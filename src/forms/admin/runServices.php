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
			?>
			<center>
				<div style="width:100%;">
					<span onclick="runService()" style="padding: 10px 10px;color:navy;background: white;font-size: 15px;font-weight: bolder;border-radius: 50px;cursor: pointer;"> RUN SERVICE</span>
			</div>
			<div class="runService" hidden></div>
			</center>
			<script>
				function runService(){
				  const runBursaryApplicationService=1
				  $(".runService").removeAttr('hidden').html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Proccessing Service..</h5>");
				  $.ajax({
				      url:'../app/controller/adminController.php',
				      type:'post',
				      data:{runBursaryApplicationService:runBursaryApplicationService},
				      beforeSend:function(){
				          $(".runService").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Running Service..</h5>");
				      },
				      success:function(e){
				          response = JSON.parse(e);
									if(response['responseStatus']==='F'){
                      $(".runService").attr("style","padding:5px 5px;color:red;width:100%;").html(response['responseMessage']);
                  }
                  else{
                       $(".runService").attr("style","padding:5px 5px;color:green;width:100%;").html("Ran Successfully...");
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
		window.location=("../");
	</script>

	<?php
}
?> 