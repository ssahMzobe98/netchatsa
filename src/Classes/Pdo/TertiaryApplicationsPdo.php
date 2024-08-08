<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\Flags;
class TertiaryApplicationsPdo{
	use DBConnectServiceTrait;
	public function isLevelOfApplicaation(string $my_id):array{
		// echo $my_id." => ";
		$sql="SELECT
			s.*
		from testing as t
			LEFT JOIN step1 as s on s.std_id=t.my_id
		where t.my_id=?";
		return $this->connect->getAllDataSafely($sql,"s",[$my_id])[0]??[];
	}
	public function hambisaIsgabaSesibili($gender,$dob,$title,$initials,$lname,$fname,$status,$hlang,$ethnicGroup,$employed,$hear,$bursary,$id_num,$nationality,$app_idStep2,$my_id):Response{
		$params=[$app_idStep2,$nationality,($nationality=="South African")?"":$id_num,($nationality=="South African")?$id_num:"",$gender,$dob,$title,$initials,$lname,$fname,$status,$hlang,$ethnicGroup,$employed,$hear,$bursary];
		$sql="INSERT into step2(applicationid,sa,passport,idnumber,gender,dob,title,initials,lname,fname,status,hlang,ethnicgroup,employed,hear,bursary,date,year,time_submitted)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,date(NOW()),year(NOW()),time(NOW()))";
		$strParams="ssssssssssssssss";
		$response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$response= $this->testingUpdater(2,true,$my_id);
		}
		return $response;
	}
	public function hambisaKwisigabaSesibili($street,$suburb,$town,$province,$postal,$phone,$telephone,$email,$res,$dis,$studedentApplicationId,$my_id):Response{
		$sql="INSERT into step3(applicationid,street,suburb,town,province,postal,phone,telephone,email,res,dis,date,year,time_posted)values(?,?,?,?,?,?,?,?,?,?,?,date(NOW()),year(NOW()),NOW())";
		$params=[$studedentApplicationId,$street,$suburb,$town,$province,$postal,$phone,$telephone,$email,$res,$dis];
		$strParams="sssssssssss";
		$response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$response= $this->testingUpdater(3,true,$my_id);
		}
		return $response;

	}
	public function hambisaIsgabaSesine($fname,$lname,$relationship,$employed,$phone,$alphone,$email,$street,$suburb,$town,$province,$postal,$applicationidStep4,$my_id):Response{
		$params=[$applicationidStep4,$fname,$lname,$relationship,$employed,$alphone,$email,$phone,$street,$suburb,$town,$province,$postal];
		$sql="insert into step4(applicationid,fname,lname,relationship,employed,alphone,email,phone,street,suburb,town,province,postal,date,year,time_submitted)values(?,?,?,?,?,?,?,?,?,?,?,?,?,date(NOW()),year(NOW()),now())";
		$strParams="sssssssssssss";
		$response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$response= $this->testingUpdater(4,true,$my_id);
		}
		return $response;

	}
	public function uploadedUpload(string $column,bool $isLastDoc=false,string $new_name_file="",string $applicationId="",string $my_id=""):Response{
		$params=[$new_name_file,$applicationId];
		$sql="update step5 set {$column}=? where applicationid=?";
		$strParams="ss";
		$response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
			if($isLastDoc){
				$response= $this->testingUpdater(6,true,$my_id);
			}
		}
		return $response;
	}
	public function getFacultyName($faculty_id):array{
		$sql="SELECT faculty_name from faculties where faculty_id=?";
		$params=[$faculty_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function uniName($uni_id):array{
		$sql="SELECT  uni_name from universities where id=?";
		$params=[$uni_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function get_students_applications_login_details($std_id):array{
		$sql="SELECT  * from students_applications_login_details where student_id_ref = ?";
		$params=[$std_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getApplicationId(?string $my_id=null):string{
		global $conn;
		$sql="SELECT applicationid from step1 where std_id=?";
		$response=$this->connect->getAllDataSafely($sql,"s",[$my_id])[0]??[];
		if(empty($response)){
			return "absent";
		}
		else{
			return $response['applicationid'];
		}
	}
	public function hambisaIsgabaSesithupha($uni_id,$uni_name,$faculty_id,$faculty_name,$course_id,$course_name,$mode_of_attendance,$year_of_study,$campus_id,$my_id,bool $skip=false):Response{
		$applicationId=$this->getApplicationId($my_id);
		$sql="insert into finalapplication(applicationid,uni_id,uni_name,faculty_id,faculty_name,course_id,course_name,mode_of_attendance,year_of_study,campus_id,date,year,time_submitted) values(?,?,?,?,?,?,?,?,?,?,date(NOW()),year(NOW()),NOW())";
		$params=[$applicationId,$uni_id,$uni_name,$faculty_id,$faculty_name,$course_id,$course_name,$mode_of_attendance,$year_of_study,$campus_id];
		$strParams="ssssssssss";
		$response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
			if(!$skip){
				$getCount=$this->connect->numRows("SELECT applicationid from finalapplication where applicationid=?","s",[$applicationId])??0;
				if($getCount==3 || $getCount>3){
				    
					$response=$this->testingUpdater(7,true,$my_id);
					if($response->responseStatus===StatusConstants::SUCCESS_STATUS){
					    $response->responseMessage ='NEXT';
					}
				}
			}
		}
		return $response;
	}
	public function applicationidExists($applicationidStep8):array{
	    $sql = "SELECT applicationid from terms_conditions where applicationid=?";
	    $strParams="s";
	    $params = [$applicationidStep8];
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function hambisaIsgabaConditionsAccept($accept,$applicationidStep8,$my_id):Response{
		$params=[$applicationidStep8,$accept];
		if(!empty($this->applicationidExists($applicationidStep8))){
		    $this->Response->responseStatus=StatusConstants::FAILED_STATUS; 
		    $this->Response->responseMessage ="Cannot duplicate records. Aplicant ID Exists";
		    return $this->Response;
		}
		$sql="INSERT into terms_conditions(applicationid,accept,date,year,time_accepted)values(?,?,date(NOW()),year(NOW()),NOW())";
		$strParams="ss";
		$this->Response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($this->Response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$this->Response=$this->testingUpdater(8,true,$my_id);
		}
		return $this->Response;
	}
	public function testingUpdater(int $level=0,bool $isStarted=false, string $my_id=""):Response{
		$sql="";
		$params=[];
		$stringSetter="";
		if(!$isStarted){
			$sql="INSERT into testing(my_id,level,year,time_started,date_started)values(?,?,year(NOW()),time(NOW()),NOW())";

			$params=[$my_id,$level];
			$stringSetter="ss";
		}
		else{
			$sql="UPDATE testing set level=? where my_id=?";
			$params=[$level,$my_id];
			$stringSetter="ss";
		}
		return $this->connect->postDataSafely($sql,$stringSetter,$params);
	}
	public function hambisaIsgabaSesihlanu($applicationidStep5,$my_id,$schoolname,$street,$suburb,$town,$province,$postal,$yearcompleted,$activity,$eduhistory,$uni,$studentnumber,$statuscompletion):Response{
		$params=[$applicationidStep5,$schoolname,$street,$suburb,$town,$province,$postal,$yearcompleted,$activity,$eduhistory,$uni,$studentnumber,$statuscompletion];
		$sql="INSERT into step5(applicationid,schoolname,street,suburb,town,province,postal,yearcompleted,activity,eduhistory,uni,studentnumber,statuscompletion,date,year,time_submitted)values(?,?,?,?,?,?,?,?,?,?,?,?,?,date(NOW()),YEAR(NOW()),NOW())";
		$strParams="sssssssssssss";
		$this->Response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($this->Response->responseStatus===StatusConstants::FAILED_STATUS){
			return $this->Response;
		}
		return $this->testingUpdater(5,true,$my_id);
	}
	public function getCoursesOfThisFaculty(int $uni=0,int $faculty=0):array{
		$sql="SELECT *from courses where faculty_id=? and uni_id=?";
		$params=[$faculty,$uni];
		$strParams="ss";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	// public function getuniversities():array{
	// 	return $this->connect->getAllDataSafely("SELECT * from universities order by uni_name ASC","",[])??[];

	// }
	public function getApplicationsStatments($applicant_id):array{
		$params=[$applicant_id];
		$strParams="s";
		$sql="SELECT * from finalapplication where applicationid=?";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function geCourse($couse_id):string{
	    $sql="SELECT course_name from courses where course_id=?";
	    $response=$this->connect->getAllDataSafely($sql,"s",[$couse_id]);
	       $response=$response[0];
	       return $response['course_name'];
	}
	public function getPaymentStatus($applicationid):string{
		$sql="SELECT applicationid from payment where applicationid=? Limit 1";
		$results = $this->connect->numRows($sql,'s',[$applicationid]);
		if($results===1){
		   $sql="SELECT payment_status from payment where applicationid=?";
		   $response=$this->connect->getAllDataSafely($sql,"s",[$applicationid])[0];
	       return $response['payment_status']??'';
		}
		else{
		    return '';
		}
	}
	public function getAllSchools(){
		$sql="SELECT * from highschools";
		$response=$this->connect->getAllDataSafely($sql,"",[])??[];
		foreach($response as $row){
			?>
			<option value="<?php echo $row['id'];?>"><?php echo $row['school'];?></option>
			<?php
		}
	}
	public function getAllUniversities(){
		$sql="SELECT * from universities";
		$response=$this->connect->getAllDataSafely($sql,"",[]);
		foreach($response as $row){
			?>
			<option value="<?php echo $row['id'];?>"><?php echo $row['uni_name'];?></option>
			<?php
		}
	}
	public function yearCompleted(){
		$sql="SELECT * from yearcompleted";
		$response=$this->connect->getAllDataSafely($sql,"",[]);
		foreach($response as $row){
			?>
			<option value="<?php echo $row['yearc'];?>"><?php echo $row['yearc'];?></option>
			<?php
		}

	}
	public function isUploaded1($array){
		$applicationId=$this->getApplicationId($array['std_id']);
		if($applicationId=="absent"||$applicationId===""){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$response=$this->connect->getAllDataSafely("SELECT idcopy from step5 where applicationid=?","s",[$applicationId])[0];
			if(empty($response['idcopy'])){
				return false;
			}
			else{
				return true;
			}
			

		}
	}
	public function isUploaded2($array){
		$applicationId=$this->getApplicationId($array['std_id']);
		if($applicationId=="absent"||$applicationId===""){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$response=$this->connect->getAllDataSafely("select finalresults from step5 where applicationid=?","s",[$applicationId])[0];
			if(empty($response['finalresults'])){
				return false;
			}
			else{
				return true;
			}
		}
	}
	public function isUploaded3($array){
		$applicationId=$this->getApplicationId($array['std_id']);
		if($applicationId==="absent"||$applicationId===""){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$response=$this->connect->getAllDataSafely("select proofresident from step5 where applicationid=?","s",[$applicationId])[0];
			if(empty($response['proofresident'])){
				return false;
			}
			else{
				return true;
			}
		}
	}
	public function isUploaded4($array){
		$applicationId=$this->getApplicationId($array['std_id']);
		if($applicationId=="absent" || $applicationId===""){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$response=$this->connect->getAllDataSafely("SELECT guardianid from step5 where applicationid=?","s",[$applicationId])[0]??[];
			
			if(empty($response['guardianid'])){
				return false;
			}
			else{
				return true;
			}

		}
	}
	public function studentIsPaidThisMonthAndYear($std_id,$year,$month){
	    $sql="SELECT *from matric_upgrade_payment where std_matric_upgrade=? and month=? and year=?";
	    $strParams="sss";
	    $params=[$std_id,$month,$year];
	    return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function studentIsPaidThisMonthAndYearTertiary(string $std_id="",$year,$month):array{
	   // echo $std_id;
	    $sql="SELECT *from tertiary_upgrade_payment where std_matric_upgrade=? and month=? and year=?";
	    $strParams="sss";
	    $params=[$std_id,$month,$year];
	    return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function isAcceptedTerms($applicationid):bool{
	   $sql="SELECT accept from terms_conditions where applicationid=?";
       $response=$this->connect->getAllDataSafely($sql,"s",[$applicationid])[0]??[];
       return (empty($response['accept']) || $response['accept']=="No")?false:true;
	}
    public function getStep1Info($applicant_id):array{
       $sql="SELECT * from step1 where applicationid=?";
       return $this->connect->getAllDataSafely($sql,"s",[$applicant_id])[0]??[];
    }
    public function getStep2Info($applicant_id){
        $sql="SELECT * from step2 where applicationid=?";
        return $this->connect->getAllDataSafely($sql,"s",[$applicant_id])[0]??[];
    }
    public function getStep3Info($applicant_id){
        $sql="SELECT * from step3 where applicationid=?";
        return $this->connect->getAllDataSafely($sql,"s",[$applicant_id])[0]??[];
    }
    public function getStep4Info($applicant_id){
        $sql="SELECT * from step4 where applicationid=?";
        return $this->connect->getAllDataSafely($sql,"s",[$applicant_id])[0]??[];
    }
    public function getStep5Info($applicant_id){
        $sql="SELECT * from step5 where applicationid=?";
        return $this->connect->getAllDataSafely($sql,"s",[$applicant_id])[0]??[];
    }
    public function getInstitutionName($uni_id){
       $sql="SELECT uni_name from universities where id=?";
       $response=$this->connect->getAllDataSafely($sql,"s",[$uni_id])[0]??[];
       return $response['uni_name']??"";
    }
    public function isApplicationActive( int|string $applicant_id=''):array{
       $sql="SELECT * from active_application where id=?";
       return $this->connect->getAllDataSafely($sql,"s",[$applicant_id])[0]??[];
    }
    public function getConsultant(string $my_id = ''):string{
       $sql="SELECT * from admin where my_id=?";
       $response=$this->connect->getAllDataSafely($sql,"s",[$my_id])[0]??[];
       return isset($response['name'],$response['surname'])?$response['name'].' '.$response['surname']:'';
	}
	public function getStudentId($my_id):string{
	    $sql="SELECT applicationid from step1 where std_id=?";
	    $response=$this->connect->getAllDataSafely($sql,"s",[$my_id])[0]??[];
	    return $response['applicationid']??'';
	}
	public function getSchoolId($applicationid):string{
	    $sql="SELECT schoolname from step5 where applicationid=?";
	    $response=$this->connect->getAllDataSafely($sql,"s",[$applicationid])[0]??[];
	    return $response['schoolname']??'';
	}
	public function getAllPostalCodes():void{
		$sql="SELECT *from postaldb";
		$response=$this->connect->getAllDataSafely($sql,"",[])??[];
		foreach($response as $row){
			$a=$row["suburb"]." : ".$row['code'];
			?>
			<option value="<?php echo $a;?>"><?php echo $a;?></option>
			<?php
		}
	}
	public function getAllLanguages():void{
		$sql="SELECT *from languages";
		$response=$this->connect->getAllDataSafely($sql,"",[])??[];
		foreach($response as $row){
			?>
			<option value="<?php echo $row['id'];?>"><?php echo $row['lang'];?></option>
			<?php
		}
	}
	public function getFacultiesOfUni($uni):array{
		$sql="select*from faculties where uni_id=?";
		$params=[$uni];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];

	}
	public function hambisaKwisgabaSokuQala($grdlevel,$subjects1,$levelMark1,$levelMark11,$subjects2,$levelMark2,$levelMark22,$subjects3,$levelMark3,$levelMark33,$subjects4,$levelMark4,$levelMark44,$subjects5,$levelMark5,$levelMark55,$subjects6,$levelMark6,$levelMark66,$subjects7,$levelMark7,$levelMark77,$subjects8,$levelMark8,$levelMark88,$subjects9,$levelMark9,$levelMark99,$subjects10,$levelMark10,$levelMark1010,$total,$subj,array $cur_user_row=[]):Response{
		$year=date("Y");
		$date=date("Y-m-d");
		$time=date("H:i:s");
		$my_id=$cur_user_row['my_id'];
		$applicationid=md5($my_id);
		$average=$total/$subj;
		$sql="insert into step1(std_id,
								applicationid,
								avrg,
								grdlevel,
								numofsubj,
								subjects1,
								levelmark1,
								levelmark11,
								subjects2,
								levelmark2,
								levelmark22,
								subjects3,
								levelmark3,
								levelmark33,
								subjects4,
								levelmark4,
								levelmark44,
								subjects5,
								levelmark5,
								levelmark55,
								subjects6,
								levelmark6,
								levelmark66,
								subjects7,
								levelmark7,
								levelmark77,
								levelmark88,
								levelmark99,
								levelmark1010,
								subjects8,
								subjects9,
								subjects10,
								levelmark8,
								levelmark9,
								levelmark10,
								year_started,
								date_started,
								time_started)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,year(NOW()),NOW(),time(NOW()))";
		$params=[$my_id,$applicationid,$average,$grdlevel,$subj,$subjects1,$levelMark1,$levelMark11,$subjects2,$levelMark2,$levelMark22,$subjects3,$levelMark3,$levelMark33,$subjects4,$levelMark4,$levelMark44,$subjects5,$levelMark5,$levelMark55,$subjects6,$levelMark6,$levelMark66,$subjects7,$levelMark7,$levelMark77,$levelMark88,$levelMark99,$levelMark1010,$subjects8,$levelMark9,$subjects10,$levelMark8,$levelMark9,$levelMark10];		
		$string="sssssssssssssssssssssssssssssssssss";
		$this->Response=$this->connect->postDataSafely($sql,$string,$params);
		
		if($this->Response->responseStatus===StatusConstants::FAILED_STATUS){
			return $this->Response;
		}
		return $this->testingUpdater(1,false,$my_id);
	}
	public function getLevelOfApplication(string $my_id):string{
		$sql="SELECT level from testing where my_id=?";
		return $this->connect->getAllDataSafely($sql,"s",[$my_id])[0]['level']??"";
	}
	public function getUniversities():array{
		$sql="SELECT *from universities order by rand()";
		return $this->connect->getAllDataSafely($sql,'',[])??[];
	}
	public function getAllFacultiesFromUni($uni_id):array{
		$sql="SELECT *from faculties where uni_id=?";
		return $this->connect->getAllDataSafely($sql,"s",[$uni_id])??[];
	}
	public function issAlreadyApplied($course_id,$applicationid):bool{
		$sql="SELECT course_id,applicationid from finalapplication where applicationid=? AND course_id=?";
		return $this->connect->numRows($sql,"ss",[$applicationid,$course_id])===1;
	}
	public function studyCampus($course_id):void{
		$sql="SELECT campus_id from courses where course_id=?";
		$response=$this->connect->getAllDataSafely($sql,"s",[$course_id])[0]??[];
		
		$campus_id=$response['campus_id']??'';
		$sql="SELECT campus_name,campus_id from studycampus where campus_id=?";
		$response=$this->connect->getAllDataSafely($sql,"s",[$campus_id])[0]??[];
		
		if(empty($response)){
			?>
				<option value="">No Campus Found For this Course</option>
			<?php
		}
		else{
			
				$campus_name=$response['campus_name']??'';
				$campus_id=$response['campus_id']??'';
				?>
				<option value="<?php echo $campus_id;?>"> <?php echo $campus_name;?></option>
				<?php
		}
	}
	public function getCoursesFromUniFaculty(?int $uni_id=null,?int $faculty_id=null):array{
		$sql="SELECT *from courses where uni_id=? AND faculty_id=?";
		return $this->connect->getAllDataSafely($sql,"ss",[$uni_id,$faculty_id])??[];
	}
	public function getStudentInfoPayload(string $applicant = null):array{
	    $strParams = "s";
	    $params = [$applicant];
	    $sqlArr=[];
	    for($i=0;$i<5;$i++){
	        $k=$i+1;
	        $sqlArr[]="SELECT 
	                *
	            from step{$k}
	            where applicationid = ?";
	    }
	    $results = [];
	    $i=1;
	    foreach($sqlArr as $sql){
	        $results["step{$i}"]=$this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	        $i++;
	    }
	    
		return $results??[];
	}
	public function getDocUrl($my_id):string{
	    $sql = "SELECT directory_index from create_runaccount where my_id=?";
	    $params = [$my_id];
	    $strParams = "s";
		$res = $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
		return $res ['directory_index']??"";
	}
	public function getfinalApplication($studentId):array{
	    $sql ="
	    SELECT fa.*,
            fa.uni_id,
            (select uni_name from universities where id =fa.uni_id) as uni_name,
            fa.faculty_name as faculty_name,
            fa.course_id,
            (select course_name from courses where course_id =fa.course_id) as study_choice,
            (select url_varsy from universities where id =fa.uni_id) as api,
            asl.student_no as student_no,
            asl.password as password
        from finalapplication fa
            left join application_status_login as asl on asl.student = fa.applicationid and asl.uni =fa.uni_id
	        where fa.applicationid =?
	    ";
	    $params = [$studentId];
	    $strParams = "s";
	    return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getBursaryApplications(?string $my_id=null):array{
		$sql = "SELECT sba.*, 
       				GROUP_CONCAT(c.course_name) AS courses_funded
				FROM student_bursary_application AS sba
				LEFT JOIN step1 AS s ON s.applicationid = sba.student_application_id
				LEFT JOIN courses AS c ON FIND_IN_SET(c.course_id, (sba.list_of_courses_applied_funded_by_institution))
				WHERE s.std_id = ? 
  						AND sba.status = 'A'
				GROUP BY sba.id;
		";
		return $this->connect->getAllDataSafely($sql,'s',[$my_id])??[];
	}
	
}
?>