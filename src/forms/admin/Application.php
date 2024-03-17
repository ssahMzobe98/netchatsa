<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['usermail'])){
  	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
  	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
  	$cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$adminPdo = PDOServiceFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
		if(isset($_GET['Application'])&&$_GET['Application']>0){
			$uni = $cleanData->OMO($_GET['Application']);
			$Application=$adminPdo->masomaneGetApplicantsAppliedOnUni($uni);
			print_r($Application);
		}
		else{
			echo"BAD REQUEST!!";
		}
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