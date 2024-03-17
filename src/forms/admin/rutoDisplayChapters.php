<?php
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['masomane'])){
	require_once("../controller/pdo.php");
	$pdo=new _pdo_();
	$cur_user_row =$pdo->userInfo($_SESSION['masomane']);
	$userDirect=$cur_user_row['user_nav'];
	$url = explode("/",$_SERVER['REQUEST_URI']);
	$url=$url[count($url)-4]."/".str_replace("%20", " ",$url[count($url)-3]);
	if($url==$userDirect){
		if(isset($_GET['subj'])){
			$subj = $pdo->OMO($_GET['subj']);
			?>
			<label>Chapter Name</label>
			<select class="subjectChapter">
				 <option value=""> - - Select Chapter - - </option>
				 <?php
				 $getMatricUpgradeSubjChapters = $getMatricUpgradeSubjChapters = $pdo->masomaneGetMatricUpgradeSubjChapters($subj);
				 foreach($getMatricUpgradeSubjChapters as $row){
				 	 echo"<option value='{$row['id']}'>{$row['chapter']}</option>";
				 }
				 ?>
			</select>
			<?php
		}
		else{
			echo'UKNOWN REQUEST!!..';
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
		window.location=("../../?fghfghfghgfh");
	</script>

	<?php
}
?> 