<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\PayFast\PayFastIntegration;

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
    // $cur_user_row=mysqli_fetch_array($conn->query("select*from create_runaccount where usermail='$a'"));
        $id=$cur_user_row['my_id'];
        $getStudentGradeIfExists=$matricUpgrade->getStudentGradeIfExists($cur_user_row['my_id'],"tertiary");
        $std_id=$getStudentGradeIfExists['id'];
        $payment_required=150+(150*0.15)+3.50;
    	$payment_required=number_format( sprintf( '%.2f', $payment_required ), 2, '.', '' );
        $passPhrase = 'msiziMzobe98';
        $amount_net=$payment_required-2.48;
        $data = array(
            'merchant_id' => '18152361',
            'merchant_key' => '2ammma77nrah4',
            'return_url' => 'https://netchatsa.com/view/?_=apply',
            'cancel_url' => 'https://netchatsa.com/cancel.php',
            'notify_url' => 'https://netchatsa.com/notify.php',
            'name_first'=>$getStudentGradeIfExists['name'],
            'name_last'=>$getStudentGradeIfExists['surname'],
            'email_address'=>$cur_user_row['usermail'],
            'm_payment_id' => $getStudentGradeIfExists['id'],
            'amount' => number_format( sprintf( '%.2f', $payment_required ), 2, '.', '' ),
            'item_name' => 'TERTIARY SELF LEARNING NETCHATSA'
            
        );
            // Generate signature (see Custom Integration -> Step 2)
        $data["signature"] = PayFastIntegration::generateSignature($data, $passPhrase);
        $pfParamString = PayFastIntegration::dataToString($data);
        //echo 'Param : '.$pfParamString;
        
        $identifier = PayFastIntegration::generatePaymentIdentifier($pfParamString);
        $data['pf_payment_id'] = '';
        $data['item_description'] = 'THIS PAYMENT IS A MONTHLY PAYABLE ADMINISTRATION FEE CHARGING TERTIARY STUDENTS REGISTERD WITH NETCHATSA. THE FEES ARE NOT FOR THE CONTENT ON THE APP. FEES ARE ONLY FOR APP ADMINISTRATION.';
        $data['amount_gross'] = number_format( sprintf( '%.2f', $payment_required ), 2, '.', '' );
        $data['amount_fee'] = 2.48;
        $data['amount_net'] = $amount_net;
        $data['payment_status'] = 'PAID';
        if($identifier!==null){
               ?>
               <script>
                  window.payfast_do_onsite_payment({"uuid":"<?php echo $identifier;?>"}, function (result){
                      if(result){
                        //   window.location=("./?_=apply&Processing=true");
                        const std_id="<?php echo $std_id;?>";
                        const amountToPay="<?php echo $payment_required;?>";
                        const pfData ='<?php echo json_encode($data);?>';
                        const pfParamString = '<?php echo $pfParamString;?>';
                        $(".PaymentRequiredASI").removeAttr("hidden").html("<small><img style='width:3%;' src='../img/loader.gif'> <span style='color:green;'>Processing Payment Request...</span></small>");
                        $.ajax({
                    		url:'./tertiaryMonthlyPaymentSuccess.php',
                    		type:'post',
                    		data:{std_id:std_id,amountToPay:amountToPay,pfData:pfData,pfParamString:pfParamString},
                    		success:function(e){
                    		    response = JSON.parse(e);
                                if(response['responseStatus']==='S'){
                    		        $(".PaymentRequiredASI").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                    		        $(".PaymentRequiredASI").html("Payment Successfull, Processing Request...");
                    		        loader("tertiary");
                    		    }
                    		    else{
                    		        $(".PaymentRequiredASI").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                    		        $(".PaymentRequiredASI").html(response['responseMessage']);
                    		    }
                    			
                    		}
                        });
                      }
                      else{
                          $(".PaymentRequiredASI").removeAttr("hidden");
                          $(".PaymentRequiredASI").removeAttr("hidden").html('<div style="background:red;color:white;">Payment Cancelled</div>');
                      }
                  });
                </script>
                   <?php
       }
       else{
           echo'<div style="width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;">
            Could not Identify your payment request {'.$identifier.'}
        </div>';
       }
}
else{
    session_destroy();
    ?>
    <script>
        window.location=("../../?error=warning: Stop this madness!!!");
    </script>
    <?php
}