<?php
session_start();
if(isset($_SESSION['usermail'])){
	require_once("pdo.php");
	$pdo= new _pdo_();
	$e=array();
	$thisUserInfo=$pdo->getThisUserInfo($_SESSION['usermail']);
	$id=$thisUserInfo['my_id'];
	$a=$thisUserInfo['usermail'];
	if(isset($_POST['about'])&&isset($_POST['id'])){
		if(empty($_POST['about'])){
			$e="Cannot upload empty input!!";
		}
		else{
			$about=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['about']));
			$id=mysqli_escape_string($conn,$_POST['id']);
			if($conn->query("UPDATE create_runaccount set about='$about'   where my_id='$id'")){
				$e=1;
			}
			else{
				$e="IQ23-Error: ".$conn->error;
			}
		}
	}
	elseif(isset($_POST['nameMatricUpgrade']) and isset($_POST['surnameMatricUpgrade']) and isset($_POST['idNumMatricUpgrade']) and isset($_POST['phoneMatricUpgrade']) and isset($_POST['emailMatricUpgrade']) and isset($_POST['subj1MatricUpgrade']) and isset($_POST['subj2MatricUpgrade']) and isset($_POST['subj3MatricUpgrade']) and isset($_POST['subj4MatricUpgrade']) and isset($_POST['subj5MatricUpgrade']) and isset($_POST['subj6MatricUpgrade']) and isset($_POST['subj7MatricUpgrade']) and isset($_POST['subj8MatricUpgrade']) and isset($_POST['subj9MatricUpgrade']) and isset($_POST['subj10MatricUpgrade'])){
		$nameMatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['nameMatricUpgrade']));
		$surnameMatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['surnameMatricUpgrade']));
		$idNumMatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['idNumMatricUpgrade']));
		$phoneMatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['phoneMatricUpgrade']));
		$emailMatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['emailMatricUpgrade']));
		$subj1MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj1MatricUpgrade']));
		$subj2MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj2MatricUpgrade']));
		$subj3MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj3MatricUpgrade']));
		$subj4MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj4MatricUpgrade']));
		$subj5MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj5MatricUpgrade']));
		$subj6MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj6MatricUpgrade']));
		$subj7MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj7MatricUpgrade']));
		$subj8MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj8MatricUpgrade']));
		$subj9MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj9MatricUpgrade']));
		$subj10MatricUpgrade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj10MatricUpgrade']));
		$SchoolsSA=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['SchoolsSA']));
		$my_id=$thisUserInfo['my_id'];
		if($conn->query("insert into matricupgrade (my_id,namematricupgrade, surnamematricupgrade, idNummatricupgrade, phonematricupgrade, emailmatricupgrade, subj1matricupgrade, subj2matricupgrade, subj3matricupgrade, subj4matricupgrade, subj5matricupgrade, subj6matricupgrade, subj7matricupgrade, subj8matricupgrade, subj9matricupgrade, subj10matricupgrade,schoolsa,tim_reg)values('$my_id','$nameMatricUpgrade','$surnameMatricUpgrade','$idNumMatricUpgrade','$phoneMatricUpgrade','$emailMatricUpgrade','$subj1MatricUpgrade','$subj2MatricUpgrade','$subj3MatricUpgrade','$subj4MatricUpgrade','$subj5MatricUpgrade','$subj6MatricUpgrade','$subj7MatricUpgrade','$subj8MatricUpgrade','$subj9MatricUpgrade','$subj10MatricUpgrade','$SchoolsSA',NOW())")){
			$message="<p>CONGRATULATIONS!!, your matric classes are now active, you can start learning at your own pace, own time, and own place. All content havs been uploaded to your selected classes.</p><p>GOOD LUCK MACALA🤙!!</p>";
			$subject="CONGRATULATIONS MATRIC RE-WRITE CLASSES ACTIVATED!!";
			// $pdo->sendEmail($message,$emailMatricUpgrade,'noreply@netchatsa.com',$subject);
			$e=1;
		}
		else{
			$e="IQ23-Error: ".$conn->error;
		}

	}
	elseif(isset($_GET['submit_assignment'])){
	    $school_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['school_id']));
        $subj_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj_id']));
        $ass_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['ass_id']));
        $ext=explode(".",$_FILES['file']['name']);
		$ext=end($ext);
		$dir=$school_id."/".$subj_id."/";
		if(!is_dir($dir)){
           mkdir($dir,0777,true);
        }
        $myfile = fopen($dir."index.php", "w") or die("Unable to open file!");
        fwrite($myfile, "<?php header('Location:https://netchatsa.com');exit();?>");
        fclose($myfile);
		$arr=array("jpg","png","jpeng","heic","pdf","docx","xlxs","xlx");
		if(!in_array(strtolower($ext),$arr)){
			$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic,pdf,docx,xlxs,xlx} Format Supported";
			
		}
		else{
		    $time=date("H:m:ia");
		    $date=date("Y:m:d");
		    $new_name_file=rand(000,9999999999999)."_netChat.".$ext;
		    $std_inf=$pdo->$pdo->getStudentInfo($id);
		    $std_id=$std_inf['student_id'];
		    $assigment_info=mysqli_fetch_array($conn->query("select*from assignment where ass_id='$ass_id'"));
		    $marks=$assigment_info['marks'];
		    if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
		        if($conn->query("insert into assignment_submission(ass_id,document,subj_id,std_id,time_submitted,date_submitted,total_mark)values('$ass_id','$new_name_file','$subj_id','$std_id','$time','$date','$marks')")){
		            
    		        $e=1;
    		        $emailTo=$a;
                    $emailFrom="Alert.Submission@netchatsa.com";
                    $subject="Assignment Submitted Successfully{".$assigment_info['name']."}";
                    $Message="<h3 style='color:green;'>You hav successfully submitted your assignment</h3><h2 style='color:red;'>Assignment Info</h2><ul><li>Assignment Name: ".$assigment_info['name']."</li><li>Due date : ".$assigment_info['due_date']."</li><li>Due Time: ".$assigment_info['due_time']."</li><li>Assignment Mark: ".$assigment_info['marks']."</li></ul><br><br>";
        	        $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
    		    }
    		    else{
    		        $e="Suspense Error(9233){Report error: } :".$conn->error;
    		    }
		    }   
		    else{
		        $e="Error 786: Could not move file to folder, Please try again later";
		    }
		}
	}
	elseif(isset($_GET['updateAbout'])){
	    $id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['id']));
	    $text=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['about']));
	    if($conn->query("UPDATE create_runaccount SET about = '$text' WHERE my_id='$id'")){
// $thisUserInfo
            $emailTo=$a;
            $emailFrom="Alert.Updater@netchatsa.com";
            $subject="About Info Updated!!";
            $Message="You have successfuly updated your about info.<br><br>";
	        $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
            $e=array();
        }
        else{
            $e="Error 3456: Report This Error<br>Error: ".$conn->error;
        }
	}
	elseif(isset($_GET['install_class'])){
	    $subj_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['id']));
	    if($pdo->isSubjId($subj_id)){
	        $subj_info=$pdo->getSubjInfo($subj_id);
		    $teacher=$subj_info['subj_teacher_id'];
		    $school=$subj_info['subj_school_id'];
		    $grd=$subj_info['grd'];
		  //  -----------------
		    $std_inf=$pdo->$pdo->getStudentInfo($id);
		    $std_grd=$std_inf['grd'];
		    $std_school=$std_inf["school"];
		    if($std_grd!=$grd){
		        $e="You are registered for ".$std_grd." therefore cannot install class for ".$grd.".";
		        $emailTo=$a;
                $emailFrom="Alert.ClassRegister@netchatsa.com";
                $subject="Register Class Failed!!...";
                $Message="<h4 style='color:red;'>Class Registration has Failed!!..</h4><h2 style='color:crimson;'>Reason :</h2><br>".$e."<br><br>";
    	        $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
		    }
		    elseif($std_school!=$school){
		            $e="You are NOT registered for this School!!";
		            $emailTo=$a;
                    $emailFrom="Alert.ClassRegister@netchatsa.com";
                    $subject="Register Class Failed!!...";
                    $Message="<h4 style='color:red;'>Class Registration has Failed!!..</h4><h2 style='color:crimson;'>Reason :</h2><br>".$e."<br><br>";
        	        $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
		    }
		    elseif($pdo->studentRegisteredForSubj($subj_id,$std_inf['student_id'])){
		        
		        $e="already Registered for this Subject";
		        $emailTo=$a;
                $emailFrom="Alert.ClassRegister@netchatsa.com";
                $subject="Register Class Failed!!...";
                $Message="<h4 style='color:red;'>Class Registration has Failed!!..</h4><h2 style='color:crimson;'>Reason :</h2><br>".$e."<br><br>";
    	        $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
		    }
		    else{
		        $reg_id=$pdo->run_topic();$std=$std_inf['student_id'];
		        if($conn->query("insert into student_subj_tracker(std_id,school_id,subj_id,teacher_id,time_added)values('$std','$std_school','$subj_id','$teacher',NOW())")){
		            $emailTo=$a;
                    $emailFrom="Alert.ClassRegister@netchatsa.com";
                    $subject="Class Registration Successfull!!...";
                    // $$pdo->getSubjInfo=$pdo->getSubjInfo($subj_id);
                    $Message="<h4 style='color:green;'>Class registration successfull...</h4><br><br>";
        	        $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
		            $e=array();
		        }
		        else{
		            $e="Report This Error : Error 3253, ".$conn->error;
		        }
		    }
	        
	    }
	    else{
	        $e="Subject ID Entered Does Not Exist, You may have entered incorrectly.";
	    }
	}
	elseif(isset($_GET['instal_full_class'])){
    	$nameInstall=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['nameInstall']));
		$surnameInstall=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['surnameInstall']));
		$subj_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subj_id']));
		if($pdo->isSubjId($subj_id)){
		    $subj_info=$pdo->getSubjInfo($subj_id);
		    $teacher=$subj_info['subj_teacher_id'];
		    $school=$subj_info['subj_school_id'];
		    $grd=$subj_info['grd'];
		    if($conn->query("insert into schoolstudents(my_id,name,surname,grd,school,time_added)values('$id','$nameInstall','$surnameInstall','$grd','$school',NOW())")){
		        $reg_id=$pdo->run_topic();
		        $std_id=mysqli_fetch_array($conn->query("select*from schoolstudents where my_id='$id'"))['student_id'];
		        if($conn->query("insert into student_subj_tracker(std_id,school_id,subj_id,teacher_id,time_added)values('$std_id','$school','$subj_id','$teacher',NOW())")){
		            $emailTo=$a;
                    $emailFrom="Alert.ClassRegister@netchatsa.com";
                    $subject="Sgela Tech Extraclass Registration successfull!!...";
                    $Message="<h4 style='color:green;'>Sgela Tech Class registration for extra class is now active. See all other subjects on the App.</h4><br><br>";
        	        $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
		            $e=array();
		        }
		        else{
		            $e="REPORT THIS ERROR:<br>Error 5678:".$conn->error;
		        }
		    }
		    else{
		        $e="REPORT THIS ERROR:<br>Error 5678:".$conn->error;
		    }
		}
		else{
		    $e="Subject ID Entered Does Not Exist, You may have entered incorrectly.";
		}
	}
	elseif(isset($_GET['matric'])){
		$name=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['name']));
		$surname=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['surname']));
		$institution=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['institution']));
		$grade=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['grade']));
		$paid=0;
		$amount="R50.00";
		$status="matric";
		if($conn->query("insert into sgela(my_id,status,name,surname,institution,level,paid,amount,date_reg)values('$id','$status','$name','$surname','$institution','$grade','$paid','$amount',NOW())")){
		    $emailTo=$a;
            $emailFrom="Alert.ClassRegister@netchatsa.com";
            $subject="Registration as a High school learner completed!!...";
            $Message="<h4 style='color:green;'>Registration Successfull!!..</h4><h2 style='color:crimson;'>Your registration as a high school learner is successfull.</h2><br><br>";
            $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
			$e=array();
		}
		else{
			$e=$conn->error;
		}
	}
	elseif(isset($_POST['aa'])){
	    $uni=mysqli_escape_string($conn,$_POST['aa']);
	    $level=mysqli_escape_string($conn,$_POST['bb']);
	    $name=$thisUserInfo['name'];
	    $surname=$thisUserInfo['surname'];
	    $status="varsy";
	    $amount="R100";
	    if($pdo->existOnSgela($id)){
	        if($conn->query("insert into sgela_varsy_students(uni,level,my_id,time_reg)values('$uni','$level','$id',NOW())")){
    	        $e=1;
    	    }
    	    else{
    	        $e="Report Error{suspense error:4322}: ".$conn->error;
    	    }
	    }
	    elseif($conn->query("insert into sgela(my_id,status,name,surname,institution,level,paid,amount,date_reg)values('$id','$status','$name','$surname','$uni','$level','0','$amount',NOW())")){
	        if($conn->query("insert into sgela_varsy_students(uni,level,my_id,time_reg)values('$uni','$level','$id',NOW())")){
	            $emailTo=$a;
                $emailFrom="Alert.ClassRegister@netchatsa.com";
                $subject="Registration as a Tertiary Student completed!!...";
                $Message="<h4 style='color:green;'>Registration Successfull!!..</h4><h2 style='color:crimson;'>Your registration as a Tertiary Student is successfull.</h2><br><br>";
                $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
    	        $e=1;
    	    }
    	    else{
    	        $e="Report Error{suspense error:4322}: ".$conn->error;
    	    }
	    }
	    else{
	        $e="Report Error{suspense error:4322}: ".$conn->error;
	    }
    	    
	    
	}
	elseif(isset($_GET['views'])){
		$likeId=$pdo->run_topic();
		$post_id=$_POST['post_id'];
		if($conn->query("insert into views(post_id,viewed_by,time_viewed)values('$post_id','$id',NOW())")){
			$_=$conn->query("select*from views where post_id='$post_id'");
			$e=$_->num_rows;
		}
		else{
			$e=$conn->error;
		}
	}
	elseif(isset($_GET['like'])){
		$likeId=$pdo->run_topic();
		$post_id=$_POST['post_id'];
		if($conn->query("insert into likes(post_id,user,time_liked)values('$post_id','$id',NOW())")){
			$_=$conn->query("select*from likes where post_id='$post_id'");
			$e=$_->num_rows;
			$postInfoMation=$pdo->postInfo($post_id);
			$userLikingFor=$pdo->getOtherIdDetails($postInfoMation['posted_by']);
			$emailTo=$userLikingFor['usermail'];
			$emailFrom="no-replyAlert@netchatsa.com".
			$nameofliker=$thisUserInfo['name']." ".$thisUserInfo['surname'];//person liking the post
			$name=$userLikingFor['name']." ".$userLikingFor['surname'];//person we liking the poster for
			$subject=$name." Your post is getting Noticed!...";
            $Message="<h4 style='color:green;'>".$nameofliker." and ".($e-1)." others liked your post!!..</h4><br><br>";
			$pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
		}
		else{
			$e=$conn->error;
		}
	}
	elseif(isset($_GET['dislike'])){
		$dislikeId=$pdo->run_topic();
		$post_id=$_POST['post_id'];
		if($conn->query("insert into dislikes(post_id,disliked_by,time_disliked)values('$post_id','$id',NOW())")){
			$_=$conn->query("select*from dislikes where post_id='$post_id'");
			$e=$_->num_rows;
		}
		else{
			$e=$conn->error;
		}
	}
	elseif(isset($_GET['studyareareply'])){
		if($_GET['studyareareply']==1){
			$text=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['code']));
			$post_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['p_id']));
			$reply_id=$pdo->run_topic();
			$iscode=1;
			$mp4=0;
			$img=0;
			if($conn->query("insert into studyareareply(iscode,post_id,text,img,video,posted_by,time_posted)values('$iscode','$post_id','$text','$img','$mp4','$id',NOW())")){
				$e=array();
				
			}
			else{
				$e=$conn->error;
			}
		}
		else{
			$file="empty";
			$mp4=0;
			$img=0;
			$tracker=true;
			if(isset($_FILES['file'])){
				$file=$_FILES['file']['name'];
				if($_FILES['file']['size']>41943040){
					$e="file too big!!";
					$tracker=false;
				}
				else{
					$ext=explode(".",$_FILES['file']['name']);
					$ext=end($ext);
					$arr=array("jpg","png","jpeng","jpeg","heic","mp4","mv");
					if(!in_array(strtolower($ext),$arr)){
						$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
						$tracker=false;
					}
					else{
						if(in_array(strtolower($ext),array("jpg","png","jpeng","jpeg","heic"))){
							$img=1;
						}
						else{
							$mp4=1;
						}
						$new_name_file=rand(000000,999999)."_netChat.".$ext;
						$dir="../../../posts/netchatsaSudyArea/".$id."/";
						if(!is_dir($dir)){
							mkdir($dir,0777,true);
						}
						$profile_id=$pdo->run_topic();
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
							$file=$new_name_file;
						}
						else{
							
							$e="Failed to upload file to Dir, Please try again later.";
							$tracker=false;

						}
					}
				}
			}
			if($tracker){
				$text=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['studyAreaMathTextReply']));
				$post_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['p_id']));
				if($img==1){
					$img=$file;
				}
				elseif($mp4==1){
					$mp4=$file;
				}
				$reply_id=$pdo->run_topic();
				$iscode=0;
				if($conn->query("insert into studyareareply(iscode,post_id,text,img,video,posted_by,time_posted)values('$iscode','$post_id','$text','$img','$mp4','$id',NOW())")){
					$e=array();
				}
				else{
					$e=$conn->error;
				}
			}
		}
	}
	elseif(isset($_GET['studyarea'])){
		if($_GET['studyarea']==1){
			$file="empty";
			$mp4=0;
			$img=0;
			$tracker=true;
			if(isset($_FILES['file'])){
				$file=$_FILES['file']['name'];
				if($_FILES['file']['size']>41943040){
					$e="file too big!!";
					$tracker=false;
				}
				else{
					$ext=explode(".",$_FILES['file']['name']);
					$ext=end($ext);
					$arr=array("jpg","png","jpeng","jpeg","heic","mp4","mv");
					if(!in_array(strtolower($ext),$arr)){
						$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
						$tracker=false;
					}
					else{
						if(in_array(strtolower($ext),array("jpg","png","jpeng","jpeg","heic"))){
							$img=1;
						}
						else{
							$mp4=1;
						}
						$new_name_file=rand(000000,999999)."_netChat.".$ext;
						$dir="../../../posts/netchatsaSudyArea/".$id."/";
						if(!is_dir($dir)){
							mkdir($dir,0777,true);
						}
						$profile_id=$pdo->run_topic();
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
							$file=$new_name_file;
						}
						else{
							
							$e="Failed to upload file to Dir, Please try again later.";
							$tracker=false;

						}
					}
				}
			}
			if($tracker){
				$text=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['studyAreaMathText']));
				$title=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['studyAreaMathTitle']));
				if($img==1){
					$img=$file;
				}
				elseif($mp4==1){
					$mp4=$file;
				}
				$post_id=$pdo->run_topic();
				$iscode=0;
				if($conn->query("insert into studyarea(iscode,title,text,img,video,posted_by,time_posted)values('$iscode','$title','$text','$img','$mp4','$id',NOW())")){
					$e=array();
				}
				else{
					$e=$conn->error;
				}
			}
		}
		else{
			$text=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['code']));
			$title=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['title']));
			$post_id=$pdo->run_topic();
			$iscode=1;
			$mp4=0;
			$img=0;
			if($conn->query("insert into studyarea(iscode,title,text,img,video,posted_by,time_posted)values('$iscode','$title','$text','$img','$mp4','$id',NOW())")){
				$e=array();
			}
			else{
				$e=$conn->error;
			}

		}
	}
	elseif(isset($_GET['personal'])){
		if($_GET["personal"]==1){
			$mess=mysqli_escape_string($conn,$_POST['mess']);
			$mess=$pdo->editTextBeforeSubmitting($mess);
			$other=mysqli_escape_string($conn,$_POST['a']);
			$img=0;
			$mp4=0;
			$chat_id=$pdo->run_topic();
			$seen=0;
			if($conn->query("insert into messages(me,otheruser,chat,img,video,seen,time_sent)values('$id','$other','$mess','$img','$mp4','$seen',NOW())")){
				// $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
			    $pdo->sendAlert($other,$thisUserInfo['name']." ".$thisUserInfo['surname'],$thisUserInfo['username']);
				$e=array();
			}
			else{
				$e=$conn->error;
			}

		}
		else{
			$seen=0;
			$mess=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['messageTextUpload']));
			$other=$_POST['other'];
			if($_FILES['file']['size']>41943040){
				$e="file too big!!";

			}
			else{
				$ext=explode(".",$_FILES['file']['name']);
				$ext=end($ext);
				$arr=array("jpg","png","jpeg","jpeng","heic","mp4","mv");
				if(!in_array(strtolower($ext),$arr)){
					$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
				}
				else{
					$new_name_file=rand(000000,999999)."_netChat.".$ext;
					$dir="../../../posts/message/".$id."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					$profile_id=$pdo->run_topic();
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$chat_id=$pdo->run_topic();
						$mp4=0;
						$img=0;
						if(in_array(strtolower($ext),array('mp4','mv'))){
							$mp4=$new_name_file;
						}
						elseif(in_array(strtolower($ext),array('jpg',"jpeg",'jpeng','png','heic'))){
							$img=$new_name_file;
						}
						if($conn->query("insert into messages(me,otheruser,chat,img,video,seen,time_sent)values('$id','$other','$mess','$img','$mp4','$seen',NOW())")){
							$e=array();
						}
						else{
							$e=$conn->error;
						}

					}
					else{
						$e="Could not upload file to folder. Please try again later!..";
					}
				}
			}
			
		}
	}
	elseif(isset($_GET["updateProfile"])){
	    
		$ext=explode(".",$_FILES['file']['name']);
		$ext=end($ext);
		$e=$_FILES['file']['name'];
		
		$arr=array("jpg","png","jpeng","jpeg","heic","JPG","PNG","JPENG","JPEG","HEIC");
		if(!in_array(strtolower($ext),$arr)){
			$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic} Format Supported";
		}
		else{
			$new_name_file=rand(000000,999999)."_netChat.".$ext;

			$dir="../../../posts/".$id."/";
			// echo is_dir($dir)." -- ";
			if(!is_dir($dir)){
				mkdir($dir,0777,true);
				// echo "Dir has been made!!";exit();
			}
			// echo"Failed to make dir!!";exit();
			$profile_id=$pdo->run_topic();
			if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
				if($conn->query("update create_runaccount set profile_image='$new_name_file' where my_id ='$id'")){
					if($conn->query("insert into profilesaver(my_id,img,time_submitted)values('$id','$new_name_file',NOW())")){
						$e=array();
					}
					else{
						$e=$conn->error;
					}
				}
				else{
					$e=$conn->error;
				}
			}
			else{
				$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
			}
		}
	}
	elseif(isset($_GET['my_post'])){
		if($_GET['my_post']==1){
			$data=mysqli_escape_string($conn,$_POST['data']);
		 	$file=$_FILES['file']['name'];
		 	if(!empty($data)){
		 		$data=$pdo->editTextBeforeSubmitting($data);
		 	}
		 	if(!empty($file)){
		 		$ext=explode(".",$file);
				$ext=end($ext);
				$arr=array("jpg","png","jpeg","jpeng","gif","heic");
				if(!in_array(strtolower($ext), $arr)){
					$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
				}
				else{
					$new_name_file=rand(000000,999999)."_netChat.".$ext;
					
					$dir="../../../posts/".$id."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$file=$new_name_file;
					}
					else{
						$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
					}
				}
		 	}
		 	else{
		 		$file=0;
		 	}
		 	$post_id=$pdo->run_topic();
		 	$posted_by=$id;
		 	$video=0;
		 	if($conn->query("insert into my_post(text,img,video,posted_by,time_posted)values('$data','$file','$video','$posted_by',NOW())")){
		 		$e=array();
		 	}
		 	else{
		 		$e=$conn->error;
		 	}
		}
		else{
			$data=mysqli_escape_string($conn,$_POST['data']);
		 	$video=$_FILES['file']['name'];
		 	if(!empty($data)){
		 		$data=$pdo->editTextBeforeSubmitting($data);
		 	}
		 	if(!empty($video)){
		 		$ext=explode(".",$video);
				$ext=end($ext);
				$arr=array("mp4","mv");
				if(!in_array(strtolower($ext), $arr)){
					$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
				}
				else{
					$new_name_file=rand(000000,999999)."_netChat.".$ext;
					
					$dir="../../../posts/".$id."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$video=$new_name_file;
					}
					else{
						$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
					}
				}
		 	}
		 	else{
		 		$video=0;
		 	}
		 	$post_id=$pdo->run_topic();
		 	$posted_by=$id;
		 	$file=0;
		 	if($conn->query("insert into my_post(text,img,video,posted_by,time_posted)values('$data','$file','$video','$posted_by',NOW())")){
		 		$e=array();
		 	}
		 	else{
		 		$e=$conn->error;
		 	}
		}
		
	}
	elseif(isset($_GET["live_chat"])){
		if($_GET["live_chat"]==1){
			$mess=mysqli_escape_string($conn,$_POST['mess']);
			$mess=$pdo->editTextBeforeSubmitting($mess);
			$img=0;
			$mp4=0;
// 			$post=$pdo->run_topic();
			if($conn->query("insert into live_chat(my_id,chat,img,video,time_sent)values('$id','$mess','$img','$mp4',NOW())")){
				$e=array();
			}
			else{
				$e=$conn->error;
			}

		}
		else{
			$mess=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['data']));
			if($_FILES['file']['size']>41943040){
				$e="file too big!!";

			}
			else{
				$ext=explode(".",$_FILES['file']['name']);
				$ext=end($ext);
				$arr=array("jpg","png","jpeg","jpeng","heic","mp4","mv","jiji");
				if(!in_array(strtolower($ext),$arr)){
					$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic,mp4,mv} Format Supported";
				}
				else{
					$new_name_file=rand(000000,999999)."_netChat.".$ext;
					$dir="../../../default-img/live_chat/".$id."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					$profile_id=$pdo->run_topic();
					if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
						$chat_id=$pdo->run_topic();
						$mp4=0;
						$img=0;
						if(in_array(strtolower($ext),array('mp4','mv'))){
							$mp4=$new_name_file;
						}
						elseif(in_array(strtolower($ext),array('jpg',"jpeg",'jpeng','png','heic'))){
							$img=$new_name_file;
						}
						$post=$pdo->run_topic();
						if($conn->query("insert into live_chat(my_id,chat,img,video,time_sent)values('$id','$mess','$img','$mp4',NOW())")){
							$e=array();
						}
						else{
							$e=$conn->error;
						}
					}
					else{
						$e="Could not upload file to folder. Please try again later!..";
					}
				}
			}
		}
	}
	elseif(isset($_GET['step'])){
		$std_id=$id;

		if($_GET['step']==1){
			$avrg=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['avrg']));
			$grdlevel=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['grdlevel']));
			$numOfSubj=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['numOfSubj']));
			$subjects1=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects1']));
			$levelMark1=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark1']));
			$levelMark11=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark11']));
			$subjects2=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects2']));
			$levelMark2=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark2']));
			$levelMark22=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark22']));
			$subjects3=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects3']));
			$levelMark3=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark3']));
			$levelMark33=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark33']));
			$subjects4=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects4']));
			$levelMark4=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark4']));
			$levelMark44=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark44']));
			$subjects5=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects5']));
			$levelMark5=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark5']));
			$levelMark55=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark55']));
			$subjects6=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects6']));
			$levelMark6=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark6']));
			$levelMark66=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark66']));
			$subjects7=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects7']));
			$levelMark7=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark7']));
			$levelMark77=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark77']));
			$levelMark88=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark88']));
			if(empty($levelMark99)){
				$levelMark99="-1";
			}
			$levelMark99=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark99']));
			if(empty($levelMark1010)){
				$levelMark1010="-1";
			}
			$levelMark1010=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark1010']));
			if(empty($subjects8)){
				$subjects8="-1";
			}
			$subjects8=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects8']));
			if(empty($subjects9)){
				$subjects9="-1";
			}
			$subjects9=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects9']));
			if(empty($subjects10)){
				$subjects10="-1";
			}
			$subjects10=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['subjects10']));
			if(empty($levelMark8)){
				$levelMark8="-1";
			}
			$levelMark8=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark8']));
			if(empty($levelMark9)){
				$levelMark9="-1";
			}
			$levelMark9=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark9']));
			if(empty($levelMark10)){
				$levelMark10="-1";
			}
			$levelMark10=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['levelMark10']));
			if(empty($std_id)){
				$std_id="-1";
			}
			
			$applicationId=$pdo->applicationsId();
			$date=date("Y-m-d");
			$year=date("Y");
			if($conn->query("insert into step1(std_id,applicationid,avrg,grdlevel,numofsubj,subjects1,levelmark1,levelmark11,subjects2,levelmark2,levelmark22,subjects3,levelmark3,levelmark33,subjects4,levelmark4,levelmark44,subjects5,levelmark5,levelmark55,subjects6,levelmark6,levelmark66,subjects7,levelmark7,levelmark77,levelmark88,levelmark99,levelmark1010,subjects8,subjects9,subjects10,levelmark8,levelmark9,levelmark10,year_started,date_started,time_started)values('$std_id','$applicationId','$avrg','$grdlevel','$numOfSubj','$subjects1','$levelMark1','$levelMark11','$subjects2','$levelMark2','$levelMark22','$subjects3','$levelMark3','$levelMark33','$subjects4','$levelMark4','$levelMark44','$subjects5','$levelMark5','$levelMark55','$subjects6','$levelMark6','$levelMark66','$subjects7','$levelMark7','$levelMark77','$levelMark88','$levelMark99','$levelMark1010','$subjects8','$subjects9','$subjects10','$levelMark8','$levelMark9','$levelMark10','$date','$year',NOW())")){
				$time=date("H:i:sa");
				if($conn->query("insert into testing(my_id,level,year,time_started,date_started)values('$std_id','1','$year','$time',NOW())")){
				    $emailTo=$a;
				    $emailFrom="np-reply@netchatsa.com";
				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
				    $subject="TAMA APPLICATIONSA (Completion of step1 Alert)";
				    // $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
				    $e="submitted wrap";
				}
				else{
					$e=$conn->error;
				}
			}
			else{
				$e=$conn->error;
			}
		}
		elseif ($_GET['step']==2) {
			$sa=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['sa']));
			$passport=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['passport']));
			$idNumber=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['idNumber']));
			$gender=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['gender']));
			$dob=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['dob']));
			$title=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['title']));
			$initials=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['initials']));
			$lname=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['lname']));
			$fname=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['fname']));
			$status=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['status']));
			$hlang=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['hlang']));
			$EthnicGroup=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['EthnicGroup']));
			$Employed=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['Employed']));
			$hear=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['hear']));
			$bursary=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['bursary']));
			$applicationId=$pdo->ExistingApplicationsId($std_id);
			if($applicationId==-1){
				$e="application ID for ".$std_id." does not exist";
			}
			else{
				$k=true;
				if(strtolower($sa)=="yes" && empty($idNumber)){
					$e="cannot process empty ID Number, SA ID Num must be 13 length of digit";
					$k=false;
				}
				elseif(strtolower($sa)=="no" && empty($passport)){
					$e="cannot process empty passport ID";
					$k=false;
				}
				if(empty($idNumber)&&empty($passport)){
					$e="cannot process empty passport or SA ID Number";
					$k=false;
				}
				if(!empty($idNumber)&&!empty($passport)){
					if(strtolower($sa)=="yes"){
						$e="only SA ID is required";
					}
					else{
						$e="only passport ID is Required";
					}
					$k=false;
				}
				if($k){
					$date=date("Y-m-d");
					$year=date("Y");
					if($conn->query("insert into step2(applicationid,sa,passport,idnumber,gender,dob,title,initials,lname,fname,status,hlang,ethnicgroup,employed,hear,bursary,date,year,time_submitted)values('$applicationId','$sa','$passport','$idNumber','$gender','$dob','$title','$initials','$lname','$fname','$status','$hlang','$EthnicGroup','$Employed','$hear','$bursary','$date','$year',NOW())")){
						if($conn->query("update testing set level='2' where my_id='$std_id'")){
						    $emailTo=$a;
        				    $emailFrom="np-reply@netchatsa.com";
        				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
        				    $subject="TAMA APPLICATIONSA (Completion of step2 Alert)";
        				    $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
							$e=array();
						}
						else{
							$e=$conn->error;
						}
					}
					else{
						$e=$conn->error;
					}
				}
			}
		}
		elseif($_GET['step']==3){
			$street=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['street']));
			$suburb=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['suburb']));
			$town=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['town']));
			$province=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['province']));
			$postal=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['postal']));
			$phone=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['phone']));
			$telephone=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['telephone']));
			$email=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['email']));
			$res=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['res']));
			$dis=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['dis']));
	
			$applicationId=$pdo->ExistingApplicationsId($std_id);
			$date=date("Y-m-d");
			$year=date("Y");
			if($applicationId==-1){
				$e="application ID for ".$std_id." does not exist";
			}
			else{
				if($conn->query("insert into step3(applicationid,street,suburb,town,province,postal,phone,telephone,email,res,dis,date,year,time_posted)values('$applicationId','$street','$suburb','$town','$province','$postal','$phone','$telephone','$email','$res','$dis','$date','$year',NOW())")){
					if($conn->query("update testing set level='3' where my_id='$std_id'")){
					    $emailTo=$a;
				    $emailFrom="np-reply@netchatsa.com";
				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
				    $subject="TAMA APPLICATIONSA (Completion of step3 Alert)";
				    $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
						$e=array();
					}
					else{
						$e=$conn->error;
					}
				}
				else{
					$e=$conn->error;
				}
			}
		}
		elseif ($_GET['step']==4) {
			$fname=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['fname']));
			$lname=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['lname']));
			$relationship=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['relationship']));
			$employed=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['employed']));
			$alphone=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['alphone']));
			$email=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['email']));
			$phone=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['phone']));
			$street=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['street']));
			$suburb=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['suburb']));
			$town=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['town']));
			$province=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['province']));
			$postal=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['postal']));
			$applicationId=$pdo->ExistingApplicationsId($std_id);
			$date=date("Y-m-d");
			$year=date("Y");
			if($applicationId==-1){
				$e="application ID for ".$std_id." does not exist";
			}
			else{
				if($conn->query("insert into step4(applicationid,fname,lname,relationship,employed,alphone,email,phone,street,suburb,town,province,postal,date,year,time_submitted)values('$applicationId','$fname','$lname','$relationship','$employed','$alphone','$email','$phone','$street','$suburb','$town','$province','$postal','$date','$year',NOW())")){
					if($conn->query("update testing set level='4' where my_id='$std_id'")){
					    $emailTo=$a;
				    $emailFrom="np-reply@netchatsa.com";
				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
				    $subject="TAMA APPLICATIONSA (Completion of step4 Alert)";
				    $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
						$e=array();
					}
					else{
						$e=$conn->error;
					}
				}
				else{
					$e=$conn->error;
				}
			}
		}
		elseif ($_GET['step']==5) {
			if(isset($_GET['file'])){
				if($_GET['file']==1){
					$ext=explode(".",$_FILES['file']['name']);
					$ext=end($ext);
					if(strtolower($ext)!="pdf"){
						$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
					}
					else{
						$new_name_file=rand(000000,999999)."_netChat.".$ext;
						$applicationId=$pdo->ExistingApplicationsId($std_id);
						if($applicationId==-1){
							$e="application ID for ".$std_id." does not exist";
						}
						else{
							$dir=md5($applicationId)."/";
							if(!is_dir($dir)){
								mkdir($dir,0777,true);
							}
							if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
								if($conn->query("update step5 set idcopy='$new_name_file' where applicationid ='$applicationId'")){
								    $emailTo=$a;
				    $emailFrom="np-reply@netchatsa.com";
				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
				    $subject="TAMA APPLICATIONSA (Completion of step5 Alert)";
				    $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
									$e=array();
								}
								else{
									$e=$conn->error;
								}
							}
							else{
								$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
							}
						}
					}
					

					
				}
				elseif($_GET['file']==2){
					$ext=explode(".",$_FILES['file']['name']);
					$ext=end($ext);
					if(strtolower($ext)!="pdf"){
						$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
					}
					else{
						$new_name_file=rand(000000,999999)."_netChat.".$ext;
						$applicationId=$pdo->ExistingApplicationsId($std_id);
						if($applicationId==-1){
							$e="application ID for ".$std_id." does not exist";
						}
						else{
							$dir=md5($applicationId)."/";
							if(!is_dir($dir)){
								mkdir($dir,0777,true);
							}
							if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
								if($conn->query("update step5 set finalresults='$new_name_file' where applicationid ='$applicationId'")){
									$e=array();
								}
								else{
									$e=$conn->error;
								}
							}
							else{
								$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
							}
						}
					}
					

					
				}
				elseif($_GET['file']==3){
					$ext=explode(".",$_FILES['file']['name']);
					$ext=end($ext);
					if(strtolower($ext)!="pdf"){
						$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
					}
					else{
						$new_name_file=rand(000000,999999)."_netChat.".$ext;
						$applicationId=$pdo->ExistingApplicationsId($std_id);
						if($applicationId==-1){
							$e="application ID for ".$std_id." does not exist";
						}
						else{
							$dir=md5($applicationId)."/";
							if(!is_dir($dir)){
								mkdir($dir,0777,true);
							}
							if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
								if($conn->query("update step5 set proofresident='$new_name_file' where applicationid ='$applicationId'")){
									$e=array();
								}
								else{
									$e=$conn->error;
								}
							}
							else{
								$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
							}
						}
					}
					

					
				}
				elseif($_GET['file']==4){
					$ext=explode(".",$_FILES['file']['name']);
					$ext=end($ext);
					if(strtolower($ext)!="pdf"){
						$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
					}
					else{
						$new_name_file=rand(000000,999999)."_netChat.".$ext;
						$applicationId=$pdo->ExistingApplicationsId($std_id);
						if($applicationId==-1){
							$e="application ID for ".$std_id." does not exist";
						}
						else{
							$dir=md5($applicationId)."/";
							if(!is_dir($dir)){
								mkdir($dir,0777,true);
							}
							if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
								if($conn->query("update step5 set guardianid='$new_name_file' where applicationid ='$applicationId'")){
									if($conn->query("update testing set level='6' where my_id='$std_id'")){
									    $emailTo=$a;
				    $emailFrom="np-reply@netchatsa.com";
				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
				    $subject="TAMA APPLICATIONSA (Completion of step6 Alert)";
				    $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
										$e=array();
									}
									else{
										$e=$conn->error;
									}
								}
								else{
									$e=$conn->error;
								}
							}
							else{
								$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
							}
						}
					}
				}
				else{
					$e="bridge responce detected";
				}
			}
			else{
				$schoolname=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['schoolname']));
				$street=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['street']));
				$suburb=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['suburb']));
				$town=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['town']));
				$province=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['province']));
				$postal=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['postal']));
				$yearcompleted=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['yearcompleted']));
				$activity=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['activity']));
				$eduhistory=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['eduhistory']));
				$uni=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['uni']));
				$studentnumber=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['studentnumber']));
				$statuscompletion=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['statuscompletion']));
				$applicationId=$pdo->ExistingApplicationsId($std_id);
				$date=date("Y-m-d");
				$year=date("Y");
				if($applicationId==-1){
					$e="application ID for ".$std_id." does not exist";
				}
				else{
					
					$idcopy="empty";
					
					$finalresults="empty";
					$proofresident="empty";
					$guardianid="empty";
					
					$tracker=true;
					if($tracker){
						if($conn->query("insert into step5(applicationid,schoolname,street,suburb,town,province,postal,yearcompleted,activity,eduhistory,uni,studentnumber,statuscompletion,idcopy,finalresults,proofresident,guardianid,date,year,time_submitted)values('$applicationId','$schoolname','$street','$suburb','$town','$province','$postal','$yearcompleted','$activity','$eduhistory','$uni','$studentnumber','$statuscompletion','$idcopy','$finalresults','$proofresident','$guardianid','$date','$year',NOW())")){
							if($conn->query("update testing set level='5' where my_id='$std_id'")){
							    $emailTo=$a;
				    $emailFrom="np-reply@netchatsa.com";
				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
				    $subject="TAMA APPLICATIONSA (Completion of step5 Alert)";
				    $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
								$e=array();
							}
							else{
								$e=$conn->error;
							}
						}
						else{
							$e=$conn->error;
						}
					}	
				}
			}
				
		}
		elseif($_GET['step']==6){
		    
            // $uni_name=getUniName($uni);
            
            // $course_name=getCourseName($course);
		    
			$uni_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['uni_id']));
			$uni_name=$pdo->getUniName($uni_id);
			$faculty_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['faculty_id']));
			$faculty_name=$pdo->getFacultyName($faculty_id);
// 			$faculty_name=mysqli_escape_string($conn,$_POST['faculty_name']);
			$course_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['course_id']));
			$course_name=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['course_name']));
			$mode_of_attendance=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['mode_of_attendance']));
			$year_of_study=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['year_of_study']));
			$campus_id=mysqli_fetch_array($conn->query("select campus_id from courses where course_id='$course_id'"))['campus_id'];
			$applicationId=$pdo->ExistingApplicationsId($std_id);
			$date=date("Y-m-d");
			$year=date("Y");
			
			if($applicationId==-1){
				$e="application ID for ".$std_id." does not exist";
			}
			else{
				if($conn->query("insert into finalapplication(applicationid,uni_id,uni_name,faculty_id,faculty_name,course_id,course_name,mode_of_attendance,year_of_study,campus_id,date,year,time_submitted) values('$applicationId','$uni_id','$uni_name','$faculty_id','$faculty_name','$course_id','$course_name','$mode_of_attendance','$year_of_study','$campus_id','$date','$year',NOW())")){
					$_=$conn->query("select * from finalapplication where applicationid='$applicationId'");
					if($_->num_rows>=3){
						if($conn->query("update testing set level='7' where my_id='$std_id'")){
						    $emailTo=$a;
				    $emailFrom="np-reply@netchatsa.com";
				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
				    $subject="TAMA APPLICATIONSA (Completion of step6 Alert)";
				    $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
								$e=1;
						}
						else{
							$e=$conn->error;//uni_id: 846513232 faculty id: 76543123
						}
					}
					else{
						$e=array();
					}
				}
				else{
					$e=$conn->error;
				}
			}
		}
		
		elseif($_GET['step']==7){
			$accept=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['accept']));
			$applicationId=$pdo->ExistingApplicationsId($std_id);
			$date=date("Y-m-d");
			$year=date("Y");
			if($applicationId==-1){
				$e="This application ID does not exist";
			}
			else{
				if($conn->query("insert into terms_conditions(applicationid,accept,date,year,time_accepted)values('$applicationId','$accept','$date','$year',NOW())")){
					if($conn->query("update testing set level='8' where my_id='$std_id'")){
					    $emailTo=$a;
				    $emailFrom="np-reply@netchatsa.com";
				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
				    $subject="TAMA APPLICATIONSA (Completion of step7 Alert)";
				    $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
						$e=array();
					}
					else{
						$e=$conn->error;
					}
				}
				else{
					$e=$conn->error;
				}
			}
		}
		elseif($_GET['step']==8){
			$ext=explode(".",$_FILES['file']['name']);
			$ext=end($ext);
			if(strtolower($ext)!="pdf"){
				$e="{".$ext."} Not Supported. Only {PDF/pdf} Format Supported";
			}
			else{
				$new_name_file=rand(000000,999999)."_netChat.".$ext;
				$e=$new_name_file;
				$applicationId=$pdo->ExistingApplicationsId($std_id);
				if($applicationId==-1){
					$e="application ID for ".$std_id." does not exist";
				}
				else{
					$dir=md5($applicationId)."/";
					if(!is_dir($dir)){
						mkdir($dir,0777,true);
					}
					$school_details=$pdo->getSchoolDetails($applicationId);
					if(empty($school_details)){
						$e="application id not Found";
					}
					else{
						$school_id=$school_details[0];
						$amount=$school_details[1];
						$step2_info=$pdo->getStep2Info($applicationId);
                		$step3_info=$pdo->getStep3Info($applicationId);
                		$surname=$step2_info['fname'];
                		$name=$step2_info['title']." ".$step2_info['initials']." ".$step2_info['lname'];
                		$email=$step3_info['email'];
                		$m_payment_id=$step2_info['idnumber'];
                		$item_name="TAMA ORGANIZATIONSA TERTIARY APPLICATIONS";
						if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
							if($conn->query("insert into payment(applicationid,m_payment_id,pf_payment_id,payment_status,item_name,item_description,amount_gross,amount_fee,amount_net,name_first,name_last,email_address,merchant_id,school,time_uploaded )values('$applicationId','$m_payment_id','$m_payment_id','PENDING','$item_name','$new_name_file','$amount','0','$amount','$name','$surname','$email','18152361','$school_id',NOW())")){
								if($conn->query("update testing set level='9' where my_id='$std_id'")){
								    $emailTo=$a;
				    $emailFrom="np-reply@netchatsa.com";
				    $Message="<p>Dear Applicant</p><p>You have started Tertiary Applications with TAMA Organizationsa via netchatsa APP. Please note that you just completed the 1st step of the application. CONGRATS!!👏 😇</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
				    $subject="TAMA APPLICATIONSA (Completion of step8 Alert)";
				    $pdo->sendEmail($Message,$emailTo,$emailFrom,$subject);
									$e=array();
								}
								else{
									$e=$conn->error;
								}
							}
							else{
								$e=$conn->error;
							}
						}
						else{
							$e="REPORT THIS ERROR 330: File cannot be moved to Path ";
						}
					}
				}
			}
		}
		else{
			$e="unrecognized Command to step : ".$_GET['step'];
		}
	}
	elseif(isset($_GET['k'])){
	    $code=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['m']));
	    $select=$conn->query("select device_locker from code_security where device_locker='$code'");
	    if($select->num_rows==1){
	        $conn->query("DELETE FROM code_security WHERE device_locker='$code'");
	        $e="";
	    }
	    else{
	        $e=$conn->error;
	    }
	}
	elseif(isset($_POST['a'])&&isset($_POST['b'])&&isset($_POST['c'])){
	    $applicationId=$pdo->ExistingApplicationsId($id);
	    $faculty=$_POST['a'];
        $uni=$_POST['b'];
        $course=$_POST['c'];
        $campus_id=mysqli_fetch_array($conn->query("select campus_id from courses where course_id='$course'"))['campus_id'];
        
        $uni_name=$pdo->getUniName($uni);
        $faculty_name=$pdo->getFacultyName($faculty);
        $course_name=$pdo->getCourseName($course);
        // echo $uni_name." - ".$faculty_name." - ".$course_name;
        $date=date("Y-m-d");
		$year=date("Y");
		$mode_of_attendance="FULL TIME";
		$year_of_study="1ST YEAR";
		$_="select applicationid and course_id from finalapplication where applicationid=? and course_id=? Limit 1";
		$stmt = $conn->prepare($_);
		$stmt->bind_param("ss", $applicationId,$course);
		$stmt->execute();
		$stmt->bind_result($course);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		
		if($rnum==1){
		    $e="<p style='color:navy;'>Already Applied for ".$course_name." at ".$uni_name.".</p>";
		}
		else{
		    if($conn->query("insert into finalapplication(applicationid,uni_id,uni_name,faculty_id,faculty_name,course_id,course_name,mode_of_attendance,year_of_study,campus_id,date,year,time_submitted) values('$applicationId','$uni','$uni_name','$faculty','$faculty_name','$course','$course_name','$mode_of_attendance','$year_of_study','$campus_id','$date','$year',NOW())")){
    			$e=1;
    		}
    		else{
    		    $e="Suspense Error(Report Error) :".$conn->error;
    		}
		}
		
	}
	elseif(isset($_POST['numorders'])){
	    $shisanyama_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['shisanyama_id']));
        $product_id=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['product_id']));
        $source1=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['source1']));
        $source2=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['source2']));
        $source3=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['source3']));
        $numorders=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['numorders']));
        $price=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['price']));
        $total_price=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['total_price']));
        $date=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['date']));
        $time=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['time']));
        $email=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['email']));
        $cel=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['cel']));
        $extras="";
        $chef_id=mysqli_fetch_array($conn->query("select chef_id from shisanyama_chef where shisanyama_id='$shisanyama_id' order by rand() limit 1"))['chef_id'];
        $name=$thisUserInfo['name'];
        $surname=$thisUserInfo['surname'];
        $username=$thisUserInfo['username'];
        $my_id=$thisUserInfo['my_id'];
        
        if($conn->query("insert into all_orders(product_id,shisanyama_id,num_orders,original_price,checkout_price,source1,source2,source3,extra1,extra2,extra3,time_orderd,time_collect,date_collect,payment,person_ordered_my_id,name,surname,username,email,phone,iscollected,chef_id)values('$product_id','$shisanyama_id','$numorders','$price','$total_price','$source1','$source2','$source3','$extras','$extras','$extras',NOW(),'$time','$date','0','$my_id','$name','$surname','$username','$email','$cel','0','$chef_id')")){
            
            $e=1;
        }
        else{
            $e="Suspense Error(Report this error) : ".$conn->error;
        }
        //order_id,product_id,shisanyama_id,num_orders,original_price,checkout_price,source1,source2,source3,extra1,extra2,extra3,time_orderd,time_collect,date_collect,payment,person_ordered_my_id,name,surname,username,email,phone,iscollected,time_collected,chef_id
	}
	elseif(isset($_POST['select_module_2_reg'])){
	    $year=date("Y-m-d");
	    $module=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['select_module_2_reg']));
	    $level=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['level_module']));
	    $std_id=mysqli_fetch_array($conn->query("select id from sgela_varsy_students where my_id='$id'"))['id'];
	    if($conn->query("insert into sgelamodulestudent(student_id,my_id,module,level,year,reg_date
)values('$std_id','$id','$module','$level','$year',NOW())")){
	        $e=1;
	    }
	    else{
	        $e="Suspense Error(Report this error) : ".$conn->error;
	    }
	}
    elseif(isset($_POST['track_id'])){
        $id_track=$_POST['track_id'];
        if($conn->query("insert into song_likes(track,my_id)values('$id_track','$id')")){
            $_=$conn->query("select*from song_likes where track='$id_track'");
            $e=$_->num_rows;
        }
        else{
            $e=$conn->error;
        }
    }
    elseif(isset($_POST['changegrade'])){
    	$changegrade=mysqli_escape_string($conn,$_POST['changegrade']);
    	if($conn->query("UPDATE sgela SET level = '$changegrade' WHERE my_id = '$id'")){
    		if($changegrade=="gr12"){
    			$e=12;
    		}
    		elseif ($changegrade=="gr11") {
    			$e=10;
    		}
    		elseif ($changegrade=="gr10") {
    			$e=10;
    		}
    		elseif ($changegrade=="gr9") {
    			$e=9;
    		}
    		else{
    			$e=8;
    		}
    	}
    	else{
    		$e=$conn->error;//
    	}
    }
    elseif(isset($_POST['track_download'])){
        $id_track=$_POST['track_download'];
        if($conn->query("insert into song_download(track,my_id)values('$id_track','$id')")){
            $_=$conn->query("select*from song_download where track='$id_track'");
            $e=$_->num_rows;
            if($conn->query("UPDATE track SET downloads = '$e' WHERE id = '$id_track'")){
                $e=$e;
            }
            else{
                $e=$conn->error;
            }
        }
        else{
            $e=$conn->error;
        }
    }
    // elseif(isset($_POST['darkbrightchange'])){
    // 	if($conn->query("UPDATE track SET downloads = '$e' WHERE id = '$id_track'")){
    //             $e=$e;
    //         }
    //         else{
    //             $e=$conn->error;
    //         }
    // }
	elseif(isset($_POST['target'])){
	    
	    $coment=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['target']));
	    $post_id=$_POST['post_id'];
	    $poster_my_id=mysqli_fetch_array($conn->query("select posted_by from my_post where post_id='$post_id'"))['posted_by'];
	    $commenter=$id;
	    
	    if($conn->query("insert into post_comments(commenter,poster,post_id,comment,time_commented)values('$commenter','$poster_my_id','$post_id','$coment',NOW())")){
	        $e=1;
	    }
	    else{
	        $e="report this Error(Suspense Error {5236}):".$conn->error;
	    }
	}
	else{
		$e="Bridge Attempt!!..";
	}
	echo json_encode($e);
	$conn->close();
}
else{
	session_destroy();
	?>
	<script> window.location=("../../?error=Access denied");</script>
	<?php
}
?>