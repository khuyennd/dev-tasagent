<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class RoomFileController extends FrontController
{
	
	public function __construct()
	{
		$this->php_self = "roomplanedit.php";
		
		
		parent::__construct();
	}
	public function preProcess()
	{
		parent::preProcess();
		
		$method = 'fullsized';
		
		if ($_REQUEST['rpid'])
		{
			$rp_images = RoomFile::getRoomFileListByRoomPlanId($_REQUEST['rpid']);
			if (!rp_images)
			{
				exit();
			}
			$file_id = $rp_images[0]['RoomFileId'];
			$method = 'thumbs';
		} else {
			$file_id = $_REQUEST['fid'];
		}
		

		
		$res = RoomFile::getRoomFile($file_id);
		
		
		if (!$res)
		{
			echo 'error';
			exit();		
		}
		
		$file = $res[0]['RoomFilePath']; //UPLOAD_DIR.'/homepage_adimg.jpg';
		if ($method == 'thumbs')
		{
			$file = str_replace('/fullsized/', '/thumbs/', $file);
		}
		
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}		
		// $type = 'image/jpeg';
		// header('Content-Type:'.$type);
		// header('Content-Length: '.filesize($file));
		// $fp = fopen($file, 'rb');
		// fpassthru($fp);
		//readfile($file);
		header('Location: /asset/'.$method.'/'.basename($file));
		// echo filesize($file);
		exit();
	}
}
