<?php /**
All rights reserved.
Copyright (c) 2018 - 2024
"Netchatsa" and its logo are trademarks or registered trademarks of MMS HIGH TECH in South Africa and/or other countries.

This software application is protected by copyright law and international treaties. Unauthorized reproduction or distribution of this program, or any portion of it, may result in severe civil and criminal penalties, and will be prosecuted to the maximum extent possible under the law.

Developed by MMS HIGH TECH
Author: Mr. Msizi S. Mzobe

For inquiries regarding the use of this software, please contact MMS HIGH TECH at 068 515 3023.

*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Netchatsa SGELA is a project implemented by MMS HIGH TECH to make tertiary applications and funding applications easier, affordable and trackable. Tertiary applications, Bursary applications, NSFAS applications, Matric Upgrade, create an account and login to see more features. (::By mms enterprise, netchatsa, Mr MS Mzobe) .&amp; Backups">
    <link rel="canonical" href="https://netchatsa.com/" />
    <meta name="keywords" content="TERTIARY APPLICATIONS, MATRIC UPGRADE, SELF LEARNING, TUTORIALS, PAST EXAM PAPERS, AND LESSONS">
    <meta name="author" content="Mr M.S Mzobe, mms enterprise, netchatsa">
    <link rel="dns-prefetch" href="https://netchatsa.com//s0.wp.com" />
    <link rel="dns-prefetch" href="https://netchatsa.com/" />
    <link rel="dns-prefetch" href="https://fonts.googleapis.com" />
    <link rel="dns-prefetch" href="https://netchatsa.com//s.w.org" />
    <link rel="alternate" type="application/rss+xml" title="The best edu-technology integration  &raquo; Feed" href="https://netchatsa.com/feed/" />
    <link rel="alternate" type="application/rss+xml" title="The best edu-technology integration &raquo; Comments Feed" href="https://netchatsa.com/feed/" />
    <meta property="og:title" content="Netchatsa: Bringing quality education to your hands |(::By mms enterprise)|" />
    <meta property="og:description" content="Netchatsa SGELA is a project implemented by MMS HIGH TECH to make tertiary applications and funding applications easier, affordable and trackable. Tertiary applications, Bursary applications, NSFAS applications, Matric Upgrade, create an account and login to see more features. &amp; Backups" />
    <meta property="og:url" content="https://netchatsa.com" />
    <meta property="og:site_name" content="Netchatsa: The best Edu technology" />

    <link rel="icon" href="img/logo.jpg">
    <title>Netchatsa</title>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Include Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
    <!-- Include jQuery Slim -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Include Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Include Typed.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>

    <!-- Include Waypoints -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>

    <!-- Include Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Include Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<style>
	body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
	background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
}
.main{
	width: 350px;
	height: 600px;
	background: red;
	overflow: hidden;
	background: url("https://img.freepik.com/premium-vector/abstract-realistic-technology-particle-background_23-2148414765.jpg?w=740") no-repeat center/ cover;
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000;
}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
	margin-top: -20%;
}
.signup-y{
	position: relative;
	width:100%;
	height: 40%;
	margin-top: -20%;
}
label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 60px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}
input,select{
	width: 60%;
	height: 40px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px 20px;
	border: none;
	outline: none;
	border-radius: 5px;
}
button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: #573b8a;
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background: #6d44b8;
}
.login{
	height: 520px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-100px);
	transition: .8s ease-in-out;
}
.login label{
	color: #573b8a;
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-430px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}
.email, .pswd{
	padding: 10px 10px;
}

</style>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<div>
					<label for="chk" aria-hidden="true">Sign up</label>
					<select class="indicator">
						<option value='1'>SA ID</option>
						<option value='0'>Passport</option>
					</select>
					<input type="number" class="numberNew" placeholder="ID Number" required="">
					<input type="text" class="name" placeholder="First Name" required="">
					<input type="text" class="surname" placeholder="Last Name" required="">
					<input type="email" class="emailNew" placeholder="Email" required="">
					<input type="password" class="pswdNew" placeholder="Password" required="">
					<button onclick="signup()">Sign up</button>
					<div style='font-size: 8px;text-align: center;color:white;'>By Signing up you agree to our user TsnCs.</div>
					<div class="errorResolutionSignup" hidden></div>
				</div>
			</div>

			<div class="login">
				<div>
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" class="email" placeholder="Email" required="">
					<input type="password" class="pswd" placeholder="Password" required="">
					<button onclick="login()">Login</button>
				</div>
				<div style='font-size: 8px;text-align: center;color:red;'>By logging in you agree to our user TsnCs.</div>
				<div style='font-size: 12px;text-align: center;color:navy;padding:10px 10px;cursor: pointer;' onclick="loadAfterQuery('.main','forgotPass.php');">Forgot Password</div>

				<div class="errorResolution" hidden></div>
			</div>
	</div>
	<script>
		function reload(){
			window.location=("./");
		}
		


		function newResetPassword(){
			const newPassReset = $('.newPassReset').val();
			const newPassReset1 = $('.newPassReset1').val();
			const reset_code = $('.reset_code').val();
			$(".errorResolution").removeAttr('hidden').attr("style","padding:10px 10px;color:green").html("<span style='display:flex;'><img src='img/loader.gif' style='width:15%;border-radius: 20px;'>Processing Request...</span>");
			if(newPassReset===""){
				$('.newPassReset').attr("style","border:1px solid red;");
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else if(newPassReset1===""){
				$('.newPassReset1').attr("style","border:1px solid red;");
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else if(reset_code===""){
				$('.reset_code').attr("style","border:1px solid red;");
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else if(newPassReset!==newPassReset1){
				$('.newPassReset').attr("style","border:1px solid red;");
				$('.newPassReset1').attr("style","border:1px solid red;");
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Password does not match.");
			}
			else if(newPassReset.length<8){
				$('.newPassReset').attr("style","border:1px solid red;");
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Password too short.");
			}
			else{
				$.ajax({
                    url:'./routes/routeLogin.php',
                    type:'post',
                    data:{
                    	newPassReset:newPassReset,reset_code:reset_code
                    },
                    success:function(e){
                        response = JSON.parse(e);
                        if(response['responseStatus']==='F'){
                            $(".errorResolution").attr("style","padding:5px 5px;color:red;").html(response['responseMessage']);
                        }
                        else{
                            $(".errorResolution").attr("style","padding:5px 5px;color:green;").html("New Password Set successfully");
                            reload();
                            
                        }
                    }
                });
			}
		}
		function resetPassword(){
			const EmailSetRequest = $('.EmailSet').val();
			$(".errorResolution").removeAttr('hidden').attr("style","padding:10px 10px;color:green").html("<span style='display:flex;'><img src='img/loader.gif' style='width:15%;border-radius: 20px;'>Processing Request...</span>");
			if(EmailSetRequest===""){
				$('.EmailSet').attr("style","border:1px solid red;");
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else{
				$.ajax({
                    url:'./routes/routeLogin.php',
                    type:'post',
                    data:{
                    	EmailSetRequest:EmailSetRequest
                    },
                    success:function(e){
                        response = JSON.parse(e);
                        if(response['responseStatus']==='F'){
                            $(".errorResolution").attr("style","padding:5px 5px;color:red;").html(response['responseMessage']);
                        }
                        else{
                            $(".errorResolution").attr("style","padding:5px 5px;color:green;").html("Email Identified, Processing...");
                            loadAfterQuery('.main','newPass.php');
                            
                        }
                    }
                });
			}
		}
		function completeDetails(){
			const gender=$(".gender").val();
			const region=$(".region").val();
			const dob=$(".dob").val();
			const address=$(".address").val();
			const provice=$(".provice").val();
			const otp=$(".otp").val();
			$(".errorResolutionCompleteDetails").removeAttr('hidden').attr("style","padding:10px 10px;color:green").html("<span style='display:flex;'><img src='img/loader.gif' style='width:15%;border-radius: 20px;'> Processing Request...</span>");
			if(gender===""){
				$('.gender').attr("style","border:1px solid red;");
				$(".errorResolutionCompleteDetails").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else if(region===""){
				$('.region').attr("style","border:1px solid red;");
				$(".errorResolutionCompleteDetails").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else if(dob===""){
				$('.dob').attr("style","border:1px solid red;");
				$(".errorResolutionCompleteDetails").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else if(address===""){
				$('.address').attr("style","border:1px solid red;");
				$(".errorResolutionCompleteDetails").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else if(provice===""){
				$('.provice').attr("style","border:1px solid red;");
				$(".errorResolutionCompleteDetails").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else if(otp===""){
				$('.otp').attr("style","border:1px solid red;");
				$(".errorResolutionCompleteDetails").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else{
				$.ajax({
                    url:'./routes/routeLogin.php',
                    type:'post',
                    data:{
                    	gender:gender,
						region:region,
						dob:dob,
						address:address,
						provice:provice,
						otp:otp
                    },
                    success:function(e){
                        response = JSON.parse(e);
                        if(response['responseStatus']==='F'){
                            $(".errorResolutionCompleteDetails").attr("style","padding:5px 5px;color:red;").html(response['responseMessage']);
                        }
                        else{
                            $(".errorResolutionCompleteDetails").attr("style","padding:5px 5px;color:green;").html("Account Created, Please login.");
                            
                        }
                    }
                });
			}
		}
		function login(){
			const emailLogin = $('.email').val();
			const passLogin = $('.pswd').val();
			$(".errorResolution").removeAttr('hidden').attr("style","padding:10px 10px;color:green").html("<span style='display:flex;'><img src='img/loader.gif' style='width:15%;border-radius: 20px;'> Processing Request...</span>"); 
			if(emailLogin===''){
				$(".email").attr("style",'border: 1px solid red;');
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else if(!validateEmail(emailLogin)){
				$(".email").attr("style",'border: 1px solid red;');
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Email Not Valid*");
			}
			else if(passLogin===''){
				$(".pass").attr("style",'border: 1px solid red;');
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
			}
			else{
				const dash = 'APP';
                $.ajax({
                    url:'./routes/routeLogin.php',
                    type:'post',
                    data:{emailLogin:emailLogin,passLogin:passLogin},
                    success:function(e){
                        response = JSON.parse(e);
                        // console.log(response);
                        if(response['responseStatus']==='F'){
                            $(".errorResolution").attr("style","padding:5px 5px;color:red;").html(response['responseMessage']);
                            if (typeof response !== 'undefined' && response['status'] === 'INCOMPLETE') {
                            	loadAfterQuery('.main','completeRegistra.php');
                            }
                        }
                        else{
                            $(".errorResolution").attr("style","padding:5px 5px;color:green;").html("Logging into to your account..");
                            window.location=("./"+response['user_type']);
                        }
                    }
                });
			}
		}

		function signup(){
			const emailNew = $('.emailNew').val();
			const pswdNew = $('.pswdNew').val();
			const indicator = $(".indicator").val();
			const numberNew = $(".numberNew").val();
			const name = $(".name").val();
			const surname = $(".surname").val();
			$(".errorResolutionSignup").removeAttr('hidden').attr("style","padding:5px 5px;color:green;font-size:12px;text-align:center;margin-top:-2%;").html("<span style='display:flex;'><img src='img/loader.gif' style='width:10%;border-radius: 20px;'> Processing Request...</span>"); 
			if(emailNew===''){
				$(".emailNew").attr("style",'border: 1px solid red;');
				$(".errorResolutionSignup").attr("style","padding:5px 5px;color:green;font-size:12px;text-align:center;margin-top:-2%;").html("Field Required*");
			}
			else if(!validateEmail(emailNew)){
				$(".emailNew").attr("style",'border: 1px solid red;');
				$(".errorResolutionSignup").attr("style","padding:5px 5px;color:green;font-size:12px;text-align:center;margin-top:-2%;").html("Email Not Valid*");
			}
			else if(pswdNew===''){
				$(".pswdNew").attr("style",'border: 1px solid red;');
				$(".errorResolutionSignup").attr("style","padding:5px 5px;color:green;font-size:12px;text-align:center;margin-top:-2%;").html("Field Required*");
			}
			else if(indicator===''){
				$(".indicator").attr("style",'border: 1px solid red;');
				$(".errorResolutionSignup").attr("style","padding:5px 5px;color:green;font-size:12px;text-align:center;margin-top:-2%;").html("Field Required*");
			}
			else if(numberNew===''){
				$(".numberNew").attr("style",'border: 1px solid red;');
				$(".errorResolutionSignup").attr("style","padding:5px 5px;color:green;font-size:12px;text-align:center;margin-top:-2%;").html("Field Required*");
			}
			else if(name===''){
				$(".name").attr("style",'border: 1px solid red;');
				$(".errorResolutionSignup").attr("style","padding:5px 5px;color:green;font-size:12px;text-align:center;margin-top:-2%;").html("Field Required*");
			}
			else if(surname===''){
				$(".surname").attr("style",'border: 1px solid red;');
				$(".errorResolutionSignup").attr("style","padding:5px 5px;color:green;font-size:12px;text-align:center;margin-top:-2%;").html("Field Required*");
			}
			else{
				const dash = 'APP';
                $.ajax({
                    url:'./routes/routeLogin.php',
                    type:'post',
                    data:{emailNew:emailNew,pswdNew:pswdNew,indicator:indicator,numberNew:numberNew,name:name,surname:surname},
                    success:function(e){
                        response = JSON.parse(e);
                        console.log(response);
                        if(response['responseStatus']==='F'){
                            $(".errorResolutionSignup").attr("style","padding:5px 5px;color:red;font-size:12px;text-align:center;margin-top:-2%;").html(response['responseMessage']);

                        }
                        else{
                            $(".errorResolutionSignup").attr("style","padding:5px 5px;color:green;font-size:12px;text-align:center;margin-top:-2%;").html("Account successfully created!.");
                            loadAfterQuery('.main','completeRegistra.php');

                            // window.location=("./"+response['user_type']);
                        }
                    }
                });
			}
		}
		function validateEmail(email) {
		    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		    return regex.test(email);
		}
		function loadAfterQuery(rclass,dir){
		  $(rclass).html("<center><img src='img/loader.gif' style='width:20%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'></center>").load(dir);
		}


	</script>
	<script>
		function autoCompleteAddress() {
		    var input = document.querySelector('.address');
		    var autocomplete = new google.maps.places.Autocomplete(input);
		    autocomplete.setFields(['address_components', 'formatted_address']);
		    autocomplete.addListener('place_changed', function() {
		        var place = autocomplete.getPlace();
		        console.log(place.formatted_address);
		    });
		}
		function loadGoogleMapsScript() {
		    var script = document.createElement('script');
		    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB89PxjqngFvCG66ljG_CLVc3oQlzk0YBI&libraries=places&callback=autoCompleteAddress';
		    script.defer = true;
		    //AIzaSyB89PxjqngFvCG66ljG_CLVc3oQlzk0YBI&callback=initMap&libraries=places&v=weekly
		    document.body.appendChild(script);
		}
		loadGoogleMapsScript();

	</script>
</body>
</html>