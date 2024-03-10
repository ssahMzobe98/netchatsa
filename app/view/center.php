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
	$dir="../img/avatar.png";//default;
	// echo $cur_user_row['profile_image'];
	if(isset($cur_user_row['profile_image'])&&$cur_user_row['profile_image']!="empty" && strlen($cur_user_row['profile_image'])>5){
		$dir="../img/userProfileImages/".$cur_user_row['my_id']."/".$cur_user_row['profile_image'];
	}
	// echo"<br>";echo $dir;
	?>
	<style>
		
.box 
{
	position: relative;
	width: 100%;
	height: 100%;
	background: #1c1c1c;
	border-radius: 8px;
	opacity: .7;
	box-shadow: 0px 0px 15px rgba(0,0,0,.5);
	overflow: hidden;
}
.box::before 
{
	content: '';
	z-index: 1;
	position: absolute;
	top: -50%;
	left: -50%;
	width: 100%;
	height: 100%;
	transform-origin: bottom right;
	background: linear-gradient(0deg,transparent,white,white);
	animation: animate 6s linear infinite;
}
.box::after 
{
	content: '';
	z-index: 1;
	position: absolute;
	top: -50%;
	left: -50%;
	width: 100%;
	height: 100%;
	transform-origin: bottom right;
	background: linear-gradient(0deg,transparent,#45f3ff,#45f3ff);
	animation: animate 6s linear infinite;
	animation-delay: -3s;
}
@keyframes animate 
{
	0%
	{
		transform: rotate(0deg);
	}
	100%
	{
		transform: rotate(360deg);
	}
}
.dictator 
{
	position: absolute;
	inset: 2px;
	background: #1c1c1c;
	padding: 10px 10px;
	border-radius: 8px;
	z-index: 2;
	display: flex;
	flex-direction: column;

}

.img-setter-profile {
	width: 80%;
	border-radius: 100%;
	border-top: 2px solid #45f3ff;
	border-bottom: 2px solid #FFFF;
	height:40vh;
	color:#45f3ff;
	background: navy;
	box-shadow: 0px 0px 40px rgba(0,0,0,.5);
	align-items: center;
	justify-content: center;
	justify-items: center;
	justify-self: center;
	text-align: center;
}
.img-setter-profile img{
	width: 100%;
	height: 100%;
	border-radius: 100%;
}
.setBack{
	width: 100%;
	height: 100%;
	padding: 10px 10px;
	text-align: center;
	align-items: center;
	box-shadow: 0px 0px 40px rgba(0,0,0,.5);
	background:#1c1c1c;
	border-radius: 10px 10px;
	color:#45f3ff;
}
.setBack .mode{
	width: 100%;
	height: 72%;
	border:1px solid #45f3ff;
	border-radius: 10px;
	padding: 2px 2px;
	align-items: left;
	text-align: left;
	justify-content: left;
	
}

.modal-header{
	justify-content: center;
	text-align: center;
	align-items: center;
}
.modal-content 
{
	position: relative;
	width: 100%;
	height: 100%;
	background: #212121;
	border-radius: 8px;
	opacity: 1;
	color: #45f3ff;
}

.inputBox 
{
	position: relative;
	width: 100%;
	padding: 5px 5px;
}
.inputBox input{
	background: #212121;
}
input{
	border:none;
	border-bottom:2px solid #45f3ff;
	padding: 10px 10px;
	background: #212121;
	color: #45f3ff;
}
textarea{
	border:none;
	border-left:2px solid #45f3ff;
	padding: 10px 10px;
	background: #212121;
	color: #45f3ff;
}
.inputBox input ,textarea
{
	position: relative;
	width: 100%;
	padding: 20px 10px 10px;
	background: transparent;
	outline: none;
	box-shadow: none;
	border: none;
	color:#45f3ff;
	font-size: 1em;
	letter-spacing: 0.05em;
	transition: 0.5s;
	z-index: 10;
}
.inputBox textarea{
   height: 20vh;
   color:#45f3ff;
   min-width: 100%;
   max-height: 20vh;
   min-height: 20vh;
   max-width: 100%;
   border:2px solid #45f3ff;
   border-radius: 5px;
   border-left: 2px solid #45f3ff;
}
.inputBox span 
{
	position: absolute;
	left: 0;
	padding: 20px 0px 10px;
	pointer-events: none;
	font-size: 1em;
	color: #8f8f8f;
	letter-spacing: 0.05em;
	transition: 0.5s;
}
.inputBox input:valid ~ span,
.inputBox input:focus ~ span 
{
	color: #45f3ff;
	transform: translateX(0px) translateY(-34px);
	font-size: 0.75em;
}
.inputBox textarea:valid ~ span,
.inputBox textarea:focus ~ span {
	color: #45f3ff;
	transform: translateX(0px) translateY(-34px);
	font-size: 0.75em;
}
.btn{
	color:#45f3ff;
	border:2px solid #45f3ff;
}
.btn:hover{
	color:purple;
	border:2px solid white;
	background: #45f3ff;
}
.inputBox i 
{
	position: absolute;
	left: 0;
	bottom: 0;
	width: 100%;
	height: 2px;
	background: #45f3ff;
	border-radius: 4px;
	overflow: hidden;
	transition: 0.5s;
	pointer-events: none;
	z-index: 9;
}
.inputBox input:valid ~ i,
.inputBox input:focus ~ i 
{
	height: 44px;
}




	</style>
	<div class="box">
		<div class="dictator">
			<center><div class="img-setter-profile" style="cursor:pointer;" id="myBtn" data-toggle="modal" data-target="#img_gost0">
				<img src="<?php echo $dir;?>">
			</div></center>
			<div style="padding: 10px 10px;"></div>
			<div class="setBack">
				<h2>My Profile</h2>
				<p>@userName Name Surname</p>
				<div class="mode">
					<p data-toggle="modal" data-target="#UpdateTextFiled" style="cursor: pointer;">click me to Edit</p>
					<div class="displayMyStory">
						write over 200 words in on here. dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut ..
					</div>
				</div>

			</div>
		</div>
	</div>
<div class="modal fade" id="UpdateTextFiled" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">Update Story Point</h4>
        </div>
        <div class="modal-body">
        	<!-- <div class="inputBox">
				<input type="text" required="required">
				<span>Userame</span>
				<i></i>
			</div> -->
			<div class="inputBox">
				<textarea class="writeStoryPoint" placeholder="Type your story.."></textarea>
				
			</div>
          	<div class="sendBtn">
          		<button type="button" class="btn btn-default">Save</button>
          	</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
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