/// Static configuration values shared across the app.
/// Mirrors important PHP config lists so we keep things consistent.
class AppConstants {
  const AppConstants._();

  /// Copied from PHP `$list_industries` in config.php.
  static const List<String> industries = [
    'Animal Health',
    'Appliance',
    'Automobile',
    'Chemicals',
    'Clothes',
    'Construction',
    'Cosmetics',
    'Electronics',
    'Food',
    'Garments',
    'General Store',
    'Grocery',
    'Handicraft',
    'Hardware',
    'Health',
    'Interior',
    'IT',
    'Jewellery',
    'Medical',
    'Mobiles',
    'Paper',
    'Petroleum',
    'Shoes',
    'Skin Care',
    'Sports',
    'Stationery',
    'Textile',
    'Tyres',
    'Vegetable',
    'Pesticides',
    // PHP adds "Others - " as an extra option in the dropdown.
    'Others - ',
  ];
}


