<?php
/*
* 2012 TAS
*/
if(!defined('IN_TAS')) {
    exit('Access Denied');
}
class HotelFileController extends FrontController
{
	
	public function __construct()
	{
		$this->php_self = "roomplanedit.php";
		
		
		parent::__construct();
	}
	public function preProcess()
	{
		parent::preProcess();
		
		$file_id = $_REQUEST['fid'];
		
		
		/*
		$file = UPLOAD_DIR.'/homepage_adimg.jpg';
		echo $file;
		
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
		*/
		exit();
	}
}
