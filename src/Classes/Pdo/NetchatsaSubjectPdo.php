<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\Flags;
class NetchatsaSubjectPdo{
	use DBConnectServiceTrait;
	public function getChapterInfo(int $chapter_id=0){
	    $sql="SELECT * from netchatsa_subjects_chapters where chapter_id=?";
		$params=[$chapter_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function NetchatSubjInfo(int $subj_id=0):array{
	    $sql="SELECT * from netchatsa_subjects where subj_id=?";
		$params=[$subj_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function isChapterMor(?int $chapter_id=null):bool{
	    $sql="SELECT * from netchatsa_subjects_chapters where chapter_id=?";
		$params=[$chapter_id];
		$strParams="s";
		return ($this->connect->numRows($sql,$strParams,$params)==1);
	}
	public function isNetchatSubjpracticeExams($chapter):bool{
	    $sql="SELECT * from exampractice where chapter=?";
		$params=[$chapter];
		$strParams="s";
		return ($this->connect->numRows($sql,$strParams,$params)>0);
	}
	public function isNetchatSubj(?int $subj_id=null):bool{
	    $sql="SELECT * from netchatsa_subjects where subj_id=?";
		$params=[$subj_id];
		$strParams="s";
		return ($this->connect->numRows($sql,$strParams,$params)==1);
	}
	public function getConententHighSchool(int $chapter_id=0):array{
		$sql="SELECT * from netchatsa_content where chapter_id=? order by time_added DESC";
		$params=[$chapter_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getNetchatsaSubjectsForHighSchool(string $level=""):array{
		$sql="SELECT * from netchatsa_subjects where level=?";
		$params=[$level];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getChapterHighSchoolSet(int $subj_id=0):array{
	//'
		$sql="SELECT * from netchatsa_subjects_chapters where subj_id=?";
		$params=[$subj_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function isSubjectId(?int $subj_id=null):bool{
	    $sql="SELECT * from netchatsa_subjects where subj_id=?";
	    $params=[$subj_id];
	    $strParams="s";
	    return ($this->connect->numRows($sql,$strParams,$params)!=0);
	}
	public function isChapter(?int $chapter=null):bool{
       $sql="SELECT * from netchatsa_subjects_chapters where chapter_id=?";
       $params=[$chapter];
       $strParams="s";
	   return ($this->connect->numRows($sql,$strParams,$params)!=0);
    }
    public function getChaterInfo(?int $chapter=null):array{
       $sql="SELECT * from netchatsa_subjects_chapters where chapter_id=?";
       $params=[$chapter];
       $strParams="s";
       return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
    }
    public function getSubjInfo(?int $subj_id=null):array{
	    $sql="SELECT * from netchatsa_subjects where subj_id=?";
	    $params=[$subj_id];
	    $strParams="s";
        return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function getNetchatsaSubjects(int $min=0,int $max=10){
		$sql = "select *from netchatsa_subjects order by subj_name limit ?,?";
		$params = [$min,$max];
		$strParams = "ss";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
}

?>