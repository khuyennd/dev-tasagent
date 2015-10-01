<?php
/* This file was created by eclipse
 *
 * @author zotiger
 * @created 2012-11-05
 * @file Room Plan Manager
 */

if(!defined('IN_TAS')) {
	exit('Access Denied');
}

/**
 * RoomPlan class
 */
class  RoomPlan extends ObjectModel
{
	var $id;
	var $typeId;
	var $planName;
	var $planMaxRooms;
	var $startTime;
	var $endTime;
	var $size;
	var $planDesc;
	var $breakfast;
	var $dinner;
	var $active;
	
	/*
	 * getRoomPlanListByHotelId function
	 * 
	 * @param int $hotelId
	 * 
	 * @author zotiger
	 * @created 2012-11-05
	 */
	public static function getRoomPlanListByHotelId($hotelId)
	{
		$sql = 'select B.* '.
				'from '._DB_PREFIX_.'HotelRoomPlanLink as A, '._DB_PREFIX_.'RoomPlan as B '.
				'where A.HotelId = '.$hotelId.' AND A.RoomPlanId = B.RoomPlanId '.
				'order by A.ShowOrder ';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	/*
	 *  get room plan with price
	 *
	 */
	public static function getRoomPlanListDetailByHotelId($hotelId)
	{
		$sql = '
			SELECT
				 A.*, min(B.Price) AS MinPrice, C.RoomTypeName
			FROM
				(
					SELECT 
						B.*, C.ShowOrder
					FROM 
						HT_Hotel as A, HT_HotelRoomPlanLink as C, HT_RoomPlan as B 
					WHERE
						A.`HotelId` = C.`HotelId` AND B.`RoomPlanId` = C.RoomPlanId AND A.HotelId = '.$hotelId.'
				) as A left join HT_RoomStockAndPrice as B on A.RoomPlanId = B.`RoomPlanId` AND B.Price > 0
				, HT_RoomType as C
			WHERE
				A.RoomTypeId = C.RoomTypeId
			GROUP BY 
				A.RoomPlanId
			ORDER BY 
				A.ShowOrder, min(B.Price) ASC
		';
		// echo $sql;
		return Db::getInstance()->ExecuteS($sql);
	}
    public static function getRoomPlanListDetailByHotelIdHotelAndAdmin($hotelId)
   	{
   		$sql = '
   			SELECT
   							 A.* AS MinPrice, C.RoomTypeName
   						FROM
   							(
   								SELECT
   									B.*, C.ShowOrder
   								FROM
   									HT_Hotel as A, HT_HotelRoomPlanLink as C, HT_RoomPlan as B
   								WHERE
   									A.`HotelId` = C.`HotelId` AND B.`RoomPlanId` = C.RoomPlanId AND A.HotelId = '.$hotelId.'
   							) as A
   							, HT_RoomType as C
   						WHERE
   							A.RoomTypeId = C.RoomTypeId
   						GROUP BY
   							A.RoomPlanId
   						ORDER BY
   							A.ShowOrder ASC
   		';
   		// echo $sql;
   		return Db::getInstance()->ExecuteS($sql);
   	}
	public static function getRoomTypeList()
	{
		$sql = 'select A.* '.
				'from '._DB_PREFIX_.'RoomType as A ';
		return Db::getInstance()->ExecuteS($sql);
	}

	/*
	 *  deleteRoomPlanByIdList function
	 * 
	 * delete room plan by Room plan id list string separated with comma.
	 * 
	 * @param string $rpid_str
	 * 
	 * @author zotiger
	 * @created 2012-11-06
	 */
	public static function deleteRoomPlanByIdList($rpid_str)
	{
		if ($rpid_str == '0')
			return;
        $sql = 'INSERT INTO '._DB_PREFIX_.'RoomPlan_del (
        	RoomPlanId,
        	RoomTypeId,
        	RoomPlanName,
        	RoomPlanName_en,
        	RoomPlanName_jp,
        	RoomPlanName_S_CN,
        	RoomPlanName_T_CN,
        	RoomMaxPersons,
        	StartTime,
        	EndTime,
        	RoomSize,
        	RoomPlanDescription,
        	RoomPlanDescription_en,
        	RoomPlanDescription_jp,
        	RoomPlanDescription_S_CN,
        	RoomPlanDescription_T_CN,
        	Breakfast,
        	Dinner,
        	UseCon,
        	ConFromTime,
        	ConToTime,
        	Nights,
        	PriceAll,
        	PriceAsia,
        	PriceEuro,
        	Active,
        	liaojin,
        	zaiku
        ) SELECT
        	RoomPlanId,
        	RoomTypeId,
        	RoomPlanName,
        	RoomPlanName_en,
        	RoomPlanName_jp,
        	RoomPlanName_S_CN,
        	RoomPlanName_T_CN,
        	RoomMaxPersons,
        	StartTime,
        	EndTime,
        	RoomSize,
        	RoomPlanDescription,
        	RoomPlanDescription_en,
        	RoomPlanDescription_jp,
        	RoomPlanDescription_S_CN,
        	RoomPlanDescription_T_CN,
        	Breakfast,
        	Dinner,
        	UseCon,
        	ConFromTime,
        	ConToTime,
        	Nights,
        	PriceAll,
        	PriceAsia,
        	PriceEuro,
        	Active,
        	liaojin,
        	zaiku
        FROM
        	'._DB_PREFIX_.'RoomPlan
        WHERE
        	RoomPlanId IN  ('.$rpid_str.')';
      		Db::getInstance()->ExecuteS($sql);
		$sql = 'DELETE FROM '._DB_PREFIX_.'RoomPlan WHERE RoomPlanId in ('.$rpid_str.')';
		Db::getInstance()->ExecuteS($sql);

        $sql='INSERT INTO '._DB_PREFIX_.'RoomPlanRoomFileLink_del (
      			RoomPlanRoomFileLinkId,
      			RoomPlanId,
      			RoomFileId,
      			ShowOrder
      		) SELECT
      			RoomPlanRoomFileLinkId,
      			RoomPlanId,
      			RoomFileId,
      			ShowOrder
      		FROM
      			'._DB_PREFIX_.'RoomPlanRoomFileLink
      		WHERE
      			RoomPlanId IN ('.$rpid_str.')';
        Db::getInstance()->ExecuteS($sql);
		$sql = 'DELETE FROM '._DB_PREFIX_.'RoomPlanRoomFileLink WHERE RoomPlanId in ('.$rpid_str.')';
		Db::getInstance()->ExecuteS($sql);

        $sql = 'INSERT INTO '._DB_PREFIX_.'RoomStockAndPrice_del (
        	RoomPriceId,
        	RoomPlanId,
        	ApplyDate,
        	Price,
        	Amount,
        	Asia,
        	Euro
        ) SELECT
        	RoomPriceId,
        	RoomPlanId,
        	ApplyDate,
        	Price,
        	Amount,
        	Asia,
        	Euro
        FROM
        	'._DB_PREFIX_.'RoomStockAndPrice
        WHERE
        	RoomPlanId IN  ('.$rpid_str.')';
      	Db::getInstance()->ExecuteS($sql);
		$sql = 'DELETE FROM '._DB_PREFIX_.'RoomStockAndPrice WHERE RoomPlanId in ('.$rpid_str.')';
		Db::getInstance()->ExecuteS($sql);

        $sql = 'INSERT INTO '._DB_PREFIX_.'HotelRoomPlanLink_del (
        	HotelRoomPlanLinkId,
        	HotelId,
        	RoomPlanId,
        	ShowOrder
        ) SELECT
        	HotelRoomPlanLinkId,
        	HotelId,
        	RoomPlanId,
        	ShowOrder
        FROM
        	'._DB_PREFIX_.'HotelRoomPlanLink
        WHERE
        	RoomPlanId IN  ('.$rpid_str.')';
      	Db::getInstance()->ExecuteS($sql);
		$sql = 'DELETE FROM '._DB_PREFIX_.'HotelRoomPlanLink WHERE RoomPlanId in ('.$rpid_str.')';
		Db::getInstance()->ExecuteS($sql);
	}
	
	//添加Excel中RoomPlan的信息到数据库中
	public static function addExcelRoomPlan($hotelId, $roomTypeId, $roomplaninfo) {
		$sql = "select A.`RoomPlanId`, A.`StartTime`, A.`EndTime`, B.`HotelRoomPlanLinkId` 
			from "._DB_PREFIX_."RoomPlan A, "._DB_PREFIX_."HotelRoomPlanLink B 
			where A.`RoomPlanName_en` = '".$roomplaninfo['RoomPlanName_en']."'  
			and A.`RoomTypeId` = '".$roomTypeId."'
			and B.`HotelId` = '".$hotelId."' 
			and A.`RoomPlanId` = B.`RoomPlanId`";
		$result = DB::getInstance()->getRow($sql);

		if($result) {
			if(strtotime($result['StartTime']) < strtotime($roomplaninfo['StartTime']))
				$startTime = $result['StartTime'];
			else
				$startTime = $roomplaninfo['StartTime'];
			
			if(strtotime($result['EndTime']) < strtotime($roomplaninfo['EndTime']))
				$endTime = $roomplaninfo['EndTime'];
			else
				$endTime = $result['EndTime'];

			$roomPlanId = $result['RoomPlanId'];
			
			$setsdata = array('RoomPlanName_en', 'RoomPlanName_jp', 'RoomPlanName_S_CN', 'RoomPlanName_T_CN', 
					'RoomMaxPersons', 'Breakfast', 'Dinner');
			$setsinfo = array_intersect_key($roomplaninfo, array_flip($setsdata));
			$setsinfo['StartTime'] = $startTime;
			$setsinfo['EndTime'] = $endTime;
			$sets = '';
			foreach($setsinfo as $key => $value)
				$sets .= $key."='".$value."',";
			$sets = substr($sets, 0, -1);
			$sql = "update "._DB_PREFIX_."RoomPlan set ".$sets." where `RoomPlanId` = '{$roomPlanId}'";

			Db::getInstance() -> Execute($sql);
			return $roomPlanId;
		} else {
			array_shift($roomplaninfo); 
			$roomplaninfo['RoomTypeId'] = $roomTypeId;
			
			$sets = '';
			foreach($roomplaninfo as $key => $value)
				$sets .= $key."='".$value."',";
			$sql = "insert into "._DB_PREFIX_."RoomPlan set ".$sets." Active = 1";
			Db::getInstance() -> Execute($sql);
			$roomPlanId = Db::getInstance()->Insert_ID();

			$sql = "insert into "._DB_PREFIX_."HotelRoomPlanLink set HotelId = '{$hotelId}', RoomPlanId = '{$roomPlanId}'";
			Db::getInstance() -> Execute($sql);

			return $roomPlanId;
		}
	}	
	
	
	public static function insertOrUpdateRoomPlan($hotelId, $roomPlanId, $roomTypeId, $roomPlanName,$roomMaxPersons, $startTime,
			$endTime, $roomSize, $roomPlanDesc, $breakfast, $dinner, $useCon, $conFromTime, $conToTime, $nights, $priceAll, 
			$priceAsia, $priceEuro,$liaojin=1,$zaiku=1)
	{
        $roomPlanName = mysql_real_escape_string($roomPlanName);
        $roomPlanDesc = mysql_real_escape_string($roomPlanDesc);
		//first check if already exist.
		if($roomPlanId ==0 ){// if insert
			//check if already exist.
			$tblRoomPlan = _DB_PREFIX_."RoomPlan A";
			$tblLink = _DB_PREFIX_."HotelRoomPlanLink B";
						
			$sql = "SELECT A.`RoomPlanId` FROM {$tblRoomPlan}, {$tblLink} 
					WHERE A.`RoomPlanName`='{$roomPlanName}' AND A.`RoomTypeId` = '{$roomTypeId}' AND A.`StartTime`='{$startTime}'
					      AND A.`EndTime`='{$endTime}' AND B.`HotelId` = $hotelId";
			$result = Db::getInstance() -> getRow($sql);
			if($result){//if alreay exist, return 0;
				return 0;
			}
		}

        $startTime = '2012-01-01';
        $endTime = '2112-01-01';
		if ($breakfast == '') $breakfast = 0;
		if ($dinner == '') $dinner = 0;
		if ($useCon == '') $useCon = 0;
		if ($roomSize == '') $roomSize = 0;
		if ($nights == '') $nights = 0;
		if ($priceAll == '') $priceAll = 0;
		if ($priceAsia == '') $priceAsia = 0;
		if ($priceEuro == '') $priceEuro = 0;
        if ($liaojin == '') $liaojin = 0;
        if ($zaiku == '') $zaiku = 0;
		global $cookie;
		$iso = Language::getIsoById((int)$cookie->LanguageID);

		/*
		$sql = 'REPLACE INTO '._DB_PREFIX_.'RoomPlan(RoomPlanId, RoomTypeId, RoomPlanName_'.$iso.', RoomMaxPersons, StartTime,
		EndTime, RoomSize, RoomPlanDescription_'.$iso.', Breakfast, Dinner, UseCon, ConFromTime, ConToTime, Nights, PriceAll, PriceAsia, PriceEuro, Active) ';
		$sql .="values($roomPlanId, '$roomTypeId', '$roomPlanName', $roomMaxPersons, '$startTime', '$endTime', $roomSize, '$roomPlanDesc', $breakfast, ".
		"$dinner, $useCon, '$conFromTime', '$conToTime', $nights, $priceAll, $priceAsia, $priceEuro, 1)";
		*/

		//此处需要用insert 和 update组合 不能用replace, replace会在插入前加原有数据删除
		if ($roomPlanId == 0) {
			$sql = 'INSERT INTO '._DB_PREFIX_.'RoomPlan(RoomPlanId, RoomTypeId, RoomPlanName_en,RoomPlanName_jp,RoomPlanName_S_CN,RoomPlanName_T_CN, RoomMaxPersons, StartTime,
				EndTime, RoomSize, RoomPlanDescription_'.$iso.', Breakfast, Dinner, UseCon, ConFromTime, ConToTime, Nights, PriceAll, PriceAsia, PriceEuro, Active) ';
				$sql .="values($roomPlanId, '$roomTypeId', '$roomPlanName','$roomPlanName','$roomPlanName','$roomPlanName', $roomMaxPersons, '$startTime', '$endTime', $roomSize, '$roomPlanDesc', $breakfast, ".
				"$dinner, $useCon, '$conFromTime', '$conToTime', $nights, $priceAll, $priceAsia, $priceEuro, 1)";
		} else {
			$sql = "update "._DB_PREFIX_."RoomPlan set RoomTypeId = '$roomTypeId', RoomPlanName_".$iso." = '$roomPlanName', RoomMaxPersons = $roomMaxPersons, 
						liaojin = '$liaojin', zaiku = '$zaiku', RoomSize = $roomSize, RoomPlanDescription_".$iso." = '$roomPlanDesc',
						Breakfast = $breakfast, Dinner = $dinner, UseCon = $useCon, ConFromTime = '$conFromTime', ConToTime = '$conToTime', 
						Nights = $nights, PriceAll = $priceAll, PriceAsia = $priceAsia, PriceEuro = $priceEuro, Active = 1  
				where RoomPlanId = $roomPlanId";		
		}
		Db::getInstance()->ExecuteS($sql);
//echo $sql;
        if ($roomPlanId != 0) {
            if (RoomPlan::getRoomPlanName($roomPlanId, 'en') == null) {
                RoomPlan::updateRoomPlanName($roomPlanId, 'en', $roomPlanName);
            }
            if (RoomPlan::getRoomPlanName($roomPlanId, 'jp') == null) {
                RoomPlan::updateRoomPlanName($roomPlanId, 'jp', $roomPlanName);
            }
            if (RoomPlan::getRoomPlanName($roomPlanId, 'S_CN') == null) {
                RoomPlan::updateRoomPlanName($roomPlanId, 'S_CN', $roomPlanName);
            }
            if (RoomPlan::getRoomPlanName($roomPlanId, 'T_CN') == null) {
                RoomPlan::updateRoomPlanName($roomPlanId, 'T_CN', $roomPlanName);
            }
        }
		if ($roomPlanId == 0)
		{	
			// get new inserted room plan id
			$new_rpid = Db::getInstance()->Insert_ID();
			// insert HotelRoomPlanLink
			$sql = 'insert into '._DB_PREFIX_.'HotelRoomPlanLink(HotelId, RoomPlanId) ';
			$sql .= "values($hotelId, $new_rpid)";
			Db::getInstance()->ExecuteS($sql);
			
			return $new_rpid; // inserted id
		}
		
		return 0; // update
	}
    public static function updateRoomPlanName($RoomPlanId, $iso = "",$RoomPlanName)
    {
        global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);
        $sql = 'update '._DB_PREFIX_.'RoomPlan
   		set	 RoomPlanName_' . $iso . '="'.$RoomPlanName.'"
   		WHERE
   			 RoomPlanId = ' . $RoomPlanId;

        return Db::getInstance()->ExecuteS($sql);
    }
    public static function getRoomPlanName($RoomPlanId, $iso = "")
    {
        global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);
        $sql = 'SELECT
   			 A.RoomPlanName_' . $iso . '
   		FROM
   			'._DB_PREFIX_.'RoomPlan as A
   		WHERE
   			 A.`RoomPlanId` = ' . $RoomPlanId;

        return Db::getInstance()->getValue($sql);
    }
	/*
	 * @TODO eliminate paramter count
	 *
	 * @author zotiger
	 */
	public static function insertRoomPlan($hotelId, $roomTypeId, $roomPlanName, $roomMaxPersons, $startTime, $endTime, $roomSize,
	 		$roomPlanDesc, $breakfast, $dinner, $useCon, $conFromTime, $conToTime, $nights, $priceAll, $priceAsia, $priceEuro,$liaojin,$zaiku)
	{
		return RoomPlan::insertOrUpdateRoomPlan($hotelId, 0, $roomTypeId, $roomPlanName, $roomMaxPersons, $startTime, $endTime, $roomSize,
		$roomPlanDesc, $breakfast, $dinner, $useCon, $conFromTime, $conToTime, $nights, $priceAll, $priceAsia, $priceEuro,$liaojin,$zaiku);
	}
	
	public static function updateRoomPlan($hotelId, $roomPlanId, $roomTypeId, $roomPlanName, $roomMaxPersons, $startTime, $endTime,
			$roomSize, $roomPlanDesc, $breakfast, $dinner, $useCon, $conFromTime, $conToTime, $nights, $priceAll, $priceAsia, $priceEuro,$liaojin,$zaiku)
	{
		RoomPlan::insertOrUpdateRoomPlan($hotelId, $roomPlanId, $roomTypeId, $roomPlanName, $roomMaxPersons, $startTime, $endTime,
		$roomSize, $roomPlanDesc, $breakfast, $dinner, $useCon, $conFromTime, $conToTime, $nights, $priceAll, $priceAsia, $priceEuro,$liaojin,$zaiku);
	}
	
	/*
	 *  generate where criteria condition
	 *
	 * @param $criteria array search variable
	 *
	 * @author zotiger
	 * @created 2012-11-08
	 * @modified 2012-11-13 bug fixed for calculating min prince between check in/out days.
	 * @modified 2012-11-19 bug fixed for check/out day was out room plan duration.
	 */
	public static function getCriteriaWhereClause($criteria)
	{
		$where_cond = ' ';

        if (array_key_exists('ContinentCode', $criteria))
        {
            if ($criteria['ContinentCode'] == 'AS') // asia
            {
                $where_cond .= 'AND ((I.Asia > 0) || (I.Price > 0 && I.Asia = 0))';
            } else if ($criteria['ContinentCode'] == 'EU') // europe
            {
                $where_cond .= 'AND ((I.Euro > 0) || (I.Price > 0 && I.Euro = 0))';
            } else {
                $where_cond .= 'AND ((I.Price > 0))';
            }
        }

		if (array_key_exists('HotelId', $criteria) && '0' != $criteria['HotelId'])
		{
			$where_cond.=' AND A.`HotelId` = '.$criteria['HotelId'];
		}
		if (array_key_exists('CityId', $criteria) && '0' != $criteria['CityId'])
		{
			$where_cond.=' AND A.`HotelCity` = '.$criteria['CityId'];
		}
		if (array_key_exists('AreaId', $criteria) && '0' != $criteria['AreaId'])
		{
			$where_cond.=' AND A.`HotelArea` = '.$criteria['AreaId'];
		}
		if (array_key_exists('CheckIn', $criteria) && '' != $criteria['CheckIn'])
		{
			$where_cond.=' AND "'.$criteria['CheckIn'].'" between C.`StartTime` and C.`EndTime` ';
		}
		if (array_key_exists('CheckOut', $criteria) && '' != $criteria['CheckOut'])
		{
			$where_cond.=' AND DATE_SUB("'.$criteria['CheckOut'].'",INTERVAL 1 DAY) between C.`StartTime` and C.`EndTime` ';
		}
		if (array_key_exists('CheckIn', $criteria) && '' != $criteria['CheckIn'] &&
			array_key_exists('CheckOut', $criteria) && '' != $criteria['CheckOut'])
		{	
			$where_cond .= " AND I.`ApplyDate` between \"{$criteria['CheckIn']}\" and DATE_SUB(\"{$criteria['CheckOut']}\",INTERVAL 1 DAY)";
		}
		if (array_key_exists('RoomTypeVals', $criteria))
		{
            $roomtype_cond = '';
            $roomtype_cond .= ' AND ( (1 <> 1) ';
			// echo count($criteria['RoomTypeVals']);
			$cond_count = 0;
			foreach($criteria['RoomTypeVals'] as $roomType => $roomTypeCount)
			{
				if ($roomTypeCount > 0)
				{
					$cond_count = 1;
					$roomtype_cond .= 'OR (';
					$roomtype_cond .= "C.`RoomTypeId` = $roomType";
					$roomtype_cond .= ') ';
				}
			}
			if ($cond_count == 0)
				$roomtype_cond = '';
			else
				$roomtype_cond .= ')';
			
			$where_cond .= $roomtype_cond;
		}
		if (array_key_exists('HotelClassId', $criteria) && '0' != $criteria['HotelClassId'])
		{
			$where_cond.=' AND A.`HotelClass` = '.$criteria['HotelClassId'];
		}

		global $cookie;
        $iso = Language::getIsoById((int)$cookie->LanguageID);

		if (array_key_exists('HotelName', $criteria) && '' != $criteria['HotelName'])
		{
            $where_cond.=' AND A.HotelName_'.$iso.' like "%'.$criteria['HotelName'].'%"';
		}
		return $where_cond;
	}

    /*
     * generate having clause for search hotel list
     *
     * when agent search hotel, we only show hotel list those every hotel will have all price in the duration (checkin~checkout)
     *
     * we will check it such as count(price list) = day diff
     *
     * @author zotiger
     * @created 2012-11
	 * @modified 2012-12-13 add HideRQ criteria for iss1202
     * @modified 2012-12-14 remove HideRQ criteria for bug fixing. add getCriteriaHavingClause2 functions
     */
    public static function getCriteriaHavingClause($criteria)
    {
        $having_cond = ' HAVING 1=1 ';


        if (array_key_exists('CheckIn', $criteria) && '' != $criteria['CheckIn'] &&
            array_key_exists('CheckOut', $criteria) && '' != $criteria['CheckOut'])
        {
            $having_cond .= " AND count(I.`RoomPlanId`) = DATEDIFF(\"{$criteria['CheckOut']}\", \"{$criteria['CheckIn']}\") ";
        }


        if (array_key_exists('HideRQ', $criteria) && '1' == $criteria['HideRQ'])
        {
            // $having_cond.=' AND min(I.`Amount`) > 0 ';
            if (array_key_exists('RoomTypeVals', $criteria))
            {
                $roomtype_cond = '';
                $roomtype_cond .= ' AND (1 ';
                // echo count($criteria['RoomTypeVals']);
                $cond_count = 0;
                foreach($criteria['RoomTypeVals'] as $roomType => $roomTypeCount)
                {
                    if ($roomTypeCount > 0)
                    {
                        // sum(if(A.`RoomTypeId` = 1, 1, 0))
                        $cond_count = 1;
                        $roomtype_cond .= '* (';
                        $roomtype_cond .= "if(`RoomTypeId` = $roomType, min(I.`Amount`) >= {$roomTypeCount}, 1)";
                        $roomtype_cond .= ') ';
                    }
                }
                $roomtype_cond .= ') > 0';

                $having_cond .= $roomtype_cond;
            }
        }

        return $having_cond;
    }

    /*
     * having clause for room plan type list
     *
     * if agent searched room plan type1, and type2, then we have to show those hotels that have both two plan types,
     *  of course we will not show hotels that have only one that types.
     *
     * we will use this function when this case occured.
     *
     * @author zotiger
     * @created 2012-11-19
     */
    public static function getCriteriaHavingClause2($criteria)
    {
        $having_cond = ' ';

        if (array_key_exists('RoomTypeVals', $criteria))
        {
            $roomtype_cond = '';
            $roomtype_cond .= ' HAVING (1 ';
            // echo count($criteria['RoomTypeVals']);
            $cond_count = 0;
            foreach($criteria['RoomTypeVals'] as $roomType => $roomTypeCount)
            {
                if ($roomTypeCount > 0)
                {
                    // sum(if(A.`RoomTypeId` = 1, 1, 0))
                    $cond_count = 1;
                    $roomtype_cond .= '* (';
                    $roomtype_cond .= "sum(if(`RoomTypeId` = $roomType, 1, 0))";
                    $roomtype_cond .= ') ';
                }
            }
            $roomtype_cond .= ') > 0';

            $having_cond .= $roomtype_cond;
        }

        return $having_cond;
    }

    /*
     * select clause for price field
     *
     * when the user is in asia continent, when we first check asia price and then total price
     * and the user is in europe continent, we first check euro price and if that value is zero then total price
     *
     * @author zotiger
     * @created 2012-11-17
     */
    public static function getCriteriaPriceField($criteria)
    {
        $price_field = '';
		
        if (!array_key_exists('ContinentCode', $criteria))
        {
            // $criteria['ContinentCode'] = 'AS'; // default asia
            return;
        }

        if ($criteria['ContinentCode'] == 'AS') // asia
        {
            $price_field = 'AVG( IF(I.Asia > 0, I.Asia, I.Price) )';
        } else if ($criteria['ContinentCode'] == 'EU') // europe
        {
            $price_field = 'AVG( IF(I.Euro > 0, I.Euro, I.Price) )';
        } else {
            $price_field = 'AVG( I.Price )';
        }

        return ','.$price_field.' AS MinPrice';
    }

    public static function getCriteriaRole($criteria)
    {
        if (!array_key_exists('Role', $criteria))
        {
            // $criteria['ContinentCode'] = 'AS'; // default asia
            return;
        }
        return $criteria['Role'];
    }
	/*
	 * get count of hotel room plan with search condition
	 *
	 * @param array criteria search condition
	 *
	 * @author zotiger
	 * @created 2012-11-08
	 * @modified 2012-11-19 update sql query
	 */
	public static function searchHotelRoomPlanCount($criteria)
	{
        $where_cond = RoomPlan::getCriteriaWhereClause($criteria);
        $having_cond = RoomPlan::getCriteriaHavingClause($criteria);
        $price_field =  RoomPlan::getCriteriaPriceField($criteria);
        $having_cond2 = RoomPlan::getCriteriaHavingClause2($criteria);
		$role=RoomPlan::getCriteriaRole($criteria);
		$sql = '
		SELECT count(*)
					FROM (
					    select
						    *
					    From
						    (
							select
								(A.HotelId), A.HotelName, F.HotelClassName, C.RoomTypeId '.$price_field.'
							from
								HT_Hotel as A, HT_HotelRoomPlanLink as B,  HT_RoomPlan as C,';
        if($role=='Agent'){
            $sql.='`HT_RoomStockAndPrice` as I,';
        }
        $sql.='
								 HT_HotelClass as F
							where
								A.HotelId = B.HotelId and B.RoomPlanId = C.RoomPlanId
								 and F.HotelClassId = A.HotelClass';
        if($role=='Agent'){
            $sql.='AND C.`RoomPlanId` = I.`RoomPlanId`';
        }
            $sql.=$where_cond;
        if($role=='Agent'){
            $sql.='GROUP BY I.`RoomPlanId`';
        }
        $sql .=	$having_cond;
        $sql .=    '		)
						AS A GROUP BY HotelId '.$having_cond2;
        $sql .= ") AS A";
        //echo $sql;
		return (int)Db::getInstance()->getValue($sql);
	}
	
	/*
	 * search hotel room plan list function
	 *
	 * @param array $criteria search conditions, sort order and paging
	 * @return array search RoomPlan list
	 *
	 * @author zotiger
	 * @created 2012-11-07
	 * @modified 2012-11-19 we can not use contient code for admin and hotel user
	 */
	public static function searchHotelRoomPlan($criteria, $p, $n)
	{
        global $cookie;
        $iso = Language::getIsoById((int)$cookie->LanguageID);

        $where_cond = RoomPlan::getCriteriaWhereClause($criteria);
		$having_cond = RoomPlan::getCriteriaHavingClause($criteria);
        $price_field =  RoomPlan::getCriteriaPriceField($criteria);
        $having_cond2 = RoomPlan::getCriteriaHavingClause2($criteria);
        $role=RoomPlan::getCriteriaRole($criteria);

        $usecond_cond = ' ';
        if (array_key_exists('CheckIn', $criteria) && '' != $criteria['CheckIn'] &&
            array_key_exists('CheckOut', $criteria) && '' != $criteria['CheckOut'])
        {
            // $usecond_cond .= " , if(C.UseCon = 1, (DATE_ADD(\"{$criteria['CheckIn']}\", INTERVAL C.Nights-1 DAY) <= C.`ConToTime`)  AND (DATE_SUB(\"{$criteria['CheckOut']}\",INTERVAL 1 DAY) >= C.`ConFromTime`) , 0) as UseCon ";
            $usecond_cond .= " , if(C.UseCon = 1, DATEDIFF(LEAST(C.`ConToTime`, DATE_SUB(\"{$criteria['CheckOut']}\",INTERVAL 1 DAY)) , GREATEST(\"{$criteria['CheckIn']}\", C.`ConFromTime`)) >= (C.Nights - 1), 0) as UseCon ";
        }

		$order_by = '';
		
		if (array_key_exists('SortBy', $criteria) && '' != $criteria['SortBy'] && 
			array_key_exists('SortOrder', $criteria) && '' != $criteria['SortOrder'])
		{
			if ($criteria['SortBy'] == 'price' && array_key_exists('ContinentCode', $criteria))
			{
				$order_by = " MinPrice ".$criteria['SortOrder'];
			} else if ($criteria['SortBy'] == 'class')
			{
				$order_by = ' HotelClassName '.$criteria['SortOrder'];
			}else if ($criteria['SortBy'] == 'name')
			{
				$order_by = ' A.HotelName '.$criteria['SortOrder'];
			}
		}
		$sql = '
			select A.HotelId,A.HotelName_'.$iso.' as HotelName, A.HotelClass, A.HotelAddress_'.$iso.' as HotelAddress, F.HotelClassName, A.HotelCity, G.CityName_'.$iso.' as CityName, A.HotelArea, H.AreaName_'.$iso.' as AreaName
					,A.HotelDescription_'.$iso.' as HotelDescription, C.RoomPlanId, C.RoomTypeId, J.`RoomTypeName`, C.RoomPlanName_'.$iso.' as RoomPlanName, C.RoomMaxPersons,C.zaiku
					, C.Breakfast, C.Dinner, E.HotelOrder, C.`StartTime` , F.HotelClassName
					, C.`EndTime` '.$usecond_cond.$price_field;
        if($role=='Agent'){
            $sql.=', min(I.`Amount`) as MinAmount';
        }

        $sql.='	FROM HT_Hotel as A, HT_HotelRoomPlanLink as B,  HT_RoomPlan as C';
        if($role=='Agent'){
            $sql.=', `HT_RoomStockAndPrice` as I';
        }
        $sql.=',(
					SELECT HotelId,  @curRow := @curRow + 1 AS HotelOrder
					FROM (
					    select
						    *
					    From
						    (
							select 
								(A.HotelId), A.HotelName, F.HotelClassName, C.RoomTypeId '.$price_field.'
							from
								HT_Hotel as A, HT_HotelRoomPlanLink as B,  HT_RoomPlan as C,';
        if($role=='Agent'){
            $sql.='`HT_RoomStockAndPrice` as I,';
        }
        $sql.='HT_HotelClass as F
							where 
								A.HotelId = B.HotelId and B.RoomPlanId = C.RoomPlanId and F.HotelClassId = A.HotelClass ';
        if($role=='Agent'){
            $sql.=' AND C.`RoomPlanId` = I.`RoomPlanId`';
        }
         $sql.=$where_cond;
        if($role=='Agent'){
            $sql.=' GROUP BY I.`RoomPlanId`';
        }
        $sql .=	$having_cond;
        if ($order_by != '')
            $sql .= '       ORDER BY '.$order_by;
        $sql .=    '		)
						AS A GROUP BY HotelId '.$having_cond2;
        if ($order_by != '')
            $sql .= ' ORDER BY '.$order_by;
        $sql .='	LIMIT '.(($p - 1) * $n).','.$n;
		
		$sql	.=') AS A join (SELECT @curRow := 0) r
				) AS E,
				
				HT_HotelClass as F,
				HT_City as G,
				HT_Area as H,
				HT_RoomType as J
			WHERE
				A.HotelId = E.HotelId and
				A.HotelId = B.HotelId and B.RoomPlanId = C.RoomPlanId
				AND A.HotelClass = F.HotelClassId
				AND A.HotelCity = G.CityId
				AND A.HotelArea = H.AreaId
				AND C.`RoomTypeId` = J.`RoomTypeId`';
        if($role=='Agent'){
            $sql.=' AND C.`RoomPlanId` = I.`RoomPlanId`';
        }
         $sql.=$where_cond;
        if($role=='Agent'){
            $sql.=' GROUP BY I.`RoomPlanId`';
        }
        $sql .=	$having_cond.
            ' ORDER BY E.HotelOrder ASC';
		if ($order_by != '')
					$sql .= ', '.$order_by;
		else
					$sql .=', B.`ShowOrder` ASC';
				
	    //echo $sql;
		$res = Db::getInstance()->ExecuteS($sql);
		if (!$res)
		{
			return null;
		}
		
		// indexed by hotel id
		$search_result = array();
		
		$pre_buy_plans = array();
		//
		foreach ($res as $hotel_roomplan)
		{
            if($hotel_roomplan['zaiku']=='1'&&$hotel_roomplan['MinAmount']=='0'){
                continue;
            }
			// key
			$hotel_id = $hotel_roomplan['HotelId'];
			
			$search_record = array();
			$new_roomplan = Tools::element_copy($hotel_roomplan, 'RoomPlanId', 'RoomTypeId','RoomTypeName', 'RoomPlanName',
			 'RoomMaxPersons', 'UseCon', 'Breakfast', 'Dinner', 'RoomPriceId', 'ApplyDate', 'MinPrice', 'MinAmount');
			
			if (array_key_exists($hotel_id, $search_result)) // hotel already exists.
			{
				// get hotel record
				$search_record = $search_result[$hotel_id];
				
			} else { // It's new a hotel key
				
				// create new hotel info
				$search_record = Tools::element_copy($hotel_roomplan, 'HotelId', 'HotelName', 'HotelClass', 'HotelClassName', 'HotelAddress', 
				'HotelCity', 'CityName' , 'HotelArea', 'AreaName', 'HotelDescription');
				
				// pre-calculation price for display
				// but user can reselect room type and count 
				$search_record['BookingPrice'] = 0;
				
				// get hotel first image
				$image = HotelDetail::getFirstFileOfHotel($search_record['HotelId']);
				$search_record['HotelFilePath'] = $image['HotelFilePath'];
				$search_record['w5_path'] = $image['w5_path'];
				$search_record['w5'] = $image['w5'];
				$search_record['h5'] = $image['h5'];
				
				//
				$search_record['RoomPlanList'] = array();
			}
			
			$new_roomplan['PreSelect'] = 0;
			
			if ($criteria['RoomTypeVals'][$new_roomplan['RoomTypeId']] > 0) // pre-buy engine
			{
				if (!array_key_exists($hotel_id, $pre_buy_plans))
					$pre_buy_plans[$hotel_id] = array();
				
				// check already selected same room type
				if (!array_key_exists($new_roomplan['RoomTypeId'], $pre_buy_plans[$hotel_id]))
				{
					$new_roomplan['PreSelect'] = 1;
					$pre_buy_plans[$hotel_id][$new_roomplan['RoomTypeId']] = 1; // pre-select
					$search_record['BookingPrice'] += $new_roomplan['MinPrice'] * $criteria['RoomTypeVals'][$new_roomplan['RoomTypeId']];
				}
			}
			
			// insert image information 
			$rp_images = RoomFile::getRoomFileListByRoomPlanId($hotel_roomplan['RoomPlanId']);
			$file_id = $rp_images[0]['RoomFileId'];
			$res = RoomFile::getRoomFile($file_id);
			if (!$res)
			{
				$w2 = 0; $h2= 0;	
			} else {
				$filepath = $res[0]['RoomFilePath'];
				list($width, $height, $type, $attr) = getimagesize($filepath);
				if ($width < 100 && $height < 75) {
					$w2 = width; $h2 = $height;
				} else {
					$ratio1=$width/100;
					$ratio2=$height/75;
					if ($ratio1 < $ratio2) {
						$w2 = 100;$h2 = intval($height / $ratio1);
					} else {
						$h2 = 75;$w2 = intval($width / $ratio2); 
					}
				}
				$pos = strpos($filepath, "/asset");
				$new_roomplan['img_path'] = substr($filepath, $pos);
			}
			$new_roomplan['img_width'] = $w2;$new_roomplan['img_height'] = $h2;
			
			// insert new roomplan-stock info
			$search_record['RoomPlanList'][] = $new_roomplan;
			
			
			// add or reset search result record
			$search_result[$hotel_id] = $search_record;
				
		}
		return $search_result;
	}
	
	/*
	 * get room plan list with min price for booking
	 *
	 * @param array $id_list id list
	 * @param string $checkin start date for min price
	 * @param string $checkout end date for min price
	 *
	 * @author zotiger
	 * @created 2012-11-09 
	 * @modified 2012-11-09 added $checkin and $checkout parameters for min price prevening hack.
	 * @modified 2012-11-21 remove booking room plan count
	 */
	public static function getRoomPlanListForBooking($id_list, $checkin, $checkout)
	{
		global $cookie;
        $iso = Language::getIsoById((int)$cookie->LanguageID);

		$ids = implode(',', $id_list);
		$sql = '
            SELECT
                A.RoomPlanId, A.RoomPlanName_'.$iso.' as RoomPlanName, A.RoomTypeId, A.`Breakfast`, A.`Dinner`, B.`RoomTypeName`, A.`RoomMaxPersons`
            FROM
                HT_RoomPlan as A, HT_RoomType as B, HT_RoomStockAndPrice as C
            WHERE
                A.RoomTypeId = B.`RoomTypeId` AND A.RoomPlanId = C.`RoomPlanId`
            AND  C.`ApplyDate` >= "'.$checkin.'" AND  C.`ApplyDate` < "'.$checkout.'" 
			AND A.`StartTime` <= "'.$checkin.'" AND A.`EndTime` >= DATE_SUB("'.$checkout.'", INTERVAL 1 DAY) 
             AND A.`RoomPlanId` in ('.$ids.')
             group by C.RoomPlanId
		';


        // echo $sql;
        $result = Db::getInstance()->ExecuteS($sql);

        $plan_list = array();
        foreach($result as $record)
        {
            $plan_list[$record['RoomPlanId']] = $record;
        }

        $ret_plan_list = array();
        foreach($id_list as $rpid)
        {
            $ret_plan_list[] =  $plan_list[$rpid];
        }


		return $ret_plan_list;
	}

    /*
     * get room plan sales info by primary key
     *
     * @author zotiger
     * @since 2012-11
     */
	public static function getRoomPlanSales($rpid)
	{
		$sql = "
		SELECT `UseCon`, DATE_FORMAT(`ConFromTime`, '%Y-%m-%d') as ConFromTime, DATE_FORMAT(`ConToTime`, '%Y-%m-%d') as ConToTime, `Nights`, `PriceAll`, `PriceAsia`, `PriceEuro`, `Active`
		FROM HT_RoomPlan
		WHERE RoomPlanId = {$rpid}
		";
		
		return Db::getInstance()->getRow($sql);
	}

    /*
     * get room plan summary for popup summary info
     *
     * @author zotiger
     * @since 2012-11
     */
	public static function getRoomPlanSummary($rpid)
	{
			global $cookie;
       	 $iso = Language::getIsoById((int)$cookie->LanguageID);

		$sql = "
				SELECT RoomPlanId, RoomSize, RoomPlanName_".$iso." as RoomPlanName, RoomPlanDescription_".$iso." as RoomPlanDescription  
			FROM HT_RoomPlan
			WHERE RoomPlanId = {$rpid}
		";
		
		$roomplan_summary = Db::getInstance()->getRow($sql);

		
		$sql = "
		SELECT B.*
		FROM HT_RoomPlanRoomFileLink as A, HT_RoomFile as B
		WHERE A.`RoomPlanId` = {$rpid} AND B.`RoomFileId` = A.`RoomFileId`
		ORDER BY A.ShowOrder ASC
		";
		
		$results = Db::getInstance()->ExecuteS($sql);
		
		foreach ($results as $row) {
			$filepath = $row['RoomFilePath'];
			list($width, $height, $type, $attr) = getimagesize($filepath);
			if ($width < 100 && $height < 75) {
				$w2 = width; $h2 = $height;
			} else {
				$ratio1=$width/100;
				$ratio2=$height/75;
				if ($ratio1 < $ratio2) {
					$w2 = 100;$h2 = intval($height / $ratio1);
				} else {
					$h2 = 75;$w2 = intval($width / $ratio2); 
				}
			}
			$pos = strpos($filepath, "/asset");
			$row['img_path'] = substr($filepath, $pos);
			
			$row['img_width'] = $w2;$row['img_height'] = $h2;
			$roomplan_summary['RelImages'][] = $row;
		}
		return $roomplan_summary;
	}

	//通过OrderId来获取RoomTypeList并以字符串的形式返回
	public static function getRoomTypeListByOrderId($orderId) {
		$sql = "select O.OrderId, O.RoomPlanId, R.RoomTypeId, T.RoomTypeName  
				from HT_OrderRoom as O, HT_RoomPlan as R, HT_RoomType as T 
				where O.RoomPlanId = R.RoomPlanId and R.RoomTypeId = T.RoomTypeId 
				and O.OrderId = '$orderId' 
				group by RoomTypeName";
		$results = Db::getInstance()->ExecuteS($sql);
		
		$RoomTypeList = '';
		foreach ($results as $row) {
			$RoomTypeList .= $row['RoomTypeName'].',';		
		}
		
		$RoomTypeList = substr($RoomTypeList, 0, -1);
		return $RoomTypeList;
	}

	public static function getOrderRoomInfo($orderid, $iso = "") {
		global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);
        
		$sql = "select O.`OrderRoomId`, O.`OrderId`,  
					O.`RoomPlanId`, R.`RoomPlanName_".$iso."` as RoomPlanName, 
					R.`RoomTypeId`, T.`RoomTypeName`,  
					R.`Breakfast`, R.`Dinner`,  
					O.`SpecialRequestNoSmoking`, O.`SpecialRequestSmoking`, O.`SpecialRequestAdjoin`, O.`SpecialRequestRemark` 
				from HT_OrderRoom as O, HT_RoomPlan as R, HT_RoomType as T 
				where O.`RoomPlanId` = R.`RoomPlanId` 
				and R.`RoomTypeId` = T.`RoomTypeId`  
				and O.`OrderId` = '{$orderid}'";
				
		$roomplaninfo = Db::getInstance()->ExecuteS($sql);

		foreach ($roomplaninfo as $key => $roomplan) {
			$roomplanid = $roomplan['OrderRoomId'];
			$sql = "select C.OrderRoomId, C.CustomerSex, 
						C.CustomerFamilyName as CustomerFName, C.CustomerGivenName as CustomerGName, 
						C.CustomerCountryId, CT.CountryName_".$iso." as CountryName  
				from HT_OrderCustomer as C, HT_Country as CT 
				where C.CustomerCountryId = CT.CountryId 
				and OrderRoomId = '{$roomplanid}'";
			$customers = Db::getInstance()->ExecuteS($sql);
			
			$customerName = '';
			foreach ($customers as $cus) {
				if ($cus['CustomerSex'] == 1) {
					$customerName .= 'Mr '.$cus['CustomerFName'].' '.$cus['CustomerGName'].'('.$cus['CountryName'].'), ';
				} else {
					$customerName .= 'Mrs '.$cus['CustomerFName'].' '.$cus['CustomerGName'].'('.$cus['CountryName'].'), ';
				}
			}

			$roomplaninfo[$key]['CustomerName'] = substr($customerName, 0, -2);
			$roomplaninfo[$key]['Breakfast'] = $roomplan['Breakfast'] ? "Include" : "None";
			$roomplaninfo[$key]['Dinner'] = $roomplan['Dinner'] ? "Include" : "None";   
			$roomplaninfo[$key]['Special'] .= $roomplan['SpecialRequestNoSmoking'] ? "Non Smoking  " : "";
			$roomplaninfo[$key]['Special'] .= $roomplan['SpecialRequestSmoking'] ? "Smoking  " : "";
			$roomplaninfo[$key]['Special'] .= $roomplan['SpecialRequestAdjoin'] ? "Adjoin room  " : "";
			$roomplaninfo[$key]['Special'] .= $roomplan['SpecialRequestRemark'] ? $roomplan['SpecialRequestRemark']." " : "";
		}
		
		return $roomplaninfo;
	}

	public static function getRoomString($orderid, $iso = "") {
		global $cookie;
        if ($iso == "") $iso = Language::getIsoById((int)$cookie->LanguageID);
        
		$sql = "select O.`OrderRoomId`, O.`OrderId`, R.`RoomPlanName_".$iso."` as RoomPlanName,  
					O.`RoomPlanId`,  R.`RoomTypeId`, T.`RoomTypeName`, count(O.`RoomPlanId`) as RoomTypeNo 
				from HT_OrderRoom as O, HT_RoomPlan as R, HT_RoomType as T 
				where O.`RoomPlanId` = R.`RoomPlanId` 
				and R.`RoomTypeId` = T.`RoomTypeId`  
				and O.`OrderId` = '{$orderid}' 
				group by R.`RoomPlanId`";
				
		$roomplaninfo = Db::getInstance()->ExecuteS($sql);
		
		$RoomString = '';
		foreach ($roomplaninfo as $roomplan) {
			$RoomString .= $roomplan['RoomTypeNo']." ".$roomplan['RoomPlanName']."&";			
		}
		$RoomString = substr($RoomString, 0, -1);
		return $RoomString;
	}
}