<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Factory\Admin\PDOAdminFactory;
use App\Providers\Constants\Flags;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['usermail'])){
		$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
  	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
  	$cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$UniAdminPdo = PDOAdminFactory::make(ServiceConstants::UNI_ADMIN_PDO,[$userPdo->connect]);
		if(isset($_GET['course'])&&$_GET['course']>0){
			$course = $cleanData->OMO($_GET['course']);
			$courses = $UniAdminPdo->masomaneGetUniCoursesInfo($course);
			
			if(count($courses)==0){
				echo"No data to display";
			}
			foreach($courses as $data){
					?>
						<div class="box-shadow soloVp">
							<span style="display: flex; cursor: pointer;white-space: nowrap;word-wrap: break-word;hyphens: auto;overflow-wrap: break-word;-ms-word-break: break-all;word-break: break-all;clear: both;vertical-align: bottom;width:100%;">
								<div class="projectElo"><?php echo wordwrap($data['course_name'],37,"<br>\n");?></div>
							</span>
							<span title="Edit Course" style="padding:10px 10px;cursor: pointer;"><i onclick="fa_fa_edit_campus('<?php echo $data['course_id'];?>')" class="fa fa-edit"></i></span>
										<!-- <span title="Delete Campus" style="padding:10px 10px;cursor: pointer;"><i onclick="fa_fa_delete_campus('<?php //echo $row['campus_id'];?>')" class="fa fa-trash"></i></span> -->
							
						</div>
						
					<?php
			}
		}
		else{
			echo"BAD REQUEST!!";
		}
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../?fghfghfghgfh");
	</script>

	<?php
}
?> 