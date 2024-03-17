<?php
include_once("../../../vendor/autoload.php");
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
  $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
  $tertiaryApplicationsPdo = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
  $adminPdo = PDOServiceFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
  $uniAdminPdo = PDOServiceFactory::make(ServiceConstants::UNI_ADMIN_PDO,[$userPdo->connect]);
  $cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
  $matricUpgradeAdminPdo = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_ADMIN,[$userPdo->connect]);
	if(isset($_GET['applicant'])){
	    $studentId = $cleanData->OMO($_GET['applicant']);
		$response = $tertiaryApplicationsPdo->getStudentInfoPayload($studentId);
		$step1=$response['step1'];
		$getDocUrl = $tertiaryApplicationsPdo->getDocUrl($step1['std_id']);
		$step2=$response['step2'];
		$step3=$response['step3'];
		$step4=$response['step4'];
		$step5=$response['step5'];
		?>
	 
	    <style>
	        .displayerBoard{
				width: 100%;
				padding: 5px 5px;
				display: flex;
			}
			.displayLeft{
				width:33.5%;
				padding: 5px 10px;
			}
			.displayerBoardCenter{
				width:33.5%;
				padding: 5px 10px;
			}
			.displayRight{
				width:33.5%;
				padding: 5px 10px;
			}
			.displayMacLeft{
				width: 100%;
				padding: 5px 5px;
				border-radius: 10px;
				border-right: 2px solid rebeccapurple;
				border-left: 2px solid mediumvioletred;
				overflow-y: scroll;
				white-space: nowrap;
				word-wrap: break-word;
				hyphens: auto;
				height: 68vh;
				justify-content: space-between;
	  				
					/*border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;*/
			}
			.displayMacLeft::-webkit-scrollbar{
				  width:1px;
			}
			.displayMacLeft::-webkit-scrollbar-thumb {
			  background: red; 
			  border-radius: 10px;
			}
			.displayMacCenter{
				width: 100%;
				padding: 5px 5px;
				border-radius: 10px;
				border-right: 2px solid rebeccapurple;
				border-left: 2px solid mediumvioletred;
				overflow-y: scroll;
				white-space: nowrap;
				word-wrap: break-word;
				hyphens: auto;
				height: 68vh;
				justify-content: space-between;
	  				
					/*border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;*/
			}
			.displayMacCenter::-webkit-scrollbar{
				  width:1px;
			}
			.displayMacCenter::-webkit-scrollbar-thumb {
			  background: red; 
			  border-radius: 10px;
			}
			.displayMacRight{
				width: 100%;
				padding: 5px 5px;
				border-radius: 10px;
				border-right: 2px solid rebeccapurple;
				border-left: 2px solid mediumvioletred;
				overflow-y: scroll;
				white-space: nowrap;
				word-wrap: break-word;
				hyphens: auto;
				height: 68vh;
				justify-content: space-between;
	  				
					/*border-top: 2px solid rebeccapurple;
					border-bottom: 2px solid mediumvioletred;*/
			}
			.displayMacRight::-webkit-scrollbar{
				  width:1px;
			}
			.displayMacRight::-webkit-scrollbar-thumb {
			  background: red; 
			  border-radius: 10px;

			}
			.izikoleZakithi{
				width:100%;
				padding: 10px 10px;
				color:#ddd;
				text-align: left;
				display: flex;
				border-radius: 10px 10px;
				border-right: 2px solid mediumvioletred;
				border-left: 2px solid rebeccapurple;
				cursor: pointer;
			}
			.activeBtn{
				border-bottom: 2px solid mediumvioletred;
				border-top: 2px solid rebeccapurple;
				background: -webkit-linear-gradient(mediumvioletred,purple,rebeccapurple);
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			}
	    </style>
	    <div class="displayerBoard">
			<div class="displayLeft">
				<div class="displayMacLeft" id="displayMacLeft">
				    <center><span style="background:none;width:100%;border:none;color:mediumvioletred;border:1px solid rebeccapurple;border-radius:100px;padding:10px 10px;">Student Details</span></center>
				    <div class="rudelf">
				        <style>
				            table{
				                padding:10px 10px;
				                width:100%;
				                border:1px solid mediumvioletred;
				                border-radius:10px;
				            }
				            tr{
				                padding:10px 10px;
				            }
				            th{
				                padding:10px 10px;
				                background: -webkit-linear-gradient(mediumvioletred,purple,rebeccapurple);
                    			-webkit-background-clip: text;
                    			-webkit-text-fill-color: transparent;
                    			text-align:left;
                    			border:1px solid rebeccapurple;
				            }
				            td{
				                border:1px solid rebeccapurple;
				                padding:10px 10px;
				                text-align:left;
				            }
				        </style>
				       <table>
				        <tr>
			                <th>Title</th>
			                <th>Initials</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['title'];?></span></td>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['initials'];?></span></td>
			            </tr>
			            <tr>
			                <th>First Name</th>
			                <th>Last Name</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['lname'];?></span></td>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['fname']."({$step2['status']})";?></span></td>
			            </tr>
			            <tr>
			                <th>ID/Passport</th>
			                <th>DOB-Gender</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['idnumber']??$step2['passport']??"No ID Available";?></span></td>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['dob']." | {$step2['gender']}";?></span></td>
			            </tr>
			            <tr>
			                <th>Year Applied</th>
			                <th>About us From?</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['year'];?></span></td>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['hear'];?></span></td>
			            </tr>
			            <tr>
			                <th>EthnicGroup</th>
			                <th>Home Language</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['ethnicgroup'];?></span></td>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $adminPdo->languagesString($step2['hlang']);?></span></td>
			            </tr>
			            <tr>
			                <th>Are you Employed?</th>
			                <th>Need Bursary?</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['employed'];?></span></td>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step2['bursary'];?></span></td>
			            </tr>
			          </table>
				    </div>
				</div>
				
			</div>
			<div class="displayerBoardCenter">
				<div class="displayMacCenter" id="displayMacCenter">
				    <center><span style="background:none;width:100%;border:none;color:mediumvioletred;border:1px solid rebeccapurple;border-radius:100px;padding:10px 10px;">Parent Details</span></center>
				    <div class="rudelf">
				        <style>
				            table{
				                padding:10px 10px;
				                width:100%;
				                border:1px solid mediumvioletred;
				                border-radius:10px;
				            }
				            tr{
				                padding:10px 10px;
				            }
				            th{
				                padding:10px 10px;
				                background: -webkit-linear-gradient(mediumvioletred,purple,rebeccapurple);
                    			-webkit-background-clip: text;
                    			-webkit-text-fill-color: transparent;
                    			text-align:left;
                    			border:1px solid rebeccapurple;
				            }
				            td{
				                border:1px solid rebeccapurple;
				                padding:10px 10px;
				                text-align:left;
				            }
				        </style>
				       <table>
			            <tr>
			                <th>Parent</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step4['fname']." ".$step4['lname'];?></span></td>
			            </tr>
			            <tr>
			                <th>Relationship</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step4['relationship']; echo" (".($step4['employed']=="Yes")?"Employed":"Not Employed".")";?></span></td>
			            </tr>
			            <tr>
			                <th>Phone No.</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step4['phone']."/".$step4['alphone'];?></span></td>
			            </tr>
			            <tr>
			                <th>Email Address</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step4['email'];?></span></td>
			            </tr>
			            <tr>
			                <th>Home Address</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step4['street']."<br>".$step4['suburb']."<br>".$step4['town']." | ".$step4['province']."<br>".$step4['postal'];?></span></td>
			                
			            </tr>
			          </table>
				    </div>
				</div>
			</div>
			<div class="displayRight">
					<div class="displayMacRight" id="displayMacRight">
					    <center><span style="background:none;width:100%;border:none;color:mediumvioletred;border:1px solid rebeccapurple;border-radius:100px;padding:10px 10px;">School Results(Gr11/Gr12)</span></center>
					    <div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
        					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects1']),30,"<br>");?></div>
        					<span style="padding:10px 10px;"><?php echo $step1['levelmark1'];?></span> 
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark11']."%";?></span>
        				</div>
        				<br>
        				<div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
        					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects2']),30,"<br>");?></div>
        					<span style="padding:10px 10px;"><?php echo $step1['levelmark2'];?></span> 
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark22']."%";?></span>
        				</div>
        				<br>
        				<div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
        					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects3']),30,"<br>");?></div>
        					<span style="padding:10px 10px;"><?php echo $step1['levelmark3'];?></span> 
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark33']."%";?></span>
        				</div>
        				<br>
        				<div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
        					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects4']),30,"<br>");?></div>
        					<span style="padding:10px 10px;"><?php echo $step1['levelmark4'];?></span>
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark44']."%";?></span>
        				</div>
        				<br>
        				<div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
        					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects5']),30,"<br>");?></div>
        					<span style="padding:10px 10px;"><?php echo $step1['levelmark5'];?></span>
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark55']."%";?></span>
        				</div>
        				<br>
        				<div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
        					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects6']),30,"<br>");?></div>
        					<span style="padding:10px 10px;"><?php echo $step1['levelmark6'];?></i></span>
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark66']."%";?></span>
        				</div>
        				<br>
        				<div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
        					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects7']),30,"<br>");?></div>
        					<span style="padding:10px 10px;"><?php echo $step1['levelmark7'];?></span>
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark77']."%";?></span>
        				</div>
        				<br>
        				<?php
        				if(!empty($step1['subjects8'])){
        				    ?>
        				    <div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
            					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects8']),30,"<br>");?></div>
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark8'];?></span> 
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark88']."%";?></span>
            				</div><br>
        				    <?php
        				}
        				if(!empty($step1['subjects9'])){
        				    ?>
        				<div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
        					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects9']),30,"<br>");?></div>
        					<span style="padding:10px 10px;"><?php echo $step1['levelmark9'];?></i></span>
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark99']."%";?></span>
        				</div><br>
        				    <?php
        				}
        				if(!empty($step1['subjects10'])){
        				?>
        				<div class="izikoleZakithi box-shadow activate<?php echo $step1['id'];?>" id="inactive" >
        					<div style="width:100%;"><?php echo wordwrap($matricUpgradeAdminPdo->getSubjectString($step1['subjects10']),30,"<br>");?></div>
        					<span style="padding:10px 10px;"><?php echo $step1['levelmark10'];?></span> | 
            					<span style="padding:10px 10px;"><?php echo $step1['levelmark1010']."%";?></span>
        				</div><br>
        			    <?php
        				}
        			    ?>
					</div>
			</div>
		</div>
		<hr>
		<div class="displayerBoard">
			<div class="displayLeft">
				<div class="displayMacLeft" id="displayMacLeft">
				    <center><span style="background:none;width:100%;border:none;color:mediumvioletred;border:1px solid rebeccapurple;border-radius:100px;padding:10px 10px;">Education Details</span></center>
				    <div class="rudelf">
				        <style>
				            table{
				                padding:10px 10px;
				                width:100%;
				                border:1px solid mediumvioletred;
				                border-radius:10px;
				            }
				            tr{
				                padding:10px 10px;
				            }
				            th{
				                padding:10px 10px;
				                background: -webkit-linear-gradient(mediumvioletred,purple,rebeccapurple);
                    			-webkit-background-clip: text;
                    			-webkit-text-fill-color: transparent;
                    			text-align:left;
                    			border:1px solid rebeccapurple;
				            }
				            td{
				                border:1px solid rebeccapurple;
				                padding:10px 10px;
				                text-align:left;
				            }
				        </style>
				       <table>
			            <tr>
			                <th>School Name</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $adminPdo->getSchool($step5['schoolname'])['school']."<br>".$step5['street']."<br>".$step5['suburb']."<br>".$step5['town']." | ".$step5['province']."<br>".$step5['postal'];?></span></td>
			            </tr>
			            <tr>
			                <th>Matric Year Completed</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step5['yearcompleted'];?></span></td>
			            </tr>
			            <tr>
			                <th>Current Activity</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step5['activity'];?></span></td>
			            </tr>
			            <tr>
			                <th>Educational History</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo $step5['eduhistory'];?></span></td>
			            </tr>
			            <tr>
			                <th>University Attended</th>
			            </tr>
			            <tr>
			                <td><span  style="width:100%;padding:10px 10px;"><?php echo (empty($step5['uni'])?"N\A":$uniAdminPdo->masomaneGetUniInfo($step5['uni'])['uni_name'])."<br>".$step5['studentnumber']."<br>".$step5['statuscompletion']?></span></td>
			            </tr>
			          </table>
				    </div>
				</div>
			</div>
			<div class="displayerBoardCenter">
				<div class="displayMacCenter" id="displayMacCenter">
				    <center><span style="background:none;width:100%;border:none;color:mediumvioletred;border:1px solid rebeccapurple;border-radius:100px;padding:10px 10px;">Documents</span></center>
				    <a download href="../../accounts/<?php echo $getDocUrl."/".$step5['idcopy'];?>"><div class="izikoleZakithi box-shadow" id="inactive" >
    					<div style="width:100%;"><?php echo "Student ID Copy";?></div>
    					<span style=""><i class="fa fa-download" style="padding:10px 10px;color:#ddd;"></i></span> 
    				</div></a>
    				<br>
    				<a download href="../../accounts/<?php echo $getDocUrl."/".$step5['finalresults'];?>"><div class="izikoleZakithi box-shadow" id="inactive" >
    					<div style="width:100%;"><?php echo "School Results";?></div>
    					<span style=""><i class="fa fa-download" style="padding:10px 10px;color:#ddd;"></i></span> 
    				</div></a>
    				<br>
    				<a download href="../../accounts/<?php echo $getDocUrl."/".$step5['proofresident'];?>"><div class="izikoleZakithi box-shadow" id="inactive" >
    					<div style="width:100%;"><?php echo "Proof Of Residents";?></div>
    					<span style=""><i class="fa fa-download" style="padding:10px 10px;color:#ddd;"></i></span> 
    				</div></a>
    				<br>
    				<a download href="../../accounts/<?php echo $getDocUrl."/".$step5['guardianid'];?>"><div class="izikoleZakithi box-shadow" id="inactive" >
    					<div style="width:100%;"><?php echo "Parent/Guardian ID";?></div>
    					<span style=""><i class="fa fa-download" style="padding:10px 10px;color:#ddd;"></i></span> 
    				</div></a>
    				<br>
    				
				</div>
			</div>
			<!--<div class="displayRight">-->
			<!--		<div class="displayMacRight" id="displayMacRight"></div>-->
			<!--</div>-->
		</div>
		<section style="padding:20px 10px;">
		    <div class="romeAdd">
		        <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="color:white;">University</th>
                        <th style="color:white;">Applicatioin Link|API</th>
                        <th style="color:white;">Study Choice</th>
                        <th style="color:white;">Student No</th>
                        <th style="color:white;">Password</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $applications= $tertiaryApplicationsPdo->getfinalApplication($studentId);
                      $count = 0;
                      foreach($applications as $row){
                          $student_no=$row['student_no'];
                          $password=$row['password'];
                          $disabled = (empty($student_no)?"":"disabled");
                          $disabledPass = empty($password)?'':'disabled';
                          $input = "<input style='padding:3px 3px;width:50px;height:30px;border:none;border-radius:100px;background:none;color:white;' type='text' value='{$student_no}' $disabled><span class='badge badge-primary text-white text-center'>-></span>";
                          $pass = "<input style='padding:3px 3px;width:50px;height:30px;border:none;border-radius:100px;background:none;color:white;' type='text' value='{$password}' $disabledPass><span class='badge badge-primary text-white text-center'>-></span>";
                       ?>
                            <tr>
                              <td <?php if($count%2==0){echo 'style="color:limegreen;"';}else{echo 'style="color:white;"';} ?>><?php echo  $row['uni_name'];?></td>
                              <td <?php if($count%2==0){echo 'style="color:limegreen;"';}else{echo 'style="color:white;"';} ?>><?php echo  $row['api'];?></td>
                              <td <?php if($count%2==0){echo 'style="color:limegreen;"';}else{echo 'style="color:white;"';} ?>><?php echo  $row["study_choice"];?></td>
                              <td <?php if($count%2==0){echo 'style="color:limegreen;"';}else{echo 'style="color:white;"';} ?>><?php echo $input  ;?></td>
                              <td <?php if($count%2==0){echo 'style="color:limegreen;"';}else{echo 'style="color:white;"';} ?>><?php echo $pass  ;?></td>
                              
                          </tr>
                          <?php
                            $count++;
                      }
                      ?>
                      
                      <tfoot>
                        <th style="color:white;">University</th>
                        <th style="color:white;">Applicatioin Link|API</th>
                        <th style="color:white;">Study Choice</th>
                        <th style="color:white;">Student No</th>
                        <th style="color:white;">Password</th>
                      </tfoot>
                     
                    </tbody>
                </table>
		    </div>
		</section>
	    
	    <?php
	    }
	    else{
	        echo"UKNOWN REQUEST!!";
	    }
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../");
	</script>

	<?php
}
?>