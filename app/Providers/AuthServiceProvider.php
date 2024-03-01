<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\IService\IAuthServiceProvider;
use App\Prividers\Factory\DataGeneratorFactory;
class AuthServiceProvider extends ServiceProvider implements IAuthServiceProvider
{
    // use DBConnectServiceTrait;
    public $dataProvider;
    public function init(){
        $this->dataProvider=DataGeneratorFactory::make(ServiceConstants::GENERATE_DATA,[]);
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
            return ['response'=>'F','data'=>'invalid data request!'];
        }
        return $this->dataProvider->GetCurrentUserDetailsByMail($email);

    }
    public function login(?string $pass=null,?string $email=null):array{
        if(!isset($pass)){
            return return ['response'=>'F','data'=>'Password Required!'];
        }
        if(!isset($email)){
            return return ['response'=>'F','data'=>'Email Required!'];
        }
        $pass = $this->lockPassWord($pass);
        $response = $this->dataProvider->verifyLogin($pass,$email);
        if($response===0){
            return['response'=>'F','data'=>'Email|Password Incorrect.'];
        }
        if($response>1){
            return['response'=>'F','data'=>'Sorry Multiple Accounts with this email detected.'];
        }
        $userDetails = $this->getCurrentUserDetails($email);
        if(empty($userDetails)){
             return['response'=>'F','data'=>'User With email not found.'];
        }
        if($userDetails['user_type']==StatusConstants::USER_TYPE_APP){
            $device = $_SERVER;
            return['response'=>'F','data'=>$device];

        }
        return [];



    }
}
