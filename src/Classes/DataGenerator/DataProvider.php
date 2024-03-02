<?php
namespace Src\Classes\DataGenerator;
use App\Providers\TraitService\DBConnectServiceTrait;
Class DataProvider {
	use DBConnectServiceTrait;
	public function GetCurrentUserDetailsByMail(?string $email=null):array{
		$sql="SELECT * from create_runaccount where usermail=?";
		return $this->connect->getAllDataSafely($sql,'s',[$email])[0]??[];
	}
	public function verifyLogin(?String $pass=null,?string $email=null):int{
		$sql="SELECT usermail from create_runaccount where usermail=? and security=? and status='A'";
		return $this->connect->numRows($sql,'ss',[$email,$pass])??0;
	}
}
?>
