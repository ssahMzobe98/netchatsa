<?php

namespace App\Providers\Response;

use App\Providers\Constants\StatusConstants;
use App\Providers\IResponse\IResponse;

class Response implements IResponse
{
    public string $responseStatus='';
    public string $responseMessage='';
    public int $otp;
    public string $extraData;
    public object $objectError;
    public array $responseArray=[];
    public $response;
    public  function successSetter():Response{
        $this->responseStatus = StatusConstants::SUCCESS_STATUS;
        return $this;
    }
    public  function failureSetter():Response{
        $this->responseStatus = StatusConstants::FAILED_STATUS;
        return $this;
    }
    public  function messagerSetter(String $message=""):Response{
        $this->responseMessage = $message;
        return $this;
    }
    public  function messagerArraySetter(array $arrayMesssage=[]):Response{
        $this->responseArray = $arrayMesssage;
        return $this;
    }
    public function setObjectReturn():Response{
        $this->response = (object) ["responseStatus"=>$this->responseStatus,"responseMessage"=>$this->responseMessage,
            "responseArray"=>$this->responseArray];
        return $this;
    }
}
