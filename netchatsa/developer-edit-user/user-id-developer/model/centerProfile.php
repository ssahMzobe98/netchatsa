<?php
function reduce($var,$size){
  if(strlen($var)>$size){
      $count=0;
      foreach (str_split($var) as $char){
          echo"$char";
          $count++;
          if($count==$size){
              echo"...";
              break;
          }
      }
  }
  else{
      echo $var;
  }
}

?>
<style>
    .center-body{
        width:100%;
        height:100%;
    }
    .center-body .pesh{
        width:93%;
        height:270px;
    }
    .center-body .pesh .img{
        width:100%;
        box-shadow:0px 0px 6px -1px #000;
        height:98%;
        border-radius:100%;
        cursor:pointer;
    }
    .center-body .pesh .img img{
        width:100%;
        border-radius:100%;
        height:100%;
    }
    .center-body .med{
        width:100%;
        box-shadow:0px 0px 6px -1px #000;
        font-size:12px;
        border-radius:8px;
        height:51%;
    }
</style>
<div class="center-body">
    <div class="pesh">
        <div class="img" data-toggle="modal" data-target="#img_gost0" >
            <?php if($cur_user_row['profile_image']=="empty"){
                ?>
                <img src="../view/img/images/d/userq58.jpg" title="click to update profile image">
                <?php
            }else{
                ?>
                <img src="<?php echo "../view/img/userProfileImages/".$id."/".$cur_user_row['profile_image'];?>" title="click to update profile image">
                <?php
            }?>
            
        </div>
    </div>
    
        <div class="med">
            <center><h2 style='font-size:13px;'> My Profile</h2></center>
 		 	<h4 style='font-size:19px;' id='raw'>
 		 	<p><div style='font-size:19px;'><?php reduce($cur_user_row['name']." ".$cur_user_row['surname'],25);?></div></p>
 		 	<p><div style='font-size:13px;'> gender : <?php echo $cur_user_row['gender'].", Joined: ".$cur_user_row['date_of_birth'];?></div></p>
 		 	<p><div style='font-size:13px;'> province : <?php echo $cur_user_row['province'].", ".$cur_user_row['city'];?></<div></p>
 		 	<div style="border:1px solid #bbb;"></div>
 		 	 <p><div style='font-size:13px;'><center><h5>About Me <span style="font-size:10px;color:red;">(click text to edit)</span></h5></center></<div></p>
 		 	 <p><div > <h6 style='font-size:12.5px;cursor:pointer;' title="click me to edit ABOUT ME" class="about" data-toggle="modal" data-target="#editText">
 		 	   <?php
 		 	   if(empty($cur_user_row['about'])){
 		 	       $ra="Use it to describe your credentials, expertise ygyugyugu yuguygugygu, and goals. What’s the best way to start? The following exercises can be helpful in figuring all of that out, and will help you determine what to one for gdastgbj jbjhb and will help you determine what to one for gdastgbj jbjhb and will help you determine what to one for gdastgbj jbjhb ugigiug giugiui ihiuhiiu iuhiu";
 		 	   }
 		 	   else{
 		 	       $ra=$cur_user_row['about'];
 		 	   }
 		 	   reduce($ra,250);
 		 	   ?>  
 		 	   </h6></<div></p>
 		 	    
 		 	</h4>
    </div>
</div>
<script>
    function editAboutMe(id){
        const about=$("#about").val();
        // const errorAbout=$(".errorAbout");
        if(about==""){
            $(".errorAbout").removeAttr("hidden");
            $(".errorAbout").attr("style","background-color:#000;color:red;width:100%;padding:10px;");
            $(".errorAbout").html("** Cannot Process Empty Data**");
            
        }
        else{
            $(".errorAbout").removeAttr("hidden");
			$(".errorAbout").attr("style","background-color:#000;color:green;padding:5px;opacity:.8;");
			$(".errorAbout").html("Processing...");
			$.ajax({
				url:"../controller/functions/upload.php?updateAbout",
				type:"POST",
				data:{id:id,about:about},
				cache:false,
				beforeSend:function(){
					$(".errorAbout").removeAttr("hidden");
					$(".errorAbout").html("<img style='width:10%;' src='img/loader.gif'><h5 style='color:green;'>UPLOADING..</h5>");
				},
				success:function(e){
					console.log(e.length);
					if(e.length>2){
						$(".errorAbout").removeAttr("hidden");
						$(".errorAbout").attr("style","background-color:#000;color:red;padding:5px;opacity:.8;");
						$(".errorAbout").html("Suspense 320 : "+e);
						
						$(".about").html(about);
					}
					else{
						$(".errorAbout").removeAttr("hidden");
						$(".errorAbout").html("<small style='color:green;'>Chapter Added Successfuly..</small>");
						$("#about").val("");
					}
				}
			});
        }
    }
</script>