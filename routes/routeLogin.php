<?php
require_once("../vendor/autoload.php");
use App\Provider\Factory\MMSServiceFactory;
use App\Provider\Constants\ServiceConstants;
use App\Provider\Constants\StatusConstants;

if(session_status() === PHP_SESSION_ACTIVE){
    session_destroy();
}
$e = ['response'=>'F','data'=>'UNKNOWN REQUEST!'];
if(isset($_POST['emailLogin'],$_POST['passLogin'])){
	$serviceProvider = MMSServiceFactory::make(ServiceConstants::AUTH_SERVICE_PROVIDER,[StatusConstants::CONNECTION_STATUS_NOT_CONNECTED]);
	$pass = $serviceProvider->WashDUnitDataSet($_POST['emailLogin']);
	$email = $serviceProvider->WashDUnitDataSet($_POST['passLogin']);
	$response = $serviceProvider->login($pass,$email);
	print_r($response);
	$e=$response;
	
}
print_r($_POST);
echo json_encode($e);


?>