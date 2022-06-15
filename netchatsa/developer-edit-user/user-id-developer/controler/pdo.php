<?php
$user="root";
$pass="";
$dbnam="netchatsa";
$conn=mysqli_connect("localhost",$user,$pass,$dbnam)or die("Connection was not established!!");
class _pdo_{
	protected function messages($cur_user_row){
		global $conn;
		?>
<style>
	/*
Message box-sholing all users
*/
 .showAll{
    	border: 1px solid #000;
    	box-shadow: 1px 1px 1px 1px #000;
    	width: 100%;
    	padding: 10px;
    	border-bottom: 1px solid #000;
    	display: flex;
    	/*--------------------*/
   
		 	color: #f3f3f3;
		 	

		/*-------------------------------*/
    }
     .showAll .imgProfile{
    	width: 40px;
    	height: 40px;
    	cursor: pointer;
    	border-radius: 100%;
    	border: 1px solid navy;
    	background-color: white;
    	padding: 1px 1px;

    }
     .showAll .imgProfile img{
    	width: 100%;
    	height: 100%;
    	border-radius: 100%;
    	border: 1px solid navy;
    }
     .showAll a{
    	width: 88%;
    	color: white;
    	padding: 0 15px;
    }
     .showAll .content{
    	width: 100%;
    	padding: 2px;
    	cursor: pointer;
    }

     .showAll .content .username,.lastmessage{
    	font-size: 12px;
    }
    .messageBoxPesornal{
    	width: 100%;
    	height: 83%;
    	hyphens: auto;
    	overflow-x:auto;
    	 /*hyphens: auto;
*/      overflow-wrap: break-word;
      word-wrap: break-word;
      
      /*border-radius: 10px;*/
      background-color: none;
     
    }
    .messageBoxPersonal .talk-bubble{
    	display: block;
    	position: relative;
    	width: 50%;
    	color: #000;
    	margin-left: 48%;
    	padding: 10px 0;
    }
    .messageBoxPersonal .talk-bubble .my_text{
    	background-color: lightgrey;
    	border-radius: 8px;
    }
    .messageBoxPersonal .talk-bubble .prof{
    	width: 100%;
    	cursor: pointer;
    }
    .messageBoxPersonal .talk-bubble .prof .img{
    	width: 20%;
    	border-radius: 100%;
    }
    .messageBoxPersonal .talk-bubble .prof .me{
    	padding: 10px 8px;
    	cursor: pointer;
    }
    .messageBoxPersonal .talk-bubble .prof .img img{
    	width: 80%;
    	border-radius: 100%;
    }
    .messageBoxPersonal .talk-bubbleb{
    	display: block;
    	position: relative;
    	width: 50%;
    	color: #000;
    	margin-left: 2%;
    	padding: 10px 0;
    }
    .messageBoxPersonal .talk-bubbleb .my_text{
    	background-color: lightsteelblue;
    	border-radius: 8px;
    }
    .messageBoxPersonal .talk-bubbleb .prof{
    	width: 100%;
    	cursor: pointer;
    }
    .messageBoxPersonal .talk-bubbleb .prof .img{
    	width: 20%;
    	border-radius: 100%;
    }
    .messageBoxPersonal .talk-bubbleb .prof .me{
    	padding: 10px 8px;
    	cursor: pointer;
    }
    .messageBoxPersonal .talk-bubbleb .prof .img img{
    	width: 80%;
    	border-radius: 100%;
    	
    }
    .submitBotPersonal{
    	width: 100%;
    	height: 6%;
    	background-color: none;

    }
    .submitBotPersonal #fa:hover{
    	color: navy;
    }
    .submitBotPersonal #fa{
    	font-size: 30px;
    }
    .submitBotPersonal .chat-centerPersonal{
    	width: 89%;
    	height: 100%;
    	background-color: none;


    }
    .submitBotPersonal .chat-centerPersonal .chatAreaPersonal{
    	width: 100%;
    	height: 30px;
    	border: none;
    	
    	border-bottom: 1px solid #f3f3;
    	max-height: 30px;
    	min-height: 30px;
    	min-width: 100%;
    	max-width: 100%;
    	background-color:transparent!important;
    	border: none;
    	border-bottom: 1px solid grey;

    }
    .submitBotPersonal .submitButtonPersonal{
    	width: 10%;
    	height: 100%;
    }
    .submitBotPersonal .submitButtonPersonal .chatSubmitPersonal{
    	width: 100%;
    	height: 30px;
    	background-color:blue;
    	border: none;
    }
    .submitBotPersonal .submitButtonPersonal .chatSubmitPersonal:hover{
  		background-color: navy;
    }
    .submitBotPersonal .submitButtonPersonal .chatSubmitPersonal #faa{
    	font-size: 25px;
    	color: #f3f3f3;
    }
</style>
		<?php
		$id=$cur_user_row['my_id'];
		if(isset($_GET['__'])){
			$other_user=$this->getOtherUser($_GET["__"]);
			$profileIMG=$other_user['profile_image'];
			$profileDir="";
			$my_id=$other_user['my_id'];
			$username=$other_user['username'];
			$name=$other_user['name']." ".$other_user['surname'];
			if($profileIMG=="empty"){
				$profileDir="../../default-img/fff.jpg";
				
			}
			else{
				$profileDir="../../posts/".$my_id."/".$profileIMG;
			}
			?>
			<div class="showAll">
				<div class="imgProfile">
					<img src="<?php echo $profileDir;?>">
				</div>
				<a >
					<div class="content">
						<div class="username">
							<?php echo $username."  ";?><span style="margin-left: 50px;"><i title="Video Call <?php echo $username." , ".$name;?>"  class="fa fa-video-camera" id="fa" aria-hidden="true"></i></span><span style="margin-left: 10px;"><i title="Voice Call <?php echo $username." , ".$name;?>"  class="fa fa-phone" id="fa" aria-hidden="true"></i></span>
						</div>
						<div class="lastmessage">
							<?php
							$_=mysqli_fetch_array($conn->query("select * from status_online_offline where my_id='$my_id'"));
							$status=$_['onlne_ofline'];
							if($status==0){
								echo "<span style='color:red;'>last seen : ";$this->time_Ago(strtotime($_["time_last"]));echo"</span>";
							}
							else{
								echo"<span style='color:green;'>online</span>";
							}
							?>
						</div>
					</div>
				</a>
			</div>
			<div class="messageBoxPesornal"></div>
			<div class="submitBotPersonal flex">
				<input type="hidden" id="b" value="<?php echo $other_user['my_id'];?>">
				<div class="imgOptionPersonal" data-toggle="modal" data-target="#fileUpload"><i title="Add Image On your Text.. "  class="fa fa-picture-o" id="fa" aria-hidden="true"></i></div>
				<div class="chat-centerPersonal"><textarea title="Type your message here..." class="chatAreaPersonal" placeholder="Type Your Message..."></textarea></div>
				<div class="submitButtonPersonal"><button class="chatSubmitPersonal" title="send your message.."><i class="fa fa-send-o" id="faa" aria-hidden="true"></i></button></div>
			</div>
			<script type="text/javascript">
				const otherUser="<?php echo $other_user['my_id']; ;?>"
				autoLoadPrivateMessages(otherUser);
			</script>
			<?php
		}
		else{
			$_=$conn->query("select*from create_runaccount where my_id!='$id' ");
			while($row=mysqli_fetch_array($_)){
				$username=$row['username'];
				$name=$row['name']." ".$row['surname'];
				$profileIMG=$row['profile_image'];
				$profileDir="";
				$my_id=$row['my_id'];
				if($profileIMG=="empty"){
					$profileDir="../../default-img/fff.jpg";
					
				}
				else{
					$profileDir="../../posts/".$my_id."/".$profileIMG;
				}

				?>

				<div class="showAll">
					<div class="imgProfile" style="width:40px;height: 40px;">
						<img style="width: 100%;height:100%;" src="<?php echo $profileDir;?>">
					</div>
					<a href="./?_=messages&__=<?php echo $my_id;?>">
						<div class="content">
							<div class="username">
								<?php echo $username." , ".$name;?>
							</div>
							<div class="lastmessage">
								vhgvh
								<?php
								$other_user_id=$my_id;
								$seen=0;
								$_11=$conn->query("select me , otheruser AND seen from messages where me='$other_user_id' AND otheruser='$id' AND seen ='$seen'");
								$num_mess=$_11->num_rows;
								if($num_mess>0){
									?>
									<small style="color: #f3f3f3;background-color: green;border-radius: 100%;width:10px;height: 10px;"><?php echo $num_mess;?></small>
									<?php
								}
								?>
							</div>
						</div>
					</a>
				</div>

				<?php
			}
		}
	}
	public function displayMessages($cur_user_row){
		global $conn;
		
		$_=$conn->query("select*from live_chat ORDER BY time_sent");
		while($row=mysqli_fetch_array($_)){
			$mp4=$row['video'];
			$img=$row['img'];
			$chat=$row['chat'];
			if($row["my_id"]==$cur_user_row['my_id']){

				$img_prof=$cur_user_row['profile_image'];
				$profile_dir="";
				if($img_prof=="empty"){
					$profile_dir="../../default-img/fff.jpg";
				}
				else{
					$profile_dir="../../posts/".$row["my_id"]."/".$img_prof;
				}
				if($mp4==0 && $img==0){
					?>
					<div class="talk-bubble">
						<div class="prof flex">
							<div class="img" style="width:35px;height: 35px;border:1px solid white;padding:2px 2px;background-color:navy;"><img style="width:100%;height:100%;border:1px solid white;" title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($cur_user_row["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<?php
							echo $chat;
							?>
							<div class="seen">
								<small style="font-size: 8px; margin-left:70%;color: seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
						
										
					</div>
					<?php
				}
				elseif($mp4!=0){
					$fileDir="../../default-img/live_chat/".$cur_user_row['my_id']."/";
					$dir=$fileDir.$mp4;
					?>
					<div class="talk-bubble">
						<div class="prof flex">
							<div class="img" style="width:35px;height: 35px;border:1px solid white;padding:2px 2px;background-color:navy;"><img style="width:100%;height:100%;border:1px solid white;" title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($cur_user_row["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<div class="fileDisplay" style="width:100%;">
								<video controls style="width: 100%;">
							    	<source src="<?php echo $dir;?>" type="video/mp4">
							    	<source src="<?php echo $dir;?>" type="video/mp4">
							    </video>
							</div>
							<?php
							echo $chat;
							?>
							<div class="seen">
								<small style="font-size: 8px; margin-left:70%;color: seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
										
					</div>
					<?php
				}
				else{
					$fileDir="../../default-img/live_chat/".$cur_user_row['my_id']."/";
					$dir=$fileDir.$img;
					?>
					<div class="talk-bubble">
						<div class="prof flex">
							<div class="img" style="width:35px;height: 35px;border:1px solid white;padding:2px 2px;background-color:navy;"><img style="width:100%;height:100%;border:1px solid white;" title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($cur_user_row["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<div class="fileDisplay" style="width: 100%;">
								<img style="width: 100%;" src="<?php echo $dir;?>">
							</div>
							<?php
							echo $chat;
							?>
							<div class="seen">
								<small style="font-size: 8px; margin-left:70%;color: seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
										
					</div>
					<?php
				}
			}
			else{
				// echo $row["my_id"];
				$other_user=$this->getOtherUser($row["my_id"]);
				// print_r($other_user);
				$img_prof=$other_user['profile_image'];
				$profile_dir="";
				if($img_prof=="empty"){
					$profile_dir="../../default-img/fff.jpg";
				}
				else{
					$profile_dir="../../posts/".$row["my_id"]."/".$img_prof;
				}
				if($mp4==0 && $img==0){
					?>
					<div class="talk-bubbleb">
						<div class="prof flex">
							<div class="img" style="width:35px;height: 35px;border:1px solid white;padding:2px 2px;background-color:navy;"><img style="width:100%;height:100%;border:1px solid white;" title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($other_user["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<?php
							echo $chat;
							?>
							<div class="seen">
								<small style="font-size: 8px; color:seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
										
					</div>
					<?php
				}
				elseif($mp4!=0){
					$fileDir="../../default-img/live_chat/".$row["my_id"]."/";
					$dir=$fileDir.$mp4;
					?>
					<div class="talk-bubbleb">
						<div class="prof flex">
							<div class="img" style="width:35px;height: 35px;border:1px solid white;padding:2px 2px;background-color:navy;"><img style="width:100%;height:100%;border:1px solid white;" title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($other_user["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<div class="fileDisplay" style="width: 100%;">
								<video controls style="width: 100%;">
							    	<source src="<?php echo $dir;?>" type="video/mp4">
							    	<source src="<?php echo $dir;?>" type="video/mp4">
							    </video>
							</div>
							<?php
							echo $chat;
							?>
							<div class="seen">
								<small style="font-size: 8px; color:seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
										
					</div>
					<?php
				}
				else{
					$fileDir="../../default-img/live_chat/".$row["my_id"]."/";
					$dir=$fileDir.$img;
					?>
					<div class="talk-bubbleb">
						<div class="prof flex">
							<div class="img" style="width:35px;height: 35px;border:1px solid white;padding:2px 2px;background-color:navy;"><img style="width:100%;height:100%;border:1px solid white;" title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($other_user["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<div class="fileDisplay" style="width: 100%;">
								<img style="width: 100%;" src="<?php echo $dir;?>">
							</div>
							<?php
							echo $chat;
							?>
							<div class="seen">
								<small style="font-size: 8px; color:seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
										
					</div>
					<?php
				}
			}

		}
	}
	private function reduce($var,$size){
	  if(strlen($var)>$size){
	      $count=0;
	      foreach (str_split($var) as $char){
	          echo"$char";
	          $count++;
	          if($count==$size){
	              echo"...";
	              break;
	          }
	      }
	  }
	  else{
	      echo $var;
	  }
	}
	public function getThisUserInfo($id){
		global $conn;
		return mysqli_fetch_array($conn->query("select*from create_runaccount where usermail='$id'"));
	}
	private function threeBorderUnderline(){
		?>
		<style >
			.rough-path-underline-navy{
				background-color: white;
				width: 100%;
				border: 2px solid navy;
				
			}
			.rough-path-underline-white{
				background-color: navy;
				width: 100%;
				border: 2px solid white;
				
			}

		</style>
		<div class="rough-path-underline-navy"></div>
		<div class="rough-path-underline-white"></div>
		<div class="rough-path-underline-navy"></div>
		<?php
	}
	public function fireApp(){
		global $conn;
		$id=$_SESSION['usermail'];
		$cur_user_row=mysqli_fetch_array($conn->query("select*from create_runaccount where usermail='$id'"));
		$this->header($cur_user_row);

		?>
		<style>
			.full-page{
				width: 100%;
				height: 100%;
				display: flex;
				margin-top: .5%;
			}
			.full-page .leftBar{
				width: 15%;
				height: 100%;
				box-shadow: 0px 6px 5px 8px #000;
				
				/*border: 1px solid #f3f3f3;*/
				margin-left: 2%;
				overflow-x:auto;
				overflow-wrap: break-word;
			    word-wrap: break-word;
			    hyphens: auto;

			}
			.full-page .leftBar::-webkit-scrollbar{
			    width:0;
			}
			.full-page .center{
				width: 20%;
				height: 100%;
				box-shadow: 0px 6px 5px 8px #000;
				
				/*border: 1px solid #f3f3f3;*/
				margin-left: 2%;
			}
			.full-page .center .img-switcher-display-border1{
				width: 100%;
				background-color: navy;
				border-radius:100%;
				height: 45.5%;
				align-content: center;
				text-align: center;
				align-items: center;
				align-self: center;
				padding: 4px 4px;

			}
			.full-page .center .img-switcher-display-border1 .img-switcher-display-border-2{
				width: 100%;
				background-color: white;
				border-radius:100%;
				height: 100%;
				align-content: center;
				text-align: center;
				align-items: center;
				align-self: center;
				padding: 4px 4px;

			}
			.full-page .center .img-switcher-display-border1 .img-switcher-display-border-2 .img-switcher-display{
				width: 100%;
				height: 100%;
				border-radius:100%;
			}
			.full-page .center .img-switcher-display-border1 .img-switcher-display-border-2 .img-switcher-display img{
				width: 100%;
				height: 100%;
				border-radius:100%;
				border: 4px solid navy;
				cursor: pointer;
			}
			.full-page .center .img-switcher-display-border1 .img-switcher-display-border-2 .img-switcher-display img:hover{

				opacity: .5;
			}
			.full-page .right-{
				width: 40%;
				height: 100%;
				box-shadow: 0px 6px 5px 8px #000;
				
				/*border: 1px solid #f3f3f3;*/
				margin-left: 2%;
				color: white;
				overflow-x:auto;
				overflow-wrap: break-word;
			    word-wrap: break-word;
			    hyphens: auto;
			    
			}
			.full-page .right-::-webkit-scrollbar{
			    width:0;
			}
			@media only screen and (max-width: 900px){
				.full-page .leftBar{
					display: none;
				}
				.full-page .center{
					display: none;
				}
				.full-page .right-{
					width: 100%;
					margin-left: 0;
				}
			} 
		</style>

		<div class="full-page">
			<div class="leftBar">
				<center>
				<?php $this->sideBar($cur_user_row);?>
				</center>
			</div>
			<div class="center">
				
					<div class="img-switcher-display-border1">
						<div class="img-switcher-display-border-2">
							<div class="img-switcher-display">
								<?php
									$dir="../../";
									$profile=$cur_user_row['profile_image'];
									if($profile=="empty"){
										$dir.="default-img/fff.jpg";
									}
									else{
										$dir.="posts/".$cur_user_row['my_id']."/".$profile;
									}
								?>
								<img src="<?php echo $dir;?>" data-toggle="modal" data-target="#img_gost0" title="click to update profile image" ></div>
						</div>
						
					</div>
					<div class="info-tag-net-run" style="padding: 3px 3px;">
						
						
						<?php
							$this->threeBorderUnderline();
						?>
						<div class="med" style="padding:3px 3px;">
				            <center><h2 style='color: white;font-size:13px;'> My Profile</h2></center>
				 		 	<h4 style='color: white;font-size:19px;' id='raw'>
				 		 	<p><div style='color: white;font-size:19px;'><?php $this->reduce($cur_user_row['name']." ".$cur_user_row['surname'],25);?></div></p>
				 		 	<p><div style='color: white;font-size:13px;'> gender : <?php echo $cur_user_row['gender'].", Joined: ".$cur_user_row['date_of_birth'];?></div></p>
				 		 	<p><div style='color: white;font-size:13px;'> province : <?php echo $cur_user_row['province'].", ".$cur_user_row['city'];?></<div></p>
				 		 	
				 		 	<div class="rough-path-underline-navy"></div>
						<div class="rough-path-underline-white"></div>
						<div class="rough-path-underline-navy"></div>
				 		 	 <p><div style='color: white;font-size:13px;'><center><h5>About Me <span style="font-size:10px;color:red;">(click text to edit)</span></h5></center></<div></p>
				 		 	 <p><div > <h6 style='color: white;font-size:12.5px;cursor:pointer;' title="click me to edit ABOUT ME" class="about" data-toggle="modal" data-target="#editText">
				 		 	   <?php
				 		 	   if(empty($cur_user_row['about'])){
				 		 	       $ra="Use it to describe your credentials, expertise ygyugyugu yuguygugygu, and goals. What’s the best way to start? The following exercises can be helpful in figuring all of that out, and will help you determine what to one for gdastgbj jbjhb and will help you determine what to one for gdastgbj jbjhb and will help you determine what to one for gdastgbj jbjhb ugigiug giugiui ihiuhiiu iuhiu";
				 		 	   }
				 		 	   else{
				 		 	       $ra=$cur_user_row['about'];
				 		 	   }
				 		 	   $this->reduce($ra,250);
				 		 	   ?>  
				 		 	   </h6></<div></p>
				 		 	    
				 		 	</h4>
				    	</div>
					</div>

				</div>
			<div class="right-">
				<?php
				if(isset($_GET['_']) &!empty($_GET['_'])){
					if($_GET['_']=="exit"){
						$this->logout($cur_user_row['usermail']);
					}
					elseif($_GET['_']=="apply"){
						$this->appy($cur_user_row);
					}
					elseif($_GET['_']=="studyarea"){
						$this->studyarea($cur_user_row);
					}
					elseif($_GET['_']=="pastpapers"){
						$this->pastpapers($cur_user_row);
					}
					elseif(strtolower($_GET['_'])=="subj"){
                        $this->subjectDisplay($cur_user_row);
                    }
					elseif($_GET['_']=="Math-Phy"){
						$this->mathPhy($cur_user_row);
					}
					elseif($_GET['_']=="notification"){
						$this->notification($cur_user_row);
					}
					elseif($_GET['_']=="my-account"){
						$this->myAccount($cur_user_row);
					}
					elseif($_GET['_']=="my-post"){
						$this->myPost($cur_user_row);
					}
					elseif($_GET['_']=="messages"){
						$this->messages($cur_user_row);
					}
					elseif($_GET['_']=="live public chats"){
						$this->livePublicChats($cur_user_row);
					}
					elseif($_GET['_']=="latestNews"){
						$this->latestNews($cur_user_row);
					}
					elseif($_GET['_']=="SportsNews"){
						$this->SportsNews($cur_user_row);
					}
					// elseif($_GET['_']=="shisanyama"){
					// 	$this->shisanyama($cur_user_row);
					// }
					elseif($_GET['_']=="music"){
						$this->music($cur_user_row);
					}
					elseif($_GET['_']=="matricUpgrade"){
						$this->matricUpgrade($cur_user_row);
					}
					elseif($_GET['_']=='profile' && isset($_GET['_1_'])){
						$this->view_profile($_GET['_1_']);
					}
					elseif(strtolower($_GET['_'])=="edusgela"){
                            $this->eduSgela($id);
                    }
					else{
						$this->home($cur_user_row);
					}
				}
				else{
					$this->home($cur_user_row);
				}
				?>
			</div>
		</div>
		<script>
			function editAboutMe(id){
		        const about=$("#about").val();
		        // const errorAbout=$(".errorAbout");
		        if(about==""){
		            $(".errorAbout").removeAttr("hidden");
		            $(".errorAbout").attr("style","background-color:#000;color:red;width:100%;padding:10px;");
		            $(".errorAbout").html("** Cannot Process Empty Data**");
		        }
		        else{
		            $(".errorAbout").removeAttr("hidden");
					$(".errorAbout").attr("style","background-color:#000;color:green;padding:5px;opacity:.8;");
					$(".errorAbout").html("Processing...");
					$.ajax({
						url:"controler/upload.php",
						type:"POST",
						data:{id:id,about:about},
						cache:false,
						beforeSend:function(){
							$(".errorAbout").removeAttr("hidden");
							$(".errorAbout").html("<img style='width:10%;' src='img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
						},
						success:function(e){
							console.log(e.length);
							if(e.length>2){
								$(".errorAbout").removeAttr("hidden");
								$(".errorAbout").attr("style","background-color:#000;color:red;padding:5px;opacity:.8;");
								$(".errorAbout").html("Suspense 320 : "+e);
								
								$(".about").html(about);
							}
							else{
								$(".errorAbout").removeAttr("hidden");
								$(".errorAbout").html("<small style='color:green;'>About content Added Successfuly..</small>");
								$("#about").val("");
							}
						}
					});
		        }
		    }
		</script>
		<?php
	}
	protected function abc($id){
	    global $conn;
	    ?>
	    <style>
			.headerSgela{
				width: 100%;
				margin-top: .5%;
				padding: 5px 0;
				

			}
			.headerSgela .macDropDown{
				width: 25%;
			}
			.headerSgela .macDropDown .regi{
				width: 80%;
				border: 1px solid green;
				cursor: pointer;
				border-radius: 10px;
				box-shadow: 0 6px 4px -8px black;
			}
			.headerSgela .macDropDown .regi:hover{
				background-color: green;
				border-radius: 10px;
				box-shadow: 0 8px 6px -6px black;
				border: 1px solid ghostwhite;
			}
			.headerSgela .dropdown .dropbtn{
				background-color: #000;
			}
			.headerSgela .dropdown .dropdown-content{
				width: 220px;
			}

		</style>
		<center>
		<div class="headerSgela flex">
			<div class="dropdown macDropDown" >
			  <button class="dropbtn regi">Subj</button>
			  <div class="dropdown-content">
			  	<a style='background-color: red; color: #f3f3f3;' data-toggle="modal" data-target="#install_school">Install School</a>
			  	<style>
			  	    .k2{
			  	        cursor:pointer;background-color: #ddd; color: #000;
			  	    }
			  	    .k2:hover{
			  	        background-color:navy;color:#f3f3f3;
			  	    }
			  	    .k1{
			  	        cursor:pointer;background-color: seagreen; color: #f3f3f3;
			  	    }
			  	    .k1:hover{
			  	        background-color:navy;color:#f3f3f3;
			  	    }
			  	</style>
			  	<?php 
			  	$std_inf=$this->getStudentInfo($id);
			  	$std_id=$std_inf['student_id'];
			  	$_=$conn->query("select*from student_subj_tracker where std_id='$std_id'");
			  	if($_->num_rows==0){
			  	    ?>
			  	    <a style='cursor:pointer;background-color: #ddd; color: #000;' >No Registered Subject Yet</a>
			  	    <?php
			  	}else{
			  	    $count=1;
			  	    while($row=mysqli_fetch_array($_)){
			  	        $subj_info=$this->getSubjInfo($row['subj_id']);
			  	        if($count%2==0){
			  	            ?>
    			  	        <a class="k2" href='./?_=subj&_-=<?php echo $row['subj_id'];?>'><?php echo $subj_info['subj_name'];?></a>
    			  	        <?php
			  	        }
			  	        else{
			  	            ?>
    			  	        <a class="k1" href='./?_=subj&_-=<?php echo $row['subj_id'];?>'><?php echo $subj_info['subj_name'];?></a>
    			  	        <?php
			  	        }
			  	        $count++;
			  	        
			  	    }
			  	}
			  	?>
			  </div>
			</div>
			<?php if(isset($_GET['_-'])){
			    ?>
			<div class="dropdown macDropDown" style="width:40%;" onclick="redirectPractice(<?php echo $_GET['_-'];?>)">
			  <button class="dropbtn regi" style="width:100%;">Practice exam questions</button>
			  
			</div>
			    <?php
			    }
			?>
			<script>
			    function redirectPractice(subj){
			        window.location=(".?_=eduSgela&practiceSubj="+subj);
			    }
			</script>
		</div>
		<?php
	}
	protected function isSubjectId($subj_id){
	    global $conn;
	    $_=$conn->query("select*from subjectssa where subj_id='$subj_id'");
	    return ($_->num_rows==1);
	}
	protected function headerPassMech($subj_id,$id){
		global $conn;
		?>
		<style>
			.headerSgela{
				width: 100%;
				margin-top: .5%;
				padding: 5px 0;
				

			}
			.headerSgela .macDropDown{
				width: 25%;
			}
			.headerSgela .macDropDown .regi{
				width: 80%;
				border: 1px solid green;
				cursor: pointer;
				border-radius: 10px;
				box-shadow: 0 6px 4px -8px black;
			}
			.headerSgela .macDropDown .regi:hover{
				background-color: green;
				border-radius: 10px;
				box-shadow: 0 8px 6px -6px black;
				border: 1px solid ghostwhite;
			}
			.headerSgela .dropdown .dropbtn{
				background-color: #000;
			}
			.headerSgela .dropdown .dropdown-content{
				width: 280px;
			}

		</style>
		<center>
		<div class="headerSgela flex">
			<div class="dropdown macDropDown" >
			  <button class="dropbtn regi">Subj</button>
			  <div class="dropdown-content">
			  	
			  	<style>
			  	    .k2{
			  	        cursor:pointer;background-color: navy; color: #f3f3f3;border-bottom:2px solid #000;
			  	        
			  	    }
			  	    .k2:hover{
			  	        background-color:powderblue;color:#f3f3f3;
			  	    }
			  	    .k1{
			  	        cursor:pointer;background-color: seagreen; color: #f3f3f3;border-bottom:2px solid #000;
			  	        
			  	    }
			  	    .k1:hover{
			  	        background-color:powderblue;color:#f3f3f3;
			  	    }
			  	</style>
			  	<?php 
			  	$std_inf=$this->getStudentInfo($id);
			  	$std_id=$std_inf['student_id'];
			  	$_=$conn->query("select*from student_subj_tracker where std_id='$std_id'");
			  	if($_->num_rows==0){
			  	    ?>
			  	    <a style='cursor:pointer;background-color: #ddd; color: #000;' >No Registered Subject Yet</a>
			  	    <?php
			  	}
			  	else{
			  	    $count=1;
			  	    while($row=mysqli_fetch_array($_)){
			  	        $subj_info=$this->getSubjInfo($row['subj_id']);
			  	        if($count%2==0){
			  	            ?>
    			  	        <a class="k2" style="<?php if($row['subj_id']==$subj_id){echo"background-color:red;";}?>" href='?_=subj&_-=<?php echo $row['subj_id'];?>'><?php echo $subj_info['subj_name'];?></a>
    			  	        <?php
			  	        }
			  	        else{
			  	            ?>
    			  	        <a class="k1" style="<?php if($row['subj_id']==$subj_id){echo"background-color:navy;";}?>" href='?_=subj&_-=<?php echo $row['subj_id'];?>'><?php echo $subj_info['subj_name'];?></a>
    			  	        <?php
			  	        }
			  	        $count++;
			  	        
			  	    }
			  	}
			  	?>
			  </div>
			</div>
			<div class="dropdown macDropDown" >
			  
			  <button class="dropbtn regi">Assignments</button>
			  <div class="dropdown-content">
			  	
			  	<style>
			  	    .k2{
			  	        cursor:pointer;background-color: red; color: #f3f3f3;
			  	        
			  	    }
			  	    .k2:hover{
			  	        background-color:#f70d1a;color:#f3f3f3;
			  	    }
			  	    .k1{
			  	        cursor:pointer;background-color: orangered; color: #f3f3f3;
			  	        
			  	    }
			  	    .k1:hover{
			  	        background-color:#f70d1a;color:#f3f3f3;
			  	    }
			  	</style>
			  	<?php 
			 // 	$std_inf=$this->getStudentInfo($id);
			 // 	$std_id=$std_inf['student_id'];
			   $_=$conn->query("select*from assignment where subj_id='$subj_id' AND publish='1'");
			   $num=$_->num_rows;
			  	if($num==0){
			  	    ?>
			  	    <a style='cursor:pointer;background-color: #ddd; color: #000;' >No Available Assignment Yet</a>
			  	    <?php
			  	}else{
			  	    $count=1;
			  	    $std_inf=$this->getStudentInfo($id);
    			  	$std_id=$std_inf['student_id'];
    			  	
			  	    while($row=mysqli_fetch_array($_)){
			  	        $ass_info=$this->AssignmentInfo($row['ass_id']);
			  	        
			  	        if($this->isSubbmitted($row['ass_id'],$std_id)){
			  	            $ass_id=$row['ass_id'];
			  	            $submission_info=mysqli_fetch_array($conn->query("select*from assignment_submission where ass_id='$ass_id' and std_id='$std_id'"));
			  	            ?>
			  	            <a class="k2" style="background-color:navy;" ><?php echo $ass_info['name']." Submitted on : ".$submission_info['date_submitted']."|".$submission_info['time_submitted'];?></a>
			  	            <?php
			  	        }
			  	        else{
			  	            if($count%2==0){
    			  	            ?>
        			  	        <a class="k2"  href='?_=assignment&a_id=<?php echo $row['ass_id'];?>'><?php echo $ass_info['name']." Due : ".$ass_info['due_date']."|".$ass_info['due_time'];?></a>
        			  	        <?php
    			  	        }
    			  	        else{
    			  	            ?>
        			  	        <a class="k1"  href='?_=assignment&a_id=<?php echo $row['ass_id'];?>'><?php echo $ass_info['name']." Due : ".$ass_info['due_date']."|".$ass_info['due_time'];?></a>
        			  	        <?php
    			  	        }
    			  	        $count++;
			  	        }
    			  	        
			  	        
			  	    }
			  	}
			  	?>
			  </div>
			</div>
			<div class="dropdown macDropDown" >
			  <button class="dropbtn regi">Exam/Tests</button>
			  <div class="dropdown-content" style="margin-left:-90%;">
			  	
			  	<style>
			  	    .k2{
			  	        cursor:pointer;background-color: #ddd; color: #000;
			  	        
			  	    }
			  	    .k2:hover{
			  	        background-color:navy;color:#f3f3f3;
			  	    }
			  	    .k1{
			  	        cursor:pointer;background-color: seagreen; color: #f3f3f3;
			  	        
			  	    }
			  	    .k1:hover{
			  	        background-color:navy;color:#f3f3f3;
			  	    }
			  	</style>
			  	<?php 
			  	$_=$conn->query("select*from exams where subj_id='$subj_id' AND is_live='1'");
			   $num=$_->num_rows;
			  	if($num==0){
			  	    ?>
			  	    <a style='cursor:pointer;background-color: #ddd; color: #000;' >No Available Exam/Test Yet</a>
			  	    <?php
			  	}else{
			  	    $count=1;
			  	    $std_inf=$this->getStudentInfo($id);
    			  	$std_id=$std_inf['student_id'];
    			  	
			  	    while($row=mysqli_fetch_array($_)){
			  	        $exam_id=$row['id'];
			  	        $exam_info=$this->examInfo($exam_id);
			  	         
			  	        if($this->isSubbmittedExam($exam_id,$std_id)){
			  	           
			  	            $submitted_Exam_info=mysqli_fetch_array($_=$conn->query("select*from answers_exam_tracker where student_id='$std_id' and exam_id='$exam_id'"));
			  	            ?>
			  	            <a class="k2" style="background-color:navy; color:#f3f3f3;" ><?php echo $exam_info['exam_name']." Submitted on : ".$submitted_Exam_info['date_submitted']."|".$submitted_Exam_info['time_submitted'];?></a>
			  	            <?php
			  	        }
			  	        else{
			  	            if($count%2==0){
    			  	            ?>
        			  	        <a class="k2"  href='?_=exam&e_id=<?php echo $exam_id;?>'>gh<?php echo $exam_info['exam_name']." Due : ".$exam_info['total_questions']."|".$exam_info['total_marks'].", TT:".$exam_info['total_time']."min's";?></a>
        			  	        <?php
    			  	        }
    			  	        else{
    			  	            ?>
        			  	        <a class="k1"  href='?_=exam&e_id=<?php echo $exam_id;?>'>pp<?php echo $exam_info['exam_name']." TQ:".$exam_info['total_questions'].", TM:".$exam_info['total_marks'].", TT:".$exam_info['total_time']."min's";?></a>
        			  	        <?php
    			  	        }
    			  	        $count++;
			  	        }
    			  	        
			  	        
			  	    }
			  	}
			  	?>
			  </div>
			</div>
			<div class="dropdown macDropDown" >
			  <button class="dropbtn regi">Results</button>
			  <div style="margin-left:-190%;" class="dropdown-content">
			  	
			  	<style>
			  	    .k2{
			  	        cursor:pointer;background-color: #ddd; color: #000;
			  	        
			  	    }
			  	    .k2:hover{
			  	        background-color:navy;color:#f3f3f3;
			  	    }
			  	    .k1{
			  	        cursor:pointer;background-color: seagreen; color: #f3f3f3;
			  	        
			  	    }
			  	    .k1:hover{
			  	        background-color:navy;color:#f3f3f3;
			  	    }
			  	</style>
			  	<?php 
			  	$std_inf=$this->getStudentInfo($id);
			  	$std_id=$std_inf['student_id'];
			  	$_=$conn->query("select*from student_subj_tracker where std_id='$std_id'");
			  	if($_->num_rows==0){
			  	    ?>
			  	    <a style='cursor:pointer;background-color: #ddd; color: #000;' >No Registered Subject Yet</a>
			  	    <?php
			  	}else{
			  	    $count=1;
			  	    while($row=mysqli_fetch_array($_)){
			  	        $subj_info=$this->getSubjInfo($row['subj_id']);
			  	        if($count%2==0){
			  	            ?>
    			  	        <a class="k2" style="<?php if($row['subj_id']==$subj_id){echo"background-color:navy; color:#f3f3f3;";}?>" href='?_=subj&subj=<?php echo $row['subj_id'];?>'><?php echo $subj_info['subj_name'];?></a>
    			  	        <?php
			  	        }
			  	        else{
			  	            ?>
    			  	        <a class="k1" style="<?php if($row['subj_id']==$subj_id){echo"background-color:navy;";}?>" href='?_=subj&subj=<?php echo $row['subj_id'];?>'><?php echo $subj_info['subj_name'];?></a>
    			  	        <?php
			  	        }
			  	        $count++;
			  	        
			  	    }
			  	}
			  	?>
			  </div>
			</div>
		</div>
		</center>
		<?php
		
	}
	protected function music($cur_user_row){

	    global $conn;
	    $id=$cur_user_row['my_id'];
	 ?>
	<section class="welcome-area"  >
      <!-- Welcome Slides -->
      <div class="welcome-slides owl-carousel" >

        <!-- Single Welcome Slide Active(duplicate when necessary!!) -->
        <div class="welcome-welcome-slide bg-img bg-overlay" style="background-image: url(../../default-img/1.jpg);width:100%;height:80vh;">
          <div class="container h-100">
            <div class="row h-100 align-items-center">
              <div class="col-12">
                <!-- Welcome Text 1 -->
                <div class="welcome-text">
                  	<div class="headerSgela flex" >
                    	<div class="dropdown macDropDown" style="width:100%;">
                    	  <h4><i class="fa fa-bars" aria-hidden="true" style="color:white;font-size:20px;"></i></h4>
                    	  <div class="dropdown-content" style="width:100%;">
                    	      <style>
                    	          .rowler{
                    	              border:2px solid #f3f3f3;
                    	              color:#f3f3f3;
                    	       
                    	          }
                    	          .rowler:hover{
                    	              color:#000;
                    	              border:2px solid #000;
                    	          }
                    	      </style>
                    	       <a class="rowler" href="./?_=music">Most Downloaded</a>
                    	       <a class="rowler" href="./?_=music&latest_release">Recent Release</a>
                    	      <?php
                    	      $_aa=$conn->query("select*from type_music");
                    	      while($row=mysqli_fetch_array($_aa)){
                    	          ?>
                    	          <a class="rowler" href="./?_=music&music=<?php echo $row['id']; if(isset($_GET['music']) && $_GET['music']==$row['id']){ echo'style="border:1px solid red;color:red;"';}?>" ><?php echo $row['type_music_name'];?></a>
                    	          <?php
                    	      }
                    	      ?>
                    	      
                    	     
                    	  </div>
                	  	</div>
                	</div>
                	<br>
                  <div class="welcome-btn-groupt" style="">
                      <style>
                          .flex-wrap{
                              background-color:#282828;
                              border:1px solid #f3f3f3;
                              box-shadow: 0px 6px -8px 7px #212121;
                              
                          }
                      </style>
                      <?php
                      if(isset($_GET['music'])){
                          $type_of_music=$_GET['music'];
                          $_display=$conn->query("select*from track where type_music='$type_of_music' order by time_uploaded DESC");
                          if($_display->num_rows==0){
                              ?>
                              <h5 style="color:red;">No Music Loaded</h5>
                              <?php
                          }
                          else{
                              
                          
                              while($row=mysqli_fetch_array($_display)){
                                  $recording_label=$this->getRecordingLabel($row['recording_label']);
                                  $album="";
                                 $album_info="";
                                  if($row['album']<1){
                                      $album="Single Release";
                                  }
                                  else{
                                      $album_info=$this->getAlbuminfo($row['album']);
                                      $album=$album_info['album_name'];
                                  }
                                  $artist_info=$this->getArtistInfo($row['artist']);
                                  $publish_date=$row['time_uploaded'];
                                  $song_name=$row['track_name'];
                                  $artist=$artist_info['artist_stage_name'];
                                  $label=$recording_label['recording_label'];
                                  $dir_img="../../music/logo/".$row['track_logo'];
                                  $dir_mp3="../../music/track/".$row['track_mp3'];
                                  $track_id=$row['id'];
                                  ?>
                                  <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms" style="margin-top: -3%;">
                                  <div class="poca-music-thumbnail" style="width:100%;">
                                    <img src="<?php echo $dir_img;?>" alt="" style="width:100%;">
                                  </div>
                                  <div class="poca-music-content" style="width:100%;">
                                    <span class="music-published-date"><?php echo $publish_date;?> <small style="font-size:7px;padding:2px;border-radius:50px;background-color:crimson;color:#f3f3f3;border:1px solid #f3f3f3;">new</small></span>
                                    <h2><?php echo $song_name;?></h2>
                                    <div class="music-meta-data">
                                      <p>By <a href="#" class="music-author"><?php if(strlen($artist)<10){ echo $artist;}else{ for($i=0;$i<10;$i++){echo $artist[$i];}echo".."; }?></a> | <a href="#" class="music-catagory"><?php echo $label; ?></a> | <a href="#" class="music-duration"><?php echo $album;?></a></p>
                                    </div>
                                    <!-- Music Player -->
                                    <div class="poca-music-player" style="width:100%;color:#f3f3f3;background-color:#282828;">
                                      <audio preload="auto" controls controlsList="nodownload" style="width:100%; color:#f3f3f3;background-color:#282828;">
                                        <source src="<?php echo $dir_mp3;?>" style="width:100%;">
                                      </audio>
                                    </div>
                                    <!-- Likes, Share & Download -->
                                    <div class="likes-share-download d-flex align-items-center justify-content-between">
                                      <a onclick="likeSong(<?php echo $track_id;?>)" class="<?php echo $track_id;?>"><i class="fa fa-heart" aria-hidden="true"></i>(<?php
                                      
                                      $_=$conn->query("select id from song_likes where track='$track_id'");
                                      echo $_->num_rows;
                                    ?>)</a>
                                      <div>
                                        <a  class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
                                        <a onclick="download_song(<?php echo $track_id;?>)" id="<?php echo $track_id;?>" href="<?php echo $dir_mp3;?>" download><i class="fa fa-download" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <br>
                              <?php
                              }
                          }
                      }
                      elseif(isset($_GET['latest_release'])){
                          $_display=$conn->query("select*from track order by time_uploaded DESC");
                          if($_display->num_rows==0){
                              ?>
                              <h5 style="color:red;">No Music Loaded</h5>
                              <?php
                          }
                          else{
                              
                          
                              while($row=mysqli_fetch_array($_display)){
                                  $recording_label=$this->getRecordingLabel($row['recording_label']);
                                  $album="";
                                 $album_info="";
                                  if($row['album']<1){
                                      $album="Single Release";
                                  }
                                  else{
                                      $album_info=$this->getAlbuminfo($row['album']);
                                      $album=$album_info['album_name'];
                                  }
                                  $artist_info=$this->getArtistInfo($row['artist']);
                                  $publish_date=$row['time_uploaded'];
                                  $song_name=$row['track_name'];
                                  $artist=$artist_info['artist_stage_name'];
                                  $label=$recording_label['recording_label'];
                                  $dir_img="../../music/logo/".$row['track_logo'];
                                  $dir_mp3="../../music/track/".$row['track_mp3'];
                                  $track_id=$row['id'];
                                  ?>
                                  <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms" style="margin-top: -3%;">
                                  <div class="poca-music-thumbnail" style="width:100%;">
                                    <img src="<?php echo $dir_img;?>" alt="" style="width:100%;">
                                  </div>
                                  <div class="poca-music-content" style="width:100%;">
                                    <span class="music-published-date"><?php echo $publish_date;?><small style="font-size:7px;padding:2px;border-radius:50px;background-color:crimson;color:#f3f3f3;border:1px solid #f3f3f3;">new</small></span>
                                    <h2><?php echo $song_name;?></h2>
                                    <div class="music-meta-data">
                                      <p>By <a href="#" class="music-author"><?php if(strlen($artist)<10){ echo $artist;}else{ for($i=0;$i<10;$i++){echo $artist[$i];}echo".."; }?></a> | <a href="#" class="music-catagory"><?php echo $label; ?></a> | <a href="#" class="music-duration"><?php echo $album;?></a></p>
                                    </div>
                                    <!-- Music Player -->
                                    <div class="poca-music-player" style="width:100%;color:#f3f3f3;background-color:#282828;">
                                      <audio preload="auto" controls controlsList="nodownload" style="width:100%; color:#f3f3f3;background-color:#282828;">
                                        <source src="<?php echo $dir_mp3;?>" style="width:100%;">
                                      </audio>
                                    </div>
                                    <!-- Likes, Share & Download -->
                                    <div class="likes-share-download d-flex align-items-center justify-content-between">
                                      <a onclick="likeSong(<?php echo $track_id;?>)" class="<?php echo $track_id;?>"><i class="fa fa-heart" aria-hidden="true"></i>(<?php
                                      
                                      $_=$conn->query("select id from song_likes where track='$track_id'");
                                      echo $_->num_rows;
                                    ?>)</a>
                                      <div>
                                        <a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
                                        <a onclick="download_song(<?php echo $track_id;?>)" id="<?php echo $track_id;?>" href="<?php echo $dir_mp3;?>" download><i class="fa fa-download" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <br>
                              <?php
                              }
                          }
                      }
                      else{
                          $_display=$conn->query("select*from track order by downloads DESC");
                          while($row=mysqli_fetch_array($_display)){
                              $recording_label=$this->getRecordingLabel($row['recording_label']);
                              $album="";
                             $album_info="";
                              if($row['album']<1){
                                  $album="Single Release";
                              }
                              else{
                                  $album_info=$this->getAlbuminfo($row['album']);
                                  $album=$album_info['album_name'];
                              }
                              $artist_info=$this->getArtistInfo($row['artist']);
                              $publish_date=$row['time_uploaded'];
                              $song_name=$row['track_name'];
                              $artist=$artist_info['artist_stage_name'];
                              $label=$recording_label['recording_label'];
                              $dir_img="../../music/logo/".$row['track_logo'];
                              $dir_mp3="../../music/track/".$row['track_mp3'];
                              $track_id=$row['id'];
                              ?>
                              <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms" style="margin-top: -3%;">
                              <div class="poca-music-thumbnail" style="width:100%;">
                                <img src="<?php echo $dir_img;?>" alt="" style="width:100%;">
                              </div>
                              <div class="poca-music-content" style="width:100%;">
                                <span class="music-published-date"><?php echo $publish_date;?><small style="font-size:7px;padding:2px;border-radius:50px;background-color:crimson;color:#f3f3f3;border:1px solid #f3f3f3;">new</small></span>
                                <h2><?php echo $song_name;?></h2>
                                <div class="music-meta-data">
                                  <p>By <a href="#" class="music-author"><?php if(strlen($artist)<10){ echo $artist;}else{ for($i=0;$i<10;$i++){echo $artist[$i];}echo".."; }?></a> | <a href="#" class="music-catagory"><?php echo $label; ?></a> | <a href="#" class="music-duration"><?php echo $album;?></a></p>
                                </div>
                                <!-- Music Player -->
                                <div class="poca-music-player" style="width:100%;color:#f3f3f3;background-color:#282828;">
                                  <audio preload="auto" controls controlsList="nodownload" style="width:100%; color:#f3f3f3;background-color:#282828;">
                                    <source src="<?php echo $dir_mp3;?>" style="width:100%;">
                                  </audio>
                                </div>
                                <!-- Likes, Share & Download -->
                                <div class="likes-share-download d-flex align-items-center justify-content-between">
                                  <a onclick="likeSong(<?php echo $track_id;?>)" class="<?php echo $track_id;?>"><i class="fa fa-heart" aria-hidden="true"></i>(<?php
                                  
                                  $_=$conn->query("select id from song_likes where track='$track_id'");
                                  echo $_->num_rows;
                                ?>)</a>
                                  <div>
                                    <a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
                                    <a onclick="download_song(<?php echo $track_id;?>)" id="<?php echo $track_id;?>" href="<?php echo $dir_mp3;?>" download><i class="fa fa-download" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br>
                          <?php
                              
                          }
                      }
                      ?>
                    
                    
                  </div>
                    
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
          function likeSong(track_id){
           $.ajax({
        		url:'controler/upload.php',
        		type:'post',
        		data:{track_id:track_id},
        		success:function(e){
        			$("."+track_id).html('<i class="fa fa-heart" aria-hidden="true"></i>('+e+")");
        		}
        	});
          }
          function download_song(track_download){
             $.ajax({
        		url:'controler/upload.php',
        		type:'post',
        		data:{track_download:track_download},
        		success:function(e){
        			$("#"+track_download).html('<i class="fa fa-download" aria-hidden="true"></i>('+e+")");
        		}
        	}); 
          }
      </script>
    </section>
	    
	    <?php
	}
	protected function subjectDisplay($cur_user_row){
        global $conn;
        $id=$cur_user_row['my_id'];
        if(isset($_GET['_-'])&&!empty($_GET['_-'])){
            if($this->isSubjectId($_GET['_-'])){
                $this->headerPassMech($_GET['_-'],$id);
                
                ?>
                <style>
                    .jodan{
                        width:100%;
                        padding:5px 0;
                        
                    }
                    .jodan .fitter{
                        width:100%;
                        padding:10px;
                        box-shadow: 6px 6px 4px -8px black;
                        display:flex;
                        
                    }
                    .jodan .fitter .imgd{
                        width:45px;
                        height:40px;
                        border-radius:100%;
                        
                    }.jodan .fitter .imgd img{
                        width:95%;
                        height:100%;
                        border-radius:100%;
                    }
                    .jodan .fitter .wider{
                        
                        width:100%;
                        padding:5px 0;
                        display:flex;
                        
                    }
                    .jodan .fitter .wider .topMacInd{
                        width:100%;
                        
                        
                    }
                    
                </style>
                
                
                <?php
                $subj_id=$_GET['_-'];
                $_=$conn->query("select*from subj_chapterssa where subj_id='$subj_id'");
                while($row=mysqli_fetch_array($_)){
                    $chapter_name=$row['chapter_name'];
                    $chapte_id=$row['chapter_id'];
                    $subj_info=$this->getSubjInfo($row['subj_id']);
                    $subj_name=$subj_info['subj_name'];
                    $dir="../controller/functions/netchatsaSchoolLogo/a.jpg";
                    $school=$this->GetSchool($row['school_id']);
                    $school_logo=$school['school_logo'];
                    if($school_logo!="empty"){
                        $dir="../controller/functions/netchatsaSchoolLogo/".$school_logo;
                    }
                    ?>
                        
                        <div class="jodan">
                            <a href="?_=subj&_-_=<?php echo $chapte_id;?>">
                            <div class="fitter">
                                <div class="imgd">
                                    <img src="<?php echo $dir;?>">
                                </div>
                                <div class="wider">
                                    <div class="topMacInd"><?php echo $subj_name;?></div>
                                    <div class="topMacInd"><?php echo $chapter_name;?></div>
                                </div>
                            </div>
                             </a>
                        </div>
                        
                   
                    <?php
                    
                }
            }
            else{
                ?>
                <h3 style="color:red;">Cannot Find Subject ID Provided</h3>
                <?php
            }
        }
        elseif(isset($_GET["_-_"])){
            $chapter_id=$_GET["_-_"];
            if($this->isChapter($chapter_id)){
                $chapter_info=$this->getChaterInfo($chapter_id);
                // $subj_info=$this->getSubjInfo($chapter_info['subj_id']);
                $this->headerPassMech($chapter_info['subj_id'],$id);
                ?>
                <style>
                    .jodan{
                        width:100%;
                        padding:10px 0;
                        
                    }
                    .jodan .fitter{
                        width:100%;
                        padding:10px;
                        box-shadow: 6px 6px 4px -8px black;
                        
                        
                    }
                    .jodan .fitter .ral{
                        width:100%;
                        display:flex;
                    }
                    .jodan .fitter .ral .a{
                        width:100%;
                    }
                    .jodan .fitter .imgd{
                        width:100%;
                        
                        
                        
                    }.jodan .fitter .imgd img,video{
                        width:100%;
                        
                       
                    }
                    .jodan .fitter .wider{
                        
                        width:100%;
                        padding:5px 0;
                    }
                    .jodan .fitter .wider .topMacInd{
                        width:100%;
                    }
                    
                </style>
                <?php
                $_=$conn->query("select*from content where chapter_id='$chapter_id' order by time_added DESC");
                if($_->num_rows==0){
                    ?>
                    <h2 style="color:green;">No Content Added Yet</h2>
                    <?php
                }
                else{
                    while($row=mysqli_fetch_array($_)){
                        $doc=$row["document"];
                        $ext=explode(".",$doc);
                        $ext=end($ext);
                        
                        $subject_id=$row['subj_id'];
                        $subj_info=$this->getSubjInfo($subject_id);
                        $chapter_info=$this->getChaterInfo($chapter_id);
                        $school_id=$subj_info['subj_school_id'];
                        $dir="../controller/functions/".$school_id."/".$subject_id."/".$chapter_id."/".$doc;
                        
                        
                        ?>
                        <div class="jodan">
                            <div class="fitter">
                                <div class="ral">
                                    <div class="a"><?php echo $subj_info['subj_name']; ?></div>
                                    <div class="a"><?php echo $chapter_info['chapter_name']; ?></div>
                                </div>
                                <div class="imgd">
                                    <?php
                                    if(in_array(strtolower($ext),array("png","jpg","jpeg","heic","jpeng"))){
                                        ?>
                                        <img src="<?php echo $dir;?>">
                                        <?php
                                    }
                                    elseif(in_array(strtolower($ext),array("mp4","mv"))){
                                        ?>
                                        <video controls>
                                          <source src="<?php echo $dir;?>" type="video/mp4">
                                          <source src="<?php echo $dir;?>" type="video/ogg">
                                          Your browser does not support the video tag.
                                        </video>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <a href="<?php echo $dir;?>" download><?php echo $chapter_info['chapter_name']." Content downloadable";?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                        
                }
            }
            else{
                ?>
                <h3 style="color:red;">Query ID Does not Exist!!</h3>
                <?php
            }
        }
        else{
            ?>
            <h3 style="color:red;">No such Refference Exist!!</h3>
            <?php
        }
    }
	protected function getOtherUser($poster_my_id){
		global $conn;
		return mysqli_fetch_array($conn->query("select*from create_runaccount where my_id='$poster_my_id'"));
	}
	protected function isNetchatSubj($subj_id){
	    global $conn;
	    $_=$conn->query("select*from netchatsa_subjects where subj_id='$subj_id'");
	    return ($_->num_rows==1);
	}
	protected function NetchatSubjInfo($subj_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select*from netchatsa_subjects where subj_id='$subj_id'"));
	}
	protected function eduSgela($id){
	    global $conn;
	    $this->abc($id);
	    if(isset($_GET['_-'])&&!empty($_GET['_-'])){
	        $subj_id=$_GET['_-'];
	        $subj_info=$this->NetchatSubjInfo($subj_id);
	        if($this->isNetchatSubj($subj_id)){
	            ?>

	            <style>
		
        		    .medLocker{
        		        
        		        width:100%;
        		        
        		        
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                        
                        color:#f3f3f3;
                        hyphens: auto;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
        		</style>
        		<div class="medLocker">
        		    <?php
        		    $_=$conn->query("select*from netchatsa_subjects_chapters where subj_id='$subj_id'");
        		    if($_->num_rows==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Chappters Added for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        while($row=mysqli_fetch_array($_)){
            		        $chapter_name=$row['chapter_name'];
            		        $chapter_id=$row['chapter_id'];
            		        $dir="../../default-img/a.png";
            		        
            		        ?>
            		        <div class="bodyCamp" onclick="dofoUsLeg1(<?php echo $chapter_id;?>)">
            		            <div class="radeMos">
            		                <div class="img-kMover">
                    		            <img src="<?php echo $dir;?>">
                    		        </div>
                    		        <div class="maxcKood">
                    		            <div><small><?php echo $chapter_name;?></small></div>
                    		            <div><small>click to see Content presented for <?php echo $chapter_name;?></small></div>
                    		        </div>
            		            </div>
                    		        
                		    </div>
                    		
            		        <?php
            		    }
        		    }
            		    
        		    ?>
            		    
        		</div>
        		</center>
        		<?php
	        }
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	    }
	    elseif(isset($_GET['_-_'])&&!empty($_GET['_-_'])){
	        $chapter_id=$_GET['_-_'];
	        if($this->isChapterMor($chapter_id)){
	            $chapter_info=$this->getChapterInfo($chapter_id);
	            $subj_info=$this->NetchatSubjInfo($chapter_info['subj_id']);
	            ?>
	            <style>
		
        		    .medLocker{
        		        
        		        width:100%;
        		        
        		        hyphens: auto;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                        
                        color:#f3f3f3;
                        /*background-color:#fff;*/
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
        		</style>
        		<div class="medLocker" >
        		    <?php
        		    $_=$conn->query("select*from netchatsa_content where chapter_id='$chapter_id' order by time_added ASC");
        		    if($_->num_rows==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Contnent Added for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        while($row=mysqli_fetch_array($_)){
        		            $ext=explode(".",$row['content']);
        		            $ext=$ext[0];
        		            $subj_id=$row['subj_id'];
                            $chapter_id=$row['chapter_id'];
                            
        		            $dir="../../posts/netchatsaSubject/".$subj_id."/".$chapter_id."/".$row['content'];
        		            if(in_array($ext,["mp4","MP4","mv","MV"])){
        		                ?>
        		                <video style="width:100%;" controls download='false'>
                                  <source src="<?php echo $dir;?>" type="video/mp4">
                                  <source src="<?php echo $dir;?>" type="video/ogg">
                                  Your browser does not support the video tag.
                                </video>
        		                <?php
        		            }
        		            else{
        		                ?>
        		                <img src="<?php echo $dir;?>" style="width:100%;" download='false'>
        		                <?php
        		            }
        		            
        		        }
        		        
        		    }
            		    
        		    ?>
            		    
        		</div>
        		</center>
	            <?php
	        }
	        
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	        
	    }
	    elseif(isset($_GET['_practiceSubj_']) && !empty($_GET['_practiceSubj_'])){
	        $chapter=$_GET['_practiceSubj_'];
	        if($this->isNetchatSubjpracticeExams($chapter)){
	           // $subj_info=$this->NetchatSubjpracticeExams($chapter);
	            $_=$conn->query("select*from exampractice where chapter='$chapter'");
	            if($_->num_rows==0){
	                ?>
	                <h4 style="color:red;">Chapter has no practice questions yet!!..</h4>
	                <?php
	            }
	            else{
	                $count=1;
	                while($row=mysqli_fetch_array($_)){
	                    $chapter_id=$row['chapter'];
	                    $subject=$row['subject'];
	                    $question="../../posts/netchatsaSubject/".$subject."/".$chapter_id."/practice/".$row['question'];
	                    $answer="../../posts/netchatsaSubject/".$subject."/".$chapter_id."/practice/";
	                    $solution_array=array();
	                    if(!empty($row['a']) && $row['a']!="empty"){
	                        array_push($solution_array,$row['a']);
	                    }
	                    if(!empty($row['b']) && $row['b']!="empty"){
	                        array_push($solution_array,$row['b']);
	                    }
	                    if(!empty($row['c']) && $row['c']!="empty"){
	                        array_push($solution_array,$row['c']);
	                    }
	                    if(!empty($row['d']) && $row['d']!="empty"){
	                        array_push($solution_array,$row['d']);
	                    }
	                    if(!empty($row['e']) && $row['e']!="empty"){
	                        array_push($solution_array,$row['e']);
	                    }
	                    if(!empty($row['f']) && $row['f']!="empty"){
	                        array_push($solution_array,$row['f']);
	                    }
	                    
	                    ?>
        	            <div class="container">
                            <center><h3>question <?php echo $count;?></h3></center>
                          <div data-toggle="modal" data-target="#_<?php echo $row['id'];?>">
                              <img src="<?php echo $question;?>" style="width:100%;">
                          </div>
                        
                          <!-- Modal -->
                          <div class="modal fade" id="_<?php echo $row['id'];?>" role="dialog">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h3 style="color:#000;text-align:left;">Solutions to question <?php echo $count;?></h3>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  
                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo $answer.$row['answer'];?>" style="width:100%;">
                                  
                                  <?php
                                    foreach($solution_array as $img){
                                        ?>
                                        <img src="<?php echo $answer.$img;?>" style="width:100%;">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
        
        	            <?php
        	            $count++;
	                }
	            }
        	            
	        }
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	        
	    }
	    elseif(isset($_GET['practiceSubj']) && !empty($_GET['practiceSubj'])){
	        $subj_id=$_GET['practiceSubj'];
	        if($this->isNetchatSubj($subj_id)){
	            $subj_info=$this->NetchatSubjInfo($subj_id);
	            ?>
	            <style>
		
        		    .medLocker{
        		        
        		        width:100%;
        		        
        		        height:80.5vh;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                        hyphens: auto;
                        color:#f3f3f3;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
        		</style>
        		<div class="medLocker">
        		    <?php
        		    $_=$conn->query("select*from exampractice where subject='$subj_id'");
        		    if($_->num_rows==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Exam Practice for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        $chapterswithexamquestions=array();
        		        while($row=mysqli_fetch_array($_)){
        		            $chapter=$row['chapter'];
        		            if(!in_array($chapter,$chapterswithexamquestions)){
        		                array_push($chapterswithexamquestions,$chapter);
        		            }
        		        }
        		        foreach($chapterswithexamquestions as $chapter_id){
        		            $chapter_info=$this->getChapterInfo($chapter_id);
        		           
            		        $chapter_name=$chapter_info['chapter_name'];
            		        
            		        $dir="../../default-img/a.png";
            		        
            		        ?>
            		        <div class="bodyCamp" onclick="practiceExamQuestionsRedirect(<?php echo $chapter_id;?>)">
            		           
            		            <div class="radeMos">
            		                <div class="img-kMover">
                    		            <img src="<?php echo $dir;?>">
                    		        </div>
                    		        <div class="maxcKood">
                    		            <div><small><?php echo $chapter_name;?></small></div>
                    		            <div><small>click to start exam practice </small></div>
                    		        </div>
            		            </div>
                    		        
                		    </div>
                    		
            		        <?php
            		    }
        		    }
            		    
        		    ?>
            		    
        		</div>
        		<script>
        		    function practiceExamQuestionsRedirect(chapter){
        		        window.location=("./?_=eduSgela&_practiceSubj_="+chapter);
        		    }
        		</script>
        		</center>
        		<?php
	        }
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	        
	    }
	    else{
	        ?>
	        <h4 style="color:red;">Query Does Not Exist!!..</h4>
	        <?php
	    }
	}
	protected function isNetchatSubjpracticeExams($chapter){
	    global $conn;
	    $_=$conn->query("select*from exampractice where chapter='$chapter'");
	    return ($_->num_rows>=0);
	}
	protected function NetchatSubjpracticeExams($chapter){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select*from exampractice where chapter='$chapter'"));
	}
	protected function getChapterInfo($chapter_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select*from netchatsa_subjects_chapters where chapter_id='$chapter_id'"));
	}
	
	// protected function getSubjInfo($subj_id){
	//     global $conn;
	//     return mysqli_fetch_array($conn->query("select*from subjectssa where subj_id='$subj_id'"));
	// }
	protected function schoolSubj($id){
		global $conn;
		$ara=array();
		$_=$conn->query("select*from sgelamatricclasses");
		while($row=mysqli_fetch_array($_)){
			array_push($ara,$row);
		}
		return $ara;
	}
	
	protected function existOnSgela($id){
	    global $conn;
	    $_=$conn->query("select my_id from sgela where my_id='$id'");
	    return ($_->num_rows==1);
	}
	protected function isChapterMor($chapter_id){
	    global $conn;
	    $_=$conn->query("select*from netchatsa_subjects_chapters where chapter_id='$chapter_id'");
	    return ($_->num_rows==1);
	}
	public function isRegWithSgelaLearn2Code($id){
		global $conn;
		return false;
	}
	protected function home($cur_user_row){
		global $conn;
		?>
		<style>
			.bottomPart{
				width: 100%;	
			}
			.bottomPart .package{
				width: 100%;
				box-shadow: -3px 4px 6px 6px black;
			}
			.bottomPart .package a{
				width: 100%;
			}
			.bottomPart .package a .headerDisplayMach{
				width: 100%;
				display: flex;
				padding: 5px 5px;
			}
			.bottomPart .package a .headerDisplayMach .profile{
				width: 40px;
				height: 40px;
				border: 2px solid white;
				border-radius: 100%;
				
			}
			.bottomPart .package a .headerDisplayMach .profile img{
				width: 100%;
				height: 100%;
				width: 100%;
				border-radius: 100%;
			}
			.bottomPart .package .headerDisplayMach .userName{
		    	padding: 10px 10px;
		    	font-size: 8px;
		    }
		    .bottomPart .package .headerDisplayMach .userName h5{
		    	font-size: 15px;
		    }
		    .bottomPart .package .headerDisplayMach .names{
		    	padding: 10px 10px;
		    	font-size: 8px;
		    }
		    .bottomPart .package .headerDisplayMach .names h5{
		    	font-size: 15px;
		    }
		    .bottomPart .package .headerDisplayMach .time{
		    	padding: 10px 10px;
		    	font-size: 8px;
		    }
		    .bottomPart .package .headerDisplayMach .time h5{
		    	font-size: 15px;
		    }
		    .bottomPart .package .textDisplay{
		    	width: 100%;
		    	padding: 5px 5px;
		    	cursor: pointer;
		    }
		    .bottomPart .package .textDisplay h5{
		    	font-size: 14px;
		    }
		    .bottomPart .package .textDisplay{
		    	width: 100%;
		    }
		    .bottomPart .package .textDisplay img{
		    	width: 100%;
		    }
		    .bottomPart .package .textDisplay video{
		    	width: 100%;
		    }
		    .bottomPart .package .displayEmogies{
		    	width: 100%;
		    	padding: 5px 5px;
		    	text-align: center;
		    	justify-content: center;
		    	align-content: center;
		    	align-items: center;
		    	align-self: center;
		    	display: flex;

		    }
		    .bottomPart .package .displayEmogies .like{
		    	width: 25%;
		    	
		    	text-align: center;
		    }
		    .bottomPart .package .displayEmogies .like i{
		    	font-size: 15px;
		    	color: white;
		    }

		</style>
		<div class="bottomPart">
			<?php
			$_=$conn->query("select*from my_post ORDER BY time_posted DESC");
			while($row=mysqli_fetch_array($_)){
				$text=$row['text'];
				$img=$row['img'];
				$video=$row['video'];
				$time_posted=$row['time_posted'];
				$posted_by=$row['posted_by'];
				$posted_by_info=$this->getOtherUser($posted_by);//array
				$dir="../../posts/".$posted_by."/".$img;
				$dirVideo="../../posts/".$posted_by."/".$video;
				$profileIMG=$posted_by_info['profile_image'];
				$profileDir="";
				$post_id=$row['post_id'];
				if($profileIMG=="empty"){
					$profileDir="../../default-img/fff.jpg";
					
				}
				else{
					$profileDir="../../posts/".$posted_by."/".$profileIMG;
				}
				$target_ip=$posted_by;
	            // $target_ip=str_replace("=","",$target_ip);
	            //echo $target_ip;
	// 			$target_ip2=$this->hlanza($target_ip,true);
	// 			echo"<br>".$target_ip2;
				?>
				<div class="package">
					<a href="./?_=profile&_1_=<?php echo $target_ip;?>">
						<div class="headerDisplayMach" style="cursor:pointer;">
							<div class="profile"><img src="<?php echo $profileDir;?>"></div>
							<div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<15){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
								for($i=0;$i<15;$i++){echo $bb[$i];}echo"..";
							}?></h5></div>
							<div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<15){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
								for($i=0;$i<15;$i++){echo $aa[$i];}echo"..";
							}?></h5></div>
							<div class="time" ><h5><?php $this->time_Ago(strtotime($time_posted));?></h5></div>
						</div>
					</a>
						<?php 
						if(!empty($text)){
							?>
						<div class="textDisplay" data-toggle="modal" data-target="#viewAddComments" onclick="fetchData(<?php echo $post_id; ?>)">
							<h5><?php echo $text;?></h5>
						</div>

							<?php
						}
						if($img!=0){
							?>
							<div class="textDisplay" data-toggle="modal" data-target="#viewAddComments" onclick="fetchData(<?php echo $post_id; ?>)">
								<img src="<?php echo $dir;?>">
							</div>
							
							<?php
						}
						else{

							if($video!=0){
								?>
								<div class="textDisplay" data-toggle="modal" data-target="#viewAddComments" onclick="fetchData(<?php echo $post_id; ?>)">
								    <video controls>
								    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
								    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
								    </video>
								</div>
								<!-- <div class="displayEmogies flex" >
									<div class="like">
										<i class="fa fa-refresh" aria-hidden="true"></i>
									</div>
									<div class="like">
										<i class="fa fa-refresh" aria-hidden="true"></i>
									</div>
									<div class="like">
										<i class="fa fa-refresh" aria-hidden="true"></i>
									</div><div class="like">
										<i class="fa fa-refresh" aria-hidden="true"></i>
									</div>
									
								</div> -->
								<?php
							}
						}
						?>
						<div class="displayEmogies flex" >
						    	<div class="like flex"  data-toggle="modal" data-target="#viewAddComments" onclick="fetchData(<?php echo $post_id; ?>)">
								<i class="fa fa-comment" aria-hidden="true"></i><small><?php echo $this->getNumComments($post_id);?></small>
							</div>
							<div class="like flex"  >
								<i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $this->getNumViews($post_id);?></small>
							</div>
							<div class="like flex"  >
								<i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $this->getNumDislike($post_id);?></small>
							</div>
							<div class="like flex" >
								<i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $this->getNumLikes($post_id);?></small>
							</div>
						</div>
					</div>
				<br>
				<?php
			}
			?>

		</div>
			
		<script>
		    function fetchData(postid){
		        console.log(postid);
    			$.ajax({
    				url:'controler/modaldata/postmodal.php',
    				type:'post',
    				data:{postid:postid},
    				success:function(e){
    					$("#viewaddcommentdata").html(e);
    				}
    			});
		    }
		</script>
		<?php
	}
	protected function getNumComments($post_id){
	    global $conn;
	    $_=$conn->query("select post_id from post_comments where post_id='$post_id'");
        return $_->num_rows;
	}
	public function sideBar($cur_user_row){
		?>
<style>
    .control{
        width:100%;
    }
    .control .control-ap{
        width:100%;
        height:6vh;
        border-bottom:1px solid #f1f1f1;
        display:flex;
        cursor:pointer;
        color: #f1f1f1;
    }
    .control .control-ap:hover{
        border: 5px dashed white;
      background:
        linear-gradient(to top, navy, 5px, transparent 5px),
        linear-gradient(to right, navy, 5px, transparent 5px),
        linear-gradient(to bottom, navy, 5px, transparent 5px),
        linear-gradient(to left, navy, 5px, transparent 5px);
      background-origin: border-box;
      text-align:center;
      color: #35424a;
    }
    .control .control-ap a .d-m{
        width:15%;
    }
    .control .control-ap a .map-co{
        width:85%;

    }

</style>
	<div class="control">
	    <a href="?_=apply"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='apply'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-pencil" style="" aria-hidden="true"></i> Apply</div>
	    </div></a>
	    <a href="?_=studyarea"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='studyarea'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-book" style="" aria-hidden="true"></i> study Area</div>
	    </div></a>
	    <a href="?_=pastpapers"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='pastpapers'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Sgela</div>
	    </div></a>
	    <a href="?_=matricUpgrade"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='matricupgrade'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Matric Upgrade</div>
	    </div></a>
	    <a href="?_=Math-Phy"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='math-phy'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-trophy" style="" aria-hidden="true"></i> Math-Phy</div>
	    </div></a>
	    <hr style="color:#f3f3f3;">
	    
	    <!-- <a href="?_=notification"><div class="control-ap" <?php //if(isset($_GET['_'])&&strtolower($_GET['_'])=='notification'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php// };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-bell" style="" aria-hidden="true"></i> Notification</div>
	    </div></a> -->
	    <a href="?_=my-account"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='my-account'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-refresh" style="" aria-hidden="true"></i> update profile</div>
	    </div></a>
	     <a href="?_=my-post"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='my-post'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-picture-o" style="" aria-hidden="true"></i> my Post</div>
	    </div></a>
	     <a href="?_=messages"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='messages'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-envelope" style="" aria-hidden="true"></i> messages <?php //$this->getNumMess($id);?></div>
	    </div></a>
	     <a href="?_=live public chats"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='live public chats'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-comments" style="" aria-hidden="true"></i> live public chats</div>
	    </div></a>
	     
	     <a href="?_=latestNews"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='latestNews'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-newspaper-o" style="" aria-hidden="true"></i> Latest News</div>
	    </div></a>
	    <a href="?_=SportsNews"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='sportsnews'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-futbol-o" style="" aria-hidden="true"></i> Sport News</div>
	    </div></a>
	     
	    <!-- <a href="?_=shisanyama"><div class="control-ap" <?php //if(isset($_GET['_'])&&strtolower($_GET['_'])=='shisanyama'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php //};?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-fire" style="" aria-hidden="true"></i> Ekasi Shisanyama</div>
	    </div></a> -->
	    <a href="?_=music"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='music'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-music" style="" aria-hidden="true"></i> Music</div>
	    </div></a>
	    
	    <!--<i class="fa fa-music" aria-hidden="true" style="font-size:25px;"></i>-->
	    <a href="?_=exit"><div class="control-ap" <?php if(isset($_GET['_'])&&strtolower($_GET['_'])=='exit'){?> style=" border: 5px dashed white;background:linear-gradient(to top, navy, 5px, transparent 5px),linear-gradient(to right, navy, 5px, transparent 5px),linear-gradient(to bottom, navy, 5px, transparent 5px),linear-gradient(to left, navy, 5px, transparent 5px);background-origin: border-box;text-align:center;color:white;" <?php };?> >
	        <div class="d-m" style="width:15%;"></div><div class="map-co"><i class="fa fa-sign-out" style="" aria-hidden="true"></i> log out</div>
	    </div></a>
	    
	    
	</div>

		<?php
	}
	protected function getNumMess($id){
		global $conn;
		
		$_=$conn->query("select*from messages where otheruser='$id' AND seen='0'");
		$num=$_->num_rows;
		if($num>0){
			?>
				(<small style="font-size:10px;color:#f3f3f3;background-color: seagreen;border-radius: 100%;"><?php echo $num;?></small>)
			<?php
		}
	}
	protected function header($cur_user_row){
		  global $conn;
		  require_once("model/header.php");
	}
	
	protected function getRecordingLabel($id){
      global $conn;
      return mysqli_fetch_array($conn->query("select* from recording_label where id='$id'"));
    }
    protected function getAlbuminfo($id){
        global $conn;
        return mysqli_fetch_array($conn->query("select* from album where id='$id'"));
    }
    protected function getArtistInfo($id){
        global $conn;
        return mysqli_fetch_array($conn->query("select* from artist where id='$id'"));
    }
	protected function logout($a){
		global $conn;
	    $cur_user_row=mysqli_fetch_array($conn->query("select*from create_runaccount where usermail='$a'"));
	    $id=$cur_user_row['my_id'];
	    $onlne_ofline=0;
	    if($conn->query("UPDATE status_online_offline set onlne_ofline='$onlne_ofline' , time_last='NOW()'  where my_id='$id'")){
	        unset($a);
	     	session_destroy();
	     	?>
	     	<script>
	     		window.location=("../../");
	     	</script>
	     	<?php
	     	exit();
	    }
	    else{
	        unset($a);
	     	session_destroy();
	     	
	     	header("Location:../../?logout failed");
	     	exit();
	    }
		unset($id);
		session_destroy()

		?>
		<script> window.location=("../../"); </script>
		<?php
	}
	protected function appy($cur_user_row){
		$this->play($cur_user_row['my_id']);
	}
	protected function studyarea($cur_user_row){
		global $conn;
		?>
		<style>
			.headerSearchBar{
	width: 100%;
	padding: 10px;
	background-color: none;
	border-bottom:1px solid orangered;
}
.headerSearchBar .model{
	width: 90%;
	
}
.headerSearchBar .model form{
	width: 100%;
	display: flex;
	
}
.headerSearchBar .model form .seachInput{
	width: 90%;
	
}
.headerSearchBar .model form .seachInput input{
	width: 100%;
	border: none;
	border-bottom: 1px solid white;
	color: white;
	background-color: #212121;
}
.headerSearchBar .model form .seachSubmit{
	width: 10%;
}
.headerSearchBar .model form .seachSubmit .btn{
	width: 100%;
}
.bodyStudyArea{
	width: 100%;

}
.bodyStudyArea .package{
		width: 100%;
		box-shadow: -3px 4px 6px 6px black;
	}
	.bodyStudyArea .package .headerDisplayMach{
		width: 100%;
		padding-top: 5px 5px;
		display: flex;
	}
	
	.bodyStudyArea .package .headerDisplayMach .userName{
		padding: 10px 10px;
		font-size: 8px;
	}
	.bodyStudyArea .package .headerDisplayMach .userName h5{
		font-size: 15px;
	}
	.bodyStudyArea .package .headerDisplayMach .names{
		padding: 10px 10px;
		font-size: 8px;
	}
	.bodyStudyArea .package .headerDisplayMach .names h5{
		font-size: 15px;
	}
	.bodyStudyArea .package .headerDisplayMach .time{
		padding: 10px 10px;
		font-size: 8px;
	}
	.bodyStudyArea .package .headerDisplayMach .time h5{
		font-size: 15px;
	}
	.bodyStudyArea .package .textDisplay{
		width: 100%;
		padding: 5px 5px;
		
	}
	.bodyStudyArea .package .textDisplay h5{
		font-size: 14px;
	}
	.bodyStudyArea .package .textDisplay a{
		width: 100%;
	}
	.bodyStudyArea .package .textDisplay img{
		width: 100%;
	}
	.bodyStudyArea .package .textDisplay video{
		width: 100%;
	}
	.bodyStudyArea .package .displayEmogies{
		width: 100%;
		padding: 5px 5px;
		text-align: center;
		justify-content: center;
		align-content: center;
		align-items: center;
		align-self: center;

	}
	.bodyStudyArea .package .displayEmogies .like{
		width: 25%;
		
		text-align: center;
	}
	.bodyStudyArea .package .displayEmogies .like i{
		font-size: 15px;
		color: white;
	}
	.package .headerDisplayMach{
		width: 100%;
		padding: 2px 2px;
	}
	.package .headerDisplayMach .profile{
		
		width:40px;
		height:40px;
		border-radius: 100%;
		border: 1px solid white;
		padding: 2px 2px;
		background-color: navy;
	}
	.package .headerDisplayMach .profile img{
		
		width: 100%;
		height: 100%;
		border-radius: 100%;
		border: 1px solid white;
		
	}

		</style>
			<div class="headerSearchBar flex">
				<div class="model">
					<form method="post">
						<div class="seachInput"><input type="search" name="search" id="search" placeholder="Find Your Answer/Solution..." required=""></div>
						<div class="seachSubmit"><button type="button" class="btn" onclick="searchFind();"><i title="Click Find Your Search"  class="fa fa-search" id="fa" aria-hidden="true"></i></button></div>
					</form>
					<script>
					    function searchFind(){
					        q=$('#search').val();
					        if(q==""){
					            $('#search').removeAttr("placeholder");
					            $('#search').attr("placeholder","EMPTY SEARCH QUERY!!..");
					        }
					        else{
					            window.location=("./?_=studyarea&q="+q);
					        }
					    }
					</script>
				</div>
				<div class="idPos"><button type="button" data-toggle="modal" data-target="#StudyAreaUpload"  class="btn"><i title="Click Upload Problem/Question"  class="fa fa-upload" id="fa" aria-hidden="true"></i></button></div>
				<div class="idPos"><button type="button" data-toggle="modal" data-target="#coding" class="btn"><i title="Click Write n Upload Your Code"  class="fa fa-code" id="fa" aria-hidden="true"></i></button></div>

			</div>
			<br>
			<div class="bodyStudyArea">
				<?php
				    if(isset($_GET['q']) & !empty($_GET['q'])){
				        $search=$_GET['q'];
				        $aKeyword = explode(" ", $search);
                        $query ="SELECT * FROM studyarea WHERE title like '%" . $aKeyword[0] . "%'";
                        for($i = 1; $i < count($aKeyword); $i++) {
                            if(!empty($aKeyword[$i])) {
                                $query .= " OR title like '%" . $aKeyword[$i] . "%'";
                            }
                        }
                        $result = $conn->query($query);
                        
                        echo "<div style='color:white;background-color:green;width:100%;min-height:20px;text-align:center;box-shadow:1px 1px 1px 1px #000;'><span>search results for : ".$search."</span> ".$result->num_rows."</div><br>";
                        $numbReplyusingImage_id_count=1;
                    	$r=0;$r1=1;$r2=2;
                        if(mysqli_num_rows($result) > 0) {
                            while($row = $result->fetch_assoc()) { 
    				       
    							$post_id=$row['post_id'];
    							$text=$row['text'];
    							$img=$row['img'];
    							$video=$row['video'];
    							$time_posted=$row['time_posted'];
    							$posted_by=$row['posted_by'];
    							$posted_by_info=$this->getOtherUser($posted_by);//array
    							$dir="../../posts/netchatsaSudyArea/".$posted_by."/".$img;
    							$dirVideo="../../posts/netchatsaSudyArea/".$posted_by."/".$video;
    							$profileIMG=$posted_by_info['profile_image'];
    							$profileDir="";
    							if($profileIMG=="empty"){
    								$profileDir="../../default-img/fff.jpg";
    								
    							}
    							else{
    								$profileDir="../../posts/".$posted_by."/".$profileIMG;
    							}
    
    							?>
    							<div class="package">
    								
    								<div class="headerDisplayMach">
										<div class="profile">
													<img src="<?php echo $profileDir;?>">
										</div>
										
    									
    									<div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<17){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
    										for($i=0;$i<17;$i++){echo $bb[$i];}echo"..";
    									}?></h5></div>
    									<div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<17){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
    										for($i=0;$i<17;$i++){echo $aa[$i];}echo"..";
    									}?></h5></div>
    									<div class="time" ><h5><?php $this->time_Ago(strtotime($time_posted));?></h5></div>
    								</div>
    								<div class="title" style="width:100%;color: #f3f3f3;background-color: navy;padding: 10px 0;">
    									<?php
    										echo $row['title'];
    									?>
    								</div>
    								<?php 
    								if(!empty($text)){
    									?>
    								<div class="textDisplay">
    									<h5><?php echo $text;?></h5>
    								</div>
    									<?php
    								}
    								if($img!=0){
    									?>
    									<div class="textDisplay">
    										<img src="<?php echo $dir;?>">
    									</div>
    									<?php
    								}
    								else{
    
    									if($video!=0){
    										?>
    										<div class="textDisplay">
    										    <video controls>
    										    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
    										    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
    										    </video>
    										</div>
    										<?php
    									}
    								}
    								?>
    								<div class="displayEmogies flex" >
    									<div class="like flex"  >
    										<i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $this->getNumViews($post_id);?></small>
    									</div>
    									<div class="like flex"  >
    										<i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $this->getNumDislike($post_id);?></small>
    									</div>
    									<div class="like flex" >
    										<i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $this->getNumLikes($post_id);?></small>
    									</div>
    									
    										<div class="like flex" >
    											<a href="./?_=studyarea&__=studyAreaReply&_-=<?php echo $post_id;?>" ><i onclick="views(<?php echo $post_id;?>);" class="fa fa-reply" aria-hidden="true"></i></a><small><?php echo $this->getNumOfReply($post_id);?></small>
    										</div>
    								</div>
    								
    							</div>
    							<br>
    							<?php
    						}
                        }
				    }
					elseif(isset($_GET['__']) &&isset($_GET["_-"]) && $_GET['__']=="studyAreaReply"){
						$_=$conn->query("select*from studyarea where post_id='".$_GET['_-']."'");
						if($_->num_rows!=1){
							echo "<h2 style='background-color:red;color:#f3f3f3;padding:10px 0;'>Post Not Found!!..</h2>";
						}
						else{
							$row=mysqli_fetch_array($_);
							$post_id=$row['post_id'];
							$text=$row['text'];
							$img=$row['img'];
							$video=$row['video'];
							$time_posted=$row['time_posted'];
							$posted_by=$row['posted_by'];
							$posted_by_info=$this->getOtherUser($posted_by);//array
							$dir="../../posts/netchatsaSudyArea/".$posted_by."/".$img;
							$dirVideo="../../posts/netchatsaSudyArea/".$posted_by."/".$video;
							$profileIMG=$posted_by_info['profile_image'];
							$profileDir="";
							$post_id=$row['post_id'];
							if($profileIMG=="empty"){
								$profileDir="../../default-img/fff.jpg";
								
							}
							else{
								$profileDir="../../posts/".$posted_by."/".$profileIMG;
							}

							?>
							<div class="package">

								<div class="headerDisplayMach">
									<div class="profile" style=""><img src="<?php echo $profileDir;?>"></div>
									<div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<17){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
										for($i=0;$i<17;$i++){echo $bb[$i];}echo"..";
									}?></h5></div>
									<div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<17){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
										for($i=0;$i<17;$i++){echo $aa[$i];}echo"..";
									}?></h5></div>
									<div class="time" ><h5><?php $this->time_Ago(strtotime($time_posted));?></h5></div>
								</div>
								<div class="title" style="width:100%;color: #f3f3f3;background-color: navy;padding: 10px 0;">
									<?php
										echo $row['title'];
									?>
								</div>
								<?php 
								if(!empty($text)){
									?>
								<div class="textDisplay">
									<h5><?php echo $text;?></h5>
								</div>

									<?php
								}
								if($img!=0){
									?>
									<div class="textDisplay">
										<img src="<?php echo $dir;?>">
									</div>
									<?php
								}
								else{

									if($video!=0){
										?>
										<div class="textDisplay">
										    <video controls>
										    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
										    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
										    </video>
										</div>
										<?php
									}
								}
								?>
								<div class="displayEmogies flex" >
									<div class="like flex"  >
										<i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $this->getNumViews($post_id);?></small>
									</div>
									<div class="like flex"  >
										<i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $this->getNumDislike($post_id);?></small>
									</div>
									<div class="like flex" >
										<i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $this->getNumLikes($post_id);?></small>
									</div>
									<div class="like flex" data-toggle="modal" data-target="#codingReply">
									<i class="fa fa-code" aria-hidden="true"></i>
									</div>
									<div class="like flex" data-toggle="modal" data-target="#replyStudyArea">
									<i class="fa fa-reply" aria-hidden="true"></i><small><?php echo $this->getNumOfReply($post_id);?></small>
									</div>
									
								</div>
								
							</div>
							<h2>Replies Below..</h2>
							<br>
							<?php

							$_=$conn->query("select*from studyareareply where post_id='$post_id' ORDER BY time_posted DESC");
							while($row=mysqli_fetch_array($_)){
								$text=$row['text'];
								$img=$row['img'];
								$video=$row['video'];
								$time_posted=$row['time_posted'];
								$posted_by=$row['posted_by'];
								$posted_by_info=$this->getOtherUser($posted_by);//array
								$dir="../../posts/netchatsaSudyArea/".$posted_by."/".$img;
								$dirVideo="../../posts/netchatsaSudyArea/".$posted_by."/".$video;
								$profileIMG=$posted_by_info['profile_image'];
								$profileDir="";
								$post_id=$row['reply_id'];
								if($profileIMG=="empty"){
									$profileDir="../../default-img/fff.jpg";
									
								}
								else{
									$profileDir="../../posts/".$posted_by."/".$profileIMG;
								}

								?>
								<div class="package">

									<div class="headerDisplayMach">
										<div class="profile" style=""><img src="<?php echo $profileDir;?>"></div>
										<div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<17){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
											for($i=0;$i<17;$i++){echo $bb[$i];}echo"..";
										}?></h5></div>
										<div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<17){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
											for($i=0;$i<17;$i++){echo $aa[$i];}echo"..";
										}?></h5></div>
										<div class="time" ><h5><?php $this->time_Ago(strtotime($time_posted));?></h5></div>
									</div>
									
									<?php 
									if(!empty($text)){
										?>
									<div class="textDisplay">
										<h5><?php echo $text;?></h5>
									</div>

										<?php
									}
									if($img!=0){
										?>
										<div class="textDisplay">
											<img src="<?php echo $dir;?>">
										</div>
										<?php
									}
									else{

										if($video!=0){
											?>
											<div class="textDisplay">
											    <video controls>
											    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
											    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
											    </video>
											</div>
											<?php
										}
									}
									?>
									<div class="displayEmogies flex" >
									<div class="like flex"  >
										<i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $this->getNumViews($post_id);?></small>
									</div>
									<div class="like flex"  >
										<i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $this->getNumDislike($post_id);?></small>
									</div>
									<div class="like flex" >
										<i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $this->getNumLikes($post_id);?></small>
									</div>
									
								</div>
									
								</div>
								<br>
								<?php
							}
						}
						
					}
					else{
						$_=$conn->query("select*from studyarea ORDER BY time_posted DESC");
						while($row=mysqli_fetch_array($_)){
							$post_id=$row['post_id'];
							$text=$row['text'];
							$img=$row['img'];
							$video=$row['video'];
							$time_posted=$row['time_posted'];
							$posted_by=$row['posted_by'];
							$posted_by_info=$this->getOtherUser($posted_by);//array
							$dir="../../posts/netchatsaSudyArea/".$posted_by."/".$img;
							$dirVideo="../../posts/netchatsaSudyArea/".$posted_by."/".$video;
							$profileIMG=$posted_by_info['profile_image'];
							$profileDir="";
							if($profileIMG=="empty"){
								$profileDir="../../default-img/fff.jpg";
								
							}
							else{
								$profileDir="../../posts/".$posted_by."/".$profileIMG;
							}

							?>
							<div class="package">

								<div class="headerDisplayMach">
									<div class="profile" style=""><img src="<?php echo $profileDir;?>"></div>
									<div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<17){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
										for($i=0;$i<17;$i++){echo $bb[$i];}echo"..";
									}?></h5></div>
									<div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<17){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
										for($i=0;$i<17;$i++){echo $aa[$i];}echo"..";
									}?></h5></div>
									<div class="time" ><h5><?php $this->time_Ago(strtotime($time_posted));?></h5></div>
								</div>
								<div class="title" style="width:100%;color: #f3f3f3;background-color: navy;padding: 10px 0;">
									<?php
										echo $row['title'];
									?>
								</div>
								<?php 
								if(!empty($text)){
									?>
								<div class="textDisplay">
									<h5><?php echo $text;?></h5>
								</div>

									<?php
								}
								if($img!=0){
									?>
									<div class="textDisplay">
										<img src="<?php echo $dir;?>">
									</div>
									<?php
								}
								else{

									if($video!=0){
										?>
										<div class="textDisplay">
										    <video controls>
										    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
										    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
										    </video>
										</div>
										<?php
									}
								}
								?>
								<div class="displayEmogies flex" >
									<div class="like flex"  >
										<i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $this->getNumViews($post_id);?></small>
									</div>
									<div class="like flex"  >
										<i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $this->getNumDislike($post_id);?></small>
									</div>
									<div class="like flex" >
										<i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $this->getNumLikes($post_id);?></small>
									</div>
									
										<div class="like flex" >
											<a href="./?_=studyarea&__=studyAreaReply&_-=<?php echo $post_id;?>" ><i onclick="views(<?php echo $post_id;?>);" class="fa fa-reply" aria-hidden="true"></i></a><small><?php echo $this->getNumOfReply($post_id);?></small>
										</div>
									

									
								</div>
								
							</div>
							<br>
							<?php
						}
					}
					?>
			</div>

		<?php
	}
	protected function header_student_inf($id){
		global $conn;
		// getting data from sgela info.
		return mysqli_fetch_array($conn->query("select*from sgela where  my_id='$id'"));
	}
	protected function headerSgela($id){
		global $conn;
		$header_student_inf=$this->header_student_inf($id);
		?>
		<script>
			$(document).ready(function(){
				$(document).on('change','.changegrade',function(){
					const changegrade=$(".changegrade").val();
					$.ajax({
						
	            		url:'controler/upload.php',
	            		type:'post',
	            		data:{changegrade:changegrade},
	            		success:function(e){
	            		    if(e.length<=2){
	            		    	$("#grade").html("Refreshing...");
	            		    	window.location=("./?_=pastpapers&_-=matric");
	            		    }
	            		    else{
	            		    	$("#grade").html("Error: "+e);
	            		    }
	            		}
	          		});
				});
			});
		</script>
		<style>
			.headerSgela{
				width: 100%;
				margin-top: .5%;
				padding: 5px 0;
				border:1px solid #f3f3f3;
				

			}
			.headerSgela .macDropDown{
				width: 25%;
			}
			.headerSgela .macDropDown .regi{
				width: 80%;
				border: 1px solid green;
				cursor: pointer;
				border-radius: 10px;
				box-shadow: 0 6px 4px -8px black;
			}
			.headerSgela .macDropDown .regi:hover{
				background-color: green;
				border-radius: 10px;
				box-shadow: 0 8px 6px -6px black;
				border: 1px solid ghostwhite;
			}
			.headerSgela .dropdown .dropbtn{
				background-color: #000;
			}
			.headerSgela .dropdown .dropdown-content{
				width: 220px;
			}

		</style>
		<center>
		<div class="headerSgela flex" style="border:1px solid white;">
			<div class="dropdown macDropDown" >
			  <button class="dropbtn regi">Subj</button>
			  <div class="dropdown-content">
			  	<a style='background-color: red; color: #f3f3f3;' data-toggle="modal" data-target="#install_school">Install School</a>
			  	<style>
			  	    .k2{
			  	        cursor:pointer;background-color: #ddd; color: #000;
			  	    }
			  	    .k2:hover{
			  	        background-color:navy;color:#f3f3f3;
			  	    }
			  	    .k1{
			  	        cursor:pointer;background-color: seagreen; color: #f3f3f3;
			  	    }
			  	    .k1:hover{
			  	        background-color:navy;color:#f3f3f3;
			  	    }
			  	</style>
			  	<?php 
			  	$std_inf=$this->getStudentInfo($id);
			  	$level=$header_student_inf['level'];
			  	$std_id=$std_inf['student_id'];
			  	$_=$conn->query("select*from student_subj_tracker where std_id='$std_id'");
			  	if($_->num_rows==0){
			  	    ?>
			  	    <a style='cursor:pointer;background-color: #ddd; color: #000;' >No Registered Subject Yet</a>
			  	    <?php
			  	}else{
			  	    $count=1;
			  	    while($row=mysqli_fetch_array($_)){
			  	        $subj_info=$this->getSubjInfo($row['subj_id']);
			  	        if($count%2==0){
			  	            ?>
    			  	        <a class="k2" href='./?_=subj&_-=<?php echo $row['subj_id'];?>'><?php echo $subj_info['subj_name'];?></a>
    			  	        <?php
			  	        }
			  	        else{
			  	            ?>
    			  	        <a class="k1" href='./?_=subj&_-=<?php echo $row['subj_id'];?>'><?php echo $subj_info['subj_name'];?></a>
    			  	        <?php
			  	        }
			  	        $count++;
			  	        
			  	    }
			  	}
			  	?>
			  </div>
			</div>
			<div class="randomdC" style="width:10%; padding: 0 5px;">
			    <h5 id="grade">
			    	<?php
			    		echo $level;
			    	?>
			    </h5>
			</div>
			<div class="randomdC" style="width:10%; padding: 0 5px;">
			    <h6>
			    	<?php
			    		if($header_student_inf['paid']==1){
			    			?>
			    			<h5 style="color:red;font-style: bold;font-family: arial;">NOT PAID</h5>
			    			<?php
			    		}
			    		else{
			    			?>
			    			<h5 style="color:green;font-style: bold;font-family: arial;">PAID</h5>
			    			<?php
			    		}
			    	?>
			    </h6>
			</div>
			<div class="randomdC" style="width:35%; padding: 0 5px;">
			    <select class="changegrade">
			    	<option value="">-- Change Grade --</option>
			    	<option value="gr12">Grade 12</option>
			    	<option value="gr11">Grade 11</option>
			    	<option value="gr10">Grade 10</option>
			    	<option value="gr9">Grade 9</option>
			    	<option value="gr8">Grade 8</option>
			    </select>
			</div>
		</div>
		<style>
		
		    .medLocker{
		        
		        width:100%;
		        hyphens: auto;
		        
		        overflow-x:auto;
                overflow-wrap: break-word;
                word-wrap: break-word;
                
                color:#f3f3f3;
		    }
		    .medLocker .bodyCamp{
		        width:100%;
		        padding:10px;
		    }
		    .medLocker .bodyCamp .radeMos{
		        width:100%;
		        height:auto;
		        padding:6px;
		        box-shadow: 0 8px 6px -6px black;
		        display:flex;
		        cursor:pointer;
		    }
		    .medLocker .bodyCamp .radeMos:hover{
		        background-color:navy;
		    }
		    .medLocker .bodyCamp .radeMos .img-kMover{
		        width:60px;
		        height:60px;
		        border-radius:100%;
		        padding:10px;
		    }
		    .medLocker .bodyCamp .radeMos .img-kMover img{
		        width:100%;
		        height:100%;
		        border-radius:100%;
		    }
		</style>
		<div class="medLocker">
		    <?php
		    $_=$conn->query("select*from netchatsa_subjects where level='$level'");
		    $count=0;
		    while($row=mysqli_fetch_array($_)){
		        $subj_name=$row['subj_name'];
		        $subj_id=$row['subj_id'];
		        $dir="../../default-img/a.png";
		        
		        ?>
		        <div class="bodyCamp" onclick="dofoUsLeg(<?php echo $subj_id;?>)">
		            <div class="radeMos">
		                <div class="img-kMover">
        		            <img src="<?php echo $dir;?>">
        		        </div>
        		        <div class="maxcKood">
        		            <div><small><?php echo $subj_name;?></small></div>
        		            <div><small>click to see all Chapters presented for <?php echo $subj_name;?></small></div>
        		        </div>
		            </div>
        		        
    		    </div>
        		
		        <?php
		        $count++;
		    }
		    if($count==0){
		    	?>
		    	<h5 style="color:#bbb;border:1px solid #bbb;padding:10px;10px;"> <?php echo $level." has not subjects yet!!";?></h5>
		    	<?php
		    }
		    ?>
    		    
		</div>
		</center>
		<?php
	}
	protected function matricShow($id){
		global $conn;
		$this->headerSgela($id);
		$_=$conn->query("select*from sgelamatricclasses");
		?>
		<style>
			.dopeSgela{
				width: 100%;
				padding: 5px 0;
				
			}
			h5{
				font-size: 13px;
			}
			.dopeSgela .sgelaContent{
				width: 100%;
				box-shadow: 0 8px 6px -6px black;
				cursor: pointer;
				background-color: none;
				font-size: 13px;
			}
			.dopeSgela .sgelaContent:hover{
				box-shadow: 0 6px 4px -8px black;
				background-color: green;
			}
			.dopeSgela .sgelaContent .imgLog{
				width: 50px;
				
				height: 50px;
				border-radius: 100%;
				cursor: pointer;
			}
			.dopeSgela .sgelaContent .imgLog img{
				width: 100%;
				height: 100%;
				border-radius: 100%;
				
			}
			.dopeSgela .sgelaContent .cntentAdvise{
				width: 85%;
				padding: 5px;
				
				
			}
			.dopeSgela .sgelaContent .cntentAdvise .dubjName{
				width: 100%;
			}
			.dopeSgela .sgelaContent .cntentAdvise .dubjChapters{
				width: 100%;
			}
		</style>
		<?php
		while($row=mysqli_fetch_array($_)){
			?>

			<div class="dopeSgela">
				<div class="sgelaContent flex">
					<div class="imgLog"><img src=""></div>
					<div class="cntentAdvise">
						<div class="subjName"><h5><?php echo $row['subj_name'];?></h5></div>
						<div class="subjChapters"><h5>Chapter 1 to <?php echo $row['num_chapters'];?></h5></div>
					</div>
				</div>
				<div class="brokenMat" id="_<?php echo $row['subj_id'];?>">
					ffrel;
				</div>

			</div>
			<?php
		}
		
	}
	protected function pastpapers($cur_user_row){

		global $conn;
		$id=$cur_user_row['my_id'];
		if(isset($_GET['_-'])){
			if(strtolower($_GET['_-'])=="matric"){
				$this->matricShow($id);
			}
			elseif(strtolower($_GET['_-'])=="uni"){
				
				$this->uniView($id);
			}
			elseif(strtolower($_GET['_-'])=="code"){
				$this->sgelaCoding($id);
			}
			else{
			    ?>
			    <h2 style="color:red;">Query not found </h2>
			    <?php
			}
		}
		else{
			$_=$conn->query("select * from sgela where my_id='$id'");
			if($_->num_rows!=1){
				?>
				<div class="bodyDisplaySgela">
					<div class="Grade12" data-toggle="modal" data-target="#matric" style="cursor:pointer;">
						<img src="../../default-img/high_school.png">
					</div>
					<div class="uni" data-toggle="modal" data-target="#varsity" style="cursor:pointer;">
						<img src="../../default-img/varsity.png">
					</div>
				</div>
				<div class="bodyDisplaySgela">
					<div class="learntocode" title="learn to code" id="learn2code" style="cursor:pointer;" data-toggle="modal" data-target="#learn2code_nav">
						<h2>LEARN 2 CODE</h2>
						<i style="font-size: 100px;"  class="fa fa-code" id="fa" aria-hidden="true"></i>

					</div>
				</div>
				<?php
			}
			else{
				$m=mysqli_fetch_array($_);
				if($m['status']=="matric"){
					?>
					<div class="bodyDisplaySgela">
						
							<div class="Grade12" style="cursor:pointer;">
								<a href="./?_=pastpapers&_-=matric"> 
								<img src="../../default-img/high_school.png">
								</a>
							</div>
						
					</div>
					<hr>
					<div class="bodyDisplaySgela">
						
							<div class="learntocode" title="learn to code" id="learn2code" style="cursor:pointer;" data-toggle="modal" data-target="#learn2code_nav">
								<h2>LEARN 2 CODE</h2>
								
								<i style="font-size: 100px;"  class="fa fa-code" id="fa" aria-hidden="true"></i>

							</div>
						
					</div>
					<?php
				}
				elseif($m['status']=="varsy"){
					?>
					<div class="bodyDisplaySgela">
						
							<div class="uni" style="cursor:pointer;">
								<a href="./?_=pastpapers&_-=uni"> 
								<img src="../../default-img/varsity.png"></a>
							</div>
						
					</div>
					<hr>
					<div class="bodyDisplaySgela">
						 
							<div class="learntocode" title="learn to code" id="learn2code" style="cursor:pointer;" data-toggle="modal" data-target="#learn2code_nav">
								<h2>LEARN 2 CODE</h2>
							
								<i style="font-size: 100px;"  class="fa fa-code" id="fa" aria-hidden="true"></i>
							</div>
						
					</div>
					<?php
				}
				else{
					$this->sgelaCoding($id);
				}
			}
		}
	}
	protected function mathPhy($cur_user_row){
		global $conn;
		echo "mathPhy";
	}
	protected function notification($cur_user_row){
		global $conn;
		echo "notification";
	}
	protected function myAccount($cur_user_row){
		global $conn;
		echo "myAccount";
	}
	public function sendEmail($message,$reciever,$sender,$subject){
		global $conn;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        // Create email headers
        $headers .= 'From: '.$sender."\r\n".
            'Reply-To: '.$sender."\r\n" .
            'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $mess = '<html><body> <div style="background-color:#212121;color:#f3f3f3;">';
        $mess .= '<div style="display:flex;">';
        $mess .='<div style="width:50px;height:40px;margin-left:5%;border-radius:100%;border:4px solid #f3f3f3;padding:4px 0;"><img style="width:100%;border-radius:100%;" src="https://netchatsa.com/mailLogo.jpg"></div>';
        $mess .='<div><h3 style="color:#080;font-size:18px;">Netchatsa Mailer Alert</h3></div>';
        $mess .='</div>';
        $mess .= '<h3 style="color:#f40;">Exe Macala 🤙</h3>'.$message;
        $mess .= '<div style="padding:10px;border:1px solid #f3f3f3;font-style:italic;font-size:12px;color:red;">netchatsa mailer is a communication system developed by Sgela Technologies EAI. If this mail does not belong to you please ignore it. Do not reply to this email as it is controlled by RoboTech.</div></div></body></html>';
        mail($reciever, $subject, $mess, $headers);

	}
	protected function myPost($cur_user_row){
		global $conn;
		$id=$cur_user_row['my_id'];
		?>
		<style>
			.toppart{
				width: 100%;

			}
			.toppart .displayFullLength{
				width: 100%;
				padding: 4px 4px;
				background-color: navy;
				height: 30vh;
			}
			.toppart .displayFullLength .border-1{
				width: 100%;
				padding: 4px 4px;
				background-color: white;
				height: 100%;
			}
			.toppart .displayFullLength .border-1  img{
				width: 100%;
				border: 3px solid navy;
				height: 100%;
				cursor: pointer;

			}

			.toppart .displayRound{
				width: 39%;
				padding: 4px 4px;
				background-color: white;
				height: 32vh;
				border-radius: 100%;
				margin-top: -35%;
			}
			.toppart .displayRound .border-2{
				width: 100%;
				padding: 4px 4px;
				background-color: navy;
				height: 100%;
				border-radius: 100%;
			}
			.toppart .displayRound .border-2  img{
				width: 100%;
				border: 3px solid white;
				height: 100%;
				border-radius: 100%;
				cursor: pointer;

			}
			
			.postButtn{
			float: right;
			}
			.postButtn .img-share{
				border: 2px solid white;
				border-radius: 50px;

			}
			.postButtn .img-share:hover{
				border: 2px solid navy;
			}
			.flex{
				display: flex;
			}
			.bottomPart{
				width: 100%;
				
				
			}
			.bottomPart .package{
		    	width: 100%;
		    	box-shadow: -3px 4px 6px 6px black;
		    }
		    .bottomPart .package .headerDisplayMach{
		    	width: 100%;
		    	padding-top: 5px 5px;
		    	display: flex;
		    }
		    .bottomPart .package .headerDisplayMach .round-pack-dom{
		    	width: 100px;
		    }
		    .bottomPart .package .headerDisplayMach .round-pack-dom .profile{
		    	background-color: white;
		    	
		    	width: 40px;
		    	height: 40px;
		    	border-radius: 100%;
		    }
		    .bottomPart .package .headerDisplayMach .round-pack-dom .profile .navy-border{
		    	background-color: navy;
		    	width: 100%;
		    	height: 100%;
		    	border-radius: 100%;
		    }
		    .bottomPart .package .headerDisplayMach .round-pack-dom .profile .navy-border img{
		    	width: 100%;
		    	height: 100%;
		    	border-radius: 100%;
		    	cursor: pointer;
		    	border: 2px solid white;
		    }
		    .bottomPart .package .headerDisplayMach .userName{
		    	padding: 10px 10px;
		    	font-size: 8px;
		    }
		    .bottomPart .package .headerDisplayMach .userName h5{
		    	font-size: 15px;
		    }
		    .bottomPart .package .headerDisplayMach .names{
		    	padding: 10px 10px;
		    	font-size: 8px;
		    }
		    .bottomPart .package .headerDisplayMach .names h5{
		    	font-size: 15px;
		    }
		    .bottomPart .package .headerDisplayMach .time{
		    	padding: 10px 10px;
		    	font-size: 8px;
		    }
		    .bottomPart .package .headerDisplayMach .time h5{
		    	font-size: 15px;
		    }
		    .bottomPart .package .textDisplay{
		    	width: 100%;
		    	padding: 5px 5px;
		    	
		    }
		    .bottomPart .package .textDisplay h5{
		    	font-size: 14px;
		    }
		    .bottomPart .package .textDisplay a{
		    	width: 100%;
		    }
		    .bottomPart .package .textDisplay a img{
		    	width: 100%;
		    }
		    .bottomPart .package .textDisplay video{
		    	width: 100%;
		    }
		    .bottomPart .package .displayEmogies{
		    	width: 100%;
		    	padding: 5px 5px;
		    	text-align: center;
		    	justify-content: center;
		    	align-content: center;
		    	align-items: center;
		    	align-self: center;

		    }
		    .bottomPart .package .displayEmogies .like{
		    	width: 25%;
		    	
		    	text-align: center;
		    }
		    .bottomPart .package .displayEmogies .like i{
		    	font-size: 15px;
		    	color: white;
		    }		
		</style>
		<div class="toppart">
			<?php $_1=$conn->query("select img from profilesaver where my_id='$id' ORDER BY RAND()");
			$count=0;
			$img=array();
			while($row=mysqli_fetch_array($_1)){
				if($count==2){
					break;
				}
				else{
					array_push($img,$row['img']);
					$count++;
				}
			}

			
			if($count==0){
				$dir1="../../default-img/fff.jpg";
				$dir2="../../default-img/fff.jpg";
			}
			elseif($count==1){
				$dir1="../../posts/".$id."/".$img[0];
				$dir2="../../default-img/fff.jpg";
			}
			else{
				$dir1="../../posts/".$id."/".$img[0];
				$dir2="../../posts/".$id."/".$img[1];
			}

			?>

			<div class="displayFullLength">
				<div class="border-1">
					<img src="<?php echo $dir2;?>">
				</div>
				
			</div>
			<div class="displayRound">
				<div class="border-2">
					<img src="<?php echo $dir1;?>"> 
				</div>
				
			</div>
		</div>
		<div class="postButtn flex">
			<div class="img-share" style="margin-right: 0;" title="click to upload image">
				<button type="button" class="btn" data-toggle="modal" data-target="#img_share"><i class="fa fa-upload" style="color:#f3f3f3;font-size: 15px;padding: 3px;" aria-hidden="true"></i><i class="fa fa-picture-o" style="color:#f3f3f3;font-size: 15px;padding: 3px;" aria-hidden="true"></i></button>
			</div>
			<div class="img-share" style="margin-left: 0;" title="click to upload video">
				<button type="button" class="btn" data-toggle="modal" data-target="#video_share"><i class="fa fa-upload" style="color:#f3f3f3;font-size: 15px;padding: 3px;" aria-hidden="true"></i><i class="fa fa-video-camera" style="color:#f3f3f3;font-size: 15px;padding: 3px;" aria-hidden="true"></i></button>
			</div>
		</div>
		<style >

		</style>
		<div class="bottomPart">
			<?php
			$_=$conn->query("select*from my_post where posted_by='$id' ORDER BY time_posted DESC");
			while($row=mysqli_fetch_array($_)){
				$text=$row['text'];
				$img=$row['img'];
				$video=$row['video'];
				$time_posted=$row['time_posted'];
				$posted_by=$row['posted_by'];
				$posted_by_info=$this->getOtherUser($posted_by);//array
				//print_r($posted_by_info);echo"------".$posted_by;exit();
				$dir="../../posts/".$posted_by."/".$img;
				$dirVideo="../../posts/".$posted_by."/".$video;
				$post_id=$row['post_id'];
				$profileIMG=$posted_by_info['profile_image'];
				$profileDir="";
				if($profileIMG=="empty"){
					$profileDir="../../default-img/fff.jpg";
					
				}
				else{
					$profileDir="../../posts/".$posted_by."/".$profileIMG;
				}

				?>
				<div class="package">

					<div class="headerDisplayMach">
						<center>
							<div class="round-pack-dom">
								<div class="profile" style="">
									<div class="navy-border">
										<img src="<?php echo $profileDir;?>">
									</div>
								</div>
							</div>
						</center>

						<div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<17){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
							for($i=0;$i<17;$i++){echo $bb[$i];}echo"..";
						}?></h5>
						</div>
						<div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<17){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
							for($i=0;$i<17;$i++){echo $aa[$i];}echo"..";
						}?></h5></div>
						<div class="time" ><h5><?php $this->time_Ago(strtotime($time_posted));?></h5></div>
					</div>
					<?php 
					if(!empty($text)){
						?>
					<div class="textDisplay">
						<h5><?php echo $text;?></h5>
					</div>

						<?php
					}
					if($img!=0){
						?>
						<div class="textDisplay">
							<a href="<?php echo $dir;?>"><img src="<?php echo $dir;?>"></a>
						</div>
						
						<?php
					}
					else{

						if($video!=0){
							?>
							<div class="textDisplay">
							    <video controls>
							    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
							    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
							    </video>
							</div>
							<?php
						}
					}
					?>
					<center>
						<div class="displayEmogies flex" >
							<div class="like flex"  >
								<i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $this->getNumViews($post_id);?></small>
							</div>
							<div class="like flex"  >
								<i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $this->getNumDislike($post_id);?></small>
							</div>
							<div class="like flex" >
								<i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $this->getNumLikes($post_id);?></small>
							</div>
							<div class="like flex" >
								<i class="fa fa-comment" aria-hidden="true"></i><small id="<?php echo "_".$post_id;?>"><?php echo $this->getNumLikes($post_id);?></small>
							</div>
						</div>
					</center>
						
				</div>
			
				<br>
				<?php
			}
			?>
			
		</div>
		<?php
	}
	private function getNumViews($post_id){
		global $conn;
		$num=$conn->query("select*from views where post_id='$post_id'");
		return $num->num_rows;
	}
	private function getNumDislike($post_id){
		global $conn;
		$num=$conn->query("select*from dislikes where post_id='$post_id'");
		return $num->num_rows;
	}
	private function getNumLikes($post_id){
		global $conn;
		$num=$conn->query("select*from likes where post_id='$post_id'");
		return $num->num_rows;
	}
	private function getNumOfReply($post_id){
		global $conn;
		$num=$conn->query("select*from studyareareply where post_id='$post_id'");
		return $num->num_rows;
	}
	// protected function messages($cur_user_row){
	// 	global $conn;
	// 	echo "messages";
	// }
	protected function livePublicChats($cur_user_row){
		global $conn;
		$id=$cur_user_row['my_id'];
		?>
		<style>
.messageBox{
    	width: 100%;
    	height: 92.5%;
    	 
    	overflow-x:auto;
    	
      overflow-wrap: break-word;
      word-wrap: break-word;
      
      border-radius: 10px;
      background-color: none;
     hyphens: auto;
      /*--------------------*/
 		color: #f3f3f3;

    }
    .messageBox .talk-bubble{
    	display: block;
    	position: relative;
    	width: 50%;
    	color: #000;
    	margin-left: 47%;
    	padding: 10px 0;

    }
    .messageBox .talk-bubble .my_text{
    	background-color: lightgrey;
    	border-radius: 8px;
    }
    .messageBox .talk-bubble .prof{
    	width: 100%;
    	cursor: pointer;
    }
    .messageBox .talk-bubble .prof .img{
    	width: 15%;
    	border-radius: 100%;
    	border: 1px solid red;
    	height: 38px;
    }
    .messageBox .talk-bubble .prof .me{
    	padding: 10px 8px;
    	cursor: pointer;
    }
   	.messageBox .talk-bubble .prof .img img{
    	width: 100%;
    	height: 100%;
    	border-radius: 100%;
    }
    .messageBox .talk-bubbleb{
    	display: block;
    	position: relative;
    	width: 50%;
    	color: #000;
    	margin-left: 2%;
    	padding: 10px 0;
    }
    .messageBox .talk-bubbleb .my_text{
    	background-color: lightsteelblue;
    	border-radius: 8px;
    }
    .messageBox .talk-bubbleb .prof{
    	width: 100%;
    	cursor: pointer;
    }
    .messageBox .talk-bubbleb .prof .img{
    	width: 15%;
    	border-radius: 100%;
    	height: 38px;
    	    }
    .messageBox .talk-bubbleb .prof .me{
    	padding: 10px 8px;
    	cursor: pointer;
    }
    .messageBox .talk-bubbleb .prof .img img{
    	width: 100%;
    	height: 98%;
    	border-radius: 100%;	
    }
    .submitBot{
    	width: 100%;
    	height: 6%;
    	background-color: none;

    }
    .submitBot #fa:hover{
    	color: navy;
    }
    .submitBot #fa{
    	font-size: 30px;
 		color: #f3f3f3;
 	}
    .submitBot .chat-center{
    	width: 89%;
    	height: 100%;
    	background-color: none;


    }
   	.submitBot .chat-center .chatArea{
    	width: 100%;
    	height: 40px;
    	border: none;
    	
    	border-bottom: 1px solid #f3f3;
    	max-height: 60px;
    	min-height: 40px;
    	min-width: 100%;
    	max-width: 100%;

    	
	 	color: #f3f3f3;
	 	background-color: #222;
    }
    .submitBot .submitButton{
    	width: 10%;
    	height: 100%;
    }
    .submitBot .submitButton .chatSubmit{
    	width: 100%;
    	height: 40px;
    	background-color:blue;
    	border: none;
    }
    .submitBot .submitButton .chatSubmit:hover{
  		background-color: navy;
    }
    .submitBot .submitButton .chatSubmit #faa{
    	font-size: 25px;
    	color: #f3f3f3;
    }
    .postButtn{
    	width: 100%;
    	padding: 10px;
    }
    
    .postButtn .img-share .btn{

    	background-color: navy;
    	color: #f3f3f3;
    	margin-left: 100%;
    	cursor: pointer;

    }
    .postButtn .img-share .btn:hover{
    	background-color: seagreen;
    }
    .postButtn .img-share- .btn{

    	background-color: navy;
    	color: #f3f3f3;
    	margin-left: 100%;
    	cursor: pointer;

    }
    .postButtn .img-share- .btn:hover{
    	background-color: seagreen;
    }
		</style>
		<div class="messageBox" id="m"></div>
		<div class="submitBot flex">
			<div class="imgOption" data-toggle="modal" data-target="#fileUploadLive"><i title="Add Image On your Text.. "  class="fa fa-picture-o" id="fa" aria-hidden="true"></i></div>
			<div class="chat-center"><textarea title="Type your message here..." class="chatArea" placeholder="Type Your Message..."></textarea></div>
			<div class="submitButton"><button class="chatSubmit" title="send your message.."><i class="fa fa-send-o" id="faa" aria-hidden="true"></i></button></div>
		</div>
		<script type="text/javascript">
			autoReload();
			
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
			    $(".messageBox").mouseover(
                  function () {
                    $(this).addClass("active");
                  },
                  function () {
                    $(this).removeClass("active");
                  }
                );
                $(".chatSubmit").click(function(){
            		const mess=$(".chatArea").val();
            		if(mess==""){
            			$(".chatArea").attr("placeholder","CAN NOT SEND EMPTY MESSAGE!!.. ");
            		}
            		else{
            			$(".chatArea").val("");
            			$.ajax({
            				url:"controler/upload.php?live_chat=1",
            				type:"POST",
            				data:{mess:mess},
            				cache:false,
            				beforeSend:function(){
            					$(".chatArea").attr("placeholder","Sending Message...");
            				},
            				success:function(e){
            					console.log(e.length);
            					if(e.length>2){
            						$(".submitBot").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
            						$(".submitBot").html(" <br>Error 320 : "+e);
            					}
            					else{
            						$(".chatArea").attr("placeholder","Type Your Message ...");
            					}
            				}
            			});
            		}
            	});
			});
			
		</script>
		<?php
	}
	protected function latestNews($cur_user_row){
		global $conn;
		$this->sgelaNews($cur_user_row['my_id']);
	}
	protected function SportsNews($cur_user_row){
		global $conn;
		$this->sportNews($cur_user_row['my_id']);
	}
	protected function shisanyama($cur_user_row){
		global $conn;
		echo "shisanyama";
	}
	
	protected function isAssignmentId($ass_id){
        global $conn;
        $_=$conn->query("select*from assignment where ass_id='$ass_id'");
	    return ($_->num_rows==1);
    }
    protected function isSubmitted($ass_id,$std){
        global $conn;
        $_=$conn->query("select*from assignment_submission where ass_id='$ass_id' AND std_id='$std'");
	    return ($_->num_rows==1);
    }
    public function assignments($id){
        global $conn;
        if(isset($_GET["a_id"])){
            $ass_id=$_GET['a_id'];
            if($this->isAssignmentId($ass_id)){
                $assignment=mysqli_fetch_array($conn->query("select*from assignment where ass_id='$ass_id'"));
                $std_inf=$this->getStudentInfo($id);
                $dir="../../posts/".$assignment['school_id']."/".$assignment['subj_id']."/assignments/".$assignment['assignment'];
                $k=0;
                if($this->isSubmitted($ass_id,$std_inf['student_id'])){
                    $k=1;
                }
                ?>
                <div class="decoMall">
                    <div class="grand4">
                        <div class="container">
                          <h2>Assignment Info</h2>
                                    
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th style="color:orangered;">Assignment</th>
                                <th style="color:red;">Due Date</th>
                                <th style="color:orangered;">IsSubmitted</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="color:orangered;"><?php echo $assignment["name"];?></td>
                                <td style="color:red;"><?php echo $assignment["due_date"]."|".$assignment["due_time"];?></td>
                                <td style="color:orangered;"><?php if($k==1){echo "Yes";}else{echo "No";}?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        
                        <div class="download" >
                            <?php if($k==0){
                            ?>
                            <a href="<?php echo $dir;?>" download disabled><button style="color:#f3f3f3;background-color:navy;padding:10px;" class="btn mavel"> Download <?php echo $assignment["name"];?></button></a>
                            <?php
                            }
                            else{
                                ?>
                                <button style="color:#f3f3f3;background-color:navy;padding:10px;" class="btn mavel"> Already Submitted <?php echo $assignment["name"];?></button>
                                <?php
                            }
                            ?>
                            
                        </div>
                        
                        <?php
                        if($k==0){
                            ?>
                            <br><br>
                            <h2>Submit Your Assignment</h2>
                            <?php
                            $school_id=$assignment['school_id'];
                            $subj_id=$assignment['subj_id'];
                            $ass_id=$assignment['ass_id'];
                            // $assignment
                            // $std_inf
                            ?>
                            <input type="hidden" value="<?php echo $school_id;?>" id="school_id">
                            <input type="hidden" value="<?php echo $subj_id;?>" id="subj_id">
                            <input type="hidden" value="<?php echo $ass_id;?>" id="ass_id">
                            <div class="demoGran" style="padding:5px">
                                <input id="submitting" type="file">
                            </div>
                            
                            <div class="demoGran">
                                <button class="btn smack" style="color:#f3f3f3;padding:10px;background-color:navy;" type="button">Submit <?php echo $assignment["name"];?></button>
                            </div>
                            <div class="errorNech" hidden>
                                
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $(".smack").click(function(){
                		const school_id=$("#school_id").val();
                		const subj_id=$("#subj_id").val();
                		const ass_id=$("#ass_id").val();
                        const submitting=$("#submitting").val();
                		// console.log(studyAreaMathTextReply);
                		
                		if(submitting==""){
                			$(".errorNech").removeAttr("hidden");
                			$(".errorNech").html("<small style='color:red;'>Cannot send empty file/Text!!..</small>");
                		}
                		else{
                			var form_data=new FormData();
                			var file="";
                			if(submitting!=""){
                				file=document.getElementById('submitting').files[0].name;
                			}
                			var ext=file.split('.').pop().toLowerCase();
                			const array=["pdf","PDF","DOCX","docx","xlxs","XLXS","xlx","XLX","png","jpg","jpeng","heic","jpeg","MV","PNG","JPG","HEIC","JPEG","gif","GIF"];
                			if(jQuery.inArray(ext,array)==-1 && file!=""){
                				$(".errorNech").removeAttr("hidden");
                				$(".errorNech").html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic,pdf,xlxs,docx} Format </small>");
                
                			}
                			else{
                				if(submitting!=""){
                					form_data.append("file",document.getElementById("submitting").files[0]);
                				}
                				else{
                					form_data.append("file",file);
                				}
                				form_data.append("school_id",school_id);
                				form_data.append("subj_id",subj_id);
                				form_data.append("ass_id",ass_id);
                				$(".errorNech").removeAttr("hidden");
                				$(".errorNech").html("<small><img style='width:8%;' src='img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
                				$.ajax({
                					url:"../../posts/upload.php?submit_assignment",
                					type:"POST",
                					data:form_data,
                					contentType:false,
                					cache:false,
                					processData:false,
                					beforeSend:function(){
                						$(".errorNech").removeAttr("hidden");
                						$(".errorNech").html("<img style='width:10%;' src='img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
                					},
                					success:function(e){
                						console.log(e);
                						console.log(e.length);
                						if(e.length>2){
                							$(".errorNech").removeAttr("hidden");
                							$(".errorNech").attr("style","color:red;");
                							$(".errorNech").html(" "+e);
                						}
                						else{
                							$(".errorNech").removeAttr("hidden");
                							$(".errorNech").html("<small style='color:green;'> Assignment Submitedd Successfully</small>");
                							$("#submitting").val("");
                							
                							window.location=("./?_=assignment&a_id="+ass_id);
                							
                						}
                					}
                				});
                			}
                		}
                	});
                    });
                </script>
                <?php
            }
            else{
                ?>
                <h3 style="color:red;">Query not Found!..</h3>
                <?php
            }
        }
        else{
            ?>
            <h3 style="color:red;">No such Refference Exist!!</h3>
            <?php
        }
    }
	public function getAllSchoolsSA(){
		global $conn;
		$_=$conn->query("select*from highschools");
		?>
			<option value=""> -- Select School --</option>
		<?php
		while ($row=mysqli_fetch_array($_)) {
			?>
			<option value="<?php echo $row['id']?>"> <?php echo $row['school'];?></option>
			<?php
		}
	}
	protected function matricUpgrade($cur_user_row){
		global $conn;
		if(!$this->isRegistered($cur_user_row['my_id'])){
			?>
			<style>
				.ropw{
					border:1px solid white;
					padding: 3px 3px;
				}
				.ropw .full-tc-page{
					/*border: 2px solid navy;
					background-color: #212121;*/
					width: 100%;
					border: 1px solid navy;
					padding: 4px 4px;

				}
				.ropw .full-tc-page .regForm{
					width: 100%;
					border: 1px solid white;
					padding: 4px 4px;
				}
				.ropw .full-tc-page .regForm table{
					width: 100%;
				}
				.ropw .full-tc-page .regForm table .td{
					width: 30%;
					padding: 6px 6px;
				}
				.ropw .full-tc-page .regForm table #td{
					width: 70%;
					padding: 6px 6px;
				}
				.ropw .full-tc-page .regForm table td input,select{
					width: 100%;
					padding: 4px 5px;
					cursor: pointer;
					color: white;
					background-color: #212121;
				}
				.ropw .full-tc-page .regForm .btn-mac{
					padding: 15px 15px;
					/*border: 2px solid navy;*/
				}
				.ropw .full-tc-page .regForm .btn-mac .btn{
					border: 2px solid white;
					color: white;
					padding: 5px 5px;
					border-radius: 50px;
					font-size: 15px;
				}
				.ropw .full-tc-page .regForm .btn-mac .btn:hover{
					border: 2px solid navy;
					color: navy;

				}

			</style>
		<div class="ropw" >
			<div class="full-tc-page">
				<h2>Register to start learning</h2>
				<div class="regForm">
					<table>
						<tr>
							<td class="id">Name</td>
							<td id="id"><input placeholder="First Name" type="text" class="nameMatricUpgrade"></td>
							
							
						</tr>
						<tr>
							<td class="id">Surname</td>
							<td id="id"><input placeholder="Last Name" type="text" class="surnameMatricUpgrade"></td>
							
						</tr>
						<tr>
							<td class="id">SA ID No</td>
							<td id="id"><input placeholder="SA ID Number" type="number" class="idNumMatricUpgrade"></td>
							
						</tr>
						<tr>
							<td class="id">Phone Number</td>
							<td id="id"><input placeholder="SA Phone Number" type="number" class="phoneMatricUpgrade"></td>
							
						</tr>
						<tr>
							<td class="id">Email Address</td>
							<td id="id"><input placeholder="Email Address" type="email" class="emailMatricUpgrade"></td>
							
						</tr>
						<tr>
							<td class="id">School Registered At</td>
							<td id="id"><select class="SchoolsSA">
								<?php $this->getAllSchoolsSA();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 1</td>
							<td id="id"><select class="subj1MatricUpgrade">

								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 2</td>
							<td id="id"><select class="subj2MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 3</td>
							<td id="id"><select class="subj3MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 4</td>
							<td id="id"><select class="subj4MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 5</td>
							<td id="id"><select class="subj5MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 6</td>
							<td id="id"><select class="subj6MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 7</td>
							<td id="id"><select class="subj7MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 8</td>
							<td id="id"><select class="subj8MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 9</td>
							<td id="id"><select class="subj9MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 10</td>
							<td id="id"><select class="subj10MatricUpgrade">
								
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						
					</table>
					<div class="btn-mac">
						<button class="btn submitMatricReWriteReg">Register</button>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$(".submitMatricReWriteReg").click(function(){
					
					const SchoolsSA=$(".SchoolsSA").val();
					const nameMatricUpgrade=$(".nameMatricUpgrade").val();
					const surnameMatricUpgrade=$(".surnameMatricUpgrade").val();
					const idNumMatricUpgrade=$(".idNumMatricUpgrade").val();
					const phoneMatricUpgrade=$(".phoneMatricUpgrade").val();
					const emailMatricUpgrade=$(".emailMatricUpgrade").val();
					const subj1MatricUpgrade=$(".subj1MatricUpgrade").val();
					const subj2MatricUpgrade=$(".subj2MatricUpgrade").val();
					const subj3MatricUpgrade=$(".subj3MatricUpgrade").val();
					const subj4MatricUpgrade=$(".subj4MatricUpgrade").val();
					const subj5MatricUpgrade=$(".subj5MatricUpgrade").val();
					const subj6MatricUpgrade=$(".subj6MatricUpgrade").val();
					const subj7MatricUpgrade=$(".subj7MatricUpgrade").val();
					const subj8MatricUpgrade=$(".subj8MatricUpgrade").val();
					const subj9MatricUpgrade=$(".subj9MatricUpgrade").val();
					const subj10MatricUpgrade=$(".subj10MatricUpgrade").val();
					var error=0;
					if(nameMatricUpgrade==""){
						$(".nameMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(surnameMatricUpgrade==""){
						$(".surnameMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(idNumMatricUpgrade==""){
						$(".idNumMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(phoneMatricUpgrade==""){
						$(".phoneMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(emailMatricUpgrade==""){
						$(".emailMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(subj1MatricUpgrade==""){
						$(".subj1MatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(SchoolsSA==""){
						$(".SchoolsSA").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(error==1){
						$(".submitMatricReWriteReg").attr("style","color:red;border:2px solid red;");
					}
					else{
						$(".submitMatricReWriteReg").attr("style","background-color:#000;color:green;padding:5px;opacity:.8;border:2px solid green");
						$(".submitMatricReWriteReg").html("Processing...");
						$.ajax({
							url:"controler/upload.php",
							type:"POST",
							data:{
								nameMatricUpgrade:nameMatricUpgrade,
								surnameMatricUpgrade:surnameMatricUpgrade,
								idNumMatricUpgrade:idNumMatricUpgrade,
								phoneMatricUpgrade:phoneMatricUpgrade,
								emailMatricUpgrade:emailMatricUpgrade,
								subj1MatricUpgrade:subj1MatricUpgrade,
								subj2MatricUpgrade:subj2MatricUpgrade,
								subj3MatricUpgrade:subj3MatricUpgrade,
								subj4MatricUpgrade:subj4MatricUpgrade,
								subj5MatricUpgrade:subj5MatricUpgrade,
								subj6MatricUpgrade:subj6MatricUpgrade,
								subj7MatricUpgrade:subj7MatricUpgrade,
								subj8MatricUpgrade:subj8MatricUpgrade,
								subj9MatricUpgrade:subj9MatricUpgrade,
								subj10MatricUpgrade:subj10MatricUpgrade,
								SchoolsSA:SchoolsSA
							},
							cache:false,
							beforeSend:function(){
								$(".submitMatricReWriteReg").html("<img style='width:10%;' src='../../default-img/loader.gif'><span style='color:green;'>UPLOADING..</span>");
							},
							success:function(e){
								console.log(e.length);
								if(e.length>2){
									$(".submitMatricReWriteReg").attr("style","background-color:#000;border:1pxsolid red;color:red;padding:5px;opacity:.8;");
									$(".submitMatricReWriteReg").html("Suspense 320 : "+e);
								}
								else{
									$(".submitMatricReWriteReg").html("<small style='color:green;'>Registration Successful..</small>");
									$(".nameMatricUpgrade").val("");
									$(".surnameMatricUpgrade").val("");
									$(".idNumMatricUpgrade").val("");
									$(".phoneMatricUpgrade").val("");
									$(".emailMatricUpgrade").val("");
									$(".subj1MatricUpgrade").val("");
									$(".subj2MatricUpgrade").val("");
									$(".subj3MatricUpgrade").val("");
									$(".subj4MatricUpgrade").val("");
									$(".subj5MatricUpgrade").val("");
									$(".subj6MatricUpgrade").val("");
									$(".subj7MatricUpgrade").val("");
									$(".subj8MatricUpgrade").val("");
									$(".subj9MatricUpgrade").val("");
									$(".subj10MatricUpgrade").val("");
									$(".SchoolsSA").val();
									window.location=("./?_=matricUpgrade");
								}
							}
						});
					}
				});
			});
		</script>
		
			<?php
		}
		elseif(isset($_GET['_upgrade_'])&&!empty($_GET['_upgrade_'])){
			?>
			<style>
				.medLocker{
        		        
        		        width:100%;
        		        
        		        /*hyphens: auto;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;*/
                        
                        color:#f3f3f3;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
			</style>
			<div class="medLocker">
				<?php
				$getSubjInfo=$this->getMatricSubjInfo($_GET['_upgrade_']);
				// print_r($array[$i]);
				$subj_id=$getSubjInfo['subj_id'];
				$subj_name=$getSubjInfo['subject'];
				$dir="../../default-img/a.png";
				?>
				<div class="bodyCamp" onclick="na2thisterm(1,<?php echo $_GET['_upgrade_'];?>)">
		            <div class="radeMos">
		                <div class="img-kMover">
	    		            <img src="<?php echo $dir;?>">
	    		        </div>
	    		        <div class="maxcKood">
	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 1</span></small></div>
	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
	    		        </div>
		            </div>
			    </div>
			    <div class="bodyCamp" onclick="na2thisterm(2,<?php echo $_GET['_upgrade_'];?>)">
		            <div class="radeMos">
		                <div class="img-kMover">
	    		            <img src="<?php echo $dir;?>">
	    		        </div>
	    		        <div class="maxcKood">
	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 2</span></small></div>
	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
	    		        </div>
		            </div>
			    </div>
			    <div class="bodyCamp" onclick="na2thisterm(3,<?php echo $_GET['_upgrade_'];?>)">
		            <div class="radeMos">
		                <div class="img-kMover">
	    		            <img src="<?php echo $dir;?>">
	    		        </div>
	    		        <div class="maxcKood">
	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 3</span></small></div>
	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
	    		        </div>
		            </div>
			    </div>
			    <div class="bodyCamp" onclick="na2thisterm(4,<?php echo $_GET['_upgrade_'];?>)">
		            <div class="radeMos">
		                <div class="img-kMover">
	    		            <img src="<?php echo $dir;?>">
	    		        </div>
	    		        <div class="maxcKood">
	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 4</span></small></div>
	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
	    		        </div>
		            </div>
			    </div>
	    	</div>
	    	<script>
	    		function na2thisterm(term,subj_id){
	    			window.location=("./?_=matricUpgrade&term="+term+"-"+subj_id);
	    		}
	    	</script>

		<?php
		}
		elseif(isset($_GET['term'])&&!empty($_GET['term'])){
			$tmp=explode("-",$_GET['term']);
			$term=$tmp[0];
			$subj_id=$tmp[1];
			echo "TERM : ".$term."<br>Subj : ".$subj_id;
		}
		else{
			?>
			<style>
				.medLocker{
        		        
        		        width:100%;
        		        
        		        /*hyphens: auto;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;*/
                        
                        color:#f3f3f3;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
		</style>
		<div class="medLocker">
			<?php
			$getAllInfoOfMatricReWriteLearner=$this->getAllInfoOfMatricReWriteLearner($cur_user_row['my_id']);
			$array=array();
			for ($i=0;$i<10;$i++){
				$subj_id=$getAllInfoOfMatricReWriteLearner[7+$i];
				if(!empty($subj_id)){
					array_push($array,$subj_id);
				}
			}
			for ($i=0;$i<sizeof($array);$i++){
				$getSubjInfo=$this->getMatricSubjInfo($array[$i]);
				// print_r($array[$i]);
				$subj_id=$getSubjInfo['subj_id'];
				$subj_name=$getSubjInfo['subject'];
				$dir="../../default-img/a.png";
				?>
				<div class="bodyCamp" onclick="na2thisSubj(<?php echo $subj_id;?>)">
		            <div class="radeMos">
		                <div class="img-kMover">
        		            <img src="<?php echo $dir;?>">
        		        </div>
        		        <div class="maxcKood">
        		            <div><small><?php echo $subj_name;?></small></div>
        		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
        		        </div>
		            </div>
    		    </div>	
				<?php
			}
		?>
		</div>
		<script>
			function na2thisSubj(id){
				window.location=("./?_=matricUpgrade&_upgrade_="+id);
			}
		</script>
		<?php
		}
	}
	protected function getMatricSubjInfo($subj_id){
		global $conn;
		return mysqli_fetch_array($conn->query("select*from matricsubjects where subj_id='$subj_id'"));
	}
	protected function getAllInfoOfMatricReWriteLearner($id){
		global $conn;
		return mysqli_fetch_array($conn->query("select*from matricupgrade where my_id='$id'"));

	}
	protected function getAllSubjectMatric(){
		global $conn;
		?>
		<option value=""> -- Select Subject --</option>
		<?php
		$_=$conn->query("select*from matricsubjects");
		while ($row=mysqli_fetch_array($_)){
			$subj_id=$row["subj_id"];
			$subj=$row["subject"];
			?>
			<option value="<?php echo $subj_id;?>">
				<?php echo $subj;?>
			</option>
			<?php
		}
	}
	protected function isRegistered($my_id){
		global $conn;
		$_="select my_id from matricupgrade where my_id=? LIMIT 1";
		$stmt = $conn->prepare($_);
		$stmt->bind_param("s", $my_id);
		$stmt->execute();
		$stmt->bind_result($my_id);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		return ($rnum==1);
	}
	protected function time_Ago($time) { 
	    $diff     = time() - $time; 
	    $sec     = $diff; 
	      
	    // Convert time difference in minutes 
	    $min     = round($diff / 60 ); 
	      
	    // Convert time difference in hours 
	    $hrs     = round($diff / 3600); 
	      
	    // Convert time difference in days 
	    $days     = round($diff / 86400 ); 
	      
	    // Convert time difference in weeks 
	    $weeks     = round($diff / 604800); 
	      
	    // Convert time difference in months 
	    $mnths     = round($diff / 2600640 ); 
	      
	    // Convert time difference in years 
	    $yrs     = round($diff / 31207680 ); 
	      
	    // Check for seconds 
	    if($sec <= 60) { 
	        echo "s ago"; 
	    } 
	      
	    // Check for minutes 
	    else if($min <= 60) { 
	        if($min==1) { 
	            echo $min." m ago"; 
	        } 
	        else { 
	            echo "$min m ago"; 
	        } 
	    } 
	      
	    // Check for hours 
	    else if($hrs <= 24) { 
	        if($hrs == 1) {  
	            echo "hr ago"; 
	        } 
	        else { 
	            echo "$hrs hrs ago"; 
	        } 
	    } 
	      
	    // Check for days 
	    else if($days <= 7) { 
	        if($days == 1) { 
	            echo "Yest"; 
	        } 
	        else { 
	            echo "$days d ago"; 
	        } 
	    } 
	      
	    // Check for weeks 
	    else if($weeks <= 4.3) { 
	        if($weeks == 1) { 
	            echo "a w ago"; 
	        } 
	        else { 
	            echo "$weeks w ago"; 
	        } 
	    } 
	      
	    // Check for months 
	    else if($mnths <= 12) { 
	        if($mnths == 1) { 
	            echo "a mn ago"; 
	        } 
	        else { 
	            echo "$mnths mn ago"; 
	        } 
	    }  
	    else { 
	        if($yrs == 1) { 
	            echo $yrs." y ago"; 
	        } 
	        else { 
	            echo "$yrs ys ago"; 
	        } 
	    } 
	}
	protected function isIDExists($id){
	    global $conn;
	    $_=$conn->query("select my_id from create_runaccount where my_id='$id' limit 1");
	    return $_->num_rows;
	}
	protected function view_profile($id){
	    global $conn;
	    if(isset($_GET['_1_'])&&!empty($_GET['_1_'])){
	        $target_ip=$_GET['_1_'];
	        if($this->isIDExists($target_ip)){
	            $target_info=mysqli_fetch_array($conn->query("select*from create_runaccount where my_id='$target_ip'"));
	            $dir="../../posts/".$target_info['my_id']."/".$target_info['profile_image'];
	            if($target_info['profile_image']=="empty"){
	                $dir="../../default-img/fff.jpg";
	            }
	            ?>
	            <div class="tag-image-thru" style="width:100%;">
	                <img src="<?php echo $dir;?>" style="width:100%;">
	            </div><br>
	            <div class="personalInfo">
	                <h4>ABOUT :<?php echo $target_info['name']." ".$target_info['surname'];?></h4>
	                <h4>
	                    <p><i class="fa fa-user-circle" style="font-size:25px;color:red;"></i>: <?php echo $target_info['username'];?></p>
	                    <p>Gender : <?php echo $target_info['gender'].", Joined : ". $target_info['time_posted']; ?></p>
	                    <p>DOB : <?php echo $target_info['date_of_birth'].", Age : ";
	                    $a=strtotime(date('Y-m-d')); 
	                    $b=strtotime($target_info['date_of_birth']);
	                    $diff=abs($a-$b);echo floor($diff / (365*60*60*24));?></p>
	                    <?php
	                    if($target_info['promaths']=='Yes'){
	                        echo"<p> Promaths Alumni </p>";
	                    }
	                    ?>
	                    
	                </h4>
	                <hr style="font-size:8px;color:#fff;">
	                <h4>Shared Story : </h4>
	                <h4><p><?php $ss=$target_info['about'];
	                if(empty($ss)){
	                    echo "Has not shared a life story yet!!";
	                }
	                else{
	                    echo $ss;
	                }
	                ?></p></h4>
	            </div>
	            <div class="barowo">
	                <h4>View <?php echo " ".$target_info['name']." ".$target_info['surname']." ";?> Posts</h4>
	                <style>
			.bottomPart{
				width: 100%;	
			}
			.bottomPart .package{
				width: 100%;
				box-shadow: -3px 4px 6px 6px black;
			}
			.bottomPart .package a{
				width: 100%;
			}
			.bottomPart .package a .headerDisplayMach{
				width: 100%;
				display: flex;
				padding: 5px 5px;
			}
			.bottomPart .package a .headerDisplayMach .profile{
				width: 40px;
				height: 40px;
				border: 2px solid white;
				border-radius: 100%;
				
			}
			.bottomPart .package a .headerDisplayMach .profile img{
				width: 100%;
				height: 100%;
				width: 100%;
				border-radius: 100%;
			}
			.bottomPart .package .headerDisplayMach .userName{
		    	padding: 10px 10px;
		    	font-size: 8px;
		    }
		    .bottomPart .package .headerDisplayMach .userName h5{
		    	font-size: 15px;
		    }
		    .bottomPart .package .headerDisplayMach .names{
		    	padding: 10px 10px;
		    	font-size: 8px;
		    }
		    .bottomPart .package .headerDisplayMach .names h5{
		    	font-size: 15px;
		    }
		    .bottomPart .package .headerDisplayMach .time{
		    	padding: 10px 10px;
		    	font-size: 8px;
		    }
		    .bottomPart .package .headerDisplayMach .time h5{
		    	font-size: 15px;
		    }
		    .bottomPart .package .textDisplay{
		    	width: 100%;
		    	padding: 5px 5px;
		    	cursor: pointer;
		    }
		    .bottomPart .package .textDisplay h5{
		    	font-size: 14px;
		    }
		    .bottomPart .package .textDisplay{
		    	width: 100%;
		    }
		    .bottomPart .package .textDisplay img{
		    	width: 100%;
		    }
		    .bottomPart .package .textDisplay video{
		    	width: 100%;
		    }
		    .bottomPart .package .displayEmogies{
		    	width: 100%;
		    	padding: 5px 5px;
		    	text-align: center;
		    	justify-content: center;
		    	align-content: center;
		    	align-items: center;
		    	align-self: center;
		    	display: flex;

		    }
		    .bottomPart .package .displayEmogies .like{
		    	width: 25%;
		    	
		    	text-align: center;
		    }
		    .bottomPart .package .displayEmogies .like i{
		    	font-size: 15px;
		    	color: white;
		    }

		</style>
		<div class="bottomPart">
			<?php
	                $_=$conn->query("select*from my_post where posted_by='$target_ip' ORDER BY time_posted DESC");
	                while($row=mysqli_fetch_array($_)){
	                    
	                    $text=$row['text'];
            			$img=$row['img'];
            			$video=$row['video'];
            			$time_posted=$row['time_posted'];
            			$posted_by=$row['posted_by'];
            			$posted_by_info=$this->getOtherUser($posted_by);//array
            			$dir="../../posts/".$posted_by."/".$img;
            			$dirVideo="../../posts/".$posted_by."/".$video;
            			$profileIMG=$posted_by_info['profile_image'];
            			$profileDir="";
            			$post_id=$row['post_id'];
            			if($profileIMG=="empty"){
            				$profileDir="../../default-img/fff.jpg";
            				
            			}
            			else{
            				$profileDir="../../posts/".$posted_by."/".$profileIMG;
            			}
            			$target_ip=$posted_by;
                        
            			?>
            			<div class="package">
            				<a ><div class="headerDisplayMach" style="cursor:pointer;">
            						<div class="profile"><img src="<?php echo $profileDir;?>"></div>
            						<div class="userName" ><h5><?php if(strlen($posted_by_info['username'])<15){echo $posted_by_info['username'];}else{$bb=$posted_by_info['username'];
            							for($i=0;$i<15;$i++){echo $bb[$i];}echo"..";
            						}?></h5></div>
            						<div class="names" ><h5><?php if(strlen($posted_by_info['name']."_".$posted_by_info['surname'])<15){echo $posted_by_info['name']."_".$posted_by_info['surname'];}else{$aa=$posted_by_info['name']."_".$posted_by_info['surname'];
            							for($i=0;$i<15;$i++){echo $aa[$i];}echo"..";
            						}?></h5></div>
            						<div class="time" ><h5><?php $this->time_Ago(strtotime($time_posted));?></h5></div>
            					</div></a>
            					<?php 
            					if(!empty($text)){
            						?>
            					<div class="textDisplay" data-toggle="modal" data-target="#viewAddComments" onclick="fetchData(<?php echo $post_id; ?>)">
            						<h5><?php echo $text;?></h5>
            					</div>
            
            						<?php
            					}
            					if($img!=0){
            						?>
            						<div class="textDisplay" data-toggle="modal" data-target="#viewAddComments" onclick="fetchData(<?php echo $post_id; ?>)">
            							<img src="<?php echo $dir;?>">
            						</div>
            						
            						<?php
            					}
            					else{
            
            						if($video!=0){
            							?>
            							<div class="textDisplay" data-toggle="modal" data-target="#viewAddComments" onclick="fetchData(<?php echo $post_id; ?>)">
            							    <video controls>
            							    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
            							    	<source src="<?php echo $dirVideo;?>" type="video/mp4">
            							    </video>
            							</div>
            							
            							<?php
            						}
            					}
            					?>
            					<div class="displayEmogies flex" >
            					    	<div class="like flex"  data-toggle="modal" data-target="#viewAddComments" onclick="fetchData(<?php echo $post_id; ?>)">
            							<i class="fa fa-comment" aria-hidden="true"></i><small><?php echo $this->getNumComments($post_id);?></small>
            						</div>
            						<div class="like flex"  >
            							<i class="fa fa-eye" aria-hidden="true"></i><small><?php echo $this->getNumViews($post_id);?></small>
            						</div>
            						<div class="like flex"  >
            							<i class="fa fa-thumbs-down" onclick="DislikePost(<?php echo $post_id;?>);" aria-hidden="true"></i><small id="<?php echo $post_id;?>"><?php echo $this->getNumDislike($post_id);?></small>
            						</div>
            						<div class="like flex" >
            							<i class="fa fa-thumbs-up" aria-hidden="true" onclick="likePost(<?php echo $post_id;?>);"></i><small id="<?php echo "_".$post_id;?>"><?php echo $this->getNumLikes($post_id);?></small>
            						</div>
            					</div>
            				</div>
            			<br>
	                    <?php
	                }
	                ?>
		</div>
	                
	            </div>
	            <?php
	        }
	        else{
	            ?>
	            <script>
    	            window.location=("./");
    	        </script>
	            <?php
	        }
	    }
	    else{
	        ?>
	        <script>
	            window.location=("./");
	        </script>
	        <?php
	    }
	}
	// Application new
/*
=	=	=	=	=	=	=	=	=	=	=	=	=	=
=													=
=													=
=													=
=													=
=													=	
=													=
=													=	
=													=
=													=	
=	=	=	=	=	=	=	=	=	=	=	=	=	=							
*/
	public function applicationsId(){
		return md5(rand(00000000,99999999));
	}
	protected function play($id){
		global $conn;
		
		$_=$conn->query("select*from testing where my_id='$id'");
		if($_->num_rows==1){
			$this->continueApplication($this->getApplicationLevel($id));
		}
		else{
			$this->beginApplication($id);
		}

	}
	protected function getApplicationLevel($id){
		global $conn;
		return mysqli_fetch_array($conn->query("select*from testing where my_id='$id'")); 
	}
	protected function isLevelIsComplete($level){
		return ($level=="complete");
	}
	protected function continueApplication($array){
		if($this->isLevelIsComplete($array['level'])){
			$this->levelIsCmplete($array['my_id']);
		}
		else{
			$this->continueapp($array);
		}
	}
	protected function levelIsCmplete($id){
		include_once("model/isLevelIsComplete.php");//completed aplication navigate here
		$contApp=new isLevelIsComplete();
		$contApp->isLevelIsComplete($id);
	}
	protected function continueapp($array){
		include_once("model/continueLevelApp.php");//incomplete applications navigate here
		$contApp=new continueLevelApp();
		$contApp->continueapp($array);
	}
	protected function beginApplication($id){
		?>
		<style>
		    .foApply{
		        width:100%;
		        text-align:left;
		        color:#f3f3f3;
		        border:2px solid red;
		        margin-top:7%;
		    }
		</style>
		<!-- ############################## -->

<!-- <script>
	$(document).ready(function(){
		$("#beginAppProcess").click(function(){
			
		});
		$("#btn").click(function(){
			const grdlevel=$("#grdlevel").val();
			const numOfSubj=$("#numOfSubj").val();
			alert(grdlevel+" "+numOfSubj);

		});
	});
</script>
 -->
 <style>
 	.applications{
		width: 100%;
		
	}
	.applications .firstStep{
	
	width: 100%;
	margin-top: 2%;

}
.applications #hide{
	display: none;
}
.applications #show{
	display: block;
}
.applications .schoolResults{
	width: 95%;
	margin-top: 2%;
}
.flex{
	display: flex;
}
.applications .schoolResults .macMalow,.grade,.topicId,.flexMatch{
	width: 100%;
	box-shadow: 0 8px 6px -6px black;
	border: 2px solid #ddd;
	border-radius: 10px;
	background-color: #222;
	opacity: .9;
	color: #f3f3f3;
}

.applications .schoolResults .grade select,input{
	width: 95%;
	background-color: #222!important;
	border-bottom: 3px solid #f3f3f3;
	color: #f3f3f3;
	border: none;
	text-align: center;
	align-content: center;
	cursor: pointer;
	border-bottom: 2px solid #f3f3f3;
}
.applications .schoolResults .topicId{
	border-bottom: none;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}
.applications .schoolResults .topicId .left{
	width: 60%;
}
.applications .schoolResults .topicId .center{
	width: 20%;
}
.applications .schoolResults .topicId .right{
	width: 20%;
}
.applications .schoolResults .flexMatch{
	border-top: none;
	border-top-right-radius: 0;
	border-top-left-radius: 0;
}
.applications .schoolResults .flexMatch .left{
	width: 70%;
}
.applications .schoolResults .flexMatch .left .subjects{
	width: 100%;
	height: 40px;
}
.applications .schoolResults .flexMatch .left .subjects select{
	height: 100%;
	width: 100%;
	background-color: #222;
	border: none;
	color: #f3f3f3;
	border-bottom: 2px solid #f3f3f3;
	border-right: 1px solid #f3f3f3;

}
.applications .schoolResults .flexMatch .center{
	width: 20%;
	height: 40px;
}
.applications .schoolResults .flexMatch .center .marks{
	width: 100%;
	height: 100%;

}
.applications .schoolResults .flexMatch .center .marks input{
	height: 100%;
	width: 100%;
	background-color: #222;
	border: none;
	color: #f3f3f3;
	border-bottom: 2px solid #f3f3f3;
	border-right: 1px solid #f3f3f3;
	

}
.applications .schoolResults .flexMatch .right{
	width: 20%;
	height: 40px;
}
.applications .schoolResults .flexMatch .right .marks{
	width: 100%;
	height: 100%;
}
.applications .schoolResults .flexMatch .right .marks input{
	height: 100%;
	width: 100%;
	background-color: #222;
	border: none;
	color: #f3f3f3;
	border-bottom: 2px solid #f3f3f3;
}
.applications .schoolResults .submitBtn{
	align-content: right;
	align-items: left;
	

}
.applications .schoolResults .submitBtn .btn{
	width: 80%;
	background-color: navy;
	color: #f3f3f3;
}
.applications .schoolResults .submitBtn .btn:hover{
	background-color: seagreen;
}
.applications .DNQ{
	width: 100%;
}
.applications .DNQ .failure{
	width: 100%;
}
.applications .DNQ .failure img{
	width: 100%;
}
.applications .applyBtn .step2{
	width: 100%;
	padding: 10px 0;
	
	align-content: center;
	text-align: center;
	margin-top: -19%;

}
.applications .applyBtn .step2 .headerWarner{
	width: 98%;
	color: #f3f3f3;
	background-color: #222;
	border-radius: 10px;
	box-shadow: 0 8px 6px -6px black;
	margin-left: 1%;
	opacity: .9;
}
.applications .applyBtn .step2 .personalDetails{
	width: 98%;
	background-color: 	#222;
	color: #f3f3f3;
	margin-left: 1%;
	border-radius: 10px;
	box-shadow: 0 8px 6px -6px black;
	opacity: .9;
}
.applications .applyBtn .step2 .personalDetails .info{
	align-content: center;
	text-align: center;
	width: 60%;
	/*border: 1px solid red;*/
	margin-left: 10%;
	padding: 10px;
}
.applications .applyBtn .step2 .personalDetails .info .div{
	align-content: center;
	text-align: center;
	width: 70%;
	/*border: 1px solid blue;*/
	padding: 3px;
}
.applications .applyBtn .step2 .personalDetails .info .div2{
	align-content: center;
	text-align: center;
	width: 30%;
	/*border: 1px solid blue;*/
	padding: 3px;
}
.applications .applyBtn .step2 .personalDetails .info .div2 select{
	background-color: #222;
	color: #f3f3f3;
	width: 100%;
	border: none;
}
.applications .applyBtn .step2 .personalDetails .foreign,.southafrican{
	align-content: center;
	justify-content: safe center;
}
.applications .applyBtn .step2 .personalDetails .info1{
	align-content: center;
	text-align: center;
	width: 100%;
	/*border: 1px solid red;*/
	
	padding: 10px;
}
.applications .applyBtn .step2 .personalDetails .info1 .myPerso{
	width: 100%;
	justify-content: legacy left;
	text-align: left;
}
.applications .applyBtn .step2 .personalDetails .info1 .myPerso .left{
	width:50%;
	padding: 10px 0;
	
}
.applications .applyBtn .step2 .personalDetails .info1 .myPerso .right{
	width:60%;
}
.applications .applyBtn .step2 .personalDetails .info1 .myPerso .right input,select{
	width: 100%;
	padding: 5px 0;
	color: #f3f3f3;
	background-color: #222;
	border: none;
	border-bottom: 2px solid #f3f3f3;
	cursor: pointer;
}
.applications .applyBtn .step2 .personalDetails .btn{
	width: 80%;
	background-color: navy;
	color: #f3f3f3;
	cursor: pointer;
	border-radius: 10px;
}
.applications .applyBtn .step2 .personalDetails .btn:hover{
	background-color: seagreen;

}

 </style>
<div class="applications" id="app1">
	<center>
		<!-- <div class="applyBtn" >
		<?php
		// $this->play($id);
		?>
		<!--</div> -->
		<div class="firstStep" hidden>
		<?php
			$this->firstStep($id);
		?>
		</div>
		<div class="DNQ" id="dnq" hidden>
		<?php
			$this->doNotQualify($id);
		?>
		</div>
	</center>
</div>

	<script>
		$(document).ready(function(){

			$("#beginAppProcess").click(function(){
				$(".doMokEarly").attr("hidden","true");
				$(".firstStep").removeAttr("hidden");
			});

		});
	</script>
		<!-- ############################## -->
	<div class="doMokEarly">
		<div class="foApply">
		    <h5>By Applying using this application System, you will apply to all universities of your choice with just one application process and be able to track application status, update application information, and accept firm offers.</h5>
		</div>
		<style>
	        #acho-date{
	            text-align: center;
              font-size: 100px;
              margin-top: 0px;
	        }
	        #acho-date #d{
	            border:2px solid red;
	            font-size:40px;
	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
	        }
	        #acho-date #h{
	            border:2px solid red;
	            font-size:40px;
	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
	        }
	        #acho-date #m{
	            border:2px solid red;
	            font-size:40px;
	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
	        }
	        #acho-date #d{
	            border:2px solid red;
	            font-size:40px;
	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
	        }
	        #acho-date #m{
	            border:2px solid red;
	            font-size:40px;
	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
	        }
	        #acho-date #s{
	            border:2px solid red;
	            font-size:40px;
	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
	        }
	        .appBtn{
	        	border: 2px solid white;
	        	color: white;
	        	padding: 10px ;
	        	border-radius: 50px;
	        	content: center
	        }
	        .appBtn:hover{
	        	border: 2px  solid navy;
	        	color: navy;
	        }
	    </style>
	    
		<h5>
		    2023 Tertiary Applications including NSFAS & Bursary Applications:
		    <br>Opening Date: 20 January 2022
		    <br>Closing date: 30 July 2022
		</h5>
		<h2>Applications Closing in :</h2> <p id="acho-date"></p>
		<button class="btn appBtn" id="beginAppProcess" >APPLY ( <span style="color:green;">OPEN</span>)</button>
	</div>
		<script>

var countDownDate = new Date("June 30, 2022 00:00:00").getTime();
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  document.getElementById("acho-date").innerHTML = "<span id='d'>"+days + "d </span><span style='color:#212121;'>--</span>" + "<span id='h'>"+hours + "h </span><span style='color:#212121;'>--</span>"
  + "<span id='m'>"+minutes + "m </span><span style='color:#212121;'>--</span>" + "<span id='s'>"+seconds + "s </span>";
    
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("acho-date").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
<?php
	}
	protected function firstStep($id){
		?>
		<div class="schoolResults">
			<div class="macMalow">
				<h2>Enter School Results below</h2>
				<h6>NB: <small>to qualify you must have atleast 60%</small></h6>
			</div>
			<hr>
			<div class="grade">
				<h5>Select Grade Level</h5>
				<select id="grdlevel" required>
					<option value="">--select Grade Level--</option>
					<option value="0">Current Gr12</option>
					<option value="1">Post Gr12</option>
				</select>
				<div id="grd" hidden></div>
				<h5>Enter Number Of Subject</h5>
				<input type="number" id="numOfSubj" max="10" min="7" placeholder="enter number of subjects" required>
				<div id="num" hidden></div>
				<span><br>cvb</span>
			</div>
			<hr>
			<center>
				<div class="topicId flex">
					<div class="left"><h5>Subject</h5></div>
					<div class="center"><h5>Score</h5></div>
					<div class="right"><h5>Perc(%)</h5></div>

				</div>
			</center>


			<div class="flexMatch ">
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects1" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects1Error" hidden></div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark1" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark1Error" hidden></div>
					</div>

					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark11" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark11Error" hidden></div>
					</div>
				</div>
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects2" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects2Error" hidden></div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark2" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark2Error" hidden></div>
					</div>

					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark22" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark22Error" hidden></div>
					</div>
				</div>
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects3" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects3Error" hidden></div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark3" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark3Error" hidden></div>
					</div>
					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark33" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark33Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects4" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects4Error" hidden></div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark4" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark4Error" hidden></div>
					</div>

					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark44" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark44Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects5" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects5Error" hidden></div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark5" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark5Error" hidden></div>
					</div>

					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark55" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark55Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects6" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects6Error" hidden></div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark6" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark6Error" hidden></div>
					</div>

					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark66" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark66Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects7" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects7Error" hidden></div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark7" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark7Error" hidden></div>
					</div>

					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark77" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark77Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects8" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark8" min="0" max="10" placeholder="7">
						</div>
					</div>

					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark88" min="0" max="100" placeholder="95">
						</div>
						
					</div>
				</div>
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects9" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark9" min="0" max="10" placeholder="7">
						</div>
					</div>

					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark99" min="0" max="100" placeholder="95">
						</div>
						
					</div>
				</div>
				<div class="flex">
					<div class="left">
						<div class="subjects">
							<select id="subjects10" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
					</div>
					<div class="center">
						<div class="marks">
							<input type="number" id="levelMark10" min="0" max="10" placeholder="7">
						</div>
					</div>

					<div class="right">
						<div class="marks">
							<input type="number" id="levelMark1010" min="0" max="100" placeholder="95">
						</div>
					</div>
				</div>
				<br>
				<div class="submitBtn">
					<button class="btn" id="step1Btn">Submit</button>
				</div>
				<br>
			</div>
			<div class="errorCatch" hidden=""></div>
		</div>
		<?php
	}
	//######################## upload.php new functions #############
	public function getStep2Info($applicant_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select * from step2 where applicationid='$applicant_id'"));
	}
	public function getStep3Info($applicant_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select * from step3 where applicationid='$applicant_id'"));
	}
	public function getUniName($uni_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select*from universities where id='$uni_id'"))['uni_name'];
	}
	public function getFacultyName($faculty_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select*from faculties where faculty_id='$faculty_id'"))['faculty_name'];
	}
	private function updateSeen($chat_id){
		global $conn;
		return $conn->query("update messages set seen='1' where chat_id='$chat_id'");
	}
	public function displayPersonalMessages($cur_user_row,$other){

		global $conn;
		?>
		<style>
			.talk-bubble{
    	display: block;
    	position: relative;
    	
    	width:80%;
    	color: #000;
    	margin-left: 19%;
    	padding: 10px 0;
    }
    .talk-bubble .my_text{
    	background-color: lightgrey;
    	border-radius: 8px;
    	width: 100%;
    }
    .talk-bubble .my_text .fileDisplay{
    	width: 100%;
    	
    }
    .talk-bubble .my_text .fileDisplay video{
    	border-radius: 10px;
    	width: 100%;
    }
    .talk-bubble .my_text .fileDisplay img{
    	border-radius: 10px;
    	width: 100%;
    }
    .talk-bubble .prof{
    	width: 100%;
    	cursor: pointer;
    }
    .talk-bubble .prof .img{
    	width: 38px;
    	border-radius: 100%;
    	
    	height: 38px;

    }
    .talk-bubble .prof .me{
    	padding: 10px 8px;
    	cursor: pointer;
    }
    .talk-bubble .prof .img img{
    	width: 100%;
    	height: 100%;
    	border-radius: 100%;
    }
    .talk-bubbleb{
    	display: block;
    	position: relative;
    	width: 80%;
    	color: #000;
    	margin-left: 2%;
    	padding: 10px 0;
    }
    .talk-bubbleb .my_text{
    	background-color: lightsteelblue;
    	border-radius: 8px;
    	width: 100%;
    }
    .talk-bubbleb .my_text .fileDisplay{
    	width: 100%;

    }
    .talk-bubbleb .my_text .fileDisplay video{
    	border-radius: 10px;
    	width: 100%;
    }
    .talk-bubbleb .my_text .fileDisplay img{
    	border-radius: 10px;
    	width: 100%;
    }
    .talk-bubbleb .prof{
    	width: 100%;
    	cursor: pointer;
    }
    .talk-bubbleb .prof .img{
    	width: 38px;
    	border-radius: 100%;
    	
    	height: 38px;
    }
    .talk-bubbleb .prof .me{
    	padding: 10px 8px;
    	cursor: pointer;
    }
    .talk-bubbleb .prof .img img{
    	width: 100%;
    	height: 100%;
    	border-radius: 100%;
    	
    }
		</style>
		<?php
		$me=$cur_user_row['my_id'];
		$_=$conn->query("select*from messages where (me='$me' AND otheruser='$other') OR (me='$other' AND otheruser='$me')  ORDER BY time_sent");
		while($row=mysqli_fetch_array($_)){
			$mp4=$row['video'];
			$img=$row['img'];
			$chat=$row['chat'];
			
			if($row["me"]==$cur_user_row['my_id']){

				$fileDir="../../posts/message/".$row["me"]."/";
				$img_prof=$cur_user_row['profile_image'];
				$profile_dir="";
				if($img_prof=="empty"){
					$profile_dir="../../default-img/fff.jpg";
				}
				else{
					$profile_dir="../../posts/".$row["me"]."/".$img_prof;
				}
				if($mp4==0 && $img==0){
					?>
					<div class="talk-bubble">
						<div class="prof flex">
							<div class="img"><img title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($cur_user_row["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<?php
							echo $chat;
							?>
								<div class="seen" style="margin-left:70%;">
								<?php
								if($row['seen']==0){
									?>
									<i class="fa fa-eye-slash" style="color:orangered;" aria-hidden="true"></i>
									<?php
								}
								else{
									?>
									<i class="fa fa-eye" style="color:green;" aria-hidden="true"></i>
									<?php
								}
								?>
								<small style="font-size: 8px; color:seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
									
					</div>
					<?php
				}
				elseif($mp4!=0){
					$dir=$fileDir.$mp4;
					?>
					<div class="talk-bubble">
						<div class="prof flex">
							<div class="img"><img title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($cur_user_row["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<div class="fileDisplay">
								<video controls>
							    	<source src="<?php echo $dir;?>" type="video/mp4">
							    	<source src="<?php echo $dir;?>" type="video/mp4">
							    </video>
							</div>
							<?php
							echo $chat;
							?>
							<div class="seen" style="margin-left:70%;">
								<?php
								if($row['seen']==0){
									?>
									<i class="fa fa-eye-slash" style="color:orangered;" aria-hidden="true"></i>
									<?php
								}
								else{
									?>
									<i class="fa fa-eye" style="color:green;" aria-hidden="true"></i>
									<?php
								}
								?>
								<small style="font-size: 8px; color:seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
										
					</div>
					<?php
				}
				else{
					$fileDir="../../posts/message/".$row["me"]."/";
					$dir=$fileDir.$img;
					?>
					<div class="talk-bubble">
						<div class="prof flex">
							<div class="img"><img title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($cur_user_row["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<div class="fileDisplay">
								<img src="<?php echo $dir;?>">
							</div>
							<?php
							echo $chat;
							?>
							<div class="seen" style="margin-left:70%;">
								<?php
								if($row['seen']==0){
									?>
									<i class="fa fa-eye-slash" style="color:orangered;" aria-hidden="true"></i>
									<?php
								}
								else{
									?>
									<i class="fa fa-eye" style="color:green;" aria-hidden="true"></i>
									<?php
								}
								?>
								<small style="font-size: 8px; color:seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
										
					</div>
					<?php
				}
			}
			else{
				// echo $row["my_id"];
				$other_user=$this->getOtherUser($row["me"]);
				// print_r($other_user);
				$img_prof=$other_user['profile_image'];
				$profile_dir="";
				$seen=$row['chat_id'];
				if(!$this->updateSeen($seen)){
					echo"<br>Report this error: Could not update seen!<br>";
				}
				if($img_prof=="empty"){
					$profile_dir="../../default-img/fff.jpg";
				}
				else{
					$profile_dir="../../posts/".$row["me"]."/".$img_prof;
				}
				if($mp4==0 && $img==0){
					?>
					<div class="talk-bubbleb">
						<div class="prof flex">
							<div class="img"><img title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($other_user["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<?php
							echo $chat;
							?>
							<div class="seen">
								<small style="font-size: 8px; color:seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
						
										
					</div>
					<?php
				}
				elseif($mp4!=0){
					$fileDir="../../posts/message/".$row["me"]."/";
					$dir=$fileDir.$mp4;
					?>
					<div class="talk-bubbleb">
						<div class="prof flex">
							<div class="img"><img title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($other_user["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<div class="fileDisplay">
								<video controls>
							    	<source src="<?php echo $dir;?>" type="video/mp4">
							    	<source src="<?php echo $dir;?>" type="video/mp4">
							    </video>
							</div>
							<?php
							echo $chat;
							?>
							<div class="seen">
								<small style="font-size: 8px; color:seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
										
					</div>
					<?php
				}
				else{
					$fileDir="../../posts/message/".$row["me"]."/";

					$dir=$fileDir.$img;
					?>
					<div class="talk-bubbleb">
						<div class="prof flex">
							<div class="img"><img title="visit my profile'" id="visita" src="<?php echo $profile_dir;?>"></div>
							<div class="me"><small title="visit my profile'" id="visitb" style="color:orangered;"><?php $userName=str_split($other_user["username"]);
							// print_r($userName);
							for($i=0;$i<10;$i++){
								if($i>=9){
									echo $userName[$i]."...";
								}
								else{
									echo $userName[$i];
								}
							}


						?></small></div>
						</div>
						<div class="my_text">
							<div class="fileDisplay">
								<img src="<?php echo $dir;?>">
							</div>
							<?php
							echo $chat;
							?>
							<div class="seen">
								<small style="font-size: 8px; color:seagreen;"><?php echo $this->time_Ago(strtotime($row['time_sent']));?></small>
							</div>
						</div>
										
					</div>
					<?php
				}
			}

		}
	}
	public function getCourseName($course_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select*from courses where course_id='$course_id'"))['course_name'];
	}
	public function addToNtification($uploaderid,$data_uploaded,$id_ofuploaded_content){
	    global $conn;
	}
	public function getOtherIdDetails($idOfReciever){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select*from create_runaccount where my_id='$idOfReciever'"));
	}
	public function sendAlert($idOfReciever,$sender_name,$sender_username){
	    global $conn;
	    $reciever_id=$this->getOtherIdDetails($idOfReciever);
	    $name=$reciever_id['name']." ".$reciever_id['surname'];
	    $email=$reciever_id['usermail'];
	    ini_set( 'display_errors', 1 );
	    error_reporting( E_ALL );
	    $from = "tech-develo@netchatsa.com";
	    $to = $email;
	    $subject = "You have a message from netchatsa";
	    $message =$sender_name."(".$sender_username.") has sent you a meesage.
	    
	    login to netchatsa.com then go to messages to view the message. 
	    
	    message important ratings: 95.7%, 
	    ";
	    $headers = "MIME-Version: 1.0" . "\r\n";
	    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	    $headers = "From: notification-alert@netchatsa.com";
	    if(!mail($to,$subject,$message, $headers)) {
	        ini_set( 'display_errors', 1 );
	        error_reporting( E_ALL );
	        $from = "tech-develo@netchatsa.com";
	        $to = "netchatsa@gmail.com";
	        $subject = "Error: email was not sent: Fix Problem";
	        $message = "Error: email was not sent: Fix Problem";
	        $headers = "MIME-Version: 1.0" . "\r\n";
	        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	        $headers = "From: Error.alert@netchatsa.com";
	    } 
	    
	}

	public function getSchoolDetails($applicationId){
		global $conn;
		$_=$conn->query("select*from step5 where applicationid='$applicationId'");
		if($_->num_rows!=1){
			return array();
		}	
		else{
			$s=mysqli_fetch_array($_)['schoolname'];
			$b=mysqli_fetch_array($conn->query("select*from highschools where id='$s'"))["amount"];
			return array($s,$b);
		}
	}
	public function isSubjId($subj_id){
	    global $conn;
	    $_=$conn->query("select*from subjectssa where subj_id='$subj_id'");
	    return ($_->num_rows==1);
	}
	public function run_topic(){
		return rand(1,9999999999);
	}
	public function postInfo($post_id){
		global $conn;
		return mysqli_fetch_array($conn->query("select * from my_post where post_id='$post_id'"));
	}
	public function editTextBeforeSubmitting($mess){
		$mess = str_replace('<', "?", $mess);
		$mess = str_replace('>', "?", $mess);
		$mess = str_replace("\\r\\n", "<br>", $mess);
		$mess = str_replace("\\n\\r", "<br>", $mess);
		$mess = str_replace("\\r", "<br>", $mess);
		$mess = str_replace("\\n", "<br>", $mess);
		$mess = str_replace("\r\n", "<br>", $mess);
		$mess = str_replace("\n\r", "<br>", $mess);
		$mess = str_replace("\r", "<br>", $mess);
		$mess = str_replace("\n", "<br>", $mess);
		$mess = str_replace("\\", " ", $mess);
		$mess = str_replace("'", "`", $mess);
		$mess = str_replace('"', "``", $mess);

		return $mess;
	}
	public function getSubjInfo($subj_id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select*from subjectssa where subj_id='$subj_id'"));
	}
	protected function getStudentInfo($id){
	    global $conn;
	    return mysqli_fetch_array($conn->query("select*from schoolstudents where  my_id='$id'"));
	}
	protected function studentRegisteredForSubj($subj_id,$std){
	    global $conn;
	    $_=$conn->query("select*from student_subj_tracker where std_id='$std' AND subj_id='$subj_id'");
	    return ($_->num_rows==1);
	}
	//###############################################################
	protected function getMatricSubjects(){
		global $conn;
		$_=$conn->query("select*from matricsubjects");
		while($row=mysqli_fetch_array($_)){
			?>
			<option value="<?php echo $row["subj_id"]; ?>"><?php echo $row["subject"]; ?></option>
			<?php
		}
	}
	protected function doNotQualify($id){
		?>
		<div class="failure" id="failure">
			<img src="../../default-img/a1.jpg" >
		</div>
		<?php
	}
	public function ExistingApplicationsId($std_id){
		global $conn;
		$_=$conn->query("select applicationid from step1 where std_id='$std_id'");
		if($_->num_rows!=1){
			return -1;
		}
		else{
			return mysqli_fetch_array($_)['applicationid'];
		}
	}
	// 		NEWS -----------//

	protected function getSportNews(){
		global $conn;
		$url="https://newsapi.org/v2/top-headlines?country=za&category=sports&apikey=e8a367febe384f5d8a1e3029f7d509fd";
		$status=true;
		$response=file_get_contents($url);
		$news=json_decode($response);
		$error="";
		foreach ($news->articles as $element){
			$img=str_replace('"', "``",str_replace("'", "`",$element->urlToImage));
			$title=str_replace('"', "``",str_replace("'", "`",$element->title));
			$title=str_replace('"', "``",str_replace("'", "`",$title));
			$source=str_replace('"', "``",str_replace("'", "`",$element->source->name));
			$descr=str_replace('"', "``",str_replace("'", "`",$element->description));
			$url=str_replace('"', "``",str_replace("'", "`",$element->url));
			$type='story';
			$author=str_replace('"', "``",str_replace("'", "`",$element->author));
			$content=str_replace('"', "``",str_replace("'", "`",$element->content));
			$datetime=str_replace('Z', "",str_replace("T", " ",$element->publishedAt));
			$id=rand(0000000,9999999);
			//echo $img."<br>".$title."<br>".$source."<br>".$descr."<br>".$url."<br>".$type."<br>".$author."<br>".$content."<br>".$datetime;
			// $datetime."<br>";
			$datetime=explode(" ", $datetime);

			//echo $datetime[0]."<br>".$datetime[1];
			$d = new DateTime($datetime[0]);
			$d1 = new DateTime($datetime[1]);

			//$timestamp = $d->getTimestamp(); // Unix timestamp
			$date = $d->format('Y-m-d');
			//$timestamp = $d1->getTimestamp(); // Unix timestamp
			$time = $d1->format('H:i:sa');

			//$date=;//date("y-m-d");//$datetime[0];
			//$timea= str_split($datetime[1],"Z");
			//$time=date_create_from_format("h:i:sa", $datetime[1])->format("h:i:sa");//date("h:i:s");//$timea[0];
			
			$pdq="select title from sportnewsdb where title=? Limit 1";
			$stmt = $conn->prepare($pdq);
			$stmt->bind_param("s",$title);
			$stmt->execute();
			$stmt->bind_result($title);
			$stmt->store_result();
			$rnum = $stmt->num_rows;
			$view_count=rand(500,1000);
			if($rnum==0){
				if($conn->query("insert into sportnewsdb(item_id,view_count,img,item_type,source,author,descr,url,content,title,date_uploaded,time_uploaded) values('$id','$view_count','$img','$type','$source','$author','$descr','$url','$content','$title','$date','$time')")){
					$status=True;

				}
				else{
					$status=false;
					$error=$conn->error;
					break;

					
				}
			}
		}
		
		if(!$status){
			echo"<h2 style='background-color:red;'>INTERNAL ERROR: ".$error."</h2>";
			exit();
		}
	}
	protected function autoload(){
		$tz = new DateTimeZone("Africa/Johannesburg");
		$now = new DateTime("now", $tz);
		$yr=date("y");
		$m=$this->getMonth(date("m"));
		$day=date("d");
		$hour=$now->format("H");
		$min=$now->format("i");
		$sec=$now->format("s");
		$am=$now->format("a");
		// echo "<div class='hours flex' style='margin-top:4%';><h6>Time(SA) : ".$hour.":".$min.":".$sec."".$am."</h6></div>";
		// echo "<div class='days flex' style='margin-top:4%';><h6>Date : 20".$yr." ".$m." ".$day."</h6></div>" ;
		// if(($hour==13 && $min==00 && $sec==00)|| ($hour==14 && $min==00 && $sec==00)|| ($hour==15 && $min==00 && $sec==00) || ($hour==16 && $min==00 && $sec==00) || ($hour==17 && $min==00 && $sec==00) || ($hour==18 && $min==18 && $sec==00)|| ($hour==19 && $min==00 && $sec==00) || ($hour==20 && $min==00 && $sec==00) || ($hour==21 && $min==00 && $sec==00) || ($hour==22 && $min==00 && $sec==00) || ($hour==23 && $min==00 && $sec==00) || ($hour==00 && $min==00 && $sec==00) || ($hour==01 && $min==00 && $sec==00)|| ($hour==02 && $min==00 && $sec==00)|| ($hour==03 && $min==55 && $sec==00) || ($hour==04 && $min==00 && $sec==00) || ($hour==05 && $min==00 && $sec==00) || ($hour==06 && $min==00 && $sec==00)|| ($hour==07 && $min==00 && $sec==00) || ($hour==8 && $min==00 && $sec==00) || ($hour==9 && $min==00 && $sec==00) || ($hour==10 && $min==25 && $sec==00) || ($hour==11 && $min==00 && $sec==00)){
		$this->getMzobeNews();
		// }
	}
	protected function autoloadSportNews(){
		$tz = new DateTimeZone("Africa/Johannesburg");
		$now = new DateTime("now", $tz);
		$yr=date("y");
		$m=$this->getMonth(date("m"));
		$day=date("d");
		$hour=$now->format("H");
		$min=$now->format("i");
		$sec=$now->format("s");
		$am=$now->format("a");
		// echo "<div class='hours flex' style='margin-top:4%';><h6>Time(SA) : ".$hour.":".$min.":".$sec."".$am."</h6></div>";
		// echo "<div class='days flex' style='margin-top:4%';><h6>Date : 20".$yr." ".$m." ".$day."</h6></div>" ;
		// if(($hour==13 && $min==00 && $sec==00)|| ($hour==14 && $min==00 && $sec==00)|| ($hour==15 && $min==00 && $sec==00) || ($hour==16 && $min==00 && $sec==00) || ($hour==17 && $min==00 && $sec==00) || ($hour==18 && $min==18 && $sec==00)|| ($hour==19 && $min==00 && $sec==00) || ($hour==20 && $min==00 && $sec==00) || ($hour==21 && $min==00 && $sec==00) || ($hour==22 && $min==00 && $sec==00) || ($hour==23 && $min==00 && $sec==00) || ($hour==00 && $min==00 && $sec==00) || ($hour==01 && $min==00 && $sec==00)|| ($hour==02 && $min==00 && $sec==00)|| ($hour==03 && $min==55 && $sec==00) || ($hour==04 && $min==00 && $sec==00) || ($hour==05 && $min==00 && $sec==00) || ($hour==06 && $min==00 && $sec==00)|| ($hour==07 && $min==00 && $sec==00) || ($hour==8 && $min==00 && $sec==00) || ($hour==9 && $min==00 && $sec==00) || ($hour==10 && $min==25 && $sec==00) || ($hour==11 && $min==00 && $sec==00)){
		$this->getSportNews();
		// }
	}
	private function getMonth($m){
		if($m==01){
			$n="Jan";
		}
		elseif($m==02){
			$n="Feb";
		}
		elseif($m==03){
			$n="Mar";
		}
		elseif($m==04){
			$n="Apr";
		}
		elseif($m==05){
			$n="May";
		}
		elseif($m==06){
			$n="Jun";
		}
		elseif($m==07){
			$n="Jul";
		}
		elseif($m==8){
			$n="Aug";
		}
		elseif($m==9){
			$n="Sep";
		}
		elseif($m==10){
			$n="Oct";
		}
		elseif($m==11){
			$n="Nov";
		}
		elseif($m==12){
			$n="Dec";
		}
		return $n;
		
	}
	protected function sgelaNews($id){
		global $conn;
		$this->autoload();
		global $conn;
		$todaysDate=date("Y-m-d");
		$_=$conn->query("select*from newsdb ORDER BY date_uploaded DESC");
		?>
		<style>
			.block-alter{
				width: 100%;
				padding: 10px;
			}
			.block-alter .block{
				box-shadow: 0 6px 4px -8px black;
				padding: 10px 0;
			}
			.block-alter .block .img-show{
				width: 100%;
				
			}
			.block-alter .block .img-show img{
				width: 100%;
			}

		</style>
		<?php
		if($_->num_rows!=0){

			while($row=mysqli_fetch_array($_)){
				?>

				<div class="block-alter">
					<div class="block">
						<?php $ram=$row['img'];if(empty($row['img'])){$ram="../../default-img/NoImageFound.png";}?>
						<div class="img-show">
							<img src="<?php echo $ram;?>">
						</div>
						<div class="time-load" style="font-size:10px;"> <?php $d1 = new DateTime($row['time_uploaded']);$time = $d1->format('H:i:sa');?>
							<h6><span style='color:red;'>Article date: </span><?php echo $row['date_uploaded']." | ".$time." || <span style='color:red;'>By:</span> ";if(empty($row['author'])){echo "N/A";}else{$split=str_split($row['author']);$count=count($split);if($count<=8){echo $row['author'];}else{for($i=0;$i<8;$i++){echo $split[$i];}echo"...";}}?></h6><h6><span style='color:red;'>Source:</span> <?php echo $row['source']." : ".$row['view_count']." views";?></h6>
						</div>
						<div class="title ">
							<h6><?php echo"<span style='color:red;'>Title:</span> ";$split=str_split($row['title']);$count=count($split);if($count<=130){echo $row['title'];}else{for($i=0;$i<130;$i++){echo $split[$i];}echo"...";}?></h6></div>
						<div class="mat-r flex">
							<div class="descr">
								<h6><?php echo"<span style='color:red;'>Description:</span> ";if(empty($row['descr'])){echo" No Description.";}else{$split=str_split($row['descr']);$count=count($split);if($count<=140){echo $row['descr'];}else{for($i=0;$i<140;$i++){echo $split[$i];}echo"...";}}?></h6>
							</div>
							<div class="url">
								<a href="<?php echo $row['url'];?>" target='_blank'><div class="btn"><button class="btn" style="background-color: navy;color:#f3f3f3;" onclick="updateViewCount(<?php echo $row['item_id'];?>)">Read More</button></div></a>
							</div>
						</div>
						
						
					</div>	
				</div>
				<?php

			}
		}
		else{
			?>
			<div class="empty">
				<h2>No News For date (<?php echo $todaysDate;?>)</h2>
			</div>
			<?php
		}
	}
	protected function sportNews($id){
		global $conn;
		$this->autoloadSportNews();
		global $conn;
		$todaysDate=date("Y-m-d");
		$_=$conn->query("select*from sportnewsdb ORDER BY date_uploaded DESC");
		?>
		<style>
			.block-alter{
				width: 100%;
				padding: 10px;
			}
			.block-alter .block{
				box-shadow: 0 6px 4px -8px black;
				padding: 10px 0;
			}
			.block-alter .block .img-show{
				width: 100%;
				
			}
			.block-alter .block .img-show img{
				width: 100%;
			}

		</style>
		<?php
		if($_->num_rows!=0){

			while($row=mysqli_fetch_array($_)){
				?>

				<div class="block-alter">
					<div class="block">
						<?php $ram=$row['img'];if(empty($row['img'])){$ram="../../default-img/NoImageFound.png";}?>
						<div class="img-show">
							<img src="<?php echo $ram;?>">
						</div>
						<div class="time-load" style="font-size:10px;"> <?php $d1 = new DateTime($row['time_uploaded']);$time = $d1->format('H:i:sa');?>
							<h6><span style='color:red;'>Article date: </span><?php echo $row['date_uploaded']." | ".$time." || <span style='color:red;'>By:</span> ";if(empty($row['author'])){echo "N/A";}else{$split=str_split($row['author']);$count=count($split);if($count<=8){echo $row['author'];}else{for($i=0;$i<8;$i++){echo $split[$i];}echo"...";}}?></h6><h6><span style='color:red;'>Source:</span> <?php echo $row['source']." : ".$row['view_count']." views";?></h6>
						</div>
						<div class="title ">
							<h6><?php echo"<span style='color:red;'>Title:</span> ";$split=str_split($row['title']);$count=count($split);if($count<=130){echo $row['title'];}else{for($i=0;$i<130;$i++){echo $split[$i];}echo"...";}?></h6></div>
						<div class="mat-r flex">
							<div class="descr">
								<h6><?php echo"<span style='color:red;'>Description:</span> ";if(empty($row['descr'])){echo" No Description.";}else{$split=str_split($row['descr']);$count=count($split);if($count<=140){echo $row['descr'];}else{for($i=0;$i<140;$i++){echo $split[$i];}echo"...";}}?></h6>
							</div>
							<div class="url">
								<a href="<?php echo $row['url'];?>" target='_blank'><div class="btn"><button class="btn" style="background-color: navy;color:#f3f3f3;" onclick="updateViewCount(<?php echo $row['item_id'];?>)">Read More</button></div></a>
							</div>
						</div>
						
						
					</div>	
				</div>
				<?php

			}
		}
		else{
			?>
			<div class="empty">
				<h2>No News For date (<?php echo $todaysDate;?>)</h2>
			</div>
			<?php
		}
	}
	protected function getMzobeNews(){
		global $conn;
		$url="https://newsapi.org/v2/top-headlines?country=za&apikey=e8a367febe384f5d8a1e3029f7d509fd";
		$status=true;
		$response=file_get_contents($url);
		$news=json_decode($response);
		$error="";
		foreach ($news->articles as $element){
			$img=str_replace('"', "``",str_replace("'", "`",$element->urlToImage));
			$title=str_replace('"', "``",str_replace("'", "`",$element->title));
			$title=str_replace('"', "``",str_replace("'", "`",$title));
			$source=str_replace('"', "``",str_replace("'", "`",$element->source->name));
			$descr=str_replace('"', "``",str_replace("'", "`",$element->description));
			$url=str_replace('"', "``",str_replace("'", "`",$element->url));
			$type='story';
			$author=str_replace('"', "``",str_replace("'", "`",$element->author));
			$content=str_replace('"', "``",str_replace("'", "`",$element->content));
			$datetime=str_replace('Z', "",str_replace("T", " ",$element->publishedAt));
			$id=rand(0000000,9999999);
			//echo $img."<br>".$title."<br>".$source."<br>".$descr."<br>".$url."<br>".$type."<br>".$author."<br>".$content."<br>".$datetime;
			// $datetime."<br>";
			$datetime=explode(" ", $datetime);

			//echo $datetime[0]."<br>".$datetime[1];
			$d = new DateTime($datetime[0]);
			$d1 = new DateTime($datetime[1]);

			//$timestamp = $d->getTimestamp(); // Unix timestamp
			$date = $d->format('Y-m-d');
			//$timestamp = $d1->getTimestamp(); // Unix timestamp
			$time = $d1->format('H:i:sa');

			//$date=;//date("y-m-d");//$datetime[0];
			//$timea= str_split($datetime[1],"Z");
			//$time=date_create_from_format("h:i:sa", $datetime[1])->format("h:i:sa");//date("h:i:s");//$timea[0];
			
			$pdq="select title from newsdb where title=? Limit 1";
			$stmt = $conn->prepare($pdq);
			$stmt->bind_param("s",$title);
			$stmt->execute();
			$stmt->bind_result($title);
			$stmt->store_result();
			$rnum = $stmt->num_rows;
			$view_count=rand(500,1000);
			if($rnum==0){
				if($conn->query("insert into newsdb(item_id,view_count,img,item_type,source,author,descr,url,content,title,date_uploaded,time_uploaded) values('$id','$view_count','$img','$type','$source','$author','$descr','$url','$content','$title','$date','$time')")){
					$status=True;

				}
				else{
					$status=false;
					$error=$conn->error;
					break;

					
				}
			}
		}
		
		if(!$status){
			echo"<h2 style='background-color:red;'>INTERNAL ERROR: ".$error."</h2>";
			exit();
		}
	}
}
?>