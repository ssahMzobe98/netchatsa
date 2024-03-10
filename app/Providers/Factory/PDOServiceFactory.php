<?php
namespace App\Providers\Factory;
use App\Providers\IService\IMMSServiceFactory;
use App\Providers\Constants\ServiceConstants;
use Src\Classes\Pdo\UserPdo;
use Src\Classes\Pdo\TertiaryApplicationsPdo;
use Src\Classes\Pdo\MatricUpgradePdo;
use Src\Classes\Pdo\MusicPdo;
use Src\Classes\Pdo\NavigationHistoryPdo;
use Src\Classes\Pdo\NetchatsaSubjectPdo;
use Src\Classes\Pdo\NotificationsPdo;
use Src\Classes\Pdo\SgelaUniversityPdo;
use Src\Classes\Pdo\StudyAreaPdo;
use Src\Classes\Pdo\TimePdo;
use Src\Classes\PayFast\PaymentProcessor;
use Src\Classes\PayFast\PayFastIntegration;
use Src\Classes\CleanData;
use Src\Classes\Drama\DramaClassPdo;
class PDOServiceFactory implements IMMSServiceFactory
{
    protected static $data = [
        ServiceConstants::USER=>UserPdo::class,
        ServiceConstants::TERTIARY_APPLICATIONS=>TertiaryApplicationsPdo::class,
        ServiceConstants::MATRIC_UPGRADE_PDO=>MatricUpgradePdo::class,
        ServiceConstants::MUSIC_PDO=>MusicPdo::class,
        ServiceConstants::NAVIGATION_HISTORY_PDO=>NavigationHistoryPdo::class,
        ServiceConstants::NETCHATSA_SUBJECT_PDO=>NetchatsaSubjectPdo::class,
        ServiceConstants::NOTIFICATION_PDO=>NotificationsPdo::class,
        ServiceConstants::SGELA_UNI_PDO=>SgelaUniversityPdo::class,
        ServiceConstants::STUDY_AREA_PDO=>StudyAreaPdo::class,
        ServiceConstants::TIME_PDO=>TimePdo::class,
        ServiceConstants::PAYMENT_PROCESSOR=>PaymentProcessor::class,
        ServiceConstants::PAYFAST_INTEGRATION=>PayFastIntegration::class,
        ServiceConstants::CLEANDATA=>CleanData::class,
        ServiceConstants::DRAMA_CLASS_PDO=>DramaClassPdo::class
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