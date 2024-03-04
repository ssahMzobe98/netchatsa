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
    	$response=$pdo->getStudentGradeIfExists($cur_user_row['my_id'],"high school");
    	if(empty($response)){
    		$pdo->registerAsNewCandidate($cur_user_row['my_id'],"high school");
    	}
    	else{
    		$pdo->autoShowHighSchoolSelfLearning($response);
    		?>
    		<script>
    			$(document).ready(function(){
    				$(".displayMode").click(function(){
						const displayModeAnswers=$(this).attr("id");
						console.log(displayModeAnswers);
						$.ajax({
                            url:"./model/dataFetchAnswers.php",
                            type:"POST",
                            data:{displayModeAnswers:displayModeAnswers},
                            
                            cache:false,
                            beforeSend:function(){
                                
                                $(".showAnswersModal").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>Fetching Data..</h5>");
                            },
                            success:function(e){
                                $(".showAnswersModal").html(e);

                            }
                        });
                        $("#showAnswersModal").modal("show");
					});
    			});
    			function closeMyModalNow(){
    				$("#showAnswersModal").modal("hide");
    			}
	    			
    		</script>
    		<?php
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