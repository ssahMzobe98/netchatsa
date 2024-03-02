<?php
namespace App\Providers\Factory;
use App\Providers\IService\IMMSServiceFactory;
use App\Providers\Constants\ServiceConstants;
use App\Providers\MMSHightech\MMSHightech;

class MMSServiceONLYFactory implements IMMSServiceFactory
{
    protected static $data = [
        ServiceConstants::MMSHIGHTECH => MMSHightech::class
    ];
    public static function make(string $classString, array $array=[])
    {
        $cl = self::$data[ServiceConstants::MMSHIGHTECH];
        if (!empty(self::$data[$classString])) {
            $cl =  self::$data[$classString];
        }
        return new $cl(...$array);
    }
}
?>