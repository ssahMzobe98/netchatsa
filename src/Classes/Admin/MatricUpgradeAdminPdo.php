<?php
namespace Src\Classes\Admin;
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
class MatricUpgradeAdminPdo{
	use DBConnectServiceTrait;
	public function masomaneGetMatricUpgradeSubjects():array{
		$sql = "SELECT subj_id as id ,subject as subject_name,
				(select count(id) from matricupgradesubjchapter where subject=subj_id and status='A') as ChapterCounts
				from matricsubjects where status = 'A' order by subject ASC";
		$params = [];
		$strParams = "";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getSubjectString(int $id):string{
	    $sql = "SELECT subject from matricsubjects where subj_id=?";
		$params = [$id];
		$strParams = "s";
		$re=$this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
		return $re['subject']??'No subject found!!';
	}
	public function masomaneGetMatricUpgradeSubjChapters($subj):array{
		$sql = "SELECT id,chapter,subject from matricupgradesubjchapter where subject=? and status='A' order by chapter ASC";
		$params = [$subj];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function masomaneGetMatricUpgradeSubjChaptersContent($chapter){
		$sql = "SELECT id,content,source,title,term from matric_rewrite_subj_content where chapter= ? and status='A' order by term and id ASC";
		$params = [$chapter];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function deleteThisContent(int $deleteThisContent = 0):Response{
		$sql = "UPDATE matric_rewrite_subj_content set status='D' where id=?";
		$params = [$deleteThisContent];
		$strParams = "s";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function masomaneGetMatricUpgradeSubjectsSearch($findMe):array{
		$sql = "SELECT subj_id as id ,subject as subject_name,
				(select count(id) from matricupgradesubjchapter where subject=subj_id and status='A') as ChapterCounts
				from matricsubjects where subject like ? and status = 'A' order by subject ASC";
		$params = ["%".$findMe."%"];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function andNewMatricUpgradeChapter(int $subjectName = 0,string $TextChapter="",int $user=0):Response{
		$sql = "INSERT into matricupgradesubjchapter(subject,chapter,added_by,time_added)values(?,?,?,NOW())";
		$strParams = "sss";
		$params = [$subjectName,$TextChapter,$user];
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function masomaneAddNewContent(int $deremoTerm=1,int $subjectChapter = 0,int $subjectNameMatricUpgrade = 0,string $titleOfContent="",string $SourceName = "",string $SourceURL = "",int $user = 0):Response{
		$sql = "INSERT into matric_rewrite_subj_content(subject,chapter,term,title,source,content,time_added,added_by) values(?,?,?,?,?,?,NOW(),?)";
		$strParams = "sssssss";
		$params = [$subjectNameMatricUpgrade,$subjectChapter,$deremoTerm,$titleOfContent,$SourceName,$SourceURL,$user];
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
}
?>