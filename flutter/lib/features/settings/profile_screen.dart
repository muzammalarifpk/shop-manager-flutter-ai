import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:image_picker/image_picker.dart';
import 'dart:io';
import '../../widgets/glassy_theme_widgets.dart';
import '../../widgets/custom_notifications.dart';
import '../auth/auth_service.dart';
import '../../database/app_database.dart';
import '../../config/app_constants.dart';

/// Profile screen matching PHP c-profile.php form structure
class ProfileScreen extends StatefulWidget {
  const ProfileScreen({super.key});

  @override
  State<ProfileScreen> createState() => _ProfileScreenState();
}

class _ProfileScreenState extends State<ProfileScreen> {
  final _formKey = GlobalKey<FormState>();
  final _authService = AuthService();
  final _imagePicker = ImagePicker();
  User? _currentUser;
  bool _isLoading = true;
  bool _isSaving = false;
  File? _selectedLogoImage;

  // Controllers for form fields
  final _businessNameController = TextEditingController();
  final _addressController = TextEditingController();
  final _cityController = TextEditingController();
  final _stateController = TextEditingController();
  final _countryController = TextEditingController();
  final _emailController = TextEditingController();
  final _currencyController = TextEditingController();
  final _gstController = TextEditingController();
  final _vatController = TextEditingController();
  final _printHeaderNoteController = TextEditingController();
  final _printFooterNoteController = TextEditingController();

  // State variables
  String? _industryType;
  String _businessType = 'Retailer';
  String _printDefaultTemplate = 'A4';

  // Feature toggles (on/off)
  String _variants = 'off';
  String _secondaryUnits = 'off';
  String _salesmanCommission = 'off';
  String _agentCommission = 'off';
  String _negative = 'off';
  String _barcode = 'off';
  String _tax = 'off';
  String _lendInventory = 'off';
  String _printHeader = 'off';
  String _printUrduInvoice = 'off';
  String _smsNotification = 'off';

  @override
  void initState() {
    super.initState();
    _loadUserData();
  }

  @override
  void dispose() {
    _businessNameController.dispose();
    _addressController.dispose();
    _cityController.dispose();
    _stateController.dispose();
    _countryController.dispose();
    _emailController.dispose();
    _currencyController.dispose();
    _gstController.dispose();
    _vatController.dispose();
    _printHeaderNoteController.dispose();
    _printFooterNoteController.dispose();
    super.dispose();
  }

  Future<void> _loadUserData() async {
    try {
      final user = await _authService.getCurrentUser();
      if (user != null) {
        setState(() {
          _currentUser = user;
          _businessNameController.text = user.businessName;
          _addressController.text = user.address ?? '';
          _cityController.text = user.city ?? '';
          _stateController.text = user.state ?? '';
          _countryController.text = user.country ?? '';
          _emailController.text = user.email ?? '';
          _currencyController.text = user.currency ?? 'USD';
          _gstController.text = user.gst ?? '';
          _vatController.text = user.vat ?? '';
          _industryType = user.industryType;
          _businessType = user.businessType ?? 'Retailer';
          _printHeaderNoteController.text = user.printHeaderNote ?? '';
          _printFooterNoteController.text = user.printFooterNote ?? '';

          // Set feature toggles
          _variants = user.variants ?? 'off';
          _secondaryUnits = user.secondaryUnits ?? 'off';
          _salesmanCommission = user.salesmanCommission ?? 'off';
          _agentCommission = user.agentCommission ?? 'off';
          _negative = user.negative ?? 'off';
          _barcode = user.barcode ?? 'off';
          _tax = user.tax ?? 'off';

          // Reset logo image selection when reloading
          _selectedLogoImage = null;

          _isLoading = false;
        });
      }
    } catch (e) {
      setState(() {
        _isLoading = false;
      });
      if (mounted) {
        GlassyErrorNotification.show(
          context,
          message: 'Failed to load profile: ${e.toString()}',
        );
      }
    }
  }

  Future<void> _pickLogoImage() async {
    try {
      final XFile? image = await _imagePicker.pickImage(
        source: ImageSource.gallery,
        maxWidth: 1024,
        maxHeight: 1024,
        imageQuality: 85,
      );

      if (image != null) {
        setState(() {
          _selectedLogoImage = File(image.path);
        });
      }
    } on PlatformException catch (e) {
      if (mounted) {
        String errorMessage = 'Failed to pick image';
        if (e.code == 'photo_library_access_denied') {
          errorMessage =
              'Photo library access denied. Please enable it in Settings.';
        } else if (e.message != null) {
          errorMessage = 'Failed to pick image: ${e.message}';
        }
        GlassyErrorNotification.show(context, message: errorMessage);
      }
    } catch (e) {
      if (mounted) {
        GlassyErrorNotification.show(
          context,
          message: 'Failed to pick image: ${e.toString()}',
        );
      }
    }
  }

  Future<void> _handleSave() async {
    if (!_formKey.currentState!.validate()) {
      return;
    }

    setState(() {
      _isSaving = true;
    });

    try {
      final result = await _authService.updateProfile(
        businessName: _businessNameController.text.trim(),
        address: _addressController.text.trim(),
        city: _cityController.text.trim().isEmpty
            ? null
            : _cityController.text.trim(),
        state: _stateController.text.trim().isEmpty
            ? null
            : _stateController.text.trim(),
        country: _countryController.text.trim().isEmpty
            ? null
            : _countryController.text.trim(),
        email: _emailController.text.trim().isEmpty
            ? null
            : _emailController.text.trim(),
        industryType: _industryType,
        businessType: _businessType,
        currency: _currencyController.text.trim(),
        gst: _gstController.text.trim().isEmpty
            ? null
            : _gstController.text.trim(),
        vat: _vatController.text.trim().isEmpty
            ? null
            : _vatController.text.trim(),
        tax: _tax,
        negative: _negative,
        secondaryUnits: _secondaryUnits,
        variants: _variants,
        barcode: _barcode,
        salesmanCommission: _salesmanCommission,
        agentCommission: _agentCommission,
        printHeaderNote: _printHeaderNoteController.text.trim().isEmpty
            ? null
            : _printHeaderNoteController.text.trim(),
        printFooterNote: _printFooterNoteController.text.trim().isEmpty
            ? null
            : _printFooterNoteController.text.trim(),
        printDefaultTemplate: _printDefaultTemplate,
        logoPath: null, // TODO: Upload logo to Firebase Storage and get URL
      );

      if (mounted) {
        if (result['success'] == true) {
          GlassySuccessNotification.show(
            context,
            message: result['message'] ?? 'Profile updated successfully',
          );

          // Reload user data to show updated values
          await _loadUserData();
        } else {
          GlassyErrorNotification.show(
            context,
            message: result['message'] ?? 'Failed to update profile',
          );
        }
      }
    } catch (e) {
      if (mounted) {
        GlassyErrorNotification.show(
          context,
          message: 'Failed to update profile: ${e.toString()}',
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
    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: GlassyTheme.glassyAppBar(
        titleText: 'Profile Settings',
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: Stack(
        children: [
          const GlassyFuturisticBackground(),
          SafeArea(
            child: _isLoading
                ? const Center(
                    child: CircularProgressIndicator(
                      valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
                    ),
                  )
                : SingleChildScrollView(
                    padding: const EdgeInsets.all(20),
                    child: Form(
                      key: _formKey,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          // Basic Information Section
                          _buildSectionCard('Basic Information', [
                            GlassyTextField(
                              label: 'Business Name',
                              controller: _businessNameController,
                              required: true,
                              hintText: 'Shop Name',
                              validator: (value) {
                                if (value == null || value.trim().isEmpty) {
                                  return 'Business Name is required';
                                }
                                return null;
                              },
                            ),
                            const SizedBox(height: 16),
                            GlassyTextField(
                              label: 'Shop Address',
                              controller: _addressController,
                              required: true,
                              hintText: 'Shop Address',
                              validator: (value) {
                                if (value == null || value.trim().isEmpty) {
                                  return 'Shop Address is required';
                                }
                                return null;
                              },
                            ),
                            const SizedBox(height: 16),
                            Row(
                              children: [
                                Expanded(
                                  child: GlassyTextField(
                                    label: 'City',
                                    controller: _cityController,
                                    required: true,
                                    hintText: 'City',
                                    validator: (value) {
                                      if (value == null ||
                                          value.trim().isEmpty) {
                                        return 'City is required';
                                      }
                                      return null;
                                    },
                                  ),
                                ),
                                const SizedBox(width: 12),
                                Expanded(
                                  child: GlassyTextField(
                                    label: 'State',
                                    controller: _stateController,
                                    required: true,
                                    hintText: 'State',
                                    validator: (value) {
                                      if (value == null ||
                                          value.trim().isEmpty) {
                                        return 'State/Province is required';
                                      }
                                      return null;
                                    },
                                  ),
                                ),
                                const SizedBox(width: 12),
                                Expanded(
                                  child: GlassyTextField(
                                    label: 'Country',
                                    controller: _countryController,
                                    required: true,
                                    hintText: 'Country',
                                    validator: (value) {
                                      if (value == null ||
                                          value.trim().isEmpty) {
                                        return 'Country is required';
                                      }
                                      return null;
                                    },
                                  ),
                                ),
                              ],
                            ),
                            const SizedBox(height: 16),
                            GlassyTextField(
                              label: 'Email Address',
                              controller: _emailController,
                              hintText: 'Email Address',
                              keyboardType: TextInputType.emailAddress,
                              validator: (value) {
                                if (value != null && value.trim().isNotEmpty) {
                                  final emailRegex = RegExp(
                                    r'^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$',
                                  );
                                  if (!emailRegex.hasMatch(value.trim())) {
                                    return 'Please enter a valid email address';
                                  }
                                }
                                return null;
                              },
                            ),
                            const SizedBox(height: 16),
                            GlassyDropdownField<String>(
                              label: 'Industry',
                              selectedValue: _industryType,
                              required: true,
                              items: AppConstants.industries
                                  .map(
                                    (industry) => GlassyDropdownItem<String>(
                                      value: industry,
                                      label: industry,
                                    ),
                                  )
                                  .toList(),
                              onChanged: (value) {
                                setState(() {
                                  _industryType = value;
                                });
                              },
                            ),
                            const SizedBox(height: 16),
                            GlassyChipGroup<String>(
                              label: 'Business type',
                              selectedValue: _businessType,
                              options: const [
                                GlassyDropdownItem(
                                  label: 'Wholesaller',
                                  value: 'Wholesaller',
                                ),
                                GlassyDropdownItem(
                                  label: 'Distributor',
                                  value: 'Distributor',
                                ),
                                GlassyDropdownItem(
                                  label: 'Retailer',
                                  value: 'Retailer',
                                ),
                                GlassyDropdownItem(
                                  label: 'Manufacturer',
                                  value: 'Manufacturer',
                                ),
                              ],
                              onChanged: (value) {
                                setState(() {
                                  _businessType = value;
                                });
                              },
                            ),
                            const SizedBox(height: 16),
                            GlassyTextField(
                              label: 'Currency',
                              controller: _currencyController,
                              required: true,
                              hintText: 'USD',
                              validator: (value) {
                                if (value == null || value.trim().isEmpty) {
                                  return 'Currency is required';
                                }
                                return null;
                              },
                            ),
                          ]),
                          const SizedBox(height: 20),

                          // Configure Features Section
                          _buildSectionCard('Configure Features', [
                            _buildToggleField('Variants', _variants, (value) {
                              setState(() => _variants = value);
                            }),
                            _buildToggleField(
                              'Secondary Units',
                              _secondaryUnits,
                              (value) {
                                setState(() => _secondaryUnits = value);
                              },
                            ),
                            _buildToggleField(
                              'Salesman Commission',
                              _salesmanCommission,
                              (value) {
                                setState(() => _salesmanCommission = value);
                              },
                            ),
                            _buildToggleField(
                              'Agent Commission',
                              _agentCommission,
                              (value) {
                                setState(() => _agentCommission = value);
                              },
                            ),
                            _buildToggleField(
                              'Negative Stock selling',
                              _negative,
                              (value) {
                                setState(() => _negative = value);
                              },
                            ),
                            _buildToggleField('Barcode / QR code', _barcode, (
                              value,
                            ) {
                              setState(() => _barcode = value);
                            }),
                            _buildToggleField('Tax option', _tax, (value) {
                              setState(() => _tax = value);
                            }),
                            _buildToggleField(
                              'Lend Inventory',
                              _lendInventory,
                              (value) {
                                setState(() => _lendInventory = value);
                              },
                            ),
                            const SizedBox(height: 16),
                            Row(
                              children: [
                                Expanded(
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      GlassyTheme.fieldLabel(
                                        'GST (General Sales Tax)',
                                        required: true,
                                      ),
                                      GlassyTheme.glassyTextField(
                                        TextFormField(
                                          controller: _gstController,
                                          style: const TextStyle(
                                            color: Colors.white,
                                          ),
                                          keyboardType: TextInputType.number,
                                          decoration:
                                              GlassyTheme.glassyInputDecoration(
                                                hintText: '0',
                                                suffixIcon: Padding(
                                                  padding: const EdgeInsets.all(
                                                    12,
                                                  ),
                                                  child: Text(
                                                    '%',
                                                    style: TextStyle(
                                                      color: Colors.white
                                                          .withValues(
                                                            alpha: 0.7,
                                                          ),
                                                    ),
                                                  ),
                                                ),
                                              ),
                                          validator: (value) {
                                            if (value == null ||
                                                value.trim().isEmpty) {
                                              return 'GST is required';
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
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      GlassyTheme.fieldLabel(
                                        'VAT (Value Added Tax)',
                                        required: true,
                                      ),
                                      GlassyTheme.glassyTextField(
                                        TextFormField(
                                          controller: _vatController,
                                          style: const TextStyle(
                                            color: Colors.white,
                                          ),
                                          keyboardType: TextInputType.number,
                                          decoration:
                                              GlassyTheme.glassyInputDecoration(
                                                hintText: '0',
                                                suffixIcon: Padding(
                                                  padding: const EdgeInsets.all(
                                                    12,
                                                  ),
                                                  child: Text(
                                                    '%',
                                                    style: TextStyle(
                                                      color: Colors.white
                                                          .withValues(
                                                            alpha: 0.7,
                                                          ),
                                                    ),
                                                  ),
                                                ),
                                              ),
                                          validator: (value) {
                                            if (value == null ||
                                                value.trim().isEmpty) {
                                              return 'VAT is required';
                                            }
                                            return null;
                                          },
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                              ],
                            ),
                          ]),
                          const SizedBox(height: 20),

                          // Invoice Setting Section
                          _buildSectionCard('Invoice Setting', [
                            // Logo upload
                            SizedBox(
                              width: double.infinity,
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  GlassyTheme.fieldLabel('Logo Image'),
                                  const SizedBox(height: 8),
                                  GestureDetector(
                                    onTap: _pickLogoImage,
                                    child: Container(
                                      width: double.infinity,
                                      padding: const EdgeInsets.all(20),
                                      decoration: BoxDecoration(
                                        borderRadius: BorderRadius.circular(16),
                                        border: Border.all(
                                          color: Colors.white.withValues(
                                            alpha: 0.2,
                                          ),
                                          width: 2,
                                          style: BorderStyle.solid,
                                        ),
                                      ),
                                      child: _selectedLogoImage != null
                                          ? Column(
                                              children: [
                                                ClipRRect(
                                                  borderRadius:
                                                      BorderRadius.circular(12),
                                                  child: Image.file(
                                                    _selectedLogoImage!,
                                                    height: 200,
                                                    width: double.infinity,
                                                    fit: BoxFit.contain,
                                                  ),
                                                ),
                                                const SizedBox(height: 12),
                                                Row(
                                                  mainAxisAlignment:
                                                      MainAxisAlignment.center,
                                                  children: [
                                                    Icon(
                                                      Icons.edit,
                                                      color: Colors.white
                                                          .withValues(
                                                            alpha: 0.7,
                                                          ),
                                                      size: 18,
                                                    ),
                                                    const SizedBox(width: 8),
                                                    Text(
                                                      'Tap to change logo',
                                                      style: TextStyle(
                                                        color: Colors.white
                                                            .withValues(
                                                              alpha: 0.7,
                                                            ),
                                                        fontSize: 14,
                                                      ),
                                                    ),
                                                  ],
                                                ),
                                              ],
                                            )
                                          : Column(
                                              children: [
                                                Icon(
                                                  Icons.add_photo_alternate,
                                                  color: Colors.white
                                                      .withValues(alpha: 0.5),
                                                  size: 48,
                                                ),
                                                const SizedBox(height: 8),
                                                Text(
                                                  'Tap to select logo from gallery',
                                                  style: TextStyle(
                                                    color: Colors.white
                                                        .withValues(alpha: 0.7),
                                                    fontSize: 14,
                                                  ),
                                                ),
                                              ],
                                            ),
                                    ),
                                  ),
                                ],
                              ),
                            ),
                            const SizedBox(height: 16),
                            Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                GlassyTheme.fieldLabel('Print Header Note'),
                                GlassyTheme.glassyTextField(
                                  TextFormField(
                                    controller: _printHeaderNoteController,
                                    style: const TextStyle(color: Colors.white),
                                    maxLines: 4,
                                    textInputAction: TextInputAction.newline,
                                    decoration:
                                        GlassyTheme.glassyInputDecoration(
                                          hintText:
                                              'Enter header note for invoices',
                                        ),
                                  ),
                                ),
                              ],
                            ),
                            const SizedBox(height: 16),
                            Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                GlassyTheme.fieldLabel('Print Footer Note'),
                                GlassyTheme.glassyTextField(
                                  TextFormField(
                                    controller: _printFooterNoteController,
                                    style: const TextStyle(color: Colors.white),
                                    maxLines: 4,
                                    textInputAction: TextInputAction.newline,
                                    decoration:
                                        GlassyTheme.glassyInputDecoration(
                                          hintText:
                                              'Enter footer note for invoices',
                                        ),
                                  ),
                                ),
                              ],
                            ),
                            const SizedBox(height: 16),
                            GlassyDropdownField<String>(
                              label: 'Print Default template',
                              selectedValue: _printDefaultTemplate,
                              required: true,
                              items: const [
                                GlassyDropdownItem(value: 'A4', label: 'A4'),
                                GlassyDropdownItem(value: 'A5', label: 'A5'),
                                GlassyDropdownItem(
                                  value: 'Thermal_80mm',
                                  label: 'Thermal 80mm',
                                ),
                              ],
                              onChanged: (value) {
                                setState(() {
                                  _printDefaultTemplate = value ?? 'A4';
                                });
                              },
                            ),
                            const SizedBox(height: 16),
                            _buildToggleField(
                              'Print Header and Logo on Invoice',
                              _printHeader,
                              (value) {
                                setState(() => _printHeader = value);
                              },
                            ),
                            _buildToggleField(
                              'Print urdu label on invoice',
                              _printUrduInvoice,
                              (value) {
                                setState(() => _printUrduInvoice = value);
                              },
                            ),
                            _buildToggleField(
                              'Send SMS Notification',
                              _smsNotification,
                              (value) {
                                setState(() => _smsNotification = value);
                              },
                            ),
                          ]),
                          const SizedBox(height: 20),

                          // Account Information Section
                          if (_currentUser != null)
                            _buildSectionCard('Account Information', [
                              _buildReadOnlyField(
                                'Username',
                                _currentUser!.number,
                              ),
                              const SizedBox(height: 16),
                              _buildReadOnlyField(
                                'Account Type',
                                _currentUser!.status ?? 'N/A',
                              ),
                            ]),
                          const SizedBox(height: 20),

                          // Save Button
                          SizedBox(
                            width: double.infinity,
                            child: GlassySubmitButton(
                              onPressed: _handleSave,
                              label: 'Update',
                              isLoading: _isSaving,
                            ),
                          ),
                          const SizedBox(height: 20),
                        ],
                      ),
                    ),
                  ),
          ),
        ],
      ),
    );
  }

  Widget _buildSectionCard(String title, List<Widget> children) {
    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(24),
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            Colors.white.withValues(alpha: 0.1),
            Colors.white.withValues(alpha: 0.05),
          ],
        ),
        border: Border.all(
          color: Colors.white.withValues(alpha: 0.2),
          width: 1,
        ),
      ),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(24),
        child: BackdropFilter(
          filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),
          child: Padding(
            padding: const EdgeInsets.all(20),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  title,
                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 20),
                ...children,
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildToggleField(
    String label,
    String value,
    Function(String) onChanged,
  ) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            label,
            style: TextStyle(
              color: Colors.white.withValues(alpha: 0.9),
              fontSize: 14,
              fontWeight: FontWeight.w600,
            ),
          ),
          const SizedBox(height: 8),
          Row(
            children: [
              Expanded(
                child: _buildToggleOption(
                  'On',
                  value == 'on',
                  () => onChanged('on'),
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: _buildToggleOption(
                  'Off',
                  value == 'off',
                  () => onChanged('off'),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildToggleOption(String label, bool isSelected, VoidCallback onTap) {
    return Material(
      color: Colors.transparent,
      child: InkWell(
        onTap: onTap,
        borderRadius: BorderRadius.circular(12),
        child: Container(
          padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 16),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(12),
            gradient: isSelected
                ? LinearGradient(
                    colors: [
                      Colors.cyan.withValues(alpha: 0.3),
                      Colors.blue.withValues(alpha: 0.3),
                    ],
                  )
                : null,
            border: Border.all(
              color: isSelected
                  ? Colors.cyan.withValues(alpha: 0.5)
                  : Colors.white.withValues(alpha: 0.2),
              width: 2,
            ),
          ),
          child: Center(
            child: Text(
              label,
              style: TextStyle(
                color: isSelected
                    ? Colors.white
                    : Colors.white.withValues(alpha: 0.7),
                fontWeight: isSelected ? FontWeight.bold : FontWeight.normal,
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildReadOnlyField(String label, String value) {
    return SizedBox(
      width: double.infinity,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            label,
            style: TextStyle(
              color: Colors.white.withValues(alpha: 0.7),
              fontSize: 12,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            value,
            style: const TextStyle(
              color: Colors.white,
              fontSize: 16,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }
}
