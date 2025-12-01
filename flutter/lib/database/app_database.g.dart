// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'app_database.dart';

// ignore_for_file: type=lint
class $UsersTable extends Users with TableInfo<$UsersTable, User> {
  @override
  final GeneratedDatabase attachedDatabase;
  final String? _alias;
  $UsersTable(this.attachedDatabase, [this._alias]);
  static const VerificationMeta _idMeta = const VerificationMeta('id');
  @override
  late final GeneratedColumn<int> id = GeneratedColumn<int>(
    'id',
    aliasedName,
    false,
    hasAutoIncrement: true,
    type: DriftSqlType.int,
    requiredDuringInsert: false,
    defaultConstraints: GeneratedColumn.constraintIsAlways(
      'PRIMARY KEY AUTOINCREMENT',
    ),
  );
  static const VerificationMeta _firebaseUidMeta = const VerificationMeta(
    'firebaseUid',
  );
  @override
  late final GeneratedColumn<String> firebaseUid = GeneratedColumn<String>(
    'firebase_uid',
    aliasedName,
    true,
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _numberMeta = const VerificationMeta('number');
  @override
  late final GeneratedColumn<String> number = GeneratedColumn<String>(
    'number',
    aliasedName,
    false,
    additionalChecks: GeneratedColumn.checkTextLength(
      minTextLength: 1,
      maxTextLength: 50,
    ),
    type: DriftSqlType.string,
    requiredDuringInsert: true,
  );
  static const VerificationMeta _businessNameMeta = const VerificationMeta(
    'businessName',
  );
  @override
  late final GeneratedColumn<String> businessName = GeneratedColumn<String>(
    'business_name',
    aliasedName,
    false,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 255),
    type: DriftSqlType.string,
    requiredDuringInsert: true,
  );
  static const VerificationMeta _emailMeta = const VerificationMeta('email');
  @override
  late final GeneratedColumn<String> email = GeneratedColumn<String>(
    'email',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 255),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _countryCodeMeta = const VerificationMeta(
    'countryCode',
  );
  @override
  late final GeneratedColumn<String> countryCode = GeneratedColumn<String>(
    'country_code',
    aliasedName,
    false,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 10),
    type: DriftSqlType.string,
    requiredDuringInsert: true,
  );
  static const VerificationMeta _mobileMeta = const VerificationMeta('mobile');
  @override
  late final GeneratedColumn<String> mobile = GeneratedColumn<String>(
    'mobile',
    aliasedName,
    false,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 20),
    type: DriftSqlType.string,
    requiredDuringInsert: true,
  );
  static const VerificationMeta _industryTypeMeta = const VerificationMeta(
    'industryType',
  );
  @override
  late final GeneratedColumn<String> industryType = GeneratedColumn<String>(
    'industry_type',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 100),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _businessTypeMeta = const VerificationMeta(
    'businessType',
  );
  @override
  late final GeneratedColumn<String> businessType = GeneratedColumn<String>(
    'business_type',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 50),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _addressMeta = const VerificationMeta(
    'address',
  );
  @override
  late final GeneratedColumn<String> address = GeneratedColumn<String>(
    'address',
    aliasedName,
    true,
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _cityMeta = const VerificationMeta('city');
  @override
  late final GeneratedColumn<String> city = GeneratedColumn<String>(
    'city',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 100),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _stateMeta = const VerificationMeta('state');
  @override
  late final GeneratedColumn<String> state = GeneratedColumn<String>(
    'state',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 100),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _countryMeta = const VerificationMeta(
    'country',
  );
  @override
  late final GeneratedColumn<String> country = GeneratedColumn<String>(
    'country',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 100),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _currencyMeta = const VerificationMeta(
    'currency',
  );
  @override
  late final GeneratedColumn<String> currency = GeneratedColumn<String>(
    'currency',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 10),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _gstMeta = const VerificationMeta('gst');
  @override
  late final GeneratedColumn<String> gst = GeneratedColumn<String>(
    'gst',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 50),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _vatMeta = const VerificationMeta('vat');
  @override
  late final GeneratedColumn<String> vat = GeneratedColumn<String>(
    'vat',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 50),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _taxMeta = const VerificationMeta('tax');
  @override
  late final GeneratedColumn<String> tax = GeneratedColumn<String>(
    'tax',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 10),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _negativeMeta = const VerificationMeta(
    'negative',
  );
  @override
  late final GeneratedColumn<String> negative = GeneratedColumn<String>(
    'negative',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 10),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _secondaryUnitsMeta = const VerificationMeta(
    'secondaryUnits',
  );
  @override
  late final GeneratedColumn<String> secondaryUnits = GeneratedColumn<String>(
    'secondary_units',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 10),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _variantsMeta = const VerificationMeta(
    'variants',
  );
  @override
  late final GeneratedColumn<String> variants = GeneratedColumn<String>(
    'variants',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 10),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _barcodeMeta = const VerificationMeta(
    'barcode',
  );
  @override
  late final GeneratedColumn<String> barcode = GeneratedColumn<String>(
    'barcode',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 10),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _logoMeta = const VerificationMeta('logo');
  @override
  late final GeneratedColumn<String> logo = GeneratedColumn<String>(
    'logo',
    aliasedName,
    true,
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _salesmanCommissionMeta =
      const VerificationMeta('salesmanCommission');
  @override
  late final GeneratedColumn<String> salesmanCommission =
      GeneratedColumn<String>(
        'salesman_commission',
        aliasedName,
        true,
        additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 10),
        type: DriftSqlType.string,
        requiredDuringInsert: false,
      );
  static const VerificationMeta _agentCommissionMeta = const VerificationMeta(
    'agentCommission',
  );
  @override
  late final GeneratedColumn<String> agentCommission = GeneratedColumn<String>(
    'agent_commission',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 10),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _printHeaderNoteMeta = const VerificationMeta(
    'printHeaderNote',
  );
  @override
  late final GeneratedColumn<String> printHeaderNote = GeneratedColumn<String>(
    'print_header_note',
    aliasedName,
    true,
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _printFooterNoteMeta = const VerificationMeta(
    'printFooterNote',
  );
  @override
  late final GeneratedColumn<String> printFooterNote = GeneratedColumn<String>(
    'print_footer_note',
    aliasedName,
    true,
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _statusMeta = const VerificationMeta('status');
  @override
  late final GeneratedColumn<String> status = GeneratedColumn<String>(
    'status',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 20),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _privsMeta = const VerificationMeta('privs');
  @override
  late final GeneratedColumn<String> privs = GeneratedColumn<String>(
    'privs',
    aliasedName,
    true,
    additionalChecks: GeneratedColumn.checkTextLength(maxTextLength: 255),
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _accountKeysMeta = const VerificationMeta(
    'accountKeys',
  );
  @override
  late final GeneratedColumn<String> accountKeys = GeneratedColumn<String>(
    'account_keys',
    aliasedName,
    true,
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _createdAtMeta = const VerificationMeta(
    'createdAt',
  );
  @override
  late final GeneratedColumn<DateTime> createdAt = GeneratedColumn<DateTime>(
    'created_at',
    aliasedName,
    false,
    type: DriftSqlType.dateTime,
    requiredDuringInsert: false,
    defaultValue: currentDateAndTime,
  );
  static const VerificationMeta _updatedAtMeta = const VerificationMeta(
    'updatedAt',
  );
  @override
  late final GeneratedColumn<DateTime> updatedAt = GeneratedColumn<DateTime>(
    'updated_at',
    aliasedName,
    false,
    type: DriftSqlType.dateTime,
    requiredDuringInsert: false,
    defaultValue: currentDateAndTime,
  );
  @override
  List<GeneratedColumn> get $columns => [
    id,
    firebaseUid,
    number,
    businessName,
    email,
    countryCode,
    mobile,
    industryType,
    businessType,
    address,
    city,
    state,
    country,
    currency,
    gst,
    vat,
    tax,
    negative,
    secondaryUnits,
    variants,
    barcode,
    logo,
    salesmanCommission,
    agentCommission,
    printHeaderNote,
    printFooterNote,
    status,
    privs,
    accountKeys,
    createdAt,
    updatedAt,
  ];
  @override
  String get aliasedName => _alias ?? actualTableName;
  @override
  String get actualTableName => $name;
  static const String $name = 'users';
  @override
  VerificationContext validateIntegrity(
    Insertable<User> instance, {
    bool isInserting = false,
  }) {
    final context = VerificationContext();
    final data = instance.toColumns(true);
    if (data.containsKey('id')) {
      context.handle(_idMeta, id.isAcceptableOrUnknown(data['id']!, _idMeta));
    }
    if (data.containsKey('firebase_uid')) {
      context.handle(
        _firebaseUidMeta,
        firebaseUid.isAcceptableOrUnknown(
          data['firebase_uid']!,
          _firebaseUidMeta,
        ),
      );
    }
    if (data.containsKey('number')) {
      context.handle(
        _numberMeta,
        number.isAcceptableOrUnknown(data['number']!, _numberMeta),
      );
    } else if (isInserting) {
      context.missing(_numberMeta);
    }
    if (data.containsKey('business_name')) {
      context.handle(
        _businessNameMeta,
        businessName.isAcceptableOrUnknown(
          data['business_name']!,
          _businessNameMeta,
        ),
      );
    } else if (isInserting) {
      context.missing(_businessNameMeta);
    }
    if (data.containsKey('email')) {
      context.handle(
        _emailMeta,
        email.isAcceptableOrUnknown(data['email']!, _emailMeta),
      );
    }
    if (data.containsKey('country_code')) {
      context.handle(
        _countryCodeMeta,
        countryCode.isAcceptableOrUnknown(
          data['country_code']!,
          _countryCodeMeta,
        ),
      );
    } else if (isInserting) {
      context.missing(_countryCodeMeta);
    }
    if (data.containsKey('mobile')) {
      context.handle(
        _mobileMeta,
        mobile.isAcceptableOrUnknown(data['mobile']!, _mobileMeta),
      );
    } else if (isInserting) {
      context.missing(_mobileMeta);
    }
    if (data.containsKey('industry_type')) {
      context.handle(
        _industryTypeMeta,
        industryType.isAcceptableOrUnknown(
          data['industry_type']!,
          _industryTypeMeta,
        ),
      );
    }
    if (data.containsKey('business_type')) {
      context.handle(
        _businessTypeMeta,
        businessType.isAcceptableOrUnknown(
          data['business_type']!,
          _businessTypeMeta,
        ),
      );
    }
    if (data.containsKey('address')) {
      context.handle(
        _addressMeta,
        address.isAcceptableOrUnknown(data['address']!, _addressMeta),
      );
    }
    if (data.containsKey('city')) {
      context.handle(
        _cityMeta,
        city.isAcceptableOrUnknown(data['city']!, _cityMeta),
      );
    }
    if (data.containsKey('state')) {
      context.handle(
        _stateMeta,
        state.isAcceptableOrUnknown(data['state']!, _stateMeta),
      );
    }
    if (data.containsKey('country')) {
      context.handle(
        _countryMeta,
        country.isAcceptableOrUnknown(data['country']!, _countryMeta),
      );
    }
    if (data.containsKey('currency')) {
      context.handle(
        _currencyMeta,
        currency.isAcceptableOrUnknown(data['currency']!, _currencyMeta),
      );
    }
    if (data.containsKey('gst')) {
      context.handle(
        _gstMeta,
        gst.isAcceptableOrUnknown(data['gst']!, _gstMeta),
      );
    }
    if (data.containsKey('vat')) {
      context.handle(
        _vatMeta,
        vat.isAcceptableOrUnknown(data['vat']!, _vatMeta),
      );
    }
    if (data.containsKey('tax')) {
      context.handle(
        _taxMeta,
        tax.isAcceptableOrUnknown(data['tax']!, _taxMeta),
      );
    }
    if (data.containsKey('negative')) {
      context.handle(
        _negativeMeta,
        negative.isAcceptableOrUnknown(data['negative']!, _negativeMeta),
      );
    }
    if (data.containsKey('secondary_units')) {
      context.handle(
        _secondaryUnitsMeta,
        secondaryUnits.isAcceptableOrUnknown(
          data['secondary_units']!,
          _secondaryUnitsMeta,
        ),
      );
    }
    if (data.containsKey('variants')) {
      context.handle(
        _variantsMeta,
        variants.isAcceptableOrUnknown(data['variants']!, _variantsMeta),
      );
    }
    if (data.containsKey('barcode')) {
      context.handle(
        _barcodeMeta,
        barcode.isAcceptableOrUnknown(data['barcode']!, _barcodeMeta),
      );
    }
    if (data.containsKey('logo')) {
      context.handle(
        _logoMeta,
        logo.isAcceptableOrUnknown(data['logo']!, _logoMeta),
      );
    }
    if (data.containsKey('salesman_commission')) {
      context.handle(
        _salesmanCommissionMeta,
        salesmanCommission.isAcceptableOrUnknown(
          data['salesman_commission']!,
          _salesmanCommissionMeta,
        ),
      );
    }
    if (data.containsKey('agent_commission')) {
      context.handle(
        _agentCommissionMeta,
        agentCommission.isAcceptableOrUnknown(
          data['agent_commission']!,
          _agentCommissionMeta,
        ),
      );
    }
    if (data.containsKey('print_header_note')) {
      context.handle(
        _printHeaderNoteMeta,
        printHeaderNote.isAcceptableOrUnknown(
          data['print_header_note']!,
          _printHeaderNoteMeta,
        ),
      );
    }
    if (data.containsKey('print_footer_note')) {
      context.handle(
        _printFooterNoteMeta,
        printFooterNote.isAcceptableOrUnknown(
          data['print_footer_note']!,
          _printFooterNoteMeta,
        ),
      );
    }
    if (data.containsKey('status')) {
      context.handle(
        _statusMeta,
        status.isAcceptableOrUnknown(data['status']!, _statusMeta),
      );
    }
    if (data.containsKey('privs')) {
      context.handle(
        _privsMeta,
        privs.isAcceptableOrUnknown(data['privs']!, _privsMeta),
      );
    }
    if (data.containsKey('account_keys')) {
      context.handle(
        _accountKeysMeta,
        accountKeys.isAcceptableOrUnknown(
          data['account_keys']!,
          _accountKeysMeta,
        ),
      );
    }
    if (data.containsKey('created_at')) {
      context.handle(
        _createdAtMeta,
        createdAt.isAcceptableOrUnknown(data['created_at']!, _createdAtMeta),
      );
    }
    if (data.containsKey('updated_at')) {
      context.handle(
        _updatedAtMeta,
        updatedAt.isAcceptableOrUnknown(data['updated_at']!, _updatedAtMeta),
      );
    }
    return context;
  }

  @override
  Set<GeneratedColumn> get $primaryKey => {id};
  @override
  User map(Map<String, dynamic> data, {String? tablePrefix}) {
    final effectivePrefix = tablePrefix != null ? '$tablePrefix.' : '';
    return User(
      id: attachedDatabase.typeMapping.read(
        DriftSqlType.int,
        data['${effectivePrefix}id'],
      )!,
      firebaseUid: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}firebase_uid'],
      ),
      number: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}number'],
      )!,
      businessName: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}business_name'],
      )!,
      email: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}email'],
      ),
      countryCode: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}country_code'],
      )!,
      mobile: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}mobile'],
      )!,
      industryType: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}industry_type'],
      ),
      businessType: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}business_type'],
      ),
      address: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}address'],
      ),
      city: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}city'],
      ),
      state: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}state'],
      ),
      country: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}country'],
      ),
      currency: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}currency'],
      ),
      gst: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}gst'],
      ),
      vat: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}vat'],
      ),
      tax: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}tax'],
      ),
      negative: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}negative'],
      ),
      secondaryUnits: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}secondary_units'],
      ),
      variants: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}variants'],
      ),
      barcode: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}barcode'],
      ),
      logo: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}logo'],
      ),
      salesmanCommission: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}salesman_commission'],
      ),
      agentCommission: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}agent_commission'],
      ),
      printHeaderNote: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}print_header_note'],
      ),
      printFooterNote: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}print_footer_note'],
      ),
      status: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}status'],
      ),
      privs: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}privs'],
      ),
      accountKeys: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}account_keys'],
      ),
      createdAt: attachedDatabase.typeMapping.read(
        DriftSqlType.dateTime,
        data['${effectivePrefix}created_at'],
      )!,
      updatedAt: attachedDatabase.typeMapping.read(
        DriftSqlType.dateTime,
        data['${effectivePrefix}updated_at'],
      )!,
    );
  }

  @override
  $UsersTable createAlias(String alias) {
    return $UsersTable(attachedDatabase, alias);
  }
}

class User extends DataClass implements Insertable<User> {
  final int id;
  final String? firebaseUid;
  final String number;
  final String businessName;
  final String? email;
  final String countryCode;
  final String mobile;
  final String? industryType;
  final String? businessType;
  final String? address;
  final String? city;
  final String? state;
  final String? country;
  final String? currency;
  final String? gst;
  final String? vat;
  final String? tax;
  final String? negative;
  final String? secondaryUnits;
  final String? variants;
  final String? barcode;
  final String? logo;
  final String? salesmanCommission;
  final String? agentCommission;
  final String? printHeaderNote;
  final String? printFooterNote;
  final String? status;
  final String? privs;
  final String? accountKeys;
  final DateTime createdAt;
  final DateTime updatedAt;
  const User({
    required this.id,
    this.firebaseUid,
    required this.number,
    required this.businessName,
    this.email,
    required this.countryCode,
    required this.mobile,
    this.industryType,
    this.businessType,
    this.address,
    this.city,
    this.state,
    this.country,
    this.currency,
    this.gst,
    this.vat,
    this.tax,
    this.negative,
    this.secondaryUnits,
    this.variants,
    this.barcode,
    this.logo,
    this.salesmanCommission,
    this.agentCommission,
    this.printHeaderNote,
    this.printFooterNote,
    this.status,
    this.privs,
    this.accountKeys,
    required this.createdAt,
    required this.updatedAt,
  });
  @override
  Map<String, Expression> toColumns(bool nullToAbsent) {
    final map = <String, Expression>{};
    map['id'] = Variable<int>(id);
    if (!nullToAbsent || firebaseUid != null) {
      map['firebase_uid'] = Variable<String>(firebaseUid);
    }
    map['number'] = Variable<String>(number);
    map['business_name'] = Variable<String>(businessName);
    if (!nullToAbsent || email != null) {
      map['email'] = Variable<String>(email);
    }
    map['country_code'] = Variable<String>(countryCode);
    map['mobile'] = Variable<String>(mobile);
    if (!nullToAbsent || industryType != null) {
      map['industry_type'] = Variable<String>(industryType);
    }
    if (!nullToAbsent || businessType != null) {
      map['business_type'] = Variable<String>(businessType);
    }
    if (!nullToAbsent || address != null) {
      map['address'] = Variable<String>(address);
    }
    if (!nullToAbsent || city != null) {
      map['city'] = Variable<String>(city);
    }
    if (!nullToAbsent || state != null) {
      map['state'] = Variable<String>(state);
    }
    if (!nullToAbsent || country != null) {
      map['country'] = Variable<String>(country);
    }
    if (!nullToAbsent || currency != null) {
      map['currency'] = Variable<String>(currency);
    }
    if (!nullToAbsent || gst != null) {
      map['gst'] = Variable<String>(gst);
    }
    if (!nullToAbsent || vat != null) {
      map['vat'] = Variable<String>(vat);
    }
    if (!nullToAbsent || tax != null) {
      map['tax'] = Variable<String>(tax);
    }
    if (!nullToAbsent || negative != null) {
      map['negative'] = Variable<String>(negative);
    }
    if (!nullToAbsent || secondaryUnits != null) {
      map['secondary_units'] = Variable<String>(secondaryUnits);
    }
    if (!nullToAbsent || variants != null) {
      map['variants'] = Variable<String>(variants);
    }
    if (!nullToAbsent || barcode != null) {
      map['barcode'] = Variable<String>(barcode);
    }
    if (!nullToAbsent || logo != null) {
      map['logo'] = Variable<String>(logo);
    }
    if (!nullToAbsent || salesmanCommission != null) {
      map['salesman_commission'] = Variable<String>(salesmanCommission);
    }
    if (!nullToAbsent || agentCommission != null) {
      map['agent_commission'] = Variable<String>(agentCommission);
    }
    if (!nullToAbsent || printHeaderNote != null) {
      map['print_header_note'] = Variable<String>(printHeaderNote);
    }
    if (!nullToAbsent || printFooterNote != null) {
      map['print_footer_note'] = Variable<String>(printFooterNote);
    }
    if (!nullToAbsent || status != null) {
      map['status'] = Variable<String>(status);
    }
    if (!nullToAbsent || privs != null) {
      map['privs'] = Variable<String>(privs);
    }
    if (!nullToAbsent || accountKeys != null) {
      map['account_keys'] = Variable<String>(accountKeys);
    }
    map['created_at'] = Variable<DateTime>(createdAt);
    map['updated_at'] = Variable<DateTime>(updatedAt);
    return map;
  }

  UsersCompanion toCompanion(bool nullToAbsent) {
    return UsersCompanion(
      id: Value(id),
      firebaseUid: firebaseUid == null && nullToAbsent
          ? const Value.absent()
          : Value(firebaseUid),
      number: Value(number),
      businessName: Value(businessName),
      email: email == null && nullToAbsent
          ? const Value.absent()
          : Value(email),
      countryCode: Value(countryCode),
      mobile: Value(mobile),
      industryType: industryType == null && nullToAbsent
          ? const Value.absent()
          : Value(industryType),
      businessType: businessType == null && nullToAbsent
          ? const Value.absent()
          : Value(businessType),
      address: address == null && nullToAbsent
          ? const Value.absent()
          : Value(address),
      city: city == null && nullToAbsent ? const Value.absent() : Value(city),
      state: state == null && nullToAbsent
          ? const Value.absent()
          : Value(state),
      country: country == null && nullToAbsent
          ? const Value.absent()
          : Value(country),
      currency: currency == null && nullToAbsent
          ? const Value.absent()
          : Value(currency),
      gst: gst == null && nullToAbsent ? const Value.absent() : Value(gst),
      vat: vat == null && nullToAbsent ? const Value.absent() : Value(vat),
      tax: tax == null && nullToAbsent ? const Value.absent() : Value(tax),
      negative: negative == null && nullToAbsent
          ? const Value.absent()
          : Value(negative),
      secondaryUnits: secondaryUnits == null && nullToAbsent
          ? const Value.absent()
          : Value(secondaryUnits),
      variants: variants == null && nullToAbsent
          ? const Value.absent()
          : Value(variants),
      barcode: barcode == null && nullToAbsent
          ? const Value.absent()
          : Value(barcode),
      logo: logo == null && nullToAbsent ? const Value.absent() : Value(logo),
      salesmanCommission: salesmanCommission == null && nullToAbsent
          ? const Value.absent()
          : Value(salesmanCommission),
      agentCommission: agentCommission == null && nullToAbsent
          ? const Value.absent()
          : Value(agentCommission),
      printHeaderNote: printHeaderNote == null && nullToAbsent
          ? const Value.absent()
          : Value(printHeaderNote),
      printFooterNote: printFooterNote == null && nullToAbsent
          ? const Value.absent()
          : Value(printFooterNote),
      status: status == null && nullToAbsent
          ? const Value.absent()
          : Value(status),
      privs: privs == null && nullToAbsent
          ? const Value.absent()
          : Value(privs),
      accountKeys: accountKeys == null && nullToAbsent
          ? const Value.absent()
          : Value(accountKeys),
      createdAt: Value(createdAt),
      updatedAt: Value(updatedAt),
    );
  }

  factory User.fromJson(
    Map<String, dynamic> json, {
    ValueSerializer? serializer,
  }) {
    serializer ??= driftRuntimeOptions.defaultSerializer;
    return User(
      id: serializer.fromJson<int>(json['id']),
      firebaseUid: serializer.fromJson<String?>(json['firebaseUid']),
      number: serializer.fromJson<String>(json['number']),
      businessName: serializer.fromJson<String>(json['businessName']),
      email: serializer.fromJson<String?>(json['email']),
      countryCode: serializer.fromJson<String>(json['countryCode']),
      mobile: serializer.fromJson<String>(json['mobile']),
      industryType: serializer.fromJson<String?>(json['industryType']),
      businessType: serializer.fromJson<String?>(json['businessType']),
      address: serializer.fromJson<String?>(json['address']),
      city: serializer.fromJson<String?>(json['city']),
      state: serializer.fromJson<String?>(json['state']),
      country: serializer.fromJson<String?>(json['country']),
      currency: serializer.fromJson<String?>(json['currency']),
      gst: serializer.fromJson<String?>(json['gst']),
      vat: serializer.fromJson<String?>(json['vat']),
      tax: serializer.fromJson<String?>(json['tax']),
      negative: serializer.fromJson<String?>(json['negative']),
      secondaryUnits: serializer.fromJson<String?>(json['secondaryUnits']),
      variants: serializer.fromJson<String?>(json['variants']),
      barcode: serializer.fromJson<String?>(json['barcode']),
      logo: serializer.fromJson<String?>(json['logo']),
      salesmanCommission: serializer.fromJson<String?>(
        json['salesmanCommission'],
      ),
      agentCommission: serializer.fromJson<String?>(json['agentCommission']),
      printHeaderNote: serializer.fromJson<String?>(json['printHeaderNote']),
      printFooterNote: serializer.fromJson<String?>(json['printFooterNote']),
      status: serializer.fromJson<String?>(json['status']),
      privs: serializer.fromJson<String?>(json['privs']),
      accountKeys: serializer.fromJson<String?>(json['accountKeys']),
      createdAt: serializer.fromJson<DateTime>(json['createdAt']),
      updatedAt: serializer.fromJson<DateTime>(json['updatedAt']),
    );
  }
  @override
  Map<String, dynamic> toJson({ValueSerializer? serializer}) {
    serializer ??= driftRuntimeOptions.defaultSerializer;
    return <String, dynamic>{
      'id': serializer.toJson<int>(id),
      'firebaseUid': serializer.toJson<String?>(firebaseUid),
      'number': serializer.toJson<String>(number),
      'businessName': serializer.toJson<String>(businessName),
      'email': serializer.toJson<String?>(email),
      'countryCode': serializer.toJson<String>(countryCode),
      'mobile': serializer.toJson<String>(mobile),
      'industryType': serializer.toJson<String?>(industryType),
      'businessType': serializer.toJson<String?>(businessType),
      'address': serializer.toJson<String?>(address),
      'city': serializer.toJson<String?>(city),
      'state': serializer.toJson<String?>(state),
      'country': serializer.toJson<String?>(country),
      'currency': serializer.toJson<String?>(currency),
      'gst': serializer.toJson<String?>(gst),
      'vat': serializer.toJson<String?>(vat),
      'tax': serializer.toJson<String?>(tax),
      'negative': serializer.toJson<String?>(negative),
      'secondaryUnits': serializer.toJson<String?>(secondaryUnits),
      'variants': serializer.toJson<String?>(variants),
      'barcode': serializer.toJson<String?>(barcode),
      'logo': serializer.toJson<String?>(logo),
      'salesmanCommission': serializer.toJson<String?>(salesmanCommission),
      'agentCommission': serializer.toJson<String?>(agentCommission),
      'printHeaderNote': serializer.toJson<String?>(printHeaderNote),
      'printFooterNote': serializer.toJson<String?>(printFooterNote),
      'status': serializer.toJson<String?>(status),
      'privs': serializer.toJson<String?>(privs),
      'accountKeys': serializer.toJson<String?>(accountKeys),
      'createdAt': serializer.toJson<DateTime>(createdAt),
      'updatedAt': serializer.toJson<DateTime>(updatedAt),
    };
  }

  User copyWith({
    int? id,
    Value<String?> firebaseUid = const Value.absent(),
    String? number,
    String? businessName,
    Value<String?> email = const Value.absent(),
    String? countryCode,
    String? mobile,
    Value<String?> industryType = const Value.absent(),
    Value<String?> businessType = const Value.absent(),
    Value<String?> address = const Value.absent(),
    Value<String?> city = const Value.absent(),
    Value<String?> state = const Value.absent(),
    Value<String?> country = const Value.absent(),
    Value<String?> currency = const Value.absent(),
    Value<String?> gst = const Value.absent(),
    Value<String?> vat = const Value.absent(),
    Value<String?> tax = const Value.absent(),
    Value<String?> negative = const Value.absent(),
    Value<String?> secondaryUnits = const Value.absent(),
    Value<String?> variants = const Value.absent(),
    Value<String?> barcode = const Value.absent(),
    Value<String?> logo = const Value.absent(),
    Value<String?> salesmanCommission = const Value.absent(),
    Value<String?> agentCommission = const Value.absent(),
    Value<String?> printHeaderNote = const Value.absent(),
    Value<String?> printFooterNote = const Value.absent(),
    Value<String?> status = const Value.absent(),
    Value<String?> privs = const Value.absent(),
    Value<String?> accountKeys = const Value.absent(),
    DateTime? createdAt,
    DateTime? updatedAt,
  }) => User(
    id: id ?? this.id,
    firebaseUid: firebaseUid.present ? firebaseUid.value : this.firebaseUid,
    number: number ?? this.number,
    businessName: businessName ?? this.businessName,
    email: email.present ? email.value : this.email,
    countryCode: countryCode ?? this.countryCode,
    mobile: mobile ?? this.mobile,
    industryType: industryType.present ? industryType.value : this.industryType,
    businessType: businessType.present ? businessType.value : this.businessType,
    address: address.present ? address.value : this.address,
    city: city.present ? city.value : this.city,
    state: state.present ? state.value : this.state,
    country: country.present ? country.value : this.country,
    currency: currency.present ? currency.value : this.currency,
    gst: gst.present ? gst.value : this.gst,
    vat: vat.present ? vat.value : this.vat,
    tax: tax.present ? tax.value : this.tax,
    negative: negative.present ? negative.value : this.negative,
    secondaryUnits: secondaryUnits.present
        ? secondaryUnits.value
        : this.secondaryUnits,
    variants: variants.present ? variants.value : this.variants,
    barcode: barcode.present ? barcode.value : this.barcode,
    logo: logo.present ? logo.value : this.logo,
    salesmanCommission: salesmanCommission.present
        ? salesmanCommission.value
        : this.salesmanCommission,
    agentCommission: agentCommission.present
        ? agentCommission.value
        : this.agentCommission,
    printHeaderNote: printHeaderNote.present
        ? printHeaderNote.value
        : this.printHeaderNote,
    printFooterNote: printFooterNote.present
        ? printFooterNote.value
        : this.printFooterNote,
    status: status.present ? status.value : this.status,
    privs: privs.present ? privs.value : this.privs,
    accountKeys: accountKeys.present ? accountKeys.value : this.accountKeys,
    createdAt: createdAt ?? this.createdAt,
    updatedAt: updatedAt ?? this.updatedAt,
  );
  User copyWithCompanion(UsersCompanion data) {
    return User(
      id: data.id.present ? data.id.value : this.id,
      firebaseUid: data.firebaseUid.present
          ? data.firebaseUid.value
          : this.firebaseUid,
      number: data.number.present ? data.number.value : this.number,
      businessName: data.businessName.present
          ? data.businessName.value
          : this.businessName,
      email: data.email.present ? data.email.value : this.email,
      countryCode: data.countryCode.present
          ? data.countryCode.value
          : this.countryCode,
      mobile: data.mobile.present ? data.mobile.value : this.mobile,
      industryType: data.industryType.present
          ? data.industryType.value
          : this.industryType,
      businessType: data.businessType.present
          ? data.businessType.value
          : this.businessType,
      address: data.address.present ? data.address.value : this.address,
      city: data.city.present ? data.city.value : this.city,
      state: data.state.present ? data.state.value : this.state,
      country: data.country.present ? data.country.value : this.country,
      currency: data.currency.present ? data.currency.value : this.currency,
      gst: data.gst.present ? data.gst.value : this.gst,
      vat: data.vat.present ? data.vat.value : this.vat,
      tax: data.tax.present ? data.tax.value : this.tax,
      negative: data.negative.present ? data.negative.value : this.negative,
      secondaryUnits: data.secondaryUnits.present
          ? data.secondaryUnits.value
          : this.secondaryUnits,
      variants: data.variants.present ? data.variants.value : this.variants,
      barcode: data.barcode.present ? data.barcode.value : this.barcode,
      logo: data.logo.present ? data.logo.value : this.logo,
      salesmanCommission: data.salesmanCommission.present
          ? data.salesmanCommission.value
          : this.salesmanCommission,
      agentCommission: data.agentCommission.present
          ? data.agentCommission.value
          : this.agentCommission,
      printHeaderNote: data.printHeaderNote.present
          ? data.printHeaderNote.value
          : this.printHeaderNote,
      printFooterNote: data.printFooterNote.present
          ? data.printFooterNote.value
          : this.printFooterNote,
      status: data.status.present ? data.status.value : this.status,
      privs: data.privs.present ? data.privs.value : this.privs,
      accountKeys: data.accountKeys.present
          ? data.accountKeys.value
          : this.accountKeys,
      createdAt: data.createdAt.present ? data.createdAt.value : this.createdAt,
      updatedAt: data.updatedAt.present ? data.updatedAt.value : this.updatedAt,
    );
  }

  @override
  String toString() {
    return (StringBuffer('User(')
          ..write('id: $id, ')
          ..write('firebaseUid: $firebaseUid, ')
          ..write('number: $number, ')
          ..write('businessName: $businessName, ')
          ..write('email: $email, ')
          ..write('countryCode: $countryCode, ')
          ..write('mobile: $mobile, ')
          ..write('industryType: $industryType, ')
          ..write('businessType: $businessType, ')
          ..write('address: $address, ')
          ..write('city: $city, ')
          ..write('state: $state, ')
          ..write('country: $country, ')
          ..write('currency: $currency, ')
          ..write('gst: $gst, ')
          ..write('vat: $vat, ')
          ..write('tax: $tax, ')
          ..write('negative: $negative, ')
          ..write('secondaryUnits: $secondaryUnits, ')
          ..write('variants: $variants, ')
          ..write('barcode: $barcode, ')
          ..write('logo: $logo, ')
          ..write('salesmanCommission: $salesmanCommission, ')
          ..write('agentCommission: $agentCommission, ')
          ..write('printHeaderNote: $printHeaderNote, ')
          ..write('printFooterNote: $printFooterNote, ')
          ..write('status: $status, ')
          ..write('privs: $privs, ')
          ..write('accountKeys: $accountKeys, ')
          ..write('createdAt: $createdAt, ')
          ..write('updatedAt: $updatedAt')
          ..write(')'))
        .toString();
  }

  @override
  int get hashCode => Object.hashAll([
    id,
    firebaseUid,
    number,
    businessName,
    email,
    countryCode,
    mobile,
    industryType,
    businessType,
    address,
    city,
    state,
    country,
    currency,
    gst,
    vat,
    tax,
    negative,
    secondaryUnits,
    variants,
    barcode,
    logo,
    salesmanCommission,
    agentCommission,
    printHeaderNote,
    printFooterNote,
    status,
    privs,
    accountKeys,
    createdAt,
    updatedAt,
  ]);
  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      (other is User &&
          other.id == this.id &&
          other.firebaseUid == this.firebaseUid &&
          other.number == this.number &&
          other.businessName == this.businessName &&
          other.email == this.email &&
          other.countryCode == this.countryCode &&
          other.mobile == this.mobile &&
          other.industryType == this.industryType &&
          other.businessType == this.businessType &&
          other.address == this.address &&
          other.city == this.city &&
          other.state == this.state &&
          other.country == this.country &&
          other.currency == this.currency &&
          other.gst == this.gst &&
          other.vat == this.vat &&
          other.tax == this.tax &&
          other.negative == this.negative &&
          other.secondaryUnits == this.secondaryUnits &&
          other.variants == this.variants &&
          other.barcode == this.barcode &&
          other.logo == this.logo &&
          other.salesmanCommission == this.salesmanCommission &&
          other.agentCommission == this.agentCommission &&
          other.printHeaderNote == this.printHeaderNote &&
          other.printFooterNote == this.printFooterNote &&
          other.status == this.status &&
          other.privs == this.privs &&
          other.accountKeys == this.accountKeys &&
          other.createdAt == this.createdAt &&
          other.updatedAt == this.updatedAt);
}

class UsersCompanion extends UpdateCompanion<User> {
  final Value<int> id;
  final Value<String?> firebaseUid;
  final Value<String> number;
  final Value<String> businessName;
  final Value<String?> email;
  final Value<String> countryCode;
  final Value<String> mobile;
  final Value<String?> industryType;
  final Value<String?> businessType;
  final Value<String?> address;
  final Value<String?> city;
  final Value<String?> state;
  final Value<String?> country;
  final Value<String?> currency;
  final Value<String?> gst;
  final Value<String?> vat;
  final Value<String?> tax;
  final Value<String?> negative;
  final Value<String?> secondaryUnits;
  final Value<String?> variants;
  final Value<String?> barcode;
  final Value<String?> logo;
  final Value<String?> salesmanCommission;
  final Value<String?> agentCommission;
  final Value<String?> printHeaderNote;
  final Value<String?> printFooterNote;
  final Value<String?> status;
  final Value<String?> privs;
  final Value<String?> accountKeys;
  final Value<DateTime> createdAt;
  final Value<DateTime> updatedAt;
  const UsersCompanion({
    this.id = const Value.absent(),
    this.firebaseUid = const Value.absent(),
    this.number = const Value.absent(),
    this.businessName = const Value.absent(),
    this.email = const Value.absent(),
    this.countryCode = const Value.absent(),
    this.mobile = const Value.absent(),
    this.industryType = const Value.absent(),
    this.businessType = const Value.absent(),
    this.address = const Value.absent(),
    this.city = const Value.absent(),
    this.state = const Value.absent(),
    this.country = const Value.absent(),
    this.currency = const Value.absent(),
    this.gst = const Value.absent(),
    this.vat = const Value.absent(),
    this.tax = const Value.absent(),
    this.negative = const Value.absent(),
    this.secondaryUnits = const Value.absent(),
    this.variants = const Value.absent(),
    this.barcode = const Value.absent(),
    this.logo = const Value.absent(),
    this.salesmanCommission = const Value.absent(),
    this.agentCommission = const Value.absent(),
    this.printHeaderNote = const Value.absent(),
    this.printFooterNote = const Value.absent(),
    this.status = const Value.absent(),
    this.privs = const Value.absent(),
    this.accountKeys = const Value.absent(),
    this.createdAt = const Value.absent(),
    this.updatedAt = const Value.absent(),
  });
  UsersCompanion.insert({
    this.id = const Value.absent(),
    this.firebaseUid = const Value.absent(),
    required String number,
    required String businessName,
    this.email = const Value.absent(),
    required String countryCode,
    required String mobile,
    this.industryType = const Value.absent(),
    this.businessType = const Value.absent(),
    this.address = const Value.absent(),
    this.city = const Value.absent(),
    this.state = const Value.absent(),
    this.country = const Value.absent(),
    this.currency = const Value.absent(),
    this.gst = const Value.absent(),
    this.vat = const Value.absent(),
    this.tax = const Value.absent(),
    this.negative = const Value.absent(),
    this.secondaryUnits = const Value.absent(),
    this.variants = const Value.absent(),
    this.barcode = const Value.absent(),
    this.logo = const Value.absent(),
    this.salesmanCommission = const Value.absent(),
    this.agentCommission = const Value.absent(),
    this.printHeaderNote = const Value.absent(),
    this.printFooterNote = const Value.absent(),
    this.status = const Value.absent(),
    this.privs = const Value.absent(),
    this.accountKeys = const Value.absent(),
    this.createdAt = const Value.absent(),
    this.updatedAt = const Value.absent(),
  }) : number = Value(number),
       businessName = Value(businessName),
       countryCode = Value(countryCode),
       mobile = Value(mobile);
  static Insertable<User> custom({
    Expression<int>? id,
    Expression<String>? firebaseUid,
    Expression<String>? number,
    Expression<String>? businessName,
    Expression<String>? email,
    Expression<String>? countryCode,
    Expression<String>? mobile,
    Expression<String>? industryType,
    Expression<String>? businessType,
    Expression<String>? address,
    Expression<String>? city,
    Expression<String>? state,
    Expression<String>? country,
    Expression<String>? currency,
    Expression<String>? gst,
    Expression<String>? vat,
    Expression<String>? tax,
    Expression<String>? negative,
    Expression<String>? secondaryUnits,
    Expression<String>? variants,
    Expression<String>? barcode,
    Expression<String>? logo,
    Expression<String>? salesmanCommission,
    Expression<String>? agentCommission,
    Expression<String>? printHeaderNote,
    Expression<String>? printFooterNote,
    Expression<String>? status,
    Expression<String>? privs,
    Expression<String>? accountKeys,
    Expression<DateTime>? createdAt,
    Expression<DateTime>? updatedAt,
  }) {
    return RawValuesInsertable({
      if (id != null) 'id': id,
      if (firebaseUid != null) 'firebase_uid': firebaseUid,
      if (number != null) 'number': number,
      if (businessName != null) 'business_name': businessName,
      if (email != null) 'email': email,
      if (countryCode != null) 'country_code': countryCode,
      if (mobile != null) 'mobile': mobile,
      if (industryType != null) 'industry_type': industryType,
      if (businessType != null) 'business_type': businessType,
      if (address != null) 'address': address,
      if (city != null) 'city': city,
      if (state != null) 'state': state,
      if (country != null) 'country': country,
      if (currency != null) 'currency': currency,
      if (gst != null) 'gst': gst,
      if (vat != null) 'vat': vat,
      if (tax != null) 'tax': tax,
      if (negative != null) 'negative': negative,
      if (secondaryUnits != null) 'secondary_units': secondaryUnits,
      if (variants != null) 'variants': variants,
      if (barcode != null) 'barcode': barcode,
      if (logo != null) 'logo': logo,
      if (salesmanCommission != null) 'salesman_commission': salesmanCommission,
      if (agentCommission != null) 'agent_commission': agentCommission,
      if (printHeaderNote != null) 'print_header_note': printHeaderNote,
      if (printFooterNote != null) 'print_footer_note': printFooterNote,
      if (status != null) 'status': status,
      if (privs != null) 'privs': privs,
      if (accountKeys != null) 'account_keys': accountKeys,
      if (createdAt != null) 'created_at': createdAt,
      if (updatedAt != null) 'updated_at': updatedAt,
    });
  }

  UsersCompanion copyWith({
    Value<int>? id,
    Value<String?>? firebaseUid,
    Value<String>? number,
    Value<String>? businessName,
    Value<String?>? email,
    Value<String>? countryCode,
    Value<String>? mobile,
    Value<String?>? industryType,
    Value<String?>? businessType,
    Value<String?>? address,
    Value<String?>? city,
    Value<String?>? state,
    Value<String?>? country,
    Value<String?>? currency,
    Value<String?>? gst,
    Value<String?>? vat,
    Value<String?>? tax,
    Value<String?>? negative,
    Value<String?>? secondaryUnits,
    Value<String?>? variants,
    Value<String?>? barcode,
    Value<String?>? logo,
    Value<String?>? salesmanCommission,
    Value<String?>? agentCommission,
    Value<String?>? printHeaderNote,
    Value<String?>? printFooterNote,
    Value<String?>? status,
    Value<String?>? privs,
    Value<String?>? accountKeys,
    Value<DateTime>? createdAt,
    Value<DateTime>? updatedAt,
  }) {
    return UsersCompanion(
      id: id ?? this.id,
      firebaseUid: firebaseUid ?? this.firebaseUid,
      number: number ?? this.number,
      businessName: businessName ?? this.businessName,
      email: email ?? this.email,
      countryCode: countryCode ?? this.countryCode,
      mobile: mobile ?? this.mobile,
      industryType: industryType ?? this.industryType,
      businessType: businessType ?? this.businessType,
      address: address ?? this.address,
      city: city ?? this.city,
      state: state ?? this.state,
      country: country ?? this.country,
      currency: currency ?? this.currency,
      gst: gst ?? this.gst,
      vat: vat ?? this.vat,
      tax: tax ?? this.tax,
      negative: negative ?? this.negative,
      secondaryUnits: secondaryUnits ?? this.secondaryUnits,
      variants: variants ?? this.variants,
      barcode: barcode ?? this.barcode,
      logo: logo ?? this.logo,
      salesmanCommission: salesmanCommission ?? this.salesmanCommission,
      agentCommission: agentCommission ?? this.agentCommission,
      printHeaderNote: printHeaderNote ?? this.printHeaderNote,
      printFooterNote: printFooterNote ?? this.printFooterNote,
      status: status ?? this.status,
      privs: privs ?? this.privs,
      accountKeys: accountKeys ?? this.accountKeys,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
    );
  }

  @override
  Map<String, Expression> toColumns(bool nullToAbsent) {
    final map = <String, Expression>{};
    if (id.present) {
      map['id'] = Variable<int>(id.value);
    }
    if (firebaseUid.present) {
      map['firebase_uid'] = Variable<String>(firebaseUid.value);
    }
    if (number.present) {
      map['number'] = Variable<String>(number.value);
    }
    if (businessName.present) {
      map['business_name'] = Variable<String>(businessName.value);
    }
    if (email.present) {
      map['email'] = Variable<String>(email.value);
    }
    if (countryCode.present) {
      map['country_code'] = Variable<String>(countryCode.value);
    }
    if (mobile.present) {
      map['mobile'] = Variable<String>(mobile.value);
    }
    if (industryType.present) {
      map['industry_type'] = Variable<String>(industryType.value);
    }
    if (businessType.present) {
      map['business_type'] = Variable<String>(businessType.value);
    }
    if (address.present) {
      map['address'] = Variable<String>(address.value);
    }
    if (city.present) {
      map['city'] = Variable<String>(city.value);
    }
    if (state.present) {
      map['state'] = Variable<String>(state.value);
    }
    if (country.present) {
      map['country'] = Variable<String>(country.value);
    }
    if (currency.present) {
      map['currency'] = Variable<String>(currency.value);
    }
    if (gst.present) {
      map['gst'] = Variable<String>(gst.value);
    }
    if (vat.present) {
      map['vat'] = Variable<String>(vat.value);
    }
    if (tax.present) {
      map['tax'] = Variable<String>(tax.value);
    }
    if (negative.present) {
      map['negative'] = Variable<String>(negative.value);
    }
    if (secondaryUnits.present) {
      map['secondary_units'] = Variable<String>(secondaryUnits.value);
    }
    if (variants.present) {
      map['variants'] = Variable<String>(variants.value);
    }
    if (barcode.present) {
      map['barcode'] = Variable<String>(barcode.value);
    }
    if (logo.present) {
      map['logo'] = Variable<String>(logo.value);
    }
    if (salesmanCommission.present) {
      map['salesman_commission'] = Variable<String>(salesmanCommission.value);
    }
    if (agentCommission.present) {
      map['agent_commission'] = Variable<String>(agentCommission.value);
    }
    if (printHeaderNote.present) {
      map['print_header_note'] = Variable<String>(printHeaderNote.value);
    }
    if (printFooterNote.present) {
      map['print_footer_note'] = Variable<String>(printFooterNote.value);
    }
    if (status.present) {
      map['status'] = Variable<String>(status.value);
    }
    if (privs.present) {
      map['privs'] = Variable<String>(privs.value);
    }
    if (accountKeys.present) {
      map['account_keys'] = Variable<String>(accountKeys.value);
    }
    if (createdAt.present) {
      map['created_at'] = Variable<DateTime>(createdAt.value);
    }
    if (updatedAt.present) {
      map['updated_at'] = Variable<DateTime>(updatedAt.value);
    }
    return map;
  }

  @override
  String toString() {
    return (StringBuffer('UsersCompanion(')
          ..write('id: $id, ')
          ..write('firebaseUid: $firebaseUid, ')
          ..write('number: $number, ')
          ..write('businessName: $businessName, ')
          ..write('email: $email, ')
          ..write('countryCode: $countryCode, ')
          ..write('mobile: $mobile, ')
          ..write('industryType: $industryType, ')
          ..write('businessType: $businessType, ')
          ..write('address: $address, ')
          ..write('city: $city, ')
          ..write('state: $state, ')
          ..write('country: $country, ')
          ..write('currency: $currency, ')
          ..write('gst: $gst, ')
          ..write('vat: $vat, ')
          ..write('tax: $tax, ')
          ..write('negative: $negative, ')
          ..write('secondaryUnits: $secondaryUnits, ')
          ..write('variants: $variants, ')
          ..write('barcode: $barcode, ')
          ..write('logo: $logo, ')
          ..write('salesmanCommission: $salesmanCommission, ')
          ..write('agentCommission: $agentCommission, ')
          ..write('printHeaderNote: $printHeaderNote, ')
          ..write('printFooterNote: $printFooterNote, ')
          ..write('status: $status, ')
          ..write('privs: $privs, ')
          ..write('accountKeys: $accountKeys, ')
          ..write('createdAt: $createdAt, ')
          ..write('updatedAt: $updatedAt')
          ..write(')'))
        .toString();
  }
}

class $SessionsTable extends Sessions with TableInfo<$SessionsTable, Session> {
  @override
  final GeneratedDatabase attachedDatabase;
  final String? _alias;
  $SessionsTable(this.attachedDatabase, [this._alias]);
  static const VerificationMeta _idMeta = const VerificationMeta('id');
  @override
  late final GeneratedColumn<int> id = GeneratedColumn<int>(
    'id',
    aliasedName,
    false,
    hasAutoIncrement: true,
    type: DriftSqlType.int,
    requiredDuringInsert: false,
    defaultConstraints: GeneratedColumn.constraintIsAlways(
      'PRIMARY KEY AUTOINCREMENT',
    ),
  );
  static const VerificationMeta _userIdMeta = const VerificationMeta('userId');
  @override
  late final GeneratedColumn<int> userId = GeneratedColumn<int>(
    'user_id',
    aliasedName,
    false,
    type: DriftSqlType.int,
    requiredDuringInsert: true,
    defaultConstraints: GeneratedColumn.constraintIsAlways(
      'REFERENCES users (id) ON DELETE CASCADE',
    ),
  );
  static const VerificationMeta _tokenMeta = const VerificationMeta('token');
  @override
  late final GeneratedColumn<String> token = GeneratedColumn<String>(
    'token',
    aliasedName,
    true,
    type: DriftSqlType.string,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _loggedInAtMeta = const VerificationMeta(
    'loggedInAt',
  );
  @override
  late final GeneratedColumn<DateTime> loggedInAt = GeneratedColumn<DateTime>(
    'logged_in_at',
    aliasedName,
    false,
    type: DriftSqlType.dateTime,
    requiredDuringInsert: false,
    defaultValue: currentDateAndTime,
  );
  static const VerificationMeta _expiresAtMeta = const VerificationMeta(
    'expiresAt',
  );
  @override
  late final GeneratedColumn<DateTime> expiresAt = GeneratedColumn<DateTime>(
    'expires_at',
    aliasedName,
    true,
    type: DriftSqlType.dateTime,
    requiredDuringInsert: false,
  );
  static const VerificationMeta _isActiveMeta = const VerificationMeta(
    'isActive',
  );
  @override
  late final GeneratedColumn<bool> isActive = GeneratedColumn<bool>(
    'is_active',
    aliasedName,
    false,
    type: DriftSqlType.bool,
    requiredDuringInsert: false,
    defaultConstraints: GeneratedColumn.constraintIsAlways(
      'CHECK ("is_active" IN (0, 1))',
    ),
    defaultValue: const Constant(true),
  );
  @override
  List<GeneratedColumn> get $columns => [
    id,
    userId,
    token,
    loggedInAt,
    expiresAt,
    isActive,
  ];
  @override
  String get aliasedName => _alias ?? actualTableName;
  @override
  String get actualTableName => $name;
  static const String $name = 'sessions';
  @override
  VerificationContext validateIntegrity(
    Insertable<Session> instance, {
    bool isInserting = false,
  }) {
    final context = VerificationContext();
    final data = instance.toColumns(true);
    if (data.containsKey('id')) {
      context.handle(_idMeta, id.isAcceptableOrUnknown(data['id']!, _idMeta));
    }
    if (data.containsKey('user_id')) {
      context.handle(
        _userIdMeta,
        userId.isAcceptableOrUnknown(data['user_id']!, _userIdMeta),
      );
    } else if (isInserting) {
      context.missing(_userIdMeta);
    }
    if (data.containsKey('token')) {
      context.handle(
        _tokenMeta,
        token.isAcceptableOrUnknown(data['token']!, _tokenMeta),
      );
    }
    if (data.containsKey('logged_in_at')) {
      context.handle(
        _loggedInAtMeta,
        loggedInAt.isAcceptableOrUnknown(
          data['logged_in_at']!,
          _loggedInAtMeta,
        ),
      );
    }
    if (data.containsKey('expires_at')) {
      context.handle(
        _expiresAtMeta,
        expiresAt.isAcceptableOrUnknown(data['expires_at']!, _expiresAtMeta),
      );
    }
    if (data.containsKey('is_active')) {
      context.handle(
        _isActiveMeta,
        isActive.isAcceptableOrUnknown(data['is_active']!, _isActiveMeta),
      );
    }
    return context;
  }

  @override
  Set<GeneratedColumn> get $primaryKey => {id};
  @override
  Session map(Map<String, dynamic> data, {String? tablePrefix}) {
    final effectivePrefix = tablePrefix != null ? '$tablePrefix.' : '';
    return Session(
      id: attachedDatabase.typeMapping.read(
        DriftSqlType.int,
        data['${effectivePrefix}id'],
      )!,
      userId: attachedDatabase.typeMapping.read(
        DriftSqlType.int,
        data['${effectivePrefix}user_id'],
      )!,
      token: attachedDatabase.typeMapping.read(
        DriftSqlType.string,
        data['${effectivePrefix}token'],
      ),
      loggedInAt: attachedDatabase.typeMapping.read(
        DriftSqlType.dateTime,
        data['${effectivePrefix}logged_in_at'],
      )!,
      expiresAt: attachedDatabase.typeMapping.read(
        DriftSqlType.dateTime,
        data['${effectivePrefix}expires_at'],
      ),
      isActive: attachedDatabase.typeMapping.read(
        DriftSqlType.bool,
        data['${effectivePrefix}is_active'],
      )!,
    );
  }

  @override
  $SessionsTable createAlias(String alias) {
    return $SessionsTable(attachedDatabase, alias);
  }
}

class Session extends DataClass implements Insertable<Session> {
  final int id;
  final int userId;
  final String? token;
  final DateTime loggedInAt;
  final DateTime? expiresAt;
  final bool isActive;
  const Session({
    required this.id,
    required this.userId,
    this.token,
    required this.loggedInAt,
    this.expiresAt,
    required this.isActive,
  });
  @override
  Map<String, Expression> toColumns(bool nullToAbsent) {
    final map = <String, Expression>{};
    map['id'] = Variable<int>(id);
    map['user_id'] = Variable<int>(userId);
    if (!nullToAbsent || token != null) {
      map['token'] = Variable<String>(token);
    }
    map['logged_in_at'] = Variable<DateTime>(loggedInAt);
    if (!nullToAbsent || expiresAt != null) {
      map['expires_at'] = Variable<DateTime>(expiresAt);
    }
    map['is_active'] = Variable<bool>(isActive);
    return map;
  }

  SessionsCompanion toCompanion(bool nullToAbsent) {
    return SessionsCompanion(
      id: Value(id),
      userId: Value(userId),
      token: token == null && nullToAbsent
          ? const Value.absent()
          : Value(token),
      loggedInAt: Value(loggedInAt),
      expiresAt: expiresAt == null && nullToAbsent
          ? const Value.absent()
          : Value(expiresAt),
      isActive: Value(isActive),
    );
  }

  factory Session.fromJson(
    Map<String, dynamic> json, {
    ValueSerializer? serializer,
  }) {
    serializer ??= driftRuntimeOptions.defaultSerializer;
    return Session(
      id: serializer.fromJson<int>(json['id']),
      userId: serializer.fromJson<int>(json['userId']),
      token: serializer.fromJson<String?>(json['token']),
      loggedInAt: serializer.fromJson<DateTime>(json['loggedInAt']),
      expiresAt: serializer.fromJson<DateTime?>(json['expiresAt']),
      isActive: serializer.fromJson<bool>(json['isActive']),
    );
  }
  @override
  Map<String, dynamic> toJson({ValueSerializer? serializer}) {
    serializer ??= driftRuntimeOptions.defaultSerializer;
    return <String, dynamic>{
      'id': serializer.toJson<int>(id),
      'userId': serializer.toJson<int>(userId),
      'token': serializer.toJson<String?>(token),
      'loggedInAt': serializer.toJson<DateTime>(loggedInAt),
      'expiresAt': serializer.toJson<DateTime?>(expiresAt),
      'isActive': serializer.toJson<bool>(isActive),
    };
  }

  Session copyWith({
    int? id,
    int? userId,
    Value<String?> token = const Value.absent(),
    DateTime? loggedInAt,
    Value<DateTime?> expiresAt = const Value.absent(),
    bool? isActive,
  }) => Session(
    id: id ?? this.id,
    userId: userId ?? this.userId,
    token: token.present ? token.value : this.token,
    loggedInAt: loggedInAt ?? this.loggedInAt,
    expiresAt: expiresAt.present ? expiresAt.value : this.expiresAt,
    isActive: isActive ?? this.isActive,
  );
  Session copyWithCompanion(SessionsCompanion data) {
    return Session(
      id: data.id.present ? data.id.value : this.id,
      userId: data.userId.present ? data.userId.value : this.userId,
      token: data.token.present ? data.token.value : this.token,
      loggedInAt: data.loggedInAt.present
          ? data.loggedInAt.value
          : this.loggedInAt,
      expiresAt: data.expiresAt.present ? data.expiresAt.value : this.expiresAt,
      isActive: data.isActive.present ? data.isActive.value : this.isActive,
    );
  }

  @override
  String toString() {
    return (StringBuffer('Session(')
          ..write('id: $id, ')
          ..write('userId: $userId, ')
          ..write('token: $token, ')
          ..write('loggedInAt: $loggedInAt, ')
          ..write('expiresAt: $expiresAt, ')
          ..write('isActive: $isActive')
          ..write(')'))
        .toString();
  }

  @override
  int get hashCode =>
      Object.hash(id, userId, token, loggedInAt, expiresAt, isActive);
  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      (other is Session &&
          other.id == this.id &&
          other.userId == this.userId &&
          other.token == this.token &&
          other.loggedInAt == this.loggedInAt &&
          other.expiresAt == this.expiresAt &&
          other.isActive == this.isActive);
}

class SessionsCompanion extends UpdateCompanion<Session> {
  final Value<int> id;
  final Value<int> userId;
  final Value<String?> token;
  final Value<DateTime> loggedInAt;
  final Value<DateTime?> expiresAt;
  final Value<bool> isActive;
  const SessionsCompanion({
    this.id = const Value.absent(),
    this.userId = const Value.absent(),
    this.token = const Value.absent(),
    this.loggedInAt = const Value.absent(),
    this.expiresAt = const Value.absent(),
    this.isActive = const Value.absent(),
  });
  SessionsCompanion.insert({
    this.id = const Value.absent(),
    required int userId,
    this.token = const Value.absent(),
    this.loggedInAt = const Value.absent(),
    this.expiresAt = const Value.absent(),
    this.isActive = const Value.absent(),
  }) : userId = Value(userId);
  static Insertable<Session> custom({
    Expression<int>? id,
    Expression<int>? userId,
    Expression<String>? token,
    Expression<DateTime>? loggedInAt,
    Expression<DateTime>? expiresAt,
    Expression<bool>? isActive,
  }) {
    return RawValuesInsertable({
      if (id != null) 'id': id,
      if (userId != null) 'user_id': userId,
      if (token != null) 'token': token,
      if (loggedInAt != null) 'logged_in_at': loggedInAt,
      if (expiresAt != null) 'expires_at': expiresAt,
      if (isActive != null) 'is_active': isActive,
    });
  }

  SessionsCompanion copyWith({
    Value<int>? id,
    Value<int>? userId,
    Value<String?>? token,
    Value<DateTime>? loggedInAt,
    Value<DateTime?>? expiresAt,
    Value<bool>? isActive,
  }) {
    return SessionsCompanion(
      id: id ?? this.id,
      userId: userId ?? this.userId,
      token: token ?? this.token,
      loggedInAt: loggedInAt ?? this.loggedInAt,
      expiresAt: expiresAt ?? this.expiresAt,
      isActive: isActive ?? this.isActive,
    );
  }

  @override
  Map<String, Expression> toColumns(bool nullToAbsent) {
    final map = <String, Expression>{};
    if (id.present) {
      map['id'] = Variable<int>(id.value);
    }
    if (userId.present) {
      map['user_id'] = Variable<int>(userId.value);
    }
    if (token.present) {
      map['token'] = Variable<String>(token.value);
    }
    if (loggedInAt.present) {
      map['logged_in_at'] = Variable<DateTime>(loggedInAt.value);
    }
    if (expiresAt.present) {
      map['expires_at'] = Variable<DateTime>(expiresAt.value);
    }
    if (isActive.present) {
      map['is_active'] = Variable<bool>(isActive.value);
    }
    return map;
  }

  @override
  String toString() {
    return (StringBuffer('SessionsCompanion(')
          ..write('id: $id, ')
          ..write('userId: $userId, ')
          ..write('token: $token, ')
          ..write('loggedInAt: $loggedInAt, ')
          ..write('expiresAt: $expiresAt, ')
          ..write('isActive: $isActive')
          ..write(')'))
        .toString();
  }
}

abstract class _$AppDatabase extends GeneratedDatabase {
  _$AppDatabase(QueryExecutor e) : super(e);
  $AppDatabaseManager get managers => $AppDatabaseManager(this);
  late final $UsersTable users = $UsersTable(this);
  late final $SessionsTable sessions = $SessionsTable(this);
  @override
  Iterable<TableInfo<Table, Object?>> get allTables =>
      allSchemaEntities.whereType<TableInfo<Table, Object?>>();
  @override
  List<DatabaseSchemaEntity> get allSchemaEntities => [users, sessions];
  @override
  StreamQueryUpdateRules get streamUpdateRules => const StreamQueryUpdateRules([
    WritePropagation(
      on: TableUpdateQuery.onTableName(
        'users',
        limitUpdateKind: UpdateKind.delete,
      ),
      result: [TableUpdate('sessions', kind: UpdateKind.delete)],
    ),
  ]);
}

typedef $$UsersTableCreateCompanionBuilder =
    UsersCompanion Function({
      Value<int> id,
      Value<String?> firebaseUid,
      required String number,
      required String businessName,
      Value<String?> email,
      required String countryCode,
      required String mobile,
      Value<String?> industryType,
      Value<String?> businessType,
      Value<String?> address,
      Value<String?> city,
      Value<String?> state,
      Value<String?> country,
      Value<String?> currency,
      Value<String?> gst,
      Value<String?> vat,
      Value<String?> tax,
      Value<String?> negative,
      Value<String?> secondaryUnits,
      Value<String?> variants,
      Value<String?> barcode,
      Value<String?> logo,
      Value<String?> salesmanCommission,
      Value<String?> agentCommission,
      Value<String?> printHeaderNote,
      Value<String?> printFooterNote,
      Value<String?> status,
      Value<String?> privs,
      Value<String?> accountKeys,
      Value<DateTime> createdAt,
      Value<DateTime> updatedAt,
    });
typedef $$UsersTableUpdateCompanionBuilder =
    UsersCompanion Function({
      Value<int> id,
      Value<String?> firebaseUid,
      Value<String> number,
      Value<String> businessName,
      Value<String?> email,
      Value<String> countryCode,
      Value<String> mobile,
      Value<String?> industryType,
      Value<String?> businessType,
      Value<String?> address,
      Value<String?> city,
      Value<String?> state,
      Value<String?> country,
      Value<String?> currency,
      Value<String?> gst,
      Value<String?> vat,
      Value<String?> tax,
      Value<String?> negative,
      Value<String?> secondaryUnits,
      Value<String?> variants,
      Value<String?> barcode,
      Value<String?> logo,
      Value<String?> salesmanCommission,
      Value<String?> agentCommission,
      Value<String?> printHeaderNote,
      Value<String?> printFooterNote,
      Value<String?> status,
      Value<String?> privs,
      Value<String?> accountKeys,
      Value<DateTime> createdAt,
      Value<DateTime> updatedAt,
    });

final class $$UsersTableReferences
    extends BaseReferences<_$AppDatabase, $UsersTable, User> {
  $$UsersTableReferences(super.$_db, super.$_table, super.$_typedResult);

  static MultiTypedResultKey<$SessionsTable, List<Session>> _sessionsRefsTable(
    _$AppDatabase db,
  ) => MultiTypedResultKey.fromTable(
    db.sessions,
    aliasName: $_aliasNameGenerator(db.users.id, db.sessions.userId),
  );

  $$SessionsTableProcessedTableManager get sessionsRefs {
    final manager = $$SessionsTableTableManager(
      $_db,
      $_db.sessions,
    ).filter((f) => f.userId.id.sqlEquals($_itemColumn<int>('id')!));

    final cache = $_typedResult.readTableOrNull(_sessionsRefsTable($_db));
    return ProcessedTableManager(
      manager.$state.copyWith(prefetchedData: cache),
    );
  }
}

class $$UsersTableFilterComposer extends Composer<_$AppDatabase, $UsersTable> {
  $$UsersTableFilterComposer({
    required super.$db,
    required super.$table,
    super.joinBuilder,
    super.$addJoinBuilderToRootComposer,
    super.$removeJoinBuilderFromRootComposer,
  });
  ColumnFilters<int> get id => $composableBuilder(
    column: $table.id,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get firebaseUid => $composableBuilder(
    column: $table.firebaseUid,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get number => $composableBuilder(
    column: $table.number,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get businessName => $composableBuilder(
    column: $table.businessName,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get email => $composableBuilder(
    column: $table.email,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get countryCode => $composableBuilder(
    column: $table.countryCode,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get mobile => $composableBuilder(
    column: $table.mobile,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get industryType => $composableBuilder(
    column: $table.industryType,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get businessType => $composableBuilder(
    column: $table.businessType,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get address => $composableBuilder(
    column: $table.address,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get city => $composableBuilder(
    column: $table.city,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get state => $composableBuilder(
    column: $table.state,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get country => $composableBuilder(
    column: $table.country,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get currency => $composableBuilder(
    column: $table.currency,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get gst => $composableBuilder(
    column: $table.gst,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get vat => $composableBuilder(
    column: $table.vat,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get tax => $composableBuilder(
    column: $table.tax,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get negative => $composableBuilder(
    column: $table.negative,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get secondaryUnits => $composableBuilder(
    column: $table.secondaryUnits,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get variants => $composableBuilder(
    column: $table.variants,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get barcode => $composableBuilder(
    column: $table.barcode,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get logo => $composableBuilder(
    column: $table.logo,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get salesmanCommission => $composableBuilder(
    column: $table.salesmanCommission,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get agentCommission => $composableBuilder(
    column: $table.agentCommission,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get printHeaderNote => $composableBuilder(
    column: $table.printHeaderNote,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get printFooterNote => $composableBuilder(
    column: $table.printFooterNote,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get status => $composableBuilder(
    column: $table.status,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get privs => $composableBuilder(
    column: $table.privs,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get accountKeys => $composableBuilder(
    column: $table.accountKeys,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<DateTime> get createdAt => $composableBuilder(
    column: $table.createdAt,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<DateTime> get updatedAt => $composableBuilder(
    column: $table.updatedAt,
    builder: (column) => ColumnFilters(column),
  );

  Expression<bool> sessionsRefs(
    Expression<bool> Function($$SessionsTableFilterComposer f) f,
  ) {
    final $$SessionsTableFilterComposer composer = $composerBuilder(
      composer: this,
      getCurrentColumn: (t) => t.id,
      referencedTable: $db.sessions,
      getReferencedColumn: (t) => t.userId,
      builder:
          (
            joinBuilder, {
            $addJoinBuilderToRootComposer,
            $removeJoinBuilderFromRootComposer,
          }) => $$SessionsTableFilterComposer(
            $db: $db,
            $table: $db.sessions,
            $addJoinBuilderToRootComposer: $addJoinBuilderToRootComposer,
            joinBuilder: joinBuilder,
            $removeJoinBuilderFromRootComposer:
                $removeJoinBuilderFromRootComposer,
          ),
    );
    return f(composer);
  }
}

class $$UsersTableOrderingComposer
    extends Composer<_$AppDatabase, $UsersTable> {
  $$UsersTableOrderingComposer({
    required super.$db,
    required super.$table,
    super.joinBuilder,
    super.$addJoinBuilderToRootComposer,
    super.$removeJoinBuilderFromRootComposer,
  });
  ColumnOrderings<int> get id => $composableBuilder(
    column: $table.id,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get firebaseUid => $composableBuilder(
    column: $table.firebaseUid,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get number => $composableBuilder(
    column: $table.number,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get businessName => $composableBuilder(
    column: $table.businessName,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get email => $composableBuilder(
    column: $table.email,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get countryCode => $composableBuilder(
    column: $table.countryCode,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get mobile => $composableBuilder(
    column: $table.mobile,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get industryType => $composableBuilder(
    column: $table.industryType,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get businessType => $composableBuilder(
    column: $table.businessType,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get address => $composableBuilder(
    column: $table.address,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get city => $composableBuilder(
    column: $table.city,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get state => $composableBuilder(
    column: $table.state,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get country => $composableBuilder(
    column: $table.country,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get currency => $composableBuilder(
    column: $table.currency,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get gst => $composableBuilder(
    column: $table.gst,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get vat => $composableBuilder(
    column: $table.vat,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get tax => $composableBuilder(
    column: $table.tax,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get negative => $composableBuilder(
    column: $table.negative,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get secondaryUnits => $composableBuilder(
    column: $table.secondaryUnits,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get variants => $composableBuilder(
    column: $table.variants,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get barcode => $composableBuilder(
    column: $table.barcode,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get logo => $composableBuilder(
    column: $table.logo,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get salesmanCommission => $composableBuilder(
    column: $table.salesmanCommission,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get agentCommission => $composableBuilder(
    column: $table.agentCommission,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get printHeaderNote => $composableBuilder(
    column: $table.printHeaderNote,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get printFooterNote => $composableBuilder(
    column: $table.printFooterNote,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get status => $composableBuilder(
    column: $table.status,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get privs => $composableBuilder(
    column: $table.privs,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get accountKeys => $composableBuilder(
    column: $table.accountKeys,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<DateTime> get createdAt => $composableBuilder(
    column: $table.createdAt,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<DateTime> get updatedAt => $composableBuilder(
    column: $table.updatedAt,
    builder: (column) => ColumnOrderings(column),
  );
}

class $$UsersTableAnnotationComposer
    extends Composer<_$AppDatabase, $UsersTable> {
  $$UsersTableAnnotationComposer({
    required super.$db,
    required super.$table,
    super.joinBuilder,
    super.$addJoinBuilderToRootComposer,
    super.$removeJoinBuilderFromRootComposer,
  });
  GeneratedColumn<int> get id =>
      $composableBuilder(column: $table.id, builder: (column) => column);

  GeneratedColumn<String> get firebaseUid => $composableBuilder(
    column: $table.firebaseUid,
    builder: (column) => column,
  );

  GeneratedColumn<String> get number =>
      $composableBuilder(column: $table.number, builder: (column) => column);

  GeneratedColumn<String> get businessName => $composableBuilder(
    column: $table.businessName,
    builder: (column) => column,
  );

  GeneratedColumn<String> get email =>
      $composableBuilder(column: $table.email, builder: (column) => column);

  GeneratedColumn<String> get countryCode => $composableBuilder(
    column: $table.countryCode,
    builder: (column) => column,
  );

  GeneratedColumn<String> get mobile =>
      $composableBuilder(column: $table.mobile, builder: (column) => column);

  GeneratedColumn<String> get industryType => $composableBuilder(
    column: $table.industryType,
    builder: (column) => column,
  );

  GeneratedColumn<String> get businessType => $composableBuilder(
    column: $table.businessType,
    builder: (column) => column,
  );

  GeneratedColumn<String> get address =>
      $composableBuilder(column: $table.address, builder: (column) => column);

  GeneratedColumn<String> get city =>
      $composableBuilder(column: $table.city, builder: (column) => column);

  GeneratedColumn<String> get state =>
      $composableBuilder(column: $table.state, builder: (column) => column);

  GeneratedColumn<String> get country =>
      $composableBuilder(column: $table.country, builder: (column) => column);

  GeneratedColumn<String> get currency =>
      $composableBuilder(column: $table.currency, builder: (column) => column);

  GeneratedColumn<String> get gst =>
      $composableBuilder(column: $table.gst, builder: (column) => column);

  GeneratedColumn<String> get vat =>
      $composableBuilder(column: $table.vat, builder: (column) => column);

  GeneratedColumn<String> get tax =>
      $composableBuilder(column: $table.tax, builder: (column) => column);

  GeneratedColumn<String> get negative =>
      $composableBuilder(column: $table.negative, builder: (column) => column);

  GeneratedColumn<String> get secondaryUnits => $composableBuilder(
    column: $table.secondaryUnits,
    builder: (column) => column,
  );

  GeneratedColumn<String> get variants =>
      $composableBuilder(column: $table.variants, builder: (column) => column);

  GeneratedColumn<String> get barcode =>
      $composableBuilder(column: $table.barcode, builder: (column) => column);

  GeneratedColumn<String> get logo =>
      $composableBuilder(column: $table.logo, builder: (column) => column);

  GeneratedColumn<String> get salesmanCommission => $composableBuilder(
    column: $table.salesmanCommission,
    builder: (column) => column,
  );

  GeneratedColumn<String> get agentCommission => $composableBuilder(
    column: $table.agentCommission,
    builder: (column) => column,
  );

  GeneratedColumn<String> get printHeaderNote => $composableBuilder(
    column: $table.printHeaderNote,
    builder: (column) => column,
  );

  GeneratedColumn<String> get printFooterNote => $composableBuilder(
    column: $table.printFooterNote,
    builder: (column) => column,
  );

  GeneratedColumn<String> get status =>
      $composableBuilder(column: $table.status, builder: (column) => column);

  GeneratedColumn<String> get privs =>
      $composableBuilder(column: $table.privs, builder: (column) => column);

  GeneratedColumn<String> get accountKeys => $composableBuilder(
    column: $table.accountKeys,
    builder: (column) => column,
  );

  GeneratedColumn<DateTime> get createdAt =>
      $composableBuilder(column: $table.createdAt, builder: (column) => column);

  GeneratedColumn<DateTime> get updatedAt =>
      $composableBuilder(column: $table.updatedAt, builder: (column) => column);

  Expression<T> sessionsRefs<T extends Object>(
    Expression<T> Function($$SessionsTableAnnotationComposer a) f,
  ) {
    final $$SessionsTableAnnotationComposer composer = $composerBuilder(
      composer: this,
      getCurrentColumn: (t) => t.id,
      referencedTable: $db.sessions,
      getReferencedColumn: (t) => t.userId,
      builder:
          (
            joinBuilder, {
            $addJoinBuilderToRootComposer,
            $removeJoinBuilderFromRootComposer,
          }) => $$SessionsTableAnnotationComposer(
            $db: $db,
            $table: $db.sessions,
            $addJoinBuilderToRootComposer: $addJoinBuilderToRootComposer,
            joinBuilder: joinBuilder,
            $removeJoinBuilderFromRootComposer:
                $removeJoinBuilderFromRootComposer,
          ),
    );
    return f(composer);
  }
}

class $$UsersTableTableManager
    extends
        RootTableManager<
          _$AppDatabase,
          $UsersTable,
          User,
          $$UsersTableFilterComposer,
          $$UsersTableOrderingComposer,
          $$UsersTableAnnotationComposer,
          $$UsersTableCreateCompanionBuilder,
          $$UsersTableUpdateCompanionBuilder,
          (User, $$UsersTableReferences),
          User,
          PrefetchHooks Function({bool sessionsRefs})
        > {
  $$UsersTableTableManager(_$AppDatabase db, $UsersTable table)
    : super(
        TableManagerState(
          db: db,
          table: table,
          createFilteringComposer: () =>
              $$UsersTableFilterComposer($db: db, $table: table),
          createOrderingComposer: () =>
              $$UsersTableOrderingComposer($db: db, $table: table),
          createComputedFieldComposer: () =>
              $$UsersTableAnnotationComposer($db: db, $table: table),
          updateCompanionCallback:
              ({
                Value<int> id = const Value.absent(),
                Value<String?> firebaseUid = const Value.absent(),
                Value<String> number = const Value.absent(),
                Value<String> businessName = const Value.absent(),
                Value<String?> email = const Value.absent(),
                Value<String> countryCode = const Value.absent(),
                Value<String> mobile = const Value.absent(),
                Value<String?> industryType = const Value.absent(),
                Value<String?> businessType = const Value.absent(),
                Value<String?> address = const Value.absent(),
                Value<String?> city = const Value.absent(),
                Value<String?> state = const Value.absent(),
                Value<String?> country = const Value.absent(),
                Value<String?> currency = const Value.absent(),
                Value<String?> gst = const Value.absent(),
                Value<String?> vat = const Value.absent(),
                Value<String?> tax = const Value.absent(),
                Value<String?> negative = const Value.absent(),
                Value<String?> secondaryUnits = const Value.absent(),
                Value<String?> variants = const Value.absent(),
                Value<String?> barcode = const Value.absent(),
                Value<String?> logo = const Value.absent(),
                Value<String?> salesmanCommission = const Value.absent(),
                Value<String?> agentCommission = const Value.absent(),
                Value<String?> printHeaderNote = const Value.absent(),
                Value<String?> printFooterNote = const Value.absent(),
                Value<String?> status = const Value.absent(),
                Value<String?> privs = const Value.absent(),
                Value<String?> accountKeys = const Value.absent(),
                Value<DateTime> createdAt = const Value.absent(),
                Value<DateTime> updatedAt = const Value.absent(),
              }) => UsersCompanion(
                id: id,
                firebaseUid: firebaseUid,
                number: number,
                businessName: businessName,
                email: email,
                countryCode: countryCode,
                mobile: mobile,
                industryType: industryType,
                businessType: businessType,
                address: address,
                city: city,
                state: state,
                country: country,
                currency: currency,
                gst: gst,
                vat: vat,
                tax: tax,
                negative: negative,
                secondaryUnits: secondaryUnits,
                variants: variants,
                barcode: barcode,
                logo: logo,
                salesmanCommission: salesmanCommission,
                agentCommission: agentCommission,
                printHeaderNote: printHeaderNote,
                printFooterNote: printFooterNote,
                status: status,
                privs: privs,
                accountKeys: accountKeys,
                createdAt: createdAt,
                updatedAt: updatedAt,
              ),
          createCompanionCallback:
              ({
                Value<int> id = const Value.absent(),
                Value<String?> firebaseUid = const Value.absent(),
                required String number,
                required String businessName,
                Value<String?> email = const Value.absent(),
                required String countryCode,
                required String mobile,
                Value<String?> industryType = const Value.absent(),
                Value<String?> businessType = const Value.absent(),
                Value<String?> address = const Value.absent(),
                Value<String?> city = const Value.absent(),
                Value<String?> state = const Value.absent(),
                Value<String?> country = const Value.absent(),
                Value<String?> currency = const Value.absent(),
                Value<String?> gst = const Value.absent(),
                Value<String?> vat = const Value.absent(),
                Value<String?> tax = const Value.absent(),
                Value<String?> negative = const Value.absent(),
                Value<String?> secondaryUnits = const Value.absent(),
                Value<String?> variants = const Value.absent(),
                Value<String?> barcode = const Value.absent(),
                Value<String?> logo = const Value.absent(),
                Value<String?> salesmanCommission = const Value.absent(),
                Value<String?> agentCommission = const Value.absent(),
                Value<String?> printHeaderNote = const Value.absent(),
                Value<String?> printFooterNote = const Value.absent(),
                Value<String?> status = const Value.absent(),
                Value<String?> privs = const Value.absent(),
                Value<String?> accountKeys = const Value.absent(),
                Value<DateTime> createdAt = const Value.absent(),
                Value<DateTime> updatedAt = const Value.absent(),
              }) => UsersCompanion.insert(
                id: id,
                firebaseUid: firebaseUid,
                number: number,
                businessName: businessName,
                email: email,
                countryCode: countryCode,
                mobile: mobile,
                industryType: industryType,
                businessType: businessType,
                address: address,
                city: city,
                state: state,
                country: country,
                currency: currency,
                gst: gst,
                vat: vat,
                tax: tax,
                negative: negative,
                secondaryUnits: secondaryUnits,
                variants: variants,
                barcode: barcode,
                logo: logo,
                salesmanCommission: salesmanCommission,
                agentCommission: agentCommission,
                printHeaderNote: printHeaderNote,
                printFooterNote: printFooterNote,
                status: status,
                privs: privs,
                accountKeys: accountKeys,
                createdAt: createdAt,
                updatedAt: updatedAt,
              ),
          withReferenceMapper: (p0) => p0
              .map(
                (e) =>
                    (e.readTable(table), $$UsersTableReferences(db, table, e)),
              )
              .toList(),
          prefetchHooksCallback: ({sessionsRefs = false}) {
            return PrefetchHooks(
              db: db,
              explicitlyWatchedTables: [if (sessionsRefs) db.sessions],
              addJoins: null,
              getPrefetchedDataCallback: (items) async {
                return [
                  if (sessionsRefs)
                    await $_getPrefetchedData<User, $UsersTable, Session>(
                      currentTable: table,
                      referencedTable: $$UsersTableReferences
                          ._sessionsRefsTable(db),
                      managerFromTypedResult: (p0) =>
                          $$UsersTableReferences(db, table, p0).sessionsRefs,
                      referencedItemsForCurrentItem: (item, referencedItems) =>
                          referencedItems.where((e) => e.userId == item.id),
                      typedResults: items,
                    ),
                ];
              },
            );
          },
        ),
      );
}

typedef $$UsersTableProcessedTableManager =
    ProcessedTableManager<
      _$AppDatabase,
      $UsersTable,
      User,
      $$UsersTableFilterComposer,
      $$UsersTableOrderingComposer,
      $$UsersTableAnnotationComposer,
      $$UsersTableCreateCompanionBuilder,
      $$UsersTableUpdateCompanionBuilder,
      (User, $$UsersTableReferences),
      User,
      PrefetchHooks Function({bool sessionsRefs})
    >;
typedef $$SessionsTableCreateCompanionBuilder =
    SessionsCompanion Function({
      Value<int> id,
      required int userId,
      Value<String?> token,
      Value<DateTime> loggedInAt,
      Value<DateTime?> expiresAt,
      Value<bool> isActive,
    });
typedef $$SessionsTableUpdateCompanionBuilder =
    SessionsCompanion Function({
      Value<int> id,
      Value<int> userId,
      Value<String?> token,
      Value<DateTime> loggedInAt,
      Value<DateTime?> expiresAt,
      Value<bool> isActive,
    });

final class $$SessionsTableReferences
    extends BaseReferences<_$AppDatabase, $SessionsTable, Session> {
  $$SessionsTableReferences(super.$_db, super.$_table, super.$_typedResult);

  static $UsersTable _userIdTable(_$AppDatabase db) => db.users.createAlias(
    $_aliasNameGenerator(db.sessions.userId, db.users.id),
  );

  $$UsersTableProcessedTableManager get userId {
    final $_column = $_itemColumn<int>('user_id')!;

    final manager = $$UsersTableTableManager(
      $_db,
      $_db.users,
    ).filter((f) => f.id.sqlEquals($_column));
    final item = $_typedResult.readTableOrNull(_userIdTable($_db));
    if (item == null) return manager;
    return ProcessedTableManager(
      manager.$state.copyWith(prefetchedData: [item]),
    );
  }
}

class $$SessionsTableFilterComposer
    extends Composer<_$AppDatabase, $SessionsTable> {
  $$SessionsTableFilterComposer({
    required super.$db,
    required super.$table,
    super.joinBuilder,
    super.$addJoinBuilderToRootComposer,
    super.$removeJoinBuilderFromRootComposer,
  });
  ColumnFilters<int> get id => $composableBuilder(
    column: $table.id,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<String> get token => $composableBuilder(
    column: $table.token,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<DateTime> get loggedInAt => $composableBuilder(
    column: $table.loggedInAt,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<DateTime> get expiresAt => $composableBuilder(
    column: $table.expiresAt,
    builder: (column) => ColumnFilters(column),
  );

  ColumnFilters<bool> get isActive => $composableBuilder(
    column: $table.isActive,
    builder: (column) => ColumnFilters(column),
  );

  $$UsersTableFilterComposer get userId {
    final $$UsersTableFilterComposer composer = $composerBuilder(
      composer: this,
      getCurrentColumn: (t) => t.userId,
      referencedTable: $db.users,
      getReferencedColumn: (t) => t.id,
      builder:
          (
            joinBuilder, {
            $addJoinBuilderToRootComposer,
            $removeJoinBuilderFromRootComposer,
          }) => $$UsersTableFilterComposer(
            $db: $db,
            $table: $db.users,
            $addJoinBuilderToRootComposer: $addJoinBuilderToRootComposer,
            joinBuilder: joinBuilder,
            $removeJoinBuilderFromRootComposer:
                $removeJoinBuilderFromRootComposer,
          ),
    );
    return composer;
  }
}

class $$SessionsTableOrderingComposer
    extends Composer<_$AppDatabase, $SessionsTable> {
  $$SessionsTableOrderingComposer({
    required super.$db,
    required super.$table,
    super.joinBuilder,
    super.$addJoinBuilderToRootComposer,
    super.$removeJoinBuilderFromRootComposer,
  });
  ColumnOrderings<int> get id => $composableBuilder(
    column: $table.id,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<String> get token => $composableBuilder(
    column: $table.token,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<DateTime> get loggedInAt => $composableBuilder(
    column: $table.loggedInAt,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<DateTime> get expiresAt => $composableBuilder(
    column: $table.expiresAt,
    builder: (column) => ColumnOrderings(column),
  );

  ColumnOrderings<bool> get isActive => $composableBuilder(
    column: $table.isActive,
    builder: (column) => ColumnOrderings(column),
  );

  $$UsersTableOrderingComposer get userId {
    final $$UsersTableOrderingComposer composer = $composerBuilder(
      composer: this,
      getCurrentColumn: (t) => t.userId,
      referencedTable: $db.users,
      getReferencedColumn: (t) => t.id,
      builder:
          (
            joinBuilder, {
            $addJoinBuilderToRootComposer,
            $removeJoinBuilderFromRootComposer,
          }) => $$UsersTableOrderingComposer(
            $db: $db,
            $table: $db.users,
            $addJoinBuilderToRootComposer: $addJoinBuilderToRootComposer,
            joinBuilder: joinBuilder,
            $removeJoinBuilderFromRootComposer:
                $removeJoinBuilderFromRootComposer,
          ),
    );
    return composer;
  }
}

class $$SessionsTableAnnotationComposer
    extends Composer<_$AppDatabase, $SessionsTable> {
  $$SessionsTableAnnotationComposer({
    required super.$db,
    required super.$table,
    super.joinBuilder,
    super.$addJoinBuilderToRootComposer,
    super.$removeJoinBuilderFromRootComposer,
  });
  GeneratedColumn<int> get id =>
      $composableBuilder(column: $table.id, builder: (column) => column);

  GeneratedColumn<String> get token =>
      $composableBuilder(column: $table.token, builder: (column) => column);

  GeneratedColumn<DateTime> get loggedInAt => $composableBuilder(
    column: $table.loggedInAt,
    builder: (column) => column,
  );

  GeneratedColumn<DateTime> get expiresAt =>
      $composableBuilder(column: $table.expiresAt, builder: (column) => column);

  GeneratedColumn<bool> get isActive =>
      $composableBuilder(column: $table.isActive, builder: (column) => column);

  $$UsersTableAnnotationComposer get userId {
    final $$UsersTableAnnotationComposer composer = $composerBuilder(
      composer: this,
      getCurrentColumn: (t) => t.userId,
      referencedTable: $db.users,
      getReferencedColumn: (t) => t.id,
      builder:
          (
            joinBuilder, {
            $addJoinBuilderToRootComposer,
            $removeJoinBuilderFromRootComposer,
          }) => $$UsersTableAnnotationComposer(
            $db: $db,
            $table: $db.users,
            $addJoinBuilderToRootComposer: $addJoinBuilderToRootComposer,
            joinBuilder: joinBuilder,
            $removeJoinBuilderFromRootComposer:
                $removeJoinBuilderFromRootComposer,
          ),
    );
    return composer;
  }
}

class $$SessionsTableTableManager
    extends
        RootTableManager<
          _$AppDatabase,
          $SessionsTable,
          Session,
          $$SessionsTableFilterComposer,
          $$SessionsTableOrderingComposer,
          $$SessionsTableAnnotationComposer,
          $$SessionsTableCreateCompanionBuilder,
          $$SessionsTableUpdateCompanionBuilder,
          (Session, $$SessionsTableReferences),
          Session,
          PrefetchHooks Function({bool userId})
        > {
  $$SessionsTableTableManager(_$AppDatabase db, $SessionsTable table)
    : super(
        TableManagerState(
          db: db,
          table: table,
          createFilteringComposer: () =>
              $$SessionsTableFilterComposer($db: db, $table: table),
          createOrderingComposer: () =>
              $$SessionsTableOrderingComposer($db: db, $table: table),
          createComputedFieldComposer: () =>
              $$SessionsTableAnnotationComposer($db: db, $table: table),
          updateCompanionCallback:
              ({
                Value<int> id = const Value.absent(),
                Value<int> userId = const Value.absent(),
                Value<String?> token = const Value.absent(),
                Value<DateTime> loggedInAt = const Value.absent(),
                Value<DateTime?> expiresAt = const Value.absent(),
                Value<bool> isActive = const Value.absent(),
              }) => SessionsCompanion(
                id: id,
                userId: userId,
                token: token,
                loggedInAt: loggedInAt,
                expiresAt: expiresAt,
                isActive: isActive,
              ),
          createCompanionCallback:
              ({
                Value<int> id = const Value.absent(),
                required int userId,
                Value<String?> token = const Value.absent(),
                Value<DateTime> loggedInAt = const Value.absent(),
                Value<DateTime?> expiresAt = const Value.absent(),
                Value<bool> isActive = const Value.absent(),
              }) => SessionsCompanion.insert(
                id: id,
                userId: userId,
                token: token,
                loggedInAt: loggedInAt,
                expiresAt: expiresAt,
                isActive: isActive,
              ),
          withReferenceMapper: (p0) => p0
              .map(
                (e) => (
                  e.readTable(table),
                  $$SessionsTableReferences(db, table, e),
                ),
              )
              .toList(),
          prefetchHooksCallback: ({userId = false}) {
            return PrefetchHooks(
              db: db,
              explicitlyWatchedTables: [],
              addJoins:
                  <
                    T extends TableManagerState<
                      dynamic,
                      dynamic,
                      dynamic,
                      dynamic,
                      dynamic,
                      dynamic,
                      dynamic,
                      dynamic,
                      dynamic,
                      dynamic,
                      dynamic
                    >
                  >(state) {
                    if (userId) {
                      state =
                          state.withJoin(
                                currentTable: table,
                                currentColumn: table.userId,
                                referencedTable: $$SessionsTableReferences
                                    ._userIdTable(db),
                                referencedColumn: $$SessionsTableReferences
                                    ._userIdTable(db)
                                    .id,
                              )
                              as T;
                    }

                    return state;
                  },
              getPrefetchedDataCallback: (items) async {
                return [];
              },
            );
          },
        ),
      );
}

typedef $$SessionsTableProcessedTableManager =
    ProcessedTableManager<
      _$AppDatabase,
      $SessionsTable,
      Session,
      $$SessionsTableFilterComposer,
      $$SessionsTableOrderingComposer,
      $$SessionsTableAnnotationComposer,
      $$SessionsTableCreateCompanionBuilder,
      $$SessionsTableUpdateCompanionBuilder,
      (Session, $$SessionsTableReferences),
      Session,
      PrefetchHooks Function({bool userId})
    >;

class $AppDatabaseManager {
  final _$AppDatabase _db;
  $AppDatabaseManager(this._db);
  $$UsersTableTableManager get users =>
      $$UsersTableTableManager(_db, _db.users);
  $$SessionsTableTableManager get sessions =>
      $$SessionsTableTableManager(_db, _db.sessions);
}
