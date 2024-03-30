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
  	$cleanData = PDOAdminFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$adminPdo = PDOServiceFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
		$ProjectTicketAdminPdo = PDOAdminFactory::make(ServiceConstants::PROJECT_TICKET_ADMIN,[$userPdo->connect]);
		if(isset($_GET['project'])&&$_GET['project']>0){
			$project = $cleanData->OMO($_GET['project']);
			$tickets = $ProjectTicketAdminPdo->maSomaneGetThisProjectTicket($project);
			if(count($tickets)==0){
				echo"No data to display";
			}
			foreach($tickets as $data){
				$ticket_id = $data['ticket_id']??"";
				$ticketName= 'MMS-'.$ticket_id??'';
				$ticket_description = $data['ticket_description']??"";
				$project_sprint = $data['project_sprint']??"";
				$ticket_details = $data['ticket_details']??"";
				$status = "<span style='color:green;'>".$data['status']."</span>";
				$assigned_to = $data['assigned_to']??'NOT ASSIGNED';
				$img = $data['logo']??'';
				$dir = "../../img/profile.jpg";
				if($assigned_to!="NOT ASSIGNED" && !empty($img)){
					$dir = "../../img/all/{$img}";
				}
					?>
						<div title="<?php echo $ticket_description;?>" class="box-shadow soloVp voshoDupop<?php echo $ticket_id;?>">
							<span style="display: flex;" onclick="loadAfterQuery('.DataSetRight','../src/forms/admin/showTickets.php?ticket=<?php echo $ticket_id;?>');">
								<div class="projectElo"><?php echo $ticketName;?></div>
								<div class="projectElo"><?php echo $adminPdo->add3dots($ticket_description,'...',15);?></div>
							</span>
							<input type="hidden" class="ticket_id" value="<?php echo $ticket_id;?>">
							
							<div class="projectElo clasIOn" title="<?php echo $data['status'];?>">
								<select class="ticket_status" style="padding:3px 3px;">
									<option value="" style="color:green;"><?php echo $status;?></option>
									<?php echo $ProjectTicketAdminPdo->getStatuses();?>
								</select>		
							</div>
							<div style="width:110px;height:55px;border-radius: 100%;padding: 5px 5px;" title="<?php echo $assigned_to;?>">
								<img style="width:100%;height:100%;border-radius:100%;padding: 10px 10px;" src="<?php echo $dir;?>">
							</div>
							
						</div>
						
					<?php
			}
		}
		else{
			echo"BAD REQUEST!!";
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