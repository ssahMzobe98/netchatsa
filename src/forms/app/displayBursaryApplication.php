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

    // echo "<pre>";print_r($getBursaryApplications);echo"</pre>";
    if(empty($getBursaryApplications)){
        echo"<h4 style='text-align:center;'>No Bursary Applications Available yet</h4>";
    }
    else{
        ?>
        <style>
            table{
                width: 100%;
                border:1px solid #ddd;
                border-radius: 10px;
            }
            table tr{
                width: 100%;

            }
            table tr td{
                padding: 2px 2px;
            }
        </style>
        <table >
            <tr>
            <td style="width:30%;">Bursary</td>
            <td style="width:40%;">Funded Applied Causes</td>
            <td style="width:30%;">Application Status</td>
           </tr>
        <?php
        // $getBursaryApplications[]=[
        //     'bursary_institution' => 'dfsdfsdfsd',
        //     'courses_funded' => [
        //         [
        //             'course_name' => 'khjhkhjhkjhj'
        //         ]
        //     ],
        //     'application_status' => 'PENDING'
        // ];
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