<?php

namespace App\Providers\IResponse;
use App\Providers\IResponse\Response;

interface IResponse
{
    public string $responseStatus='';
    public string $responseMessage='';
    public array $responseArray=[];
    public $response;
    public  function successSetter():Response;
    public  function failureSetter():Response;
    public  function messagerSetter(String $message=""):Response;
    public  function messagerArraySetter(array $arrayMesssage=[]):Response;
    public function setObjectReturn():Response;
}
