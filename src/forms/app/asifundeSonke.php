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
	$studyArea = PDOServiceFactory::make(ServiceConstants::STUDY_AREA_PDO,[$userPdo->connect]);
	$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
		$id=$cur_user_row['my_id'];
		if(isset($_POST['limit'])&&isset($_POST['start'])){
			//echo $_GET['min']." ".$_GET['max'];
			$response=$studyArea->getAsifundeSonke($_POST['start'],$_POST['limit'],$id);

			foreach($response as $row){
				$post_id=$row['post_id'];
				$text=$row['text'];
				$img=$row['img'];
				$video=$row['video'];
				$time_posted=$row['time_posted'];
				$posted_by=$row['posted_by'];
				$posted_by_info=$studyArea->getOtherUser($posted_by);//array
				if(!empty($posted_by_info)){
				    $dir="../posts/netchatsaSudyArea/".$posted_by."/".$img;
				$dirVideo="../posts/netchatsaSudyArea/".$posted_by."/".$video;
				$profileIMG=$posted_by_info['profile_image'];
				$profileDir="";
				if($profileIMG=="empty"){
					$profileDir="../img/aa.jpg";
					
				}
				else{
					$profileDir="../img/userProfileImages/".$posted_by."/".$profileIMG;
				}

				?>
				<style>
					.like i,a,{
						color:#45f3ff;
					}
					.soloLa{
						color:#45f3ff;
					}
					.package{
						color:#45f3ff;
					}

				</style>
				<div class="package">

					<div class="headerDisplayMach">
						<div class="profile" style=""><img src="<?php echo $profileDir;?>"></div>
						<div class="userName" style="font-size:12px;"><span><?php if(strlen($posted_by_info['username'])<15){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
							for($i=0;$i<17;$i++){echo $bb[$i];}echo"..";
						}?></span></div>
						<div class="names" style="font-size:12px;"><span><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<17){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
							for($i=0;$i<17;$i++){echo $aa[$i];}echo"..";
						}?></span></div>
						<div class="time" style="font-size:12px;"><span><?php TimePdo::time_Ago(strtotime($time_posted));?></span></div>
					</div>
					<div class="title" style="width:100%;color: #000;background-color: #45f3ff;padding: 10px 0;">
						<?php
							echo $row['title'];
						?>
					</div>
					<?php 
					if(!empty($text)){
						?>
					<div class="textDisplay">
						<h5><?php echo $text;?></h5>
					</div>

						<?php
					}
					if($img!=0){
						?>
						<div class="textDisplay">
							<img src="<?php echo $dir;?>">
						</div>
						<?php
					}
					else{

						if($video!=0){
							?>
							<div class="textDisplay">
							    <video controls>
							    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
							    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
							    </video>
							</div>
							<?php
						}
					}
					?>
					<div class="displayEmogies flex" >
						<div class="like flex"  >
							<i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $studyArea->getNumViews($post_id);?></small>
						</div>
						<div class="like flex"  >
							<i class="fa fa-thumbs-down" id='soloLa' onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $studyArea->getNumDislike($post_id);?></small>
						</div>
						<div class="like flex" >
							<i class="fa fa-thumbs-up" id='soloLa' aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $studyArea->getNumLikes($post_id);?></small>
						</div>
						
						<div class="like flex" >
							<a onclick="loadStudyAreaReply('<?php echo $post_id;?>')" ><i id='soloLa' onclick="views(<?php echo $post_id;?>);" class="fa fa-reply" aria-hidden="true"></i></a><small><?php echo $studyArea->getNumOfReply($post_id);?></small>
						</div>
						<div class="like flex" >
							<a onclick="blockUser('<?php echo $posted_by;?>','blocked<?php echo $post_id;?>','asifundeSonke')" class="blocked<?php echo $post_id;?>"><i id='soloLa' class="fa fa-ban" aria-hidden="true"></i></a>
						</div>
						<div class="like flex" >
							<a onclick="reportUser('<?php echo $posted_by;?>','reported<?php echo $post_id;?>','asifundeSonke')" class="reported<?php echo $post_id;?>"><i id='soloLa' class="fa fa-flag" aria-hidden="true"></i></a>
						</div>
					</div>
					
				</div>
				<br>
                <?php
				}
			}
		}
		else{
			echo"Report this Error: Could not load Study Area Data";
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