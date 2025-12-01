import 'package:flutter/material.dart';
import '../../config/app_constants.dart';
import '../../utils/general_functions.dart';
import '../../widgets/glassy_theme_widgets.dart';
import 'auth_service.dart';

/// Registration screen with validation and Firebase integration.
/// Matches PHP registration logic from register.php and do_register_flutter.php
class RegisterScreen extends StatefulWidget {
  const RegisterScreen({super.key});

  @override
  State<RegisterScreen> createState() => _RegisterScreenState();
}

class _RegisterScreenState extends State<RegisterScreen> {
  final _formKey = GlobalKey<FormState>();
  final _authService = AuthService();

  // Controllers for form fields
  final _businessNameController = TextEditingController();
  final _emailController = TextEditingController();
  final _mobileController = TextEditingController();
  final _passwordController = TextEditingController();

  // State variables
  String _industry = '';
  String _businessType = 'Retailer';
  String _countryCode = '+92';
  bool _isLoading = false;
  String? _errorMessage;
  bool _agreeTerms = false;
  bool _agreeEULA = false;

  @override
  void dispose() {
    _businessNameController.dispose();
    _emailController.dispose();
    _mobileController.dispose();
    _passwordController.dispose();
    super.dispose();
  }

  Future<void> _handleRegistration() async {
    // Clear previous error
    setState(() {
      _errorMessage = null;
    });

    // Validate checkboxes
    if (!_agreeTerms) {
      setState(() {
        _errorMessage = 'Please agree to the Terms and Conditions';
      });
      return;
    }

    if (!_agreeEULA) {
      setState(() {
        _errorMessage = 'Please agree to the End User License Agreement';
      });
      return;
    }

    // Validate form
    if (!_formKey.currentState!.validate()) {
      return;
    }

    setState(() {
      _isLoading = true;
    });

    try {
      // Note: Uniqueness check is now done inside register() after authentication
      // to ensure proper Firestore permissions
      final result = await _authService.register(
        businessName: _businessNameController.text.trim(),
        countryCode: _countryCode,
        mobile: _mobileController.text.trim(),
        password: _passwordController.text,
        industryType: _industry.isEmpty ? null : _industry,
        businessType: _businessType,
        email: _emailController.text.trim().isEmpty
            ? null
            : _emailController.text.trim(),
      );

      if (!mounted) return;

      setState(() {
        _isLoading = false;
      });

      if (result['success'] == true) {
        // Show success message
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(result['message'] ?? 'Registered Successfully'),
            backgroundColor: Colors.green,
            behavior: SnackBarBehavior.floating,
          ),
        );

        // Navigate to login or dashboard
        // For now, just pop back to login
        Navigator.of(context).pop();
      } else {
        setState(() {
          _errorMessage = result['message'] ?? 'Registration failed';
        });
      }
    } catch (e, stackTrace) {
      if (!mounted) return;

      // Print full error details for debugging
      GeneralFunctions.debugPrintError(
        checkpoint: 4,
        message: 'Registration error occurred',
        error: e,
        stackTrace: stackTrace,
      );

      setState(() {
        _isLoading = false;
        _errorMessage = 'An unexpected error occurred: ${e.toString()}';
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: GlassyTheme.glassyAppBar(titleText: 'Sign Up for Free'),
      body: Stack(
        children: [
          // Futuristic city night background with blur
          const GlassyFuturisticBackground(),
          // Form content on top
          GlassyFormContainer(
            child: Form(
              key: _formKey,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.stretch,
                mainAxisSize: MainAxisSize.min,
                children: [
                  const SizedBox(height: 20),
                  // Industry dropdown (optional)
                  GlassyDropdownField<String>(
                    label: 'Industry',
                    items: AppConstants.industries
                        .map(
                          (industry) => GlassyDropdownItem<String>(
                            label: industry,
                            value: industry,
                          ),
                        )
                        .toList(),
                    selectedValue: _industry.isEmpty ? null : _industry,
                    onChanged: (value) {
                      setState(() {
                        _industry = value ?? '';
                      });
                    },
                  ),

                  const SizedBox(height: 16),

                  // Business type chips (required, defaults to Retailer)
                  GlassyChipGroup<String>(
                    label: 'Business type',
                    options: const [
                      GlassyDropdownItem(label: 'Retailer', value: 'Retailer'),
                      GlassyDropdownItem(
                        label: 'Wholesaller',
                        value: 'Wholesaller',
                      ),
                      GlassyDropdownItem(label: 'Services', value: 'Services'),
                      GlassyDropdownItem(
                        label: 'Manufacturer',
                        value: 'Manufacturer',
                      ),
                    ],
                    selectedValue: _businessType,
                    onChanged: (value) {
                      setState(() {
                        _businessType = value;
                      });
                    },
                  ),

                  const SizedBox(height: 12),

                  // Business Name (required)
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
                    textCapitalization: TextCapitalization.words,
                  ),

                  const SizedBox(height: 12),

                  // Email Address (optional)
                  GlassyTextField(
                    label: 'Email Address',
                    controller: _emailController,
                    hintText: 'yourname@example.com',
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

                  const SizedBox(height: 12),

                  // Country Code and Mobile Number (both required)
                  GlassyPhoneField(
                    countryCodeLabel: 'Code',
                    mobileNumberLabel: 'Mobile Number',
                    countryCode: _countryCode,
                    mobileController: _mobileController,
                    countryCodeOptions: AppConstants.countryCodes
                        .map(
                          (country) => GlassyDropdownItem<String>(
                            value: country['code']!,
                            label: '${country['code']} (${country['name']})',
                          ),
                        )
                        .toList(),
                    onCountryCodeChanged: (value) {
                      setState(() {
                        _countryCode = value;
                      });
                    },
                  ),

                  const SizedBox(height: 14),

                  // Password (required)
                  GlassyPasswordField(
                    label: 'Password',
                    controller: _passwordController,
                    required: true,
                    hintText: 'Enter password',
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Password is required';
                      }
                      if (value.length < 6) {
                        return 'Password must be at least 6 characters';
                      }
                      return null;
                    },
                  ),

                  const SizedBox(height: 20),

                  // Error message display
                  if (_errorMessage != null)
                    GlassyTheme.glassyErrorContainer(message: _errorMessage!),

                  const SizedBox(height: 16),

                  // Terms and EULA checkboxes
                  GlassyTheme.glassyCheckboxContainer(
                    children: [
                      GlassyCheckboxWithLabel(
                        value: _agreeTerms,
                        onChanged: (value) {
                          setState(() {
                            _agreeTerms = value;
                          });
                        },
                        label: 'I agree to the Terms and Conditions',
                      ),
                      const SizedBox(height: 8),
                      GlassyCheckboxWithLabel(
                        value: _agreeEULA,
                        onChanged: (value) {
                          setState(() {
                            _agreeEULA = value;
                          });
                        },
                        label:
                            'I agree to the End User License Agreement (EULA)',
                      ),
                    ],
                  ),

                  const SizedBox(height: 20),

                  // Submit button
                  GlassySubmitButton(
                    onPressed: _handleRegistration,
                    label: 'Sign Up',
                    isLoading: _isLoading,
                  ),

                  const SizedBox(height: 14),

                  Center(
                    child: TextButton(
                      onPressed: _isLoading
                          ? null
                          : () {
                              Navigator.of(context).pop();
                            },
                      style: TextButton.styleFrom(
                        foregroundColor: Colors.white.withValues(alpha: 0.9),
                      ),
                      child: const Text('Already have an account? Sign In'),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
