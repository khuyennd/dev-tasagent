<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class FrontController
{
	public $errors = array();
	protected static $smarty;
	protected static $cookie;
	public $iso;

	public $orderBy;
	public $orderWay;
	public $p;
	public $n;

	public $auth = true; // Must Login for use this system
	public  $brandNavi = array();
	protected $restrictedCountry = false;
	
	public static $initialized = false;
	

	public function __construct()
	{
	}

	public function run()
	{
		$this->init();
		if (!isset($_GET['ajaxType']))  $this->preProcess();	
		if (!isset($_GET['ajaxType']))	$this->displayHeader();
		$this->process();
		$this->displayContent();
		if (!isset($_GET['ajaxType']))	$this->displayFooter();
	}

	public function init()
	{
		global  $cookie, $smarty, $iso, $defaultCountry, $protocol_link, $protocol_content, $css_files, $js_files;

		if (self::$initialized)
			return;
		self::$initialized = true;

		$css_files = array();
		$js_files = array();

		
		ob_start();

		/* Loading default country */
		$cookieLifetime = (time() + (((int)Configuration::get('TAS_COOKIE_LIFETIME_FO') > 0 ? (int)Configuration::get('TAS_COOKIE_LIFETIME_FO') : 1)* 3600));

		$cookie = new Cookie('tas', '', $cookieLifetime);
		//var_dump($cookie);

		if ($this->php_self != "login.php") { // If calling url is not login.php then check user is logged
			if ($this->auth AND !$cookie->isLogged(false)) {//echo "test";die;
				$this->authRedirection = urlencode($_SERVER['REQUEST_URI']);
				Tools::redirect('login.php'.($this->authRedirection ? '?back='.$this->authRedirection : ''));
			}
		}

		/* Theme is missing or maintenance */
		if (!is_dir(_TAS_THEME_DIR_))
			die(Tools::displayError('Current theme unavailable. Please check your theme directory name and permissions.'));
		
		
		Tools::setCookieLanguage();

		/* attribute LanguageID is often needed, so we create a constant for performance reasons */
		if (!defined('_USER_ID_LANG_'))
			define('_USER_ID_LANG_', (int)$cookie->LanguageID);
		
		 
		
		if (isset($_GET['logout']) OR ($cookie->logged AND Member::isBanned((int)$cookie->UserID)))
		{
			$cookie->logout();
			Tools::redirect("index.php");
		}
		elseif (isset($_GET['mylogout']))
		{
			$cookie->mylogout();
			Tools::redirect("index.php");
		}

		if (Validate::isLoadedObject($tas_language = new Language((int)$cookie->LanguageID)))
			$smarty->tas_language = $tas_language;
			
		$iso = $tas_language->LanguageShortName;
		/* get page name to display it in body id */
		$page_name = (isset($this->php_self) ? preg_replace('/\.php$/', '', $this->php_self) : '');
		
		$smarty->assign(Tools::getMetaTags($cookie->LanguageID, $page_name));
		$smarty->assign('request_uri', Tools::safeOutput(urldecode($_SERVER['REQUEST_URI'])));

		$protocol_link = 'http://';
		$protocol_content = 'http://';
		
		$smarty->assign(array(
			'cookie' => $cookie,
			'page_name' => $page_name,
			'base_dir' => __TAS_BASE_URI__,
			'tpl_dir' => _TAS_THEME_DIR_,
			'lang_iso' => $iso,
			'come_from' => Tools::getHttpHost(true, true).Tools::htmlentitiesUTF8(str_replace('\'', '', urldecode($_SERVER['REQUEST_URI']))),
			'languages' => Tools::getLanguages(),
			'sl_lang' => $cookie->LanguageID, 
			'shop_name' => 'TAS',
			
		));

		// Deprecated
		$smarty->assign(array(
			'logged' => $cookie->isLogged(),
			'userName' => ($cookie->logged ? $cookie->LoginUserName : false)
		));

		// TODO for better performances (cache usage), remove these assign and use a smarty function to get the right media server in relation to the full ressource name
		$assignArray = array(
			'img_dir' => _THEME_IMG_DIR_,
			'css_dir' => _THEME_CSS_DIR_,
			'js_dir' => _THEME_JS_DIR_
		);
	
		foreach ($assignArray as $assignKey => $assignValue)
				$smarty->assign($assignKey, $assignValue);

		// setting properties from global var
		self::$cookie = $cookie;
		self::$smarty = $smarty;
		
		$this->iso = $iso == "" ? "en" : $iso;
		$this->setMedia();
	}

	public function preProcess()
	{
	}

	public function setMedia()
	{
		Tools::addCSS(_THEME_CSS_DIR_.'default.css', 'all');
		Tools::addCSS(_THEME_CSS_DIR_.'font_'.$this->iso.'.css', 'all');
		Tools::addCSS(_THEME_CSS_DIR_.'style.css', 'all');
		Tools::addCSS(_THEME_CSS_DIR_.'slider.css', 'all');
		Tools::addCSS(_THEME_CSS_DIR_.'flatWeatherPlugin.css', 'all');
		Tools::addJS(_THEME_JS_DIR_.'jquery-1.8.2.min.js');
		//Tools::addJS(_THEME_JS_DIR_.'common.js');
      	Tools::addJS(_THEME_JS_DIR_.'common_'.$this->iso.'.js');
	}

	public function process()
	{
	}

	public function displayContent()
	{
		Tools::safePostVars();
		self::$smarty->assign('errors', $this->errors);
		
	}

	public function displayHeader()
	{
		global $css_files, $js_files;

		if (!self::$initialized)
			$this->init();

		// P3P Policies (http://www.w3.org/TR/2002/REC-P3P-20020416/#compact_policies)
		header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

		/* Hooks are volontary out the initialize array (need those variables already assigned) */
		self::$smarty->assign(array(
			'time' => time(),
			'static_token' => Tools::getToken(false),
			'token' => Tools::getToken(),
			'content_only' => $this->content_only
		));
        self::$smarty->assign('CheckInDay', date('Y-m-d', strtotime("5 day")));
        self::$smarty->assign('CheckOutDay', date('Y-m-d', strtotime("6 day")));
		self::$smarty->assign('css_files', $css_files);
		self::$smarty->assign('js_files', array_unique($js_files));
		self::$smarty->assign('brandNavi', $this->brandNavi);
		self::$smarty->assign('popAreaList', Db::getInstance()->ExecuteS("select *, AreaName_".$this->iso." as AreaName from HT_Area where IsPopular = 1"));
		self::$smarty->display(_TAS_THEME_DIR_.'common/header.tpl');
	}

	public function displayFooter()
	{

		if (!self::$initialized)
			$this->init();

		self::$smarty->display(_TAS_THEME_DIR_.'common/footer.tpl');
		Tools::displayError();
	}

	public function productSort()
	{
		if (!self::$initialized)
			$this->init();

		$stock_management = (int)(Configuration::get('PS_STOCK_MANAGEMENT')) ? true : false; // no display quantity order if stock management disabled
		$this->orderBy = Tools::getProductsOrder('by', Tools::getValue('orderby'));
		$this->orderWay = Tools::getProductsOrder('way', Tools::getValue('orderway'));

		self::$smarty->assign(array(
			'orderby' => $this->orderBy,
			'orderway' => $this->orderWay,
			'orderbydefault' => Tools::getProductsOrder('by'),
			'orderwayposition' => Tools::getProductsOrder('way'), // Deprecated: orderwayposition
			'orderwaydefault' => Tools::getProductsOrder('way'),
			'stock_management' => (int)($stock_management)));
	}

	public function pagination($nbProducts = 10)
	{
		if (!self::$initialized)
			$this->init();

		$nArray = (int)(Configuration::get('TAS_ITEMS_PER_PAGE')) != 20 ? array((int)(Configuration::get('TAS_ITEMS_PER_PAGE')), 20) : array(20);
		// Clean duplicate values
		$nArray = array_unique($nArray);
		asort($nArray);
		$this->n = abs((int)(Tools::getValue('n', ((isset(self::$cookie->nb_item_per_page) AND self::$cookie->nb_item_per_page >= 20) ? self::$cookie->nb_item_per_page : (int)(Configuration::get('TAS_ITEMS_PER_PAGE'))))));
		
		$this->p = abs((int)(Tools::getValue('p', 1)));

		
		$current_url = tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']);
		//delete parameter page
		$current_url = preg_replace('/(\?)?(&amp;)?p=\d+/', '$1', $current_url);

		$range = 2; /* how many pages around page selected */

		if ($this->p < 0)
			$this->p = 0;

		if (isset(self::$cookie->nb_item_per_page) AND $this->n != self::$cookie->nb_item_per_page AND in_array($this->n, $nArray))
			self::$cookie->nb_item_per_page = $this->n;

		if ($this->p > (($nbProducts / $this->n) + 1))
			$this->p = 1;

		$pages_nb = ceil($nbProducts / (int)($this->n));

		$start = (int)($this->p - $range);
		if ($start < 1)
			$start = 1;
		$stop = (int)($this->p + $range);
		if ($stop > $pages_nb)
			$stop = (int)($pages_nb);
		self::$smarty->assign('nb_products', $nbProducts);
		$pagination_infos = array(
			'products_per_page' => (int)Configuration::get('TAS_ITEMS_PER_PAGE'),
			'pages_nb' => $pages_nb,
			'p' => $this->p,
			'n' => $this->n,
			'nArray' => $nArray,
			'range' => $range,
			'start' => $start,
			'stop' => $stop,
			'current_url' => $current_url
		);
		self::$smarty->assign($pagination_infos);
	}

	protected static function isInWhitelistForGeolocation()
	{
		$allowed = false;
		$userIp = Tools::getRemoteAddr();
		$ips = explode(';', Configuration::get('PS_GEOLOCATION_WHITELIST'));
		if (is_array($ips) AND sizeof($ips))
			foreach ($ips AS $ip)
				if (!empty($ip) AND strpos($userIp, $ip) === 0)
					$allowed = true;
		return $allowed;
	}
	
	public function getSearchWhere() {
		$swhere = "";
		foreach ($this->searchField as $name=> $op) {
			$value = Tools::getValue($name);
			if ($value!=null && $value!="" ) {
				if ($op == "like") $value = '%'.$value.'%';
				if ($swhere != "") $swhere .= ' and '; 
				$swhere .= $name .' '.$op." '".$value."'";
			}
		}
		return $swhere;
	}
}

