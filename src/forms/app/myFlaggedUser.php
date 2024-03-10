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
        $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
        $getUser=$userPdo->getReportedUsersByMe($cur_user_row['my_id']);
        $size=sizeof($getUser);
        if($size<1){
            echo"No Reported user to display";
        }
        foreach($getUser as $row){
            $name=$row['name'];
            $surname=$row['surname'];
            $username=$row['username'];
            ?>
            <style>
                .domdom{
                    width:100%;
                    padding:2px 10px;
                    box-shadow: 0 8px 6px -6px black;
                }
                .domdom .leftTone{
                    width:100%;
                    padding:5px 10px;
                    color:#45f3ff;
                    text-align:center;
                }
                .domdom .rightTone{
                    width:30%;
                    padding:10px 10px;
                    text-align:center;
                   
                }
                .domdom .rightTone .woo{
                    padding:10px 10px;
                }
            </style>
            <div class="domdom ranch<?php echo $row['id'];?> flex">
                <div class="leftTone">
                    <h6><?php echo $name." ".$surname;?></h6>
                    <h6><?php echo $username;?></h6>
                </div>
                <div class="rightTone" onclick="unFlagUser(<?php echo $row['id'];?>,'<?php echo $row['flaggee'];?>')">
                    <span class="woo badge badge-secondary text-white texte-center;">unFlag</span>
                </div>
                
            </div>
            
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