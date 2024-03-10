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
    // $cur_user_row=mysqli_fetch_array($conn->query("select*from create_runaccount where usermail='$a'"));
        $id=$cur_user_row['my_id'];
        $getStudentGradeIfExists=$pdo->getStudentGradeIfExists($cur_user_row['my_id'],"tertiary");
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
        $data["signature"] = $pdo->generateSignature($data, $passPhrase);
        $pfParamString = $pdo->dataToString($data);
        //echo 'Param : '.$pfParamString;
        
        $identifier = $pdo->generatePaymentIdentifier($pfParamString);
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
                        $(".PaymentRequired").removeAttr("hidden");
                        $.ajax({
                    		url:'./model/tertiaryMonthlyPaymentSuccess.php',
                    		type:'post',
                    		data:{std_id:std_id,amountToPay:amountToPay,pfData:pfData,pfParamString:pfParamString},
                    		success:function(e){
                    		    console.log(e);
                    		    if(e.length<=2){
                    		        $(".PaymentRequiredASI").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                    		        $(".PaymentRequiredASI").html("Payment Successfull, Processing Request...");
                    		        loader("tertiary");
                    		    }
                    		    else{
                    		        $(".PaymentRequiredASI").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                    		        $(".PaymentRequiredASI").html(e);
                    		    }
                    			
                    		}
                        });
                      }
                      else{
                          $(".PaymentRequiredASI").removeAttr("hidden");
                          //$(".PaymentRequiredASI").removeAttr("hidden").html('Payment Cancelled');
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
                window.location=("../../?Yazi uyajwayela wena!!, Stop trying to access somebody's account through your own login details.");
            </script>
        <?php
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