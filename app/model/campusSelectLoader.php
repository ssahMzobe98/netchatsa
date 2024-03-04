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
		if(isset($_GET['q'])){
			if(!empty($_GET['q'])){
				$uni=$_GET['q'];
				$getFaculties=$pdo->getFacultiesOfUni($_GET['q']);
				if(count($getFaculties)==0){
					echo"No Faculties Found";
				}
				else{
					?>
					<select class="selection">
						<?php
						foreach ($getFaculties as $row) {
							?>
							<option value="<?php echo $row['faculty_id'];?>"> <?php echo $row['faculty_name'];?></option>
							<?php
						}
						?>
					</select>
					<br>
					<div class="saleInput" style="width:100%;padding: 10px 10px;"></div>
					<script>
						$(document).ready(function(){
							$(".selection").on("change",function(){
								const select=$(".selection").val();
								if(select==""){
									$(".saleInput").html("No data Selected");
								}
								else{
									const uni="<?php echo $uni;?>";
									$(".saleInput").html("waiting for response...").load("./model/CourseSelectLoader.php?unisaleInpu="+uni+"&faculty_id="+select);

								}
							});
						});
					</script>
					<?php
				}
			}
			else{
				echo"Yewna Yey!!, Musa ukusijwayela kabi!!...";
			}
		}	
		else{
			echo"Engathi Suyaphaphjake manje, Whoever you are stop it!!...";
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