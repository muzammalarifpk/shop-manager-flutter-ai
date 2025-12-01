import 'package:flutter/material.dart';

import '../../config/app_theme.dart';
import '../../config/theme_controller.dart';

/// Screen that lets the user pick one of several predefined color schemes.
class ThemePickerScreen extends StatelessWidget {
  const ThemePickerScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final controller = ThemeController.instance;
    final current = controller.currentOption;

    final options = AppThemeOption.values;

    return Scaffold(
      appBar: AppBar(
        title: const Text('Choose Color Scheme'),
      ),
      body: RadioGroup<AppThemeOption>(
        groupValue: current,
        onChanged: (value) {
          if (value == null) return;
          controller.setTheme(value);
        },
        child: ListView.separated(
          padding: const EdgeInsets.all(16),
          itemCount: options.length,
          separatorBuilder: (_, __) => const SizedBox(height: 8),
          itemBuilder: (context, index) {
            final option = options[index];
            final label = AppTheme.labelFor(option);
            final previewTheme = AppTheme.themeFor(option);
            final colors = previewTheme.colorScheme;

            return RadioListTile<AppThemeOption>(
              value: option,
              title: Text(label),
              subtitle: Row(
                children: [
                  _ColorDot(color: colors.primary),
                  _ColorDot(color: colors.secondary),
                  _ColorDot(color: colors.surface),
                ],
              ),
            );
          },
        ),
      ),
    );
  }
}

class _ColorDot extends StatelessWidget {
  const _ColorDot({required this.color});

  final Color color;

  @override
  Widget build(BuildContext context) {
    return Container(
      width: 20,
      height: 20,
      margin: const EdgeInsets.only(right: 8, top: 4),
      decoration: BoxDecoration(
        color: color,
        shape: BoxShape.circle,
        border: Border.all(
          color: Colors.black.withValues(alpha: 0.1),
          width: 1,
        ),
      ),
    );
  }
}


