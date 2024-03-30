<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use App\Providers\Factory\Admin\PDOAdminFactory;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['usermail'])){
 $userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
  	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
  	$cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$UniAdminPdo = PDOAdminFactory::make(ServiceConstants::UNI_ADMIN_PDO,[$userPdo->connect]);
		if(isset($_GET['campus'])&&$_GET['campus']>0){
			$campus = $cleanData->OMO($_GET['campus']);
			$faculties = $UniAdminPdo->masomaneGetUniFacultyInfo($campus);
			
			if(count($faculties)==0){
				echo"No data to display";
			}
			foreach($faculties as $data){
					?>
						<div class="box-shadow soloVp">
							<span style="display: flex; cursor: pointer;white-space: nowrap;word-wrap: break-word;hyphens: auto;overflow-wrap: break-word;-ms-word-break: break-all;word-break: break-all;clear: both;vertical-align: bottom;width:100%;" onclick="loadAfterQuery('.DataSetRight-b','../src/forms/admin/courses.php?course=<?php echo $data['faculty_id'];?>');">
								<div class="projectElo"><?php echo wordwrap($data['faculty_name'],37,"<br>\n");?></div>
							</span>
							<span title="Edit Faculty" style="padding:10px 10px;cursor: pointer;"><i onclick="fa_fa_edit_campus('<?php echo $data['faculty_id'];?>')" class="fa fa-edit"></i></span>
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