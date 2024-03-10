<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$studyArea = PDOServiceFactory::make(ServiceConstants::STUDY_AREA_PDO,[$userPdo->connect]);
	$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	echo"COMING SOON..";
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