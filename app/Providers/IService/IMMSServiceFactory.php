<?php
namespace App\Providers\IService;
interface IMMSServiceFactory{
	public static function make(string $classString, array $array=[]);
}

?>