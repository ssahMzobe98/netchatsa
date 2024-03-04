<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['usermail'])){
    require_once("../controller/pdo.php");
    $pdo=new _pdo_();
    $cur_user_row =$pdo->userInfo($_SESSION['usermail']);
    $userDirect=$cur_user_row['directory_index'];
    $url = explode("/",$_SERVER['REQUEST_URI']);
    $url=str_replace("%20", " ",$url[2]);
    if($url==$userDirect){
    	$response=$pdo->getStudentGradeIfExists($cur_user_row['my_id'],"tertiary");
    // 	print_r($response);
    	if(empty($response)){
    		$pdo->registerAsNewCandidate($cur_user_row['my_id'],"tertiary");
    	}
    	else{

    		$responseReturn=$pdo->studentIsPaidThisMonthAndYearTertiary($response['id'],date("Y"),date("m"));
    		if(empty($responseReturn)){
    			$pdo->requestPayment($response);
    		}
    		else{
    			$pdo->autoShowTertiarySelfLearning($response);
    		}
    		
    	}
		
	}
	else{
		session_destroy();
		?>
			<script>
				window.location=("../../?Yazi uyajwayela wena!!, Stop trying to access somebody's account through your own login details.");
			</script>
		<?php
	}
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../");
	</script>

	<?php
}
?>