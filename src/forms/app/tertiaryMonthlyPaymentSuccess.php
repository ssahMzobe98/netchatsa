<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\PayFast\PayFastIntegration;

use App\Providers\Response\Response;

use Src\Classes\Pdo\TimePdo;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['usermail'])){
    // require_once("../controller/pdo.php");
    $userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
    // $tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);   
    $matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$userPdo->connect]); 
    // $sgelaUniversity = PDOServiceFactory::make(ServiceConstants::SGELA_UNI_PDO,[$userPdo->connect]);
    $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
    $paymentProcessor = PDOServiceFactory::make(ServiceConstants::PAYMENT_PROCESSOR,[$userPdo->connect]);
    $notification = PDOServiceFactory::make(ServiceConstants::NOTIFICATION_PDO,[$userPdo->connect]);
    $e=new Response();
    $e->responseStatus = StatusConstants::FAILED_STATUS;
    $e->responseMessage = 'UNKNOWN REQUEST!!';
    // $cur_user_row=mysqli_fetch_array($conn->query("select*from create_runaccount where usermail='$a'"));
	    if(isset($_POST['std_id'],$_POST['amountToPay'],$_POST['pfData'],$_POST['pfParamString'])){
	        $a=$_SESSION['usermail'];
	        
	        //$cur_user_row=mysqli_fetch_array($conn->query("select*from create_runaccount where usermail='$a'"));
	        $id=$cur_user_row['my_id'];
	        $getStudentGradeIfExists=$matricUpgrade->getStudentGradeIfExists($cur_user_row['my_id'],"tertiary");
	        header( 'HTTP/1.0 200 OK' );
	        flush();
	        // require_once("controller/pdo.php");
	        define( 'SANDBOX_MODE', true );
	        $pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
	        $pfData = $pdo->object_to_array(json_decode($_POST['pfData'],true));
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
	        // $check3 = $continueLevelAppPDO->pfValidPaymentData($amountToPay,$pfData['amount_gross']);
	        // $check4 = $continueLevelAppPDO->pfValidServerConfirmation($pfParamString, $pfHost);
	        // echo $check3?"true":"false";
	        // echo $check4?"true":"false";
	        
	        $std_id=$id;
	        // $applicant_id=$continueLevelAppPDO->getStudentId($id);
		   // $amountToPay=$continueLevelAppPDO->getAmountToPay($continueLevelAppPDO->getApplicationId($id));
		   // $proof_of_payment=$_GET['pt'];
		   // $applicant_id=$continueLevelAppPDO->getStudentId($id);
		    $school=$getStudentGradeIfExists['level'];
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
	        $day=date("d");
	        $month=date("m");
	        $year=date("Y");
	        $e=$paymentProcessor->processPaymentIntoDBTERTIARY($std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day);
	       if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
	            $month=TimePdo::getMonth($month);
				$emailTo=$email_address;
			    $emailFrom="np-reply@netchatsa.com";
			    $Message="<p>Dear Netchatsa Student</p><h5 style='color:green;'>PAYMENT OF (".$amountToPay.") SUCCESSFUL</h5>
			    <p>
			    {$name_first} {$name_last} you have made a successfull payment via netchatsa App for tertiary self learning assistance.
			    </p>
			    <p>
			    <style>
			        width:50%;
	                border:1px solid #ddd;
	                color:#45f3ff;
			    </style>
			    <table>
			        <tr>
			            <th>Paid Amount :</th>
			            <th>{$amount_gross}</th>
			        </tr>
			        <tr>
			            <th>Payment Status :</th>
			            <th>{$payment_status}</th>
			        </tr>
			        <tr>
			            <th>Student :</th>
			            <th>{$name_first} {$name_last}</th>
			        </tr>
			        <tr>
			            <th>Payment Date:</th>
			            <th>{$day}-{$month}-{$year}</th>
			        </tr>
			        <tr>
			            <th>Description:</th>
			            <th>{$item_name} :: {$item_description}</th>
			        </tr>
			        
			    </table>
			    
			    </p>";
			    $subject="Tertiary Admin Fee Successfully paid ({$std_id})";
			 //   $pdo->sendEmail($emailTo,$emailFrom,$Message,$subject);
			    $e->extraData=$notification->fakaKuNotification($subject,$Message,$cur_user_row['my_id'],$emailFrom,$cur_user_row);
			    $emailTo="netchatsa@gmail.com";
			    $emailFrom="np-reply@netchatsa.com";
			    $Message="<p>Mr MS Mzobe </p><h5 style='color:green;'>PAYMENT OF (".$amountToPay.") SUCCESSFUL By user ({$emailTo} - {$id})</h5>
			    <p>
			    {$name_first} {$name_last} have made a successfull payment via netchatsa App for TERTIARY SELF LEARNING.
			    </p>
			    <p>
			    <table>
			        <tr>
			            <th>Paid Amount :</th>
			            <th>{$amount_gross}</th>
			        </tr>
			        <tr>
			            <th>Payment Status :</th>
			            <th>{$payment_status}</th>
			        </tr>
			        <tr>
			            <th>Student :</th>
			            <th>{$name_first} {$name_last}</th>
			        </tr>
			        <tr>
			            <th>Payment Date:</th>
			            <th>{$day}-{$month}-{$year}</th>
			        </tr>
			        <tr>
			            <th>Description:</th>
			            <th>{$item_name} :: {$item_description}</th>
			        </tr>
			        
			    </table>
			    
			    </p>";
			    
			    $e->moreExtraData=$notification->sendEmail("netchatsa@gmail.com",$emailFrom,$Message,$subject);
	        }

	    }
    echo json_encode($e);
}
else{
    // $e="No Session Found";
    session_destroy();
    ?>
    <script>
        window.location=("../../?login&error=warning: Stop this madness!!!");
    </script>
    <?php
}

?>