import 'package:flutter/material.dart';

/// Available theme options for the app.
enum AppThemeOption {
  retailPro, // RetailPro dashboard theme - default
  tealOrange,
  indigoBlue,
  amberPink,
  greenBlue,
  darkBlue,
}

/// Central place for all app-wide static theme configuration.
/// Any static colors, text styles, or theme-related constants
/// should be added here (or split into more config files later).
class AppTheme {
  const AppTheme._();

  /// Default option when the app starts.
  static const AppThemeOption defaultOption = AppThemeOption.retailPro;


  /// Human-friendly labels for each theme.
  static String labelFor(AppThemeOption option) {
    switch (option) {
      case AppThemeOption.retailPro:
        return 'RetailPro (Default)';
      case AppThemeOption.tealOrange:
        return 'Teal + Orange';
      case AppThemeOption.indigoBlue:
        return 'Indigo + Blue';
      case AppThemeOption.amberPink:
        return 'Amber + Pink';
      case AppThemeOption.greenBlue:
        return 'Green + Blue';
      case AppThemeOption.darkBlue:
        return 'Dark Blue (Night)';
    }
  }

  /// Primary light theme for the app, based on the given option.
  static ThemeData themeFor(AppThemeOption option) {
    switch (option) {
      case AppThemeOption.retailPro:
        // RetailPro dashboard theme - Purple primary with blue, green, orange accents
        return ThemeData(
          useMaterial3: true,
          colorScheme: ColorScheme.fromSeed(
            seedColor: const Color(0xFF7C3AED), // Purple primary
            brightness: Brightness.light,
          ).copyWith(
            primary: const Color(0xFF7C3AED), // Purple
            secondary: const Color(0xFF3B82F6), // Blue for revenue
            tertiary: const Color(0xFF10B981), // Green for orders
            error: const Color(0xFFEF4444), // Red for alerts
            surface: Colors.white,
            surfaceContainerHighest: const Color(0xFFF5F5F5), // Light grey background
            onPrimary: Colors.white,
            onSecondary: Colors.white,
            onTertiary: Colors.white,
          ),
          scaffoldBackgroundColor: const Color(0xFFF5F5F5), // Light grey background
          cardTheme: CardThemeData(
            color: Colors.white,
            elevation: 0,
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(12),
            ),
          ),
          appBarTheme: const AppBarTheme(
            elevation: 0,
            centerTitle: false,
            backgroundColor: Colors.white,
            foregroundColor: Color(0xFF1F2937),
          ),
        );
      case AppThemeOption.tealOrange:
        return ThemeData(
          useMaterial3: true,
          colorScheme: ColorScheme.fromSeed(
            seedColor: const Color(0xFF0F766E), // teal/emerald
            brightness: Brightness.light,
          ).copyWith(
            secondary: const Color(0xFFF97316),
            secondaryContainer: const Color(0xFFFFEDD5),
          ),
        );
      case AppThemeOption.indigoBlue:
        return ThemeData(
          useMaterial3: true,
          colorScheme: ColorScheme.fromSeed(
            seedColor: const Color(0xFF4F46E5), // indigo
            brightness: Brightness.light,
          ),
        );
      case AppThemeOption.amberPink:
        return ThemeData(
          useMaterial3: true,
          colorScheme: ColorScheme.fromSeed(
            seedColor: const Color(0xFFF59E0B), // amber
            brightness: Brightness.light,
          ).copyWith(
            secondary: const Color(0xFFDB2777), // pink
          ),
        );
      case AppThemeOption.greenBlue:
        return ThemeData(
          useMaterial3: true,
          colorScheme: ColorScheme.fromSeed(
            seedColor: const Color(0xFF16A34A), // green
            brightness: Brightness.light,
          ).copyWith(
            secondary: const Color(0xFF0EA5E9), // light blue
          ),
        );
      case AppThemeOption.darkBlue:
        return ThemeData(
          useMaterial3: true,
          colorScheme: ColorScheme.fromSeed(
            seedColor: const Color(0xFF0F172A), // slate/dark blue
            brightness: Brightness.dark,
          ),
        );
    }
  }
}

/// RetailPro dashboard metric card colors matching the design.
/// These colors are used for the KPI/metric cards in the dashboard.
class RetailProColors {
  const RetailProColors._();

  /// Blue color for Total Revenue metric card
  static const Color revenueBlue = Color(0xFF3B82F6);
  
  /// Green color for Orders Today metric card
  static const Color ordersGreen = Color(0xFF10B981);
  
  /// Purple color for Inventory Items metric card
  static const Color inventoryPurple = Color(0xFF7C3AED);
  
  /// Orange color for Active Customers metric card
  static const Color customersOrange = Color(0xFFF97316);
  
  /// Light grey background for the dashboard
  static const Color backgroundGrey = Color(0xFFF5F5F5);
  
  /// White for cards
  static const Color cardWhite = Colors.white;
}
