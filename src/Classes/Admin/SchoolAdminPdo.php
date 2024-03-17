<?php
namespace Src\Classes\Admin;
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
class SchoolAdminPdo{
	private $adminPdo;
	private $cleanPdo;
	use DBConnectServiceTrait;
	public function init(){
		$this->adminPdo = PDOServiceFactory::make(ServiceConstants::ADMIN,[$userPdo->connect]);
		$this->cleanPdo = PDOServiceFactory::make(ServiceConstants::CLEANDATA,[$userPdo->connect]);
	}
	public function maSomaneSaveSchool(string $PrincipalName="",string $PrincipalSurname="",int $PrincipalPhoneNo=0,string $PrincipalEmail="",int $selectMasomaneSchool=0,int $PrincipaIdNo=0,string $PrincipaPass="",int $PrincipaPersal=0,int $added_by=0):Response{
		$getSchool=$this->adminPdo->getSchool($selectMasomaneSchool);
		$school_name=$getSchool['school'];
		$user_nav="../school/".$school_name.rand(0,999999);
		$params=[$PrincipalName,$PrincipalSurname,$PrincipalEmail,$this->cleanPdo->lockPassWord($PrincipaPass),"Principal",$user_nav,$PrincipalPhoneNo,$selectMasomaneSchool,$PrincipaIdNo,$PrincipaPersal,$PrincipaPersal,$added_by];
		$sql="INSERT into masomane_users(name,surname,usermail,security,type,user_nav,grade_studying,phone,school,id_number,persal_number,school_student_num,school_employee_no,is_principal,time_added,added_by)values(?,?,?,?,?,?,'',?,?,?,?,'',?,1,NOW(),?)";
		$strParams="ssssssssssss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
		
	}
	public function readForReadOnly(int $id=0):array{
		$sql="
			SELECT ms_u.type as type,
				   ms_u.name as name,
				   ms_u.surname as surname,
				   ms_u.usermail as email,
				   ms_u.phone as phone,
				   ms_u.id_number as id_no,
				   ms_u.persal_number as persal,
				   if(ms_u.is_principal=1,'Yes','No') as is_principal,
				   hs.school as school_name,
				   (SELECT count(a1.id) from masomane_users as a1 where a1.type='student' and a1.school=ms_u.school) as learners,
				   (SELECT count(a2.id) from masomane_users as a2 where a2.type='teacher' and a2.school=ms_u.school) as teachers
				   from masomane_users as ms_u 
				   left join highschools as hs on hs.id = ms_u.school
				   where ms_u.id=?
		";
		$params=[$id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function readForEditOnly(int $id=0):array{
		$sql = "SELECT ms_u.*, hs.school as school_name from masomane_users ms_u 
				left join highschools as hs on hs.id = ms_u.school
		where ms_u.id = ?";
		$params = [$id];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	
	
	public function searchMasomaneBySchool(string $search =""):array{
		$searchInSchoolTable= $this->searchInSchoolTable($search);
		if(empty($searchInSchoolTable)){
			return [];
		}
		$arr=[];
		foreach($searchInSchoolTable as $data){
			$arr[]=$data['id'];
		}
		$sql = "SELECT *from masomane_users where school in (".implode(",", $arr).") and is_principal = 1";
		$params = [];
		$strParams = "";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function searchInSchoolTable(string $school_search=""):array{
		$sql = "SELECT id from highschools where school like ? order by school asc limit 0,1000";
		$params = ["%".$school_search."%"];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function maSomaneGetProjectsSchools(){
		$sql = "SELECT * from highschools order by school asc";
		$params = [];
		$strParams = "";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function maSomaneGetProjectsSchoolsSearch($findMe):array{
		$sql="SELECT * from highschools where school like ? limit 100";
		$params = ["%".$findMe."%"];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function MasomaneAddHighschools($schoolNameInput,$userMail):Response{
		$sql="INSERT into highschools(school,amount,added_by,time_added)values(?,'R300',?,NOW())";
		$params = [$schoolNameInput,$userMail];
		$strParams = 'ss';
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	
	public function searchBursaryCompaniesl(string $search=''):array{
		$sql = "SELECT id, institutions from bursaries_institutions where institutions like ? order by institutions ASC";
		$params = ['%'.$search.'%'];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function searchCourseFundedbyInstitution(string $search = ""):array{
		$sql = "SELECT 
					bfc.id as linked_id, 
					c.course_name, 
					bfc.institution_id,
					(SELECT institutions from bursaries_institutions where id=bfc.institution_id) as institutions
				from courses  as c 
					left join bursary_funding_courses as bfc on c.course_id = bfc.course_id
				where c.course_name like ? and status='A' order by c.course_name ASC";
		$params = ['%'.$search.'%'];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function searchBursaryUIDS(array $institutions = []):array{
		$sql = "SELECT id, institutions from bursaries_institutions where id in (?) order by institutions ASC";
		$params = [inplode(",",$institutions)];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
}

?>