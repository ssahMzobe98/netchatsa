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
		$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);

		$tertiaries = $uniAdminPdo->makhanyileGetTertiaries();
		if(count($tertiaries)==0){
			echo"<h4>No tertiaries found</h4>";
		}
		else{
			?>
			<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Tertiary name</th>
		        <th>Campuses</th>
		        <th>Faculties</th>
		        <th>Courses</th>
		        <th>Applications</th>
		       
		      </tr>
		    </thead>
		    <tbody>
		    	<?php
		    	$count=0;
		    	foreach($tertiaries as $row){
		    		$uni_name=$row['uni_name']??'';
						$uni_id=$row['uni_id']??0;
						$campuses =$row['campuses']??0;
						$courses =$row['courses']??0;
						$faculties =$row['faculties']??0;
						$applicants =$row['applicants']??0;
						// echo $uni_id;
						$read=1;$write=2;?>
					  <tr>
			        
			        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span style="width:100%;padding:10px 10px;" onclick='loadAfterQuery(".makhanyile","../src/forms/admin/uniForm.php?uni_id=<?php echo $uni_id;?>")' class="badge badge-secondary text-white text-center"><?php echo  $uni_name;?></span></td>
			        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span style="width:100%;padding:10px 10px;"><?php echo  $campuses;?></span></td>
			        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span style="width:100%;padding:10px 10px;"><?php echo  $faculties;?></span></td>
			        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span style="width:100%;padding:10px 10px;"><?php echo  $courses;?></span></td>
			        <td <?php if($count%2==0){echo 'style="color:limegreen;"';} ?> ><span style="width:100%;padding:10px 10px;" onclick='loadAfterQuery(".makhanyile","../src/forms/admin/Application.php?Application=<?php echo $uni_id;?>")' class="badge badge-success text-white text-center"><?php echo  $applicants;?></span></td>
		      </tr>
					<?php
						$count++;
					}
					?>
		      <tfoot>
		      	<tr>
			        <th>Tertiary name</th>
			        <th>Campuses</th>
			        <th>Faculties</th>
			        <th>Courses</th>
			        <th>Applications</th>
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
		window.location=("../");
	</script>

	<?php
}
?>