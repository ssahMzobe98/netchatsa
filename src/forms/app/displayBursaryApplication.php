<?php
include_once("../../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use Src\Classes\Pdo\TimePdo;
// use Src\Classes\CleanData;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['usermail'])){
    $userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
    //$this->TertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$this->connect]);
    $tertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$userPdo->connect]);
    $cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
    $getBursaryApplications = $tertiaryApplications->getBursaryApplications($cur_user_row['my_id']);
    if(empty($getBursaryApplications)){
        echo"<h4 style='text-align:center;'>No Bursary Applications Available yet</h4>";
    }
    else{
        ?>
        <table >
            <tr>
            <td>Bursary</td>
            <td>Funded Applied Causes</td>
            <td>Application Status</td>
           </tr>
        <?php
        foreach ($getBursaryApplications as $value) {
            ?>
               <tr>
                <td><?php echo $value['bursary_institution'];?></td>
                <td>
                    <select disabled>
                    <?php 
                        foreach($value['courses_funded'] as $data){
                            ?>
                                <option><?php echo $data['course_name'];?></option>
                            <?php
                        }
                    ?>
                    </select></td>
                <td><?php echo $value['application_status'];?></td>
               </tr> 
            <?php
        }
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