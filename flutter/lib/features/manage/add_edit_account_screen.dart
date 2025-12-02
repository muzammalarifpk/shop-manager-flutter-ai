import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:intl/intl.dart';
import '../../models/chart_of_account.dart';
import '../../services/chart_of_account_service.dart';
import '../../widgets/glassy_theme_widgets.dart';
import '../../widgets/custom_notifications.dart';
import '../auth/auth_service.dart';
import '../../database/app_database.dart';

class AddEditAccountScreen extends StatefulWidget {
  final ChartOfAccount? account;

  const AddEditAccountScreen({super.key, this.account});

  @override
  State<AddEditAccountScreen> createState() => _AddEditAccountScreenState();
}

class _AddEditAccountScreenState extends State<AddEditAccountScreen> {
  final _formKey = GlobalKey<FormState>();
  final _accountService = ChartOfAccountService();
  final _authService = AuthService();
  
  final _accountHeadController = TextEditingController();
  final _balanceController = TextEditingController();
  final _notesController = TextEditingController();
  final _balanceFocusNode = FocusNode();
  
  String _accountType = 'Cash';
  String _balanceType = 'Debit';
  String _status = 'published';
  bool _isSaving = false;
  String _currencySymbol = '\$'; // Default
  User? _currentUser;

  // Account types from PHP config
  final List<String> _accountTypes = [
    'Cash',
    'Bank',
    'Asset',
    'Liability',
    'Expense',
    'Income',
    'Equity',
    'Cost of Sale',
  ];

  final List<String> _balanceTypes = ['Debit', 'Credit'];
  final List<String> _statusOptions = ['published', 'draft'];

  @override
  void initState() {
    super.initState();
    _loadUserData();
    if (widget.account != null) {
      _loadAccountData();
    } else {
      _balanceController.text = '0.00';
    }
    
    // Listen to focus changes on balance field
    _balanceFocusNode.addListener(() {
      if (_balanceFocusNode.hasFocus) {
        // Clear field if it's 0 or 0.00
        final value = _balanceController.text.replaceAll(',', '');
        if (value == '0' || value == '0.00' || value.isEmpty) {
          _balanceController.clear();
        }
      } else {
        // Format when focus is lost
        _formatBalance();
      }
    });
  }

  Future<void> _loadUserData() async {
    final user = await _authService.getCurrentUser();
    if (user != null) {
      setState(() {
        _currentUser = user;
        _currencySymbol = _getCurrencySymbol(user.currency ?? 'USD');
      });
    }
  }

  String _getCurrencySymbol(String currency) {
    switch (currency.toUpperCase()) {
      case 'USD':
        return '\$';
      case 'EUR':
        return '€';
      case 'GBP':
        return '£';
      case 'INR':
        return '₹';
      case 'PKR':
        return 'Rs';
      case 'JPY':
        return '¥';
      case 'CNY':
        return '¥';
      case 'AUD':
        return 'A\$';
      case 'CAD':
        return 'C\$';
      case 'AED':
        return 'د.إ';
      case 'SAR':
        return 'ر.س';
      default:
        return currency;
    }
  }

  void _loadAccountData() {
    final account = widget.account!;
    _accountHeadController.text = account.accountHead;
    _balanceController.text = account.balance.toString();
    _notesController.text = account.notes ?? '';
    _accountType = account.accountType;
    _balanceType = account.balanceType;
    _status = account.status;
  }

  void _formatBalance() {
    final text = _balanceController.text.replaceAll(',', '');
    if (text.isEmpty) {
      _balanceController.text = '0.00';
      return;
    }
    
    final value = double.tryParse(text);
    if (value != null) {
      final formatter = NumberFormat('#,##0.00', 'en_US');
      _balanceController.text = formatter.format(value);
    }
  }

  @override
  void dispose() {
    _accountHeadController.dispose();
    _balanceController.dispose();
    _notesController.dispose();
    _balanceFocusNode.dispose();
    super.dispose();
  }

  Future<void> _handleSave() async {
    if (!_formKey.currentState!.validate()) {
      return;
    }

    setState(() {
      _isSaving = true;
    });

    try {
      // Remove commas before parsing
      final cleanText = _balanceController.text.replaceAll(',', '');
      final balance = double.tryParse(cleanText) ?? 0.0;

      if (widget.account == null) {
        // Add new account
        await _accountService.addAccount(
          accountHead: _accountHeadController.text.trim(),
          accountType: _accountType,
          balance: balance,
          balanceType: _balanceType,
          status: _status,
          notes: _notesController.text.trim().isEmpty
              ? null
              : _notesController.text.trim(),
        );

        if (mounted) {
          GlassySuccessNotification.show(
            context,
            message: 'Account created successfully',
            icon: Icons.check_circle,
          );
          Navigator.of(context).pop();
        }
      } else {
        // Update existing account
        await _accountService.updateAccount(
          id: widget.account!.id,
          accountHead: _accountHeadController.text.trim(),
          status: _status,
          notes: _notesController.text.trim().isEmpty
              ? null
              : _notesController.text.trim(),
        );

        if (mounted) {
          GlassySuccessNotification.show(
            context,
            message: 'Account updated successfully',
            icon: Icons.check_circle,
          );
          Navigator.of(context).pop();
        }
      }
    } catch (e) {
      if (mounted) {
        GlassyErrorNotification.show(
          context,
          message: 'Failed to save account: ${e.toString()}',
        );
      }
    } finally {
      if (mounted) {
        setState(() {
          _isSaving = false;
        });
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final isEdit = widget.account != null;

    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.transparent,
        flexibleSpace: ClipRRect(
          child: BackdropFilter(
            filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),
            child: Container(
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  colors: [
                    Colors.white.withValues(alpha: 0.1),
                    Colors.white.withValues(alpha: 0.05),
                  ],
                ),
              ),
            ),
          ),
        ),
        title: Text(
          isEdit ? 'Edit Account' : 'Add New Account',
          style: const TextStyle(
            color: Colors.white,
            fontWeight: FontWeight.bold,
          ),
        ),
        iconTheme: const IconThemeData(color: Colors.white),
      ),
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [
              Color(0xFF6366F1), // Indigo
              Color(0xFF8B5CF6), // Purple
            ],
          ),
        ),
        child: SafeArea(
          child: Form(
            key: _formKey,
            child: ListView(
              padding: const EdgeInsets.all(20),
              children: [
                // Account Head
                GlassyTheme.fieldLabel('Account Name', required: true),
                GlassyTheme.glassyTextField(
                  TextFormField(
                    controller: _accountHeadController,
                    style: const TextStyle(color: Colors.white),
                    decoration: GlassyTheme.glassyInputDecoration(
                      hintText: 'e.g., Main Bank Account',
                      prefixIcon: const Icon(
                        Icons.account_balance_wallet,
                        color: Colors.white70,
                      ),
                    ),
                    validator: (value) {
                      if (value == null || value.trim().isEmpty) {
                        return 'Account name is required';
                      }
                      return null;
                    },
                  ),
                ),
                const SizedBox(height: 20),

                // Account Type (only for new accounts)
                if (!isEdit) ...[
                  GlassyDropdownField<String>(
                    label: 'Account Type',
                    required: true,
                    selectedValue: _accountType,
                    items: _accountTypes
                        .map((type) => GlassyDropdownItem(
                              label: type,
                              value: type,
                            ))
                        .toList(),
                    onChanged: (value) {
                      setState(() {
                        _accountType = value!;
                      });
                    },
                    hintText: 'Select account type',
                  ),
                  const SizedBox(height: 20),
                ],

                // Balance and Balance Type (only for new accounts)
                if (!isEdit) ...[
                  Row(
                    children: [
                      Expanded(
                        flex: 2,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            GlassyTheme.fieldLabel('Opening Balance', required: true),
                            GlassyTheme.glassyTextField(
                              TextFormField(
                                controller: _balanceController,
                                focusNode: _balanceFocusNode,
                                style: const TextStyle(color: Colors.white),
                                keyboardType: const TextInputType.numberWithOptions(
                                  decimal: true,
                                ),
                                inputFormatters: [
                                  FilteringTextInputFormatter.allow(RegExp(r'[0-9.]')),
                                  _CurrencyInputFormatter(),
                                ],
                                decoration: GlassyTheme.glassyInputDecoration(
                                  hintText: '0.00',
                                  prefixIcon: Padding(
                                    padding: const EdgeInsets.only(left: 16, right: 8),
                                    child: Center(
                                      widthFactor: 0.0,
                                      child: Text(
                                        _currencySymbol,
                                        style: const TextStyle(
                                          color: Colors.white70,
                                          fontSize: 16,
                                          fontWeight: FontWeight.w600,
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                                validator: (value) {
                                  if (value == null || value.trim().isEmpty) {
                                    return 'Balance is required';
                                  }
                                  final cleanValue = value.replaceAll(',', '');
                                  if (double.tryParse(cleanValue) == null) {
                                    return 'Enter valid number';
                                  }
                                  return null;
                                },
                              ),
                            ),
                          ],
                        ),
                      ),
                      const SizedBox(width: 12),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            GlassyTheme.fieldLabel('Type', required: true),
                            const SizedBox(height: 8),
                            Row(
                              children: [
                                Expanded(
                                  child: GestureDetector(
                                    onTap: () {
                                      setState(() {
                                        _balanceType = 'Debit';
                                      });
                                    },
                                    child: Container(
                                      padding: const EdgeInsets.symmetric(vertical: 12),
                                      decoration: BoxDecoration(
                                        gradient: _balanceType == 'Debit'
                                            ? LinearGradient(
                                                colors: [
                                                  Colors.red.shade400,
                                                  Colors.red.shade600,
                                                ],
                                              )
                                            : LinearGradient(
                                                colors: [
                                                  Colors.white.withValues(alpha: 0.1),
                                                  Colors.white.withValues(alpha: 0.05),
                                                ],
                                              ),
                                        borderRadius: const BorderRadius.only(
                                          topLeft: Radius.circular(12),
                                          bottomLeft: Radius.circular(12),
                                        ),
                                        border: Border.all(
                                          color: _balanceType == 'Debit'
                                              ? Colors.red.shade300
                                              : Colors.white.withValues(alpha: 0.3),
                                          width: _balanceType == 'Debit' ? 2 : 1,
                                        ),
                                      ),
                                      child: Text(
                                        'DR',
                                        textAlign: TextAlign.center,
                                        style: TextStyle(
                                          color: _balanceType == 'Debit'
                                              ? Colors.white
                                              : Colors.white.withValues(alpha: 0.7),
                                          fontSize: 14,
                                          fontWeight: _balanceType == 'Debit'
                                              ? FontWeight.bold
                                              : FontWeight.normal,
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                                Expanded(
                                  child: GestureDetector(
                                    onTap: () {
                                      setState(() {
                                        _balanceType = 'Credit';
                                      });
                                    },
                                    child: Container(
                                      padding: const EdgeInsets.symmetric(vertical: 12),
                                      decoration: BoxDecoration(
                                        gradient: _balanceType == 'Credit'
                                            ? LinearGradient(
                                                colors: [
                                                  Colors.green.shade400,
                                                  Colors.green.shade600,
                                                ],
                                              )
                                            : LinearGradient(
                                                colors: [
                                                  Colors.white.withValues(alpha: 0.1),
                                                  Colors.white.withValues(alpha: 0.05),
                                                ],
                                              ),
                                        borderRadius: const BorderRadius.only(
                                          topRight: Radius.circular(12),
                                          bottomRight: Radius.circular(12),
                                        ),
                                        border: Border.all(
                                          color: _balanceType == 'Credit'
                                              ? Colors.green.shade300
                                              : Colors.white.withValues(alpha: 0.3),
                                          width: _balanceType == 'Credit' ? 2 : 1,
                                        ),
                                      ),
                                      child: Text(
                                        'CR',
                                        textAlign: TextAlign.center,
                                        style: TextStyle(
                                          color: _balanceType == 'Credit'
                                              ? Colors.white
                                              : Colors.white.withValues(alpha: 0.7),
                                          fontSize: 14,
                                          fontWeight: _balanceType == 'Credit'
                                              ? FontWeight.bold
                                              : FontWeight.normal,
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                              ],
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 20),
                ],

                // Status
                GlassyDropdownField<String>(
                  label: 'Status',
                  required: true,
                  selectedValue: _status,
                  items: _statusOptions
                      .map((status) => GlassyDropdownItem(
                            label: status.toUpperCase(),
                            value: status,
                          ))
                      .toList(),
                  onChanged: (value) {
                    setState(() {
                      _status = value!;
                    });
                  },
                  hintText: 'Select status',
                ),
                const SizedBox(height: 20),

                // Notes
                GlassyTheme.fieldLabel('Notes'),
                GlassyTheme.glassyTextField(
                  TextFormField(
                    controller: _notesController,
                    style: const TextStyle(color: Colors.white),
                    maxLines: 4,
                    decoration: GlassyTheme.glassyInputDecoration(
                      hintText: 'Add any additional notes...',
                    ),
                  ),
                ),
                const SizedBox(height: 32),

                // Save Button
                Container(
                  height: 56,
                  decoration: BoxDecoration(
                    gradient: LinearGradient(
                      colors: [
                        Colors.white.withValues(alpha: 0.3),
                        Colors.white.withValues(alpha: 0.2),
                      ],
                    ),
                    borderRadius: BorderRadius.circular(16),
                    border: Border.all(
                      color: Colors.white.withValues(alpha: 0.4),
                      width: 1.5,
                    ),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withValues(alpha: 0.1),
                        blurRadius: 10,
                        offset: const Offset(0, 4),
                      ),
                    ],
                  ),
                  child: Material(
                    color: Colors.transparent,
                    child: InkWell(
                      borderRadius: BorderRadius.circular(16),
                      onTap: _isSaving ? null : _handleSave,
                      child: Center(
                        child: _isSaving
                            ? const SizedBox(
                                width: 24,
                                height: 24,
                                child: CircularProgressIndicator(
                                  valueColor: AlwaysStoppedAnimation<Color>(
                                    Colors.white,
                                  ),
                                  strokeWidth: 2,
                                ),
                              )
                            : Row(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  const Icon(
                                    Icons.save,
                                    color: Colors.white,
                                  ),
                                  const SizedBox(width: 12),
                                  Text(
                                    isEdit ? 'Update Account' : 'Create Account',
                                    style: const TextStyle(
                                      color: Colors.white,
                                      fontSize: 16,
                                      fontWeight: FontWeight.bold,
                                      letterSpacing: 0.5,
                                    ),
                                  ),
                                ],
                              ),
                      ),
                    ),
                  ),
                ),

                // Info note for edit mode
                if (isEdit) ...[
                  const SizedBox(height: 20),
                  Container(
                    padding: const EdgeInsets.all(16),
                    decoration: BoxDecoration(
                      color: Colors.white.withValues(alpha: 0.1),
                      borderRadius: BorderRadius.circular(12),
                      border: Border.all(
                        color: Colors.white.withValues(alpha: 0.2),
                      ),
                    ),
                    child: Row(
                      children: [
                        Icon(
                          Icons.info_outline,
                          color: Colors.white.withValues(alpha: 0.7),
                          size: 20,
                        ),
                        const SizedBox(width: 12),
                        Expanded(
                          child: Text(
                            'Account type and balance cannot be changed after creation.',
                            style: TextStyle(
                              color: Colors.white.withValues(alpha: 0.8),
                              fontSize: 12,
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ],
            ),
          ),
        ),
      ),
    );
  }
}

// Currency input formatter for real-time formatting
class _CurrencyInputFormatter extends TextInputFormatter {
  @override
  TextEditingValue formatEditUpdate(
    TextEditingValue oldValue,
    TextEditingValue newValue,
  ) {
    if (newValue.text.isEmpty) {
      return newValue;
    }

    // Remove all commas first
    String text = newValue.text.replaceAll(',', '');

    // Don't allow multiple decimal points
    if ('.'.allMatches(text).length > 1) {
      return oldValue;
    }

    // Split by decimal point
    final parts = text.split('.');
    
    // Format the integer part with commas
    String formattedInteger = parts[0];
    if (formattedInteger.isNotEmpty) {
      // Add commas to integer part
      final intValue = int.tryParse(formattedInteger);
      if (intValue != null) {
        final formatter = NumberFormat('#,###', 'en_US');
        formattedInteger = formatter.format(intValue);
      }
    }

    // Reconstruct the number
    String formattedText = formattedInteger;
    if (parts.length > 1) {
      // Limit decimal places to 2
      String decimalPart = parts[1];
      if (decimalPart.length > 2) {
        decimalPart = decimalPart.substring(0, 2);
      }
      formattedText = '$formattedInteger.$decimalPart';
    } else if (text.endsWith('.')) {
      formattedText = '$formattedInteger.';
    }

    // Calculate new cursor position
    int cursorPosition = formattedText.length;
    
    return TextEditingValue(
      text: formattedText,
      selection: TextSelection.collapsed(offset: cursorPosition),
    );
  }
}

