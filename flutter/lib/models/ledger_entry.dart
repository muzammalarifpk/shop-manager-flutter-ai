class LedgerEntry {
  final String id;
  final String ownerMobile;
  final int timestamp;
  final String addedBy;
  final String status;
  final int lastUpdated;
  final DateTime date;
  final String accountId;
  final String description;
  final double amount;
  final String amountType; // 'debit' or 'credit'
  final double balance;
  final String balanceType; // 'debit' or 'credit'
  final String entryLink;

  LedgerEntry({
    required this.id,
    required this.ownerMobile,
    required this.timestamp,
    required this.addedBy,
    required this.status,
    required this.lastUpdated,
    required this.date,
    required this.accountId,
    required this.description,
    required this.amount,
    required this.amountType,
    required this.balance,
    required this.balanceType,
    required this.entryLink,
  });

  factory LedgerEntry.fromFirestore(Map<String, dynamic> data, String id) {
    return LedgerEntry(
      id: id,
      ownerMobile: data['owner_mobile'] ?? '',
      timestamp: data['timestamp'] ?? 0,
      addedBy: data['added_by'] ?? '',
      status: data['status'] ?? 'Published',
      lastUpdated: data['last_updated'] ?? 0,
      date: data['date'] != null
          ? DateTime.parse(data['date'])
          : DateTime.now(),
      accountId: data['account_id'] ?? '',
      description: data['description'] ?? '',
      amount: (data['amount'] ?? 0).toDouble(),
      amountType: data['amount_type'] ?? 'debit',
      balance: (data['balance'] ?? 0).toDouble(),
      balanceType: data['balance_type'] ?? 'debit',
      entryLink: data['entry_link'] ?? '',
    );
  }

  Map<String, dynamic> toFirestore() {
    return {
      'owner_mobile': ownerMobile,
      'timestamp': timestamp,
      'added_by': addedBy,
      'status': status,
      'last_updated': lastUpdated,
      'date': date.toIso8601String(),
      'account_id': accountId,
      'description': description,
      'amount': amount,
      'amount_type': amountType,
      'balance': balance,
      'balance_type': balanceType,
      'entry_link': entryLink,
    };
  }
}

