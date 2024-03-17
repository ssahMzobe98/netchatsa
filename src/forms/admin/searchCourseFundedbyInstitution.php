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
  	$cleanData = PDOAdminFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$schoolAdminPdo = PDOAdminFactory::make(ServiceConstants::SCHOOL_ADMIN_PDO,[$userPdo->connect]);
		if(isset($_POST["findMe"])){
			$SEARCH=$cleanData->OMO($_POST["findMe"]);
			$response = $schoolAdminPdo->searchCourseFundedbyInstitution($SEARCH);
			if(count($response)==0){
				?>
				<h3 style="padding:10px 10px; width:100%;color:red;">NO SEARCH RESULTS FOUND </h3>
				<?php
			}
			else{
				$passToArray = [];
				foreach($response as $row){
					if(!in_array($row['institution_id'], $passToArray)){
						$passToArray[]=$row['institution_id'];
					}
				}
				$passToArrayOBj = json_encode($passToArray);
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
				if(count($response)==0){
					echo"<h3>No Institutions found..</h3>";
				}
				else{
					foreach($response as $row){
						?>
						<div title="FUNDED BY : <?php echo $row['institutions'];?>" class="izikoleZakithi box-shadow">
							<div onclick="loadAfterQuery('.dataDisplayerIdrCoursesStudents','../src/forms/admin/displayFundingCoursesStudents.php?fundedStudents = <?php echo $row['linked_id'];?>')" style="width:100%;"><?php echo wordwrap($row['course_name'],30,"<br>");?></div>
							<span style="padding:10ppx 10px;"><i class="fa fa-edit"></i></span>
						</div>
							<br>
						<?php
					}
					if(count($passToArray)>0){
						?>
						<script>
							loadAfterQuery(".dataDisplayerIdr","../src/forms/admin/displayFundingInstitution.php?institutions=<?php echo $passToArrayOBj;?>");
						</script>
						<?php
					}	
				}
			}
		}
		else{
			echo"UKNOWN REQUEST!!";
		}
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../xZx");
	</script>

	<?php
}
?>