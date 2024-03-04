<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;

class UserPdo{
	use DBConnectServiceTrait;
	public function getUserInfo(?string $column=null,?string $data=null):array{
		$sql="SELECT * FROM create_runaccount where $column=?";
		return $this->connect->getAllDataSafely($sql,'s',[$data])[0]??[];
	}
}
?>