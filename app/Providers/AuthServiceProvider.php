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
class AuthServiceProvider extends ServiceProvider implements IAuthServiceProvider
{
    // use DBConnectServiceTrait;
    private $dataProvider;
    public $cleanData;
    public function __construct(){
        $this->cleanData=MMSServiceFactory::make(ServiceConstants::CLEANDATA,[null]);
        $this->dataProvider=DataGeneratorFactory::make(ServiceConstants::GENERATE_DATA,[$this->cleanData->connect]);   
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
