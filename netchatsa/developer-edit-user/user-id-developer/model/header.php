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
	<link rel='dns-prefetch' href='https://netchatsa.com//fonts.googleapis.com' />
	<link rel='dns-prefetch' href='https://netchatsa.com//s.w.org' />
	<link rel="alternate" type="application/rss+xml" title="Netchatsa &raquo; Feed" href="https://netchatsa.com/feed/" />
	<link rel="alternate" type="application/rss+xml" title="Netchatsa &raquo; Comments Feed" href="https://netchatsa.com/feed/" />
	<meta property="og:title" content="Netchatsa : Integrating Education With Technology"/>
    <meta property="og:description" content="Netchatsa SGELA is a project implemented by TAMA Organizationsa. It is secured and fully protected by TAMA Organization. Project was implemented to solve Education problems through Technology by creting Education API that will equally distribute World class Education to everyone who's in need."/>
  <link rel="icon" href="../../default-img/ff.jpg">
	<title><?php echo $cur_user_row['username']; $id=$cur_user_row['my_id'];?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">-->
	<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>-->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://www.payfast.co.za/onsite/engine.js"></script>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script> -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
<!-- <script src="https://cdn.datatables.net/scroller/2.0.6/js/dataTables.scroller.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.6/css/scroller.dataTables.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<script scr="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<!-- <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script> -->
<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.0/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.0/datatables.min.js"></script>
  <script src="controler/js/pdoInstallerav8.2.js"></script>
  <!-- <link rel="stylesheet" href="controler/js/dataTables.bootstrap5.min.css" /> -->
  <!---->
  
  
  
  <!---->

  <!-- <script type="text/javascript" src="../controller/js/pdoInstallerav8.js"></script> -->

<style>
*{
  box-sizing: border-box;
  font-size: 15px;
}
body{

    <?php
 $_=mysqli_fetch_array($conn->query("select darkbright from brightdarksetup where my_id='$id'"));
 if($_['darkbright']=="dark"){?>
     color:#ffffff;
     background-color:#212121;
<?php
 }
 else{
     ?>
     
    color:#000000;
    background-color:#f1f1f1;
<?php     
 }
?>
}
.menu {
  float: left;
  width: 15%;
  top:10%;
  margin:10px;
  box-shadow:1px 1px 1px 1px #000;
  font:arial;
  font-size:13px;
}
.messages::-webkit-scrollbar{
    width:0;
}
.menuitem {
  padding 1px;
  line-height: 2.6;
  border-bottom: 2px solid #000;
  <?php
 $_=mysqli_fetch_array($conn->query("select darkbright from brightdarksetup where my_id='$id'"));
 if($_['darkbright']=="dark"){?>
     background-color:#212121;
<?php
 }
 else{
     ?>
     
    color:#000000;
    background-color:#f1f1f1;
<?php     
 }
?>
}
.menuitem:hover{
    color:blue;
    background-color:#E6E6FA;
}
.menuitem a{
    <?php
 $_=mysqli_fetch_array($conn->query("select darkbright from brightdarksetup where my_id='$id'"));
 if($_['darkbright']=="dark"){?>
     color:white;
<?php
 }
 else{
     ?>
    color:#000;
<?php     
 }
?> 
}
.menuitem a:hover{
    <?php
 $_=mysqli_fetch_array($conn->query("select darkbright from brightdarksetup where my_id='$id'"));
 if($_['darkbright']=="dark"){?>
     color:#000000;
<?php
 }
 else{
     ?>
    color:blue;
<?php     
 }
?> 
}
#run-1-2{
    width:100%;
    height:auto;
    display:flex;
    
}
#run-1-2 a{
    color:#BA9EF9  ;
}

.main {
  float: left;
  width: 21.5%;
  top:10%;
  padding: 0 10px;
  overflow: hidden;
  font:arial;
  font-size:13px;
}
.right {
  float: left;
  width: 50%;
  padding: 10px 15px;
  margin-top: 6px;
}

#mobile-display{
    display:none;
}
#next{
    margin-top:10px;
    border:1px solid #212121;
    box-shadow:2px 2px 2px 2px #000;
    border-radius:5px;
}
#next img{
    
    width:100%;
    border:1px solid #212121;
}
#area{
    border-radius:5px;
    box-shadow:2px 2px 2px 2px #000;
    border:1px solid #000;
     <?php
 $_=mysqli_fetch_array($conn->query("select darkbright from brightdarksetup where my_id='$id'"));

 if($_['darkbright']=="dark"){?>
     color:#E6E6FA;
<?php
 }
 else{
     ?>
    color:#000000;
<?php     
 }
?>
}
.temp-div{
    width:100%;
    /*border:1px solid red;*/
    box-shadow:2px 2px 2px 2px #000;
}
.temp-div-{
    width:100%;
    /*border:1px solid blue;*/
}
.temp-div- img{
    width:100%;
}
.red-text{
    color:red;
}
.fa {
  
  cursor: pointer;
  user-select: none;
  color:red;
}

.fa:hover {
  color: darkblue;
}
#messages{
	height: 89vh;
	overflow-x: hidden;
	padding: 5px;
	 <?php
 $_=mysqli_fetch_array($conn->query("select darkbright from brightdarksetup where my_id='$id'"));
 if($_['darkbright']=="dark"){?>
     background-color:#212121;
<?php
 }
 else{
     ?>
   background-image: none;/*url(../images/d/1abc.jpg);*/
<?php     
 }
?>
	
}
#posti:hover{box-shadow:1px 1px 1px 1px #000;width:120px; height:120px;}
form.net{
	display: flex;
}
input.neti{
	font-size: 1.2rem;
	padding: 6px;
	margin: 5px 0px;
	appearance:none;
	-webkit-appearance:none;
	border:1px solid #ccc;
	border-radius: 5px;
}
#message{
	flex: 20;
	min-height:40px;
	max-height:40px;
	border-radius: 5px;
}
@media only screen and (max-width:900px) {
  /* For tablets: */
  .promotional_post_pop_show{
    width:100%;
    height:auto;
    
}
.promotional_post_pop_show img{
    width:100%;
    height:auto;
}
  #headerDt{
      
      width:100%;
  }
  #hyper-links-net-mobile{
      
  }
  .id-join{
      height:30px;
      width:30px;
      
  }
  .widthAtd{
      width:60%;
  }
  .header{
      padding:15px;
  }
  #messages{
    margin-top:1%;
	height: 80vh;
	width:100%;
  }
   .id-rol{
      display:none;
  }
  .noll{
      display:none;
  }
  #img-id-header{
      display:none;
  }
  #id-rol{
      display:none;
  }
  #mobile-display{
      display:block;
  }
  #computer-display{
      display:none;
  }
.menu, .main{
      display:none;
  } 
  .right {
    width: 100%;
  }
  .noll{
      display:none;
  }
 
  /*-------------------*/
    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #35424a;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }
    
    .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      color: #818181;
      display: block;
      transition: 0.3s;
    }
    
    .sidenav a:hover {
      color: #f1f1f1;
    }
    
    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }
    
    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }
}
@media only screen and (max-width:500px) {
  /* For mobile phones: */
  .promotional_post_pop_show{
    width:100%;
    height:auto;
    
}
.promotional_post_pop_show img{
    width:100%;
    height:auto;
}
  #mobile-display-2{
      width:100px;height:100px;
  }
  
  .header{
      padding:10px;
  }
  /*-------------------*/
.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #35424a;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
/*-------------------------------*/ 
  .id-rol{
      display:none;
  }
  .noll{
      display:none;
  }
  #img-id-header{
      display:none;
  }
  #id-rol{
      display:none;
  }
  #mobile-display{
      display:block;
  }
  #computer-display{
      display:none;
  }
  #messages{
    margin-top:1%;
	height: 80vh;
	width:100%;
  }
  
  .menu, .main{
      display:none;
  } 
  .right {
    width: 100%;
  }
}
.img-id-header{
}

.search_id_form input{
    width:20%;
    height:30px;
}
.search_id_form button{
    width:4%;
    height:27px;
}
/*header:hover:dopdown*/
}
.headerr{
		height: 20px;
		padding: 10px;
		background-color: #35424a;
		width: 100%;
		border-bottom: 2px solid #e8491d;
	}
	.headerDt{
		float: left;
		width:10%;
		text-align: center;
	}
	#hyper-links-net-mobile{
		color: white;
		width:10%;
		float: left;
		
	}
	#hyper-links-net-mobile a{
		color: white;
	}
	#hyper-links-net-mobile img{
		color: white;
	}
	#inputIn{
		float: left;
	}
	#inputIn input{
		padding: 2px;
	}
	

	.dropbtn {   background-color: #4CAF50;   color: white;   padding: 3px;   font-size: 12px;   border: none; } 
 
	.dropdown {   position: relative;   display: inline-block; } 
	 
	.dropdown-content {   display: none;   position: absolute;   background-color: #35424a;   min-width: 100px;   box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); 
	 
	  z-index: 1; } 
	 
	.dropdown-content a {   color: black;   padding: 12px 12px;   text-decoration: none;   display: block; } 
	 
	.dropdown-content a:hover {background-color: #ddd;} 
	 
	.dropdown:hover .dropdown-content {display: block;} 
	 
	.dropdown:hover .dropbtn {background-color: #3e8e41;}
	
.search-allow{
    display:flex;
    width:40%;
    background-color: #35424a;
}
.search-allow .input{
    width:73%;
}
.search-allow .select{
    width:20%;
}
.search-allow .button{
    width:7%;
}
.search-allow .input input,.select select,.button button{
    width:100%;
    height:100%;
    border:none;
}
.search-allow .select select,.button button{
    color:#f3f3f3;
    background-color: #35424a;
}
.search-allow .input input{
    color:#f3f3f3;
    background-color: #35424a;
    border-bottom:2px solid #f3f3f3;
}
</style>

</head>
<body style="font-family:Verdana,Lucida Sans,Lucida Sans Regular,Lucida Sans Unicode; background-color: #212121;height: 90vh;color:#35424a;">
<!--<div class="noll">ksdcnkjdcnkdcksdckcs<br>jksjdfhskfhkdsf</div>-->
<div style="background-color:#35424a;padding:15px;border-bottom: 2px solid #e8491d; height:50px;" class="header" id="mobile-display">
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "98%";
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

			<div class="headerr">
			<div class="headerDt">
				<div class="dropDown">
					<div class="dropdown">   
						<button style="font-size:10px;cursor:pointer;width:68px;height:30px;" class="dropbtn" onclick="openNav()">&#9776; NetChat</button>   
						<div class="dropdown-content">
						    <div id="mySidenav" class="sidenav">
                              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            
						<style type="text/css">#link-nav{A}</style> 
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
							<?php 
							 echo '
							 <a style="text-align:left; color:#f3ff3f3;"  name="dark" type="post" value="" id="dark"><i class="fa fa-moon-o" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span><span style="color:#f3f3f3;">Dark</span></a>
							 <a style="text-align:left; color:#f3ff3f3;" id="bright" type="post" value=""><i class="fa fa-sun-o" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span><span style="color:#f3f3f3;">Bright</span></a> 
                                        <div style="width:400px;border-bottom: 2px dotted #E6E6F;" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=latestNews"><i class="fa fa-newspaper-o" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>Latest News</a></nav> 
										</div>
										<div style="width:400px;border-bottom: 2px dotted #E6E6F;" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=SportsNews"><i class="fa fa-futbol-o" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>Sports News</a></nav> 
										</div>
										
										<div style="width:400px;border-bottom: 2px dotted #E6E6F" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=apply"><i class="fa fa-pencil" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>Apply</a></nav>    
										</div>
							 			<div id="link-nav" style="width:400px;">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=my-account"><i class="fa fa-edit" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>update profile</a></nav> 
										</div>
										<div style="width:400px;border-bottom: 2px dotted #E6E6F;" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=shisanyama"><i class="fa fa-fire" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>Ekasi Shisanyama</a></nav> 
										</div>
										<div style="width:400px;border-bottom: 2px dotted #E6E6F;" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=messages"><i class="fa fa-envelope" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>messages</a></nav> 
										</div>
										<div style="width:400px;border-bottom: 2px dotted #E6E6F" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=my-post"><i class="fa fa-sticky-note-o" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>my-post</a></nav> 
										</div>
										
										<div style="width:400px;border-bottom: 2px dotted #E6E6F" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=studyarea"><i class="fa fa-book" aria-hidden="true" style="font-size:25px;"></i></span>study Area</a></nav>  
										</div>
										
										<div style="width:400px;border-bottom: 2px dotted #E6E6F" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=live public chats"><i class="fa fa-comments" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>live public chats</a></nav>  
										</div>'
										
										;
										
										echo'<div style="width:400px;border-bottom: 2px dotted #E6E6F" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=pastpapers"><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>Sgela</a></nav>    
										</div>
								
										<div style="width:400px;border-bottom: 2px dotted #E6E6F" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=music"><i class="fa fa-music" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>Music</a></nav>    
										</div>
										
										';
										echo'
										<div style="width:400px;border-bottom: 2px dotted #E6E6F" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=math-phy"><i class="fa fa-trophy" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>math-phy</a></nav> 
										</div>
										<div style="width:400px;border-bottom: 2px dotted #E6E6F" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;">I Chat dot com South Africa</a></nav> 
										</div>
										<div style="width:400px;color:#E6E6FA;border-bottom: 2px dotted #E6E6F" id="link-nav">
											<nav style="text-align:left;"><a style="color:#f3f3f3;" href="?_=exit"><i class="fa fa-sign-out" aria-hidden="true" style="font-size:25px;"></i><span style="color:#35424a;">---</span>log out</a></nav> 
										</div>


										';
	
							?>       
							 <!----------------------------------------------------------->
							 </div>
						</div> 
					</div> 					
				</div>
			</div>
<!------------  ready to be an executable header for entire web app ------->

		<div class="headerDt" style="width: 70%;text-align: left; margin-left:12%;" id="headerDt" >
		    <style>#new-tech{font-size:28px;color:#f3f3f3;}</style>
			<div title="Home" id="hyper-links-net-mobile" class="id-join"><a href="?_=home"><i id="new-tech" class="fa fa-home"></i></a></div>
			<div title="Media Members" id="hyper-links-net-mobile" class="id-join" style="width:4%;"><a href="?_=messages"></a></div>
			<div title="Media Members" id="hyper-links-net-mobile" class="id-join"><a href="?_=members"><i class="fa fa-users" aria-hidden="true" id="new-tech" style="font-size:22px;"></i></a></div>
			<div title="Media Members" id="hyper-links-net-mobile" class="id-join" style="width:4%;"><a href="?_=messages"></a></div>
			<div title="Media Members" id="hyper-links-net-mobile" class="id-join"><a href="?_=pastpapers"><i class="fa fa-graduation-cap" aria-hidden="true" id="new-tech"></i></a></div>
			<div title="Media Members" id="hyper-links-net-mobile" class="id-join" style="width:4%;"><a href="?_=messages"></a></div>
			<div title="Media Members" id="hyper-links-net-mobile" class="id-join"><a href="?_=studyarea"><i class="fa fa-book fa-fw" aria-hidden="true" id="new-tech"></i></a></div>
			
			<div title="Media Members" id="hyper-links-net-mobile" class="id-join" style="width:4%;"><a href="?_=messages"></a></div>
			
			
			<div title="My Account" id="hyper-links-net-mobile" style="width: 48%;margin-right:-50px;" class="id-join"><a href='?_=my-account'><i class="fa fa-user" aria-hidden="true" id="new-tech"></i></a> <span style="color:#e8491d; "><em> <?php if(strlen($cur_user_row['username'])>10 and strlen($cur_user_row['username'])<=17){echo"<small style='font-size:8px;'>".$cur_user_row['username']."</small>";}elseif(strlen($cur_user_row['username'])>17){
			    $tmp_arr=$cur_user_row['username'];for($i=0;$i<=7;$i++){echo $tmp_arr[$i];}echo"...";}else{echo $cur_user_row['username'];}?></em></span></div>

		</div>
		
	</div>
</div>
 
    
</div>
<div style="background-color:#35424a;padding:8px;border-bottom: 2px solid #e8491d;" class="header" id="computer-display">
    <div class="headerr">
		<div class="headerDt">
			<div class="dropDown">
				<div class="dropdown">   
					<button class="dropbtn">NetChat</button>   
					<div class="dropdown-content">    
						
						 <?php echo'
						 <a title="🌑 Dark Theme" name="dark" type="post" onclick="dark()">Dark</a>
						 <a title="🌕 Bright Theme" name="bright" type="post" onclick="bright()">Bright</a>     
						 ';?>     
						 
					</div> 
				</div> 					
			</div>
		</div>
		<div class="headerDt" style="width: 20%;text-align: left;">
			<div id="hyper-links-net-mobile" title="🏡 go to Home page" ><a href="?_=home"><i id="new-tech" class="fa fa-home"></i> </a> </div>
			<div id="hyper-links-net-mobile" ><a href="?_=members"><i class="fa fa-users" aria-hidden="true" id="new-tech" style="font-size:22px;"></i></a></div>
			<div id="hyper-links-net-mobile" style="width: 80%;"><i class="fa fa-user" aria-hidden="true" id="new-tech"></i><span style="color:#e8491d; "><em><?php if(strlen($cur_user_row['username'])>10 and strlen($cur_user_row['username'])<=17){echo"<small style='font-size:8px;'>".$cur_user_row['username']."</small>";}elseif(strlen($cur_user_row['username'])>17){
			    $tmp_arr=$cur_user_row['username'];for($i=0;$i<=7;$i++){echo $tmp_arr[$i];}echo"...";}else{echo $cur_user_row['username'];}?></em></span></div>

		</div>

	</div>
    	<div class="search-allow">
    	    <div class="input"><input id="search_query" title="find user 😉" type="search" name="searchId" placeholder="find any user" required></div>
    	    <div class="select"><select id="search_type" name="select" required><option value="">Filter</option><option value="1">Filter by Name</option><option value="2">Filter by username</option></select></div>
    	    <div class="button"><button title="start search 🧐" id="search_btn" name="findme" type="submit"><i class="fa fa-search"></i></button></div>
    	</div>
</div>