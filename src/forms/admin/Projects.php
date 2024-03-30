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
			.topicHorizontalf{
				width:100%;
				padding: 10px 10px;
				overflow-x: scroll;
				white-space: nowrap;
				word-wrap: break-word;
				hyphens: auto;
				display: flex;
			}
			.topicHorizontalf::-webkit-scrollbar{
			  height:5px;
			}
			.topicHorizontalf::-webkit-scrollbar-thumb {
			  background: red;
			  border-radius: 10px;
			}
			.topicHorizontalf .margin_SetterTop{
				padding: 2px 10px;
			}
			.topicHorizontalf .margin_SetterTop .span-asset{
				padding: 2px 10px;
				border:1px solid #ddd;
				border: 100px;
				color:#ddd;
				text-align: center;
			}
			.projectName,.Decription,.Sprint{
				width:100%;
				padding: 5px 10px;
				border:none;
				border-radius: 100px;
				color: #ddd;
				background: none;
				border-bottom: 2px solid rebeccapurple;
				border-top: 2px solid mediumvioletred;
			}
			.btn{
				padding:5px 10px;
				color:white;
				border: none;
				border-bottom: 2px solid purple;
				border-top: 2px solid blue;
			}
			.btn:hover{
				border-bottom: 2px solid rebeccapurple;
				border-top: 2px solid mediumvioletred;
				color:purple;
			}
			textarea{
				height:37px;
			}
			textarea::-webkit-scrollbar{
			  width:5px;
			}
			textarea::-webkit-scrollbar-thumb {
			  background: red;
			  border-radius: 10px;
			}
		</style>
		<div class="topicHorizontalf">
			<div class="margin_SetterTop">New Project : </div>
			<div class="margin_SetterTop">
				<input type="text" class="projectName" place placeholder="Prject Name (ie. MaSomane)">
			</div>
			<div class="margin_SetterTop">
				<textarea type="text" class="Decription" place placeholder="Project Description (ie. Developing interphase of netchatsa)"></textarea>
			</div>
			<div class="margin_SetterTop">
				<input type="number" class="Sprint" place placeholder="Sprint Number (ie. 33)">
			</div>
			<div class="margin_SetterTop">
				<button type="button" class="btn" onclick="saveNewProject()">Save Project</button>
			</div>
			<div class="margin_SetterTop">
				<span class="error-logSettup" hidden></span>
			</div>

		</div>
		<div class="ProjectbodyMagnitude"></div>
		<script>
			loadAfterQuery(".ProjectbodyMagnitude","../src/forms/admin/allProjects.php");
		</script>
		<?php
	}
	else{
		session_destroy();
		?>
			<script>
				window.location=("../../../Yazi uyajwayela wena!!, Stop trying to access somebody's account through your own login details.");
			</script>
		<?php
	}
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../../fghfghfghgfh");
	</script>

	<?php
}
?> 