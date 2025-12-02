import 'package:cloud_firestore/cloud_firestore.dart';
import '../models/chart_of_account.dart';
import '../features/auth/auth_service.dart';

class ChartOfAccountService {
  final FirebaseFirestore _firestore = FirebaseFirestore.instance;
  final AuthService _authService = AuthService();

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
        .orderBy('account_head')
        .snapshots()
        .map((snapshot) => snapshot.docs
            .map((doc) => ChartOfAccount.fromFirestore(doc.data(), doc.id))
            .toList());
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

      final account = ChartOfAccount(
        id: '', // Will be set by Firestore
        accountHead: accountHead,
        accountType: accountType,
        balance: balance,
        balanceType: balanceType,
        status: status,
        notes: notes,
        ownerMobile: user.number,
        createdAt: DateTime.now(),
        updatedAt: DateTime.now(),
      );

      final docRef = await _firestore
          .collection('chartofaccount')
          .add(account.toFirestore());

      return docRef.id;
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

      await _firestore.collection('chartofaccount').doc(id).update({
        'account_head': accountHead,
        'status': status,
        'notes': notes,
        'updated_at': DateTime.now().toIso8601String(),
      });
    } catch (e) {
      throw Exception('Failed to update account: $e');
    }
  }

  // Delete account
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

