<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use App\Providers\Factory\Admin\PDOAdminFactory;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['usermail'])){
  $userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
  $matricUpgradeAdminPdo = PDOAdminFactory::make(ServiceConstants::MATRIC_UPGRADE_ADMIN,[$userPdo->connect]);
  $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
  $cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		if(isset($_GET['subj'])){
			$subj = $cleanData->OMO($_GET['subj']);
			$getMatricUpgradeSubjChapters = $matricUpgradeAdminPdo->masomaneGetMatricUpgradeSubjChapters($subj);
			?>
			<style>
				.izikoleZakithi{
					width:90%;
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
			if(count($getMatricUpgradeSubjChapters)==0){
				echo"<h3>No Chapter found..</h3>";
			}
			else{
				foreach($getMatricUpgradeSubjChapters as $row){
					?>
					<div class="izikoleZakithi box-shadow selected<?php echo $row['id'];?>" id='selected'>
						<div style="width:100%;" onclick="loadAfterQuery('.displaySubjectChaptersContent','../src/forms/admin/displaySubjectChaptersContent.php?chapter=<?php echo $row['id'];?>');activateOnclickDynamic(<?php echo $row['id'];?>,'selected');" style="width:100%;"><?php echo wordwrap($row['chapter'],30,"<br>");?></div>
						<span style="padding:10px 10px;"><i class="fa fa-edit"></i></span>
					</div>
						<br>
					<?php
				}
			}
		}
		else{
			echo"UKNOWN REQUEST!!..";
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