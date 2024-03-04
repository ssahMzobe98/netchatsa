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
    	if(isset($_POST['displayModeAnswers'])){
    		$displayModeAnswers=$pdo->OMO($_POST['displayModeAnswers']);
    		$row=$pdo->getdisplayModeAnswers(intval($displayModeAnswers));
    		$chapter_id=$row['chapter'];
            $subject=$row['subject'];
            $question="../../highschool/".$subject."/".$chapter_id."/practice/".$row['question'];
            $answer="../../highschool/".$subject."/".$chapter_id."/practice/";
            $solution_array=array();
            if(!empty($row['a']) && $row['a']!="empty"){
                array_push($solution_array,$row['a']);
            }
            if(!empty($row['b']) && $row['b']!="empty"){
                array_push($solution_array,$row['b']);
            }
            if(!empty($row['c']) && $row['c']!="empty"){
                array_push($solution_array,$row['c']);
            }
            if(!empty($row['d']) && $row['d']!="empty"){
                array_push($solution_array,$row['d']);
            }
            if(!empty($row['e']) && $row['e']!="empty"){
                array_push($solution_array,$row['e']);
            }
            if(!empty($row['f']) && $row['f']!="empty"){
                array_push($solution_array,$row['f']);
            }
            ?>
            <img src="<?php echo $answer.$row['answer'];?>" style="width:100%;">
                                  
          <?php
            foreach($solution_array as $img){
                ?>
                <img src="<?php echo $answer.$img;?>" style="width:100%;">
                <?php
            }

    	}
    	else{
    		echo"Cannot process undefined request";
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