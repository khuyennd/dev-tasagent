<?php
/*
* This file was created by eclipse
* @file Room File Manager
* @author zotiger
* @created 2012-11-06
*/

if(!defined('IN_TAS')) {
	exit('Access Denied');
}

/* RoomFile class
 * 
 */
class  RoomFile extends ObjectModel
{
    public static function createThumbnail($filename, $path_to_image_directory, $path_to_thumbs_directory, $final_width_of_image) {
	    
	    if(preg_match('/[.](jpg)$/', $filename)) {  
	        $im = imagecreatefromjpeg($path_to_image_directory . $filename);  
	    } else if (preg_match('/[.](gif)$/', $filename)) {  
	        $im = imagecreatefromgif($path_to_image_directory . $filename);  
	    } else if (preg_match('/[.](png)$/', $filename)) {  
	        $im = imagecreatefrompng($path_to_image_directory . $filename);  
	    }  
	    $ox = imagesx($im);  
	    $oy = imagesy($im);  
	    $nx = $final_width_of_image;  
	    $ny = floor($oy * ($final_width_of_image / $ox));  
	    $nm = imagecreatetruecolor($nx, $ny);  
	    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);  
	    if(!file_exists($path_to_thumbs_directory)) {  
	      if(!mkdir($path_to_thumbs_directory)) {  
	           die("There was a problem. Please try again!");  
	      }  
	       }  
	    imagejpeg($nm, $path_to_thumbs_directory . $filename);  
	    // $tn = '<img src="' . $path_to_thumbs_directory . $filename . '" alt="image" />';  
	    // $tn .= '<br />Congratulations. Your file has been successfully uploaded, and a      thumbnail has been created.';  
	    // echo $tn;  
    }

	/*
	 * insertRoomFiles function
	 *
	 * multiple file upload process from $_FILES values
	 * 
	 * @param $file $_FILES for upload php variable. image tag name is myfile
	 * @param $type image or other. not used
	 *
	 * @author zotiger
	 * @created 2012-11-05
	 * @modified 2012-11-07 changed return value type from int to array for uploading multiple files 
	 * @modified 2012-11-13 hashing file name, create thumb images and save it.
	 */
	public static function insertRoomFiles($file, $type)
	{
		$img_ids = array();
		
		$uploads_dir = UPLOAD_DIR;
		foreach ($_FILES["myfile"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["myfile"]["tmp_name"][$key];
				$ext = end(explode(".", $_FILES["myfile"]["name"][$key])); //pathinfo($tmp_name, PATHINFO_EXTENSION);
				$name = date("YmdHis").rand().".".$ext;
				// $name = $_FILES["myfile"]["name"][$key];
				$fullfilepath = "$uploads_dir/fullsized/$name";
				@move_uploaded_file($tmp_name, $fullfilepath);
				
				//
				RoomFile::createThumbnail($name, "$uploads_dir/fullsized/", "$uploads_dir/thumbs/", 100);
				
				$fn = $name;
				$fp = mysql_real_escape_string($fullfilepath);
				$ft = $type;
				$fi = $key+1;
				
				$sql = 'INSERT INTO '._DB_PREFIX_.'RoomFile(RoomFileName,RoomFileName_jp,RoomFileName_en,RoomFileName_S_CN,RoomFileName_T_CN, RoomFilePath, RoomFileType, RoomFileIndex) ';
				$sql .="values('$fn','$fn','$fn','$fn','$fn', '$fp', '$ft', '$fi')";
				
				Db::getInstance()->ExecuteS($sql);
				
				$img_ids[] = Db::getInstance()->Insert_ID();
			}
		}
		
		// get new inserted file id
		return $img_ids;
	}
	
	public static function insertRoomFileById($rpid, $fid, $order)
	{
		$sql = 'INSERT INTO '._DB_PREFIX_.'RoomPlanRoomFileLink(RoomPlanId, RoomFileId, ShowOrder) values('.$rpid.','.$fid.','.$order.')';
		// echo $sql;
		Db::getInstance()->ExecuteS($sql);
	}
	
	public static function getRoomFile($fid)
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'RoomFile where RoomFileId = '.$fid;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public static function getRoomFileListByRoomPlanId($rpid)
	{
		$sql =
            'SELECT A.RoomFileId, B.* '.
            'FROM '._DB_PREFIX_.'RoomPlanRoomFileLink as A, '._DB_PREFIX_.'RoomFile as B '.
            'where A.RoomPlanId = '.$rpid.' AND A.RoomFileId = B.RoomFileId '.
            'ORDER BY ShowOrder ASC';
		return Db::getInstance()->ExecuteS($sql); 
	}
	
	public static function deleteAllFilesByRoomPlanId($rpid)
	{
		$sql = 'DELETE FROM '._DB_PREFIX_.'RoomPlanRoomFileLink WHERE RoomPlanId ='.$rpid;
		Db::getInstance()->ExecuteS($sql);
	}

    /*
     * update Room File name function by file id
     *
     * @param $fid RoomFile's RoomFileId
     * @param $fname RoomFile name
     */
    public static function updateRoomFileName($fid, $fname,$iso) {
        $sql = "UPDATE HT_RoomFile set RoomFileName_$iso = '$fname' where RoomFileId = $fid";
        Db::getInstance()->ExecuteS($sql);
        return 0;
    }
}