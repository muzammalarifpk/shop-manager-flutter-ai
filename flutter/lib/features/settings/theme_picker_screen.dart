import 'dart:ui';

import 'package:flutter/material.dart';

import '../../config/app_theme.dart';
import '../../config/theme_controller.dart';
import '../../widgets/glassy_theme_widgets.dart';

/// Screen that lets the user pick one of several predefined color schemes.
/// Redesigned to match login screen with theme preview blocks.
class ThemePickerScreen extends StatelessWidget {
  const ThemePickerScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final controller = ThemeController.instance;
    final current = controller.currentOption;
    final options = AppThemeOption.values;

    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: GlassyTheme.glassyAppBar(
        titleText: 'Choose Color Scheme',
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () => Navigator.of(context).pop(),
        ),
      ),
      body: Stack(
        children: [
          // Futuristic city night background with blur
          const GlassyFuturisticBackground(),
          // Form content on top
          GlassyFormContainer(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              mainAxisSize: MainAxisSize.min,
              children: [
                const SizedBox(height: 20),
                // Title and description
                Text(
                  'Choose Your Theme',
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
                  'Select a color scheme that matches your style. Your choice will be saved and persist across sessions.',
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
                // Theme options grid
                ...options.map((option) {
                  final isSelected = option == current;
                  final label = AppTheme.labelFor(option);
                  final previewTheme = AppTheme.themeFor(option);
                  final colors = previewTheme.colorScheme;

                  return Padding(
                    padding: const EdgeInsets.only(bottom: 16),
                    child: _ThemePreviewBlock(
                      option: option,
                      label: label,
                      colors: colors,
                      isSelected: isSelected,
                      onTap: () async {
                        await controller.setTheme(option);
                        if (context.mounted) {
                          Navigator.of(context).pop();
                        }
                      },
                    ),
                  );
                }),
                const SizedBox(height: 8),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

/// A preview block showing a theme with buttons and widgets to make it visible.
class _ThemePreviewBlock extends StatelessWidget {
  const _ThemePreviewBlock({
    required this.option,
    required this.label,
    required this.colors,
    required this.isSelected,
    required this.onTap,
  });

  final AppThemeOption option;
  final String label;
  final ColorScheme colors;
  final bool isSelected;
  final VoidCallback onTap;

  @override
  Widget build(BuildContext context) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(GlassyTheme.borderRadius),
      child: BackdropFilter(
        filter: ImageFilter.blur(
          sigmaX: GlassyTheme.blurSigma,
          sigmaY: GlassyTheme.blurSigma,
        ),
        child: Material(
          color: Colors.transparent,
          child: InkWell(
            onTap: onTap,
            borderRadius: BorderRadius.circular(GlassyTheme.borderRadius),
            child: Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: isSelected
                    ? colors.primary.withValues(alpha: 0.3)
                    : Colors.white.withValues(alpha: GlassyTheme.containerOpacity),
                borderRadius: BorderRadius.circular(GlassyTheme.borderRadius),
                border: Border.all(
                  color: isSelected
                      ? colors.primary.withValues(alpha: 0.8)
                      : Colors.white.withValues(alpha: GlassyTheme.borderOpacity),
                  width: isSelected ? 2.5 : GlassyTheme.borderWidth,
                ),
                boxShadow: isSelected
                    ? [
                        BoxShadow(
                          color: colors.primary.withValues(alpha: 0.4),
                          blurRadius: 12,
                          offset: const Offset(0, 4),
                        ),
                      ]
                    : null,
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Header with label and selected indicator
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Expanded(
                        child: Text(
                          label,
                          style: TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.w600,
                            fontSize: 16,
                            shadows: [
                              Shadow(
                                color: Colors.black.withValues(alpha: 0.5),
                                blurRadius: 4,
                              ),
                            ],
                          ),
                        ),
                      ),
                      if (isSelected)
                        Container(
                          padding: const EdgeInsets.symmetric(
                            horizontal: 10,
                            vertical: 4,
                          ),
                          decoration: BoxDecoration(
                            color: colors.primary,
                            borderRadius: BorderRadius.circular(12),
                          ),
                          child: Row(
                            mainAxisSize: MainAxisSize.min,
                            children: [
                              const Icon(
                                Icons.check_circle,
                                color: Colors.white,
                                size: 16,
                              ),
                              const SizedBox(width: 4),
                              Text(
                                'Selected',
                                style: const TextStyle(
                                  color: Colors.white,
                                  fontSize: 12,
                                  fontWeight: FontWeight.w600,
                                ),
                              ),
                            ],
                          ),
                        ),
                    ],
                  ),
                  const SizedBox(height: 16),
                  // Color palette preview
                  Row(
                    children: [
                      _ColorSwatch(
                        color: colors.primary,
                        label: 'Primary',
                      ),
                      const SizedBox(width: 8),
                      _ColorSwatch(
                        color: colors.secondary,
                        label: 'Secondary',
                      ),
                      const SizedBox(width: 8),
                      _ColorSwatch(
                        color: colors.tertiary,
                        label: 'Tertiary',
                      ),
                      const SizedBox(width: 8),
                      _ColorSwatch(
                        color: colors.surface,
                        label: 'Surface',
                      ),
                    ],
                  ),
                  const SizedBox(height: 16),
                  // Preview widgets (buttons, cards, etc.)
                  _ThemePreviewWidgets(colors: colors),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}

/// Color swatch widget showing a color with label
class _ColorSwatch extends StatelessWidget {
  const _ColorSwatch({
    required this.color,
    required this.label,
  });

  final Color color;
  final String label;

  @override
  Widget build(BuildContext context) {
    return Expanded(
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Container(
            height: 40,
            width: double.infinity,
            decoration: BoxDecoration(
              color: color,
              borderRadius: BorderRadius.circular(8),
              border: Border.all(
                color: Colors.white.withValues(alpha: 0.3),
                width: 1,
              ),
            ),
          ),
          const SizedBox(height: 4),
          Text(
            label,
            style: TextStyle(
              color: Colors.white.withValues(alpha: 0.8),
              fontSize: 10,
              fontWeight: FontWeight.w500,
            ),
            textAlign: TextAlign.center,
          ),
        ],
      ),
    );
  }
}

/// Preview widgets showing how the theme looks with buttons and cards
class _ThemePreviewWidgets extends StatelessWidget {
  const _ThemePreviewWidgets({required this.colors});

  final ColorScheme colors;

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.stretch,
      children: [
        // Buttons row
        Row(
          children: [
            Expanded(
              child: FilledButton(
                onPressed: () {},
                style: FilledButton.styleFrom(
                  backgroundColor: colors.primary,
                  foregroundColor: colors.onPrimary,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(8),
                  ),
                ),
                child: const Text(
                  'Button',
                  style: TextStyle(fontSize: 12),
                ),
              ),
            ),
            const SizedBox(width: 8),
            Expanded(
              child: FilledButton(
                onPressed: () {},
                style: FilledButton.styleFrom(
                  backgroundColor: colors.secondary,
                  foregroundColor: colors.onSecondary,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(8),
                  ),
                ),
                child: const Text(
                  'Button',
                  style: TextStyle(fontSize: 12),
                ),
              ),
            ),
          ],
        ),
        const SizedBox(height: 12),
        // Card preview
        Container(
          padding: const EdgeInsets.all(12),
          decoration: BoxDecoration(
            color: colors.surface,
            borderRadius: BorderRadius.circular(8),
            border: Border.all(
              color: colors.outline.withValues(alpha: 0.2),
              width: 1,
            ),
          ),
          child: Row(
            children: [
              Container(
                width: 40,
                height: 40,
                decoration: BoxDecoration(
                  color: colors.primary.withValues(alpha: 0.2),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Icon(
                  Icons.shopping_cart,
                  color: colors.primary,
                  size: 20,
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Text(
                      'Sample Card',
                      style: TextStyle(
                        color: colors.onSurface,
                        fontWeight: FontWeight.w600,
                        fontSize: 12,
                      ),
                    ),
                    const SizedBox(height: 4),
                    Text(
                      'Preview of theme colors',
                      style: TextStyle(
                        color: colors.onSurface.withValues(alpha: 0.7),
                        fontSize: 10,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ],
    );
  }
}
