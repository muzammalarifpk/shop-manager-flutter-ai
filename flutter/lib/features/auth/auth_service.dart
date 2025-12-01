import 'dart:convert';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:firebase_auth/firebase_auth.dart' hide User;
import 'package:drift/drift.dart' show Value;
import '../../database/app_database.dart';
import '../../utils/general_functions.dart';

/// Service for handling authentication and user data storage.
/// Matches the PHP registration logic from do_register_flutter.php
class AuthService {
  final FirebaseAuth _auth = FirebaseAuth.instance;
  final FirebaseFirestore _firestore = FirebaseFirestore.instance;
  final AppDatabase _database = AppDatabase();

  /// Register a new user with validation matching PHP logic.
  /// 
  /// Required fields: business_name, country_code, mobile, password
  /// Unique field: number (country_code + '-' + mobile)
  Future<Map<String, dynamic>> register({
    required String businessName,
    required String countryCode,
    required String mobile,
    required String password,
    String? industryType,
    String? businessType,
    String? email,
    String? referby,
  }) async {
    try {
      // Generate number field: country_code + '-' + mobile (matching PHP)
      final number = '$countryCode-$mobile';
      
      // Validate required fields (matching PHP: $fields['req'])
      final validationErrors = <String>[];
      
      if (businessName.trim().isEmpty) {
        validationErrors.add('business_name Is a required Field.');
      }
      
      if (countryCode.trim().isEmpty) {
        validationErrors.add('country_code Is a required Field.');
      }
      
      if (mobile.trim().isEmpty) {
        validationErrors.add('mobile Is a required Field.');
      }
      
      if (password.trim().isEmpty) {
        validationErrors.add('password Is a required Field.');
      }
      
      if (number.trim().isEmpty) {
        validationErrors.add('number Is a required Field.');
      }
      
      // Return validation errors if any
      if (validationErrors.isNotEmpty) {
        return {
          'success': false,
          'code': 204,
          'message': 'Ops Validation Error: ${validationErrors.join(" ")}',
        };
      }
      
      // Create authentication credential with phone number first
      // Since Firebase Auth uses email or phone, we'll create a custom token
      // or use email if provided, otherwise use number@temp.com format
      // Firebase requires valid email format - remove special chars from number
      final String authEmail;
      if (email != null && email.isNotEmpty) {
        authEmail = email;
      } else {
        // Use number as email identifier for Firebase Auth
        // Clean the number for valid email format (remove + and -)
        final cleanNumber = number.replaceAll('+', 'plus').replaceAll('-', '');
        authEmail = '$cleanNumber@shopmanager.local';
      }
      
      // Create user in Firebase Auth
      final credential = await _auth.createUserWithEmailAndPassword(
        email: authEmail,
        password: password,
      );
      
      final user = credential.user;
      if (user == null) {
        return {
          'success': false,
          'code': 401,
          'message': 'Failed to create user account',
        };
      }
      
      // Now check if number (username) already exists (matching PHP unique check)
      // We do this after auth to ensure we have permission to query Firestore
      try {
        final existingUserQuery = await _firestore
            .collection('users')
            .where('number', isEqualTo: number)
            .limit(1)
            .get();
        
        if (existingUserQuery.docs.isNotEmpty) {
          // Delete the auth user since number already exists
          try {
            await user.delete();
          } catch (_) {
            // Ignore deletion errors
          }
          
          return {
            'success': false,
            'code': 204,
            'message': '$number Already Exists. number must be unique.',
          };
        }
      } catch (e) {
        // If query fails, delete auth user and return error
        try {
          await user.delete();
        } catch (_) {
          // Ignore deletion errors
        }
        
        return {
          'success': false,
          'code': 500,
          'message': 'Failed to verify phone number uniqueness: ${e.toString()}',
        };
      }
      
      // Get current timestamp (matching PHP $time)
      final timestamp = FieldValue.serverTimestamp();
      
      // Generate cohort (Y-W format matching PHP: date("Y-W"))
      final now = DateTime.now();
      final year = now.year;
      final week = _getWeekNumber(now);
      final cohort = '$year-$week';
      
      // Prepare user data matching PHP structure
      final userData = {
        // Default fields (matching PHP $fields['default'])
        'timestamp': timestamp,
        'added_by': 'flutter_app',
        'status': 'published',
        'last_updated': timestamp,
        'ip': '', // Can be added if needed
        'sync': 0,
        'source': 'flutter',
        'cohort': cohort,
        
        // User input fields (matching PHP $fields['all'])
        'industry_type': industryType ?? '',
        'business_type': businessType ?? 'Retailer',
        'business_name': businessName,
        'email': email ?? '',
        'referby': referby ?? '',
        'country_code': countryCode,
        'mobile': mobile,
        'number': number,
        'password': '', // Don't store plain password, Firebase Auth handles it
        
        // Additional fields from PHP
        'bars': '---',
        'default_account_keys': '',
        'logo': 'uploads/images/default-logo.png',
        'currency': 'Rs ',
        'continent_name': '',
        'country_name': '',
        'country_code_iso': '',
        'region_name': '',
        'city': '',
        
        // Firebase Auth UID
        'firebase_uid': user.uid,
      };
      
      // Store user data in Firestore
      try {
        await _firestore.collection('users').doc(user.uid).set(userData);
      } catch (e) {
        // If Firestore write fails, delete the Firebase Auth user to maintain consistency
        try {
          await user.delete();
        } catch (_) {
          // Ignore deletion errors
        }
        rethrow;
      }

      // Create default accounts (matching PHP do_register.php)
      Map<String, String> defaultAccountIds = {};
      try {
        defaultAccountIds = await _createDefaultAccounts(number);
        GeneralFunctions.debugPrintSuccess(
          checkpoint: 13,
          message: 'Default accounts creation completed',
          data: {'accounts_created': defaultAccountIds.length},
        );
      } catch (e, stackTrace) {
        GeneralFunctions.debugPrintError(
          checkpoint: 10,
          message: 'Failed to create default accounts',
          error: e,
          stackTrace: stackTrace,
        );
        // Continue even if accounts creation fails - we'll log it but not fail registration
      }

      // Create walk-in contact (matching PHP do_register.php)
      try {
        await _createWalkInContact(number);
      } catch (e) {
        GeneralFunctions.debugPrintError(
          checkpoint: 11,
          message: 'Failed to create walk-in contact',
          error: e,
        );
        // Continue even if contact creation fails
      }

      // Update user's default_account_keys with the account IDs (matching PHP)
      String defaultAccountKeysJson = '';
      if (defaultAccountIds.isNotEmpty) {
        // Convert map to proper JSON format (matching PHP json_encode)
        defaultAccountKeysJson = jsonEncode(defaultAccountIds);
        
        // Update user document with default_account_keys
        try {
          await _firestore.collection('users').doc(user.uid).update({
            'default_account_keys': defaultAccountKeysJson,
          });
        } catch (e) {
          GeneralFunctions.debugPrintError(
            checkpoint: 12,
            message: 'Failed to update default_account_keys',
            error: e,
          );
        }
      }

      // Automatically log in the user after registration (matching PHP behavior)
      // Fetch user data from Firestore for login
      final userDoc = await _firestore
          .collection('users')
          .where('number', isEqualTo: number)
          .limit(1)
          .get();

      if (userDoc.docs.isEmpty) {
        return {
          'success': false,
          'code': 500,
          'message': 'User created but could not be found for login',
        };
      }

      final userDataFromFirestore = userDoc.docs.first.data();
      final userId = userDoc.docs.first.id;

      // Get Firebase Auth token
      final token = await user.getIdToken();

      // Prepare user data for local storage
      final defaultLogo = 'uploads/images/default-logo.png';
      final logoUrl = userDataFromFirestore['logo'] != null && userDataFromFirestore['logo'].toString().isNotEmpty
          ? 'https://shop-manager.roznamchaapp.com/${userDataFromFirestore['logo']}'
          : 'https://shop-manager.roznamchaapp.com/$defaultLogo';

      // Store user in local database
      final localUser = UsersCompanion.insert(
        firebaseUid: Value(user.uid),
        number: number,
        businessName: userDataFromFirestore['business_name'] ?? businessName,
        email: Value(userDataFromFirestore['email']),
        countryCode: userDataFromFirestore['country_code'] ?? countryCode,
        mobile: userDataFromFirestore['mobile'] ?? mobile,
        industryType: Value(userDataFromFirestore['industry_type']),
        businessType: Value(userDataFromFirestore['business_type']),
        address: Value(userDataFromFirestore['address']),
        currency: Value(userDataFromFirestore['currency'] ?? 'Rs '),
        gst: Value(userDataFromFirestore['gst']),
        vat: Value(userDataFromFirestore['vat']),
        tax: Value(userDataFromFirestore['tax']),
        negative: Value(userDataFromFirestore['negative']),
        secondaryUnits: Value(userDataFromFirestore['secondary_units']),
        variants: Value(userDataFromFirestore['variants']),
        barcode: Value(userDataFromFirestore['barcode']),
        logo: Value(logoUrl),
        salesmanCommission: Value(userDataFromFirestore['salesman_commission']),
        agentCommission: Value(userDataFromFirestore['agent_commission']),
        printHeaderNote: Value(userDataFromFirestore['print_header_note']),
        printFooterNote: Value(userDataFromFirestore['print_footer_note']),
        status: Value(userDataFromFirestore['status'] ?? 'published'),
        privs: Value(userDataFromFirestore['privs'] ?? '*'),
        accountKeys: Value(defaultAccountKeysJson),
      );

      final dbUserId = await _database.insertUser(localUser);

      // Create session
      await _database.createSession(
        SessionsCompanion.insert(
          userId: dbUserId,
          token: Value(token),
          isActive: const Value(true),
        ),
      );
      
      // Return success response matching PHP structure with login data
      return {
        'success': true,
        'code': 200,
        'message': 'Registered Successfully',
        'data': {
          'id': userId,
          'token': token,
          'username': number,
          'addedBy': number,
          'name': userDataFromFirestore['business_name'] ?? businessName,
          'account_keys': defaultAccountKeysJson,
          'industry_type': userDataFromFirestore['industry_type'] ?? industryType ?? '',
          'business_type': userDataFromFirestore['business_type'] ?? businessType ?? 'Retailer',
          'address': userDataFromFirestore['address'] ?? '',
          'email': userDataFromFirestore['email'] ?? email ?? '',
          'country_code': userDataFromFirestore['country_code'] ?? countryCode,
          'mobile': userDataFromFirestore['mobile'] ?? mobile,
          'number': number,
          'currency': userDataFromFirestore['currency'] ?? 'Rs ',
          'gst': userDataFromFirestore['gst'] ?? '',
          'vat': userDataFromFirestore['vat'] ?? '',
          'negative': userDataFromFirestore['negative'] ?? 'off',
          'tax': userDataFromFirestore['tax'] ?? 'off',
          'secondary_units': userDataFromFirestore['secondary_units'] ?? 'off',
          'variants': userDataFromFirestore['variants'] ?? 'off',
          'barcode': userDataFromFirestore['barcode'] ?? 'off',
          'logo': logoUrl,
          'salesman_commission': userDataFromFirestore['salesman_commission'] ?? 'off',
          'agent_commission': userDataFromFirestore['agent_commission'] ?? 'off',
          'print_header_note': userDataFromFirestore['print_header_note'] ?? '',
          'print_footer_note': userDataFromFirestore['print_footer_note'] ?? '',
          'status': userDataFromFirestore['status'] ?? 'published',
          'privs': '*',
        },
      };
    } on FirebaseAuthException catch (e) {
      String message = 'Registration failed';
      int code = 400;
      
      switch (e.code) {
        case 'weak-password':
          message = 'The password provided is too weak.';
          break;
        case 'email-already-in-use':
          message = 'An account already exists for this number.';
          code = 204;
          break;
        case 'invalid-email':
          message = 'Invalid email format.';
          break;
        case 'operation-not-allowed':
          message = 'Email/Password accounts are not enabled. Please contact support.';
          break;
        case 'network-request-failed':
          message = 'Network error. Please check your internet connection.';
          break;
        default:
          message = e.message ?? 'Registration failed: ${e.code}';
      }
      
      // Log the full error for debugging
      GeneralFunctions.debugPrintError(
        checkpoint: 6,
        message: 'FirebaseAuthException: ${e.code}',
        error: e.message,
        stackTrace: e.stackTrace,
      );
      
      return {
        'success': false,
        'code': code,
        'message': message,
      };
    } on FirebaseException catch (e) {
      // Firestore errors
      String message = 'Database error occurred';
      int code = 500;
      
      if (e.code == 'permission-denied') {
        message = 'Permission denied. Please check Firestore security rules.';
      } else if (e.code == 'unavailable') {
        message = 'Service temporarily unavailable. Please try again.';
      } else {
        message = 'Database error: ${e.message ?? e.code}';
      }
      
      GeneralFunctions.debugPrintError(
        checkpoint: 7,
        message: 'FirebaseException: ${e.code}',
        error: e.message,
      );
      
      return {
        'success': false,
        'code': code,
        'message': message,
      };
    } catch (e, stackTrace) {
      // General errors - print full details for debugging
      GeneralFunctions.debugPrintError(
        checkpoint: 8,
        message: 'Registration error occurred',
        error: e,
        stackTrace: stackTrace,
      );
      
      return {
        'success': false,
        'code': 500,
        'message': 'An error occurred: ${e.toString()}',
      };
    }
  }
  
  /// Get week number for cohort calculation
  int _getWeekNumber(DateTime date) {
    final dayOfYear = date.difference(DateTime(date.year, 1, 1)).inDays + 1;
    return ((dayOfYear - date.weekday + 10) / 7).floor();
  }

  /// Default accounts list matching PHP config.php
  static const List<Map<String, String>> _defaultAccounts = [
    {'account_key': 'cashonhand', 'account_head': 'Cash', 'account_type': 'Cash'},
    {'account_key': 'expense', 'account_head': 'Expense', 'account_type': 'Expense'},
    {'account_key': 'rnp', 'account_head': 'Accounts Receivable and Payable', 'account_type': 'Assets'},
    {'account_key': 'sales', 'account_head': 'Sales', 'account_type': 'Income'},
    {'account_key': 'tax', 'account_head': 'All Taxes', 'account_type': 'Liabilities'},
    {'account_key': 'purchases', 'account_head': 'Purchases', 'account_type': 'Cost of Sale'},
    {'account_key': 'purchasediscount', 'account_head': 'Purchase Discount', 'account_type': 'Income'},
    {'account_key': 'salediscount', 'account_head': 'Sale Discount', 'account_type': 'Expense'},
    {'account_key': 'profitandlose', 'account_head': 'Profit and Lose', 'account_type': 'Income'},
    {'account_key': 'capital', 'account_head': 'Capital', 'account_type': 'Equity'},
    {'account_key': 'inventory', 'account_head': 'Inventory', 'account_type': 'Assets'},
  ];

  /// Create default accounts in Firestore (chartofaccount collection)
  /// Returns a map of account_key -> account_document_id
  Future<Map<String, String>> _createDefaultAccounts(String ownerMobile) async {
    final timestamp = FieldValue.serverTimestamp();
    final accountIds = <String, String>{};

    GeneralFunctions.debugPrintSuccess(
      checkpoint: 20,
      message: 'Starting to create default accounts for: $ownerMobile',
      data: {'account_count': _defaultAccounts.length},
    );

    for (final account in _defaultAccounts) {
      try {
        final accountData = {
          'owner_mobile': ownerMobile,
          'timestamp': timestamp,
          'added_by': 'System',
          'status': 'Published',
          'last_updated': timestamp,
          'account_head': account['account_head'],
          'account_type': account['account_type'],
          'balance': 0,
          'balance_type': 'cr',
          'old_balance': 0,
          'old_balance_type': 'cr',
          'last_update_date': timestamp,
          'notes': '',
        };

        GeneralFunctions.debugPrintSuccess(
          checkpoint: 21,
          message: 'Creating account: ${account['account_head']}',
          data: accountData,
        );

        final docRef = await _firestore.collection('chartofaccount').add(accountData);
        accountIds[account['account_key']!] = docRef.id;

        GeneralFunctions.debugPrintSuccess(
          checkpoint: 22,
          message: 'Successfully created account: ${account['account_head']}',
          data: {'account_key': account['account_key'], 'doc_id': docRef.id},
        );
      } catch (e, stackTrace) {
        GeneralFunctions.debugPrintError(
          checkpoint: 23,
          message: 'Failed to create account: ${account['account_head']}',
          error: e,
          stackTrace: stackTrace,
        );
        // Continue with other accounts even if one fails
      }
    }

    GeneralFunctions.debugPrintSuccess(
      checkpoint: 24,
      message: 'Finished creating default accounts',
      data: {'created_count': accountIds.length, 'total_count': _defaultAccounts.length},
    );

    return accountIds;
  }

  /// Create walk-in contact in Firestore (contacts collection)
  Future<void> _createWalkInContact(String ownerMobile) async {
    final timestamp = FieldValue.serverTimestamp();
    
    final contactData = {
      'owner_mobile': ownerMobile,
      'timestamp': timestamp,
      'added_by': 'System',
      'status': 'Published',
      'last_updated': timestamp,
      'name': 'Walk-in Customer / Supplier',
      'country_code': '+',
      'mobile': '0000',
      'number': '+0000', // Using '+0000' to match existing database format (PHP: '+' + '0000')
      'type': 'customer',
      'balance': '0',
      'balance_status': 'payable',
    };

    await _firestore.collection('contacts').add(contactData);
  }
  
  /// Check if a phone number (number field) already exists
  /// Note: This requires the user to be authenticated. For registration,
  /// the uniqueness check is done after auth creation in the register() method.
  Future<bool> checkNumberExists(String number) async {
    if (_auth.currentUser == null) {
      // Can't check without authentication - will be checked during registration
      return false;
    }
    
    final query = await _firestore
        .collection('users')
        .where('number', isEqualTo: number)
        .limit(1)
        .get();
    
    return query.docs.isNotEmpty;
  }

  /// Login user with username (number: country_code-mobile) and password
  /// Matches PHP login logic from do_login_flutter.php
  Future<Map<String, dynamic>> login({
    required String countryCode,
    required String mobile,
    required String password,
  }) async {
    try {
      // Generate username: country_code + '-' + mobile (matching PHP)
      String number = '$countryCode-$mobile';
      
      // Ensure number starts with + if country code doesn't
      if (!number.startsWith('+')) {
        number = '+$number';
      }
      
      // Validate inputs
      if (number.trim().isEmpty) {
        return {
          'success': false,
          'code': 201,
          'message': 'Username (phone number) is required.',
        };
      }
      
      if (password.trim().isEmpty) {
        return {
          'success': false,
          'code': 201,
          'message': 'Password is required.',
        };
      }

      // Get Firebase Auth email from number (same format as registration)
      final cleanNumber = number.replaceAll('+', 'plus').replaceAll('-', '');
      final authEmail = '$cleanNumber@shopmanager.local';

      // Authenticate with Firebase Auth
      try {
        final credential = await _auth.signInWithEmailAndPassword(
          email: authEmail,
          password: password,
        );

        if (credential.user == null) {
          return {
            'success': false,
            'code': 201,
            'message': 'Login failed. Invalid credentials.',
          };
        }

        // Fetch user data from Firestore
        final userDoc = await _firestore
            .collection('users')
            .where('number', isEqualTo: number)
            .limit(1)
            .get();

        if (userDoc.docs.isEmpty) {
          await _auth.signOut();
          return {
            'success': false,
            'code': 201,
            'message': 'Login failed. User not found.',
          };
        }

        final userData = userDoc.docs.first.data();
        final userId = userDoc.docs.first.id;

        // Get Firebase Auth token
        final token = await credential.user!.getIdToken();

        // Prepare user data matching PHP response structure
        final defaultLogo = 'uploads/images/default-logo.png';
        final logoUrl = userData['logo'] != null && userData['logo'].toString().isNotEmpty
            ? 'https://shop-manager.roznamchaapp.com/${userData['logo']}'
            : 'https://shop-manager.roznamchaapp.com/$defaultLogo';

        // Store user in local database
        final user = UsersCompanion.insert(
          firebaseUid: Value(credential.user!.uid),
          number: number,
          businessName: userData['business_name'] ?? '',
          email: Value(userData['email']),
          countryCode: userData['country_code'] ?? countryCode,
          mobile: userData['mobile'] ?? mobile,
          industryType: Value(userData['industry_type']),
          businessType: Value(userData['business_type']),
          address: Value(userData['address']),
          currency: Value(userData['currency'] ?? 'Rs '),
          gst: Value(userData['gst']),
          vat: Value(userData['vat']),
          tax: Value(userData['tax']),
          negative: Value(userData['negative']),
          secondaryUnits: Value(userData['secondary_units']),
          variants: Value(userData['variants']),
          barcode: Value(userData['barcode']),
          logo: Value(logoUrl),
          salesmanCommission: Value(userData['salesman_commission']),
          agentCommission: Value(userData['agent_commission']),
          printHeaderNote: Value(userData['print_header_note']),
          printFooterNote: Value(userData['print_footer_note']),
          status: Value(userData['status'] ?? 'published'),
          privs: Value(userData['privs'] ?? '*'),
          accountKeys: Value(userData['default_account_keys']?.toString()),
        );

        final dbUserId = await _database.insertUser(user);

        // Create session
        await _database.createSession(
          SessionsCompanion.insert(
            userId: dbUserId,
            token: Value(token),
            isActive: const Value(true),
          ),
        );

        // Return success response matching PHP structure
        return {
          'success': true,
          'code': 200,
          'message': 'Login successfully.',
          'data': {
            'id': userId,
            'token': token,
            'username': number,
            'addedBy': number,
            'name': userData['business_name'] ?? '',
            'account_keys': userData['default_account_keys'] ?? '',
            'industry_type': userData['industry_type'] ?? '',
            'business_type': userData['business_type'] ?? 'Retailer',
            'address': userData['address'] ?? '',
            'email': userData['email'] ?? '',
            'country_code': userData['country_code'] ?? countryCode,
            'mobile': userData['mobile'] ?? mobile,
            'number': number,
            'currency': userData['currency'] ?? 'Rs ',
            'gst': userData['gst'] ?? '',
            'vat': userData['vat'] ?? '',
            'negative': userData['negative'] ?? 'off',
            'tax': userData['tax'] ?? 'off',
            'secondary_units': userData['secondary_units'] ?? 'off',
            'variants': userData['variants'] ?? 'off',
            'barcode': userData['barcode'] ?? 'off',
            'logo': logoUrl,
            'salesman_commission': userData['salesman_commission'] ?? 'off',
            'print_header_note': userData['print_header_note'] ?? '',
            'print_footer_note': userData['print_footer_note'] ?? '',
            'status': userData['status'] ?? 'published',
            'privs': '*',
          },
        };
      } on FirebaseAuthException catch (e) {
        String message = 'Login failed';
        
        switch (e.code) {
          case 'user-not-found':
          case 'wrong-password':
          case 'invalid-credential':
            message = 'Login Fail. $number';
            break;
          case 'user-disabled':
            message = 'This account has been disabled.';
            break;
          case 'too-many-requests':
            message = 'Too many failed login attempts. Please try again later.';
            break;
          default:
            message = 'Login failed: ${e.message ?? e.code}';
        }

        return {
          'success': false,
          'code': 201,
          'message': message,
        };
      }
    } on FirebaseException catch (e) {
      return {
        'success': false,
        'code': 500,
        'message': 'Database error: ${e.message ?? e.code}',
      };
    } catch (e, stackTrace) {
      GeneralFunctions.debugPrintError(
        checkpoint: 9,
        message: 'Login error occurred',
        error: e,
        stackTrace: stackTrace,
      );
      
      return {
        'success': false,
        'code': 500,
        'message': 'An error occurred: ${e.toString()}',
      };
    }
  }

  /// Logout current user
  Future<void> logout() async {
    await _auth.signOut();
    await _database.logout();
  }

  /// Get current logged-in user from local database
  Future<User?> getCurrentUser() async {
    return await _database.getCurrentUser();
  }

  /// Check if user is logged in
  Future<bool> isLoggedIn() async {
    final session = await _database.getActiveSession();
    return session != null && _auth.currentUser != null;
  }
}

