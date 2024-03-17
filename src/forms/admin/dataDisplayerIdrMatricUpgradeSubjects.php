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
		$MatricUpgradeSubjects = $matricUpgradeAdminPdo->masomaneGetMatricUpgradeSubjects();
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
			.activeBtn{
				border-bottom: 2px solid mediumvioletred;
				border-top: 2px solid rebeccapurple;
				background: -webkit-linear-gradient(mediumvioletred,purple,rebeccapurple);
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			}
		</style>
		<?php
		if(count($MatricUpgradeSubjects)==0){
			echo"<h3>No Institutions found..</h3>";
		}
		else{
			foreach($MatricUpgradeSubjects as $row){
				$ChapterCounts = $row['ChapterCounts'];
				?>
				<div class="izikoleZakithi box-shadow activate<?php echo $row['id'];?>" id="inactive" >
					<div onclick="loadAfterQuery('.displaySubjectChapters','../src/forms/admin/displayMatricUpgradeSubjectChapters.php?subj=<?php echo $row['id'];?>');activateOnclick(<?php echo $row['id'];?>);" style="width:100%;"><?php echo wordwrap($row['subject_name'],30,"<br>")." ({$ChapterCounts})";?></div>
					<span style="padding:10px 10px;"><i class="fa fa-edit"></i></span>
				</div>
					<br>
				<?php
			}
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