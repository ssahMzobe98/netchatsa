<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$studyArea = PDOServiceFactory::make(ServiceConstants::STUDY_AREA_PDO,[$userPdo->connect]);
	$cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
	?>
<style>
	.headerSearchBar{
		width: 100%;
		padding: 10px;
		background-color: none;
		border-bottom:1px solid #45f3ff;
	}
	.headerSearchBar .model{
		width: 90%;
		
	}
	.headerSearchBar .model form{
		width: 100%;
		display: flex;
		
	}
	.headerSearchBar .model form .seachInput{
		width: 100%;
		
	}
	.headerSearchBar .model form .seachInput input{
		width: 100%;
		border: none;
		border-bottom: 1px solid #45f3ff;
		color: #45f3ff;
		background-color: transparent;
		padding: 10px 10px;
	}
	.headerSearchBar .model form .seachSubmit{
		width: 10%;
	}
	.headerSearchBar .model form .seachSubmit .btn{
		width: 100%;
	}
	.bodyStudyArea{
		width: 100%;
	}
	.bodyStudyArea .package{
		width: 100%;
		box-shadow: -3px 4px 6px 6px black;
		background-color: #212121;
	}
	.bodyStudyArea .package .headerDisplayMach{
		width: 100%;
		padding-top: 5px 5px;
		display: flex;
	}
	
	.bodyStudyArea .package .headerDisplayMach .userName{
		padding: 10px 10px;
		font-size: 8px;
	}
	.bodyStudyArea .package .headerDisplayMach .userName h5{
		font-size: 15px;
	}
	.bodyStudyArea .package .headerDisplayMach .names{
		padding: 10px 10px;
		font-size: 8px;
	}
	.bodyStudyArea .package .headerDisplayMach .names h5{
		font-size: 15px;
	}
	.bodyStudyArea .package .headerDisplayMach .time{
		padding: 10px 10px;
		font-size: 8px;
	}
	.bodyStudyArea .package .headerDisplayMach .time h5{
		font-size: 15px;
	}
	.bodyStudyArea .package .textDisplay{
		width: 100%;
		padding: 5px 5px;
		
	}
	.bodyStudyArea .package .textDisplay h5{
		font-size: 14px;
	}
	.bodyStudyArea .package .textDisplay a{
		width: 100%;
	}
	.bodyStudyArea .package .textDisplay img{
		width: 100%;
	}
	.bodyStudyArea .package .textDisplay video{
		width: 100%;
	}
	.bodyStudyArea .package .displayEmogies{
		width: 100%;
		padding: 5px 5px;
		text-align: center;
		justify-content: center;
		align-content: center;
		align-items: center;
		align-self: center;

	}
	.bodyStudyArea .package .displayEmogies .like{
		width: 25%;
		
		text-align: center;
	}
	.bodyStudyArea .package .displayEmogies .like i{
		font-size: 15px;
		color: white;
	}
	.package .headerDisplayMach{
		width: 100%;
		padding: 2px 2px;
	}
	.package .headerDisplayMach .profile{
		
		width:40px;
		height:40px;
		border-radius: 100%;
		border: 1px solid #45f3ff;
		padding: 2px 2px;
		
	}
	.package .headerDisplayMach .profile img{
		
		width: 100%;
		height: 100%;
		border-radius: 100%;
		border: 1px solid #45f3ff;
		
	}
</style>

		</style>
			<div class="headerSearchBar flex">
				<div class="model">
					<form method="post">
						<div class="seachInput"><input type="search" oninput="searchFind()" name="search" id="search" placeholder="Find Your Answer/Solution..." required=""></div>
						
					</form>
					<script>
					    function searchFind(){
					        q=$('#search').val();
					        if(q==""){
					            $('#search').removeAttr("placeholder");
					            $('#search').attr("placeholder","Search Study Content Here..");
					        }
					        else{
						    const url="model/searchOnStudyArea.php";
						    $.ajax({
						      url:url,
						      type:"POST",
						      data:{q:q},
						      cache:false,
						      beforeSend:function(data){
						        $(".bodyStudyArea").html("Searching "+q+" ..");
						      },
						      success:function(data){
						        $(".bodyStudyArea").html(data);
						      }
					        });
					      }
					   }
					</script>
				</div>
				<div class="idPos"><button type="button" data-toggle="modal" data-target="#StudyAreaUpload"  class="btn"><i title="Click Upload Problem/Question"  class="fa fa-upload" id="fa" aria-hidden="true"></i></button></div>
				<div class="idPos"><button type="button" data-toggle="modal" data-target="#coding" class="btn"><i title="Click Write n Upload Your Code"  class="fa fa-code" id="fa" aria-hidden="true"></i></button></div>

			</div>
			<br>
			<div class="bodyStudyArea" id="#load_data"></div>
			<!-- <div style="display: flex;"><div class="next"></div><div class="prev"></div></div> -->
			<span id="load_data_respsonse"></span>
			
			<script >
				// loadStudyArea(1,7);
$(document).ready(function(){

 var limit = 7;
 var start = 0;
 var action = 'inactive';
 
// console.log("preparing to load data");
 if(action == 'inactive')
 {
  action = 'active';
  // console.log("loading data now...")
  load_country_data(limit, start);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 1000);
  }
 });
 
});
function load_country_data(limit, start){
  const constant=7;

  $.ajax({
   url:"../src/forms/app/asifundeSonke.php",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
   	// console.log(data+" : Data info ");
    $('.bodyStudyArea').append(data);
    if(data == '')
    {
     $('#load_data_respsonse').html("<button type='button' class='btn btn-dark' style='width:100%;padding:2px 2px;color:#45f3ff;'>No Data Found</button>");
     action = 'active';
    }
    else
    {
     $('#load_data_respsonse').html("<button style='width:100%;padding:2px 2px;color:#45f3ff;' onclick='load_country_data("+(limit+constant)+","+(start+constant)+")' type='button' class='btn btn-dark;'>Load More</button>");
     action = "inactive";
    }
   }
  });
 }
</script>

		<?php
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