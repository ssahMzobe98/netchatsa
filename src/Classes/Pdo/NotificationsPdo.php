<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Factory\MMSServiceFactory;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\ServiceConstants;
use PHPMailer\PHPMailer\PHPMailer;
use App\Providers\Constants\Flags;
class NotificationsPdo{
	use DBConnectServiceTrait;
	public function fakaKuNotification(string $topic="",string $notification="",string $my_id_notification="",string $from_sender="",array $cur_user_row=[]):Response{
		$params=[$topic,$notification,$my_id_notification,$from_sender];
		$sql="INSERT into notifications(topic,notification,my_id_notification,from_sender,time_sent,is_read)values(?,?,?,?,NOW(),0)";
		$strParams="ssss";
		$this->Response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($this->Response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$this->Response->extraData=$this->sendEmail($notification,$cur_user_row['usermail'],$from_sender,$topic,$cur_user_row['name'],$cur_user_row['surname']);
		}
		return $this->Response;
	}
	public function sendEmail($message,$reciever,$sender,$subject,$name,$surname):Response {
		$mailService = MMSServiceFactory::make(ServiceConstants::MAIL_SERVICE,[new PHPMailer()]);
		return $mailService->setSMTPSettings(StatusConstants::MAIL_HOST, StatusConstants::DEFAULT_SYSTEM_SENDER, StatusConstants::MAILER_PASS, 465,PHPMailer::ENCRYPTION_SMTPS)
						->setSender(StatusConstants::DEFAULT_SYSTEM_SENDER,StatusConstants::DEFAULT_SYSTEM_SENDER_NAME)
						->addRecipient($reciever,$name.' '.$surname)
						->setSubject($subject)
						->setBody($message)
						->send();
	}
	public function updateSeeingPost(?int $id=null):Response{
		$sql="UPDATE notifications set is_read=1 where id=?";
		return $this->connect->postDataSafely($sql,"s",[$id]);
	}
	public function fetchAllNotifications(int $limit=0,int $start=0,string $my_id=""):array{
		$params=[$my_id,$start,$limit];
		$strParams="sss";
		$sql="SELECT  * from notifications where my_id_notification=? order by id DESC limit ?,?";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[]; 
	}

}
?>