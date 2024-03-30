<?php
include_once("../vendor/autoload.php");
use App\Providers\Factory\MMSServiceFactory;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use PHPMailer\PHPMailer\PHPMailer;
use Src\Classes\SAIDValidator;
use App\Providers\Response\Response;

if(session_status() === PHP_SESSION_ACTIVE){
    session_destroy();
}
$e=new Response();
$e->responseStatus=StatusConstants::FAILED_STATUS;
$e->responseMessage="UNKNOWN REQUEST!!.";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if(isset($_POST['emailLogin'],$_POST['passLogin'])){
		$serviceProvider = MMSServiceFactory::make(ServiceConstants::AUTH_SERVICE_PROVIDER,[null]);
		$mailService = MMSServiceFactory::make(ServiceConstants::MAIL_SERVICE,[new PHPMailer()]);
		$pass = $serviceProvider->WashDUnitDataSet($_POST['emailLogin']);
		$email = $serviceProvider->WashDUnitDataSet($_POST['passLogin']);
		$response = $serviceProvider->login($pass,$email);
		if($response['responseStatus']===StatusConstants::FAILED_STATUS){
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
			$data=$response['responseMessage'];
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

			$response['responseMessage']='Signing you in...';

			$date=date("Y-m-d H:m:ia");
			$message="A successful login has been conducted on your account using ({$email})<br><br>User : {$data['name']} {$data['surname']}<br><br>Device : {$_SERVER['REMOTE_ADDR']}<br><br>Date : {$date}<br><br>";
			$subject="LOGIN SUCCESS ($date)";
			$mailResponse = $mailService->setSMTPSettings(StatusConstants::MAIL_HOST, StatusConstants::DEFAULT_SYSTEM_SENDER, StatusConstants::MAILER_PASS, 465,PHPMailer::ENCRYPTION_SMTPS)
						->setSender(StatusConstants::DEFAULT_SYSTEM_SENDER,StatusConstants::DEFAULT_SYSTEM_SENDER_NAME)
						->addRecipient($email,strtoupper($data['name'].' '.$data['surname']))
						->setSubject($subject)
						->setBody($message)
						->send();
			$response['mailResponse']=$mailResponse;
			// if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
			$serviceProvider->cleanData->connect->commit();
			session_start();

			$_SESSION['usermail']=$email;
			$e=$response;
		}
		$serviceProvider->setUserLoginHistory($email,json_encode($e),json_encode($_SERVER),json_encode($_REQUEST),json_encode($_ENV),json_encode($_SESSION),json_encode($_COOKIE));
		
	}
	elseif(isset($_POST['gender'],$_POST['region'],$_POST['dob'],$_POST['address'],$_POST['provice'],$_POST['otp'])){
		$serviceProvider = MMSServiceFactory::make(ServiceConstants::AUTH_SERVICE_PROVIDER,[null]);
		$mailService = MMSServiceFactory::make(ServiceConstants::MAIL_SERVICE,[new PHPMailer()]);
		$gender = $serviceProvider->WashDUnitDataSet($_POST['gender']);
		$region = $serviceProvider->WashDUnitDataSet($_POST['region']);
		$dob = $serviceProvider->WashDUnitDataSet($_POST['dob']);
		$address = $serviceProvider->WashDUnitDataSet($_POST['address']);
		$provice = $serviceProvider->WashDUnitDataSet($_POST['provice']);
		$otp = $serviceProvider->WashDUnitDataSet($_POST['otp']);
		$e=$serviceProvider->finalizeAccountReg($gender,$region,$dob,$address,$provice,$otp);
		if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
			$serviceProvider->cleanData->connect->commit();
			$date=date("Y-m-d H:m:ia");
			$extraData = (array)json_decode($e->extraData);
			$message="Once again, A warm welcome to Netchatsa community a place of wise choice.<br><br>Welcome to Netchatsa, Your account has been successfully created. You can now login and enjoy the best tech experience.<br><br>Email : ({$extraData['usermail']})<br><br>User : {$extraData['name']} {$extraData['surname']}<br><br>Device : {$_SERVER['REMOTE_ADDR']}<br><br>Date : {$date}<br><br>";
			$subject="WELCOME TO NETCHATSA";
			$mailResponse = $mailService->setSMTPSettings(StatusConstants::MAIL_HOST, StatusConstants::DEFAULT_SYSTEM_SENDER, StatusConstants::MAILER_PASS, 465,PHPMailer::ENCRYPTION_SMTPS)
						->setSender(StatusConstants::DEFAULT_SYSTEM_SENDER,StatusConstants::DEFAULT_SYSTEM_SENDER_NAME)
						->addRecipient($extraData['usermail'],strtoupper($extraData['name'].' '.$extraData['usermail']))
						->setSubject($subject)
						->setBody($message)
						->send();
			$e->objectError=$mailResponse;
		}
		else{
			$serviceProvider->cleanData->connect->rollback();
		}

	}
	elseif(isset($_POST['newPassReset'],$_POST['reset_code'])){
		$serviceProvider = MMSServiceFactory::make(ServiceConstants::AUTH_SERVICE_PROVIDER,[null]);
		$mailService = MMSServiceFactory::make(ServiceConstants::MAIL_SERVICE,[new PHPMailer()]);
		$newPassReset = $serviceProvider->WashDUnitDataSet($_POST['newPassReset']);
		$reset_code = $serviceProvider->WashDUnitDataSet($_POST['reset_code']);
		$e = $serviceProvider->passwordReset($newPassReset,$reset_code);

		$date=date("Y-m-d H:m:ia");
		$message="New password has been made active.<br><br>Date : {$date}<br><br>If you're not aware of this request please report it at netchatsa WhatsApp Support.<br><br>";
		$subject="PASSWORD RESET SUCCESS";
		// print_r($e);
		if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
			$mailResponse = $mailService->setSMTPSettings(StatusConstants::MAIL_HOST, StatusConstants::DEFAULT_SYSTEM_SENDER, StatusConstants::MAILER_PASS, 465,PHPMailer::ENCRYPTION_SMTPS)
							->setSender(StatusConstants::DEFAULT_SYSTEM_SENDER,StatusConstants::DEFAULT_SYSTEM_SENDER_NAME)
							->addRecipient($e->responseMessage,'')
							->setSubject($subject)
							->setBody($message)
							->send();
				$e->objectError=$mailResponse;
		}
		else{
			$serviceProvider->cleanData->connect->rollback();
		}
	}
	elseif(isset($_POST['EmailSetRequest'])){
		$serviceProvider = MMSServiceFactory::make(ServiceConstants::AUTH_SERVICE_PROVIDER,[null]);
		$mailService = MMSServiceFactory::make(ServiceConstants::MAIL_SERVICE,[new PHPMailer()]);
		$EmailSetRequest = $serviceProvider->WashDUnitDataSet($_POST['EmailSetRequest']);
		$resetCode = rand(100,1000000);
		$e = $serviceProvider->passwordResetRequest($EmailSetRequest,$resetCode);
		$date=date("Y-m-d H:m:ia");
		$message="New password reset request for this email user : ({$EmailSetRequest})<br><br>Date : {$date}<br><br>Reset Code: {$resetCode}<br><br>If you're not aware of this request please report it at netchatsa WhatsApp Support.<br><br>";
		$subject="PASSWORD RESET REQUEST";

		if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
			$mailResponse = $mailService->setSMTPSettings(StatusConstants::MAIL_HOST, StatusConstants::DEFAULT_SYSTEM_SENDER, StatusConstants::MAILER_PASS, 465,PHPMailer::ENCRYPTION_SMTPS)
							->setSender(StatusConstants::DEFAULT_SYSTEM_SENDER,StatusConstants::DEFAULT_SYSTEM_SENDER_NAME)
							->addRecipient($EmailSetRequest,'')
							->setSubject($subject)
							->setBody($message)
							->send();
				$e->objectError=$mailResponse;
		}
		else{
			$serviceProvider->cleanData->connect->rollback();
		}
	}
	elseif(isset($_POST['emailNew'],$_POST['pswdNew'],$_POST['indicator'],$_POST['numberNew'],$_POST['name'],$_POST['surname'])){
		$serviceProvider = MMSServiceFactory::make(ServiceConstants::AUTH_SERVICE_PROVIDER,[null]);
		$mailService = MMSServiceFactory::make(ServiceConstants::MAIL_SERVICE,[new PHPMailer()]);
		$emailNew = $serviceProvider->WashDUnitDataSet($_POST['emailNew']);
		$pswdNew = $serviceProvider->WashDUnitDataSet($_POST['pswdNew']);
		$indicator = $serviceProvider->WashDUnitDataSet($_POST['indicator']);
		$numberNew = $serviceProvider->WashDUnitDataSet($_POST['numberNew']);
		$name = $serviceProvider->WashDUnitDataSet($_POST['name']);
		$surname = $serviceProvider->WashDUnitDataSet($_POST['surname']);
		$terminate = false;
		if($indicator===1){
			if(!SAIDValidator::validateSAID($numberNew)){
				$e=['responseStatus'=>'F','responseMessage'=>'Invalid ID Number'];
				$terminate=true;
			}
		}
		if(!$terminate){
			if($indicator===0){
				if(!SAIDValidator::validatePassport($numberNew)){
					$e=['responseStatus'=>'F','responseMessage'=>'Invalid Passport Number'];
					$terminate=true;
				}
			}
		}
		if(!$terminate){
			$e=$serviceProvider->createNew($emailNew,$pswdNew,$numberNew,$name,$surname);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$serviceProvider->cleanData->connect->commit();
				$date=date("Y-m-d H:m:ia");
				$message="A warm welcome to Netchatsa community a place of wise choice.<br><br>Welcome to Netchatsa, Your account has been successfully created. Please do complete your profile creation to continue getting best experience of EDU-TECH Technology.<br><br>OTP : {$e->otp}<br><br>Email : ({$emailNew})<br><br>User : {$name} {$surname}<br><br>Device : {$_SERVER['REMOTE_ADDR']}<br><br>Date : {$date}<br><br>";
				$subject="WELCOME TO NETCHATSA";
				$mailResponse = $mailService->setSMTPSettings(StatusConstants::MAIL_HOST, StatusConstants::DEFAULT_SYSTEM_SENDER, StatusConstants::MAILER_PASS, 465,PHPMailer::ENCRYPTION_SMTPS)
							->setSender(StatusConstants::DEFAULT_SYSTEM_SENDER,StatusConstants::DEFAULT_SYSTEM_SENDER_NAME)
							->addRecipient($emailNew,strtoupper($name.' '.$surname))
							->setSubject($subject)
							->setBody($message)
							->send();
				$e->objectError=$mailResponse;
			}
			else{
				$serviceProvider->cleanData->connect->rollback();
			}
		}
	}
}
echo json_encode($e);


?>