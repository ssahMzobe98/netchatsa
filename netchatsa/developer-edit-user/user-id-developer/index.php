<?php
session_start();
if(isset($_SESSION['usermail'])){
	//echo $_SESSION['usermail'];
?>
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
	color: #f3f3f3;
	background-color: #222;
	border-radius: 10px;
	box-shadow: 0 8px 6px -6px black;
	margin-left: 1%;
	opacity: .9;
}
.step2 .personalDetails{
	width: 98%;
	background-color: 	#222;
	color: #f3f3f3;
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
	color: #f3f3f3;
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
	color: #f3f3f3;
	background-color: #222;
	border: none;
	border-bottom: 2px solid #f3f3f3;
	cursor: pointer;
}
.step2 .personalDetails .btn{
	width: 80%;
	background-color: navy;
	color: #f3f3f3;
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
	.step2 .personalDetails .info .info1 .btnn:{
		width: 100%;
	}
}



</style>
<?php
	require_once("controler/pdo.php");
	$pdo=new _pdo_();
	$pdo->fireApp();
	$user_details=$pdo->getThisUserInfo($_SESSION['usermail']);

?>

<div class="container mt-3">
	<div class="modal fade" id="img_share" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color: #000;" class="modal-title">Publicly Share Image Post </h4>
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
	        		}

	        	</style>
	          <div class="img_selector">
	          	<input type="file" name="file" id="imgPost" accept="image/*">
	          </div>
	          <div class="text_editor">
	          	<textarea style="color:#000;" id="textPost" placeholder="Add Text to your Post..."></textarea>
	          </div>
	          <div class="buttn">
	          	<button type="button" class="btn" style="color:#f3f3f3;background-color: navy;" id="postImg">Publish Post</button>
	          </div>
	          <div class="errorDisplayer" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
	</div>
  <div class="modal fade" id="video_share" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:#000;" class="modal-title">Publicly Share Video Post</h4>
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
        		}

        	</style>
          <div class="img_selector">
          	<input type="file" name="file" id="videoPost" accept="video/*">
          </div>
          <div class="text_editor">
          	<textarea style="color:#000;" id="textPost" placeholder="Add Text to your Post..."></textarea>
          </div>
          <div class="buttn">
          	<button type="button" class="btn" style="color:#f3f3f3;background-color: navy;" id="postMp4">Publish Post</button>
          </div>
          <div class="errorDisplayer" hidden></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	<div class="modal fade" id="img_gost0" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">Update Profile </h4>
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
	<?php if(isset($_GET["__"])){?>
	<div class="modal fade" id="fileUpload" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">My Files</h4>
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
	        		}

	        	</style>
	          <div class="img_selector">
	          	<input type="file" name="file" id="messageFileUpload" accept="video/*,image/*">
	          </div>
	          <input type="hidden" id="other" value="<?php echo $_GET['__'];?>">
	          <div class="text_editor">
	          	<textarea style="color:#000;" id="messageTextUpload" placeholder="Add Text to your Post..."></textarea>
	          </div>
	          <div class="buttn">
	          	<button type="button" class="btn" id="messageB" style="color:#f3f3f3;background-color: navy;" id="postMp4">Send Message</button>
	          </div>
	          <div class="errorDisplayermessage" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	</div>
	<?php 
	}
	?>
	<div class="modal fade" id="editText" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">Edit About Me</h4>
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
	                }

	            </style>
	          
	          <div class="text_editor">
	            <textarea style="color:#000;" id="about" maxlength="300" placeholder="Add Text to your Message..."></textarea><h6 style="color:red;">300 char max</h6>
	          </div>
	          <div class="buttn">
	            <button type="button" class="btn" style="color:#f3f3f3;background-color: navy;" onclick="editAboutMe('<?php echo $user_details["my_id"];?>')" id="postMp4">Update</button>
	          </div>
	          <div class="errorAbout" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	</div>
	<div class="modal fade" id="fileUploadLive" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">My Files</h4>
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
	                }

	            </style>
	          <div class="img_selector">
	            <input type="file" name="file" id="messagefileUploadLive" accept="video/*,image/*">
	          </div>
	          <div class="text_editor">
	            <textarea style="color:#000;" id="messageTextUploadLive" placeholder="Add Text to your Message..."></textarea>
	          </div>
	          <div class="buttn">
	            <button type="button" class="btn" style="color:#f3f3f3;background-color: navy;" id="postMp4-a1">Send Message</button>
	          </div>
	          <div class="errorDisplayermessageLive" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	        <script>
	        $(document).ready(function(){
	            $("#postMp4-a1").click(function(){
	        		const data=$("#messageTextUploadLive").val();
	        		const img=$("#messagefileUploadLive").val();
	        		console.log(data+" "+img);
	        		if(data=="" && img==""){
	        			$(".errorDisplayermessageLive").removeAttr("hidden");
	        			$(".errorDisplayermessageLive").html("<small style='color:red;'>Cannot upload 'Empty Post'</small>");
	        		}
	        		else{
	        			var file=document.getElementById('messagefileUploadLive').files[0].name;
	        			var form_data=new FormData();
	        			var ext=file.split('.').pop().toLowerCase();
	        			const array=["mp4","mv","jpg","jpeg","heic","png","jpeng","jiji"];
	        			if(jQuery.inArray(ext,array)==-1){
	        				$(".errorDisplayermessageLive").removeAttr("hidden");
	        				$(".errorDisplayermessageLive").html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic} Format </small>")
	        
	        			}
	        			else{
	        				form_data.append("file",document.getElementById("messagefileUploadLive").files[0]);
	        				form_data.append("data",data);
	        				$(".errorDisplayermessageLive").removeAttr("hidden");
	        				$(".errorDisplayermessageLive").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
	        				$.ajax({
	        					url:"controler/upload.php?live_chat=2",
	        					type:"POST",
	        					data:form_data,
	        					contentType:false,
	        					cache:false,
	        					processData:false,
	        					beforeSend:function(){
	        						$(".errorDisplayermessageLive").removeAttr("hidden");
	        						$(".errorDisplayermessageLive").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
	        					},
	        					success:function(e){
	        						console.log(e);
	        						console.log(e.length);
	        						if(e.length>2){
	        							$(".errorDisplayermessageLive").removeAttr("hidden");
	        							$(".errorDisplayermessageLive").attr("style","color:red;");
	        							$(".errorDisplayermessageLive").html(" <br>Error 320 : "+e);
	        						}
	        						else{
	        							$(".errorDisplayermessageLive").removeAttr("hidden");
	        							$(".errorDisplayermessageLive").html("<small style='color:green;'>Message sent</small>");
	        							$("#messagefileUploadLive").val("");
	        							$("#messageTextUploadLive").val("");
	        							
	        						}
	        					}
	        				});
	        			}
	        		}
	        	});
	        });
	        </script>
	      </div>
	      
	    </div>
	</div>
	<div class="modal fade" id="StudyAreaUpload" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">Upload My Question/Problem</h4>
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

	        		}

	        	</style>
	        	<div class="img_selector">
	          	<input type="text"  id="studyAreaMathTitle" placeholder="Enter Your Title Here..">
	          </div>
	          <div class="img_selector">
	          	<input type="file" name="file" id="studyAreaMathInput" accept="video/*,image/*">
	          </div>
	          <div class="text_editor">
	          	<textarea style="color:#000;" id="studyAreaMathText" placeholder="Upload Problem/Question..."></textarea>
	          </div>
	          <div class="buttn">
	          	<button type="button" class="btn" id="studyAreaMath" style="color:#f3f3f3;background-color: navy;" id="postMp4">Ask</button>
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
	          <h4 style="color:#000;" class="modal-title">Write My Code</h4>
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
	        		}

	        	</style>
	        	<div class="img_selector">
	          	<input type="text"  id="studyAreaMathTitleCode" placeholder="Enter Your Title Here..">
	          </div>
	          <div class="text_editor">
	          	<textarea style="color:#000;" type="code" id="studyAreaMathCode" placeholder="String variable='Add my Problem/Solution Code Here';//JAVA,PHP,..."></textarea>
	          </div>
	          <div class="buttn">
	          	<button type="button" class="btn" id="studyAreaMathCodeSubmit" style="color:#f3f3f3;background-color: navy;" id="postMp4">Ask</button>
	          </div>
	          <div class="errorDisplayermessageStudyAreaCode" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	</div>
	<?php
	if(isset($_GET["_-"])){
	?>
	<div class="modal fade" id="replyStudyArea" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">Reply To Post</h4>
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

	        		}

	        	</style>
	        	<input type="hidden"  id="post_id" value="<?php echo $_GET["_-"];?>">
	          <div class="img_selector">
	          	<input type="file" name="file" id="studyAreaMathInputReply" accept="video/*,image/*">
	          </div>
	          <div class="text_editor">
	          	<textarea style="color:#000;" id="studyAreaMathTextReply" placeholder="Upload Problem/Question..."></textarea>
	          </div>
	          <div class="buttn">
	          	<button type="button" class="btn" id="studyAreaMathReply" style="color:#f3f3f3;background-color: navy;" id="postMp4">Reply</button>
	          </div>
	          <div class="errorDisplayermessageStudyAreaReply" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	</div>
	<div class="modal fade" id="codingReply" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">Write My Code to Reply</h4>
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
	        		}

	        	</style>
	          	<input type="hidden"  id="post_id2" value="<?php echo $_GET["_-"];?>">
	          <div class="text_editor">
	          	<textarea style="color:#000;" type="code" id="studyAreaMathCodeReply" placeholder="String variable='Add my Problem/Solution Code Here';//JAVA,PHP,..."></textarea>
	          </div>
	          <div class="buttn">
	          	<button type="button" class="btn" id="studyAreaMathCodeSubmitReply" style="color:#f3f3f3;background-color: navy;" >Reply</button>
	          </div>
	          <div class="errorDisplayermessageStudyAreaCodeReply" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	</div>
	<?php
	}
	?>
	<div class="modal fade" id="matric" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">Register to Start Enjoying Matric</h4>
	        </div>
	        <div class="modal-body">
	        	<style>
	        		.img_selector,.text_editor{
	        			width: 100%;

	        		}
	        		.img_selector input,.text_editor input{
	        			width: 100%;
	        		}
	        	

	        	</style>
	          	
	          <div class="text_editor">
	          	<input type="text" id="name" placeholder="Enter Your Name">
	          </div>
	          <div class="text_editor">
	          	<input type="text" id="surname" placeholder="Enter Your Surname">
	          </div>
	          <div class="text_editor">
	          	<select id="institution">
	          		<?php
	          		$pdo->getAllSchoolsSA();
	          		?>
	          	</select>
	          </div>
	          <div class="text_editor">
	             <select id="grade">
	                 <option value=""> --Select Grade--</option>
	                 <option value="gr12"> gr12</option>
	                 <option value="gr11"> gr11 </option>
	                 <option value="gr10"> gr10 </option>
	                 <option value="gr9"> gr9 </option>
	                 <option value="gr8"> gr8 </option>
	             </select>
	          	
	          	
	          </div>
	          <div class="buttn">
	          	<button type="button" class="btn" id="matrico" style="color:#f3f3f3;background-color: navy;">Register</button>
	          </div>
	          <div class="errorMatric" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
	</div>
	<!--##############################################################-->
	<div class="modal fade" id="varsity" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">Register to Start Enjoying Varsity Studies</h4>
	        </div>
	        <div class="modal-body">
	        	<style>
	        		.img_selector,.text_editor{
	        			width: 100%;

	        		}
	        		.img_selector input,select,.text_editor input,select{
	        			width: 100%;
	        		}
	        	

	        	</style>
	          	
	          <div class="text_editor">
	              <select id="uni_tech" required>
	          	    <option value="">Select your institution</option>
	          	<?php $_=$conn->query("select * from universities"); 
	          	      while($row=mysqli_fetch_array($_)){
	          	          ?>
	          	          <option value="<?php echo $row['id'];?>"><?php echo $row['uni_name'];?></option>"
	          	          <?php
	          	      }
	          	?>
	          	 </select>
	          </div>
	          <div class="text_editor">
	          	<select id="level" required>
	          	    <option value="">Select Your Level of Study</option>
	          	    <option value="1st">First Year</option>
	          	    <option value="2nd">Second Year</option>
	          	    <option value="3rd">Third Year</option>
	          	    <option value="4th">Fourth Year</option>
	          	    <option value="5th">Fifth Year</option>
	          	    <option value="honours">honours</option>
	          	    <option value="Masters">Masters</option>
	          	    <option value="phd">PHD</option>
	          	</select>
	          </div>
	          <div class="buttn">
	          	<button type="button" class="btn" onclick="vasi_submit()" style="color:#f3f3f3;background-color: navy;">Register</button>
	          </div>
	          <div class="errorVarsy" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	        <script>
	            function vasi_submit(){
	    		    $(".errorVarsy").removeAttr("hidden");
	    		    $(".errorVarsy").attr("style","background-color:#000;");
					$(".errorVarsy").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Processing Data...</span></small>");
	    		    const aa=$("#uni_tech").val();
	    		    const bb=$("#level").val();
	    		    if(aa=="" || bb==""){
	    		        $(".errorVarsy").removeAttr("hidden");
	        		    $(".errorVarsy").attr("style","background-color:#000;");
	    				$(".errorVarsy").html("<small><span style='color:red;'>** All fields are required!!</span></small>");
	    		    }
	    		    else{
	    		       $.ajax({
	        				url:"controler/upload.php",
	        				type:"POST",
	        				data:{aa:aa,bb:bb},
	        				success:function(e){
	        					if(e.length<2){
	        					    $(".errorVarsy").removeAttr("hidden");
	                    		    $(".errorVarsy").attr("style","background-color:#000;");
	                				$(".errorVarsy").html("<small><span style='color:green;'>Successfuly Registered...</span></small>");
	                				window.location=("./?_=pastpapers&_-=uni");
	        					}
	        					else{
	        					    $(".errorVarsy").removeAttr("hidden");
	                    		    $(".errorVarsy").attr("style","background-color:#000;");
	                				$(".errorVarsy").html("<small><span style='color:red;'>"+e+"</small>");
	        					}
	        				}
	        			}); 
	    		    }
	    		    //  uni_tech
	                // level   
	        			
	    		}
	        </script>
	      </div>
	    </div>
	</div>
	<!--##############################################################-->
	<div class="modal fade" id="install_school" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">INSTALL CLASS</h4>
	        </div>
	        <div class="modal-body">
	            <style>
	                .img_selector,.text_editor{
	                    width: 100%;

	                }
	                .img_selector input,.text_editor input{
	                    width: 100%;
	                }
	            

	            </style>
	            <?php
	            	$id=$user_details['my_id'];
	                $_=$conn->query("select*from schoolstudents where my_id='$id'");
	                if($_->num_rows==1){
	                    ?>
	                      <div class="text_editor">
	                        <input type="number" id="subj_id_install" placeholder="Enter Subject ID">
	                      </div>
	                     
	                      <div class="buttn">
	                        <button type="button" class="btn" id="matricoInstall1" style="color:#f3f3f3;background-color: navy;">Install</button>
	                      </div>
	                      <div class="errorMatricInstall" hidden></div>
	                    <?php
	                }
	                else{
	                    ?>
	                    <div class="text_editor">
	                    <input type="text" id="nameInstall" placeholder="Enter Your Name">
	                  </div>
	                  <div class="text_editor">
	                    <input type="text" id="surnameInstall" placeholder="Enter Your Surname">
	                  </div>
	                  <div class="text_editor">
	                    <input type="number" id="subj_id"  placeholder="Subject Id">
	                  </div>
	                  <div class="buttn">
	                    <button type="button" class="btn" id="matricoInstall0" style="color:#f3f3f3;background-color: navy;">Install</button>
	                  </div>
	                  <div class="errorMatricInstall" hidden></div>

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
	<!--#########################################-->
	<div class="modal fade" id="install_module" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">INSTALL A MODULE</h4>
	        </div>
	        <div class="modal-body">
	            <style>
	                .img_selector,.text_editor{
	                    width: 100%;
	                }
	                .img_selector input,.text_editor input{
	                    width: 100%;
	                }
	            </style>
	            <div class="text_editor">
	                <select class="select_module_2_reg">
	                    <option value="">-- Select Module --</option>
	                    <?php
	                    $_=$conn->query("select*from sgelavarsymodules");
	                    
	                    while($row=mysqli_fetch_array($_)){
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
	                    <option value="1st">-- 1st year --</option>
	                    <option value="2nd">-- 2nd year --</option>
	                    <option value="3rd">-- 3rd year --</option>
	                    <option value="NS">-- not Studying --</option>
	                </select>
	            </div>
	              <div class="buttn">
	                <button type="button" class="btn" onclick="installModuleSgela()" style="color:#f3f3f3;background-color: navy;">Install</button>
	              </div>
	              <div class="errorSgelaModuleInstall" hidden></div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
	</div>
	<!--#####3##################################-->
	<div class="modal fade" id="learn2code_nav" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 style="color:#000;" class="modal-title">Learn 2 Code with Sgela Technology</h4>
	        </div>
	        <div class="modal-body">
	            <?php
	            if($pdo->isRegWithSgelaLearn2Code($user_details['my_id'])==1){
	                ?>
	                <script>
	                    window.location=("./?_=pastpapers&_-=code");
	                </script>
	                <?php
	            }
	            else{
	               ?>
	                 <style>
	                    .img_selector,.text_editor{
	                        width: 100%;
	    
	                    }
	                    .img_selector input,.text_editor input{
	                        width: 100%;
	                    }
	                </style>
	              <div class="text_editor">
	                <input type="text" id="name2code" placeholder="Enter Your Name">
	              </div>
	              <div class="text_editor">
	                <input type="text" id="surname2code" placeholder="Enter Your Surname">
	              </div>
	              <div class="text_editor">
	                  <select id="uni_tech_sgela" required>
	              	    <option value="">Select your institution</option>
	              	    <option value="Not Studying">Not Studying anywhere</option>
	              	<?php $_=$conn->query("select * from universities"); 
	              	      while($row=mysqli_fetch_array($_)){
	              	          ?>
	              	          <option value="<?php echo $row['id'];?>"><?php echo $row['uni_name'];?></option>"
	              	          <?php
	              	      }
	              	        ?>
	              	 </select>
	              </div>
	              <div class="buttn">
	                <button type="button" class="btn" onclick="learn2code()" style="color:#f3f3f3;background-color: navy;">Register</button>
	              </div>
	              <div class="errorlearn2code" hidden></div>
	            <?php
	            }
	            ?>
	            <script>
	                function learn2code(){
	                    console.log("ready to register..");
	                }
	            </script>
	           </div> 
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
	</div>

	<!--##########################################-->
	<div class="modal fade" id="viewAddComments" role="dialog" >
	    <div class="modal-dialog" >
	      <style>
	          .set{
	             color:#f3f3f3;
	             border:1px solid #f3f3f3;
	          }
	          .set:hover{
	              color:#000;background-color:#f3f3f3;
	          }
	      </style>
	      <!-- Modal content-->
	      <div class="modal-content"style="color:#f3f3f3;background-color:#212121;">
	        <div class="modal-body" id="viewaddcommentdata"></div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default set" data-dismiss="modal" style="">Close</button>
	        </div>
	      </div>
	    </div>
	</div>
	<div class="modal fade" id="addApplicationTertiary" role="dialog" >
	    <div class="modal-dialog">
	      <div class="modal-content"style="color:#f3f3f3;background-color:#212121;">
	       <div class="header-malo">
	           <h5>Add Application here</h5>
	       </div>
	        <div class="modal-body">
	            <div class="rode-map">
	                <form action="./?_=apply" method="post">
	                    <select class="uni-row" name="uni" >
	                        <option value="">-- Select University --</option>
	                        <?php
	                        $_p=$conn->query("select*from universities order by uni_name ASC");
	                        while($row=mysqli_fetch_array($_p)){
	                            ?>
	                            <option value="<?php echo $row['id'];?>" ><?php echo $row['uni_name'];?></option>
	                            <?php
	                        }
	                        ?>
	                    </select> 
	                    <br><br>
	                    <button class="btn " style="border:1px solid #f3f3f3;color:#f3f3f3;" name="addButn">Select Tertiary</button>
	                </form>
	            </div>        
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default set" data-dismiss="modal" style="">Close</button>
	        </div>
	      </div>
	    </div>
	</div>
</div>


<script>
				// function dark(){
				// 	$.ajax({
				// 				darkbrightchange="dark";
    //         		url:'controler/upload.php',
    //         		type:'post',
    //         		data:{darkbrightchange:darkbrightchange},
    //         		success:function(e){
    //         		    if(e.length<=2){}
    //         		}
    //       });
				// }
        function installModuleSgela(){
            const level_module=$(".level_module").val();
            const select_module_2_reg=$(".select_module_2_reg").val();
            if( level_module==""||select_module_2_reg==""){
                $(".errorSgelaModuleInstall").removeAttr("hidden");
                $(".errorSgelaModuleInstall").attr("style","background-color:#000;color:red;width:100%;");
                $(".errorSgelaModuleInstall").html("** All field Required **");
            }
            else{
                $(".errorSgelaModuleInstall").removeAttr('hidden');
                $(".errorSgelaModuleInstall").html("<img style='width:4%;' src='../../default-img/loader.gif'> installing Module..");
            	$.ajax({
            		url:'controler/upload.php',
            		type:'post',
            		data:{level_module:level_module,select_module_2_reg:select_module_2_reg},
            		success:function(e){
            		    if(e.length<=2){
            		        $(".errorSgelaModuleInstall").removeAttr('hidden');
            		        $(".errorSgelaModuleInstall").attr("style","background-color:green;color:#f3f3f3;");
            		        $(".errorSgelaModuleInstall").html('Module Installed Successfuly');
                            
                            $(".select_module_2_reg").val("");
                            $(".level_module").val("");
                            $(".errorSgelaModuleInstall").removeAttr('hidden');
            		        $(".errorSgelaModuleInstall").attr("style","background-color:green;color:#fff;");
            		        $(".errorSgelaModuleInstall").html("Final Processing...");
            		        window.location=("./?_=pastpapers&_-=uni");
                            
            		    }
            		    else{
            		        $(".errorSgelaModuleInstall").removeAttr('hidden');
            		        $(".errorSgelaModuleInstall").attr("style","background-color:black;color:red;");
            		        $(".errorSgelaModuleInstall").html("error:"+e);
            		    }
            			
            		}
            	});
            }
        }
		function like_update(id){
		    $('#like_loop_'+id).css({"transform": "rotateY(15deg)"});
		  
			jQuery.ajax({
				url:'update_count.php',
				type:'post',
				data:'type=like&id='+id,
				success:function(result){
					var cur_count=jQuery('#like_loop_'+id).html();
					cur_count++;
					jQuery('#like_loop_'+id).html(cur_count);
					console.log("success");
				}
			});
		}	
		function dislike_update(id){
		    console.log(id);
			jQuery.ajax({
				url:'update_count.php',
				type:'post',
				data:'type=dislike&id='+id,
				success:function(result){
					var cur_count=jQuery('#dislike_loop_'+id).html();
					cur_count++;
					jQuery('#dislike_loop_'+id).html(cur_count);
			
				}
			});
		}	
		</script>
</body>
</html>
<?php
}
else{
	session_destroy();
	header("location:../../");exit();
}
?>