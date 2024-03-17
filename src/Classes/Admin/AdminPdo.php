<?php

namespace Src\Classes\Admin;
use App\Providers\Response\Response;
use App\Providers\Constants\StatusConstants;
use App\Providers\TraitService\DBConnectServiceTrait;
class AdminPdo{
	use DBConnectServiceTrait;
	public function totalSchools():int{
		$sql="SELECT * from masomane_users where type='Principal'";
		return $this->connect->numRows($sql,"",[]);
	}
	public function totalStudents():int{
		$sql="SELECT * from masomane_users where type='student'";
		return $this->connect->numRows($sql,"",[]);
	}
	public function totalTeachers():int{
		$sql="SELECT * from masomane_users where type='teacher'";
		return $this->connect->numRows($sql,"",[]);
	}
	public function getRevenu():string|int|float{
		return number_format($this->totalStudents()*((200+(200*0.15))),2,","," ");
	}
	public function getSchool(int $school=0):array{
		$sql="SELECT *from highschools where id=?";
		$params=[$school];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function add3dots($string, $repl, $limit){
	  if(strlen($string) > $limit){
	    return substr($string, 0, $limit) . $repl; 
	  }
	  else{
	    return $string;
	  }
	}
	public function getMasomaneSchools(int $start=0,int $limit=0):array{
		$sql = "SELECT *from masomane_users where is_principal = 1 order by id desc limit ?,? ";
		$params = [$start,$limit];
		$strParams = "ss";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getStudentInfo(?int $std_uid=null):array{
		$sql = "SELECT title,initials,lname as surname,fname as name, (SELECT std_id from step1 where applicationid = ?) as my_id,(SELECT email from step3 where applicationid = ?) as usermail from step2 where applicationid = ?";
		$params = [$std_uid,$std_uid,$std_uid];
		$strParams = "sss";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
		public function masomaneGetApplicantsAppliedOnUni(int $uni=0):array{
		$sql = "select
					fa.applicationid applicant_id,
					s.title as title,
					s.initials as initials,
					s.lname as lname,
					s.fname as fname,
					s.status as status
				from finalapplication as fa
					left join step2 as s on s.applicationid = fa.applicationid
				where uni_id=? group by uni_id";
		$params = [$uni];
		$strParams = "s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function makhanyileGetAllApplicants(int $start=0,int $limit=15):array{
		$sql="select
				if(test.level>8,'COMPLETED','NOT COMPLED') as status,
				s.title as title,
				s.initials as initials,	
				s.lname as lname,
				s.fname as fname,
				s.idnumber as id_no,
				s.passport as passport,
				s.gender as gender,
				s.dob as dob,
				s1.applicationid as std,
				(select concat(phone,'/',telephone) from step3 where applicationid= s.applicationid limit 1) as phone,
				(select email from step3 where applicationid= s.applicationid limit 1) as email
			from step2 as s
				left join step1 as s1 on s1.applicationid=s.applicationid
				left join testing as test on test.my_id = s1.std_id 
			where test.year = year(NOW()) limit ?,?";
		$params = [$start,$limit=15];
		$strParams = "ss";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function makhanyileGetAllApplicantsSearch($findMe):array{
		$sql="select
				if(test.level>8,'COMPLETED','NOT COMPLED') as status,
				s.title as title,
				s.initials as initials,	
				s.lname as lname,
				s.fname as fname,
				s.idnumber as id_no,
				s.passport as passport,
				s.gender as gender,
				s.dob as dob,
				s1.applicationid as std,
				(select concat(phone,'/',telephone) from step3 where applicationid= s.applicationid limit 1) as phone,
				(select email from step3 where applicationid= s.applicationid limit 1) as email
			from step2 as s
				left join step1 as s1 on s1.applicationid=s.applicationid
				left join testing as test on test.my_id = s1.std_id 
			where (s.idnumber like ? or s.passport like ?) and test.year = year(NOW()) limit 1000";
		$params = ["%".$findMe."%","%".$findMe."%"];
		$strParams = "ss";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
}

?>