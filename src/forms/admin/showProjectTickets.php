<?php
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['masomane'])){
	require_once("../controller/pdo.php");
	$pdo=new _pdo_();
	$cur_user_row =$pdo->userInfo($_SESSION['masomane']);
	$userDirect=$cur_user_row['user_nav'];
	$url = explode("/",$_SERVER['REQUEST_URI']);
	$url=$url[count($url)-4]."/".str_replace("%20", " ",$url[count($url)-3]);
	
	if($url==$userDirect){
		if(isset($_GET['project'])&&$_GET['project']>0){
			$project = $pdo->OMO($_GET['project']);
			$tickets = $pdo->maSomaneGetThisProjectTicket($project);
			
			if(count($tickets)==0){
				echo"No data to display";
			}
			foreach($tickets as $data){
// ticket_status_id

// project_id

// ticket_weight

// added_by

// logo
// user_id
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
							<span style="display: flex;" onclick="loadAfterQuery('.DataSetRight','./model/showTickets.php?ticket=<?php echo $ticket_id;?>');">
								<div class="projectElo"><?php echo $ticketName;?></div>
								<div class="projectElo"><?php echo $pdo->add3dots($ticket_description,'...',15);?></div>
							</span>
							<input type="hidden" class="ticket_id" value="<?php echo $ticket_id;?>">
							
							<div class="projectElo clasIOn" title="<?php echo $data['status'];?>">
								<select class="ticket_status" style="padding:3px 3px;">
									<option value="" style="color:green;"><?php echo $status;?></option>
									<?php echo $pdo->getStatuses();?>
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
				window.location=("../../?Yazi uyajwayela wena!!, Stop trying to access somebody's account through your own login details.");
			</script>
		<?php
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