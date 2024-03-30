<?php
include_once("../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;

if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['usermail'])){
  $userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
  $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
  $tertiaryApplicationsPdo = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
  $adminPdo = PDOServiceFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
    date_default_timezone_set('Africa/Johannesburg');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="E-Learning for all SGELA is an app engineered to simplify all tertiary & bursary applications and easily accessible.">
      <meta name="keywords" content=" MMS HIGH TECH | <?php echo $cur_user_row['name']." ".$cur_user_row['surname'];?> | E-Learning for all">
      <meta name="author" content="Mr M.S Mzobe">
        <link rel='dns-prefetch' href='https://netchatsa.com/admin//s0.wp.com' />
      <link rel='dns-prefetch' href='https://netchatsa.com/admin/'/>
      <link rel='dns-prefetch' href='https://netchatsa.com/admin//fonts.googleapis.com' />
      <link rel='dns-prefetch' href='https://netchatsa.com/admin//s.w.org' />
      <link rel="alternate" type="application/rss+xml" title="E-Learning for all &raquo; Feed" href="https://netchatsa.com/admin/feed/" />
      <link rel="alternate" type="application/rss+xml" title="E-Learning for all &raquo; Comments Feed" href="https://netchatsa.com/admin/feed/" />
      <meta property="og:title" content="MMS HIGH TECH | <?php echo $cur_user_row['name']." ".$cur_user_row['surname'];?>"/>
        <meta property="og:description" content="MMS HIGH TECH | <?php echo $cur_user_row['name']." ".$cur_user_row['surname'];?>"/>

      <title><?php echo $cur_user_row['name']." ".$cur_user_row['surname'];?></title>
      <link rel="icon" href="../img/aa.jpg">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<script src="https://www.payfast.co.za/onsite/engine.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <!-- <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-ckfinder@41.2.0/src/index.min.js"></script>  -->

 <!-- <script src="../ckeditor/ckeditor.js"></script>
 <script src="../ckfinder/ckfinder.js"></script> -->
   </head>
   <style>
     /* Googlefont Poppins CDN Link */
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
/*  font-size: 12px;*/
}
.selected{
  border-bottom: 2px solid mediumvioletred;
  border-top: 2px solid rebeccapurple;
  background: -webkit-linear-gradient(mediumvioletred,purple,rebeccapurple);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.sidebar{
  position: fixed;
  height: 100%;
  width: 240px;
  background: #11101d;
  transition: all 0.5s ease;
  font-size:12px;
}
.sidebar.active{
  width: 60px;
}
.sidebar .logo-details{
  height: 80px;
  display: flex;
  align-items: center;
}
.sidebar .logo-details i{
  font-size: 28px;
  font-weight: 500;
  color: #fff;
  min-width: 60px;
  text-align: center
}
.largeModal{
  width:1100px;
  margin-left: -58%;
}
.sidebar .logo-details .logo_name{
  color: #fff;
  font-size: 18px;
  font-weight: 500;
}
.sidebar .nav-links{
  margin-top: 10px;
  margin-left: -21px;
}
.sidebar .nav-links li{
  position: relative;
  list-style: none;
  height: 50px;
}
.sidebar .nav-links li a{
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  text-decoration: none;
  transition: all 0.4s ease;
  font-size:12px;
}
.sidebar .nav-links li a.active{
  background: #081D45;
}
.sidebar .nav-links li a:hover{
  background: #081D45;
}
.sidebar .nav-links li i{
  min-width: 60px;
  text-align: center;
  font-size: 18px;
  color: #fff;
}

.sidebar .nav-links li a .links_name{
  color: #fff;
  font-size: 15px;
  font-weight: 400;
  white-space: nowrap;
  cursor: pointer;
}
.sidebar .nav-links .log_out{
  position: absolute;
  bottom: 0;
  width: 100%;
}
.home-section{
  position: relative;
  background: #081D45;
  min-height: 100vh;
  width: calc(100% - 240px);
  left: 240px;
  transition: all 0.5s ease;
  height: 100%;
/*  width:90%;*/
}
.sidebar.active ~ .home-section{
  width: calc(100% - 60px);
  left: 60px;
}
.home-section nav{
  display: flex;
  justify-content: space-between;
  height: 70px;
  background: #11101d;
  display: flex;
  align-items: center;
  position: fixed;
  width: calc(100% - 240px);
  left: 240px;
  z-index: 100;
  padding: 0 20px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  transition: all 0.5s ease;
}
.sidebar.active ~ .home-section nav{
  left: 60px;
  width: calc(100% - 60px);
}
.home-section nav .sidebar-button{
  display: flex;
  align-items: center;
  font-size: 24px;
  font-weight: 500;
  color:#fff;
}
nav .sidebar-button i{
  font-size: 35px;
  margin-right: 10px;
}
.home-section nav .search-box{
  position: relative;
  height: 50px;
  max-width: 550px;
  width: 100%;
  margin: 0 20px;
  font-size: 18px;
  color:#f1f1f1;
}
.searchMasomaneSchoolSlide .searchMasomaneSchool{
  width: 100%;
  height:100%;
  outline: none;
  background: #11101d;;
  border: 2px solid #EFEEF1;
  border-radius: 6px;
  font-size: 18px;
  padding: 0 15px;
  color:#fff;
}
.searchMasomaneSchoolSlide{
  position: absolute;
  height: 40px;
  width: 250px;
  background: #11101d;
  border-radius: 4px;
  line-height: 40px;
  text-align: center;
  color: #fff;
  font-size: 22px;
  transition: all 0.4 ease;
  padding: 0 10px;
}
.home-section nav .profile-details{
  display: flex;
  align-items: center;
  background: #11101d;;
  border: 2px solid #EFEEF1;
  border-radius: 6px;
  height: 50px;
  min-width: 190px;
  padding: 0 15px 0 2px;
}
nav .profile-details img{
  height: 40px;
  width: 40px;
  border-radius: 6px;
  object-fit: cover;
}
th,td{
  color: #fff;
}

nav .profile-details .admin_name{
  font-size: 15px;
  font-weight: 500;
  color: #fff;
  margin: 0 10px;
  white-space: nowrap;
}
nav .profile-details i{
  font-size: 25px;
  color: #fff;
}
.home-section .home-content{
  position: relative;
  padding-top: 104px;
}
.home-content .overview-boxes{
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  padding: 0 20px;
  margin-bottom: 26px;
}
.overview-boxes .box{
  display: flex;
  align-items: center;
  justify-content: center;
  width: calc(100% / 4 - 15px);
  background: #11101d;
  padding: 12px 10px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.1);
  color:#fff;
}
.overview-boxes .box-topic{
  font-size: 15px;
  font-weight: 500;
  color: #ddd;
}
.home-content .box .number{
  display: inline-block;
  font-size: 18px;
  margin-top: -6px;
  font-weight: 500;
}
.home-content .box .indicator{
  display: flex;
  align-items: center;
}
.home-content .box .indicator i{
  height: 15px;
  width: 15px;
  background: #8FDACB;
  line-height: 20px;
  text-align: center;
  border-radius: 50%;
  color: #fff;
  font-size: 15px;
  margin-right: 5px;
}
.box .indicator i.down{
  background: #e87d88;
}
.home-content .box .indicator .text{
  font-size: 12px;
}
.home-content .box .cart{
  display: inline-block;
  font-size: 32px;
  height: 50px;
  width: 50px;
  background: #cce5ff;
  line-height: 50px;
  text-align: center;
  color: #66b0ff;
  border-radius: 12px;
  margin: -15px 0 0 6px;
}
.home-content .box .cart.two{
   color: #2BD47D;
   background: #C0F2D8;
 }
.home-content .box .cart.three{
   color: #ffc233;
   background: #ffe8b3;
 }
.home-content .box .cart.four{
   color: #e05260;
   background: #f7d4d7;
 }
.home-content .total-order{
  font-size: 20px;
  font-weight: 500;
}
.home-content .masomane{
  display: flex;
  justify-content: space-between;
  height: 61vh;
  <?php
  $r=3;
  if($r!==1){
    ?>
    height: 82vh;
    <?php
  }
  ?>
  
}
.home-content .masomane::-webkit-scrollbar{
  width:1px;
}
.home-content .masomane::-webkit-scrollbar-thumb {
  background: white; 
  border-radius: 10px;
}

/* left box */
.home-content .masomane .makhanyile{
  width: 100%;
  background: #11101d;
  padding: 20px 30px;
  margin: 0 20px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  color:#fff;
  overflow-y: scroll;
  overflow-wrap: break-word;
  word-wrap: break-word;
  hyphens: auto;
  height: 100%;  
}
.box-shadow{
  box-shadow: 3px 5px 3px #000;
}
.home-content .masomane .makhanyile::-webkit-scrollbar{
  width:1px;
}
.home-content .masomane .makhanyile::-webkit-scrollbar-thumb {
  background: white; 
  border-radius: 10px;
}
.home-content .masomane .makhanyileDtails{
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #11101d;
  color:#fff;
}
.masomane .box .title{
  font-size: 24px;
  font-weight: 500;
  border-bottom: 1px solid white;
  /* margin-bottom: 10px; */
}
.masomane .makhanyileDtails li.topic{
  font-size: 20px;
  font-weight: 500;
  color: #ddd;
}
.masomane .makhanyileDtails li{
  list-style: none;
  margin: 8px 0;
}

.masomane .makhanyileDtails li a{
  font-size: 18px;
  color: #fff;
  font-size: 400;
  text-decoration: none;
  cursor: pointer;
}
.masomane .box .button{
  width: 100%;
  display: flex;
  justify-content: flex-end;
}
.masomane .box .button a{
  color: #fff;
  background: #0A2558;
  padding: 4px 12px;
  font-size: 15px;
  font-weight: 400;
  border-radius: 4px;
  text-decoration: none;
  transition: all 0.3s ease;
  cursor: pointer;
}
.masomane .box .button a:hover{
  background:  #0d3073;
}

/* Right box */
.home-content .masomane .maKhathi{
  width: 28%;
  background: #11101d;
  padding: 20px 30px;
  margin: 0 20px 0 0;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  color:#fff;
  overflow-y: auto;
  overflow-wrap: break-word;
  word-wrap: break-word;
  hyphens: auto;
  height: 100%;
}
.badge{
  cursor: pointer;
}
.home-content .masomane .maKhathi::-webkit-scrollbar{
  width:1px;
}
.home-content .masomane .maKhathi::-webkit-scrollbar-thumb {
  background: red; 
  border-radius: 10px;
}
.home-content .masomane .maKhathi .pass{
  width:40px;
  height: 40px;
  border:2px solid #fff;
  border-radius: 100%;
  background:green;
  padding: 10px 10px;
  text-align: center;
  font-size: 12px;

}
.home-content .masomane .maKhathi .failed{
  width:40px;
  height: 40px;
  border:2px solid #fff;
  border-radius: 100%;
  background:red;
  padding: 10px 10px;
  text-align: center;
  font-size: 12px;

}
.home-content .masomane .maKhathi .markPernding{
  width:40px;
  height: 40px;
  border:2px solid #fff;
  border-radius: 100%;
  background:#0d3073;
  padding: 10px 10px;
  text-align: center;
  font-size: 12px;
}
.masomane .maKhathi li{
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 10px 0;
}
.masomane .maKhathi li a img{
  height: 40px;
  width: 40px;
  object-fit: cover;
  border-radius: 12px;
  margin-right: 10px;
  background: #333;
}
.masomane .maKhathi li a{
  display: flex;
  align-items: center;
  text-decoration: none;
  cursor: pointer;
}
.masomane .maKhathi li .product,
.marks{
  font-size: 17px;
  font-weight: 400;
  color: #fff;
  background:#11101d;
}
.modal-content{
  background: #11101d;
}
.inputVals{
  width: 100%;
  padding:10px 10px;
}
.modal-title{
  text-align: center;
  color: white;

}
.inputVals .addMasomaneNewSchool{
  border:2px solid white;
  color:white;
  border-radius: 100px;
  text-align: center;
  cursor: pointer;
}
.inputVals input,select{
  width:100%;
  border:none;
  border-bottom: 2px solid white;
  background:none;
  color:white;
  padding: 10px 10px;
}
select{
  background: #11101d;
  color: white;
}
/* Responsive Media Query */
@media (max-width: 1240px) {
  .sidebar{
    width: 60px;
  }
  .sidebar.active{
    width: 220px;
  }
  .home-section{
    width: calc(100% - 60px);
    left: 60px;
  }
  .sidebar.active ~ .home-section{
    /* width: calc(100% - 220px); */
    overflow: hidden;
    left: 220px;
  }
  .home-section nav{
    width: calc(100% - 60px);
    left: 60px;
  }
  .sidebar.active ~ .home-section nav{
    width: calc(100% - 220px);
    left: 220px;
  }
}
@media (max-width: 1150px) {
  .home-content .masomane{
    flex-direction: column;
  }
  .home-content .masomane .box{
    width: 100%;
    overflow-x: scroll;
    margin-bottom: 30px;
  }
  .home-content .masomane .maKhathi{
    margin: 0;
  }
}
@media (max-width: 1000px) {
  .overview-boxes .box{
    width: calc(100% / 2 - 15px);
    margin-bottom: 15px;
  }
}
@media (max-width: 700px) {
  nav .sidebar-button .dashboard,
  nav .profile-details .admin_name,
  nav .profile-details i{
    display: none;
  }
  .home-section nav .profile-details{
    height: 50px;
    min-width: 40px;
  }
  .home-content .masomane .makhanyileDtails{
    width: 560px;
  }
}
@media (max-width: 550px) {
  .overview-boxes .box{
    width: 100%;
    margin-bottom: 15px;
  }
  .sidebar.active ~ .home-section nav .profile-details{
    display: none;
  }
}
  @media (max-width: 400px) {
  .sidebar{
    width: 0;
  }
  .sidebar.active{
    width: 60px;
  }
  .home-section{
    width: 100%;
    left: 0;
  }
  .sidebar.active ~ .home-section{
    left: 60px;
    width: calc(100% - 60px);
  }
  .home-section nav{
    width: 100%;
    left: 0;
  }
  .sidebar.active ~ .home-section nav{
    left: 60px;
    width: calc(100% - 60px);
  }
}
   </style>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">MMS HIGH TECH</span>
    </div>
      <ul class="nav-links">
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/uni/applicationsa.php")' class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Applications</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/uni/Applicationsa.php")'>
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Accepted Std</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/admin/highSchools.php")'>
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Regretted Std</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/admin/tertiaries.php")'>
            <i class='bx bx-box' ></i>
            <span class="links_name">Universities</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/admin/funding.php")'>
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Bursaries</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/admin/matricUpgrade.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Matric Upgrade</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/admin/netchatsaSchooling.php")'>
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">netchatsa</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/admin/payments.php")'>
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Payments</span>
          </a>
        </li>
        <!-- <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/admin/mmsteam.php")'>
            <i class='bx bx-user' ></i>
            <span class="links_name">MMS Team</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/admin/mmswork.php")'>
            <i class='bx bx-user' ></i>
            <span class="links_name">MMS Work</span>
          </a>
        </li> -->
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../src/forms/admin/settings.php")'>
            <i class='bx bx-cog' ></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
          <a onclick="logout()">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard time_and_date" style="font-size: 12px;"></span>
      </div>
      <div class="search-box">
        MMS HIGH TECH <span class="username"> ~ <?php echo $cur_user_row['name']." ".$cur_user_row['surname']." : ".$cur_user_row['id'];?>
      </div>
      <div class="profile-details">
        <img src="../img/profile.jpg" alt="" style="width:100%;">
        <span class="admin_name"><?php echo $cur_user_row['name']." ".$cur_user_row['surname'];?></span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>

    <div class="home-content">
      <?php
      $r =0;
      if($r===1){
        ?>
          <div class="overview-boxes">
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Schools</div>
                <div class="number"><?php echo $adminPdo->totalSchools();?></div>
                <div class="indicator">
                  <i class='bx bx-up-arrow-alt'></i>
                  <span class="text">Up from yesterday</span>
                </div>
              </div>
              <i class='bx bx-cart-alt cart'></i>
            </div>
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Students</div>
                <div class="number"><?php echo $adminPdo->totalStudents();?></div>
                <div class="indicator">
                  <i class='bx bx-up-arrow-alt'></i>
                  <span class="text">Up from yesterday</span>
                </div>
              </div>
              <i class='bx bxs-cart-add cart two' ></i>
            </div>
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Teachers</div>
                <div class="number"><?php echo $adminPdo->totalTeachers();?></div>
                <div class="indicator">
                  <i class='bx bx-up-arrow-alt'></i>
                  <span class="text">Up from yesterday</span>
                </div>
              </div>
              <i class='bx bx-cart cart three' ></i>
            </div>
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Revenue</div>
                <div class="number">R<?php echo $adminPdo->getRevenu();?></div>
                <div class="indicator">
                  <i class='bx bx-down-arrow-alt down'></i>
                  <span class="text">Down From Today</span>
                </div>
              </div>
              <i class='bx bxs-cart-download cart four' ></i>
            </div>
          </div>
          <?php

        }
          ?>
        
      <div class="masomane"></div>
    </div>
  </section>
<div class="modal" id="MaSomaneAddNewSchool">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="text-align: center;">Add New School</h4>
        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="inputVals">
          <input type="text" required class="PrincipalName" placeholder="Enter Principal Name">
        </div>
        <div class="inputVals">
          <input type="text" required class="PrincipalSurname" placeholder="Enter Principal Surname">
        </div>
        <div class="inputVals">
          <input type="number" required class="PrincipalPhoneNo" placeholder="Enter Principal Phone No">
        </div>
        <div class="inputVals">
          <input type="email" required class="PrincipalEmail" placeholder="Enter Principal Email">
        </div>
        <div class="inputVals">
          <select class="selectMasomaneSchool">
            <option value=""> -- Select School -- </option>
            <?php
              $tertiaryApplicationsPdo->getAllSchools();
            ?>
          </select>
        </div>
        <div class="inputVals">
          <input type="number" required class="PrincipaIdNo" placeholder="Enter Principal ID No">
        </div>
        <div class="inputVals">
          <input type="password" required class="PrincipaPass" placeholder="Enter Principal Password">
        </div>
        <div class="inputVals">
          <input type="number" required class="PrincipaPersal" placeholder="Enter Principal Persal">
        </div>
        <br>
        <div class="inputVals">
          <input type="ssubmit" class="addMasomaneNewSchool" onclick="maSomaneAddNewSchool()" value="Add New School" >
        </div>
        <div class="errorLogMasoManeAddSchool" hidden></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="showModal">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="showModal"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="largeModal">
  <div class="modal-dialog">
    <div class="modal-content largeModal">
      
      <div class="showlargeModal"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="addNetchatsaSubjects">
  <style>
    input.errorLogMasoManeAddNetchatsaSubject{
      width: 100%;
      border:none;
      border-radius: 100px;
      background:none;
      border-top: 2px solid rebeccapurple;
      border-bottom: 2px solid mediumvioletred;
      color:rebeccapurple;
    }
    input.errorLogMasoManeAddNetchatsaSubject:hover{
      border-bottom: 2px solid rebeccapurple;
      border-top: 2px solid mediumvioletred;
      color:mediumvioletred;
    }

  </style>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="text-align: center;">Add Netchatsa Subject</h4>
        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="inputVals">
          <input type="text" required class="SubjectNameNetchatsa" placeholder="Enter Principal Name">
        </div>
        <div class="inputVals">
          <select class="gradeNetchatsa">
            <option value=""> -- Select Grade -- </option>
            <option value="Gr12">Grade 12</option>
            <option value="Gr11">Grade 11</option>
            <option value="Gr10">Grade 10</option>
            <option value="Gr9">Grade 9</option>
            <option value="Gr8">Grade 8</option>
          </select>
        </div>
        
        <br>
        <div class="inputVals">

          <input type="submit" class="MasoManeAddNetchatsaSubject" onclick="MasoManeAddNetchatsaSubject()" value="Add new netchatsa subject" >
        </div>
        <div class="errorLogMasoManeAddNetchatsaSubjectError" hidden></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    loadMasomane("masomane");
    setInterval(function() {
      $(".time_and_date").load('../src/forms/admin/timer.php');
    }, 1000);

});
$(document).on("change",".ticket_status",function(){
  const ticket_status=$(".ticket_status").val();
  const ticket_id = $(".ticket_id").val();
  console.log("sending "+ticket_status+" "+ticket_id);
  const url="../app/controller/adminController.php";
  $.ajax({
    url:url,
    type:"POST",
    data:{ticket_status:ticket_status,ticket_id:ticket_id},
    cache:false,
    success:function(e){
      if(e.length==1){
        console.log("added");
      }
      else{
        console.log("Error: "+e);
      }
    }
  });
});
$(document).on("change",".selectClassField",function(){
  const selectClassField=$(".selectClassField").val();
  loadAfterQuery(".rutoDisplayChapters","../src/forms/admin/netcjatsaSubjectFilterByLevel.php?level="+selectClassField);
});
$(document).on("change",".subjectNameMatricUpgrade",function(){
  const subjectNameMatricUpgrade=$(".subjectNameMatricUpgrade").val();
  loadAfterQuery(".rutoDisplayChapters","../src/forms/admin/rutoDisplayChapters.php?subj="+subjectNameMatricUpgrade);
});
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
    sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
  }
  else{
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
}
function loadMasomane(url){
  LoadOnClick(url);
}
function logout(){
  const url="../app/controller/adminController.php";
  logoutExit="1";
  $("#log_out").html('Sign Off Request Sent..');
  $.ajax({
      url:url,
      type:"POST",
      data:{logoutExit:logoutExit},
      cache:false,
      success:function(e){
        console.log(e);
        if(e.length==1){
          $("#log_out").html('Good Bye...');
          window.location("../");
        }
        else{
          $("#log_out").html('Error: '+e);
        }
      }
    });
}
function LoadOnClick(url){
  // console.log("loading on click");
  $(".masomane").html("<center><img src='../img/loader.gif' style='width:10%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'></center>").load("../src/forms/admin/masomaneProject.php?"+url);
}
function searchStudentsByIdNumber(){
  var findMe = document.getElementById("searchStudentsByIdNumber").value;
   console.log(findMe);
   if(findMe==""){
    loadAfterQuery(".ApplicantsLoader","../src/forms/admin/ApplicantsLoader.php?start=0&limit=10");
   }
   else{
    const url="../src/forms/admin/ApplicantsLoaderSeach.php";
    $.ajax({
      url:url,
      type:"POST",
      data:{findMe:findMe},
      cache:false,
      success:function(e){
        document.getElementById("ApplicantsLoader").innerHTML = e;
      }
    });
  }
}
function searchInputSchool(){
  var findMe = document.getElementById("searchInputSchool").value;
   if(findMe==""){
    loadAfterQuery(".AsivezeIzikoleLaphaLeft","../src/forms/admin/AsivezeIzikoleLaphaLoader.php");
   }
   else{
    const url="../src/forms/admin/AsivezeIzikoleLaphaLoaderSearch.php";
    $.ajax({
      url:url,
      type:"POST",
      data:{findMe:findMe},
      cache:false,
      success:function(e){
        // console.log(e);
        document.getElementById("AsivezeIzikoleLaphaLeft").innerHTML = e;
      }
    });
  }
}
function SearchSubjectMatricUpgrade(){
  var findMe = document.getElementById("SearchSubjectMatricUpgrade").value;
   if(findMe==""){
    loadAfterQuery(".dataDisplayerIdrMatricUpgradeSubjects","../src/forms/admin/dataDisplayerIdrMatricUpgradeSubjects.php");
   }
   else{
    const url="../src/forms/admin/SearchSubjectMatricUpgrade.php";
    $.ajax({
      url:url,
      type:"POST",
      data:{findMe:findMe},
      cache:false,
      success:function(e){
        // console.log(e);
        document.getElementById("dataDisplayerIdrMatricUpgradeSubjects").innerHTML = e;
      }
    });
  }
}
function searchMasomaneSchoolFunc(){
   var findMe = document.getElementById("searchMasomaneSchool").value;
    // document.getElementById("meassageOnType").innerHTML = x;
   if(findMe==""){
    loadAfterQuery(".dynamicalLoad1","../src/forms/admin/loadMasomaneSchools.php?start=0&limit=10");
   }
   else{
    const url="../src/forms/admin/searchMasomaneSchools.php";
    $.ajax({
      url:url,
      type:"POST",
      data:{findMe:findMe},
      cache:false,
      success:function(e){
        document.getElementById("dynamicalLoad1").innerHTML = e;
      }
    });
  }
}
function searchBursaries(){
  var findMe = document.getElementById("searchBursaries").value;
    // document.getElementById("meassageOnType").innerHTML = x;
   if(findMe==""){
    loadAfterQuery(".dataDisplayerIdr","../src/forms/admin/DisplayFunding.php");
   }
   else{
    const url="../src/forms/admin/seachBursaries.php";
    $.ajax({
      url:url,
      type:"POST",
      data:{findMe:findMe},
      cache:false,
      success:function(e){
        document.getElementById("dataDisplayerIdr").innerHTML = e;
      }
    });
  }
}
function searchCourseFundedbyInstitution(){
  var findMe = document.getElementById("searchCourse").value;
    // document.getElementById("meassageOnType").innerHTML = x;
   if(findMe==""){
    $(".dataDisplayerIdrCourses").html("Search Cleared..");
   }
   else{
    const url="../src/forms/admin/searchCourseFundedbyInstitution.php";
    $.ajax({
      url:url,
      type:"POST",
      data:{findMe:findMe},
      cache:false,
      success:function(e){
        document.getElementById("dataDisplayerIdrCourses").innerHTML = e;
      }
    });
  }
}
function saveSchoolName(){
  const schoolNameInput = $(".schoolNameInput").val();
  $(".randOffInputError").removeAttr("hidden").attr("style","color:green;").html("<center><img src='../img/loader.gif' style='width:30%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'> Submitting Request...</center>");
  $(".schoolNameInput").removeAttr("style").attr("style");

  if(schoolNameInput==""){
    $(".randOffInputError").attr("style","padding:5px 5px;color:red;").html("Field Required!!..");
    $(".schoolNameInput").attr("style","background:red");

  }
  else{
    $.ajax({
      url:'../app/controller/adminController.php',
      type:'post',
      data:{
        schoolNameInput:schoolNameInput
          },
      success:function(e){
        if(e.length>1){
            $(".randOffInputError").attr("style","padding:5px 5px;color:red;").html(e);
        }
        else{
            $(".randOffInputError").attr("style","padding:5px 5px;color:green;border:1px solid green;").html("School Added Successfuly");
            clearInput([".schoolNameInput"]);
            loadAfterQuery(".AsivezeIzikoleLaphaLeft","../src/forms/admin/AsivezeIzikoleLaphaLoader.php");
        }
      }
    });
  }
}
function maSomaneAddNewSchool(){
  const PrincipalName=$(".PrincipalName").val();
  const PrincipalSurname=$(".PrincipalSurname").val();
  const PrincipalPhoneNo=$(".PrincipalPhoneNo").val();
  const PrincipalEmail=$(".PrincipalEmail").val();
  const selectMasomaneSchool=$(".selectMasomaneSchool").val();
  const PrincipaIdNo=$(".PrincipaIdNo").val();
  const PrincipaPass=$(".PrincipaPass").val();
  const PrincipaPersal=$(".PrincipaPersal").val();
  $(".PrincipalName").removeAttr("style");
  $(".PrincipalSurname").removeAttr("style");
  $(".PrincipalPhoneNo").removeAttr("style");
  $(".PrincipalEmail").removeAttr("style");
  $(".selectMasomaneSchool").removeAttr("style");
  $(".PrincipaIdNo").removeAttr("style");
  $(".PrincipaPass").removeAttr("style");
  $(".PrincipaPersal").removeAttr("style");
  $(".errorLogMasoManeAddSchool").attr("style","color:green;").removeAttr("hidden").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'> Submitting Request...</center>");
  if(PrincipalName==""){
    $(".PrincipalName").attr("style","background:red;");
    $(".errorLogMasoManeAddSchool").attr("style","color:red;").html("Field Required**");
  }
  else if(PrincipalSurname==""){
    $(".PrincipalSurname").attr("style","background:red;");
    $(".errorLogMasoManeAddSchool").attr("style","color:red;").html("Field Required**");
  }
  else if(PrincipalPhoneNo==""){
    $(".PrincipalPhoneNo").attr("style","background:red;");
    $(".errorLogMasoManeAddSchool").attr("style","color:red;").html("Field Required**");
  }
  else if(PrincipalEmail==""){
    $(".PrincipalEmail").attr("style","background:red;");
    $(".errorLogMasoManeAddSchool").attr("style","color:red;").html("Field Required**");
  }
  else if(selectMasomaneSchool==""){
    $(".selectMasomaneSchool").attr("style","background:red;");
    $(".errorLogMasoManeAddSchool").attr("style","color:red;").html("Field Required**");
  }
  else if(PrincipaIdNo==""){
    $(".PrincipaIdNo").attr("style","background:red;");
    $(".errorLogMasoManeAddSchool").attr("style","color:red;").html("Field Required**");
  }
  else if(PrincipaPass==""){
    $(".PrincipaPass").attr("style","background:red;");
    $(".errorLogMasoManeAddSchool").attr("style","color:red;").html("Field Required**");
  }
  else if(PrincipaPersal==""){
    $(".PrincipaPersal").attr("style","background:red;");
    $(".errorLogMasoManeAddSchool").attr("style","color:red;").html("Field Required**");
  }
  else if(!ValidateEmail(PrincipalEmail)){
    $(".PrincipalEmail").attr("style","background:red;");
    $(".errorLogMasoManeAddSchool").attr("style","color:red;").html("Email Not Valid!!");
  }
  else{
    $.ajax({
      url:'../app/controller/adminController.php',
      type:'post',
      data:{PrincipalName:PrincipalName,
            PrincipalSurname:PrincipalSurname,
            PrincipalPhoneNo:PrincipalPhoneNo,
            PrincipalEmail:PrincipalEmail,
            selectMasomaneSchool:selectMasomaneSchool,
            PrincipaIdNo:PrincipaIdNo,
            PrincipaPass:PrincipaPass,
            PrincipaPersal:PrincipaPersal
          },
      success:function(e){
        if(e.length>1){
            $(".errorLogMasoManeAddSchool").attr("style","padding:5px 5px;color:red;").html(e);
        }
        else{
            $(".errorLogMasoManeAddSchool").attr("style","padding:5px 5px;color:green;border:1px solid green;").html("School Added Successfuly");
            clearInput([".PrincipalName",".PrincipalSurname",".PrincipalPhoneNo",".PrincipalEmail",".selectMasomaneSchool",".PrincipaIdNo",".PrincipaPass",".PrincipaPersal"]);
            loadAfterQuery(".dynamicalLoad1","../src/forms/admin/loadMasomaneSchools.php?start=0&limit=10");
        }
      }
    });
  }
}
function clearInput(array){
  for(i=0;i<array.length;i++){
    $(array[i]).val("");
  }
}
function sendReminderPn(StudentIdQRQR){
  sendReminderPn
  $.ajax({
    url:'../app/controller/adminController.php',
    type:'post',
    data:{
      StudentIdQRQR:StudentIdQRQR
    },
    beforeSend:function(){
      $(".sendReminderPn"+StudentIdQRQR).removeAttr("hidden").attr("style","color:white;").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Submitting Request...</center>");
    },
    success:function(e){
        if(e.length==1){
          $(".sendReminderPn"+StudentIdQRQR).attr("style","color:green;").html("<center>Email Sent</center>");
          
        }
        else{
          $(".sendReminderPn"+StudentIdQRQR).attr("style","color:red;").html("<center>"+e+"</center>");
        }
    }
  });
}
function loadAfterQuery(rclass,dir){
  $(rclass).html("<center><img src='../img/loader.gif' style='width:30%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'></center>").load(dir);
}
function viewThisSchooInfo(viewThisSchooInfoID,is_read){
  $.ajax({
      url:'../src/forms/admin/showSchoolModal.php',
      type:'post',
      data:{viewThisSchooInfoID:viewThisSchooInfoID,is_read:is_read},
      beforeSend:function(){
          $(".showModal").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
      },
      success:function(e){
          // console.log(e);
          $(".showModal").html(e);
      }
    });
  $("#showModal").modal("show");
}
function addNewCourse(){
  const ddd=1;
  $.ajax({
      url:'../src/forms/admin/addNewCourseModal.php',
      type:'post',
      data:{ddd:ddd},
      beforeSend:function(){
          $(".showModal").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
      },
      success:function(e){
          // console.log(e);
          $(".showModal").html(e);
      }
    });
  $("#showModal").modal("show");
}
function saveInsititution(){
  const TextNewInstitution = $(".TextNewInstitution").val();
  const TextNewInstitutionApiLink = $(".TextNewInstitutionApiLink").val();
  const TextNewInstitutionAPIKey = $(".TextNewInstitutionAPIKey").val();
  const TextNewInstitutionAipKey2 = $(".TextNewInstitutionAipKey2").val();
  const TextNewInstitutiontoken = $(".TextNewInstitutiontoken").val();
  $(".TextNewInstitution").removeAttr("style");
  $(".TextNewInstitutionApiLink").removeAttr("style");
  $(".TextNewInstitutionAPIKey").removeAttr("style");
  $(".TextNewInstitutionAipKey2").removeAttr("style");
  $(".TextNewInstitutiontoken").removeAttr("style");
  $(".error-logSettup").removeAttr("hidden").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Processing Request...</center>");
  if(TextNewInstitution==""){
    $(".TextNewInstitution").attr("style","background:red;");
    $(".error-logSettup").attr("style","color:red;").html("Field Required!!");
  }
  else if(TextNewInstitutionApiLink==""){
    $(".TextNewInstitutionApiLink").attr("style","background:red;");
    $(".error-logSettup").attr("style","color:red;").html("Field Required!!");
  }
  else if(TextNewInstitutionAPIKey==""){
    $(".TextNewInstitutionAPIKey").attr("style","background:red;");
    $(".error-logSettup").attr("style","color:red;").html("Field Required!!");
  }
  else if(TextNewInstitutionAipKey2==""){
    $(".TextNewInstitutionAipKey2").attr("style","background:red;");
    $(".error-logSettup").attr("style","color:red;").html("Field Required!!");
  }
  else if(TextNewInstitutiontoken==""){
    $(".TextNewInstitutiontoken").attr("style","background:red;");
    $(".error-logSettup").attr("style","color:red;").html("Field Required!!");
  }
  else{
    $.ajax({
      url:'../app/controller/adminController.php',
      type:'post',
      data:{
        TextNewInstitution:TextNewInstitution,
        TextNewInstitutionApiLink:TextNewInstitutionApiLink,
        TextNewInstitutionAPIKey:TextNewInstitutionAPIKey,
        TextNewInstitutionAipKey2:TextNewInstitutionAipKey2,
        TextNewInstitutiontoken:TextNewInstitutiontoken
      },
      beforeSend:function(){
        $(".error-logSettup").removeAttr("hidden").attr("style","color:white;").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Submitting Request...</center>");

      },
      success:function(e){
          if(e.length==1){
            $(".error-logSettup").attr("style","color:green;").html("<center>Institution Added.</center>");
            loadAfterQuery(".dataDisplayerIdr","../src/forms/admin/DisplayFunding.php");
            clearInput(['.TextNewInstitution',
                        '.TextNewInstitutionApiLink',
                        '.TextNewInstitutionAPIKey',
                        '.TextNewInstitutionAipKey2',
                        '.TextNewInstitutiontoken']);
          }
          else{
            $(".error-logSettup").attr("style","color:red;").html("<center>"+e+"</center>");
          }
      }
    });
  }
}
function addNewInstitution(){
  const ddd=1;
  $.ajax({
      url:'../src/forms/admin/addNewInstitutioModal.php',
      type:'post',
      data:{ddd:ddd},
      beforeSend:function(){
          $(".showModal").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
      },
      success:function(e){
          // console.log(e);
          $(".showModal").html(e);
      }
    });
  $("#showModal").modal("show");
}
function addMatricUpgradeNewChapter(){
  const ddd=1;
  $.ajax({
      url:'../src/forms/admin/addMatricUpgradeNewChapter.php',
      type:'post',
      data:{ddd:ddd},
      beforeSend:function(){
          $(".showModal").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
      },
      success:function(e){
          // console.log(e);
          $(".showModal").html(e);
      }
    });
  $("#showModal").modal("show");
}
function AddNewContent(){
  const ddd=1;
  $.ajax({
      url:'../src/forms/admin/AddNewContent.php',
      type:'post',
      data:{ddd:ddd},
      beforeSend:function(){
          $(".showModal").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
      },
      success:function(e){
          // console.log(e);
          $(".showModal").html(e);
      }
    });
  $("#showModal").modal("show");
}
function CreateNewTicket(){
  const neTicket = 1;
  $.ajax({
      url:'../src/forms/admin/newTicket.php',
      type:'post',
      data:{neTicket:neTicket},
      beforeSend:function(){
          $(".showlargeModal").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
      },
      success:function(e){
          // console.log(e);
          $(".showlargeModal").html(e);
      }
    });

  $("#largeModal").modal("show");
}
function ValidateEmail(email_id){
    const regex_pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

   if (regex_pattern.test(email_id)) {
    return true;
  }
    return false;
}
function saveNewProject(){
  const projectName = $(".projectName").val();
  const Decription = $(".Decription").val();
  const Sprint = $(".Sprint").val();
  $(".error-logSettup").removeAttr("hidden").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Processing Request...</center>");
  $(".Sprint").removeAttr('style');
  $(".projectName").removeAttr('style');
  $(".Decription").removeAttr('style');
  if(projectName==""){
    $(".error-logSettup").attr("style","color:red;").html("Input Field required!!");
    $(".projectName").attr("style","color:white;background:red;");
  }
  else if(Decription==""){
    $(".error-logSettup").attr("style","color:red;").html("Input Field required!!");
    $(".Decription").attr("style","color:white;background:red;");
  }
  else if(Sprint==""){
    $(".error-logSettup").attr("style","color:red;").html("Input Field required!!");
    $(".Sprint").attr("style","color:white;background:red;");
  }
  else{
    $.ajax({
      url:'../app/controller/adminController.php',
      type:'post',
      data:{
        projectName:projectName,
        Decription:Decription,
        Sprint:Sprint
      },
      beforeSend:function(){
        $(".error-logSettup").removeAttr("hidden").attr("style","color:white;").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Submitting Request...</center>");

      },
      success:function(e){
          if(e.length==1){
            $(".error-logSettup").attr("style","color:green;").html("<center>Project Saved</center>");
            loadAfterQuery(".ProjectbodyMagnitude","../src/forms/admin/myWork.php");
            clearInput(['.projectName','.Decription','.Sprint']);
          }
          else{
            $(".error-logSettup").attr("style","color:red;").html("<center>"+e+"</center>");
          }
      }
    });
  }
}
function saveNewTicket(){
  const editorEDS = CKEDITOR.instances.editorEDS.getData();
  const projectStatsI = $(".projectStatsI").val();
  const textTicketDescription = $(".textTicketDescription").val();
  const textTicketWeight = $(".textTicketWeight").val();
  $(".errorSubmit").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Submitting Request...</center>");
  if(editorEDS==""){
    $(".errorSubmit").attr("style","color:red;").html("Input Field required!!");
    $("#editorEDS").attr("style","color:white;background:red;");
  }
  else if(projectStatsI==""){
    $(".errorSubmit").attr("style","color:red;").html("Input Field required!!");
    $(".projectStatsI").attr("style","color:white;background:red;");
  }
  else if(textTicketDescription==""){
    $(".errorSubmit").attr("style","color:red;").html("Input Field required!!");
    $(".textTicketDescription").attr("style","color:white;background:red;");
  }
  else if(textTicketWeight==""){
    $(".errorSubmit").attr("style","color:red;").html("Input Field required!!");
    $(".textTicketWeight").attr("style","color:white;background:red;");
  }
  else{
    $.ajax({
      url:'../app/controller/adminController.php',
      type:'post',
      data:{
        editorEDS:editorEDS,
        projectStatsI:projectStatsI,
        textTicketDescription:textTicketDescription,
        textTicketWeight:textTicketWeight
      },
      beforeSend:function(){
        $(".error-logSettup").removeAttr("hidden").attr("style","color:white;").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Submitting Request...</center>");

      },
      success:function(e){
          if(e.length==1){
            $(".errorSubmit").attr("style","color:green;").html("<center>Ticket Saved</center>");
            // loadAfterQuery(".ProjectbodyMagnitude","../src/forms/admin/myWork.php");
            clearInput(['#editorEDS','.projectStatsI','.textTicketDescription','.textTicketWeight']);
          }
          else{
            $(".errorSubmit").attr("style","color:red;").html("<center>"+e+"</center>");
          }
      }
    });
  }
}
function saveMatricUpgradeNewChapter(){
  const subjectName = $(".subjectName").val();
  const TextChapter = $(".TextChapter").val();
  $(".error-logSettup").removeAttr("hidden").attr("style","color:white;").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Submitting Request...</center>");
  if(subjectName==""){
    $(".subjectName").attr("background:red;");
    $(".error-logSettup").attr("style","color:red;").html("Field Required!!");
  }
     
  else if(TextChapter==""){
    $(".TextChapter").attr("background:red;");
    $(".error-logSettup").attr("style","color:red;").html("Field Required!!");
  }
  else{
    $.ajax({
      url:'../app/controller/adminController.php',
      type:'post',
      data:{
        subjectName:subjectName,
        TextChapter:TextChapter
      },
      beforeSend:function(){
        $(".error-logSettup").removeAttr("hidden").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Processing Request...</center>");
      },
      success:function(e){
          if(e.length==1){
            $(".error-logSettup").attr("style","color:green;").html("<center>Course Saved</center>");
            clearInput(['.TextChapter']);
          }
          else{
            $(".error-logSettup").attr("style","color:red;").html("<center>"+e+"</center>");
          }
      }
    });
  }
}
function saveNewFunding(){
  const selectInstitution = $(".selectInstitution").val();
  const selectCourse = $(".selectCourse").val();
  $(".error-logSettup").removeAttr("hidden").attr("style","color:white;").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Submitting Request...</center>");
  if(selectInstitution==""){
    $(".selectInstitution").attr("background:red;");
    $(".error-logSettup").attr("style","color:red;").html("Field Required!!");
  }
     
  else if(selectCourse==""){
    $(".selectCourse").attr("background:red;");
    $(".error-logSettup").attr("style","color:red;").html("Field Required!!");
  }
  else{
    $.ajax({
      url:'../app/controller/adminController.php',
      type:'post',
      data:{
        selectInstitution:selectInstitution,
        selectCourse:selectCourse
      },
      beforeSend:function(){
        $(".error-logSettup").removeAttr("hidden").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Processing Request...</center>");
      },
      success:function(e){
          if(e.length==1){
            $(".error-logSettup").attr("style","color:green;").html("<center>Course Saved</center>");
            clearInput(['.selectCourse']);
          }
          else{
            $(".error-logSettup").attr("style","color:red;").html("<center>"+e+"</center>");
          }
      }
    });
  }
     
}
function activateOnclick(id){
  const allElements =  document.querySelectorAll('*');
  allElements.forEach((element) => {
    element.classList.remove('activeBtn');
  });
  $('.activate'+id).addClass('activeBtn');
}
function activateOnclickDynamic(id,selected){
  console.log(id+" "+selected+"  = "+id+selected)
  const allElements =  document.querySelectorAll('*');
  allElements.forEach((element) => {
    element.classList.remove(selected);
  });
  $('.'+selected+id).addClass(selected);
}
function removeContentFromDb(deleteThisContent){
    $.ajax({
    url:'../app/controller/adminController.php',
    type:'post',
    data:{deleteThisContent:deleteThisContent},
    success:function(e){
        if(e.length<=2){
            $(".deleteThisContent"+deleteThisContent).attr("hidden","true");
            $(".deleteThisContent"+deleteThisContent).html('removed');
        }
        else{
            $(".deleteThisContent"+deleteThisContent).html("error:"+e);
        }
    }
  });
}
function sendButtonAddingContent(){
  const deremoTerm = $(".deremoTerm").val();
  const subjectChapter = $(".subjectChapter").val();
  const subjectNameMatricUpgrade = $(".subjectNameMatricUpgrade").val();
  const titleOfContent = $(".titleOfContent").val();
  const SourceName = $(".SourceName").val();
  const SourceURL = $(".SourceURL").val();
  $(".deremoTerm").removeAttr('style');
  $(".subjectChapter").removeAttr('style');
  $(".subjectNameMatricUpgrade").removeAttr('style');
  $(".titleOfContent").removeAttr('style');
  $(".SourceName").removeAttr('style');
  $(".SourceURL").removeAttr('style');
  if(deremoTerm==""){
    $(".deremoTerm").attr("style","background:red;");
    $(".failerError").removeAttr("hidden").attr("style","color:red;").html("Required Field!!");
  }
  else if(subjectChapter==""){
    $(".subjectChapter").attr("style","background:red;");
    $(".failerError").removeAttr("hidden").attr("style","color:red;").html("Required Field!!");
  }
  else if(subjectNameMatricUpgrade==""){
    $(".subjectNameMatricUpgrade").attr("style","background:red;");
    $(".failerError").removeAttr("hidden").attr("style","color:red;").html("Required Field!!");
  }
  else if(titleOfContent==""){
    $(".titleOfContent").attr("style","background:red;");
    $(".failerError").removeAttr("hidden").attr("style","color:red;").html("Required Field!!");
  }
  else if(SourceName==""){
    $(".SourceName").attr("style","background:red;");
    $(".failerError").removeAttr("hidden").attr("style","color:red;").html("Required Field!!");
  }
  else if(SourceURL==""){
    $(".SourceURL").attr("style","background:red;");
    $(".failerError").removeAttr("hidden").attr("style","color:red;").html("Required Field!!");
  }
  else{
    $.ajax({
      url:'../app/controller/adminController.php',
      type:'post',
      data:{deremoTerm:deremoTerm,
            subjectChapter:subjectChapter,
            subjectNameMatricUpgrade:subjectNameMatricUpgrade,
            titleOfContent:titleOfContent,
            SourceName:SourceName,
            SourceURL:SourceURL},
      success:function(e){
          if(e.length==1){
              $(".failerError").removeAttr("hidden").attr("style","color:green;").html("<center>Content Saved.</center>");
              clearInput(['.titleOfContent','.SourceURL']);
          }
          else{
              $(".failerError").removeAttr("hidden").attr("style","color:red;").html("error:"+e);
          }
      }
    });
  }
}
function MasoManeAddNetchatsaSubject(){
  const SubjectNameNetchatsa = $(".SubjectNameNetchatsa").val();
  const gradeNetchatsa = $(".gradeNetchatsa").val();
  $(".errorLogMasoManeAddNetchatsaSubjectError").removeAttr("hidden").attr("style","color:white;").html("<center><img src='../img/loader.gif' style='width:5%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'>Processing Request...</center>");
  $(".SubjectNameNetchatsa").removeAttr("style");
  $(".gradeNetchatsa").removeAttr("style");
  if(SubjectNameNetchatsa==""){
    $(".SubjectNameNetchatsa").attr("style","background:red;");
    $(".errorLogMasoManeAddNetchatsaSubjectError").removeAttr("hidden").attr("style","color:white;").html("<center>Field Required!</center>");
  }
  else if(gradeNetchatsa==""){
    $(".gradeNetchatsa").attr("style","background:red;");
    $(".errorLogMasoManeAddNetchatsaSubjectError").removeAttr("hidden").attr("style","color:white;").html("<center>Field Required!</center>");
  }
  else{
    $.ajax({
      url:'../app/controller/adminController.php',
      type:'post',
      data:{SubjectNameNetchatsa:SubjectNameNetchatsa,
            gradeNetchatsa:gradeNetchatsa},
      success:function(e){
        if(e.length==1){
            $(".errorLogMasoManeAddNetchatsaSubjectError").removeAttr("hidden").attr("style","color:green;").html("<center>Subject Saved.</center>");
            clearInput(['.SubjectNameNetchatsa','.gradeNetchatsa']);
        }
        else{
            $(".errorLogMasoManeAddNetchatsaSubjectError").removeAttr("hidden").attr("style","color:red;").html("error:"+e);
        }
      }
    });
  }
}
</script>

</body>
</html>
<?php 
}
else{
  session_destroy();
  ?>
  <script>
    window.location=("../");
  </script>

  <?php
}
?>