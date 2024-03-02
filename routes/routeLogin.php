<?php
include_once("../vendor/autoload.php");
use App\Providers\Factory\MMSServiceFactory;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use PHPMailer\PHPMailer\PHPMailer;
if(session_status() === PHP_SESSION_ACTIVE){
    session_destroy();
}
$e = ['response'=>'F','data'=>'UNKNOWN REQUEST!'];
if(isset($_POST['emailLogin'],$_POST['passLogin'])){
	$serviceProvider = MMSServiceFactory::make(ServiceConstants::AUTH_SERVICE_PROVIDER,[null]);
	$mailService = MMSServiceFactory::make(ServiceConstants::MAIL_SERVICE,[new PHPMailer()]);
	$pass = $serviceProvider->WashDUnitDataSet($_POST['emailLogin']);
	$email = $serviceProvider->WashDUnitDataSet($_POST['passLogin']);
	$response = $serviceProvider->login($pass,$email);
	if($response['response']===StatusConstants::FAILED_STATUS){
		
		$date=date("Y-m-d H:m:ia");
		$message="A Failed Login Attempt was detected on your account using ({$email})<br><br>Device: {$_SERVER['REMOTE_ADDR']}<br><br>Date : {$date}<br><br>";
		$subject="LOGIN FAILED ($date)";
		$mailResponse = $mailService->setSMTPSettings(StatusConstants::MAIL_HOST, StatusConstants::DEFAULT_SYSTEM_SENDER, StatusConstants::MAILER_PASS, 465,PHPMailer::ENCRYPTION_SMTPS)
					->setSender(StatusConstants::DEFAULT_SYSTEM_SENDER,StatusConstants::DEFAULT_SYSTEM_SENDER_NAME)
					->addRecipient($email,'')
					->setSubject($subject)
					->setBody($message)
					->send();
		$response['mailResponse']=$mailResponse;
		$response['server']=$_SERVER;
		$e=$response;
	}
	else{
		$data=$response['data'];
		$ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        $encryption_iv = '0685153023980510'; 
        $encryption_key = "MakhathiMacele"; 
        $simple_string = $data['usermail']."-".$data['security']; 
        $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
        $arr_cookie_options = array (
            'expires' => time() + 60*60*24*30,
            'path' => '/',
            'domain' => '.netchatsa.com',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'None'
        );
        
        setcookie("umfazi", ($serviceProvider->cleanData->ibhubesiLesilisa(md5($serviceProvider->cleanData->ibhubesiLesilisa(md5($data['usermail'])).md5($serviceProvider->cleanData->ibhubesiLesilisa(md5($data['security'])))))), $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
        setcookie("indoda",($serviceProvider->cleanData->ibhubesiLesilisa(md5($serviceProvider->cleanData->ibhubesiLesilisa(md5($data['usermail'].$data['security'].$data['my_id'])).md5($serviceProvider->cleanData->ibhubesiLesilisa(md5($data['usermail'].$data['security'].$data['my_id'])))))), $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
        setcookie("hlomula",($serviceProvider->cleanData->ibhubesiLesilisa(md5($serviceProvider->cleanData->ibhubesiLesilisa(md5($data['my_id'].$data['name'])).md5($serviceProvider->cleanData->ibhubesiLesilisa(md5($data['my_id'].$data['surname'])))))), $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
        setcookie("ibhubesi","$encryption", $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
		// $e="./accounts/".$);
		$response['user_type'] = strtolower($data['user_type']);

		$response['data']='Signing you in...';

		$date=date("Y-m-d H:m:ia");
		$message="A successful login has been conducted on your account using ({$email})<br><br>Device : {$_SERVER['REMOTE_ADDR']}<br><br>Date : {$date}<br><br>";
		$subject="LOGIN SUCCESS ($date)";
		$mailResponse = $mailService->setSMTPSettings(StatusConstants::MAIL_HOST, StatusConstants::DEFAULT_SYSTEM_SENDER, StatusConstants::MAILER_PASS, 465,PHPMailer::ENCRYPTION_SMTPS)
					->setSender(StatusConstants::DEFAULT_SYSTEM_SENDER,StatusConstants::DEFAULT_SYSTEM_SENDER_NAME)
					->addRecipient($email,'')
					->setSubject($subject)
					->setBody($message)
					->send();
		$response['mailResponse']=$mailResponse;
		session_start();
		$_SESSION['usermail']=$email;
		$e=$response;
	}
	
}
echo json_encode($e);


?>