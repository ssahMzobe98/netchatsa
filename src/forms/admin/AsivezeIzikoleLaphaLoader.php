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
		$schoolAdminPdo = PDOAdminFactory::make(ServiceConstants::SCHOOL_ADMIN_PDO,[$userPdo->connect]);
		$getSchool = $schoolAdminPdo->maSomaneGetProjectsSchools();
			?>
			<style>
				.izikoleZakithi{
					width:100%;
					padding: 10px 10px;
					color:#ddd;
					text-align: left;
					display: flex;
					border-radius: 10px 10px;
					border-right: 2px solid mediumvioletred;
					border-left: 2px solid rebeccapurple;
				}
			</style>
			<?php
			foreach($getSchool as $row){
				?>
				<div class="izikoleZakithi box-shadow">
					<div style="width:100%;"><?php echo wordwrap($row['school'],30,"<br>");?></div>
					<span style="padding:10ppx 10px;"><i class="fa fa-edit"></i></span>
				</div>
				<?php
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