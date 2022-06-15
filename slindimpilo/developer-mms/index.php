<?php
function getAdminInfo($adminId){
	global $conn;
	return mysqli_fetch_array($conn->query("select*from aminuser where adminid='$adminId'"));
}
session_start();

if(isset($_SESSION['adminSession'])){
	// echo $_SESSION['adminSession'];exit();
	require_once('controler/pdo.php');
	$imfene=new _imfene_();
	$admin_info=getAdminInfo($_SESSION['adminSession']);
	$dir="admin/".$admin_info['userdirectory'];
	header("Location:./".$dir);
}
elseif(isset($_SESSION['customerSession'])){
	require_once('controler/pdo.php');
}
else{
	session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Slindimpilo Development (PTY) LTD was formed in the year 2015 as a supplier and maintainer of the overhead electrical supply, Incorporated by a sole owner in the republic of South Africa. Our primary objective is to provide overhead electrical supply to all the companies efficient to the erection and maintanance of the overhead electrical supply. (::By mms enterprise, netchatsa, Mr MS Mzobe) slindimpilo,electricity, Overhead power line material, Aluminium and Copper Conductors, Preformed line products, Silicone and porcelain insulators, ABC Cables and accessories, Earthing material, Commercial and Private business, Goverment and Municipalities, Private Sector,Individuals.">
<meta name="keywords" content="Electricity Appliance, slindimpilo,electricity, Overhead power line material, Aluminium and Copper Conductors, Preformed line products, Silicone and porcelain insulators, ABC Cables and accessories, Earthing material, Commercial and Private business, Goverment and Municipalities, Private Sector,Individuals, mms enterprise, netchatsa,(::By mms enterprise, netchatsa, Mr MS Mzobe)">
<meta name="author" content="Mr M.S Mzobe,mms enterprise,netchatsa">
<link rel='dns-prefetch' href='https://slindimpilo.co.za//s0.wp.com' />
<link rel='dns-prefetch' href='https://slindimpilo.co.za/'/>
<link rel='dns-prefetch' href='https://slindimpilo.co.za//fonts.googleapis.com' />
<link rel='dns-prefetch' href='https://slindimpilo.co.za//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="Slindimpilo Electric Appliance Supply Company  &raquo; Feed" href="https://slindimpilo.co.za/feed/" />
<link rel="alternate" type="application/rss+xml" title="Slindimpilo Electric Appliance Supply Company &raquo; Comments Feed" href="https://slindimpilo.co.za/feed/" />
<meta property="og:title" content="Slindimpilo : Where Electricity Begins |(::By mms enterprise)|"/>
<meta property="og:description" content="Slindimpilo Development (PTY) LTD was formed in the year 2015 as a supplier and maintainer of the overhead electrical supply, Incorporated by a sole owner in the republic of South Africa. Our primary objective is to provide overhead electrical supply to all the companies efficient to the erection and maintanance of the overhead electrical supply.(::By mms enterprise, netchatsa, Mr MS Mzobe) "/>
<link rel="icon" href="img/logo.jpg">
<title>Slindimpilo</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- <script src="https://www.payfast.co.za/onsite/engine.js"></script> -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<script scr="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.0/datatables.min.css"/>
 <!--  -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.1.2/jquery.bxslider.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.1.2/jquery.bxslider.css"/>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js" ></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css"/>
 <!--  -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.0/datatables.min.js"></script>
<script src="controler/js/alsoAlgoJS.js"></script>

</head>
<style >
	*{
		padding: 0;
		margin: 0;
		font-size: 15px;
		font-family: arial;

	}
	body{
		width: 100%;
		padding: 0;
		margin: 0;
		background-color: #f1f1f1;
	}
	.navbar{
		width: 100%;
		position: fixed;
		opacity: .95;
		top: 0;
		height: auto;

	}
	.navbar-brand{
		width: 155px;
		
		/*border: 1px solid red;*/
	}
	.navbar-brand img{
		width: 100%;
		margin-top: -6.5%;
	}
	.navbar-toggler{
		border: 1px solid red;
	}
	.navbar{
		color: white;
		background-color: #212121;
		border-bottom: 3px solid darkorange;
	}
	.nav-item{
		padding: 0 10px;
	}
	.nav-link{
		color: white;
	}
	.nav-link:hover{
		color: darkorange;
	}
	.dropdown-item:hover{
		border: 2px solid darkorange;
		border-radius: 10px;
		background-color: #212529;
	}
	.nav-item:hover{
		border: 2px solid darkorange;
		border-radius: 10px;
	}
	.btn-outline-success{
		border: none;
		color: darkorange;
	}
	.btn-outline-success:hover{
		background-color: #212529;
		border: none;
	}
	.me-2{
		background-color: #212529;
		border: none;
		color: darkorange;
		border-radius: 10px;
	}
	.me-2:hover{
		background-color: #212529;
		color: darkorange;
	}
	.d-flex{
		border-bottom: 2px solid darkorange;
	}
	.fa{
		padding: 0 5px;
	}
	.navbar-toggler-icon,.navbar-toggler{
		color: darkorange;
	}
	.dropdown-menu{
		width: 200px;
	}
	.body-tag{
		background-image: url(img/bg-net.jpg);
		height: 90vh;
		margin-top: 5%;
	}
	.enroll{
		opacity: .8;
		width: 30%;
		
		margin-top: 100px;
		margin-left: -13%;

	}
	.enroll .caller{
		width: 100%;
		border-radius: 10px;
		box-shadow: -9px -9px 0px 3px darkorange;
		padding: 10px 10px;
	}
	.navigation-btn{
		display: flex;

	}
	.navigation-btn .btns-asset{
		padding: 5px 10px;
	}
	.navigation-btn .btns-asset .btn-{
		border: 2px solid darkorange;
		color: darkorange;
	}
	.navigation-btn .btns-asset .btn-:hover{
		background-color: darkorange;
		color: white;
		border: white;
	}
	.navigation-btn .btns-asset .btn-1{
		border: 2px solid crimson;
		color: crimson;
	}
	.navigation-btn .btns-asset .btn-1:hover{
		background-color: crimson;
		color: white;
		border: white;
	}
	.text-center{
		text-align: center;
		text-transform: uppercase;
		font-size: 20px;
	}
	.modal{
		
		color: white;
		
	}
	.modal-content{
		background-color: #212529;
		opacity: .8;
	}
	.select-area{
		width: 100%;
		padding: 5px 10px;
		
	}
	.select-area select, input{
		width: 100%;
		padding: 5px 10px;
		color: darkorange;
		background-color: #212529;
		border: none;
		border-bottom: 2px solid darkorange;

	}

	.select-area button{
		width: 100%;
		color: darkorange;
		border: 2px solid darkorange;
		border-radius: 50px;
	}
	.select-area button:hover{
		border: 2px solid white;
		color: white;
		background-color: darkorange;
	}
	.acute{
		width: 100%;
		display: flex;
		padding: 5px 10px;
	}
 
.acute .recoverPassword{
	color: red;
	border: 2px solid red;
}
.acute .recoverPassword:hover{
	border: 2px solid white;
	background-color:red;
	color: white;
}
.acute .newAccount{
	color: white;
	border: 2px solid white;
}	
.acute .newAccount:hover{
	background-color: white;
	color: red;
	border: 2px solid red;
}
.scroller-menu{
	width: 100%;
	
	padding: 10px 0;
}
.scroller-menu .groupId{
	text-decoration: blink;
	text-align: center;
	color: darkorange;
	text-transform: uppercase;
	text-decoration-line: underline;
	text-shadow: 2px darkorange;
	font-size: 18px;
	font-weight: bolder;

}
div.scrollmenu{
	overflow: auto;
	white-space: nowrap;
	width: 100%;
	padding: 20px 20px;
	/*background-color: darkorange;*/
	background-image: url('img/images (12).jpeg');
	
	background-repeat: repeat;
}
div.scrollmenu .scrollbody{
	display: inline-block;
	text-align: center;
	padding: 5px 5px;
	text-decoration: none;
	width: 20%;
	/*border: 1px solid red;*/
	height: 55vh;
	
	background-color: white;
	border-radius: 10px;
	/*border: 2px solid darkorange;/*#f1f1f1;*/
}
div.scrollmenu .scrollbody .img-display{
	width: 100%;
}
div.scrollmenu .scrollbody .img-display .text-feature{
	color: white;
	text-align: left;
	width: 100%;
	
}
div.scrollmenu .scrollbody .img-display .text-feature .productName{
	color: white;
	width: 100%;
	text-align: center;
	padding: 4px 4px;
	font-weight: bolder;
	font-family: arial;
	font-style: bold;
} 
div.scrollmenu .scrollbody .img-display .text-feature .productDescription{
	overflow-wrap: break-word;
  word-wrap: break-word;
	width: 100%;

}
div.scrollmenu .scrollbody .img-display .text-feature .product-Volv{
	width: 100%;
	display: inline-flex;
}
/*div.scrollmenu .scrollbody .img-display .text-feature .product-Volv .acn*/
div.scrollmenu .scrollbody .img-display .text-feature .cartBtn{
	width: 100%;
	padding: 5px 5px;
	display: flex;
}
div.scrollmenu .scrollbody .img-display .text-feature .cartBtn .cartBtn-n{
	width: 50%;

}
div.scrollmenu .scrollbody .img-display .text-feature .cartBtn .cartBtn-n .btn-cart-product{
	border: 2px solid darkorange;
	color: darkorange;
	background-color: none;
	width: 98%;
	border-radius: 50px;
}
div.scrollmenu .scrollbody .img-display .text-feature .cartBtn .cartBtn-n .btn-cart-product:hover{
	border: 2px solid white;
	color: white;
	background-color: darkorange;

}
div.scrollmenu .scrollbody .img-display .text-feature .cartBtn .cartBtn-n .btn-view-product{
	border: 2px solid white;
	color: white;
	width: 98%;
	border-radius: 50px;
}
div.scrollmenu .scrollbody .img-display .text-feature .cartBtn .cartBtn-n .btn-view-product:hover{
	border: 2px solid navy;
	color: navy;
	background-color: white;

}
div.scrollmenu .scrollbody .img-display .text-feature .product-Volv .acn{
	width: 50%;
	color: white;
	font-size: 10px;
}
div.scrollmenu .scrollbody .img-display img{
	width: 100%;
	height: 220px;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
}
/*div.scrollmenu .scrollbody:hover{
	
}*/
.footermack{
	width: 100%;
	background-color: #212529;
	color: white;
	padding: 10px 10px;
	border-top: 3px solid darkorange;
	display: flex;
	/*border: 2px solid green;*/
}
.footermack .rodmap{
	width: 100%;
}
.footermack .rodmap-i{
	width: 30%;
	/*border: 1px solid red;*/
	font-size: 20px;
	font-family: arial;
	font-weight: bolder;
	font-style: bold;
}
.footermack .rodmap-i .deve-secu{
	width: 100%;
	color: darkorange;
}
.footermack .rodmap-i .img-mac-dis{
	width: 100%;
}
.footermack .rodmap-i .img-mac-dis img{
	width: 60px;
	height: 60px;
}
@media only screen and (max-width: 600px){
	div.scrollmenu .scrollbody{
		width: 100%;
		height: 60vh;
	}
	div.scrollmenu .scrollbody .img-display img{
		height: 240px;
	}
}
@media only screen and (max-width: 913px){
		.navbar-brand{
			width: 78%;
		}
		.body-tag{
			height: 35vh;
			margin-top: 7.5%;
		}
		.navbar-brand img{
			width: 150px;
			height: 70px;
			margin-top: -1%;
		}
	}
	@media only screen and (max-width: 870px){
		.navbar-brand{
			width: 78%;
		}
		.body-tag{
			height: 35vh;
			margin-top: 17%;
		}
		.navbar-brand img{
			width: 150px;
			height: 70px;
			margin-top: -5.6%;
		}
	}
	@media only screen and (max-width: 821px){
		.body-tag{
			margin-top: 7.5%;
		}
	}
	@media only screen and (max-width: 769px){
		.body-tag{
			margin-top: 8.5%;
		}
		.footermack{
			display: block;
			width: 100%;
		}
		.footermack .rodmap-i{
			width: 100%;
		}
		.footermack .txt{
			text-align: center;
		}
	}
	@media only screen and (max-width: 540px){
		.body-tag{
			margin-top: 12%;
		}
	}
	@media only screen and (max-width: 420px){
		.body-tag{
			margin-top: 16%;
		}
	}
	
	@media only screen and (max-width: 370px){
		.body-tag{
			margin-top: 18%;
		}
	}
	@media only screen and (max-width: 280px){
		.body-tag{
			margin-top: 22.7%;
		}
	}
</style>
<script>
	$(document).ready(function(){
      
	});
</script>
<body>


<!-- Slider -->
<div id="carouselExampleIndicators" class="body-tag carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
  </ol>
  <div class="carousel-inner" style="height:100%;">
    <div class="carousel-item active" style="height:100%;">
      <img class="d-block w-100" src="img/Slide1.jpg" alt="First slide" style="width:100%;height: 100%;">
      <div class="carousel-caption d-none d-md-block  enroll" style="">
      	<div class="bg-dark caller">
      		<h3>PRODUCT NAME</h3>
			    <p>Product Description, ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam .</p>
			    <p>
      	</div>
		    	<div class="navigation-btn">
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-" data-toggle="modal" data-target="#masItemId">Add 2 Cart >> <i class="fa fa-shopping-cart"></i></button>
		    		</div>
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-1">Sign in <i class="fa fa-sign-in"></i></button>
		    	  </div>

		    	</div>
		  </div>
    </div>
    <div class="carousel-item" style="height:100%;">
      <img class="d-block w-100" src="img/Slide2.jpg" alt="Second slide" style="width:100%;height:100%;">
      <div class="carousel-caption d-none d-md-block  enroll" style="">
      	<div class="bg-dark caller">
      		<h3>PRODUCT NAME</h3>
			    <p>Product Description, ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam .</p>
			    <p>
      	</div>
		    	<div class="navigation-btn">
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-" data-toggle="modal" data-target="#masItemId">Add 2 Cart >> <i class="fa fa-shopping-cart"></i></button>
		    		</div>
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-1">Sign in <i class="fa fa-sign-in"></i></button>
		    	  </div>
		    	</div>
		  </div>
    </div>
    <div class="carousel-item" style="height:100%;">
      <img class="d-block w-100" src="img/Slide3.jpg" alt="Third slide" style="width:100%;height:100%;">
      <div class="carousel-caption d-none d-md-block  enroll" style="">
      	<div class="bg-dark caller">
      		<h3>PRODUCT NAME</h3>
			    <p>Product Description, ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam .</p>
			    <p>
      	</div>
		    

		    	<div class="navigation-btn">
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-" data-toggle="modal" data-target="#masItemId">Add 2 Cart >> <i class="fa fa-shopping-cart"></i></button>
		    		</div>
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-1">Sign in <i class="fa fa-sign-in"></i></button>
		    	  </div>

		    	</div>
		  </div>
    </div>
    <div class="carousel-item" style="height:100%;">
      <img class="d-block w-100" src="img/Slide4.jpg" alt="Fourth slide" style="width:100%;height:100%;;">
      <div class="carousel-caption d-none d-md-block  enroll" style="">
      	<div class="bg-dark caller">
      		<h3>PRODUCT NAME</h3>
			    <p>Product Description, ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam .</p>
			    <p>
      	</div>
		    

		    	<div class="navigation-btn">
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-" data-toggle="modal" data-target="#masItemId">Add 2 Cart >> <i class="fa fa-shopping-cart"></i></button>
		    		</div>
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-1">Sign in <i class="fa fa-sign-in"></i></button>
		    	  </div>

		    	</div>
		  </div>
    </div>
    <div class="carousel-item" style="height:100%;">
      <img class="d-block w-100" src="img/Slide5.jpg" alt="Fifth slide" style="width:100%;height:100%;">
      <div class="carousel-caption d-none d-md-block  enroll" style="">
      	<div class="bg-dark caller">
      		<h3>PRODUCT NAME</h3>
			    <p>Product Description, ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam .</p>
			    <p>
      	</div>
		    

		    	<div class="navigation-btn">
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-" data-toggle="modal" data-target="#masItemId">Add 2 Cart >> <i class="fa fa-shopping-cart"></i></button>
		    		</div>
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-1">Sign in <i class="fa fa-sign-in"></i></button>
		    	  </div>

		    	</div>
		  </div>
    </div>
    <div class="carousel-item" style="height:100%;">
      <img class="d-block w-100" src="img/Slide6.jpg" alt="Sixth slide" style="width:100%;height:100%;">
      <div class="carousel-caption d-none d-md-block  enroll" style="">
      	<div class="bg-dark caller">
      		<h3>PRODUCT NAME</h3>
			    <p>Product Description, ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam .</p>
			    <p>
      	</div>
		    

		    	<div class="navigation-btn">
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-" data-toggle="modal" data-target="#masItemId">Add 2 Cart >> <i class="fa fa-shopping-cart"></i></button>
		    		</div>
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-1">Sign in <i class="fa fa-sign-in"></i></button>
		    	  </div>

		    	</div>
		  </div>
    </div>
    <div class="carousel-item" style="height:100%;">
      <img class="d-block w-100" src="img/Slide7.jpg" alt="Seventh slide" style="width:100%;height:100%;;">
      <div class="carousel-caption d-none d-md-block  enroll" style="">
      	<div class="bg-dark caller">
      		<h3>PRODUCT NAME</h3>
			    <p>Product Description, ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam .</p>
			    <p>
      	</div>
		    

		    	<div class="navigation-btn">
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-" data-toggle="modal" data-target="#masItemId">Add 2 Cart >> <i class="fa fa-shopping-cart"></i></button>
		    		</div>
		    		<div class="btns-asset">
		    			<button type="button" class="btn btn-primary btn-1">Sign in <i class="fa fa-sign-in"></i></button>
		    	  </div>

		    	</div>
		  </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- Nav Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark abc">
  <div class="container-fluid">
    <a class="navbar-brand" ><img src="img/logo.png"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="color:darkorange;border:darkorange;background: darkorange;">
      <span class="navbar-toggler-icon" ></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item" data-toggle="modal" data-target="#customerLogin">
          <a class="nav-link active" aria-current="page" href="#" style="color:darkorange;">Login<i class="fa fa-sign-in" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" style="color:darkorange;">Cart<i class="fa fa-shopping-cart" aria-hidden="true"></i> <small style="font-size: 10px;">0</small></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:darkorange;">
            More
          </a>
          <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#" style="color:darkorange;">About Us</a></li>
            <li><a class="dropdown-item" href="#" style="color:darkorange;">Contact us</a></li>
            <li><hr class="dropdown-divider" style="border: 1px solid darkorange;"></li>
            <li data-toggle="modal" data-target="#adminLogin" class="bg-danger"><a class="dropdown-item" href="#" style="color:darkorange;">Staff <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li> -->
      </ul>
      <div class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </div>
</nav>
<!-- vertical Scroll -->
<div class="scroller-menu">
	<div class="groupId"><h3>Name of Grouped Product</h3></div>
	<div class="scrollmenu">
		<div class="scrollbody bg-dark">
				<div class="img-display ">
					<img src="img/1.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
									<!-- <div class="acn"></div> -->
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
		<div class="scrollbody bg-dark">
				<div class="img-display bg-dark">
					<img src="img/2.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
		<div class="scrollbody bg-dark">
				<div class="img-display bg-dark">
					<img src="img/3.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
		<div class="scrollbody bg-dark">
				<div class="img-display bg-dark">
					<img src="img/4.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
		<div class="scrollbody bg-dark">
				<div class="img-display bg-dark">
					<img src="img/5.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
		<div class="scrollbody bg-dark">
				<div class="img-display bg-dark">
					<img src="img/6.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
		<div class="scrollbody bg-dark">
				<div class="img-display bg-dark">
					<img src="img/7.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
		<div class="scrollbody bg-dark">
				<div class="img-display bg-dark">
					<img src="img/8.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
		<div class="scrollbody bg-dark">
				<div class="img-display bg-dark">
					<img src="img/9.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
		<div class="scrollbody bg-dark">
				<div class="img-display bg-dark">
					<img src="img/10.jpg">
					<div class="text-feature">
							<div class="productName"><h3>Product Name</h3></div>
							<div class="productDescription">
								<p>kdjfknfksjdnsfdjfn</p>
							</div>
							<div class="product-Volv">
									<div class="acn">On Stock</div>
									<div class="acn">: 25</div>
									<div class="acn"></div>
									<div class="acn"></div>
									<div class="acn">sold</div>
									<div class="acn">: 300</div>
							</div>
							<div class="cartBtn">
								<div class="cartBtn-n">
									<button class="btn btn-cart-product">Add 2 Cart <i class="fa fa-shopping-cart"></i></button>
								</div>
								<div class="cartBtn-n">
									<button class="btn btn-view-product">View Product</button>
								</div>
							</div>
					</div>
				</div>
		</div>
	</div>
</div>

<div class="footermack">
		<div class="rodmap" style="display: block;">
			<ul>
				<li><div class="randover-mac"><a href="about.php" title="About us" style="color: white;">About Us</a></div></li>
				<li><div class="randover-mac"><a href="contact.php" title="Contact us" style="color: white;">Contact Us</a></div></li>
			</ul>
				<div class="rondval">
					<div class="p-key">
						<i class="fa fa-facebook"></i>
					</div>
					<div class="p-key">
						<i class="fa fa-twitter"></i>
					</div>
						<!-- <div class="vepmo-jhbjh" style="display:inline-flex;padding: 20px 20px;">
							<div class="cials-pack-kjbkj" style="width: 50px;height: 50px;border:2px solid white;border-radius:100%;padding: 10px 10px;"><i class="fa fa-facebook" style="font-size:30px;"></div>
							<div class="cials-pack-kjbkj" style="width: 50px;height: 50px;border:2px solid white;border-radius:100%;padding: 10px 10px;"><i class="fa fa-instagram" style="font-size:30px;"></div>
							<div class="cials-pack-kjbkj" style="width: 50px;height: 50px;border:2px solid white;border-radius:100%;padding: 10px 10px;"><i class="fa fa-twitter" style="font-size:30px;"></div>
							<div class="cials-pack-kjbkj" style="width: 50px;height: 50px;border:2px solid white;border-radius:100%;padding: 10px 10px;"><i class="fa fa-linkedin" style="font-size:30px;"></div>
						</div> -->
				</div>
				
		</div>
		<div class="rodmap mms txt">
				<h5>Designed & Developed by <a href="https://netchatsa.com" title="netchatsa" ><span class="mms-tech" style="color:darkorange;">MMS Enterprise</span></a></h5>
		</div>
		<div class="rodmap-i">
			<center>
				<div class="deve-secu">Managed & Secure by</div>
				<div class="img-mac-dis">
					<img src="img/transparent.png">
				</div>
			</center>
		</div>
</div>

<div class="container">
	<!-- Modal -->
	<div class="modal fade text-center" id="masItemId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Product title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade text-center" id="resetPas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Customer/client Reset Password</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      		<div class="select-area alert-border">
	        		<h5>
	        			Please enter your account email address, We will then send you more details and instructions to follow to reset your password.
	        		</h5>
	        	</div>
	        	<div class="select-area">
	        		<input type="email" class="email" placeholder="Access Email Address">
	        	</div>
	        	
	        	<div class="select-area acute">
	        		<button class="btn submit-btn resetPassword" > Submit Email</button>
	        		<button class="btn submit-btn newAccount" data-dismiss="modal" data-toggle="modal" data-target="#newAccount">Create new Account</button>
	        	</div>
	      </div>
	      <div class="modal-footer" >
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade text-center" id="newAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Customer/client New Account</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      		<div class="select-area alert-border">
	        		<h5>
	        			Enter New Account Details Here
	        		</h5>
	        	</div>
	        	<div class="select-area">
	        		<input type="email" class="email" placeholder="Access Email Address">
	        	</div>
	        	
	        	<div class="select-area acute">
	        		<button class="btn submit-btn createNewAccount" > Create New Account</button>
	        	</div>
	      </div>
	      <div class="modal-footer" >
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade text-center" id="customerLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Customer/client Login</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        	<div class="select-area">
	        		<input type="email" class="CustomerEmail" placeholder="Access Email Address">
	        	</div>
	        	<div class="select-area emailCustomerLoginError" hidden style="background-color:red;color:white;border:1px solid white;font-size: 10px;padding: 2px 3px;">kjsf fsjkndf fskdfnk</div>
	        	<div class="select-area">
	        		<input type="password" class="CustomerPassword" placeholder="Access password">
	        	</div>
	        	<div class="select-area passwordCustomerLoginError" hidden style="background-color:red;color:white;border:1px solid white;font-size: 10px;padding: 2px 3px;">kjsf fsjkndf fskdfnk</div>
	        	<div class="select-area">
	        		<button class="btn submit-btn customer_login">Login</button>
	        	</div>
	        	<div class="select-area acute">
	        		<button class="btn submit-btn recoverPassword" data-dismiss="modal" data-toggle="modal" data-target="#resetPas">Reset my password here..</button>
	        		<button class="btn submit-btn newAccount" data-dismiss="modal" data-toggle="modal" data-target="#newAccount">Create new Account</button>
	        	</div>
	      </div>
	      <div class="modal-footer" >
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade text-center" id="adminLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel" style="padding: 5px 10px;">Staff Login <span class="bg-dark" style="color: red;">ONLY</span></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        	<div class="select-area">
	        		<select class="admin_type">
	        			<option value="">-- Select Access Duty --</option>
	        			<option value="1">Diretor Access</option>
	        			<option value="2">Management Access</option>
	        			<option value="3">Admin Consultant Access</option>
	        		</select>
	        	</div>
	        	<div class="select-area admin_typeLoginAdmin" hidden style="background-color:red;color:white;border:1px solid white;font-size: 10px;padding: 2px 3px;">kjsf fsjkndf fskdfnk</div>
	        	<div class="select-area">
	        		<input type="email" class="Adminemail" placeholder="Access Email Address">
	        	</div>
	        	<div class="select-area emailLoginAdmin" hidden style="background-color:red;color:white;border:1px solid white;font-size: 10px;padding: 2px 3px;">kjsf fsjkndf fskdfnk</div>
	        	<div class="select-area">
	        		<input type="password" class="Adminpassword" placeholder="Access password">
	        	</div>
	        	<div class="select-area passwordLoginAdmin" hidden style="background-color:red;color:white;border:1px solid white;font-size: 10px;padding: 2px 3px;">kjsf fsjkndf fskdfnk</div>
	        	<div class="select-area">
	        		<button class="btn submit-btn login">Login</button>
	        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" style="background-color: darkorange;border-radius: 50px;border:1px solid white;" data-dismiss="modal">Close</button>
	        <!-- <button type="button" class="btn btn-primary">Login</button> -->
	      </div>
	    </div>
	    <script>
	    	$(document).ready(function(){
					$(".login").click(function(){
						$(".admin_typeLoginAdmin").attr("hidden","true");
						$(".emailLoginAdmin").attr("hidden","true");
						$(".passwordLoginAdmin").attr("hidden","true");

						const email=$(".Adminemail").val();
						const pass=$(".Adminpassword").val();
						const admin_type=$(".admin_type").val();
						if(admin_type==""){
							$(".admin_typeLoginAdmin").removeAttr("hidden");
							$(".admin_typeLoginAdmin").html("**Admin type Required**");
							$(".admin_typeLoginAdmin").attr("style","border:2px solid red;color:white;padding:3px 5px; font-size:10px;");
						}
						else if(email==""){
							$(".emailLoginAdmin").removeAttr("hidden");
							$(".emailLoginAdmin").html("**Email Required**");
							$(".emailLoginAdmin").attr("style","border:2px solid red;color:white;padding:3px 5px; font-size:10px;");
						}
						else if(!isEmail(email)){
							$(".emailLoginAdmin").removeAttr("hidden");
							$(".emailLoginAdmin").html("**Incorrect email format!!**");
							$(".emailLoginAdmin").attr("style","border:2px solid red;color:white;padding:3px 5px; font-size:10px;");
						}
						else if(pass==""){
							$(".passwordLoginAdmin").removeAttr("hidden");
							$(".passwordLoginAdmin").html("**Password Required**");
							$(".passwordLoginAdmin").attr("style","border:2px solid red;color:white;padding:3px 5px; font-size:10px;");
						}
						else{
							const url="controler/upload.php";
							$.ajax({
								url:url,
								type:"POST",
								data:{email:email,pass:pass,admin_type:admin_type},
								cache:false,
								beforeSend:function(){
									// $(".login").removeAttr("hidden");
									$(".login").html("<img style='width:10%;' src='img/loader.gif'><h5 style='color:green;'>Processing..</h5>");
								},
								success:function(e){
									console.log(e);
									console.log(e.length);
									if(e.length>2){
										// $(".login").removeAttr("hidden");
										$(".login").attr("style","color:red;");
										$(".login").html(" "+e);
									}
									else{
										// $(".login").removeAttr("hidden");
										$(".login").html("<small style='color:green;'> Login Successful... please wait redirecting page..</small>");
										$(".Adminemail").val("");
										$(".Adminpassword").val("");
										$(".admin_type").val("");
										window.location=("./");
									}
								}
							});

						}
						
					});
// cusstomer



					$(".customer_login").click(function(){
						const CustomerEmail=$(".CustomerEmail").val();
						const CustomerPassword=$(".CustomerPassword").val();


						if(CustomerEmail==""){
							$(".emailCustomerLoginError").removeAttr("hidden");
							$(".emailCustomerLoginError").html("**Email Required**");
							$(".emailCustomerLoginError").attr("style","border:2px solid red;color:white;padding:3px 5px; font-size:10px;");
						}
						else if(!isEmail(CustomerEmail)){
							$(".emailCustomerLoginError").removeAttr("hidden");
							$(".emailCustomerLoginError").html("**Incorrect email format!!**");
							$(".emailCustomerLoginError").attr("style","border:2px solid red;color:white;padding:3px 5px; font-size:10px;");
						}
						else if(CustomerPassword==""){
							$(".passwordCustomerLoginError").removeAttr("hidden");
							$(".passwordCustomerLoginError").html("**Password Required**");
							$(".passwordCustomerLoginError").attr("style","border:2px solid red;color:white;padding:3px 5px; font-size:10px;");
						}
						else{
							const url="controler/upload.php";
							$.ajax({
								url:url,
								type:"POST",
								data:{CustomerEmail:CustomerEmail,CustomerPassword:CustomerPassword},
								cache:false,
								beforeSend:function(){
									// $(".login").removeAttr("hidden");
									$(".customer_login").html("<img style='width:10%;' src='img/loader.gif'><h5 style='color:green;'>Processing..</h5>");
								},
								success:function(e){
									// console.log(e);
									// console.log(e.length);
									if(e.length>2){
										// $(".login").removeAttr("hidden");
										$(".customer_login").attr("style","color:red;");
										$(".customer_login").html(" "+e);
									}
									else{
										// $(".login").removeAttr("hidden");
										$(".customer_login").html("<small style='color:green;'> Login Successful... please wait redirecting page..</small>");
										$(".CustomerEmail").val("");
										$(".CustomerPassword").val("");
										
										window.location=("./");
									}
								}
							});

						}
						
					});
				});
	    </script>
	  </div>
	</div>
</div>

<script>
	function isEmail(email){
		return true;
	}
</script>
</body>
</html>