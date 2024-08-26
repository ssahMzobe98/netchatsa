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
		$schoolAdminPdo = PDOAdminFactory::make(ServiceConstants::SCHOOL_ADMIN_PDO,[$userPdo->connect]);
		if(isset($_GET["institutions"])){
			$institutions=(array) json_decode($_GET["institutions"]);
//			print_r($institutions);
			if(empty($institutions)){
				?>
				<h5 style="padding:10px 10px; width:100%;color:red;">NO SEARCH RESULTS FOUND </h5>
				<?php
			}
			else{
				$getInstitution = $schoolAdminPdo->searchBursaryUIDS($institutions);
				if(count($getInstitution)==0){
					?>
					<h5 style="padding:10px 10px; width:100%;color:red;">NO SEARCH RESULTS FOUND </h5>
					<?php
				}
				else{
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
							cursor: pointer;
						} 
					</style>
					<?php
					foreach($getInstitution as $row){
						?>
						<div class="izikoleZakithi box-shadow">
							<div onclick="loadAfterQuery('.dataDisplayerIdrCourses','../src/forms/admin/displayFundingCourses.php?funder=<?php echo $row['id'];?>')" style="width:100%;"><?php echo wordwrap($row['institutions'],30,"<br>");?></div>
							<span style="padding:10ppx 10px;"><i class="fa fa-edit"></i></span>
						</div>
							<br>
						<?php
					}
				}
			}
		}
		else{
			echo"UKNOWN REQUEST!!";
		}
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../xZx");
	</script>

	<?php
}
?>