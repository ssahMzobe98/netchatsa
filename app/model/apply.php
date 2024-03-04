<?php
include_once("../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	require_once("../controller/pdo.php");
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	$isLevelOfApplicaation=$pdo->isLevelOfApplicaation($cur_user_row['my_id']);
	$data=$isLevelOfApplicaation['data'];
	?>
	<style>
		.rulesNetWorks{
			width: 100%;
			background: #212121;
/*				border: 1px solid #45f3ff;*/
			border-radius: 5px;
			min-height: 100%;
			height: auto;
			box-shadow: 0px 0px 15px rgba(0,0,0,.5);
			
		}
	</style>
	<div class="rulesNetWorks">
<style>
	.flex{
		display: flex;
	}
	.step2{
		width: 100%;
		padding: 10px 0;
		align-content: center;
		text-align: center;
	}
	.step2 .headerWarner{
		width: 98%;
		color: #45f3ff;
		background-color: #222;
		border-radius: 10px;
		box-shadow: 0 8px 6px -6px black;
		margin-left: 1%;
		opacity: .9;
	}
	.step2 .personalDetails{
		width: 98%;
		background-color: 	#222;
		color: #45f3ff;
		margin-left: 1%;
		border-radius: 10px;
		box-shadow: 0 8px 6px -6px black;
		opacity: .9;
	}
	.step2 .personalDetails .info{
		align-content: center;
		text-align: center;
		width: 60%;
		/*border: 1px solid red;*/
		margin-left: 10%;
		padding: 10px;
	}
	.step2 .personalDetails .info .div{
		align-content: center;
		text-align: center;
		width: 70%;
		/*border: 1px solid blue;*/
		padding: 3px;
	}
	.step2 .personalDetails .info .div2{
		align-content: center;
		text-align: center;
		width: 30%;
		/*border: 1px solid blue;*/
		padding: 3px;
	}
	.step2 .personalDetails .info .div2 select{
		background-color: #222;
		color: #45f3ff;
		width: 100%;
		border: none;
		background-color: #212121;
	}
	.step2 .personalDetails .foreign,.southafrican{
		align-content: center;
		justify-content: safe center;
	}
	.step2 .personalDetails .info1{
		align-content: center;
		text-align: center;
		width: 100%;
		/*border: 1px solid red;*/
		
		padding: 10px;
	}
	.step2 .personalDetails .info1 .myPerso{
		width: 100%;
		justify-content: legacy left;
		text-align: left;
		
	}
	.step2 .personalDetails .info1 .myPerso .left{
		width:50%;
		padding: 10px 0;
		
	}
	.step2 .personalDetails .info1 .myPerso .right{
		width:60%;
	}
	.step2 .personalDetails .info1 .myPerso .right input,select{
		width: 100%;
		padding: 5px 0;
		color: #45f3ff;
		background-color: #222;
		border: none;
		border-bottom: 2px solid #45f3ff;
		cursor: pointer;
	}
	.step2 .personalDetails .btn{
		width: 80%;
		background-color: navy;
		color: #45f3ff;
		cursor: pointer;
		border-radius: 10px;
	}
	.step2 .personalDetails .btn{
		background-color: #212121;
		border: 2px solid white;
		padding: 5px 5px;
		width: 100%;
		background-color: #212121;
		color: white;
		font-size: 15px;
	}
	.step2 .personalDetails .btn:hover{
		background-color: #212121;

	}
	.step2 .personalDetails .info .info1 .btnn{
		width: 100%;
	}
	.step2 .personalDetails .info1 .btnn:hover{
		color: navy;
		border: 2px solid navy;
	}
	.bodyDisplaySgela{
		display: flex;
		padding: 10px 0;
		width: 100%;
		justify-content: center;
		justify-items: center;
		text-align: center;
	}
	.bodyDisplaySgela .Grade12,.uni,.learntocode{
		width: 50%;
		
	}
	.bodyDisplaySgela .Grade12 img,.uni img{
		width: 80%;
	}




	@media only screen and (max-width: 800px){
		.flex{
			display: block;
		}
		.step2 .personalDetails .info .div{
			width: 100%;
		}
		.step2 .personalDetails .info .info1 .btnn:{
			width: 100%;
		}
		.step2 .personalDetails .info1 .myPerso{
			display: block;
		}
		.step2 .personalDetails .info1 .myPerso .right{
			width: 100%;
		}
		.step2 .personalDetails .info1 .myPerso .left{
			width: 100%;
		}
	}
</style>
			<?php
			if(empty($data)){
				echo"<div class='set-trap'>";
				$pdo->goToStart($cur_user_row);
				echo"</div>

				<div class='set-trapAcep'>";
				$pdo->firstStep($cur_user_row);
				echo"<div>";

				?>
				<div class="doNotQualify">
					<center><h2 style="color: white;background: red;padding: 10px 10px;">Sorry Your average mark is less than the requirements of the tertiary institutions. Please upgrade your results.</h2></center>
				</div>
				<div class="progress" hidden></div>
				<script>
					supSetDefault();
					function beginAppProcess(){
						$(".set-trap").fadeOut();
						$(".set-trapAcep").fadeIn();
						$(".doNotQualify").hide();
					}
					function supSetDefault(){
						$(".set-trap").show();
						$(".set-trapAcep").hide();
						$(".doNotQualify").hide();
					}
					function doNotQualify(){
						$(".set-trapAcep").fadeOut();
						$(".set-trap").hide();
						$(".doNotQualify").fadeIn();
					}
				</script>
				<?php

			}
			else{
				$goToLevel=$pdo->goToLevelApplication($cur_user_row,$data);
			}
		?>
		</div>
		<script>
			function step1Btn(){
				$(".progress").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
				const grdlevel=$("#grdlevel").val();
				const numOfSubj=$("#numOfSubj").val();
				const subjects1=$("#subjects1").val();
				const levelMark1=$("#levelMark1").val();
				const levelMark11=$("#levelMark11").val();
				const subjects2=$("#subjects2").val();
				const levelMark2=$("#levelMark2").val();
				const levelMark22=$("#levelMark22").val();
				const subjects3=$("#subjects3").val();
				const levelMark3=$("#levelMark3").val();
				const levelMark33=$("#levelMark33").val();
				const subjects4=$("#subjects4").val();
				const levelMark4=$("#levelMark4").val();
				const levelMark44=$("#levelMark44").val();
				const subjects5=$("#subjects5").val();
				const levelMark5=$("#levelMark5").val();
				const levelMark55=$("#levelMark55").val();
				const subjects6=$("#subjects6").val();
				const levelMark6=$("#levelMark6").val();
				const levelMark66=$("#levelMark66").val();
				const subjects7=$("#subjects7").val();
				const levelMark7=$("#levelMark7").val();
				const levelMark77=$("#levelMark77").val();
				const subjects8=$("#subjects8").val();
				const levelMark8=$("#levelMark8").val();
				const levelMark88=$("#levelMark88").val();
				const subjects9=$("#subjects9").val();
				const levelMark9=$("#levelMark9").val();
				const levelMark99=$("#levelMark99").val();
				const subjects10=$("#subjects10").val();
				const levelMark10=$("#levelMark10").val();
				const levelMark1010=$("#levelMark1010").val();	
				if(grdlevel.length==0){
					$("#grd").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(numOfSubj.length==0){
					$("#num").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects1.length==0){
					$("#subjects1Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark1.length==0){
					$("#levelMark1Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark11.length==0){
					$("#levelMark11Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects2.length==0){
					$("#subjects2Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark2.length==0){
					$("#levelMark2Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark22.length==0){
					$("#levelMark22Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects3.length==0){
					$("#subjects3Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark3.length==0){
					$("#levelMark3Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark33.length==0){
					$("#levelMark33Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects4.length==0){
					$("#subjects4Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark4.length==0){
					$("#levelMark4Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark44.length==0){
					$("#levelMark44Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects5.length==0){
					$("#subjects5Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark5.length==0){
					$("#levelMark5Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark55.length==0){
					$("#levelMark55Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects6.length==0){
					$("#subjects6Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark6.length==0){
					$("#levelMark6Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark66.length==0){
					$("#levelMark66Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(subjects7.length==0){
					$("#subjects7Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark7.length==0){
					$("#levelMark7Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else if(levelMark77.length==0){
					$("#levelMark77Error").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".progress").removeAttr("hidden").attr("style","background:red;color:#45f3ff;").html("Data required **");

				}
				else{
					const arr=[subjects1,subjects2,subjects3,subjects4,subjects5,subjects6,subjects7,subjects8,subjects9,subjects10];
					const pri=[levelMark11,levelMark22,levelMark33,levelMark44,levelMark55,levelMark66,levelMark77,levelMark88,levelMark99,levelMark1010];
					var total=0;
					var subj=1;
					for (var i = arr.length - 1; i >= 0; i--) {
						if(arr[i].length>0 && arr[i]!=10029){
							total=total+parseInt(pri[i]);
							subj++;
						}
					}
					if(grdlevel==1 && (total/subj)<40){
						doNotQualify();
					}
					else{
						$.ajax({
			                url:'./controller/ajaxCallProcessor.php',
			                type:'post',
			                data:{
			                	grdlevel:grdlevel,
								subjects1:subjects1,
								levelMark1:levelMark1,
								levelMark11:levelMark11,
								subjects2:subjects2,
								levelMark2:levelMark2,
								levelMark22:levelMark22,
								subjects3:subjects3,
								levelMark3:levelMark3,
								levelMark33:levelMark33,
								subjects4:subjects4,
								levelMark4:levelMark4,
								levelMark44:levelMark44,
								subjects5:subjects5,
								levelMark5:levelMark5,
								levelMark55:levelMark55,
								subjects6:subjects6,
								levelMark6:levelMark6,
								levelMark66:levelMark66,
								subjects7:subjects7,
								levelMark7:levelMark7,
								levelMark77:levelMark77,
								subjects8:subjects8,
								levelMark8:levelMark8,
								levelMark88:levelMark88,
								subjects9:subjects9,
								levelMark9:levelMark9,
								levelMark99:levelMark99,
								subjects10:subjects10,
								levelMark10:levelMark10,
								levelMark1010:levelMark1010,
								total:total,
								subj:subj
			                },
			                success:function(e){
			                    console.log(e);
			                    if(e.length>1){
			                        $(".progress").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
			                    }
			                    else{
			                        
			                         $(".progress").attr("style","padding:5px 5px;color:green;width:100%;border:1px solid white;").html("Data Submitted Successfully please wait, redirecting...");
			                         loader("apply");
			                    }
			                    
			                }
			            });
					}
					
				}
			}
		</script>		
		<?php
	}
	else{
		session_destroy();
		?>
			<script>
				window.location=("../../?Yazi uyajwayela wena!!, Stop trying to access somebody's account through your own login details.");
			</script>
		<?php
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