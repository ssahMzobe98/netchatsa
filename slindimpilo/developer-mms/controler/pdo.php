<?php
$user="root";
$pass="";
$dbnam="slindimpilo";
$conn=mysqli_connect("localhost",$user,$pass,$dbnam)or die("Connection was not established!!");
include_once("iMfene.php");
class _pdo_{
	function isAdminType($email,$admin_type){
		global  $conn;
		return (mysqli_fetch_array($conn->query("select admintype from aminuser where adminid='$email'"))['admintype']==$admin_type);
	}
}
?>