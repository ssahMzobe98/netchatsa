<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\Flags;
class MatricUpgradePdo{
	use DBConnectServiceTrait;
	public function isRegistered($my_id):bool{
		$sql="SELECT my_id from matricupgrade where my_id=? LIMIT 1";
		return $this->connect->numRows($sql,'s',[$my_id])===1;
	}
	public function getMatricUpgradeStudentDetails($id):array{
	    $sql="SELECT * from matricupgrade where my_id=?";
	    $strParams="s";
	    $params=[$id];
	    return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function getAllInfoOfMatricReWriteLearner($id):array{
		$sql="SELECT * from matricupgrade where my_id=?";
	    $strParams="s";
	    $params=[$id];
	    return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function yenzaUmatikuletshenaWabaphindayo($my_id,$nameMatricUpgrade,$surnameMatricUpgrade,$idNumMatricUpgrade,$phoneMatricUpgrade,$emailMatricUpgrade,$subj1MatricUpgrade,$subj2MatricUpgrade,$subj3MatricUpgrade,$subj4MatricUpgrade,$subj5MatricUpgrade,$subj6MatricUpgrade,$subj7MatricUpgrade,$subj8MatricUpgrade,$subj9MatricUpgrade,$subj10MatricUpgrade,$SchoolsSA):Response{
		$sql="INSERT into matricupgrade (my_id,namematricupgrade, surnamematricupgrade, idNummatricupgrade, phonematricupgrade, emailmatricupgrade, subj1matricupgrade, subj2matricupgrade, subj3matricupgrade, subj4matricupgrade, subj5matricupgrade, subj6matricupgrade, subj7matricupgrade, subj8matricupgrade, subj9matricupgrade, subj10matricupgrade,schoolsa,tim_reg)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
		$params=[$my_id,$nameMatricUpgrade,$surnameMatricUpgrade,$idNumMatricUpgrade,$phoneMatricUpgrade,$emailMatricUpgrade,$subj1MatricUpgrade,$subj2MatricUpgrade,$subj3MatricUpgrade,$subj4MatricUpgrade,$subj5MatricUpgrade,$subj6MatricUpgrade,$subj7MatricUpgrade,$subj8MatricUpgrade,$subj9MatricUpgrade,$subj10MatricUpgrade,$SchoolsSA];
		$strParams="sssssssssssssssss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function getMatricRewriteSbjectContent($subj,$term):array{
		$sql="SELECT * from matric_rewrite_subj_content where subject=? and term=?";
	    $strParams="ss";
	    $params=[$subj,$term];
	    return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getMatricSubjInfo($subj_id):array{
		$sql="SELECT * from matricsubjects where subj_id=?";
	    $strParams="s";
	    $params=[$subj_id];
	    return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function getAmountToPay($applicationid){
		$sql="SELECT schoolname from step5 where applicationid=?";
	    $response=$this->connect->getAllDataSafely($sql,"s",[$applicationid])[0]??[];
	    // print_r($response);
	    return $this->getAmount($response['schoolname']);
	}
	
	public function getAmount($schoolname){
		$sql="SELECT amount from highschools where id=?";
	    $response=$this->connect->getAllDataSafely($sql,"s",[$schoolname])[0]??[];
	    // print_r($response);
	    return $response['amount'];
	}
	public function getEmailUser(string $my_id):string{
	    $sql="SELECT usermail from create_runaccount where my_id=?";
	    $response=$this->connect->getAllDataSafely($sql,"s",[$my_id])[0]??[];
	    return $response['usermail']??'';
	}
	
    public function getStudentGradeIfExists(string $my_id="",string $status=""):array{
    	$sql="SELECT * from sgela where my_id=? and status=?";
	    return $this->connect->getAllDataSafely($sql,"ss",[$my_id,$status])[0]??[];
    }
    public function changegrade($changegrade,$my_id):Response{
		$params=[$changegrade,$my_id];
		$strParams="ss";
		$sql="UPDATE sgela set level=? where my_id=?";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function getMatricSubjects():void{
		$sql="SELECT *from matricsubjects";
	?>
	<option value="">-- Select Subjects --</option>
	<?php
		$response=$this->connect->getAllDataSafely($sql,"",[])??[];
		foreach($response as $row) { 
			?>
			<option value="<?php echo $row["subj_id"]; ?>"><?php echo $row["subject"]; ?></option>
			<?php
		}
	}
	public function fakaIsifundoEsishaSasenyuvesi(string $select_module_2_reg="",string $level_module="",string $my_id=""):Response{
		$vavaStudentInfo=$this->getStudentGradeIfExists($my_id,"tertiary")??[];
		$student_id=$vavaStudentInfo['id'];
		$sql="INSERT into sgelamodulestudent(student_id,my_id,module,level,year,reg_date)values(?,?,?,?,year(NOW()),NOW())";
		$params =[$student_id,$my_id,$select_module_2_reg,$level_module];
		$strParams="ssss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function masomaneAddNewNetchatsaSchool(string $SubjectNameNetchatsa=""|null,string $gradeNetchatsa=""|null,$id):array{
		$SourceURL = "";
		$sql = "INSERT into matric_rewrite_subj_content(subject,chapter,term,title,source,content,time_added,added_by) values(?,?,?,?,?,?,NOW(),?)";
		$strParams = "sssssss";
		$params = [$subjectNameMatricUpgrade,$subjectChapter,$deremoTerm,$titleOfContent,$SourceName,$SourceURL,$user];
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}

	
}

?>