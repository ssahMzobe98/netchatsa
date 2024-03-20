<?php
namespace Src\Classes\DataGenerator;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Response\Response;
Class DataProvider {
	use DBConnectServiceTrait;
	public function GetCurrentUserDetailsByMail(?string $email=null):array{
		$sql="SELECT * from create_runaccount where usermail=?";
		return $this->connect->getAllDataSafely($sql,'s',[$email])[0]??[];
	}
	public function verifyLogin(?String $pass=null,?string $email=null):int{
		// echo $pass;;
		$sql="SELECT usermail from create_runaccount where usermail=? and security=? and status='A'";
		return $this->connect->numRows($sql,'ss',[$email,$pass])??0;
	}
	private function isEmailHasAccount(?string $email=null):bool{
		$sql="SELECT usermail from create_runaccount where usermail=? and status='A'";
		return ($this->connect->numRows($sql,'s',[$email])??0)===1;
	}
	private function isOtpVAlod(?int $otp=null):array{
		$sql="SELECT usermail,name,surname from create_runaccount where otp=? and status='A'";
		return $this->connect->getAllDataSafely($sql,'s',[$otp])[0]??[];
	}
	public function createNewUserFromApp(?string $my_id=null,?string $emailNew=null,?string $pswdNew=null,?string $numberNew=null,?string $name=null,?string $surname=null):Response{

		if($this->isEmailHasAccount($emailNew)){
			return $this->Response->failureSetter()
								  ->messagerSetter('Account with this email already exist.')
								  ->messagerArraySetter()
								  ->setObjectReturn();
		}
		$username = "@".$name.'_'.$surname;
		$otp = rand(0,999);
		$sql="INSERT into create_runaccount(usermail,sa_id_number_passport,name,surname,username,security,my_id,otp,time_posted)values(?,?,?,?,?,?,?,?,NOW())";
		$paramArray=[$emailNew,$numberNew,$name,$surname,$username,$pswdNew,$my_id,$otp];
		$results=$this->connect->postDataSafely($sql,'ssssssss', $paramArray);
		$results->otp=$otp;
		return $results;
	}
	public function finalizeAccountRegFromApp(string $gender='',string $region='',string $dob='',string $address='',string $provice='',?int $otp=null):Response{
		$dataFromOTP = $this->isOtpVAlod($otp);
		if(empty($dataFromOTP)){
			return $this->Response->failureSetter()
								  ->messagerSetter('This Account is not valid!')
								  ->messagerArraySetter()
								  ->setObjectReturn();
		}
		$sql="UPDATE create_runaccount set gender=?,province=?,date_of_birth=?,address=?,region=?,verify='VERIFIED',otp=null where otp=?";
		$paramArray=[$gender,$provice,$dob,$address,$region,$otp];
		$results=$this->connect->postDataSafely($sql,'ssssss', $paramArray);
		$results->extraData=json_encode($dataFromOTP);
		return $results;
	}
	public function updateLoginSuccess(?string $email=null):Response{
		$sql = "UPDATE create_runaccount set iss_looggedin=1 where usermail=? and status='A'";
		return $this->connect->postDataSafely($sql,'s',[$email]);

	}

}
?>
