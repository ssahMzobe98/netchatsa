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
		if(isset($_POST['viewThisSchooInfoID'],$_POST['is_read'])){
				$viewThisSchooInfoID=intval($cleanData->OMO($_POST['viewThisSchooInfoID']));
				$read=intval($cleanData->OMO($_POST['is_read']));
				if($read==1){
						$response=$schoolAdminPdo->readForReadOnly($viewThisSchooInfoID);
						
						?>
					<div class="modal-header">
		        <h4 class="modal-title" style="text-align: center;">Viewing <?php echo $response['school_name']??"No School Name Found";?></h4>
		        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
		      </div>
		      <div class="modal-body">
		      	<table>
		      	  <tr>
		      			<th>
		      				<h4>School Details</h4>
		      			</th>
		      		</tr>
		      	
		      		<tr>
		      			<th>School</th>
		      			<th><?php echo $response['school_name']??"No School Name Found";?></th>
		      		</tr>
		      		<tr>
		      			<th><?php echo $response['type'];?></th>
		      			<th><?php echo $response['is_principal'];?></th>
		      		</tr>
		      		<tr>
		      			<th>First Name</th>
		      			<th><?php echo $response['name'];?></th>
		      		</tr>
		      		<tr>
		      			<th>Last Name</th>
		      			<th><?php echo $response['surname'];?></th>
		      		</tr>
		      		<tr>
		      			<th>
		      				<h4>Contact Details</h4>
		      			</th>
		      		</tr>
		      		<tr>
		      			<th>Phone No.</th>
		      			<th><?php echo $response['phone'];?></th>
		      		</tr>
		      		<tr>
		      			<th>Email Address</th>
		      			<th><?php echo $response['email'];?></th>
		      		</tr>
		      		<tr>
		      			<th>
		      				<h4>Cruise Creds</h4>
		      			</th>
		      		</tr>
		      		<tr>
		      			<th>ID No.</th>
		      			<th><?php echo $response['id_no'];?></th>
		      		</tr>
		      		<tr>
		      			<th>Persal No.</th>
		      			<th><?php echo $response['persal'];?></th>
		      		</tr>
		      		<tr>
		      			<th>Students : </th>
		      			<th><?php echo $response['learners'];?></th>
		      		</tr>
		      		<tr>
		      			<th>Teachers : </th>
		      			<th><?php echo $response['teachers'];?></th>
		      		</tr>
		      		<tr>
		      			<th>Revenue : </th>
		      			<th>R<?php echo number_format($response['learners']*(200+(200*0.15)),2,","," ");?></th>

		      		</tr>

		      		
		      	</table>

		      </div>
						<?php						
				}
				else{
						$response=$schoolAdminPdo->readForEditOnly($viewThisSchooInfoID);
						?>
					<div class="modal-header">
		        <h4 class="modal-title" style="text-align: center;">Edit <?php echo $response['school_name']??"No School Name Found";?></h4>
		        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
		      </div>
		      <div class="modal-body">
							<div class="inputVals">
			          <input type="text" required class="UpdaatePrincipalName" placeholder="Enter Principal Name" value="<?php echo $response['name'];?>">
			        </div>
			        <div class="inputVals">
			          <input type="text" required class="UpdaatePrincipalSurname" placeholder="Enter Principal Surname" value="<?php echo $response['surname'];?>">
			        </div>
			        <div class="inputVals">
			          <input type="number" required class="UpdaatePrincipalPhoneNo" placeholder="Enter Principal Phone No" value="<?php echo $response['phone'];?>">
			        </div>
			        <div class="inputVals">
			          <input type="email" required class="UpdaatePrincipalEmail" placeholder="Enter Principal Email" value="<?php echo $response['usermail'];?>">
			        </div>
			        <div class="inputVals">
			          <input type="number" required class="UpdaatePrincipaIdNo" placeholder="Enter Principal ID No" value="<?php echo $response['id_number'];?>">
			        </div>
			        <div class="inputVals">
			          <input type="password" required class="UpdaatePrincipaPass" placeholder="Enter Principal Password">
			        </div>
			        <div class="inputVals">
			          <input type="number" required class="UpdaatePrincipaPersal" placeholder="Enter Principal Persal" value="<?php echo $response['persal_number'];?>">
			        </div>
			        <br>
			        <div class="inputVals">
			          <input type="ssubmit" class="addMasomaneNewSchool" onclick="updateMasomaneSchool()" value="Update" >
			        </div>
			        <div class="errorLogMasoManeUpdateSchool" hidden></div>
			      </div>
						<?php
				}
		}
		else{
			echo"UKNOWN REQUEST";
		}
		// echo json_encode($e);
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