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
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
	$matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$userPdo->connect]);
	$dramaClassPdo = PDOServiceFactory::make(ServiceConstants::DRAMA_CLASS_PDO,[$userPdo->connect]);
	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	// print_r($cur_user_row);
	$data=$tertiaryApplications->isLevelOfApplicaation($cur_user_row['my_id']);
	// print_r($isLevelOfApplicaation);
	// $data=$isLevelOfApplicaation;
	?>
	<style>
		.rulesNetWorks{
			width: 100%;
			background: #212121;
/*				border: 1px solid #45f3ff;*/
			border-radius: 5px;
			min-height: 100%;
			height: auto;
			box-shadow: 0px 0px 15px rgba(0,0,0,.5);
			
		}
	</style>
	<div class="rulesNetWorks">
<style>
	.flex{
		display: flex;
	}
	.step2{
		width: 100%;
		padding: 10px 0;
		align-content: center;
		text-align: center;
	}
	.step2 .headerWarner{
		width: 98%;
		color: #45f3ff;
		background-color: #222;
		border-radius: 10px;
		box-shadow: 0 8px 6px -6px black;
		margin-left: 1%;
		opacity: .9;
	}
	.step2 .personalDetails{
		width: 98%;
		background-color: 	#222;
		color: #45f3ff;
		margin-left: 1%;
		border-radius: 10px;
		box-shadow: 0 8px 6px -6px black;
		opacity: .9;
	}
	.step2 .personalDetails .info{
		align-content: center;
		text-align: center;
		width: 60%;
		/*border: 1px solid red;*/
		margin-left: 10%;
		padding: 10px;
	}
	.step2 .personalDetails .info .div{
		align-content: center;
		text-align: center;
		width: 70%;
		/*border: 1px solid blue;*/
		padding: 3px;
	}
	.step2 .personalDetails .info .div2{
		align-content: center;
		text-align: center;
		width: 30%;
		/*border: 1px solid blue;*/
		padding: 3px;
	}
	.step2 .personalDetails .info .div2 select{
		background-color: #222;
		color: #45f3ff;
		width: 100%;
		border: none;
		background-color: #212121;
	}
	.step2 .personalDetails .foreign,.southafrican{
		align-content: center;
		justify-content: safe center;
	}
	.step2 .personalDetails .info1{
		align-content: center;
		text-align: center;
		width: 100%;
		/*border: 1px solid red;*/
		
		padding: 10px;
	}
	.step2 .personalDetails .info1 .myPerso{
		width: 100%;
		justify-content: legacy left;
		text-align: left;
		
	}
	.step2 .personalDetails .info1 .myPerso .left{
		width:50%;
		padding: 10px 0;
		
	}
	.step2 .personalDetails .info1 .myPerso .right{
		width:60%;
	}
	.step2 .personalDetails .info1 .myPerso .right input,select{
		width: 100%;
		padding: 5px 0;
		color: #45f3ff;
		background-color: #222;
		border: none;
		border-bottom: 2px solid #45f3ff;
		cursor: pointer;
	}
	.step2 .personalDetails .btn{
		width: 80%;
		background-color: navy;
		color: #45f3ff;
		cursor: pointer;
		border-radius: 10px;
	}
	.step2 .personalDetails .btn{
		background-color: #212121;
		border: 2px solid white;
		padding: 5px 5px;
		width: 100%;
		background-color: #212121;
		color: white;
		font-size: 15px;
	}
	.step2 .personalDetails .btn:hover{
		background-color: #212121;

	}
	.step2 .personalDetails .info .info1 .btnn{
		width: 100%;
	}
	.step2 .personalDetails .info1 .btnn:hover{
		color: navy;
		border: 2px solid navy;
	}
	.bodyDisplaySgela{
		display: flex;
		padding: 10px 0;
		width: 100%;
		justify-content: center;
		justify-items: center;
		text-align: center;
	}
	.bodyDisplaySgela .Grade12,.uni,.learntocode{
		width: 50%;
		
	}
	.bodyDisplaySgela .Grade12 img,.uni img{
		width: 80%;
	}




	@media only screen and (max-width: 800px){
		.flex{
			display: block;
		}
		.step2 .personalDetails .info .div{
			width: 100%;
		}
		.step2 .personalDetails .info .info1 .btnn:{
			width: 100%;
		}
		.step2 .personalDetails .info1 .myPerso{
			display: block;
		}
		.step2 .personalDetails .info1 .myPerso .right{
			width: 100%;
		}
		.step2 .personalDetails .info1 .myPerso .left{
			width: 100%;
		}
	}
</style>
			<?php
			// print_r($data);
			if(empty($data)){
				echo"<div class='set-trap'>";
				?>

				<style>
        		    .foApply{
        		        width:100%;
        		        text-align:left;
        		        color:#45f3ff;
        		        margin-top:7%;
        		        
        		    }
        		    .appBtn{
        		    	background:#45f3ff;
        		    	color:purple;
        		    	border: purple;
        		    }
        		    .appBtn:hover{
        		    	background:purple;
        		    	color:#45f3ff;
        		    	border:#45f3ff;
        		    }
        		    h2,p,h5{
        		    	color:#45f3ff;
        		    }
        		</style>
        		<div class="foApply">
        		    <ul>
        		        <li>
        		           <h6>By Applying using this application System, you will apply to all universities of your choice with just one application process and be able to track application status, update application information, and accept firm offers.</h6> 
        		        </li>
        		        <li>
        		           <h6>Exciting part about netchatsa is that you do not have to worry about funding application. The app will take care of it. NSFAS and other Funding Applications will be based on the select Courses as your choice of study. They will be displayed below your tertiary applications statuses.</h6> 
        		        </li>
        		    </ul>
        		</div>
        		<style>
        	        #acho-date{
        	            text-align: center;
                      font-size: 100px;
                      margin-top: 0px;
        	        }
        	        #acho-date #d{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #h{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #m{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #d{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #m{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #s{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	    </style>
        	    
        		<h5>
        		    2023/2024 Tertiary Applications including NSFAS & Bursary Applications:
        		    <br>Opening Date: 20 January 2023
        		    <br>Closing date: 30 July 2023
        		</h5>
        		<h4 style='color:red;'>Applications are now Closed :</h4> <!--<p id="acho-date">30 July 2023</p>-->
        		<p style='color:red;'>
        		    Applications are only open for Testing|Jusging by MTN AWARDS Competition.
        		 </p>
        		    <h4 style='color:#45f3ff;'>JUDGES PLEASE NOTE:</h4>
        		<p style='color:red;'>
        		    <span style='color:#45f3ff;'>Tertiary Applications</span> is the only feature that is entering this competition. 
        		    Feel free to test other features, But know that the <span style='color:#45f3ff;'>Tertiary Applications</span> is the only feature sent to represent us. Feature (<span style='color:#45f3ff;'>Matric Upgrade</span>, <span style='color:#45f3ff;'>High School Self Learning</span> and <span style='color:#45f3ff;'>Tertiary Self Learning</span> are currently fully active for production testing to only privately selected users).
        		</p>
        		<button class="btn appBtn" id="beginAppProcess" onclick="beginAppProcess()" >APPLY ( <span style="color:green;">OPEN</span>)</button>
        		
				<?php
				echo"</div>

				<div class='set-trapAcep'>";
				?>
					<style>.flex{display:flex;}</style>
					<div class="schoolResults">
						<div class="macMalow">
							<h2>Enter School Results below</h2>
							<h5>NB: <small style="color:red;">to qualify you must have atleast 60%</small></h5>
						</div>
						<hr>
						<div class="grade">
							<h5>Select Grade Level</h5>
							<select id="grdlevel" required>
								<option value="">--select Grade Level--</option>
								<option value="0">Current Gr12</option>
								<option value="1">Post Gr12</option>
							</select>
							<div id="grd" hidden></div>
							<h5>Enter Number Of Subject</h5>
							<input type="number" id="numOfSubj" max="10" min="7" placeholder="enter number of subjects" required>
							<div id="num" hidden></div>
							<span><br>cvb</span>
						</div>
						<hr>
						<center>
							<div class="topicId flex">
								<div class="leftTf"><h5>Subject</h5></div>
								<div class="centerTf"><h5>Score</h5></div>
								<div class="rightTf"><h5>Perc%</h5></div>

							</div>
						</center>


						<div class="flexMatch ">
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects1" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
									<div id="subjects1Error" hidden></div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark1" min="0" max="10" placeholder="7">
									</div>
									<div id="levelMark1Error" hidden></div>
								</div>

								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark11" min="0" max="100" placeholder="95">
									</div>
									<div id="levelMark11Error" hidden></div>
								</div>
							</div>
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects2" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
									<div id="subjects2Error" hidden></div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark2" min="0" max="10" placeholder="7">
										
									</div>
									<div id="levelMark2Error" hidden></div>
								</div>

								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark22" min="0" max="100" placeholder="95">
									</div>
									<div id="levelMark22Error" hidden></div>
								</div>
							</div>
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects3" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
									<div id="subjects3Error" hidden></div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark3" min="0" max="10" placeholder="7">
									</div>
									<div id="levelMark3Error" hidden></div>
								</div>
								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark33" min="0" max="100" placeholder="95">
									</div>
									<div id="levelMark33Error" hidden></div>
									
								</div>
							</div>
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects4" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
									<div id="subjects4Error" hidden></div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark4" min="0" max="10" placeholder="7">
									</div>
									<div id="levelMark4Error" hidden></div>
								</div>

								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark44" min="0" max="100" placeholder="95">
									</div>
									<div id="levelMark44Error" hidden></div>
									
								</div>
							</div>
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects5" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
									<div id="subjects5Error" hidden></div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark5" min="0" max="10" placeholder="7">
									</div>
									<div id="levelMark5Error" hidden></div>
								</div>

								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark55" min="0" max="100" placeholder="95">
									</div>
									<div id="levelMark55Error" hidden></div>
									
								</div>
							</div>
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects6" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
									<div id="subjects6Error" hidden></div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark6" min="0" max="10" placeholder="7">
									</div>
									<div id="levelMark6Error" hidden></div>
								</div>

								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark66" min="0" max="100" placeholder="95">
									</div>
									<div id="levelMark66Error" hidden></div>
									
								</div>
							</div>
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects7" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
									<div id="subjects7Error" hidden></div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark7" min="0" max="10" placeholder="7">
									</div>
									<div id="levelMark7Error" hidden></div>
								</div>

								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark77" min="0" max="100" placeholder="95">
									</div>
									<div id="levelMark77Error" hidden></div>
									
								</div>
							</div>
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects8" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark8" min="0" max="10" placeholder="7">
									</div>
								</div>

								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark88" min="0" max="100" placeholder="95">
									</div>
									
								</div>
							</div>
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects9" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark9" min="0" max="10" placeholder="7">
									</div>
								</div>

								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark99" min="0" max="100" placeholder="95">
									</div>
									
								</div>
							</div>
							<div class="flex">
								<div class="Ieleft">
									<div class="subjects">
										<select id="subjects10" required>
											<option value="">-- Select your Subject --</option>
											<?php $matricUpgrade->getMatricSubjects();?>
										</select>
									</div>
								</div>
								<div class="Iecenter">
									<div class="marks">
										<input type="number" id="levelMark10" min="0" max="10" placeholder="7">
									</div>
								</div>

								<div class="Ieright">
									<div class="marks">
										<input type="number" id="levelMark1010" min="0" max="100" placeholder="95">
									</div>
								</div>
							</div>
							<br>
							<div class="submitBtn">
								<button class="btn" id="step1Btn" onclick="step1Btn()">Submit</button>
							</div>
							<br>
						</div>
						<div class="errorCatch" hidden=""></div>
					</div>

				<?php
				echo"<div>";

				?>
				<div class="doNotQualify">
					<center><h2 style="color: white;background: red;padding: 10px 10px;">Sorry Your average mark is less than the requirements of the tertiary institutions. Please upgrade your results.</h2></center>
				</div>
				<div class="progress" hidden></div>
				<script>
					supSetDefault();
					function beginAppProcess(){
						$(".set-trap").fadeOut();
						$(".set-trapAcep").fadeIn();
						$(".doNotQualify").hide();
					}
					function supSetDefault(){
						$(".set-trap").show();
						$(".set-trapAcep").hide();
						$(".doNotQualify").hide();
					}
					function doNotQualify(){
						$(".set-trapAcep").fadeOut();
						$(".set-trap").hide();
						$(".doNotQualify").fadeIn();
					}
				</script>
				<?php

			}
			else{
				$level=$tertiaryApplications->getLevelOfApplication($cur_user_row['my_id']);
				if($level==1){
					$dramaClassPdo->step2($data);
				}
				elseif($level==2){
					$dramaClassPdo->step3($data);
				}
				elseif($level==3){
					$dramaClassPdo->step4($data);
				}
				elseif($level==4){
					$dramaClassPdo->step5($data);
				}
				elseif($level==5){
					$dramaClassPdo->step6($data);
				}
				elseif($level==6){
					$dramaClassPdo->step7($data);
				}
				elseif($level==7){
					$dramaClassPdo->step8($data);
				}
				elseif($level==8){
					$dramaClassPdo->step9($data);
				}
				elseif($level==9){
					$dramaClassPdo->step10($data);
				}
				else{
					echo"CAN'T GO PAST THIS POINT";
				}
			}
		?>
		</div>
		<script>
			function step1Btn(){
				$(".progress").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
				const grdlevel=$("#grdlevel").val();
				const numOfSubj=$("#numOfSubj").val();
				const subjects1=$("#subjects1").val();
				const levelMark1=$("#levelMark1").val();
				const levelMark11=$("#levelMark11").val();
				const subjects2=$("#subjects2").val();
				const levelMark2=$("#levelMark2").val();
				const levelMark22=$("#levelMark22").val();
				const subjects3=$("#subjects3").val();
				const levelMark3=$("#levelMark3").val();
				const levelMark33=$("#levelMark33").val();
				const subjects4=$("#subjects4").val();
				const levelMark4=$("#levelMark4").val();
				const levelMark44=$("#levelMark44").val();
				const subjects5=$("#subjects5").val();
				const levelMark5=$("#levelMark5").val();
				const levelMark55=$("#levelMark55").val();
				const subjects6=$("#subjects6").val();
				const levelMark6=$("#levelMark6").val();
				const levelMark66=$("#levelMark66").val();
				const subjects7=$("#subjects7").val();
				const levelMark7=$("#levelMark7").val();
				const levelMark77=$("#levelMark77").val();
				const subjects8=$("#subjects8").val();
				const levelMark8=$("#levelMark8").val();
				const levelMark88=$("#levelMark88").val();
				const subjects9=$("#subjects9").val();
				const levelMark9=$("#levelMark9").val();
				const levelMark99=$("#levelMark99").val();
				const subjects10=$("#subjects10").val();
				const levelMark10=$("#levelMark10").val();
				const levelMark1010=$("#levelMark1010").val();	
				if(grdlevel.length==0){
					$("#grd").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(numOfSubj.length==0){
					$("#num").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects1.length==0){
					$("#subjects1Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark1.length==0){
					$("#levelMark1Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark11.length==0){
					$("#levelMark11Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects2.length==0){
					$("#subjects2Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark2.length==0){
					$("#levelMark2Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark22.length==0){
					$("#levelMark22Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects3.length==0){
					$("#subjects3Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark3.length==0){
					$("#levelMark3Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark33.length==0){
					$("#levelMark33Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects4.length==0){
					$("#subjects4Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark4.length==0){
					$("#levelMark4Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark44.length==0){
					$("#levelMark44Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects5.length==0){
					$("#subjects5Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark5.length==0){
					$("#levelMark5Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark55.length==0){
					$("#levelMark55Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects6.length==0){
					$("#subjects6Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark6.length==0){
					$("#levelMark6Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark66.length==0){
					$("#levelMark66Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects7.length==0){
					$("#subjects7Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark7.length==0){
					$("#levelMark7Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark77.length==0){
					$("#levelMark77Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else{
					const arr=[subjects1,subjects2,subjects3,subjects4,subjects5,subjects6,subjects7,subjects8,subjects9,subjects10];
					const pri=[levelMark11,levelMark22,levelMark33,levelMark44,levelMark55,levelMark66,levelMark77,levelMark88,levelMark99,levelMark1010];
					var total=0;
					var subj=1;
					for (var i = arr.length - 1; i >= 0; i--) {
						if(arr[i].length>0 && arr[i]!=10029){
							total=total+parseInt(pri[i]);
							subj++;
						}
					}
					if(grdlevel==1 && (total/subj)<40){
						doNotQualify();
					}
					else{
						$.ajax({
			                url:'./controller/ajaxCallProcessor.php',
			                type:'post',
			                data:{
			                	grdlevel:grdlevel,
								subjects1:subjects1,
								levelMark1:levelMark1,
								levelMark11:levelMark11,
								subjects2:subjects2,
								levelMark2:levelMark2,
								levelMark22:levelMark22,
								subjects3:subjects3,
								levelMark3:levelMark3,
								levelMark33:levelMark33,
								subjects4:subjects4,
								levelMark4:levelMark4,
								levelMark44:levelMark44,
								subjects5:subjects5,
								levelMark5:levelMark5,
								levelMark55:levelMark55,
								subjects6:subjects6,
								levelMark6:levelMark6,
								levelMark66:levelMark66,
								subjects7:subjects7,
								levelMark7:levelMark7,
								levelMark77:levelMark77,
								subjects8:subjects8,
								levelMark8:levelMark8,
								levelMark88:levelMark88,
								subjects9:subjects9,
								levelMark9:levelMark9,
								levelMark99:levelMark99,
								subjects10:subjects10,
								levelMark10:levelMark10,
								levelMark1010:levelMark1010,
								total:total,
								subj:subj
			                },
			                success:function(e){
			                    response = JSON.parse(e);
			                    if(response['responseStatus']==='F'){
			                        $(".progress").attr("style","padding:5px 5px;color:red;width:100%;").html(response['responseMessage']);
			                    }
			                    else{
			                        
			                         $(".progress").attr("style","padding:5px 5px;color:green;width:100%;border:1px solid white;").html("Data Submitted Successfully please wait, redirecting...");
			                         loader("apply");
			                    }
			                    
			                }
			            });
					}
					
				}
			}
			function submitStep2(app_idStep2,my_id){
					const gender=$("#gender").val();
					const dob=$("#dob").val();
					const title=$("#title").val();
					const initials=$("#initials").val();
					const lname=$("#lname").val();
					const fname=$("#fname").val();
					const status=$("#status").val();
					const hlang=$("#hlang").val();
					const ethnicGroup=$("#EthnicGroup").val();
					const employed=$("#Employed").val();
					const hear=$("#hear").val();
					const bursary=$("#bursary").val();
					const sa=$("#sa").val();
					var id_num=0;
					var nationality= "";
				  	if(sa=="Yes"){
				  		id_num=$("#idNumber").val();
				  		nationality="South African";
				  	}
				  	if(sa=="No"){
				  		id_num=$("#passport").val();
				  		nationality="foreign nationality";
				  	}
				  	if(sa==""){
				  		$(".errorMessage").removeAttr("hidden").attr("style","color:red;").html("Required**");
				  	}
					else if(gender==""){
						$("#errorgender").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(dob==""){
						$("#errordob").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(title==""){
						$("#errortitle").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(initials==""){
						$("#errorinitials").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(lname==""){
						$("#errorlname").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(fname==""){
						$("#errorfname").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(status==""){
						$("#errorstatus").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(hlang==""){
						$("#errorhlang").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(ethnicGroup==""){
						$("#errorEthnicGroup").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(employed==""){
						$("#errorEmployed").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(hear==""){
						$("#errorhear").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(bursary==""){
						$("#errorbursary").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else{
						$.ajax({
			                url:'./controller/ajaxCallProcessor.php',
			                type:'post',
			                data:{
								gender:gender,
								dob:dob,
								title:title,
								initials:initials,
								lname:lname,
								fname:fname,
								status:status,
								hlang:hlang,
								ethnicGroup:ethnicGroup,
								employed:employed,
								hear:hear,
								bursary:bursary,
								id_num:id_num,
								nationality:nationality,
								app_idStep2:app_idStep2,
								my_id:my_id
			                },
			                success:function(e){
			                	resonse = JSON.parse(e);

			                    if(response['responseStatus']==='F'){
			                        $(".submitStep2").attr("style","padding:5px 5px;color:red;width:100%;").html(response['responseMessage']);
			                    }
			                    else{
			                         $(".submitStep2").html("Data Submitted Successfully please wait, redirecting...");
			                         loader("apply");
			                    }
			                    
			                }
			            });
					}

				}
		</script>		
		<?php
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