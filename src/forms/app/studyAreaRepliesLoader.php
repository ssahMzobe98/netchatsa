<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
// use Src\Classes\CleanData;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['usermail'])){
        $userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
        $studyArea = PDOServiceFactory::make(ServiceConstants::STUDY_AREA_PDO,[$userPdo->connect]);
        $cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
        $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
        if(isset($_POST["post_id"],$_POST['limit'],$_POST['start'])){
            $post_id=$cleanData->OMO($_POST["post_id"]);
            $max=$cleanData->OMO($_POST['limit']);
            $min=$cleanData->OMO($_POST['start']);

            $response=$studyArea->getRepliesOfThisPost($post_id,$min,$max,$cur_user_row['my_id']);
            foreach($response as $row){
                $text=$row['text']??'';
                $img=$row['img']??'';
                $video=$row['video'];
                $time_posted=$row['time_posted']??'';
                $posted_by=$row['posted_by']??'';
                $posted_by_info=$studyArea->getOtherUser($posted_by);//array
                $dir="../posts/netchatsaSudyArea/".$posted_by."/".$img;
                $dirVideo="../posts/netchatsaSudyArea/".$posted_by."/".$video;
                $profileIMG=$posted_by_info['profile_image']??'';
                $profileDir="";
                $post_id=$row['reply_id']??'';
                if($profileIMG=="empty"){
                    $profileDir="../img/aa.jpg";   
                }
                else{
                    $profileDir="../img/userProfileImages/".$posted_by."/".$profileIMG;
                }
                ?>
                <div class="package">

                    <div class="headerDisplayMach">
                        <div class="profile" style=""><img src="<?php echo $profileDir;?>"></div>
                        <div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<14){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
                            for($i=0;$i<14;$i++){echo $bb[$i];}echo"..";
                        }?></h5></div>
                        <div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<14){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
                            for($i=0;$i<14;$i++){echo $aa[$i];}echo"..";
                        }?></h5></div>
                        <div class="time" ><h5><?php TimePdo::time_Ago(strtotime($time_posted));?></h5></div>
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
                        <i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $studyArea->getNumDislike($post_id);?></small>
                    </div>
                    <div class="like flex" >
                        <i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $studyArea->getNumLikes($post_id);?></small>
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