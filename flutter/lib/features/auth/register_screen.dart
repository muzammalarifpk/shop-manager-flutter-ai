import 'dart:ui';

import 'package:flutter/material.dart';
import '../../config/app_constants.dart';
import '../../utils/general_functions.dart';
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
  bool _obscurePassword = true;
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

  Widget _fieldLabel(String label, {bool required = false}) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 8, left: 4),
      child: Text(
        required ? '$label *' : label,
        style: TextStyle(
          color: Colors.white,
          fontWeight: FontWeight.w600,
          fontSize: 14,
          shadows: [
            Shadow(
              color: Colors.black.withValues(alpha: 0.6),
              blurRadius: 4,
              offset: const Offset(0, 1),
            ),
          ],
        ),
      ),
    );
  }

  InputDecoration _glassyInputDecoration({
    String? hintText,
    Widget? suffixIcon,
  }) {
    return InputDecoration(
      hintText: hintText,
      hintStyle: TextStyle(color: Colors.white.withValues(alpha: 0.6)),
      suffixIcon: suffixIcon != null
          ? IconTheme(
              data: IconThemeData(color: Colors.white.withValues(alpha: 0.8)),
              child: suffixIcon,
            )
          : null,
      filled: true,
      fillColor: Colors.white.withValues(alpha: 0.08),
      border: OutlineInputBorder(
        borderRadius: BorderRadius.circular(16),
        borderSide: BorderSide(
          color: Colors.white.withValues(alpha: 0.2),
          width: 1,
        ),
      ),
      enabledBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(16),
        borderSide: BorderSide(
          color: Colors.white.withValues(alpha: 0.2),
          width: 1,
        ),
      ),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(16),
        borderSide: BorderSide(
          color: Colors.white.withValues(alpha: 0.4),
          width: 1.5,
        ),
      ),
      errorBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(16),
        borderSide: BorderSide(
          color: Colors.red.withValues(alpha: 0.6),
          width: 1,
        ),
      ),
      focusedErrorBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(16),
        borderSide: BorderSide(
          color: Colors.red.withValues(alpha: 0.8),
          width: 1.5,
        ),
      ),
      errorStyle: TextStyle(color: Colors.red.shade200),
    );
  }

  Widget _glassyTextField(Widget child) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(16),
      child: BackdropFilter(
        filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),
        child: child,
      ),
    );
  }

  void _showGlassyDropdown(BuildContext context, GlobalKey key) {
    final RenderBox? renderBox =
        key.currentContext?.findRenderObject() as RenderBox?;
    if (renderBox == null) return;

    final size = renderBox.size;
    final offset = renderBox.localToGlobal(Offset.zero);
    final screenWidth = MediaQuery.of(context).size.width;
    final screenHeight = MediaQuery.of(context).size.height;
    final left = offset.dx.clamp(8.0, screenWidth - 8.0 - size.width);
    final top = (offset.dy + size.height + 8).clamp(
      8.0,
      screenHeight - 8.0 - 300,
    );

    final overlay = Overlay.of(context);
    late OverlayEntry overlayEntry;

    overlayEntry = OverlayEntry(
      builder: (context) => Stack(
        children: [
          // Transparent barrier to dismiss on tap outside
          Positioned.fill(
            child: GestureDetector(
              onTap: () => overlayEntry.remove(),
              child: Container(color: Colors.transparent),
            ),
          ),
          // Glassy dropdown menu
          Positioned(
            left: left,
            top: top,
            child: TweenAnimationBuilder<double>(
              duration: const Duration(milliseconds: 200),
              tween: Tween(begin: 0.0, end: 1.0),
              builder: (context, value, child) {
                return Opacity(
                  opacity: value,
                  child: Transform.scale(
                    scale: 0.95 + (value * 0.05),
                    child: child,
                  ),
                );
              },
              child: ClipRRect(
                borderRadius: BorderRadius.circular(24),
                child: BackdropFilter(
                  filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
                  child: Container(
                    width: size.width,
                    constraints: const BoxConstraints(maxHeight: 300),
                    decoration: BoxDecoration(
                      color: Colors.white.withValues(alpha: 0.25),
                      borderRadius: BorderRadius.circular(24),
                      border: Border.all(
                        color: Colors.white.withValues(alpha: 0.18),
                        width: 0.5,
                      ),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withValues(alpha: 0.15),
                          blurRadius: 30,
                          offset: const Offset(0, 8),
                          spreadRadius: 0,
                        ),
                      ],
                    ),
                    child: Material(
                      color: Colors.transparent,
                      child: ListView(
                        shrinkWrap: true,
                        padding: const EdgeInsets.symmetric(vertical: 8),
                        children: [
                          Material(
                            color: Colors.transparent,
                            child: InkWell(
                              onTap: () {
                                overlayEntry.remove();
                                setState(() {
                                  _industry = '';
                                });
                              },
                              borderRadius: BorderRadius.circular(12),
                              child: Container(
                                padding: const EdgeInsets.symmetric(
                                  horizontal: 20,
                                  vertical: 14,
                                ),
                                decoration: BoxDecoration(
                                  color: _industry.isEmpty
                                      ? Colors.white.withValues(alpha: 0.15)
                                      : Colors.transparent,
                                  borderRadius: BorderRadius.circular(12),
                                ),
                                child: Text(
                                  '-- Select --',
                                  style: TextStyle(
                                    color: _industry.isEmpty
                                        ? Colors.white
                                        : Colors.white.withValues(alpha: 0.9),
                                    fontWeight: _industry.isEmpty
                                        ? FontWeight.w600
                                        : FontWeight.w500,
                                    fontSize: 16,
                                  ),
                                ),
                              ),
                            ),
                          ),
                          ...AppConstants.industries.map(
                            (industry) => Material(
                              color: Colors.transparent,
                              child: InkWell(
                                onTap: () {
                                  overlayEntry.remove();
                                  setState(() {
                                    _industry = industry;
                                  });
                                },
                                borderRadius: BorderRadius.circular(12),
                                child: Container(
                                  padding: const EdgeInsets.symmetric(
                                    horizontal: 20,
                                    vertical: 14,
                                  ),
                                  decoration: BoxDecoration(
                                    color: _industry == industry
                                        ? Colors.white.withValues(alpha: 0.15)
                                        : Colors.transparent,
                                    borderRadius: BorderRadius.circular(12),
                                  ),
                                  child: Text(
                                    industry,
                                    style: TextStyle(
                                      color: _industry == industry
                                          ? Colors.white
                                          : Colors.white.withValues(alpha: 0.9),
                                      fontWeight: _industry == industry
                                          ? FontWeight.w600
                                          : FontWeight.w500,
                                      fontSize: 16,
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );

    overlay.insert(overlayEntry);
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
      appBar: AppBar(
        title: const Text(
          'Sign Up for Free',
          style: TextStyle(fontWeight: FontWeight.w600, color: Colors.white),
        ),
        backgroundColor: Colors.transparent,
        elevation: 0,
        flexibleSpace: ClipRRect(
          child: BackdropFilter(
            filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
            child: Container(
              decoration: BoxDecoration(
                color: Colors.black.withValues(alpha: 0.3),
                border: Border(
                  bottom: BorderSide(
                    color: Colors.white.withValues(alpha: 0.2),
                    width: 0.5,
                  ),
                ),
              ),
            ),
          ),
        ),
        iconTheme: const IconThemeData(color: Colors.white),
      ),
      body: Stack(
        children: [
          // Futuristic city night background with blur
          Container(
            width: double.infinity,
            height: double.infinity,
            decoration: BoxDecoration(
              gradient: LinearGradient(
                colors: [
                  const Color(0xFF0a0a1a), // Deep dark blue
                  const Color(0xFF1a0a2e), // Dark purple
                  const Color(0xFF16213e), // Dark blue-grey
                  const Color(0xFF0f0c29), // Very dark purple
                ],
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
                stops: const [0.0, 0.3, 0.7, 1.0],
              ),
            ),
          ),
          // Blurred neon city lights layer 1
          Positioned.fill(
            child: ClipRect(
              child: BackdropFilter(
                filter: ImageFilter.blur(sigmaX: 15, sigmaY: 15),
                child: Container(
                  decoration: BoxDecoration(
                    gradient: RadialGradient(
                      center: Alignment.topRight,
                      radius: 1.5,
                      colors: [
                        const Color(0xFF00d4ff).withValues(alpha: 0.4), // Cyan
                        const Color(
                          0xFF7b2cbf,
                        ).withValues(alpha: 0.3), // Purple
                        Colors.transparent,
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
          // Blurred neon city lights layer 2
          Positioned.fill(
            child: ClipRect(
              child: BackdropFilter(
                filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
                child: Container(
                  decoration: BoxDecoration(
                    gradient: RadialGradient(
                      center: Alignment.bottomLeft,
                      radius: 1.8,
                      colors: [
                        const Color(0xFFff006e).withValues(alpha: 0.3), // Pink
                        const Color(
                          0xFF8338ec,
                        ).withValues(alpha: 0.25), // Purple
                        Colors.transparent,
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
          // Blurred neon city lights layer 3 (center)
          Positioned.fill(
            child: ClipRect(
              child: BackdropFilter(
                filter: ImageFilter.blur(sigmaX: 25, sigmaY: 25),
                child: Container(
                  decoration: BoxDecoration(
                    gradient: RadialGradient(
                      center: Alignment.center,
                      radius: 1.2,
                      colors: [
                        const Color(0xFF3a86ff).withValues(alpha: 0.2), // Blue
                        const Color(
                          0xFF560bad,
                        ).withValues(alpha: 0.15), // Dark purple
                        Colors.transparent,
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
          // Additional blur overlay for depth
          Positioned.fill(
            child: Container(
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  begin: Alignment.topCenter,
                  end: Alignment.bottomCenter,
                  colors: [
                    Colors.black.withValues(alpha: 0.3),
                    Colors.transparent,
                    Colors.black.withValues(alpha: 0.4),
                  ],
                  stops: const [0.0, 0.5, 1.0],
                ),
              ),
            ),
          ),
          // Form content on top
          Center(
            child: SingleChildScrollView(
              padding: const EdgeInsets.fromLTRB(20, 100, 20, 24),
              child: ConstrainedBox(
                constraints: const BoxConstraints(maxWidth: 600),
                child: TweenAnimationBuilder<double>(
                  duration: const Duration(milliseconds: 600),
                  curve: Curves.easeOutCubic,
                  tween: Tween(begin: 0, end: 1),
                  builder: (context, value, child) {
                    return Opacity(
                      opacity: value,
                      child: Transform.translate(
                        offset: Offset(0, (1 - value) * 24),
                        child: child,
                      ),
                    );
                  },
                  child: ClipRRect(
                    borderRadius: BorderRadius.circular(24),
                    child: BackdropFilter(
                      filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
                      child: Container(
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(24),
                          color: Colors.white.withValues(alpha: 0.1),
                          border: Border.all(
                            color: Colors.white.withValues(alpha: 0.2),
                            width: 0.5,
                          ),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withValues(alpha: 0.15),
                              blurRadius: 30,
                              offset: const Offset(0, 8),
                              spreadRadius: 0,
                            ),
                          ],
                        ),
                        child: Padding(
                          padding: const EdgeInsets.fromLTRB(20, 20, 20, 24),
                          child: Form(
                            key: _formKey,
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.stretch,
                              mainAxisSize: MainAxisSize.min,
                              children: [
                                const SizedBox(height: 20),

                                // Industry dropdown (optional)
                                Builder(
                                  builder: (context) {
                                    final dropdownKey = GlobalKey();
                                    return Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        _fieldLabel('Industry'),
                                        _glassyTextField(
                                          TextFormField(
                                            key: dropdownKey,
                                            readOnly: true,
                                            style: const TextStyle(
                                              color: Colors.white,
                                            ),
                                            controller: TextEditingController(
                                              text: _industry.isEmpty
                                                  ? '-- Select --'
                                                  : _industry,
                                            ),
                                            decoration: _glassyInputDecoration(
                                              hintText: '-- Select --',
                                              suffixIcon: const Icon(
                                                Icons.arrow_drop_down,
                                              ),
                                            ),
                                            onTap: () {
                                              _showGlassyDropdown(
                                                context,
                                                dropdownKey,
                                              );
                                            },
                                          ),
                                        ),
                                      ],
                                    );
                                  },
                                ),

                                const SizedBox(height: 16),

                                // Business type chips (required, defaults to Retailer)
                                Text(
                                  'Business type',
                                  style: Theme.of(context).textTheme.titleSmall
                                      ?.copyWith(
                                        fontWeight: FontWeight.w600,
                                        color: Colors.white.withValues(
                                          alpha: 0.9,
                                        ),
                                      ),
                                ),
                                const SizedBox(height: 8),
                                Wrap(
                                  spacing: 12,
                                  runSpacing: 4,
                                  children: [
                                    _BusinessTypeChip(
                                      label: 'Retailer',
                                      value: 'Retailer',
                                      groupValue: _businessType,
                                      onChanged: (value) {
                                        setState(() {
                                          _businessType = value;
                                        });
                                      },
                                    ),
                                    _BusinessTypeChip(
                                      label: 'Wholesaller',
                                      value: 'Wholesaller',
                                      groupValue: _businessType,
                                      onChanged: (value) {
                                        setState(() {
                                          _businessType = value;
                                        });
                                      },
                                    ),
                                    _BusinessTypeChip(
                                      label: 'Services',
                                      value: 'Services',
                                      groupValue: _businessType,
                                      onChanged: (value) {
                                        setState(() {
                                          _businessType = value;
                                        });
                                      },
                                    ),
                                    _BusinessTypeChip(
                                      label: 'Manufacturer',
                                      value: 'Manufacturer',
                                      groupValue: _businessType,
                                      onChanged: (value) {
                                        setState(() {
                                          _businessType = value;
                                        });
                                      },
                                    ),
                                  ],
                                ),

                                const SizedBox(height: 12),

                                // Business Name (required)
                                Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    _fieldLabel(
                                      'Business Name',
                                      required: true,
                                    ),
                                    _glassyTextField(
                                      TextFormField(
                                        controller: _businessNameController,
                                        style: const TextStyle(
                                          color: Colors.white,
                                        ),
                                        decoration: _glassyInputDecoration(
                                          hintText: 'Shop Name',
                                        ),
                                        validator: (value) {
                                          if (value == null ||
                                              value.trim().isEmpty) {
                                            return 'Business Name is required';
                                          }
                                          return null;
                                        },
                                        textCapitalization:
                                            TextCapitalization.words,
                                      ),
                                    ),
                                  ],
                                ),

                                const SizedBox(height: 12),

                                // Email Address (optional)
                                Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    _fieldLabel('Email Address'),
                                    _glassyTextField(
                                      TextFormField(
                                        controller: _emailController,
                                        style: const TextStyle(
                                          color: Colors.white,
                                        ),
                                        decoration: _glassyInputDecoration(
                                          hintText: 'yourname@example.com',
                                        ),
                                        keyboardType:
                                            TextInputType.emailAddress,
                                        validator: (value) {
                                          if (value != null &&
                                              value.trim().isNotEmpty) {
                                            final emailRegex = RegExp(
                                              r'^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$',
                                            );
                                            if (!emailRegex.hasMatch(
                                              value.trim(),
                                            )) {
                                              return 'Please enter a valid email address';
                                            }
                                          }
                                          return null;
                                        },
                                      ),
                                    ),
                                  ],
                                ),

                                const SizedBox(height: 12),

                                // Country Code and Mobile Number (both required)
                                Row(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Expanded(
                                      flex: 3,
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          _fieldLabel('Code', required: true),
                                          _glassyTextField(
                                            DropdownButtonFormField<String>(
                                              initialValue: _countryCode,
                                              style: const TextStyle(
                                                color: Colors.white,
                                              ),
                                              dropdownColor: Colors.white
                                                  .withValues(alpha: 0.85),
                                              menuMaxHeight: 300,
                                              borderRadius:
                                                  BorderRadius.circular(16),
                                              decoration:
                                                  _glassyInputDecoration()
                                                      .copyWith(isDense: true),
                                              isExpanded: true,
                                              selectedItemBuilder:
                                                  (BuildContext context) {
                                                    return const [
                                                      Text(
                                                        '+92',
                                                        overflow: TextOverflow
                                                            .ellipsis,
                                                        style: TextStyle(
                                                          color: Colors.white,
                                                        ),
                                                      ),
                                                      Text(
                                                        '+1',
                                                        overflow: TextOverflow
                                                            .ellipsis,
                                                        style: TextStyle(
                                                          color: Colors.white,
                                                        ),
                                                      ),
                                                      Text(
                                                        '+44',
                                                        overflow: TextOverflow
                                                            .ellipsis,
                                                        style: TextStyle(
                                                          color: Colors.white,
                                                        ),
                                                      ),
                                                      Text(
                                                        '+91',
                                                        overflow: TextOverflow
                                                            .ellipsis,
                                                        style: TextStyle(
                                                          color: Colors.white,
                                                        ),
                                                      ),
                                                      Text(
                                                        '+971',
                                                        overflow: TextOverflow
                                                            .ellipsis,
                                                        style: TextStyle(
                                                          color: Colors.white,
                                                        ),
                                                      ),
                                                    ];
                                                  },
                                              items: const [
                                                DropdownMenuItem(
                                                  value: '+92',
                                                  child: Text('+92 (Pakistan)'),
                                                ),
                                                DropdownMenuItem(
                                                  value: '+1',
                                                  child: Text(
                                                    '+1 (USA/Canada)',
                                                  ),
                                                ),
                                                DropdownMenuItem(
                                                  value: '+44',
                                                  child: Text('+44 (UK)'),
                                                ),
                                                DropdownMenuItem(
                                                  value: '+91',
                                                  child: Text('+91 (India)'),
                                                ),
                                                DropdownMenuItem(
                                                  value: '+971',
                                                  child: Text('+971 (UAE)'),
                                                ),
                                              ],
                                              onChanged: (value) {
                                                setState(() {
                                                  _countryCode = value ?? '+92';
                                                });
                                              },
                                              validator: (value) {
                                                if (value == null ||
                                                    value.isEmpty) {
                                                  return 'Required';
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
                                      flex: 7,
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          _fieldLabel(
                                            'Mobile Number',
                                            required: true,
                                          ),
                                          _glassyTextField(
                                            TextFormField(
                                              controller: _mobileController,
                                              style: const TextStyle(
                                                color: Colors.white,
                                              ),
                                              keyboardType: TextInputType.phone,
                                              decoration:
                                                  _glassyInputDecoration(
                                                    hintText: '1234567890',
                                                  ),
                                              validator: (value) {
                                                if (value == null ||
                                                    value.trim().isEmpty) {
                                                  return 'Mobile Number is required';
                                                }
                                                if (!RegExp(
                                                  r'^\d+$',
                                                ).hasMatch(value.trim())) {
                                                  return 'Must contain only digits';
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

                                const SizedBox(height: 14),

                                // Password (required)
                                Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    _fieldLabel('Password', required: true),
                                    _glassyTextField(
                                      TextFormField(
                                        controller: _passwordController,
                                        style: const TextStyle(
                                          color: Colors.white,
                                        ),
                                        obscureText: _obscurePassword,
                                        decoration: _glassyInputDecoration(
                                          hintText: 'Enter password',
                                          suffixIcon: IconButton(
                                            icon: Icon(
                                              _obscurePassword
                                                  ? Icons.visibility_outlined
                                                  : Icons
                                                        .visibility_off_outlined,
                                            ),
                                            onPressed: () {
                                              setState(() {
                                                _obscurePassword =
                                                    !_obscurePassword;
                                              });
                                            },
                                          ),
                                        ),
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
                                    ),
                                  ],
                                ),

                                const SizedBox(height: 20),

                                // Error message display
                                if (_errorMessage != null)
                                  ClipRRect(
                                    borderRadius: BorderRadius.circular(16),
                                    child: BackdropFilter(
                                      filter: ImageFilter.blur(
                                        sigmaX: 10,
                                        sigmaY: 10,
                                      ),
                                      child: Container(
                                        padding: const EdgeInsets.all(12),
                                        margin: const EdgeInsets.only(
                                          bottom: 16,
                                        ),
                                        decoration: BoxDecoration(
                                          color: Colors.red.withValues(
                                            alpha: 0.2,
                                          ),
                                          borderRadius: BorderRadius.circular(
                                            16,
                                          ),
                                          border: Border.all(
                                            color: Colors.red.withValues(
                                              alpha: 0.4,
                                            ),
                                            width: 1,
                                          ),
                                        ),
                                        child: Row(
                                          children: [
                                            Icon(
                                              Icons.error_outline,
                                              color: Colors.red.shade200,
                                              size: 20,
                                            ),
                                            const SizedBox(width: 8),
                                            Expanded(
                                              child: Text(
                                                _errorMessage!,
                                                style: TextStyle(
                                                  color: Colors.red.shade200,
                                                  fontSize: 13,
                                                ),
                                              ),
                                            ),
                                          ],
                                        ),
                                      ),
                                    ),
                                  ),

                                const SizedBox(height: 16),

                                // Terms and EULA checkboxes
                                ClipRRect(
                                  borderRadius: BorderRadius.circular(12),
                                  child: BackdropFilter(
                                    filter: ImageFilter.blur(
                                      sigmaX: 10,
                                      sigmaY: 10,
                                    ),
                                    child: Container(
                                      padding: const EdgeInsets.all(12),
                                      decoration: BoxDecoration(
                                        color: Colors.white.withValues(
                                          alpha: 0.08,
                                        ),
                                        borderRadius: BorderRadius.circular(12),
                                        border: Border.all(
                                          color: Colors.white.withValues(
                                            alpha: 0.2,
                                          ),
                                          width: 1,
                                        ),
                                      ),
                                      child: Column(
                                        children: [
                                          Row(
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              Checkbox(
                                                value: _agreeTerms,
                                                onChanged: (value) {
                                                  setState(() {
                                                    _agreeTerms =
                                                        value ?? false;
                                                  });
                                                },
                                                activeColor: Theme.of(
                                                  context,
                                                ).colorScheme.primary,
                                                checkColor: Colors.white,
                                              ),
                                              Expanded(
                                                child: GestureDetector(
                                                  onTap: () {
                                                    setState(() {
                                                      _agreeTerms =
                                                          !_agreeTerms;
                                                    });
                                                  },
                                                  child: Padding(
                                                    padding:
                                                        const EdgeInsets.only(
                                                          top: 12,
                                                        ),
                                                    child: Text(
                                                      'I agree to the Terms and Conditions',
                                                      style: TextStyle(
                                                        color: Colors.white,
                                                        fontSize: 14,
                                                      ),
                                                    ),
                                                  ),
                                                ),
                                              ),
                                            ],
                                          ),
                                          const SizedBox(height: 8),
                                          Row(
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              Checkbox(
                                                value: _agreeEULA,
                                                onChanged: (value) {
                                                  setState(() {
                                                    _agreeEULA = value ?? false;
                                                  });
                                                },
                                                activeColor: Theme.of(
                                                  context,
                                                ).colorScheme.primary,
                                                checkColor: Colors.white,
                                              ),
                                              Expanded(
                                                child: GestureDetector(
                                                  onTap: () {
                                                    setState(() {
                                                      _agreeEULA = !_agreeEULA;
                                                    });
                                                  },
                                                  child: Padding(
                                                    padding:
                                                        const EdgeInsets.only(
                                                          top: 12,
                                                        ),
                                                    child: Text(
                                                      'I agree to the End User License Agreement (EULA)',
                                                      style: TextStyle(
                                                        color: Colors.white,
                                                        fontSize: 14,
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
                                  ),
                                ),

                                const SizedBox(height: 20),

                                // Submit button
                                SizedBox(
                                  height: 48,
                                  child: FilledButton(
                                    onPressed: _isLoading
                                        ? null
                                        : _handleRegistration,
                                    style: FilledButton.styleFrom(
                                      backgroundColor: Theme.of(
                                        context,
                                      ).colorScheme.primary,
                                      foregroundColor: Colors.white,
                                      disabledBackgroundColor: Theme.of(context)
                                          .colorScheme
                                          .primary
                                          .withValues(alpha: 0.5),
                                      shape: RoundedRectangleBorder(
                                        borderRadius: BorderRadius.circular(16),
                                      ),
                                      elevation: 4,
                                      shadowColor: Theme.of(context)
                                          .colorScheme
                                          .primary
                                          .withValues(alpha: 0.5),
                                    ),
                                    child: _isLoading
                                        ? const SizedBox(
                                            height: 20,
                                            width: 20,
                                            child: CircularProgressIndicator(
                                              strokeWidth: 2,
                                              valueColor:
                                                  AlwaysStoppedAnimation<Color>(
                                                    Colors.white,
                                                  ),
                                            ),
                                          )
                                        : const Text(
                                            'Sign Up',
                                            style: TextStyle(
                                              fontWeight: FontWeight.w600,
                                              fontSize: 16,
                                            ),
                                          ),
                                  ),
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
                                      foregroundColor: Colors.white.withValues(
                                        alpha: 0.9,
                                      ),
                                    ),
                                    child: const Text(
                                      'Already have an account? Sign In',
                                    ),
                                  ),
                                ),
                              ],
                            ),
                          ),
                        ),
                      ),
                    ),
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}

class _BusinessTypeChip extends StatelessWidget {
  const _BusinessTypeChip({
    required this.label,
    required this.value,
    required this.groupValue,
    required this.onChanged,
  });

  final String label;
  final String value;
  final String groupValue;
  final ValueChanged<String> onChanged;

  @override
  Widget build(BuildContext context) {
    final selected = value == groupValue;

    return ClipRRect(
      borderRadius: BorderRadius.circular(20),
      child: BackdropFilter(
        filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),
        child: Material(
          color: Colors.transparent,
          child: InkWell(
            onTap: () => onChanged(value),
            borderRadius: BorderRadius.circular(20),
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
              decoration: BoxDecoration(
                color: selected
                    ? Theme.of(
                        context,
                      ).colorScheme.primary.withValues(alpha: 0.4)
                    : Colors.white.withValues(alpha: 0.1),
                borderRadius: BorderRadius.circular(20),
                border: Border.all(
                  color: selected
                      ? Theme.of(
                          context,
                        ).colorScheme.primary.withValues(alpha: 0.8)
                      : Colors.white.withValues(alpha: 0.18),
                  width: selected ? 2 : 1,
                ),
                boxShadow: selected
                    ? [
                        BoxShadow(
                          color: Theme.of(
                            context,
                          ).colorScheme.primary.withValues(alpha: 0.3),
                          blurRadius: 8,
                          offset: const Offset(0, 2),
                        ),
                      ]
                    : null,
              ),
              child: Text(
                label,
                style: TextStyle(
                  color: selected
                      ? Colors.white
                      : Colors.white.withValues(alpha: 0.9),
                  fontWeight: selected ? FontWeight.w700 : FontWeight.w500,
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
