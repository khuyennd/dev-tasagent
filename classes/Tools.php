<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class Tools
{
	protected static $file_exists_cache = array();
	protected static $_forceCompile;
	protected static $_caching;

	/**
	* Random password generator
	*
	* @param integer $length Desired length (optional)
	* @return string Password
	*/
	public static function passwdGen($length = 8)
	{
		$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for ($i = 0, $passwd = ''; $i < $length; $i++)
			$passwd .= self::substr($str, mt_rand(0, self::strlen($str) - 1), 1);
		return $passwd;
	}

	/**
	* Redirect user to another page
	*
	* @param string $url Desired URL
	* @param string $baseUri Base URI (optional)
	*/
	public static function redirect($url, $baseUri = __TAS_BASE_URI__)
	{
		if (strpos($url, 'http://') === FALSE && strpos($url, 'https://') === FALSE)
		{
			global $link;
			if (strpos($url, $baseUri) !== FALSE && strpos($url, $baseUri) == 0)
				$url = substr($url, strlen($baseUri));
			$explode = explode('?', $url, 2);
			// don't use ssl if url is home page
			// used when logout for example
			
			$url = $explode[0];
			if (isset($explode[1]))
				$url .= '?'.$explode[1];
			$baseUri = '';
		}

		if (isset($_SERVER['HTTP_REFERER']) AND ($url == $_SERVER['HTTP_REFERER']))
			header('Location: '.$_SERVER['HTTP_REFERER']);
		else
			header('Location: '.$baseUri.$url);
		exit;
	}

	/**
	* Redirect url wich allready TAS_BASE_URI
	*
	* @param string $url Desired URL
	*/
	public static function redirectLink($url)
	{
		if (!preg_match('@^https?://@i', $url))
		{
			global $link;
			if (strpos($url, __TAS_BASE_URI__) !== FALSE && strpos($url, __TAS_BASE_URI__) == 0)
				$url = substr($url, strlen(__TAS_BASE_URI__));
			$explode = explode('?', $url, 2);
			$url = $link->getPageLink($explode[0]);
			if (isset($explode[1]))
				$url .= '?'.$explode[1];
		}

		header('Location: '.$url);
		exit;
	}


	/**
	 * getProtocol return the set protocol according to configuration (http[s])
	 * @param Boolean true if require ssl
	 * @return String (http|https)
	 */
	public static function getProtocol($use_ssl = null)
	{
		return (!is_null($use_ssl) && $use_ssl ? 'https://' : 'http://');
	}

	/**
	 * getHttpHost return the <b>current</b> host used, with the protocol (http or https) if $http is true
	 * This function should not be used to choose http or https domain name.
	 * Use Tools::getShopDomain() or Tools::getShopDomainSsl instead
	 *
	 * @param boolean $http
	 * @param boolean $entities
	 * @return string host
	 */
	public static function getHttpHost($http = false, $entities = false)
	{
		$host = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
		if ($entities)
			$host = htmlspecialchars($host, ENT_COMPAT, 'UTF-8');
		if ($http)
			$host = 'http://';
		return $host;
	}

	
	/**
	* Get the server variable SERVER_NAME
	*
	* @return string server name
	*/
	static function getServerName()
	{
		if (isset($_SERVER['HTTP_X_FORWARDED_SERVER']) AND $_SERVER['HTTP_X_FORWARDED_SERVER'])
			return $_SERVER['HTTP_X_FORWARDED_SERVER'];
		return $_SERVER['SERVER_NAME'];
	}

	/**
	* Get the server variable REMOTE_ADDR, or the first ip of HTTP_X_FORWARDED_FOR (when using proxy)
	*
	* @return string $remote_addr ip of client
	*/
	static function getRemoteAddr()
	{
		// This condition is necessary when using CDN, don't remove it.
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND $_SERVER['HTTP_X_FORWARDED_FOR'] AND (!isset($_SERVER['REMOTE_ADDR']) OR preg_match('/^127\..*/i', trim($_SERVER['REMOTE_ADDR'])) OR preg_match('/^172\.16.*/i', trim($_SERVER['REMOTE_ADDR'])) OR preg_match('/^192\.168\.*/i', trim($_SERVER['REMOTE_ADDR'])) OR preg_match('/^10\..*/i', trim($_SERVER['REMOTE_ADDR']))))
		{
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ','))
			{
				$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				return $ips[0];
			}
			else
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	* Check if the current page use SSL connection on not
	*
	* @return bool uses SSL
	*/
	public static function usingSecureMode()
	{
		if (isset($_SERVER['HTTPS']))
			return ($_SERVER['HTTPS'] == 1 || strtolower($_SERVER['HTTPS']) == 'on');
		// $_SERVER['SSL'] exists only in some specific configuration
		if (isset($_SERVER['SSL']))
			return ($_SERVER['SSL'] == 1 || strtolower($_SERVER['SSL']) == 'on');

		return false;
	}

	/**
	* Get the current url prefix protocol (https/http)
	*
	* @return string protocol
	*/
	public static function getCurrentUrlProtocolPrefix()
	{
		if (self::usingSecureMode())
			return 'https://';
		else
			return 'http://';
	}

	/**
	* Secure an URL referrer
	*
	* @param string $referrer URL referrer
	* @return secured referrer
	*/
	public static function secureReferrer($referrer)
	{
		if (preg_match('/^http[s]?:\/\/'.self::getServerName().'(:'._PS_SSL_PORT_.')?\/.*$/Ui', $referrer))
			return $referrer;
		return __TAS_BASE_URI__;
	}

	/**
	* Get a value from $_POST / $_GET
	* if unavailable, take a default value
	*
	* @param string $key Value key
	* @param mixed $defaultValue (optional)
	* @return mixed Value
	*/
	public static function getValue($key, $defaultValue = false)
	{
	 	if (!isset($key) OR empty($key) OR !is_string($key))
			return false;
		$ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $defaultValue));

		/*
		if (is_string($ret) === true)
			$ret = stripslashes(urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret))));
		elseif (is_array($ret))
            $ret = Tools::getArrayValue($ret);
            */
		//echo $ret;exit();
		//$ret = trim($ret, " ");
		return $ret;
	}

    /**
     * Escape values contained in an array
     *
     * @param array $array Value array
     * @return mixed Value
     */
    public static function getArrayValue($array)
    {
        foreach ($array as &$row)
        {
            if (is_array($row))
                $row = Tools::getArrayValue($row);
            else
                $row = stripslashes(urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($row))));
        }

        return $array;
    }

	public static function getIsset($key)
	{
	 	if (!isset($key) OR empty($key) OR !is_string($key))
			return false;
	 	return isset($_POST[$key]) ? true : (isset($_GET[$key]) ? true : false);
	}

	/**
	* Change language in cookie while clicking on a flag
	*
	* @return string iso code
	*/
	public static function setCookieLanguage()
	{
		global $cookie;

		if (Tools::isSubmit("clang")) {
			$cookie->LanguageID  = Tools::getValue("languageId");
		}
		/* If language does not exist or is disabled, erase it */
		if ($cookie->LanguageID)
		{
			$lang = new Language((int)$cookie->LanguageID);
			if (!Validate::isLoadedObject($lang) OR !$lang->Active)
				$cookie->LanguageID = NULL;
		}

		/* If language file not present, you must use default language file */
		if (!$cookie->LanguageID OR !Validate::isUnsignedId($cookie->LanguageID))
			$cookie->LanguageID = (int)(Configuration::get('TAS_LANG_DEFAULT'));

		$iso = Language::getIsoById((int)$cookie->LanguageID);
		@include_once(_TAS_THEME_DIR_.'lang/'.$iso.'.php');

		return $iso;
	}

	/**
	 * Set cookie id_lang
	 */
	public static function switchLanguage()
	{
		global $cookie;

		if ($id_lang = (int)(self::getValue('LanguageId')) AND Validate::isUnsignedId($LanguageId))
			$cookie->LanguageId = $id_lang;
	}
	
	public static function getLanguages() {
		
		$langList = Language::getLanguages();
		$langArray = Array();
		foreach ($langList as $lang) {
			$langArray[$lang['LanguageId']] = $lang['LanguageName'];
		}
		return $langArray;
	}

	
	public static function getCountries() {
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		
		$result = Db::getInstance()->ExecuteS('SELECT *, CountryName_'.$iso.' as CountryName  FROM `'._DB_PREFIX_.'Country` ORDER BY CountryCode');
		$countryArray = Array();
		foreach ($result as $row) {
			$countryArray[$row['CountryId']] = $row['CountryName'];
		}
		return $countryArray;
	}

	/**
	* Display date regarding to language preferences
	*
	* @param array $params Date, format...
	* @param object $smarty Smarty object for language preferences
	* @return string Date
	*/
	public static function dateFormat($params, &$smarty)
	{
		return self::displayDate($params['date'], $smarty->tas_language->id, (isset($params['full']) ? $params['full'] : false));
	}

	/**
	* Display date regarding to language preferences
	*
	* @param string $date Date to display format UNIX
	* @param integer $id_lang Language id
	* @param boolean $full With time or not (optional)
	* @return string Date
	*/
	public static function displayDate($date, $id_lang, $full = false, $separator = '-')
	{
	 	if (!$date OR !($time = strtotime($date)))
	 		return $date;
		if (!Validate::isDate($date) OR !Validate::isBool($full))
			die (self::displayError('Invalid date'));

		$language = Language::getLanguage((int)$id_lang);
		return date($full ? $language['date_format_full'] : $language['date_format_lite'], $time);
	}

	/**
	* Sanitize a string
	*
	* @param string $string String to sanitize
	* @param boolean $full String contains HTML or not (optional)
	* @return string Sanitized string
	*/
	public static function safeOutput($string, $html = false)
	{
	 	if (!$html)
			$string = strip_tags($string);
		return @Tools::htmlentitiesUTF8($string, ENT_QUOTES);
	}

	public static function htmlentitiesUTF8($string, $type = ENT_QUOTES)
	{
		if (is_array($string))
			return array_map(array('Tools', 'htmlentitiesUTF8'), $string);
		return htmlentities($string, $type, 'utf-8');
	}

	public static function htmlentitiesDecodeUTF8($string)
	{
		if (is_array($string))
			return array_map(array('Tools', 'htmlentitiesDecodeUTF8'), $string);
		return html_entity_decode($string, ENT_QUOTES, 'utf-8');
	}

	public static function safePostVars()
	{
		$_POST = array_map(array('Tools', 'htmlentitiesUTF8'), $_POST);
	}

	/**
	* Delete directory and subdirectories
	*
	* @param string $dirname Directory name
	*/
	public static function deleteDirectory($dirname, $delete_self = true)
	{
		$dirname = rtrim($dirname, '/').'/';
		$files = scandir($dirname);
		foreach ($files as $file)
			if ($file != '.' AND $file != '..')
			{
				if (is_dir($dirname.$file))
					self::deleteDirectory($dirname.$file, true);
				elseif (file_exists($dirname.$file))
					unlink($dirname.$file);
			}
		if ($delete_self)
			rmdir($dirname);
	}

	/**
	* Display an error according to an error code
	*
	* @param string $string Error message
	* @param boolean $htmlentities By default at true for parsing error message with htmlentities
	*/
	public static function displayError($string = 'Fatal error', $htmlentities = true)
	{
		global $_ERRORS, $cookie;

		$iso = strtolower(Language::getIsoById((is_object($cookie) AND $cookie->id_lang) ? (int)$cookie->id_lang : (int)Configuration::get('PS_LANG_DEFAULT')));
		@include_once(_PS_TRANSLATIONS_DIR_.$iso.'/errors.php');

		if (defined('_PS_MODE_DEV_') AND _PS_MODE_DEV_ AND $string == 'Fatal error')
			return ('<pre>'.print_r(debug_backtrace(), true).'</pre>');
		if (!is_array($_ERRORS))
			return str_replace('"', '&quot;', $string);
		$key = md5(str_replace('\'', '\\\'', $string));
		$str = (isset($_ERRORS) AND is_array($_ERRORS) AND key_exists($key, $_ERRORS)) ? ($htmlentities ? htmlentities($_ERRORS[$key], ENT_COMPAT, 'UTF-8') : $_ERRORS[$key]) : $string;
		return str_replace('"', '&quot;', stripslashes($str));
	}

	/**
	 * Display an error with detailed object
	 *
	 * @param mixed $object
	 * @param boolean $kill
	 * @return $object if $kill = false;
	 */
	public static function dieObject($object, $kill = true)
	{
		echo '<pre style="text-align: left;">';
		print_r($object);
		echo '</pre><br />';
		if ($kill)
			die('END');
		return $object;
	}

	/**
	* ALIAS OF dieObject() - Display an error with detailed object
	*
	* @param object $object Object to display
	*/
	public static function d($object, $kill = true)
	{
		return (self::dieObject($object, $kill));
	}

	/**
	* ALIAS OF dieObject() - Display an error with detailed object but don't stop the execution
	*
	* @param object $object Object to display
	*/
	public static function p($object)
	{
		return (self::dieObject($object, false));
	}

	/**
	* Check if submit has been posted
	*
	* @param string $submit submit name
	*/
	public static function isSubmit($submit)
	{
		return (
			isset($_POST[$submit]) OR isset($_POST[$submit.'_x']) OR isset($_POST[$submit.'_y'])
			OR isset($_GET[$submit]) OR isset($_GET[$submit.'_x']) OR isset($_GET[$submit.'_y'])
		);
	}

	/**
	* Get meta tages for a given page
	*
	* @param integer $id_lang Language id
	* @return array Meta tags
	*/
	public static function getMetaTags($id_lang, $page_name, $title = '')
	{
		/* Default meta tags */
		return self::getHomeMetaTags($id_lang, $page_name);
	}

	/**
	* Get meta tags for a given page
	*
	* @param integer $id_lang Language id
	* @return array Meta tags
	*/
	public static function getHomeMetaTags($id_lang, $page_name)
	{
		/* Metas-tags */
		$ret['meta_title'] = 'TAS AGENT';
		$ret['meta_description'] = 'Japan Hotel Booking System';
		$ret['meta_keywords'] = 'Japan Hotel Booking System';
		return $ret;
	}


	/**
	* Encrypt password
	*
	* @param object $object Object to display
	*/
	public static function encrypt($passwd)
	{
		return md5(pSQL(_COOKIE_KEY_.$passwd));
	}

	/**
	* Get token to prevent CSRF
	*
	* @param string $token token to encrypt
	*/
	public static function getToken($page = true)
	{
		global $cookie;
		if ($page === true)
			return (self::encrypt($cookie->UserID.$cookie->Password.$_SERVER['SCRIPT_NAME']));
		else
			return (self::encrypt($cookie->UserID.$cookie->Password.$page));
	}

	/**
	 * Return the friendly url from the provided string
	 *
	 * @param string $str
	 * @param bool $utf8_decode => needs to be marked as deprecated
	 * @return string
	 */
	public static function link_rewrite($str, $utf8_decode = false)
	{
		return self::str2url($str);
	}

	/**
	 * Return a friendly url made from the provided string
	 * If the mbstring library is available, the output is the same as the js function of the same name
	 *
	 * @param string $str
	 * @return string
	 */
	public static function str2url($str)
	{
		if (function_exists('mb_strtolower'))
			$str = mb_strtolower($str, 'utf-8');

		$str = trim($str);
		$str = self::replaceAccentedChars($str);

		// Remove all non-whitelist chars.
		$str = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]-]/','', $str);
		$str = preg_replace('/[\s\'\:\/\[\]-]+/',' ', $str);
		$str = preg_replace('/[ ]/','-', $str);
		$str = preg_replace('/[\/]/','-', $str);

		// If it was not possible to lowercase the string with mb_strtolower, we do it after the transformations.
		// This way we lose fewer special chars.
		$str = strtolower($str);

		return $str;
	}

	/**
	 * Replace all accented chars by their equivalent non accented chars.
	 *
	 * @param string $str
	 * @return string
	 */
	public static function replaceAccentedChars($str)
	{
		$str = preg_replace('/[\x{0105}\x{0104}\x{00E0}\x{00E1}\x{00E2}\x{00E3}\x{00E4}\x{00E5}]/u','a', $str);
		$str = preg_replace('/[\x{00E7}\x{010D}\x{0107}\x{0106}]/u','c', $str);
		$str = preg_replace('/[\x{010F}]/u','d', $str);
		$str = preg_replace('/[\x{00E8}\x{00E9}\x{00EA}\x{00EB}\x{011B}\x{0119}\x{0118}]/u','e', $str);
		$str = preg_replace('/[\x{00EC}\x{00ED}\x{00EE}\x{00EF}]/u','i', $str);
		$str = preg_replace('/[\x{0142}\x{0141}\x{013E}\x{013A}]/u','l', $str);
		$str = preg_replace('/[\x{00F1}\x{0148}]/u','n', $str);
		$str = preg_replace('/[\x{00F2}\x{00F3}\x{00F4}\x{00F5}\x{00F6}\x{00F8}\x{00D3}]/u','o', $str);
		$str = preg_replace('/[\x{0159}\x{0155}]/u','r', $str);
		$str = preg_replace('/[\x{015B}\x{015A}\x{0161}]/u','s', $str);
		$str = preg_replace('/[\x{00DF}]/u','ss', $str);
		$str = preg_replace('/[\x{0165}]/u','t', $str);
		$str = preg_replace('/[\x{00F9}\x{00FA}\x{00FB}\x{00FC}\x{016F}]/u','u', $str);
		$str = preg_replace('/[\x{00FD}\x{00FF}]/u','y', $str);
		$str = preg_replace('/[\x{017C}\x{017A}\x{017B}\x{0179}\x{017E}]/u','z', $str);
		$str = preg_replace('/[\x{00E6}]/u','ae', $str);
		$str = preg_replace('/[\x{0153}]/u','oe', $str);
		return $str;
	}

	/**
	* Truncate strings
	*
	* @param string $str
	* @param integer $maxLen Max length
	* @param string $suffix Suffix optional
	* @return string $str truncated
	*/
	/* CAUTION : Use it only on module hookEvents.
	** For other purposes use the smarty function instead */
	public static function truncate($str, $maxLen, $suffix = '...')
	{
	 	if (self::strlen($str) <= $maxLen)
	 		return $str;
	 	$str = utf8_decode($str);
	 	return (utf8_encode(substr($str, 0, $maxLen - self::strlen($suffix)).$suffix));
	}

	/**
	* Generate date form
	*
	* @param integer $year Year to select
	* @param integer $month Month to select
	* @param integer $day Day to select
	* @return array $tab html data with 3 cells :['days'], ['months'], ['years']
	*
	*/
	public static function dateYears()
	{
		for ($i = date('Y') - 10; $i >= 1900; $i--)
			$tab[] = $i;
		return $tab;
	}

	public static function dateDays()
	{
		for ($i = 1; $i != 32; $i++)
			$tab[] = $i;
		return $tab;
	}

	public static function dateMonths()
	{
		for ($i = 1; $i != 13; $i++)
			$tab[$i] = date('F', mktime(0, 0, 0, $i, date('m'), date('Y')));
		return $tab;
	}

	public static function hourGenerate($hours, $minutes, $seconds)
	{
		return implode(':', array($hours, $minutes, $seconds));
	}

	public static function dateFrom($date)
	{
		$tab = explode(' ', $date);
		if (!isset($tab[1]))
			$date .= ' ' . self::hourGenerate(0, 0, 0);
		return $date;
	}

	public static function dateTo($date)
	{
		$tab = explode(' ', $date);
		if (!isset($tab[1]))
			$date .= ' ' . self::hourGenerate(23, 59, 59);
		return $date;
	}

	/**
	 * @deprecated
	 */
	public static function getExactTime()
	{
		return time()+microtime();
	}

	static function strtolower($str)
	{
		if (is_array($str))
			return false;
		if (function_exists('mb_strtolower'))
			return mb_strtolower($str, 'utf-8');
		return strtolower($str);
	}

	static function strlen($str, $encoding = 'UTF-8')
	{
		if (is_array($str))
			return false;
		$str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
		if (function_exists('mb_strlen'))
			return mb_strlen($str, $encoding);
		return strlen($str);
	}

	static function stripslashes($string)
	{
		if (_PS_MAGIC_QUOTES_GPC_)
			$string = stripslashes($string);
		return $string;
	}

	static function strtoupper($str)
	{
		if (is_array($str))
			return false;
		if (function_exists('mb_strtoupper'))
			return mb_strtoupper($str, 'utf-8');
		return strtoupper($str);
	}

	static function substr($str, $start, $length = false, $encoding = 'utf-8')
	{
		if (is_array($str))
			return false;
		if (function_exists('mb_substr'))
			return mb_substr($str, (int)($start), ($length === false ? self::strlen($str) : (int)($length)), $encoding);
		return substr($str, $start, ($length === false ? self::strlen($str) : (int)($length)));
	}

	
	public static function iconv($from, $to, $string)
	{
		if (function_exists('iconv'))
			return iconv($from, $to.'//TRANSLIT', str_replace('¥', '&yen;', str_replace('£', '&pound;', str_replace('€', '&euro;', $string))));
		return html_entity_decode(htmlentities($string, ENT_NOQUOTES, $from), ENT_NOQUOTES, $to);
	}

	public static function isEmpty($field)
	{
		return ($field === '' OR $field === NULL);
	}


	public static function ps_round($value, $precision = 0)
	{
		$method = (int)(Configuration::get('TAS_PRICE_ROUND_MODE'));
		if ($method == PS_ROUND_UP)
			return self::ceilf($value, $precision);
		elseif ($method == PS_ROUND_DOWN)
			return self::floorf($value, $precision);
		return round($value, $precision);
	}

	public static function ceilf($value, $precision = 0)
	{
		$precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
		$tmp = $value * $precisionFactor;
		$tmp2 = (string)$tmp;
		// If the current value has already the desired precision
		if (strpos($tmp2, '.') === false)
			return ($value);
		if ($tmp2[strlen($tmp2) - 1] == 0)
			return $value;
		return ceil($tmp) / $precisionFactor;
	}

	public static function floorf($value, $precision = 0)
	{
		$precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
		$tmp = $value * $precisionFactor;
		$tmp2 = (string)$tmp;
		// If the current value has already the desired precision
		if (strpos($tmp2, '.') === false)
			return ($value);
		if ($tmp2[strlen($tmp2) - 1] == 0)
			return $value;
		return floor($tmp) / $precisionFactor;
	}

	/**
	 * file_exists() wrapper with cache to speedup performance
	 *
	 * @param string $filename File name
	 * @return boolean Cached result of file_exists($filename)
	 */
	public static function file_exists_cache($filename)
	{
		if (!isset(self::$file_exists_cache[$filename]))
			self::$file_exists_cache[$filename] = file_exists($filename);
		return self::$file_exists_cache[$filename];
	}

	public static function file_get_contents($url, $useIncludePath = false, $streamContext = NULL, $curlTimeOut = 5)
	{
		if ($streamContext == NULL)
			$streamContext = @stream_context_create(array('http' => array('timeout' => 5)));

		if (in_array(ini_get('allow_url_fopen'), array('On', 'on', '1')))
			return @file_get_contents($url, $useIncludePath, $streamContext);
		elseif (function_exists('curl_init') && in_array(ini_get('allow_url_fopen'), array('On', 'on', '1')))
		{
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $curlTimeOut);
			curl_setopt($curl, CURLOPT_TIMEOUT, $curlTimeOut);
			$content = curl_exec($curl);
			curl_close($curl);
			return $content;
		}
		else
			return false;
	}

	public static function simplexml_load_file($url, $class_name = null)
	{
		if (in_array(ini_get('allow_url_fopen'), array('On', 'on', '1')))
			return simplexml_load_string(Tools::file_get_contents($url), $class_name);
		else
			return false;
	}

	
	/**
	* Translates a string with underscores into camel case (e.g. first_name -> firstName)
	* @prototype string public static function toCamelCase(string $str[, bool $capitaliseFirstChar = false])
	*/
	public static function toCamelCase($str, $capitaliseFirstChar = false)
	{
		$str = strtolower($str);
		if ($capitaliseFirstChar)
			$str = ucfirst($str);
		return preg_replace_callback('/_([a-z])/', create_function('$c', 'return strtoupper($c[1]);'), $str);
	}

	public static function getBrightness($hex)
	{
		$hex = str_replace('#', '', $hex);
		$r = hexdec(substr($hex, 0, 2));
		$g = hexdec(substr($hex, 2, 2));
		$b = hexdec(substr($hex, 4, 2));
		return (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
	}
	
	public static function replaceByAbsoluteURL($matches)
	{
		global $current_css_file;

		$protocol_link = self::getCurrentUrlProtocolPrefix();

		if (array_key_exists(1, $matches))
		{
			$tmp = dirname($current_css_file).'/'.$matches[1];
			return 'url(\''.$protocol_link.self::getMediaServer($tmp).$tmp.'\')';
		}
		return false;
	}

	/**
	 * addJS load a javascript file in the header
	 *
	 * @param mixed $js_uri
	 * @return void
	 */
	public static function addJS($js_uri)
	{
		global $js_files;
		if (!isset($js_files))
			$js_files = array();
		// avoid useless operation...
		if (in_array($js_uri, $js_files))
			return true;

		// detect mass add
		if (!is_array($js_uri) && !in_array($js_uri, $js_files))
			$js_uri = array($js_uri);
		else
			foreach ($js_uri as $key => $js)
				if (in_array($js, $js_files))
					unset($js_uri[$key]);

		// adding file to the big array...
		$js_files = array_merge($js_files, $js_uri);

		return true;
	}

	/**
	 * addCSS allows you to add stylesheet at any time.
	 *
	 * @param mixed $css_uri
	 * @param string $css_media_type
	 * @return true
	 */
	public static function addCSS($css_uri, $css_media_type = 'all')
	{
		global $css_files;

		if (is_array($css_uri))
		{
			foreach ($css_uri as $file => $media_type)
				self::addCSS($file, $media_type);
			return true;
		}

		// detect mass add
		$css_uri = array($css_uri => $css_media_type);

		// adding file to the big array...
		if (is_array($css_files))
			$css_files = array_merge($css_files, $css_uri);
		else
			$css_files = $css_uri;

		return true;
	}



	/**
	 * jsonDecode convert json string to php array / object
	 *
	 * @param string $json
	 * @param boolean $assoc  (since 1.4.2.4) if true, convert to associativ array
	 * @return array
	 */
	public static function jsonDecode($json, $assoc = false)
	{
		if (function_exists('json_decode'))
			return json_decode($json, $assoc);
		else
		{
			include_once(_PS_TOOL_DIR_.'json/json.php');
			$pearJson = new Services_JSON(($assoc) ? SERVICES_JSON_LOOSE_TYPE : 0);
			return $pearJson->decode($json);
		}
	}

	/**
	 * Convert an array to json string
	 *
	 * @param array $data
	 * @return string json
	 */
	public static function jsonEncode($data)
	{
		if (function_exists('json_encode'))
			return json_encode($data);
		else
		{
			include_once(_PS_TOOL_DIR_.'json/json.php');
			$pearJson = new Services_JSON();
			return $pearJson->encode($data);
		}
	}

	public static function enableCache($level = 1)
	{
		global $smarty;

		if (!Configuration::get('PS_SMARTY_CACHE'))
			return;
		if ($smarty->force_compile == 0 AND $smarty->caching == $level)
			return ;
		self::$_forceCompile = (int)($smarty->force_compile);
		self::$_caching = (int)($smarty->caching);
		$smarty->force_compile = 0;
		$smarty->caching = (int)($level);
	}

	public static function restoreCacheSettings()
	{
		global $smarty;

		if (isset(self::$_forceCompile))
			$smarty->force_compile = (int)(self::$_forceCompile);
		if (isset(self::$_caching))
			$smarty->caching = (int)(self::$_caching);
	}

	public static function isCallable($function)
	{
		$disabled = explode(',', ini_get('disable_functions'));
		return (!in_array($function, $disabled) AND is_callable($function));
	}

	public static function pRegexp($s, $delim)
	{
		$s = str_replace($delim, '\\'.$delim, $s);
		foreach (array('?', '[', ']', '(', ')', '{', '}', '-', '.', '+', '*', '^', '$') as $char)
			$s = str_replace($char, '\\'.$char, $s);
		return $s;
	}

	public static function str_replace_once($needle , $replace, $haystack)
	{
		$pos = strpos($haystack, $needle);
		if ($pos === false)
			return $haystack;
		return substr_replace($haystack, $replace, $pos, strlen($needle));
	}


	/**
	 * Function property_exists does not exist in PHP < 5.1
	 *
	 * @param object or class $class
	 * @param string $property
	 * @return boolean
	 */
	public static function property_exists($class, $property)
	{
		if (function_exists('property_exists'))
			return property_exists($class, $property);

		if (is_object($class))
			$vars = get_object_vars($class);
		else
			$vars = get_class_vars($class);

		return array_key_exists($property, $vars);
	}

	/**
	 * @desc identify the version of php
	 * @return string
	 */
	public static function checkPhpVersion()
	{
		$version = null;

		if (defined('PHP_VERSION'))
			$version = PHP_VERSION;
		else
			$version  = phpversion('');

		//Case management system of ubuntu, php version return 5.2.4-2ubuntu5.2
		if (strpos($version, '-') !== false )
			$version  = substr($version, 0, strpos($version, '-'));

		return $version;
	}

	/**
	 * Convert a shorthand byte value from a PHP configuration directive to an integer value
	 * @param string $value value to convert
	 * @return int
	 */
	public static function convertBytes($value)
	{
		if (is_numeric($value))
		{
			return $value;
		}
		else
		{
			$value_length = strlen($value);
			$qty = substr($value, 0, $value_length - 1 );
			$unit = strtolower(substr($value, $value_length - 1));
			switch ($unit)
			{
				case 'k':
					$qty *= 1024;
					break;
				case 'm':
					$qty *= 1048576;
					break;
				case 'g':
					$qty *= 1073741824;
					break;
			}
			return $qty;
		}
	}

	public static function display404Error()
	{
		header('HTTP/1.1 404 Not Found');
		header('Status: 404 Not Found');
		include(dirname(__FILE__).'/../404.php');
		die;
	}

	/**
	 * Display error and dies or silently log the error.
	 *
	 * @param string $msg
	 * @param bool $die
	 * @return success of logging
	 */
	public static function dieOrLog($msg, $die = true)
	{
		if ($die || (defined('_TAS_MODE_DEV_') && _PS_MODE_DEV_))
			die($msg);
		return Logger::addLog($msg);
	}

	/**
	 * Clear cache for Smarty
	 *
	 * @param objet $smarty
	 */
	public static function clearCache($smarty)
	{
		if (!Configuration::get('TAS_FORCE_SMARTY_2'))
			$smarty->clearAllCache();
		else
			$smarty->clear_all_cache();
	}

	/**
	 * getMemoryLimit allow to get the memory limit in octet
	 *
	 * @since 1.4.5.0
	 * @return int the memory limit value in octet
	 */
	public static function getMemoryLimit()
	{
		$memory_limit = @ini_get('memory_limit');

		if (preg_match('/[0-9]+k/i', $memory_limit))
			return 1024 * (int)$memory_limit;

		if (preg_match('/[0-9]+m/i', $memory_limit))
			return 1024 * 1024 * (int)$memory_limit;

		if (preg_match('/[0-9]+g/i', $memory_limit))
			return 1024 * 1024 * 1024 * (int)$memory_limit;

		return $memory_limit;
	}

	public static function isX86_64arch()
	{
		return (PHP_INT_MAX == '9223372036854775807');
	}

	/**
	 * apacheModExists return true if the apache module $name is loaded
	 * @TODO move this method in class Information (when it will exist)
	 *
	 * @param string $name module name
	 * @return boolean true if exists
	 * @since 1.4.5.0
	 */
	public static function apacheModExists($name)
	{
		if(function_exists('apache_get_modules'))
		{
			static $apacheModuleList = null;

			if (!is_array($apacheModuleList))
				$apacheModuleList = apache_get_modules();

			// we need strpos (example, evasive can be evasive20)
			foreach($apacheModuleList as $module)
			{
				if (strpos($module, $name) !== false)
					return true;
			}
		}
		else{
			// If apache_get_modules does not exists,
			// one solution should be parsing httpd.conf,
			// but we could simple parse phpinfo(INFO_MODULES) return string
			ob_start();
			phpinfo(INFO_MODULES);
			$phpinfo = ob_get_contents();
			ob_end_clean();
			if (strpos($phpinfo, $name) !== false)
				return true;
		}

		return false;
	}
	
	
	public static function hasFunction($name) {
		global $cookie;
		
		$functionList = @split("," , $cookie->RoleList);
		if (in_array($name, $functionList)) 
			return 1;
		else return 0;
	}
	
	public static function getJapanAreas() {
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
	
		$sql = 'SELECT A.* , A.AreaName_'.$iso.' as AreaName, count(H.HotelArea) as HotelNum
			FROM `'._DB_PREFIX_.'Area` as A left join `'._DB_PREFIX_.'Hotel` as H
			on A.AreaId = H.HotelArea  
			WHERE A.CountryId = 109  
			GROUP BY A.AreaId 
			ORDER BY A.AreaId ASC';
		
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public static function getCitys($areaid) {
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		
		$sql = 'SELECT C.*, COUNT(H.HotelCity) AS HotelNum 
					FROM  
					(SELECT * , CityName_'.$iso.' as CityName 
					FROM `'._DB_PREFIX_.'City` 
					WHERE AreaId = '.$areaid.' 
					) as C LEFT JOIN 
					(select HotelId, HotelCity, HotelArea 
					FROM `'._DB_PREFIX_.'Hotel` 
					where HotelArea = '.$areaid.' 
					) AS H ON C.CityId = H.HotelCity  
				GROUP BY C.CityId 
				ORDER BY C.CityId ASC';
		
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public static function getAreaName($areaId) {
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		
		$res = Db::getInstance()->ExecuteS('
		SELECT AreaName_'.$iso.' as AreaName 
		FROM `'._DB_PREFIX_.'Area`
		WHERE AreaId = '.$areaId.' and CountryId = 109');
		
		return $res[0]['AreaName'];
	}
	
	public static function getCityName($cityId) {
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		
		$res =  Db::getInstance()->ExecuteS('
		SELECT CityName_'.$iso.' as CityName 
		FROM `'._DB_PREFIX_.'City`
		WHERE CityId = '.$cityId);
		
		return $res[0]['CityName'];
	}
	
	public static function getAllHotelClasses() {
		return Db::getInstance()->ExecuteS('
		SELECT * 
		FROM `'._DB_PREFIX_.'HotelClass`
		ORDER BY HotelClassId ASC');
	}


	public static function createRandomFileName($prefix="",$subfix="") {
		$tmpstr = date("YmdHis");
		$tmpstr .= rand(100,999);
		$tmpstr = $prefix.$tmpstr.$subfix;
		return $tmpstr;
	}
	
	public static function uploadAFile($upload_dir, &$ofn, $bMakeThumb = false, $bOverwrite = False, $bExtChange=true) {
		
		
				
		//if (!is_dir($updir)) return "";
		if (!$ofn[tmp_name]) return "";
		if (!$ofn[size]) return "";

		$fn = $ofn[name];
		if ($bExtChange) {

			$fn = str_replace(" ", "_", $fn);
			$fn = str_replace("'", "", $fn);   
			$fn = str_replace("\"", "", $fn);  
			$ext = substr(strrchr($fn, "."), 1);
			$ext = strtolower($ext);
			$fn = str_replace(".$ext","",$fn);
			$fn = Tools::createRandomFileName();
			//if ( !preg_match("/^[a-zA-Z0-9_]*$/", $fn) )
				
			$fn .= ".$ext";
			// -----
			$ext = substr(strrchr($fn, "."), 1);
			$ext = strtolower($ext);

			if (preg_match("/exe|bat|com|inc|phtm|htm|shtm|php|php3|dot|asp|cgi|pl/i", $ext)) $fn .= ".tmp";
		}
		
		$ext = substr(strrchr($fn, "."), 1);
		$ffn = substr($fn, 0, strlen($fn)-strlen($ext)-1);
		if ($bMakeThumb) {
			$thumbfn = "{$ffn}.{$ext}";
			$destfn = "{$ffn}_n.{$ext}";
		} else {
			$destfn = "{$ffn}.{$ext}";
		}
		
		if (@move_uploaded_file($ofn['tmp_name'], $upload_dir."/".$destfn)) {
			if ($bMakeThumb)Tools::make_thumb($upload_dir."/".$destfn,$upload_dir."/".$thumbfn,200,200);
			@chmod("$upload_dir/$destfn", 0640); // 0777);
			if ($thumbfn) @chmod("$upload_dir/$thumbfn", 0640); // 0777);
			if ($thumbfn) 
				return $thumbfn;
			else return $destfn;
		}
	}
	
	public static function uploadMultiFile($upload_dir, &$ofn, $key, $bMakeThumb = false, $bOverwrite = False, $bExtChange=true) {
		
		
				
		//if (!is_dir($updir)) return "";
		if (!$ofn[tmp_name][$key]) return "";
		if (!$ofn[size][$key]) return "";

		$fn = $ofn[name][$key];
		if ($bExtChange) {

			$fn = str_replace(" ", "_", $fn);
			$fn = str_replace("'", "", $fn);   
			$fn = str_replace("\"", "", $fn);  
			$ext = substr(strrchr($fn, "."), 1);
			$ext = strtolower($ext);
			$fn = str_replace(".$ext","",$fn);
			$fn = Tools::createRandomFileName();
			//if ( !preg_match("/^[a-zA-Z0-9_]*$/", $fn) )
				
			$fn .= ".$ext";
			// -----
			$ext = substr(strrchr($fn, "."), 1);
			$ext = strtolower($ext);

			if (preg_match("/exe|bat|com|inc|phtm|htm|shtm|php|php3|dot|asp|cgi|pl/i", $ext)) $fn .= ".tmp";
		}
		
		$ext = substr(strrchr($fn, "."), 1);
		$ffn = substr($fn, 0, strlen($fn)-strlen($ext)-1);
		if ($bMakeThumb) {
			$thumbfn = "{$ffn}.{$ext}";
			$destfn = "{$ffn}_n.{$ext}";
		} else {
			$destfn = "{$ffn}.{$ext}";
		}

		if (@move_uploaded_file($ofn['tmp_name'][$key], $upload_dir."/".$destfn)) {//echo "test---" . $upload_dir/$destfn;die("hehe");
			if ($bMakeThumb)Tools::make_thumb($upload_dir."/".$destfn,$upload_dir."/".$thumbfn,200,200);
			@chmod("$upload_dir/$destfn", 0640); // 0777);
			if ($thumbfn) @chmod("$upload_dir/$thumbfn", 0640); // 0777);
			if ($thumbfn) 
				return $thumbfn;
			else return $destfn;
		}

	}
// this is the function that will create the thumbnail image from the uploaded image
	// the resize will be done considering the width and height defined, but without deforming the image
	public static function make_thumb($img_name,$filename,$new_w,$new_h)
	{
		//get image extension.
		$ext=Tools::getExtension($img_name);
		//creates the new image using the appropriate function from gd library
		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
			$src_img=imagecreatefromjpeg($img_name);
		
		if(!strcmp("png",$ext))
			$src_img=imagecreatefrompng($img_name);
		
		//gets the dimmensions of the image
		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
		
		// next we will calculate the new dimmensions for the thumbnail image
		// the next steps will be taken:
		// 1. calculate the ratio by dividing the old dimmensions with the new ones
		// 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
		// and the height will be calculated so the image ratio will not change
		// 3. otherwise we will use the height ratio for the image
		// as a result, only one of the dimmensions will be from the fixed ones
		$ratio1=$old_x/$new_w;
		$ratio2=$old_y/$new_h;
		if($ratio1>$ratio2) {
			$thumb_w=$new_w;
			$thumb_h=$old_y/$ratio1;
		}
		else {
			$thumb_h=$new_h;
			$thumb_w=$old_x/$ratio2;
		}
		
		// we create a new image with the new dimmensions
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		
		// resize the big image to the new created one
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
		
		// output the created image to the file. Now we will have the thumbnail into the file named by $filename
		if(!strcmp("png",$ext))
			imagepng($dst_img,$filename);
		else
			imagejpeg($dst_img,$filename);
		
		//destroys source and destination images.
		imagedestroy($dst_img);
		imagedestroy($src_img);
	}
	
	// This function reads the extension of the file.
	// It is used to determine if the file is an image by checking the extension.
	public static function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	/**
	 * element_copy function
	 * 
	 * array copy by key filter helper function.
	 * for example, 
	 * 	$a = array('name' : 1, 'age' : 2, 'desc' : 'He is an excellent student');
	 * 	we want a copy $a to $by but only name and age key value.
	 *  then we use $b = element_copy($a, 'name', 'age');
	 * 
	 * @param array $src source array
	 * @param ...  parameter list key for copying 
	 * 
	 * @author zotiger
	 * @since 2011-11-07
	 */
	public static function element_copy()
	{
		/*
		$dst = array();
		foreach ($filter as $key)
			$dst[$key] = $src[$key];
		
		return $dst;
		*/
		$params = func_get_args();
		$array = array_shift($params);
		return array_intersect_key($array, array_flip($params));
	}
	
	public static function get_default_val($val, $def)
	{
		if ($val == '')
			return $def;
		return $val;
	}

    /*
     * get user continenet code
     *
     * @author zotiger
     * @created 2012-11-16
     */
    public static function getUserContinentCode($companyId)
    {
        if ($companyId == 0) // when admin user
        {
            return 'AS'; // return asia
        }

        // get continent code from company id
        $sql = "
        select A.ContinentCode from HT_Country AS A, HT_Company as B where A.`CountryId` = B.`CountryId` and B.`CompanyId` = {$companyId}
        ";

        return Db::getInstance()->getValue($sql);
    }

    /*
     * get country name by primary id
     *
     * @author zotiger
     * @created 2012-11-17
     */
    public static function getCountryName($countryId)
    {
    	global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);
		
        $sql = "
        select A.`CountryName_".$iso."`
        from HT_Country as A
        where A.`CountryId` = $countryId
        ";

        return Db::getInstance()->getValue($sql);
    }

    public static function money($money)
    {
        return '￥'.number_format($money);
    }

	public static function ordermail($orderid) {
    	$year = date('Y');
    	$month = date('m');
    	$day = date('d');
    	$hour = date('H');
    	$minute = date('i');
    	$second = date('s');
    	$apm = date('A');
    	
    	$bookingInfo = Booking::getBookingOrder($orderid);	//获取BookingNo, CheckIn, CheckOut
    	$BookingNo = $bookingInfo['BookingNo'];
    	$CheckIn = $bookingInfo['checkin'];
    	$CheckOut = $bookingInfo['checkout'];

    	$hotelid = $bookingInfo['hotel_id'];
    	$orderStatus = $bookingInfo['OrderStatusId'];	//获取订单状态
    	$paymentMethod = $bookingInfo['paymentMethod'];	//获取支付方式
    	
    	$RoomType = RoomPlan::getRoomTypeListByOrderId($orderid);	//获取RoomTypeList
    	
    	$userid = $bookingInfo['OrderUserId'];	//获取AgentName, GuestName, to
    	$userinfo = Member::getUserInfoById($userid);
    	$GuestName = $userinfo['Name'];
    	
    	$to = $userinfo['Email'];
    	$languageid = $userinfo['LanguageID'];
    	$roleId = $userinfo['RoleID'];
    	
    	$iso = $userinfo['LanguageShortName'];
    	$hotelinfo = HotelDetail::getHotelDescription($hotelid, $iso);
    	$HotelName = $hotelinfo['HotelName'];
    	
    	$AgentName = '';
    	if ($roleId == 2 || $roleId == 3) {
    		$AgentName = $userinfo['CompanyName'];	
    	}
        $CustomerName=Member::getCustomerList($orderid);
        $CustomerName=$CustomerName[0]['CustomerFamilyName'].' '.$CustomerName[0]['CustomerGivenName'];
		include_once substr(dirname(__FILE__), 0, -8).'/config/mail.config.php';
    	global $from, $message, $subject;
    	
		$Url = "http://tas-agent.com/booking_order.php?booking=edit&oid=".$orderid;

    	$search = array('{#year}', '{#month}', '{#day}', '{#hour}', '{#minute}', '{#second}', '{#apm}', '{#Url}',   
   							'{#AgentName}', '{#BookingNo}', '{#HotelName}', '{#GuestName}', '{#CheckIn}', '{#CheckOut}', '{#RoomType}', '{#CustomerName}');
   		$replace = array($year, $month, $day, $hour, $minute, $second, $apm, $Url, 
   							$AgentName, $BookingNo, $HotelName, $GuestName, $CheckIn, $CheckOut, $RoomType,$CustomerName);

		if ($orderStatus == 9 && $paymentMethod == 1) $orderStatus = 3;	    							

		$headers = "From: {$from}" . "\r\n";
		$headers .= 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
		
		if ($orderStatus == 3 && $paymentMethod == 1) {
   			$msg = str_replace($search, $replace, $message[$orderStatus][4][$languageid]);
			$sub = str_replace('{#BookingNo}', $BookingNo, $subject[$orderStatus][4][$languageid]);   
			if ($sub != '' && $msg != '') {
				//@mail($to, $sub, $msg, $headers);
                self::sendEmail($to,$sub,$msg);
				$msg = htmlentities($msg);
				$sql = 'insert into `HT_Mail`(MailTo, MailFrom, SubjectName, Body) value("'.$to.'", "'.$from.'", "'.$sub.'", "'.$msg.'")';
				Db::getInstance ()->ExecuteS ( $sql );
			}
		} else {
			$msg = str_replace($search, $replace, $message[$orderStatus][3][$languageid]);
			$sub = str_replace('{#BookingNo}', $BookingNo, $subject[$orderStatus][3][$languageid]);    	
    		if ($sub != '' && $msg != '') {
    			//@mail($to, $sub, $msg, $headers);
                self::sendEmail($to,$sub,$msg);
    			$msg = htmlentities($msg);
				$sql = 'insert into `HT_Mail`(MailTo, MailFrom, SubjectName, Body) value("'.$to.'", "'.$from.'", "'.$sub.'", "'.$msg.'")';
				Db::getInstance ()->ExecuteS ( $sql );
    		}
		}
    	
    	if ($orderStatus != 3) {
    		global $toemail;

			$msg = str_replace($search, $replace, $message[$orderStatus][4][4]);
			$sub = str_replace('{#BookingNo}', $BookingNo, $subject[$orderStatus][4][4]);    	
	    	if ($sub != '' && $msg != '') {
	    		//@mail($toemail, $sub, $msg, $headers);
                self::sendEmail($toemail,$sub,$msg);
	    		$msg = htmlentities($msg);
				$sql = 'insert into `HT_Mail`(MailTo, MailFrom, SubjectName, Body) value("'.$toemail.'", "'.$from.'", "'.$sub.'", "'.$msg.'")';
				Db::getInstance ()->ExecuteS ( $sql );
	    	}
    	}
    }

    //给hotel发信
    public static function emailHotel($orderid, $orderstatus) {
    	//1.获取订单信息
    	$bookingInfo = Booking::getBookingOrder($orderid);
		$BookingNo = $bookingInfo['BookingNo'];	//订单编号
		
		$ContactName = $bookingInfo['contact_name'];	//1.Customer Information
		$ContactEmail = $bookingInfo['contact_email'];
		$ContactTel = $bookingInfo['contact_tel'];
    	$CheckIn = $bookingInfo['checkin'];
    	$CheckOut = $bookingInfo['checkout'];

    	//2.获取下订单的用户信息
    	$userid = $bookingInfo['OrderUserId'];
    	$userinfo = Member::getUserInfoById($userid);
    	
    	$AgentName = $userinfo['Name'];
    	$AgentPhoneNo = $userinfo['Tel'];
    	$AgentEmail = $userinfo['Email'];
    	
    	//3.获取酒店用户信息
    	$hotelid = $bookingInfo['hotel_id'];
    	$hoteluserinfo = Member::getUserInfoByHotelId($hotelid);
    	$UserName = $hoteluserinfo['Name'];

		$prefFax = $hoteluserinfo['PrefFax'];
		$prefEmail = $hoteluserinfo['PrefEmail'];
		
		$Fax = $hoteluserinfo['Fax'];
		$to = $hoteluserinfo['Email'];

		$languageid = $hoteluserinfo['LanguageID'];   
		$iso = $hoteluserinfo['LanguageShortName'];
		if(!isset($hoteluserinfo['LanguageID'])){
            $languageid=4;
        }
		//4.获取酒店信息
		$hotelinfo = HotelDetail::getHotelDescription($hotelid, $iso);
		$HotelName = $hotelinfo['HotelName'];
		$HotelAddress = $hotelinfo['HotelAddress'];
		$HotelContactNo = $hotelinfo['HotelContactNo'];
		
		$orderroominfo = RoomPlan::getOrderRoomInfo($orderid, $iso);
		$RoomList = '';
        $RoomListFax='';
		$id = 1;
		foreach ($orderroominfo as $orderroom) {
			$RoomList .= "<table  width='100%' cellspacing='10' style='font-size:12px;'>
				<tr>
					<td colspan=2><span style='color:#000000;font-weight:bold;font-zie:14px;'>- Room ".$id."</span></td>
				</tr>
				<tr>
					<td colspan=2><span>Room Plan(宿泊プラン):</span> ".$orderroom['RoomPlanName']." </td>
				</tr>
				<tr>
					<td colspan=2><span>Room Type(ルームタイプ):</span> ".$orderroom['RoomTypeName']." </td>				
				</tr> 
				<tr>
					<td colspan=2><span>Guest Name(宿泊者名):</span> ".$orderroom['CustomerName']."</td>
				</tr>
				<tr>
					<td width='30%'><span>Breakfast(朝食):</span> ".$orderroom['Breakfast']."</td>			
					<td><span>Dinner(夕食):</span> ".$orderroom['Dinner']."</td>
				</tr>
				<tr>
					<td colspan=2><span>Special Request(特別リクエスト):</span> ".$orderroom['Special']." </td>
				</tr>
				<tr>
					<td colspan=2><span>* All Special request are subjects to availability </span></td>
				</tr>
			</table>";
            $RoomListFax .= "<table  width=190 >
         				<tr>
         					<td width=5></td><td colspan=2 size=11>- Room ".$id."</td>
         				</tr>
         				<tr>
         					<td width=5></td><td colspan=2>Room Plan(宿泊プラン): ".$orderroom['RoomPlanName']." </td>
         				</tr>
         				<tr>
         					<td width=5></td><td colspan=2>Room Type(ルームタイプ): ".$orderroom['RoomTypeName']." </td>
         				</tr>
         				<tr>
         					<td width=5></td><td colspan=2>Guest Name(宿泊者名): ".$orderroom['CustomerName']."</td>
         				</tr>
         				<tr>
         					<td width=5></td><td>Breakfast(朝食): ".$orderroom['Breakfast']."</td>
         					<td>Dinner(夕食): ".$orderroom['Dinner']."</td>
         				</tr>
         				<tr>
         					<td width=5></td><td colspan=2>Special Request(特別リクエスト): ".$orderroom['Special']." </td>
         				</tr>
         				<tr>
         					<td width=5></td><td colspan=2>* All Special request are subjects to availability </td>
         				</tr>
         			</table>";
			$id++;
		}
		$RoomString = RoomPlan::getRoomString($orderid, $iso);
		
		include_once substr(dirname(__FILE__), 0, -8).'/config/mail.config.php';
    	global $from, $message, $subject;
    		
		$search = array('{#BookingNo}', 
			'{#HotelName}', '{#UserName}',
			'{#HotelAddress}', '{#HotelContactNo}', 
			'{#ContactName}', '{#ContactEmail}', '{#ContactTel}', 
			'{#CheckIn}', '{#CheckOut}',
			'{#RoomString}', '{#RoomList}', 
			'{#AgentName}', '{#AgentPhoneNo}', '{#AgentEmail}');
		$replace = array($BookingNo,
			$HotelName, $UserName, 
			$HotelAddress, $HotelContactNo,
			$ContactName, $ContactEmail, $ContactTel,
			$CheckIn, $CheckOut,
			$RoomString, $RoomList,
			$AgentName, $AgentPhoneNo, $AgentEmail);
        $replaceFax = array($BookingNo,
      			$HotelName, $UserName,
      			$HotelAddress, $HotelContactNo,
      			$ContactName, $ContactEmail, $ContactTel,
      			$CheckIn, $CheckOut,
      			$RoomString, $RoomListFax,
      			$AgentName, $AgentPhoneNo, $AgentEmail);
		$msg = str_replace($search, $replace, $message[10][5][$languageid]);
       // $faxmsg = str_replace($search, $replaceFax, $message[21][5][$languageid]);
        $faxmsg = str_replace($search, $replaceFax, $message[21][5][4]);
		$sub = str_replace('{#BookingNo}', $BookingNo, $subject[$orderstatus][5][$languageid]);
		if ($orderstatus == 7) {
			$msg = str_replace('下記の予約をお願いいたします', '下記の予約のキャンセルをお願いいたします', $msg);
			$faxmsg = str_replace('下記の予約をお願いいたします', '下記の予約のキャンセルをお願いいたします', $faxmsg);
		}
		if ($prefEmail) {
			$headers = "From: {$from}" . "\r\n";
			$headers .= 'MIME-Version: 1.0'."\r\n";
			$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
			$headers .= 'Bcc: booking@tas-agent.com';
            //echo $sub."<br/><br/><br/>".$msg;
			if ($sub != '' && $msg != '') {
				global $emailTail;
				$msgBody = $msg.$emailTail;
                self::sendEmail($to,$sub,$msg);
				//@mail($to, $sub, $msgBody, $headers);
				$Insertmsg = htmlentities($msg);
				$sql = 'insert into `HT_Mail`(MailTo, MailFrom, SubjectName, Body) value("'.$to.'", "'.$from.'", "'.$sub.'", "'.$Insertmsg.'")';
				Db::getInstance ()->ExecuteS ( $sql );
			}
		}
		
		if ($prefFax) {
			global $toemail, $faxTail, $faxHead;

            $emailBody = "<p>需要给酒店发送传真.</p>
						<p>传真号为: {$Fax}</p>
						<p>订单状态为: {$orderstatus}</p>";
            $emailBody="fax";
            $faxsub = $faxHead[$orderstatus];
            $faxsub2 = "<TAS-Agent.com> Booking ID:". $BookingNo;
            $prefix = time();
            require_once(_TAS_TOOL_DIR_ . "/tfpdf/pdffax.inc.php");
            $defFont = 'MyFont';
            $pdf = new PDFTable();
            $pdf->AddFont($defFont, '', 'ARIALUNI.TTF', true);
            $pdf->AddFont($defFont . 'B', '', 'ARIALUNI.TTF', true);
            $pdf->SetMargins(10, 2);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetPadding(0);
            $pdf->SetSpacing(0, 0);
            $pdf->AddPage();
            //header
            $pdf->SetFont($defFont, '', 10);
            $pdf->Image(_TAS_THEME_DIR_ . "/img/logo_pdf.png", 140, 15, 60);
            $pdf->htmltable("<table width=190><tr><td size=20 > </td></tr></table>", 1);
            $pdf->Ln(2);
            $pdf->htmltable("<table width=190><tr><td size=14 colspan=2>" . $faxsub . " </td></tr>
           	    </table>", 1);
            $pdf->Image(_TAS_THEME_DIR_ . "/img/linep.png", 10, $pdf->y, 190);
            //内容
            $pdf->htmltable($faxmsg);

            //footer
            $pdf->SetY(-30);
            $pdf->Image(_TAS_THEME_DIR_ . "/img/linep.png", 10, $pdf->y, 190);
            $pdf->Ln(1);
            $pdf->Image(_TAS_THEME_DIR_ . "/img/bottom_logo_pdf.png", 12, $pdf->y + 2, 20);
            $pdf->x = 35;
            $pdf->htmltable("<table width=90>
    	    <tr><td size=9>TAS Agent / TAS Co.Ltd<br>TEL 03-5565-5850<br>FAX 03-5565-5850<br>booking@tas-agent.com</td></tr>
    	    </table>", 0);
            $pdf->htmltable("<table width=190>
                	    <tr><td size=9>※TAS Agent はTAS Co.,Ltdが運営しております。　上記予約の内容については直接TASまでご連絡ください。
                	    </td></tr></table>", 1);

            $attachment_file = _TAS_ROOT_DIR_ . "/classes/temp/attachment_" . $prefix . ".pdf";
            //$attachment_file=_TAS_ROOT_DIR_."/config/attachment_".$prefix.".pdf";
            $pdf->Output($attachment_file);

            require_once(_TAS_TOOL_DIR_ . "/PHPMailer/class.phpmailer.php");
            $mail = new PHPMailer();
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->SMTPAuth = true; // enable SMTP authentication
            $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
            $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
            $mail->Port = 465; // set the SMTP port for the GMAIL server
            $mail->Username = "fax-send@tas-japan.net"; // GMAIL username
            $mail->Password = "tas1980fax"; // GMAIL password
            $mail->SetFrom('fax-send@tas-japan.net', 'fax');
            $mail->AddReplyTo("fax-send@tas-japan.net", "fax");
            $mail->Subject = $faxsub2;
            $mail->MsgHTML($emailBody);
            $toemail=$Fax."@efaxsend.com";
            $mail->AddAddress($toemail, $Fax);
            $mail->AddAttachment($attachment_file); // attachment
            $mail->Send();//发邮件

            if (file_exists($attachment_file)) {
                   unlink($attachment_file);//删除文件
            }

        }
    }
    public static function sendEmail($to, $Subject, $emailBody,$name='tas-agent',$from='noreply@tas-japan.net') {
         require_once(_TAS_TOOL_DIR_ . "/PHPMailer/class.phpmailer.php");
         $mail = new PHPMailer();
         $mail->IsSMTP(); // telling the class to use SMTP
         $mail->CharSet='utf-8';
         $mail->SMTPAuth = true; // enable SMTP authentication
         $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
         $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
         $mail->Port = 465; // set the SMTP port for the GMAIL server
         $mail->Username = "noreply@tas-japan.net"; // GMAIL username
         $mail->Password = "tas1980?5514"; // GMAIL password
         $mail->SetFrom($from,$name);
        // $mail->AddReplyTo("fax-send@tas-japan.net", "fax");
         $mail->Subject = $Subject;
         $mail->MsgHTML($emailBody);
        // $toemail=$Fax."@efaxsend.com";
         $mail->AddAddress($to);
        // $mail->AddAttachment($attachment_file); // attachment
         $mail->Send();//发邮件
    }

    public static function echo_str($str='') {
        ob_clean();
        echo($str);
        exit;
    }

	public static function is_Hotel($company_id)
	{
		if ($company_id == 0) {
			return false;
		}
		$sql = "select HotelId from `HT_User` where CompanyID=" . $company_id;
		$HotelId = Db::getInstance()->getValue($sql);
		if ($HotelId > 0) {
			return true;
		} else {
			return false;
		}
	}
}
