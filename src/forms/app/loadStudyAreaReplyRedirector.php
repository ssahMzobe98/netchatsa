<?php
session_start();
if(isset($_SESSION['usermail'])){
    require_once("../controler/pdo.php");
    $pdo=new _pdo_();
    $id=$_SESSION['usermail'];
    $cur_user_row=$pdo->getThisUserInfo($id);
    if(isset($_GET['p_id'])&&!empty($_GET['p_id'])){
    	$dir =$_GET['p_id'];
    	echo "redirecting...";
		?>
		<script>
			 loadStudyAreaReply(<?php echo $dir;?>);
		</script>
		<?php
    }
    else{
    	echo"You trying to access restricted area";
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