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
  	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
  	$cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$matricUpgradeAdminPdo = PDOAdminFactory::make(ServiceConstants::MATRIC_UPGRADE_ADMIN,[$userPdo->connect]);
		if(isset($_GET['subj'])){
			$subj = $cleanData->OMO($_GET['subj']);
			?>
			<label>Chapter Name</label>
			<select class="subjectChapter">
				 <option value=""> - - Select Chapter - - </option>
				 <?php
				 $getMatricUpgradeSubjChapters = $matricUpgradeAdminPdo->masomaneGetMatricUpgradeSubjChapters($subj);
				 foreach($getMatricUpgradeSubjChapters as $row){
				 	 echo"<option value='{$row['id']}'>{$row['chapter']}</option>";
				 }
				 ?>
			</select>
			<?php
		}
		else{
			echo'UKNOWN REQUEST!!..';
		}
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../?fghfghfghgfh");
	</script>

	<?php
}
?> 