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
		$schoolAdminPdo = PDOAdminFactory::make(ServiceConstants::SCHOOL_ADMIN_PDO,[$userPdo->connect]);
		$adminPdo = PDOServiceFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
		$ProjectTicketAdminPdo = PDOAdminFactory::make(ServiceConstants::PROJECT_TICKET_ADMIN,[$userPdo->connect]);
			$SEARCH=$cleanData->OMO($_POST["findMe"]);
			$response = $schoolAdminPdo->searchMasomaneBySchool($SEARCH);
			if(count($response)==0){
				?>
				<h3 style="padding:10px 10px; width:100%;color:red;">NO SEARCH RESULTS FOUND </h3>
				<?php
			}
			else{
				?>
					<table class="table table-striped">
				    <thead>
				      <tr>
				        <th>Date</th>
				        <th>School</th>
				        <th>Principal</th>
				        <th>Manage</th>
				      </tr>
				    </thead>
				    <tbody>
				    	<?php
				    	$count=0;
				    	foreach($response as $row){
								$school = $adminPdo->getSchool($row["school"]);
								$school_name = $school['school']??"No School Found";
								$read=1;$write=2;?>
							  <tr  >
					        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><?php echo  explode(" ",$row["time_added"])[0];?></td>
					        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><?php echo  $adminPdo->add3dots($school_name,"...",50);?></td>
					        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><?php echo  $row["name"]." ".$row["surname"];?></td>
					        <td>
					        	<a onclick="viewThisSchooInfo('<?php echo $row['id'];?>','<?php echo $read;?>')" class="badge badge-primary text-white text-center">-></a> 
					        	<a onclick="viewThisSchooInfo('<?php echo $row['id'];?>','<?php echo $write;?>')" class="badge badge-danger text-white text-center"><i class="bx bx-cog" id="i-manage"></i></a></td> <!-- read : 1, Write : 0 -->
				      </tr>
							<?php
								$count++;
							}
							?>
				      <tfoot>
				      	<tr>
					        <th>Date</th>
				        <th>School</th>
				        <th>Principal</th>
				        <th>Manage</th>
				      </tr>
				      </tfoot>
				     
				    </tbody>
				  </table>

				<?php
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