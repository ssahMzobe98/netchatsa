<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if(isset($_SESSION['usermail'])){
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	?>
	<div class="left-set">
		<div class="slack-content" onclick="loader('apply')"><i id="acQr" class="fa fa-graduation-cap"></i>Tertiary Applications(APPLY)</div>
	    <div class="slack-content" onclick="loader('matricUpgrade')"><i id="acQr" class="fa fa-bold"></i>Matric Upgrade</div>
	    <div class="slack-content" onclick="loader('highschool')"><i id="acQr" class="fa fa fa-book"></i>High School Self Learning</div>
	    <div class="slack-content" onclick="loader('tertiary')"><i id="acQr" class="fa fa-laptop"></i>Tertiary Self Learning</div>
	    <!-- <div class="slack-content" onclick="loader('highschool')"><i id="acQr" class="fa fa-book"></i>High School Program</div> -->
	    <div class="slack-content" onclick="loader('reportedUsers')"><i id="acQr" class="fa fa-flag"></i>Reported Users</div>
	    <div class="slack-content" onclick="loader('blockedUsers')"><i id="acQr" class="fa fa-ban"></i>Blocked Users</div>
	    <div class="slack-content" onclick="loader('asifundeSonke&min=0&max=7')"><i id="acQr" class="fa fa-question-circle"></i>Asifunde Sonke</div>
	    <hr>
	    <div class="slack-content" onclick="loader('izihlabelelo')"><i id="acQr" class="fa fa-music"></i>Izihlabelelo</div>
	    <div class="slack-content" onclick="loader('notification')"><i id="acQr" class="fa fa-bell"></i>Notifications</div>
	    <div class="slack-content" onclick="loader('myProfile')"><i id="acQr" class="fa fa-user"></i>My Profile</div>
	    <div class="slack-content logout" onclick="loader('logout')"><i id="acQr" class="fa fa-sign-out"></i>Logout</div>
	</div>
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