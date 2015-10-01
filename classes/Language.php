<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class Language extends ObjectModel
{
	public 		$id;

	/** @var string Name */
	public 		$name;

	/** @var string 2-letter iso code */
	public 		$LanguageShortName;

	/** @var string date format http://http://php.net/manual/en/function.date.php with the date only */
	public 		$DateFormatLite = 'Y-m-d';
	
	/** @var string date format http://http://php.net/manual/en/function.date.php with hours and minutes */
	public 		$DateFormatFull = 'Y-m-d H:i:s';


	/** @var boolean Status */
	public 		$Active = true;

	protected 	$fieldsRequired = array('LanguageName', 'LanguageShortName', 'DateFormatLite', 'DateFormatFull');
	protected 	$fieldsSize = array('name' => 32, 'LanguageShortName' => 2,  'DateFormatLite' => 32, 'DateFormatFull' => 32);
	protected 	$fieldsValidate = array('name' => 'isGenericName', 'LanguageShortName' => 'isLanguageIsoCode', 
	'Active' => 'isBool', 'DateFormatLite' => 'isPhpDateFormat', 'DateFormatFull' => 'isPhpDateFormat');

	protected 	$table = 'Language';
	protected 	$identifier = 'LanguageId';

	/** @var array Languages cache */
	protected static $_checkedLangs;
	protected static $_LANGUAGES;
	protected static $countActiveLanguages;

	
	public	function __construct($id = NULL, $id_lang = NULL)
	{
		parent::__construct($id);
	}

	public function getFields()
	{
		parent::validateFields();
		$fields['LanguageName'] = pSQL($this->LanguageName);
		$fields['LanguageShortName'] = pSQL(strtolower($this->LanguageShortName));
		$fields['DateFormatLite'] = pSQL($this->DateFormatLite);
		$fields['DateFormatFull'] = pSQL($this->DateFormatFull);
		$fields['Active'] = (int)$this->Active;
		return $fields;
	}
	
	

	/**
	  * Return available languages
	  *
	  * @param boolean $Active Select only Active languages
	  * @return array Languages
	  */
	public static function getLanguages($Active = true)
	{
		if (!self::$_LANGUAGES)
			self::loadLanguages();

		$languages = array();
		foreach (self::$_LANGUAGES AS $language)
		{
			if ($Active AND !$language['Active'])
				continue;
			$languages[] = $language;
		}
		return $languages;
	}

	public static function getLanguage($id_lang)
	{
		if (!array_key_exists((int)($id_lang), self::$_LANGUAGES))
			return false;
		return self::$_LANGUAGES[(int)($id_lang)];
	}

	/**
	  * Return iso code from id
	  *
	  * @param integer $id_lang Language ID
	  * @return string Iso code
	  */
	public static function getIsoById($id_lang)
	{
		if (isset(self::$_LANGUAGES[(int)$id_lang]['LanguageShortName']))
			return self::$_LANGUAGES[(int)$id_lang]['LanguageShortName'];
		return "en";
	}

	/**
	  * Return id from iso code
	  *
	  * @param string $LanguageShortName Iso code
	  * @return integer Language ID
	  */
	public static function getIdByIso($LanguageShortName)
	{
	 	if (!Validate::isLanguageIsoCode($LanguageShortName))
	 		die(Tools::displayError('Fatal error: ISO code is not correct').' '.$LanguageShortName);

		return Db::getInstance()->getValue('SELECT `LanguageId` FROM `'._DB_PREFIX_.'Language` WHERE `LanguageShortName` = \''.pSQL(strtolower($LanguageShortName)).'\'');
	}

	public static function getLanguageCodeByIso($LanguageShortName)
	{
		return $LanguageShortName;
	}

	/**
	  * Return array (id_lang, LanguageShortName)
	  *
	  * @param string $LanguageShortName Iso code
	  * @return array  Language (id_lang, LanguageShortName)
	  */
	public static function getIsoIds($Active = true)
	{
		return Db::getInstance()->ExecuteS('SELECT `LanguageId`, `LanguageShortName` FROM `'._DB_PREFIX_.'Language` '.($Active ? 'WHERE Active = 1' : ''));
	}
	/**
	  * Load all languages in memory for caching
	  */
	public static function loadLanguages()
	{
		self::$_LANGUAGES = array();
		$result = Db::getInstance()->ExecuteS('SELECT * FROM `'._DB_PREFIX_.'Language`');
		foreach ($result AS $row)
			self::$_LANGUAGES[(int)$row['LanguageId']] = $row;
	}

	public function update($nullValues = false)
	{
		if (!parent::update($nullValues))
			return false;
	}

	private static $_cache_language_installation = null;
	public static function isInstalled($LanguageShortName)
	{
		if (self::$_cache_language_installation === null)
		{
			self::$_cache_language_installation = array();
			$result = Db::getInstance()->ExecuteS('SELECT `LanguageId`, `LanguageShortName` FROM `'._DB_PREFIX_.'Language`');
			foreach ($result as $row)
				self::$_cache_language_installation[$row['LanguageShortName']] = $row['LanguageId'];
		}
		return (isset(self::$_cache_language_installation[$LanguageShortName]) ? self::$_cache_language_installation[$LanguageShortName] : false);
	}

	public static function countActiveLanguages()
	{
		if (!self::$countActiveLanguages)
			self::$countActiveLanguages = Db::getInstance()->getValue('SELECT COUNT(*) FROM `'._DB_PREFIX_.'Language` WHERE `Active` = 1');
		return self::$countActiveLanguages;
	}
}

