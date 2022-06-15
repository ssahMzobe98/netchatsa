<?php
session_start();
if(isset($_SESSION['adminSession'])){ 
require_once("pdo.php");
$pdo=new _pdo_();
$CurrentAdminInfo=$pdo->currentAdminInfo($_SESSION['adminSession']);
$user_dir=$CurrentAdminInfo['userdirectory'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Slindimpilo Development (PTY) LTD was formed in the year 2015 as a supplier and maintainer of the overhead electrical supply, Incorporated by a sole owner in the republic of South Africa. Our primary objective is to provide overhead electrical supply to all the companies efficient to the erection and maintanance of the overhead electrical supply. (::By mms enterprise, netchatsa, Mr MS Mzobe) slindimpilo,electricity, Overhead power line material, Aluminium and Copper Conductors, Preformed line products, Silicone and porcelain insulators, ABC Cables and accessories, Earthing material, Commercial and Private business, Goverment and Municipalities, Private Sector,Individuals.">
<meta name="keywords" content="Electricity Appliance, slindimpilo,electricity, Overhead power line material, Aluminium and Copper Conductors, Preformed line products, Silicone and porcelain insulators, ABC Cables and accessories, Earthing material, Commercial and Private business, Goverment and Municipalities, Private Sector,Individuals, mms enterprise, netchatsa,(::By mms enterprise, netchatsa, Mr MS Mzobe)">
<meta name="author" content="Mr M.S Mzobe,mms enterprise,netchatsa">
<link rel='dns-prefetch' href='https://slindimpilo.co.za/admin/<?php echo$user_dir;?>//s0.wp.com' />
<link rel='dns-prefetch' href='https://slindimpilo.co.za/admin/<?php echo$user_dir;?>/'/>
<link rel='dns-prefetch' href='https://slindimpilo.co.za/admin/<?php echo$user_dir;?>//fonts.googleapis.com' />
<link rel='dns-prefetch' href='https://slindimpilo.co.za/admin/<?php echo$user_dir;?>//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="Slindimpilo Electric Appliance Supply Company  &raquo; Feed" href="https://slindimpilo.co.za/admin/<?php echo $user_dir;?>/feed/" />
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js" ></script> -->
<link rel="alternate" type="application/rss+xml" title="Slindimpilo Electric Appliance Supply Company &raquo; Comments Feed" href="https://slindimpilo.co.za/admin/<?php echo$user_dir;?>/feed/" />
<meta property="og:title" content="Slindimpilo : Where Electricity Begins |(::By mms enterprise)|"/>
<meta property="og:description" content="Slindimpilo Development (PTY) LTD was formed in the year 2015 as a supplier and maintainer of the overhead electrical supply, Incorporated by a sole owner in the republic of South Africa. Our primary objective is to provide overhead electrical supply to all the companies efficient to the erection and maintanance of the overhead electrical supply.(::By mms enterprise, netchatsa, Mr MS Mzobe) "/>
<link rel="icon" href="../../img/dark-logo.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <!--<script type="text/javascript" src="../controller/js/login-rego20.js"></script> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>


<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3.0/dist/css/bootstrap.min.css" crossorigin="anonymous"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- =========================================================================== -->




    <!-- ======================================================== -->
    <title><?php echo $CurrentAdminInfo['name']."_".$CurrentAdminInfo['surname'];?></title>
    <style>
    	body{
    		margin: 0;
    		padding: 0;
    		background: #f1f1f1;
    	}
    	.py-5{
    		height: 1vh;
    	}
    	.darkorange{
    		background: darkorange;
    	}
      .prfile-img{
        width:250px;
        height: 250px;
        border: 2px solid #ddd;
        border-radius: 100%;
        padding: 2px 2px;
      }
      .prfile-img img{
        width: 100%;
        height: 100%;
        border-radius: 100%;
        border: 2px solid #ddd;
        padding: 2px 2px;
      }
      .soul-card{
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 7px;
        padding: 3px 3px;

      }
/*soul-card-header*/
      .dom-mack{
        width: 100%;
        height: 100%;
        border: 1px solid #ddd;
        border-radius: 7px;
      }
      .dom-mack{
        width: 100%;
        padding: 3px 3px;
      }
      .dom-mack .email-info{
        width: 50%;
       
      }
      .dom-mack .email-info input{
        width: 80%;
        border: none;
        color: darkorange;
        padding: 2px 2px;
      }
      .btn-solvent-ab12{
        
        color: darkorange;
        background: none;
      }
      .btn-solvent-ab12:hover{
        
        color: white;
        
      }
      .input-maq{
        width: 100%;
        padding: 4px 4px;
      }
      .input-maq .thoe-dev{
        width: 100%;
        height: 100%;
        border-bottom: 2px solid #ddd;
      }
      .input-maq .thoe-dev input,select{
        width: 100%;
        padding: 7px 7px;
        border: none;
        color: white;
      }
      .input-maq .thoe-dev-pc{
        width: 100%;
        height: 100%;
      }
      .input-maq .thoe-dev-pc button{
        width: 100%;
        padding: 7px 7px;
        border: none;
        color: navy;
        border: 2px solid navy;
        border-radius: 100px;

      }
      .input-maq .thoe-dev-pc button:hover{
        color: white;
        border: 2px solid white;
        background: navy;

      }
      .badge,.nav-link{
        cursor: pointer;
      }
/*btn-solvent-ab12*/
    </style>
  </head>
  <body>
<script>
	$(document).ready(function () {
	    $('#example').DataTable();
	});
</script>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          
          >Slindimpilo Dev <small>(PTY) LTD</small></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
            <div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle ms-2"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" style="cursor: pointer;" data-dismiss="modal" data-toggle="modal" data-target="#MyAccount">Manage Account</a></li>
                <!-- <li><a class="dropdown-item" href="#">Another action</a></li> -->
                <li>
                  <a class="dropdown-item" style="cursor: pointer;" href="?_=exit">Log Out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="./" class="nav-link px-3 active">
                <img src="../../img/reansparent-attempt.png" style="width:90%;height: 160px;">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span><?php echo $CurrentAdminInfo['name']." ".$CurrentAdminInfo['surname'];?></span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Interface
              </div>
            </li>

            <li>
            	<!-- <a ></a> -->
              <a class="nav-link px-3 sidebar-link" href="#layouts"  data-bs-toggle="collapse" role='button' aria-expanded='false' aria-controls='layouts'>
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Tech Team</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li data-toggle="modal" data-target="#addNewAdmin">
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Add Staff Member</span>
                    </a>
                  </li>
                  <li>
                    <a href="?_=manageStaff" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Manage Staff</span>
                    </a>
                  </li>

                  <li data-toggle="modal" data-target="#addmatricsubj">
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Add Verified Customer</span>
                    </a>
                  </li>
                  <li data-toggle="modal" data-target="#addmatricsubj">
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Manage Customer</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a class="nav-link px-3" data-toggle="modal" data-target="#createPortfolio">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Create Potfolio</span>
              </a>
            </li>
            <li>
              <a href="?_=managePortfolio" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Manage Portfolio</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3" data-toggle="modal" data-target="#addsgelamodule">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Add Products</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3" data-toggle="modal" data-target="#addsgelamodule">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Manage Products</span>
              </a>
            </li>

            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                OFF SET
              </div>
            </li>
            <li data-toggle="modal" data-target="#addschool_sgela">
              <a href="#" class="nav-link px-3">
                <span class="me-2"
                  ><i class="bi bi-speedometer2"></i
                ></span>
                <span>Off Set Order</span>
              </a>
            </li>
            <li data-toggle="modal" data-target="#addschool_sgela">
              <a href="#" class="nav-link px-3">
                <span class="me-2"
                  ><i class="bi bi-speedometer2"></i
                ></span>
                <span>Manage Off Set</span>
              </a>
            </li>
            <li data-toggle="modal" data-target="#addschool_sgela">
              <a href="#" class="nav-link px-3">
                <span class="me-2"
                  ><i class="bi bi-speedometer2"></i
                ></span>
                <span>Create Structure</span>
              </a>
            </li>
            <li data-toggle="modal" data-target="#addschool_sgela">
              <a href="#" class="nav-link px-3">
                <span class="me-2"
                  ><i class="bi bi-speedometer2"></i
                ></span>
                <span>Manage Structure</span>
              </a>
            </li>
            
          </ul>
        </nav>
      </div>
    </div>

    <!-- offcanvas -->
    <main class="working-panel mt-5 pt-3">
      <div class="container-fluid">
       	<div class="row">
          <div class="col-md-12">
            <h4>Dashboard: <?php echo $CurrentAdminInfo['position']." :: ".$CurrentAdminInfo['name']." ".$CurrentAdminInfo['surname'];;?></h4>
          </div>
        </div>
        <!-- second row -->
    	<div class="row">
          <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
              <div class="card-body py-5"><i class="fas fa-users"></i>Customers/Clients</div>
              <div class="card-footer d-flex">
                1000
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5"><i class="fas fa-dolly-flatbed"></i>Orders</div>
              <div class="card-footer d-flex">
                1000 /total live orders
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-info text-white h-100">
              <div class="card-body py-5"><i class="fas fa-users"></i>Paid Orders</div>
              <div class="card-footer d-flex">
                1000 / unpaid orders
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100">
              <div class="card-body py-5"><i class="fas fa-truck-loading"></i>Delivered Orders</div>
              <div class="card-footer d-flex">
                1000/ undelivered orders
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
        	
        </div>
        <div class="row">
              <div class="col-md-12 mb-3">

                <div class="card">
                  <?php 
                  if(isset($_GET['_']) && !empty($_GET['_'])){
                    if(strtolower($_GET['_']=="exit")){
                      $pdo->exit($CurrentAdminInfo['adminid']);
                    }
                    elseif(strtolower($_GET['_'])=="managestaff"){
                        $pdo->runMageStaff($CurrentAdminInfo['adminid']);
                    }
                    elseif(strtolower($_GET['_'])=="manageportfolio"){
                      $pdo->managePortfolio($CurrentAdminInfo['adminid']);
                      echo"dfjsdhfkjh";
                    }
                    else{
                      echo 'gjjhghgjgj';
                    }
                    
                    // elseif($strtolower($_GET[''])){

                    // }
                    ?>
                      <!-- comming here!!!... -->
                    <?php
                  }
                  elseif(isset($_GET['analysis'])){
                    ?>
                      analyse employee here!!..
                    <?php
                  }
                  else{
                    ?>
                    <div class="card-header">
                      <span><i class="bi bi-table me-2"></i></span> Customers/Clients Table
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table
                          id="example"
                          class="table table-striped data-table"
                          style="width: 100%"
                        >
                          <thead class="bg-dark text-white">
                            <tr>
                              <th>ID</th>
                              <th>Institution</th>
                              <th>Campuses</th>
                              <th>Faculties</th>
                              <th>Programs</th>
                              <th>Applicants</th>
                              <th>view</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php echo "kkkkkkk";?></td>
                              <td><?php echo "kkkkkkk";?></td>
                              <td><?php echo "kkkkkkk";?></td>
                              <td><?php echo "kkkkkkk";?></td>
                              <td><?php echo "kkkkkkk";?></td>
                              <td><?php echo "kkkkkkk";?></td>
                              <td><a href="?view&_i=<?php echo 'mnmbm';?>"><span class="badge badge-danger text-white">Visit</span></a></td>
                            </tr>
                          </tbody>
                          <tfoot class="bg-dark text-white">
                            <tr>
                              <th>ID</th>
                              <th>Institution</th>
                              <th>Campus</th>
                              <th>Faculties</th>
                              <th>Programs</th>
                              <th>Applicants</th>
                              <th>view</th>
                            </tr>
                          </tfoot>
                        </table>
              
                      </div>
                    </div>
                  <?php
                  }
                  ?>
                  
                </div>
              </div>
            </div>

      </div>

   </main>
<!-- Modal -->
<?php
$_i=$conn->query("select*from portfolio");
while($row=mysqli_fetch_array($_i)){
  $portfolio=$row['portfolio'];
  $id=$row['id'];?>
<div class="modal fade text-center" id="addProduct<?php echo $id;?>">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white text-center">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Item to <?php echo $portfolio;?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="input-maq">
            <div class="thoe-dev">
              <input type="text" class="item<?php echo $id;?> bg-dark" placeholder="Enter Item Name here...">
            </div>
        </div>
        <div class="input-maq">
            <div class="thoe-dev">
              <input type="text" class="ItemDescription<?php echo $id;?> bg-dark" placeholder="Enter Item Description...">
            </div>
        </div>
        <div class="input-maq">
            <div class="thoe-dev">
              <input type="text" class="price<?php echo $id;?> bg-dark" placeholder="Enter Item Price...">
            </div>
        </div>
        <div class="input-maq">
            <div class="thoe-dev" style="border:none">
              Select Item Image
            </div>
            <div class="thoe-dev">
              <input type="file" class="fileItem<?php echo $id;?> bg-dark" name="file" id="fileItem<?php echo $id;?>" placeholder="Select Image">
            </div>
        </div>
        <input type="hidden" class="id_of_portfolio<?php echo $id;?>" value="<?php echo $id;?>">
        <div class="input-maq">
          <div class="thoe-dev-pc">
          <button class="btn addProduct<?php echo $id;?> text-center" onclick="addItem(<?php echo $id;?>)">Add Product/Item</button>
          </div>
        </div>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  <?php
}
?>

<!-- < -->
<div class="modal fade text-center" id="createPortfolio">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white text-center">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create New Portfolio</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="input-maq">
            <div class="thoe-dev">
              <input type="text" class="portfolio bg-dark" placeholder="Enter Portfolio Name here...">
            </div>
        </div>
        <div class="input-maq">
          <div class="thoe-dev-pc">
          <button class="btn addPortfolio text-center">Add Portfolio</button>
          </div>
        </div>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--  -->
  <div class="modal fade text-center" id="addNewAdmin">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-white text-center">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Administrator</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="input-maq">
            <div class="thoe-dev">
            <input type="email" class="email bg-dark text-white text-left" placeholder="Enter Email Address">
            </div>
          </div>
          
          <div class="input-maq">
            <div class="thoe-dev">
            <input type="password" class="password bg-dark text-white text-left" placeholder="Enter temporal password">
            </div>
          </div>
          <div class="input-maq">
            <div class="thoe-dev">
            <input type="text" class="name bg-dark text-white text-left" placeholder="Enter admin name">
            </div>
            <!-- <input type="" name=""> -->
          </div>
          <div class="input-maq">
            <div class="thoe-dev">
            <input type="text" class="surname bg-dark text-white text-left" placeholder="Enter admin surname">
            </div>
          </div>
          <div class="input-maq">
            <div class="thoe-dev">
            <input type="number" class="phone bg-dark text-white text-left" placeholder="Enter phone number ">
            </div>
          </div>
          <div class="input-maq">
            <div class="thoe-dev">
            <select class="adminType bg-dark text-white" style="cursor:pointer;">
              <option value=""> -- Select Admin Type --</option>
              <option value="1">Director</option>
              <option value="2">Management</option>
              <option value="3">Admin Consultant</option>
            </select>
            </div>
          </div>
          <div class="input-maq">
            <div class="thoe-dev-pc">
            <button class="btn btn-conform text-center">Add Admin</button>
            </div>
          </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-center" id="img-change">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white text-center">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update My Profile Picture</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="">
          <input type="file" name="file" class="file" id="profilePost">
        </div>
        <div class="errorDisplayerProfile" hidden></div>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>
<div class="modal fade text-center" id="MyAccount">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white text-center">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">My Account Panel</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <?php 
        $profile=$CurrentAdminInfo['profileimg'];
        $dir="../../img/";
        if($profile=='empty'){
          $dir.="fff.jpg";
        }
        else{
          $dir.=$CurrentAdminInfo['id']."/".$profile;
        }
        ?>
        <center>
          <div class="prfile-img">
        
            <img src="<?php echo $dir;?>" data-dismiss="modal" data-toggle="modal" data-target="#img-change">
           
          </div>
          <div class="soul-card">
            <div class="soul-card-header">

                <h2 style="color:darkorange;">Details of:<?php echo $CurrentAdminInfo['name']." ".$CurrentAdminInfo['surname'];?></h2>
            </div>
            <div class="dom-mack  d-flex" style="border:none;">
              <div class="email-info d-flex" style="border:none;">
                <h5>update email</h5>
              </div>
              <div class="email-info d-flex" style="border:none;">
                <h5>update phone</h5>
              </div>
            </div>
            <div class="dom-mack  d-flex">

              <div class="email-info d-flex">
                
                <div class="solor" style="border:1px solid #ddd;border-radius: 7px;">
                  <input type="email" class="email-changer bg-dark text-white text-center newemail" value="<?php echo $CurrentAdminInfo['adminid'];?>"><button class="btn btn-solvent-ab12 text-center updatemail"><i class="fa fa-upload"></i></button>
                </div>
                  
              </div>
              <div class="email-info d-flex">

                <div class="solor" style="border:1px solid #ddd;border-radius: 7px;">
                  <input type="number" class="phone bg-dark text-white text-center newnum" value="<?php echo $CurrentAdminInfo['phone'];?>"><button class="btn btn-solvent-ab12 text-center updatephone"><i class="fa fa-upload"></i></button>
                </div>
                  
              </div>
            </div>
            <hr>
            <h5>Update Your Password</h5>
            <div class="dom-mack  d-flex">
              <div class="email-info d-flex">
                <div class="solor" style="border:1px solid #ddd;border-radius: 7px;">
                  <input type="password" class="email-changer bg-dark text-white text-center newpass" style="width:100%;" placeholder="Enter new password">
                </div>
                  
              </div>
              <div class="email-info d-flex">
                <div class="solor" style="border:1px solid #ddd;border-radius: 7px;">
                  <input type="password" class="phone bg-dark text-white text-center newpass_1" style="" placeholder="Confirm Password"><button class="btn btn-solvent-ab12 text-center updatepass_1"><i class="fa fa-upload"></i></button>
                </div>
                  
              </div>
            </div>
          </div>
        </center>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>
      <script>
        $(document).ready(function(){
          $(".updatepass_1").click(function(){
            const newpass=$(".newpass").val();
            const newpass_1=$(".newpass_1").val();
            if(newpass_1==""){
              $(".newpass_1").attr("placeholder","Input Empty!!");
            }
            else if(newpass==""){
              $(".newpass").attr("placeholder","Input Empty!!");
            }
            else if(newpass!=newpass_1){
              $(".newpass").attr("style","border:1px solid red;color:red;");
              $(".newpass_1").attr("style","border:1px solid red;color:red;");
            }
            else{
                $(".newpass").val("");
                $(".newpass_1").val("");
                const url="upload.php";
                $.ajax({
                  url:url,
                  type:"POST",
                  data:{newpass:newpass},
                  cache:false,
                  beforeSend:function(){
                    // $(".login").removeAttr("hidden");
                    $(".newpass").attr("placeholder","processing...");
                    $(".newpass_1").attr("placeholder","processing...");
                  },
                  success:function(e){
                    console.log(e);
                    console.log(e.length);
                    if(e.length>2){
                      // $(".login").removeAttr("hidden");
                      
                      $(".newpass").attr("placeholder",e);
                    }
                    else{
                      // $(".login").removeAttr("hidden");
                      $(".newpass").attr("placeholder","successful");
                      $(".newpass_1").attr("placeholder","successful");
                      $(".newpass").attr("style","border:1px solid green;color:green;");
              $(".newpass_1").attr("style","border:1px solid green;color:green;");
                    }
                  }
                });
            }
          });
          $(".updatemail").click(function(){
            const newemail=$(".newemail").val();
            if(newemail==""){
              $(".newemail").attr("placeholder","Input Empty!!")
            }
            else{
                const url="upload.php";
                $.ajax({
                  url:url,
                  type:"POST",
                  data:{newemail:newemail},
                  cache:false,
                  beforeSend:function(){
                    // $(".login").removeAttr("hidden");
                    $(".newemail").attr("placeholder","processing...");
                    $(".newemail").attr("placeholder","processing...");
                  },
                  success:function(e){
                    console.log(e);
                    console.log(e.length);
                    if(e.length>2){
                      // $(".login").removeAttr("hidden");
                      
                      $(".newemail").attr("placeholder",e);
                    }
                    else{
                      // $(".login").removeAttr("hidden");
                      $(".newemail").attr("placeholder","successful");
                      $(".newemail").attr("placeholder","successful");
                    }
                  }
                });
            }
          });
          $(".updatephone").click(function(){
            const newnum=$(".newnum").val();
            if(newnum==""){
              $(".newnum").attr("placeholder","Input Empty!!")
            }
            else{
              $(".newnum").val("");
              const url="upload.php";
              $.ajax({
                url:url,
                type:"POST",
                data:{newnum:newnum},
                cache:false,
                beforeSend:function(){
                  // $(".login").removeAttr("hidden");
                  $(".newnum").attr("placeholder","processing...");
                },
                success:function(e){
                  console.log(e);
                  console.log(e.length);
                  if(e.length>2){
                    // $(".login").removeAttr("hidden");
                    
                    $(".newnum").html(" "+e);
                  }
                  else{
                    // $(".login").removeAttr("hidden");
                    $(".newnum").attr("placeholder",newnum);
                  }
                }
              });
            }
          });
          $(document).on('change','#profilePost',function(){
            $(".errorDisplayerProfile").removeAttr("hidden");
            $(".errorDisplayerProfile").html("<small><img style='width:3%;' src='../../img/loader.gif'> <span style='color:green;'>Analysing File Data...</span></small>");
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
                url:"upload.php",
                type:"POST",
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                  $(".errorDisplayerProfile").removeAttr("hidden");
                  $(".errorDisplayerProfile").html("<img style='width:3%;' src='../../img/loader.gif'><h5 style='color:#fff;'>UPLOADING..</h5>");
                },
                success:function(e){
                  
                  if(e.length>2){
                    $(".errorDisplayerProfile").removeAttr("hidden");
                    $(".errorDisplayerProfile").attr("style","color:red;border:3px solid red;bored-radius:10px;");
                    $(".errorDisplayerProfile").html(e);
                  }
                  else{
                    $(".errorDisplayerProfile").removeAttr("hidden");
                    $(".errorDisplayerProfile").html("<small style='color:green;border:3px solid green;bored-radius:10px;'> Profile updated successfuly</small>");
                    $("#profilePost").val("");
                    
                                
                  }
                }
              });
            }
          });
          $(".btn-conform").click(function(){
            const email=$(".email").val();
            const password=$(".password").val();
            const name=$(".name").val();
            const surname=$(".surname").val();
            const phone=$(".phone").val();
            const adminType=$(".adminType").val();
            $(".email").attr("style","border:none;color:white;");
            $(".password").attr("style","border:none;color:white;");
            $(".name").attr("style","border:none;color:white;");
            $(".surname").attr("style","border:none;color:white;");
            $(".phone").attr("style","border:none;color:white;");

            if(email==""){
              $(".email").attr("placeholder","Input Empty!!");
              $(".email").attr("style","border:1px solid red;color:red;");
            }
            else if(password==""){
              $(".password").attr("placeholder","Input Empty!!");
              $(".password").attr("style","border:1px solid red;color:red;");
            }
            else if(name==""){
              $(".name").attr("style","border:1px solid red;color:red;");
              $(".name").attr("placeholder","Input Empty!!");
            }
            else if(surname==""){
              $(".surname").attr("style","border:1px solid red;color:red;");
              $(".surname").attr("placeholder","Input Empty!!");
            }
            else if(phone==""){
              $(".phone").attr("style","border:1px solid red;color:red;");
              $(".phone").attr("placeholder","Input Empty!!");
            }
            else if(adminType==""){
              $(".adminType").attr("style","border:1px solid red;color:red;");
              $(".adminType").attr("placeholder","Input Empty!!");
            }
            else{
                const url="upload.php";
                $.ajax({
                  url:url,
                  type:"POST",
                  data:{email:email,password:password,name:name,surname:surname,phone:phone,adminType:adminType},
                  cache:false,
                  beforeSend:function(){
                    // $(".login").removeAttr("hidden");
                    $(".btn-conform").html("<img src='../../img/loader.gif' style='width:3%;'> Lodding....");
                  },
                  success:function(e){
                    console.log(e);
                    console.log(e.length);
                    if(e.length>2){
                      // $(".login").removeAttr("hidden");
                      
                      $(".btn-conform").attr("style","border:3px solid red;background:#212121;color:red;");
                      $(".btn-conform").html(e);
                    }
                    else{
                      // $(".login").removeAttr("hidden");
                      $(".btn-conform").attr("style","border:3px solid green;background:#212121;color:green;");
                      $(".btn-conform").html("Admin Added successfuly!, Add another..");
                      $(".email").val("");
                      $(".password").val("");
                      $(".name").val("");
                      $(".surname").val("");
                      $(".phone").val("");
                      $(".adminType").val("");
                    }
                  }
                });
            }
          });


          $(".addPortfolio").click(function(){
            const portfolio=$(".portfolio").val();
            if(portfolio==""){
              $(".portfolio").attr("placeholder","Input Empty!!");
              $(".portfolio").attr("style","border:1px solid red;color:red;");
              
            }
            else{
                const url="upload.php";
                $.ajax({
                  url:url,
                  type:"POST",
                  data:{portfolio:portfolio},
                  cache:false,
                  beforeSend:function(){
                    // $(".login").removeAttr("hidden");
                    $(".addPortfolio").html("<img src='../../img/loader.gif' style='width:3%;'> Processing...");
                  },
                  success:function(e){
                    console.log(e);
                    console.log(e.length);
                    if(e.length>2){
                      // $(".login").removeAttr("hidden");
                      $(".addPortfolio").attr("style","border:3px solid red;color:red;");
                      $(".addPortfolio").html(e);
                    }
                    else{
                      // $(".login").removeAttr("hidden");
                      $(".addPortfolio").attr("style","border:3px solid green;color:green;");
                      $(".addPortfolio").html("Portfolio Created successful");
                      $(".portfolio").val("");
                    }
                  }
                });
            }
          });

        });
        function addItem(PortfolioId){
            const item=$(".item"+PortfolioId).val();
            const ItemDescription=$(".ItemDescription"+PortfolioId).val();
            const id_of_portfolio=$(".id_of_portfolio"+PortfolioId).val();
            const price=$(".price"+PortfolioId).val();
            const fileItem=$("#fileItem"+PortfolioId).val();
            // console.log(item+" "+ItemDescription+" "+id_of_portfolio+" "+fileItem);
            if(item==""){
              $(".item"+PortfolioId).attr("placeholder","Input Empty!!");
              $(".item"+PortfolioId).attr("style","border:1px solid red;color:red;");
              
            }
            else if(ItemDescription==""){
              $(".ItemDescription"+PortfolioId).attr("placeholder","Input Empty!!");
              $(".ItemDescription"+PortfolioId).attr("style","border:1px solid red;color:red;");
              
            }
            else if(price==""){
              $(".price"+PortfolioId).attr("placeholder","Input Empty!!");
              $(".price"+PortfolioId).attr("style","border:1px solid red;color:red;");
              
            }
            else if(fileItem==""){
              $("#fileItem"+PortfolioId).attr("placeholder","Input Empty!!");
              $("#fileItem"+PortfolioId).attr("style","border:1px solid red;color:red;");
              
            }
            else{
              var form_data=new FormData();
              var fileCol="";
              if(fileItem!=""){
                fileCol=document.getElementById("fileItem"+PortfolioId).files[0].name;
              }
              var ext=fileCol.split('.').pop().toLowerCase();
              const array=["jpg","png","jpeg","jpeng","heic","JPG","PNG","JPEG","JPENG","HEIC","GIF","gif"];
              if(jQuery.inArray(ext,array)==-1 && fileCol!=""){
                // $(".errorDisplayerProfile").removeAttr("hidden");
                $(".addProduct"+PortfolioId).html("<small style='color:red;'>"+ext+" Not Supported. Only Support {jpg,png,jpeng,gif,heic} Format </small>");

              }
              else{
                if(fileCol!=""){
                  form_data.append("fileCol",document.getElementById("fileItem"+PortfolioId).files[0]);
                }
                else{
                  form_data.append("fileCol",fileCol);
                }
                form_data.append('price',price);
                form_data.append('item',item);
                form_data.append('ItemDescription',ItemDescription);
                form_data.append('id_of_portfolio',id_of_portfolio);
                // console.log(form_data);
                $.ajax({
                  url:"upload.php?_still_",
                  type:"POST",
                  data:form_data,
                  contentType:false,
                  cache:false,
                  processData:false,
                  beforeSend:function(){
                    // $(".addProduct").removeAttr("hidden");
                    $(".addProduct"+PortfolioId).html("<img style='width:5%;' src='../../img/loader.gif'><h5 style='color:#fff;'>UPLOADING..</h5>");
                  },
                  success:function(e){
                    console.log(e);
                    console.log(e.length);
                    if(e.length>2){
                      // $(".addProduct").removeAttr("hidden");
                      $(".addProduct"+PortfolioId).attr("style","color:red;border:3px solid red;bored-radius:10px;");
                      $(".addProduct"+PortfolioId).html(e);
                    }
                    else{
                      // $(".addProduct").removeAttr("hidden");
                      $(".addProduct"+PortfolioId).html("<small style='color:green;border:3px solid green;bored-radius:10px;'> Item Added successfuly!! </small>");
                      $(".item"+PortfolioId).val("");
                      $(".ItemDescription"+PortfolioId).val("");
                      $(".id_of_portfolio"+PortfolioId).val("");
                      $("#fileItem"+PortfolioId).val("");           
                    }
                  }
                });
              }
            }
        }
        function deleteF(id){
          const url="upload.php";
          const cdcDeletePortfolio="1";
          $.ajax({
            url:url,
            type:"POST",
            data:{id:id,cdcDeletePortfolio:cdcDeletePortfolio},
            cache:false,
            beforeSend:function(){
              // $(".login").removeAttr("hidden");
              $(".deleteFunctionPortfolio_"+id).html("<img src='../../img/loader.gif' style='width:4%;'>");
            },
            success:function(e){
              console.log(e);
              console.log(e.length);
              if(e.length>2){
                // $(".login").removeAttr("hidden");
                $(".deleteFunctionPortfolio_"+id).attr("style","border:3px solid red;color:red;");
                $(".deleteFunctionPortfolio_"+id).html(e);
              }
              else{
                // $(".login").removeAttr("hidden");
                $(".deleteFunctionPortfolio_"+id).attr("style","border:3px solid green;color:green;");
                $(".deleteFunctionPortfolio_"+id).html("Removed successfuly!!..");
                
              }
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
	header("Location:../");exit();
}
?>