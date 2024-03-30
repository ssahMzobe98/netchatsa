<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\Flags;

class UserPdo{
	use DBConnectServiceTrait;
	public function getUserInfo(?string $column=null,?string $data=null):array{
		$sql="SELECT * FROM create_runaccount where $column=?";
		return $this->connect->getAllDataSafely($sql,'s',[$data])[0]??[];
	}
	public function loggOff(?string $email=null):Response{
		$sql="UPDATE create_runaccount set iss_looggedin=0 where usermail=?";
		return $this->connect->postDataSafely($sql,"s",[$email]);
		
	}
	public function fakaIsithombeEsishaKwiProfilePicture(string $new_name_file = "",string $id=""):Response{
		$params=[$new_name_file,$id];
		$sql="UPDATE create_runaccount set profile_image=? where my_id =?";
		$strParams="ss";
		$response=$this->connect->postDataSafely($sql,$strParams,$params);
		if($response->responseStatus!==StatusConstants::SUCCESS_STATUS){
			$sql="INSERT into profilesaver(my_id,img,time_submitted)values(?,?,NOW())";
			$params=[$id,$new_name_file];
			$response=$this->connect->postDataSafely($sql,$strParams,$params);
		}
		return $response;
    }
    public function setUserLoginHistory(?string $email=null,object|null|string|array $response=null,object|null|string|array $server=null,object|null|string|array $request=null,object|null|string|array $env=null,object|null|string|array $session=null,object|null|string|array $cookies=null):Response{
    	$sql = "INSERT into userHistoryDeviceTracker(email,response,server,request,env,session,cookies,date_time)values(?,?,?,?,?,?,?,NOW())";
    	$params = [$email,$response,$server,$request,$env,$session,$cookies];
        return$this->connect->postDataSafely($sql,'sssssss',$params);
    }
	public function getPosterUserMy_id(?int $post_id=null):string{
    	$sql="SELECT posted_by from studyarea where post_id=?";
    	$params=[$post_id];
    	$strParams="s";
    	$response=$this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
    	return $response['posted_by']??'';
    }
    public function unFlagUser(?int $deleteId=null):Response{
    	$response = new Response();
		if($this->connect->connection->query("DELETE from flagged_use_list where id='{$deleteId}'")){
            $response->successSetter()->messagerSetter("Success")->setObjectReturn();
        }
		else{
		    $response->failureSetter()->messagerSetter("Failed to process due to : " . $this->connect->connection->error)->messagerArraySetter(['error' => $this->connect->connection->error, 'Error_list' => $this->connect->connection->error_list]);
		}
		return $response;
	}
	public function unBlocUser(?int $deleteId=null):Response{
		$response = new Response();
		if($this->connect->connection->query("DELETE from blocked_user_list where id='{$deleteId}'")){
		     $response->successSetter()->messagerSetter("Success")->setObjectReturn();
        }
		else{
		    $response->failureSetter()->messagerSetter("Failed to process due to : " . $this->connect->connection->error)->messagerArraySetter(['error' => $this->connect->connection->error, 'Error_list' => $this->connect->connection->error_list]);
		}
		return $response;
	}


	public function getReportedUsersByMe(string $id=""):array{
        $sql="SELECT me.*,cr.name,cr.surname, cr.username from flagged_use_list me 
            left join create_runaccount as cr on cr.my_id COLLATE utf8mb4_unicode_ci= me.flaggee
        where me.flagger=? order by time_flagged DESC";
        return $this->connect->getAllDataSafely($sql,'s',[$id])??[];
    }
	public function getBlockedUsersByMe(string $id=""):array{
        
        $sql="SELECT me.*,cr.name,cr.surname, cr.username from blocked_user_list me
            left join create_runaccount as cr on cr.my_id COLLATE utf8mb4_unicode_ci= me.blockee
        where blocker =? order by time_blocked DESC";
        return $this->connect->getAllDataSafely($sql,'s',[$id])??[];
    }
	public function userInfoUNINGmyID(string $my_id=''):array{
		return $this->getUserInfo(Flags::USER_MY_ID_COLUMN,$my_id);
	}
	public function fakaKuFlagged(string $my_id="",string $poster=""):Response{
		$sql="INSERT into flagged_use_list(flagger,flaggee,time_flagged)values(?,?,NOW())";
		return $this->connect->postDataSafely($sql,"ss",[$my_id,$poster]);
	}
	public function fakaKuBlockedUsers(string $my_id="",string $poster=""):Response{
		$sql="INSERT into blocked_user_list(blocker,blockee,time_blocked)values(?,?,NOW())";
		return $this->connect->postDataSafely($sql,"ss",[$my_id,$poster]);
	}
	public function updateUserDataStoryPoint(?string $writeStoryPoint=null,?int $userId=null):Response{
		$sql = "UPDATE create_runaccount set about=? where id=?";
		return $this->connect->postDataSafely($sql,"ss",[$writeStoryPoint,$userId]);
	}
	public function passwordResetRequest(?string $EmailSetRequest=null,?int $resetCode=null):Response{
		$this->Response->failureSetter()->messagerSetter("User Does not Exist.")->messagerArraySetter([]);
		if(!$this->isUserExist($EmailSetRequest)){
			return $this->Response;
		}
		$sql = "UPDATE create_runaccount set reset_code=? where usermail=?";
		return $this->connect->postDataSafely($sql,"ss",[$resetCode,$EmailSetRequest]);
	}
	public function passwordReset(?string $newPassReset=null,?int $reset_code=null):Response{
		$this->Response->failureSetter()->messagerSetter("Code {$reset_code} does not exists.")->messagerArraySetter([]);
		$arr=$this->isCodeExist($reset_code);
		if(empty($arr)){
			return $this->Response;
		}

        $sql = "UPDATE create_runaccount set security=?, reset_code=null where reset_code=?";
		$this->Response=$this->connect->postDataSafely($sql,"ss",[$newPassReset,$reset_code]);
		if($this->Response->responseStatus===StatusConstants::SUCCESS_STATUS){
			$this->Response->responseMessage=$arr['usermail'];
		}
		
		return $this->Response;
		

    }

	public function isUserExist(?string $userMail=null):bool{
		if(!isset($userMail)){
			return false;
		}
		$sql="SELECT usermail from create_runaccount where usermail=? and status='A'";
		return $this->connect->numRows($sql,'s',[$userMail])===1;
	}
	public function isCodeExist(?int $reset_code=null):array{
		if(!isset($reset_code)){
			return [];
		}
		$sql="SELECT usermail from create_runaccount where reset_code=? and status='A'";
		return $this->connect->getAllDataSafely($sql,'s',[$reset_code])[0]??[];
	}
}
?>