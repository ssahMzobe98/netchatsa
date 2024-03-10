<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\Flags;
class SgelaUniversityPdo{
	use DBConnectServiceTrait;
	public function getAllModules():array{
		$sql="SELECT *from sgelavarsymodules";
		$params=[];
		$strParams="";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	//$_=$conn->query("select*from sgelavarsychapter where module='$module'");
    public function sgelavarsychapter($module):array{
    	$sql="SELECT *from sgelavarsychapter where module=?";
		$params=[$module];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
    }
	public function levelInfo(string $id="",string $status="high school"):array{
		$sql="SELECT *from sgela where my_id=? and status=?";
		$params=[$id,$status];
		$strParams="ss";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function gelaModuleStudent($id,$level):array{
		$sql="SELECT *from sgelamodulestudent where my_id=? and level=?";
		$params=[$id,$level];
		$strParams="ss";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getModuleInfo($module_id):array{
	    $sql="SELECT *from sgelavarsymodules where id=?";
		$params=[$module_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function getModuleChapterInfo($module_id):array{
	    $sql="SELECT *from sgelavarsychapter where module=?";
		$params=[$module_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function ismoduleandisstudent($std,$module):bool{
	    $sql="SELECT  my_id, module from sgelamodulestudent where my_id=? AND module=?";
		$params=[$std,$module];
		$strParams="ss";
		return ($this->connect->numRows($sql,$strParams,$params)>0);
	}
	public function ischapterandmodule($chapter_id,$id):bool{
	    $sql="SELECT  module from sgelavarsychapter where id=?";
		$params=[$chapter_id];
		$strParams="s";
		$response=$this->connect->getAllDataSafely($sql,$strParams,$params)[0];
		if(count($response)==0){
	        return false;
	    }
	    else{
	        $module=$response['module'];
	        return $this->ismoduleandisstudent($id,$module);
	    }
	}
	public function netchatsaExamsSubject(int $subj_id=0):array{
		$sql="SELECT *from exampractice where subject=?";
		$params=[$subj_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function NetchatSubjpracticeExams(int $chapter=0):array{
	    $sql="SELECT *from exampractice where chapter=?";
		$params=[$chapter];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getdisplayModeAnswers(int $displayModeAnswers=0):array{
		$sql="SELECT  * from exampractice where id=?";
		$params=[$displayModeAnswers];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function GetmatricUpgradeChapterInfo($MatricChapterId):array{
	    $sql="SELECT * from matricupgradesubjchapter where id=?";
	    $strParams="s";
	    $params=[$MatricChapterId];
	    return $this->connect->getAllDataSafely($sql,$strParams,$params)[0];
	}
	public function ngezelaEsinyeIsifundo($position,$subjModelAddSunject,$id):Response{
		$params=[$subjModelAddSunject,$id];
		$strParams="ss";
		$sql="UPDATE matricupgrade set $position=? where id=?";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function setSelfLearningClass($my_id_new_set,$status_new_set,$studentNameconst,$studentSurname,$studentSchoolAttecnding,$studentCurrentGrade,$amount):Response{
		$params=[$my_id_new_set,$status_new_set,$studentNameconst,$studentSurname,$studentSchoolAttecnding,$studentCurrentGrade,$amount];
		$strParams="sssssss";
		$sql="INSERT into sgela(my_id,status,name,surname,institution,level,paid,amount,date_reg)values(?,?,?,?,?,?,0,?,NOW())";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	
	public function fetchMatricUpgradeContent(int $subj=0,int $chapter=0,int $term=0,int $start=0,int $limit=0):array{
	    $params=[$subj,$chapter,$term,$start,$limit];
	    $sql="SELECT * from matric_rewrite_subj_content where subject=? and chapter=? and term=? limit ?,?";
	    $strParams="sssss";
	    return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	
	public function updateLevelVAVA(string $updateLevelVAVA="",string $my_id="",string $status="tertiary"):Response{
    	$sql="UPDATE sgela set level=? where my_id=? and status=?";
    	$params=[$updateLevelVAVA,$my_id,$status];
	  	$strParams="sss";
	  	return $this->connect->postDataSafely($sql,$strParams,$params);
    }
}

?>