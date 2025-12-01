import 'package:flutter/material.dart';

import 'app_theme.dart';

/// Simple global theme controller so any screen can switch the active theme.
class ThemeController extends ChangeNotifier {
  ThemeController._();

  static final ThemeController instance = ThemeController._();

  AppThemeOption _currentOption = AppTheme.defaultOption;

  AppThemeOption get currentOption => _currentOption;

  ThemeData get theme => AppTheme.themeFor(_currentOption);

  void setTheme(AppThemeOption option) {
    if (option == _currentOption) return;
    _currentOption = option;
    notifyListeners();
  }
}


