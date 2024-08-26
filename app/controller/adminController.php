<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Factory\Admin\PDOAdminFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
use App\Providers\Response\Response;
use Src\Classes\logs\WriteResponseLog;

if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	$e=new Response();
	$e->responseStatus=StatusConstants::FAILED_STATUS;
	$e->responseMessage="UNKNOWN REQUEST!!.";
	try{

		$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
		$cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$schoolAdminPdo = PDOAdminFactory::make(ServiceConstants::SCHOOL_ADMIN_PDO,[$userPdo->connect]);
		$uniAdminPdo = PDOAdminFactory::make(ServiceConstants::UNI_ADMIN_PDO,[$userPdo->connect]);
		$matricUpgradeAdminPdo = PDOAdminFactory::make(ServiceConstants::MATRIC_UPGRADE_ADMIN,[$userPdo->connect]);
		$notification = PDOServiceFactory::make(ServiceConstants::NOTIFICATION_PDO,[$userPdo->connect]);
		//$tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
		$matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$userPdo->connect]);
		// $sgelaPdo = PDOServiceFactory::make(ServiceConstants::SGELA_UNI_PDO,[$userPdo->connect]);
		$adminPdo = PDOServiceFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
		$bursaryApplicationJobService = PDOAdminFactory::make(ServiceConstants::BURSARY_APPLICATION_JOB_SERVICE,[$userPdo->connect]);
		$ProjectTicketAdminPdo = PDOAdminFactory::make(ServiceConstants::PROJECT_TICKET_ADMIN,[$userPdo->connect]);
		$cur_user_row = $userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
		if(isset($_POST['PrincipalName'],
							$_POST['PrincipalSurname'],
							$_POST['PrincipalPhoneNo'],
							$_POST['PrincipalEmail'],
							$_POST['selectMasomaneSchool'],
							$_POST['PrincipaIdNo'],
							$_POST['PrincipaPass'],
							$_POST['PrincipaPersal'])){
				$PrincipalName=$cleanData->OMO($_POST['PrincipalName']);
				$PrincipalSurname=$cleanData->OMO($_POST['PrincipalSurname']);
				$PrincipalPhoneNo=$cleanData->OMO($_POST['PrincipalPhoneNo']);
				$PrincipalEmail=$cleanData->OMO($_POST['PrincipalEmail']);
				$selectMasomaneSchool=$cleanData->OMO($_POST['selectMasomaneSchool']);
				$PrincipaIdNo=$cleanData->OMO($_POST['PrincipaIdNo']);
				$PrincipaPass=$cleanData->OMO($_POST['PrincipaPass']);
				$PrincipaPersal=$cleanData->OMO($_POST['PrincipaPersal']);
				$e = $schoolAdminPdo->maSomaneSaveSchool($PrincipalName,$PrincipalSurname,$PrincipalPhoneNo,
																							$PrincipalEmail,
																							$selectMasomaneSchool,
																							$PrincipaIdNo,
																							$PrincipaPass,
																							$PrincipaPersal,
																							$cur_user_row['id']);
		}
		else if(isset($_POST['logoutExit'])){
			$e->responseMessage="READY TO LOGOUT!!.";
		}
		elseif(isset($_POST['projectName'],$_POST['Decription'],$_POST['Sprint'])){
			$projectName = $cleanData->OMO($_POST['projectName']);
			$Decription = $cleanData->OMO($_POST['Decription']);
			$Sprint = $cleanData->OMO($_POST['Sprint']);
			$e = $ProjectTicketAdminPdo->maSomaneSaveProject($projectName,$Decription,$Sprint,$cur_user_row['id']);
		}
		elseif(isset($_POST['editorEDS'],$_POST['projectStatsI'],$_POST['textTicketDescription'],$_POST['textTicketWeight'])){
			$editorEDS = $_POST['editorEDS'];
			$projectStatsI = $cleanData->OMO($_POST['projectStatsI']);
			$textTicketDescription = $cleanData->OMO($_POST['textTicketDescription']);
			$textTicketWeight = $cleanData->OMO($_POST['textTicketWeight']);		
			$e = $ProjectTicketAdminPdo->maSomaneSaveTicket($editorEDS,$projectStatsI,$textTicketDescription,$textTicketWeight,$cur_user_row['id']);	
		}
		elseif(isset($_POST['ticket_status'],$_POST['ticket_id'])){
			$ticket_status = $cleanData->OMO($_POST['ticket_status']);
			$ticket_id = $cleanData->OMO($_POST['ticket_id']);
			$e = $ProjectTicketAdminPdo->maSomaneSaveTicketUpdate($ticket_status,$ticket_id);	
		}
		elseif(isset($_POST['schoolNameInput'])){
			$schoolNameInput = $cleanData->OMO($_POST['schoolNameInput']);
			$e = $schoolAdminPdo->MasomaneAddHighschools($schoolNameInput,$cur_user_row['usermail']);
		}
		elseif(isset($_POST['StudentIdQRQR'])){
			$std_uid = $cleanData->OMO($_POST['StudentIdQRQR']);
			$response = $adminPdo->getStudentInfo($std_uid);
			$date = date("Y-m-d H:m:ia");
			$subject = "<h2>INCOMPLETE APPLICATIONS {$date}</h2>";
			
			$message ="
				Hello {$response['title']} {$response['initials']} {$response['surname']} {$response['name']}<br>
				<p>
					Your Tertiary application via NETCHATSA is pending completion. Please do complete application before closing date as there will bee no late applications. 
				</p>
			";
			$my_id_notification=$response['my_id'];
			$from_sender = "no-reply@netchatsa.com";
			$e = $notification->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$response);
			//fakaKuNotification(string $topic="",string $notification="",string $my_id_notification="",string $from_sender="",array $cur_user_row=[])
		}
		elseif(isset($_POST['TextNewInstitution'],$_POST['TextNewInstitutionApiLink'],$_POST['TextNewInstitutionAPIKey'],$_POST['TextNewInstitutionAipKey2'],$_POST['TextNewInstitutiontoken'])){
			$TextNewInstitution = $cleanData->OMO($_POST['TextNewInstitution']);
			$TextNewInstitutionApiLink = $uniAdminPdo->connect->EncryptThis($_POST['TextNewInstitutionApiLink']);
			$TextNewInstitutionAPIKey = $uniAdminPdo->connect->EncryptThis($_POST['TextNewInstitutionAPIKey']);
			$TextNewInstitutionAipKey2 = $uniAdminPdo->connect->EncryptThis($_POST['TextNewInstitutionAipKey2']);
			$TextNewInstitutiontoken = $uniAdminPdo->connect->EncryptThis($_POST['TextNewInstitutiontoken']);
			$e = $uniAdminPdo->masomaneSaveInstituions($TextNewInstitution,$TextNewInstitutionApiLink,$TextNewInstitutionAPIKey,$TextNewInstitutionAipKey2,$TextNewInstitutiontoken,$cur_user_row['id']);

		}
		elseif(isset($_POST['selectInstitution'],$_POST['selectCourse'])){
			$selectInstitution=$cleanData->OMO($_POST['selectInstitution']);
			$selectCourse=$cleanData->OMO($_POST['selectCourse']);
			$e->responseStatus=StatusConstants::FAILED_STATUS;
			$e->responseMessage="This course has already been added.";
			if(!$uniAdminPdo->isCourseAddedToInstitution($selectInstitution,$selectCourse)){
				$e = $uniAdminPdo->masomaneCreateNewCourse($selectInstitution,$selectCourse,$cur_user_row['id']);
			}
		}
		elseif(isset($_POST['subjectName'],$_POST['TextChapter'])){
			$subjectName=$cleanData->OMO($_POST['subjectName']);
			$TextChapter=$cleanData->OMO($_POST['TextChapter']);
	    	$e = $matricUpgradeAdminPdo->andNewMatricUpgradeChapter($subjectName,$TextChapter,$cur_user_row['id']);
		}
		elseif(isset($_POST['deleteThisContent'])){
	    	$deleteThisContent=$cleanData->OMO($_POST['deleteThisContent']);
	    	$e = $matricUpgradeAdminPdo->deleteThisContent($deleteThisContent);
		}
		elseif(isset($_POST['deremoTerm'],
								 $_POST['subjectChapter'],
								 $_POST['subjectNameMatricUpgrade'],
								 $_POST['titleOfContent'],
								 $_POST['SourceName'],
								 $_POST['SourceURL'])){
			$deremoTerm = $cleanData->OMO($_POST['deremoTerm']);
			$subjectChapter = $cleanData->OMO($_POST['subjectChapter']);
			$subjectNameMatricUpgrade = $cleanData->OMO($_POST['subjectNameMatricUpgrade']);
			$titleOfContent = $cleanData->OMO($_POST['titleOfContent']);
			$SourceName = $cleanData->OMO($_POST['SourceName']);
			$SourceURL = $_POST['SourceURL'];
			$e = $matricUpgradeAdminPdo->masomaneAddNewContent($deremoTerm,$subjectChapter,$subjectNameMatricUpgrade,$titleOfContent,$SourceName,$SourceURL,$cur_user_row['id']);

		}
		elseif(isset($_POST['SubjectNameNetchatsa'],$_POST['gradeNetchatsa'])){
			$SubjectNameNetchatsa = $cleanData->OMO($_POST['SubjectNameNetchatsa']);
			$gradeNetchatsa = $cleanData->OMO($_POST['gradeNetchatsa']);
			$e = $matricUpgrade->masomaneAddNewNetchatsaSchool($SubjectNameNetchatsa,$gradeNetchatsa,$cur_user_row['id']);
		}
		elseif(isset($_POST['runBursaryApplicationService'])){
			$e=$bursaryApplicationJobService->fireJob();

		}
		WriteResponseLog::writelogResponse('../../storage/logs/', 'error', 'adminController', 'UNKNOWN', $e);
		if($e->responseStatus == StatusConstants::FAILED_STATUS){
        	WriteResponseLog::writelogResponse('../../storage/logs/', 'error', 'adminController', 'UNKNOWN', $e);
	    }
	    else{
	    	$userPdo->connect->commit();
	    }
    }
    catch(\Exception $error){
        $erroObject= WriteResponseLog::exceptionBuiler($error);
        $e->responseStatus = StatusConstants::FAILED_STATUS;
        $e->responseMessage = $error->getMessage();
        WriteResponseLog::writelogResponse('../../storage/logs/', $erroObject->issueType, $erroObject->class, $erroObject->method, $erroObject);
    }
	echo json_encode($e);
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../");
	</script>

	<?php
}
?>