<?php
session_start();
if(isset($_SESSION['usermail'])){
	include_once("pdo.php");
	$a=$_SESSION['usermail'];
    $cur_user_row=mysqli_fetch_array($conn->query("select*from create_runaccount where usermail='$a'"));
    $id=$cur_user_row['my_id'];
	$pdo=new _pdo_();
	$pdo->displayMessages($cur_user_row);
}
else{
	session_destroy();exit();
	$e="Session undefined";
}

?>