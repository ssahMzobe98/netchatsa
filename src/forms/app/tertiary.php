<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use App\Providers\Factory\Admin\PDOAdminFactory;
use Src\Classes\Pdo\TimePdo;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	// require_once("../controller/pdo.php");
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);	
	$matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$userPdo->connect]);	
	$sgelaUniversity = PDOServiceFactory::make(ServiceConstants::SGELA_UNI_PDO,[$userPdo->connect]);
	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	$status ="tertiary";
    $response=$matricUpgrade->getStudentGradeIfExists($cur_user_row['my_id'],$status);

    // 	print_r($response);
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
				$(".errorRegistrationModea").removeAttr("hidden").attr("style","color:#45f3ff;").html("<img style='width:4%;color:#45f3ff;' src='../img/processor.gif'>Processing Request...");
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

    		$responseReturn=$tertiaryApplications->studentIsPaidThisMonthAndYearTertiary($response['id'],date("Y"),date("m"));
    		if(empty($responseReturn)){
    		
    			echo"<center>
					<h3>Payment Required.</h3>
				</center>";
				$day=date("d");
		        $year=date("Y");
		        $month=date("m");
				$payment_required=150+(150*0.15)+3.50;
		        $payment_required=number_format( sprintf( '%.2f', $payment_required ), 2, '.', '' );
		        $monthText=TimePdo::getMonth($month);
		        
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
					        load("../src/forms/app/tertiaryMonthlyPayment.php");
					    }
					</script>
		       </center>
    			<?php
    		}
    		else{
    			$id=$response['my_id'];
	    if(isset($_GET['_u_'])&&!empty($_GET['_u_'])&&isset($_GET['_uu_'])&&!empty($_GET['_uu_'])){
	        $module=$_GET['_u_'];
	        $chapter=$_GET['_uu_'];
	        if($sgelaUniversity->ismoduleandisstudent($id,$module) && $sgelaUniversity->ischapterandmodule($chapter,$id)) {
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
                       url:"../src/forms/admin/fetchUniContent.php",
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
	        if($sgelaUniversity->ismoduleandisstudent($id,$module)) {
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
                    $sgelavarsychapter=$sgelaUniversity->sgelavarsychapter($module);
                    if(count($sgelavarsychapter)==0){
                        ?>
                        <h5 style="color:red;">No chapters added yet
                        <?php
                    }
                    else{
                        foreach($sgelavarsychapter as $row){
                            
                            
            		        $module_info=$sgelaUniversity->getModuleInfo($row['module']);
            		      //  $chapter_info=$this->getModuleChapterInfo($module_id);
            		        $dir="../img/aa.jpg";
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
                
                $level=$sgelaUniversity->levelInfo($id,"tertiary");//mysqli_fetch_array($conn->query(""))
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
		                $gelaModuleStudent=$sgelaUniversity->gelaModuleStudent($id,$level['level']);
		                //$_=$conn->query("select*from sgelamodulestudent where my_id='$id' and level='".$level['level']."'");
		                if(count($gelaModuleStudent)==0){
		                    ?>
		                    <h5 style="color:red;">No modules installed yet, Click <span style="color:#f3f3f3;">'Install Module'</span> to start installation.</h5>
		                    <?php
		                }
		                else{
		                    foreach($gelaModuleStudent as $row){
		                        
		                        $module_id=$row['module'];
		        		        $module_info=$sgelaUniversity->getModuleInfo($module_id);
		        		        $chapter_info=$sgelaUniversity->getModuleChapterInfo($module_id);
		        		        
		        		        $dir="../img/aa.jpg";
		        		        
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