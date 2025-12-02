class JournalEntry {
  final String id;
  final String description;
  final DateTime dateTime;
  final String creditJson; // JSON array of credit entries
  final String debitJson; // JSON array of debit entries
  final String entryType;
  final String entryLink;
  final String ownerMobile;
  final int timestamp;
  final String addedBy;
  final String status;
  final int lastUpdated;

  JournalEntry({
    required this.id,
    required this.description,
    required this.dateTime,
    required this.creditJson,
    required this.debitJson,
    required this.entryType,
    required this.entryLink,
    required this.ownerMobile,
    required this.timestamp,
    required this.addedBy,
    required this.status,
    required this.lastUpdated,
  });

  factory JournalEntry.fromFirestore(Map<String, dynamic> data, String id) {
    return JournalEntry(
      id: id,
      description: data['description'] ?? '',
      dateTime: data['date_time'] != null
          ? DateTime.parse(data['date_time'])
          : DateTime.now(),
      creditJson: data['credit_json'] ?? '[]',
      debitJson: data['debit_json'] ?? '[]',
      entryType: data['entry_type'] ?? '',
      entryLink: data['entry_link'] ?? '',
      ownerMobile: data['owner_mobile'] ?? '',
      timestamp: data['timestamp'] ?? 0,
      addedBy: data['added_by'] ?? '',
      status: data['status'] ?? 'Published',
      lastUpdated: data['last_updated'] ?? 0,
    );
  }

  Map<String, dynamic> toFirestore() {
    return {
      'description': description,
      'date_time': dateTime.toIso8601String(),
      'credit_json': creditJson,
      'debit_json': debitJson,
      'entry_type': entryType,
      'entry_link': entryLink,
      'owner_mobile': ownerMobile,
      'timestamp': timestamp,
      'added_by': addedBy,
      'status': status,
      'last_updated': lastUpdated,
    };
  }
}

