import 'package:flutter/material.dart';
import '../../config/app_constants.dart';
import '../../utils/general_functions.dart';
import '../settings/theme_picker_screen.dart';
import '../../widgets/glassy_theme_widgets.dart';
import 'register_screen.dart';
import 'auth_service.dart';

/// Login screen with validation and Firebase integration.
/// Matches PHP login logic from index.php and do_login_flutter.php
class LoginScreen extends StatelessWidget {
  const LoginScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: GlassyTheme.glassyAppBar(
        titleText: 'Sign In - Your Account',
        actions: [
          IconButton(
            tooltip: 'Choose color scheme',
            icon: const Icon(Icons.color_lens_outlined),
            onPressed: () {
              Navigator.of(context).push(
                MaterialPageRoute<void>(
                  builder: (_) => const ThemePickerScreen(),
                ),
              );
            },
          ),
        ],
      ),
      body: Stack(
        children: [
          // Futuristic city night background with blur
          const GlassyFuturisticBackground(),
          // Form content on top
          GlassyFormContainer(
            child: _LoginForm(),
          ),
        ],
      ),
    );
  }
}

class _LoginForm extends StatefulWidget {
  @override
  State<_LoginForm> createState() => _LoginFormState();
}

class _LoginFormState extends State<_LoginForm> {
  final _formKey = GlobalKey<FormState>();
  final _authService = AuthService();
  final _mobileController = TextEditingController();
  final _passwordController = TextEditingController();

  String _countryCode = '+92';
  bool _isLoading = false;
  String? _errorMessage;

  @override
  void dispose() {
    _mobileController.dispose();
    _passwordController.dispose();
    super.dispose();
  }

  Future<void> _handleLogin() async {
    // Clear previous error
    setState(() {
      _errorMessage = null;
    });

    // Validate form
    if (!_formKey.currentState!.validate()) {
      return;
    }

    setState(() {
      _isLoading = true;
    });

    try {
      final result = await _authService.login(
        countryCode: _countryCode,
        mobile: _mobileController.text.trim(),
        password: _passwordController.text,
      );

      if (!mounted) return;

      setState(() {
        _isLoading = false;
      });

      if (result['success'] == true) {
        // Show success message
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(result['message'] ?? 'Login successful'),
            backgroundColor: Colors.green,
            behavior: SnackBarBehavior.floating,
          ),
        );

        // Navigate to dashboard/home screen
        // TODO: Replace with actual dashboard route
        // Navigator.of(context).pushReplacement(
        //   MaterialPageRoute(builder: (_) => const DashboardScreen()),
        // );

        // For now, just show success
        GeneralFunctions.debugPrintSuccess(
          checkpoint: 1,
          message: 'Login successful',
          data: result['data'],
        );
      } else {
        setState(() {
          _errorMessage = result['message'] ?? 'Login failed';
        });
      }
    } catch (e, stackTrace) {
      if (!mounted) return;

      GeneralFunctions.debugPrintError(
        checkpoint: 2,
        message: 'Login error occurred',
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
    return Form(
      key: _formKey,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        mainAxisSize: MainAxisSize.min,
        children: [
          const SizedBox(height: 20),

          // Title and description
          Text(
            'Sign In - Your Account',
            style: Theme.of(context).textTheme.titleLarge?.copyWith(
                  color: Colors.white,
                  fontWeight: FontWeight.w600,
                  shadows: [
                    Shadow(
                      color: Colors.black.withValues(alpha: 0.3),
                      blurRadius: 4,
                    ),
                  ],
                ),
          ),
          const SizedBox(height: 12),
          Text(
            'Login with the same mobile number and password you use on the web app.',
            style: Theme.of(context).textTheme.bodyMedium?.copyWith(
                  color: Colors.white.withValues(alpha: 0.9),
                  shadows: [
                    Shadow(
                      color: Colors.black.withValues(alpha: 0.3),
                      blurRadius: 4,
                    ),
                  ],
                ),
          ),
          const SizedBox(height: 24),

          // Country Code and Mobile Number
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

          // Password
          GlassyPasswordField(
            label: 'Password',
            controller: _passwordController,
            required: true,
            hintText: 'Enter password',
            validator: (value) {
              if (value == null || value.isEmpty) {
                return 'Password is required';
              }
              return null;
            },
            onFieldSubmitted: (_) => _handleLogin(),
          ),

          const SizedBox(height: 8),

          Align(
            alignment: Alignment.centerRight,
            child: TextButton(
              onPressed: () {
                // TODO: Forgot password flow
                ScaffoldMessenger.of(context).showSnackBar(
                  const SnackBar(
                    content: Text('Forgot password feature coming soon'),
                  ),
                );
              },
              style: TextButton.styleFrom(
                foregroundColor: Colors.white.withValues(alpha: 0.9),
              ),
              child: const Text('Forgot Password?'),
            ),
          ),

          const SizedBox(height: 20),

          // Error message display
          if (_errorMessage != null)
            GlassyTheme.glassyErrorContainer(message: _errorMessage!),

          const SizedBox(height: 16),

          // Login button
          GlassySubmitButton(
            onPressed: _handleLogin,
            label: 'Log In',
            isLoading: _isLoading,
          ),

          const SizedBox(height: 14),

          Center(
            child: TextButton(
              onPressed: _isLoading
                  ? null
                  : () {
                      Navigator.of(context).push(
                        MaterialPageRoute<void>(
                          builder: (_) => const RegisterScreen(),
                        ),
                      );
                    },
              style: TextButton.styleFrom(
                foregroundColor: Colors.white.withValues(alpha: 0.9),
              ),
              child: const Text("Don't have an account? Sign Up"),
            ),
          ),
        ],
      ),
    );
  }
}
