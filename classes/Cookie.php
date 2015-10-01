<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class	Cookie
{
	/** @var array Contain cookie content in a key => value format */
	protected $_content;

	/** @var array Crypted cookie name for setcookie() */
	protected $_name;

	/** @var array expiration date for setcookie() */
	protected $_expire;

	/** @var array Website domain for setcookie() */
	protected $_domain;

	/** @var array Path for setcookie() */
	protected $_path;

	/** @var array cipher tool instance */
	protected $_cipherTool;

	/** @var array cipher tool initialization key */
	protected $_key;

	/** @var array cipher tool initilization vector */
	protected $_iv;
	
	protected $_modified = false;

	/**
	  * Get data if the cookie exists and else initialize an new one
	  *
	  * @param $name Cookie name before encrypting
	  * @param $path
	  */
	public function __construct($name, $path = '', $expire = NULL)
	{
		$this->_content = array();
		$this->_expire = isset($expire) ? (int)($expire) : (time() + 1728000);
		$this->_name = md5($name);
		$this->_path = trim(__TAS_BASE_URI__.$path, '/\\').'/';
		if ($this->_path{0} != '/') $this->_path = '/'.$this->_path;
		$this->_path = rawurlencode($this->_path);
		$this->_path = str_replace('%2F', '/', $this->_path);
		$this->_path = str_replace('%7E', '~', $this->_path);
		$this->_key = _COOKIE_KEY_;
		$this->_iv = _COOKIE_IV_;
		$this->_domain = $this->getDomain();
			$this->_cipherTool = new Blowfish($this->_key, $this->_iv);
		$this->update();
	}
	
	protected function getDomain()
	{
		$r = '!(?:(\w+)://)?(?:(\w+)\:(\w+)@)?([^/:]+)?(?:\:(\d*))?([^#?]+)?(?:\?([^#]+))?(?:#(.+$))?!i';
	    preg_match ($r, Tools::getHttpHost(false, false), $out);
		if (preg_match('/^(((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]{1}[0-9]|[1-9]).)'. 
         '{1}((25[0-5]|2[0-4][0-9]|[1]{1}[0-9]{2}|[1-9]{1}[0-9]|[0-9]).)'. 
         '{2}((25[0-5]|2[0-4][0-9]|[1]{1}[0-9]{2}|[1-9]{1}[0-9]|[0-9]){1}))$/', $out[4]))
			return false;
		if (!strstr(Tools::getHttpHost(false, false), '.'))
			return false;
		$domain = $out[4];
		/*
		$subDomains = SubDomain::getSubDomains();
		if ($subDomains === false)
			die(Tools::displayError('Bad SubDomain SQL query.'));
		foreach ($subDomains AS $subDomain)
		{
			$subDomainLength = strlen($subDomain) + 1;
			if (strncmp($subDomain.'.', $domain, $subDomainLength) == 0)
				$domain = substr($domain, $subDomainLength);
		}
		*/
		return $domain;
	}

	/**
	  * Set expiration date
	  *
	  * @param integer $expire Expiration time from now
	  */
	function setExpire($expire)
	{
		$this->_expire = (int)($expire);
	}

	/**
	  * Magic method wich return cookie data from _content array
	  *
	  * @param $key key wanted
	  * @return string value corresponding to the key
	  */
	public function __get($key)
	{
		return isset($this->_content[$key]) ? $this->_content[$key] : false;
	}

	/**
	  * Magic method which check if key exists in the cookie
	  *
	  * @param $key key wanted
	  * @return boolean key existence
	  */
	public function __isset($key)
	{
		return isset($this->_content[$key]);
	}

	/**
	  * Magic method wich add data into _content array
	  *
	  * @param $key key desired
	  * @param $value value corresponding to the key
	  */
	public function __set($key, $value)
	{
		if (is_array($value))
			die(Tools::displayError());
		if (preg_match('/¤|\|/', $key.$value))
			throw new Exception('Forbidden chars in cookie');
		if (!$this->_modified AND (!isset($this->_content[$key]) OR (isset($this->_content[$key]) AND $this->_content[$key] != $value)))
			$this->_modified = true;
		$this->_content[$key] = $value;
		$this->write();
	}

	/**
	  * Magic method wich delete data into _content array
	  *
	  * @param $key key wanted
	  */
	public function __unset($key)
	{
		if (isset($this->_content[$key]))
			$this->_modified = true;
		unset($this->_content[$key]);
		$this->write();
	}

	/**
	  * Check member informations saved into cookie and return member validity
	  *
	  * @return boolean member validity
	  */
	public function isLogged($withGuest = false)
	{
		
		/* member is valid only if it can be load and if cookie password is the same as database one */
	 	if ($this->logged == 1 AND $this->UserID AND Validate::isUnsignedId($this->UserID) AND Member::checkPassword((int)($this->UserID), $this->Password))
        	return true;
        return false;
	}

	/**
	  * Check employee informations saved into cookie and return employee validity
	  *
	  * @return boolean employee validity
	  */
	public function isLoggedBack()
	{
		/* Employee is valid only if it can be load and if cookie password is the same as database one */
	 	return ($this->UserID
			AND Validate::isUnsignedId($this->UserID)
			AND member::checkPassword((int)$this->UserID, $this->Password)
		);
	}

	/**
	  * Delete cookie
	  */
	public function logout()
	{
		$this->_content = array();
		$this->_setcookie();
		unset($_COOKIE[$this->_name]);
		$this->_modified = true;
		$this->write();
	}

	/**
	  * Soft logout, delete everything links to the member
	  * but leave there affiliate's informations
	  */
	public function mylogout()
	{
		unset($this->_content['UserID']);
		unset($this->_content['LoginUserName']);
		unset($this->_content['logged']);
		unset($this->_content['Password']);
		unset($this->_content['Email']);
		unset($this->_content['LanguageID']);
		unset($this->_content['RoleID']);
		unset($this->_content['CompanyID']);
		unset($this->_content['OldLoginUserName']);
		$this->_modified = true;
		$this->write();
	}
	
	function makeNewLog()
	{
		unset($this->_content['UserID']);
		$this->_modified = true;
	}

	/**
	  * Get cookie content
	  */
	function update($nullValues = false)
	{
		
		if (isset($_COOKIE[$this->_name]))
		{
			
			/* Decrypt cookie content */
			$content = $this->_cipherTool->decrypt($_COOKIE[$this->_name]);
			
			/* Get cookie checksum */
			$mbStrValue = ((1 << 1) & ini_get('mbstring.func_overload')) ? 1 : 2;
			$checksum = crc32($this->_iv.substr($content, 0, strrpos($content, '¤') + $mbStrValue));

			/* Unserialize cookie content */
			$tmpTab = explode('¤', $content);
			
			foreach ($tmpTab AS $keyAndValue)
			{
				$tmpTab2 = explode('|', $keyAndValue);
				if (sizeof($tmpTab2) == 2)
					 $this->_content[$tmpTab2[0]] = $tmpTab2[1];
			 }
			/* Blowfish fix */
			if (isset($this->_content['checksum']))
				$this->_content['checksum'] = (int)($this->_content['checksum']);

			/* Check if cookie has not been modified */
			if (!isset($this->_content['checksum']) OR $this->_content['checksum'] != $checksum)
				$this->logout();
			
			if (!isset($this->_content['date_add']))
				$this->_content['date_add'] = date('Y-m-d H:i:s');
		}
		else
			$this->_content['date_add'] = date('Y-m-d H:i:s');
		
		//checks if the language exists, if not choose the default language
		if (!Language::getLanguage((int)$this->LanguageID))
			$this->LanguageID = Configuration::get('TAS_LANG_DEFAULT');
		
	}

	/**
	  * Setcookie according to php version
	  */
	protected function _setcookie($cookie = NULL)
	{
		if ($cookie)
		{
			$content = $this->_cipherTool->encrypt($cookie);
			$time = $this->_expire;
		}
		else
		{
			$content = 0;
			$time = time() - 1;
		}
		if (PHP_VERSION_ID <= 50200) /* PHP version > 5.2.0 */
			return setcookie($this->_name, $content, $time, $this->_path, $this->_domain, 0);
		else
			return setcookie($this->_name, $content, $time, $this->_path, $this->_domain, 0, true);
	}

	/**
	  * Save cookie with setcookie()
	  */
	public function write()
	{
		$cookie = '';

		/* Serialize cookie content */
		if (isset($this->_content['checksum'])) unset($this->_content['checksum']);
		
		foreach ($this->_content AS $key => $value)
			$cookie .= $key.'|'.$value.'¤';

		/* Add checksum to cookie */
		$cookie .= 'checksum|'.crc32($this->_iv.$cookie);

		/* Cookies are encrypted for evident security reasons */
		return $this->_setcookie($cookie);
	}

	/**
	 * Get a family of variables (e.g. "filter_")
	 */
	public function getFamily($origin)
	{
		$result = array();
		if (count($this->_content) == 0)
			return $result;
		foreach ($this->_content AS $key => $value)
			if (strncmp($key, $origin, strlen($origin)) == 0)
				$result[$key] = $value;
		return $result;
	}

	/**
	 *
	 */
	public function unsetFamily($origin)
	{
		$family = $this->getFamily($origin);
		foreach (array_keys($family) AS $member)
			unset($this->$member);
	}

	/**
	 *
	 * @return String name of cookie
	 */
	public function getName()
	{
		return $this->_name;
	}
}
