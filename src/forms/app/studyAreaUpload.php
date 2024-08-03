<?php
include_once("../../../vendor/autoload.php");

use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags; // Added this line to import the Flags class
use Src\Classes\Pdo\TimePdo;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

if(isset($_SESSION['usermail'])){
    $userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
    $studyArea = PDOServiceFactory::make(ServiceConstants::STUDY_AREA_PDO,[$userPdo->connect]);
    $cur_user_row =$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
    
    if(isset($_POST['request'])){
        switch ($_POST['request']){
            case Flags::CODING_DOME_POPUP:
                pCODING_DOME_POPUP();
                break;
            case Flags::UPLOAD_DOME_POPUP:
                pUPLOAD_DOME_POPUP();
                break;
            case Flags::UPDATE_TEXT_FILED:
            	pUPDATE_TEXT_FILED();
                break;
            case Flags::UPDATE_PROFILE_PICTURES:
            	pUPDATEPROFILEPICTURES();
            	break;
            default:
                pERROR_HANDLER();
                break;
        }
    }
    else{
        echo"<h3 style='text-align:center;color:red;'>UNKNOWN REQUEST!!..</h3>";
    }
}
else{
    session_destroy();
?>
    <script>
        window.location=("../../../");
    </script>
<?php
}
function pUPDATEPROFILEPICTURES(){
	?>
	<div class="modal-header">
      <h4 style="color:#45f3ff;" class="modal-title">Update Profile </h4>
    </div>
    <div class="modal-body">
    	<style>
    		.img_selector,.text_editor{
                width: 100%;

            }
            .img_selector input,.text_editor input{
                width: 100%;
                color: #45f3ff;
                background-color:#212121;
                border: none;
                border-bottom: 2px solid #45f3ff;
            }
            .img_selector select,.text_editor select{
                width: 100%;
                color: #45f3ff;
                background-color:#212121;
                border: none;
                border-bottom: 2px solid #45f3ff;
            }

    	</style>
      <div class="img_selector">
      	<input type="file" name="file" id="profilePost" accept="image/*">
      </div>
      <div class="errorDisplayerProfile" hidden></div>
    </div>		

	<?php
}
function pUPDATE_TEXT_FILED(){
	?>
		<div class="modal-header">
          <h4 class="modal-title">Update Story Point</h4>
        </div>
        <div class="modal-body">
			<div class="inputBox">
				<textarea class="writeStoryPoint" id="writeStoryPoint" placeholder="Type your story.."></textarea>
			</div>
          	<div class="sendBtn">
          		<button type="button" class="btn btn-default" onclick="saveWriteStoryPoint()">Save</button>
          	</div>
          	<div class="errorRegistrationModeaHidden" hidden></div>
        </div>
    
<?php
}
function pUPLOAD_DOME_POPUP(){
?>
		<div class="modal-header">
          <h4 class="modal-title">Upload My Question/Problem</h4>
        </div>
        <div class="modal-body">
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
		            max-height: 50vh;
		            border:none;
		            border-left:2px solid #45f3ff;
		            padding: 10px 10px;
		            background: #212121;
		            color: #45f3ff;
		        }
		    </style>
		    <div class="img_selector">
		        <input type="text"  id="studyAreaMathTitle" placeholder="Enter Your Title Here..">
		    </div>
		    <div class="img_selector">
		        <input type="file" name="file" id="studyAreaMathInput" >
		    </div>
		    <br>
		    <div class="text_editor">
		        <textarea id="studyAreaMathText" placeholder="Upload Problem/Question..."></textarea>
		    </div>
		    <div class="buttn">
		        <button type="button" class="btn" id="studyAreaMath" onclick="uploadMathQuestion()">Ask</button>
		    </div>
		    <div class="errorDisplayermessageStudyArea" hidden></div>
        </div>
    
<?php
}

function pCODING_DOME_POPUP(){
?>
        <div class="modal-header">
          <h4 class="modal-title">Write My Code</h4>
        </div>
        <div class="modal-body">
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
        	<div class="img_selector">
          	<input type="text"  id="studyAreaMathTitleCode" placeholder="Enter Your Title Here..">
          </div>
          <div class="text_editor">
          	<textarea type="code" id="studyAreaMathCode" placeholder="String variable='Add my Problem/Solution Code Here';//JAVA,PHP,..."></textarea>
          </div>
          <div class="buttn">
          	<button type="button" class="btn" id="studyAreaMathCodeSubmit" onclick="UploadCodeQuestion()">Ask</button>
          </div>
          <div class="errorDisplayermessageStudyAreaCode" hidden></div>
        </div>
        
<?php
}

function pERROR_HANDLER(){
    echo"<h3 style='text-align:center;color:red;'>UNKNOWN REQUEST!!..</h3>";
}
?>
