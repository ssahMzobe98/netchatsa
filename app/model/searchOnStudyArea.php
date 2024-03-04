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
        if(isset($_POST['q'])){
            $search=$pdo->OMO($_POST['q']);
            // $aKeyword = explode(" ", $search);
            // $query ="SELECT * FROM studyarea WHERE title like '%" . $aKeyword[0] . "%'";
            // for($i = 1; $i < count($aKeyword); $i++) {
            //     if(!empty($aKeyword[$i])) {
            //         $query .= " OR title like '%" . $aKeyword[$i] . "%'";
            //     }
            // }

            $searchItems=$pdo->getSearchItemsForStudyArea($search,$cur_user_row['my_id']);
            // $_ = $conn->query($query);
            
            echo "<div style='color:#45f3ff;background-color:green;width:100%;min-height:20px;text-align:center;box-shadow:1px 1px 1px 1px #000;'><span>search results for : ".$search."</span> ".count($searchItems)."</div><br>";
            $numbReplyusingImage_id_count=1;
            $r=0;$r1=1;$r2=2;
            if(count($searchItems) > 0) {
                foreach ($searchItems as $row){ 
               
                    $post_id=$row['post_id'];
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
                    if($profileIMG=="empty"){
                        $profileDir="../../img/aa.jpg";
                        
                    }
                    else{
                        $profileDir="../../img/userProfileImages/".$posted_by."/".$profileIMG;
                    }

                    ?>
                    <div class="package">
                        
                        <div class="headerDisplayMach">
                            <div class="profile">
                                <img src="<?php echo $profileDir;?>">
                            </div>
                            <div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<17){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
                                for($i=0;$i<17;$i++){echo $bb[$i];}echo"..";
                            }?></h5></div>
                            <div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<17){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
                                for($i=0;$i<17;$i++){echo $aa[$i];}echo"..";
                            }?></h5></div>
                            <div class="time" ><h5><?php $pdo->time_Ago(strtotime($time_posted));?></h5></div>
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
                                <i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $pdo->getNumViews($post_id);?></small>
                            </div>
                            <div class="like flex"  >
                                <i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $pdo->getNumDislike($post_id);?></small>
                            </div>
                            <div class="like flex" >
                                <i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $pdo->getNumLikes($post_id);?></small>
                            </div>
                            
                                <div class="like flex" >
                                    <a onclick="loadStudyAreaReply('<?php echo $post_id;?>')" ><i onclick="views(<?php echo $post_id;?>);" class="fa fa-reply" aria-hidden="true"></i></a><small><?php echo $pdo->getNumOfReply($post_id);?></small>
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
            echo"No data Found";
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