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
		?>
		<style>
			.topicHorizontal{
				width:100%;
				padding: 10px 10px;
				overflow-x: scroll;
  				white-space: nowrap;
  				word-wrap: break-word;
  				hyphens: auto;
  				display: flex;
			}
			.topicHorizontal::-webkit-scrollbar{
			  height:5px;
			}
			.topicHorizontal::-webkit-scrollbar-thumb {
			  background: red; 
			  border-radius: 10px;
			}
			.topicHorizontal .margin_SetterTop{
				padding: 2px 10px;
			}
			.topicHorizontal .margin_SetterTop .span-asset{
				padding: 10px 10px;
				border:1px solid #ddd;
				border: 100px;
				color:#ddd;
				text-align: center;
			}
			
		</style>
		<div class="topicHorizontal">
			<div class="margin_SetterTop">
				<span class="badge badge-success text-white text-center span-asset" onclick='loadAfterQuery(".bodyMagnitude","./model/myWork.php")'>My Work</span>
			</div>
			<div class="margin_SetterTop">
				<span class="badge badge-secondary text-white text-center span-asset" onclick='loadAfterQuery(".bodyMagnitude","./model/Projects.php")'>Projects</span>
			</div>
			<div class="margin_SetterTop">
				<span class="badge badge-primary text-white text-center span-asset" onclick='loadAfterQuery(".bodyMagnitude","./model/teamWork.php")'>Team Work</span>
			</div>
			<div class="margin_SetterTop">
				<span class="badge badge-dark text-white text-center span-asset" onclick="CreateNewTicket()">New Ticket</span>
			</div>
		</div>
		<div class="bodyMagnitude">
			
		</div>
		<script>
			loadAfterQuery(".bodyMagnitude","./model/myWork.php");
		</script>


		<?php
	}
	else{
		session_destroy();
		?>
			<script>
				window.location=("../../../?Yazi uyajwayela wena!!, Stop trying to access somebody's account through your own login details.");
			</script>
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