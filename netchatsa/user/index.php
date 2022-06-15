<?php
	session_start();
	session_destroy();
	header("Location:../?error=Access Denied!!");exit();
?>