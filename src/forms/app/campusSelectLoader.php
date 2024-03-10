<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
	$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
		if(isset($_GET['q'])){
			if(!empty($_GET['q'])){
				$uni=$_GET['q'];
				$getFaculties=$tertiaryApplications->getFacultiesOfUni($_GET['q']);
				if(count($getFaculties)==0){
					echo"No Faculties Found";
				}
				else{
					?>
					<select class="selection">
						<?php
						foreach ($getFaculties as $row) {
							?>
							<option value="<?php echo $row['faculty_id'];?>"> <?php echo $row['faculty_name'];?></option>
							<?php
						}
						?>
					</select>
					<br>
					<div class="saleInput" style="width:100%;padding: 10px 10px;"></div>
					<script>
						$(document).ready(function(){
							$(".selection").on("change",function(){
								const select=$(".selection").val();
								if(select==""){
									$(".saleInput").html("No data Selected");
								}
								else{
									const uni="<?php echo $uni;?>";
									$(".saleInput").html("waiting for response...").loadQuery('className',"./model/CourseSelectLoader.php?unisaleInpu="+uni+"&faculty_id="+select);

								}
							});
						});
					</script>
					<?php
				}
			}
			else{
				echo"Yewna Yey!!, Musa ukusijwayela kabi!!...";
			}
		}	
		else{
			echo"Engathi Suyaphaphjake manje, Whoever you are stop it!!...";
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