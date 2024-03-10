<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use App\Providers\Response\Response;
use Src\Classes\PayFast\PayFastIntegration;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['usermail'])){
    
    $e=new Response();
    $e->responseStatus = StatusConstants::FAILED_STATUS;
    $e->responseMessage = 'UNKNOWN REQUEST!!';
    // require_once("../controller/pdo.php");
    if(isset($_POST['std_id'],$_POST['amountToPay'],$_POST['pfData'],$_POST['pfParamString'])){
    	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
        $tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
        $matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$userPdo->connect]);
        $dramaClassPdo = PDOServiceFactory::make(ServiceConstants::DRAMA_CLASS_PDO,[$userPdo->connect]);
        $paymentProcessor = PDOServiceFactory::make(ServiceConstants::PAYMENT_PROCESSOR,[$userPdo->connect]);
        $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
        // $payFastIntegration = new ();
        // $a=$_SESSION['usermail'];
        $id=$cur_user_row['my_id'];
        header( 'HTTP/1.0 200 OK' );
        flush();
        // require_once("controller/pdo.php");
        define( 'SANDBOX_MODE', true );
        $pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
        // Posted variables from ITN
        // echo $_POST['pfData'];
        $pfData = PayFastIntegration::object_to_array(json_decode($_POST['pfData'],true));
        // echo"<pre>";
        // print_r($pfData);
        // echo"</pre>";
        // Strip any slashes in data
        foreach( $pfData as $key => $val ) {
            $pfData[$key] = stripslashes( $val );
        }
        $pfParamString=$_POST['pfParamString'];
        // Convert posted variables to a string
        
        // foreach( $pfData as $key => $val ) {
        //     if( !in_array($key, ['signature','pf_payment_id','item_description','amount_gross','amount_fee','amount_net','payment_status'])) {
        //         $pfParamString .= $key .'='. urlencode( $val ) .'&';
        //     } else {
        //         break;
        //     }
        // }
        // $myFile= fopen("notify.txt","wb")or die;
        // $pfParamString = substr( $pfParamString, 0, -1 );
        // echo "<br>pfParamString : ".$pfParamString;
        // $check1 = $continueLevelAppPDO->pfValidSignature($pfData['signature'], $pfParamString);
        // $check1 ? fwrite($myFile,"pfData: ".$pfData."\n\nPFPARAM : ".$pfParamString."\n\n is valid signiture"):fwrite($myFile,$pfData."\n\n".$pfParamString."\n\n is NOT valid signiture");
        // $check2 = $continueLevelAppPDO->pfValidIP();
        $amountToPay = $pfData['amount'];
        if($amountToPay=="R150.00"){
            $amountToPay=150.00;
        }
        elseif($amountToPay=="R250.00"){
            $amountToPay=250.00;
        }
        else{
            $amountToPay=200.00;
        }
        $amountToPay+=($amountToPay*0.15);
        // $check3 = $continueLevelAppPDO->pfValidPaymentData($amountToPay,$pfData['amount_gross']);
        // $check4 = $continueLevelAppPDO->pfValidServerConfirmation($pfParamString, $pfHost);
        // echo $check3?"true":"false";
        // echo $check4?"true":"false";
        // echo"<pre>";
        // print_r($pfData);
        // echo"</pre>";
        $std_id=$id;
        $applicant_id=$tertiaryApplications->getStudentId($id);
	   // $amountToPay=$continueLevelAppPDO->getAmountToPay($continueLevelAppPDO->getApplicationId($id));
	   // $proof_of_payment=$_GET['pt'];
	    $applicant_id=$tertiaryApplications->getStudentId($id);
	    $school=$tertiaryApplications->getSchoolId($applicant_id);
        $m_payment_id=$pfData['m_payment_id'];
        $pf_payment_id=$pfData['pf_payment_id'];
        $payment_status=$pfData['payment_status'];
        $item_name=$pfData['item_name'];
        $item_description=$pfData['item_description'];
        $amount_gross=$pfData['amount_gross'];
        $amount_fee=$pfData['amount_fee'];
        $amount_net=$pfData['amount_net'];
        $name_first=$pfData['name_first'];
        $name_last=$pfData['name_last'];
        $email_address=$pfData['email_address'];
        $merchant_id=$pfData['merchant_id'];
        $e=$paymentProcessor->processPayment($applicant_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee, $amount_net, $name_first,$name_last, $email_address, $merchant_id,$school,$id);
        if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
			$emailTo=$matricUpgrade->getEmailUser($id);
		    $emailFrom="np-reply@netchatsa.com";
		    $Message="<p>Dear Applicant</p><h5 style='color:green;'>PAYMENT OF (".$amountToPay.") SUCCESSFUL</h5><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 9th step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
		    $subject="TAMA APPLICATIONSA (Completion of step9 Alert)";
		    // require_once("../controller/pdo.php");
		    $notification->sendEmail($emailTo,$emailFrom,$Message,$subject);
		    
		    $emailTo=$matricUpgrade->getEmailUser($id);
		    $emailFrom="np-reply@netchatsa.com";
		    $Message="<p>Mr MS Mzobe </p><h5 style='color:green;'>PAYMENT OF (".$amountToPay.") SUCCESSFUL By user ({$emailTo} - {$id})</h5><p></p>";
		    $subject="TAMA APPLICATIONSA (Completion of step9 Alert)";
		    $notification->sendEmail("netchatsa@gmail.com",$emailFrom,$Message,$subject);
        }

    }
    else{
        
        $e->responseStatus = StatusConstants::FAILED_STATUS;
        $e->responseMessage = 'YOU DO NOT HAVE PERMISSIONS TO BE HERE!!..';
    }
    echo json_encode($e);
}
else{
    // $e="No Session Found";
    session_destroy();
    ?>
    <script>
        window.location=("../?login&error=warning: Stop this madness!!!");
    </script>
    <?php
}

?>