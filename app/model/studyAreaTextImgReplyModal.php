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
        if(isset($_POST['post_id_Code_reply_modal'])){
            $post_id=$pdo->OMO($_POST['post_id_Code_reply_modal']);
            ?>
            <style>
                .img_selector,.text_editor{
                    width: 100%;
                }
                .img_selector input,.text_editor textarea{
                    width: 100%;
                }
                .text_editor textarea{
                    max-width: 100%;
                    min-width: 100%;
                    min-height: 50vh;
                    max-height: 90vh;
                    border:none;
                    border-left:2px solid #45f3ff;
                    padding: 10px 10px;
                    background: #212121;
                    color: #45f3ff;
                }
            </style>
            <input type="hidden"  id="post_id" value="<?php echo $post_id;?>">
          <div class="img_selector">
            <input type="file" name="file" id="studyAreaMathInputReply" accept="video/*,image/*">
          </div>
          <div class="text_editor">
            <textarea id="studyAreaMathTextReply" placeholder="Upload Problem/Question..."></textarea>
          </div>
          <div class="buttn">
            <button type="button" class="btn" id="studyAreaMathReply" style="color:#45f3ff;">Reply</button>
          </div>
          <div class="errorDisplayermessageStudyAreaReply" hidden></div>
          <script>
              $("#studyAreaMathReply").click(function(){
                    const studyAreaMathInputReply=$("#studyAreaMathInputReply").val();
                    const studyAreaMathTextReply=$("#studyAreaMathTextReply").val();
                    const p_id_img=$("#post_id").val();

                    // console.log(studyAreaMathTextReply);
                    if(p_id_img==""){
                        $(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
                        $(".errorDisplayermessageStudyAreaReply").html("<small style='color:red;background-color:#000;'>Title is Required</small>");
                    }
                    else{
                        if(studyAreaMathInputReply=="" && studyAreaMathTextReply==""){
                            $(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
                            $(".errorDisplayermessageStudyAreaReply").html("<small style='color:red;'>Cannot send empty file/Text!!..</small>");
                        }
                        else{
                            var form_data=new FormData();
                            var file="";
                            if(studyAreaMathInputReply!=""){
                                file=document.getElementById('studyAreaMathInputReply').files[0].name;
                            }
                            var ext=file.split('.').pop().toLowerCase();
                            const array=["mp4","mv","png","jpg","jpeng","heic","jpeg","MP4","MV","PNG","JPG","HEIC","JPEG","gif","GIF"];
                            if(jQuery.inArray(ext,array)==-1 && file!=""){
                                $(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
                                $(".errorDisplayermessageStudyAreaReply").html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic} Format </small>");

                            }
                            else{
                                if(studyAreaMathInputReply!=""){
                                    form_data.append("file",document.getElementById("studyAreaMathInputReply").files[0]);
                                }
                                else{
                                    form_data.append("file",file);
                                }
                                form_data.append("p_id_img",p_id_img);
                                form_data.append("studyAreaMathTextReply",studyAreaMathTextReply);
                                
                                $(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
                                $(".errorDisplayermessageStudyAreaReply").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
                                $.ajax({
                                    url:"./controller/ajaxCallProcessor.php",
                                    type:"POST",
                                    data:form_data,
                                    contentType:false,
                                    cache:false,
                                    processData:false,
                                    beforeSend:function(){
                                        $(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
                                        $(".errorDisplayermessageStudyAreaReply").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
                                    },
                                    success:function(e){
                                        console.log(e);
                                        console.log(e.length);
                                        if(e.length>2){
                                            $(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
                                            $(".errorDisplayermessageStudyAreaReply").attr("style","color:red;");
                                            $(".errorDisplayermessageStudyAreaReply").html(e);
                                        }
                                        else{
                                            $(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
                                            $(".errorDisplayermessageStudyAreaReply").html("<small style='color:green;'> SENT..</small>");
                                            $("#studyAreaMathTextReply").val("");
                                            $("#studyAreaMathInputReply").val("");
                                            // $('#replyStudyArea').modal('show');
                                            // console.log("hiding Modal");
                                            // loader("loadStudyAreaReply.php?_="+p_id+"&min=0&max=7");
                                            loadStudyAreaReply(p_id_img);
                                           
                                            
                                        }
                                    }
                                });
                            }
                        }
                    }
                        
                });
                
          </script>
            <?php
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