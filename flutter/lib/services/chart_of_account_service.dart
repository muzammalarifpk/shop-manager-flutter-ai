import 'dart:convert';
import 'package:cloud_firestore/cloud_firestore.dart';
import '../models/chart_of_account.dart';
import '../features/auth/auth_service.dart';
import 'journal_service.dart';

class ChartOfAccountService {
  final FirebaseFirestore _firestore = FirebaseFirestore.instance;
  final AuthService _authService = AuthService();
  final JournalService _journalService = JournalService();

  // Get all accounts for current user
  Stream<List<ChartOfAccount>> getAccounts() async* {
    final user = await _authService.getCurrentUser();
    if (user == null) {
      yield [];
      return;
    }

    yield* _firestore
        .collection('chartofaccount')
        .where('owner_mobile', isEqualTo: user.number)
        .snapshots()
        .map((snapshot) {
          final accounts = snapshot.docs
              .map((doc) => ChartOfAccount.fromFirestore(doc.data(), doc.id))
              .where((account) => account.status != 'delete') // Filter out deleted accounts
              .toList();
          // Sort in memory instead of using Firestore orderBy
          accounts.sort((a, b) => a.accountHead.compareTo(b.accountHead));
          return accounts;
        });
  }

  // Get single account by ID
  Future<ChartOfAccount?> getAccountById(String id) async {
    try {
      final doc = await _firestore.collection('chartofaccount').doc(id).get();
      if (doc.exists) {
        return ChartOfAccount.fromFirestore(doc.data()!, doc.id);
      }
      return null;
    } catch (e) {
      throw Exception('Failed to get account: $e');
    }
  }

  // Add new account
  Future<String> addAccount({
    required String accountHead,
    required String accountType,
    required double balance,
    required String balanceType,
    required String status,
    String? notes,
  }) async {
    try {
      final user = await _authService.getCurrentUser();
      if (user == null) {
        throw Exception('User not logged in');
      }

      final now = DateTime.now();
      final timestamp = now.millisecondsSinceEpoch ~/ 1000; // Unix timestamp

      // Create account data matching PHP structure
      final accountData = {
        'account_head': accountHead,
        'account_type': accountType,
        'balance': balance,
        'balance_type': balanceType.toLowerCase(),
        'old_balance': balance,
        'old_balance_type': balanceType.toLowerCase(),
        'status': status,
        'notes': notes ?? '',
        'owner_mobile': user.number,
        'added_by': user.businessName, // User's business name
        'timestamp': timestamp,
        'last_updated': now.toUtc().toIso8601String(),
        'last_update_date': now.toUtc().toIso8601String(),
        'created_at': now.toIso8601String(),
        'updated_at': now.toIso8601String(),
        // No account_key for user-created accounts (only system accounts have this)
      };

      final docRef = await _firestore
          .collection('chartofaccount')
          .add(accountData);

      final newAccountId = docRef.id;

      // If opening balance is not zero, create journal and ledger entries
      if (balance != 0) {
        // Get Capital account ID from user's default accounts
        final userDoc = await _firestore.collection('users').doc(user.number).get();
        final userData = userDoc.data();
        
        String? capitalAccountId;
        if (userData != null && userData['default_account_keys'] != null) {
          try {
            final accountKeys = jsonDecode(userData['default_account_keys']) as Map<String, dynamic>;
            capitalAccountId = accountKeys['capital'];
          } catch (e) {
            // If parsing fails, try to find capital account manually
            final capitalSnapshot = await _firestore
                .collection('chartofaccount')
                .where('owner_mobile', isEqualTo: user.number)
                .where('account_key', isEqualTo: 'capital')
                .limit(1)
                .get();
            
            if (capitalSnapshot.docs.isNotEmpty) {
              capitalAccountId = capitalSnapshot.docs.first.id;
            }
          }
        }

        if (capitalAccountId != null) {
          // Create journal entry based on balance type
          List<Map<String, dynamic>> creditArray;
          List<Map<String, dynamic>> debitArray;

          if (balanceType.toLowerCase() == 'debit') {
            // Debit the new account, Credit the capital account
            debitArray = [{'account': newAccountId, 'amount': balance}];
            creditArray = [{'account': capitalAccountId, 'amount': balance}];
          } else {
            // Credit the new account, Debit the capital account
            creditArray = [{'account': newAccountId, 'amount': balance}];
            debitArray = [{'account': capitalAccountId, 'amount': balance}];
          }

          await _journalService.createJournalEntry(
            creditArray: creditArray,
            debitArray: debitArray,
            entryType: 'New Account with beginning balance.',
            entryLink: 'accountid:$newAccountId',
          );
        }
      }

      return newAccountId;
    } catch (e) {
      throw Exception('Failed to add account: $e');
    }
  }

  // Update existing account
  Future<void> updateAccount({
    required String id,
    required String accountHead,
    required String status,
    String? notes,
  }) async {
    try {
      final user = await _authService.getCurrentUser();
      if (user == null) {
        throw Exception('User not logged in');
      }

      final now = DateTime.now();

      await _firestore.collection('chartofaccount').doc(id).update({
        'account_head': accountHead,
        'status': status,
        'notes': notes ?? '',
        'updated_at': now.toIso8601String(),
        'last_updated': now.toUtc().toIso8601String(),
        'last_update_date': now.toUtc().toIso8601String(),
      });
    } catch (e) {
      throw Exception('Failed to update account: $e');
    }
  }

  // Soft delete account (mark as deleted, don't actually remove)
  Future<void> softDeleteAccount(String id) async {
    try {
      final user = await _authService.getCurrentUser();
      if (user == null) {
        throw Exception('User not logged in');
      }

      final now = DateTime.now();

      // Update status to 'delete' instead of actually deleting
      await _firestore.collection('chartofaccount').doc(id).update({
        'status': 'delete',
        'updated_at': now.toIso8601String(),
        'last_updated': now.toUtc().toIso8601String(),
        'last_update_date': now.toUtc().toIso8601String(),
      });
    } catch (e) {
      throw Exception('Failed to delete account: $e');
    }
  }

  // Hard delete account (permanent removal - use with caution)
  Future<void> deleteAccount(String id) async {
    try {
      final user = await _authService.getCurrentUser();
      if (user == null) {
        throw Exception('User not logged in');
      }

      await _firestore.collection('chartofaccount').doc(id).delete();
    } catch (e) {
      throw Exception('Failed to delete account: $e');
    }
  }

  // Search accounts
  Future<List<ChartOfAccount>> searchAccounts(String query) async {
    try {
      final user = await _authService.getCurrentUser();
      if (user == null) {
        return [];
      }

      final snapshot = await _firestore
          .collection('chartofaccount')
          .where('owner_mobile', isEqualTo: user.number)
          .get();

      final accounts = snapshot.docs
          .map((doc) => ChartOfAccount.fromFirestore(doc.data(), doc.id))
          .where((account) =>
              account.accountHead.toLowerCase().contains(query.toLowerCase()) ||
              account.accountType.toLowerCase().contains(query.toLowerCase()))
          .toList();

      return accounts;
    } catch (e) {
      throw Exception('Failed to search accounts: $e');
    }
  }
}

