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
			.homeSetter{
				width: 100%;
				display: flex;
			}
			.sususu{
				width: 40%;
				padding: 10px 10px;
			}
			.sususui{
				width: 20%;
				padding: 10px 10px;
			}
			.sususu input{
				width:100%;
				padding: 10px 10px;
				background: none;
				border:none;
				border-radius: 100px;
				border-top: 2px solid mediumvioletred;
				border-bottom: 2px solid rebeccapurple;
				color: white;
			}
			.dud:hover{
				box-shadow: 3px 5px 4px #000;
			}
			.bororo{
				width: 100%;
				padding: 10px 10px;
				display: flex;

			}
			.displayInstitutions{
				width:30%; 
				padding: 10px 10px;
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
				.displayInstitutions::-webkit-scrollbar{
				  width:1px;
				}
				.displayInstitutions::-webkit-scrollbar-thumb {
				  background: red; 
				  border-radius: 10px;
				}
				.dataDisplayerIdr{
					width: 100%;

				}
				.ff{width:45%;}

		</style>
		<div class="homeSetter">
			<div class="das" style="width: 100%;display: flex;">
				<div class="sususu">
					<input type="search" class="SearchSubjectMatricUpgrade" id="SearchSubjectMatricUpgrade" placeholder="Search Subject Matric Upgrade.." oninput="SearchSubjectMatricUpgrade()"> 
				</div>  
			</div>
			<div class="sususui">
				<span class="dud" style="padding:10px 10px;cursor:pointer;text-align: center;background: none;border-radius: 100px;border-top: 1px solid rebeccapurple;border-bottom: 1px solid mediumvioletred;" class="bthnGurur" onclick="addMatricUpgradeNewChapter()">Add Chapter</span>
			</div>
			<div class="sususui">
				<span class="dud" style="padding:10px 10px;cursor:pointer;text-align: center;background: none;border-radius: 100px;border-top: 1px solid rebeccapurple;border-bottom: 1px solid mediumvioletred;" class="bthnGurur" onclick="AddNewContent()">Add Content</span>
			</div>
			
		</div>
		<div class="bororo">
			  <div class="displayInstitutions" >
					<div style="padding: 10px 10px;color: #ddd;border-radius:10px;border-bottom: 2px solid mediumvioletred;text-align: center;"> - - - Matric Upgrade Subjects - - - </div>
					<div style="border-bottom: 2px dotted mediumpurple;width:100%;padding: 5px 0;"></div>
					<div class="dataDisplayerIdrMatricUpgradeSubjects" id="dataDisplayerIdrMatricUpgradeSubjects"></div>
				</div>
				<div style="width:2%;"></div>
				<div class="displayInstitutions" >
					<div style="padding: 10px 10px;color: #ddd;border-radius:10px;border-bottom: 2px solid mediumvioletred;text-align: center;"> - - - Subject Chapters - - - </div>
					<div style="border-bottom: 2px dotted mediumpurple;width:100%;padding: 5px 0;"></div>
					<div class="displaySubjectChapters" id="displaySubjectChapters"></div>
				</div>
				<div style="width:2%;"></div>
				<div class="displayInstitutions ff" >
					<div style="padding: 10px 10px;color: #ddd;border-radius:10px;border-bottom: 2px solid mediumvioletred;text-align: center;"> - - - Chapter Content - - - </div>
					<div style="border-bottom: 2px dotted mediumpurple;width:100%;padding: 5px 0;"></div>
					<div class="displaySubjectChaptersContent" id="displaySubjectChaptersContent"></div>
				</div>
		</div>
		<script>
			 loadAfterQuery(".dataDisplayerIdrMatricUpgradeSubjects","../src/forms/admin/dataDisplayerIdrMatricUpgradeSubjects.php");
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