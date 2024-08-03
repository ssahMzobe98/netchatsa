<?php
namespace Src\Classes\PayFast;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Factory\PDOServiceFactory;
class PaymentProcessor{
	private $TertiaryApplications;
	use DBConnectServiceTrait;

// 	public function init(){
		
// 	}
	public function processPaymentIntoDB($std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day):Response{
    	$sql="INSERT into matric_upgrade_payment(std_matric_upgrade,m_payment_id,pf_payment_id,payment_status,item_name,item_description,amount_gross,amount_fee,amount_net,name_first,name_last,email_address,merchant_id,school,time_uploaded,year,month,day,is_ctive,is_derigistered)values(?,?,?,?,?,?,?,?,?,?,?,?, ?,?,NOW(),?,?,?,1,1)";
    	$params=[$std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day];
    	$strParams="sssssssssssssssss";
    	return $this->connect->postDataSafely($sql,$strParams,$params);
    }
    public function processPaymentIntoDBTERTIARY($std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day):Response{
    	$sql="INSERT into tertiary_upgrade_payment(std_matric_upgrade,m_payment_id,pf_payment_id,payment_status,item_name,item_description,amount_gross,amount_fee,amount_net,name_first,name_last,email_address,merchant_id,school,time_uploaded,year,month,day,is_ctive,is_derigistered)values(?,?,?,?,?,?,?,?,?,?,?,?, ?,?,NOW(),?,?,?,1,1)";
    	$params=[$std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day];
    	$strParams="sssssssssssssssss";
    	return $this->connect->postDataSafely($sql,$strParams,$params);
    }
    public function processPayment($applicant_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee, $amount_net, $name_first,$name_last, $email_address, $merchant_id,$school,$my_id):Response{
		$sql="INSERT into payment(applicationid,m_payment_id,pf_payment_id,payment_status,item_name,item_description,amount_gross,amount_fee,amount_net,name_first,name_last,email_address,merchant_id,school,time_uploaded)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
		$params=[$applicant_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee, $amount_net, $name_first,$name_last, $email_address, $merchant_id,$school];
		$strParams="ssssssssssssss";
		$this->Response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($this->Response->responseStatus!==StatusConstants::SUCCESS_STATUS){
			return $this->Response;
		}
		$this->TertiaryApplications = PDOServiceFactory::make(ServiceConstants::TERTIARY_APPLICATIONS,[$this->connect]);
		return $this->TertiaryApplications->testingUpdater(9,true,$my_id);
	}

}

?>