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
  date_default_timezone_set('Africa/Johannesburg');
		?>
		    <div class="makhanyile box">
          <div class="title">MaSomane: Registered Schools <span class="badge badge-primary text-white text-center" data-bs-toggle="modal" data-bs-target="#MaSomaneAddNewSchool"><i class="fa fa-plus"></i> Add New School</span><span class="searchMasomaneSchoolSlide"><input oninput="searchMasomaneSchoolFunc()" class="searchMasomaneSchool" id="searchMasomaneSchool" type="search" ></span></div>
          <div class="makhanyileDtails dynamicalLoad1" id="dynamicalLoad1"></div>
        </div>
      <script>
            $(document).ready(function(){
              loadAfterQuery(".dynamicalLoad1","../src/forms/admin/loadMasomaneSchools.php?start=0&limit=10");
            });
      </script>
		<?php
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