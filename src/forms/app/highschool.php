<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	// require_once("../controller/pdo.php");
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);	
	$matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$userPdo->connect]);	
	$netchatSa = PDOServiceFactory::make(ServiceConstants::NETCHATSA_SUBJECT_PDO,[$userPdo->connect]);
	$sgelaUniPdo = PDOServiceFactory::make(ServiceConstants::SGELA_UNI_PDO,[$userPdo->connect]);	
	$status ="high school";
    	$response=$matricUpgrade->getStudentGradeIfExists($cur_user_row['my_id'],$status);
    	$header_student_inf=$response;
    	if(empty($response)){
    		?>
    		<style>
			.softa{
				width:100%;
				border:1px solid #45f3ff;
				box-shadow: 0px 0px 15px rgba(0,0,0,.5);
				background-color: #212121;
				padding:0 10px;
				color: #45f3ff;
				text-align: center;
			}
			.softa .settupMao{
				width: 100%;
			}
			.softa .settupMao input,select{
				width:100%;
				padding: 10px 10px;
				border: none;
				background-color: #212121;
				border-bottom: 2px solid #45f3ff;
				color: #45f3ff;
			}
			span{
				text-align: center;
			}
			.sudoBtmNet{
				padding: 10px 10px;

			}
		</style>
		<div class="softa">
			<center><h2>
				Fill 2 Request Self Learning Access
			</h2></center>
			<span>Enter Name</span>
			<div class="settupMao">
				<input type="text" placeholder="Enter Student Name" class="studentName">
			</div>
			<span>Enter Surname</span>
			<div class="settupMao">
				<input type="text" placeholder="Enter Surname" class="studentSurname">
			</div>
			<?php
			if($status=="tertiary"){
				?>
				<span>Select University</span>
				<div class="settupMao">
					<select class="studentSchoolAttecnding">
						<option value="">-- Select Tertiary --</option>
						<?php $tertiaryApplications->getAllUniversities();?>
					</select>
				</div>
				<span>Select Current Level</span>
				<div class="settupMao">
					<select class="studentCurrentGrade">
						<option value="">-- Select Current level --</option>
						<option value="1st">1st Year</option>
						<option value="2nd">2nd Year</option>
						<option value="3rd">3rd Year</option>					
						<option value="4th">4th Year</option>
						<option value="5th">5th Year</option>
					</select>
				</div>
				<?php
			}
			else{
			?>
				<span>Select School</span>
				<div class="settupMao">
					<select class="studentSchoolAttecnding">
						<option value="">-- Select School --</option>
						<?php $tertiaryApplications->getAllSchools();?>
					</select>
				</div>
				<span>Select Current Grade</span>
				<div class="settupMao">
					<select class="studentCurrentGrade">
						<option value="">-- Select Current Grade --</option>
						<option value="gr12">Grade 12</option>
						<option value="gr11">Grade 11</option>
						<option value="gr10">Grade 10</option>					
						<option value="gr9">Grade 9</option>
						<option value="gr8">Grade 8</option>
					</select>
				</div>
			<?php
			}
			?>
			<div class="sudoBtmNet">
				<div class="topNavBtn btn" onclick="SaveToAutoLearn('<?php echo $cur_user_row['my_id'];?>','<?php echo $status?>')">Request Self learning Access</div>
			</div>
			
			<div class="errorRegistrationModea" hidden></div>
		</div>
		<script>
			function SaveToAutoLearn(my_id_new_set,status_new_set){
				const studentNameconst = $(".studentName").val(); 
				const studentSurname = $(".studentSurname").val();
				const studentSchoolAttecnding = $(".studentSchoolAttecnding").val();
				const studentCurrentGrade = $(".studentCurrentGrade").val();
				$(".errorRegistrationModea").removeAttr("hidden").attr("style","color:#45f3ff;").html("<img style='width:4%;color:#45f3ff;' src='../../img/processor.gif'>Processing Request...");
				if(studentNameconst==""){
					$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("All Fields are required!..");
				}
				else if(studentSurname==""){
					$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("All Fields are required!..");
				}
				else if(studentSchoolAttecnding==""){
					$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("All Fields are required!..");
				}
				else if(studentCurrentGrade==""){
					$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("All Fields are required!..");
				}
				else{
					var amount=100.00;
					if(status_new_set=="high school"){
						amount=50.00;
					}
					$.ajax({
	            		url:'./controller/ajaxCallProcessor.php',
	            		type:'post',
	            		data:{my_id_new_set:my_id_new_set,status_new_set:status_new_set,studentNameconst:studentNameconst,studentSurname:studentSurname,studentSchoolAttecnding:studentSchoolAttecnding,studentCurrentGrade:studentCurrentGrade,amount:amount},
	            		success:function(e){
	            		    response = JSON.parse(e);
											if(response['responseStatus']==='S'){
	            		    	$(".errorRegistrationModea").html("Refreshing...");
	            		    	if(status_new_set=="high school"){
	            		    		loader("highschool");
	            		    	}
	            		    	else{
	            		    		loader("tertiary");
	            		    	}
	            		    }
	            		    else{
	            		    	$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("Error: "+response['responseMessage']);
	            		    }
	            		}
	          		});
				}
			}
		</script>
		<?php
    	}
    	else{
    		?>
		<script>
			
		</script>
		<style>
			.headerSgela{
				width: 100%;
				color:#45f3ff;
				border-bottom: 2px solid #45f3ff;
				padding: 10px 10px;

			}
			.flex{
				size: flex;
			}
			.randomdC{
				width: 100%;
				
			}
			select{
				width: 170px;
			}
			
			

		</style>
		<center>
		<div class="headerSgela flex">
			<div class="randomdC" style="width:30%;padding: 5px 5px;">
			    <h5 id="grade">
			    	<?php
			    		echo $header_student_inf['level'];
			    	?>
			    </h5>
			</div>
			<div class="randomdC" style="width:30%;padding: 5px 5px;">
			    <h6>
			    	<?php
			    		if($header_student_inf['paid']==1){
			    			?>
			    			<h5 style="color:red;font-style: bold;font-family: arial;">NOT PAID</h5>
			    			<?php
			    		}
			    		else{
			    			?>
			    			<h5 style="color:green;font-style: bold;font-family: arial;">PAID</h5>
			    			<?php
			    		}
			    	?>
			    </h6>
			</div>
			<?php if(isset($_GET['_-'])){
			    ?>
			<div class="randomdC" style="width:30%;border:1px solid #45f3ff;color:#45f3ff;border-radius:10px;padding:10px 5px;" onclick="redirectPractice(<?php echo $_GET['_-'];?>)">
			  Exams
			</div>
			    <?php
			    }
			?>
			<div class="randomdC">
			    <select class="changegrade" style="background-color:#212121;color: #45f3ff;">
			    	<option value="">-- Change Grade --</option>
			    	<option value="gr12">Grade 12</option>
			    	<option value="gr11">Grade 11</option>
			    	<option value="gr10">Grade 10</option>
			    	<option value="gr9">Grade 9</option>
			    	<option value="gr8">Grade 8</option>
			    </select>
			</div>
			
			<script>
			    function redirectPractice(subj){
			       loader("highschool&practiceSubj="+subj);
			    }
			</script>
		</div>
		
		<!-- </center> -->

		<?php
		$id=$header_student_inf['my_id'];
		if(isset($_GET['_-'])&&!empty($_GET['_-'])){
	        $subj_id=$_GET['_-'];
	        $subj_info=$netchatSa ->NetchatSubjInfo($subj_id);
	        if($netchatSa->isNetchatSubj($subj_id)){
	            ?>
	            <style>
		
        		    .medLocker{
        		        
        		        width:100%;
        		        
        		        height:80.5vh;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                        hyphens: auto;
                        color:#45f3ff;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
        		</style>
        		<div class="medLocker">
        		    <?php
        		    $getChapterHighSchoolSet=$netchatSa->getChapterHighSchoolSet(intval($subj_id));
        		    if(count($getChapterHighSchoolSet)==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Chappters Added for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        foreach($getChapterHighSchoolSet as $row){
            		        $chapter_name=$row['chapter_name'];
            		        $chapter_id=$row['chapter_id'];
            		        $dir="../img/aa.jpg";
            		        
            		        ?>
            		        <div class="bodyCamp" onclick="dofoUsLeg1(<?php echo $chapter_id;?>)">
            		            <div class="radeMos">
            		                <div class="img-kMover">
                    		            <img src="<?php echo $dir;?>">
                    		        </div>
                    		        <div class="maxcKood">
                    		            <div><small><?php echo $chapter_name;?></small></div>
                    		            <div><small>click to see Content presented for <?php echo $chapter_name;?></small></div>
                    		        </div>
            		            </div>
                    		        
                		    </div>
                    		
            		        <?php
            		    }
        		    }
            		    
        		    ?>
            		    
        		</div>
        		</center>
        		<?php
	        }
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	    }
	    elseif(isset($_GET['_-_'])&&!empty($_GET['_-_'])){
	        $chapter_id=$_GET['_-_'];
	        if($netchatSa->isChapterMor($chapter_id)){
	            $chapter_info=$netchatSa->getChapterInfo($chapter_id);
	            // print_r($chapter_info);
	            $subj_info=$netchatSa->NetchatSubjInfo($chapter_info['subj_id']);
	            ?>
	            <style>
		
        		    .medLocker{
        		        
        		        width:100%;
        		        
        		        height:80.5vh;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                        hyphens: auto;
                        color:#45f3ff;
                        background-color:#fff;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
        		</style>
        		<div class="medLocker" >
        		    <?php
        		    $getConententHighSchool=$netchatSa->getConententHighSchool(intval($chapter_id));
        		    if(count($getConententHighSchool)==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Contnent Added for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        foreach($getConententHighSchool as $row){
        		            $ext=explode(".",$row['content']);
        		            $ext=$ext[0];
        		            $subj_id=$row['subj_id'];
                            $chapter_id=$row['chapter_id'];
                            
        		            $dir="../highschool/".$subj_id."/".$chapter_id."/".$row['content'];
        		            if(in_array($ext,["mp4","MP4","mv","MV"])){
        		                ?>
        		                <video style="width:100%;" controls download='false'>
                                  <source src="<?php echo $dir;?>" type="video/mp4">
                                  <source src="<?php echo $dir;?>" type="video/ogg">
                                  Your browser does not support the video tag.
                                </video>
        		                <?php
        		            }
        		            else{
        		                ?>
        		                <img src="<?php echo $dir;?>" style="width:100%;" download='false'>
        		                <?php
        		            }
        		            
        		        }
        		        
        		    }
            		    
        		    ?>
            		    
        		</div>
        		</center>
	            <?php
	        }
	        
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	        
	    }
	    elseif(isset($_GET['_practiceSubj_']) && !empty($_GET['_practiceSubj_'])){
	        $chapter=$_GET['_practiceSubj_'];
	        if($netchatSa->isNetchatSubjpracticeExams($chapter)){
	           // $subj_info=$this->NetchatSubjpracticeExams($chapter);
	            $NetchatSubjpracticeExams=$sgelaUniPdo->NetchatSubjpracticeExams($chapter);
	            if(count($NetchatSubjpracticeExams)==0){
	                ?>
	                <h4 style="color:red;">Chapter has no practice questions yet!!..</h4>
	                <?php
	            }
	            else{
	                $count=1;
	                foreach($NetchatSubjpracticeExams as $row){
	                    $chapter_id=$row['chapter'];
	                    $subject=$row['subject'];
	                    $question="../highschool/".$subject."/".$chapter_id."/practice/".$row['question'];
	                    $answer="../highschool/".$subject."/".$chapter_id."/practice/";
	                    $solution_array=array();
	                    if(!empty($row['a']) && $row['a']!="empty"){
	                        array_push($solution_array,$row['a']);
	                    }
	                    if(!empty($row['b']) && $row['b']!="empty"){
	                        array_push($solution_array,$row['b']);
	                    }
	                    if(!empty($row['c']) && $row['c']!="empty"){
	                        array_push($solution_array,$row['c']);
	                    }
	                    if(!empty($row['d']) && $row['d']!="empty"){
	                        array_push($solution_array,$row['d']);
	                    }
	                    if(!empty($row['e']) && $row['e']!="empty"){
	                        array_push($solution_array,$row['e']);
	                    }
	                    if(!empty($row['f']) && $row['f']!="empty"){
	                        array_push($solution_array,$row['f']);
	                    }
	                    
	                    ?>
        	            <!-- <div class="container"> -->
                            <center><h3>question <?php echo $count;?></h3></center>
                          <div class="displayMode" id="<?php echo $row['id'];?>">
                              <img src="<?php echo $question;?>" style="width:100%;">
                          </div>
                        
                          
        
        	            <?php
        	            $count++;
	                }

	            }        
	        }
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	    }
	    elseif(isset($_GET['practiceSubj']) && !empty($_GET['practiceSubj'])){
	        $subj_id=$_GET['practiceSubj'];
	        if($netchatSa->isNetchatSubj($subj_id)){
	            $subj_info=$netchatSa->NetchatSubjInfo($subj_id);
	            ?>
	            <style>
		
        		    .medLocker{
        		        width:100%;
        		        height:80.5vh;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                        hyphens: auto;
                        color:#45f3ff;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
        		</style>
        		<div class="medLocker">
        		    <?php
        		    $netchatsaExamsSubject=$sgelaUniPdo->netchatsaExamsSubject($subj_id);
        		    if(count($netchatsaExamsSubject)==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Exam Practice for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        $chapterswithexamquestions=array();
        		       foreach($netchatsaExamsSubject as $row){
        		            $chapter=$row['chapter'];
        		            if(!in_array($chapter,$chapterswithexamquestions)){
        		                array_push($chapterswithexamquestions,$chapter);
        		            }
        		        }
        		        foreach($chapterswithexamquestions as $chapter_id){
        		            $chapter_info=$netchatSa->getChapterInfo($chapter_id);
        		           
            		        $chapter_name=$chapter_info['chapter_name'];
            		        
            		        $dir="../img/aa.jpg";
            		        
            		        ?>
            		        <div class="bodyCamp" onclick="practiceExamQuestionsRedirect(<?php echo $chapter_id;?>)">
            		           
            		            <div class="radeMos">
            		                <div class="img-kMover">
                    		            <img src="<?php echo $dir;?>">
                    		        </div>
                    		        <div class="maxcKood">
                    		            <div><small><?php echo $chapter_name;?></small></div>
                    		            <div><small>click to start exam practice </small></div>
                    		        </div>
            		            </div>
                    		        
                		    </div>
                    		
            		        <?php
            		    }
        		    }  
        		    ?> 
        		</div>
        		<script>
        		    function practiceExamQuestionsRedirect(chapter){
        		        loader("highschool&_practiceSubj_="+chapter);
        		    }
        		</script>
        		</center>
        		<?php
	        }
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	        
	    }
	    else{
            ?>
            <style>
		
			    .medLocker{
			        
			        width:100%;
			        hyphens: auto;
			        
			        overflow-x:auto;
	                overflow-wrap: break-word;
	                word-wrap: break-word;
	                
	                color:#45f3ff;
			    }
			    .medLocker .bodyCamp{
			        width:100%;
			        padding:10px;
			    }
			    .medLocker .bodyCamp .radeMos{
			        width:100%;
			        height:auto;
			        padding:6px;
			        box-shadow: 0 8px 6px -6px black;
			        display:flex;
			        cursor:pointer;
			    }
			    .medLocker .bodyCamp .radeMos:hover{
			        background-color:#45f3ff;
			        color:#000;
			    }
			    .medLocker .bodyCamp .radeMos .img-kMover{
			        width:60px;
			        height:60px;
			        border-radius:100%;
			        padding:10px;
			    }
			    .medLocker .bodyCamp .radeMos .img-kMover img{
			        width:100%;
			        height:100%;
			        border-radius:100%;
			    }
			</style>
				<div class="medLocker">
				    <?php
				    // echo $header_student_inf['level'];
				    $response =$netchatSa->getNetchatsaSubjectsForHighSchool($header_student_inf['level']);
				    $count=0;//
				    foreach($response as $row){
				        $subj_name=$row['subj_name'];
				        $subj_id=$row['subj_id'];
				        $dir="../img/aa.jpg";
				        
				        ?>
				        <div class="bodyCamp" onclick="dofoUsLeg('<?php echo $subj_id;?>')">
				            <div class="radeMos">
				                <div class="img-kMover">
		        		            <img src="<?php echo $dir;?>">
		        		        </div>
		        		        <div class="maxcKood">
		        		            <div><small><?php echo $subj_name;?></small></div>
		        		            <div><small>click to see all Chapters presented for <?php echo $subj_name;?></small></div>
		        		        </div>
				            </div>
		        		        
		    		    </div>
		        		
				        <?php
				        $count++;
				    }
				    if($count==0){
				    	?>
				    	<h5 style="color:#bbb;border:1px solid #bbb;padding:10px;10px;"> <?php echo $header_student_inf['level']." has not subjects yet!!";?></h5>
				    	<?php
				    }
				    ?>
		    		    
				</div>
        	</center>
        <?php
       	}
    		?>
    		<script>
    			$(document).ready(function(){
    				$(".displayMode").click(function(){
						const displayModeAnswers=$(this).attr("id");
						console.log(displayModeAnswers);
						$.ajax({
                            url:"../src/forms/app/dataFetchAnswers.php",
                            type:"POST",
                            data:{displayModeAnswers:displayModeAnswers},
                            
                            cache:false,
                            beforeSend:function(){
                                
                                $(".showAnswersModal").html("<img style='width:10%;' src='../img/processor.gif'><h5 style='color:green;'>Fetching Data..</h5>");
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
		window.location=("../../");
	</script>

	<?php
}
?>