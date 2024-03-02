<?php
namespace App\Providers\Factory;

use Src\Classes\DataGenerator\DataProvider;
use App\Providers\Constants\ServiceConstants;
use App\Providers\MMSHightech\MMSHightech;
use App\Providers\IService\IMMSServiceFactory;
class DataGeneratorFactory implements IMMSServiceFactory{
	protected static array $data=[
			ServiceConstants::GENERATE_DATA => DataProvider::class
	];
	public static function make(string $tagertClass,array $array=[]){
		$cl = self::$data[ServiceConstants::GENERATE_DATA];
		if(!empty(self::$data[$tagertClass])){
			$cl = self::$data[$tagertClass];
		}
		return new $cl(...$array);
	}
}
?>