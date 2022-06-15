<?php

$e;
require_once("pdo.php");
$imfene=new _imfene_();
$pdo=new _pdo_();
if(isset($_POST['email'])&&isset($_POST['pass'])&&isset($_POST['admin_type'])){

	$adminId=mysqli_escape_string($conn,$_POST['email']);
	$pass=$imfene->ibhubesiLesilisa(md5($imfene->ibhubesiLesilisa(mysqli_escape_string($conn,$_POST['pass']))));
	$_="select adminid and password from aminuser where adminid=? and password=? LIMIT 1";
	$stmt = $conn->prepare($_);
	$stmt->bind_param("ss", $adminId,$pass);
	$stmt->execute();
	$stmt->bind_result($adminId);
	$stmt->store_result();
	$rnum = $stmt->num_rows;
	if($rnum==1){
		if($pdo->isAdminType($adminId,$_POST['admin_type'])){
			session_start();
			$_SESSION['adminSession']=$adminId;
			$e=1;
		}
		else{
			$e="Error A032: Admin Does not match admin_type!!";
		}
		
	}
	else{
		$e="Incorrect Admin Email or password";
	}
	return $e;
}
elseif(isset($_POST['CustomerEmail'])&&isset($_POST['CustomerPassword'])){
	$customerId=mysqli_escape_string($conn,$_POST['CustomerEmail']);
	$pass=$imfene->ibhubesiLesilisa(md5($imfene->ibhubesiLesilisa(mysqli_escape_string($conn,$_POST['CustomerPassword']))));
	$_="select customerid and password from customer where customerid=? and password=? LIMIT 1";
	$stmt = $conn->prepare($_);
	$stmt->bind_param("ss", $customerid,$pass);
	$stmt->execute();
	$stmt->bind_result($customerid);
	$stmt->store_result();
	$rnum = $stmt->num_rows;
	if($rnum==0){
		session_start();
		$_SESSION['adminSession']=$customerid;
		$e=1;
	}
	else{
		$e="incorrect customer email or password";
	}
	return $e;
}
else{
	?>
		<script >window.location=("../");</script>
	<?php
}
echo json_encode($e);
$conn->close();


?>