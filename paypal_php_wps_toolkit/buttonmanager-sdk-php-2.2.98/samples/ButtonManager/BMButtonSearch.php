<?php
require_once('../PPBootStrap.php');

$logger = new PPLoggingManager('Button Search');

$buttonSearchRequest = new BMButtonSearchRequestType();
$buttonSearchRequest->StartDate = $_REQUEST['startDate'];
$buttonSearchRequest->EndDate = $_REQUEST['endDate'];

$buttonSearchReq = new BMButtonSearchReq();
$buttonSearchReq->BMButtonSearchRequest = $buttonSearchRequest;

$paypalService = new PayPalAPIInterfaceServiceService();
try {
	$buttonSearchResponse = $paypalService->BMButtonSearch($buttonSearchReq);
} catch (Exception $ex) {
	require '../Error.php';
	exit;
}
echo "<table>";
echo "<tr><td>Ack :</td><td><div id='Ack'>$buttonSearchResponse->Ack</div> </td></tr>";
echo "</table>";

echo "<pre>";
	print_r($buttonSearchResponse);
echo "</pre>";
require_once '../Response.php';