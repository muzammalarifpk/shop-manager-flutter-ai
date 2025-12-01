# Development Guidelines

This document outlines the development rules and best practices for this Flutter project.

## Flutter Version

**Current Flutter Version:** 3.35.4 (Stable Channel)  
**Dart Version:** 3.9.2

### Checking for Updates

To check if your Flutter installation is up-to-date:
```bash
flutter --version
flutter upgrade
```

## Deprecation Rules

### ⚠️ **CRITICAL: No Deprecated Functions or Packages**

**Rule:** Do NOT use any deprecated functions, classes, or packages in the codebase.

**Enforcement:**
- The `analysis_options.yaml` file is configured with linting rules that will flag deprecated API usage:
  - `avoid_deprecated_member_use`: Warns when using deprecated members
  - `avoid_deprecated_member_use_from_same_package`: Warns when using deprecated members from the same package

**How to Check:**
- Run `flutter analyze` to check for deprecated API usage
- IDE will show warnings for deprecated APIs
- Always check Flutter's [breaking changes documentation](https://docs.flutter.dev/release/breaking-changes) before major updates

**Action Items:**
- If you encounter deprecation warnings, update the code to use the recommended alternatives
- Never suppress deprecation warnings without fixing the underlying issue
- Review deprecation notices in package changelogs when updating dependencies

## Dependency Management

### 📦 **Always Use Latest Stable Versions**

**Rule:** When adding a new dependency, always check for and use the latest stable version available.

**Process Before Adding Dependencies:**

1. **Check Latest Version on pub.dev:**
   ```bash
   # Visit https://pub.dev and search for the package
   # Or use the CLI:
   flutter pub search <package_name>
   ```

2. **Verify Version Before Adding:**
   - Check the package's pub.dev page for the latest stable version
   - Read the changelog for breaking changes
   - Ensure compatibility with current Flutter/Dart version

3. **Check for Outdated Packages:**
   ```bash
   flutter pub outdated
   ```

4. **Update Existing Dependencies:**
   ```bash
   # Update within current constraints
   flutter pub upgrade
   
   # Update including major versions (use with caution)
   flutter pub upgrade --major-versions
   ```

**Best Practices:**
- ✅ Always specify version constraints (e.g., `^2.5.0` allows patch and minor updates)
- ✅ Check package maintenance status and popularity on pub.dev
- ✅ Verify the package is actively maintained (recent updates, open issues count)
- ✅ Read the package's README and documentation before adding
- ❌ Never use packages marked as "discontinued" or "deprecated"
- ❌ Avoid packages with no recent updates (>6 months) unless absolutely necessary

## Code Quality

### Static Analysis

Run static analysis before committing:
```bash
flutter analyze
```

This will check for:
- Deprecated API usage
- Linting violations
- Type errors
- Other code quality issues

### Formatting

Ensure code is properly formatted:
```bash
flutter format .
```

## Version Information

Last checked: January 2025

To check the latest Flutter version:
- Visit: https://docs.flutter.dev/release/archive
- Or run: `flutter --version` and compare with official releases

---

**Remember:** Always prioritize code quality, maintainability, and staying up-to-date with Flutter best practices!

