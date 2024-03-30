<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\IService\IAuthServiceProvider;
use App\Providers\Factory\DataGeneratorFactory;
use App\Providers\Factory\MMSServiceFactory;
use App\Providers\MMSHightech\MMSHightech;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Response\Response;
use App\Providers\Factory\PDOServiceFactory;
class AuthServiceProvider extends ServiceProvider implements IAuthServiceProvider
{
    // use DBConnectServiceTrait;
    private $dataProvider;
    public $cleanData;
    public $userPdo;
    public function __construct(){
        $this->cleanData=MMSServiceFactory::make(ServiceConstants::CLEANDATA,[null]);
        $this->dataProvider=DataGeneratorFactory::make(ServiceConstants::GENERATE_DATA,[$this->cleanData->connect]); 
        $this->userPdo = PDOServiceFactory::make(ServiceConstants::GENERATE_DATA,[$this->cleanData->connect]);

    }
    public function WashDUnitDataSet(?string $data = null): string
    {
        return $this->cleanData->OMO($data);
    }

    public function WashDMultDataSet(array $arrayData = []): array
    {
        return $this->cleanData->cleanAll($arrayData);
    }
    public function getCurrentUserDetails(?string $email=null):array{
        if(!isset($email)){
            return ['responseStatus'=>'F','responseMessage'=>'invalid data request!'];
        }
        return $this->dataProvider->GetCurrentUserDetailsByMail($email);

    }
    public function createNew(?string $emailNew=null,?string $pswdNew=null,?string $numberNew=null,?string $name=null,?string $surname=null):Response{
        return $this->dataProvider->createNewUserFromApp($this->cleanData->lockPassWord($pswdNew.$emailNew),$emailNew,$this->cleanData->lockPassWord($pswdNew),$numberNew,$name,$surname);
    }
    public function finalizeAccountReg(string $gender='',string $region='',string $dob='',string $address='',string $provice='',?int $otp=null):Response{
        return $this->dataProvider->finalizeAccountRegFromApp($gender,$region,$dob,$address,$provice,$otp);
    }
    public function passwordResetRequest(?string $EmailSetRequest=null,?int $resetCode=null):Response{
        return $this->userPdo->passwordResetRequest($EmailSetRequest,$resetCode);
    }
    public function passwordReset($newPassReset,$reset_code):Response{
        return $this->userPdo->passwordReset($this->cleanData->lockPassWord($newPassReset),$reset_code);
    }
    public function setUserLoginHistory(?string $email=null,object|null|string|array $response=null,object|null|string|array $server=null,object|null|string|array $request=null,object|null|string|array $env=null,object|null|string|array $session=null,object|null|string|array $cookies=null):Response{
        return $this->userPdo->setUserLoginHistory($email,$response,$server,$request,$env,$session,$cookies);
    }
    public function login(?string $pass=null,?string $email=null):array{
        if(!isset($pass)){
            return ['responseStatus'=>'F','responseMessage'=>'Password Required!'];
        }
        if(!isset($email)){
            return ['responseStatus'=>'F','responseMessage'=>'Email Required!'];
        }
        $pass = $this->cleanData->lockPassWord($pass);
        $response = $this->dataProvider->verifyLogin($pass,$email);

        if($response===0){
            return['responseStatus'=>'F','responseMessage'=>'Email|Password Incorrect.'];
        }

        if($response>1){
            return['responseStatus'=>'F','responseMessage'=>'Sorry Multiple Accounts with this email detected.'];
        }
        $userDetails = $this->getCurrentUserDetails($email);

        if(empty($userDetails)){
             return['responseStatus'=>'F','responseMessage'=>'User With email not found.'];
        }
        if($userDetails['verify']===StatusConstants::INCOMPLETE){
            return['responseStatus'=>'F','responseMessage'=>'Please complete account creation process.','status'=>StatusConstants::INCOMPLETE];
        }
        if($userDetails['verify']!==StatusConstants::VERIFIED){
            return['responseStatus'=>'F','responseMessage'=>'Account not verified'];
        }
        $response = $this->dataProvider->updateLoginSuccess($email);
        if($response->responseStatus===StatusConstants::FAILED_STATUS){
            return['responseStatus'=>'F','responseMessage'=>$response->responseMessage];
        }
        return['responseStatus'=>'S','responseMessage'=>$userDetails];
    }
}
