<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
use App\Providers\Response\Response;

if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	$e=new Response();
	$e->responseStatus=StatusConstants::FAILED_STATUS;
	$e->responseMessage="YOU'RE NOT PERMITTED TO BE ON THIS PAGE";
	try{
		$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
		$cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$studyArea = PDOServiceFactory::make(ServiceConstants::STUDY_AREA_PDO,[$userPdo->connect]);
		$notification = PDOServiceFactory::make(ServiceConstants::NOTIFICATION_PDO,[$userPdo->connect]);
		$tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
		$matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$userPdo->connect]);
		$sgelaPdo = PDOServiceFactory::make(ServiceConstants::SGELA_UNI_PDO,[$userPdo->connect]);
		$musicPdo = PDOServiceFactory::make(ServiceConstants::MUSIC_PDO,[$userPdo->connect]);
		$bursaryApplicationJobService = PDOAdminFactory::make(ServiceConstants::BURSARY_APPLICATION_JOB_SERVICE,[$userPdo->connect]);
		$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
		$std_id = $cur_user_row['my_id']??'';
		if(isset(
			$_POST['grdlevel'],$_POST['subjects1'],$_POST['levelMark1'],$_POST['levelMark11'],$_POST['subjects2'],
			$_POST['levelMark2'],$_POST['levelMark22'],$_POST['subjects3'],$_POST['levelMark3'],$_POST['levelMark33'],
			$_POST['subjects4'],$_POST['levelMark4'],$_POST['levelMark44'],$_POST['subjects5'],$_POST['levelMark5'],
			$_POST['levelMark55'],$_POST['subjects6'],$_POST['levelMark6'],$_POST['levelMark66'],$_POST['subjects7'],
			$_POST['levelMark7'],$_POST['levelMark77'],$_POST['subjects8'],$_POST['levelMark8'],$_POST['levelMark88'],
			$_POST['subjects9'],$_POST['levelMark9'],$_POST['levelMark99'],$_POST['subjects10'],
			$_POST['levelMark10'],$_POST['levelMark1010'],$_POST['total'],$_POST['subj']))
		{
			$grdlevel=$cleanData->OMO($_POST['grdlevel']);
			$subjects1=$cleanData->OMO($_POST['subjects1']);
			$levelMark1=$cleanData->OMO($_POST['levelMark1']);
			$levelMark11=$cleanData->OMO($_POST['levelMark11']);
			$subjects2=$cleanData->OMO($_POST['subjects2']);
			$levelMark2=$cleanData->OMO($_POST['levelMark2']);
			$levelMark22=$cleanData->OMO($_POST['levelMark22']);
			$subjects3=$cleanData->OMO($_POST['subjects3']);
			$levelMark3=$cleanData->OMO($_POST['levelMark3']);
			$levelMark33=$cleanData->OMO($_POST['levelMark33']);
			$subjects4=$cleanData->OMO($_POST['subjects4']);
			$levelMark4=$cleanData->OMO($_POST['levelMark4']);
			$levelMark44=$cleanData->OMO($_POST['levelMark44']);
			$subjects5=$cleanData->OMO($_POST['subjects5']);
			$levelMark5=$cleanData->OMO($_POST['levelMark5']);
			$levelMark55=$cleanData->OMO($_POST['levelMark55']);
			$subjects6=$cleanData->OMO($_POST['subjects6']);
			$levelMark6=$cleanData->OMO($_POST['levelMark6']);
			$levelMark66=$cleanData->OMO($_POST['levelMark66']);
			$subjects7=$cleanData->OMO($_POST['subjects7']);
			$levelMark7=$cleanData->OMO($_POST['levelMark7']);
			$levelMark77=$cleanData->OMO($_POST['levelMark77']);
			$subjects8=$cleanData->OMO($_POST['subjects8']);
			$levelMark8=$cleanData->OMO($_POST['levelMark8']);
			$levelMark88=$cleanData->OMO($_POST['levelMark88']);
			$subjects9=$cleanData->OMO($_POST['subjects9']);
			$levelMark9=$cleanData->OMO($_POST['levelMark9']);
			$levelMark99=$cleanData->OMO($_POST['levelMark99']);
			$subjects10=$cleanData->OMO($_POST['subjects10']);
			$levelMark10=$cleanData->OMO($_POST['levelMark10']);
			$levelMark1010=$cleanData->OMO($_POST['levelMark1010']);
			$total=$cleanData->OMO($_POST['total']);
			$subj=$cleanData->OMO($_POST['subj']);
			$e=$tertiaryApplications->hambisaKwisgabaSokuQala($grdlevel,$subjects1,$levelMark1,$levelMark11,$subjects2,$levelMark2,$levelMark22,$subjects3,$levelMark3,$levelMark33,$subjects4,$levelMark4,$levelMark44,$subjects5,$levelMark5,$levelMark55,$subjects6,$levelMark6,$levelMark66,$subjects7,$levelMark7,$levelMark77,$subjects8,$levelMark8,$levelMark88,$subjects9,$levelMark9,$levelMark99,$subjects10,$levelMark10,$levelMark1010,$total,$subj,$cur_user_row);
			//print_r($response);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP1 COMPLETED";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				
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
			$gender=$cleanData->OMO($_POST['gender']);
			$dob=$cleanData->OMO($_POST['dob']);
			$title=$cleanData->OMO($_POST['title']);
			$initials=$cleanData->OMO($_POST['initials']);
			$lname=$cleanData->OMO($_POST['lname']);
			$fname=$cleanData->OMO($_POST['fname']);
			$status=$cleanData->OMO($_POST['status']);
			$hlang=$cleanData->OMO($_POST['hlang']);
			$ethnicGroup=$cleanData->OMO($_POST['ethnicGroup']);
			$employed=$cleanData->OMO($_POST['employed']);
			$hear=$cleanData->OMO($_POST['hear']);
			$bursary=$cleanData->OMO($_POST['bursary']);
			$id_num=$cleanData->OMO($_POST['id_num']);
			$nationality=$cleanData->OMO($_POST['nationality']);
			$app_idStep2=$cleanData->OMO($_POST['app_idStep2']);
			$e=$tertiaryApplications->hambisaIsgabaSesibili($gender,$dob,$title,$initials,$lname,$fname,$status,$hlang,$ethnicGroup,$employed,$hear,$bursary,$id_num,$nationality,$app_idStep2,$_POST['my_id']);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
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
				$e->extraData =$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				
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

			$street=$cleanData->OMO($_POST['street']);
			$suburb=$cleanData->OMO($_POST['suburb']);
			$town=$cleanData->OMO($_POST['town']);
			$province=$cleanData->OMO($_POST['province']);
			$postal=$cleanData->OMO($_POST['postal']);
			$phone=$cleanData->OMO($_POST['phone']);
			$telephone=$cleanData->OMO($_POST['telephone']);
			$email=$cleanData->OMO($_POST['email']);
			$res=$cleanData->OMO($_POST['res']);
			$dis=$cleanData->OMO($_POST['dis']);
			$studedentApplicationId=$cleanData->OMO($_POST['studedentApplicationId']);
			$my_id_step3=$cleanData->OMO($_POST['my_id_step3']);
			$e =$tertiaryApplications->hambisaKwisigabaSesibili($street,$suburb,$town,$province,$postal,$phone,$telephone,$email,$res,$dis,$studedentApplicationId,$my_id_step3);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP3 ({$studedentApplicationId}) COMPLETED";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions.The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				
				
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
			$fname=$cleanData->OMO($_POST['fname']);
			$lname=$cleanData->OMO($_POST['lname']);
			$relationship=$cleanData->OMO($_POST['relationship']);
			$employed=$cleanData->OMO($_POST['employed']);
			$phone=$cleanData->OMO($_POST['phone']);
			$alphone=$cleanData->OMO($_POST['alphone']);
			$email=$cleanData->OMO($_POST['email']);
			$street=$cleanData->OMO($_POST['street']);
			$suburb=$cleanData->OMO($_POST['suburb']);
			$town=$cleanData->OMO($_POST['town']);
			$province=$cleanData->OMO($_POST['province']);
			$postal=$cleanData->OMO($_POST['postal']);
			$applicationidStep4=$cleanData->OMO($_POST['applicationidStep4']);
			$my_id_step4=$cleanData->OMO($_POST['my_id_step4']);
			$e=$tertiaryApplications->hambisaIsgabaSesine($fname,$lname,$relationship,$employed,$phone,$alphone,$email,$street,$suburb,$town,$province,$postal,$applicationidStep4,$my_id_step4);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP4 ({$applicationidStep4}) COMPLETED";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions.The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				
				
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
			$applicationidStep5=$cleanData->OMO($_POST['applicationidStep5']);
			$my_id_step5=$cleanData->OMO($_POST['my_id_step5']);
			$schoolname=$cleanData->OMO($_POST['schoolname']);
			$street=$cleanData->OMO($_POST['street']);
			$suburb=$cleanData->OMO($_POST['suburb']);
			$town=$cleanData->OMO($_POST['town']);
			$province=$cleanData->OMO($_POST['province']);
			$postal=$cleanData->OMO($_POST['postal']);
			$yearcompleted=$cleanData->OMO($_POST['yearcompleted']);
			$activity=$cleanData->OMO($_POST['activity']);
			$eduhistory=$cleanData->OMO($_POST['eduhistory']);
			$uni=$cleanData->OMO($_POST['uni']);
			$studentnumber=$cleanData->OMO($_POST['studentnumber']);
			$statuscompletion=$cleanData->OMO($_POST['statuscompletion']);
			$e=$tertiaryApplications->hambisaIsgabaSesihlanu($applicationidStep5,$my_id_step5,$schoolname,$street,$suburb,$town,$province,$postal,$yearcompleted,$activity,$eduhistory,$uni,$studentnumber,$statuscompletion);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP6 ({$applicationidStep5}) COMPLETED";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions.The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData =$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				
			}
		}
		elseif(isset($_POST['erroridcopy'])){
			$ext=explode(".",$_FILES['file']['name']);
			$ext=end($ext);
			if(strtolower($ext)!="pdf"){
				$e->responseStatus=StatusConstants::FAILED_STATUS;

				$e->responseMessage="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$applicationId=$tertiaryApplications->getApplicationId($std_id);
				if($applicationId=="absent"){
					$e->responseStatus=StatusConstants::FAILED_STATUS;

					$e->responseMessage="application ID for ".$std_id." does not exist";
					// $e=["responseStatus"=>"F","responseMessage"=>""];
				}
				else{
					$dir="../../documents/".md5($applicationId)."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$e=$tertiaryApplications->uploadedUpload("idcopy",false,$new_name_file,$applicationId,$std_id);
						if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
							$subject="TERTIARY APPLICATION WITH NETCHATSA STEP7 {$applicationId} (ID Copy) Submitted";
							$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
							<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
							<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
							$my_id_notification=$cur_user_row['my_id'];
							$from_sender="no-reply@netchatsa.com";
							$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
							
						}
					}
					else{
						$e->responseStatus=StatusConstants::FAILED_STATUS;

						$e->responseMessage="REPORT THIS ERROR 330: File cannot be moved to Path";
					}
				}
			}	
		}
		elseif(isset($_POST['writeStoryPoint'])) {
			$writeStoryPoint = $cleanData->OMO($_POST['writeStoryPoint']);
			$e = $userPdo->updateUserDataStoryPoint($writeStoryPoint,$cur_user_row['id']);
			if($e->responseStatus===StatusConstants::FAILED_STATUS){
				$subject="Life Story updated and shared successully ";
				$message="Life story at netchatsa has been updated and shared with your community. <br><br>Share your life story more often, it might be the change some one needs out there.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		// elseif(isset($_POST['updateVersionId'],$_POST['NewVersion'])){
		//     $updateVersionId = $cleanData->OMO($_POST['updateVersionId']);
        //     $NewVersion = $cleanData->OMO($_POST['NewVersion']);
		//     $response=$pdo->submitAppVersionUpdate($updateVersionId,$NewVersion);
		//     if($response['response']=="S"){
		//         $e=1;
		//     }
		//     else{
		//         $e=$response['data'];
		//     }
		// }
		elseif(isset($_POST['errorfinalresults'])){
			$ext=explode(".",$_FILES['file']['name']);
			$ext=end($ext);
			if(strtolower($ext)!="pdf"){
				// $e=["responseStatus"=>"F","responseMessage"=>""];
				$e->responseStatus=StatusConstants::FAILED_STATUS;
				$e->responseMessage="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$applicationId=$tertiaryApplications->getApplicationId($std_id);
				if($applicationId=="absent"){
					// $e=["responseStatus"=>"F","responseMessage"=>""];
					$e->responseStatus=StatusConstants::FAILED_STATUS;
					$e->responseMessage="application ID for ".$std_id." does not exist";
				}
				else{
					$dir="../../documents/".md5($applicationId)."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$e=$tertiaryApplications->uploadedUpload("finalresults",false,$new_name_file,$applicationId,$std_id);
						if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
							$subject="TERTIARY APPLICATION WITH NETCHATSA STEP7 {$applicationId} (Final Results Copy) Submitted";
							$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
							<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
							<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
							$my_id_notification=$cur_user_row['my_id'];
							$from_sender="no-reply@netchatsa.com";
							$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
							
						}
						
					}
					else{
						// $e=["responseStatus"=>"F","responseMessage"=>""];
						$e->responseStatus=StatusConstants::FAILED_STATUS;
						$e->responseMessage="REPORT THIS ERROR 330: File cannot be moved to Path";
					}
				}
			}
		}
		elseif(isset($_POST['proofresident'])){
			$ext=explode(".",$_FILES['file']['name']);
			$ext=end($ext);
			if(strtolower($ext)!="pdf"){
				// $e=["responseStatus"=>"F","responseMessage"=>""];
				$e->responseStatus=StatusConstants::FAILED_STATUS;
				$e->responseMessage="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$applicationId=$tertiaryApplications->getApplicationId($std_id);
				if($applicationId=="absent"){
					// $e=["responseStatus"=>"F","responseMessage"=>""];
					$e->responseStatus=StatusConstants::FAILED_STATUS;
					$e->responseMessage="application ID for ".$std_id." does not exist";
				}
				else{
					$dir="../../documents/".md5($applicationId)."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$e=$tertiaryApplications->uploadedUpload("proofresident",false,$new_name_file,$applicationId,$std_id);
						if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
							$subject="TERTIARY APPLICATION WITH NETCHATSA STEP7 {$applicationId} (proofresident) Submitted";
							$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
							<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
							<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
							$my_id_notification=$cur_user_row['my_id'];
							$from_sender="no-reply@netchatsa.com";
							$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
							
						}
					}
					else{
						// $e=["responseStatus"=>"F","responseMessage"=>""];
						$e->responseStatus=StatusConstants::FAILED_STATUS;
						$e->responseMessage="REPORT THIS ERROR 330: File cannot be moved to Path";
					}
				}
			}
			

			
		}
		elseif(isset($_POST['guardianid'])){
			$ext=explode(".",$_FILES['file']['name']);
			$ext=end($ext);
			if(strtolower($ext)!="pdf"){
				// $e=["responseStatus"=>"F","responseMessage"=>""];
				$e->responseStatus=StatusConstants::FAILED_STATUS;
				$e->responseMessage="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$applicationId=$tertiaryApplications->getApplicationId($std_id);
				if($applicationId=="absent"){
					// $e=["responseStatus"=>"F","responseMessage"=>""];
					$e->responseStatus=StatusConstants::FAILED_STATUS;
					$e->responseMessage="application ID for ".$std_id." does not exist";
				}
				else{
					$dir="../../documents/".md5($applicationId)."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$e=$tertiaryApplications->uploadedUpload("guardianid",true,$new_name_file,$applicationId,$std_id);
						if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
							$subject="TERTIARY APPLICATION WITH NETCHATSA STEP7 ({$applicationId}) (guardianid) Submitted";
							$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
							<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
							<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
							$my_id_notification=$cur_user_row['my_id'];
							$from_sender="no-reply@netchatsa.com";
							$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
							
						}
						else{
							$cleanData->connect->rollback();
						}
					}
					else{
						$e->responseStatus=StatusConstants::FAILED_STATUS;
						$e->responseMessage="REPORT THIS ERROR 330: File cannot be moved to Path";
						// $e=["responseStatus"=>"F","responseMessage"=>""];
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

			$uni_id=$cleanData->OMO($_POST['uni_id']);
			$uni_name=$cleanData->OMO($_POST['uni_name']);
			$faculty_id=$cleanData->OMO($_POST['faculty_id']);
			$faculty_name=$cleanData->OMO($_POST['faculty_name']);
			$course_id=$cleanData->OMO($_POST['course_id']);
			$course_name=$cleanData->OMO($_POST['course_name']);
			$mode_of_attendance=$cleanData->OMO($_POST['mode_of_attendance']);
			$year_of_study=$cleanData->OMO($_POST['year_of_study']);
			$campus_id=$cleanData->OMO($_POST['campus_id']);
			$e=$tertiaryApplications->hambisaIsgabaSesithupha($uni_id,$uni_name,$faculty_id,$faculty_name,$course_id,$course_name,$mode_of_attendance,$year_of_study,$campus_id,$cur_user_row['my_id'],false);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				
					$subject="TERTIARY APPLICATION WITH NETCHATSA STEP8 ({$uni_id}) (guardianid) Submitted";
					$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
					<p>

					</p>
					<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
					<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
					$my_id_notification=$cur_user_row['my_id'];
					$from_sender="no-reply@netchatsa.com";
					$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
					
				
			
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif(isset($_POST['course_id'],$_POST['uni_id'],$_POST['faculty_id'],$_POST['faculty_name'],$_POST['uni_name'],$_POST['campus_id'],$_POST['mode_of_attendance'],$_POST['year_of_study'])){
			$tr=explode("-",$_POST['course_id']);
			// print_r($tr);
			$uni_id=$cleanData->OMO($_POST['uni_id']);
			$uni_name=$cleanData->OMO($_POST['uni_name']);
			$faculty_id=$cleanData->OMO($_POST['faculty_id']);
			$faculty_name=$cleanData->OMO($_POST['faculty_name']);
			$course_id=$cleanData->OMO($tr[0]);
			$course_name=$cleanData->OMO($tr[1]);
			$mode_of_attendance=$cleanData->OMO($_POST['mode_of_attendance']);
			$year_of_study=$cleanData->OMO($_POST['year_of_study']);
			$campus_id=$cleanData->OMO($_POST['campus_id']);
			$e=$tertiaryApplications->hambisaIsgabaSesithupha($uni_id,$uni_name,$faculty_id,$faculty_name,$course_id,$course_name,$mode_of_attendance,$year_of_study,$campus_id,$cur_user_row['my_id'],true);
			//print_r($response);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP6 ({$uni_id}) (guardianid) Submitted";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>

				</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p> ";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif(isset($_POST['studyAreaMathTitleCode'],$_POST['studyAreaMathCode'])){
			$studyAreaMathTitleCode=$cleanData->OMO($_POST['studyAreaMathTitleCode']);
			$studyAreaMathCode=$cleanData->OMO($_POST['studyAreaMathCode']);
			$e=$studyArea->hambisaUmbuzoWeCode($studyAreaMathTitleCode,$studyAreaMathCode,$cur_user_row['my_id']);
			//print_r($response);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$subject="New Code Posted with title ({$studyAreaMathTitleCode})";
				$message="New Code Question Posted Successfully";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif(isset($_POST['accept'],$_POST['applicationidStep8'],$_POST['my_id_step8'])){
			$accept=$cleanData->OMO($_POST['accept']);
			$applicationidStep8=$cleanData->OMO($_POST['applicationidStep8']);
			$my_id_step8=$cleanData->OMO($_POST['my_id_step8']);
			$e=$tertiaryApplications->hambisaIsgabaConditionsAccept($accept,$applicationidStep8,$my_id_step8);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$subject="TERTIARY APPLICATION WITH NETCHATSA STEP8 ({$applicationidStep8})";
				$message="<p>Congrats for starting your tertiary journey with netchatsa. Please complete all step required by the app for our team to be able to give universities access to your application for processing stage.</p>
				<p>By applying through netchatsa, It does not mean you will automatically get accepted by universities, bursaries, and/or NSFAS. It all depends on your marks and institution processing procedure.</p>
				<p style='color:red;'><h4>Disclamer</h4>Netchatsa does not take part nor involved in any decision making with any type of institution. The institutions independently make their own decisions about applications without our/company(netchatsa) invlovement nor pursuation. Netchatsa is only just a middle man between applicant and institutions. The fee charged by the app service is not an application fee, it is an admin fee. Any application fee required by any institution shall be communicated to you by that institution and shall not be paid through our system but directly to that institution. The admin fee is a no-refundable fee.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
				
			}
			else{
				$cleanData->connect->rollback();
			}
			
		}//7311235634080 3332 3523

		elseif(isset($_POST['post_id_views'])){
			// $likeId=$pdo->run_topic();
			$post_id=$cleanData->OMO($_POST['post_id_views']);
			$e=$studyArea->addViewCounts($post_id,$cur_user_row['my_id']);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$posterInfo=$userPdo->userInfoUNINGmyID($userPdo->getPosterUserMy_id($post_id));
				$subject="YOUR POST IS GETTING NOTICED (".$e->responseMessage.") views";
				$message="<p>Your is getting noticed, viewed by {$posterInfo['name']} {$posterInfo['surname']} and etc</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$posterInfo['my_id'],$from_sender,$posterInfo);
				
				
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif(isset($_POST['post_id_like'])){
			$post_id=$cleanData->OMO($_POST['post_id_like']);
			$e=$studyArea->addLikeCounts($post_id,$cur_user_row['my_id']);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$posterInfo=$userPdo->userInfoUNINGmyID($userPdo->getPosterUserMy_id($post_id));
				$e->responseMessage = $studyArea->getNumLikes($post_id);
				$subject="YOUR POST IS GETTING NOTICED ".$post_id.") likes";
				$message="<p>Your is getting noticed, liked by {$posterInfo['name']} {$posterInfo['surname']} and etc</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$posterInfo['my_id'],$from_sender,$posterInfo);
				
			}
		}
		elseif(isset($_POST['post_id_dislike'])){
			// $dislikeId=$pdo->run_topic();
			$post_id=$cleanData->OMO($_POST['post_id_dislike']);
			$e=$studyArea->addDislikeCounts($post_id,$cur_user_row['my_id']);
			if($e->responseStatus!==StatusConstants::SUCCESS_STATUS){
				$cleanData->connect->rollback();
			}
		}
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
						$e->responseStatus=StatusConstants::FAILED_STATUS;
						$e->responseMessage="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
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
						$dir="../../posts/netchatsaSudyArea/".$cur_user_row['my_id']."/";
						if(!is_dir($dir)){
							mkdir($dir,0777,true);
						}
						// $profile_id=$pdo->run_topic();
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
							$file=$new_name_file;
						}
						else{
							$e->responseStatus=StatusConstants::FAILED_STATUS;
							$e->responseMessage="Failed to upload file to Dir, Please try again later.";
							$tracker=false;

						}
					}
				}
			}
			if($tracker){
				$text=$cleanData->OMO($_POST['studyAreaMathText']);
				$title=$cleanData->OMO($_POST['studyAreaMathTitle']);
				if($img==1){
					$img=$file;
				}
				elseif($mp4==1){
					$mp4=$file;
				}
				// $post_id=$pdo->run_topic();
				$iscode=0;
				$e=$studyArea->hambisaNoneCodeAsifunde($iscode,$title,$text,$img,$mp4,$cur_user_row['my_id']);
				if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
					$subject="New Question Posted with title ({$title})";
					$message="New Question Posted Successfully";
					$my_id_notification=$cur_user_row['my_id'];
					$from_sender="no-reply@netchatsa.com";
					$e->extraData=$notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$cur_user_row);
					
				}
				else{
					$cleanData->connect->rollback();
				}
			}
		}
		elseif(isset($_POST['nameMatricUpgrade']) and isset($_POST['surnameMatricUpgrade']) and isset($_POST['idNumMatricUpgrade']) and isset($_POST['phoneMatricUpgrade']) and isset($_POST['emailMatricUpgrade']) and isset($_POST['subj1MatricUpgrade']) and isset($_POST['subj2MatricUpgrade']) and isset($_POST['subj3MatricUpgrade']) and isset($_POST['subj4MatricUpgrade']) and isset($_POST['subj5MatricUpgrade']) and isset($_POST['subj6MatricUpgrade']) and isset($_POST['subj7MatricUpgrade']) and isset($_POST['subj8MatricUpgrade']) and isset($_POST['subj9MatricUpgrade']) and isset($_POST['subj10MatricUpgrade'])){
			$nameMatricUpgrade=$cleanData->OMO($_POST['nameMatricUpgrade']);
			$surnameMatricUpgrade=$cleanData->OMO($_POST['surnameMatricUpgrade']);
			$idNumMatricUpgrade=$cleanData->OMO($_POST['idNumMatricUpgrade']);
			$phoneMatricUpgrade=$cleanData->OMO($_POST['phoneMatricUpgrade']);
			$emailMatricUpgrade=$cleanData->OMO($_POST['emailMatricUpgrade']);
			$subj1MatricUpgrade=$cleanData->OMO($_POST['subj1MatricUpgrade']);
			$subj2MatricUpgrade=$cleanData->OMO($_POST['subj2MatricUpgrade']);
			$subj3MatricUpgrade=$cleanData->OMO($_POST['subj3MatricUpgrade']);
			$subj4MatricUpgrade=$cleanData->OMO($_POST['subj4MatricUpgrade']);
			$subj5MatricUpgrade=$cleanData->OMO($_POST['subj5MatricUpgrade']);
			$subj6MatricUpgrade=$cleanData->OMO($_POST['subj6MatricUpgrade']);
			$subj7MatricUpgrade=$cleanData->OMO($_POST['subj7MatricUpgrade']);
			$subj8MatricUpgrade=$cleanData->OMO($_POST['subj8MatricUpgrade']);
			$subj9MatricUpgrade=$cleanData->OMO($_POST['subj9MatricUpgrade']);
			$subj10MatricUpgrade=$cleanData->OMO($_POST['subj10MatricUpgrade']);
			$SchoolsSA=$cleanData->OMO($_POST['SchoolsSA']);
			$my_id=$cur_user_row['my_id'];
			$e=$matricUpgrade->yenzaUmatikuletshenaWabaphindayo($my_id,$nameMatricUpgrade,$surnameMatricUpgrade,$idNumMatricUpgrade,$phoneMatricUpgrade,$emailMatricUpgrade,$subj1MatricUpgrade,$subj2MatricUpgrade,$subj3MatricUpgrade,$subj4MatricUpgrade,$subj5MatricUpgrade,$subj6MatricUpgrade,$subj7MatricUpgrade,$subj8MatricUpgrade,$subj9MatricUpgrade,$subj10MatricUpgrade,$SchoolsSA);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				
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
				$e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif(isset($_POST['subjModelAddSunject'])){
			$subjModelAddSunject=$cleanData->OMO($_POST['subjModelAddSunject']);
		    $my_id=$cur_user_row['my_id'];
		    $getAllInfoOfMatricReWriteLearner=$matricUpgrade->getAllInfoOfMatricReWriteLearner($my_id);
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
	                $e=$sgelaPdo->ngezelaEsinyeIsifundo($position,$subjModelAddSunject,$getAllInfoOfMatricReWriteLearner['id']);
	                if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
	                    $flag=true;
	                    $status=array("success"=>"s");
	                    break;
	                }
	                else{
	                    $flag=true;
	                    $status=array("error"=>$e->responseMessage);
	                    break;
	                }
	            }
	        }
	        if($flag){
	            if(empty($status)){
	            	$e->responseStatus=StatusConstants::FAILED_STATUS;
					$e->responseMessage="Status Error, Internal Error. Please Contact support @ 0685153023 WhatsApp";
	                // $e=['responseStatus'=>StatusConstants::FAILED_STATUS,'responseMessage'=>""];
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
						$e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
						
	                }
	                else{
	                	$e->responseStatus=StatusConstants::FAILED_STATUS;
						$e->responseMessage="Error 3323: {Please report this error to Support @ 0685153023 WhatsApp}".json_encode($status);
	                    // $e=['responseStatus'=>StatusConstants::FAILED_STATUS,'responseMessage'=>"];
	                }
	            }
	            
	        }
	        else{
	        	$e->responseStatus=StatusConstants::FAILED_STATUS;
				$e->responseMessage="Sorry, You Cannot take more than 10 classes!!..";
	            // $e=['responseStatus'=>StatusConstants::FAILED_STATUS,'responseMessage'=>""];
	        }
				
		}
		elseif (isset($_POST['my_id_new_set'],$_POST['status_new_set'],$_POST['studentNameconst'],$_POST['studentSurname'],$_POST['studentSchoolAttecnding'],$_POST['studentCurrentGrade'],$_POST['amount'])) {
			$my_id_new_set=$cleanData->OMO($_POST['my_id_new_set']);
			$status_new_set=$cleanData->OMO($_POST['status_new_set']);
			$studentNameconst=$cleanData->OMO($_POST['studentNameconst']);
			$studentSurname=$cleanData->OMO($_POST['studentSurname']);
			$studentSchoolAttecnding=$cleanData->OMO($_POST['studentSchoolAttecnding']);
			$studentCurrentGrade=$cleanData->OMO($_POST['studentCurrentGrade']);
			$amount=$cleanData->OMO($_POST['amount']);
			$e=$sgelaPdo->setSelfLearningClass($my_id_new_set,$status_new_set,$studentNameconst,$studentSurname,$studentSchoolAttecnding,$studentCurrentGrade,$amount);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
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
				$e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif (isset($_POST['changegrade'])) {
			$changegrade=$cleanData->OMO($_POST['changegrade']);
			$e=$matricUpgrade->changegrade($changegrade,$cur_user_row['my_id']);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
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
				$e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif(isset($_POST['updateLevelVAVA'])){
			$updateLevelVAVA=$cleanData->OMO($_POST['updateLevelVAVA']);
			$e=$sgelaPdo->updateLevelVAVA($updateLevelVAVA,$cur_user_row['my_id'],"tertiary");
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
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
				$e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif(isset($_POST['select_module_2_reg'],$_POST['level_module'])){
			$select_module_2_reg=$cleanData->OMO($_POST['select_module_2_reg']);
			$level_module=$cleanData->OMO($_POST['level_module']);
			$e=$matricUpgrade->fakaIsifundoEsishaSasenyuvesi($select_module_2_reg,$level_module,$cur_user_row['my_id']);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
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
				$e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
				
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif(isset($_POST['code'],$_POST['p_id'])){
			$text=$cleanData->OMO($_POST['code']);
			$post_id=$cleanData->OMO($_POST['p_id']);
			// $reply_id=run_topic();
			$iscode=1;
			$mp4=0;
			$img=0;
			$e=$studyArea->fakaImpenduloKa_AsifundeSonke($iscode,$post_id,$text,$img,$mp4,$cur_user_row['my_id']);
			if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$posterInfo=$userPdo->userInfoUNINGmyID($userPdo->getPosterUserMy_id($post_id));
				$subject="YOUR POST HAS A REPLY";
				$message="<p>{$cur_user_row['name']} {$cur_user_row['surname']} has replied to your post.</p>";
				$my_id_notification=$cur_user_row['my_id'];
				$from_sender="no-reply@netchatsa.com";
				$e->extraData=$notification->fakaKuNotification($subject,$message,$posterInfo['my_id']??'',$from_sender,$posterInfo);
				
			}
			else{
				$cleanData->connect->rollback();
			}
		}
		elseif(isset($_POST['flaggeeUser'])){
	        $poster=$cleanData->OMO($_POST['flaggeeUser']);
	        $e=$userPdo->fakaKuFlagged($cur_user_row['my_id'],$poster);
	        if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$aa=$userPdo->userInfoUNINGmyID($poster);
                $emailFrom="No-Reply@netchatsa.com";
                $subject="reporting of Account User {$aa['name']} {$aa['name']}";
                $message="<h3 style='color:green;'>Account User {$aa['name']} {$aa['name']} have been successfully Reported.</h3>
                <p>You will now be able to see content by {$aa['name']} {$aa['name']}, You can unFlag the user at any time.</p>
                
                <br><br>";
                $from_sender="no-Reply@netchatsa.com";
                $e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
                
			}
			else{
				$cleanData->connect->rollback();
			}        
	    }
	    elseif(isset($_POST['track_id_like'])){
	        $track_id_like=$cleanData->OMO($_POST['track_id_like']);
	        $e=$musicPdo->track_id_likeSendFunction($track_id_like,$cur_user_row['my_id']);
	        if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
	            $e=$musicPdo->trackLikes($track_id_like);
	            if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
	            	
	            }
	            else{
	            	$cleanData->connect->rollback();
	            }
	        }
	        else{
	        	$cleanData->connect->rollback();
	        }
	    }
        elseif(isset($_POST['track_download'])){
            $track_download=$cleanData->OMO($_POST['track_download']);
            $e=$musicPdo->track_downloadSendFunction($track_download);
            if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
            	
            }
            else{
            	$cleanData->connect->rollback();
            }
        }
	    elseif(isset($_POST['blockeeUser'])){
	        $poster=$cleanData->OMO($_POST['blockeeUser']);
	        $e=$userPdo->fakaKuBlockedUsers($cur_user_row['my_id'],$poster);
	        if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
				$aa=$posterInfo=$userPdo->userInfoUNINGmyID($poster);
                $emailFrom="No-Reply@netchatsa.com";
                $subject="{$aa['name']} {$aa['name']} has been blocked!!.";
                $message="<h3 style='color:green;'>Account User {$aa['name']} {$aa['name']} have been successfully blocked.</h3>
                <p>You will now be able to see content by {$aa['name']} {$aa['name']}, You can unblock the user at any time.</p>
                
                <br><br>";
                $from_sender="no-Reply@netchatsa.com";
                $e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
                
			}
			else{
				$cleanData->connect->rollback();
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
					// $e=['responseStatus'=>StatusConstants::FAILED_STATUS,'responseMessage'=>""];
					$e->responseStatus=StatusConstants::FAILED_STATUS;
					$e->responseMessage="file too big!!";
					$tracker=false;
				}
				else{
					$ext=explode(".",$_FILES['file']['name']);
					$ext=end($ext);
					$arr=array("jpg","png","jpeng","jpeg","heic","mp4","mv");
					if(!in_array(strtolower($ext),$arr)){
						$e->responseStatus=StatusConstants::FAILED_STATUS;
						$e->responseMessage="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
						// $e=['responseStatus'=>StatusConstants::FAILED_STATUS,'responseMessage'=>""];
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
						$dir="../../posts/netchatsaSudyArea/".$id."/";
						if(!is_dir($dir)){
							mkdir($dir,0777,true);
						}
						// $profile_id=run_topic();
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
							$file=$new_name_file;
						}
						else{
							$e->responseStatus=StatusConstants::FAILED_STATUS;
							$e->responseMessage="Failed to upload file to Dir, Please try again later.";
							//$e=['responseStatus'=>StatusConstants::FAILED_STATUS,'responseMessage'=>""];
							$tracker=false;

						}
					}
				}
			}
			if($tracker){
				$text=$cleanData->OMO($_POST['studyAreaMathTextReply']);
				$post_id=$cleanData->OMO($_POST['p_id_img']);
				if($img==1){
					$img=$file;
				}
				elseif($mp4==1){
					$mp4=$file;
				}
				// $reply_id=run_topic();
				$iscode=0;
				$e=$studyArea->fakaImpenduloKa_AsifundeSonke($iscode,$post_id,$text,$img,$mp4,$cur_user_row['my_id']);
				if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
					$posterInfo=$userPdo->userInfoUNINGmyID($userPdo->getPosterUserMy_id($post_id));
					$subject="YOUR POST HAS A REPLY";
					$message="<p>{$cur_user_row['name']} {$cur_user_row['surname']} has replied to your post.</p>";
					$my_id_notification=$cur_user_row['my_id'];
					$from_sender="no-reply@netchatsa.com";
					$e->extraData=$notification->fakaKuNotification($subject,$message,$posterInfo['my_id'],$from_sender,$posterInfo);
					
				}
				else{
					$cleanData->connect->rollback();
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
				$e->responseStatus=StatusConstants::FAILED_STATUS;
				$e->responseMessage="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
				// $e=['responseStatus'=>StatusConstants::FAILED_STATUS,'responseMessage'=>""];
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$dir="../../img/userProfileImages/".$id."/";
				if(!is_dir($dir)){
					mkdir($dir,0777,true);
				}
				if(move_uploaded_file($_FILES['imageProfileTag']['tmp_name'], $dir.basename($new_name_file))){
					$e=$userPdo->fakaIsithombeEsishaKwiProfilePicture($new_name_file,$cur_user_row['my_id']);
					if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
						$subject="Profile Picture Has Been Updated";
						$message="<p>You have successully updated your profile picture</p>";
						$my_id_notification=$cur_user_row['my_id'];
						$from_sender="no-reply@netchatsa.com";
						$e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
						
					}
					else{
						$cleanData->connect->rollback();
					}
				}
				else{
					$e->responseStatus=StatusConstants::FAILED_STATUS;
					$e->responseMessage="REPORT THIS ERROR 330: File cannot be moved to Path";
					// $e=['responseStatus'=>StatusConstants::FAILED_STATUS,'responseMessage'=>''];
				}
			}
		}
		elseif(isset($_POST['unFlagUser'],$_POST['unflaggeeUser'])){
	        $unFlagUser=$_POST['unFlagUser'];
	        $flaggeeUser=$_POST['unflaggeeUser'];
	        $aa=$posterInfo=$userPdo->userInfoUNINGmyID($flaggeeUser);
	        $e=$userPdo->unFlagUser($unFlagUser);
	        if($e->responseStatus===StatusConstants::SUCCESS_STATUS){
	            $emailFrom="No-Reply@netchatsa.com";
	            $subject="reporting of Account User {$aa['name']} {$aa['name']} have been successfully eliminated";
	            $message="<h3 style='color:green;'>Account User {$aa['name']} {$aa['name']} have been successfully unReported.</h3>
	            <p>You will now be able to see content by {$aa['name']} {$aa['name']}, You can block the user at any time.</p>
	            <br><br>";
	            $from_sender="no-Reply@netchatsa.com";
	            $e->extraData=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
	            
	        }
	        else{
	        	$cleanData->connect->rollback();
	        }
		}
	    elseif(isset($_POST['unblockThisUser'],$_POST['unblockeeId'])){
	        $unblockThisUser=$_POST['unblockThisUser'];
	        $aa=$posterInfo=$userPdo->userInfoUNINGmyID($_POST['unblockeeId']);
	        $e=$userPdo->unBlocUser($unblockThisUser);
	       	if($e->responseStatus===StatusConstants::FAILED_STATUS){
	            $emailFrom="No-Reply@netchatsa.com";
	            $subject="Account User {$aa['name']} {$aa['name']} have been successfully unBlocked! ";
	            $message="<h3 style='color:green;'>Account User {$aa['name']} {$aa['name']} have been successfully unBlocked.</h3>
	            <p>You will now be able to see content by {$aa['name']} {$aa['name']}, You can block the user at any time.</p>
	            <br><br>";
	            $from_sender="no-Reply@netchatsa.com";
	            $e=$notification->fakaKuNotification($subject,$message,$cur_user_row['my_id'],$from_sender,$cur_user_row);
	            
	        }
	        else{
	        	$cleanData->connect->rollback();
	        }
	    }
	    if($e->responseStatus == Constants::FAILED_STATUS){
        	WriteResponseLog::writelogResponse('../../storage/logs/', 'error', 'ajaxCallProcessor', 'UNKNOWN',, $e);
	    }
    }
    catch(\Exception $error){
        $erroObject= WriteResponseLog::exceptionBuiler($error);
        $e->responseStatus = Constants::FAILED_STATUS;
        $e->responseMessage = $error->getMessage();
        WriteResponseLog::writelogResponse('../../storage/logs/', $erroObject->issueType, $erroObject->class, $erroObject->method, $erroObject);
    }
	echo json_encode($e);
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