<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Factory\PDOAdminFactory;
use App\Providers\Constants\Flags;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['usermail'])){
  	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
  	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
  	$cleanData = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
		$adminPdo = PDOServiceFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
			if(isset($_GET['start'],$_GET['limit'])){
			$start = $cleanData->OMO($_GET['start']);
			$limit = $cleanData->OMO($_GET['limit']);

			$Applicants = $adminPdo->makhanyileGetAllApplicants($start,$limit);
			$next=$start+$limit;
			$prev = $start-$limit;
			$prev= ($prev<0)?0:$prev;
			if(count($Applicants)==0){

				echo"<h4>No Applicants found</h4>";
				?>
					<span onclick='loadAfterQuery(".ApplicantsLoader","../src/forms/admin/ApplicantsLoader.php?start=<?php echo $prev?>&limit=<?php echo $limit?>");' class="badge badge-secondary text-white text-center"><< PREVIOUS</span>
				<?php
			}
			else{
				?>
				<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Id Number</th>
			        <th>Passport</th>
			        <th>Student Name</th>
			        
			        <th>Phone</th>
			        <th>Email Address</th>
			        <th>Application Status</th>
			        <th>Manage</th>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php
			    	$count=0;
			    	foreach($Applicants as $row){
			    		$status = $row['status']??"N/A";
							$title = $row['title']??"N/A";
							$initials = $row['initials']??"N/A";
							$lname = $row['lname']??"N/A";
							$fname = $row['fname']??"N/A";
							$id_no = empty($row['id_no'])?"N/A":$row['id_no'];
							$passport = empty($row['passport'])?"N/A":$row['passport'];
							$gender = $row['gender']??"N/A";
							$dob = $row['dob']??"N/A";
							$phone = $row['phone']??'N/A';
							$badge = ($status=="COMPLETED")?'badge-success':'badge-danger';
							$email = $row['email']??'N/A';
							$std = $row['std']??'';
							$std = $row['std']??'';
							$funct="sendReminderPn(`{$std}`)";
							$url = 'loadAfterQuery(".ApplicantsLoader","../src/forms/admin/applicantApplication.php?applicant='.$std.'");';
							$push = ($status=="COMPLETED")?"<span style='padding:10px 10px;'  class='badge badge-success text-center text-white' onclick='{$url}'>Start Application</span>":"<span  style='padding:10px 10px;' class='badge badge-danger text-center text-white sendReminderPn{$std}' onclick='{$funct}'>Send PN Reminder</span>";
							?>
							<tr>
								<td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span style="width:100%;padding:10px 10px;" ><?php echo  $id_no;?></span></td>
				        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span style="width:100%;padding:10px 10px;"><?php echo  $passport?></span></td>
				        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span style="width:100%;padding:10px 10px;"><?php echo  $title.' '.$initials.' '.$lname.' '.$fname;?></span></td>
				        
				        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span  style="width:100%;padding:10px 10px;"><?php echo  $phone;?></span></td>
				        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span  style="width:100%;padding:10px 10px;"><?php echo  $email;?></span></td>
				        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span class="badge <?php echo $badge;?> text-white text-center" style="width:100%;padding:10px 10px;"><?php echo  $status;?></span></td>

				        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><?php echo $push;?></td>
				        </tr>
							<?php
							$count++;
						
			    	}
							
						
						?>
			      <tfoot>
			      	<tr>
				        <th><span onclick='loadAfterQuery(".ApplicantsLoader","../src/forms/admin/ApplicantsLoader.php?start=<?php echo $prev?>&limit=<?php echo $limit?>");' class="badge badge-secondary text-white text-center"><< PREVIOUS</span></th>
				        <th></th>
				        <th></th>
				        <th></th>
				        <th></th>
				        <th></th>
				        <th><span onclick='loadAfterQuery(".ApplicantsLoader","../src/forms/admin/ApplicantsLoader.php?start=<?php echo $next?>&limit=<?php echo $limit?>");' class="badge badge-secondary text-white text-center"> NEXT >></span></th>
			      </tr>
			      </tfoot>
			     
			    </tbody>
			  </table>
				<?php
			}
		}
		else{
			echo"<h2>UNKNOWN REQUEST!!..</h2>";
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