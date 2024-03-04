<?php
namespace App\Providers\Factory;
use App\Providers\IService\IMMSServiceFactory;
use App\Providers\Constants\ServiceConstants;
use Src\Classes\Pdo\UserPdo;
class PDOServiceFactory implements IMMSServiceFactory
{
    protected static $data = [
        ServiceConstants::USER=>UserPdo::class
    ];
    public static function make(string $classString, array $array=[])
    {
        $cl = self::$data[ServiceConstants::USER];
        if (!empty(self::$data[$classString])) {
            $cl =  self::$data[$classString];
        }
        return new $cl(...$array);
    }
}
?>