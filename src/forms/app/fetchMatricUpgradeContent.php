<?php
include_once("../../../vendor/autoload.php");
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
    $sgelaUniversity = PDOServiceFactory::make(ServiceConstants::SGELA_UNI_PDO,[$userPdo->connect]);
    $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);

    if(isset($_POST["limit"], $_POST["start"],$_POST['chapter'],$_POST['term'],$_POST['subj'])){
        $chapter=$_POST['chapter'];
        $term=$_POST['term'];
        $subj=$_POST['subj'];
        $response=$sgelaUniversity->fetchMatricUpgradeContent($subj,$chapter,$term,$_POST["start"],$_POST["limit"]);
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
        echo"You not Permitted to view this page!!";
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