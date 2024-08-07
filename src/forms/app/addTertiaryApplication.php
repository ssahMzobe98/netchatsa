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
        if(isset($_POST['request'])&&$_POST['request']=='addTertiaryApplicationModal'){
            ?>
            <style>
                .img_selector,.text_editor{
                    width: 100%;
                }
                .img_selector input,.text_editor textarea{
                    width: 100%;
                }
                .text_editor textarea{
                    max-width: 100%;
                    min-width: 100%;
                    min-height: 50vh;
                    max-height: 90vh;
                    border:none;
                    border-left:2px solid #45f3ff;
                    padding: 10px 10px;
                    background: #212121;
                    color: #45f3ff;
                }
            </style>
            <select class="uni-row" name="uni" >
                  <option value="">-- Select University --</option>
                  <?php
                  // echo"kldnflkdnslk";
                  $response=$tertiaryApplications->getUniversities();                       
                  foreach($response as $row){
                      ?>
                      <option value="<?php echo $row['id'];?>" ><?php echo $row['uni_name'];?></option>
                      <?php
                  }
                  ?>
            </select> 
            <br><br>
            <button class="btn " style="border:1px solid #45f3ff;color:#45f3ff;" onclick="selectTertiary()" data-dismiss="modal">Select Tertiary</button>
            <?php
        }
        else{
            echo"BAD REQUEST!!..";
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