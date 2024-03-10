<?php
class _pdo_{
	protected $connection;
	public function __construct(){
		$this->dbConn();
	}
	private function dbConn(){
		$user="u405316555_netchatsa";
        $pass="netchatsa";
        $dbnam="u405316555_netchatsa";
		$this->connection=mysqli_connect("localhost",$user,$pass,$dbnam)or die("Connection was not established!!");
	}
	//_____________________________________________________________________________
    #################################
    /*
    private values, do not touch, do not edit, do not remove, this functions are only private to
    
    @Mr MS Mzobe
    Version: 1.0
    */
    public function islogedIn(string $email):array{
		// global $this->connection;
		$sql="select 
				iss_looggedin 
			 from create_runaccount 
			 where usermail=?";
		$rows=$this->numRows($sql,"s",[$email]);
		if($rows<1){
			return array("response"=>"F","data"=>"user not found");
		}
		elseif($rows>1){
			return array("response"=>"F","data"=>"Multiple accounts detected!!");	
		}
		else{
			$data=$this->getAllDataSafely($sql,"s",[$email])[0]??[];
			
			$iss_looggedin=$data['iss_looggedin']??'';
			
			if($iss_looggedin==1){
				return array("response"=>"S","data"=>true);
			}
			else{
				return array("response"=>"S","data"=>false);
			}	
		}
	}
	
    // private function getAllDataSafely($query, $paramType="", $paramArray=[]):array{
    //     // global $conn;
    //     $stmt = $this->connection->prepare($query);
        
    //     if(!empty($paramType) && !empty($paramArray)) {
    //         $this->bindQueryParams($stmt, $paramType, $paramArray);
    //     }
        
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $resultset=array();
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             array_push($resultset,$row);
    //         }
    //     }
    //     return $resultset;
        
        
    // }
    // private function postDataSafely($query, $paramType, $paramArray):int{
    //     // global $conn;
    //     // print $query;
    //     $stmt = $this->connection->prepare($query);
    //     $this->bindQueryParams($stmt, $paramType, $paramArray);
    //     $stmt->execute();
    //     $insertId = $stmt->insert_id;
    //     return $insertId;
    // }
    // private function execute($query, $paramType="", $paramArray=array()){
    //     // global $conn;
    //     $stmt = $this->connection->prepare($query);
        
    //     if(!empty($paramType) && !empty($paramArray)) {
    //         $this->bindQueryParams($stmt, $paramType="", $paramArray=array());
    //     }
    //     $stmt->execute();
    // }

    // private function bindQueryParams($stmt, $paramType, $paramArray=array()){
    //     // global $conn;
    //     $paramValueReference[] = & $paramType;
    //     for ($i = 0; $i < count($paramArray); $i ++) {
    //         $paramValueReference[] = & $paramArray[$i];
    //     }
    //     call_user_func_array(array(
    //         $stmt,
    //         'bind_param'
    //     ), $paramValueReference);
    // }
    // private function numRows($query, $paramType="", $paramArray=array()):int{
    //     // global $conn;
    //     $stmt = $this->connection->prepare($query);
        
    //     if(!empty($paramType) && !empty($paramArray)) {
    //         $this->bindQueryParams($stmt, $paramType, $paramArray);
    //     }
        
    //     $stmt->execute();
    //     $stmt->store_result();
    //     $recordCount = $stmt->num_rows;
    //     return $recordCount;
    // }
    
	// public function userInfo(string $email):array{
	// 	$sql="select 
	// 			* 
	// 		 from create_runaccount 
	// 		 where usermail=?";
	// 	$rows=$this->numRows($sql,"s",[$email]);
	// 	if($rows<1){
	// 		return array("response"=>"F","data"=>"user not found");
	// 	}
	// 	elseif($rows>1){
	// 		return array("response"=>"F","data"=>"Multiple accounts detected!!");	
	// 	}
	// 	else{
	// 		return $this->getAllDataSafely($sql,"s",[$email])[0]??[];
	// 	}

	// }
	
	
	
	
	// public function logout(array $array):array{
	// 	$sql="update create_runaccount set iss_looggedin=0 where usermail=?";
	// 	$response=$this->postDataSafely($sql,"s",[$array['usermail']]);
	// 	if(is_numeric($response)){
	// 		return array("response"=>"S","data"=>$response);
	// 	}
	// 	else{
	// 		return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
	// 	}
	// }
	
	
	
	public function asifundeSonkeLoader(){
		
	}
	public function goToStart(array $userInfo):void{
	    if(isset($_GET['apply'])||isset($_GET['home'])){
	        ?>
        		
        		<?php
	    }
	}
	public function firstStep(array $userInfo):void{
		?>
		
		<?php
	}
	
	protected function rinsaNgamansiKphela(string $mess){
		$mess = str_replace('<', "?", $mess);
		$mess = str_replace('>', "?", $mess);
		$mess = str_replace("\\r\\n", "<br>", $mess);
		$mess = str_replace("\\n\\r", "<br>", $mess);
		$mess = str_replace("\\r", "<br>", $mess);
		$mess = str_replace("\\n", "<br>", $mess);
		$mess = str_replace("\r\n", "<br>", $mess);
		$mess = str_replace("\n\r", "<br>", $mess);
		$mess = str_replace("\r", "<br>", $mess);
		$mess = str_replace("\n", "<br>", $mess);
		$mess = str_replace("\\", " ", $mess);
		$mess = str_replace("'", "`", $mess);
		$mess = str_replace('"', "``", $mess);
		return $mess;
	}
	public function OMO(string $string){
		return $this->rinsaNgamansiKphela(
			mysqli_escape_string(
				$this->connection,$string
			)
		);
	}
	
	
	public function goToLevelApplication(array $array,array $data):void{
		
	}
	
	
	
	public function notifications(array $cur_user_row=[]):void{
		
	}
	public function requestPayment($response){
		echo"<center>
			<h3>Payment Required.</h3>
		</center>";
		$day=date("d");
        $year=date("Y");
        $month=date("m");
		$payment_required=150+(150*0.15)+3.50;
        $payment_required=number_format( sprintf( '%.2f', $payment_required ), 2, '.', '' );
        $monthText=$this->getMonth($month);
        
        ?>
        <style>
            .PaymentRequired{
                width:100%;
                padding:10px 10px;
                justify-content:center;
                text-align:center;
                align-content:center;
            }
            .paymentMatricUpgrade{
                width:90%;
                padding:10px 10px;
                background:navy;
                color:#45f3ff;
                border:2px solid white;
                border-radius:50px;
            }
        </style>
        <br>
        <center>
            <h5 style="color:#45f3ff;">
                Outstanding Payment for <?php echo $monthText." ".$year." "?>. Please make payment of R<?php echo $payment_required;?> to continue learning.
            </h5>
            <div class="PaymentRequiredASI">
                <div class="paymentMatricUpgrade" onclick="tertiaryMonthlyPayment()">PAY-NOW <?php echo 'R'.$payment_required;?></div>
			</div>
			<div class="processingMatricUpgradePaymentASI" hidden></div>
			<script>
			    function tertiaryMonthlyPayment(){
			        $(".PaymentRequiredASI").attr("hidden",true);
			        $(".processingMatricUpgradePaymentASI").removeAttr("hidden").
			        html("Please Wait, Fetching Payment request...").
			        load("./model/tertiaryMonthlyPayment.php");
			    }
			</script>
       </center>
        <?php
	}
	
	
	
	
	public function matricUpgrade($cur_user_row){
		global $conn;
// 		echo $cur_user_row['my_id'];
		
	}
	public function registerAsNewCandidate(string $my_id="",string $status=""){
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
						<?php $this->getAllUniversities();?>
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
						<?php $this->getAllSchools();?>
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
				<div class="topNavBtn btn" onclick="SaveToAutoLearn('<?php echo $my_id;?>','<?php echo $status?>')">Request Self learning Access</div>
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
	            		    if(e.length==1){
	            		    	$(".errorRegistrationModea").html("Refreshing...");
	            		    	if(status_new_set=="high school"){
	            		    		loader("highschool");
	            		    	}
	            		    	else{
	            		    		loader("tertiary");
	            		    	}
	            		    }
	            		    else{
	            		    	$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("Error: "+e);
	            		    }
	            		}
	          		});
				}
			}
		</script>
		<?php
	}
	
	public function autoShowHighSchoolSelfLearning(array $responseDataArray=[]){
		$header_student_inf=$responseDataArray;
		?>
		<script>
			$(document).ready(function(){
				$(document).on('change','.changegrade',function(){
					const changegrade=$(".changegrade").val();
					$.ajax({
						
	            		url:'./controller/ajaxCallProcessor.php',
	            		type:'post',
	            		data:{changegrade:changegrade},
	            		success:function(e){
	            		    if(e.length<=2){
	            		    	$("#grade").html("Refreshing...");
	            		    	loader("highschool");
	            		    }
	            		    else{
	            		    	$("#grade").html("Error: "+e);
	            		    }
	            		}
	          		});
				});
			});
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
	        $subj_info=$this->NetchatSubjInfo($subj_id);
	        if($this->isNetchatSubj($subj_id)){
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
        		    $getChapterHighSchoolSet=$this->getChapterHighSchoolSet(intval($subj_id));
        		    if(count($getChapterHighSchoolSet)==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Chappters Added for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        foreach($getChapterHighSchoolSet as $row){
            		        $chapter_name=$row['chapter_name'];
            		        $chapter_id=$row['chapter_id'];
            		        $dir="../../img/aa.jpg";
            		        
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
	        if($this->isChapterMor($chapter_id)){
	            $chapter_info=$this->getChapterInfo($chapter_id);
	            // print_r($chapter_info);
	            $subj_info=$this->NetchatSubjInfo($chapter_info['subj_id']);
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
        		    $getConententHighSchool=$this->getConententHighSchool(intval($chapter_id));
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
                            
        		            $dir="../../highschool/".$subj_id."/".$chapter_id."/".$row['content'];
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
	        if($this->isNetchatSubjpracticeExams($chapter)){
	           // $subj_info=$this->NetchatSubjpracticeExams($chapter);
	            $NetchatSubjpracticeExams=$this->NetchatSubjpracticeExams($chapter);
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
	                    $question="../../highschool/".$subject."/".$chapter_id."/practice/".$row['question'];
	                    $answer="../../highschool/".$subject."/".$chapter_id."/practice/";
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
	        if($this->isNetchatSubj($subj_id)){
	            $subj_info=$this->NetchatSubjInfo($subj_id);
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
        		    $netchatsaExamsSubject=$this->netchatsaExamsSubject($subj_id);
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
        		            $chapter_info=$this->getChapterInfo($chapter_id);
        		           
            		        $chapter_name=$chapter_info['chapter_name'];
            		        
            		        $dir="../../img/aa.jpg";
            		        
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
				    $response =$this->getNetchatsaSubjectsForHighSchool($header_student_inf['level']);
				    $count=0;//
				    foreach($response as $row){
				        $subj_name=$row['subj_name'];
				        $subj_id=$row['subj_id'];
				        $dir="../../img/aa.jpg";
				        
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
	}
	public function autoShowTertiarySelfLearning(array $response){
		// print_r($response);
		$id=$response['my_id'];
	    if(isset($_GET['_u_'])&&!empty($_GET['_u_'])&&isset($_GET['_uu_'])&&!empty($_GET['_uu_'])){
	        $module=$_GET['_u_'];
	        $chapter=$_GET['_uu_'];
	        if($this->ismoduleandisstudent($id,$module) && $this->ischapterandmodule($chapter,$id)) {
	            ?>
                <style>
                    .rain{
                        color:#45f3ff;
                        background-color:navy;
                        border:1px solid #45f3ff;
                        
                    }
                    .rain:hover{
                        background-color:#45f3ff;
                        border:1px solid #000;
                        color:#000;
                    }
                </style>
                <div class="mac" style="width:100%;display:flex;">
                    <div style="width:3%;"></div>
                    <div class="rain" data-toggle="modal" data-target="#install_module" style="padding:0 10px;">Install Module</div>
                    <div style="width:3%;"></div>
                    <div class="rain" >Assessments</div>
                    <div style="width:3%;"></div>
                    <div class="rain" >Results</div>
                </div>
                
                
                <style>
                    .medLocker{
    		        
    		        width:100%;
    		        
    		        
    		        /*overflow-x:auto;
                    overflow-wrap: break-word;
                    word-wrap: break-word;
                    hyphens: auto;*/
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
    		        
    		        
    		        cursor:pointer;
    		    }
    		    .medLocker .bodyCamp .radeMos:hover{
    		        background-color:navy;
    		    }
    		    
    		</style>
    		
                    <div class="medLocker"></div>
                    <div id="load_data_message"></div>
                    <script>
                    $(document).ready(function(){
                     
                     var limit = 7;
                     var start = 0;
                     var action = 'inactive';
                    
                    
                     if(action == 'inactive')
                     {
                      action = 'active';
                      load_country_data(limit, start);
                     }
                     
                     
                    });
                    $(window).scroll(function(){
                      if($(window).scrollTop() + $(window).height() > $(".medLocker").height() && action == 'inactive')
                      {
                       action = 'active';
                       start = start + limit;
                       setTimeout(function(){
                        load_country_data(limit, start);
                       }, 1000);
                      }
                     });
                     function load_country_data(limit, start)
                     {
                      const chapter="<?php echo $chapter?>";
                      $.ajax({
                       url:"./model/fetchUniContent.php",
                       method:"POST",
                       data:{limit:limit, start:start,chapter:chapter},
                       cache:false,
                       success:function(data)
                       {
                        $('.medLocker').append(data);
                        if(data == '')
                        {
                         $('#load_data_message').html("<span type='button' class='btn btn-info'>limit reached</span>");
                         action = 'active';
                        }
                        else
                        {
                         $('#load_data_message').html("<span onclick='load_country_data("+(limit)+", "+(start + limit)+")'>load more</span>");
                         action = "inactive";
                        }
                       }
                      });
                     }
                     </script>
                     
                     
                
                <?php
	        }
	        else{
	            ?>
	            <h2 style="color:red;">Query ID not found!!..</h2>
	            <?php
	        }
	    }
	    elseif(isset($_GET['_u_'])&&!empty($_GET['_u_'])){
	        $module=$this->OMO($_GET['_u_']);
	        // echo"Module Code : ".$module." - Student : ".$id;
	        if($this->ismoduleandisstudent($id,$module)) {
	            ?>
                <style>
                    .btn{
                        color:#45f3ff;
                        background-color:navy;
                        border:1px solid #45f3ff;
                        
                    }
                    .btn:hover{
                        background-color:#45f3ff;
                        border:1px solid #000;
                        color:#000;
                    }
                </style>
                <div class="mac" style="width:100%;display:flex;">
                    <div style="width:3%;"></div><div class="btn" data-toggle="modal" data-target="#install_module">Install Module</div><div style="width:3%;"></div><div class="btn" >Assessments</div><div style="width:3%;"></div><div class="btn" >Results</div>
                </div>
                
                
                <style>
                    .medLocker{
    		        
    		        width:100%;
    		        
    		        
    		        /*overflow-x:auto;
                    overflow-wrap: break-word;
                    word-wrap: break-word;
                    hyphens: auto;*/
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
                    // $_=$conn->query("select*from sgelavarsychapter where module='$module'");
                    $sgelavarsychapter=$this->sgelavarsychapter($module);
                    if(count($sgelavarsychapter)==0){
                        ?>
                        <h5 style="color:red;">No chapters added yet
                        <?php
                    }
                    else{
                        foreach($sgelavarsychapter as $row){
                            
                            
            		        $module_info=$this->getModuleInfo($row['module']);
            		      //  $chapter_info=$this->getModuleChapterInfo($module_id);
            		        $dir="../../img/aa.jpg";
            		        ?>
            		        <div class="bodyCamp" onclick="navtocontent(<?php echo $row['id'];?>,<?php echo $row['module'];?>)">
            		            <div class="radeMos">
            		                <div class="img-kMover">
                    		            <img src="<?php echo $dir;?>">
                    		        </div>
                    		        <div class="maxcKood">
                    		            <div><small><?php echo $row['chapter'];?></small></div>
                    		            <div><small>click to see all Content presented for <?php echo $row['chapter'];?></small></div>
                    		        </div>
            		            </div>
                    		        
                		    </div>
                            <?php
                        }
                    }
                    ?>
                    <script>
                        function navtocontent(chapter_id,module_id){
                            loader("tertiary&_u_="+module_id+"&_uu_="+chapter_id);
                        }
                    </script>
                    </div>
                
                <?php
	            
	            
	            
	            
	            
	        }
	        else{
	            ?>
	            <h3 style="color:red;">ID Query not found!!..</h3>
	            <?php
	        }
	    }
	    else{
		    ?>
            <style>
                .btn{
                        color:#45f3ff;
                        border:1px solid #45f3ff;
                        padding: 10px 10px;
                        
                    }
                    .btn:hover{
                        background-color:#45f3ff;
                        border:1px solid #000;
                        color:#000;
                    }
            </style>
            <div class="mac" style="width:100%;display:flex;">
                <?php
                
                $level=$this->levelInfo($id,"tertiary");//mysqli_fetch_array($conn->query(""))
                ?>
                <div style="width:3%;"></div><div class="btn" data-toggle="modal" data-target="#install_module">Install Module</div><div style="width:3%;"></div><div >
                    <select class="updateLevelVAVA" style="color: #45f3ff;background-color: #212121;">
                        <option value="<?php echo $level['level']?>"><?php echo $level['level']?> Year</option>
                        <option value="1st">1st year</option>
                        <option value="2nd">2nd year</option>
                        <option value="3rd">3rd year</option>
                        <option value="4rth">4rth year</option>
                        <option value="5fth">5fth year</option>
                        <option value="6th">6th year</option>
                        <option value="7nth">7nth year</option>
                    </select>
                </div>
            </div>
            
            
            <style>
                .medLocker{
		        
		        width:100%;
		        
		        
		        /*overflow-x:auto;
                overflow-wrap: break-word;
                word-wrap: break-word;
                hyphens: auto;*/
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
                $gelaModuleStudent=$this->gelaModuleStudent($id,$level['level']);
                //$_=$conn->query("select*from sgelamodulestudent where my_id='$id' and level='".$level['level']."'");
                if(count($gelaModuleStudent)==0){
                    ?>
                    <h5 style="color:red;">No modules installed yet, Click <span style="color:#f3f3f3;">'Install Module'</span> to start installation.</h5>
                    <?php
                }
                else{
                    foreach($gelaModuleStudent as $row){
                        
                        $module_id=$row['module'];
        		        $module_info=$this->getModuleInfo($module_id);
        		        $chapter_info=$this->getModuleChapterInfo($module_id);
        		        
        		        $dir="../../img/aa.jpg";
        		        
        		        ?>
        		        <div class="bodyCamp" onclick="navtochapter(<?php echo $module_id;?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
                		            <img src="<?php echo $dir;?>">
                		        </div>
                		        <div class="maxcKood">
                		            <div><small><?php echo $module_info['module'];?></small></div>
                		            <div><small>click to see all Chapters presented for <?php echo $module_info['module'];?></small></div>
                		        </div>
        		            </div>
                		        
            		    </div>
                        <?php
                    }
                }
                ?>
                <script>
                    function navtochapter(id){
                       loader("tertiary&_u_="+id);
                    }
                </script>
                </div>
            
            <?php
	    }
	}
	
	
	
	
	
	
	
    
    // public function submitAppVersionUpdate($updateVersionId,$NewVersion){
    //     $updateFromURL = "../../../accounts/ljisdjo%20sgjeoig_grekmogiemoe25674/";
    //     $url = explode("/",$_SERVER['REQUEST_URI']);
	//     $url=str_replace("%20", " ",$url[2]);
	//     $response = $this->copyUpdate();
	//     if($response['response']=="F"){
	//         return $response;
	//     }
    //     $params=[$NewVersion,$updateVersionId];
	// 	$strParams="ss";
	// 	$sql="update create_runaccount set version=? where id=?";
	// 	$response=$this->postDataSafely($sql,$strParams,$params);
	// 	if(is_numeric($response)){
	// 		return array("response"=>"S","data"=>1);
	// 	}
	// 	else{
	// 		return array("response"=>"F","data"=>$response);
	// 	}
    // }
    // protected function copyUpdate(string $userDir=".."){
    //     $count=0;
	//     $sodo=0;
	//     $totalCount=0;
	//     $dir = "../../../";
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/index.php",$userDir."/index.php")?  $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/view/index.php",$userDir."/view/index.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/view/left.php",$userDir."/view/left.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/view/center.php",$userDir."/view/center.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/view/view.php",$userDir."/view/view.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/controller/ajaxCallProcessor.php",$userDir."/controller/ajaxCallProcessor.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/controller/pdo.php",$userDir."/controller/pdo.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/apply.php",$userDir."/model/apply.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/asifundeSonke.php",$userDir."/model/asifundeSonke.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/campusSelectLoader.php",$userDir."/model/campusSelectLoader.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/CourseSelectLoader.php",$userDir."/model/CourseSelectLoader.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/dataFetchAnswers.php",$userDir."/model/dataFetchAnswers.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/esGela.php",$userDir."/model/esGela.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/fetchUniContent.php",$userDir."/model/fetchUniContent.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/hh.php",$userDir."/model/hh.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/highschool.php",$userDir."/model/highschool.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/izihlabelelo.php",$userDir."/model/izihlabelelo.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/learn2code.php",$userDir."/model/learn2code.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/loadStudyAreaReply.php",$userDir."/model/loadStudyAreaReply.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/loadStudyAreaReplyRedirector.php",$userDir."/model/loadStudyAreaReplyRedirector.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/matricUpgrade.php",$userDir."/model/matricUpgrade.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/myBlockedUsers.php",$userDir."/model/myBlockedUsers.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/myFlaggedUser.php",$userDir."/model/myFlaggedUser.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/myProfile.php",$userDir."/model/myProfile.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/notification.php",$userDir."/model/notification.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/searchOnStudyArea.php",$userDir."/model/searchOnStudyArea.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/studyAreaCodeReplyModal.php",$userDir."/model/studyAreaCodeReplyModal.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/studyAreaRepliesLoader.php",$userDir."/model/studyAreaRepliesLoader.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/studyAreaTextImgReplyModal.php",$userDir."/model/studyAreaTextImgReplyModal.php")? $count++:$sodo++;$totalCount++;
	        
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/success.php",$userDir."/model/success.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/tertiary.php",$userDir."/model/tertiary.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/tertiaryMonthlyPayment.php",$userDir."/model/tertiaryMonthlyPayment.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/tertiaryMonthlyPaymentSuccess.php",$userDir."/model/tertiaryMonthlyPaymentSuccess.php")? $count++:$sodo++;$totalCount++;
	//     copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/tutoring.php",$userDir."/model/tutoring.php")? $count++:$sodo++;$totalCount++;
	  
	// 	if(true){
	// 	    return array("response"=>"S","data"=>"Files updated");
	// 	}
	// 	else{
	// 	    return array("response"=>"F","data"=>"failed to create Directory!. Internal Error. Please contact 068 515 3023 whatsApp Support to report the issue");
	// 	}
    // }

}
?>