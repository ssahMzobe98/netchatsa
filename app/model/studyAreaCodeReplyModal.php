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
            <input type="hidden"  id="post_id2" value="<?php echo $post_id;?>">
          <div class="text_editor">
            <textarea type="code" id="studyAreaMathCodeReply" placeholder="String variable='Add my Problem/Solution Code Here';//JAVA,PHP,..."></textarea>
          </div>
          <div class="buttn">
            <button type="button" class="btn" id="studyAreaMathCodeSubmitReply" style="color:#45f3ff;" >Reply</button>
          </div>
          <div class="errorDisplayermessageStudyAreaCodeReply" hidden></div>
          <script>
                $("#studyAreaMathCodeSubmitReply").click(function(){
                    const code=$("#studyAreaMathCodeReply").val();
                    const p_id=$("#post_id2").val();
                    console.log(p_id);
                    if(p_id==""){
                        $(".errorDisplayermessageStudyAreaCodeReply").removeAttr("hidden");
                        $(".errorDisplayermessageStudyAreaCodeReply").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
                        $(".errorDisplayermessageStudyAreaCodeReply").html("PostId is required!!..");

                    }
                    else if(code==""){
                        $("#studyAreaMathCodeReply").attr("placeholder","CAN NOT SEND EMPTY CODE!!.. ");
                    }
                    else{
                        
                        $.ajax({
                            url:"./controller/ajaxCallProcessor.php",
                            type:"POST",
                            data:{code:code,p_id:p_id},
                            cache:false,
                            beforeSend:function(){
                                $("#studyAreaMathCodeReply").attr("placeholder","Sending Message...");
                            },
                            success:function(e){

                                console.log(e.length);
                                if(e.length>2){
                                    $(".errorDisplayermessageStudyAreaCodeReply").removeAttr("hidden");
                                    $(".errorDisplayermessageStudyAreaCodeReply").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
                                    $(".errorDisplayermessageStudyAreaCodeReply").html(e);
                                }
                                else{
                                    $("#studyAreaMathCodeReply").val("");
                                    $("#studyAreaMathCodeReply").attr("placeholder","Type Your Message ...");

                                    //loadStudyAreaReplyRedirector(p_id);
                                    console.log("sending to replyStudyAreaRedir");
                                    // loader("loadStudyAreaReply.php?_="+p_id+"&min=0&max=7");
                                    loadStudyAreaReply(p_id);
                                }
                            }
                        });
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