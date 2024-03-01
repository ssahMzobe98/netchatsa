<?php
namespace App\Providers\IService;
interface IAuthServiceProvider{
	public function WashDUnitDataSet(?string $data=null):string;
	public function WashDMultDataSet(array $arrayData=[]):array;
}
?>