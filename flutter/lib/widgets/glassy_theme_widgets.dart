import 'dart:ui';

import 'package:flutter/material.dart';

/// Reusable glassy theme widgets for consistent UI design across the app.
/// Update these widgets to change the theme globally.
class GlassyTheme {
  // Blur settings
  static const double blurSigma = 10.0;
  static const double containerBlurSigma = 20.0;

  // Opacity settings
  static const double containerOpacity = 0.1;
  static const double inputFieldOpacity = 0.08;
  static const double buttonOpacity = 0.2;
  static const double chipOpacity = 0.1;
  static const double chipSelectedOpacity = 0.2;

  // Border settings
  static const double borderOpacity = 0.2;
  static const double borderFocusedOpacity = 0.4;
  static const double borderWidth = 1.0;
  static const double borderFocusedWidth = 1.5;

  // Border radius
  static const double borderRadius = 16.0;
  static const double containerBorderRadius = 24.0;
  static const double chipBorderRadius = 20.0;

  // Spacing
  static const double labelBottomPadding = 8.0;
  static const double labelLeftPadding = 4.0;

  /// Creates a glassy AppBar with backdrop blur effect
  static PreferredSizeWidget glassyAppBar({
    required String titleText,
    List<Widget>? actions,
    Widget? leading,
  }) {
    return AppBar(
      title: Text(
        titleText,
        style: const TextStyle(
          fontWeight: FontWeight.w600,
          color: Colors.white,
        ),
      ),
      backgroundColor: Colors.transparent,
      elevation: 0,
      leading: leading,
      actions: actions,
      flexibleSpace: ClipRRect(
        child: BackdropFilter(
          filter: ImageFilter.blur(
            sigmaX: containerBlurSigma,
            sigmaY: containerBlurSigma,
          ),
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
    );
  }

  /// Creates a glassy text field wrapper with backdrop blur
  static Widget glassyTextField(Widget child) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(borderRadius),
      child: BackdropFilter(
        filter: ImageFilter.blur(sigmaX: blurSigma, sigmaY: blurSigma),
        child: child,
      ),
    );
  }

  /// Creates a glassy container with backdrop blur
  static Widget glassyContainer({
    required Widget child,
    double? borderRadius,
    double? opacity,
    EdgeInsets? padding,
    EdgeInsets? margin,
  }) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(borderRadius ?? containerBorderRadius),
      child: BackdropFilter(
        filter: ImageFilter.blur(
          sigmaX: containerBlurSigma,
          sigmaY: containerBlurSigma,
        ),
        child: Container(
          padding: padding,
          margin: margin,
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(
              borderRadius ?? containerBorderRadius,
            ),
            color: Colors.white.withValues(
              alpha: opacity ?? containerOpacity,
            ),
            border: Border.all(
              color: Colors.white.withValues(alpha: borderOpacity),
              width: borderWidth,
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
          child: child,
        ),
      ),
    );
  }

  /// Creates input decoration for glassy text fields
  static InputDecoration glassyInputDecoration({
    String? hintText,
    Widget? suffixIcon,
    Widget? prefixIcon,
  }) {
    return InputDecoration(
      hintText: hintText,
      hintStyle: TextStyle(color: Colors.white.withValues(alpha: 0.6)),
      prefixIcon: prefixIcon != null
          ? IconTheme(
              data: IconThemeData(color: Colors.white.withValues(alpha: 0.8)),
              child: prefixIcon,
            )
          : null,
      suffixIcon: suffixIcon != null
          ? IconTheme(
              data: IconThemeData(color: Colors.white.withValues(alpha: 0.8)),
              child: suffixIcon,
            )
          : null,
      filled: true,
      fillColor: Colors.white.withValues(alpha: inputFieldOpacity),
      border: OutlineInputBorder(
        borderRadius: BorderRadius.circular(borderRadius),
        borderSide: BorderSide(
          color: Colors.white.withValues(alpha: borderOpacity),
          width: borderWidth,
        ),
      ),
      enabledBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(borderRadius),
        borderSide: BorderSide(
          color: Colors.white.withValues(alpha: borderOpacity),
          width: borderWidth,
        ),
      ),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(borderRadius),
        borderSide: BorderSide(
          color: Colors.white.withValues(alpha: borderFocusedOpacity),
          width: borderFocusedWidth,
        ),
      ),
      errorBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(borderRadius),
        borderSide: BorderSide(
          color: Colors.red.withValues(alpha: 0.6),
          width: borderWidth,
        ),
      ),
      focusedErrorBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(borderRadius),
        borderSide: BorderSide(
          color: Colors.red.withValues(alpha: 0.8),
          width: borderFocusedWidth,
        ),
      ),
      errorStyle: TextStyle(color: Colors.red.shade200),
    );
  }

  /// Creates a field label widget
  static Widget fieldLabel(String label, {bool required = false}) {
    return Padding(
      padding: EdgeInsets.only(
        bottom: labelBottomPadding,
        left: labelLeftPadding,
      ),
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

  /// Creates a glassy button
  static Widget glassyButton({
    required VoidCallback? onPressed,
    required Widget child,
    double? height,
    Color? backgroundColor,
  }) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(borderRadius),
      child: BackdropFilter(
        filter: ImageFilter.blur(sigmaX: blurSigma, sigmaY: blurSigma),
        child: SizedBox(
          height: height ?? 48,
          child: FilledButton(
            onPressed: onPressed,
            style: FilledButton.styleFrom(
              backgroundColor: backgroundColor ??
                  Colors.white.withValues(alpha: buttonOpacity),
              foregroundColor: Colors.white,
              disabledBackgroundColor:
                  Colors.white.withValues(alpha: 0.08),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(borderRadius),
                side: BorderSide(
                  color: Colors.white.withValues(alpha: 0.25),
                  width: borderWidth,
                ),
              ),
              elevation: 0,
            ),
            child: child,
          ),
        ),
      ),
    );
  }

  /// Creates an accent colored button (primary action)
  static Widget accentButton({
    required BuildContext context,
    required VoidCallback? onPressed,
    required Widget child,
    double? height,
  }) {
    return SizedBox(
      height: height ?? 48,
      child: FilledButton(
        onPressed: onPressed,
        style: FilledButton.styleFrom(
          backgroundColor: Theme.of(context).colorScheme.primary,
          foregroundColor: Colors.white,
          disabledBackgroundColor:
              Theme.of(context).colorScheme.primary.withValues(alpha: 0.5),
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(borderRadius),
          ),
          elevation: 4,
          shadowColor:
              Theme.of(context).colorScheme.primary.withValues(alpha: 0.5),
        ),
        child: child,
      ),
    );
  }

  /// Creates a glassy chip/choice button
  static Widget glassyChip({
    required BuildContext context,
    required String label,
    required bool selected,
    required VoidCallback onTap,
  }) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(chipBorderRadius),
      child: BackdropFilter(
        filter: ImageFilter.blur(sigmaX: blurSigma, sigmaY: blurSigma),
        child: Material(
          color: Colors.transparent,
          child: InkWell(
            onTap: onTap,
            borderRadius: BorderRadius.circular(chipBorderRadius),
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
              decoration: BoxDecoration(
                color: selected
                    ? Theme.of(context)
                        .colorScheme
                        .primary
                        .withValues(alpha: 0.4)
                    : Colors.white.withValues(alpha: chipOpacity),
                borderRadius: BorderRadius.circular(chipBorderRadius),
                border: Border.all(
                  color: selected
                      ? Theme.of(context)
                          .colorScheme
                          .primary
                          .withValues(alpha: 0.8)
                      : Colors.white.withValues(alpha: 0.18),
                  width: selected ? 2 : borderWidth,
                ),
                boxShadow: selected
                    ? [
                        BoxShadow(
                          color: Theme.of(context)
                              .colorScheme
                              .primary
                              .withValues(alpha: 0.3),
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

  /// Creates a glassy error message container
  static Widget glassyErrorContainer({
    required String message,
    IconData icon = Icons.error_outline,
  }) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(borderRadius),
      child: BackdropFilter(
        filter: ImageFilter.blur(sigmaX: blurSigma, sigmaY: blurSigma),
        child: Container(
          padding: const EdgeInsets.all(12),
          margin: const EdgeInsets.only(bottom: 16),
          decoration: BoxDecoration(
            color: Colors.red.withValues(alpha: 0.2),
            borderRadius: BorderRadius.circular(borderRadius),
            border: Border.all(
              color: Colors.red.withValues(alpha: 0.4),
              width: borderWidth,
            ),
          ),
          child: Row(
            children: [
              Icon(
                icon,
                color: Colors.red.shade200,
                size: 20,
              ),
              const SizedBox(width: 8),
              Expanded(
                child: Text(
                  message,
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
    );
  }

  /// Creates a glassy checkbox container
  static Widget glassyCheckboxContainer({
    required List<Widget> children,
    EdgeInsets? padding,
  }) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(12),
      child: BackdropFilter(
        filter: ImageFilter.blur(sigmaX: blurSigma, sigmaY: blurSigma),
        child: Container(
          padding: padding ?? const EdgeInsets.all(12),
          decoration: BoxDecoration(
            color: Colors.white.withValues(alpha: inputFieldOpacity),
            borderRadius: BorderRadius.circular(12),
            border: Border.all(
              color: Colors.white.withValues(alpha: borderOpacity),
              width: borderWidth,
            ),
          ),
          child: Column(children: children),
        ),
      ),
    );
  }

  /// Creates a glassy dropdown menu (for overlay)
  static Widget glassyDropdownMenu({
    required List<Widget> items,
    required double width,
    double? maxHeight,
  }) {
    return ClipRRect(
      borderRadius: BorderRadius.circular(containerBorderRadius),
      child: BackdropFilter(
        filter: ImageFilter.blur(
          sigmaX: containerBlurSigma,
          sigmaY: containerBlurSigma,
        ),
        child: Container(
          width: width,
          constraints: BoxConstraints(maxHeight: maxHeight ?? 300),
          decoration: BoxDecoration(
            color: Colors.white.withValues(alpha: 0.75),
            borderRadius: BorderRadius.circular(containerBorderRadius),
            border: Border.all(
              color: Colors.white.withValues(alpha: 0.3),
              width: borderWidth,
            ),
            boxShadow: [
              BoxShadow(
                color: Colors.black.withValues(alpha: 0.1),
                blurRadius: 20,
                offset: const Offset(0, 10),
              ),
            ],
          ),
          child: Material(
            color: Colors.transparent,
            child: ListView(
              shrinkWrap: true,
              padding: const EdgeInsets.symmetric(vertical: 4),
              children: items,
            ),
          ),
        ),
      ),
    );
  }

  /// Shows a glassy dropdown menu positioned relative to a widget
  /// 
  /// [context] - Build context
  /// [key] - GlobalKey of the widget to position the dropdown relative to
  /// [items] - List of dropdown items, each with a label and value
  /// [selectedValue] - Currently selected value (can be null)
  /// [onSelected] - Callback when an item is selected
  /// [showSelectOption] - Whether to show a "-- Select --" option (default: true)
  /// [selectOptionLabel] - Label for the select option (default: "-- Select --")
  static void showGlassyDropdown<T>({
    required BuildContext context,
    required GlobalKey key,
    required List<GlassyDropdownItem<T>> items,
    T? selectedValue,
    required ValueChanged<T?> onSelected,
    bool showSelectOption = true,
    String selectOptionLabel = '-- Select --',
  }) {
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
                borderRadius: BorderRadius.circular(containerBorderRadius),
                child: BackdropFilter(
                  filter: ImageFilter.blur(
                    sigmaX: containerBlurSigma,
                    sigmaY: containerBlurSigma,
                  ),
                  child: Container(
                    width: size.width,
                    constraints: const BoxConstraints(maxHeight: 300),
                    decoration: BoxDecoration(
                      color: Colors.white.withValues(alpha: 0.75),
                      borderRadius: BorderRadius.circular(containerBorderRadius),
                      border: Border.all(
                        color: Colors.white.withValues(alpha: 0.3),
                        width: borderWidth,
                      ),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withValues(alpha: 0.1),
                          blurRadius: 20,
                          offset: const Offset(0, 10),
                        ),
                      ],
                    ),
                    child: Material(
                      color: Colors.transparent,
                      child: ListView(
                        shrinkWrap: true,
                        padding: const EdgeInsets.symmetric(vertical: 8),
                        children: [
                          if (showSelectOption)
                            Material(
                              color: Colors.transparent,
                              child: InkWell(
                                onTap: () {
                                  overlayEntry.remove();
                                  onSelected(null);
                                },
                                borderRadius: BorderRadius.circular(12),
                                child: Container(
                                  padding: const EdgeInsets.symmetric(
                                    horizontal: 20,
                                    vertical: 14,
                                  ),
                                  decoration: BoxDecoration(
                                    color: selectedValue == null
                                        ? Colors.white.withValues(alpha: 0.15)
                                        : Colors.transparent,
                                    borderRadius: BorderRadius.circular(12),
                                  ),
                                  child: Text(
                                    selectOptionLabel,
                                    style: TextStyle(
                                      color: selectedValue == null
                                          ? Colors.white
                                          : Colors.white.withValues(alpha: 0.9),
                                      fontWeight: selectedValue == null
                                          ? FontWeight.w600
                                          : FontWeight.w500,
                                      fontSize: 16,
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ...items.map(
                            (item) => Material(
                              color: Colors.transparent,
                              child: InkWell(
                                onTap: () {
                                  overlayEntry.remove();
                                  onSelected(item.value);
                                },
                                borderRadius: BorderRadius.circular(12),
                                child: Container(
                                  padding: const EdgeInsets.symmetric(
                                    horizontal: 20,
                                    vertical: 14,
                                  ),
                                  decoration: BoxDecoration(
                                    color: selectedValue == item.value
                                        ? Colors.white.withValues(alpha: 0.15)
                                        : Colors.transparent,
                                    borderRadius: BorderRadius.circular(12),
                                  ),
                                  child: Text(
                                    item.label,
                                    style: TextStyle(
                                      color: selectedValue == item.value
                                          ? Colors.white
                                          : Colors.white.withValues(alpha: 0.9),
                                      fontWeight: selectedValue == item.value
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

  /// Shows a searchable glassy dropdown menu positioned relative to a widget
  /// 
  /// [context] - Build context
  /// [key] - GlobalKey of the widget to position the dropdown relative to
  /// [items] - List of dropdown items, each with a label and value
  /// [selectedValue] - Currently selected value (can be null)
  /// [onSelected] - Callback when an item is selected
  /// [showSelectOption] - Whether to show a "-- Select --" option (default: true)
  /// [selectOptionLabel] - Label for the select option (default: "-- Select --")
  /// [searchHint] - Hint text for the search field
  static void showSearchableGlassyDropdown<T>({
    required BuildContext context,
    required GlobalKey key,
    required List<GlassyDropdownItem<T>> items,
    T? selectedValue,
    required ValueChanged<T?> onSelected,
    bool showSelectOption = true,
    String selectOptionLabel = '-- Select --',
    String searchHint = 'Search...',
    double? minWidth,
  }) {
    final RenderBox? renderBox =
        key.currentContext?.findRenderObject() as RenderBox?;
    if (renderBox == null) return;

    final size = renderBox.size;
    final offset = renderBox.localToGlobal(Offset.zero);
    final screenWidth = MediaQuery.of(context).size.width;
    final screenHeight = MediaQuery.of(context).size.height;
    
    // Calculate dropdown width: use minWidth if provided, otherwise use field width
    final dropdownWidth = minWidth != null 
        ? size.width.clamp(minWidth, screenWidth - 16)
        : size.width;
    
    final left = offset.dx.clamp(8.0, screenWidth - 8.0 - dropdownWidth);
    final top = (offset.dy + size.height + 8).clamp(
      8.0,
      screenHeight - 8.0 - 400,
    );

    final overlay = Overlay.of(context);
    late OverlayEntry overlayEntry;
    final searchController = TextEditingController();
    final filteredItems = ValueNotifier<List<GlassyDropdownItem<T>>>(items);

    // Filter items based on search query
    void filterItems(String query) {
      if (query.isEmpty) {
        filteredItems.value = items;
      } else {
        filteredItems.value = items.where((item) {
          return item.label.toLowerCase().contains(query.toLowerCase()) ||
              item.value.toString().toLowerCase().contains(query.toLowerCase());
        }).toList();
      }
    }

    overlayEntry = OverlayEntry(
      builder: (context) => Stack(
        children: [
          // Transparent barrier to dismiss on tap outside
          Positioned.fill(
            child: GestureDetector(
              onTap: () {
                searchController.dispose();
                overlayEntry.remove();
              },
              child: Container(color: Colors.transparent),
            ),
          ),
          // Glassy searchable dropdown menu
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
                borderRadius: BorderRadius.circular(containerBorderRadius),
                child: BackdropFilter(
                  filter: ImageFilter.blur(
                    sigmaX: containerBlurSigma,
                    sigmaY: containerBlurSigma,
                  ),
                  child: Container(
                    width: dropdownWidth,
                    constraints: const BoxConstraints(maxHeight: 400),
                    decoration: BoxDecoration(
                      color: Colors.black.withValues(alpha: 0.85),
                      borderRadius: BorderRadius.circular(containerBorderRadius),
                      border: Border.all(
                        color: Colors.white.withValues(alpha: 0.3),
                        width: borderWidth,
                      ),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withValues(alpha: 0.3),
                          blurRadius: 20,
                          offset: const Offset(0, 10),
                        ),
                      ],
                    ),
                    child: Material(
                      color: Colors.transparent,
                      child: Column(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          // Search field
                          Padding(
                            padding: const EdgeInsets.all(12),
                            child: StatefulBuilder(
                              builder: (context, setState) {
                                return GlassyTheme.glassyTextField(
                                  TextField(
                                    controller: searchController,
                                    style: const TextStyle(color: Colors.white),
                                    autofocus: true,
                                    decoration: GlassyTheme.glassyInputDecoration(
                                      hintText: searchHint,
                                      prefixIcon: const Icon(
                                        Icons.search,
                                        color: Colors.white,
                                      ),
                                      suffixIcon: searchController.text.isNotEmpty
                                          ? IconButton(
                                              icon: const Icon(
                                                Icons.clear,
                                                color: Colors.white,
                                              ),
                                              onPressed: () {
                                                searchController.clear();
                                                filterItems('');
                                                setState(() {});
                                              },
                                            )
                                          : null,
                                    ),
                                    onChanged: (value) {
                                      filterItems(value);
                                      setState(() {});
                                    },
                                  ),
                                );
                              },
                            ),
                          ),
                          // Divider
                          Divider(
                            height: 1,
                            thickness: 1,
                            color: Colors.white.withValues(alpha: 0.2),
                          ),
                          // Filtered items list
                          Flexible(
                            child: ValueListenableBuilder<List<GlassyDropdownItem<T>>>(
                              valueListenable: filteredItems,
                              builder: (context, filtered, _) {
                                if (filtered.isEmpty) {
                                  return Padding(
                                    padding: const EdgeInsets.all(20),
                                    child: Text(
                                      'No results found',
                                      style: TextStyle(
                                        color: Colors.white.withValues(alpha: 0.7),
                                        fontSize: 14,
                                      ),
                                    ),
                                  );
                                }

                                return ListView(
                                  shrinkWrap: true,
                                  padding: const EdgeInsets.symmetric(vertical: 8),
                                  children: [
                                    if (showSelectOption)
                                      Material(
                                        color: Colors.transparent,
                                        child: InkWell(
                                          onTap: () {
                                            searchController.dispose();
                                            overlayEntry.remove();
                                            onSelected(null);
                                          },
                                          borderRadius: BorderRadius.circular(12),
                                          child: Container(
                                            padding: const EdgeInsets.symmetric(
                                              horizontal: 20,
                                              vertical: 14,
                                            ),
                                            decoration: BoxDecoration(
                                              color: selectedValue == null
                                                  ? Colors.white.withValues(alpha: 0.15)
                                                  : Colors.transparent,
                                              borderRadius: BorderRadius.circular(12),
                                            ),
                                            child: Text(
                                              selectOptionLabel,
                                              style: TextStyle(
                                                color: selectedValue == null
                                                    ? Colors.white
                                                    : Colors.white.withValues(alpha: 0.9),
                                                fontWeight: selectedValue == null
                                                    ? FontWeight.w600
                                                    : FontWeight.w500,
                                                fontSize: 16,
                                              ),
                                              overflow: TextOverflow.ellipsis,
                                              maxLines: 2,
                                            ),
                                          ),
                                        ),
                                      ),
                                    ...filtered.map(
                                      (item) => Material(
                                        color: Colors.transparent,
                                        child: InkWell(
                                          onTap: () {
                                            searchController.dispose();
                                            overlayEntry.remove();
                                            onSelected(item.value);
                                          },
                                          borderRadius: BorderRadius.circular(12),
                                          child: Container(
                                            padding: const EdgeInsets.symmetric(
                                              horizontal: 20,
                                              vertical: 14,
                                            ),
                                            decoration: BoxDecoration(
                                              color: selectedValue == item.value
                                                  ? Colors.white.withValues(alpha: 0.15)
                                                  : Colors.transparent,
                                              borderRadius: BorderRadius.circular(12),
                                            ),
                                            child: Text(
                                              item.label,
                                              style: TextStyle(
                                                color: selectedValue == item.value
                                                    ? Colors.white
                                                    : Colors.white.withValues(alpha: 0.9),
                                                fontWeight: selectedValue == item.value
                                                    ? FontWeight.w600
                                                    : FontWeight.w500,
                                                fontSize: 16,
                                              ),
                                              overflow: TextOverflow.ellipsis,
                                              maxLines: 2,
                                            ),
                                          ),
                                        ),
                                      ),
                                    ),
                                  ],
                                );
                              },
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
}

/// Data class for dropdown items
class GlassyDropdownItem<T> {
  final String label;
  final T value;

  const GlassyDropdownItem({
    required this.label,
    required this.value,
  });
}

/// Reusable glassy dropdown field widget
class GlassyDropdownField<T> extends StatelessWidget {
  const GlassyDropdownField({
    super.key,
    required this.label,
    required this.items,
    required this.selectedValue,
    required this.onChanged,
    this.required = false,
    this.hintText,
    this.selectOptionLabel = '-- Select --',
    this.showSelectOption = true,
  });

  final String label;
  final List<GlassyDropdownItem<T>> items;
  final T? selectedValue;
  final ValueChanged<T?> onChanged;
  final bool required;
  final String? hintText;
  final String selectOptionLabel;
  final bool showSelectOption;

  @override
  Widget build(BuildContext context) {
    final dropdownKey = GlobalKey();
    final displayText = selectedValue == null
        ? (hintText ?? selectOptionLabel)
        : items.firstWhere(
            (item) => item.value == selectedValue,
            orElse: () => GlassyDropdownItem<T>(
              label: hintText ?? selectOptionLabel,
              value: selectedValue!,
            ),
          ).label;

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        GlassyTheme.fieldLabel(label, required: required),
        GlassyTheme.glassyTextField(
          TextFormField(
            key: dropdownKey,
            readOnly: true,
            style: const TextStyle(color: Colors.white),
            controller: TextEditingController(text: displayText),
            decoration: GlassyTheme.glassyInputDecoration(
              hintText: hintText ?? selectOptionLabel,
              suffixIcon: const Icon(Icons.arrow_drop_down),
            ),
            onTap: () {
              GlassyTheme.showSearchableGlassyDropdown<T>(
                context: context,
                key: dropdownKey,
                items: items,
                selectedValue: selectedValue,
                onSelected: onChanged,
                showSelectOption: showSelectOption,
                selectOptionLabel: selectOptionLabel,
                searchHint: 'Search ${label.toLowerCase()}...',
              );
            },
          ),
        ),
      ],
    );
  }
}

/// Reusable glassy chip group widget for selecting from multiple options
class GlassyChipGroup<T> extends StatelessWidget {
  const GlassyChipGroup({
    super.key,
    required this.label,
    required this.options,
    required this.selectedValue,
    required this.onChanged,
    this.spacing = 12,
    this.runSpacing = 4,
  });

  final String label;
  final List<GlassyDropdownItem<T>> options;
  final T selectedValue;
  final ValueChanged<T> onChanged;
  final double spacing;
  final double runSpacing;

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: Theme.of(context).textTheme.titleSmall?.copyWith(
                fontWeight: FontWeight.w600,
                color: Colors.white.withValues(alpha: 0.9),
              ),
        ),
        const SizedBox(height: 8),
        Wrap(
          spacing: spacing,
          runSpacing: runSpacing,
          children: options.map((option) {
            return GlassyTheme.glassyChip(
              context: context,
              label: option.label,
              selected: selectedValue == option.value,
              onTap: () => onChanged(option.value),
            );
          }).toList(),
        ),
      ],
    );
  }
}

/// Reusable glassy text field widget with label
class GlassyTextField extends StatelessWidget {
  const GlassyTextField({
    super.key,
    required this.label,
    required this.controller,
    this.required = false,
    this.hintText,
    this.validator,
    this.keyboardType,
    this.obscureText = false,
    this.textCapitalization,
    this.suffixIcon,
    this.onChanged,
    this.onTap,
    this.readOnly = false,
  });

  final String label;
  final TextEditingController controller;
  final bool required;
  final String? hintText;
  final String? Function(String?)? validator;
  final TextInputType? keyboardType;
  final bool obscureText;
  final TextCapitalization? textCapitalization;
  final Widget? suffixIcon;
  final ValueChanged<String>? onChanged;
  final VoidCallback? onTap;
  final bool readOnly;

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        GlassyTheme.fieldLabel(label, required: required),
        GlassyTheme.glassyTextField(
          TextFormField(
            controller: controller,
            style: const TextStyle(color: Colors.white),
            decoration: GlassyTheme.glassyInputDecoration(
              hintText: hintText,
              suffixIcon: suffixIcon,
            ),
            validator: validator,
            keyboardType: keyboardType,
            obscureText: obscureText,
            textCapitalization: textCapitalization ?? TextCapitalization.none,
            onChanged: onChanged,
            onTap: onTap,
            readOnly: readOnly,
          ),
        ),
      ],
    );
  }
}

/// Reusable glassy password field widget with visibility toggle
class GlassyPasswordField extends StatefulWidget {
  const GlassyPasswordField({
    super.key,
    required this.label,
    required this.controller,
    this.required = false,
    this.hintText,
    this.validator,
    this.minLength = 6,
    this.onFieldSubmitted,
  });

  final String label;
  final TextEditingController controller;
  final bool required;
  final String? hintText;
  final String? Function(String?)? validator;
  final int minLength;
  final void Function(String)? onFieldSubmitted;

  @override
  State<GlassyPasswordField> createState() => _GlassyPasswordFieldState();
}

class _GlassyPasswordFieldState extends State<GlassyPasswordField> {
  bool _obscurePassword = true;

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        GlassyTheme.fieldLabel(widget.label, required: widget.required),
        GlassyTheme.glassyTextField(
          TextFormField(
            controller: widget.controller,
            style: const TextStyle(color: Colors.white),
            obscureText: _obscurePassword,
            decoration: GlassyTheme.glassyInputDecoration(
              hintText: widget.hintText ?? 'Enter password',
              suffixIcon: IconButton(
                icon: Icon(
                  _obscurePassword
                      ? Icons.visibility_outlined
                      : Icons.visibility_off_outlined,
                ),
                onPressed: () {
                  setState(() {
                    _obscurePassword = !_obscurePassword;
                  });
                },
              ),
            ),
            validator: widget.validator ??
                (widget.required
                    ? (value) {
                        if (value == null || value.isEmpty) {
                          return '${widget.label} is required';
                        }
                        if (value.length < widget.minLength) {
                          return '${widget.label} must be at least ${widget.minLength} characters';
                        }
                        return null;
                      }
                    : null),
            onFieldSubmitted: widget.onFieldSubmitted,
          ),
        ),
      ],
    );
  }
}

/// Reusable phone field widget (Country Code + Mobile Number)
class GlassyPhoneField extends StatelessWidget {
  const GlassyPhoneField({
    super.key,
    required this.countryCodeLabel,
    required this.mobileNumberLabel,
    required this.countryCode,
    required this.mobileController,
    required this.countryCodeOptions,
    required this.onCountryCodeChanged,
    this.countryCodeRequired = true,
    this.mobileNumberRequired = true,
    this.mobileNumberHint,
    this.mobileNumberValidator,
    this.countryCodeValidator,
  });

  final String countryCodeLabel;
  final String mobileNumberLabel;
  final String countryCode;
  final TextEditingController mobileController;
  final List<GlassyDropdownItem<String>> countryCodeOptions;
  final ValueChanged<String> onCountryCodeChanged;
  final bool countryCodeRequired;
  final bool mobileNumberRequired;
  final String? mobileNumberHint;
  final String? Function(String?)? mobileNumberValidator;
  final String? Function(String?)? countryCodeValidator;

  @override
  Widget build(BuildContext context) {
    final dropdownKey = GlobalKey();
    final selectedItem = countryCodeOptions.firstWhere(
      (item) => item.value == countryCode,
      orElse: () => countryCodeOptions.first,
    );
    final displayText = selectedItem.value;

    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Expanded(
          flex: 4,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              GlassyTheme.fieldLabel(
                countryCodeLabel,
                required: countryCodeRequired,
              ),
              GlassyTheme.glassyTextField(
                TextFormField(
                  key: dropdownKey,
                  readOnly: true,
                  style: const TextStyle(color: Colors.white),
                  controller: TextEditingController(text: displayText),
                  decoration: GlassyTheme.glassyInputDecoration(
                    hintText: 'Code',
                    suffixIcon: const Icon(Icons.arrow_drop_down),
                  ),
                  validator: countryCodeValidator ??
                      (countryCodeRequired
                          ? (value) {
                              if (value == null || value.isEmpty) {
                                return 'Required';
                              }
                              return null;
                            }
                          : null),
                  onTap: () {
                    GlassyTheme.showSearchableGlassyDropdown<String>(
                      context: context,
                      key: dropdownKey,
                      items: countryCodeOptions,
                      selectedValue: countryCode,
                      onSelected: (value) {
                        if (value != null) {
                          onCountryCodeChanged(value);
                        }
                      },
                      showSelectOption: false,
                      searchHint: 'Search country code...',
                      minWidth: 320, // Wider width for country names
                    );
                  },
                ),
              ),
            ],
          ),
        ),
        const SizedBox(width: 12),
        Expanded(
          flex: 6,
          child: GlassyTextField(
            label: mobileNumberLabel,
            controller: mobileController,
            required: mobileNumberRequired,
            hintText: mobileNumberHint ?? '1234567890',
            keyboardType: TextInputType.phone,
            validator: mobileNumberValidator ??
                (mobileNumberRequired
                    ? (value) {
                        if (value == null || value.trim().isEmpty) {
                          return '$mobileNumberLabel is required';
                        }
                        if (!RegExp(r'^\d+$').hasMatch(value.trim())) {
                          return 'Must contain only digits';
                        }
                        return null;
                      }
                    : null),
          ),
        ),
      ],
    );
  }
}

/// Reusable checkbox with label widget
class GlassyCheckboxWithLabel extends StatelessWidget {
  const GlassyCheckboxWithLabel({
    super.key,
    required this.value,
    required this.onChanged,
    required this.label,
  });

  final bool value;
  final ValueChanged<bool> onChanged;
  final String label;

  @override
  Widget build(BuildContext context) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Checkbox(
          value: value,
          onChanged: (newValue) => onChanged(newValue ?? false),
          activeColor: Theme.of(context).colorScheme.primary,
          checkColor: Colors.white,
        ),
        Expanded(
          child: GestureDetector(
            onTap: () => onChanged(!value),
            child: Padding(
              padding: const EdgeInsets.only(top: 12),
              child: Text(
                label,
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 14,
                ),
              ),
            ),
          ),
        ),
      ],
    );
  }
}

/// Reusable futuristic city night background widget
class GlassyFuturisticBackground extends StatelessWidget {
  const GlassyFuturisticBackground({super.key});

  @override
  Widget build(BuildContext context) {
    return Stack(
      children: [
        // Base gradient
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
                      const Color(0xFF7b2cbf).withValues(alpha: 0.3), // Purple
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
                      const Color(0xFF8338ec).withValues(alpha: 0.25), // Purple
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
                      const Color(0xFF560bad).withValues(alpha: 0.15), // Dark purple
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
      ],
    );
  }
}

/// Reusable glassy form container widget
class GlassyFormContainer extends StatelessWidget {
  const GlassyFormContainer({
    super.key,
    required this.child,
    this.padding,
    this.maxWidth = 600,
    this.topPadding = 150,
  });

  final Widget child;
  final EdgeInsets? padding;
  final double maxWidth;
  final double topPadding;

  @override
  Widget build(BuildContext context) {
    return Center(
      child: SingleChildScrollView(
        padding: EdgeInsets.fromLTRB(20, topPadding, 20, 24),
        child: ConstrainedBox(
          constraints: BoxConstraints(maxWidth: maxWidth),
          child: TweenAnimationBuilder<double>(
            duration: const Duration(milliseconds: 600),
            curve: Curves.easeOutCubic,
            tween: Tween(begin: 0, end: 1),
            builder: (context, value, animatedChild) {
              return Opacity(
                opacity: value,
                child: Transform.translate(
                  offset: Offset(0, (1 - value) * 24),
                  child: animatedChild,
                ),
              );
            },
            child: GlassyTheme.glassyContainer(
              padding: padding ?? const EdgeInsets.fromLTRB(20, 20, 20, 24),
              child: child,
            ),
          ),
        ),
      ),
    );
  }
}

/// Reusable glassy submit button widget with loading state
class GlassySubmitButton extends StatelessWidget {
  const GlassySubmitButton({
    super.key,
    required this.onPressed,
    required this.label,
    this.isLoading = false,
    this.height,
  });

  final VoidCallback? onPressed;
  final String label;
  final bool isLoading;
  final double? height;

  @override
  Widget build(BuildContext context) {
    return GlassyTheme.accentButton(
      context: context,
      onPressed: isLoading ? null : onPressed,
      height: height,
      child: isLoading
          ? const SizedBox(
              height: 20,
              width: 20,
              child: CircularProgressIndicator(
                strokeWidth: 2,
                valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
              ),
            )
          : Text(
              label,
              style: const TextStyle(
                fontWeight: FontWeight.w600,
                fontSize: 16,
              ),
            ),
    );
  }
}

