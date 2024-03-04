<?php
/**
All rights reserved.
Copyright (c) 2018 - 2024
"Netchatsa" and its logo are trademarks or registered trademarks of MMS HIGH TECH in South Africa and/or other countries.

This software application is protected by copyright law and international treaties. Unauthorized reproduction or distribution of this program, or any portion of it, may result in severe civil and criminal penalties, and will be prosecuted to the maximum extent possible under the law.

Developed by MMS HIGH TECH
Author: Mr. Msizi S. Mzobe

For inquiries regarding the use of this software, please contact MMS HIGH TECH at 068 515 3023.

*/
include_once("../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
function decryptCookie($cookieValue, $key, $nonce){
    return openssl_decrypt($cookieValue, 'AES-128-CTR', $key, 0, $nonce);
}
$_SESSION['usermail'] = isset($_SESSION['usermail']) ? $_SESSION['usermail'] : (isset($_COOKIE['ibhubesi']) ? explode("-", decryptCookie($_COOKIE['ibhubesi'], 'MakhathiMacele', '0685153023980510'))[0] : null);
if (!isset($_SESSION['usermail'])) {
    session_destroy();
	?>
	<script>
	    window.location = "../?session_not_defined";
	</script>
	<?php
    exit;
}
// print_r($_COOKIE);
if (isset($_COOKIE) && isset($_SESSION['usermail'])) {
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
    if ($cur_user_row['iss_looggedin'] == 0) {
        unset($_SESSION['usermail']);
        setcookie('umfazi', '', time() - 3600, '/');
        setcookie('ibhubesi', '', time() - 3600, '/');
        session_destroy();
		?>
		<script>
		    window.location = "../";
		</script>
		<?php
    }
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title><?php echo $cur_user_row['username']; ?></title>
	    <meta name="description" content="Netchatsa SGELA is an app engineered to simplify all tertiary & bursary applications and easily accessible.">
	    <meta name="keywords" content="<?php echo $cur_user_row['username'];?>, <?php echo $cur_user_row['name'];?> <?php echo $cur_user_row['surname'];?>.">
	    <meta name="author" content="Mr M.S Mzobe">
	    <!-- Add your meta tags here -->

	    <link rel='dns-prefetch' href='https://netchatsa.com/accounts/<?php echo $userDirect;?>//s0.wp.com' />
	    <link rel='dns-prefetch' href='https://netchatsa.com/accounts/<?php echo $userDirect;?>/'/>
	    <link rel='dns-prefetch' href='https://netchatsa.com/accounts/<?php echo $userDirect;?>//fonts.googleapis.com' />
	    <link rel='dns-prefetch' href='https://netchatsa.com/accounts/<?php echo $userDirect;?>//s.w.org' />
	    <link rel="alternate" type="application/rss+xml" title="Netchatsa &raquo; Feed" href="https://netchatsa.com/accounts/<?php echo $userDirect;?>/feed/" />
	    <link rel="alternate" type="application/rss+xml" title="Netchatsa &raquo; Comments Feed" href="https://netchatsa.com/accounts/<?php echo $userDirect;?>/feed/" />
	    <meta property="og:title" content="<?php echo $cur_user_row['username'];?>, <?php echo $cur_user_row['name'];?> <?php echo $cur_user_row['surname'];?>"/>
	    <meta property="og:description" content="<?php echo $cur_user_row['name'];?> <?php echo $cur_user_row['surname'];?> <?php echo empty($cur_user_row['surname'])?"Netchatsa SGELA is an app engineered to simplify all tertiary & bursary applications and easily accessible.":$cur_user_row['surname'];?>"/>

	    <link rel="icon" href="../../img/aa.jpg">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <script src="https://www.payfast.co.za/onsite/engine.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
	</head>
	
		<style>
			body{
/*		  	  background-color: #212121;*/
		  	  padding: 0;
		  	  margin: 0;
		/*  	  background:url("../../img/jj.jpg");*/
		  	  justify-content: center;
		    align-items: center;
		/*    min-height: 92.8vh;*/
			height: 100%;
		    width: 100%;
/*		    background: url('../../img/widescreen2.jpg')no-repeat;*/
background: #23242a;
		    background-position: center;
		    background-size: cover;
		    color:#45f3ff;

			}
			section{
		/*		 display: flex;*/
		    /*justify-content: center;
		    align-items: center;
		/*    min-height: 92.8vh;*/
			/*height: 100%;
		    width: 100%;
		    background: url('../../img/widescreen2.jpg')no-repeat;
		    background-position: center;*/
		    /*background-size: cover;*/
			}
			.body{
				width:100%;
				height: 100%;
				display: flex;
				padding: 0 80px;
			}
			.label{
			    display:none;
			}
			.left{
		/*		border:2px solid white;*/
				width:25%;
				padding: 0 22px;
				justify-content: center;
		    align-items: center;
		    background-position: center;
		    background-size: cover;
		/*    box-shadow: 0 8px 6px -6px black;*/


			}
			.left-set{
				width:100%;
				justify-content: left;
			    align-items: left;
				background-position: left;
				box-shadow: 0px 0px 20px rgba(0,0,0,.5);
				background-color: #1c1c1c;
				opacity: .7;
				color:#45f3ff;
				padding: 0.1px 0;
			}
			.left-set div.slack-content{
				width: 100%;
				padding: 10px 10px;
				text-align: left;
				justify-content: left;
				align-items: left;
				font-size: 15px;
				cursor: pointer;
				border-radius: 10px;
			}
			.left-set div.slack-content:hover{
				box-shadow: 0px 0px 20px #1c1c1c;
				background-color: #000;
				opacity: 1;
				border: 1px solid #45f3ff;
				color: #45f3ff;
			}
			.left .left-set div.slack-content #acQr{
				padding: 10px 10px;
				font-size: 15px;
			}
			.left-set div.logout{
				padding: 6px 6px;
				background-color: #D2042D;
				box-shadow: 0px 0px 15px rgba(0,0,0,.5);
				border-radius: 5px;
			}
			.center{
		/*		border:2px solid white;*/
				width:30%;
				padding: 0 22px;
				justify-content: center;
		    align-items: center;
				background-position: center;
		    background-size: cover;

		/*    box-shadow: 0 8px 6px -6px black;*/


			}
			.right{
		/*		border:2px solid white;*/
				width:40%;
		/*		padding: 0 22px;*/
				justify-content: center;
		    	align-items: center;
				background-position: center;
		    	background-size: cover;
		/*    box-shadow: 0 8px 6px -6px black;*/
				box-shadow: 0px 0px 15px rgba(0,0,0,.5);
				background-color: #1c1c1c;
				opacity: .5;
				color:#45f3ff;
				height: 100%;
				overflow-x:auto;
                overflow-wrap: break-word;
                word-wrap: break-word;
                hyphens: auto;
			}
			.package{
				width: 100%;
			}
			.package .headerDisplayMach{
				width: 100%;
				font-size: 15px;
				display: flex;

			}
			.package .headerDisplayMach .profile{
				padding: 0 10px;
				font-size: 15px;
				width: px;
				height: 30px;
				width: 50px;


			}
			.package .headerDisplayMach .profile img{
				width: 100%;
				height: 100%;
				border-radius: 100%;
				border-radius: 2px solid #45f3ff;
			}
			.package .headerDisplayMach .userName{
				padding: 0 10px;
				font-size: 15px;
				margin-top: 5px;

			}
			.package .headerDisplayMach .names{
				padding: 0 10px;
				font-size: 15px;
				margin-top: 5px;

			}
			.package .headerDisplayMach .time{
				padding: 0 10px;
				font-size: 15px;
				margin-top: 5px;

			}
			.topnav a {
		  float: left;
		  display: block;
		  color: #f2f2f2;
		  text-align: center;
		  padding: 14px 16px;
		  text-decoration: none;
		  font-size: 17px;

		}

		.active {
		/*  background-color: #04AA6D;*/
		  color: #45f3ff;
		}

		.topnav .icon {
		  display: none;
		}
/**/
.schoolResults{
	width:100%;
	padding: 5px 5px;
	background-color: #1c1c1c;
	box-shadow: 0px 0px 20px #45f3ff;
}
.grade{
	width: 100%;

}
.topicId{
	width:100%;
	display: flex;
}

.topicId .leftTf{
	width:70%;
/*	border: 1px solid #45f3ff;*/
	color:#45f3ff;
}
.topicId .centerTf{
	width:15%;
/*	border: 1px solid #45f3ff;*/
	color:#45f3ff;
}
.topicId .rightTf{
	width: 15%;
/*	border: 1px solid #45f3ff;*/
	color:#45f3ff;
} 
.subjects{
	width:100%;
}
.marks{
	width:100%;
}
.flex{
	display: flex;
}
.grade input,select,textarea
{
	width: 100%;
	padding:10px 10px;
	background: transparent;
	
	border-radius: 4px;
	color: #45f3ff;
	border-bottom:1px solid #45f3ff;
}
.Ieleft{
	width:100%;
}
.Ielefr select{
    padding:10px 10px;
}
.Iecenter input{
	width: 100%;
	padding:10px 10px;
	background: transparent;
	border-radius: 4px;
	color: #45f3ff;
	border-bottom:1px solid #45f3ff;
}
.Ieright input{
	width: 100%;
	padding:10px 10px;
	background: transparent;
	border-radius: 4px;
	color: #45f3ff;
	border-bottom:1px solid #45f3ff;
}
	

/*Inputs*/
		.dropdown {
		  float: left;
		  overflow: hidden;
		}

		.dropdown .dropbtn {
		  font-size: 17px;    
		  border: none;
		  outline: none;
		  color: #45f3ff;
		  padding: 14px 16px;
		  background-color: inherit;
		  font-family: inherit;
		  margin: 0;
		}

		.dropdown-content {
		  display: none;
		  position: absolute;
		  background-color: #f9f9f9;
		  min-width: 160px;
		  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		  z-index: 1;
		}

		.dropdown-content a {
		  float: none;
		  color: black;
		  padding: 12px 16px;
		  text-decoration: none;
		  display: block;
		  text-align: left;
		}

		.topnav a:hover, .dropdown:hover .dropbtn {
		  background-color: #555;
		  color: #45f3ff;
		}

		.dropdown-content a:hover {
		  background-color: #ddd;
		  color: black;
		}

		.dropdown:hover .dropdown-content {
		  display: block;
		}
		.overlay {
		  height: 100%;
		  width: 0;
		  position: fixed;
		  z-index: 1;
		  top: 0;
		  left: 0;
		  background-color: rgb(0,0,0);
		  background-color: rgba(0,0,0, 0.9);
		  overflow-x: hidden;
		  transition: 0.5s;
		}

		.overlay-content {
		  position: relative;
		  top: 8%;
		  width: 100%;
		  text-align: left;
		  margin-top: 25px;
		}

		.overlay a {
		  padding: 8px;
		  text-decoration: none;
		  font-size: 20px;
		  color: #45f3ff;
		  display: block;
		  transition: 0.3s;
		}

		.overlay a:hover, .overlay a:focus {
		  color: #f1f1f1;
		}

		.overlay .closebtn {
		  position: absolute;
		  top: 20px;
		  right: 45px;
		  font-size: 60px;
		}

		@media screen and (max-height: 450px) {
		  .overlay a {font-size: 20px}
		  .overlay .closebtn {
		  font-size: 40px;
		  top: 15px;
		  right: 35px;
		  }
		}


		@media screen and (max-width: 600px) {
		  .topnav a:not(:first-child), .dropdown .dropbtn {
		    display: block;
		  }
		  .topnav a.icon {
		    float: right;
		    display: block;
		  }
		}

		@media screen and (max-width: 600px) {
		  .topnav.responsive {position: relative;}
		  .topnav.responsive .icon {
		    position: absolute;
		    right: 0;
		    top: 0;
		  }
		  .topnav.responsive a {
		    float: none;
		    display: block;
		    text-align: left;
		  }
		  .topnav.responsive .dropdown {float: none;}
		  .topnav.responsive .dropdown-content {position: relative;}
		  .topnav.responsive .dropdown .dropbtn {
		    display: block;
		    width: 100%;
		    text-align: left;
		  }
			@media only screen and (max-width: 800px){
				body{
					justify-content: center;
		    align-items: center;
		/*    min-height: 92.8vh;*/
			height: 100%;
		    width: 100%;
/*		    background: url('../../img/mobile.jpg')no-repeat;*/
background: #23242a;
		    background-position: center;

		    background-size: cover;
				}
				section{
				    justify-content: center;
				    align-items: center;
				    height: 100%;
				    width: 100%;
		/*		    background: url('../../img/mobile.jpg')no-repeat;*/
				    background-position: center;
				    background-size: cover;

				}
				.body{
					padding: 0;
				}
				.label{
				    display:block;
				    padding:2px 2px;
				}
				.left{
		/*			border:2px solid white;*/
					width:0%;
					padding: 0 0;
					display: none;
				}
				.center{
		/*			border:2px solid white;*/
					width:0%;
					padding: 0 0;
					display: none;
				}
				.right{
		/*			border:2px solid white;*/
					width:100%;
					padding: 0 10px;
					height: 100%;
					overflow-x:auto;
	                overflow-wrap: break-word;
	                word-wrap: break-word;
	                hyphens: auto;
					
				}
			}
			#faOnTopNav{
				font-size: 22px;
				color:#45f3ff;
			}
			a.slack-content{
				width: 100%;
				padding: 10px 10px;
				text-align: left;
				justify-content: left;
				align-items: left;
				font-size: 15px;


			}
			a.slack-content:hover{
				box-shadow: 0 8px 6px -6px #000;
			}
			a.slack-content #acQr{
				padding: 10px 10px;
				font-size: 15px;
			}
			a.logout{
				padding: 10px 10px;
				background-color: #D2042D;
				box-shadow: 5px 10px #212121;
				border-radius: 5px;
			}

		</style>
		<body>
		<?php
		    if(empty($cur_user_row['version'])||$cur_user_row['version']!=$cur_user_row['current_version']){
	            ?>
	            <style>
	                .versionUpdater{
	                    padding 10px 10px;
	                    border-radius:10px;
	                    border:2px solid purple;
	                    color:#ddd;
	                    text-align:center;
	                    align-content:center;
	                    justify-content:center;
	                    margin-top:15%;
	                    width:10%;
	                    box-shadow: 0 8px 6px -6px #000;
	                }
	                .thf{
	                    padding:10px 10px;
	                    border-radius:100px;
	                    box-shadow: 0 8px 6px -6px #000;
	                    border:2px solid purple;
	                    color:purple;
	                    
	                }
	                .thf{
	                    color:#ddd;
	                    border:2px solid #ddd;
	                }
	                @media screen and (max-height: 800px){
	                    .versionUpdater{
	                        width:70%;
	                        margin-top:20%;
	                    }
	                        
	                }
	            </style>
	            <center>
    	            <div class="versionUpdater">
                        <p>Vesrion in used has expired.</p>
                        <p><span class="btn thf" onclick="updateVersion('<?php echo $cur_user_row["id"];?>','<?php echo $cur_user_row["current_version"];?>')">Update App</span></p>
                        <p hidden class="updateVersionError"></p>
                    </div>
                </center>
                <script>
                    function updateVersion(updateVersionId,NewVersion){
                        $(".updateVersionError").removeAttr("hidden").attr("style","color:green;text-align:center;").html("Processing Request...");
                        $.ajax({
                            url:'./controller/ajaxCallProcessor.php',
                    		type:'post',
                    		data:{updateVersionId:updateVersionId,NewVersion:NewVersion},
                            cache: false,
                            success: function (e) {
                               if(e.length==1){
                                   $(".updateVersionError").attr("style","color:green;text-align:center;").html("Update Success!, Please wait while we log you in.");
                                   window.location=("./");
                                }
                                else{
                                    $(".updateVersionError").html(e);
                                }
                            }
                        });
                    }
                </script>
	            <?php
	            exit();
	        }
	        
		?>
			<div class="topnav" id="myTopnav">
				  <a  onclick="loader('back')" class="active"><i id="faOnTopNav" class="fa fa-arrow-left"></i></a>
				  <a  onclick="loader('apply')" class="active"><i id="faOnTopNav" class="fa fa-graduation-cap"></i></a>
				  <a  onclick="loader('highschool')" class="active"><i id="faOnTopNav" class="fa fa-book"></i></a>
				  <!--<a  onclick="loader('myProfile')" class="active"><i id="faOnTopNav" class="fa fa-user"></i></a>-->
				  <a  onclick="loader('izihlabelelo')" class="active"><i id="faOnTopNav" class="fa fa-music"></i></a>
				  <a  onclick="loader('matricUpgrade')" class="active"><i id="faOnTopNav" class="fa fa-bold"></i></a>

				  <a href="javascript:void(0);" style="font-size:20px;" class="icon" onclick="openNav()">&#9776;</a>
				  <div id="myNav" class="overlay">
				  	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					  <div class="overlay-content">
					    <a onclick="loader('apply')" class="slack-content" ><i id="acQr" class="fa fa-graduation-cap"></i>Tertiary Applications(APPLY)</a>
					    <a onclick="loader('matricUpgrade')" class="slack-content" ><i id="acQr" class="fa fa-bold"></i>Matric Upgrade</a>
					    <a onclick="loader('highschool')" class="slack-content" ><i id="acQr" class="fa fa-book"></i>High School Self Learning</a>
					    <a onclick="loader('tertiary')" class="slack-content" ><i id="acQr" class="fa fa-laptop"></i>Tertiary Self Learning</a>
					    <!-- <a onclick="loader('highschool')" class="slack-content" ><i id="acQr" class="fa fa-book"></i>High School Program</a> -->
					    <a onclick="loader('reportedUsers')" class="slack-content" ><i id="acQr" class="fa fa-flag"></i>Reported Users</a>
					    <a onclick="loader('blockedUsers')" class="slack-content" ><i id="acQr" class="fa fa-ban"></i>Blocked Users</a>
					    <a onclick="loader('asifundeSonke')" class="slack-content" ><i id="acQr" class="fa fa-question-circle"></i>Asifunde Sonke</a>
					    <hr>
					    <a onclick="loader('izihlabelelo')" class="slack-content"><i id="acQr" class="fa fa-music"></i>Izihlabelelo</a>
					    <a onclick="loader('notification')" class="slack-content" ><i id="acQr" class="fa fa-bell"></i>Notifications</a>
					    <a onclick="loader('myProfile')" class="slack-content" ><i id="acQr" class="fa fa-user"></i>My Profile</a>
					    <a onclick="loader('logout')" class="slack-content logout" ><i id="acQr" class="fa fa-sign-out"></i>Logout</a>
					  </div>
				  </div>
				</div>
			<section>
				<div class="body">
					<div class="left">
					</div>
					<div class="center">
					</div>	
					<div class="right"></div>
				</div>
			</section>

<div class="modal fade" id="addApplicationTertiary" role="dialog" >
    <div class="modal-dialog" >
      <div class="modal-content"style="color:#45f3ff;background-color:#212121;">
       <div class="header-malo">
           <h5>Add Application here</h5>
       </div>
        <div class="modal-body">
            <div class="rode-map">  
              <select class="uni-row" name="uni" >
                  <option value="">-- Select University --</option>
                  <?php
                  // echo"kldnflkdnslk";
                  $response=$pdo->getuniversities();                       
                  foreach($response as $row){
                      ?>
                      <option value="<?php echo $row['id'];?>" ><?php echo $row['uni_name'];?></option>
                      <?php
                  }
                  ?>
              </select> 
              <br><br>
              <button class="btn " style="border:1px solid #45f3ff;color:#45f3ff;" onclick="selectTertiary()" data-dismiss="modal">Select Tertiary</button>
            </div>    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default set" data-dismiss="modal" style="">Close</button>
        </div>
      </div>
    </div>
</div>
<?php 
$students_applications_login_details=$pdo->get_students_applications_login_details($pdo->getApplicationId($cur_user_row['my_id']));
foreach($students_applications_login_details as $row){
	?>
<div class="modal fade" id="Pera_<?php echo $row['uni_id']."-".$row['student_id_ref'];?>" role="dialog" >
    <div class="modal-dialog" >
      <div class="modal-content"style="color:#45f3ff;background-color:#212121;">
       <div class="header-malo">
           <h5><?php echo $row['uni_name'];?></h5>
       </div>
        <div class="modal-body">
            <div class="rode-map">  
              <div class="MerriDalo">
              		Student No : <?php echo $row['uni_student_no'];?>
              </div>
              <div class="MerriDalo">
              		Password - : <?php echo $row['uni_pass_word'];?>
              </div>
              <div class="Marco" style="padding: 10px 10px;">
              		<span class="btn">LOGIN</span>
              </div>
              <br><br>
              <button class="btn " style="border:1px solid #45f3ff;color:#45f3ff;" onclick="selectTertiary()" data-dismiss="modal">Select Tertiary</button>
            </div>    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default set" data-dismiss="modal" style="">Close</button>
        </div>
      </div>
    </div>
</div>
<?php
}
?>
<div class="modal fade" id="StudyAreaUpload" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload My Question/Problem</h4>
        </div>
        <div class="modal-body">
        	<style>
        		.img_selector,.text_editor{
        			width: 100%;
        		}
        		.img_selector input,.text_editor textarea{
        			width: 100%;
        		}
        		.text_editor textarea{
        			max-width: 100%;
        			min-width: 100%;

        			max-height: 50vh;

					border:none;
					border-left:2px solid #45f3ff;
					padding: 10px 10px;
					background: #212121;
					color: #45f3ff;

        		}
        	</style>
        	<div class="img_selector">
          	<input type="text"  id="studyAreaMathTitle" placeholder="Enter Your Title Here..">
          </div>
          <div class="img_selector">
          	<input type="file" name="file" id="studyAreaMathInput" accept="video/*,image/*">
          </div>
          <br>
          <div class="text_editor">
          	<textarea id="studyAreaMathText" placeholder="Upload Problem/Question..."></textarea>
          </div>
          <div class="buttn">
          	<button type="button" class="btn" id="studyAreaMath" onclick="uploadMathQuestion()">Ask</button>
          </div>
          <div class="errorDisplayermessageStudyArea" hidden></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
<div class="modal fade" id="coding" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Write My Code</h4>
        </div>
        <div class="modal-body">
        	<style>
        		.img_selector,.text_editor{
        			width: 100%;
        		}
        		.img_selector input,.text_editor textarea{
        			width: 100%;
        		}
        		.text_editor textarea{
        			max-width: 100%;
        			min-width: 100%;
        			min-height: 50vh;
        			max-height: 90vh;
        			border:none;
					border-left:2px solid #45f3ff;
					padding: 10px 10px;
					background: #212121;
					color: #45f3ff;
        		}
        	</style>
        	<div class="img_selector">
          	<input type="text"  id="studyAreaMathTitleCode" placeholder="Enter Your Title Here..">
          </div>
          <div class="text_editor">
          	<textarea type="code" id="studyAreaMathCode" placeholder="String variable='Add my Problem/Solution Code Here';//JAVA,PHP,..."></textarea>
          </div>
          <div class="buttn">
          	<button type="button" class="btn" id="studyAreaMathCodeSubmit" onclick="UploadCodeQuestion()">Ask</button>
          </div>
          <div class="errorDisplayermessageStudyAreaCode" hidden></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
<div class="modal" id="replyStudyArea" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Reply To Post</h4>
        </div>
        <div class="modal-body replyStudyArea">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="codingReplyCloseIMGTEXT()">Close</button>
        </div>
      </div>
      
    </div>
</div>
<div class="modal" id="codingReply" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Write My Code to Reply</h4>
        </div>
        <div class="modal-body codingReply"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="codingReplyClose()">Close</button>
        </div>
      </div>
      
    </div>
</div>
<div class="modal fade" id="img_gost0" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:#45f3ff;" class="modal-title">Update Profile </h4>
        </div>
        <div class="modal-body">
        	<style>
        		.img_selector,.text_editor{
                    width: 100%;

                }
                .img_selector input,.text_editor input{
                    width: 100%;
                    color: #45f3ff;
                    background-color:#212121;
                    border: none;
                    border-bottom: 2px solid #45f3ff;
                }
                .img_selector select,.text_editor select{
                    width: 100%;
                    color: #45f3ff;
                    background-color:#212121;
                    border: none;
                    border-bottom: 2px solid #45f3ff;
                }

        	</style>
          <div class="img_selector">
          	<input type="file" name="file" id="profilePost" accept="image/*">
          </div>
          <div class="errorDisplayerProfile" hidden></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
<div class="modal" id="showAnswersModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h3 style="color:#000;text-align:left;">Solutions to question</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body showAnswersModal">
            ksksaklsa
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeMyModalNow()">Close</button>
        </div>
      </div>
    </div>
 </div>
 <div class="modal fade" id="install_module" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:#45f3ff;" class="modal-title">INSTALL A MODULE</h4>
        </div>
        <div class="modal-body">
            <style>
                .img_selector,.text_editor{
                    width: 100%;

                }
                .img_selector input,.text_editor input{
                    width: 100%;
                    color: #45f3ff;
                    background-color:#212121;
                    border: none;
                    border-bottom: 2px solid #45f3ff;
                }
                .img_selector select,.text_editor select{
                    width: 100%;
                    color: #45f3ff;
                    background-color:#212121;
                    border: none;
                    border-bottom: 2px solid #45f3ff;
                }
            </style>
            <div class="text_editor">
                <select  class="select_module_2_reg">
                    <option value="">-- Select Module --</option>
                
                  
                    <?php
                    $getAllModules=$pdo->getAllModules();//$conn->query("select*from sgelavarsymodules");
                    
                   foreach($getAllModules as $row){
                        ?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['module'];?></option> 
                        <?php
                    }
                    
                    ?>
                </select>
            </div>
            <div class="text_editor">
                <select class="level_module">
                    <option value="">-- Select Level of Study --</option>
                    <option value="1st">1st year </option>
                    <option value="2nd">2nd year </option>
                    <option value="3rd">3rd year </option>
                    <option value="NS">not Studying </option>
                    
                </select>
            </div>
               <br>   
              <div class="buttn">
                <button type="button" class="btn" onclick="installModuleSgela()" style="color:#45f3ff;background-color: none;border:1px solid #45f3ff;">Install</button>
              </div>
              <div class="errorSgelaModuleInstall" hidden></div>

              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

		<script>
			$(document).ready(function(){
				const screenSize=$(document).height()-59;
				const myTopnav=$(".topnav").innerHeight();
				console.log(screenSize+" "+myTopnav);
				// $("section").height(screenSize);
				$(".body").height(screenSize);
				firstLoader();
			});
			$(document).on("change",".updateLevelVAVA",function(){
				const updateLevelVAVA=$(".updateLevelVAVA").val();
				if(updateLevelVAVA==""){
					$(".medLocker").attr("style","color:white;background:red;text-align:center;").html("Input Required*");
				}
				else{
					$(".medLocker").attr("style","color:white;background:green;text-align:center;").html("<small><img style='width:4%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting request..</span></small>");
					$.ajax({
		                url:'./controller/ajaxCallProcessor.php',
		                type:'post',
		                data:{
							updateLevelVAVA:updateLevelVAVA
		                },
		                success:function(e){
		                    if(e.length>1){
		                        $(".medLocker").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
		                    }
		                    else{
		                         $(".medLocker").html("Data Submitted Successfully please wait, redirecting...");
		                         loader("tertiary");
		                    }
		                    
		                }
		            });
				}
			});
			$(document).on('change','#profilePost',function(){
				$(".errorDisplayerProfile").removeAttr("hidden");
				$(".errorDisplayerProfile").html("<small><img style='width:3%;' src='img/loader.gif'> <span style='color:green;'>Analysing File Data...</span></small>");
		        const image=$("#profilePost").val();
		    	var form_data=new FormData();
				var imageProfileTag="";
				if(image!=""){
					imageProfileTag=document.getElementById("profilePost").files[0].name;
				}
				var ext=imageProfileTag.split('.').pop().toLowerCase();
				const array=["jpg","png","jpeg","jpeng","heic","JPG","PNG","JPEG","JPENG","HEIC","GIF","gif"];
				if(jQuery.inArray(ext,array)==-1 && imageProfileTag!=""){
					$(".errorDisplayerProfile").removeAttr("hidden");
					$(".errorDisplayerProfile").html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic} Format </small>");

				}
				else{
					if(image!=""){
						form_data.append("imageProfileTag",document.getElementById("profilePost").files[0]);
					}
					else{
						form_data.append("imageProfileTag",imageProfileTag);
					}
					console.log(imageProfileTag);
					$.ajax({
						url:"./controller/ajaxCallProcessor.php",
						type:"POST",
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						beforeSend:function(){
							$(".errorDisplayerProfile").removeAttr("hidden");
							$(".errorDisplayerProfile").html("<img style='width:3%;' src='../view/img/loader.gif'><h5 style='color:#fff;'>UPLOADING..</h5>");
						},
						success:function(e){
							
							if(e.length>1){
								$(".errorDisplayerProfile").removeAttr("hidden");
								$(".errorDisplayerProfile").attr("style","color:red;");
								$(".errorDisplayerProfile").html(e);
							}
							else{
								$(".errorDisplayerProfile").removeAttr("hidden");
								$(".errorDisplayerProfile").html("<small style='color:green;'> Profile updated successfuly</small>");
								$("#profilePost").val("");
								$(".center").html("<img src='../../img/Loading-Full.gif' width='100%'>").load("./view/center.php");
								
		                        
							}
						}
					});
				}
			});

		function uploadMathQuestion(){
			const studyAreaMathInput=$("#studyAreaMathInput").val();
			const studyAreaMathText=$("#studyAreaMathText").val();
			const studyAreaMathTitle=$("#studyAreaMathTitle").val();

			// console.log(studyAreaMathText);
			if(studyAreaMathTitle==""){
				$(".errorDisplayermessageStudyArea").removeAttr("hidden");
				$(".errorDisplayermessageStudyArea").html("<small style='color:red;background-color:#000;'>Title is Required</small>");
			}
			else{
				if(studyAreaMathInput=="" && studyAreaMathText==""){
					$(".errorDisplayermessageStudyArea").removeAttr("hidden");
					$(".errorDisplayermessageStudyArea").html("<small style='color:red;'>Cannot send empty file/Text!!..</small>");
				}
				else{
					var form_data=new FormData();
					var file="";
					if(studyAreaMathInput!=""){
						file=document.getElementById('studyAreaMathInput').files[0].name;
					}
					var ext=file.split('.').pop().toLowerCase();
					const array=["mp4","mv","png","jpg","jpeng","heic","MV4","MV","PNG","JPG","JPEG","jpeg","JPENG","HEIC","gif","GIF"];
					if(jQuery.inArray(ext,array)==-1 && file!=""){
						$(".errorDisplayermessageStudyArea").removeAttr("hidden");
						$(".errorDisplayermessageStudyArea").html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic} Format </small>")

					}
					else{
						if(studyAreaMathInput!=""){
							form_data.append("file",document.getElementById("studyAreaMathInput").files[0]);
						}
						else{
							form_data.append("file",file);
						}
						form_data.append("studyAreaMathTitle",studyAreaMathTitle);
						form_data.append("studyAreaMathText",studyAreaMathText);
						
						$(".errorDisplayermessageStudyArea").removeAttr("hidden");
						$(".errorDisplayermessageStudyArea").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
						$.ajax({
							url:"./controller/ajaxCallProcessor.php",
							type:"POST",
							data:form_data,
							contentType:false,
							cache:false,
							processData:false,
							beforeSend:function(){
								$(".errorDisplayermessageStudyArea").removeAttr("hidden");
								$(".errorDisplayermessageStudyArea").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
							},
							success:function(e){
								console.log(e);
								console.log(e.length);
								if(e.length>2){
									$(".errorDisplayermessageStudyArea").removeAttr("hidden");
									$(".errorDisplayermessageStudyArea").attr("style","color:red;");
									$(".errorDisplayermessageStudyArea").html(" <br>Error 320 : "+e);
								}
								else{
									$(".errorDisplayermessageStudyArea").removeAttr("hidden");
									$(".errorDisplayermessageStudyArea").html("<small style='color:green;'> SENT..</small>");
									$("#studyAreaMathText").val("");
									$("#studyAreaMathInput").val("");
									loader("asifundeSonke");
									
								}
							}
						});
					}
				}
			}
				
		}
		function UploadCodeQuestion(){
			const studyAreaMathTitleCode =$("#studyAreaMathTitleCode").val();
			const studyAreaMathCode =$("#studyAreaMathCode").val();
			if(studyAreaMathTitleCode==""){
				$(".errorDisplayermessageStudyAreaCode").removeAttr("hidden").attr("style","color:red;").html("Tittle Rquired..");
			}
			else if(studyAreaMathCode==""){
				$(".errorDisplayermessageStudyAreaCode").removeAttr("hidden").attr("style","color:red;").html("Code Body Rquired..");
			}
			else{
				$(".errorDisplayermessageStudyAreaCode").removeAttr("hidden").html("<center><img style='width:4%;' src='../../img/processor.gif'> Processing Request</center>");
				$.ajax({
	                url:'./controller/ajaxCallProcessor.php',
	                type:'post',
	                data:{
						studyAreaMathTitleCode:studyAreaMathTitleCode,
						studyAreaMathCode:studyAreaMathCode
	                },
	                success:function(e){
	                    if(e.length>1){
	                        $(".errorDisplayermessageStudyAreaCode").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
	                    }
	                    else{
	                         $(".errorDisplayermessageStudyAreaCode").html("Data Submitted Successfully please wait, redirecting...");
	                         loader("asifundeSonke");
	                    }
	                    
	                }
	            });
			}

		}
		function UploadTextQuestion(){
			const studyAreaMathTitleCode =$("#studyAreaMathTitleCode").val();
			const studyAreaMathCode =$("#studyAreaMathCode").val();
			if(studyAreaMathTitleCode==""){
				$(".errorDisplayermessageStudyAreaCode").removeAttr("hidden").attr("style","color:red;").html("Tittle Rquired..");
			}
			else if(studyAreaMathCode==""){
				$(".errorDisplayermessageStudyAreaCode").removeAttr("hidden").attr("style","color:red;").html("Code Body Rquired..");
			}
			else{
				$(".errorDisplayermessageStudyAreaCode").removeAttr("hidden").html("<center><img style='width:4%;' src='../../img/processor.gif'> Processing Request</center>");
				$.ajax({
	                url:'./controller/ajaxCallProcessor.php',
	                type:'post',
	                data:{
						studyAreaMathTitleCode:studyAreaMathTitleCode,
						studyAreaMathCode:studyAreaMathCode
	                },
	                success:function(e){
	                    if(e.length>1){
	                        $(".errorDisplayermessageStudyAreaCode").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
	                    }
	                    else{
	                         $(".errorDisplayermessageStudyAreaCode").html("Data Submitted Successfully please wait, redirecting...");
	                         loader("apply");
	                    }
	                    
	                }
	            });
			}

		}
		function validEmail(email){
			const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
			return validRegex.test(email);
		}
		function DislikePost(post_id_dislike){
			$.ajax({
				url:'./controller/ajaxCallProcessor.php',
				type:'post',
				data:{post_id_dislike:post_id_dislike},
				success:function(e){
					$("#"+post_id_dislike).html(e);
				}
			});
		}
		function views(post_id_views){
			$.ajax({
				url:'./controller/ajaxCallProcessor.php',
				type:'post',
				data:{post_id_views:post_id_views},
				success:function(e){
					console.log(e);
				}
			});
		}
		function likePost(post_id_like){
			$.ajax({
				url:'./controller/ajaxCallProcessor.php',
				type:'post',
				data:{post_id_like:post_id_like},
				success:function(e){
					$("#_"+post_id_like).html(e);
				}
			});
		}
		function selectTertiary(){
			const uniSelected=$(".uni-row").val();
			if(uniSelected==""){
				$(".fallbackEmptyOrError").attr("style","color:red;").html("Please select one university to process!!..");
			}
			else{
				$(".fallbackEmptyOrError").removeAttr("style").html("");
				$(".add-uni-application").attr("style","color:#45f3ff;").html("Please wait while Fetching Tertiary for you...").load("./model/campusSelectLoader.php?q="+uniSelected);
			}
		}
		function firstLoader(){
			$(".left").html("<img src='../../img/Loading-Full.gif' width='100%'>").load("./view/left.php");
			$(".center").html("<img src='../../img/Loading-Full.gif' width='100%'>").load("./view/center.php");
			loader("home");
		}
		function loadStudyAreaReply(_){
			$(".bodyStudyArea").html("<center><img style='width:4%;' src='../../default-img/loader.gif'></center>").load("./model/loadStudyAreaReply.php?_="+_+"&min=0&max=7");
		}
		function loadStudyArea(min,max){
			$(".bodyStudyArea").html("<center><img style='width:4%;' src='../../img/processor.gif'></center>").load("./model/asifundeSonke.php?min="+min+"&max="+max);
		}
		function loader(url){
			$(".right").html("<img src='../../img/Loading-Full.gif' width='100%'>").load("./view/view.php?"+url);
			closeNav()
		}
		function openNav() {
		  document.getElementById("myNav").style.width = "100%";
		}

		function closeNav() {
		  document.getElementById("myNav").style.width = "0%";
		}
		function dofoUsLeg(subj_id){
		    loader("highschool&_-="+subj_id);
		}
		function dofoUsLeg1(chapter_id){
		    loader("highschool&_-_="+chapter_id);
		}
		function installModuleSgela(){
			$(".errorSgelaModuleInstall").removeAttr("hidden").attr("style","border:2px solid white;color:white;width:100%;border-radius:10px;").html("<center><img style='width:4%;' src='../../img/processor.gif'> Processing Request</center>");
			const select_module_2_reg=$(".select_module_2_reg").val();
			const level_module=$(".level_module").val();
			if(select_module_2_reg==""){
				$(".errorSgelaModuleInstall").attr("style","background:red;color:white;").html("All Fields are Required*");
			}
			else if(level_module==""){
				$(".errorSgelaModuleInstall").attr("style","background:red;color:white;").html("All Fields are Required*");
			}
			else{
				$.ajax({
					url:'./controller/ajaxCallProcessor.php',
					type:'post',
					data:{select_module_2_reg:select_module_2_reg,level_module:level_module},
					success:function(e){
						console.log(e);
						if(e.length==1){
							$(".errorSgelaModuleInstall").attr("style","background:green;color:white;").html("Module Successfully Added. Close window.");
							$(".select_module_2_reg").val("");
							$(".level_module").val("");
							loader("tertiary");
						}
						else{
							$(".errorSgelaModuleInstall").attr("style","background:red;color:white;").html(e);
						}

					}
				});
			}
		}
		function blockUser(blockeeUser,classD,directory){
            $.ajax({
                url:'./controller/ajaxCallProcessor.php',
        		type:'post',
        		data:{blockeeUser:blockeeUser},
                cache: false,
                success: function (e) {
                    if(e.length==1){
                        loader(directory);
                    }
                    else{
                        $("."+classD).html(e);
                    }
                }
            });
        }
        function reportUser(flaggeeUser,classD,directory){
            $.ajax({
                url:'./controller/ajaxCallProcessor.php',
        		type:'post',
        		data:{flaggeeUser:flaggeeUser},
                cache: false,
                success: function (e) {
                   if(e.length<10){
                        loader(directory);
                    }
                    else{
                        $("."+classD).html(e);
                    }
                }
            });
        }
        function unFlagUser(unFlagUser,unflaggeeUser){
        // 	console.log("Unflaging User : "+unFlagUser+" - "+unflaggeeUser);
            $.ajax({
                url:'./controller/ajaxCallProcessor.php',
        		type:'post',
        		data:{unFlagUser:unFlagUser,unflaggeeUser:unflaggeeUser},
                cache: false,
                success: function (e) {
                   if(e.length==1){
                        loader("reportedUsers");
                    }
                    else{
                        $(".ranch"+unFlagUser).html(e);
                    }
                }
            });
        }
        
		function unblockThisUser(unblockThisUser,unblockeeId){
			console.log(unblockeeId);
            $.ajax({
                url:'./controller/ajaxCallProcessor.php',
        		type:'post',
        		data:{unblockThisUser:unblockThisUser,unblockeeId:unblockeeId},
                cache: false,
                success: function (e) {
                   if(e.length==1){
                       loader("blockedUsers");
                    }
                    else{
                        $(".ranch"+unblockThisUser).html(e);
                    }
                }
            });
        }
        function runCalculator(isRun=false){
            var countDownDate = new Date("July 31, 2023 23:59:59").getTime();
            var x = setInterval(function() {
              var now = new Date().getTime();
                
             
              var distance = countDownDate - now;
                
             
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
              if(isRun){
                   document.getElementById("acho-date").innerHTML = "<span id='d'>"+days + "d </span><span style='color:#45f3ff;'> </span>" + "<span id='h'>"+hours + "h </span><span style='color:#45f3ff;'> </span>"
              + "<span id='m'>"+minutes + "m </span><span style='color:#45f3ff;'> </span>" + "<span id='s'>"+seconds + "s </span>";
              }
              if (distance < 0) {
                clearInterval(x);
                document.getElementById("acho-date").innerHTML = "EXPIRED";
              }
            }, 1000);
        }
        function submitStep3(studedentApplicationId,my_id_step3){
				// $("#_3_").attr("disabled","true");
				const street=$("#street").val();
				const suburb=$("#suburb").val();
				const town=$("#town").val();
				const province=$("#province").val();
				const postal=$("#postal").val();
				const phone=$("#phone").val();
				const telephone=$("#telephone").val();
				const email=$("#email").val();
				const res=$("#res").val();
				const dis=$("#dis").val();
				console.log(street+" "+suburb+" "+town+" "+province+" "+postal+" "+phone+" "+telephone+" "+email+" "+res+" "+dis);
				$("#errorstreet").attr("hidden","true");
				$("#errorsuburb").attr("hidden","true");
				$("#errortown").attr("hidden","true");
				$("#errorprovince").attr("hidden","true");
				$("#errorpostal").attr("hidden","true");
				$("#errorphone").attr("hidden","true");
				$("#errortelephone").attr("hidden","true");
				$("#errortelephone").attr("hidden","true");
				$("#errorres").attr("hidden","true");
				$("#errordis").attr("hidden","true");
				$(".errorCatch3").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
				if(street==""){
					$("#errorstreet").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else if(suburb==""){
					$("#errorsuburb").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else if(town==""){
					$("#errortown").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else if(province==""){
					$("#errorprovince").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else if(postal==""){
					$("#errorpostal").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else if(phone==""){
					$("#errorphone").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else if(telephone==""){
					$("#errortelephone").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else if(email==""){
					$("#errortelephone").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else if(res==""){
					$("#errorres").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else if(dis==""){
					$("#errordis").removeAttr("hidden").attr("style","color:red;").html("Required**");
				}
				else{
					$.ajax({
		                url:'./controller/ajaxCallProcessor.php',
		                type:'post',
		                data:{
							street:street,
							suburb:suburb,
							town:town,
							province:province,
							postal:postal,
							phone:phone,
							telephone:telephone,
							email:email,
							res:res,
							dis:dis,
							studedentApplicationId:studedentApplicationId,
							my_id_step3:my_id_step3
		                },
		                success:function(e){
		                	console.log(e);
		                    if(e.length>1){
		                    	$("#_3_").removeAttr("disabled");
		                        $(".errorCatch3").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
		                    }
		                    else{
		                         $(".errorCatch3").html("Data Submitted Successfully please wait, redirecting...");
		                         loader("apply");
		                    }
		                    
		                }
		            });
				}
			}
			function submitStep4(applicationidStep4,my_id_step4){
				const fname=$("#fname").val();
				const lname=$("#lname").val();
				const relationship=$("#relationship").val();
				const employed=$("#employed").val();
				const phone=$("#phone").val();
				const alphone=$("#alphone").val();
				const email=$("#email").val();
				const street=$("#street").val();
				const suburb=$("#suburb").val();
				const town=$("#town").val();
				const province=$("#province").val();
				const postal=$("#postal").val();
				// $("#_4_").attr("disabled","true");
				$(".errorCatch4").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
				if(fname==""){
					$("#errorfname").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(lname==""){
					$("#errorlname").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(relationship==""){
					$("#errorrelationship").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(employed==""){
					$("#erroremployed").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(phone==""){
					$("#errorphone").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(alphone==""){
					$("#erroralphone").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(email==""){
					$("#erroremail").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(street==""){
					$("#errorstreet").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(suburb==""){
					$("#errorsuburb").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(town==""){
					$("#errortown").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(province==""){
					$("#errorprovince").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else if(postal==""){
					$("#errorpostal").removeAttr("hidden").attr("style","color:red").html("Required**");
					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_4_").removeAttr("disabled");
				}
				else{
					console.log(fname+" "+lname+" "+relationship+" "+employed+" "+phone+" "+alphone+" "+email+" "+street+" "+suburb+" "+town+" "+province+" "+postal+" "+applicationidStep4+" "+my_id_step4);
					$.ajax({
		                url:'./controller/ajaxCallProcessor.php',
		                type:'post',
		                data:{

							fname:fname,
							lname:lname,
							relationship:relationship,
							employed:employed,
							phone:phone,
							alphone:alphone,
							email:email,
							street:street,
							suburb:suburb,
							town:town,
							province:province,
							postal:postal,
							applicationidStep4:applicationidStep4,
							my_id_step4:my_id_step4
		                },
		                success:function(e){
		                	console.log(e);
		                    if(e.length>1){
		                    	$("#_4_").removeAttr("disabled");
		                        $(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
		                    }
		                    else{
		                         $(".errorCatch4").html("Data Submitted Successfully please wait, redirecting...");
		                         loader("apply");
		                    }
		                    
		                }
		            });
				}
			}
			function submitStep5(applicationidStep5,my_id_step5){
				// $("#_5_").attr("disabled","true");
				$(".errorCatch5").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
				const schoolname=$("#schoolname").val();
				const street=$("#street").val();
				const suburb=$("#suburb").val();
				const town=$("#town").val();
				const province=$("#province").val();
				const postal=$("#postal").val();
				const yearcompleted=$("#yearcompleted").val();
				const activity=$("#activity").val();
				const eduhistory=$("#eduhistory").val();
				const uni=$("#uni").val();
				const studentnumber=$("#studentnumber").val();
				const statuscompletion=$("#statuscompletion").val();
				if(schoolname==""){
					$("#errorschoolname").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_5_").removeAttr("disabled");
				}
				else if(street==""){
					$("#errorstreet").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_5_").removeAttr("disabled");
				}
				else if(suburb==""){
					$("#errorsuburb").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_5_").removeAttr("disabled");
				}
				else if(town==""){
					$("#errortown").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_5_").removeAttr("disabled");
				}
				else if(province==""){
					$("#errorprovince").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_5_").removeAttr("disabled");
				}
				else if(postal==""){
					$("#errorpostal").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_5_").removeAttr("disabled");
				}
				else if(yearcompleted==""){
					$("#erroryearcompleted").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_5_").removeAttr("disabled");
				}
				else if(activity==""){
					$("#erroractivity").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_5_").removeAttr("disabled");
				}
				else if(eduhistory==""){
					$("#erroreduhistory").removeAttr("hidden").attr("style","color:red;").html("Required**");
					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					$("#_5_").removeAttr("disabled");
				}

				else{
					var bool=true;
					if(eduhistory=="Yes"){
						if(uni==""){
							$("#erroruni").removeAttr("hidden").attr("style","color:red;").html("Required**");
							bool=false;
						}
						else if(studentnumber==""){
							$("#errorstudentnumber").removeAttr("hidden").attr("style","color:red;").html("Required**");
							bool=false;
						}
						else if(statuscompletion==""){
							$("#errorstatuscompletion").removeAttr("hidden").attr("style","color:red;").html("Required**");
							bool=false;
						}
						else{
							bool=true;
						}
					}
					if(bool){
						$.ajax({
			                url:'./controller/ajaxCallProcessor.php',
			                type:'post',
			                data:{
								applicationidStep5:applicationidStep5,
								my_id_step5:my_id_step5,
								schoolname:schoolname,
								street:street,
								suburb:suburb,
								town:town,
								province:province,
								postal:postal,
								yearcompleted:yearcompleted,
								activity:activity,
								eduhistory:eduhistory,
								uni:uni,
								studentnumber:studentnumber,
								statuscompletion:statuscompletion
			                },
			                success:function(e){
			                	console.log(e);
			                    if(e.length>1){
			                    	$("#_4_").removeAttr("disabled");
			                        $(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
			                    }
			                    else{
			                         $(".errorCatch5").html("Data Submitted Successfully please wait, redirecting...");
			                         loader("apply");
			                    }
			                    
			                }
			            });
					}
					else{
						 $(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
					}
				}
			}
			$(document).on('change','#idcopy',function(){
				$("#erroridcopy").removeAttr("hidden");
				$("#erroridcopy").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

				var file=document.getElementById('idcopy').files[0].name;
				var form_data=new FormData();
				var ext=file.split('.').pop().toLowerCase();
				if(jQuery.inArray(ext,['pdf'])==-1){
					$("#erroridcopy").removeAttr("hidden");
					$("#erroridcopy").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

				}
				else{
					$("#erroridcopy").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
					form_data.append("file",document.getElementById("idcopy").files[0]);
					$("#erroridcopy").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
					form_data.append("erroridcopy","erroridcopy");
					$.ajax({
						url:"./controller/ajaxCallProcessor.php",
						type:"POST",
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						beforeSend:function(){
							$("#erroridcopy").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
						},
						success:function(e){
							console.log(e.length);
							if(e.length>2){
								$("#erroridcopy").attr("style","color:red;");
								$("#erroridcopy").html(" <br>Error 320 : "+e);
							}
							else{
								
								$("#erroridcopy").attr("hidden",true);
								$("#_1_1").attr("style","color:green;");
								$("#_1_1").html("SUCCESSFULY UPLOADED");
								$("#_2").removeAttr("hidden");
								
							}
						}
					});
				}
			});
			$(document).on('change','#finalresults',function(){
				$("#errorfinalresults").removeAttr("hidden");
				$("#errorfinalresults").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

				var file=document.getElementById('finalresults').files[0].name;
				var form_data=new FormData();
				var ext=file.split('.').pop().toLowerCase();
				if(jQuery.inArray(ext,['pdf'])==-1){
					$("#errorfinalresults").removeAttr("hidden");
					$("#errorfinalresults").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

				}
				else{
					$("#errorfinalresults").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
					form_data.append("file",document.getElementById("finalresults").files[0]);
					$("#errorfinalresults").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
					form_data.append("errorfinalresults","errorfinalresults");
					$.ajax({
						url:"./controller/ajaxCallProcessor.php",
						type:"POST",
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						beforeSend:function(){
							$("#errorfinalresults").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
						},
						success:function(e){
							console.log(e.length);
							if(e.length>2){
								$("#errorfinalresults").attr("style","color:red;");
								$("#errorfinalresults").html(" <br>Error 320 : "+e);
							}
							else{
								
								$("#errorfinalresults").attr("hidden",true);
								$("#_2_2").attr("style","color:green;");
								$("#_2_2").html("SUCCESSFULY UPLOADED");
								$("#_3").removeAttr("hidden");
								
							}
						}
					});
				}
			});
			$(document).on('change','#proofresident',function(){
				$("#errorproofresident").removeAttr("hidden");
				$("#errorproofresident").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

				var file=document.getElementById('proofresident').files[0].name;
				var form_data=new FormData();
				var ext=file.split('.').pop().toLowerCase();
				if(jQuery.inArray(ext,['pdf'])==-1){
					$("#errorproofresident").removeAttr("hidden");
					$("#errorproofresident").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

				}
				else{
					$("#errorproofresident").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
					form_data.append("file",document.getElementById("proofresident").files[0]);
					$("#errorproofresident").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
					form_data.append("proofresident","proofresident");
					$.ajax({
						url:"./controller/ajaxCallProcessor.php",
						type:"POST",
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						beforeSend:function(){
							$("#errorproofresident").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
						},
						success:function(e){
							console.log(e.length);
							if(e.length>2){
								$("#errorproofresident").attr("style","color:red;");
								$("#errorproofresident").html(" <br>Error 320 : "+e);
							}
							else{
								
								$("#errorproofresident").attr("hidden",true);
								$("#_3_3").attr("style","color:green;");
								$("#_3_3").html("SUCCESSFULY UPLOADED");
								$("#_4").removeAttr("hidden");
								
							}
						}
					});
				}
			});
			$(document).on('change','#guardianid',function(){
				$("#errorguardianid").removeAttr("hidden");
				$("#errorguardianid").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

				var file=document.getElementById('guardianid').files[0].name;
				var form_data=new FormData();
				var ext=file.split('.').pop().toLowerCase();
				if(jQuery.inArray(ext,['pdf'])==-1){
					$("#errorguardianid").removeAttr("hidden");
					$("#errorguardianid").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

				}
				else{
					$("#errorguardianid").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
					form_data.append("file",document.getElementById("guardianid").files[0]);
					$("#errorguardianid").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
					form_data.append("guardianid","guardianid");
					$.ajax({
						url:"./controller/ajaxCallProcessor.php",
						type:"POST",
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						beforeSend:function(){
							$("#errorguardianid").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
						},
						success:function(e){
							console.log(e.length);
							if(e.length>2){
								$("#errorguardianid").attr("style","color:red;");
								$("#errorguardianid").html(" <br>Error 320 : "+e);
							}
							else{
								
								$("#errorguardianid").attr("hidden",true);
								$("#_4_4").attr("style","color:green;");
								$("#_4_4").html("SUCCESSFULY UPLOADED");
								$("#_submitFiles").removeAttr("hidden");
								$("#_submit_").html("<img style='width:8%;' src='../../img/processor.gif'> Navigating to next step...");


								loader("apply");
								
							}
						}
					});
				}
			});
			function acceptConditions(applicationidStep8,my_id_step8){
				const accept=$("#accept").val();
				if(accept=="Yes"){
					$.ajax({
						url:"./controller/ajaxCallProcessor.php",
						type:"POST",
						data:{
							accept:accept,applicationidStep8:applicationidStep8,my_id_step8:my_id_step8
						},
						cache:false,
						beforeSend:function(){
							$("#acceptconditionerror").removeAttr("hidden").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting Data...</span></small>");
						},
						success:function(e){
							console.log(e);
							if(e.length==1){
								$("#acceptconditionerror").attr("style","color:#45f3ff;background:green;").html("Successfully Saved..");
								loader("apply");
							}
							else{
								$("#acceptconditionerror").attr("style","color:red;").html(e);
							}
						}
					});
				}
				else{
					$("#acceptconditionerror").attr("style","color:red;").html("Cannot Proceed until you accept Ts n Cs");
				}
			}
			


		</script>
	<?php
}
else{
	session_destroy();
?>
	<script>
		window.location=("../?session failed");
	</script>
<?php
}
?>
