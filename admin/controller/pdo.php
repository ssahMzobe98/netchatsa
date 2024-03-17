<?php
class _pdo_{
	
	public function __construct(){
		$this->dbConn();
		
	}


	
	public function getAllSchools(){
		$sql="select*from highschools";
		$response=$this->getAllDataSafely($sql,"",[])??[];
		foreach($response as $row){
			?>
			<option value="<?php echo $row['id'];?>"><?php echo $row['school'];?></option>
			<?php
		}
	}
	
	
	

	// public function fakaKuNotification(string $topic="",string $notification="",string $my_id_notification="",string $from_sender="",$toEmail):array{
	// 	$params=[$topic,$notification,$my_id_notification,$from_sender];
	// 	$sql="insert into notifications(topic,notification,my_id_notification,from_sender,time_sent,is_read)values(?,?,?,?,NOW(),0)";
	// 	$strParams="ssss";
	// 	$response=$this->postDataSafely($sql,$strParams,$params);
	// 	if(is_numeric($response)){
	// 		$sendResponse=$this->sendEmail($notification,$toEmail,$from_sender,$topic);
	// 		// error_log($sendResponse);
	// 		return array("response"=>"S","data"=>$response);
	// 	}
	// 	else{
	// 		return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
	// 	}
	// }
	public function sendEmail($message,$reciever,$sender,$subject){
		$from=$sender;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $mess = '<html><body> <div style="background-color:#212121;color:#45f3ff;">';
        $mess .= '<div style="display:flex;">';
        $mess .='<div style="width:50px;height:40px;margin-left:5%;border-radius:100%;border:4px solid #45f3ff;padding:4px 0;"><img style="width:100%;border-radius:100%;" src="https://netchatsa.com/img/jj.jpg"></div>';
        // $mess .='<div><h3 style="color:#080;font-size:18px;">Netchatsa Mailer Alert</h3></div>';
        $mess .='</div>';
        $mess .= '<h3 style="color:#f40;">Exe Macala 🤙</h3>'.$message;
        $mess .="<a href='https://play.google.com/store/apps/details?id=com.mmshightech.netchatsa'><span class='badge badge-primary text-center text-white'>Download APP</span></a>";
        $mess .= '<div style="padding:10px;border:1px solid #45f3ff;font-style:italic;font-size:12px;color:red;">netchatsa mailer is a communication system developed by Sgela Technologies EAI. If this mail does not belong to you please ignore it. Do not reply to this email as it is controlled by RoboTech.</div></div></body></html>';
        return mail($reciever, $subject, $mess, $headers);

	}
	
	
	
	
	
	
	
	
}
