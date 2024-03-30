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
		if(isset($_POST['ddd'])){
			?>
			<style>
				.bosos{
					width:100%;
					padding: 10px 10px;
					color: white;
				}
				.bosos input{
					width: 100%;
					padding: 10px 10px;
					border-radius: 100px;
					border:none;
					border-bottom: 2px solid rebeccapurple;
					border-top: 2px solid mediumvioletred;
					color:#ddd;
					background: none;
				}
				.bosos .btnStyilng{
					padding: 10px 10px;
					background: none;
					border-radius: 100px;
					border:2px solid rebeccapurple;
					color: white;
				}
				.bosos .btnStyilng:hover{
					border:2px solid mediumvioletred;
					color: mediumvioletred;
					background: none;
				}
			</style>
			<div class="bosos">
				<label>Subject Name</label>
				<select class="subjectName">
					 <option value=""> - - Select Subject - - </option>
					 <?php
					 $masomaneGetMatricUpgradeSubjects = $matricUpgradeAdminPdo->masomaneGetMatricUpgradeSubjects();
					 foreach($masomaneGetMatricUpgradeSubjects as $row){
					 	 echo"<option value='{$row['id']}'>{$row['subject_name']}</option>";
					 }
					 ?>
				</select>
			</div>
			<div class="bosos">
				<label>Chapter</label>
				<input type="text" class="TextChapter" placeholder="Add Chapter...">
			</div>
			<div class="bosos">
				<button type="button" class="btn btnStyilng" onclick="saveMatricUpgradeNewChapter()">Save</button>
			</div>
			<div class="bosos">
				<div class="error-logSettup" hidden></div>
			</div>
			
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
		window.location=("../?fghfghfghgfh");
	</script>

	<?php
}
?> 