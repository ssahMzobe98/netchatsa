<?php
$user="root";
$pass="";
$dbnam="slindimpilo";
$conn=mysqli_connect("localhost",$user,$pass,$dbnam)or die("Connection was not established!!");
include_once("../../controler/iMfene.php");
class _pdo_{//panel admin
	public function currentAdminInfo($adminId){
		global $conn;
		return mysqli_fetch_array($conn->query("select*from aminuser where adminid='$adminId'"));
	}
	public function exit($id){
		unset($id);
		session_destroy();
		?>
		<script>
			window.location=("../../");
		</script>
		<?php
	}
	public function runMageStaff($CurrentUser){
		global $conn;
		?>
		<div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Manage Tech Team
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
                  <th>TM Code</th>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Phone</th>
                  <th>Position</th>
                  <th>Email</th>
                  <th>Analysis</th>
                  <th>Message</th>
                </tr>
              </thead>
              <tbody>
              	<?php 
              	$_=$conn->query("select*from aminuser where adminid!='$CurrentUser'");
              	while ($row=mysqli_fetch_array($_)) {
              		$name=$row['name'];
              		$surname=$row['surname'];
              		$adminid=$row['adminid'];
              		$phone=$row['phone'];
              		$position=$row['position'];
              		$id=$row['id'];
              		?>
              		<tr>
          			<td><?php echo $id;?></td>
	                  <td><?php echo "$name";?></td>
	                  <td><?php echo "$surname";?></td>
	                  <td><?php echo "$adminid";?></td>
	                  <td><?php echo "$phone";?></td>
	                  <td><?php echo "$position";?></td>
	                  <td><span class="badge badge-primary text-white text-center" data-toggle="modal" data-target="#<?php echo $id;?>">Message</span></td>
	                  <td><a href="?analysis=<?php echo $id;?>"><span class="badge badge-danger text-white">-></span></a></td>
	                  
	                </tr>
              		<?php
              	}
              	?>
              </tbody>
              <tfoot class="bg-dark text-white">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Phone</th>
                  <th>Position</th>
                  <th>Email</th>
                  <th>Analysis</th>
                  <th>Message</th>
                </tr>
              </tfoot>
            </table>
  
          </div>
        </div>
		<?php
	}
	public function managePortfolio($CurrentUser){
		global $conn;
		?>
		<div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Manage Portfolio
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
                  <th>Portfolio ID</th>
                  <th>Portfolio Name</th>
                  <th>Portfolio Created By</th>
                  <th>Date Created</th>
                  <th>Num Item</th>
                  <th>Product</th>
                </tr>
              </thead>
              <tbody>
              	<?php 
              	$_=$conn->query("select*from portfolio");
              	while ($row=mysqli_fetch_array($_)) {
              		$portfolio=$row['portfolio'];
              		$addedby=$row['addedby'];
              		$time_added=$row['time_added'];
              		$id=$row['id'];
              		$addedBy=$this->currentAdminInfo($addedby);

              		?>
              		<tr>
          			<td><?php echo $id;?></td>
	                  <td><?php echo $portfolio;?></td>
	                  <td><?php echo $addedBy['name']." ".$addedBy['surname'];?></td>
	                  <td><?php echo $time_added;?></td>
	                  <td>hjjhjk</td>
	                  <td class="deleteFunctionPortfolio_<?php echo $id;?>"><span class="badge badge-primary text-white text-center" title="Click to Add Product" data-toggle="modal" data-target="#addProduct<?php echo $id;?>"><i class="fa fa-upload"></i></span> | <a onclick="deleteF(<?php echo $id; ?>)"><span title="Click to Delete Portfolio" class="badge badge-danger text-white"> <i class="ba bi-trash"></i> </span></a></td>
	                  
	                  
	                </tr>
              		<?php
              	}
              	?>
              </tbody>
              <tfoot class="bg-dark text-white">
                <tr>
                  <th>Portfolio ID</th>
                  <th>Portfolio Name</th>
                  <th>Portfolio Created By</th>
                  <th>Date Created</th>
                  <th>Num Item</th>
                  <th>Product</th>
                  
                </tr>
              </tfoot>
            </table>
  
          </div>
        </div>
		<?php
	}
	public function editTextBeforeSubmitting($mess){
		$mess = str_replace('<', "?", $mess);
		$mess = str_replace('>', "?", $mess);
		$mess = str_replace("\\r\\n", "<br>", $mess);
		$mess = str_replace("\\n\\r", "<br>", $mess);
		$mess = str_replace("\\r", "<br>", $mess);
		$mess = str_replace("\\n", "<br>", $mess);
		$mess = str_replace("\r\n", "<br>", $mess);
		$mess = str_replace("\n\r", "<br>", $mess);
		$mess = str_replace("\r", "<br>", $mess);
		$mess = str_replace("\n", "<br>", $mess);
		$mess = str_replace("\\", " ", $mess);
		$mess = str_replace("'", "`", $mess);
		$mess = str_replace('"', "``", $mess);

		return $mess;
	}
}
?>