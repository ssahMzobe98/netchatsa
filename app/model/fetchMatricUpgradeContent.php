<?php
session_start();
if(isset($_SESSION['usermail'])){
	require_once("../controller/pdo.php");
	$pdo=new _pdo_();
	$cur_user_row =$pdo->userInfo($_SESSION['usermail']);
	$userDirect=$cur_user_row['directory_index'];
	$url = explode("/",$_SERVER['REQUEST_URI']);
	$url=str_replace("%20", " ",$url[2]);
	if($url==$userDirect){
    
        if(isset($_POST["limit"], $_POST["start"],$_POST['chapter'],$_POST['term'],$_POST['subj'])){
            $chapter=$_POST['chapter'];
            $term=$_POST['term'];
            $subj=$_POST['subj'];
            $response=$pdo->fetchMatricUpgradeContent($subj,$chapter,$term,$_POST["start"],$_POST["limit"]);
           foreach($response as $row){
		        ?>
		        <div class="bodyCamp" >
		            <div class="radeMos">
                        <iframe style="width:100%;" src="<?php echo $row['content'];?>" 
                          title="YouTube video player" frameborder="0" 
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                          allowfullscreen></iframe>
                          
                          <h4><?php echo $row['title'];?></h4>
                          <small>disclaimer:this content does not belong to netchatsa, it is owned by <?php echo $row['source'];?>.</small>
		            </div>
        		        
    		    </div>
                <?php
            }
            
        }
        else{
            echo"YOu not Permitted to view this page!!";
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