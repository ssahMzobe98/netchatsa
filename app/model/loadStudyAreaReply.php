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
        if(isset($_GET['_'])&&isset($_GET['min'])&&isset($_GET['max'])){
            $min=$_GET['min'];$max=$_GET['max'];
            $response=$pdo->getPostOfThisUid($_GET['_']);
            if(count($response)!=1){
                echo "<h2 style='background-color:red;color:#45f3ff;padding:10px 0;'>Post Not Found!!..</h2>";
            }
            else{
                $row=$response[0];
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
                $post_id=$row['post_id'];
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
                    <div class="title" style="width:100%;padding: 10px 0;">
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
                        <div class="like flex studyAreaCodeReplyModal" id="<?php echo $post_id;?>"> <!-- data-toggle="modal" data-target="#codingReply"-->
                        <i class="fa fa-code" aria-hidden="true"></i>
                        </div>
                        <div class="like flex studyAreaTextImgReplyModal" id="<?php echo $post_id;?>">
                        <i class="fa fa-reply" aria-hidden="true"></i><small><?php echo $pdo->getNumOfReply($post_id);?></small>
                        </div>
                        <!--<div class="like flex" data-toggle="modal" data-target="#replyStudyArea">-->
                        <!--<i class="fa fa-ban" aria-hidden="true"></i><small><?php echo $pdo->getNumOfReply($post_id);?></small>-->
                        <!--</div>-->
                        <!--<div class="like flex" data-toggle="modal" data-target="#replyStudyArea">-->
                        <!--<i class="fa fa-flag" aria-hidden="true"></i><small><?php echo $pdo->getNumOfReply($post_id);?></small>-->
                        <!--</div>-->
                        
                    </div>
                    
                </div>
                <h2>Replies Below..</h2>
                <br>
                <div class="RepliesLoader"></div>
                <div class="repliesAdder"></div>
                
                <?php
                
            }
            ?>
        
        <script>
            $(document).ready(function(){
                var limit = 7;
                var start = 0;
                var post_id= '<?php echo $post_id;?>';
                console.log(limit+" - "+start+" - "+post_id);
                var action = 'inactive';
                if(action == 'inactive'){
                  action = 'active';
                  loadStudyAreaRepliesForSet(post_id,limit, start);
                }
                $(window).scroll(function(){
                  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
                  {
                   action = 'active';
                   start = start + limit;
                   setTimeout(function(){
                    loadStudyAreaRepliesForSet(post_id,limit, start);
                   }, 1000);
                  }
                });

                $(".studyAreaCodeReplyModal").click(function(){
                    const post_id_Code_reply_modal = $(this).attr("id");
                    // console.log(post_id_Code_reply_modal);
                    // $("#showAnswersModal").modal("show");
                     $.ajax({
                        url:"./model/studyAreaCodeReplyModal.php",
                        type:"POST",
                        data:{post_id_Code_reply_modal:post_id_Code_reply_modal},
                        cache:false,
                        beforeSend:function(){
                            $(".codingReply").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>Fetching Data..</h5>");
                        },
                        success:function(e){
                            // console.log(e);
                            $(".codingReply").html(e);
                        }
                    });
                    $("#codingReply").modal("show");
                });
                $(".studyAreaTextImgReplyModal").click(function(){
                    const post_id_Code_reply_modal = $(this).attr("id");
                    // console.log(post_id_Code_reply_modal);
                    // $("#showAnswersModal").modal("show");
                     $.ajax({
                        url:"./model/studyAreaTextImgReplyModal.php",
                        type:"POST",
                        data:{post_id_Code_reply_modal:post_id_Code_reply_modal},
                        cache:false,
                        beforeSend:function(){
                            $(".replyStudyArea").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>Fetching Data..</h5>");
                        },
                        success:function(e){
                            // console.log(e);
                            $(".replyStudyArea").html(e);
                        }
                    });
                    $("#replyStudyArea").modal("show");
                });
            });
            function loadStudyAreaRepliesForSet(post_id,limit, start){
              console.log("initiate Running ..."+post_id+" "+limit+" "+start);
              $("#load_data_respsonse").hide();
              const constant=7;

              $.ajax({
               url:"./model/studyAreaRepliesLoader.php",
               method:"POST",
               data:{post_id:post_id,limit:limit, start:start},
               cache:false,
               success:function(data)
               {
                // console.log(data+" : Data info ");
                $('.RepliesLoader').append(data);
                if(data == ''){
                 $('.repliesAdder').html("<button type='button' class='btn btn-dark' style='width:100%;padding:2px 2px;color:#45f3ff;'>No Data Found</button>");
                 action = 'active';
                }
                else
                {
                 $('.repliesAdder').html("<button style='width:100%;padding:2px 2px;color:#45f3ff;' onclick='loadStudyAreaRepliesForSet("+post_id+","+(limit+constant)+","+(start+constant)+")' type='button' class='btn btn-dark;'>Load More</button>");
                 action = "inactive";
                }
               }
              });
              console.log("stop Running ...");
            }
            function codingReplyClose(){
                $("#codingReply").modal("hide");
            }
            function codingReplyCloseIMGTEXT(){
                $("#replyStudyArea").modal("hide");
            }
        </script>
            <?php
            
        }
        else{
            echo"could not load Replies of study area";
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