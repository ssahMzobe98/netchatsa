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
  	// $cleanData = PDOAdminFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		// $schoolAdminPdo = PDOAdminFactory::make(ServiceConstants::SCHOOL_ADMIN_PDO,[$userPdo->connect]);
		// $adminPdo = PDOAdminFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
			?>
			<style>
				.AsivezeIzikoleLapha{
					width:100%;
					padding: 10px 10px;
					display: flex;
				}
				.AsivezeIzikoleLaphaLeft{
					width:30%;
					height: 68vh;
					padding: 10px 10px;
					overflow-x: scroll;
					white-space: nowrap;
					word-wrap: break-word;
					hyphens: auto;
/*					display: flex;*/
				}
				.AsivezeIzikoleLaphaLeft::-webkit-scrollbar{
				  width:5px;
				}
				.AsivezeIzikoleLaphaLeft::-webkit-scrollbar-thumb {
				  background: red;
				  border-radius: 10px;
				}
				.topSchoolsSearch{
					width: 30%;
					padding: 10px 10px;

				}
				.topSchoolsSearch input{
					width: 100%;
					padding: 10px 10px;
					border:none;
					background: none;
					border-radius: 100px;
					border-bottom: 2px solid rebeccapurple;
					border-top:2px solid mediumvioletred;
				}
				.AsivezeIzikoleLaphaRight{
					padding: 10px 10px;
					width:30%;

				}
				.AsivezeIzikoleLaphaRight .randOffInput{
					padding: 10px 10px;
					width:100%;
				}
				.AsivezeIzikoleLaphaRight .randOffInput input{
					padding: 10px 10px;
					width:100%;
					background: none;
					border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;
					border-radius: 100px;
				}
				.AsivezeIzikoleLaphaRight .randOffInput .classmatter{
					padding: 10px 10px;
				}
			</style>
			<div class="topSchoolsSearch">
				<input type="search" class="searchInputSchool" id="searchInputSchool" oninput="searchInputSchool()" placeholder="Search School..">
			</div>
			<div class="AsivezeIzikoleLapha">
				<div class="AsivezeIzikoleLaphaLeft" id='AsivezeIzikoleLaphaLeft'></div>
				<div class="AsivezeIzikoleLaphaRight">
					<div class="randOffInput">
						<input type="text" class="schoolNameInput" placeholder="Enter School Name">
					</div>
					<div class="randOffInput">
						<span class="badge badge-primary text-white text-center classmatter" onclick="saveSchoolName()">Save</span>
					</div>
					<div class="randOffInputError"></div>
				</div>
			</div>
			<script>
				loadAfterQuery(".AsivezeIzikoleLaphaLeft","../src/forms/admin/AsivezeIzikoleLaphaLoader.php");
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