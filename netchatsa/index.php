<?php 
require_once("controler/pdo.php");
$pdo=new _pdo_();
if(isset($_POST['netchatsa-login'])){
    $login=$pdo->LoginVerification();
    if(empty($login)){
        $user=mysqli_escape_string($conn,$_POST['uname']);
        $select=mysqli_fetch_array($conn->query("select * from create_runaccount where usermail='$user' LIMIT 1"));
        $user_nav="user/".$select['account_owner'];
        if($pdo->isVerified($select['my_id'])){
            session_start();
            $_SESSION['usermail']=$user;
            // echo $_SESSION['usermail'];exit();
            header("Location:developer-edit-user/user-id-developer");exit(); 
        }
        else{
            header("Location:./?error=Account Not Verified, Check your emails to verify your account&r=0");exit();
        } 
    }
    else{
        header("Location:./?".$login[0]."=".$login[1]."&r=0");exit();
    }
}
elseif(isset($_GET['_0_']) && $_GET['_0_']>500){
    $error=$pdo->verifyAccount($_GET['_0_']);
    if(empty($error)){
        header("Location:./?susccess=Successfuly veried, Ready to LOGIN.&r=0");exit();
    }
    else{
        header("Location:./?r=0&error=".$error[0]);exit();
    }
}
elseif(isset($_POST["create_account"])){
    $error=$pdo->createNewAccount();
    header("Location:./?r=1&".$error[0]."=".$error[1]);exit();
}
else{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Netchatsa SGELA is a project implemented by TAMA Organizationsa. It is secured and fully protected by TAMA Organization">
  <meta name="keywords" content="Online tutorials, Online class, chats, posts, messages">
  <meta name="author" content="Mr M.S Mzobe">
  	<link rel='dns-prefetch' href='https://netchatsa.com//s0.wp.com' />
	<link rel='dns-prefetch' href='https://netchatsa.com/'/>
	<link rel='dns-prefetch' href='https://fonts.googleapis.com' />
	<link rel='dns-prefetch' href='https://s.w.org' />
	<link rel="alternate" type="application/rss+xml" title="Netchatsa &raquo; Feed" href="https://netchatsa.com/feed/" />
	<link rel="alternate" type="application/rss+xml" title="Netchatsa &raquo; Comments Feed" href="https://netchatsa.com/feed/" />
	<meta property="og:title" content="Netchatsa : Integrating Education With Technology"/>
    <meta property="og:description" content="Netchatsa SGELA is a project implemented by TAMA Organizationsa. It is secured and fully protected by TAMA Organization. Project was implemented to solve Education problems through Technology by creting Education API that will equally distribute World class Education to everyone who's in need."/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<title>Sign In</title>
	<script>
$(document).ready(function(){
    $(".clickR").click(function(){
        const ema=$("#email").val();
        console.log(ema);
        if(ema==""){
            $(".errorMacKh").removeAttr("disabled");
            $(".errorMacKh").attr("style","color:red;width:auto;background-color:#000;");
            $(".errorMacKh").html("Cannot Process Empty Input!..");
        }
        else{
            $(".errorMacKh").removeAttr("disabled");
            $(".errorMacKh").attr("style","color:white;width:auto;background-color:green;");
            $(".errorMacKh").html("processing..");
            // $.ajax({
            //     url:"controller/functions/d.php",
            //     type:"POST",
            //     data{ema:ema},
            //     success:function(e){
            //         console.log(e)
            //     }
            // });
            $.ajax({
		        url:'controller/functions/d.php',
        		type:'post',
        		data:{ema:ema},
        		success:function(e){
        		    console.log(e);
        		    if(e.length<=2){
        		        
        		        $(".errorMacKh").removeAttr("disabled");
                        $(".errorMacKh").attr("style","color:white;width:auto;background-color:green;");
                        $(".errorMacKh").html("Please check your emails for the next step..");
                        $("#email").val("");
        		    }
        		    else{
        		        $(".errorMacKh").removeAttr("disabled");
                        $(".errorMacKh").attr("style","color:red;width:auto;background-color:#000;");
                        $(".errorMacKh").html(e);
        		    }
        			
        		}
        	});
            
            
        }
    });
    $(".clickRT").click(function(){
        const p=$("#pass").val();
        const p1=$("#pass1").val();
        const pp=$("#code").val();
        
        if(p=="" || p1==""){
            $(".errorMacKh").removeAttr("disabled");
            $(".errorMacKh").attr("style","color:red;width:auto;background-color:#000;");
            $(".errorMacKh").html("Cannot Process Empty Input!..");
        }
        else if(p.length<8){
            $(".errorMacKh").removeAttr("disabled");
            $(".errorMacKh").attr("style","color:red;width:auto;background-color:#000;");
            $(".errorMacKh").html("password too short");
        }
        else if(p!=p1){
            $(".errorMacKh").removeAttr("disabled");
            $(".errorMacKh").attr("style","color:red;width:auto;background-color:#000;");
            $(".errorMacKh").html("Password not the same");
        }
        else{
            $(".errorMacKh").removeAttr("disabled");
            $(".errorMacKh").attr("style","color:white;width:auto;background-color:green;");
            $(".errorMacKh").html("processing..");
            $.ajax({
		        url:'controller/functions/d.php',
        		type:'post',
        		data:{pp:pp,p:p},
        		success:function(e){
        		    console.log(e);
        		    if(e.length<=2){
        		        
        		        $(".errorMacKh").removeAttr("disabled");
                        $(".errorMacKh").attr("style","color:white;width:auto;background-color:green;");
                        $(".errorMacKh").html("Please check your emails for the next step..");
                        $("#p").val("");
                        $("#p1").val("");
                        window.location=("?success=Password Reset Successful");
        		    }
        		    else{
        		        $(".errorMacKh").removeAttr("disabled");
                        $(".errorMacKh").attr("style","color:red;width:auto;background-color:#000;");
                        $(".errorMacKh").html(e);
        		    }
        			
        		}
        	});
            
            
        }
    });
});


</script> 
<style>
* {
  box-sizing: border-box;
 
}
body {font-family: Arial, Helvetica, sans-serif,Verdana;
    background-image:url("default-img/profilePic.jpg");
    background-size:cover;
     
}
form {border: 3px solid #f1f1f1; }

input[type=email], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}
.imgcontainer img{
      width:20%;
      height:20%;
  }

img.avatar {
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
.id-{
    color:white;
    height:50px;
    
}
.id- img{
    width:3%;
}
.roller{
    width:30%;
    top:20%;
}
.menu {
  float: left;
  width: 20%;
}
.menuitem {
  padding: 8px;
  margin-top: 7px;
  border-bottom: 1px solid #f1f1f1;
}
/*.main {*/
/*  float: left;*/
/*  width: 60%;*/
/*  padding: 0 20px;*/
/*  overflow: hidden;*/
/*}*/
/*.right {*/
/*  background-color: lightblue;*/
/*  float: left;*/
/*  width: 20%;*/
/*  padding: 10px 15px;*/
/*  margin-top: 7px;*/
/*}*/
@media only screen and (max-width:1000px) {
  /* For tablets: */
  .id- img{
     width:2%; 
  }
  .roller{
      width:50%;
  }
  .imgcontainer img{
      width:20%;
      height:20%;
  }
  .modal{
      width:50%;
  }
}
@media only screen and (max-width:800px) {
  /* For tablets: */
  .id- img{
     width:3%; 
  }
  .roller{
      width:90%;
      
  }
  .imgcontainer img{
      width:20%;
      height:20%;
  }
  .modal{
      width:90%;
  }
}
@media only screen and (max-width:500px) {
  /* For mobile phones: */
  .id-{
      padding:15px;
      height:40px;
      
  }
  .id- img{
     width:5%; 
  }
  .roller{
      width:90%;
      top:30%;
  }
  .imgcontainer img{
      width:20%;
      height:20%;
  }
  .menu, .main, .right {
    width: 100%;
  }
  .modal{
      width:90%;
  }
}
</style>

</head>
<body>

<!--<div style="background-color:#35424a;padding:5px;color:white;" class='id-'>-->
<!--  <img src="../images/netchatsaLogo.jpg"> NETCHATSA -->
<!--</div>-->


    
    <style>

</style>
<center>
<div style="background-color:#f1f1f1;text-align:center;padding:10px;margin-top:7px;font-size:12px;box-shadow:4px 4px 8px 8px;opacity:1" class="roller"> 
<?php if(isset($_GET["error"])){
    if($_GET["r"]==1){
        ?>
        <a><div style='color:#ffffff;background-color:red;height:40px;font-size:18px;' onclick="document.getElementById('id02').style.display='block'"><strong style='background-color:red;color:#000;'> <?php echo $_GET['error'];?> </strong> Click to fix!</div></a> 
        <?php
    }
    elseif($_GET["r"]){
         ?>
        <a><div style='color:#ffffff;background-color:red;height:40px;font-size:18px;'><strong style='background-color:red;'> <?php echo $_GET['error'];?></strong></div></a> 
        <?php
    }
    else{
         ?>
        <a><div style='color:#ffffff;background-color:red;height:40px;font-size:18px;'><strong style='background-color:red;'> <?php echo $_GET['error'];?></strong></div></a> 
        <?php
    }
}

if(isset($_GET["success"])){
    ?>
        <a><div style='color:#ffffff;background-color:green;height:40px;font-size:18px;'><strong style='background-color:green;'> <?php echo $_GET['success'];?> </strong></div></a> 
        <?php
}
if(isset($_GET['pass'])){
?>

<h2>PASSWORD RESET</h2>
    <div class="setter">
        <input id="email" type="email" placeholder="Enter Existing Email " required >
    </div>
    <div class="setter">
       <button type="submit" class="clickR">Send SetUp Request</button>
    </div>
    <div class="errorMacKh" disabled></div>
    

<?php
}
elseif(isset($_GET['_1_'])){
?>

<h2>PASSWORD RESET</h2>
<input value="<?php echo $_GET['_1_']?>" type="hidden" id='code'>
    <div class="setter">
        <input id="pass" type="password" placeholder="Enter Password " required >
    </div>
    <div class="setter">
        <input id="pass1" type="password" placeholder="Enter Password " required >
    </div>
    <div class="setter">
       <button type="submit" class="clickRT">Send SetUp Request</button>
    </div>
    <div class="errorMacKh" disabled></div>
    

<?php
}
else{
    ?>
<h2>NETCHATSA LOGIN</h2>
<form action="" method="post" >
  <!--<div class="imgcontainer">-->
    <!--<img src="view/img/images/1.jpg" alt="Avatar" class="avatar">-->
  <!--  <h2>SGELA EAI LOGIN</h2>-->
  <!--</div>-->
  
  <div class="container">
    <label for="uname"><b>Email Address</b></label>
    <input type="email" name="uname" placeholder="netchat22@gmail.com"  required>

    <label for="psw"><b>Password</b></label>
    <input type="password" name="psw" placeholder="Enter Password"  required>
        
    <button type="submit" style="border-radius:100px;" name="netchatsa-login">Login</button>
    <!--<h4>student/learner/free user dont have an account? </h>-->
  <div class="container" style="background-color:#f1f1f1">
    <button style="border-radius:100px;" type="button" onclick="document.getElementById('id01').style.display='block'" class="cancelbtn">Create Account</button>
    <span class="psw">Forgot <a href="?pass">password?</a></span>
  </div>
     
  </div>



</form>
<style>
          a{
              width:150px;
              
          }
          a .left-tr{
              width:80%;
              background-color:crimson;
              border-radius:100px;
          }
          a .right-tr{
              width:80%;
              background-color:orangered;
              border-radius:100px;
          }
          .right-tr:hover{
              color:orangered;
              border:1px solid orangered;
              background-color:#f1f1f1;
          }
          .left-tr:hover{
              color:crimson;
              border:1px solid crimson;
              background-color:#f1f1f1;
          }
          @media only screen and (max-width:800px){
              a{
                  width:130px;
              }
              a .left-tr{
              width:90%;
              
              }
              a .right-tr{
                  width:90%;
                  
              }
          }
      </style>
    <hr>
      <a style="float:left;" href="_.php"><button type="none" class="right-tr">M Records</button></a>
     
    <a style='float:right' href="admin.php"><button type="none" class="left-tr">Admin</button></a>
    <br><br><br><br><br>
    <hr>
<a style="" href="sgela.php"><button style="width:85%;background-color:blue;border-radius:100px;">School Portal</button></a>
    <hr>
<a style="" href="shisanyama.php"><button style="width:85%;background-image:url('view/img/button.jpg');border-radius:100px;">EKASI SHISA NYAMA</button></a>
    <hr>
    
 </div>   
   </center> 
<style>
 input[type=text], input[type=password], input[type=email]{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer-boot {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container-boot {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 33%;
  top: 0;
  width: 38%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}
@media only screen and (max-width:500px){
    .modal{
        width:100%;
        left:0;
    }
    .modal-content {
        width:100%;
    }
}
@media only screen and (max-width:1000px){
    .modal{
        width:70%;
        left:18%;
    }
    .modal-content {
        width:100%;
    }
}
@media only screen and (max-width:800px){
    .modal{
        width:100%;
        left:0%;
    }
    .modal-content{
        width:100%;
    }
}


/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
<center>
<!--<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>-->

<div id="id01" class="modal" >
  
  <form class="modal-content animate" action="?create_new_account" method="post">
    <div class="imgcontainer-boot">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <b>CREATE NETCHATSA ACCOUNT</b><br>
      <img src="view/img/images/login-avatar.png" alt="Avatar" class="avatar">
    </div>

    <div class="container-boot">
      <label for="uname"><b>First Name</b></label>
      <input type="text" placeholder="First Name" name="name" required>
      <label for="uname"><b>Last Name</b></label>
      <input type="text" placeholder="Last Name" name="surname" required>
      <label for="uname"><b>UserName</b></label>
      <input type="text" placeholder="@my_userName145" name="username" required>
      <label for="uname"><b>Date of Birth</b></label>
      <input type="date" placeholder="yyyy-MM-dd" name="date" required><br><br>
      <label for="uname"><b>Gender</b></label>
      <select name="gender" required placeholder="Gender" ><option value="">--- select gender---</option><option value="Male">Male</option><option value="Female">Female</option></select><br><br>
       <label for="uname"><b>Promaths alumni?</b></label>
      <select name="promaths" required placeholder="promaths"><option value="">--- select ---</option><option value="Yes">Yes</option><option value="No">No</option></select><br><br>
       <label for="uname"><b>Province</b></label>
      <select name="province" required placeholder="Province">
          <option value="">--- select province---</option>
          <option>KwaZulu-Natal</option>
          <option>Gauteng</option>
          <option>Mpumalanga</option>
          <option>Eastern-Cape</option>
          <option>Western-Cape</option>
          <option>Nothern-Cape</option>
          <option>North-West</option>
          <option>Free-State</option>
          <option>Limpopo</option>
      </select><br><br>
      <label for="uname"><b>city</b></label>
      <input type="text" placeholder="City" name="city" required>
      <br><br>
      <label for="uname"><b>Email Address</b></label>
      <input type="email" placeholder="Email Address" name="email_address" required>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Confirm Password" name="re_psw" required>
        
      <button type="submit" name="create_account">Create Account</button>
    </div>
  </form>
</div>


<div id="id02" class="modal" >
  
  <form class="modal-content animate" action="?create_new_account" method="post">
    <div class="imgcontainer-boot">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <b>CREATE NETCHATSA ACCOUNT</b><br>
      <img src="default-img/login-avatar.png" alt="Avatar" class="avatar">
    </div>

    <div class="container-boot">
      <label for="uname"><b>First Name</b></label>
      <input type="text" placeholder="First Name" name="name" value="<?php echo $_GET["a"];?>" required>
      <label for="uname"><b>Last Name</b></label>
      <input type="text" placeholder="Last Name" name="surname" value="<?php echo $_GET["b"];?>" required>
      <label for="uname"><b>UserName</b></label>
      <input type="text" placeholder="@my_userName145" name="username" value="<?php echo $_GET["c"];?>" required>
      <label for="uname"><b>Date of Birth</b></label>
      <input type="date" placeholder="dd/mm/yyyy" name="date" value="<?php echo $_GET["d"];?>" required><br><br>
      <label for="uname"><b>Gender</b></label>
      <select name="gender" required placeholder="Gender"><option><?php echo $_GET["e"];?></option><option>Male</option><option>Female</option></select><br><br>
       <label for="uname"><b>Promaths alumni?</b></label>
      <select name="promaths" required placeholder="promaths"><option><?php echo $_GET["f"];?></option><option>Yes</option><option>No</option></select><br><br>
       <label for="uname"><b>Province</b></label>
      <select name="province" required placeholder="Province">
          <option><?php echo $_GET["g"];?></option>
          <option>KwaZulu-Natal</option>
          <option>Gauteng</option>
          <option>Mpumalanga</option>
          <option>Eastern-Cape</option>
          <option>Western-Cape</option>
          <option>Nothern-Cape</option>
          <option>North-West</option>
          <option>Free-State</option>
          <option>Limpopo</option>
      </select><br><br>
      <label for="uname"><b>city</b></label>
      <input type="text" placeholder="City" name="city" value="<?php echo $_GET["h"];?>" required>
      <br><br>
      <label for="uname"><b>Email Address</b></label>
      <input type="email" placeholder="Email Address" name="email_address" value="<?php echo $_GET["i"];?>" required>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Confirm Password" name="re_psw" required>
        
      <button type="submit" name="create_account">Create Account</button>
    </div>
  </form>
</div>
</center>

<script>
// Get the modal
//var modal = document.getElementById('id02');
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>  
 
    


</body>
</html>
<?php
}
}exit()?>