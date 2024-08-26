<?php
namespace App\Providers\Factory\Admin;
use App\Providers\IService\IMMSServiceFactory;
use App\Providers\Constants\ServiceConstants;
use Src\Classes\Admin\MatricUpgradeAdminPdo;
use Src\Classes\Admin\UniAdminPdo;
use Src\Classes\Admin\SchoolAdminPdo;
use Src\Classes\Admin\ProjectTicketAdminPdo;
use App\Providers\Service\ApplicationJobService;
class PDOAdminFactory implements IMMSServiceFactory
{
    protected static $data = [
        ServiceConstants::MATRIC_UPGRADE_ADMIN=>MatricUpgradeAdminPdo::class,
        ServiceConstants::UNI_ADMIN_PDO=>UniAdminPdo::class,
        ServiceConstants::SCHOOL_ADMIN_PDO=>SchoolAdminPdo::class,
        ServiceConstants::PROJECT_TICKET_ADMIN=>ProjectTicketAdminPdo::class,
        ServiceConstants::BURSARY_APPLICATION_JOB_SERVICE=>ApplicationJobService::class
    ];
    public static function make(string $classString, array $array=[])
    {
        $cl = self::$data[ServiceConstants::MATRIC_UPGRADE_ADMIN];
        if (!empty(self::$data[$classString])) {
            $cl =  self::$data[$classString];
        }
        return new $cl(...$array);
    }
}
?>