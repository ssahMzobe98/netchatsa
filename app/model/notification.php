<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['usermail'])){
    require_once("../controller/pdo.php");
    $pdo=new _pdo_();
    $cur_user_row =$pdo->userInfo($_SESSION['usermail']);
    $userDirect=$cur_user_row['directory_index'];
    $url = explode("/",$_SERVER['REQUEST_URI']);
    $url=str_replace("%20", " ",$url[2]);
    if($url==$userDirect){
		if(isset($_POST['limit'],$_POST['start'])){
			$limit= $pdo->OMO($_POST['limit']);
			$start= $pdo->OMO($_POST['start']);
			$my_id= $cur_user_row['my_id'];
			$response=$pdo->fetchAllNotifications($limit,$start,$my_id);
			?>
			<style>
				.bodyTag{
					
					height: auto;
					width: 100%;
					box-shadow: -3px 4px 6px 6px black;
					background-color: #212121;
					color: #45f3ff;
					


				}
				.topic{
					padding: 2px 2px;
				}
				.date{
					padding: 2px 2px;
				}
				.seen{
					padding: 2px 2px;
				}
				.topicSnit{
					width: 100%;
					border-bottom: 2px solid #45f3ff;
					display: flex;
					padding: 0 10px;
				}
				.show_all{
					padding: 10px 10px;
				}
			</style>
			<?php
			foreach($response as $row){
				$topic=$row['topic'];
				$message=$row['notification'];
				$time_sent=$row['time_sent'];
				$isRead=($row['is_read']==1)?"seen":"new";
				$pdo->updateSeeingPost($row['id']);
				?>
				<div class="bodyTag">
					<div class="topicSnit flex">
						<div class="topic"><?php echo $topic;?></div>
						<div class="date"><?php echo $time_sent;?></div>
						<div class="seen"><?php echo $isRead;?></div>
					</div>
					<div class="show_all">
						<?php echo $message;?>
					</div>
				</div>
				<br>


				<?php
			}
		}	
		else{
			echo"BAD REQUEST!!..";
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
		window.location=("../../");
	</script>

	<?php
}
?>