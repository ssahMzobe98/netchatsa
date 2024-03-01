<?php
namespace App\Prividers\Factory;

use Src\Classes\DataGenerator\DataProvider;
use App\Providers\Constants\ServiceConstants;
use App\Providers\MMSHightech\MMSHightech;
class DataGeneratorFactory{
	protected static array $data=[
			ServiceConstants::GENERATE_DATA => DataProvider::class
	];
	public static function make(string $tagertClass,MMSHightech $connection){
		$cl = self::$data[ServiceConstants::GENERATE_DATA];
		if(!empty(self::$data[$tagertClass])){
			$cl = self::$data[$tagertClass];
		}
		return new $cl($connection);
	}
}
?>