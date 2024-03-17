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
  // $tertiaryApplicationsPdo = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
  $projectTicketAdminPdo = PDOAdminFactory::make(ServiceConstants::PROJECT_TICKET_ADMIN,[$userPdo->connect]);
  $adminPdo = PDOServiceFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
	if($url==$userDirect){
			$dataResponse['Disabled'] = $projectTicketAdminPdo->maSomaneGetProject(1);
			$dataResponse['Active'] = $projectTicketAdminPdo->maSomaneGetProject(2);
			$dataResponse['Done'] = $projectTicketAdminPdo->maSomaneGetProject(3);

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
					height: 60vh;
					overflow-y: scroll;
  				white-space: nowrap;
  				word-wrap: break-word;
  				hyphens: auto;
	  				
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
					height: 60vh;
					overflow-y: scroll;
  				white-space: nowrap;
  				word-wrap: break-word;
  				hyphens: auto;
	  				

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
					height: 60vh;
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
					padding: 5px 5px;
					white-space: nowrap;
  				word-wrap: break-word;
  				hyphens: auto;
  				overflow-wrap: break-word;
  				-ms-word-break: break-all;
    			word-break: break-all;

				}
			</style>
			<div class="diagnose">
				<div class="stableLeft">
					<div class="DataSetLeft">
						<div class="roadData">
							<center><span class="depalrto">- - - - Disabled Projects - - - -</span></center>
							<div class="simpleData">
								<?php
									if(count($dataResponse['Disabled'])==0){
										echo"No data to display";
									}
									foreach($dataResponse['Disabled'] as $data){
										$project_id = $data['project_id']??"";
										$project_name = $data['project_name'].'-MMS'.$project_id??"";
										$project_sprint = $data['project_sprint']??"";
										$project_description = $data['project_description']??"";
										$project_phase = $data['project_phase']??"";
										$added_by = $data['added_by']??"";
										$time_added = $data['time_added']??"";
										$status = $data['status']??"";
											?>
												<div onclick="loadAfterQuery('.DataSetCenter','../src/forms/admin/showProjectTickets.php?project=<?php echo $project_id;?>');" title="<?php echo $project_description;?>" class="box-shadow soloVp voshoDupop<?php echo $project_id;?>">
													<div class="projectElo"><?php echo $project_name;?></div>
													<div class="projectElo"><?php echo "Sprint-".$project_sprint;?></div>
													<div class="projectElo"><?php echo $adminPdo->add3dots($project_description,'...',15);?></div>
												</div>
												
											<?php
									}
								?>
							</div>	
						</div>
						<div class="roadData">
							<center><span class="depalrto">- - - - Active Projects - - - -</span></center>
							<div class="simpleData">
								<?php
									if(count($dataResponse['Active'])==0){
										echo"No data to display";
									}
									foreach($dataResponse['Active'] as $data){
										$project_id = $data['project_id']??"";
										$project_name = $data['project_name'].'-MMS'.$project_id??"";
										$project_sprint = $data['project_sprint']??"";
										$project_description = $data['project_description']??"";
										$project_phase = $data['project_phase']??"";
										$added_by = $data['added_by']??"";
										$time_added = $data['time_added']??"";
										$status = $data['status']??"";
											?>
												<div onclick="loadAfterQuery('.DataSetCenter','../src/forms/admin/showProjectTickets.php?project=<?php echo $project_id;?>');" title="<?php echo $project_description;?>" class="box-shadow soloVp voshoDupop<?php echo $project_id;?>">
													<div class="projectElo"><?php echo $project_name;?></div>
													<div class="projectElo"><?php echo "Sprint-".$project_sprint;?></div>
													<div class="projectElo"><?php echo $adminPdo->add3dots($project_description,'...',15);?></div>
													
												</div>
												
											<?php
									}
								?>
							</div>
						</div>
						<div class="roadData">
							<center><span class="depalrto">- - - - Completed Projects - - - -</span></center>
							<div class="simpleData">
								<?php
									if(count($dataResponse['Done'])==0){
										echo"No data to display";
									}
									foreach($dataResponse['Done'] as $data){
										$project_id = $data['project_id']??"";
										$project_name = $data['project_name'].'-MMS'.$project_id??"";
										$project_sprint = $data['project_sprint']??"";
										$project_description = $data['project_description']??"";
										$project_phase = $data['project_phase']??"";
										$added_by = $data['added_by']??"";
										$time_added = $data['time_added']??"";
										$status = $data['status']??"";
											?>
												<div onclick="loadAfterQuery('.DataSetCenter','../src/forms/admin/showProjectTickets.php?project=<?php echo $project_id;?>');" title="<?php echo $project_description;?>" class="box-shadow soloVp voshoDupop<?php echo $project_id;?>">
													<div class="projectElo"><?php echo $project_name;?></div>
													<div class="projectElo"><?php echo "Sprint-".$project_sprint;?></div>
													<div class="projectElo"><?php echo $adminPdo->add3dots($project_description,'...',15);?></div>
												</div>
												
											<?php
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="stableCenter">
					<div class="DataSetCenter">
						No Data to display
					</div>
				</div>
				<div class="stableRight">
					<div class="DataSetRight">
						No Data to display
					</div>
				</div>
			</div>

		  <?php
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