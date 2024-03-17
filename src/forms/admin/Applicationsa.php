<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Factory\Admin\PDOAdminFactory;
use App\Providers\Constants\Flags;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['usermail'])){
  	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
  	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
			?>
			<div style="width: 100%;padding: 10px 10px;display: flex;">
				<div style="width:30%;padding: 10px 10px;">
					<input style="width: 100%;padding: 10px 10px;border:none;border-radius: 100px;border-top: 2px solid mediumvioletred;border-bottom:2px solid rebeccapurple;background: none;color:white;" type="search" id="searchStudentsByIdNumber" class="searchStudentByIdNum" oninput="searchStudentsByIdNumber()" placeholder="search by ID / Passport Number">
				</div>
			</div>
			<div class="ApplicantsLoader" id='ApplicantsLoader'></div>
			<script>
				loadAfterQuery(".ApplicantsLoader","../src/forms/admin/ApplicantsLoader.php?start=0&limit=15");
			</script>
			<?php
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