import 'package:cloud_firestore/cloud_firestore.dart';
import '../features/auth/auth_service.dart';

class LedgerService {
  final FirebaseFirestore _firestore = FirebaseFirestore.instance;
  final AuthService _authService = AuthService();

  /// Create a ledger entry for an account
  /// Matches PHP ledger_entry() function
  Future<String> createLedgerEntry({
    required String description,
    required String accountId,
    required double amount,
    required String amountType, // 'debit' or 'credit'
    required String entryLink,
  }) async {
    try {
      if (amount == 0) {
        return 'Skipped - amount is 0';
      }

      final user = await _authService.getCurrentUser();
      if (user == null) {
        throw Exception('User not logged in');
      }

      final now = DateTime.now();
      final timestamp = now.millisecondsSinceEpoch ~/ 1000;

      // Get the last ledger entry for this account to calculate new balance
      final lastLedgerSnapshot = await _firestore
          .collection('ledger')
          .where('account_id', isEqualTo: accountId)
          .where('owner_mobile', isEqualTo: user.number)
          .orderBy('timestamp', descending: true)
          .limit(1)
          .get();

      double oldBalance = 0;
      String oldBalanceType = 'debit';

      if (lastLedgerSnapshot.docs.isNotEmpty) {
        final lastLedger = lastLedgerSnapshot.docs.first.data();
        oldBalance = (lastLedger['balance'] ?? 0).toDouble();
        oldBalanceType = lastLedger['balance_type'] ?? 'debit';
      }

      // Calculate new balance (matching PHP logic)
      double newBalance = 0;
      String newBalanceType = '';

      if (oldBalance == 0) {
        newBalanceType = amountType;
        newBalance = amount;
      } else if (oldBalanceType == 'debit' && amountType == 'debit') {
        newBalanceType = 'debit';
        newBalance = oldBalance + amount;
      } else if (oldBalanceType == 'credit' && amountType == 'credit') {
        newBalanceType = 'credit';
        newBalance = oldBalance + amount;
      } else if (oldBalanceType == 'credit' && amountType == 'debit') {
        if (amount > oldBalance) {
          newBalanceType = 'debit';
          newBalance = amount - oldBalance;
        } else {
          newBalanceType = 'credit';
          newBalance = oldBalance - amount;
        }
      } else {
        // oldBalanceType == 'debit' && amountType == 'credit'
        if (amount > oldBalance) {
          newBalanceType = 'credit';
          newBalance = amount - oldBalance;
        } else {
          newBalanceType = 'debit';
          newBalance = oldBalance - amount;
        }
      }

      // Create ledger entry
      final ledgerData = {
        'owner_mobile': user.number,
        'timestamp': timestamp,
        'added_by': user.number,
        'status': 'Published',
        'last_updated': timestamp,
        'date': now.toIso8601String(),
        'account_id': accountId,
        'description': description,
        'amount': amount,
        'amount_type': amountType,
        'balance': newBalance,
        'balance_type': newBalanceType,
        'entry_link': entryLink,
      };

      final docRef = await _firestore.collection('ledger').add(ledgerData);

      // Update the account's balance in chartofaccount
      await _firestore.collection('chartofaccount').doc(accountId).update({
        'balance': newBalance,
        'balance_type': newBalanceType,
        'last_updated': now.toUtc().toIso8601String(),
        'last_update_date': now.toUtc().toIso8601String(),
      });

      return docRef.id;
    } catch (e) {
      throw Exception('Failed to create ledger entry: $e');
    }
  }
}

