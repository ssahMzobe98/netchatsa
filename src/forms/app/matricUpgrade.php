<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
use Src\Classes\PayFast\PayFastIntegration;
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if(isset($_SESSION['usermail'])){
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	$matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$userPdo->connect]);
	$tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
	$sgelaUniPdo=PDOServiceFactory::make(ServiceConstants::SGELA_UNI_PDO,[$userPdo->connect]);
		if(!$matricUpgrade->isRegistered($cur_user_row['my_id'])){
			?>
			<style>
				.ropw{
					border:1px solid #45f3ff;
					padding: 2px 2px;
				}
				.ropw .full-tc-page{
					width: 100%;
					border: 1px solid navy;
					padding: 1px 3px;
				}
				.ropw .full-tc-page .regForm{
					width: 100%;
					border: 1px solid #45f3ff;
					padding: 4px 4px;
				}
				.ropw .full-tc-page .regForm table{
					width: 100%;
				}
				.ropw .full-tc-page .regForm table .td{
					width: 30%;
					padding: 6px 6px;
				}
				.ropw .full-tc-page .regForm table #td{
					width: 70%;
					padding: 6px 6px;
				}
				.ropw .full-tc-page .regForm table td input,select{
					width: 100%;
					padding: 10px 10px;
					cursor: pointer;
					color: #45f3ff;
					background-color: #212121;
				}
				.ropw .full-tc-page .regForm .btn-mac{
					padding: 15px 15px;
					/*border: 2px solid navy;*/
				}
				.ropw .full-tc-page .regForm .btn-mac .btn{
					border: 2px solid #45f3ff;
					color: #45f3ff;
					padding: 5px 5px;
					border-radius: 50px;
					font-size: 15px;
				}
				.ropw .full-tc-page .regForm .btn-mac .btn:hover{
					border: 2px solid navy;
					color: navy;

				}

			</style>
				<div class="ropw" >
					<div class="full-tc-page">
						<h2>Register to start learning</h2>
						<div class="regForm">
							<table>
								<tr>
									<td class="id">Name</td>
									<td id="id"><input placeholder="First Name" type="text" class="nameMatricUpgrade"></td>
									
									
								</tr>
								<tr>
									<td class="id">Surname</td>
									<td id="id"><input placeholder="Last Name" type="text" class="surnameMatricUpgrade"></td>
									
								</tr>
								<tr>
									<td class="id">SA ID No</td>
									<td id="id"><input placeholder="SA ID Number" type="number" class="idNumMatricUpgrade"></td>
									
								</tr>
								<tr>
									<td class="id">Phone Number</td>
									<td id="id"><input placeholder="SA Phone Number" type="number" class="phoneMatricUpgrade"></td>
									
								</tr>
								<tr>
									<td class="id">Email Address</td>
									<td id="id"><input placeholder="Email Address" type="email" class="emailMatricUpgrade"></td>
									
								</tr>
								<tr>
									<td class="id">School Registered At</td>
									<td id="id"><select class="SchoolsSA">
										<option value="">-- Select School --</option>
										<?php $tertiaryApplications->getAllSchools();?>
									</select></td>
									
								</tr>
								<tr>
									<td class="id">Subject 1</td>
									<td id="id"><select class="subj1MatricUpgrade">

										<?php $matricUpgrade->getMatricSubjects();?>
									</select></td>
									
								</tr>
								<tr>
									<td class="id">Subject 2</td>
									<td id="id"><select class="subj2MatricUpgrade">
										<?php $matricUpgrade->getMatricSubjects();?>
									</select></td>
									
								</tr>
								<tr>
									<td class="id">Subject 3</td>
									<td id="id"><select class="subj3MatricUpgrade">
										<?php $matricUpgrade->getMatricSubjects();?>
									</select></td>
									
								</tr>
								<tr>
									<td class="id">Subject 4</td>
									<td id="id">
										<select class="subj4MatricUpgrade">
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</td>
									
								</tr>
								<tr>
									<td class="id">Subject 5</td>
									<td id="id"><select class="subj5MatricUpgrade">
										<?php $matricUpgrade->getMatricSubjects();?>
									</select></td>
									
								</tr>
								<tr>
									<td class="id">Subject 6</td>
									<td id="id"><select class="subj6MatricUpgrade">
										<?php $matricUpgrade->getMatricSubjects();?>
									</select></td>
									
								</tr>
								<tr>
									<td class="id">Subject 7</td>
									<td id="id"><select class="subj7MatricUpgrade">
										<?php $matricUpgrade->getMatricSubjects();?>
									</select></td>
									
								</tr>
								<tr>
									<td class="id">Subject 8</td>
									<td id="id"><select class="subj8MatricUpgrade">
										<?php $matricUpgrade->getMatricSubjects();?>
									</select></td>
									
								</tr>
								<tr>
									<td class="id">Subject 9</td>
									<td id="id"><select class="subj9MatricUpgrade">
										<?php $matricUpgrade->getMatricSubjects();?>
									</select></td>
									
								</tr>
								<tr>
									<td class="id">Subject 10</td>
									<td id="id"><select class="subj10MatricUpgrade">
										
										<?php $matricUpgrade->getMatricSubjects();?>
									</select></td>
									
								</tr>
								
							</table>
							<div class="btn-mac">
								<button class="btn submitMatricReWriteReg">Register</button>
							</div>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function(){
						$(".submitMatricReWriteReg").click(function(){
							const SchoolsSA=$(".SchoolsSA").val();
							const nameMatricUpgrade=$(".nameMatricUpgrade").val();
							const surnameMatricUpgrade=$(".surnameMatricUpgrade").val();
							const idNumMatricUpgrade=$(".idNumMatricUpgrade").val();
							const phoneMatricUpgrade=$(".phoneMatricUpgrade").val();
							const emailMatricUpgrade=$(".emailMatricUpgrade").val();
							const subj1MatricUpgrade=$(".subj1MatricUpgrade").val();
							const subj2MatricUpgrade=$(".subj2MatricUpgrade").val();
							const subj3MatricUpgrade=$(".subj3MatricUpgrade").val();
							const subj4MatricUpgrade=$(".subj4MatricUpgrade").val();
							const subj5MatricUpgrade=$(".subj5MatricUpgrade").val();
							const subj6MatricUpgrade=$(".subj6MatricUpgrade").val();
							const subj7MatricUpgrade=$(".subj7MatricUpgrade").val();
							const subj8MatricUpgrade=$(".subj8MatricUpgrade").val();
							const subj9MatricUpgrade=$(".subj9MatricUpgrade").val();
							const subj10MatricUpgrade=$(".subj10MatricUpgrade").val();
							var error=0;
							if(nameMatricUpgrade==""){
								$(".nameMatricUpgrade").attr("style","color:red;border:2px solid red;");
								$error=1;
							}
							else if(surnameMatricUpgrade==""){
								$(".surnameMatricUpgrade").attr("style","color:red;border:2px solid red;");
								$error=1;
							}
							else if(idNumMatricUpgrade==""){
								$(".idNumMatricUpgrade").attr("style","color:red;border:2px solid red;");
								$error=1;
							}
							else if(phoneMatricUpgrade==""){
								$(".phoneMatricUpgrade").attr("style","color:red;border:2px solid red;");
								$error=1;
							}
							else if(emailMatricUpgrade==""){
								$(".emailMatricUpgrade").attr("style","color:red;border:2px solid red;");
								$error=1;
							}
							else if(subj1MatricUpgrade==""){
								$(".subj1MatricUpgrade").attr("style","color:red;border:2px solid red;");
								$error=1;
							}
							else if(SchoolsSA==""){
								$(".SchoolsSA").attr("style","color:red;border:2px solid red;");
								$error=1;
							}
							else if(error==1){
								$(".submitMatricReWriteReg").attr("style","color:red;border:2px solid red;");
							}
							else{
								$(".submitMatricReWriteReg").attr("style","background-color:#000;color:green;padding:5px;opacity:.8;border:2px solid green");
								$(".submitMatricReWriteReg").html("Processing...");
								$.ajax({
									url:"./controller/ajaxCallProcessor.php",
									type:"POST",
									data:{
										nameMatricUpgrade:nameMatricUpgrade,
										surnameMatricUpgrade:surnameMatricUpgrade,
										idNumMatricUpgrade:idNumMatricUpgrade,
										phoneMatricUpgrade:phoneMatricUpgrade,
										emailMatricUpgrade:emailMatricUpgrade,
										subj1MatricUpgrade:subj1MatricUpgrade,
										subj2MatricUpgrade:subj2MatricUpgrade,
										subj3MatricUpgrade:subj3MatricUpgrade,
										subj4MatricUpgrade:subj4MatricUpgrade,
										subj5MatricUpgrade:subj5MatricUpgrade,
										subj6MatricUpgrade:subj6MatricUpgrade,
										subj7MatricUpgrade:subj7MatricUpgrade,
										subj8MatricUpgrade:subj8MatricUpgrade,
										subj9MatricUpgrade:subj9MatricUpgrade,
										subj10MatricUpgrade:subj10MatricUpgrade,
										SchoolsSA:SchoolsSA
									},
									cache:false,
									beforeSend:function(){
										$(".submitMatricReWriteReg").html("<img style='width:4%;color:#45f3ff;' src='../img/processor.gif'><span style='color:green;'>UPLOADING..</span>");
									},
									success:function(e){
										// console.log(e.length);
										 response = JSON.parse(e);
                   						 if(response['responseStatus']==='F'){
											$(".submitMatricReWriteReg").attr("style","background-color:#000;border:1pxsolid red;color:red;padding:5px;opacity:.8;");
											$(".submitMatricReWriteReg").html("Suspense 320 : "+response['responseMessage']);
										}
										else{
											$(".submitMatricReWriteReg").html("<small style='color:green;'>Registration Successful..</small>");
											$(".nameMatricUpgrade").val("");
											$(".surnameMatricUpgrade").val("");
											$(".idNumMatricUpgrade").val("");
											$(".phoneMatricUpgrade").val("");
											$(".emailMatricUpgrade").val("");
											$(".subj1MatricUpgrade").val("");
											$(".subj2MatricUpgrade").val("");
											$(".subj3MatricUpgrade").val("");
											$(".subj4MatricUpgrade").val("");
											$(".subj5MatricUpgrade").val("");
											$(".subj6MatricUpgrade").val("");
											$(".subj7MatricUpgrade").val("");
											$(".subj8MatricUpgrade").val("");
											$(".subj9MatricUpgrade").val("");
											$(".subj10MatricUpgrade").val("");
											$(".SchoolsSA").val();
											loader("matricUpgrade");
										}
									}
								});
							}
						});
					});
				</script>
		
			<?php

		}
		else{
		    $MatricUpgradeStudentDetails=$matricUpgrade->getMatricUpgradeStudentDetails($cur_user_row['my_id']);
		    if(!empty($MatricUpgradeStudentDetails)){
		        $isPaid=false;
		        $month = date("m");
	            $day= date("d");
	            $year= date("Y");
		        
	            $std_id=$MatricUpgradeStudentDetails['id'];
	            $studentIsPaidThisMonthAndYear=$tertiaryApplications->studentIsPaidThisMonthAndYear($std_id,$year,$month);
	            if(!empty($studentIsPaidThisMonthAndYear)){
	                $isPaid=true;
	            }
		        if(!$isPaid){
		            $std_id='2023'.$MatricUpgradeStudentDetails['id'];
		            $payment_required=400+(400*0.15)+3;
		            $payment_required=number_format( sprintf( '%.2f', $payment_required ), 2, '.', '' );
		            $monthText=TimePdo::getMonth($month);
                    $day;
                    $year;
                    if(isset($_GET['payment'])){
                        $amountToPay=400.00;
                        $tax=($amountToPay*0.15)+3;
    	                $amountToPay+=$tax;
                        $passPhrase = 'msiziMzobe98';
                        // $amountToPay = 5;
                        $amount_net=$amountToPay-2.48;
                        $data = array(
                            'merchant_id' => '18152361',
                            'merchant_key' => '2ammma77nrah4',
                            'return_url' => 'https://netchatsa.com/?apply',
                            'cancel_url' => 'https://netchatsa.com/cancel.php',
                            'notify_url' => 'https://netchatsa.com/notify.php',
                            'name_first'=>$MatricUpgradeStudentDetails['namematricupgrade'],
                            'name_last'=>$MatricUpgradeStudentDetails['surnamematricupgrade'],
                            'email_address'=>$MatricUpgradeStudentDetails['emailmatricupgrade'],
                            'm_payment_id' => $std_id,
                            'amount' => number_format( sprintf( '%.2f', $amountToPay ), 2, '.', '' ),
                            'item_name' => 'NETCHATSA MATRIC UPGRADE ADMIN FEE'
                            
                        );
                            // Generate signature (see Custom Integration -> Step 2)
                        $data["signature"] = PayFastIntegration::generateSignature($data, $passPhrase);
                        $pfParamString = PayFastIntegration::dataToString($data);
                        //echo 'Param : '.$pfParamString;
                        
                        $identifier = PayFastIntegration::generatePaymentIdentifier($pfParamString);
                        $data['pf_payment_id'] = '';
                        $data['item_description'] = 'THIS PAYMENT IS MADE ONLY FOR MATRIC UPGRADE CLASSES.';
                        $data['amount_gross'] = number_format( sprintf( '%.2f', $amountToPay ), 2, '.', '' );
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
                                    const amountToPay="<?php echo $amountToPay;?>";
                                    const pfData ='<?php echo json_encode($data);?>';
                                    const pfParamString = '<?php echo $pfParamString;?>';
                                    $(".sudoCodeoSitePayment").removeAttr("hidden");
                                    $.ajax({
                                		url:'../src/forms/app/MatricPaymentUpgradeSuccess.php',
                                		type:'post',
                                		data:{std_id:std_id,amountToPay:amountToPay,pfData:pfData,pfParamString:pfParamString},
                                		success:function(e){
                                		    response = JSON.parse(e);
                   							if(response['responseStatus']==='S'){
                                		        $(".processingMatricUpgradePayment").removeAttr("hidden").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".processingMatricUpgradePayment").html("Payment Successfull, Processing Request...");
                                		        loader("matricUpgrade");
                                		    }
                                		    else{
                                		        $(".processingMatricUpgradePayment").removeAttr("hidden").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".processingMatricUpgradePayment").html(response['responseMessage']);
                                		    }
                                		}
                                    });
                                  }
                                  else{
                                      //window.location=("./?_=apply&failedProcessing=true");
                                      $(".processingMatricUpgradePayment").removeAttr("hidden").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                                	  $(".processingMatricUpgradePayment").html("Payment Cancelled");
                                      
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

		            ?>
		            <style>
		                .PaymentRequired{
		                    width:100%;
		                    padding:10px 10px;
		                    justify-content:center;
		                    text-align:center;
		                    align-content:center;
		                }
		                .paymentMatricUpgrade{
		                    width:90%;
		                    padding:10px 10px;
		                    background:navy;
		                    color:#45f3ff;
		                    border:2px solid white;
		                    border-radius:50px;
		                }
		            </style>
		            <br>
		            <center>
		                <h5 style="color:#45f3ff;">
		                    Outstanding Payment for <?php echo $monthText." ".$year." "?>. Please make payment of R<?php echo $payment_required;?> to continue learning.
		                </h5>
    		            <div class="PaymentRequired">
                            <div class="paymentMatricUpgrade" <?php if(isset($_['payment'])){ echo"hidden";}?> onclick="loader('matricUpgrade&payment')">PAY-NOW <?php echo 'R'.$payment_required;?></div>
            			</div>
            			<div class="processingMatricUpgradePayment" hidden></div>
            			<script>
            			 //   function paymentMatricUpgrade(){
            			 //       $(".PaymentRequired").attr("hidden",true);
            			 //       $(".processingMatricUpgradePayment").removeAttr("hidden").
            			 //       html("Please Wait, Fetching Payment request...").
            			 //       load("./model/MatricPaymentUpgradeSuccess.php");
            			 //   }
            			</script>
		           </center>
		            <?php
		        }
		        elseif(isset($_GET['_upgrade_'])&&!empty($_GET['_upgrade_'])){
        			?>
        			<style>
        				    .medLocker{
                		        width:100%;
                                color:#45f3ff;
                		    }
                		    .medLocker .bodyCamp{
                		        width:100%;
                		        padding:10px;
                		    }
                		    .medLocker .bodyCamp .radeMos{
                		        width:100%;
                		        height:auto;
                		        padding:6px;
                		        box-shadow: 0 8px 6px -6px black;
                		        display:flex;
                		        cursor:pointer;
                		    }
                		    .medLocker .bodyCamp .radeMos:hover{
                		        background-color:navy;
                		    }
                		    .medLocker .bodyCamp .radeMos .img-kMover{
                		        width:60px;
                		        height:60px;
                		        border-radius:100%;
                		        padding:10px;
                		    }
                		    .medLocker .bodyCamp .radeMos .img-kMover img{
                		        width:100%;
                		        height:100%;
                		        border-radius:100%;
                		    }
        			</style>
        			<div class="medLocker">
        				<?php
        				$getSubjInfo=$matricUpgrade->getMatricSubjInfo($_GET['_upgrade_']);
        				// print_r($array[$i]);
        				$subj_id=$getSubjInfo['subj_id'];
        				$subj_name=$getSubjInfo['subject'];
        				$dir="../img/jj.jpg";
        				?>
        				<div class="bodyCamp" onclick="na2thisterm(1,<?php echo $_GET['_upgrade_'];?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
        	    		            <img src="<?php echo $dir;?>">
        	    		        </div>
        	    		        <div class="maxcKood">
        	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 1</span></small></div>
        	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
        	    		        </div>
        		            </div>
        			    </div>
        			    <div class="bodyCamp" onclick="na2thisterm(2,<?php echo $_GET['_upgrade_'];?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
        	    		            <img src="<?php echo $dir;?>">
        	    		        </div>
        	    		        <div class="maxcKood">
        	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 2</span></small></div>
        	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
        	    		        </div>
        		            </div>
        			    </div>
        			    <div class="bodyCamp" onclick="na2thisterm(3,<?php echo $_GET['_upgrade_'];?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
        	    		            <img src="<?php echo $dir;?>">
        	    		        </div>
        	    		        <div class="maxcKood">
        	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 3</span></small></div>
        	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
        	    		        </div>
        		            </div>
        			    </div>
        			    <div class="bodyCamp" onclick="na2thisterm(4,<?php echo $_GET['_upgrade_'];?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
        	    		            <img src="<?php echo $dir;?>">
        	    		        </div>
        	    		        <div class="maxcKood">
        	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 4</span></small></div>
        	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
        	    		        </div>
        		            </div>
        			    </div>
        	    	</div>
        	    	<script>
        	    		function na2thisterm(term,subj_id){
        	    			loader("matricUpgrade&term="+term+"-"+subj_id);
        	    		}
        	    	</script>
        
        		<?php
        		}
        		elseif(isset($_GET['term'])&&!empty($_GET['term'])){
        			$tmp=explode("-",$_GET['term']);
        			$term=$tmp[0];
        			$subj_id=$tmp[1];
        			$getMatricRewriteSbjectContent=$matricUpgrade->getMatricRewriteSbjectContent($subj_id,$_GET['term']);
        			if(empty($getMatricRewriteSbjectContent)){
        				?>
        				<h2 style="color:#45f3ff;background-color: red;padding:10px 10px;text-align: center;">Subject Has no content yet!!</h2>
        				<?php
        			}
        			else{
        			    $chapters=array();
        				foreach ($getMatricRewriteSbjectContent as $array) {
        					if(!in_array($array['chapter'],$chapters)){
        					    array_push($chapters,$array['chapter']);
        					}
        				}
        				for($i=0;$i<sizeof($chapters);$i++){
        				    $matricUpgradeChapterInfo=$sgelaUniPdo->GetmatricUpgradeChapterInfo($chapters[$i]);
        				    $MatricUpgradeSubjInfo=$matricUpgrade->getMatricSubjInfo($matricUpgradeChapterInfo['subject']);
        				    $url=$term."-".$subj_id."-".$chapters[$i];
        				    // $ciphering = "AES-128-CTR"; 
                //             $iv_length = openssl_cipher_iv_length($ciphering); 
                //             $options = 0; 
                //             $encryption_iv = '0685153023980510'; 
                //             $encryption_key = "MaLwandeMkhize"; 
                //             $encryption = openssl_encrypt($url, $ciphering, $encryption_key, $options, $encryption_iv); 
                //           $decryption =  openssl_decrypt($url, $ciphering, $encryption_key, $options, $encryption_iv);
                            
                            //echo "Enryipting :: ".$url."<br>".$encryption.":: Encrypted<br>Decypted::".$decryption;
        				    ?>
        				    <center>
        				        <style>
        				            .matricSubjectHolder{
        				                width:100%;
        				                padding:10px 10px;
        				                border:none;
        				                /*box-shadow: 0 4px 6px 7px;*/
        				                box-shadow: 0 8px 6px -6px black;
        				            }
        				        </style>
        				    <div class="matricSubjectHolder" onclick="navigateTochapterTermContent('<?php echo $url?>')">
        				        <div class="display-subject"><?php echo $MatricUpgradeSubjInfo['subject'];?></div>
        				        <div class="display-chapter"><?php echo $matricUpgradeChapterInfo['chapter']?></div>
        				    </div>
        				    <br>
        				    </center>
        				    <script>
        				        function navigateTochapterTermContent(url){
                	    			loader("matricUpgrade&___="+url);
                	    			
                	    		}
        				    </script>
        				    <?php
        				}
        			}
        
        		}
        		elseif(isset($_GET['___'])){
        		    $url=explode("-",$_GET['___']);
        		    $term=$url[0];
        			$subj_id=$url[1];
        			$chapter=$url[2];
        			?>
        			<style>
                                .btn{
                                    color:#45f3ff;
                                    background-color:navy;
                                    
                                }
                                .btn0{
                                    color:#45f3ff;
                                    background-color:#FF6F61;
                                    
                                }
                                .btn1{
                                    color:#45f3ff;
                                    background-color:#6B5B95;
                                    
                                }
                                .btn2{
                                    color:green;
                                    background-color:#45f3ff;
                                    
                                }
                                .btn:hover{
                                    background-color:#88B04B;
                                    border:1px solid #45f3ff;
                                    color:#45f3ff;
                                }
                            </style>
                            <div class="mac" style="width:100%;display:flex;">
                                <div style="width:3%;"></div><div class="btn" data-toggle="modal" data-target="#install_module">Assignments<sup>(0)</sup></div><div style="width:3%;"></div><div class="btn btn0" >Tests<sup>(0)</sup></div><div style="width:3%;"></div><div class="btn btn1" >Quiz<sup>(0)</sup></div><div style="width:3%;"></div><div class="btn btn2" ><i class="fa fa-check" style="color:green;"></i></div>
                            </div>
                            
                            
                            <style>
                            .matricUpgradeContentDisplayer{
                		        width:100%;
                		        overflow-x:auto;
                                overflow-wrap: break-word;
                                word-wrap: break-word;
                                hyphens: auto;
                                color:#45f3ff;
                		    }
                		    .matricUpgradeContentDisplayer .bodyCamp{
                		        width:100%;
                		        padding:10px;
                		    }
                		    .matricUpgradeContentDisplayer .bodyCamp .radeMos{
                		        width:100%;
                		        height:auto;
                		        padding:6px;
                		        box-shadow: 0 8px 6px -6px black;
                		        cursor:pointer;
                		    }
                		    .matricUpgradeContentDisplayer .bodyCamp .radeMos:hover{
                		        background-color:navy;
                		    }
                		    
                		</style>
        			<div class="matricUpgradeContentDisplayer"></div>
                    <span id="loadmeTag"></span>
                    <script>
                    $(document).ready(function(){
                     
                     var limit = 10;
                     var start = 0;
                     var action = 'inactive';
                    
                    
                     if(action == 'inactive')
                     {
                      action = 'active';
                      loadMatricUpgradeData(limit, start);
                     }
                     
                     
                    });
                    $(window).scroll(function(){
                      if($(window).scrollTop() + $(window).height() > $(".matricUpgradeContentDisplayer").height() && action == 'inactive')
                      {
                       action = 'active';
                       start = start + limit;
                       setTimeout(function(){
                        loadMatricUpgradeData(limit, start);
                       }, 1000);
                      }
                     });
                     function loadMatricUpgradeData(limit, start)
                     {
                         $('#loadmeTag').html("<span>Please Wait Processing..</span>");
                        const term=<?php echo $term;?>;
                        const subj=<?php echo $subj_id;?>;
                        const chapter=<?php echo $chapter;?>;
                      $.ajax({
                       url:"../src/forms/app/fetchMatricUpgradeContent.php",
                       method:"POST",
                       data:{limit:limit, start:start,term:term,subj:subj,chapter:chapter},
                       cache:false,
                       success:function(data)
                       {
                        $('.matricUpgradeContentDisplayer').append(data);
                        if(data == '')
                        {
                         $('#loadmeTag').html("<span type='button' class='btn btn-info'>limit reached</span>");
                         action = 'active';
                        }
                        else
                        {
                         $('#loadmeTag').html("<span class='btn btn-info' onclick='loadMatricUpgradeData("+(limit)+", "+(start + limit)+")'>load more</span>");
                         action = "inactive";
                        }
                       }
                      });
                     }
                     </script>
        			<?php
        			
        		}
        		else{
        			?>
        			<style>
        				.medLocker{
                		        
                		        width:100%;
                		        
                		        /*hyphens: auto;
                		        overflow-x:auto;
                                overflow-wrap: break-word;
                                word-wrap: break-word;*/
                                
                                color:#45f3ff;
                                
                		    }
                		    .medLocker .bodyCamp{
                		        width:100%;
                		        padding:10px;
                		    }
                		    .medLocker .bodyCamp .radeMos{
                		        width:100%;
                		        height:auto;
                		        padding:6px;
                		        box-shadow: 0 8px 6px -6px black;
                		        display:flex;
                		        cursor:pointer;
                		    }
                		    .medLocker .bodyCamp .radeMos:hover{
                		        background-color:navy;
                		    }
                		    .medLocker .bodyCamp .radeMos .img-kMover{
                		        width:60px;
                		        height:60px;
                		        border-radius:100%;
                		        padding:10px;
                		    }
                		    .medLocker .bodyCamp .radeMos .img-kMover img{
                		        width:100%;
                		        height:100%;
                		        border-radius:100%;
                		    }
        		</style>
        		<div style="width:100%;border-bottom:1px solid #ddd;padding:5px 5px;display:flex;">
        		    <select class="subjectAdd" style="width:100%;border:none;padding:5px 0;color:#45f3ff;background:#1c1c1c;">
        		        <?php $matricUpgrade->getMatricSubjects();?>
        		    </select>
        		    <span style="border:none;padding:5px 5px;color:#45f3ff;border:1px solid #ddd;cursor:pointer;" onclick="addSubjectToUpgrade()">Add</span>
        		</div>
        		<div class="submitMatricReWriteRegAdd" hidden></div>
        		<div class="medLocker">
        			<?php
        			$getAllInfoOfMatricReWriteLearner=$matricUpgrade->getAllInfoOfMatricReWriteLearner($cur_user_row['my_id']);
        			$array=[
        			    "subj1matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj1matricupgrade'],
            			"subj2matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj2matricupgrade'],
            			"subj3matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj3matricupgrade'],
            			"subj4matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj4matricupgrade'],
            			"subj5matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj5matricupgrade'],
            			"subj6matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj6matricupgrade'],
            			"subj7matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj7matricupgrade'],
            			"subj8matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj8matricupgrade'],
            			"subj9matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj9matricupgrade'],
            			"subj10matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj10matricupgrade']
        			        ];
        			
        			$arr=[];
        			foreach($array as $subj_id){
        				if(!empty($subj_id)){
        					$arr[]=$subj_id;
        				}
        			}
        			for ($i=0;$i<sizeof($arr);$i++){
        				$getSubjInfo=$matricUpgrade->getMatricSubjInfo($arr[$i]);
        				$subj_id=$getSubjInfo['subj_id'];
        				$subj_name=$getSubjInfo['subject'];
        				$dir="../img/jj.jpg";
        				?>
        				<div class="bodyCamp" onclick="na2thisSubj(<?php echo $subj_id;?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
                		            <img src="<?php echo $dir;?>">
                		        </div>
                		        <div class="maxcKood">
                		            <div><small><?php echo $subj_name;?></small></div>
                		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
                		        </div>
        		            </div>
            		    </div>
            		    
        				<?php
        			}
        		?>
        		</div>
        		<script>
        		    function addSubjectToUpgrade(){
        		        const subjModelAddSunject=$(".subjectAdd").val();
        		        if(subjModelAddSunject==""){
        		            $(".submitMatricReWriteRegAdd").removeAttr("hidden");
        					$(".submitMatricReWriteRegAdd").attr("style","color:red;border:2px solid red;");
        					$(".submitMatricReWriteRegAdd").html("<small>Cannot process Empty inputy!.. </small>");
        				}
        				else{
        				    $(".submitMatricReWriteRegAdd").removeAttr("hidden");
        					$(".submitMatricReWriteRegAdd").attr("style","background-color:#000;color:green;");
        					$(".submitMatricReWriteRegAdd").html("Processing...");
        					$.ajax({
        						url:"./controller/ajaxCallProcessor.php",
        						type:"POST",
        						data:{
        							subjModelAddSunject:subjModelAddSunject
        						},
        						cache:false,
        						beforeSend:function(){
        							$(".submitMatricReWriteRegAdd").html("<img style='width:4%;color:#45f3ff;' src='../../img/processor.gif'><span style='color:green;'>UPLOADING..</span>");
        						},
        						success:function(e){
        							response = JSON.parse(e);
									if(response['responseStatus']==='F'){
        								$(".submitMatricReWriteRegAdd").attr("style","background-color:#000;border:1pxsolid red;color:red;padding:5px;opacity:.8;");
        								$(".submitMatricReWriteRegAdd").html("Suspense 320 : "+response['responseMessage']);
        							}
        							else{
        								$(".submitMatricReWriteRegAdd").html("<small style='color:green;'>Subject Added Successful..</small>");
        								$(".subjectAdd").val();
        								
        								loader("matricUpgrade");
        							}
        						}
        					});
        				}
        		    }
        			function na2thisSubj(id){
        				loader("matricUpgrade&_upgrade_="+id);
        			}
        		</script>
        		<?php
        		}
		    }
		    else{
		        echo"<h5 style='color:#45f3ff;background-color:red;padding:10px 10px;text-align:center;'> U are not recognized as matric upgrade user.</h5>";exit();
		    }
		}
		
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../");
	</script>

	<?php
}
?>