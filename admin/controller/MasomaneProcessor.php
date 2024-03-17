<?php
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['masomane'])){
	require_once("../controller/pdo.php");
	$pdo=new _pdo_();
	$cur_user_row =$pdo->userInfo($_SESSION['masomane']);
	$userDirect=$cur_user_row['user_nav'];
	$url = explode("/",$_SERVER['REQUEST_URI']);
	
	$url=$url[count($url)-4]."/".str_replace("%20", " ",$url[count($url)-3]);
	if($url==$userDirect){
		$e="UKNOWN REQUEST";
		if(isset($_POST['PrincipalName'],
							$_POST['PrincipalSurname'],
							$_POST['PrincipalPhoneNo'],
							$_POST['PrincipalEmail'],
							$_POST['selectMasomaneSchool'],
							$_POST['PrincipaIdNo'],
							$_POST['PrincipaPass'],
							$_POST['PrincipaPersal'])){
				$PrincipalName=$pdo->OMO($_POST['PrincipalName']);
				$PrincipalSurname=$pdo->OMO($_POST['PrincipalSurname']);
				$PrincipalPhoneNo=$pdo->OMO($_POST['PrincipalPhoneNo']);
				$PrincipalEmail=$pdo->OMO($_POST['PrincipalEmail']);
				$selectMasomaneSchool=$pdo->OMO($_POST['selectMasomaneSchool']);
				$PrincipaIdNo=$pdo->OMO($_POST['PrincipaIdNo']);
				$PrincipaPass=$pdo->OMO($_POST['PrincipaPass']);
				$PrincipaPersal=$pdo->OMO($_POST['PrincipaPersal']);
				$response = $pdo->maSomaneSaveSchool($PrincipalName,
																							$PrincipalSurname,
																							$PrincipalPhoneNo,
																							$PrincipalEmail,
																							$selectMasomaneSchool,
																							$PrincipaIdNo,
																							$PrincipaPass,
																							$PrincipaPersal,
																							$cur_user_row['id']);
				if($response["response"]=="S"){
					$e=1;
				}
				else{
					$e = $response['data'];
				}
		}
		else if(isset($_POST['logoutExit'])){
			unset($_SESSION['masomane']);
			session_destroy();
			$e=1;
		}
		elseif(isset($_POST['projectName'],$_POST['Decription'],$_POST['Sprint'])){
			$projectName = $pdo->OMO($_POST['projectName']);
			$Decription = $pdo->OMO($_POST['Decription']);
			$Sprint = $pdo->OMO($_POST['Sprint']);
			$response = $pdo->maSomaneSaveProject($projectName,$Decription,$Sprint,$cur_user_row['id']);
			if($response['response']=="S"){
				$e = 1;
			}
			else{
				$e = $response['data'];
			}
		}
		elseif(isset($_POST['editorEDS'],$_POST['projectStatsI'],$_POST['textTicketDescription'],$_POST['textTicketWeight'])){
			$editorEDS = $_POST['editorEDS'];
			$projectStatsI = $pdo->OMO($_POST['projectStatsI']);
			$textTicketDescription = $pdo->OMO($_POST['textTicketDescription']);
			$textTicketWeight = $pdo->OMO($_POST['textTicketWeight']);		
			$response = $pdo->maSomaneSaveTicket($editorEDS,$projectStatsI,$textTicketDescription,$textTicketWeight,$cur_user_row['id']);	
			if($response['response']=="S"){
				$e = 1;
			}
			else{
				$e = $response['data'];
			}
		}
		elseif(isset($_POST['ticket_status'],$_POST['ticket_id'])){
			$ticket_status = $pdo->OMO($_POST['ticket_status']);
			$ticket_id = $pdo->OMO($_POST['ticket_id']);
			$response = $pdo->maSomaneSaveTicketUpdate($ticket_status,$ticket_id);	
			if($response['response']=="S"){
				$e = 1;
			}
			else{
				$e = $response['data'];
			}
		}
		elseif(isset($_POST['schoolNameInput'])){
			$schoolNameInput = $pdo->OMO($_POST['schoolNameInput']);
			$response = $pdo->MasomaneAddHighschools($schoolNameInput,$cur_user_row['usermail']);
			if($response['response']=="S"){
				$e = 1;
			}
			else{
				$e = $response['data'];
			}
		}
		elseif(isset($_POST['StudentIdQRQR'])){
			$std_uid = $pdo->OMO($_POST['StudentIdQRQR']);
			$response = $pdo->getStudentInfo($std_uid);
			$date = date("Y-m-d H:m:ia");
			$subject = "<h2>INCOMPLETE APPLICATIONS {$date}</h2>";
			
			$message ="
				Hello {$response['title']} {$response['initials']} {$response['lname']} {$response['fname']}<br>
				<p>
					Your Tertiary application via NETCHATSA is pending completion. Please do complete application before closing date as there will bee no late applications. 
				</p>
			";
			$my_id_notification=$response['my_id'];
			$from_sender = "no-reply@netchatsa.com";
			$response = $pdo->fakaKuNotification($subject,$message,$my_id_notification,$from_sender,$response['email']);
			if($response['response']=="S"){
				$e = 1;
			}
			else{
				$e = $response['data'];
			}
		}
		elseif(isset($_POST['TextNewInstitution'],$_POST['TextNewInstitutionApiLink'],$_POST['TextNewInstitutionAPIKey'],$_POST['TextNewInstitutionAipKey2'],$_POST['TextNewInstitutiontoken'])){
			$TextNewInstitution = $pdo->OMO($_POST['TextNewInstitution']);
			$TextNewInstitutionApiLink = $pdo->EncryptThis($_POST['TextNewInstitutionApiLink']);
			$TextNewInstitutionAPIKey = $pdo->EncryptThis($_POST['TextNewInstitutionAPIKey']);
			$TextNewInstitutionAipKey2 = $pdo->EncryptThis($_POST['TextNewInstitutionAipKey2']);
			$TextNewInstitutiontoken = $pdo->EncryptThis($_POST['TextNewInstitutiontoken']);
			$response = $pdo->masomaneSaveInstituions($TextNewInstitution,$TextNewInstitutionApiLink,$TextNewInstitutionAPIKey,$TextNewInstitutionAipKey2,$TextNewInstitutiontoken,$cur_user_row['id']);
			if($response['response']=="S"){
				$e = 1;
			}
			else{
				$e = $response['data'];
			}
		}
		elseif(isset($_POST['selectInstitution'],$_POST['selectCourse'])){
			$selectInstitution=$pdo->OMO($_POST['selectInstitution']);
			$selectCourse=$pdo->OMO($_POST['selectCourse']);
			if(!$pdo->isCourseAddedToInstitution($selectInstitution,$selectCourse)){
				$response = $pdo->masomaneCreateNewCourse($selectInstitution,$selectCourse,$cur_user_row['id']);
				if($response['response']=="S"){
					$e = 1;
				}
				else{
					$e = $response['data'];
				}
			}
			else{
				$e = "Course Already Exist on this institution!";
			}

			
		}
		elseif(isset($_POST['subjectName'],$_POST['TextChapter'])){
			$subjectName=$pdo->OMO($_POST['subjectName']);
			$TextChapter=$pdo->OMO($_POST['TextChapter']);
	    $response = $pdo->andNewMatricUpgradeChapter($subjectName,$TextChapter,$cur_user_row['id']);
	    if($response['response']=="S"){
	        $e=1;
	    }
	    else{
	        $e=$conn->error;
	    }
		}
		elseif(isset($_POST['deleteThisContent'])){
	    $deleteThisContent=$pdo->OMO($_POST['deleteThisContent']);
	    $response = $pdo->deleteThisContent($deleteThisContent);
	    if($response['response']=="S"){
	        $e=1;
	    }
	    else{
	        $e=$conn->error;
	    }
		}
		elseif(isset($_POST['deremoTerm'],
								 $_POST['subjectChapter'],
								 $_POST['subjectNameMatricUpgrade'],
								 $_POST['titleOfContent'],
								 $_POST['SourceName'],
								 $_POST['SourceURL'])){
			$deremoTerm = $pdo->OMO($_POST['deremoTerm']);
			$subjectChapter = $pdo->OMO($_POST['subjectChapter']);
			$subjectNameMatricUpgrade = $pdo->OMO($_POST['subjectNameMatricUpgrade']);
			$titleOfContent = $pdo->OMO($_POST['titleOfContent']);
			$SourceName = $pdo->OMO($_POST['SourceName']);
			$SourceURL = $_POST['SourceURL'];
			$response = $pdo->masomaneAddNewContent($deremoTerm,$subjectChapter,$subjectNameMatricUpgrade,$titleOfContent,$SourceName,$SourceURL,$cur_user_row['id']);
	    if($response['response']=="S"){
	        $e=1;
	    }
	    else{
	        $e=$conn->error;
	    }

		}
		elseif(isset($_POST['SubjectNameNetchatsa'],$_POST['gradeNetchatsa'])){
			$SubjectNameNetchatsa = $pdo->OMO($_POST['SubjectNameNetchatsa']);
			$gradeNetchatsa = $pdo->OMO($_POST['gradeNetchatsa']);
			$response = $pdo->masomaneAddNewNetchatsaSchool($SubjectNameNetchatsa,$gradeNetchatsa,$cur_user_row['id']);
			if($response['response']=="S"){
	        $e=1;
	    }
	    else{
	        $e=$conn->error;
	    }
		}
		else{
			$e="UKNOWN REQUEST";
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