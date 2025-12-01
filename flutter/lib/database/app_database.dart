import 'package:drift/drift.dart';

// Conditional import for platform-specific database connections
import 'database_stub.dart'
    if (dart.library.io) 'database_native.dart'
    if (dart.library.html) 'database_web.dart' as database_impl;

part 'app_database.g.dart';

/// User table matching PHP users table structure
class Users extends Table {
  IntColumn get id => integer().autoIncrement()();
  TextColumn get firebaseUid => text().nullable()();
  TextColumn get number => text().withLength(min: 1, max: 50)(); // country_code-mobile (username)
  TextColumn get businessName => text().withLength(max: 255)();
  TextColumn get email => text().withLength(max: 255).nullable()();
  TextColumn get countryCode => text().withLength(max: 10)();
  TextColumn get mobile => text().withLength(max: 20)();
  TextColumn get industryType => text().withLength(max: 100).nullable()();
  TextColumn get businessType => text().withLength(max: 50).nullable()();
  TextColumn get address => text().nullable()();
  TextColumn get city => text().withLength(max: 100).nullable()();
  TextColumn get state => text().withLength(max: 100).nullable()();
  TextColumn get country => text().withLength(max: 100).nullable()();
  TextColumn get currency => text().withLength(max: 10).nullable()();
  TextColumn get gst => text().withLength(max: 50).nullable()();
  TextColumn get vat => text().withLength(max: 50).nullable()();
  TextColumn get tax => text().withLength(max: 10).nullable()();
  TextColumn get negative => text().withLength(max: 10).nullable()();
  TextColumn get secondaryUnits => text().withLength(max: 10).nullable()();
  TextColumn get variants => text().withLength(max: 10).nullable()();
  TextColumn get barcode => text().withLength(max: 10).nullable()();
  TextColumn get logo => text().nullable()();
  TextColumn get salesmanCommission => text().withLength(max: 10).nullable()();
  TextColumn get agentCommission => text().withLength(max: 10).nullable()();
  TextColumn get printHeaderNote => text().nullable()();
  TextColumn get printFooterNote => text().nullable()();
  TextColumn get lendInventory => text().withLength(max: 10).nullable()();
  TextColumn get printHeader => text().withLength(max: 10).nullable()();
  TextColumn get printUrduInvoice => text().withLength(max: 10).nullable()();
  TextColumn get smsNotification => text().withLength(max: 10).nullable()();
  TextColumn get status => text().withLength(max: 20).nullable()();
  TextColumn get privs => text().withLength(max: 255).nullable()();
  TextColumn get accountKeys => text().nullable()(); // JSON string of default_account_keys
  DateTimeColumn get createdAt => dateTime().withDefault(currentDateAndTime)();
  DateTimeColumn get updatedAt => dateTime().withDefault(currentDateAndTime)();
  
  // Index for fast lookup by number (username) - can be added via migration if needed
}

/// Session table to store current logged-in user
class Sessions extends Table {
  IntColumn get id => integer().autoIncrement()();
  IntColumn get userId => integer().references(Users, #id, onDelete: KeyAction.cascade)();
  TextColumn get token => text().nullable()(); // Firebase auth token
  DateTimeColumn get loggedInAt => dateTime().withDefault(currentDateAndTime)();
  DateTimeColumn get expiresAt => dateTime().nullable()();
  BoolColumn get isActive => boolean().withDefault(const Constant(true))();
}

@DriftDatabase(tables: [Users, Sessions])
class AppDatabase extends _$AppDatabase {
  AppDatabase() : super(_openConnection());

  @override
  int get schemaVersion => 3;

  @override
  MigrationStrategy get migration => MigrationStrategy(
    onCreate: (Migrator m) async {
      await m.createAll();
    },
    onUpgrade: (Migrator m, int from, int to) async {
      if (from < 2) {
        // Add city, state, and country columns
        await m.addColumn(users, users.city);
        await m.addColumn(users, users.state);
        await m.addColumn(users, users.country);
      }
      if (from < 3) {
        // Add lend_inventory, print_header, print_urdu_invoice, sms_notification columns
        await m.addColumn(users, users.lendInventory);
        await m.addColumn(users, users.printHeader);
        await m.addColumn(users, users.printUrduInvoice);
        await m.addColumn(users, users.smsNotification);
      }
    },
  );

  // User methods
  Future<int> insertUser(UsersCompanion user) async {
    return await into(users).insert(user, mode: InsertMode.replace);
  }

  Future<User?> getUserByNumber(String number) async {
    return await (select(users)..where((u) => u.number.equals(number))).getSingleOrNull();
  }

  Future<User?> getCurrentUser() async {
    final session = await getActiveSession();
    if (session == null) return null;
    
    return await (select(users)..where((u) => u.id.equals(session.userId))).getSingleOrNull();
  }

  Future<List<User>> getAllUsers() async {
    return await select(users).get();
  }

  Future<int> updateUser(int id, UsersCompanion user) async {
    return await (update(users)..where((u) => u.id.equals(id))).write(user);
  }

  Future<int> deleteUser(int id) async {
    return await (delete(users)..where((u) => u.id.equals(id))).go();
  }

  // Session methods
  Future<int> createSession(SessionsCompanion session) async {
    // Deactivate all existing sessions first
    await (update(sessions)..where((s) => s.isActive.equals(true)))
        .write(SessionsCompanion(isActive: const Value(false)));
    
    // Create new active session
    return await into(sessions).insert(session);
  }

  Future<Session?> getActiveSession() async {
    return await (select(sessions)..where((s) => s.isActive.equals(true))).getSingleOrNull();
  }

  Future<void> logout() async {
    await (update(sessions)..where((s) => s.isActive.equals(true)))
        .write(SessionsCompanion(isActive: const Value(false)));
  }

  Future<void> deleteAllSessions() async {
    await delete(sessions).go();
  }
}

LazyDatabase _openConnection() {
  return database_impl.createConnection();
}

