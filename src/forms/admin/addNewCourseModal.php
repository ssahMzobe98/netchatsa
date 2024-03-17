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
  $uniAdminPdo = PDOAdminFactory::make(ServiceConstants::UNI_ADMIN_PDO,[$userPdo->connect]);
  $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	if(isset($_POST['ddd'])){
			?>
			<style>
				.bosos{
					width:100%;
					padding: 10px 10px;
					color: white;
				}
				.bosos input,select{
					width: 100%;
					padding: 10px 10px;
					border-radius: 100px;
					border:none;
					border-bottom: 2px solid rebeccapurple;
					border-top: 2px solid mediumvioletred;
					color:#ddd;
					background: #11101d;
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
				.duo{
					padding:10px 10px;
					border-radius:10px;
					border:1px solid rebeccapurple;
					color: rebeccapurple;
					cursor: pointer;
				}
				.duo:hover{
					border:1px solid mediumvioletred;
					color: mediumvioletred;
				}
			</style>
			<div class="bosos">
				<label>Institution Name</label>
				<select class="selectInstitution">
					<option value=""> -- Select Institution -- </option>
					<?php
					$fff=$uniAdminPdo->masomaneGetInstitution();
						foreach($fff as $row){
							echo"<option value='{$row['id']}'>{$row['institutions']}</option>";
						}
					?>
				</select>
			</div>
			<div class="bosos">
				<label>Select Course</label>
				<select class="selectCourse">
					<option value=""> -- Select Course -- </option>
					<?php
					$fff=$uniAdminPdo->masomaneGetUniCourses();
						foreach($fff as $row){
							echo"<option value='{$row['id']}'>{$row['course_name']}</option>";
						}
					?>
				</select>
			</div>
			<div class="bosos">
				<span class="duo" onclick="saveNewFunding()">Save</span>
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
		window.location=("../");
	</script>

	<?php
}
?> 