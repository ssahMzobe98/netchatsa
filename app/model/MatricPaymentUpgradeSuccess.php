<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['usermail'])){
    require_once("../controller/pdo.php");
    $pdo=new _pdo_();
    $cur_user_row =$pdo->userInfo($_SESSION['usermail']);
    $userDirect=$cur_user_row['directory_index'];
    $url = explode("/",$_SERVER['REQUEST_URI']);
    $url=str_replace("%20", " ",$url[2]);
    if($url==$userDirect){
	    if(isset($_POST['std_id'],$_POST['amountToPay'],$_POST['pfData'],$_POST['pfParamString'])){
	        $a=$_SESSION['usermail'];
	        
	       // $cur_user_row=mysqli_fetch_array($conn->query("select*from create_runaccount where usermail='$a'"));
	        $id=$cur_user_row['my_id'];
	        $MatricUpgradeStudentDetails=$pdo->getMatricUpgradeStudentDetails($id);
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
	        
	        $std_id=$MatricUpgradeStudentDetails['id'];
	        // $applicant_id=$continueLevelAppPDO->getStudentId($id);
		   // $amountToPay=$continueLevelAppPDO->getAmountToPay($continueLevelAppPDO->getApplicationId($id));
		   // $proof_of_payment=$_GET['pt'];
		   // $applicant_id=$continueLevelAppPDO->getStudentId($id);
		    $school=$MatricUpgradeStudentDetails['schoolsa'];
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
	        $response=$pdo->processPaymentIntoDB($std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day);
	        if($response["response"]=="F"){
	            $e="Payment Posted: Internal Error {Please Report this error: WhatsApp 0685153023} ".$response["data"];
	        }
	        else{
	            
	           
	            $month=$pdo->getMonth($month);
				$emailTo=$email_address;
			    $emailFrom="np-reply@netchatsa.com";
			    $Message="<p>Dear Netchatsa Student</p><h5 style='color:green;'>PAYMENT OF (".$amountToPay.") SUCCESSFUL</h5>
			    <p>
			    {$name_first} {$name_last} you have made a successfull payment via netchatsa App for matric upgrade lessons.
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
			    $subject="Matric Upgrade Admin Fee Successfully paid ({$std_id})";
			    $pdo->fakaKuNotification($subject,$Message,$cur_user_row['my_id'],$emailFrom,$cur_user_row);
			 //   $pdo->sendEmail($emailTo,$emailFrom,$Message,$subject);
			    
			    $emailTo=$MatricUpgradeStudentDetails['emailmatricupgrade'];
			    $emailFrom="np-reply@netchatsa.com";
			    $Message="<p>Mr MS Mzobe </p><h5 style='color:green;'>PAYMENT OF (".$amountToPay.") SUCCESSFUL By user ({$emailTo} - {$id})</h5>
			    <p>
			    {$name_first} {$name_last} have made a successfull payment via netchatsa App for matric upgrade lessons.
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
			    
			    $pdo->sendEmail("netchatsa@gmail.com",$emailFrom,$Message,$subject);
			    $e=1;
	        }

	    }
	    else{
	        $e="YOU DO NOT HAVE PERMISSIONS TO BE HERE!!..";
	    }
	}
	else{
        session_destroy();
        ?>
            <script>
                window.location=("../../?Yazi uyajwayela wena!!, Stop trying to access somebody's account through your own login details.");
            </script>
        <?php
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