import 'dart:ui';
import 'package:flutter/material.dart';
import '../../widgets/glassy_theme_widgets.dart';
import '../../widgets/custom_notifications.dart';
import '../auth/auth_service.dart';
import '../auth/login_screen.dart';
import '../settings/theme_picker_screen.dart';
import '../settings/profile_screen.dart';
import '../manage/banks_accounts_screen.dart';
import '../../database/app_database.dart';

/// Dashboard screen showing user information and main navigation
class DashboardScreen extends StatefulWidget {
  const DashboardScreen({super.key});

  @override
  State<DashboardScreen> createState() => _DashboardScreenState();
}

class _DashboardScreenState extends State<DashboardScreen> {
  final _authService = AuthService();
  User? _currentUser;
  bool _isLoading = true;
  bool _isLoggingOut = false;

  // Track expanded sections in drawer
  final Map<String, bool> _expandedSections = {
    'Main Menu': true,
    'Manage': false,
    'Transaction': false,
    'Reports': false,
    'History': false,
    'Utilities': false,
    'Settings': false,
  };

  @override
  void initState() {
    super.initState();
    _loadUserData();
  }

  Future<void> _loadUserData() async {
    try {
      final user = await _authService.getCurrentUser();
      setState(() {
        _currentUser = user;
        _isLoading = false;
      });
    } catch (e) {
      setState(() {
        _isLoading = false;
      });
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Failed to load user data: ${e.toString()}'),
            backgroundColor: Colors.red,
          ),
        );
      }
    }
  }

  Future<void> _handleLogout() async {
    final shouldLogout = await GlassyLogoutDialog.show(context);

    if (shouldLogout != true) return;

    setState(() {
      _isLoggingOut = true;
    });

    try {
      await _authService.logout();
      if (!mounted) return;

      // Show success notification
      GlassySuccessNotification.show(
        context,
        message: 'Logged out successfully',
        icon: Icons.logout_rounded,
        color: Colors.orange,
      );

      // Navigate to login screen after a short delay
      Future.delayed(const Duration(milliseconds: 500), () {
        if (mounted) {
          Navigator.of(context).pushAndRemoveUntil(
            MaterialPageRoute(builder: (_) => const LoginScreen()),
            (route) => false,
          );
        }
      });
    } catch (e) {
      if (!mounted) return;
      setState(() {
        _isLoggingOut = false;
      });
      GlassyErrorNotification.show(
        context,
        message: 'Logout failed: ${e.toString()}',
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
      drawer: _buildNavigationDrawer(),
      appBar: GlassyTheme.glassyAppBar(
        titleText: 'Dashboard',
        leading: Builder(
          builder: (context) => IconButton(
            icon: const Icon(Icons.menu),
            onPressed: () => Scaffold.of(context).openDrawer(),
          ),
        ),
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
          const GlassyFuturisticBackground(),
          SafeArea(
            child: _isLoading
                ? const Center(
                    child: CircularProgressIndicator(
                      valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
                    ),
                  )
                : RefreshIndicator(
                    onRefresh: _loadUserData,
                    color: Colors.white,
                    child: SingleChildScrollView(
                      physics: const AlwaysScrollableScrollPhysics(),
                      padding: const EdgeInsets.symmetric(
                        horizontal: 20,
                        vertical: 10,
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const SizedBox(height: 10),
                          _buildHeroWelcomeCard(),
                          const SizedBox(height: 20),
                          _buildStatsGrid(),
                          const SizedBox(height: 20),
                          _buildSectionHeader('Quick Actions', Icons.flash_on),
                          const SizedBox(height: 12),
                          _buildQuickActionsGrid(),
                          const SizedBox(height: 20),
                          _buildSectionHeader(
                            'Account Details',
                            Icons.info_outline,
                          ),
                          const SizedBox(height: 12),
                          _buildAccountDetailsCard(),
                          const SizedBox(height: 20),
                        ],
                      ),
                    ),
                  ),
          ),
          if (_isLoggingOut)
            Container(
              color: Colors.black.withValues(alpha: 0.5),
              child: const Center(
                child: CircularProgressIndicator(
                  valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
                ),
              ),
            ),
        ],
      ),
    );
  }

  Widget _buildHeroWelcomeCard() {
    final businessName = _currentUser?.businessName ?? 'User';
    final greeting = _getGreeting();
    final emoji = _getGreetingEmoji();

    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(24),
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            Colors.blue.withValues(alpha: 0.3),
            Colors.purple.withValues(alpha: 0.3),
            Colors.pink.withValues(alpha: 0.2),
          ],
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.blue.withValues(alpha: 0.3),
            blurRadius: 20,
            offset: const Offset(0, 10),
          ),
        ],
      ),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(24),
        child: BackdropFilter(
          filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
          child: Container(
            padding: const EdgeInsets.all(24),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(24),
              color: Colors.white.withValues(alpha: 0.15),
              border: Border.all(
                color: Colors.white.withValues(alpha: 0.3),
                width: 1.5,
              ),
            ),
            child: Row(
              children: [
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Row(
                        children: [
                          Text(emoji, style: const TextStyle(fontSize: 32)),
                          const SizedBox(width: 12),
                          Flexible(
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Text(
                                  greeting,
                                  style: Theme.of(context).textTheme.titleLarge
                                      ?.copyWith(
                                        color: Colors.white.withValues(
                                          alpha: 0.9,
                                        ),
                                        fontWeight: FontWeight.w500,
                                      ),
                                ),
                                const SizedBox(height: 4),
                                Text(
                                  businessName,
                                  style: Theme.of(context)
                                      .textTheme
                                      .headlineSmall
                                      ?.copyWith(
                                        color: Colors.white,
                                        fontWeight: FontWeight.bold,
                                        shadows: [
                                          Shadow(
                                            color: Colors.black.withValues(
                                              alpha: 0.3,
                                            ),
                                            blurRadius: 8,
                                          ),
                                        ],
                                      ),
                                  maxLines: 2,
                                  overflow: TextOverflow.ellipsis,
                                ),
                              ],
                            ),
                          ),
                        ],
                      ),
                      if (_currentUser?.email != null &&
                          _currentUser!.email!.isNotEmpty) ...[
                        const SizedBox(height: 12),
                        Row(
                          children: [
                            Icon(
                              Icons.email_outlined,
                              size: 16,
                              color: Colors.white.withValues(alpha: 0.8),
                            ),
                            const SizedBox(width: 6),
                            Expanded(
                              child: Text(
                                _currentUser!.email!,
                                style: Theme.of(context).textTheme.bodySmall
                                    ?.copyWith(
                                      color: Colors.white.withValues(
                                        alpha: 0.8,
                                      ),
                                    ),
                                overflow: TextOverflow.ellipsis,
                              ),
                            ),
                          ],
                        ),
                      ],
                    ],
                  ),
                ),
                Container(
                  padding: const EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    gradient: LinearGradient(
                      colors: [
                        Colors.white.withValues(alpha: 0.2),
                        Colors.white.withValues(alpha: 0.1),
                      ],
                    ),
                    border: Border.all(
                      color: Colors.white.withValues(alpha: 0.3),
                      width: 2,
                    ),
                  ),
                  child: Icon(Icons.store, color: Colors.white, size: 32),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildStatsGrid() {
    return Row(
      children: [
        Expanded(
          child: _buildStatCard(
            icon: Icons.account_balance_wallet,
            label: 'Accounts',
            value: '11',
            gradient: [Colors.blue, Colors.cyan],
            iconBg: Colors.blue.withValues(alpha: 0.2),
          ),
        ),
        const SizedBox(width: 12),
        Expanded(
          child: _buildStatCard(
            icon: Icons.people,
            label: 'Contacts',
            value: '1',
            gradient: [Colors.green, Colors.teal],
            iconBg: Colors.green.withValues(alpha: 0.2),
          ),
        ),
        const SizedBox(width: 12),
        Expanded(
          child: _buildStatCard(
            icon: Icons.inventory_2,
            label: 'Products',
            value: '0',
            gradient: [Colors.orange, Colors.deepOrange],
            iconBg: Colors.orange.withValues(alpha: 0.2),
          ),
        ),
      ],
    );
  }

  Widget _buildStatCard({
    required IconData icon,
    required String label,
    required String value,
    required List<Color> gradient,
    required Color iconBg,
  }) {
    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(20),
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: gradient.map((c) => c.withValues(alpha: 0.25)).toList(),
        ),
        boxShadow: [
          BoxShadow(
            color: gradient.first.withValues(alpha: 0.2),
            blurRadius: 15,
            offset: const Offset(0, 8),
          ),
        ],
      ),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(20),
        child: BackdropFilter(
          filter: ImageFilter.blur(sigmaX: 15, sigmaY: 15),
          child: Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(20),
              color: Colors.white.withValues(alpha: 0.1),
              border: Border.all(
                color: Colors.white.withValues(alpha: 0.2),
                width: 1,
              ),
            ),
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                Container(
                  padding: const EdgeInsets.all(10),
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    color: iconBg,
                  ),
                  child: Icon(icon, color: gradient.first, size: 24),
                ),
                const SizedBox(height: 12),
                Text(
                  value,
                  style: Theme.of(context).textTheme.headlineMedium?.copyWith(
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                    shadows: [
                      Shadow(
                        color: Colors.black.withValues(alpha: 0.3),
                        blurRadius: 4,
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 4),
                Text(
                  label,
                  style: Theme.of(context).textTheme.bodySmall?.copyWith(
                    color: Colors.white.withValues(alpha: 0.9),
                    fontWeight: FontWeight.w500,
                  ),
                  textAlign: TextAlign.center,
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildSectionHeader(String title, IconData icon) {
    return Row(
      children: [
        Container(
          padding: const EdgeInsets.all(8),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(12),
            gradient: LinearGradient(
              colors: [
                Colors.white.withValues(alpha: 0.2),
                Colors.white.withValues(alpha: 0.1),
              ],
            ),
            border: Border.all(
              color: Colors.white.withValues(alpha: 0.3),
              width: 1,
            ),
          ),
          child: Icon(icon, color: Colors.white, size: 20),
        ),
        const SizedBox(width: 12),
        Text(
          title,
          style: Theme.of(context).textTheme.titleLarge?.copyWith(
            color: Colors.white,
            fontWeight: FontWeight.bold,
            shadows: [
              Shadow(color: Colors.black.withValues(alpha: 0.3), blurRadius: 4),
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildQuickActionsGrid() {
    final actions = [
      _ActionItem(
        icon: Icons.add_shopping_cart,
        label: 'New Sale',
        gradient: [Colors.green, Colors.teal],
        message: 'New Sale feature coming soon',
      ),
      _ActionItem(
        icon: Icons.shopping_bag,
        label: 'Purchase',
        gradient: [Colors.blue, Colors.indigo],
        message: 'New Purchase feature coming soon',
      ),
      _ActionItem(
        icon: Icons.inventory,
        label: 'Products',
        gradient: [Colors.orange, Colors.deepOrange],
        message: 'Products feature coming soon',
      ),
      _ActionItem(
        icon: Icons.people,
        label: 'Contacts',
        gradient: [Colors.purple, Colors.pink],
        message: 'Contacts feature coming soon',
      ),
      _ActionItem(
        icon: Icons.account_balance,
        label: 'Accounts',
        gradient: [Colors.cyan, Colors.blue],
        message: 'Accounts feature coming soon',
      ),
      _ActionItem(
        icon: Icons.bar_chart,
        label: 'Reports',
        gradient: [Colors.red, Colors.orange],
        message: 'Reports feature coming soon',
      ),
    ];

    return GridView.builder(
      shrinkWrap: true,
      physics: const NeverScrollableScrollPhysics(),
      gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
        crossAxisCount: 3,
        crossAxisSpacing: 12,
        mainAxisSpacing: 12,
        childAspectRatio: 0.9,
      ),
      itemCount: actions.length,
      itemBuilder: (context, index) {
        final action = actions[index];
        return _buildActionCard(action);
      },
    );
  }

  Widget _buildActionCard(_ActionItem action) {
    return Material(
      color: Colors.transparent,
      child: InkWell(
        onTap: () {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text(action.message),
              backgroundColor: action.gradient.first,
              behavior: SnackBarBehavior.floating,
            ),
          );
        },
        borderRadius: BorderRadius.circular(20),
        child: Container(
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(20),
            gradient: LinearGradient(
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
              colors: action.gradient
                  .map((c) => c.withValues(alpha: 0.3))
                  .toList(),
            ),
            boxShadow: [
              BoxShadow(
                color: action.gradient.first.withValues(alpha: 0.2),
                blurRadius: 12,
                offset: const Offset(0, 6),
              ),
            ],
          ),
          child: ClipRRect(
            borderRadius: BorderRadius.circular(20),
            child: BackdropFilter(
              filter: ImageFilter.blur(sigmaX: 15, sigmaY: 15),
              child: Container(
                padding: const EdgeInsets.all(16),
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(20),
                  color: Colors.white.withValues(alpha: 0.1),
                  border: Border.all(
                    color: Colors.white.withValues(alpha: 0.2),
                    width: 1,
                  ),
                ),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Container(
                      padding: const EdgeInsets.all(12),
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        gradient: LinearGradient(colors: action.gradient),
                        boxShadow: [
                          BoxShadow(
                            color: action.gradient.first.withValues(alpha: 0.4),
                            blurRadius: 8,
                            offset: const Offset(0, 4),
                          ),
                        ],
                      ),
                      child: Icon(action.icon, color: Colors.white, size: 24),
                    ),
                    const SizedBox(height: 12),
                    Text(
                      action.label,
                      style: Theme.of(context).textTheme.bodySmall?.copyWith(
                        color: Colors.white,
                        fontWeight: FontWeight.w600,
                        fontSize: 12,
                      ),
                      textAlign: TextAlign.center,
                      maxLines: 2,
                      overflow: TextOverflow.ellipsis,
                    ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildAccountDetailsCard() {
    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(24),
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            Colors.indigo.withValues(alpha: 0.3),
            Colors.purple.withValues(alpha: 0.3),
          ],
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.indigo.withValues(alpha: 0.2),
            blurRadius: 20,
            offset: const Offset(0, 10),
          ),
        ],
      ),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(24),
        child: BackdropFilter(
          filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
          child: Container(
            padding: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(24),
              color: Colors.white.withValues(alpha: 0.15),
              border: Border.all(
                color: Colors.white.withValues(alpha: 0.3),
                width: 1.5,
              ),
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.all(10),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(12),
                        gradient: LinearGradient(
                          colors: [
                            Colors.white.withValues(alpha: 0.3),
                            Colors.white.withValues(alpha: 0.1),
                          ],
                        ),
                      ),
                      child: const Icon(
                        Icons.business,
                        color: Colors.white,
                        size: 24,
                      ),
                    ),
                    const SizedBox(width: 12),
                    Expanded(
                      child: Text(
                        'Business Information',
                        style: Theme.of(context).textTheme.titleLarge?.copyWith(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 20),
                // Business Name
                _buildDetailRow(
                  Icons.business,
                  'Business Name',
                  _currentUser?.businessName ?? 'N/A',
                  Colors.blue,
                ),
                const SizedBox(height: 16),
                // Business Type
                _buildDetailRow(
                  Icons.store,
                  'Business Type',
                  _currentUser?.businessType ?? 'N/A',
                  Colors.indigo,
                ),
                const SizedBox(height: 16),
                // Industry Type
                if (_currentUser?.industryType != null &&
                    _currentUser!.industryType!.isNotEmpty)
                  _buildDetailRow(
                    Icons.work_outline,
                    'Industry',
                    _currentUser!.industryType!,
                    Colors.green,
                  ),
                if (_currentUser?.industryType != null &&
                    _currentUser!.industryType!.isNotEmpty)
                  const SizedBox(height: 16),
                // Email
                if (_currentUser?.email != null &&
                    _currentUser!.email!.isNotEmpty)
                  _buildDetailRow(
                    Icons.email,
                    'Email',
                    _currentUser!.email!,
                    Colors.teal,
                  ),
                if (_currentUser?.email != null &&
                    _currentUser!.email!.isNotEmpty)
                  const SizedBox(height: 16),
                // Phone Number (Country Code + Mobile)
                _buildDetailRow(
                  Icons.phone,
                  'Phone Number',
                  '${_currentUser?.countryCode ?? ''} ${_currentUser?.mobile ?? 'N/A'}',
                  Colors.orange,
                ),
                const SizedBox(height: 16),
                // Username (Number)
                _buildDetailRow(
                  Icons.person,
                  'Username',
                  _currentUser?.number ?? 'N/A',
                  Colors.pink,
                ),
                const SizedBox(height: 16),
                // Currency
                _buildDetailRow(
                  Icons.attach_money,
                  'Currency',
                  _currentUser?.currency ?? 'Rs ',
                  Colors.purple,
                ),
                // Address if available
                if (_currentUser?.address != null &&
                    _currentUser!.address!.isNotEmpty) ...[
                  const SizedBox(height: 16),
                  _buildDetailRow(
                    Icons.location_on,
                    'Address',
                    _currentUser!.address!,
                    Colors.red,
                  ),
                ],
                // GST if available
                if (_currentUser?.gst != null &&
                    _currentUser!.gst!.isNotEmpty) ...[
                  const SizedBox(height: 16),
                  _buildDetailRow(
                    Icons.receipt,
                    'GST',
                    _currentUser!.gst!,
                    Colors.amber,
                  ),
                ],
                // VAT if available
                if (_currentUser?.vat != null &&
                    _currentUser!.vat!.isNotEmpty) ...[
                  const SizedBox(height: 16),
                  _buildDetailRow(
                    Icons.receipt_long,
                    'VAT',
                    _currentUser!.vat!,
                    Colors.deepOrange,
                  ),
                ],
                // Status
                if (_currentUser?.status != null &&
                    _currentUser!.status!.isNotEmpty) ...[
                  const SizedBox(height: 16),
                  _buildDetailRow(
                    _currentUser!.status!.toLowerCase() == 'published'
                        ? Icons.check_circle
                        : Icons.info,
                    'Status',
                    _currentUser!.status!,
                    _currentUser!.status!.toLowerCase() == 'published'
                        ? Colors.green
                        : Colors.grey,
                  ),
                ],
                const SizedBox(height: 20),
                Container(
                  width: double.infinity,
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(16),
                    gradient: LinearGradient(
                      colors: [
                        Colors.red.withValues(alpha: 0.8),
                        Colors.orange.withValues(alpha: 0.8),
                      ],
                    ),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.red.withValues(alpha: 0.3),
                        blurRadius: 12,
                        offset: const Offset(0, 6),
                      ),
                    ],
                  ),
                  child: Material(
                    color: Colors.transparent,
                    child: InkWell(
                      onTap: _isLoggingOut ? null : _handleLogout,
                      borderRadius: BorderRadius.circular(16),
                      child: Container(
                        padding: const EdgeInsets.symmetric(vertical: 16),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            if (_isLoggingOut)
                              const SizedBox(
                                width: 20,
                                height: 20,
                                child: CircularProgressIndicator(
                                  strokeWidth: 2,
                                  valueColor: AlwaysStoppedAnimation<Color>(
                                    Colors.white,
                                  ),
                                ),
                              )
                            else
                              const Icon(
                                Icons.logout,
                                color: Colors.white,
                                size: 20,
                              ),
                            const SizedBox(width: 8),
                            Text(
                              _isLoggingOut ? 'Logging out...' : 'Logout',
                              style: const TextStyle(
                                color: Colors.white,
                                fontWeight: FontWeight.bold,
                                fontSize: 16,
                              ),
                            ),
                          ],
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
    );
  }

  Widget _buildDetailRow(
    IconData icon,
    String label,
    String value,
    Color iconColor,
  ) {
    return Row(
      children: [
        Container(
          padding: const EdgeInsets.all(8),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(10),
            color: iconColor.withValues(alpha: 0.2),
            border: Border.all(
              color: iconColor.withValues(alpha: 0.4),
              width: 1,
            ),
          ),
          child: Icon(icon, color: iconColor, size: 18),
        ),
        const SizedBox(width: 12),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                label,
                style: Theme.of(context).textTheme.bodySmall?.copyWith(
                  color: Colors.white.withValues(alpha: 0.7),
                  fontSize: 12,
                ),
              ),
              const SizedBox(height: 2),
              Text(
                value,
                style: Theme.of(context).textTheme.bodyMedium?.copyWith(
                  color: Colors.white,
                  fontWeight: FontWeight.w600,
                ),
              ),
            ],
          ),
        ),
      ],
    );
  }

  String _getGreeting() {
    final hour = DateTime.now().hour;
    if (hour < 12) {
      return 'Good Morning';
    } else if (hour < 17) {
      return 'Good Afternoon';
    } else {
      return 'Good Evening';
    }
  }

  String _getGreetingEmoji() {
    final hour = DateTime.now().hour;
    if (hour < 12) {
      return '🌅';
    } else if (hour < 17) {
      return '☀️';
    } else {
      return '🌙';
    }
  }

  Widget _buildNavigationDrawer() {
    return Drawer(
      backgroundColor: Colors.transparent,
      child: ClipRRect(
        child: BackdropFilter(
          filter: ImageFilter.blur(sigmaX: 20, sigmaY: 20),
          child: Container(
            decoration: BoxDecoration(
              gradient: LinearGradient(
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
                colors: [
                  Colors.black.withValues(alpha: 0.9),
                  Colors.grey[900]!.withValues(alpha: 0.95),
                ],
              ),
            ),
            child: SafeArea(
              child: Column(
                children: [
                  // Header with user info
                  _buildDrawerHeader(),
                  const Divider(color: Colors.white24, height: 1),
                  // Main Menu - Icon-only quick actions
                  _buildMainMenuIcons(),
                  const Divider(color: Colors.white24, height: 1, thickness: 1),
                  // Menu items
                  Expanded(
                    child: ListView(
                      padding: EdgeInsets.zero,
                      children: [
                        _buildDrawerSection('Manage', [
                          _DrawerMenuItem(
                            icon: Icons.account_balance,
                            title: 'Banks and Accounts',
                            onTap: () {
                              Navigator.pop(context);
                              Navigator.of(context).push(
                                MaterialPageRoute<void>(
                                  builder: (_) => const BanksAccountsScreen(),
                                ),
                              );
                            },
                          ),
                          _DrawerMenuItem(
                            icon: Icons.inventory_2,
                            title: 'Products',
                            onTap: () => _showComingSoon(context, 'Products'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.room_service,
                            title: 'Services',
                            onTap: () => _showComingSoon(context, 'Services'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.people,
                            title: 'All Contacts',
                            onTap: () =>
                                _showComingSoon(context, 'All Contacts'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.person,
                            title: 'Customers',
                            onTap: () => _showComingSoon(context, 'Customers'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.local_shipping,
                            title: 'Suppliers',
                            onTap: () => _showComingSoon(context, 'Suppliers'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.badge,
                            title: 'Agents',
                            onTap: () => _showComingSoon(context, 'Agents'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.work,
                            title: 'Employees',
                            onTap: () => _showComingSoon(context, 'Employees'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.security,
                            title: 'Employees Access',
                            onTap: () =>
                                _showComingSoon(context, 'Employees Access'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.receipt_long,
                            title: 'Expense Types',
                            onTap: () =>
                                _showComingSoon(context, 'Expense Types'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.warehouse,
                            title: 'Locations/Warehouse',
                            onTap: () =>
                                _showComingSoon(context, 'Locations/Warehouse'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.build,
                            title: 'Manufacturing Jobs',
                            onTap: () =>
                                _showComingSoon(context, 'Manufacturing Jobs'),
                          ),
                        ]),
                        _buildDrawerSection('Transaction', [
                          _DrawerMenuItem(
                            icon: Icons.shopping_cart,
                            title: 'Sale Invoice',
                            onTap: () =>
                                _showComingSoon(context, 'Sale Invoice'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.store,
                            title: 'WholeSale Invoice',
                            onTap: () =>
                                _showComingSoon(context, 'WholeSale Invoice'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.undo,
                            title: 'Sales Return',
                            onTap: () =>
                                _showComingSoon(context, 'Sales Return'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.shopping_bag,
                            title: 'Purchase Invoice',
                            onTap: () =>
                                _showComingSoon(context, 'Purchase Invoice'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.keyboard_return,
                            title: 'Purchase Return',
                            onTap: () =>
                                _showComingSoon(context, 'Purchase Return'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.receipt,
                            title: 'New Expense',
                            onTap: () =>
                                _showComingSoon(context, 'New Expense'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.payment,
                            title: 'New Payments',
                            onTap: () =>
                                _showComingSoon(context, 'New Payments'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.swap_horiz,
                            title: 'Stock Transfer',
                            onTap: () =>
                                _showComingSoon(context, 'Stock Transfer'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.article,
                            title: 'Journal Entry',
                            onTap: () =>
                                _showComingSoon(context, 'Journal Entry'),
                          ),
                        ]),
                        _buildDrawerSection('Reports', [
                          _DrawerMenuItem(
                            icon: Icons.book,
                            title: 'General Journal',
                            onTap: () =>
                                _showComingSoon(context, 'General Journal'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.inventory,
                            title: 'Stock Report',
                            onTap: () =>
                                _showComingSoon(context, 'Stock Report'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.inventory_2_outlined,
                            title: 'Lended Inventory',
                            onTap: () =>
                                _showComingSoon(context, 'Lended Inventory'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.list_alt,
                            title: 'Purchase Rate List',
                            onTap: () =>
                                _showComingSoon(context, 'Purchase Rate List'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.price_check,
                            title: 'Sale Rate List',
                            onTap: () =>
                                _showComingSoon(context, 'Sale Rate List'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.sell,
                            title: 'Sold Items',
                            onTap: () => _showComingSoon(context, 'Sold Items'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.trending_up,
                            title: 'Profit and Loss',
                            onTap: () =>
                                _showComingSoon(context, 'Profit and Loss'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.account_balance_wallet,
                            title: 'Balance Sheet',
                            onTap: () =>
                                _showComingSoon(context, 'Balance Sheet'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.account_balance,
                            title: 'Receivable / Payable',
                            onTap: () => _showComingSoon(
                              context,
                              'Receivable / Payable',
                            ),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.calendar_today,
                            title: 'Daily Report',
                            onTap: () =>
                                _showComingSoon(context, 'Daily Report'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.bar_chart,
                            title: 'Sales Report',
                            onTap: () =>
                                _showComingSoon(context, 'Sales Report'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.attach_money,
                            title: 'Cash Sales',
                            onTap: () => _showComingSoon(context, 'Cash Sales'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.credit_card,
                            title: 'Credit Sales',
                            onTap: () =>
                                _showComingSoon(context, 'Credit Sales'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.payment_outlined,
                            title: 'Partially Paid Sales',
                            onTap: () => _showComingSoon(
                              context,
                              'Partially Paid Sales',
                            ),
                          ),
                        ]),
                        _buildDrawerSection('History', [
                          _DrawerMenuItem(
                            icon: Icons.history,
                            title: 'Sales History',
                            onTap: () =>
                                _showComingSoon(context, 'Sales History'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.assignment_return,
                            title: 'Sales Return History',
                            onTap: () => _showComingSoon(
                              context,
                              'Sales Return History',
                            ),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.description,
                            title: 'Sales Quotation History',
                            onTap: () => _showComingSoon(
                              context,
                              'Sales Quotation History',
                            ),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.shopping_basket,
                            title: 'Purchases History',
                            onTap: () =>
                                _showComingSoon(context, 'Purchases History'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.assignment_returned,
                            title: 'Purchases Return History',
                            onTap: () => _showComingSoon(
                              context,
                              'Purchases Return History',
                            ),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.receipt_long,
                            title: 'Expense History',
                            onTap: () =>
                                _showComingSoon(context, 'Expense History'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.payment,
                            title: 'Payment History',
                            onTap: () =>
                                _showComingSoon(context, 'Payment History'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.swap_horizontal_circle,
                            title: 'Stock Transfer',
                            onTap: () =>
                                _showComingSoon(context, 'Stock Transfer'),
                          ),
                        ]),
                        _buildDrawerSection('Utilities', [
                          _DrawerMenuItem(
                            icon: Icons.checklist,
                            title: 'ToDo List',
                            onTap: () => _showComingSoon(context, 'ToDo List'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.local_shipping,
                            title: 'Print Shipping',
                            onTap: () =>
                                _showComingSoon(context, 'Print Shipping'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.history,
                            title: 'Shipping History',
                            onTap: () =>
                                _showComingSoon(context, 'Shipping History'),
                          ),
                        ]),
                        _buildDrawerSection('Settings', [
                          _DrawerMenuItem(
                            icon: Icons.person,
                            title: 'Profile',
                            onTap: () {
                              Navigator.pop(context);
                              Navigator.of(context).push(
                                MaterialPageRoute<void>(
                                  builder: (_) => const ProfileScreen(),
                                ),
                              );
                            },
                          ),
                          _DrawerMenuItem(
                            icon: Icons.lock,
                            title: 'Change Password',
                            onTap: () =>
                                _showComingSoon(context, 'Change Password'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.card_membership,
                            title: 'Membership',
                            onTap: () => _showComingSoon(context, 'Membership'),
                          ),
                          _DrawerMenuItem(
                            icon: Icons.color_lens,
                            title: 'Theme',
                            onTap: () {
                              Navigator.pop(context);
                              Navigator.of(context).push(
                                MaterialPageRoute<void>(
                                  builder: (_) => const ThemePickerScreen(),
                                ),
                              );
                            },
                          ),
                          _DrawerMenuItem(
                            icon: Icons.logout,
                            title: 'Logout',
                            onTap: () {
                              Navigator.pop(context);
                              _handleLogout();
                            },
                            isDestructive: true,
                          ),
                        ]),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildDrawerHeader() {
    final businessName = _currentUser?.businessName ?? 'User';
    final email = _currentUser?.email ?? '';

    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            Colors.blue.withValues(alpha: 0.3),
            Colors.purple.withValues(alpha: 0.3),
          ],
        ),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  gradient: LinearGradient(
                    colors: [
                      Colors.white.withValues(alpha: 0.2),
                      Colors.white.withValues(alpha: 0.1),
                    ],
                  ),
                  border: Border.all(
                    color: Colors.white.withValues(alpha: 0.3),
                    width: 2,
                  ),
                ),
                child: const Icon(Icons.store, color: Colors.white, size: 32),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      businessName,
                      style: const TextStyle(
                        color: Colors.white,
                        fontSize: 18,
                        fontWeight: FontWeight.bold,
                      ),
                      maxLines: 2,
                      overflow: TextOverflow.ellipsis,
                    ),
                    if (email.isNotEmpty) ...[
                      const SizedBox(height: 4),
                      Text(
                        email,
                        style: TextStyle(
                          color: Colors.white.withValues(alpha: 0.8),
                          fontSize: 12,
                        ),
                        maxLines: 1,
                        overflow: TextOverflow.ellipsis,
                      ),
                    ],
                  ],
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildMainMenuIcons() {
    return Container(
      padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 8),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        children: [
          _buildMainMenuIcon(
            icon: Icons.dashboard_rounded,
            label: 'Dashboard',
            gradient: [Colors.blue, Colors.cyan],
            onTap: () {
              Navigator.pop(context);
            },
          ),
          const SizedBox(width: 12),
          _buildMainMenuIcon(
            icon: Icons.person_rounded,
            label: 'Profile',
            gradient: [Colors.purple, Colors.pink],
            onTap: () {
              Navigator.pop(context);
              Navigator.of(context).push(
                MaterialPageRoute<void>(
                  builder: (_) => const ProfileScreen(),
                ),
              );
            },
          ),
          const SizedBox(width: 12),
          _buildMainMenuIcon(
            icon: Icons.logout_rounded,
            label: 'Logout',
            gradient: [Colors.red, Colors.orange],
            onTap: () {
              Navigator.pop(context);
              _handleLogout();
            },
          ),
        ],
      ),
    );
  }

  Widget _buildMainMenuIcon({
    required IconData icon,
    required String label,
    required List<Color> gradient,
    required VoidCallback onTap,
  }) {
    return Expanded(
      child: Container(
        margin: const EdgeInsets.symmetric(horizontal: 4),
        child: Material(
          color: Colors.transparent,
          child: InkWell(
            onTap: onTap,
            borderRadius: BorderRadius.circular(12),
            child: Container(
              padding: const EdgeInsets.symmetric(vertical: 8, horizontal: 4),
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(12),
                gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  colors: gradient.map((c) => c.withValues(alpha: 0.2)).toList(),
                ),
                border: Border.all(
                  color: gradient.first.withValues(alpha: 0.4),
                  width: 1,
                ),
              ),
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Container(
                    padding: const EdgeInsets.all(6),
                    decoration: BoxDecoration(
                      shape: BoxShape.circle,
                      gradient: LinearGradient(
                        colors: gradient,
                      ),
                      boxShadow: [
                        BoxShadow(
                          color: gradient.first.withValues(alpha: 0.4),
                          blurRadius: 6,
                          offset: const Offset(0, 2),
                        ),
                      ],
                    ),
                    child: Icon(icon, color: Colors.white, size: 16),
                  ),
                  const SizedBox(height: 6),
                  Text(
                    label,
                    style: const TextStyle(
                      color: Colors.white,
                      fontSize: 10,
                      fontWeight: FontWeight.w600,
                    ),
                    textAlign: TextAlign.center,
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildDrawerSection(String title, List<_DrawerMenuItem> items) {
    final isExpanded = _expandedSections[title] ?? false;

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Material(
          color: Colors.transparent,
          child: InkWell(
            onTap: () {
              setState(() {
                _expandedSections[title] = !isExpanded;
              });
            },
            borderRadius: BorderRadius.circular(12),
            child: Container(
              margin: const EdgeInsets.symmetric(vertical: 2),
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
              decoration: BoxDecoration(
                gradient: isExpanded
                    ? LinearGradient(
                        begin: Alignment.topLeft,
                        end: Alignment.bottomRight,
                        colors: [
                          Colors.white.withValues(alpha: 0.15),
                          Colors.white.withValues(alpha: 0.08),
                        ],
                      )
                    : LinearGradient(
                        begin: Alignment.topLeft,
                        end: Alignment.bottomRight,
                        colors: [
                          Colors.white.withValues(alpha: 0.08),
                          Colors.white.withValues(alpha: 0.03),
                        ],
                      ),
                borderRadius: BorderRadius.circular(12),
                border: Border.all(
                  color: isExpanded
                      ? Colors.white.withValues(alpha: 0.3)
                      : Colors.white.withValues(alpha: 0.15),
                  width: 1.5,
                ),
                boxShadow: isExpanded
                    ? [
                        BoxShadow(
                          color: Colors.black.withValues(alpha: 0.2),
                          blurRadius: 8,
                          offset: const Offset(0, 2),
                        ),
                      ]
                    : null,
              ),
              child: Row(
                children: [
                  Container(
                    padding: const EdgeInsets.all(8),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(8),
                      gradient: LinearGradient(
                        begin: Alignment.topLeft,
                        end: Alignment.bottomRight,
                        colors: isExpanded
                            ? [
                                Colors.cyan.withValues(alpha: 0.4),
                                Colors.blue.withValues(alpha: 0.4),
                              ]
                            : [
                                Colors.white.withValues(alpha: 0.2),
                                Colors.white.withValues(alpha: 0.1),
                              ],
                      ),
                      border: Border.all(
                        color: isExpanded
                            ? Colors.cyan.withValues(alpha: 0.5)
                            : Colors.white.withValues(alpha: 0.3),
                        width: 1,
                      ),
                    ),
                    child: Icon(
                      _getSectionIcon(title),
                      color: isExpanded
                          ? Colors.white
                          : Colors.white.withValues(alpha: 0.8),
                      size: 18,
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: Text(
                      title,
                      style: TextStyle(
                        color: Colors.white.withValues(
                          alpha: isExpanded ? 1.0 : 0.9,
                        ),
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                        letterSpacing: 0.5,
                      ),
                    ),
                  ),
                  AnimatedRotation(
                    turns: isExpanded ? 0.5 : 0,
                    duration: const Duration(milliseconds: 200),
                    curve: Curves.easeInOut,
                    child: Container(
                      padding: const EdgeInsets.all(6),
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        color: Colors.white.withValues(alpha: 0.1),
                      ),
                      child: Icon(
                        Icons.keyboard_arrow_down,
                        color: Colors.white.withValues(alpha: 0.8),
                        size: 22,
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
        ClipRect(
          child: AnimatedSize(
            duration: const Duration(milliseconds: 300),
            curve: Curves.easeInOut,
            child: isExpanded
                ? Column(
                    children: items
                        .map((item) => _buildDrawerMenuItem(item))
                        .toList(),
                  )
                : const SizedBox.shrink(),
          ),
        ),
      ],
    );
  }

  Widget _buildDrawerMenuItem(_DrawerMenuItem item) {
    return ListTile(
      leading: Container(
        padding: const EdgeInsets.all(8),
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(10),
          color: item.isDestructive
              ? Colors.red.withValues(alpha: 0.2)
              : Colors.white.withValues(alpha: 0.1),
          border: Border.all(
            color: item.isDestructive
                ? Colors.red.withValues(alpha: 0.4)
                : Colors.white.withValues(alpha: 0.2),
            width: 1,
          ),
        ),
        child: Icon(
          item.icon,
          color: item.isDestructive ? Colors.red : Colors.white,
          size: 20,
        ),
      ),
      title: Text(
        item.title,
        style: TextStyle(
          color: item.isDestructive ? Colors.red : Colors.white,
          fontSize: 15,
          fontWeight: FontWeight.w500,
        ),
      ),
      onTap: item.onTap,
      contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
      minVerticalPadding: 12,
    );
  }

  IconData _getSectionIcon(String sectionTitle) {
    switch (sectionTitle) {
      case 'Main Menu':
        return Icons.dashboard;
      case 'Manage':
        return Icons.settings;
      case 'Transaction':
        return Icons.swap_horiz;
      case 'Reports':
        return Icons.assessment;
      case 'History':
        return Icons.history;
      case 'Utilities':
        return Icons.build;
      case 'Settings':
        return Icons.settings_applications;
      default:
        return Icons.folder;
    }
  }

  void _showComingSoon(BuildContext context, String feature) {
    Navigator.pop(context);
    GlassyErrorNotification.show(
      context,
      message: '$feature feature coming soon',
      icon: Icons.info_outline,
    );
  }
}

class _DrawerMenuItem {
  final IconData icon;
  final String title;
  final VoidCallback onTap;
  final bool isDestructive;

  _DrawerMenuItem({
    required this.icon,
    required this.title,
    required this.onTap,
    this.isDestructive = false,
  });
}

class _ActionItem {
  final IconData icon;
  final String label;
  final List<Color> gradient;
  final String message;

  _ActionItem({
    required this.icon,
    required this.label,
    required this.gradient,
    required this.message,
  });
}
