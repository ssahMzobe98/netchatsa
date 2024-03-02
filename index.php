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
	height: 500px;
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
input{
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
	height: 460px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: #573b8a;
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
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
					<input type="number" name="number" placeholder="ID Number" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>Sign up</button>
				</div>
			</div>

			<div class="login">
				<div>
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" class="email" placeholder="Email" required="">
					<input type="password" class="pswd" placeholder="Password" required="">
					<button onclick="login()">Login</button>
				</div>
				<div class="errorResolution" hidden></div>
			</div>
	</div>
	<script>
		function login(){
			const emailLogin = $('.email').val();
			const passLogin = $('.pswd').val();
			$(".errorResolution").removeAttr('hidden').attr("style","padding:10px 10px;color:green").html("<span style='display:flex;'><img src='img/loader.gif' style='width:15%;border-radius: 20px;'> Processing Request...</span>"); 
			if(emailLogin===''){
				$(".email").attr("style",'border: 1px solid red;');
				$(".errorResolution").attr("style","border:1px solid red;color:red;text-align:center;").html("Field Required*");
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
                        if(response['response']==='F'){
                            $(".errorResolution").attr("style","padding:5px 5px;color:red;").html(response['data']);
                        }
                        else{
                            $(".errorResolution").attr("style","padding:5px 5px;color:green;").html("Logging into to your account..");
                            window.location=("./"+response['user_type']);
                        }
                    }
                });
			}
		}
	</script>
</body>
</html>