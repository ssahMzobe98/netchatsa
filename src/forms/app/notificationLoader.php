<?php
include_once("../../vendor/autoload.php");
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
	$studyArea = PDOServiceFactory::make(ServiceConstants::STUDY_AREA_PDO,[$userPdo->connect]);
	$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	?>
		<div class="loadNotifications"></div>
		<div class="loadButns"></div>
		<script>
			$(document).ready(function(){
				 var limit = 7;
				 var start = 0;
				 var action = 'inactive';
				 
				// console.log("preparing to load data");
				 if(action == 'inactive')
				 {
				  action = 'active';
				  // console.log("loading data now...")
				  load_country_data(limit, start);
				 }
				 $(window).scroll(function(){
				  if($(window).scrollTop() + $(window).height() > $(".loadNotifications").height() && action == 'inactive')
				  {
				   action = 'active';
				   start = start + limit;
				   setTimeout(function(){
				    load_country_data(limit, start);
				   }, 1000);
				  }
				 });
				 
			});
			function load_country_data(limit, start){
				const constant=7;
				$.ajax({
				   url:"../src/forms/app/notification.php",
				   method:"POST",
				   data:{limit:limit,start:start},
				   cache:false,
				   success:function(data){
				   	// console.log(data+" : Data info ");
				    $('.loadNotifications').append(data);
				    if(data == ''){
				     $('.loadButns').html("<button type='button' class='btn btn-dark' style='width:100%;padding:2px 2px;color:#45f3ff;'>No Notifications Found</button>");
				     action = 'active';
				    }
				    else{
				     $('.loadButns').html("<button style='width:100%;padding:2px 2px;color:#45f3ff;' onclick='load_country_data("+(limit+constant)+","+(start+constant)+")' type='button' class='btn btn-dark;'>Load More</button>");
				     action = "inactive";
				    }
				   }
				});
			}
		</script>
		<?php
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