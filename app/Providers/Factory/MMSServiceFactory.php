<?php
namespace App\Providers\Factory;
use App\Providers\IService\IMMSServiceFactory;
use App\Providers\Constants\ServiceConstants;
use App\Providers\AuthServiceProvider;
use Src\Classes\CleanData;
use App\Providers\Service\PHPMailService;

class MMSServiceFactory implements IMMSServiceFactory
{
    protected static $data = [
        ServiceConstants::CLEANDATA => CleanData::class,
        ServiceConstants::AUTH_SERVICE_PROVIDER=>AuthServiceProvider::class,
        ServiceConstants::MAIL_SERVICE => PHPMailService::class
    ];
    public static function make(string $classString, array $array=[])
    {
        $cl = self::$data[ServiceConstants::CLEANDATA];
        if (!empty(self::$data[$classString])) {
            $cl =  self::$data[$classString];
        }
        return new $cl(...$array);
    }
}
?>