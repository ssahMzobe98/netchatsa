<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['usermail'])){
    // require_once("../controller/pdo.php");
    $userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
    $tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);   
    $matricUpgrade = PDOServiceFactory::make(ServiceConstants::MATRIC_UPGRADE_PDO,[$userPdo->connect]); 
    $netchatSa = PDOServiceFactory::make(ServiceConstants::NETCHATSA_SUBJECT_PDO,[$userPdo->connect]);
    $sgelaUniPdo = PDOServiceFactory::make(ServiceConstants::SGELA_UNI_PDO,[$userPdo->connect]);  
    $cleanData =   PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
    	if(isset($_POST['displayModeAnswers'])){
    		$displayModeAnswers=$cleanData->OMO($_POST['displayModeAnswers']);
    		$row=$sgelaUniPdo->getdisplayModeAnswers(intval($displayModeAnswers));
    		$chapter_id=$row['chapter'];
            $subject=$row['subject'];
            $question="../highschool/".$subject."/".$chapter_id."/practice/".$row['question'];
            $answer="../highschool/".$subject."/".$chapter_id."/practice/";
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
		window.location=("../../");
	</script>

	<?php
}
?>