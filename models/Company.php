<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}

class Company extends ObjectModel
{
	public 		$CompanyId;
	
	public 		$AgentID;
	/** @var string CompanyName */
	public 		$CompanyName;
	
	/** @var integer CountryId */
	public		$CountryId;
	
	/** @var string City */
	public 		$City;
	
	/** @var String Address */
	public 		$Address;
	
	/** @var String Website */
	public		$Website; 
	
	/** @var String ManagingDirector */ 
	public		$ManagingDirector;
	
	/** @var String Tel */
	public 		$Tel;
	
	/** @var string Fax */
	public 		$Fax;
	
	public		$PrefFax;
	public		$PrefEmail;
	public		$PaymentMethod;
    public      $ShouShu;
    public      $ShouShuType;
	
	protected $tables = array ('Company');

 	protected 	$fieldsRequired = array('CompanyName',  'City', 'Website', 'ManagingDirector', 'Tel');
 	protected 	$fieldsSize = array('CompanyName' => 128, 'City' => 128, 'Website' => 256, 'ManagingDirector' => 128, 'Tel' => 20);
 	protected 	$fieldsValidate = array('CountryId' => 'isUnsignedId');
	protected	$exclude_copy_post = array();

	protected 	$table = 'Company';
	protected 	$identifier = 'CompanyId';

	public function getFields()
	{
		parent::validateFields();
		if (isset($this->CompanyId))
			$fields['CompanyId'] = (int)($this->CompanyId);
			
		$fields['AgentID'] = pSQL($this->AgentID);
		$fields['CompanyName'] = pSQL($this->CompanyName);
		$fields['CountryId'] 	= (int)($this->CountryId);
		$fields['City'] 		= pSQL($this->City);
		$fields['Address'] = pSQL($this->Address);
		$fields['Website'] = pSQL($this->Website);
		$fields['ManagingDirector'] = pSQL($this->ManagingDirector);
		$fields['Tel'] = pSQL($this->Tel);
		$fields['Fax'] = pSQL($this->Fax);
		$fields['PrefFax'] 	= (int)($this->PrefFax);
		$fields['PrefEmail'] 	= (int)($this->PrefEmail);
		$fields['PaymentMethod'] 	= (int)($this->PaymentMethod);
        $fields['ShouShu'] 	= (float)($this->ShouShu);
        $fields['ShouShuType'] 	= (int)($this->ShouShuType);
		return $fields;
	}

	public function add($autodate = false, $nullValues = true)
	{
	 	if (!parent::add($autodate, $nullValues))
			return false;
		$this->CompanyId = $this->id;
		return true;
	}

	public function update($nullValues = false)
	{
	 	return parent::update(false);
	}

	public function delete()
	{
		$addresses = $this->getAddresses((int)(Configuration::get('PS_LANG_DEFAULT')));
		foreach ($addresses AS $address)
		{
			$obj = new Address((int)($address['id_address']));
			$obj->delete();
		}
		Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'customer_group` WHERE `id_customer` = '.(int)($this->id));
		Discount::deleteByIdCustomer((int)($this->id));
		return parent::delete();
	}
	
	/*
	 * Return customers list
	 *
	 * @return array Customers
	 */
	public static function getCustomers()
	{
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
		SELECT `id_customer`, `email`, `firstname`, `lastname`
		FROM `'._DB_PREFIX_.'customer`
		ORDER BY `id_customer` ASC');
	}


	/*
	 * Light back office search for customers
	 *
	 * @param string $query Searched string
	 * @return array Corresponding customers
	 */
	public static function searchByName($query)
	{
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
		SELECT c.*
		FROM `'._DB_PREFIX_.'customer` c
		WHERE c.`email` LIKE \'%'.pSQL($query).'%\'
		OR c.`id_customer` LIKE \'%'.pSQL($query).'%\'
		OR c.`lastname` LIKE \'%'.pSQL($query).'%\'
		OR c.`firstname` LIKE \'%'.pSQL($query).'%\'');
	}

	
	public function isUsed()
	{
		return false;
	}
	
	public static function isExistAgentID($agentId, $cid) {
		$result = Db::getInstance()->getRow('
		SELECT *
		FROM `'._DB_PREFIX_	.'Company`
		WHERE `AgentID` = \''.pSQL($agentId).'\'' .(($cid!=0) ? " AND CompanyId <> ".$cid : "")
		);
		
		if (!$result)
			return false;
		return true;
	}
	

}
