<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Factory\Admin\PDOAdminFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
		$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
		$uniAdminPdo = PDOAdminFactory::make(ServiceConstants::UNI_ADMIN_PDO,[$userPdo->connect]);
		$cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
		if(isset($_GET['funder'])){
			$funder = $cleanData->OMO($_GET['funder']);
			$getInstitutionCourses = $uniAdminPdo->masomaneGetInstitutionCourses($funder);
			?>
			<style>
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
			</style>
			
			<?php
			if(count($getInstitutionCourses)==0){
				echo"<h3>No Institutions found..</h3>";
			}
			else{
				foreach($getInstitutionCourses as $row){
					?>
					<div class="izikoleZakithi box-shadow">
						<div onclick="loadAfterQuery('.dataDisplayerIdrCoursesStudents','../src/forms/admin/displayFundingCoursesStudents.php?fundedStudents = <?php echo $row['linked_id'];?>')" style="width:100%;"><?php echo wordwrap($row['course_name'],30,"<br>");?></div>
						<span style="padding:10ppx 10px;"><i class="fa fa-edit"></i></span>
					</div>
						<br>
					<?php
				}
			}
		}
		else{
			echo"UKNOWN REQUEST!!..";
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