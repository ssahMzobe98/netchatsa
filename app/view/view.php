<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	// require_once("../controller/pdo.php");
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$NavigationHistory = PDOServiceFactory::make(ServiceConstants::NAVIGATION_HISTORY_PDO,[$userPdo->connect]);
	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	$lastVisit=$NavigationHistory->getLastVisitHistory($cur_user_row['my_id']);
	if(empty($lastVisit)){
		$lastVisit['id']=0;
	}
	if(isset($_GET['back'])){
	 	if(count($lastVisit)>0 &&$lastVisit['prev_id']>0){
	 		$prev_id=$lastVisit['prev_id'];
	 		$prev_trend=$NavigationHistory->getLastPrevVisited($prev_id);
	 		$back_to_id=$prev_trend['prev_id'];
	 		$prev_trend=$prev_trend['url'];
	 		unset($_GET['back']);
	 		$_GET[$prev_trend]='';
	 		$lastVisit['id']=$back_to_id;
	 	}
	}
	
	if(isset($_GET['apply'])){
		require_once("../../src/forms/app/apply.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"apply");
	}
	elseif(isset($_GET['matricUpgrade'])){
		// $pdo->matricUpgrade($cur_user_row);
		require_once("../../src/forms/app/matricUpgrade.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"matricUpgrade");
	}
	elseif(isset($_GET['esGela'])){
		require_once("../../src/forms/app/esGela.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"esGela");
	}
	elseif(isset($_GET['tertiary'])){
		require_once("../../src/forms/app/tertiary.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"tertiary");
	}
	elseif(isset($_GET['highschool'])){
		require_once("../../src/forms/app/highschool.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"highschool");
	}
	elseif(isset($_GET['tutoring'])){
		require_once("../../src/forms/app/tutoring.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"tutoring");
	}
	elseif(isset($_GET['reportedUsers'])){
		require_once("../../src/forms/app/myFlaggedUser.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"reportedUsers");
		// 
		// blockedUsers
	}
	elseif(isset($_GET['blockedUsers'])){
		require_once("../../src/forms/app/myBlockedUsers.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"blockedUsers");
	}
	elseif(isset($_GET['asifundeSonke'])){
		// $NavigationHistory->asifundeSonkeLoader();
		require_once("../../src/forms/app/asifundeSonkeLoader.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"asifundeSonke");
	}	
	elseif(isset($_GET['notification'])){
		require_once("../../src/forms/app/notificationLoader.php");
		// $pdo->notifications($cur_user_row);
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"notification");
	}
	elseif(isset($_GET['myProfile'])){
		require_once("../../src/forms/app/myProfile.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"myProfile");
	}
	elseif(isset($_GET['izihlabelelo'])){
		require_once("../../src/forms/app/izihlabelelo.php");
		$NavigationHistory->InsertPathToHistory($cur_user_row['my_id'],$lastVisit['id'],"izihlabelelo");
	}
	elseif(isset($_GET['logout'])){
		$dom=$pdo->logout($cur_user_row);
		if($dom['response']=="S"){
			echo"<h3 style='color:#45f3ff;background:red;'>Logging Out...</h3>";
			unset($_SESSION['usermail']);
			session_destroy();
			?>
			<script>
				window.location=("../../");
			</script>
			<?php
		}
		else{
			echo"<h3 style='color:#45f3ff;background:red;'>".$dom['data']."</h3>";
		}
	}
	else{
		
		require_once("../../src/forms/app/apply.php");
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