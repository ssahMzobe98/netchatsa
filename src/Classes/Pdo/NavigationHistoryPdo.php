<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\Flags;
class NavigationHistoryPdo{
	use DBConnectServiceTrait;
	public function InsertPathToHistory(string $my_id="",int $prev_id=0,string $url=""):Response{
		$sql="INSERT into history_nav(prev_id,url,my_id,time_visits)values(?,?,?,NOW())";
		$params=[$prev_id,$url,$my_id];
		$strParams="sss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function getLastVisitHistory(string $my_id=""):array{
		$sql="SELECT * from history_nav where my_id=? order by id DESC Limit 1";
		return $this->connect->getAllDataSafely($sql,'s',[$my_id])[0]??[];
	}
	public function getLastPrevVisited(?int $prev_id=null):array{
		$sql="SELECT * from history_nav where id=? order by id DESC Limit 1";
		return $this->connect->getAllDataSafely($sql,'s',[$prev_id])[0]??[];
	}
}