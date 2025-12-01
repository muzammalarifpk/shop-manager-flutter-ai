import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'app_theme.dart';

/// Simple global theme controller so any screen can switch the active theme.
/// Persists theme selection using SharedPreferences.
class ThemeController extends ChangeNotifier {
  ThemeController._();

  static final ThemeController instance = ThemeController._();

  AppThemeOption _currentOption = AppTheme.defaultOption;
  bool _isInitialized = false;

  AppThemeOption get currentOption => _currentOption;

  ThemeData get theme => AppTheme.themeFor(_currentOption);

  /// Initialize the theme controller by loading saved theme preference.
  /// Should be called once at app startup.
  Future<void> initialize() async {
    if (_isInitialized) return;

    try {
      final prefs = await SharedPreferences.getInstance();
      final savedThemeIndex = prefs.getInt('selected_theme_option');
      
      if (savedThemeIndex != null) {
        final savedOption = AppThemeOption.values.firstWhere(
          (option) => option.index == savedThemeIndex,
          orElse: () => AppTheme.defaultOption,
        );
        _currentOption = savedOption;
        notifyListeners();
      }
    } catch (e) {
      // If loading fails, use default theme
      _currentOption = AppTheme.defaultOption;
    }
    
    _isInitialized = true;
  }

  /// Set the theme and persist it to SharedPreferences.
  /// The theme will persist even after login/logout.
  Future<void> setTheme(AppThemeOption option) async {
    if (option == _currentOption) return;
    
    _currentOption = option;
    notifyListeners();

    // Save to SharedPreferences
    try {
      final prefs = await SharedPreferences.getInstance();
      await prefs.setInt('selected_theme_option', option.index);
    } catch (e) {
      // If saving fails, theme is still changed but won't persist
      // This is acceptable - user can change it again
    }
  }
}


