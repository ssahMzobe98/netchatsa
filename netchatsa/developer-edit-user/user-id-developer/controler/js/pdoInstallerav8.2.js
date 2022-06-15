$(document).ready(function(){
    $("#matricoInstall1").click(function(){
        const id=$("#subj_id_install").val();
        if(id==""){
            $(".errorMatricInstall").removeAttr("hidden");
			$(".errorMatricInstall").html("<small style='color:red;background-color:#000;'>All Fields Are Required!..</small>");
        }
        else{
            $.ajax({
				url:"controler/upload.php?install_class",
				type:"POST",
				data:{id:id},
				cache:false,
				beforeSend:function(){
					$(".errorMatricInstall").removeAttr("hidden");
					$(".errorMatricInstall").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
				},
				success:function(e){
					console.log(e);
					console.log(e.length);
					if(e.length>2){
						$(".errorMatricInstall").removeAttr("hidden");
						$(".errorMatricInstall").attr("style","color:red;");
						$(".errorMatricInstall").html(" "+e);
					}
					else{
						$(".errorMatricInstall").removeAttr("hidden");
						$(".errorMatricInstall").html("<small style='color:green;'> Registration Completed... please wait reloading page..</small>");
						$("#subj_id_install").val("");
						window.location=("./?_=pastpapers&_-=matric");
					}
				}
			});
        }
    });
    $("#matricoInstall0").click(function(){
        const nameInstall=$("#nameInstall").val();
		const surnameInstall=$("#surnameInstall").val();
		const subj_id=$("#subj_id").val();
	
		if(nameInstall=="" || surnameInstall=="" || subj_id==""){
			$(".errorMatricInstall").removeAttr("hidden");
			$(".errorMatricInstall").html("<small style='color:red;background-color:#000;'>All Fields Are Required!..</small>");
		}
		else{
			console.log(nameInstall+" "+surnameInstall+" "+subj_id);
			$.ajax({
				url:"controler/upload.php?instal_full_class",
				type:"POST",
				data:{nameInstall:nameInstall,surnameInstall:surnameInstall,subj_id:subj_id},
				cache:false,
				beforeSend:function(){
					$(".errorMatricInstall").removeAttr("hidden");
					$(".errorMatricInstall").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
				},
				success:function(e){
					console.log(e);
					console.log(e.length);
					if(e.length>2){
						$(".errorMatricInstall").removeAttr("hidden");
						$(".errorMatricInstall").attr("style","color:red;");
						$(".errorMatricInstall").html(" "+e);
					}
					else{
						$(".errorMatricInstall").removeAttr("hidden");
						$(".errorMatricInstall").html("<small style='color:green;'> Registration Completed...</small>");
						$("#nameInstall").val("");
						$("#surnameInstall").val("");
						$("#subj_id").val("");
						
						window.location=("./?_=pastpapers&_-=matric");
					}
				}
			});
		}
    });
	$("#matrico").click(function(){
		const name=$("#name").val();
		const surname=$("#surname").val();
		const institution=$("#institution").val();
		const grade=$("#grade").val();
		if(name=="" || surname=="" || institution=="" || grade==""){
			$(".errorMatric").removeAttr("hidden");
			$(".errorMatric").html("<small style='color:red;background-color:#000;'>All Fields Are Required!..</small>");
		}
		else{
			console.log(name+" "+surname+" "+institution+" "+grade);
			$.ajax({
				url:"controler/upload.php?matric",
				type:"POST",
				data:{name:name,surname:surname,institution:institution,grade:grade},
				cache:false,
				beforeSend:function(){
					$(".errorMatric").removeAttr("hidden");
					$(".errorMatric").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
				},
				success:function(e){
					console.log(e);
					console.log(e.length);
					if(e.length>2){
						$(".errorMatric").removeAttr("hidden");
						$(".errorMatric").attr("style","color:red;");
						$(".errorMatric").html(" <br>Error 320 : "+e);
					}
					else{
						$(".errorMatric").removeAttr("hidden");
						$(".errorMatric").html("<small style='color:green;'> SENT..</small>");
						$("#name").val("");
						$("#surname").val("");
						$("#institution").val("");
						$("#grade").val("");
						window.location=("./?_=pastpapers");
					}
				}
			});
		}
	});
	$("#studyAreaMathReply").click(function(){
		const studyAreaMathInputReply=$("#studyAreaMathInputReply").val();
		const studyAreaMathTextReply=$("#studyAreaMathTextReply").val();
		const p_id=$("#post_id").val();

		// console.log(studyAreaMathTextReply);
		if(p_id==""){
			$(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
			$(".errorDisplayermessageStudyAreaReply").html("<small style='color:red;background-color:#000;'>Title is Required</small>");
		}
		else{
			if(studyAreaMathInputReply=="" && studyAreaMathTextReply==""){
				$(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
				$(".errorDisplayermessageStudyAreaReply").html("<small style='color:red;'>Cannot send empty file/Text!!..</small>");
			}
			else{
				var form_data=new FormData();
				var file="";
				if(studyAreaMathInputReply!=""){
					file=document.getElementById('studyAreaMathInputReply').files[0].name;
				}
				var ext=file.split('.').pop().toLowerCase();
				const array=["mp4","mv","png","jpg","jpeng","heic","MP4","MV","PNG","JPG","HEIC","JPEG","gif","GIF"];
				if(jQuery.inArray(ext,array)==-1 && file!=""){
					$(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
					$(".errorDisplayermessageStudyAreaReply").html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic} Format </small>");

				}
				else{
					if(studyAreaMathInputReply!=""){
						form_data.append("file",document.getElementById("studyAreaMathInputReply").files[0]);
					}
					else{
						form_data.append("file",file);
					}
					form_data.append("p_id",p_id);
					form_data.append("studyAreaMathTextReply",studyAreaMathTextReply);
					
					$(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
					$(".errorDisplayermessageStudyAreaReply").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
					$.ajax({
						url:"controler/upload.php?studyareareply=2",
						type:"POST",
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						beforeSend:function(){
							$(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
							$(".errorDisplayermessageStudyAreaReply").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
						},
						success:function(e){
							console.log(e);
							console.log(e.length);
							if(e.length>2){
								$(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
								$(".errorDisplayermessageStudyAreaReply").attr("style","color:red;");
								$(".errorDisplayermessageStudyAreaReply").html(" "+e);
							}
							else{
								$(".errorDisplayermessageStudyAreaReply").removeAttr("hidden");
								$(".errorDisplayermessageStudyAreaReply").html("<small style='color:green;'> SENT..</small>");
								$("#studyAreaMathTextReply").val("");
								$("#studyAreaMathInputReply").val("");
								window.location=("./?_=studyarea&__=studyAreaReply&_-="+p_id);
								
							}
						}
					});
				}
			}
		}
			
	});
	$("#studyAreaMathCodeSubmitReply").click(function(){
		const code=$("#studyAreaMathCodeReply").val();
		const p_id=$("#post_id2").val();
		console.log(p_id);
		if(p_id==""){
			$(".errorDisplayermessageStudyAreaCodeReply").removeAttr("hidden");
			$(".errorDisplayermessageStudyAreaCodeReply").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
			$(".errorDisplayermessageStudyAreaCodeReply").html("PostId is required!!..");

		}
		else if(code==""){
			$("#studyAreaMathCodeReply").attr("placeholder","CAN NOT SEND EMPTY CODE!!.. ");
		}
		else{
			
			$.ajax({
				url:"controler/upload.php?studyareareply=1",
				type:"POST",
				data:{code:code,p_id:p_id},
				cache:false,
				beforeSend:function(){
					$("#studyAreaMathCodeReply").attr("placeholder","Sending Message...");
				},
				success:function(e){

					console.log(e.length);
					if(e.length>2){
						$(".errorDisplayermessageStudyAreaCodeReply").removeAttr("hidden");
						$(".errorDisplayermessageStudyAreaCodeReply").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
						$(".errorDisplayermessageStudyAreaCodeReply").html(""+e);
					}
					else{
						$("#studyAreaMathCodeReply").val("");
						$("#studyAreaMathCodeReply").attr("placeholder","Type Your Message ...");
						window.location=("./?_=studyarea&__=studyAreaReply&_-="+p_id);
					}
				}
			});
		}
	});
	$("#studyAreaMathCodeSubmit").click(function(){
		const code=$("#studyAreaMathCode").val();
		const title=$("#studyAreaMathTitleCode").val();
		if(title==""){
			$(".errorDisplayermessageStudyAreaCode").removeAttr("hidden");
			$(".errorDisplayermessageStudyAreaCode").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
			$(".errorDisplayermessageStudyAreaCode").html("Title is required!!..");

		}
		else if(code==""){
			$("#studyAreaMathCode").attr("placeholder","CAN NOT SEND EMPTY CODE!!.. ");
		}
		else{
			
			$.ajax({
				url:"controler/upload.php?studyarea=2",
				type:"POST",
				data:{code:code,title:title},
				cache:false,
				beforeSend:function(){
					$("#studyAreaMathCode").attr("placeholder","Sending Message...");
				},
				success:function(e){

					console.log(e.length);
					if(e.length>2){
						$(".errorDisplayermessageStudyAreaCode").removeAttr("hidden");
						$(".errorDisplayermessageStudyAreaCode").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
						$(".errorDisplayermessageStudyAreaCode").html(" <br>Error 320 : "+e);
					}
					else{
						$("#studyAreaMathCode").val("");
						$("#studyAreaMathCode").attr("placeholder","Type Your Message ...");
						window.location=("./?_=studyarea");
					}
				}
			});
		}
	});
	$("#studyAreaMath").click(function(){
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
					$(".errorDisplayermessageStudyArea").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
					$.ajax({
						url:"controler/upload.php?studyarea=1",
						type:"POST",
						data:form_data,
						contentType:false,
						cache:false,
						processData:false,
						beforeSend:function(){
							$(".errorDisplayermessageStudyArea").removeAttr("hidden");
							$(".errorDisplayermessageStudyArea").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
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
								window.location=("./?_=studyarea")
								
							}
						}
					});
				}
			}
		}
			
	});
	$("#messageB").click(function(){
		const messageFileUpload=$("#messageFileUpload").val();
		const messageTextUpload=$("#messageTextUpload").val();
		const other=$("#other").val();
		console.log(messageTextUpload);
		if(messageFileUpload==""){
			$(".errorDisplayermessage").removeAttr("hidden");
			$(".errorDisplayermessage").html("<small style='color:red;'>Cannot send empty file!!..</small>");
		}
		else{
			var file=document.getElementById('messageFileUpload').files[0].name;
			var form_data=new FormData();
			var ext=file.split('.').pop().toLowerCase();
			const array=["mp4","mv","png","jpg","jpeng","heic","MP4","MV","PNG","JPG","JPEG","jpeg","JPENG","HEIC","gif","GIF"];
			if(jQuery.inArray(ext,array)==-1){
				$(".errorDisplayermessage").removeAttr("hidden");
				$(".errorDisplayermessage").html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic} Format </small>")

			}
			else{
				form_data.append("file",document.getElementById("messageFileUpload").files[0]);
				form_data.append("messageTextUpload",messageTextUpload);
				form_data.append("other",other);
				$(".errorDisplayermessage").removeAttr("hidden");
				$(".errorDisplayermessage").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
				$.ajax({
					url:"controler/upload.php?personal=2",
					type:"POST",
					data:form_data,
					contentType:false,
					cache:false,
					processData:false,
					beforeSend:function(){
						$(".errorDisplayermessage").removeAttr("hidden");
						$(".errorDisplayermessage").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
					},
					success:function(e){
						console.log(e);
						console.log(e.length);
						if(e.length>2){
							$(".errorDisplayermessage").removeAttr("hidden");
							$(".errorDisplayermessage").attr("style","color:red;");
							$(".errorDisplayermessage").html(" <br>Error 320 : "+e);
						}
						else{
							$(".errorDisplayermessage").removeAttr("hidden");
							$(".errorDisplayermessage").html("<small style='color:green;'> SENT..</small>");
							$("#messageTextUpload").val("");
							$("#messageFileUpload").val("");
							
						}
					}
				});
			}
		}
	});
	$(".chatSubmitPersonal").click(function(){
		const mess=$(".chatAreaPersonal").val();
		if(mess==""){
			$(".chatAreaPersonal").attr("placeholder","CAN NOT SEND EMPTY MESSAGE!!.. ");
		}
		else{
			const a=$("#b").val();
			$.ajax({
				url:"controler/upload.php?personal=1",
				type:"POST",
				data:{mess:mess,a:a},
				cache:false,
				beforeSend:function(){
					$(".chatAreaPersonal").attr("placeholder","Sending Message...");
				},
				success:function(e){

					console.log(e.length);
					if(e.length>2){
						$(".submitButtonPersonal").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
						$(".submitButtonPersonal").html(" <br>Error 320 : "+e);
					}
					else{
						$(".chatAreaPersonal").val("");
						$(".chatAreaPersonal").attr("placeholder","Type Your Message ...");
					}
				}
			});
		}
	});
	$(document).on('change','#profilePost',function(){
		$(".errorDisplayerProfile").removeAttr("hidden");
		$(".errorDisplayerProfile").html("<small><img style='width:3%;' src='../../default-img/loader.gif'> <span style='color:green;'>Analysing File Data...</span></small>");
        const image=$("#profilePost").val();
    	var form_data=new FormData();
		var file="";
		if(image!=""){
			file=document.getElementById("profilePost").files[0].name;
		}
		var ext=file.split('.').pop().toLowerCase();
		const array=["jpg","png","jpeg","jpeng","heic","JPG","PNG","JPEG","JPENG","HEIC","GIF","gif"];
		if(jQuery.inArray(ext,array)==-1 && file!=""){
			$(".errorDisplayerProfile").removeAttr("hidden");
			$(".errorDisplayerProfile").html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic} Format </small>");

		}
		else{
			if(image!=""){
				form_data.append("file",document.getElementById("profilePost").files[0]);
			}
			else{
				form_data.append("file",file);
			}
			console.log(file);
			$.ajax({
				url:"controler/upload.php?updateProfile",
				type:"POST",
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$(".errorDisplayerProfile").removeAttr("hidden");
					$(".errorDisplayerProfile").html("<img style='width:3%;' src='../view/../../default-img/loader.gif'><h5 style='color:#fff;'>UPLOADING..</h5>");
				},
				success:function(e){
					
					if(e.length>2){
						$(".errorDisplayerProfile").removeAttr("hidden");
						$(".errorDisplayerProfile").attr("style","color:red;");
						$(".errorDisplayerProfile").html(e);
					}
					else{
						$(".errorDisplayerProfile").removeAttr("hidden");
						$(".errorDisplayerProfile").html("<small style='color:green;'> Profile updated successfuly</small>");
						$("#profilePost").val("");
						
                        
					}
				}
			});
		}
	});
	$("#postImg").click(function(){
		const data=$("#textPost").val();
		const img=$("#imgPost").val();
		
		if(data=="" && img==""){
			$(".errorDisplayer").removeAttr("hidden");
			$(".errorDisplayer").html("<small style='color:red;'>Cannot upload 'Empty Post'</small>");
		}
		else{
			var file=document.getElementById('imgPost').files[0].name;
			var form_data=new FormData();
			var ext=file.split('.').pop().toLowerCase();
			const array=["jpg","png","jpeng","gif","heic","jpeg","JPEG","JPENG","PNG","JPG","GIF","HEIC"];
			if(jQuery.inArray(ext,array)==-1){
				$(".errorDisplayer").removeAttr("hidden");
				$(".errorDisplayer").html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic} Format </small>")

			}
			else{
				form_data.append("file",document.getElementById("imgPost").files[0]);
				form_data.append("data",data);
				$(".errorDisplayer").removeAttr("hidden");
				$(".errorDisplayer").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
				$.ajax({
					url:"controler/upload.php?my_post=1",
					type:"POST",
					data:form_data,
					contentType:false,
					cache:false,
					processData:false,
					beforeSend:function(){
						$(".errorDisplayer").removeAttr("hidden");
						$(".errorDisplayer").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
					},
					success:function(e){
						console.log(e);
						console.log(e.length);
						if(e.length>2){
							$(".errorDisplayer").removeAttr("hidden");
							$(".errorDisplayer").attr("style","color:red;");
							$(".errorDisplayer").html(" <br>Error 320 : "+e);
						}
						else{
							$(".errorDisplayer").removeAttr("hidden");
							$(".errorDisplayer").html("<small style='color:green;'>UPLOADED SUCCESSFULLY..</small>");
							$("#textPost").val("");
							$("#imgPost").val("");
							window.location=("./?_=my-post")
							
						}
					}
				});
			}
		}
	});
	$("#search_btn").click(function(){
		const search_query=$("#search_query").val();
		const search_type=$("#search_type").val();
		let temp=true;
		if(search_query==""){
			$("#search_query").attr("placeholder","Can`t search Empty search");
			temp=false;
		}
		if(search_type==""){
			$("#search_type").attr("placeholder","Can`t search Empty search");
			temp=false;
		}
		if(temp){
			console.log("true");
		}
	});
	$("#visita").click(function(){
		window.location=("./?_=my-account");
	});
	$("#visitb").click(function(){
		window.location=("./?_=my-account");
	});
	$("#paycard").click(function(){
		$(".payCard_online").removeAttr("hidden");
		$(".payCard_online").removeAttr("disabled");
		$("#proofofpayment").removeAttr("disabled");
		$(".PayCash_details").attr("hidden",true);
		$(".PayCash_details").attr("disabled",true);
	});
	$(document).on('change','#proofofpayment',function(){
		$("#proofofpaymenterror").removeAttr("hidden");
		$("#proofofpaymenterror").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

		var file=document.getElementById('proofofpayment').files[0].name;
		var form_data=new FormData();
		var ext=file.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext,['pdf'])==-1){
			$("#proofofpaymenterror").removeAttr("hidden");
			$("#proofofpaymenterror").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

		}
		else{
			$("#proofofpaymenterror").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Processing File Data...</span></small>");
			form_data.append("file",document.getElementById("proofofpayment").files[0]);
			$("#proofofpaymenterror").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
			$.ajax({
				url:"controler/upload.php?step=8",
				type:"POST",
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$("#proofofpaymenterror").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
				},
				success:function(e){
					console.log(e.length);
					if(e.length>2){
						$("#proofofpaymenterror").attr("style","color:red;");
						$("#proofofpaymenterror").html(" <br>Error 320 : "+e);
					}
					else{
						
						$("#proofofpaymenterror").html("<small style='color:green;'>UPLOADED SUCCESSFULLY..</small>");
						window.location=("./?_=apply");
						
					}
				}
			});
		}
	});
	$("#paycash").click(function(){
		$(".PayCash_details").removeAttr("hidden");
		$(".PayCash_details").removeAttr("disabled");
		$("#proofofpayment").removeAttr("disabled");
		$(".payCard_online").attr("hidden",true);
		$(".payCard_online").attr("disabled",true);

	});
	$("#acceptcondition").click(function(){
		
		const accept=$("#accept").val();
		if(accept=="No"){
			alert("Are you sure you want to cancel your Application?");
		}
		$.ajax({
			url:"controler/upload.php?step=7",
			type:"POST",
			data:{accept:accept},
			cache:false,
			beforeSend:function(){
				$("#acceptcondition").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting Data...</span></small>");
			},
			success:function(e){
				console.log(e.length);
				if(e.length>2){
					$("#acceptcondition").html("ERROR:  :"+e);
					$("#acceptcondition").attr("style","color:red;background-color:#000;");
					$("#acceptconditionerror").removeAttr("hidden");
					$("#acceptconditionerror").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
					$("#acceptconditionerror").html(" <br>Error 320 : "+e);
				}

				else{
					$("#acceptcondition").html("Application Submitted!!");
					window.location=("./?_=apply");	
				}
			}
		});
		
	});
	$(document).on('change','#idcopy',function(){
		$("#erroridcopy").removeAttr("hidden");
		$("#erroridcopy").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

		var file=document.getElementById('idcopy').files[0].name;
		var form_data=new FormData();
		var ext=file.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext,['pdf'])==-1){
			$("#erroridcopy").removeAttr("hidden");
			$("#erroridcopy").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

		}
		else{
			$("#erroridcopy").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Processing File Data...</span></small>");
			form_data.append("file",document.getElementById("idcopy").files[0]);
			$("#erroridcopy").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
			$.ajax({
				url:"controler/upload.php?step=5&file=1",
				type:"POST",
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$("#erroridcopy").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
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
		$("#errorfinalresults").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

		var file=document.getElementById('finalresults').files[0].name;
		var form_data=new FormData();
		var ext=file.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext,['pdf'])==-1){
			$("#errorfinalresults").removeAttr("hidden");
			$("#errorfinalresults").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

		}
		else{
			$("#errorfinalresults").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Processing File Data...</span></small>");
			form_data.append("file",document.getElementById("finalresults").files[0]);
			$("#errorfinalresults").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
			$.ajax({
				url:"controler/upload.php?step=5&file=2",
				type:"POST",
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$("#errorfinalresults").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
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
		$("#errorproofresident").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

		var file=document.getElementById('proofresident').files[0].name;
		var form_data=new FormData();
		var ext=file.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext,['pdf'])==-1){
			$("#errorproofresident").removeAttr("hidden");
			$("#errorproofresident").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

		}
		else{
			$("#errorproofresident").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Processing File Data...</span></small>");
			form_data.append("file",document.getElementById("proofresident").files[0]);
			$("#errorproofresident").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
			$.ajax({
				url:"controler/upload.php?step=5&file=3",
				type:"POST",
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$("#errorproofresident").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
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
		$("#errorguardianid").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

		var file=document.getElementById('guardianid').files[0].name;
		var form_data=new FormData();
		var ext=file.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext,['pdf'])==-1){
			$("#errorguardianid").removeAttr("hidden");
			$("#errorguardianid").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

		}
		else{
			$("#errorguardianid").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Processing File Data...</span></small>");
			form_data.append("file",document.getElementById("guardianid").files[0]);
			$("#errorguardianid").html("<small><img style='width:8%;' src='../../default-img/loader.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
			$.ajax({
				url:"controler/upload.php?step=5&file=4",
				type:"POST",
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$("#errorguardianid").html("<img style='width:10%;' src='../../default-img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
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
						$("#_submit_").html("<img style='width:8%;' src='../../default-img/loader.gif'> Navigating to next step...");


						window.location=("./?_=apply");
						
					}
				}
			});
		}
	});
		
	
	$("#_5_").click(function(){
		let tracker=true;
		const schoolname=$("#schoolname").val();
		if(schoolname==""){
			$("#errorschoolname").removeAttr("hidden");
			$("#errorschoolname").html("<small style='color:red;'>* Field Required </small>")
			tracker=false;
		}
		const street=$("#street").val();
		if(street==""){
			$("#errorstreet").removeAttr("hidden");
			$("#errorstreet").html("<small style='color:red;'>* Field Required </small>")
			tracker=false;
		}
		const suburb=$("#suburb").val();
		if(suburb==""){
			$("#errorsuburb").removeAttr("hidden");
			$("#errorsuburb").html("<small style='color:red;'>* Field Required </small>")
			tracker=false;
		}
		const town=$("#town").val();
		if(town==""){
			$("#errortown").removeAttr("hidden");
			$("#errortown").html("<small style='color:red;'>* Field Required </small>")
			tracker=false;
		}
		const province=$("#province").val();
		if(province==""){
			$("#errorprovince").removeAttr("hidden");
			$("#errorprovince").html("<small style='color:red;'>* Field Required </small>")
			tracker=false;
		}
		const postal=$("#postal").val();
		if(postal==""){
			$("#errorpostal").removeAttr("hidden");
			$("#errorpostal").html("<small style='color:red;'>* Field Required </small>")
			tracker=false;
		}
		const yearcompleted=$("#yearcompleted").val();
		if(yearcompleted==""){
			$("#erroryearcompleted").removeAttr("hidden");
			$("#erroryearcompleted").html("<small style='color:red;'>* Field Required </small>")
			tracker=false;
		}
		const activity=$("#activity").val();
		if(activity==""){
			$("#erroractivity").removeAttr("hidden");
			$("#erroractivity").html("<small style='color:red;'>* Field Required </small>")
			tracker=false;
		}
		const eduhistory=$("#eduhistory").val();
		const uni=$("#uni").val();
		const studentnumber=$("#studentnumber").val();
		const statuscompletion=$("#statuscompletion").val();
		if(eduhistory==""){
			$("#erroreduhistory").removeAttr("hidden");
			$("#erroreduhistory").html("<small style='color:red;'>* Field Required </small>")
			tracker=false;
		}
		else{
			if(eduhistory=="Yes"){
				if(uni==""){
					$("#erroruni").removeAttr("hidden");
					$("#erroruni").html("<small style='color:red;'>* Field Required </small>")
					tracker=false;
				}
				if(studentnumber==""){
					$("#errorstudentnumber").removeAttr("hidden");
					$("#errorstudentnumber").html("<small style='color:red;'>* Field Required </small>")
					tracker=false;
				}
				if(statuscompletion==""){
					$("#errorstatuscompletion").removeAttr("hidden");
					$("#errorstatuscompletion").html("<small style='color:red;'>* Field Required </small>")
					tracker=false;
				}
			}
		}
		
		// let idcopy=$("#idcopy").val();
		// if(idcopy==""){
		// 	$("#erroridcopy").removeAttr("hidden");
		// 	$("#erroridcopy").html("<small style='color:red;'>* Field Required </small>")
		// 	tracker=false;
		// }
		// let finalresults=$("#finalresults").val();
		// if(finalresults==""){
		// 	$("#errorfinalresults").removeAttr("hidden");
		// 	$("#errorfinalresults").html("<small style='color:red;'>* Field Required </small>")
		// 	tracker=false;
		// }
		// let proofresident=$("#proofresident").val();
		// if(proofresident==""){
		// 	$("#errorproofresident").removeAttr("hidden");
		// 	$("#errorproofresident").html("<small style='color:red;'>* Field Required </small>")
		// 	tracker=false;
		// }
		// let guardianid=$("#guardianid").val();
		// if(guardianid==""){
		// 	$("#errorguardianid").removeAttr("hidden");
		// 	$("#errorguardianid").html("<small style='color:red;'>* Field Required </small>")
		// 	tracker=false;
		// }
		console.log("processing");
		// console.log("Changing Activity");
		// idcopy=document.getElementById('idcopy').files[0].name;
		// finalresults=document.getElementById('finalresults').files[0].name;
		// proofresident=document.getElementById('proofresident').files[0].name;
		// guardianid=document.getElementById('guardianid').files[0].name;
		// console.log(idcopy);
		// console.log(finalresults);
		// console.log(proofresident);
		// console.log(guardianid);

		if(tracker){
			$("#_5_").html("<img style='width:8%;' src='../../default-img/loader.gif'> submitting request...");
			$.ajax({
				url:"controler/upload.php?step=5",
				type:"POST",
				data:{schoolname:schoolname,street:street,suburb:suburb,town:town,province:province,postal:postal,yearcompleted:yearcompleted,activity:activity,eduhistory:eduhistory,uni:uni,studentnumber:studentnumber,statuscompletion:statuscompletion
				},
				cache:false,
				success:function(e){
					console.log(e.length);
					if(e.length>2){
						$("#_5_").html("ERROR: ");
						$("#_5_").attr("style","color:red;background-color:#000;");
						$(".errorCatch5").removeAttr("hidden");
						$(".errorCatch5").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
						$(".errorCatch5").html(" <br>Error 320 : "+e);
					}
					else{
						$("#_5_").html("<img style='width:10%;' src='../../default-img/loader.gif'> processing data!!..");
						$("#fname").val("");
						$("#lname").val("");
						$("#relationship").val("");
						$("#employed").val("");
						$("#alphone").val("");
						$("#email").val("");
						$("#phone").val("");
						$("#street").val("");
						$("#suburb").val("");
						$("#town").val("");
						$("#province").val("");
						$("#postal").val("");
						window.location=("./?_=apply");
					}
				}
			});
		}

	});
	$("#eduhistory").click(function(){
		const choice=$("#eduhistory").val();
		if(choice=="Yes"){
			$("#ExtraEdit").removeAttr("hidden");
			$("#ExtraEdit1").removeAttr("hidden");
			$("#ExtraEdit2").removeAttr("hidden");


		}
		else{
			$("#ExtraEdit").attr("hidden",true);
			$("#ExtraEdit1").attr("hidden",true);
			$("#ExtraEdit2").attr("hidden",true);
		}
	});
	$("#_4_").click(function(){
		let tracker=true;
		const fname=$("#fname").val();
		if(fname==""){
			$("#errorfname").removeAttr("hidden");
			$("#errorfname").html("<small style='color:red;'>* Field Required </small>");
			tracker=false;
		}
		const lname=$("#lname").val();
		if(lname==""){
			$("#errorlname").removeAttr("hidden");
			$("#errorlname").html("<small style='color:red;'>* Field Required </small>");
			tracker=false;
		}
		const relationship=$("#relationship").val();
		if(relationship==""){
			$("#errorrelationship").removeAttr("hidden");
			$("#errorrelationship").html("<small style='color:red;'>* Field Required </small>");
			tracker=false;
		}
		const employed=$("#employed").val();
		if(employed==""){
			$("#erroremployed").removeAttr("hidden");
			$("#erroremployed").html("<small style='color:red;'>* Field Required </small>");
			tracker=false;
		}
		const alphone=$("#alphone").val();
		if(alphone==""){
			$("#erroralphone").removeAttr("hidden");
			$("#erroralphone").html("<small style='color:red;'>* Field Required </small>");
			tracker=false;
		}
		const email=$("#email").val();
		if(email==""){
			$("#erroremail").removeAttr("hidden");
			$("#erroremail").html("<small style='color:red;'>* Field Required </small>");
			tracker=false;
		}
		
		if(email!="" && !validEmail(email)){
			$("#erroremail").removeAttr("hidden");
			$("#erroremail").html("<small style='color:red;'>* Email Address Not Valid, Enter Valid Email </small>");
			tracker=false;
		}
		const phone=$("#phone").val();
		if(phone==""){
			$("#errorphone").removeAttr("hidden");
			$("#errorphone").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const street=$("#street").val();
		if(street==""){
			$("#errorstreet").removeAttr("hidden");
			$("#errorstreet").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const suburb=$("#suburb").val();
		if(suburb==""){
			$("#errorsuburb").removeAttr("hidden");
			$("#errorsuburb").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const town=$("#town").val();
		if(town==""){
			$("#errortown").removeAttr("hidden");
			$("#errortown").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const province=$("#province").val();
		if(province==""){
			$("#errorprovince").removeAttr("hidden");
			$("#errorprovince").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const postal=$("#postal").val();
		if(postal==""){
			$("#errorpostal").removeAttr("hidden");
			$("#errorpostal").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		console.log(tracker);
		if(tracker){
			$("#_4_").html("<img style='width:10%;' src='../../default-img/loader.gif'> submitting request...");
			$.ajax({
				url:"controler/upload.php?step=4",
				type:"POST",
				data:{fname:fname,lname:lname,relationship:relationship,employed:employed,alphone:alphone,email:email,phone:phone,street:street,suburb:suburb,town:town,province:province,postal:postal
				},
				cache:false,
				success:function(e){
					console.log(e.length);
					if(e.length>2){
						$("#_4_").html("ERROR: ");
						$("#_4_").attr("style","color:red;background-color:#000;");
						$(".errorCatch4").removeAttr("hidden");
						$(".errorCatch4").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
						$(".errorCatch4").html(" <br>Error 320 : "+e);
					}
					else{
						$("#_3_").html("<img style='width:10%;' src='../../default-img/loader.gif'> PROCESSING FORWARD!!..");
						$("#fname").val("");
						$("#lname").val("");
						$("#relationship").val("");
						$("#employed").val("");
						$("#alphone").val("");
						$("#email").val("");
						$("#phone").val("");
						$("#street").val("");
						$("#suburb").val("");
						$("#town").val("");
						$("#province").val("");
						$("#postal").val("");
						window.location=("./?_=apply");
					}
				}
			});
		}
		
	});
	$("#_3_").click(function(){
		let tracker=true;
		const street=$("#street").val();
		if(street==""){
			$("#errorstreet").removeAttr("hidden");
			$("#errorstreet").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const suburb=$("#suburb").val();
		if(suburb==""){
			$("#errorsuburb").removeAttr("hidden");
			$("#errorsuburb").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const town=$("#town").val();
		if(town==""){
			$("#errortown").removeAttr("hidden");
			$("#errortown").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const province=$("#province").val();
		if(province==""){
			$("#errorprovince").removeAttr("hidden");
			$("#errorprovince").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const postal=$("#postal").val();
		if(postal==""){
			$("#errorpostal").removeAttr("hidden");
			$("#errorpostal").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const phone=$("#phone").val();
		if(phone==""){
			$("#errorphone").removeAttr("hidden");
			$("#errorphone").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const telephone=$("#telephone").val();
		if(telephone==""){
			$("#errortelephone").removeAttr("hidden");
			$("#errortelephone").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const email=$("#email").val();
		if(email==""){
			$("#erroremail").removeAttr("hidden");
			$("#erroremail").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const res=$("#res").val();
		const dis=$("#res").val();
		if(res==""){
			$("#errorres").removeAttr("hidden");
			$("#errorres").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		if(dis==""){
			$("#errordis").removeAttr("hidden");
			$("#errordis").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		console.log(tracker);
		if(tracker){
			$("#_3_").html("<img style='width:10%;' src='../../default-img/loader.gif'> submitting request...");
			$.ajax({
				url:"controler/upload.php?step=3",
				type:"POST",
				data:{street:street,suburb:suburb,town:town,province:province,postal:postal,phone:phone,telephone:telephone,email:email,res:res,dis:dis
				},
				cache:false,
				success:function(e){
					console.log(e.length);
					if(e.length>2){
						$("#_3_").html("ERROR: ");
						$("#_3_").attr("style","color:red;background-color:#000;");
						$(".errorCatch3").removeAttr("hidden");
						$(".errorCatch3").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
						$(".errorCatch3").html(" <br>Error 320 : "+e);
					}
					else{
						$("#_3_").html("<img style='width:10%;' src='../../default-img/loader.gif'> PROCESSING FORWARD!!..");
						$("#street").val("");
						$("#suburb").val("");
						$("#town").val("");
						$("#province").val("");
						$("#postal").val("");
						$("#phone").val("");
						$("#telephone").val("");
						$("#email").val("");
						$("#resYes").val("");
						$("#resNo").val("");
						$("#disYes").val("");
						$("#disNo").val("");
						window.location=("./?_=apply");
					}
				}
			});
		}
	});
	$(".btnn").click(function(){
		let tracker=true;
		console.log("tracker:"+tracker);
		const sa=$("#sa").val();

		if(sa==""){
			$(".errorMessage").removeAttr("hidden");
			$(".errorMessage").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}

		const passport=$("#passport").val();
		const idNumber=$("#idNumber").val();
		if(sa=="yes"){
			if(idNumber==""){
				$(".errorMessage").removeAttr("hidden");
				$(".errorMessage").html("<small style='color:red;'>* SA ID NUMBER Required</small>");
				tracker=false;
			}
			else{
				if(idNumber.length!=13){
					$(".errorMessage").removeAttr("hidden");
					$(".errorMessage").html("<small style='color:red;'>* SA ID NUMBER must be 13 digit long</small>");
					tracker=false;

				}
				else{
					if(!isValid(idNumber)){
						$(".errorMessage").removeAttr("hidden");
						$(".errorMessage").html("<small style='color:red;'>* NOT VALID SA ID!!..</small>");
						tracker=false;
					}
				}
			}
		}
		if(passport=="" && idNumber==""){
			$(".errorMessage").removeAttr("hidden");
			$(".errorMessage").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		if(passport!="" && idNumber!=""){
			$(".errorMessage").removeAttr("hidden");
			$(".errorMessage").html("<small style='color:red;'>* only Once field must be selected</small>");
			tracker=false;
		}
		const gender=$("#gender").val();
		if(gender==""){
			$("#errorgender").removeAttr("hidden");
			$("#errorgender").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
		const dob=$("#dob").val();
		if(dob==""){
			$("#errordob").removeAttr("hidden");
			$("#errordob").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const title=$("#title").val();
		if(title==""){
			$("#errortitle").removeAttr("hidden");
			$("#errortitle").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const initials=$("#initials").val();
		if(initials==""){
			$("#errorinitials").removeAttr("hidden");
			$("#errorinitials").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const lname=$("#lname").val();
		if(lname==""){
			$("#errorlname").removeAttr("hidden");
			$("#errorlname").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const fname=$("#fname").val();
		if(fname==""){
			$("#errorfname").removeAttr("hidden");
			$("#errorfname").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const status=$("#status").val();
		if(status==""){
			$("#errorstatus").removeAttr("hidden");
			$("#errorstatus").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const hlang=$("#hlang").val();
		if(hlang==""){
			$("#errorhlang").removeAttr("hidden");
			$("#errorhlang").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const EthnicGroup=$("#EthnicGroup").val();
		if(EthnicGroup==""){
			$("#errorEthnicGroup").removeAttr("hidden");
			$("#errorEthnicGroup").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const Employed=$("#Employed").val();
		if(Employed==""){
			$("#errorEmployed").removeAttr("hidden");
			$("#errorEmployed").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const hear=$("#hear").val();
		if(hear==""){
			$("#errorhear").removeAttr("hidden");
			$("#errorhear").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}
			const bursary=$("#bursary").val();
		if(bursary==""){
			$("#errorbursary").removeAttr("hidden");
			$("#errorbursary").html("<small style='color:red;'>* Field Required</small>");
			tracker=false;
		}

		console.log("updated tracker:"+tracker);
		if(!tracker){
			$("#_1_").html("Submit");
		}
		else{
			$("#_1_").html("<img style='width:10%;' src='../../default-img/loader.gif'> submitting request...");
			$.ajax({
				url:"controler/upload.php?step=2",
				type:"POST",
				data:{sa:sa,passport:passport,idNumber:idNumber,gender:gender,dob:dob,title:title,initials:initials,lname:lname,fname:fname,status:status,hlang:hlang,EthnicGroup:EthnicGroup,Employed:Employed,hear:hear,bursary:bursary
				},
				cache:false,
				success:function(e){
					console.log(e.length);
					if(e.length>2){
						$("#_1_").html("ERROR: ");
						$("#_1_").attr("style","color:red;background-color:#000;");
						$(".errorCatch2").removeAttr("hidden");
						$(".errorCatch2").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
						$(".errorCatch2").html(" <br>Error 320 : "+e);
					}
					else{
						$("#_1_").html("<img style='width:10%;' src='../../default-img/loader.gif'> PROCESSING FORWARD!!..");
						$("#sa").val("");
						$("#passport").val("");
						$("#idNumber").val("");
						$("#gender").val("");
						$("#dob").val("");
						$("#title").val("");
						$("#initials").val("");
						$("#lname").val("");
						$("#fname").val("");
						$("#status").val("");
						$("#hlang").val("");
						$("#EthnicGroup").val("");
						$("#Employed").val("");
						$("#hear").val("");
						$("#bursary").val("");
						window.location=("./?_=apply");
					}
				}
			});
		}
	});
	$("#sa").click(function(){
		if($("#sa").val()=="Yes"){
			$(".southafrican").removeAttr("hidden");
			$(".foreign").attr("hidden",true);
		}
		else{
			if($("#sa").val()=="No"){
				$(".foreign").removeAttr("hidden");
				$(".southafrican").attr("hidden",true);
			}
		}

	});
	$("#beginAppProcess").click(function(){

		$(".applyBtn").attr("hidden",true);
		$(".firstStep").removeAttr("hidden");
	});
	$("#step1Btn").click(function(){
		$("#step1Btn").html("<img style='width:10%;' src='../../default-img/loader.gif'> submitting request...");
		var tmp=true;
		const grdlevel=$("#grdlevel").val();
		if(grdlevel==""){
			tmp=false;
			$("#grd").removeAttr("hidden");
			$("#grd").html("<small style='color:red;'>* required</small>");

		}
		const numOfSubj=$("#numOfSubj").val();
		if(numOfSubj==""){
			tmp=false;
			$("#num").removeAttr("hidden");
			$("#num").html("<small style='color:red;'>* required</small>");
					
		}
		const	subjects1=$("#subjects1").val();
		const marksArray=[];
		const subjArray=[];
		subjArray.push(subjects1);
		if(subjects1==""){
			tmp=false;
			$("#subjects1Error").removeAttr("hidden");
			$("#subjects1Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark1=$("#levelMark1").val();
		if(levelMark1==""){
			tmp=false;
			$("#levelMark1Error").removeAttr("hidden");
			$("#levelMark1Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark11=$("#levelMark11").val();
			marksArray.push(levelMark11);
		if(levelMark11==""){
			tmp=false;
			$("#levelMark11Error").removeAttr("hidden");
			$("#levelMark11Error").html("<small style='color:red;'>* required</small>");

		}
			const	subjects2=$("#subjects2").val();
			subjArray.push(subjects2);
		if(subjects2==""){
			tmp=false;
			$("#subjects2Error").removeAttr("hidden");
			$("#subjects2Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark2=$("#levelMark2").val();
		if(levelMark2==""){
			tmp=false;
			$("#levelMark2Error").removeAttr("hidden");
			$("#levelMark2Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark22=$("#levelMark22").val();
			marksArray.push(levelMark22);
		if(levelMark22==""){
			tmp=false;
			$("#levelMark22Error").removeAttr("hidden");
			$("#levelMark22Error").html("<small style='color:red;'>* required</small>");

		}
			const	subjects3=$("#subjects3").val();
			subjArray.push(subjects3);
		if(subjects3==""){
			tmp=false;
			$("#subjects3Error").removeAttr("hidden");
			$("#subjects3Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark3=$("#levelMark3").val();
		if(levelMark3==""){
			tmp=false;
			$("#levelMark3Error").removeAttr("hidden");
			$("#levelMark3Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark33=$("#levelMark33").val();
			marksArray.push(levelMark33);
		if(levelMark33==""){
			tmp=false;
			$("#levelMark33Error").removeAttr("hidden");
			$("#levelMark33Error").html("<small style='color:red;'>* required</small>");

		}
			const	subjects4=$("#subjects4").val();
			subjArray.push(subjects4);
		if(subjects4==""){
			tmp=false;
			$("#subjects4Error").removeAttr("hidden");
			$("#subjects4Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark4=$("#levelMark4").val();
		if(levelMark4==""){
			tmp=false;
			$("#levelMark4Error").removeAttr("hidden");
			$("#levelMark4Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark44=$("#levelMark44").val();
			marksArray.push(levelMark44);
		if(levelMark44==""){
			tmp=false;
			$("#levelMark44Error").removeAttr("hidden");
			$("#levelMark44Error").html("<small style='color:red;'>* required</small>");

		}
			const	subjects5=$("#subjects5").val();
			subjArray.push(subjects5);
		if(subjects5==""){
			tmp=false;
			$("#subjects5Error").removeAttr("hidden");
			$("#subjects5Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark5=$("#levelMark5").val();
		if(levelMark5==""){
			tmp=false;
			$("#levelMark5Error").removeAttr("hidden");
			$("#levelMark5Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark55=$("#levelMark55").val();
			marksArray.push(levelMark55);
		if(levelMark55==""){
			tmp=false;
			$("#levelMark55Error").removeAttr("hidden");
			$("#levelMark55Error").html("<small style='color:red;'>* required</small>");

		}
			const	subjects6=$("#subjects6").val();
			subjArray.push(subjects6);
		if(subjects6==""){
			tmp=false;
			$("#subjects6Error").removeAttr("hidden");
			$("#subjects6Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark6=$("#levelMark6").val();
		if(levelMark6==""){
			tmp=false;
			$("#levelMark6Error").removeAttr("hidden");
			$("#levelMark6Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark66=$("#levelMark66").val();
			marksArray.push(levelMark66);
		if(levelMark66==""){
			tmp=false;
			$("#levelMark66Error").removeAttr("hidden");
			$("#levelMark66Error").html("<small style='color:red;'>* required</small>");

		}
			const	subjects7=$("#subjects7").val();
			subjArray.push(subjects7);
		if(subjects7==""){
			tmp=false;
			$("#subjects7Error").removeAttr("hidden");
			$("#subjects7Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark7=$("#levelMark7").val();
		if(levelMark7==""){
			tmp=false;
			$("#levelMark7Error").removeAttr("hidden");
			$("#levelMark7Error").html("<small style='color:red;'>* required</small>");

		}
			const	levelMark77=$("#levelMark77").val();
			marksArray.push(levelMark77);
		if(levelMark77==""){
			tmp=false;
			$("#levelMark77Error").removeAttr("hidden");
			$("#levelMark77Error").html("<small style='color:red;'>* required</small>");

		}
		const	levelMark88=$("#levelMark88").val();
		const	levelMark99=$("#levelMark99").val();
		const	levelMark1010=$("#levelMark1010").val();
		const	subjects8=$("#subjects8").val();
		const	subjects9=$("#subjects9").val();
		const	subjects10=$("#subjects10").val();
		if(subjects8!=""){
			subjArray.push(subjects8);
		}
		if(subjects9!=""){
			subjArray.push(subjects9);
		}
		if(subjects10!=""){
			subjArray.push(subjects10);
		}
		
		const	levelMark8=$("#levelMark7").val();
		const	levelMark9=$("#levelMark7").val();
		const	levelMark10=$("#levelMark7").val();

		if(levelMark88!=""){
			marksArray.push(levelMark88);
		}
		if(levelMark99!=""){
			marksArray.push(levelMark99);
		}
		if(levelMark1010!=""){
			marksArray.push(levelMark1010);
		}
		if(!tmp){
			$("#step1Btn").html("Submit");
		}
		else{
			var sum=0;
			var index=0;
			let numOfSubjcount=0
			const max=(marksArray.length-1);
			while(index<=max){
				if(subjArray[index]!="10029"){
					console.log(sum+"+"+marksArray[index]+"=");
					sum+=parseInt(marksArray[index]);
					console.log(sum);
					numOfSubjcount++;
					
				}
				else{
					console.log("excluding "+subjArray[index]);
				}
				index++;
				
			}
			const avrg=sum/numOfSubjcount;
			console.log(avrg);
			if(grdlevel==1 && avrg<60){
				$("#step1Btn").html("Submit");
				$(".firstStep").attr("hidden",true);
				$("#dnq").removeAttr("hidden");
			}
			else{
				$.ajax({
					url:"controler/upload.php?step=1",
					type:"POST",
					data:{avrg:avrg,grdlevel:grdlevel,numOfSubj:numOfSubj,subjects1:subjects1,levelMark1:levelMark1,levelMark11:levelMark11,subjects2:subjects2,levelMark2:levelMark2,levelMark22:levelMark22,subjects3:subjects3,levelMark3:levelMark3,levelMark33:levelMark33,subjects4:subjects4,levelMark4:levelMark4,levelMark44:levelMark44,subjects5:subjects5,levelMark5:levelMark5,levelMark55:levelMark55,subjects6:subjects6,levelMark6:levelMark6,levelMark66:levelMark66,subjects7:subjects7,levelMark7:levelMark7,levelMark77:levelMark77,levelMark88:levelMark88,levelMark99:levelMark99,levelMark1010:levelMark1010,subjects8:subjects8,subjects9:subjects9,subjects10:subjects10,levelMark8:levelMark8,levelMark9:levelMark9,levelMark10:levelMark10},
					cache:false,
					success:function(e){
						console.log(e.length);
						if(e.length>2){
							$("#step1Btn").html("ERROR: ");
							$("#step1Btn").attr("style","color:red;background-color:#000;");
							$(".errorCatch").removeAttr("hidden");
							$(".errorCatch").attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
							$(".errorCatch").html(" <br>Error 320 : "+e);
						}
						else{
							console.log("processing forward!!..");
							window.location=("./?_=apply");
						}
					}
				});
			}
			

		}
	});

});
function autoReload(){
	setInterval(function(){
		$(".messageBox").load("controler/displayLiveChat.php");
		$(".messageBox").scrollTop($(".messageBox").prop("scrollHeight"));
	},100);
}
function autoLoadPrivateMessages(otherUser){

	setInterval(function(){
		// console.log(otherUser);
		$(".messageBoxPesornal").load("controler/personal.php?o="+otherUser);
		$(".messageBoxPesornal").scrollTop($(".messageBoxPesornal").prop("scrollHeight"));
	},100);
}
function isValid(idNumber){
	return true;
}
function cd(){
	window.location=("../");
}
function validEmail(email){
	const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	return validRegex.test(email);
}
function DislikePost(post_id){
	$.ajax({
		url:'controler/upload.php?dislike',
		type:'post',
		data:{post_id:post_id},
		success:function(e){
			$("#"+post_id).html(e);
		}
	});
}
function views(post_id){
	$.ajax({
		url:'controler/upload.php?views',
		type:'post',
		data:{post_id:post_id},
		success:function(e){
			console.log(e);
		}
	});
}
function likePost(post_id){
	$.ajax({
		url:'controler/upload.php?like',
		type:'post',
		data:{post_id:post_id},
		success:function(e){
			$("#_"+post_id).html(e);
		}
	});
}
function dofoUsLeg(subj_id){
    window.location=("./?_=eduSgela&_-="+subj_id);
}
function dofoUsLeg1(chapter_id){
    window.location=("./?_=eduSgela&_-_="+chapter_id);
}