<?php

if(isset($_SESSION['usermail'])){
	?>
<div class="applications" id="app1">
	<center>
		<?php 
		$pdo=new applications();
		?>
		<div class="applyBtn" >
		<?php
		$pdo->play($id);
		?>
		</div>
		<div class="firstStep" hidden>
		<?php
			$pdo->firstStep($id);
		?>
		</div>
		<div class="DNQ" id="dnq" hidden>
		<?php
			$pdo->doNotQualify($id);
		?>
		</div>
		
	</center>
</div>
<script>
	$(document).ready(function(){
		$("#beginAppProcess").click(function(){
			
		});
		$("#btn").click(function(){
			const grdlevel=$("#grdlevel").val();
			const numOfSubj=$("#numOfSubj").val();
			alert(grdlevel+" "+numOfSubj);

		});
	});
</script>
	<?php
}
else{
	header("Location:../exit");exit();
}
?>