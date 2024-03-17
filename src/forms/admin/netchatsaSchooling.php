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
  // $matricUpgradeAdminPdo = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_ADMIN,[$userPdo->connect]);
  $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
		?>
		<style>
			.titlePort{
				width: 100%;
				padding: 5px 5px;
				display: flex;
			}
			.toggleBtn{
				padding: 10px 10px;
			}
			#toggleBtn{
				padding: 5px 10px;
				border-radius: 100px;
			}
			.displayerBoard{
				width: 100%;
				padding: 5px 5px;
				display: flex;
			}
			.displayLeft{
				width:33.5%;
				padding: 5px 10px;
			}
			.displayerBoardCenter{
				width:33.5%;
				padding: 5px 10px;
			}
			.displayRight{
				width:33.5%;
				padding: 5px 10px;
			}
			.displayMacLeft{
				width: 100%;
				padding: 5px 5px;
				border-radius: 10px;
				border-right: 2px solid rebeccapurple;
				border-left: 2px solid mediumvioletred;
				overflow-y: scroll;
				white-space: nowrap;
				word-wrap: break-word;
				hyphens: auto;
				height: 68vh;
				justify-content: space-between;
	  				
					/*border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;*/
			}
			.displayMacLeft::-webkit-scrollbar{
				  width:1px;
			}
			.displayMacLeft::-webkit-scrollbar-thumb {
			  background: red; 
			  border-radius: 10px;
			}
			.displayMacCenter{
				width: 100%;
				padding: 5px 5px;
				border-radius: 10px;
				border-right: 2px solid rebeccapurple;
				border-left: 2px solid mediumvioletred;
				overflow-y: scroll;
				white-space: nowrap;
				word-wrap: break-word;
				hyphens: auto;
				height: 68vh;
				justify-content: space-between;
	  				
					/*border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;*/
			}
			.displayMacCenter::-webkit-scrollbar{
				  width:1px;
			}
			.displayMacCenter::-webkit-scrollbar-thumb {
			  background: red; 
			  border-radius: 10px;
			}
			.displayMacRight{
				width: 100%;
				padding: 5px 5px;
				border-radius: 10px;
				border-right: 2px solid rebeccapurple;
				border-left: 2px solid mediumvioletred;
				overflow-y: scroll;
				white-space: nowrap;
				word-wrap: break-word;
				hyphens: auto;
				height: 68vh;
				justify-content: space-between;
	  				
					/*border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;*/
			}
			.displayMacRight::-webkit-scrollbar{
				  width:1px;
			}
			.displayMacRight::-webkit-scrollbar-thumb {
			  background: red; 
			  border-radius: 10px;

			}
			.searchIdDom{
				width: 15%;
				border-bottom:2px solid rebeccapurple;;
				border-radius: 100px;

				
			}
			.searchIdDom input,select{
				width:100%;
				padding: 7px 10px;
				border:none;
				background: none;
				color: #ddd;
				border-radius: 100px;


			}
			.selectClassField{
				background: #11101d;
			}

		</style>
		<div class="titlePort">
			<div class="toggleBtn">
				<span id="toggleBtn" class="badge badge-primary text-white text-center" data-bs-toggle="modal" data-bs-target="#addNetchatsaSubjects">Add Subject</span>
			</div>
			<div class="toggleBtn">
				<span id="toggleBtn" class="badge badge-dark text-white text-center">Add Chapter</span>
			</div>
			<div class="toggleBtn">
				<span id="toggleBtn" class="badge badge-success text-white text-center">Add Content</span>
			</div>
			<div class="searchIdDom" style="width: 20%;">
					<input type="search" class="searchNetchatsaSubject" placeholder="Find Netchatsa Subject.." id="searchNetchatsaSubject" oninput="searchNetchatsaSubject()">
			</div>
			<div style="width:2%;"></div>
			<div class="searchIdDom">
					<select class="selectClassField">
						<option value=""> -- Filter Display --</option>
						<option value="gr12">Grade 12</option>
						<option value="gr11">Grade 11</option>
						<option value="gr10">Grade 10</option>
						<option value="gr9"> Grade 9</option>
						<option value="gr8"> Grade 8</option>
					</select>
			</div>
				
		</div>
		<div class="displayerBoard">
			<div class="displayLeft">
				<div class="displayMacLeft" id="displayMacLeft"></div>
			</div>
			<div class="displayerBoardCenter">
				<div class="displayMacCenter" id="displayMacCenter"></div>
			</div>
			<div class="displayRight">
					<div class="displayMacRight" id="displayMacRight"></div>
			</div>
		</div>
		<script>
			loadAfterQuery('.displayMacLeft','../src/forms/admin/displayNetchatsaSubjects.php');
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