<?php
/*
* This file was created by eclipse
* @author zotiger
* @created 2012-11-05
* @file Room Plan Manager
*/

if(!defined('IN_TAS')) {
	exit('Access Denied');
}

/**
 * RoomPlan class
 * 
 */
class  HotelFile extends ObjectModel
{
	
	public static function insertHotelFiles($file, $type)
	{
		
		$uploads_dir = UPLOAD_DIR;
		foreach ($_FILES["myfile"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["myfile"]["tmp_name"][$key];
				$name = $_FILES["myfile"]["name"][$key];
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
				
				$fn = $name;
				$fp = "$uploads_dir/$name";
				$ft = $type;
				$fi = 0;
				
				$sql = 'INSERT INTO '._DB_PREFIX_.'HotelFile(HotelFileName, HotelFilePath, HotelFileType, HotelFileIndex) ';
				$sql .="values('$fn', '$fp', '$ft', '$fi')";
				
				Db::getInstance()->ExecuteS($sql);
			}
		}
		
		// get new inserted file id
		return Db::getInstance()->Insert_ID();
	}
	
}