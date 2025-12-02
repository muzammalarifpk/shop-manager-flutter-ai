class ChartOfAccount {
  final String id;
  final String accountHead;
  final String accountType;
  final double balance;
  final String balanceType; // 'debit' or 'credit'
  final String status; // 'published' or 'draft'
  final String? notes;
  final String ownerMobile;
  final String? accountKey; // System account identifier (e.g., 'cashonhand', 'expense')
  final String? addedBy; // Who created the account ('System' or user's business name)
  final DateTime createdAt;
  final DateTime updatedAt;

  ChartOfAccount({
    required this.id,
    required this.accountHead,
    required this.accountType,
    required this.balance,
    required this.balanceType,
    required this.status,
    this.notes,
    required this.ownerMobile,
    this.accountKey,
    this.addedBy,
    required this.createdAt,
    required this.updatedAt,
  });

  // Check if this is a system-created default account
  bool get isSystemAccount => 
      (accountKey != null && accountKey!.isNotEmpty) || 
      (addedBy != null && addedBy!.toLowerCase() == 'system');

  factory ChartOfAccount.fromFirestore(Map<String, dynamic> data, String id) {
    return ChartOfAccount(
      id: id,
      accountHead: data['account_head'] ?? '',
      accountType: data['account_type'] ?? '',
      balance: (data['balance'] ?? 0).toDouble(),
      balanceType: data['balance_type'] ?? 'debit',
      status: data['status'] ?? 'published',
      notes: data['notes'],
      ownerMobile: data['owner_mobile'] ?? '',
      accountKey: data['account_key'],
      addedBy: data['added_by'],
      createdAt: data['created_at'] != null
          ? DateTime.parse(data['created_at'])
          : DateTime.now(),
      updatedAt: data['updated_at'] != null
          ? DateTime.parse(data['updated_at'])
          : DateTime.now(),
    );
  }

  Map<String, dynamic> toFirestore() {
    final data = {
      'account_head': accountHead,
      'account_type': accountType,
      'balance': balance,
      'balance_type': balanceType,
      'status': status,
      'notes': notes,
      'owner_mobile': ownerMobile,
      'created_at': createdAt.toIso8601String(),
      'updated_at': updatedAt.toIso8601String(),
    };
    
    // Only include optional fields if they're not null
    if (accountKey != null) {
      data['account_key'] = accountKey;
    }
    if (addedBy != null) {
      data['added_by'] = addedBy;
    }
    
    return data;
  }

  ChartOfAccount copyWith({
    String? id,
    String? accountHead,
    String? accountType,
    double? balance,
    String? balanceType,
    String? status,
    String? notes,
    String? ownerMobile,
    String? accountKey,
    String? addedBy,
    DateTime? createdAt,
    DateTime? updatedAt,
  }) {
    return ChartOfAccount(
      id: id ?? this.id,
      accountHead: accountHead ?? this.accountHead,
      accountType: accountType ?? this.accountType,
      balance: balance ?? this.balance,
      balanceType: balanceType ?? this.balanceType,
      status: status ?? this.status,
      notes: notes ?? this.notes,
      ownerMobile: ownerMobile ?? this.ownerMobile,
      accountKey: accountKey ?? this.accountKey,
      addedBy: addedBy ?? this.addedBy,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
    );
  }
}

}

