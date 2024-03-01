<?php
namespace Src\Classes\DataGenerator;
use App\Providers\TraitService\DBConnectServiceTrait;
Class DataProvider {
	use DBConnectServiceTrait;
	public function GetCurrentUserDetailsByMail(?string $email=null):array{
		return [];
	}
	public function verifyLogin(?String $pass=null,?string $email=null):int{
		$sql="SELECT usermail from create_runaccount where usermail=? and security=? and status=1";
		return $this->connect->numRows($sql,'ss',[$email,$pass])??0;
	}
}
?>
