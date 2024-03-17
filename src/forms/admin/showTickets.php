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
		if(isset($_GET['ticket'])&&$_GET['ticket']>0){
			$ticket = $pdo->OMO($_GET['ticket']);
			$ticket = $pdo->masomaneGetThisTicket($ticket);

			if(count($ticket)==0){
				echo"No data to display";
			}
				$ticket_id = $ticket['ticket_id']??"";
				$ticketName= 'MMS-'.$ticket_id??'';
				$ticket_description = $ticket['ticket_description']??"";
				$project_sprint = $ticket['project_sprint']??"";
				$ticket_details = $ticket['ticket_details']??"";
				$status = "<span style='color:green;'>".$ticket['status']."</span>";
				$assigned_to = $ticket['assigned_to']??'NOT ASSIGNED';
				$img = $ticket['logo']??'';
				$dir = "../../img/profile.jpg";
				if($assigned_to!="NOT ASSIGNED" && !empty($img)){
					$dir = "../../img/all/{$img}";
				}
					?>
						<div style="width:100%;display: block;overflow-wrap: break-word;-ms-word-break: break-all;word-break: break-all;" title="<?php echo $ticket_description;?>" class="box-shadow">
							<div style="padding:10px 10px;width: 100%;display: flex;">
								<div style="padding:10px 10px;width:50px;height:50px;">
									<img style="width:100%;height:100%;padding:10px 10px;" src="<?php echo $dir?>">
								</div>
								<div >
									<?php echo $assigned_to;?>
								</div>
							</div>
							<div style="font-style: bold;font-weight: bolder;font-size: 13px; width:100%;overflow-wrap: break-word;border:2px solid green;-ms-word-break: break-all;word-break: break-all;"><?php echo $ticketName." | ".$ticket_description;?></div>
							<br>
									<?php echo $ticket_details;?>
						</div>
						<script>
							$(document).ready(function(){
								$("img").attr("style","width:100%;");
							});
						</script>
					<?php
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