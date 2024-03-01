<?php
namespace App\Providers\Factory;
use App\Providers\IService\IMMSServiceFactory;
use App\Providers\MMSHightech\MMSHightech;
use App\Providers\Constants\ServiceConstants;

class MMSServiceFactory implements IMMSServiceFactory
{
    protected static $data = [
        ServiceConstants::MMSHIGHTECH => MMSHightech::class,
        ServiceConstants::CLEANDATA => CleanData::class,
        ServiceConstants::AUTH_SERVICE_PROVIDER=>AuthServiceProvider::class
    ];
    public static function make(string $classString, array $array)
    {
        $cl = self::$data[ServiceConstants::MMSHIGHTECH];
        if (!empty(self::$data[$classString])) {
            $cl =  self::$data[$classString];
        }
        return new $cl(...$array);
    }
}
?>