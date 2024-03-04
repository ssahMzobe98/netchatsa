<?php
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	require_once("./pdo.php");
	$pdo=new _pdo_();
	$cur_user_row =$pdo->userInfo($_SESSION['usermail']);
	$userDirect=$cur_user_row['directory_index'];
	$url = explode("/",$_SERVER['REQUEST_URI']);
	$url=str_replace("%20", " ",$url[2]);
	$std_id=$cur_user_row['my_id'];

	if($url==$userDirect){
		$e="YOU DO NOT PERMITTED TO BE ON THIS PAGE";
		if(isset(
			$_POST['grdlevel'],$_POST['subjects1'],$_POST['levelMark1'],$_POST['levelMark11'],$_POST['subjects2'],
			$_POST['levelMark2'],$_POST['levelMark22'],$_POST['subjects3'],$_POST['levelMark3'],$_POST['levelMark33'],
			$_POST['subjects4'],$_POST['levelMark4'],$_POST['levelMark44'],$_POST['subjects5'],$_POST['levelMark5'],
			$_POST['levelMark55'],$_POST['subjects6'],$_POST['levelMark6'],$_POST['levelMark66'],$_POST['subjects7'],
			$_POST['levelMark7'],$_POST['levelMark77'],$_POST['subjects8'],$_POST['levelMark8'],$_POST['levelMark88'],
			$_POST['subjects9'],$_POST['levelMark9'],$_POST['levelMark99'],$_POST['subjects10'],
			$_POST['levelMark10'],$_POST['levelMark1010'],$_POST['total'],$_POST['subj']))
		{
			$grdlevel=$pdo->OMO($_POST['grdlevel']);
			$subjects1=$pdo->OMO($_POST['subjects1']);
			$levelMark1=$pdo->OMO($_POST['levelMark1']);
			$levelMark11=$pdo->OMO($_POST['levelMark11']);
			$subjects2=$pdo->OMO($_POST['subjects2']);
			$levelMark2=$pdo->OMO($_POST['levelMark2']);
			$levelMark22=$pdo->OMO($_POST['levelMark22']);
			$subjects3=$pdo->OMO($_POST['subjects3']);
			$levelMark3=$pdo->OMO($_POST['levelMark3']);
			$levelMark33=$pdo->OMO($_POST['levelMark33']);
			$subjects4=$pdo->OMO($_POST['subjects4']);
			$levelMark4=$pdo->OMO($_POST['levelMark4']);
			$levelMark44=$pdo->OMO($_POST['levelMark44']);
			$subjects5=$pdo->OMO($_POST['subjects5']);
			$levelMark5=$pdo->OMO($_POST['levelMark5']);
			$levelMark55=$pdo->OMO($_POST['levelMark55']);
			$subjects6=$pdo->OMO($_POST['subjects6']);
			$levelMark6=$pdo->OMO($_POST['levelMark6']);
			$levelMark66=$pdo->OMO($_POST['levelMark66']);
			$subjects7=$pdo->OMO($_POST['subjects7']);
			$levelMark7=$pdo->OMO($_POST['levelMark7']);
			$levelMark77=$pdo->OMO($_POST['levelMark77']);
			$subjects8=$pdo->OMO($_POST['subjects8']);
			$levelMark8=$pdo->OMO($_POST['levelMark8']);
			$levelMark88=$pdo->OMO($_POST['levelMark88']);
			$subjects9=$pdo->OMO($_POST['subjects9']);
			$levelMark9=$pdo->OMO($_POST['levelMark9']);
			$levelMark99=$pdo->OMO($_POST['levelMark99']);
			$subjects10=$pdo->OMO($_POST['subjects10']);
			$levelMark10=$pdo->OMO($_POST['levelMark10']);
			$levelMark1010=$pdo->OMO($_POST['levelMark1010']);
			$total=$pdo->OMO($_POST['total']);
			$subj=$pdo->OMO($_POST['subj']);
			$response=$pdo->hambisaKwisgabaSokuQala($grdlevel,$subjects1,$levelMark1,$levelMark11,$subjects2,$levelMark2,$levelMark22,$subjects3,$levelMark3,$levelMark33,$subjects4,$levelMark4,$levelMark44,$subjects5,$levelMark5,$levelMark55,$subjects6,$levelMark6,$levelMark66,$subjects7,$levelMark7,$levelMark77,$subjects8,$levelMark8,$levelMark88,$subjects9,$levelMark9,$levelMark99,$subjects10,$levelMark10,$levelMark1010,$total,$subj,$cur_user_row);
			//print_r($response);
			if($response['response']=="S"){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP1 COMPLETED";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}
		elseif(isset(
			$_POST['gender'],
			$_POST['dob'],
			$_POST['title'],
			$_POST['initials'],
			$_POST['lname'],
			$_POST['fname'],
			$_POST['status'],
			$_POST['hlang'],
			$_POST['ethnicGroup'],
			$_POST['employed'],
			$_POST['hear'],
			$_POST['bursary'],
			$_POST['id_num'],
			$_POST['nationality'],
			$_POST['app_idStep2'],
			$_POST['my_id']
		)){
			$gender=$pdo->OMO($_POST['gender']);
			$dob=$pdo->OMO($_POST['dob']);
			$title=$pdo->OMO($_POST['title']);
			$initials=$pdo->OMO($_POST['initials']);
			$lname=$pdo->OMO($_POST['lname']);
			$fname=$pdo->OMO($_POST['fname']);
			$status=$pdo->OMO($_POST['status']);
			$hlang=$pdo->OMO($_POST['hlang']);
			$ethnicGroup=$pdo->OMO($_POST['ethnicGroup']);
			$employed=$pdo->OMO($_POST['employed']);
			$hear=$pdo->OMO($_POST['hear']);
			$bursary=$pdo->OMO($_POST['bursary']);
			$id_num=$pdo->OMO($_POST['id_num']);
			$nationality=$pdo->OMO($_POST['nationality']);
			$app_idStep2=$pdo->OMO($_POST['app_idStep2']);
			$response=$pdo->hambisaIsgabaSesibili($gender,$dob,$title,$initials,$lname,$fname,$status,$hlang,$ethnicGroup,$employed,$hear,$bursary,$id_num,$nationality,$app_idStep2,$_POST['my_id']);
			if($response['response']=="S"){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP2 COMPLETED";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>
					<table>
						<tr>
							<th>Name : </th>
							<th>{$title} {$initials} {$fname} {$lname}</th>
						</tr>
					</table>
				</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions.The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}
		elseif(isset($_POST['street'],
				$_POST['suburb'],
				$_POST['town'],
				$_POST['province'],
				$_POST['postal'],
				$_POST['phone'],
				$_POST['telephone'],
				$_POST['email'],
				$_POST['res'],
				$_POST['dis'],
				$_POST['studedentApplicationId'],
				$_POST['my_id_step3']
			)){

			$street=$pdo->OMO($_POST['street']);
			$suburb=$pdo->OMO($_POST['suburb']);
			$town=$pdo->OMO($_POST['town']);
			$province=$pdo->OMO($_POST['province']);
			$postal=$pdo->OMO($_POST['postal']);
			$phone=$pdo->OMO($_POST['phone']);
			$telephone=$pdo->OMO($_POST['telephone']);
			$email=$pdo->OMO($_POST['email']);
			$res=$pdo->OMO($_POST['res']);
			$dis=$pdo->OMO($_POST['dis']);
			$studedentApplicationId=$pdo->OMO($_POST['studedentApplicationId']);
			$my_id_step3=$pdo->OMO($_POST['my_id_step3']);
			$response =$pdo->hambisaKwisigabaSesibili($street,$suburb,$town,$province,$postal,$phone,$telephone,$email,$res,$dis,$studedentApplicationId,$my_id_step3);
			if($response['response']=="S"){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP3 ({$studedentApplicationId}) COMPLETED";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions.The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}
		elseif(isset(
			$_POST['fname'],
			$_POST['lname'],
			$_POST['relationship'],
			$_POST['employed'],
			$_POST['phone'],
			$_POST['alphone'],
			$_POST['email'],
			$_POST['street'],
			$_POST['suburb'],
			$_POST['town'],
			$_POST['province'],
			$_POST['postal'],
			$_POST['applicationidStep4'],
			$_POST['my_id_step4']
		)){
			$fname=$pdo->OMO($_POST['fname']);
			$lname=$pdo->OMO($_POST['lname']);
			$relationship=$pdo->OMO($_POST['relationship']);
			$employed=$pdo->OMO($_POST['employed']);
			$phone=$pdo->OMO($_POST['phone']);
			$alphone=$pdo->OMO($_POST['alphone']);
			$email=$pdo->OMO($_POST['email']);
			$street=$pdo->OMO($_POST['street']);
			$suburb=$pdo->OMO($_POST['suburb']);
			$town=$pdo->OMO($_POST['town']);
			$province=$pdo->OMO($_POST['province']);
			$postal=$pdo->OMO($_POST['postal']);
			$applicationidStep4=$pdo->OMO($_POST['applicationidStep4']);
			$my_id_step4=$pdo->OMO($_POST['my_id_step4']);
			$response=$pdo->hambisaIsgabaSesine($fname,$lname,$relationship,$employed,$phone,$alphone,$email,$street,$suburb,$town,$province,$postal,$applicationidStep4,$my_id_step4);
			if($response['response']=="S"){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP4 ({$applicationidStep4}) COMPLETED";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions.The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}

		}
		elseif(isset(
			$_POST['applicationidStep5'],
			$_POST['my_id_step5'],
			$_POST['schoolname'],
			$_POST['street'],
			$_POST['suburb'],
			$_POST['town'],
			$_POST['province'],
			$_POST['postal'],
			$_POST['yearcompleted'],
			$_POST['activity'],
			$_POST['eduhistory'],
			$_POST['uni'],
			$_POST['studentnumber'],
			$_POST['statuscompletion']
		)){
			$applicationidStep5=$pdo->OMO($_POST['applicationidStep5']);
			$my_id_step5=$pdo->OMO($_POST['my_id_step5']);
			$schoolname=$pdo->OMO($_POST['schoolname']);
			$street=$pdo->OMO($_POST['street']);
			$suburb=$pdo->OMO($_POST['suburb']);
			$town=$pdo->OMO($_POST['town']);
			$province=$pdo->OMO($_POST['province']);
			$postal=$pdo->OMO($_POST['postal']);
			$yearcompleted=$pdo->OMO($_POST['yearcompleted']);
			$activity=$pdo->OMO($_POST['activity']);
			$eduhistory=$pdo->OMO($_POST['eduhistory']);
			$uni=$pdo->OMO($_POST['uni']);
			$studentnumber=$pdo->OMO($_POST['studentnumber']);
			$statuscompletion=$pdo->OMO($_POST['statuscompletion']);
			$response=$pdo->hambisaIsgabaSesihlanu($applicationidStep5,$my_id_step5,$schoolname,$street,$suburb,$town,$province,$postal,$yearcompleted,$activity,$eduhistory,$uni,$studentnumber,$statuscompletion);
			if($response['response']=="S"){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP6 ({$applicationidStep5}) COMPLETED";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions.The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}

		}
		elseif(isset($_POST['erroridcopy'])){
			$ext=explode(".",$_FILES['file']['name']);
			$ext=end($ext);
			if(strtolower($ext)!="pdf"){
				$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$applicationId=$pdo->getApplicationId($std_id);
				if($applicationId=="absent"){
					$e="application ID for ".$std_id." does not exist";
				}
				else{
					$dir="../".md5($applicationId)."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$response=$pdo->uploadedUpload("idcopy",false,$new_name_file,$applicationId,$std_id);
						if($response['response']=="S"){
							$subject="TERTIARY APPLICATION WITH NETCHATSA STEP7 {$applicationId} (ID Copy) Submitted";
							$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
							<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
							<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
							$my_id_notification=$cur_user_row['my_id'];
							$from_sender="no-reply@netchatsa.com";
							$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
							$e=1;
						}
						else{
							$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
						}
					}
					else{
						$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
					}
				}
			}
			

			
		}
		elseif(isset($_POST['updateVersionId'],$_POST['NewVersion'])){
		    $updateVersionId = $pdo->OMO($_POST['updateVersionId']);
            $NewVersion = $pdo->OMO($_POST['NewVersion']);
		    $response=$pdo->submitAppVersionUpdate($updateVersionId,$NewVersion);
		    if($response['response']=="S"){
		        $e=1;
		    }
		    else{
		        $e=$response['data'];
		    }
		}
		elseif(isset($_POST['errorfinalresults'])){
			$ext=explode(".",$_FILES['file']['name']);
			$ext=end($ext);
			if(strtolower($ext)!="pdf"){
				$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$applicationId=$pdo->getApplicationId($std_id);
				if($applicationId=="absent"){
					$e="application ID for ".$std_id." does not exist";
				}
				else{
					$dir="../".md5($applicationId)."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$response=$pdo->uploadedUpload("finalresults",false,$new_name_file,$applicationId,$std_id);
						if($response['response']=="S"){
							$subject="TERTIARY APPLICATION WITH NETCHATSA STEP7 {$applicationId} (Final Results Copy) Submitted";
							$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
							<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
							<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
							$my_id_notification=$cur_user_row['my_id'];
							$from_sender="no-reply@netchatsa.com";
							$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
							$e=1;
						}
						else{
							$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
						}
					}
					else{
						$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
					}
				}
			}
			

			
		}
		elseif(isset($_POST['proofresident'])){
			$ext=explode(".",$_FILES['file']['name']);
			$ext=end($ext);
			if(strtolower($ext)!="pdf"){
				$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$applicationId=$pdo->getApplicationId($std_id);
				if($applicationId=="absent"){
					$e="application ID for ".$std_id." does not exist";
				}
				else{
					$dir="../".md5($applicationId)."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$response=$pdo->uploadedUpload("proofresident",false,$new_name_file,$applicationId,$std_id);
						if($response['response']=="S"){
							$subject="TERTIARY APPLICATION WITH NETCHATSA STEP7 {$applicationId} (proofresident) Submitted";
							$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
							<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
							<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
							$my_id_notification=$cur_user_row['my_id'];
							$from_sender="no-reply@netchatsa.com";
							$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
							$e=1;
						}
						else{
							$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
						}
					}
					else{
						$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
					}
				}
			}
			

			
		}
		elseif(isset($_POST['guardianid'])){
			$ext=explode(".",$_FILES['file']['name']);
			$ext=end($ext);
			if(strtolower($ext)!="pdf"){
				$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$applicationId=$pdo->getApplicationId($std_id);
				if($applicationId=="absent"){
					$e="application ID for ".$std_id." does not exist";
				}
				else{
					$dir="../".md5($applicationId)."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$response=$pdo->uploadedUpload("guardianid",true,$new_name_file,$applicationId,$std_id);
						if($response['response']=="S"){
							$subject="TERTIARY APPLICATION WITH NETCHATSA STEP7 ({$applicationId}) (guardianid) Submitted";
							$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
							<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
							<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
							$my_id_notification=$cur_user_row['my_id'];
							$from_sender="no-reply@netchatsa.com";
							$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
							$e=1;
						}
						else{
							$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
						}
					}
					else{
						$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
					}
				}
			}
		}
		elseif(isset($_POST['uni_id'],
			$_POST['uni_name'],
			$_POST['faculty_id'],
			$_POST['faculty_name'],
			$_POST['course_id'],
			$_POST['course_name'],
			$_POST['mode_of_attendance'],
			$_POST['year_of_study'],
			$_POST['campus_id'])){

			$uni_id=$pdo->OMO($_POST['uni_id']);
			$uni_name=$pdo->OMO($_POST['uni_name']);
			$faculty_id=$pdo->OMO($_POST['faculty_id']);
			$faculty_name=$pdo->OMO($_POST['faculty_name']);
			$course_id=$pdo->OMO($_POST['course_id']);
			$course_name=$pdo->OMO($_POST['course_name']);
			$mode_of_attendance=$pdo->OMO($_POST['mode_of_attendance']);
			$year_of_study=$pdo->OMO($_POST['year_of_study']);
			$campus_id=$pdo->OMO($_POST['campus_id']);
			$response=$pdo->hambisaIsgabaSesithupha($uni_id,$uni_name,$faculty_id,$faculty_name,$course_id,$course_name,$mode_of_attendance,$year_of_study,$campus_id,$cur_user_row['my_id'],false);
			//print_r($response);
			if($response['response']=="S"){
				if(count($response)==3){
					$subject="TERTIARY APPLICATION WITH NETCHATSA STEP8 ({$uni_id}) (guardianid) Submitted";
					$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
					<p>

					</p>
					<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
					<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
					$my_id_notification=$cur_user_row['my_id'];
					$from_sender="no-reply@netchatsa.com";
					$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
					$e=1;
				}
				else{
					$e=22;
				}
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}

		}
		elseif(isset($_POST['course_id'],$_POST['uni_id'],$_POST['faculty_id'],$_POST['faculty_name'],$_POST['uni_name'],$_POST['campus_id'],$_POST['mode_of_attendance'],$_POST['year_of_study'])){
			$tr=explode("-",$_POST['course_id']);
			// print_r($tr);
			$uni_id=$pdo->OMO($_POST['uni_id']);
			$uni_name=$pdo->OMO($_POST['uni_name']);
			$faculty_id=$pdo->OMO($_POST['faculty_id']);
			$faculty_name=$pdo->OMO($_POST['faculty_name']);
			$course_id=$pdo->OMO($tr[0]);
			$course_name=$pdo->OMO($tr[1]);
			$mode_of_attendance=$pdo->OMO($_POST['mode_of_attendance']);
			$year_of_study=$pdo->OMO($_POST['year_of_study']);
			$campus_id=$pdo->OMO($_POST['campus_id']);
			$response=$pdo->hambisaIsgabaSesithupha($uni_id,$uni_name,$faculty_id,$faculty_name,$course_id,$course_name,$mode_of_attendance,$year_of_study,$campus_id,$cur_user_row['my_id'],true);
			//print_r($response);
			if($response['response']=="S"){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP6 ({$uni_id}) (guardianid) Submitted";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>

				</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p> ";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}
		elseif(isset($_POST['studyAreaMathTitleCode'],$_POST['studyAreaMathCode'])){
			$studyAreaMathTitleCode=$pdo->OMO($_POST['studyAreaMathTitleCode']);
			$studyAreaMathCode=$pdo->OMO($_POST['studyAreaMathCode']);
			$response=$pdo->hambisaUmbuzoWeCode($studyAreaMathTitleCode,$studyAreaMathCode,$cur_user_row['my_id']);
			//print_r($response);
			if($response['response']=="S"){
				$subject="New Code Posted with title ({$studyAreaMathTitleCode})";
				$message="New Code Question Posted Successfully";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}
		elseif(isset($_POST['accept'],$_POST['applicationidStep8'],$_POST['my_id_step8'])){
			$accept=$pdo->OMO($_POST['accept']);
			$applicationidStep8=$pdo->OMO($_POST['applicationidStep8']);
			$my_id_step8=$pdo->OMO($_POST['my_id_step8']);
			$response=$pdo->hambisaIsgabaConditionsAccept($accept,$applicationidStep8,$my_id_step8);
			if($response['response']=="S"){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP8 ({$applicationidStep8})";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}//7311235634080 3332 3523

		elseif(isset($_POST['post_id_views'])){
			// $likeId=$pdo->run_topic();
			$post_id=$pdo->OMO($_POST['post_id_views']);
			$response=$pdo->addViewCounts($post_id,$cur_user_row['my_id']);
			if($response['response']=="S"){
				$posterInfo=$pdo->userInfoUNINGmyID($pdo->getPosterUserMy_id($post_id));
				$subject="YOUR POST IS GETTING NOTICED (".$response['data'].") views";
				$message="<p>Your is getting noticed, viewed by {$posterInfo['name']} {$posterInfo['surname']} and etc</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$posterInfo['my_id'],$from_sender,$posterInfo);
				$e=$response['data'];
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}
		elseif(isset($_POST['post_id_like'])){
			// $likeId=$pdo->run_topic();
			$post_id=$pdo->OMO($_POST['post_id_like']);
			$response=$pdo->addLikeCounts($post_id,$cur_user_row['my_id']);
			if($response['response']=="S"){
				$posterInfo=$pdo->userInfoUNINGmyID($pdo->getPosterUserMy_id($post_id));
				$subject="YOUR POST IS GETTING NOTICED (".$response['data'].") likes";
				$message="<p>Your is getting noticed, liked by {$posterInfo['name']} {$posterInfo['surname']} and etc</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$posterInfo['my_id'],$from_sender,$posterInfo);
				$e=$response['data'];
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}
		elseif(isset($_POST['post_id_dislike'])){
			// $dislikeId=$pdo->run_topic();
			$post_id=$pdo->OMO($_POST['post_id_dislike']);
			$response=$pdo->addDislikeCounts($post_id,$cur_user_row['my_id']);
			if($response['response']=="S"){		
				$e=$response['data'];
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}


		///////////////////////////
		
		elseif(isset($_POST['studyAreaMathText'],$_POST['studyAreaMathTitle'])){
			$file="empty";
			$mp4=0;
			$img=0;
			$tracker=true;
			if(isset($_FILES['file'])){
				$file=$_FILES['file']['name'];
				if($_FILES['file']['size']>41943040){
					$e="file too big!!";
					$tracker=false;
				}
				else{
					$ext=explode(".",$_FILES['file']['name']);
					$ext=end($ext);
					$arr=array("jpg","png","jpeng","jpeg","heic","mp4","mv");
					if(!in_array(strtolower($ext),$arr)){
						$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
						$tracker=false;
					}
					else{
						if(in_array(strtolower($ext),array("jpg","png","jpeng","jpeg","heic"))){
							$img=1;
						}
						else{
							$mp4=1;
						}
						$new_name_file=rand(000000,999999)."_netChat.".$ext;
						$dir="../../../posts/netchatsaSudyArea/".$cur_user_row['my_id']."/";
						if(!is_dir($dir)){
							mkdir($dir,0777,true);
						}
						// $profile_id=$pdo->run_topic();
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
							$file=$new_name_file;
						}
						else{
							
							$e="Failed to upload file to Dir, Please try again later.";
							$tracker=false;

						}
					}
				}
			}
			if($tracker){
				$text=$pdo->OMO($_POST['studyAreaMathText']);
				$title=$pdo->OMO($_POST['studyAreaMathTitle']);
				if($img==1){
					$img=$file;
				}
				elseif($mp4==1){
					$mp4=$file;
				}
				// $post_id=$pdo->run_topic();
				$iscode=0;
				$response=$pdo->hambisaNoneCodeAsifunde($iscode,$title,$text,$img,$mp4,$cur_user_row['my_id']);
				if($response['response']=="S"){
					$subject="New Question Posted with title ({$title})";
					$message="New Question Posted Successfully";
					$my_id_notification=$cur_user_row['my_id'];
					$from_sender="no-reply@netchatsa.com";
					$pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
					$e=1;
				}
				else{
					$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
				}
			}
		}
		elseif(isset($_POST['nameMatricUpgrade']) and isset($_POST['surnameMatricUpgrade']) and isset($_POST['idNumMatricUpgrade']) and isset($_POST['phoneMatricUpgrade']) and isset($_POST['emailMatricUpgrade']) and isset($_POST['subj1MatricUpgrade']) and isset($_POST['subj2MatricUpgrade']) and isset($_POST['subj3MatricUpgrade']) and isset($_POST['subj4MatricUpgrade']) and isset($_POST['subj5MatricUpgrade']) and isset($_POST['subj6MatricUpgrade']) and isset($_POST['subj7MatricUpgrade']) and isset($_POST['subj8MatricUpgrade']) and isset($_POST['subj9MatricUpgrade']) and isset($_POST['subj10MatricUpgrade'])){
			$nameMatricUpgrade=$pdo->OMO($_POST['nameMatricUpgrade']);
			$surnameMatricUpgrade=$pdo->OMO($_POST['surnameMatricUpgrade']);
			$idNumMatricUpgrade=$pdo->OMO($_POST['idNumMatricUpgrade']);
			$phoneMatricUpgrade=$pdo->OMO($_POST['phoneMatricUpgrade']);
			$emailMatricUpgrade=$pdo->OMO($_POST['emailMatricUpgrade']);
			$subj1MatricUpgrade=$pdo->OMO($_POST['subj1MatricUpgrade']);
			$subj2MatricUpgrade=$pdo->OMO($_POST['subj2MatricUpgrade']);
			$subj3MatricUpgrade=$pdo->OMO($_POST['subj3MatricUpgrade']);
			$subj4MatricUpgrade=$pdo->OMO($_POST['subj4MatricUpgrade']);
			$subj5MatricUpgrade=$pdo->OMO($_POST['subj5MatricUpgrade']);
			$subj6MatricUpgrade=$pdo->OMO($_POST['subj6MatricUpgrade']);
			$subj7MatricUpgrade=$pdo->OMO($_POST['subj7MatricUpgrade']);
			$subj8MatricUpgrade=$pdo->OMO($_POST['subj8MatricUpgrade']);
			$subj9MatricUpgrade=$pdo->OMO($_POST['subj9MatricUpgrade']);
			$subj10MatricUpgrade=$pdo->OMO($_POST['subj10MatricUpgrade']);
			$SchoolsSA=$pdo->OMO($_POST['SchoolsSA']);
			$my_id=$cur_user_row['my_id'];
			$response=$pdo->yenzaUmatikuletshenaWabaphindayo($my_id,$nameMatricUpgrade,$surnameMatricUpgrade,$idNumMatricUpgrade,$phoneMatricUpgrade,$emailMatricUpgrade,$subj1MatricUpgrade,$subj2MatricUpgrade,$subj3MatricUpgrade,$subj4MatricUpgrade,$subj5MatricUpgrade,$subj6MatricUpgrade,$subj7MatricUpgrade,$subj8MatricUpgrade,$subj9MatricUpgrade,$subj10MatricUpgrade,$SchoolsSA);
			if($response['response']=="S"){
				
				$subject="MATRIC UPGRADE CLASSES REGISTERED SUCCESSFULLY";
				$message="<p>Congrats {$nameMatricUpgrade} {$surnameMatricUpgrade} you have Successfully created a matric upgrade class sessions.</p>
				<p>
				The fact that you are studying on this app, it does not necessary mean that you will automatically pass your matric re-write. however it all depend on how dedicated you are and how you use the content on the app. It is time for you to study even harder than before. the app is openm 24/7 and 7 days a week. you can study anywhere, anytime,at your own pace, using any device.
				</p>
				<p>
				Disclamer<br>
				Some content on the app may not be own by the company(netchatsa/mms high tech), however it may be sourced from difference sources like youtube, and other credited sourrces. The monthly fee payable to the app is not for the content on the app. The content on the app is free. The payable fee on the app is only an admin fee which is far not even related from content selling. 
				</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e="Report this Error(068 515 3023)- Internal Error 903: ".json_encode($response['data']);
			}
		}
		elseif(isset($_POST['subjModelAddSunject'])){
			$subjModelAddSunject=$pdo->OMO($_POST['subjModelAddSunject']);
		    $my_id=$cur_user_row['my_id'];
		    $getAllInfoOfMatricReWriteLearner=$pdo->getAllInfoOfMatricReWriteLearner($my_id);
		    $subjArr=array("subj1matricupgrade"=>"subj1matricupgrade",
		                    "subj2matricupgrade"=>"subj2matricupgrade",
		                    "subj3matricupgrade"=>"subj3matricupgrade",
	                        "subj4matricupgrade"=>"subj4matricupgrade",
	                        "subj5matricupgrade"=>"subj5matricupgrade",
	                        "subj6matricupgrade"=>"subj6matricupgrade",
	                        "subj7matricupgrade"=>"subj7matricupgrade",
	                        "subj8matricupgrade"=>"subj8matricupgrade",
	                        "subj9matricupgrade"=>"subj9matricupgrade",
	                        "subj10matricupgrade"=>"subj10matricupgrade"
		        
		        );
	        $e="";
	        $flag=false;//memory is full could not be inserted to db
	        $status=array();
	        foreach($subjArr as $position){
	            $subj=$getAllInfoOfMatricReWriteLearner[$position];
	            if(empty($subj)){
	                $response=$pdo->ngezelaEsinyeIsifundo($position,$subjModelAddSunject,$getAllInfoOfMatricReWriteLearner['id']);
	                if($response['response']=="S"){
	                    $flag=true;
	                    $status=array("success"=>"s");
	                    break;
	                }
	                else{
	                    $flag=true;
	                    $status=array("error"=>$response['data']);
	                    break;
	                }
	            }
	        }
	        if($flag){
	            if(empty($status)){
	                $e="Status Error, Internal Error. Please Contact support @ 0685153023 WhatsApp";
	            }
	            else{
	                if(isset($status['success'])){
	                	$subject="Subject (".$subj.") Has Been Added Successfully";
						$message="<p>Congrats you have Successfully added new subject (".$subj.").</p>
						<p>
						The fact that you are studying on this app, it does not necessary mean that you will automatically pass your matric re-write. however it all depend on how dedicated you are and how you use the content on the app. It is time for you to study even harder than before. the app is openm 24/7 and 7 days a week. you can study anywhere, anytime,at your own pace, using any device.
						</p>
						<p>
						Disclamer<br>
						Some content on the app may not be own by the company(netchatsa/mms high tech), however it may be sourced from difference sources like youtube, and other credited sourrces. The monthly fee payable to the app is not for the content on the app. The content on the app is free. The payable fee on the app is only an admin fee which is far not even related from content selling. 
						</p>";
						$my_id_notification=$cur_user_row['my_id'];
						$from_sender="no-reply@netchatsa.com";
						$pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
	                    $e=1;
	                }
	                else{
	                    $e="Error 3323: {Please report this error to Support @ 0685153023 WhatsApp}".$status['error'];
	                }
	            }
	            
	        }
	        else{
	            $e="Sorry, You Cannot take more than 10 classes!!..";
	        }
				
		}
		elseif (isset($_POST['my_id_new_set'],$_POST['status_new_set'],$_POST['studentNameconst'],$_POST['studentSurname'],$_POST['studentSchoolAttecnding'],$_POST['studentCurrentGrade'],$_POST['amount'])) {
			$my_id_new_set=$pdo->OMO($_POST['my_id_new_set']);
			$status_new_set=$pdo->OMO($_POST['status_new_set']);
			$studentNameconst=$pdo->OMO($_POST['studentNameconst']);
			$studentSurname=$pdo->OMO($_POST['studentSurname']);
			$studentSchoolAttecnding=$pdo->OMO($_POST['studentSchoolAttecnding']);
			$studentCurrentGrade=$pdo->OMO($_POST['studentCurrentGrade']);
			$amount=$pdo->OMO($_POST['amount']);
			$response=$pdo->setSelfLearningClass($my_id_new_set,$status_new_set,$studentNameconst,$studentSurname,$studentSchoolAttecnding,$studentCurrentGrade,$amount);
			if($response['response']=="S"){
				$subject="Congrats!!, you have Successfully created High School Self learning session";
						$message="<p>Congrats {$studentNameconst} {$studentSurname} you have Successfully created High School Self learning sessions.</p>
						<p>
						The fact that you are studying on this app, it does not necessary mean that you will automatically pass your matric re-write. however it all depend on how dedicated you are and how you use the content on the app. It is time for you to study even harder than before. the app is openm 24/7 and 7 days a week. you can study anywhere, anytime,at your own pace, using any device.
						</p>
						<p>
						Disclamer<br>
						Some content on the app may not be own by the company(netchatsa/mms high tech), however it may be sourced from difference sources like youtube, and other credited sourrces. The monthly fee payable to the app is not for the content on the app. The content on the app is free. The payable fee on the app is only an admin fee which is far not even related from content selling. 
						</p>";
						$my_id_notification=$cur_user_row['my_id'];
						$from_sender="no-reply@netchatsa.com";
						$pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e=$response['data'];
			}
		}
		elseif (isset($_POST['changegrade'])) {
			$changegrade=$pdo->OMO($_POST['changegrade']);
			$response=$pdo->changegrade($changegrade,$cur_user_row['my_id']);
			if($response['response']=="S"){
				$subject="CLASS LEVEL SUCCESSFULLY UPDATED!!";
				$message="<p>You have updated Grade level to {$changegrade}</p>
				<p>
				The fact that you are studying on this app, it does not necessary mean that you will automatically pass your grade leve. however it all depend on how dedicated you are and how you use the content on the app. It is time for you to study even harder than before. the app is openm 24/7 and 7 days a week. you can study anywhere, anytime,at your own pace, using any device.
				</p>
				<p>
				Disclamer<br>
				Some content on the app may not be own by the company(netchatsa/mms high tech), however it may be sourced from difference sources like youtube, and other credited sourrces. The monthly fee payable to the app is not for the content on the app. The content on the app is free. The payable fee on the app is only an admin fee which is far not even related from content selling. 
				</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e=$response['data'];
			}

		}
		elseif(isset($_POST['updateLevelVAVA'])){
			$updateLevelVAVA=$pdo->OMO($_POST['updateLevelVAVA']);
			$response=$pdo->updateLevelVAVA($updateLevelVAVA,$cur_user_row['my_id'],"tertiary");
			if($response['response']=="S"){
				$subject="STUDY LEVEL SUCCESSFULLY UPDATED!!";
				$message="<p>You have updated STUDY level to {$updateLevelVAVA}</p>
				<p>
				The fact that you are studying on this app, it does not necessary mean that you will automatically pass your study leve. however it all depend on how dedicated you are and how you use the content on the app. It is time for you to study even harder than before. the app is openm 24/7 and 7 days a week. you can study anywhere, anytime,at your own pace, using any device.
				</p>
				<p>
				Disclamer<br>
				Some content on the app may not be own by the company(netchatsa/mms high tech), however it may be sourced from difference sources like youtube, and other credited sourrces. The monthly fee payable to the app is not for the content on the app. The content on the app is free. The payable fee on the app is only an admin fee which is far not even related from content selling. 
				</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e=$response['data'];
			}
		}
		elseif(isset($_POST['select_module_2_reg'],$_POST['level_module'])){
			$select_module_2_reg=$pdo->OMO($_POST['select_module_2_reg']);
			$level_module=$pdo->OMO($_POST['level_module']);
			$response=$pdo->fakaIsifundoEsishaSasenyuvesi($select_module_2_reg,$level_module,$cur_user_row['my_id']);
			if($response['response']=="S"){
				$subject="MODULE({$select_module_2_reg}) SUCCESSFULLY ADDED!!";
				$message="<p>You have successfully added module {$level_module}yr {$select_module_2_reg}</p>
				<p>
				The fact that you are studying on this app, it does not necessary mean that you will automatically pass your study leve. however it all depend on how dedicated you are and how you use the content on the app. It is time for you to study even harder than before. the app is openm 24/7 and 7 days a week. you can study anywhere, anytime,at your own pace, using any device.
				</p>
				<p>
				Disclamer<br>
				Some content on the app may not be own by the company(netchatsa/mms high tech), however it may be sourced from difference sources like youtube, and other credited sourrces. The monthly fee payable to the app is not for the content on the app. The content on the app is free. The payable fee on the app is only an admin fee which is far not even related from content selling. 
				</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e=$response['data'];
			}
		}
		elseif(isset($_POST['code'],$_POST['p_id'])){
			$text=$pdo->OMO($_POST['code']);
			$post_id=$pdo->OMO($_POST['p_id']);
			// $reply_id=run_topic();
			$iscode=1;
			$mp4=0;
			$img=0;
			$response=$pdo->fakaImpenduloKa_AsifundeSonke($iscode,$post_id,$text,$img,$mp4,$cur_user_row['my_id']);
			if($response['response']=="S"){
				$posterInfo=$pdo->userInfoUNINGmyID($pdo->getPosterUserMy_id($post_id));
				$subject="YOUR POST HAS A REPLY";
				$message="<p>{$cur_user_row['name']} {$cur_user_row['surname']} has replied to your post.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$pdo->fakaKuNotification($subject,$message,$posterInfo['my_id'],$from_sender,$posterInfo);
				$e=1;
			}
			else{
				$e=$response['data'];
			}
		}
		elseif(isset($_POST['flaggeeUser'])){
	        $poster=$pdo->OMO($_POST['flaggeeUser']);
	        $response=$pdo->fakaKuFlagged($cur_user_row['my_id'],$poster);
	        if($response['response']=="S"){
				$aa=$posterInfo=$pdo->userInfoUNINGmyID($poster);
                $emailFrom="No-Reply@netchatsa.com";
                $subject="reporting of Account User {$aa['name']} {$aa['name']}";
                $message="<h3 style='color:green;'>Account User {$aa['name']} {$aa['name']} have been successfully Reported.</h3>
                <p>You will now be able to see content by {$aa['name']} {$aa['name']}, You can unFlag the user at any time.</p>
                
                <br><br>";
                $from_sender="no-Reply@netchatsa.com";
                $pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
		
				$e=1;
			}
			else{
				$e=$response['data'];
			}
	        
	    }
	    elseif(isset($_POST['track_id_like'])){
	        $track_id_like=$pdo->OMO($_POST['track_id_like']);
	        $response=$pdo->track_id_likeSendFunction($track_id_like,$cur_user_row['my_id']);
	        if($response['response']=="S"){
	            $e=$pdo->trackLikes($track_id_like);
	        }
	        else{
	            $e=$response['data'];
	        }
	    }
        elseif(isset($_POST['track_download'])){
            $track_download=$pdo->OMO($_POST['track_download']);
            $response=$pdo->track_downloadSendFunction($track_download);
            if($response['response']=="S"){
                $e=$response['data'];
            }
            else{
                $e=$response['data'];
            }
        }
	    elseif(isset($_POST['blockeeUser'])){
	        $poster=$pdo->OMO($_POST['blockeeUser']);
	        $response=$pdo->fakaKuBlockedUsers($cur_user_row['my_id'],$poster);
	        if($response['response']=="S"){
				$aa=$posterInfo=$pdo->userInfoUNINGmyID($poster);
                $emailFrom="No-Reply@netchatsa.com";
                $subject="{$aa['name']} {$aa['name']} has been blocked!!.";
                $message="<h3 style='color:green;'>Account User {$aa['name']} {$aa['name']} have been successfully blocked.</h3>
                <p>You will now be able to see content by {$aa['name']} {$aa['name']}, You can unblock the user at any time.</p>
                
                <br><br>";
                $from_sender="no-Reply@netchatsa.com";
                $pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				$e=1;
			}
			else{
				$e=$response['data'];
			}
	    }
		elseif(isset($_POST['p_id_img'],$_POST['studyAreaMathTextReply'])){
			$file="empty";
			$mp4=0;
			$img=0;
			$tracker=true;
			$id=$cur_user_row['my_id'];
			if(isset($_FILES['file'])){
				$file=$_FILES['file']['name'];
				if($_FILES['file']['size']>41943040){
					$e="file too big!!";
					$tracker=false;
				}
				else{
					$ext=explode(".",$_FILES['file']['name']);
					$ext=end($ext);
					$arr=array("jpg","png","jpeng","jpeg","heic","mp4","mv");
					if(!in_array(strtolower($ext),$arr)){
						$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
						$tracker=false;
					}
					else{
						if(in_array(strtolower($ext),array("jpg","png","jpeng","jpeg","heic"))){
							$img=1;
						}
						else{
							$mp4=1;
						}
						$new_name_file=rand(000000,999999)."_netChat.".$ext;
						$dir="../../../posts/netchatsaSudyArea/".$id."/";
						if(!is_dir($dir)){
							mkdir($dir,0777,true);
						}
						// $profile_id=run_topic();
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
							$file=$new_name_file;
						}
						else{
							
							$e="Failed to upload file to Dir, Please try again later.";
							$tracker=false;

						}
					}
				}
			}
			if($tracker){
				$text=$pdo->OMO($_POST['studyAreaMathTextReply']);
				$post_id=$pdo->OMO($_POST['p_id_img']);
				if($img==1){
					$img=$file;
				}
				elseif($mp4==1){
					$mp4=$file;
				}
				// $reply_id=run_topic();
				$iscode=0;
				$response=$pdo->fakaImpenduloKa_AsifundeSonke($iscode,$post_id,$text,$img,$mp4,$cur_user_row['my_id']);
				if($response['response']=="S"){
					// print_r($pdo->getPosterUserMy_id($post_id));
					$posterInfo=$pdo->userInfoUNINGmyID($pdo->getPosterUserMy_id($post_id));
					// print_r($posterInfo);
					$subject="YOUR POST HAS A REPLY";
					$message="<p>{$cur_user_row['name']} {$cur_user_row['surname']} has replied to your post.</p>";
					$my_id_notification=$cur_user_row['my_id'];
					$from_sender="no-reply@netchatsa.com";
					$pdo->fakaKuNotification($subject,$message,$posterInfo['my_id'],$from_sender,$posterInfo);
					$e=1;
				}
				else{
					$e=$response['data'];
				}
			}
		}
		elseif(isset($_FILES['imageProfileTag'])){
			$ext=explode(".",$_FILES['imageProfileTag']['name']);
			$ext=end($ext);
			$e=$_FILES['imageProfileTag']['name'];
			$id=$cur_user_row['my_id'];
			$arr=array("jpg","png","jpeng","jpeg","heic","JPG","PNG","JPENG","JPEG","HEIC");
			if(!in_array(strtolower($ext),$arr)){
				$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$dir="../../../img/userProfileImages/".$id."/";
				if(!is_dir($dir)){
					mkdir($dir,0777,true);
				}
				// $profile_id=run_topic();
				if(move_uploaded_file($_FILES['imageProfileTag']['tmp_name'], $dir.basename($new_name_file))){
					$response=$pdo->fakaIsithombeEsishaKwiProfilePicture($new_name_file,$cur_user_row['my_id']);
					if($response['response']=="S"){
				// 		$posterInfo=$pdo->userInfoUNINGmyID($pdo->getPosterUserMy_id($post_id));
						$subject="Profile Picture Has Been Updated";
						$message="<p>You have successully updated your profile picture</p>";
						$my_id_notification=$cur_user_row['my_id'];
						$from_sender="no-reply@netchatsa.com";
						$pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
						$e=1;
					}
					else{
						$e=$response['data'];
					}
				}
				else{
					$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
				}
			}
		}
		elseif(isset($_POST['unFlagUser'],$_POST['unflaggeeUser'])){
        $unFlagUser=$_POST['unFlagUser'];
        $flaggeeUser=$_POST['unflaggeeUser'];
        $aa=$posterInfo=$pdo->userInfoUNINGmyID($flaggeeUser);
        $response=$pdo->unFlagUser($unFlagUser);
        if($response['response']=="S"){
            $emailFrom="No-Reply@netchatsa.com";
            $subject="reporting of Account User {$aa['name']} {$aa['name']} have been successfully eliminated";
            $message="<h3 style='color:green;'>Account User {$aa['name']} {$aa['name']} have been successfully unReported.</h3>
            <p>You will now be able to see content by {$aa['name']} {$aa['name']}, You can block the user at any time.</p>
            
            <br><br>";
            $from_sender="no-Reply@netchatsa.com";
            $pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
            $e=1;
            
        }
        else{
            $e="Error: Could not Process unflagging user due to :".$conn->error;
        }
	}
    elseif(isset($_POST['unblockThisUser'],$_POST['unblockeeId'])){
        $unblockThisUser=$_POST['unblockThisUser'];
        $aa=$posterInfo=$pdo->userInfoUNINGmyID($_POST['unblockeeId']);
        // print_r($aa);
        $response=$pdo->unBlocUser($unblockThisUser);
       	if($response['response']=="S"){
            $emailFrom="No-Reply@netchatsa.com";
            $subject="Account User {$aa['name']} {$aa['name']} have been successfully unBlocked! ";
            $message="<h3 style='color:green;'>Account User {$aa['name']} {$aa['name']} have been successfully unBlocked.</h3>
            <p>You will now be able to see content by {$aa['name']} {$aa['name']}, You can block the user at any time.</p>
            
            <br><br>";
            $from_sender="no-Reply@netchatsa.com";
            $pdo->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
            $e=1;
        }
        else{
            $e="Error: Could not Process unBlocking user due to :".$conn->error;
        }
    }
		echo json_encode($e);
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
		window.location=("../../");
	</script>

	<?php
}
?>