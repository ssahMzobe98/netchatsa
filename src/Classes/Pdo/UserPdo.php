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
	public function getPosterUserMy_id(?int $post_id=null):string{
    	$sql="SELECT posted_by from studyarea where post_id=?";
    	$params=[$post_id];
    	$strParams="s";
    	$response=$this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
    	return $response['posted_by'];
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
        //
        return $this->connect->getAllDataSafely($sql,'s',[$id])??[];
    }
	public function getBlockedUsersByMe(string $id=""){
        
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
		return $this->postDataSafely($sql,"ss",[$my_id,$poster]);
	}
}
?>