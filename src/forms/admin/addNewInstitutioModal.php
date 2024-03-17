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
				<label>Institution Name</label>
				<input type="text" class="TextNewInstitution" placeholder="Add New Institution..">
			</div>
			<div class="bosos">
				<label>Institution API Link</label>
				<input type="text" class="TextNewInstitutionApiLink" placeholder="Add Institution API link">
			</div>
			<div class="bosos">
				<label>Institution API Key</label>
				<input type="text" class="TextNewInstitutionAPIKey" placeholder="Add API Key">
			</div>
			<div class="bosos">
				<label>Institution API Key2</label>
				<input type="text" class="TextNewInstitutionAipKey2" placeholder="Add API Key 2">
			</div>
			<div class="bosos">
				<label>Institution TOKEN</label>
				<input type="text" class="TextNewInstitutiontoken" placeholder="Add Token">
			</div>
			<div class="bosos">
				<button type="button" class="btn btnStyilng" onclick="saveInsititution()">Save</button>
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