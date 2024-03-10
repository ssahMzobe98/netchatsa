<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$notification = PDOServiceFactory::make(ServiceConstants::NOTIFICATION_PDO,[$userPdo->connect]);
	$cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
	$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
		if(isset($_POST['limit'],$_POST['start'])){
			$limit= $cleanData->OMO($_POST['limit']);
			$start= $cleanData->OMO($_POST['start']);
			$my_id= $cur_user_row['my_id'];
			$response=$notification->fetchAllNotifications($limit,$start,$my_id);
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
			if(empty($response)){
				echo"<h5 stye='text-align:center;'>No notifications available yet.</h5>";
			}
			foreach($response as $row){
				$topic=$row['topic'];
				$message=$row['notification'];
				$time_sent=$row['time_sent'];
				$isRead=($row['is_read']==1)?"seen":"new";
				$notification->updateSeeingPost($row['id']);
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
		window.location=("../../");
	</script>

	<?php
}
?>