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
		if(isset($_GET['campus'])&&$_GET['campus']>0){
			$campus = $pdo->OMO($_GET['campus']);
			$faculties = $pdo->masomaneGetUniFacultyInfo($campus);
			
			if(count($faculties)==0){
				echo"No data to display";
			}
			foreach($faculties as $data){
					?>
						<div class="box-shadow soloVp">
							<span style="display: flex; cursor: pointer;white-space: nowrap;word-wrap: break-word;hyphens: auto;overflow-wrap: break-word;-ms-word-break: break-all;word-break: break-all;clear: both;vertical-align: bottom;width:100%;" onclick="loadAfterQuery('.DataSetRight-b','./model/courses.php?course=<?php echo $data['faculty_id'];?>');">
								<div class="projectElo"><?php echo wordwrap($data['faculty_name'],37,"<br>\n");?></div>
							</span>
							<span title="Edit Faculty" style="padding:10px 10px;cursor: pointer;"><i onclick="fa_fa_edit_campus('<?php echo $data['faculty_id'];?>')" class="fa fa-edit"></i></span>
										<!-- <span title="Delete Campus" style="padding:10px 10px;cursor: pointer;"><i onclick="fa_fa_delete_campus('<?php //echo $row['campus_id'];?>')" class="fa fa-trash"></i></span> -->
							
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