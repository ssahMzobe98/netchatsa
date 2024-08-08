<?php
include_once("../../../vendor/autoload.php");
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
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
	$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
		if(isset($_GET['unisaleInpu'],$_GET['faculty_id'])){
			if(!empty($_GET['unisaleInpu'])&&!empty($_GET['faculty_id'])){
				$uni_id=$_GET['unisaleInpu'];$faculty_id=$_GET['faculty_id'];
				$Courses=$tertiaryApplications->getCoursesOfThisFaculty($uni_id,$faculty_id);
				$facultyName=$tertiaryApplications->getFacultyName($faculty_id)['faculty_name'];
				$campus_id=$Courses[0]['campus_id'];
				$getUniName=$tertiaryApplications->uniName($uni_id)['uni_name'];
				if(count($Courses)==0){
					echo"No Courses Found";
				}
				else{
					?>
					<select class="course_selected">
						<?php
						foreach ($Courses as $row) {
							?>
							<option value="<?php echo $row['course_id'].'-'.$row['course_name'];?>"> <?php echo $row['course_name'];?></option>
							<?php
						}
						?>
					</select>
					<br>
					<div class="saleInput-err" style="width:100%;padding: 10px 10px;"></div>
					<script>
						$(document).ready(function(){
							$(".course_selected").on("change",function(){
								const course_id=$(".course_selected").val();
								if(course_id==""){
									$(".saleInput-err").html("No data Selected");
								}
								else{
									const uni_id="<?php echo $uni_id;?>";
									const uni_name = '<?php echo $getUniName;?>';
									const faculty_id ='<?php echo $faculty_id;?>';
									const faculty_name = '<?php echo $facultyName;?>';
									const mode_of_attendance="Full Time";
									const year_of_study="1st Year";
									const campus_id = '<?php echo $campus_id?>';
									
									$.ajax({
                                		url:'./controller/ajaxCallProcessor.php',
                                		type:'post',
                                		data:{course_id:course_id,uni_id:uni_id,faculty_id:faculty_id,faculty_name:faculty_name,uni_name:uni_name,campus_id:campus_id,mode_of_attendance:mode_of_attendance,year_of_study:year_of_study},
                                		success:function(e){
                                		    response = JSON.parse(e);
											if(response['responseStatus']==='S'){
                                		        $(".saleInput-err").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".saleInput-err").html("Request Successful..");
                                		        loader("apply");
                                		    }
                                		    else{
                                		        $(".saleInput-err").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".saleInput-err").html(e);
                                		    }
                                			
                                		}
                                    });
									

								}
							});
						});
					</script>
					<?php
				}
			}
			else{
				echo"UNKNOWN REQUEST!";
			}
		}	
		else{
			echo"PERMISSION DENIED!";
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