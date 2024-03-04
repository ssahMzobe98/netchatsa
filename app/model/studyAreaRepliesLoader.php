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
        if(isset($_POST["post_id"],$_POST['limit'],$_POST['start'])){
            $post_id=$pdo->OMO($_POST["post_id"]);
            $max=$pdo->OMO($_POST['limit']);
            $min=$pdo->OMO($_POST['start']);

            $response=$pdo->getRepliesOfThisPost($post_id,$min,$max,$cur_user_row['my_id']);
            foreach($response as $row){
                $text=$row['text'];
                $img=$row['img'];
                $video=$row['video'];
                $time_posted=$row['time_posted'];
                $posted_by=$row['posted_by'];
                $posted_by_info=$pdo->getOtherUser($posted_by);//array
                $dir="../../posts/netchatsaSudyArea/".$posted_by."/".$img;
                $dirVideo="../../posts/netchatsaSudyArea/".$posted_by."/".$video;
                $profileIMG=$posted_by_info['profile_image'];
                $profileDir="";
                $post_id=$row['reply_id'];
                if($profileIMG=="empty"){
                    $profileDir="../../img/aa.jpg";   
                }
                else{
                    $profileDir="../../img/userProfileImages/".$posted_by."/".$profileIMG;
                }
                ?>
                <div class="package">

                    <div class="headerDisplayMach">
                        <div class="profile" style=""><img src="<?php echo $profileDir;?>"></div>
                        <div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<17){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
                            for($i=0;$i<17;$i++){echo $bb[$i];}echo"..";
                        }?></h5></div>
                        <div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<17){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
                            for($i=0;$i<17;$i++){echo $aa[$i];}echo"..";
                        }?></h5></div>
                        <div class="time" ><h5><?php $pdo->time_Ago(strtotime($time_posted));?></h5></div>
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
                        <i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $pdo->getNumViews($post_id);?></small>
                    </div>
                    <div class="like flex"  >
                        <i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $pdo->getNumDislike($post_id);?></small>
                    </div>
                    <div class="like flex" >
                        <i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $pdo->getNumLikes($post_id);?></small>
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