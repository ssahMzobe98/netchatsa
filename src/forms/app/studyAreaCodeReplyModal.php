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
        if(isset($_POST['post_id_Code_reply_modal'])){
            $post_id=$cleanData->OMO($_POST['post_id_Code_reply_modal']);
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
                    // console.log(p_id);
                    $(".errorDisplayermessageStudyAreaCodeReply").removeAttr("hidden").html("<small><img style='width:5%;' src='../img/loader.gif'> <span style='color:green;'>Processing request...</span></small>");
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
                                response = JSON.parse(e);
                                if(response['responseStatus']==='F'){
                                    $(".errorDisplayermessageStudyAreaCodeReply").removeAttr("hidden");
                                    $(".errorDisplayermessageStudyAreaCodeReply").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
                                    $(".errorDisplayermessageStudyAreaCodeReply").html(response['responseMessage']);
                                }
                                else{
                                    $("#studyAreaMathCodeReply").val("");
                                    $("#studyAreaMathCodeReply").attr("placeholder","Type Your Message ...");
                                    $(".errorDisplayermessageStudyAreaCodeReply").html("Reply Sent.");
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
        window.location=("../../");
    </script>
    <?php
}
?>