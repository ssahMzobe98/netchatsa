<?php

namespace App\Providers\IResponse;
use App\Providers\Response\Response;

interface IResponse
{
    public function successSetter():Response;
    public function failureSetter():Response;
    public function messagerSetter(String $message=""):Response;
    public function messagerArraySetter(array $arrayMesssage=[]):Response;
    public function setObjectReturn():Response;
}
