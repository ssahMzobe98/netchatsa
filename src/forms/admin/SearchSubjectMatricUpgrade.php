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
		if(isset($_POST['findMe'])){
			$findMe = $pdo->OMO($_POST['findMe']);
			$MatricUpgradeSubjects = $pdo->masomaneGetMatricUpgradeSubjectsSearch($findMe);
			?>
			<style>
				.izikoleZakithi{
					width:100%;
					padding: 10px 10px;
					color:#ddd;
					text-align: left;
					display: flex;
					border-radius: 10px 10px;
					border-right: 2px solid mediumvioletred;
					border-left: 2px solid rebeccapurple;
					cursor: pointer;
				}
				.activeBtn{
					border-bottom: 2px solid mediumvioletred;
					border-top: 2px solid rebeccapurple;
					background: -webkit-linear-gradient(mediumvioletred,purple,rebeccapurple);
				  -webkit-background-clip: text;
				  -webkit-text-fill-color: transparent;
				}
			</style>
			<?php
			if(count($MatricUpgradeSubjects)==0){
				echo"<h3>No Subjects found..</h3>";
			}
			else{
				foreach($MatricUpgradeSubjects as $row){
					$ChapterCounts = $row['ChapterCounts'];
					?>
					<div class="izikoleZakithi box-shadow activate<?php echo $row['id'];?>" id="inactive" >
						<div onclick="loadAfterQuery('.displaySubjectChapters','./model/displayMatricUpgradeSubjectChapters.php?subj=<?php echo $row['id'];?>');activateOnclick(<?php echo $row['id'];?>);" style="width:100%;"><?php echo wordwrap($row['subject_name'],30,"<br>")." ({$ChapterCounts})";?></div>
						<span style="padding:10px 10px;"><i class="fa fa-edit"></i></span>
					</div>
						<br>
					<?php
				}
			}
		}
		else{
			echo"UKNOWN REQUEST!!";
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