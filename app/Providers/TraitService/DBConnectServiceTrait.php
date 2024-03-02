<?php
namespace App\Providers\TraitService;

use App\Providers\Factory\MMSServiceONLYFactory;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\MMSHightech\MMSHightech;

trait DBConnectServiceTrait{
    public $connect;
    // public $cleanData;
    // public DataGenerator $dataGenerator;
    public function __construct(MMSHightech|null $makeConnection=null)
    {
        if(!isset($makeConnection)){
            $makeConnection = MMSServiceONLYFactory::make(ServiceConstants::MMSHIGHTECH,[StatusConstants::CONNECTION_STATUS_NOT_CONNECTED]);
        }
        // $this->cleanData = MMSServiceFactory::make(ServiceConstants::CLEANDATA,[$makeConnection]);
        $this->connect =$makeConnection;
        // $this->dataGenerator = DataGeneratorFactory::make(ServiceConstants::GENERATE_DATA,$this->connect);
    }
}

?>