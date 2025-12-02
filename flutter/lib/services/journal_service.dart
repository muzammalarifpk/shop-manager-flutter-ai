import 'dart:convert';
import 'package:cloud_firestore/cloud_firestore.dart';
import '../features/auth/auth_service.dart';
import 'ledger_service.dart';

class JournalService {
  final FirebaseFirestore _firestore = FirebaseFirestore.instance;
  final AuthService _authService = AuthService();
  final LedgerService _ledgerService = LedgerService();

  /// Create a journal entry with credit and debit arrays
  /// Matches PHP journal_entry() function
  Future<String> createJournalEntry({
    required List<Map<String, dynamic>> creditArray,
    required List<Map<String, dynamic>> debitArray,
    required String entryType,
    required String entryLink,
  }) async {
    try {
      final user = await _authService.getCurrentUser();
      if (user == null) {
        throw Exception('User not logged in');
      }

      final now = DateTime.now();
      final timestamp = now.millisecondsSinceEpoch ~/ 1000;

      // Create journal entry
      final journalData = {
        'description': entryType,
        'date_time': now.toIso8601String(),
        'credit_json': jsonEncode(creditArray),
        'debit_json': jsonEncode(debitArray),
        'entry_type': entryType,
        'entry_link': entryLink,
        'owner_mobile': user.number,
        'timestamp': timestamp,
        'added_by': user.number,
        'status': 'Published',
        'last_updated': timestamp,
      };

      final docRef = await _firestore.collection('journal').add(journalData);

      // Create ledger entries for credit accounts
      for (final entry in creditArray) {
        await _ledgerService.createLedgerEntry(
          description: entryType,
          accountId: entry['account'],
          amount: (entry['amount'] as num).toDouble(),
          amountType: 'credit',
          entryLink: entryLink,
        );
      }

      // Create ledger entries for debit accounts
      for (final entry in debitArray) {
        await _ledgerService.createLedgerEntry(
          description: entryType,
          accountId: entry['account'],
          amount: (entry['amount'] as num).toDouble(),
          amountType: 'debit',
          entryLink: entryLink,
        );
      }

      // Update user's entries count
      await _firestore.collection('users').doc(user.number).update({
        'entries': FieldValue.increment(1),
      });

      return docRef.id;
    } catch (e) {
      throw Exception('Failed to create journal entry: $e');
    }
  }
}

