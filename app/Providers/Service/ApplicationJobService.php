<?php
namespace App\Providers\Service;
use App\Providers\IService\IApplicationJobService;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
use App\Providers\Response\Response;
class ApplicationJobService implements IApplicationJobService{
	use DBConnectServiceTrait;
	protected $tertiaryApplicationsPdo;

	public function fireJob(array $getIdOfCompletedApplications=[]):Response{

		$this->tertiaryApplicationsPdo = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$this->connect]);
		$getIdOfCompletedApplications= !empty($getIdOfCompletedApplications)?$getIdOfCompletedApplications:$this->tertiaryApplicationsPdo->getIdOfCompletedApplications();

		$this->Response->responseStatus=StatusConstants::FAILED_STATUS; 
		$this->Response->responseMessage='Preparation Failed.'; 
		$this->Response->responseArray=$getIdOfCompletedApplications; 
		if(!empty($getIdOfCompletedApplications)){
			$empty=[];
			foreach ($getIdOfCompletedApplications as $data) {
				$applicationid = $data['applicationid'];
				// echo $applicationid;
				$applicantCauses = $this->tertiaryApplicationsPdo->getAppliedStudentCauses($data['applicationid']);
				if(empty($applicantCauses)){
					$empty[]=['applicationid'=>$data['applicationid'],'notification'=>'ZERO Causes found for this applicant'];
				}
				else{
					$getBursariesThatFundTheseCauses = $this->tertiaryApplicationsPdo->getBursariesThatFundTheseCauses($applicantCauses);
					//print_r($getBursariesThatFundTheseCauses);
					if(empty($getBursariesThatFundTheseCauses)){
						$empty[]=['applicationid'=>$data['applicationid'],'notification'=>'No Bursaries found that fund causes applied by the applicant.'];
					}
					else{
						$terminate=true;
						foreach($getBursariesThatFundTheseCauses as $caurse=>$data1){
							if(!empty($data1)){
								$terminate=false;
							}
						}
						if(!$terminate){
							//$getBursariesThatFundTheseCauses = $this->filterRepeatedBursaries($getBursariesThatFundTheseCauses);
							$this->Response = $this->tertiaryApplicationsPdo->sendBursaryApplicationToQueue($data['applicationid'],$getBursariesThatFundTheseCauses);
							if($this->Response === StatusConstants::FAILED_STATUS){
								return $this->Response;
							}
						}
						else{
							$empty[]=['applicationid'=>$data['applicationid'],'notification'=>'No Bursaries found that fund causes applied by the applicant.'];
						}
					}
				}

			}
			if(!empty($empty)){
				$this->Response->responseStatus=StatusConstants::FAILED_STATUS; 
				$this->Response->responseMessage=$empty[0]['notification']." ". count($empty) . " - Applicants."; 
				$this->Response->responseArray=$empty; 
			}
		}
		return $this->Response;
	}
	protected function filterRepeatedBursaries(array $data=[]):array{
		$seen_institutions = [];
		foreach ($data as $key => &$institutions) {
		    $filtered_institutions = [];
		    foreach ($institutions as $institution) {
		        $id = $institution['institution_id'];
		        if (!in_array($id, $seen_institutions)) {
		            $seen_institutions[] = $id;
		            $filtered_institutions[] = $institution;
		        }
		    }
		    $data[$key] = $filtered_institutions;
		}
		return $data;
	}
}
?>