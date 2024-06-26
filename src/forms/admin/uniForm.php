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
		$UniAdminPdo = PDOAdminFactory::make(ServiceConstants::UNI_ADMIN_PDO,[$userPdo->connect]);
		if(isset($_GET['uni_id'])){
			$uniForm = $UniAdminPdo->masomaneGetUniInfo($cleanData->OMO($_GET['uni_id']??0));
			$campuses =$UniAdminPdo->masomaneGetUniCampusInfo($cleanData->OMO($_GET['uni_id']??0));
			$uni_name = $uniForm['uni_name']??'';
			?>
			<style>
				.diagnose{
					width:100%;
					display:flex;
				}
				.stableLeft{
					width: 33.5%;
					padding: 10px 10px;
				}
				.stableCenter{
					width: 33.5%;
					padding: 10px 10px;
				}
				.stableRight{
					width: 33.5%;
					padding: 10px 10px;
				}
				.DataSetLeft{
					padding: 5px 5px;
					border-radius:10px;
					border-left: 2px solid rebeccapurple;
					border-right: 2px solid mediumvioletred;
/*					border-top: 2px solid mediumpurple;*/
					border-top-width: 70%;
					height: 74vh;
					overflow-y: scroll;
  				white-space: nowrap;
  				word-wrap: break-word;
  				hyphens: auto;
  				overflow-wrap: break-word;
  				-ms-word-break: break-all;
    			word-break: break-all;
	  				
					/*border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;*/
				}
				.DataSetLeft::-webkit-scrollbar{
				  width:1px;
				}
				.DataSetLeft::-webkit-scrollbar-thumb {
				  background: red; 
				  border-radius: 10px;
				}
				.DataSetCenter{
					padding: 5px 5px;
					border-radius:10px;
					border-left: 2px solid rebeccapurple;
					border-right: 2px solid mediumvioletred;
					
/*					border-top: 2px solid mediumpurple;*/
					border-top-width: 70%;
					height: 74vh;
					overflow-y: scroll;
  				white-space: nowrap;
  				word-wrap: break-word;
  				hyphens: auto;
  				overflow-wrap: break-word;
  				-ms-word-break: break-all;
    			word-break: break-all;
	  				

					/*border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;*/
				}
				.DataSetCenter::-webkit-scrollbar{
				  width:1px;
				}
				.DataSetCenter::-webkit-scrollbar-thumb {
				  background: red; 
				  border-radius: 10px;
				}
				.DataSetRight{
					padding: 5px 5px;
					border-radius:10px;
					border-left: 2px solid rebeccapurple;
					border-right: 2px solid mediumvioletred;
/*					border-top: 2px solid mediumpurple;*/
					border-top-width: 70%;
					height: 74vh;
					overflow-y: scroll;
  				white-space: nowrap;
  				word-wrap: break-word;
  				hyphens: auto;
  				overflow-wrap: break-word;
  				-ms-word-break: break-all;
    			word-break: break-all;
					/*border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;*/
				}
				.DataSetRight::-webkit-scrollbar{
				  width:1px;
				}
				.DataSetRight::-webkit-scrollbar-thumb {
				  background: red; 
				  border-radius: 10px;
				}
				.roadData{
					border-bottom: 2px dotted mediumpurple;
					padding: 10px 0;
					width: 100%;
					display: block;
				}
				.depalrto{
					padding: 10px 10px;
					border-bottom: 2px solid purple;
					border-radius: 10px;
					text-align: center;
				}
				.simpleData{
					padding: 10px 0;
				}
				.soloVp{
					padding: 10px 10px;
					display: flex;
					
					cursor: pointer;
				}
				.projectElo{
					width:100%;
					padding: 10px 10px;
					white-space: nowrap;
  				word-wrap: break-word;
  				hyphens: auto;
  				overflow-wrap: break-word;
  				-ms-word-break: break-all;
    			word-break: break-all;

				}
			</style>
			<center><span class="depalrto"><?php echo $uni_name;?></span></center>
			<div class="diagnose">
				<div class="stableLeft">
					<div class="DataSetLeft">
						<div class="roadData">
							<center><span class="depalrto">- - - - Campuses - - - -</span></center>
							<div class="simpleData"></div>	
						</div>
								<?php
								foreach($campuses as $row){
									?>
									<div  style="display: flex;" class="box-shadow">
										<div style="cursor: pointer;white-space: nowrap;word-wrap: break-word;hyphens: auto;overflow-wrap: break-word;-ms-word-break: break-all;word-break: break-all;clear: both;vertical-align: bottom;" class="projectElo" onclick="loadAfterQuery('.DataSetCenter-b','../src/forms/admin/faculties.php?campus=<?php echo $row['campus_id'];?>');"><?php echo $row['campus_name'];?>
											
										</div>
										<span title="Edit Campus" style="padding:10px 10px;cursor: pointer;"><i onclick="fa_fa_edit_campus('<?php echo $row['campus_id'];?>')" class="fa fa-edit"></i></span>
										<!-- <span title="Delete Campus" style="padding:10px 10px;cursor: pointer;"><i onclick="fa_fa_delete_campus('<?php //echo $row['campus_id'];?>')" class="fa fa-trash"></i></span> -->
									</div>

									<?php
								}
								?>		
					</div>
				</div>
				<div class="stableCenter">
					<div class="DataSetCenter">
						<div class="roadData">
							<center><span class="depalrto">- - - - Faculties - - - -</span></center>
							<div class="simpleData"></div>
						</div>
						<div class="DataSetCenter-b"></div>
					</div>
				</div>
				<div class="stableRight">
					<div class="DataSetRight">
						<div class="roadData">
							<center><span class="depalrto">- - - - Courses - - - -</span></center>
							<div class="simpleData"></div>
						</div>
						<div class="DataSetRight-b"></div>
					</div>
				</div>
			</div>


			<?php
		}
		else{
			?>
			<h3>BAD REQUEST!!!</h3>
			<?php
		}
	
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../../?fghfghfghgfh");
	</script>

	<?php
}
?> 