import 'package:flutter/foundation.dart' as foundation show kDebugMode, debugPrint;

/// General utility functions for the application.
/// Provides centralized logging functionality with debug mode checks and checkpoint tracking.
class GeneralFunctions {
  /// Private constructor to prevent instantiation.
  GeneralFunctions._();

  /// Enable or disable print statements globally.
  /// Set to `false` to disable all debug prints.
  static bool enablePrint = true;

  /// Print a debug message with checkpoint tracking.
  /// 
  /// Only prints in debug mode and if `enablePrint` is `true`.
  /// 
  /// [checkpoint] - A number or string identifier to track where the print is coming from.
  /// [message] - The message to print.
  /// [additionalData] - Optional additional data to print (objects, maps, etc.).
  /// 
  /// Example:
  /// ```dart
  /// GeneralFunctions.debugPrint(
  ///   checkpoint: 1,
  ///   message: 'User logged in successfully',
  ///   additionalData: {'userId': '123', 'timestamp': DateTime.now()},
  /// );
  /// ```
  static void debugPrint({
    required dynamic checkpoint,
    required String message,
    dynamic additionalData,
  }) {
    // Only print in debug mode and if printing is enabled
    if (foundation.kDebugMode && enablePrint) {
      final timestamp = DateTime.now().toIso8601String();
      final checkpointLabel = '[CHECKPOINT $checkpoint]';
      final timestampLabel = '[$timestamp]';
      
      if (additionalData != null) {
        foundation.debugPrint('$checkpointLabel $timestampLabel $message');
        foundation.debugPrint('   Data: $additionalData');
      } else {
        foundation.debugPrint('$checkpointLabel $timestampLabel $message');
      }
    }
  }

  /// Print an error message with checkpoint tracking.
  /// 
  /// Only prints in debug mode and if `enablePrint` is `true`.
  /// 
  /// [checkpoint] - A number or string identifier to track where the error is coming from.
  /// [message] - The error message to print.
  /// [error] - The error object or exception.
  /// [stackTrace] - Optional stack trace for debugging.
  /// 
  /// Example:
  /// ```dart
  /// GeneralFunctions.debugPrintError(
  ///   checkpoint: 2,
  ///   message: 'Login failed',
  ///   error: e,
  ///   stackTrace: stackTrace,
  /// );
  /// ```
  static void debugPrintError({
    required dynamic checkpoint,
    required String message,
    required dynamic error,
    dynamic stackTrace,
  }) {
    // Only print in debug mode and if printing is enabled
    if (foundation.kDebugMode && enablePrint) {
      final timestamp = DateTime.now().toIso8601String();
      final checkpointLabel = '[CHECKPOINT $checkpoint] [ERROR]';
      final timestampLabel = '[$timestamp]';
      
      foundation.debugPrint('$checkpointLabel $timestampLabel $message');
      foundation.debugPrint('   Error: $error');
      
      if (stackTrace != null) {
        foundation.debugPrint('   Stack Trace: $stackTrace');
      }
    }
  }

  /// Print a success message with checkpoint tracking.
  /// 
  /// Only prints in debug mode and if `enablePrint` is `true`.
  /// 
  /// [checkpoint] - A number or string identifier to track where the success is coming from.
  /// [message] - The success message to print.
  /// [data] - Optional data associated with the success.
  /// 
  /// Example:
  /// ```dart
  /// GeneralFunctions.debugPrintSuccess(
  ///   checkpoint: 3,
  ///   message: 'Registration successful',
  ///   data: result['data'],
  /// );
  /// ```
  static void debugPrintSuccess({
    required dynamic checkpoint,
    required String message,
    dynamic data,
  }) {
    // Only print in debug mode and if printing is enabled
    if (foundation.kDebugMode && enablePrint) {
      final timestamp = DateTime.now().toIso8601String();
      final checkpointLabel = '[CHECKPOINT $checkpoint] [SUCCESS]';
      final timestampLabel = '[$timestamp]';
      
      if (data != null) {
        foundation.debugPrint('$checkpointLabel $timestampLabel $message');
        foundation.debugPrint('   Data: $data');
      } else {
        foundation.debugPrint('$checkpointLabel $timestampLabel $message');
      }
    }
  }
}

