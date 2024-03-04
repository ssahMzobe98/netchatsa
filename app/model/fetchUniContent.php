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
		if(isset($_POST["limit"], $_POST["start"],$_POST['chapter'])){
	        $chapter=$pdo->OMO($_POST['chapter']);
	        $limit=$pdo->OMO($_POST['limit']);
	        $start=$pdo->OMO($_POST['start']);
	        $response=$pdo->getSgelavarsychapters(intval($chapter),intval($limit),intval($start));
	        // $_=$conn->query("select*from sgelavarsychapters where chapter='$chapter' limit ".$_POST["start"].",".$_POST["limit"]);
	        if(count($response)==0 || $start<0){
	            ?>
	            <h5 style="color:red;">No content added yet</h5>
	            <?php
	        }
	        else{
	            foreach($response as $row){
			        $module_info=$pdo->getModuleInfo($row['module']);
			        $chapter_info=$pdo->getModuleChapterInfo($row['chapter']);
			      //  $dir="../controller/functions/netchatsaSchoolLogo/a.jpg";
			        ?>
			        <div class="bodyCamp" >
			            <div class="radeMos">
	                          <iframe style="width:100%;" src="<?php echo $row['content_url'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	                          
	                          <h4><?php echo $row['content_title'];?></h4>
	                          <small>disclaimer:this content does not belong to netchatsa, it is owned by <?php echo $row['content_name'];?>, reference: youtube.</small>
			            </div>
	        		        
	    		    </div>
	                <?php
	            }
	        }
	    }
	    
	    else{
	        echo"You trying to bridge the system. You have been warned!!";
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