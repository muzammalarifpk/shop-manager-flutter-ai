import 'package:drift/drift.dart';
import 'package:drift/wasm.dart';

LazyDatabase createConnection() {
  return LazyDatabase(() async {
    final result = await WasmDatabase.open(
      databaseName: 'shop_manager',
      sqlite3Uri: Uri.parse('sqlite3.wasm'),
      driftWorkerUri: Uri.parse('drift_worker.js'),
    );
    return result.resolvedExecutor.executor;
  });
}

