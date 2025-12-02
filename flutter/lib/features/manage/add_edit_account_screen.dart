import 'dart:ui';
import 'package:flutter/material.dart';
import '../../models/chart_of_account.dart';
import '../../services/chart_of_account_service.dart';
import '../../widgets/glassy_theme_widgets.dart';
import '../../widgets/custom_notifications.dart';

class AddEditAccountScreen extends StatefulWidget {
  final ChartOfAccount? account;

  const AddEditAccountScreen({super.key, this.account});

  @override
  State<AddEditAccountScreen> createState() => _AddEditAccountScreenState();
}

class _AddEditAccountScreenState extends State<AddEditAccountScreen> {
  final _formKey = GlobalKey<FormState>();
  final _accountService = ChartOfAccountService();
  
  final _accountHeadController = TextEditingController();
  final _balanceController = TextEditingController();
  final _notesController = TextEditingController();
  
  String _accountType = 'Cash';
  String _balanceType = 'Debit';
  String _status = 'published';
  bool _isSaving = false;

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
    if (widget.account != null) {
      _loadAccountData();
    } else {
      _balanceController.text = '0';
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

  @override
  void dispose() {
    _accountHeadController.dispose();
    _balanceController.dispose();
    _notesController.dispose();
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
      final balance = double.tryParse(_balanceController.text) ?? 0.0;

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
                  GlassyTheme.fieldLabel('Account Type', required: true),
                  GlassyDropdownField<String>(
                    label: 'Account Type',
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
                                style: const TextStyle(color: Colors.white),
                                keyboardType: const TextInputType.numberWithOptions(
                                  decimal: true,
                                ),
                                decoration: GlassyTheme.glassyInputDecoration(
                                  hintText: '0.00',
                                  prefixIcon: const Icon(
                                    Icons.attach_money,
                                    color: Colors.white70,
                                  ),
                                ),
                                validator: (value) {
                                  if (value == null || value.trim().isEmpty) {
                                    return 'Balance is required';
                                  }
                                  if (double.tryParse(value) == null) {
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
                            GlassyDropdownField<String>(
                              label: 'Balance Type',
                              selectedValue: _balanceType,
                              items: _balanceTypes
                                  .map((type) => GlassyDropdownItem(
                                        label: type,
                                        value: type,
                                      ))
                                  .toList(),
                              onChanged: (value) {
                                setState(() {
                                  _balanceType = value!;
                                });
                              },
                              hintText: 'Select type',
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 20),
                ],

                // Status
                GlassyTheme.fieldLabel('Status', required: true),
                GlassyDropdownField<String>(
                  label: 'Status',
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

