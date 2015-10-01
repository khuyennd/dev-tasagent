<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class HotelFeature extends ObjectModel
{
	public 		$FeatureId;
	
	
	/** @var string LoginUserName */
	public 		$FeatureName;
    public 		$FeatureName_en;
    public 		$FeatureName_jp;
    public 		$FeatureName_S_CN;
    public 		$FeatureName_T_CN;
	/** @var integer FeatureType */
	public		$FeatureType;
	
	/** @var string Object creation date */
	public 		$CreateDate;

	/** @var string Object last modification date */
	public 		$UpdateDate;
	
	protected $tables = array ('Feature');

 	protected 	$fieldsRequired = array('FeatureType', 'FeatureName');
 	protected 	$fieldsSize = array('FeatureName' => 64);
 	protected 	$fieldsValidate = array();
	protected	$exclude_copy_post = array();

	protected 	$table = 'Feature';
	protected 	$identifier = 'FeatureId';

	public function getFields()
	{
		parent::validateFields();
		if (isset($this->FeatureId))
			$fields['FeatureId'] = (int)($this->FeatureId);
		
		$fields['FeatureName'] = pSQL($this->FeatureName);
		$fields['FeatureType'] 	= (int)($this->FeatureType);
		$fields['CreateDate'] = pSQL($this->CreateDate);
        $fields['FeatureName_en'] = pSQL($this->FeatureName_en);
        $fields['FeatureName_jp'] = pSQL($this->FeatureName_jp);
        $fields['FeatureName_S_CN'] = pSQL($this->FeatureName_S_CN);
        $fields['FeatureName_T_CN'] = pSQL($this->FeatureName_T_CN);
		return $fields;
	}

	public function add($autodate = true, $nullValues = true)
	{
	 	if (!parent::add($autodate, $nullValues))
			return false;
			
		$this->FeatureId = $this->id;
		return true;
	}

	public function update($nullValues = false)
	{
	 	return parent::update(true);
	}

	public static function DeleteFeatures($aid) {
		if ($aid == "") return;
		Db::getInstance()->Execute('delete from `'._DB_PREFIX_.'Feature` WHERE `FeatureId` = '.(int)($aid));
	}
	
	public static function getFeatureCount($swhere) {
 		return (int)Db::getInstance()->getValue('
		SELECT count(*)
		FROM `'._DB_PREFIX_.'Feature` 
		WHERE 1 = 1
		'.(($swhere == "") ? "" : ' AND '.$swhere) );
 	}
	/*
	 * Return hotel list
	 *
	 * @return array Hotels
	 */
	public static function getFeatureList($swhere, $p, $n, $orderBy = NULL, $orderWay = NULL, $iso = "")
	{
		if ($p < 1) $p = 1;
	 	if (empty($orderBy) ||$orderBy == 'position') $orderBy = 'name';
	 	if (empty($orderWay)) $orderWay = 'ASC';
	 	
		global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);

		return Db::getInstance()->ExecuteS('
		SELECT `FeatureId`, `FeatureType`, `FeatureName_'.$iso.'` as FeatureName, `FeatureInformation`, `CreateDate` 
		FROM `'._DB_PREFIX_.'Feature` 
		WHERE 1 = 1 
		'.(($swhere == "") ? "" : ' AND '.$swhere) .' 
		ORDER BY FeatureId DESC' 
		.($p ? ' LIMIT '.(((int)($p) - 1) * (int)($n)).','.(int)($n) : ''));
	}
	
	/*
	 * Return All Hotel Features
	 */
	public static function getAllFeatures($iso = "") {
		global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);

		return Db::getInstance()->ExecuteS('
		SELECT `FeatureId`, `FeatureType`, `FeatureName_'.$iso.'` as FeatureName, `FeatureInformation`, `CreateDate` 
		FROM `'._DB_PREFIX_.'Feature`
		ORDER BY FeatureType ASC, FeatureId ASC');
	}
}
