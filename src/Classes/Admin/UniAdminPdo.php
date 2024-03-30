<?php
namespace Src\Classes\Admin;
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
class UniAdminPdo{
	use DBConnectServiceTrait;
	public function masomaneGetInstitution():array{
		$sql = 'select id, institutions from bursaries_institutions order by institutions ASC';
		$params = [];
		$strParams = "";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function masomaneSaveInstituions($TextNewInstitution,$TextNewInstitutionApiLink,$TextNewInstitutionAPIKey,$TextNewInstitutionAipKey2,$TextNewInstitutiontoken,$added_by):Response{
		$sql = "insert into bursaries_institutions(institutions,api,api_key,api_key_1,token,added_by,time_adedd)values(?,?,?,?,?,?,now())";
		$params = [$TextNewInstitution,$TextNewInstitutionApiLink,$TextNewInstitutionAPIKey,$TextNewInstitutionAipKey2,$TextNewInstitutiontoken,$added_by];
		$strParams = "ssssss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function masomaneGetInstitutionCourses($funder):array{
		$sql = "select 
					bfc.id as linked_id, c.course_name 
				from bursary_funding_courses as bfc 
					left join courses as c on c.course_id = bfc.course_id
				where bfc.institution_id=? and status='A' order by c.course_name ASC";
		$params = [$funder];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function masomaneGetUniCourses():array{
		$sql = "select 
					course_id as id,
					course_name
				from courses
				order by course_name ASC";
		$params = [];
		$strParams = "";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function masomaneCreateNewCourse(int $selectInstitution = 0,int $selectCourse = 0,int $user = 0):Response{
		$sql = "insert into bursary_funding_courses(course_id,institution_id,added_by,time_added)values(?,?,?,NOW())";
		$params = [$selectCourse,$selectInstitution,$user];
		$strParams = 'sss';
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function isCourseAddedToInstitution(int $selectInstitution = 0,int $selectCourse = 0):bool{
		$sql = "select id from bursary_funding_courses where course_id =? and institution_id =? and status = 'A'";
		$params = [$selectCourse,$selectInstitution];
		$strParams = "ss";
		return($this->connect->numRows($sql,$strParams,$params)==1)?true:false;
	}
	public function languagesString(int $lang_id=0):string{
	    $sql="select lang from languages where id=?";
	    $params = [$lang_id];
	    $strParams = "s";
		$res = $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
		return $res ['lang']??"No Language Found!!";
	}
	public function masomaneGetUniInfo(int $uni =0):array{
		$sql = "select uni_name from universities where id=?";
		$params = [$uni];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function masomaneGetUniCampusInfo(int $uni =0):array{
		$sql = "select campus_id,campus_name from studycampus where uni_id=?";
		$params = [$uni];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function masomaneGetUniFacultyInfo(int $campus_id =0):array{
		$sql = "select faculty_id,faculty_name from faculties where campus=?";
		$params = [$campus_id];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function masomaneGetUniCoursesInfo(int $faculty_id =0):array{
		$sql = "select course_id,course_name from courses where faculty_id=?";
		$params = [$faculty_id];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function makhanyileGetTertiaries():array{
		$sql = "select
			uni.uni_name as uni_name,
			uni.id as uni_id,
			(select count(campus_id)  from studycampus where uni_id=uni.id) as campuses,
			(select count(course_id) from courses where uni_id = uni.id) as courses,
			(select count(faculty_id) from 	faculties where uni_id=uni.id) as 	faculties,
			(select count(id) from finalapplication where uni_id = uni.id and year=year(now()) group by applicationid ) as applicants
		from universities as uni
		";
		return $this->connect->getAllDataSafely($sql,'',[])??[];
	}
}
?>