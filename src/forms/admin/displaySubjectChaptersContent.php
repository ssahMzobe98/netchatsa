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
		if(isset($_GET['chapter'])){
			$chapter = $cleanData->OMO($_GET['chapter']);
			$getMatricUpgradeSubjChaptersContent = $matricUpgradeAdminPdo->masomaneGetMatricUpgradeSubjChaptersContent($chapter);
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
				.radeMos{
					width: 100%;
				}
			</style>
			
			<?php
			if(count($getMatricUpgradeSubjChaptersContent)==0){
				echo"<h3>No Content found..</h3>";
			}
			else{
				foreach($getMatricUpgradeSubjChaptersContent as $row){
					?>
					<div class="izikoleZakithi box-shadow">
						<div class="radeMos deleteThisContent<?php echo $row['id']; ?>" >
               <iframe style="width:100%;" src="<?php echo $row['content'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                <h4><?php echo wordwrap($row['title'] ,37,"<br>");?> <span class="badge badge-danger text-white text-center deleteThisContent<?php echo $row['id']; ?>" onclick="removeContentFromDb('<?php echo $row['id'];?>')"><i class="fa fa-trash"></i></span></h4>
               <small><?php echo wordwrap("disclaimer:this content does not belong to netchatsa, it is owned by {$row['source']}",60,"<br>");?>.</small>
    		    </div>
						<!-- <span style="padding:10px 10px;"><i class="fa fa-edit"></i></span> -->
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