<?php
require_once('../PPBootStrap.php');

$logger = new PPLoggingManager('BMGetInventory');

$bmGetInventoryReqest = new BMGetInventoryRequestType($_REQUEST['hostedID']);
$bmGetInventoryReq = new BMGetInventoryReq();
$bmGetInventoryReq->BMGetInventoryRequest = $bmGetInventoryReqest;

$paypalService = new PayPalAPIInterfaceServiceService();
try {
	$bmGetInventoryResponse = $paypalService->BMGetInventory($bmGetInventoryReq);
} catch (Exception $ex) {
	require '../Error.php';
	exit;
}	

echo "<table>";
echo "<tr><td>Ack :</td><td><div id='Ack'>$bmGetInventoryResponse->Ack</div> </td></tr>";
echo "<tr><td>HostedButtonID :</td><td><div id='HostedButtonID'>$bmGetInventoryResponse->HostedButtonID</div> </td></tr>";
echo "</table>";

echo "<pre>";
print_r($bmGetInventoryResponse);
echo "</pre>";
require_once '../Response.php';