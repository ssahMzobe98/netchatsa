<?php
class _pdo_{
	protected $connection;
	public function __construct(){
		$this->dbConn();
	}
	private function dbConn(){
		$user="u405316555_netchatsa";
        $pass="netchatsa";
        $dbnam="u405316555_netchatsa";
		$this->connection=mysqli_connect("localhost",$user,$pass,$dbnam)or die("Connection was not established!!");
	}
	//_____________________________________________________________________________
    #################################
    /*
    private values, do not touch, do not edit, do not remove, this functions are only private to
    
    @Mr MS Mzobe
    Version: 1.0
    */
    public function islogedIn(string $email):array{
		// global $this->connection;
		$sql="select 
				iss_looggedin 
			 from create_runaccount 
			 where usermail=?";
		$rows=$this->numRows($sql,"s",[$email]);
		if($rows<1){
			return array("response"=>"F","data"=>"user not found");
		}
		elseif($rows>1){
			return array("response"=>"F","data"=>"Multiple accounts detected!!");	
		}
		else{
			$data=$this->getAllDataSafely($sql,"s",[$email])[0]??[];
			
			$iss_looggedin=$data['iss_looggedin']??'';
			
			if($iss_looggedin==1){
				return array("response"=>"S","data"=>true);
			}
			else{
				return array("response"=>"S","data"=>false);
			}	
		}
	}
	protected function loggOff(string $email):bool{
		$sql="update create_runaccount set iss_looggedin=0 where usermail=?";
		$post=$this->postDataSafely($sql,"s",[$email]);
		if(is_numeric($post)){
			return true;
		}
		else{
			return false;
		}
	}
    private function getAllDataSafely($query, $paramType="", $paramArray=[]):array{
        // global $conn;
        $stmt = $this->connection->prepare($query);
        
        if(!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $resultset=array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($resultset,$row);
            }
        }
        return $resultset;
        
        
    }
    private function postDataSafely($query, $paramType, $paramArray):int{
        // global $conn;
        // print $query;
        $stmt = $this->connection->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);
        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }
    private function execute($query, $paramType="", $paramArray=array()){
        // global $conn;
        $stmt = $this->connection->prepare($query);
        
        if(!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType="", $paramArray=array());
        }
        $stmt->execute();
    }

    private function bindQueryParams($stmt, $paramType, $paramArray=array()){
        // global $conn;
        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }
    private function numRows($query, $paramType="", $paramArray=array()):int{
        // global $conn;
        $stmt = $this->connection->prepare($query);
        
        if(!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;
        return $recordCount;
    }
    public function getPosterUserMy_id(int $post_id=0):string{
    	$sql="select posted_by from studyarea where post_id=?";
    	$params=[$post_id];
    	$strParams="s";
    	$response=$this->getAllDataSafely($sql,$strParams,$params)[0]??[];
    	return $response['posted_by'];
    }
	public function userInfo(string $email):array{
		$sql="select 
				* 
			 from create_runaccount 
			 where usermail=?";
		$rows=$this->numRows($sql,"s",[$email]);
		if($rows<1){
			return array("response"=>"F","data"=>"user not found");
		}
		elseif($rows>1){
			return array("response"=>"F","data"=>"Multiple accounts detected!!");	
		}
		else{
			return $this->getAllDataSafely($sql,"s",[$email])[0]??[];
		}

	}
	public function unFlagUser(int $deleteId=0){
		if($this->connection->query("delete from flagged_use_list where id='{$deleteId}'")){
		    return array("response"=>"S","data"=>$deleteId);
		}
		else{
		    return array("response"=>"F","data"=>$this->connection->error);
		}
	}
	public function unBlocUser(int $deleteId=0){
		if($this->connection->query("delete from blocked_user_list where id='{$deleteId}'")){
		    return array("response"=>"S","data"=>$deleteId);
		}
		else{
		    return array("response"=>"F","data"=>$this->connection->error);
		}
	}
	public function InsertPathToHistory(string $my_id="",int $prev_id=0,string $url=""):array{
		$sql="insert into history_nav(prev_id,url,my_id,time_visits)values(?,?,?,NOW())";
		$params=[$prev_id,$url,$my_id];
		$strParams="sss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function track_id_likeSendFunction(int $track_id_like=0,string $my_id=""):array{
	    $sql="insert into song_likes(track,my_id)values(?,?)";
	    $response=$this->postDataSafely($sql,'ss',[$track_id_like,$my_id]);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>$response);
		} 
	}
	protected function getNumDownloadsOfThisTrack(int $trackId=0):int{
	    $sql="select downloads from track where id=?";
	    $response=$this->getAllDataSafely($sql,'s',[$trackId])[0]??[];
	    if(empty($response)){
	        return 0;
	    }
	    else{
	        return $response['downloads'];
	    }
	}
    public function track_downloadSendFunction(int $track_download=0):array{
        $currNumDownload=$this->getNumDownloadsOfThisTrack($track_download)+1;
        $sql="update track set downloads=? where id=?";
        $response=$this->postDataSafely($sql,'ss',[$currNumDownload,$track_download]);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$currNumDownload);
		}
		else{
			return array("response"=>"F","data"=>$response);
		} 
    }
	public function getLastVisitHistory(string $my_id=""){
		$sql="select*from history_nav where my_id=? order by id DESC Limit 1";
		return $this->getAllDataSafely($sql,'s',[$my_id])[0]??[];
	}
	public function getLastPrevVisited(int $prev_id=0){
		$sql="select*from history_nav where id=? order by id DESC Limit 1";
		return $this->getAllDataSafely($sql,'s',[$prev_id])[0]??[];
	}
	public function getReportedUsersByMe(string $id=""){
        global $conn;
        $_="select me.*,cr.name,cr.surname, cr.username from flagged_use_list me 
            left join create_runaccount as cr on cr.my_id COLLATE utf8mb4_unicode_ci= me.flaggee
        where me.flagger=? order by time_flagged DESC";
        //
        return $this->getAllDataSafely($_,'s',[$id])??[];
    }
	public function getBlockedUsersByMe(string $id=""){
        global $conn;
        $sql="select me.*,cr.name,cr.surname, cr.username from blocked_user_list me
            left join create_runaccount as cr on cr.my_id COLLATE utf8mb4_unicode_ci= me.blockee
        where blocker =? order by time_blocked DESC";
        return $this->getAllDataSafely($sql,'s',[$id])??[];
    }
	public function userInfoUNINGmyID(string $my_id=''):array{
		$sql="select 
				* 
			 from create_runaccount 
			 where my_id=?";
		$rows=$this->numRows($sql,"s",[$my_id]);
		if($rows<1){
			return array("response"=>"F","data"=>"user not found");
		}
		elseif($rows>1){
			return array("response"=>"F","data"=>"Multiple accounts detected!!");	
		}
		else{
			return $this->getAllDataSafely($sql,"s",[$my_id])[0]??[];
		}

	}
	public function fakaKuFlagged(string $my_id="",string $poster=""){
		$sql="insert into flagged_use_list(flagger,flaggee,time_flagged)values(?,?,NOW())";
		$response=$this->postDataSafely($sql,"ss",[$my_id,$poster]);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function fakaKuBlockedUsers(string $my_id="",string $poster=""){
		$sql="insert into blocked_user_list(blocker,blockee,time_blocked)values(?,?,NOW())";
		$response=$this->postDataSafely($sql,"ss",[$my_id,$poster]);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function isLevelOfApplicaation(string $my_id):array{
		$sql="select* from testing where my_id=?";
		$response=$this->getAllDataSafely($sql,"s",[$my_id])[0]??[];
		if(empty($response)){
			return array("response"=>"S","data"=>[]);
		}
		$sql="select* from step1 where std_id=?";
		$response=$this->getAllDataSafely($sql,"s",[$my_id])[0]??[];
		return array("response"=>"S","data"=>$response);
	}
	public function logout(array $array):array{
		$sql="update create_runaccount set iss_looggedin=0 where usermail=?";
		$response=$this->postDataSafely($sql,"s",[$array['usermail']]);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
		}
	}
	public function updateSeeingPost(int $id=0):array{
		$sql="update notifications set is_read=1 where id=?";
		$response=$this->postDataSafely($sql,"s",[$id]);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function fakaImpenduloKa_AsifundeSonke(int $iscode=0,string $post_id="",string $text="",string $img="",string $mp4="",string $id=""):array{
		$params=[$iscode,$post_id,$text,$img,$mp4,$id];
		$sql="insert into studyareareply(iscode,post_id,text,img,video,posted_by,time_posted)values(?,?,?,?,?,?,NOW())";
		$strParams="ssssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
		}
	}
	public function fakaKuNotification(string $topic="",string $notification="",string $my_id_notification="",string $from_sender="",array $cur_user_row=[]):array{
		$params=[$topic,$notification,$my_id_notification,$from_sender];
		$sql="insert into notifications(topic,notification,my_id_notification,from_sender,time_sent,is_read)values(?,?,?,?,NOW(),0)";
		$strParams="ssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			$sendResponse=$this->sendEmail($notification,$cur_user_row['usermail'],$from_sender,$topic);
			error_log($sendResponse);
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
		}
	}
	public function fakaIsithombeEsishaKwiProfilePicture(string $new_name_file = "",string $id=""){
		$params=[$new_name_file,$id];
		$sql="update create_runaccount set profile_image=? where my_id =?";
		$strParams="ss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			$sql="insert into profilesaver(my_id,img,time_submitted)values(?,?,NOW())";
			$params=[$id,$new_name_file];
			$response=$this->postDataSafely($sql,$strParams,$params);
			if(is_numeric($response)){
				return array("response"=>"S","data"=>$response);
			}
			else{
				return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
			}
		}
		else{
			return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
		}
    }
	public function hambisaUmbuzoWeCode($studyAreaMathTitleCode,$studyAreaMathCode,$my_id){
		$params=[$studyAreaMathTitleCode,$studyAreaMathCode,$my_id];
		$sql="insert into studyarea(iscode,title,text,img,video,posted_by,time_posted)values(1,?,?,0,0,?,NOW())";
		$strParams="sss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
		}

	}
	public function addViewCounts($post_id,$my_id){
		$params=[$post_id,$my_id];
		$strParams="ss";
		$sql="insert into views(post_id,viewed_by,time_viewed)values(?,?,NOW())";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$this->getNumViews($post_id));
		}
		else{
			return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
		}
	}
	public function addLikeCounts($post_id,$my_id){
		$params=[$post_id,$my_id];
		$strParams="ss";
		$sql="insert into likes(post_id,user,time_liked)values(?,?,NOW())";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$this->getNumLikes($post_id));
		}
		else{
			return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
		}
	}
	public function addDislikeCounts($post_id,$my_id){
		$params=[$post_id,$my_id];
		$strParams="ss";
		$sql="insert into dislikes(post_id,disliked_by,time_disliked)values(?,?,NOW())";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$this->getNumDislike($post_id));
		}
		else{
			return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
		}
	}
	public function hambisaNoneCodeAsifunde($iscode,$title,$text,$img,$mp4,$my_id){
		$params=[$iscode,$title,$text,$img,$mp4,$my_id];
		$sql="insert into studyarea(iscode,title,text,img,video,posted_by,time_posted)values(?,?,?,?,?,?,NOW())";
		$strParams="ssssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>"failed to logout due to: ".json_encode($response));
		}
	}
	public function getPostOfThisUid(int $post_id=0){
		$params=[$post_id];
		$strParams="s";
		$sql="select*from studyarea where post_id=?";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];

	}
	public function getRepliesOfThisPost(int $post_id=0,int $min=0,int $max=0,string $id=""){
		$params=[$id,$id,$post_id,$min,$max];
		$strParams="sssss";
		// $sql="select*from studyareareply where post_id=? ORDER BY time_posted DESC limit ?,?";
		$sql="select * FROM studyareareply where posted_by  NOT IN (select flaggee COLLATE utf8mb4_unicode_ci from flagged_use_list where flagger=?) and posted_by NOT IN(select blockee COLLATE utf8mb4_unicode_ci from blocked_user_list where blocker=?) and post_id=? ORDER BY time_posted DESC limit ?,?";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function hambisaIsgabaSesibili($gender,$dob,$title,$initials,$lname,$fname,$status,$hlang,$ethnicGroup,$employed,$hear,$bursary,$id_num,$nationality,$app_idStep2,$my_id){
		$params=[$app_idStep2,$nationality,($nationality=="South African")?"":$id_num,($nationality=="South African")?$id_num:"",$gender,$dob,$title,$initials,$lname,$fname,$status,$hlang,$ethnicGroup,$employed,$hear,$bursary];
		$sql="insert into step2(applicationid,sa,passport,idnumber,gender,dob,title,initials,lname,fname,status,hlang,ethnicgroup,employed,hear,bursary,date,year,time_submitted)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,date(NOW()),year(NOW()),time(NOW()))";
		$strParams="ssssssssssssssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			$response=$this->testingUpdater(2,true,$my_id);
			//print_r($response);echo'<br>------';
			if($response['response']=="S"){
				return array("response"=>"S","data"=>$response);
			}
			else{
				return array("response"=>"F","data"=>$response['data']);
			}
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function getAsifundeSonke(int $min=0,int $max=7,string $id=""){
		// $sql="select*from studyarea ORDER BY time_posted DESC limit ? , ?";
		$sql="SELECT 
    s.*, 
    cr.username, 
    cr.profile_image, 
    cr.name, 
    cr.surname 
FROM 
    studyarea AS s
LEFT JOIN 
    create_runaccount AS cr 
ON 
    s.post_id = cr.my_id
WHERE 
    s.posted_by NOT IN (
        SELECT 
            flaggee COLLATE utf8mb4_unicode_ci 
        FROM 
            flagged_use_list 
        WHERE 
            flagger = ?
    ) 
    AND 
    s.posted_by NOT IN (
        SELECT 
            blockee COLLATE utf8mb4_unicode_ci 
        FROM 
            blocked_user_list
        WHERE 
            blocker = ?
    )
ORDER BY 
    time_posted DESC
LIMIT 
    ?,?";
		$params=[$id,$id,$min,$max];
		$strParams="ssss";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getOtherUser($poster_my_id){
		$sql="select*from create_runaccount where my_id=?";
		$params=[$poster_my_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function getNumViews($post_id){
		$sql="select*from views where post_id=?";
		$params=[$post_id];
		$strParams="s";
		return $this->numRows($sql,$strParams,$params);
	}
	public function getNumDislike($post_id){
		$sql="select*from dislikes where post_id=?";
		$params=[$post_id];
		$strParams="s";
		return $this->numRows($sql,$strParams,$params);
	}
	public function getNumLikes($post_id){
		$sql="select*from likes where post_id=?";
		$params=[$post_id];
		$strParams="s";
		return $this->numRows($sql,$strParams,$params);
	}
	public function getNumOfReply($post_id){
		$sql="select*from studyareareply where post_id=?";
		$params=[$post_id];
		$strParams="s";
		return $this->numRows($sql,$strParams,$params);
	}
	public function time_Ago($time) { 
	    $diff     = time() - $time; 
	    $sec     = $diff; 
	      
	    // Convert time difference in minutes 
	    $min     = round($diff / 60 ); 
	      
	    // Convert time difference in hours 
	    $hrs     = round($diff / 3600); 
	      
	    // Convert time difference in days 
	    $days     = round($diff / 86400 ); 
	      
	    // Convert time difference in weeks 
	    $weeks     = round($diff / 604800); 
	      
	    // Convert time difference in months 
	    $mnths     = round($diff / 2600640 ); 
	      
	    // Convert time difference in years 
	    $yrs     = round($diff / 31207680 ); 
	      
	    // Check for seconds 
	    if($sec <= 60) { 
	        echo "s ago"; 
	    } 
	      
	    // Check for minutes 
	    else if($min <= 60) { 
	        if($min==1) { 
	            echo $min." m ago"; 
	        } 
	        else { 
	            echo "$min m ago"; 
	        } 
	    } 
	      
	    // Check for hours 
	    else if($hrs <= 24) { 
	        if($hrs == 1) {  
	            echo "hr ago"; 
	        } 
	        else { 
	            echo "$hrs hrs ago"; 
	        } 
	    } 
	      
	    // Check for days 
	    else if($days <= 7) { 
	        if($days == 1) { 
	            echo "Yest"; 
	        } 
	        else { 
	            echo "$days d ago"; 
	        } 
	    } 
	      
	    // Check for weeks 
	    else if($weeks <= 4.3) { 
	        if($weeks == 1) { 
	            echo "a w ago"; 
	        } 
	        else { 
	            echo "$weeks w ago"; 
	        } 
	    } 
	      
	    // Check for months 
	    else if($mnths <= 12) { 
	        if($mnths == 1) { 
	            echo "a mn ago"; 
	        } 
	        else { 
	            echo "$mnths mn ago"; 
	        } 
	    }  
	    else { 
	        if($yrs == 1) { 
	            echo $yrs." y ago"; 
	        } 
	        else { 
	            echo "$yrs ys ago"; 
	        } 
	    } 
	}
	public function hambisaKwisigabaSesibili($street,$suburb,$town,$province,$postal,$phone,$telephone,$email,$res,$dis,$studedentApplicationId,$my_id){
		$sql="insert into step3(applicationid,street,suburb,town,province,postal,phone,telephone,email,res,dis,date,year,time_posted)values(?,?,?,?,?,?,?,?,?,?,?,date(NOW()),year(NOW()),NOW())";
		$params=[$studedentApplicationId,$street,$suburb,$town,$province,$postal,$phone,$telephone,$email,$res,$dis];
		$strParams="sssssssssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			$response=$this->testingUpdater(3,true,$my_id);
			//print_r($response);echo'<br>------';
			if($response['response']=="S"){
				return array("response"=>"S","data"=>$response);
			}
			else{
				return array("response"=>"F","data"=>$response['data']);
			}
		}
		else{
			return array("response"=>"F","data"=>$response);
		}

	}
	public function hambisaIsgabaSesine($fname,$lname,$relationship,$employed,$phone,$alphone,$email,$street,$suburb,$town,$province,$postal,$applicationidStep4,$my_id){
		$params=[$applicationidStep4,$fname,$lname,$relationship,$employed,$alphone,$email,$phone,$street,$suburb,$town,$province,$postal];
		$sql="insert into step4(applicationid,fname,lname,relationship,employed,alphone,email,phone,street,suburb,town,province,postal,date,year,time_submitted)values(?,?,?,?,?,?,?,?,?,?,?,?,?,date(NOW()),year(NOW()),now())";
		$strParams="sssssssssssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			$response=$this->testingUpdater(4,true,$my_id);
			//print_r($response);echo'<br>------';
			if($response['response']=="S"){
				return array("response"=>"S","data"=>$response);
			}
			else{
				return array("response"=>"F","data"=>$response['data']);
			}
		}
		else{
			return array("response"=>"F","data"=>$response);
		}

	}
	public function uploadedUpload(string $column,bool $isLastDoc=false,string $new_name_file="",string $applicationId="",string $my_id=""){
		$params=[$new_name_file,$applicationId];
		$sql="update step5 set {$column}=? where applicationid=?";
		$strParams="ss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			if($isLastDoc){
				$response=$this->testingUpdater(6,true,$my_id);
				//print_r($response);echo'<br>------';
				if($response['response']=="S"){
					return array("response"=>"S","data"=>$response);
				}
				else{
					return array("response"=>"F","data"=>$response['data']);
				}
			}
			else{
				return array("response"=>"S","data"=>$response);
			}
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
		

	}
	public function getFacultyName($faculty_id){
		$sql="select faculty_name from faculties where faculty_id=?";
		$params=[$faculty_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function uniName($uni_id){
		$sql="select uni_name from universities where id=?";
		$params=[$uni_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function get_students_applications_login_details($std_id){
		$sql="select * from students_applications_login_details where student_id_ref = ?";
		$params=[$std_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function hambisaIsgabaSesithupha($uni_id,$uni_name,$faculty_id,$faculty_name,$course_id,$course_name,$mode_of_attendance,$year_of_study,$campus_id,$my_id,bool $skip=false){
		$applicationId=$this->getApplicationId($my_id);
		$sql="insert into finalapplication(applicationid,uni_id,uni_name,faculty_id,faculty_name,course_id,course_name,mode_of_attendance,year_of_study,campus_id,date,year,time_submitted) values(?,?,?,?,?,?,?,?,?,?,date(NOW()),year(NOW()),NOW())";
		$params=[$applicationId,$uni_id,$uni_name,$faculty_id,$faculty_name,$course_id,$course_name,$mode_of_attendance,$year_of_study,$campus_id];
		$strParams="ssssssssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			if($skip){
				return array("response"=>"S","data"=>$response);
			}
			else{
				$getCount=count($this->getAllDataSafely("select*from finalapplication where applicationid=?","s",[$applicationId])??[]);
				if($getCount==3 || $getCount>3){
					$response=$this->testingUpdater(7,true,$my_id);
					//print_r($response);echo'<br>------';
					if($response['response']=="S"){
						return array("response"=>"S","data"=>$response,"loader"=>1);
					}
					else{
						return array("response"=>"F","data"=>$response['data']);
					}
				}
				else{
					return array("response"=>"S","data"=>$response);
				}
			}
		}
		else{
			return array("response"=>"F","data"=>$response);
		}

	}
	protected function applicationidExists($applicationidStep8):array{
	    $sql = "select applicationid from terms_conditions where applicationid=?";
	    $strParams="s";
	    $params = [$applicationidStep8];
		return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function hambisaIsgabaConditionsAccept($accept,$applicationidStep8,$my_id){
		$params=[$applicationidStep8,$accept];
		if(!empty($this->applicationidExists($applicationidStep8))){
		    return array("response"=>"F","data"=>"Cannot duplicate records. Aplicant ID Exists");
		}
		$sql="insert into terms_conditions(applicationid,accept,date,year,time_accepted)values(?,?,date(NOW()),year(NOW()),NOW())";
		$strParams="ss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			$response=$this->testingUpdater(8,true,$my_id);
			if($response['response']=="S"){
				return array("response"=>"S","data"=>$response);
			}
			else{
				return array("response"=>"F","data"=>$response['data']);
			}
		}
		else{
			return array("response"=>"F","data"=>$response);
		}


	}
	public function getSearchItemsForStudyArea(string $search ="",string $id=""){
		// $sql="select*from studyarea where title like ? order by post_id DESC limit 1000";
		$sql="SELECT * FROM studyarea
                       WHERE posted_by  
                       NOT IN (select flaggee COLLATE utf8mb4_unicode_ci from flagged_use_list where flagger=?) 
                       and 
                       posted_by 
                       NOT IN(select blockee COLLATE utf8mb4_unicode_ci from blocked_user_list where blocker=?) 
                       and 
                       title 
                       like ? order by post_id DESC limit 1000";

        $params=[$id,$id,"%".$search."%"];
		$strParams="sss";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function hambisaIsgabaSesihlanu($applicationidStep5,$my_id,$schoolname,$street,$suburb,$town,$province,$postal,$yearcompleted,$activity,$eduhistory,$uni,$studentnumber,$statuscompletion){
		$params=[$applicationidStep5,$schoolname,$street,$suburb,$town,$province,$postal,$yearcompleted,$activity,$eduhistory,$uni,$studentnumber,$statuscompletion];
		$sql="insert into step5(applicationid,schoolname,street,suburb,town,province,postal,yearcompleted,activity,eduhistory,uni,studentnumber,statuscompletion,date,year,time_submitted)values(?,?,?,?,?,?,?,?,?,?,?,?,?,date(NOW()),YEAR(NOW()),NOW())";
		$strParams="sssssssssssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			$response=$this->testingUpdater(5,true,$my_id);
			if($response['response']=="S"){
				return array("response"=>"S","data"=>$response);
			}
			else{
				return array("response"=>"F","data"=>$response['data']);
			}
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function getCoursesOfThisFaculty(int $uni=0,int $faculty=0){
		$sql="select*from courses where faculty_id=? and uni_id=?";
		$params=[$faculty,$uni];
		$strParams="ss";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function fetchAllNotifications(int $limit=0,int $start=0,string $my_id=""):array{
		$params=[$my_id,$start,$limit];
		$strParams="sss";
		$sql="select * from notifications where my_id_notification=? order by id DESC limit ?,?";
		return $this->getAllDataSafely($sql,$strParams,$params)??[]; 
	}
	public function notifications(array $cur_user_row=[]):void{
		?>
		<div class="loadNotifications"></div>
		<div class="loadButns"></div>
		<script>
			$(document).ready(function(){
				 var limit = 7;
				 var start = 0;
				 var action = 'inactive';
				 
				// console.log("preparing to load data");
				 if(action == 'inactive')
				 {
				  action = 'active';
				  // console.log("loading data now...")
				  load_country_data(limit, start);
				 }
				 $(window).scroll(function(){
				  if($(window).scrollTop() + $(window).height() > $(".loadNotifications").height() && action == 'inactive')
				  {
				   action = 'active';
				   start = start + limit;
				   setTimeout(function(){
				    load_country_data(limit, start);
				   }, 1000);
				  }
				 });
				 
			});
			function load_country_data(limit, start){
				const constant=7;
				$.ajax({
				   url:"./model/notification.php",
				   method:"POST",
				   data:{limit:limit,start:start},
				   cache:false,
				   success:function(data){
				   	// console.log(data+" : Data info ");
				    $('.loadNotifications').append(data);
				    if(data == ''){
				     $('.loadButns').html("<button type='button' class='btn btn-dark' style='width:100%;padding:2px 2px;color:#45f3ff;'>No Notifications Found</button>");
				     action = 'active';
				    }
				    else{
				     $('.loadButns').html("<button style='width:100%;padding:2px 2px;color:#45f3ff;' onclick='load_country_data("+(limit+constant)+","+(start+constant)+")' type='button' class='btn btn-dark;'>Load More</button>");
				     action = "inactive";
				    }
				   }
				});
			}
		</script>
		<?php
	}
	public function asifundeSonkeLoader(){
		?>
<style>
	.headerSearchBar{
		width: 100%;
		padding: 10px;
		background-color: none;
		border-bottom:1px solid #45f3ff;
	}
	.headerSearchBar .model{
		width: 90%;
		
	}
	.headerSearchBar .model form{
		width: 100%;
		display: flex;
		
	}
	.headerSearchBar .model form .seachInput{
		width: 100%;
		
	}
	.headerSearchBar .model form .seachInput input{
		width: 100%;
		border: none;
		border-bottom: 1px solid #45f3ff;
		color: #45f3ff;
		background-color: transparent;
		padding: 10px 10px;
	}
	.headerSearchBar .model form .seachSubmit{
		width: 10%;
	}
	.headerSearchBar .model form .seachSubmit .btn{
		width: 100%;
	}
	.bodyStudyArea{
		width: 100%;
	}
	.bodyStudyArea .package{
		width: 100%;
		box-shadow: -3px 4px 6px 6px black;
		background-color: #212121;
	}
	.bodyStudyArea .package .headerDisplayMach{
		width: 100%;
		padding-top: 5px 5px;
		display: flex;
	}
	
	.bodyStudyArea .package .headerDisplayMach .userName{
		padding: 10px 10px;
		font-size: 8px;
	}
	.bodyStudyArea .package .headerDisplayMach .userName h5{
		font-size: 15px;
	}
	.bodyStudyArea .package .headerDisplayMach .names{
		padding: 10px 10px;
		font-size: 8px;
	}
	.bodyStudyArea .package .headerDisplayMach .names h5{
		font-size: 15px;
	}
	.bodyStudyArea .package .headerDisplayMach .time{
		padding: 10px 10px;
		font-size: 8px;
	}
	.bodyStudyArea .package .headerDisplayMach .time h5{
		font-size: 15px;
	}
	.bodyStudyArea .package .textDisplay{
		width: 100%;
		padding: 5px 5px;
		
	}
	.bodyStudyArea .package .textDisplay h5{
		font-size: 14px;
	}
	.bodyStudyArea .package .textDisplay a{
		width: 100%;
	}
	.bodyStudyArea .package .textDisplay img{
		width: 100%;
	}
	.bodyStudyArea .package .textDisplay video{
		width: 100%;
	}
	.bodyStudyArea .package .displayEmogies{
		width: 100%;
		padding: 5px 5px;
		text-align: center;
		justify-content: center;
		align-content: center;
		align-items: center;
		align-self: center;

	}
	.bodyStudyArea .package .displayEmogies .like{
		width: 25%;
		
		text-align: center;
	}
	.bodyStudyArea .package .displayEmogies .like i{
		font-size: 15px;
		color: white;
	}
	.package .headerDisplayMach{
		width: 100%;
		padding: 2px 2px;
	}
	.package .headerDisplayMach .profile{
		
		width:40px;
		height:40px;
		border-radius: 100%;
		border: 1px solid #45f3ff;
		padding: 2px 2px;
		
	}
	.package .headerDisplayMach .profile img{
		
		width: 100%;
		height: 100%;
		border-radius: 100%;
		border: 1px solid #45f3ff;
		
	}
</style>

		</style>
			<div class="headerSearchBar flex">
				<div class="model">
					<form method="post">
						<div class="seachInput"><input type="search" oninput="searchFind()" name="search" id="search" placeholder="Find Your Answer/Solution..." required=""></div>
						
					</form>
					<script>
					    function searchFind(){
					        q=$('#search').val();
					        if(q==""){
					            $('#search').removeAttr("placeholder");
					            $('#search').attr("placeholder","Search Study Content Here..");
					        }
					        else{
						    const url="model/searchOnStudyArea.php";
						    $.ajax({
						      url:url,
						      type:"POST",
						      data:{q:q},
						      cache:false,
						      beforeSend:function(data){
						        $(".bodyStudyArea").html("Searching "+q+" ..");
						      },
						      success:function(data){
						        $(".bodyStudyArea").html(data);
						      }
					        });
					      }
					   }
					</script>
				</div>
				<div class="idPos"><button type="button" data-toggle="modal" data-target="#StudyAreaUpload"  class="btn"><i title="Click Upload Problem/Question"  class="fa fa-upload" id="fa" aria-hidden="true"></i></button></div>
				<div class="idPos"><button type="button" data-toggle="modal" data-target="#coding" class="btn"><i title="Click Write n Upload Your Code"  class="fa fa-code" id="fa" aria-hidden="true"></i></button></div>

			</div>
			<br>
			<div class="bodyStudyArea" id="#load_data"></div>
			<!-- <div style="display: flex;"><div class="next"></div><div class="prev"></div></div> -->
			<span id="load_data_respsonse"></span>
			
			<script >
				// loadStudyArea(1,7);
$(document).ready(function(){

 var limit = 7;
 var start = 0;
 var action = 'inactive';
 
// console.log("preparing to load data");
 if(action == 'inactive')
 {
  action = 'active';
  // console.log("loading data now...")
  load_country_data(limit, start);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 1000);
  }
 });
 
});
function load_country_data(limit, start){
  const constant=7;

  $.ajax({
   url:"./model/asifundeSonke.php",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
   	// console.log(data+" : Data info ");
    $('.bodyStudyArea').append(data);
    if(data == '')
    {
     $('#load_data_respsonse').html("<button type='button' class='btn btn-dark' style='width:100%;padding:2px 2px;color:#45f3ff;'>No Data Found</button>");
     action = 'active';
    }
    else
    {
     $('#load_data_respsonse').html("<button style='width:100%;padding:2px 2px;color:#45f3ff;' onclick='load_country_data("+(limit+constant)+","+(start+constant)+")' type='button' class='btn btn-dark;'>Load More</button>");
     action = "inactive";
    }
   }
  });
 }
</script>

		<?php
	}
	public function goToStart(array $userInfo):void{
	    if(isset($_GET['apply'])||isset($_GET['home'])){
	        ?>
        		<style>
        		    .foApply{
        		        width:100%;
        		        text-align:left;
        		        color:#45f3ff;
        		        margin-top:7%;
        		        
        		    }
        		    .appBtn{
        		    	background:#45f3ff;
        		    	color:purple;
        		    	border: purple;
        		    }
        		    .appBtn:hover{
        		    	background:purple;
        		    	color:#45f3ff;
        		    	border:#45f3ff;
        		    }
        		    h2,p,h5{
        		    	color:#45f3ff;
        		    }
        		</style>
        		<div class="foApply">
        		    <ul>
        		        <li>
        		           <h6>By Applying using this application System, you will apply to all universities of your choice with just one application process and be able to track application status, update application information, and accept firm offers.</h6> 
        		        </li>
        		        <li>
        		           <h6>Exciting part about netchatsa is that you do not have to worry about funding application. The app will take care of it. NSFAS and other Funding Applications will be based on the select Courses as your choice of study. They will be displayed below your tertiary applications statuses.</h6> 
        		        </li>
        		    </ul>
        		</div>
        		<style>
        	        #acho-date{
        	            text-align: center;
                      font-size: 100px;
                      margin-top: 0px;
        	        }
        	        #acho-date #d{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #h{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #m{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #d{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #m{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	        #acho-date #s{
        	            border:2px solid #45f3ff;
        	            font-size:25px;
        	            box-shadow: 0 3px 10px rgb(0 0 0 / 1.8);
        	        }
        	    </style>
        	    
        		<h5>
        		    2023/2024 Tertiary Applications including NSFAS & Bursary Applications:
        		    <br>Opening Date: 20 January 2023
        		    <br>Closing date: 30 July 2023
        		</h5>
        		<h4 style='color:red;'>Applications are now Closed :</h4> <!--<p id="acho-date">30 July 2023</p>-->
        		<p style='color:red;'>
        		    Applications are only open for Testing|Jusging by MTN AWARDS Competition.
        		 </p>
        		    <h4 style='color:#45f3ff;'>JUDGES PLEASE NOTE:</h4>
        		<p style='color:red;'>
        		    <span style='color:#45f3ff;'>Tertiary Applications</span> is the only feature that is entering this competition. 
        		    Feel free to test other features, But know that the <span style='color:#45f3ff;'>Tertiary Applications</span> is the only feature sent to represent us. Feature (<span style='color:#45f3ff;'>Matric Upgrade</span>, <span style='color:#45f3ff;'>High School Self Learning</span> and <span style='color:#45f3ff;'>Tertiary Self Learning</span> are currently fully active for production testing to only privately selected users).
        		</p>
        		<button class="btn appBtn" id="beginAppProcess" onclick="beginAppProcess()" >APPLY ( <span style="color:green;">OPEN</span>)</button>
        		<script>
        </script>
        		<?php
	    }
	}
	public function firstStep(array $userInfo):void{
		?>
		<style>.flex{display:flex;}</style>
		<div class="schoolResults">
			<div class="macMalow">
				<h2>Enter School Results below</h2>
				<h5>NB: <small style="color:red;">to qualify you must have atleast 60%</small></h5>
			</div>
			<hr>
			<div class="grade">
				<h5>Select Grade Level</h5>
				<select id="grdlevel" required>
					<option value="">--select Grade Level--</option>
					<option value="0">Current Gr12</option>
					<option value="1">Post Gr12</option>
				</select>
				<div id="grd" hidden></div>
				<h5>Enter Number Of Subject</h5>
				<input type="number" id="numOfSubj" max="10" min="7" placeholder="enter number of subjects" required>
				<div id="num" hidden></div>
				<span><br>cvb</span>
			</div>
			<hr>
			<center>
				<div class="topicId flex">
					<div class="leftTf"><h5>Subject</h5></div>
					<div class="centerTf"><h5>Score</h5></div>
					<div class="rightTf"><h5>Perc%</h5></div>

				</div>
			</center>


			<div class="flexMatch ">
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects1" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects1Error" hidden></div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark1" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark1Error" hidden></div>
					</div>

					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark11" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark11Error" hidden></div>
					</div>
				</div>
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects2" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects2Error" hidden></div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark2" min="0" max="10" placeholder="7">
							
						</div>
						<div id="levelMark2Error" hidden></div>
					</div>

					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark22" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark22Error" hidden></div>
					</div>
				</div>
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects3" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects3Error" hidden></div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark3" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark3Error" hidden></div>
					</div>
					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark33" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark33Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects4" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects4Error" hidden></div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark4" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark4Error" hidden></div>
					</div>

					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark44" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark44Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects5" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects5Error" hidden></div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark5" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark5Error" hidden></div>
					</div>

					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark55" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark55Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects6" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects6Error" hidden></div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark6" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark6Error" hidden></div>
					</div>

					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark66" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark66Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects7" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
						<div id="subjects7Error" hidden></div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark7" min="0" max="10" placeholder="7">
						</div>
						<div id="levelMark7Error" hidden></div>
					</div>

					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark77" min="0" max="100" placeholder="95">
						</div>
						<div id="levelMark77Error" hidden></div>
						
					</div>
				</div>
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects8" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark8" min="0" max="10" placeholder="7">
						</div>
					</div>

					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark88" min="0" max="100" placeholder="95">
						</div>
						
					</div>
				</div>
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects9" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark9" min="0" max="10" placeholder="7">
						</div>
					</div>

					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark99" min="0" max="100" placeholder="95">
						</div>
						
					</div>
				</div>
				<div class="flex">
					<div class="Ieleft">
						<div class="subjects">
							<select id="subjects10" required>
								<option value="">-- Select your Subject --</option>
								<?php $this->getMatricSubjects();?>
							</select>
						</div>
					</div>
					<div class="Iecenter">
						<div class="marks">
							<input type="number" id="levelMark10" min="0" max="10" placeholder="7">
						</div>
					</div>

					<div class="Ieright">
						<div class="marks">
							<input type="number" id="levelMark1010" min="0" max="100" placeholder="95">
						</div>
					</div>
				</div>
				<br>
				<div class="submitBtn">
					<button class="btn" id="step1Btn" onclick="step1Btn()">Submit</button>
				</div>
				<br>
			</div>
			<div class="errorCatch" hidden=""></div>
		</div>
		<?php
	}
	public function getMatricSubjects(){
		global $conn;
		$sql="select*from matricsubjects";
		$response=$this->getAllDataSafely($sql,"",[])??[];
		// print_r($response);
		foreach($response as $row) { 
			?>
			<option value="<?php echo $row["subj_id"]; ?>"><?php echo $row["subject"]; ?></option>
			<?php
		}
	}
	protected function rinsaNgamansiKphela(string $mess){
		$mess = str_replace('<', "?", $mess);
		$mess = str_replace('>', "?", $mess);
		$mess = str_replace("\\r\\n", "<br>", $mess);
		$mess = str_replace("\\n\\r", "<br>", $mess);
		$mess = str_replace("\\r", "<br>", $mess);
		$mess = str_replace("\\n", "<br>", $mess);
		$mess = str_replace("\r\n", "<br>", $mess);
		$mess = str_replace("\n\r", "<br>", $mess);
		$mess = str_replace("\r", "<br>", $mess);
		$mess = str_replace("\n", "<br>", $mess);
		$mess = str_replace("\\", " ", $mess);
		$mess = str_replace("'", "`", $mess);
		$mess = str_replace('"', "``", $mess);
		return $mess;
	}
	public function OMO(string $string){
		return $this->rinsaNgamansiKphela(
			mysqli_escape_string(
				$this->connection,$string
			)
		);
	}
	public function fakaIsifundoEsishaSasenyuvesi(string $select_module_2_reg="",string $level_module="",string $my_id=""):array{
		$vavaStudentInfo=$this->getStudentGradeIfExists($my_id,"tertiary")??[];
		$student_id=$vavaStudentInfo['id'];
		$sql="insert into sgelamodulestudent(student_id,my_id,module,level,year,reg_date)values(?,?,?,?,year(NOW()),NOW())";
		$params =[$student_id,$my_id,$select_module_2_reg,$level_module];
		$strParams="ssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}

	}
	public function fetchMatricUpgradeContent(int $subj=0,int $chapter=0,int $term=0,int $start=0,int $limit=0):array{
	    $params=[$subj,$chapter,$term,$start,$limit];
	    $sql="select*from matric_rewrite_subj_content where subject=? and chapter=? and term=? limit ?,?";
	    $strParams="sssss";
	    return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	private function testingUpdater(int $level=0,bool $isStarted=false, string $my_id=""):array{
		$sql="";
		$params=[];
		$stringSetter="";
		if(!$isStarted){
			$sql="insert into testing(my_id,level,year,time_started,date_started)values(?,?,year(NOW()),time(NOW()),NOW())";

			$params=[$my_id,$level];
			$stringSetter="ss";
		}
		else{
			$sql="update testing set level=? where my_id=?";
			$params=[$level,$my_id];
			$stringSetter="ss";
		}
		$response=$this->postDataSafely($sql,$stringSetter,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function updateLevelVAVA(string $updateLevelVAVA="",string $my_id="",string $status="tertiary"):array{
    	$sql="update sgela set level=? where my_id=? and status=?";
    	$params=[$updateLevelVAVA,$my_id,$status];
	  	$strParams="sss";
	  	$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
    }
	public function hambisaKwisgabaSokuQala($grdlevel,$subjects1,$levelMark1,$levelMark11,$subjects2,$levelMark2,$levelMark22,$subjects3,$levelMark3,$levelMark33,$subjects4,$levelMark4,$levelMark44,$subjects5,$levelMark5,$levelMark55,$subjects6,$levelMark6,$levelMark66,$subjects7,$levelMark7,$levelMark77,$subjects8,$levelMark8,$levelMark88,$subjects9,$levelMark9,$levelMark99,$subjects10,$levelMark10,$levelMark1010,$total,$subj,array $cur_user_row=[]):array{
		$year=date("Y");
		$date=date("Y-m-d");
		$time=date("H:i:s");
		$my_id=$cur_user_row['my_id'];
		$applicationid=md5($my_id);
		$average=$total/$subj;
		$sql="insert into step1(std_id,
								applicationid,
								avrg,
								grdlevel,
								numofsubj,
								subjects1,
								levelmark1,
								levelmark11,
								subjects2,
								levelmark2,
								levelmark22,
								subjects3,
								levelmark3,
								levelmark33,
								subjects4,
								levelmark4,
								levelmark44,
								subjects5,
								levelmark5,
								levelmark55,
								subjects6,
								levelmark6,
								levelmark66,
								subjects7,
								levelmark7,
								levelmark77,
								levelmark88,
								levelmark99,
								levelmark1010,
								subjects8,
								subjects9,
								subjects10,
								levelmark8,
								levelmark9,
								levelmark10,
								year_started,
								date_started,
								time_started)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,year(NOW()),NOW(),time(NOW()))";
		$params=[$my_id,$applicationid,$average,$grdlevel,$subj,$subjects1,$levelMark1,$levelMark11,$subjects2,$levelMark2,$levelMark22,$subjects3,$levelMark3,$levelMark33,$subjects4,$levelMark4,$levelMark44,$subjects5,$levelMark5,$levelMark55,$subjects6,$levelMark6,$levelMark66,$subjects7,$levelMark7,$levelMark77,$levelMark88,$levelMark99,$levelMark1010,$subjects8,$levelMark9,$subjects10,$levelMark8,$levelMark9,$levelMark10];		
		$string="sssssssssssssssssssssssssssssssssss";
		$responseLocal=$this->postDataSafely($sql,$string,$params);
		//print_r($responseLocal);
		if(is_numeric($responseLocal)){
			$response=$this->testingUpdater(1,false,$my_id);
			//print_r($response);echo'<br>------';
			if($response['response']=="S"){
				return array("response"=>"S","data"=>$responseLocal);
			}
			else{
				return array("response"=>"F","data"=>$response['data']);
			}
		}
	}
	protected function getLevelOfApplication(string $my_id){
		$sql="select level from testing where my_id=?";
		return $this->getAllDataSafely($sql,"s",[$my_id])[0]['level']??"";
	}
	public function goToLevelApplication(array $array,array $data):void{
		$level=$this->getLevelOfApplication($array['my_id']);
		if($level==1){
			$this->step2($data);
		}
		elseif($level==2){
			$this->step3($data);
		}
		elseif($level==3){
			$this->step4($data);
		}
		elseif($level==4){
			$this->step5($data);
		}
		elseif($level==5){
			$this->step6($data);
		}
		elseif($level==6){
		
			$this->step7($data);
		}
		elseif($level==7){
			$this->step8($data);
		}
		elseif($level==8){
			$this->step9($data);
		}
		elseif($level==9){
			$this->step10($data);
		}
		else{
			echo"CAN'T GO PAST THIS POINT";
		}
	}
	protected function step2($array){
		?>
			<div class="step2">
				<div class="headerWarner">
					<h2>Personal Details(Step:2)</h2>
				</div>
				<div class="personalDetails">
					<div class="info flex">
						<div class="div"><h6>South African?</h6></div>
						<div class="div2">
							<select id="sa" >
								<option value="">-- --</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>
					<div class="foreign flex" hidden>
						<div class="text">Passport Number : </div>
						<div class="input_mac">
							<input type="text" id="passport" placeholder="Enter Passport Number" required="">
						</div>
					</div>
					<div class="southafrican flex" hidden> 
						<div class="text">SA ID Number : </div>
						<div class="input_mac">
							<input type="number" maxlength="13" minlength="13" id="idNumber" placeholder="Enter SA ID Number" required="">
						</div>
					</div>
					<div class="errorMessage" hidden ></div>
				</div>
				<hr>
				<div class="headerWarner">
					<h2>Continue(Step:2)..</h2>
				</div>

				<div class="personalDetails">
					<div class="info1">
						<div class="myPerso flex">
							<div class="left">Gender</div>
							<div class="right">
							    <label class="label">Gender</label>
							    <select id="gender" required><option value=""> -- Please Select -- </option><option value="male">Male</option><option value="Female">Female</option></select></div>
						</div>
						<div id="errorgender" hidden></div>
						<div class="myPerso flex">
							<div class="left">Date Of Birth</div>
							<div class="right">
							    <label class="label">date of birth</label>
							    <input type="date" id="dob" required="" placeholder="date of birth"></div>
						</div>
						<div id="errordob" hidden></div>
						<div class="myPerso flex">
							<div class="left">title</div>
							<div class="right">
							    <label class="label">title</label>
							    <select id="title" required=""><option value=""> -- Please select -- </option><option value="Mr"> Mr</option><option value="Mrs"> Mrs</option><option value="Dr"> Dr</option><option value="Ms"> Ms</option><option value="Prof"> Prof</option><option value="Miss"> Miss</option></select></div>
						</div>
						<div id="errortitle" hidden></div>
						<div class="myPerso flex">
							<div class="left">initials</div>
							<div class="right">
							    <label class="label">initials</label>
							    <input type="text" id="initials" required="" placeholder="Enter Initials"></div>
						</div>
						<div id="errorinitials" hidden></div>
						<div class="myPerso flex">
							<div class="left">Surname</div>
							<div class="right">
							    <label class="label">Surname</label>
							    <input type="text" id="lname" required="" placeholder="Enter Surname"></div>
						</div>
						<div id="errorlname" hidden></div>
						<div class="myPerso flex">
							<div class="left">First Name</div>
							<div class="right">
							    <label class="label">First Name</label>
							    <input type="text" id="fname" required="" placeholder="Enter First Name"></div>
						</div>
						<div id="errorfname" hidden></div>
						<div class="myPerso flex">
							<div class="left">Marital Status</div>
							<div class="right">
							    <label class="label">Marital Status</label>
							    <select id="status" required><option value=""> -- Please Select -- </option><option value="married">Married</option><option value="divorced">Divorced</option><option value="divorced">Single</option></select></div>
						</div>
						<div id="errorstatus" hidden></div>
						<div class="myPerso flex">
							<div class="left">Home Language</div>
							<div class="right">
							    <label class="label">Home Language</label>
							    <select id="hlang" required><option value=""> -- Please Select--</option><?php $this->getAllLanguages();?></select></div>
						</div>
						<div id="errorhlang" hidden></div>
						<div class="myPerso flex">
							<div class="left">Ethnic Group</div>
							<div class="right">
							    <label class="label">Ethnic Group</label>
							    <select id="EthnicGroup" required><option value=""> -- Please Select</option><option value="black">Black</option><option value="white">White</option><option value="coloured">Coloured</option><option value="other">Other</option></select></div>
						</div>
						<div id="errorEthnicGroup" hidden></div>
						<div class="myPerso flex">
							<div class="left">Are You Employed?</div>
							<div class="right">
							    <label class="label">Are You Employed?</label>
							    <select id="Employed" required><option value=""> -- Please Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>
						</div>
						<div id="errorEmployed" hidden></div>
						<div class="myPerso flex">
							<div class="left">Where did you hear about us?</div>
							<div class="right">
							    <label class="label">Where did you hear about us?</label>
							    <select id="hear" required><option value="netchatsa"> Netchatsa</option></select></div>
						</div>
						<div id="errorhear" hidden></div>
						<div class="myPerso flex">
							<div class="left">Is Bursary Required</div>
							<div class="right">
							    <label class="label">Is Bursary Required</label>
							    <select id="bursary" required><option value=""> -- Please Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>
						</div>
						<div id="errorbursary" hidden></div>
						
					</div>
				</div>
				<hr>
				<!-- <button id="do">dlknjn</button> -->
				<div class="personalDetails">
					<div class="info1">
						<button id="_1_" type="submit" class="btn submitStep2" onclick="submitStep2('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submit</button>
					</div>


				</div>
				<div class="errorCatch2" hidden></div>
			</div>
			<script>
				$(document).ready(function(){
					$('#sa').on('change', function() {
					  const sa=$("#sa").val();
					  if(sa=="Yes"){
					  	$(".southafrican").removeAttr("hidden");
					  	$(".foreign").attr("hidden","true");
					  }
					  else if(sa=="No"){
					  	$(".foreign").removeAttr("hidden");
					  	$(".southafrican").attr("hidden","true");
					  }
					  else{
					  	$(".foreign").attr("hidden","true");
						$(".southafrican").attr("hidden","true");
					  }
					});
				});
				function submitStep2(app_idStep2,my_id){
					const gender=$("#gender").val();
					const dob=$("#dob").val();
					const title=$("#title").val();
					const initials=$("#initials").val();
					const lname=$("#lname").val();
					const fname=$("#fname").val();
					const status=$("#status").val();
					const hlang=$("#hlang").val();
					const ethnicGroup=$("#EthnicGroup").val();
					const employed=$("#Employed").val();
					const hear=$("#hear").val();
					const bursary=$("#bursary").val();
					const sa=$("#sa").val();
					var id_num=0;
					var nationality= "";
				  	if(sa=="Yes"){
				  		id_num=$("#idNumber").val();
				  		nationality="South African";
				  	}
				  	if(sa=="No"){
				  		id_num=$("#passport").val();
				  		nationality="foreign nationality";
				  	}
				  	if(sa==""){
				  		$(".errorMessage").removeAttr("hidden").attr("style","color:red;").html("Required**");
				  	}
					else if(gender==""){
						$("#errorgender").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(dob==""){
						$("#errordob").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(title==""){
						$("#errortitle").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(initials==""){
						$("#errorinitials").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(lname==""){
						$("#errorlname").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(fname==""){
						$("#errorfname").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(status==""){
						$("#errorstatus").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(hlang==""){
						$("#errorhlang").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(ethnicGroup==""){
						$("#errorEthnicGroup").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(employed==""){
						$("#errorEmployed").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(hear==""){
						$("#errorhear").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else if(bursary==""){
						$("#errorbursary").removeAttr("hidden").attr("style","color:red").html("Required**");
					}
					else{
						$.ajax({
			                url:'./controller/ajaxCallProcessor.php',
			                type:'post',
			                data:{
								gender:gender,
								dob:dob,
								title:title,
								initials:initials,
								lname:lname,
								fname:fname,
								status:status,
								hlang:hlang,
								ethnicGroup:ethnicGroup,
								employed:employed,
								hear:hear,
								bursary:bursary,
								id_num:id_num,
								nationality:nationality,
								app_idStep2:app_idStep2,
								my_id:my_id
			                },
			                success:function(e){
			                    if(e.length>1){
			                        $(".submitStep2").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
			                    }
			                    else{
			                         $(".submitStep2").html("Data Submitted Successfully please wait, redirecting...");
			                         loader("apply");
			                    }
			                    
			                }
			            });
					}

				}
			</script>
		<?php
	}
	protected function getAllPostalCodes(){
		$sql="select*from postaldb";
		$response=$this->getAllDataSafely($sql,"",[])??[];
		foreach($response as $row){
			$a=$row["suburb"]." : ".$row['code'];
			?>
			<option value="<?php echo $a;?>"><?php echo $a;?></option>
			<?php
		}
	}
	protected function getAllLanguages(){
		$sql="select*from languages";
		$response=$this->getAllDataSafely($sql,"",[])??[];
		foreach($response as $row){
			?>
			<option value="<?php echo $row['id'];?>"><?php echo $row['lang'];?></option>
			<?php
		}
	}
	protected function step3($array){
		?>
		<div class="step2"><!--step 3-->
			<div class="headerWarner">
				<h2>Residental Information(Step:3/17)</h2>
			</div>
			<hr>
			
			<div class="personalDetails">
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Street Name</div>
						<div class="right">
						    <label class="label">Street Name</label>
						    <input type="address" id="street" placeholder="Enter Street Name"></div>
					</div>
					<div id="errorstreet" hidden></div>
					<div class="myPerso flex">
						<div class="left">Suburb Name</div>
						<div class="right">
						    <label class="label">Suburb Name</label>
						    <input type="address" id="suburb" required="" placeholder="Enter Suburb Name"></div>
					</div>
					<div id="errorsuburb" hidden></div>
					<div class="myPerso flex">
						<div class="left">Town Name</div>
						<div class="right">
						    <label class="label">Town Name</label>
						    <input type="address" id="town" placeholder="Enter Town Name"></div>
					</div>
					<div id="errortown" hidden></div>
					<div class="myPerso flex">
						<div class="left">Province Name</div>
						<div class="right">
						    <label class="label">Province Name</label>
						    <select id="province" required="" placeholder="Enter Province Name">
						        <option value=""> -- Select Province -- </option>
						        <option value="KwaZulu-Natal"> KwaZulu-Natal </option>
						        <option value="Western Cape"> Western Cape </option>
						        <option value="Northen Cape"> Northen Cape </option>
						        <option value="North West"> North West </option>
						        <option value="Limpopo"> Limpopo </option>
						        <option value="Mpumalanga"> Mpumalanga </option>
						        <option value="Free States"> Free States </option>
						        <option value="Gauteng"> Gauteng </option>
						        <option value="Eastern Cape"> Eastern Cape </option>
						    </select>
					    </div>
					</div>
					<div id="errorprovince" hidden></div>
					<div class="myPerso flex">
						<div class="left">Postal Code</div>
						<div class="right">
						    <label class="label">Postal Code</label>
						    <select id="postal" required=""><option value="">-- Select Postal Code --</option><?php $this->getAllPostalCodes();?></select></div>
						
					</div>
					<h6 style='color:red;'>Can't find your Postal? Send us your proof of resident via WhatsApp(068 515 3023) so we can fix Error.</h6>
					<div id="errorpostal" hidden></div>	
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>Contact Details</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Phone Number</div>
						<div class="right">
						    <label class="label">Phone Number</label>
						    <input type="number" id="phone" placeholder="Enter Cell Phone Number"></div>
					</div>
					<div id="errorphone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Telephone</div>
						<div class="right">
						    <label class="label">Telephone</label>
						    <input type="number" id="telephone" placeholder="Enter Telephone Number"></div>
					</div>
					<div id="errortelephone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Email Address</div>
						<div class="right">
						    <label class="label">Email Address</label>
						    <input type="email" id="email" placeholder="Enter Email Address"></div>
					</div>
					<div id="errortelephone" hidden></div>
					
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>Disability & Residents information</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Do you want to apply for Resident?</div>
						<div class="right flex">
						    <label class="label">Do you want to apply for Resident?</label>
						    <select id="res" required=""><option value="">-- Do you want to apply for Resident? -- </option><option value="yes">Yes</option><option value="no">No</option></select></div>
					</div>
					<div id="errorres" hidden></div>
					<div class="myPerso flex">
						<div class="left">Do you have Disabilities/impairment?</div>
						<div class="right flex">
						    <label class="label">Do you have Disabilities/impairment?</label>
						    <select id="dis" required=""><option value="">-- Do you have Disabilities/impairment? -- </option><option value="yes">Yes</option><option value="no">No</option></select></div>
					</div>
					<div id="errordis" hidden></div>
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<div class="info1">
					<button id="_3_" type="submit" class="btn" onclick="submitStep3('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submit</button>
				</div>
			</div>
			<div class="errorCatch3" hidden></div>
		</div>
		<script>
// 			function submitStep3(studedentApplicationId,my_id_step3){
// 				// $("#_3_").attr("disabled","true");
// 				const street=$("#street").val();
// 				const suburb=$("#suburb").val();
// 				const town=$("#town").val();
// 				const province=$("#province").val();
// 				const postal=$("#postal").val();
// 				const phone=$("#phone").val();
// 				const telephone=$("#telephone").val();
// 				const email=$("#email").val();
// 				const res=$("#res").val();
// 				const dis=$("#dis").val();
// 				console.log(street+" "+suburb+" "+town+" "+province+" "+postal+" "+phone+" "+telephone+" "+email+" "+res+" "+dis);
// 				$("#errorstreet").attr("hidden","true");
// 				$("#errorsuburb").attr("hidden","true");
// 				$("#errortown").attr("hidden","true");
// 				$("#errorprovince").attr("hidden","true");
// 				$("#errorpostal").attr("hidden","true");
// 				$("#errorphone").attr("hidden","true");
// 				$("#errortelephone").attr("hidden","true");
// 				$("#errortelephone").attr("hidden","true");
// 				$("#errorres").attr("hidden","true");
// 				$("#errordis").attr("hidden","true");
// 				$(".errorCatch3").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
// 				if(street==""){
// 					$("#errorstreet").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(suburb==""){
// 					$("#errorsuburb").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(town==""){
// 					$("#errortown").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(province==""){
// 					$("#errorprovince").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(postal==""){
// 					$("#errorpostal").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(phone==""){
// 					$("#errorphone").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(telephone==""){
// 					$("#errortelephone").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(email==""){
// 					$("#errortelephone").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(res==""){
// 					$("#errorres").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else if(dis==""){
// 					$("#errordis").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 				}
// 				else{
// 					$.ajax({
// 		                url:'./controller/ajaxCallProcessor.php',
// 		                type:'post',
// 		                data:{
// 							street:street,
// 							suburb:suburb,
// 							town:town,
// 							province:province,
// 							postal:postal,
// 							phone:phone,
// 							telephone:telephone,
// 							email:email,
// 							res:res,
// 							dis:dis,
// 							studedentApplicationId:studedentApplicationId,
// 							my_id_step3:my_id_step3
// 		                },
// 		                success:function(e){
// 		                	console.log(e);
// 		                    if(e.length>1){
// 		                    	$("#_3_").removeAttr("disabled");
// 		                        $(".errorCatch3").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
// 		                    }
// 		                    else{
// 		                         $(".errorCatch3").html("Data Submitted Successfully please wait, redirecting...");
// 		                         loader("apply");
// 		                    }
		                    
// 		                }
// 		            });
// 				}
// 			}
		</script>
		<?php
		
	}
	protected function step4($array){
		?>
		<div class="step2"><!--step 4-->
			<div class="headerWarner">
				<h2>Guardian Details(Step:4/17)</h2>
			</div>
			<hr>
			
			<div class="personalDetails">
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Guardian First Name`s</div>
						<div class="right">
						    <label class="label">Guardian First Name`s</label>
						    <input type="text" id="fname" placeholder="Enter Guardian First Name"></div>
					</div>
					<div id="errorfname" hidden></div>
					<div class="myPerso flex">
						<div class="left">Guardian Last Name</div>
						<div class="right">
						    <label class="label">Guardian Last Name</label>
						    <input type="text" id="lname" required="" placeholder="Enter Guardian Last Name"></div>
					</div>
					<div id="errorlname" hidden></div>
					<div class="myPerso flex">
						<div class="left">Relationship</div>
						<div class="right">
						    <label class="label">Relationship</label>
						    <select id="relationship" required=""><option value="">-- Select Option --</option><option value="Mother">Mother</option><option value="Father">Father</option><option value="Aunty">Aunty</option><option value="Uncle">Uncle</option><option value="Gogo">Gogo</option><option value="Mkhulu">Mkhulu</option></select></div>
					</div>
					<div id="errorrelationship" hidden></div>
					<div class="myPerso flex">
						<div class="left">Guardian is Employed?</div>
						<div class="right">
						    <label class="label">Guardian is Employed?</label>
						    <select id="employed" required=""><option value="">-- Select Option --</option><option value="Yes">Yes</option><option value="No">No</option></select></div>
					</div>
					<div id="erroremployed" hidden></div>	
					<div class="myPerso flex">
						<div class="left">Phone Number</div>
						<div class="right">
						    <label class="label">Phone Number</label>
						    <input type="number" id="phone" required="" placeholder="Enter Phone Number" maxlength="10" minlength="10"></div>
					</div>
					<div id="errorphone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Altenative Phone Number</div>
						<div class="right">
						    <label class="label">Altenative Phone Number</label>
						    <input type="number" id="alphone" required="" placeholder="Enter Altenative Phone Number" maxlength="10" minlength="10"></div>
					</div>
					<div id="erroralphone" hidden></div>
					<div class="myPerso flex">
						<div class="left">Email Address</div>
						<div class="right">
						    <label class="label">Email Address</label>
						    <input type="email" id="email" required="" placeholder="Enter email address" ></div>
					</div>
					<div id="erroremail" hidden></div>
					
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>Guardian Postal Address</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Street Name</div>
						<div class="right">
						    <label class="label">Street Name</label>
						    <input type="address" id="street" placeholder="Enter Street Name"></div>
					</div>
					<div id="errorstreet" hidden></div>
					<div class="myPerso flex">
						<div class="left">Suburb Name</div>
						<div class="right">
						    <label class="label">Suburb Name</label>
						    <input type="address" id="suburb" required="" placeholder="Enter Suburb Name"></div>
					</div>
					<div id="errorsuburb" hidden></div>
					<div class="myPerso flex">
						<div class="left">Town Name</div>
						<div class="right">
						    <label class="label">Town Name</label>
						    <input type="address" id="town" placeholder="Enter Town Name"></div>
					</div>
					<div id="errortown" hidden></div>
					<div class="myPerso flex">
						<div class="left">Province Name</div>
						
						<div class="right">
						    <label class="label">Province Name</label>
						    
						     <select id="province" required="" placeholder="Enter Province Name">
						        <option value=""> -- Select Province -- </option>
						        <option value="KwaZulu-Natal"> KwaZulu-Natal </option>
						        <option value="Western Cape"> Western Cape </option>
						        <option value="Northen Cape"> Northen Cape </option>
						        <option value="North West"> North West </option>
						        <option value="Limpopo"> Limpopo </option>
						        <option value="Mpumalanga"> Mpumalanga </option>
						        <option value="Free States"> Free States </option>
						        <option value="Gauteng"> Gauteng </option>
						        <option value="Eastern Cape"> Eastern Cape </option>
						    </select>
						</div>
					</div>
					<div id="errorprovince" hidden></div>
					<div class="myPerso flex">
						<div class="left">Postal Code</div>
						<div class="right">
						    <label class="label">Postal Code</label>
						    <select id="postal" required=""><option value="">-- Select Postal Code --</option><?php $this->getAllPostalCodes();?></select></div>
						
					</div>
					<h6 style='color:red;'>Can't find your Postal? Send us your proof of resident via WhatsApp(068 515 3023) so we can fix Error.</h6>
					<div id="errorpostal" hidden></div>	
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<div class="info1">
					<button id="_4_" type="submit" class="btn" onclick="submitStep4('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submitd</button>
				</div>
			</div>
			<div class="errorCatch4" hidden></div>
		</div>
		<script>
// 			function submitStep4(applicationidStep4,my_id_step4){
// 				const fname=$("#fname").val();
// 				const lname=$("#lname").val();
// 				const relationship=$("#relationship").val();
// 				const employed=$("#employed").val();
// 				const phone=$("#phone").val();
// 				const alphone=$("#alphone").val();
// 				const email=$("#email").val();
// 				const street=$("#street").val();
// 				const suburb=$("#suburb").val();
// 				const town=$("#town").val();
// 				const province=$("#province").val();
// 				const postal=$("#postal").val();
// 				// $("#_4_").attr("disabled","true");
// 				$(".errorCatch4").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
// 				if(fname==""){
// 					$("#errorfname").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(lname==""){
// 					$("#errorlname").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(relationship==""){
// 					$("#errorrelationship").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(employed==""){
// 					$("#erroremployed").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(phone==""){
// 					$("#errorphone").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(alphone==""){
// 					$("#erroralphone").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(email==""){
// 					$("#erroremail").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(street==""){
// 					$("#errorstreet").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(suburb==""){
// 					$("#errorsuburb").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(town==""){
// 					$("#errortown").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(province==""){
// 					$("#errorprovince").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else if(postal==""){
// 					$("#errorpostal").removeAttr("hidden").attr("style","color:red").html("Required**");
// 					$(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_4_").removeAttr("disabled");
// 				}
// 				else{
// 					console.log(fname+" "+lname+" "+relationship+" "+employed+" "+phone+" "+alphone+" "+email+" "+street+" "+suburb+" "+town+" "+province+" "+postal+" "+applicationidStep4+" "+my_id_step4);
// 					$.ajax({
// 		                url:'./controller/ajaxCallProcessor.php',
// 		                type:'post',
// 		                data:{

// 							fname:fname,
// 							lname:lname,
// 							relationship:relationship,
// 							employed:employed,
// 							phone:phone,
// 							alphone:alphone,
// 							email:email,
// 							street:street,
// 							suburb:suburb,
// 							town:town,
// 							province:province,
// 							postal:postal,
// 							applicationidStep4:applicationidStep4,
// 							my_id_step4:my_id_step4
// 		                },
// 		                success:function(e){
// 		                	console.log(e);
// 		                    if(e.length>1){
// 		                    	$("#_4_").removeAttr("disabled");
// 		                        $(".errorCatch4").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
// 		                    }
// 		                    else{
// 		                         $(".errorCatch4").html("Data Submitted Successfully please wait, redirecting...");
// 		                         loader("apply");
// 		                    }
		                    
// 		                }
// 		            });
// 				}
// 			}
			
		</script>
		<?php
	}
	protected function step5($array){
		?>
		<div class="step2"><!--step 3-->
			<div class="headerWarner">
				<h2>High School Details(Step:5/17)</h2>
			</div>
			<hr>
			
			<div class="personalDetails">
				<h2>School Address Details</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">School Name</div>
						<div class="right">
						    <label class="label">Phone Number</label>
							<select id="schoolname" required><option value=""> -- Select School -- </option><?php $this->getAllSchools();?></select>
						</div>
					</div>
					<div id="errorschoolname" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Street Name</div>
						<div class="right">
						    <label class="label">School Street Name</label>
						    <input type="address" id="street" placeholder="School Street Name"></div>
					</div>
					<div id="errorstreet" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Suburb Name</div>
						<div class="right">
						    <label class="label">School Suburb Name</label>
						    <input type="address" id="suburb" required="" placeholder="Enter School Suburb Name"></div>
					</div>
					<div id="errorsuburb" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Town Name</div>
						<div class="right">
						    <label class="label">School Town Name</label>
						    <input type="address" id="town" placeholder="Enter Town Name"></div>
					</div>
					<div id="errortown" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Province Name</div>
						<div class="right">
						    <label class="label">School Province Name</label>
						    
						     <select id="province" required="" placeholder="Enter Province Name">
						        <option value=""> -- Select Province -- </option>
						        <option value="KwaZulu-Natal"> KwaZulu-Natal </option>
						        <option value="Western Cape"> Western Cape </option>
						        <option value="Northen Cape"> Northen Cape </option>
						        <option value="North West"> North West </option>
						        <option value="Limpopo"> Limpopo </option>
						        <option value="Mpumalanga"> Mpumalanga </option>
						        <option value="Free States"> Free States </option>
						        <option value="Gauteng"> Gauteng </option>
						        <option value="Eastern Cape"> Eastern Cape </option>
						    </select>
						 </div>
					</div>
					<div id="errorprovince" hidden></div>
					<div class="myPerso flex">
						<div class="left">School Postal Code</div>
						<div class="right">
						    <label class="label">School Postal Code</label>
						    <select id="postal" required=""><option value="">-- Select Postal Code --</option><?php $this->getAllPostalCodes();?></select></div>
						
					</div>
					<h6 style='color:red;'>Can't find your Postal? Send us your proof of resident via WhatsApp(068 515 3023) so we can fix Error.</h6>
					<div id="errorpostal" hidden></div>		
				</div>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>School Details (cont)...</h2>
				<div class="info1">
					<div class="myPerso flex">
						<div class="left">Completion Year</div>
						<div class="right">
						    <label class="label">Completion Year</label>
						    <select id="yearcompleted" required=""><option value="">-- Select Completion Year -- </option><?php $this->yearCompleted();?></select></div>
					</div>
					<div id="erroryearcompleted" hidden></div>
					<div class="myPerso flex">
						<div class="left">Current Activity</div>
						<div class="right">
						    <label class="label">Current Activity</label>
						    <select id="activity" required=""><option value="">-- Select Current Activity --</option><option value="Mother">Mother</option><option value="Studying">Studying</option><option value="Working">Working</option><option value="Gap Year">Gap Year</option><option value="Attending Court Case">Attending Court Case</option><option value="College">College</option><option value="Universiy">Universiy</option></select></div>
					</div>
					<div id="erroractivity" hidden></div>
					<div class="myPerso flex">
						<div class="left">Any Tertiary Education History?</div>
						<div class="right">
						    <label class="label">Any Tertiary Education History?</label>
						    <select id="eduhistory" required=""><option value="">-- Any Tertiary Education History? --</option><option value="Yes">Yes</option><option value="No">No</option></select></div>
					</div>
					<div id="erroreduhistory" hidden></div>
					<!-- < -->
					<div class="myPerso flex" id="ExtraEdit" hidden>
						<div class="left">University</div>
						<div class="right">
						    <label class="label">University</label>
						    <input type="text" id="uni" placeholder="Enter University Studied At"></div>
					</div>
					<div id="erroruni" hidden></div>
					<div class="myPerso flex"  id="ExtraEdit1" hidden>
						<div class="left">Student Number</div>
						<div class="right">
						    <label class="label">Student Number</label>
						    <input type="number" id="studentnumber" placeholder="Enter Student Number"></div>
					</div>
					<div id="errorstudentnumber" hidden></div>
					<div class="myPerso flex"  id="ExtraEdit2" hidden>
						<div class="left">Completion Status</div>
						<div class="right">
						    <label class="label">Completion Status</label>
						    <select id="statuscompletion" required=""><option value="">-- Select Completion Status --</option><option value="Completed">Completed</option><option value="Studied: Final Year">Studied: Final Year</option><option value="Studied: Second Year">Studied: Second Year</option><option value="Studied: First Year">Studied: First Year</option><option value="Dropped Out">Dropped Out</option><option value="Expelled/Dismissed">Expelled/Dismissed</option><option value="Financial Excluded">Financial Excluded</option></select></div>
					</div>
					<div id="errorstatuscompletion" hidden></div>	
					<!-- < -->
				</div>
			</div>
			<hr>
			<!--  -->
			<div class="personalDetails">
				<div class="info1">
					<button id="_5_" type="submit" class="btn" onclick="submitStep5('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submit</button>
				</div>
			</div>
			<div class="errorCatch5" hidden></div>
		</div>
		<script>
			$(document).ready(function(){
				$("#eduhistory").on("change",function(){
					const d=$("#eduhistory").val();
					if(d=="Yes"){
						$("#ExtraEdit").removeAttr("hidden");
						$("#ExtraEdit1").removeAttr("hidden");
						$("#ExtraEdit2").removeAttr("hidden");
					}
					else{
						$("#ExtraEdit").attr("hidden","true");
						$("#ExtraEdit1").attr("hidden","true");
						$("#ExtraEdit2").attr("hidden","true");
						$("#ExtraEdit").val("");
						$("#ExtraEdit1").val("");
						$("#ExtraEdit2").val("");
					}
				});
			});
// 			function submitStep5(applicationidStep5,my_id_step5){
// 				// $("#_5_").attr("disabled","true");
// 				$(".errorCatch5").removeAttr("hidden").attr("style","background:green;color:#45f3ff;").html("<img src='../../img/processor.gif' style='width:10%;border-radius: 50px;'> <span style='color:#45f3ff;'>Processing your request...</span> ");
// 				const schoolname=$("#schoolname").val();
// 				const street=$("#street").val();
// 				const suburb=$("#suburb").val();
// 				const town=$("#town").val();
// 				const province=$("#province").val();
// 				const postal=$("#postal").val();
// 				const yearcompleted=$("#yearcompleted").val();
// 				const activity=$("#activity").val();
// 				const eduhistory=$("#eduhistory").val();
// 				const uni=$("#uni").val();
// 				const studentnumber=$("#studentnumber").val();
// 				const statuscompletion=$("#statuscompletion").val();
// 				if(schoolname==""){
// 					$("#errorschoolname").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(street==""){
// 					$("#errorstreet").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(suburb==""){
// 					$("#errorsuburb").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(town==""){
// 					$("#errortown").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(province==""){
// 					$("#errorprovince").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(postal==""){
// 					$("#errorpostal").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(yearcompleted==""){
// 					$("#erroryearcompleted").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(activity==""){
// 					$("#erroractivity").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}
// 				else if(eduhistory==""){
// 					$("#erroreduhistory").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 					$(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					$("#_5_").removeAttr("disabled");
// 				}

// 				else{
// 					var bool=true;
// 					if(eduhistory=="Yes"){
// 						if(uni==""){
// 							$("#erroruni").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 							bool=false;
// 						}
// 						else if(studentnumber==""){
// 							$("#errorstudentnumber").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 							bool=false;
// 						}
// 						else if(statuscompletion==""){
// 							$("#errorstatuscompletion").removeAttr("hidden").attr("style","color:red;").html("Required**");
// 							bool=false;
// 						}
// 						else{
// 							bool=true;
// 						}
// 					}
// 					if(bool){
// 						$.ajax({
// 			                url:'./controller/ajaxCallProcessor.php',
// 			                type:'post',
// 			                data:{
// 								applicationidStep5:applicationidStep5,
// 								my_id_step5:my_id_step5,
// 								schoolname:schoolname,
// 								street:street,
// 								suburb:suburb,
// 								town:town,
// 								province:province,
// 								postal:postal,
// 								yearcompleted:yearcompleted,
// 								activity:activity,
// 								eduhistory:eduhistory,
// 								uni:uni,
// 								studentnumber:studentnumber,
// 								statuscompletion:statuscompletion
// 			                },
// 			                success:function(e){
// 			                	console.log(e);
// 			                    if(e.length>1){
// 			                    	$("#_4_").removeAttr("disabled");
// 			                        $(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html(e);
// 			                    }
// 			                    else{
// 			                         $(".errorCatch5").html("Data Submitted Successfully please wait, redirecting...");
// 			                         loader("apply");
// 			                    }
			                    
// 			                }
// 			            });
// 					}
// 					else{
// 						 $(".errorCatch5").attr("style","padding:5px 5px;color:red;width:100%;").html("Required Field**");
// 					}
// 				}
// 			}
		</script>
		<?php
	}
	protected function step6($array){
		// print_r($array);
		$t=false;
		?>
		<div class="step2"><!--step 3-->
			<div class="headerWarner">
				<h2>Documents Upload(Step:6/17)</h2>
			</div>
			<hr>
			<div class="personalDetails">
				<h2>Upload Documents(<span style="color:red;">.PDF<small>format only</small></span>)</h2>
				<div class="info1">
					<div class="myPerso flex" id="_1">
						<div class="left">Certified ID Copy</div>
						<div class="right" id="_1_1">
							<?php  if($this->isUploaded1($array)){
								?>
									<h5 style="color:green;">FILE_ALREADY_UPLOADED.</h5>
									<script>
										$(document).ready(function(){
											$("#_2").removeAttr("hidden");
										});
										
									</script>
								<?php
								$t=true;
							}
							else{
								?>
								    <label class="label">Certified ID Copy</label>
									<input type="file" id="idcopy" name="file" required="" placeholder="upload Your ID Copy"></div>
								<?php
							}
							?>
					</div>
					<div id="erroridcopy" hidden></div>
					<div class="myPerso flex " id="_2" hidden>

						<div class="left">Certified Grade11/Matric Final Results</div>
						<div class="right" id="_2_2">
							<?php if($this->isUploaded2($array)){
								?>
									<h5 style="color:green;">FILE ALREADY UPLOADED.</h5>
									<script>
										$("#_3").removeAttr("hidden");
									</script>
								<?php
							}
							else{
								?>
								    <label class="label">Certified Grade11/Matric Final Results</label>
									<input type="file" id="finalresults" name="file" required="" placeholder="Upload Results"></div>
								<?php
							}
							?>
						
					</div>
					<div id="errorfinalresults" hidden></div>
					<div class="myPerso flex" id="_3" hidden>
						<div class="left">Certified Proof Of Resident</div>
						<div class="right" id="_3_3">
							<?php if($this->isUploaded3($array)){
								?>
									<h5 style="color:green;">FILE ALREADY UPLOADED.</h5>
									<script>
										$("#_4").removeAttr("hidden");
									</script>
								<?php
							}
							else{
								?>
								    <label class="label">Certified Proof Of Resident</label>
									<input type="file" id="proofresident" name="file" required="" placeholder="Upload Proof Of Resident"></div>
								<?php
							}
							?>
					</div>
					<div id="errorproofresident" hidden></div>
					<div class="myPerso flex" id="_4" hidden>
						<div class="left">Certified Guardian ID Copy</div>
						<div class="right" id="_4_4">
							<?php if($this->isUploaded4($array)){
								?>
									<h5 style="color:green;">FILE ALREADY UPLOADED.</h5>
									
								<?php
							}
							else{
								?>
								    <label class="label">Certified Guardian ID Copy</label>
									<input type="file" id="guardianid" name="file" required="" placeholder="Guardian Coppy"></div>
								<?php
							}
							?>
					</div>
					<div id="errorguardianid" hidden></div>
				</div>
			</div>
			<hr>
			<div class="personalDetails" id="_submitFiles" hidden="">
				<div class="info1">
					<button id="_submit_" type="submit" class="btn">Submit</button>
				</div>
			</div>
			<div class="errorCatch5" hidden></div>
		</div>
		<script>
// 			$(document).on('change','#idcopy',function(){
// 				$("#erroridcopy").removeAttr("hidden");
// 				$("#erroridcopy").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

// 				var file=document.getElementById('idcopy').files[0].name;
// 				var form_data=new FormData();
// 				var ext=file.split('.').pop().toLowerCase();
// 				if(jQuery.inArray(ext,['pdf'])==-1){
// 					$("#erroridcopy").removeAttr("hidden");
// 					$("#erroridcopy").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

// 				}
// 				else{
// 					$("#erroridcopy").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
// 					form_data.append("file",document.getElementById("idcopy").files[0]);
// 					$("#erroridcopy").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
// 					form_data.append("erroridcopy","erroridcopy");
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:form_data,
// 						contentType:false,
// 						cache:false,
// 						processData:false,
// 						beforeSend:function(){
// 							$("#erroridcopy").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
// 						},
// 						success:function(e){
// 							console.log(e.length);
// 							if(e.length>2){
// 								$("#erroridcopy").attr("style","color:red;");
// 								$("#erroridcopy").html(" <br>Error 320 : "+e);
// 							}
// 							else{
								
// 								$("#erroridcopy").attr("hidden",true);
// 								$("#_1_1").attr("style","color:green;");
// 								$("#_1_1").html("SUCCESSFULY UPLOADED");
// 								$("#_2").removeAttr("hidden");
								
// 							}
// 						}
// 					});
// 				}
// 			});
// 			$(document).on('change','#finalresults',function(){
// 				$("#errorfinalresults").removeAttr("hidden");
// 				$("#errorfinalresults").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

// 				var file=document.getElementById('finalresults').files[0].name;
// 				var form_data=new FormData();
// 				var ext=file.split('.').pop().toLowerCase();
// 				if(jQuery.inArray(ext,['pdf'])==-1){
// 					$("#errorfinalresults").removeAttr("hidden");
// 					$("#errorfinalresults").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

// 				}
// 				else{
// 					$("#errorfinalresults").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
// 					form_data.append("file",document.getElementById("finalresults").files[0]);
// 					$("#errorfinalresults").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
// 					form_data.append("errorfinalresults","errorfinalresults");
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:form_data,
// 						contentType:false,
// 						cache:false,
// 						processData:false,
// 						beforeSend:function(){
// 							$("#errorfinalresults").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
// 						},
// 						success:function(e){
// 							console.log(e.length);
// 							if(e.length>2){
// 								$("#errorfinalresults").attr("style","color:red;");
// 								$("#errorfinalresults").html(" <br>Error 320 : "+e);
// 							}
// 							else{
								
// 								$("#errorfinalresults").attr("hidden",true);
// 								$("#_2_2").attr("style","color:green;");
// 								$("#_2_2").html("SUCCESSFULY UPLOADED");
// 								$("#_3").removeAttr("hidden");
								
// 							}
// 						}
// 					});
// 				}
// 			});
// 			$(document).on('change','#proofresident',function(){
// 				$("#errorproofresident").removeAttr("hidden");
// 				$("#errorproofresident").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

// 				var file=document.getElementById('proofresident').files[0].name;
// 				var form_data=new FormData();
// 				var ext=file.split('.').pop().toLowerCase();
// 				if(jQuery.inArray(ext,['pdf'])==-1){
// 					$("#errorproofresident").removeAttr("hidden");
// 					$("#errorproofresident").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

// 				}
// 				else{
// 					$("#errorproofresident").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
// 					form_data.append("file",document.getElementById("proofresident").files[0]);
// 					$("#errorproofresident").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
// 					form_data.append("proofresident","proofresident");
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:form_data,
// 						contentType:false,
// 						cache:false,
// 						processData:false,
// 						beforeSend:function(){
// 							$("#errorproofresident").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
// 						},
// 						success:function(e){
// 							console.log(e.length);
// 							if(e.length>2){
// 								$("#errorproofresident").attr("style","color:red;");
// 								$("#errorproofresident").html(" <br>Error 320 : "+e);
// 							}
// 							else{
								
// 								$("#errorproofresident").attr("hidden",true);
// 								$("#_3_3").attr("style","color:green;");
// 								$("#_3_3").html("SUCCESSFULY UPLOADED");
// 								$("#_4").removeAttr("hidden");
								
// 							}
// 						}
// 					});
// 				}
// 			});
// 			$(document).on('change','#guardianid',function(){
// 				$("#errorguardianid").removeAttr("hidden");
// 				$("#errorguardianid").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing File Data...</span></small>");

// 				var file=document.getElementById('guardianid').files[0].name;
// 				var form_data=new FormData();
// 				var ext=file.split('.').pop().toLowerCase();
// 				if(jQuery.inArray(ext,['pdf'])==-1){
// 					$("#errorguardianid").removeAttr("hidden");
// 					$("#errorguardianid").html("<small style='color:red;'>"+ext+" Not Supported. Only Support PDF/pdf Format </small>")

// 				}
// 				else{
// 					$("#errorguardianid").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing File Data...</span></small>");
// 					form_data.append("file",document.getElementById("guardianid").files[0]);
// 					$("#errorguardianid").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting File Data...</span></small>");
// 					form_data.append("guardianid","guardianid");
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:form_data,
// 						contentType:false,
// 						cache:false,
// 						processData:false,
// 						beforeSend:function(){
// 							$("#errorguardianid").html("<img style='width:10%;' src='../../img/processor.gif'><h5 style='color:green;'>UPLOADING..</h5>");
// 						},
// 						success:function(e){
// 							console.log(e.length);
// 							if(e.length>2){
// 								$("#errorguardianid").attr("style","color:red;");
// 								$("#errorguardianid").html(" <br>Error 320 : "+e);
// 							}
// 							else{
								
// 								$("#errorguardianid").attr("hidden",true);
// 								$("#_4_4").attr("style","color:green;");
// 								$("#_4_4").html("SUCCESSFULY UPLOADED");
// 								$("#_submitFiles").removeAttr("hidden");
// 								$("#_submit_").html("<img style='width:8%;' src='../../img/processor.gif'> Navigating to next step...");


// 								loader("apply");
								
// 							}
// 						}
// 					});
// 				}
// 			});
		</script>

		<?php
	}
	protected function step7($array){
		?>
		<style>
			.container .collapse .match{
				margin-top: 2%;
			}
		</style>
		<?php
			$sql="select*from universities order by rand()";
			$response=$this->getAllDataSafely($sql,"",[])??[];
			foreach($response as $row){
			
				$uni_id=$row["id"];
				$uni_name=$row['uni_name'];
				?>
					<div class="container" style="width:100%;margin-top:-10;padding:10px;">
					  <button type="button" style="width:100%;padding: 10px 0;" class="btn btn-info" data-toggle="collapse" data-target="<?php echo "#_".$uni_id;?>"><?php echo $uni_name; ?></button>
					  <div id="<?php echo "_".$uni_id;?>" class="collapse">
							<div class="container match">
								<?php 
								$this->getAllFaculties($uni_id,$uni_name,$array);
								?>
							</div>
					  </div>
					</div>

				<?php
			}
		
	}
	protected function getAllFaculties($uni_id,$uni_name,$array){
		global $conn;
		
		$sql="select*from faculties where uni_id=?";
		$response=$this->getAllDataSafely($sql,"s",[$uni_id]);
		
		if(count($response)==0){
			echo "<h5 style='color:red;'>No faculties Available for ".$uni_name."</h5";
		}
		else{
			foreach($response as $row){
				$faculty_id=$row['faculty_id'];
				$faculty_name=$row["faculty_name"];
				?>
				<button style="width:100%;margin-top:2%;background-color:green;overflow-wrap: break-word;word-wrap: break-word;hyphens: auto;" type="button" class="btn btn-info" data-toggle="collapse" data-target="<?php echo "#_".$faculty_id;?>"><?php echo $faculty_name;?></button>
				<div id="<?php echo "_".$faculty_id;?>" class="collapse">
					<div class="container match" style="width:100%;padding: 5px 0;">
					  <?php
					  $this->courses($uni_id,$uni_name,$faculty_id,$faculty_name,$array);
					  ?>
					</div>
				</div>
				<?php
			}
		}
		
	}
	public function getFacultiesOfUni($uni){
		$sql="select*from faculties where uni_id=?";
		$params=[$uni];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];

	}
	protected function courses($uni_id,$uni_name,$faculty_id,$faculty_name,$array){
		// global $conn;
		?>
		<style>
			.collapse .container .all_combine .left{
				width: 48%;
				padding: 5px;

			}
			.collapse .container .all_combine .right{
				width: 52%;
				padding: 5px;

			}
			.collapse .container .all_combine .left .itm{
				width: 100%;
				padding: 5px 0;
			}
			.collapse .container .all_combine .right .item{
				width: 100%;
				padding: 5px 0;
			}

		</style>
		<?php
		$sql="select*from courses where uni_id=? AND faculty_id=?";
		$response=$this->getAllDataSafely($sql,"ss",[$uni_id,$faculty_id])??[];
		if(count($response)==0){
			echo "<h5 style='color:red;'>No Courses Available for Faculty of ".$faculty_name." @ ".$uni_name.",</h5";
		}
		else{
			foreach($response as $row){
				$course_id=$row['course_id'];
				$course_name=$row["course_name"];
				if($this->issAlreadyApplied($course_id,$this->getApplicationId($array['std_id']))){?>
					<button type="button" class="btn btn-info" data-toggle="collapse" style="width:100%;padding:3px;margin-top:2%;" data-target="<?php echo "#_".$course_id;?>" ><?php echo $course_name;?></button>
					<div id="<?php echo "_".$course_id;?>" class="collapse" style='padding: 10px 0;'>
						<div class="container match" style="width:100%; background-color: #f3f3;color:#000;border-radius: 10px; padding:10px 0;">
							<h2 style="color:#45f3ff;background-color:navy;">YOU ALREADY HAVE APPLIED FOR <?php echo $course_name;?></h2>	
						</div>
						
					</div>
					<?php

				}
				else{
					?>
					<button type="button" class="btn btn-info" data-toggle="collapse" style="width:100%;padding:3px;margin-top:2%;" data-target="<?php echo "#_".$course_id;?>" ><?php echo $course_name;?></button>
					<div id="<?php echo "_".$course_id;?>" class="collapse" style='padding: 10px 0;'>
						<div class="container match" style="width:100%; background-color: #f3f3;color:#000;border-radius: 10px; padding:10px 0;">
							<h4>Conduct Application For : <?php echo $course_name;?></h4>
						  	<div class="all_combine flex">
						  		<div class="left" id="#<?php echo "_".$course_id;?>">
						  			<div class="itm">
						  				<h4 style="font-size:18px;">Academic Program</h4>
						  			</div>
						  			<div class="itm">
						  				<h4 style="font-size:18px;">Mode Of Attendance</h4>
						  			</div>
						  			<div class="itm">
						  				<h4 style="font-size:18px;">Year Of Study</h4>
						  			</div>
						  			<div class="itm">
						  				<h4 style="font-size:18px;">Campus</h4>
						  			</div>
						  		</div>
						  		<div class="right <?php echo "_".$course_id;?>" >
						  			<div class="item">
						  			    <label class="label">Academic Program</label>
						  				<select id="course_name">
						  					<option value="<?php echo $course_id;?>"><?php echo $course_name;?></option>
						  				</select>
						  			</div>
						  			<div class="item">
						  			    <label class="label">Mode Of Attendance</label>
						  				<select id="mode_of_attendance">
						  					<option value="Full Time">Full Time</option>
						  					<option value="Part Time">Part Time</option>
						  				</select>
						  			</div>
						  			<div class="item">
						  			    <label class="label">Year Of Study</label>
						  				<select id="year_of_study">
						  					<option value="1st Year">1st Year</option>
						  					<option value="2nd Year">2nd Year</option>
						  				</select>
						  			</div>
						  			<div class="item">
						  			    <label class="label">Campus</label>
						  				<select id="campus_id">
						  				    
						  					<?php $this->studyCampus($course_id);?>
						  				</select>
						  			</div>
						  			
						  		</div>
						  	</div>
						  	<button type="button" class="btn btn-info <?php echo $course_id;?>" style="background-color: navy;width:90%;">Apply For this Course</button>
						</div>
						<div class="<?php echo "error".$course_id;?>" hidden></div>
					</div>
					<script>
						$(document).ready(function(){
							const id="<?php echo ".".$course_id;?>";
							const error="<?php echo "error".$course_id;?>";

							$(id).click(function(){
								$(id).html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Analysing Data...</span></small>");
								const uni_id="<?php echo $uni_id ?>";
								const uni_name="<?php echo $uni_id ?>";
								const faculty_id="<?php echo $faculty_id ?>";
								const faculty_name="<?php echo $faculty_name ?>";
								const course_id="<?php echo $course_id ?>";
								const course_name=$("#course_name").val();
								const mode_of_attendance=$("#mode_of_attendance").val();
								const year_of_study=$("#year_of_study").val();
								const campus_id=$("#campus_id").val();
								$(id).html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Processing Data...</span></small>");
								$.ajax({
									url:"./controller/ajaxCallProcessor.php",
									type:"POST",
									data:{uni_id:uni_id,uni_name:uni_name,faculty_id:faculty_id,faculty_name:faculty_name,course_id:course_id,course_name:course_name,mode_of_attendance:mode_of_attendance,year_of_study:year_of_study,campus_id:campus_id
									},
									cache:false,
									beforeSend:function(){
										$(id).html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting Data...</span></small>");
									},
									success:function(e){
										console.log(e);
										if(e.length>2){
											$(id).html("ERROR: REPORT THIS ERROR :"+e);
											$(id).attr("style","color:red;background-color:#000;");
											$(error).removeAttr("hidden");
											$(error).attr("style","border-radius:10px;padding:10px;width:100%;color:red;background-color:#000;");
											$(error).html("REPORT THIS ERROR <br>Error 320 : "+e);
											console.log("Erroring..");
										}

										else if(e.length==1){
											console.log(e.length+" loader to change")
											$(id).html("Application Submitted!!");
											$(id).attr("disabled",true);
											$(id).html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Redirecting...</span></small>");
											console.log("changing load");
											loader("apply");
										}
										else{
											$(id).html("Application Submitted!!");
											$("#_"+id).attr("hidden",true);//left
											$("._"+id).attr("hidden",true);//right
											$("#_"+id).attr("disabled",true);//left
											$("._"+id).attr("disabled",true);//right
											$("#course_name").attr("disabled",true);
											$("#mode_of_attendance").attr("disabled",true);
											$("#year_of_study").attr("disabled",true);
											$("#campus_id").attr("disabled",true);
											$(id).attr("disabled",true);
											console.log("Not suppossed to change");
										}
									}
								});
							});
						});
						
					</script>
					<?php
				}
					
			}
		}
	}
	protected function issAlreadyApplied($course_id,$applicationid){
		$sql="select course_id,applicationid from finalapplication where applicationid=? AND course_id=?";
		$response=$this->getAllDataSafely($sql,"ss",[$applicationid,$course_id])??[];
		return (count($response)==1);
	}
	protected function studyCampus($course_id){
		$sql="select*from courses where course_id=?";
		$response=$this->getAllDataSafely($sql,"s",[$course_id])[0]??[];
		
		$campus_id=$response['campus_id'];
		echo $campus_id;
		$sql="select*from studycampus where campus_id=?";
		$response=$this->getAllDataSafely($sql,"s",[$campus_id])[0]??[];
		
		if(empty($response)){
			?>
				<option value="">No Campus Found For this Course</option>
			<?php
		}
		else{
			
				$campus_name=$response['campus_name'];
				$campus_id=$response['campus_id'];
				?>
				<option value="<?php echo $campus_id;?>"> <?php echo $campus_name;?></option>
				<?php
		}
	}
	protected function step8($array){
		global $conn;
		?>
		<style>
			.contract{
				border-radius: 10px;
				width: 100%;
				height: 73vh;
				border: 1px solid #ddd;
				overflow-x:auto;
		        overflow-wrap: break-word;
		        word-wrap: break-word;
		        hyphens: auto;
			}
			.optionaln{
				width: 100%;
				/*border: 1px solid red;*/
			}
			.optionaln .flat{
				width: 100%;
				/*border: 1px solid blue;*/
			}
			.optionaln .flat select{
				width: 20%;
			}
			.btn{
				background-color: navy;
				color: #45f3ff;
				width: 20%;
				margin-top: 2%;
			}
			.btn:hover{
				background-color: forestgreen;
				color: #45f3ff;
			}
		</style>
		<div class="contract">
		    
			<h2 style="color:blue;">CONSENT TO COLLECT AND PROCESS PERSONAL INFORMATION (POPI)</h2>
            <p><span style="color:green;">I, the undersigned applicant (duly assisted by a competent person where I am under the age of
            18), hereby agree</span> to the processing of my personal information for purposes of applying to TAMA Organizationsa the responsible party with its registered address at
            D995 Sheleni Road Adams Mission Durban 4100 and permit TAMA Organizationsa to process my information for the purpose of sharing/forwarding/applying to universities & Colleges I have selected and course relevant bursaries and NSFAS application on my behalf.</p>
            
            <p>TAMA Organizationsa is committed to protecting the applicant's privacy and recognises that it needs to comply
            with statutory requirements insofar as it is necessary to process the applicant's personal
            information.</p> 
            
            <p>In terms of section 18 of the Protection of Personal Information Act 4 of 2013, TAMA Organizationsa
            is obligated to inform you of the following:</p>
            <ul>
            	
            	<p>1. The type of information that TAMA Organization will collect and process which will include any personal
            information which can identify you, your matriculation marks, national benchmark test scores and first year university marks (if applicable);</p>
            <p>2. The nature/category of the information that TAMA Organizationsa will process will relate to academic
            performance indicators.</p>
            <p>3. The purpose of processing and analysing the information will be to consider advising the applicant about career choice depending on the information submitted and share/forward/apply on behalf of the applicant to all universities selected by applicant including bursaries related to selected career choice and NSFAS.</p>
            <p>4. TAMA Organizationsa will source the information from yourself, the Department of Education and other
            university records (where applicable).</p>
            <p>5. TAMA Organizationsa may, where applicable, transfer the information to a third party country /
            organisation.</p>
            <p>6. Failure to consent to the processing of such information may results in termination of your application request with TAMA Organizationsa.</p>
            <p>7. You have the right to access and to amend any information processed by TAMA Organizationsa at any
            reasonable time.</p>
            8. You have the right to direct any complaint regarding the processing of your information
            to the Information Regulator.
            Further to the above consent, I understand that my personal information is also public in
            terms of section 50 of the Electronic Communications and Transactions Act 25 of 2002 (ECT Act).
            In terms of section 51 of the ECT Act, I hereby provide my express written permission to TAMA Organizationsa for
            the collection, collation, processing and sharing/forwarding/applying to universities/Colleges of my choice, bursaries and NSFAS institutions.</p>
            	
            </ul>
            
            
            <h2 style="color:blue;">ADMINISTRATION FEE POLICY</h2>
            <p><span style="color:green;">I, the undersigned applicant (duly assisted by a competent person where I am under the age of
            18), hereby understand</span> that the Administration Fee is mandatory to be paid by Applicant. I understand that by paying this Administration fee I am not paying for TAMA Organizationsa Services as they are Non Profit Company Services but paying for the System Administration to perform System/App needs such as updates, upgrades, Security Matters, etc.</p>
            
            <p><span style="color:green;">I, the undersigned applicant (duly assisted by a competent person where I am under the age of
            18), hereby declare</span> that aslong as i have not made the Administration fee payment my application request should not be processed and remain on hold until i have made/processed the payment of Administration Fee. In case I (the applicant) do not make/Process the Administration Fee payment until the closing date of TAMA Organizationsa and the Late application  closing date (if applicable), TAMA has the right to consider terminating my application.</p>
            

		</div>
		<code>to continue accept terms and conditions.</code>
		<div class="optionaln flex">
			
			<div class="flat flex">
			 Do you accept terms of use? <select id="accept"><option value="Yes">Yes</option><option value="No">No</option></select>
			</div>
			
		</div>
		<div id="erroragreement" hidden></div>
		<button class="btn" type="button" id="acceptcondition" onclick="acceptConditions('<?php echo $array['applicationid'] ;?>','<?php echo $array['std_id'] ;?>')">Submit</button>
		<div id="acceptconditionerror" hidden></div>
		<script>
// 			function acceptConditions(applicationidStep8,my_id_step8){
// 				const accept=$("#accept").val();
// 				if(accept=="Yes"){
// 					$.ajax({
// 						url:"./controller/ajaxCallProcessor.php",
// 						type:"POST",
// 						data:{
// 							accept:accept,applicationidStep8:applicationidStep8,my_id_step8:my_id_step8
// 						},
// 						cache:false,
// 						beforeSend:function(){
// 							$("#acceptconditionerror").removeAttr("hidden").html("<small><img style='width:8%;' src='../../img/processor.gif'> <span style='color:green;'>Submitting Data...</span></small>");
// 						},
// 						success:function(e){
// 							console.log(e);
// 							if(e.length==1){
// 								$("#acceptconditionerror").attr("style","color:#45f3ff;background:green;").html("Successfully Saved..");
// 								loader("apply");
// 							}
// 							else{
// 								$("#acceptconditionerror").attr("style","color:red;").html(e);
// 							}
// 						}
// 					});
// 				}
// 				else{
// 					$("#acceptconditionerror").attr("style","color:red;").html("Cannot Proceed until you accept Ts n Cs");
// 				}
// 			}
		</script>
		<?php
	}
	public function getAmountToPay($applicationid){
		$sql="select schoolname from step5 where applicationid=?";
	    $response=$this->getAllDataSafely($sql,"s",[$applicationid])[0]??[];
	    // print_r($response);
	    return $this->getAmount($response['schoolname']);
	}
	public function processPayment($applicant_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee, $amount_net, $name_first,$name_last, $email_address, $merchant_id,$school,$my_id){
		$sql="insert into payment(applicationid,m_payment_id,pf_payment_id,payment_status,item_name,item_description,amount_gross,amount_fee,amount_net,name_first,name_last,email_address,merchant_id,school,time_uploaded)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
		$params=[$applicant_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee, $amount_net, $name_first,$name_last, $email_address, $merchant_id,$school];
		$strParams="ssssssssssssss";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			$response=$this->testingUpdater(9,true,$my_id);
			if($response['response']=="S"){
				return array("response"=>"S","data"=>$response);
			}
			else{
				return array("response"=>"F","data"=>$response['data']);
			}
		}
		else{
			return array("response"=>"F","data"=>$response);
		}

	}
	public function getAmount($schoolname){
		$sql="select amount from highschools where id=?";
	    $response=$this->getAllDataSafely($sql,"s",[$schoolname])[0]??[];
	    // print_r($response);
	    return $response['amount'];
	}
	public function getStudentId($my_id){
	    $sql="select applicationid from step1 where std_id=?";
	    $response=$this->getAllDataSafely($sql,"s",[$my_id])[0]??[];
	    return $response['applicationid'];
	}
	public function getSchoolId($applicationid){
	    $sql="select schoolname from step5 where applicationid=?";
	    $response=$this->getAllDataSafely($sql,"s",[$applicationid])[0]??[];
	    return $response['schoolname'];
	}
	public function getEmailUser(string $my_id):string{
	    $sql="select usermail from create_runaccount where my_id=?";
	    $response=$this->getAllDataSafely($sql,"s",[$my_id])[0]??[];
	    return $response['usermail'];
	}
	public function dataToString($dataArray) {
      // Create parameter string
        $pfOutput = '';
        foreach( $dataArray as $key => $val ) {
            if($val !== '') {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        return substr( $pfOutput, 0, -1 );
    }
    public function getStudentGradeIfExists(string $my_id="",string $status=""){
    	$sql="select * from sgela where my_id=? and status=?";
	    $response=$this->getAllDataSafely($sql,"ss",[$my_id,$status]);
	    return $response[0]??[];
    }
    public function processPaymentIntoDB($std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day){
    	$sql="insert into matric_upgrade_payment(std_matric_upgrade,m_payment_id,pf_payment_id,payment_status,item_name,item_description,amount_gross,amount_fee,amount_net,name_first,name_last,email_address,merchant_id,school,time_uploaded,year,month,day,is_ctive,is_derigistered)values(?,?,?,?,?,?,?,?,?,?,?,?, ?,?,NOW(),?,?,?,1,1)";
    	$params=[$std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day];
    	$strParams="sssssssssssssssss";
    	$response=$this->postDataSafely($sql,$strParams,$params);
    	if(is_numeric($response)){
    		return array("response"=>"S","data"=>$response);
    	}
    	else{
    		return array("response"=>"F","data"=>$response);
    	}
    }
    public function processPaymentIntoDBTERTIARY($std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day){
    	$sql="insert into tertiary_upgrade_payment(std_matric_upgrade,m_payment_id,pf_payment_id,payment_status,item_name,item_description,amount_gross,amount_fee,amount_net,name_first,name_last,email_address,merchant_id,school,time_uploaded,year,month,day,is_ctive,is_derigistered)values(?,?,?,?,?,?,?,?,?,?,?,?, ?,?,NOW(),?,?,?,1,1)";
    	$params=[$std_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee,$amount_net,$name_first,$name_last,$email_address,$merchant_id,$school,$year,$month,$day];
    	$strParams="sssssssssssssssss";
    	$response=$this->postDataSafely($sql,$strParams,$params);
    	if(is_numeric($response)){
    		return array("response"=>"S","data"=>$response);
    	}
    	else{
    		return array("response"=>"F","data"=>$response);
    	}
    }
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
        $mess .='<div style="width:40px;height:40px;margin-left:5%;border-radius:100%;padding:1px 1px;background:#45f3ff;"><img style="width:100%;height:100%;border-radius:100%;" src="https://netchatsa.com/img/aa.jpg"></div>';
        // $mess .='<div><h3 style="color:#080;font-size:18px;">Netchatsa Mailer Alert</h3></div>';
        $mess .='</div>';
        $mess .= '<h3 style="color:#f40;">Exe Macala 🤙</h3>'.$message;
        $mess .="<a href='https://play.google.com/store/apps/details?id=com.mmshightech.netchatsa'><span class='badge badge-primary text-center text-white'>Download APP</span></a>";
        $mess .= '<div style="padding:10px;border:1px solid #45f3ff;font-style:italic;font-size:12px;color:red;">netchatsa mailer is a communication system developed by Sgela Technologies EAI. If this mail does not belong to you please ignore it. Do not reply to this email as it is controlled by RoboTech.</div></div></body></html>';
        return mail($reciever, $subject, $mess, $headers);

	}
    public function generateSignature($data, $passPhrase = null) {
        // Create parameter string
        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if(!empty($val)) {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );
        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5($getString);
    }
    public function generatePaymentIdentifier($pfParamString, $pfProxy = null) {
        // Use cURL (if available)
        if( in_array( 'curl', get_loaded_extensions(), true ) ) {
            // Variable initialization
            $url = 'https://www.payfast.co.za/onsite/process';
    
            // Create default cURL object
            $ch = curl_init();
    
            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
            curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
    
            // Standard settings
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
            if( !empty( $pfProxy ) )
                curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
    
            // Execute cURL
            $response = curl_exec( $ch );
            curl_close($ch );
            // echo $response;
            $rsp = json_decode($response, true);
            if ($rsp['uuid']) {
                return $rsp['uuid'];
            }
        }
        return null;
    }
    public function pfValidIP() {
        // Variable initialization
        $validHosts = array(
            'www.payfast.co.za',
            'sandbox.payfast.co.za',
            'w1w.payfast.co.za',
            'w2w.payfast.co.za',
            );
    
        $validIps = [];
    
        foreach( $validHosts as $pfHostname ) {
            $ips = gethostbynamel( $pfHostname );
    
            if( $ips !== false )
                $validIps = array_merge( $validIps, $ips );
        }
    
        // Remove duplicates
        $validIps = array_unique( $validIps );
        $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
        if( in_array( $referrerIp, $validIps, true ) ) {
            return true;
        }
        return false;
    }
    public function pfValidPaymentData( $cartTotal, $amount_gross ) {
        return !(abs((float)$cartTotal - (float)$amount_gross) > 0.01);
    }
    public function pfValidSignature( $pfDataSignature, $pfParamString, $pfPassphrase = null ) {
        // Calculate security signature
        if($pfPassphrase === null) {
            $tempParamString = $pfParamString;
        } else {
            $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
        }
    
        $signature = md5( $tempParamString );
        return ( $pfDataSignature === $signature );
    }
    public function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ) {
        // Use cURL (if available)
        if( in_array( 'curl', get_loaded_extensions(), true ) ) {
            // Variable initialization
            $url = 'https://'. $pfHost .'/eng/query/validate';
    
            // Create default cURL object
            $ch = curl_init();
        
            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
            curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
            
            // Standard settings
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
            if( !empty( $pfProxy ) )
                curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
        
            // Execute cURL
            $response = curl_exec( $ch );
            curl_close( $ch );
            if ($response === 'VALID') {
                return true;
            }
        }
        return false;
    }
    public function object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = [];
            foreach ($data as $key => $value)
            {
                $result[$key] = (is_array($value) || is_object($value)) ? object_to_array($value) : $value;
            }
            return $result;
        }
        return $data;
    }
	protected function step9($array){
		global $conn;
		$std_id=$array['std_id'];
		//print_r($this->getApplicationId($array['std_id']));echo'----';
	    $amountToPay=$this->getAmountToPay($this->getApplicationId($array['std_id']));
	    
	    if($amountToPay=="R150.00"){
            $amountToPay="150.00";
        }
        elseif($amountToPay=="R200.00"){
            $amountToPay="200.00";
        }
        elseif($amountToPay=="R250.00"){
            $amountToPay="250.00";
        }
        else{
            $amountToPay="150.00";
        }
        $tax=($amountToPay*0.15)+3;
        $amountToPay+=$tax;
	    $applicant_id=$this->getStudentId($array['std_id']);
	    $school=$this->getSchoolId($applicant_id);
		if($this->isAcceptedTerms($this->getApplicationId($array['std_id']))){
// 			$amountToPay=$this->getAmountToPay($this->getApplicationId($array['my_id']));
			if(isset($_GET['payment'])){
                    $std_id=$array['std_id'];
            	   $amountToPay=$this->getAmountToPay($this->getApplicationId($array['std_id']));
            	    $applicant_id=$this->getStudentId($array['std_id']);
            	    $school=$this->getSchoolId($applicant_id);
                    $step1_info=$this->getStep1Info($applicant_id);
            		$step2_info=$this->getStep2Info($applicant_id);
            		$step3_info=$this->getStep3Info($applicant_id);
            		$step4_info=$this->getStep4Info($applicant_id);
            		$step5_info=$this->getStep5Info($applicant_id);
                    if($amountToPay=="R150.00"){
                        $amountToPay="150.00";
                    }
                    elseif($amountToPay=="R200.00"){
                        $amountToPay="200.00";
                    }
                    elseif($amountToPay=="R250.00"){
                        $amountToPay="250.00";
                    }
                    else{
                        $amountToPay="150.00";
                    }
                    $tax=($amountToPay*0.15)+3;
	                $amountToPay=$amountToPay+=$tax;
                    $passPhrase = 'msiziMzobe98';
                    $amount_net=$amountToPay-2.48;
                    $data = array(
                        'merchant_id' => '18152361',
                        'merchant_key' => '2ammma77nrah4',
                        'return_url' => 'https://netchatsa.com/?apply',
                        'cancel_url' => 'https://netchatsa.com/cancel.php',
                        'notify_url' => 'https://netchatsa.com/notify.php',
                        'name_first'=>$step2_info['fname'],
                        'name_last'=>$step2_info['title']." ".$step2_info['initials']." ".$step2_info['lname'],
                        'email_address'=>$step3_info['email'],
                        'm_payment_id' => $step2_info['idnumber'],
                        'amount' => number_format( sprintf( '%.2f', $amountToPay ), 2, '.', '' ),
                        'item_name' => 'NETCHATSA ADMIN FEE FOR TERTIARY APPLICATION'
                        
                    );
                        // Generate signature (see Custom Integration -> Step 2)
                    $data["signature"] = $this->generateSignature($data, $passPhrase);
                    $pfParamString = $this->dataToString($data);
                    //echo 'Param : '.$pfParamString;
                    
                    $identifier = $this->generatePaymentIdentifier($pfParamString);
                    $data['pf_payment_id'] = '';
                    $data['item_description'] = 'THIS PAYMENT IS MADE ONLY FOR TERTIARY APPLICATION. IT IS NOT AN APPLICATION FEE. IT IS AN ADMINISTRATION FEE.';
                    $data['amount_gross'] = number_format( sprintf( '%.2f', $amountToPay ), 2, '.', '' );
                    $data['amount_fee'] = 2.48;
                    $data['amount_net'] = $amount_net;
                    $data['payment_status'] = 'PAID';
                    if($identifier!==null){
                           ?>
                           <script>
                              window.payfast_do_onsite_payment({"uuid":"<?php echo $identifier;?>"}, function (result){
                                  if(result){
                                    //   window.location=("./?_=apply&Processing=true");
                                    const std_id="<?php echo $std_id;?>";
                                    const amountToPay="<?php echo $amountToPay;?>";
                                    const pfData ='<?php echo json_encode($data);?>';
                                    const pfParamString = '<?php echo $pfParamString;?>';
                                    $(".sudoCodeoSitePayment").removeAttr("hidden");
                                    $.ajax({
                                		url:'./model/success.php',
                                		type:'post',
                                		data:{std_id:std_id,amountToPay:amountToPay,pfData:pfData,pfParamString:pfParamString},
                                		success:function(e){
                                		    console.log(e);
                                		    if(e.length<=2){
                                		        $(".sudoCodeoSitePayment").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".sudoCodeoSitePayment").html("Payment Successfull, Processing Request...");
                                		        loader("apply");
                                		    }
                                		    else{
                                		        $(".sudoCodeoSitePayment").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".sudoCodeoSitePayment").html(e);
                                		    }
                                			
                                		}
                                    });
                                  }
                                  else{
                                      //window.location=("./?_=apply&failedProcessing=true");
                                      $(".sudoCodeoSitePayment").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                                	  $(".sudoCodeoSitePayment").html("Payment Cancelled ");
                                      
                                  }
                              });
                            </script>
                               <?php
                   }
                   else{
                       echo'<div style="width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;">
			            Could not Identify your payment request {'.$identifier.'}
			        </div>';
                   }
			}
			?>
			<style>
				.infopack,.payCash,.payCard{
					width: 100%;
					box-shadow: 0 8px 6px -6px black;
					padding: 10px 0;
				}
				.payCash .btn,.payCard .btn{
					color: #45f3ff;
					background-color: navy;
					width: 80%;
					padding: 6px 0;
					border: 1px solid yellowgreen;
				}
				.payCash .btn:hover,.payCard .btn:hover{
					background-color: seagreen;
				}
			</style>
			<div class="infopack">
				<h2 >To Process Your Applications Please Pay <?php echo "R".$amountToPay;?> Admin Fee.</h2>
			</div>
			<hr>
			<!--<div class="payCash">-->
			<!--	<button class="btn" id="paycash">CASH PAYMENT</button>-->
			<!--</div>-->
			<!--<hr>-->
			<div class="payCard" >
				<button class="btn" id="paycard" onclick="loader('apply&payment')">
                    <input type="submit" name="paynow" value="PAY-NOW <?php echo 'R'.$amountToPay;?>">
                </button>
			</div>
			<hr>
			
			<!--<div class="payCard_online" disabled hidden>-->
			<!--	<form action="?payment" method="post">-->
   <!--                <input type="submit" name="paynow" value="PAY-NOW <?php //echo 'R'.$amountToPay;?>">-->
   <!--             </form>-->
			<!--</div>-->
			<!--<script>-->
			<!--    function paycardNotice(){-->
			<!--        $(".payCard_online").removeAttr("disabled").removeAttr("hidden");-->
			<!--    }-->
			<!--</script>-->
			<?php
			    if(isset($_GET['failedProcessing'])){
			        ?>
			        <div style="width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;">
			            Payment Failed
			        </div>
			        <?php
			    }
			?>
			    
			        <div hidden class="sudoCodeoSitePayment" style="width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;">
			            Payment Successfull, Processing Request...
			        </div>
			<?php
		}
		else{
			echo "no";exit();
		}
	}
	protected function isAcceptedTerms($applicationid){
	   $sql="select accept from terms_conditions where applicationid=?";
       $response=$this->getAllDataSafely($sql,"s",[$applicationid])[0]??[];
       return (empty($response['accept']) || $response['accept']=="No")?false:true;
	}
    protected function getStep1Info($applicant_id){
       $sql="select * from step1 where applicationid=?";
       $response=$this->getAllDataSafely($sql,"s",[$applicant_id]);
       return $response[0]??[];
    }
    protected function getStep2Info($applicant_id){
        $sql="select * from step2 where applicationid=?";
       $response=$this->getAllDataSafely($sql,"s",[$applicant_id]);
       return $response[0]??[];
    }
    protected function getStep3Info($applicant_id){
        $sql="select * from step3 where applicationid=?";
       $response=$this->getAllDataSafely($sql,"s",[$applicant_id]);
       return $response[0]??[];
    }
    protected function getStep4Info($applicant_id){
        $sql="select * from step4 where applicationid=?";
       $response=$this->getAllDataSafely($sql,"s",[$applicant_id]);
       return $response[0]??[];
    }
    protected function getStep5Info($applicant_id){
        $sql="select * from step5 where applicationid=?";
       $response=$this->getAllDataSafely($sql,"s",[$applicant_id]);
       return $response[0]??[];
    }
    protected function getInstitutionName($uni_id){
       $sql="select uni_name from universities where id=?";
       $response=$this->getAllDataSafely($sql,"s",[$uni_id]);
       return $response[0]['uni_name']??"";
    }
    protected function isApplicationActive($applicant_id){
       $sql="select * from active_application where id=?";
       $response=$this->getAllDataSafely($sql,"s",[$applicant_id]);
       return $response[0]??[];

    }
    protected function getConsultant($my_id){
       $sql="select * from admin where my_id=?";
       $response=$this->getAllDataSafely($sql,"s",[$my_id]);
       $response=$response[0];
       return $response['name'].' '.$response['surname'];
    }
	protected function step10($array){
		global $conn;
		$paymentStatusDisplay="";
		$applicant_id=$this->getApplicationId($array['std_id']);
		$paymentStatus=$this->getPaymentStatus($applicant_id);
		if($paymentStatus){
		    if($paymentStatus=="PENDING"){
		        $paymentStatusDisplay="<h5 style='color:red;'><span style='color:#45f3ff;'>PAYMENT: </span>".$paymentStatus."</h5>";
		    }
		    else{
		        $paymentStatusDisplay="<h5 style='color:green;'><span style='color:#45f3ff;'>PAYMENT: </span>".$paymentStatus."</h5>";
		    }

		    // echo $paymentStatusDisplay;
			
		
    		$step1_info=$this->getStep1Info($applicant_id);
    		$step2_info=$this->getStep2Info($applicant_id);
    		$step3_info=$this->getStep3Info($applicant_id);
    		$step4_info=$this->getStep4Info($applicant_id);
    		$step5_info=$this->getStep5Info($applicant_id);
    		
    		?>
    		<style>
    		    .mob-flex{
    		        display:flex;
    		    }
    		    .displayApplication{
    		        width:100%;
    		    }
    		    .displayApplication .1stDetails{
    		        width:100%;
    		        background-color:red;
    		    }
    		    .btn-mob{
    		        color:#45f3ff;
    		        background-color:#e8491d;
    		        border:2px solid #45f3ff;
    		    }
    		</style>
    		<div class="displayApplication">
    		    <div class="1stDetails" style="border-bottom:2px solid #e8491d;">
    		        <div class="mac_id" style="text-align:left;">
    		            Application ID : <?php echo $step2_info['applicationid'];?>
    		        </div>
    		        <div class="mac_id" style="text-align:left;">
    		            Student Name : <?php echo $step2_info['title']." ".$step2_info['initials']." ".$step2_info['lname'];?>
    		        </div>
    		        <div style="text-align:left;" ><?php $trackApplication=$this->isApplicationActive($applicant_id);
	    		        $rr="";
	    		        if(empty($trackApplication)){
	    		        	$rr="<span class='badge badge-danger text-white text-center'>NOT STARTED YET</span>";
	    		        }
	    		        elseif($trackApplication['is_application_done']=="N") {
	    		        	$consultant=$this->getConsultant($trackApplication['startedby']);
	    		        	$rr="IN PROGRESS by ".$consultant;
	    		        }
	    		        else{
	    		        	$consultant=$this->getConsultant($trackApplication['startedby']);
	    		        	$rr="SUBMITTED BY ".$consultant;
	    		        }
	    		        echo $paymentStatusDisplay."".$rr;?>
	    		    </div>
    		    </div>
    		    <br>
    		    <div class="row" style="width:100%;">
                  <div class="col-md-12 mb-3">
                    <div class="card">
                      <div class="card-header" style="background-color:#212121;border-bottom:1px solid #45f3ff;">
                        <span><i class="bi bi-table me-2"></i></span>Application Table
                      </div>
                      <div class="card-body" style="background-color:#212121;">
                        <div class="table-responsive" style="background-color:#212121;border:1px solid #45f3ff;">
                          <table
                            id="example"
                            class="table table-striped data-table"
                            style="width: 100%;background-color:#212121;color:#45f3ff"
                          >
                            <thead>
                              <tr>
                                <th>Institution</th>
                                <th>course</th>
                               
                                <th>Status</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                                <style>
                                            .ramButtonModalView{
                                                background-color:red;color:#45f3ff;padding:2px;
                                            }
                                            .ramButtonModalView:hover{
                                                background-color:#212121;
                                                border:#45f3ff;
                                                color:#45f3ff;
                                            }
                                        </style>
                              <?php 
                              $response=$this->getApplicationsStatments($applicant_id);
                              
                              foreach($response as $row){
                              	  // print_r($row);
                                  $institution =$this->getInstitutionName($row['uni_id']);
                                  $course =$this->geCourse($row['course_id']);
                                  ?>
                                  <tr>
                                    <td style="color:#45f3ff;"><?php echo $institution;?></td>
                                    <td style="color:#45f3ff;"><?php echo $course;?></td>
                                   
                                    <td><button 
                                    		class="btn ramButtonModalView" 
                                    		data-toggle="modal"
                            				data-target="#Pera_<?php echo $row['uni_id']."-".$row['applicationid'];?>"
                                    	>view</button></td>
                               
                                  </tr>
                                 <?php
                              }
                              ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>Institution</th>
                                <th>Course</th>
                                
                                <th>Status</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <?php
                if(isset($_POST['addButn'])&&isset($_POST['uni'])){
                    $uni=$_POST['uni'];
                    ?>
                <div>
                    <div class="too-do-match">
                        <form action="./?_=apply" method="post">
                            <input type="hidden" name="tmp" value="<?php echo $uni;?>">
                            <select class="rosseBruse" name="brues" required>
                                
                                <option value="">-- Select Faculty --</option>
                                <?php
                                $response=$this->getAllDataSafely("select*from faculties where uni_id=?","s",[$uni])??[];
                                foreach($response as $row){
                                    ?>
                                    <option value="<?php echo $row['faculty_id'];?>"><?php echo $row['faculty_name'];?></option>
                                    <?php
                                }
                                ?>
                                
                            </select>
                            <br><br>
                            <button class="btn" name="addBtnb" style="border:1px solid #45f3ff;color:white;">Add Faculty</button>
                        </form>
                    </div>        
                </div>
                    <?php
                }
                elseif(isset($_POST['addBtnb'])&&isset($_POST['brues']) && isset($_POST['tmp'])){
                    $faculty=$_POST['brues'];
                    $uni=$_POST['tmp']; 
                    ?>
                    <input type="hidden" name="faculty" class="a" value="<?php echo $_POST['brues'];?>">
                    <input type="hidden" name="uni" class="b" value="<?php echo $_POST['tmp'];?>">
                    <select class="c" name="brues" required>
                        
                        <option value="">-- Select Course --</option>
                        <?php
                        $response=$this->getAllDataSafely("select*from courses where uni_id=? and faculty_id=?","ss",[$uni,$faculty])??[];
                        foreach($response as $row){
                            ?>
                            <option value="<?php echo $row['course_id'];?>"><?php echo $row['course_name'];?></option>
                            <?php
                        }
                        ?>
                        
                    </select>
                    <br><br>
                    <button class="btn bedant" name="addBtnb" style="border:1px solid #45f3ff;color:#45f3ff;">Add Course</button>
                    <script>
                        $(document).ready(function(){
                            $(".bedant").click(function(){
                                const a=$(".a").val();
                                const b=$(".b").val();
                                const c=$(".c").val();
                                console.log(a+" "+b+" "+c);
                                if(c!=""){
                                    $(".bedant").removeAttr('hidden');
                                    $(".bedant").html("<img style='width:4%;color:#45f3ff;' src='../../img/processor.gif'> Adding Course...");
                                    $.ajax({
                            		url:'./controller/ajaxCallProcessor.php',
                            		type:'post',
                            		data:{a:a,b:b,c:c},
                            		success:function(e){
                            		    if(e.length<=2){
                            		        $(".bedant").attr("style","background-color:green;color:#fff;");
                            		        $(".bedant").html("Course Added Successfuly...");
                            		        loader("apply");
                            		    }
                            		    else{
                            		        $(".bedant").attr("style","background-color:black;color:red;");
                            		        $(".bedant").html(e);
                            		    }
                            			
                            		}
                	});
                                }
                                
                            });
                        });
                    </script>
                    <?php
                }
                else{
                    ?>
                <div class="add-uni-application">
                    <button class="btn btn-mob" data-toggle="modal" data-target="#addApplicationTertiary">Add Application</button>
                </div>
                <div class="fallbackEmptyOrError"></div>
                    <?php
                }
                ?>
                
                
                <br>
                <p style="color:red;border:1px solid red;font-size:11.5px;">NOTE that NSFAS & Relavant Bursary Applications will be displayed here once application process has been started with SOON to open Bursary offering Institutions.</p>
                
    		    
    		</div>

		<?php
		}
		else{
		    echo "YOU HAVE NOT MADE PAYMENT!!";	
		}
	}
	public function getuniversities(){
		return $this->getAllDataSafely("select*from universities order by uni_name ASC","",[])??[];

	}
	public function getApplicationsStatments($applicant_id){
		$params=[$applicant_id];
		$strParams="s";
		$sql="select*from finalapplication where applicationid=?";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function geCourse($couse_id){
	    $sql="select course_name from courses where course_id=?";
	    $response=$this->getAllDataSafely($sql,"s",[$couse_id]);
	       $response=$response[0];
	       return $response['course_name'];
	}
	public function getPaymentStatus($applicationid){
		$_="select applicationid from payment where applicationid=? Limit 1";
		$stmt = $this->connection->prepare($_);
		$stmt->bind_param("s", $applicationid);
		$stmt->execute();
		$stmt->bind_result($applicationid);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		if($rnum==1){
		   $sql="select*from payment where applicationid=?";
		   $response=$this->getAllDataSafely($sql,"s",[$applicationid]);
	       $response=$response[0];
	       return $response['payment_status'];
		}
		else{
		    return false;
		}
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
	public function getAllUniversities(){
		$sql="select*from universities";
		$response=$this->getAllDataSafely($sql,"",[]);
		foreach($response as $row){
			?>
			<option value="<?php echo $row['id'];?>"><?php echo $row['uni_name'];?></option>
			<?php
		}
	}
	public function yearCompleted(){
		$sql="select*from yearcompleted";
		$response=$this->getAllDataSafely($sql,"",[]);
		foreach($response as $row){
			?>
			<option value="<?php echo $row['yearc'];?>"><?php echo $row['yearc'];?></option>
			<?php
		}

	}
	public function isUploaded1($array){
		$applicationId=$this->getApplicationId($array['std_id']);
		if($applicationId=="absent"){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$response=$this->getAllDataSafely("select idcopy from step5 where applicationid=?","s",[$applicationId])[0];
			if(empty($response['idcopy'])){
				return false;
			}
			else{
				return true;
			}
			

		}
	}
	public function isUploaded2($array){
		$applicationId=$this->getApplicationId($array['std_id']);
		if($applicationId=="absent"){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$response=$this->getAllDataSafely("select finalresults from step5 where applicationid=?","s",[$applicationId])[0];
			if(empty($response['finalresults'])){
				return false;
			}
			else{
				return true;
			}
		}
	}
	public function isUploaded3($array){
		$applicationId=$this->getApplicationId($array['std_id']);
		if($applicationId=="absent"){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$response=$this->getAllDataSafely("select proofresident from step5 where applicationid=?","s",[$applicationId])[0];
			if(empty($response['proofresident'])){
				return false;
			}
			else{
				return true;
			}
		}
	}
	public function isUploaded4($array){
		$applicationId=$this->getApplicationId($array['std_id']);
		if($applicationId=="absent"){
			echo"<span style='color:red;'>You do not have an application ID!!..</span>";
			return false;
		}
		else{
			$response=$this->getAllDataSafely("select guardianid from step5 where applicationid=?","s",[$applicationId])[0]??[];
			
			if(empty($response['guardianid'])){
				return false;
			}
			else{
				return true;
			}

		}
	}
	public function getApplicationId($my_id){
		global $conn;
		$sql="select applicationid from step1 where std_id=?";
		$response=$this->getAllDataSafely($sql,"s",[$my_id])[0]??[];
		if(empty($response)){
			return "absent";
		}
		else{
			return $response['applicationid'];
		}
	}
	protected function isRegistered($my_id){
		$_="select my_id from matricupgrade where my_id=? LIMIT 1";
		$stmt = $this->connection->prepare($_);
		$stmt->bind_param("s", $my_id);
		$stmt->execute();
		$stmt->bind_result($my_id);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		return ($rnum==1);
	}
	public function getMatricUpgradeStudentDetails($id){
	    $sql="select * from matricupgrade where my_id=?";
	    $strParams="s";
	    $params=[$id];
	    return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	   //  if($_->num_rows>1){
	   //      return array("Error"=>"Multiple users found this uid");
	   //  }
	    
	   // return mysqli_fetch_array($_)??[];
	}
	public function requestPayment($response){
		echo"<center>
			<h3>Payment Required.</h3>
		</center>";
		$day=date("d");
        $year=date("Y");
        $month=date("m");
		$payment_required=150+(150*0.15)+3.50;
        $payment_required=number_format( sprintf( '%.2f', $payment_required ), 2, '.', '' );
        $monthText=$this->getMonth($month);
        
        ?>
        <style>
            .PaymentRequired{
                width:100%;
                padding:10px 10px;
                justify-content:center;
                text-align:center;
                align-content:center;
            }
            .paymentMatricUpgrade{
                width:90%;
                padding:10px 10px;
                background:navy;
                color:#45f3ff;
                border:2px solid white;
                border-radius:50px;
            }
        </style>
        <br>
        <center>
            <h5 style="color:#45f3ff;">
                Outstanding Payment for <?php echo $monthText." ".$year." "?>. Please make payment of R<?php echo $payment_required;?> to continue learning.
            </h5>
            <div class="PaymentRequiredASI">
                <div class="paymentMatricUpgrade" onclick="tertiaryMonthlyPayment()">PAY-NOW <?php echo 'R'.$payment_required;?></div>
			</div>
			<div class="processingMatricUpgradePaymentASI" hidden></div>
			<script>
			    function tertiaryMonthlyPayment(){
			        $(".PaymentRequiredASI").attr("hidden",true);
			        $(".processingMatricUpgradePaymentASI").removeAttr("hidden").
			        html("Please Wait, Fetching Payment request...").
			        load("./model/tertiaryMonthlyPayment.php");
			    }
			</script>
       </center>
        <?php
	}
	public function studentIsPaidThisMonthAndYear($std_id,$year,$month){
	    $sql="select*from matric_upgrade_payment where std_matric_upgrade=? and month=? and year=?";
	    $strParams="sss";
	    $params=[$std_id,$month,$year];
	    return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	    //return mysqli_fetch_array($conn->query("select*from matric_upgrade_payment where std_matric_upgrade='$std_id' and month='$month' and year='$year'"))??[];
	}
	public function studentIsPaidThisMonthAndYearTertiary(string $std_id="",$year,$month):array{
	   // echo $std_id;
	    $sql="select*from tertiary_upgrade_payment where std_matric_upgrade=? and month=? and year=?";
	    $strParams="sss";
	    $params=[$std_id,$month,$year];
	    return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	    //return mysqli_fetch_array($conn->query("select*from matric_upgrade_payment where std_matric_upgrade='$std_id' and month='$month' and year='$year'"))??[];
	}
	public function getMonth($m){
		if($m==01){
			$n="Jan";
		}
		elseif($m==02){
			$n="Feb";
		}
		elseif($m==03){
			$n="Mar";
		}
		elseif($m==04){
			$n="Apr";
		}
		elseif($m==05){
			$n="May";
		}
		elseif($m==06){
			$n="Jun";
		}
		elseif($m==07){
			$n="Jul";
		}
		elseif($m==8){
			$n="Aug";
		}
		elseif($m==9){
			$n="Sep";
		}
		elseif($m==10){
			$n="Oct";
		}
		elseif($m==11){
			$n="Nov";
		}
		elseif($m==12){
			$n="Dec";
		}
		return $n;
		
	}
	protected function getAllSubjectMatric(){
		?>
		<option value=""> -- Select Subject --</option>
		<?php
		$sql="select*from matricsubjects";
	    $strParams="";
	    $params=[];
	    $response=$this->getAllDataSafely($sql,$strParams,$params);
		foreach($response as $row){
			$subj_id=$row["subj_id"];
			$subj=$row["subject"];
			?>
			<option value="<?php echo $subj_id;?>">
				<?php echo $subj;?>
			</option>
			<?php
		}
	}
	public function getAllInfoOfMatricReWriteLearner($id){
		$sql="select*from matricupgrade where my_id=?";
	    $strParams="s";
	    $params=[$id];
	    return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
		//return mysqli_fetch_array($conn->query("select*from matricupgrade where my_id='$id'"));

	}
	public function yenzaUmatikuletshenaWabaphindayo($my_id,$nameMatricUpgrade,$surnameMatricUpgrade,$idNumMatricUpgrade,$phoneMatricUpgrade,$emailMatricUpgrade,$subj1MatricUpgrade,$subj2MatricUpgrade,$subj3MatricUpgrade,$subj4MatricUpgrade,$subj5MatricUpgrade,$subj6MatricUpgrade,$subj7MatricUpgrade,$subj8MatricUpgrade,$subj9MatricUpgrade,$subj10MatricUpgrade,$SchoolsSA){
		$sql="insert into matricupgrade (my_id,namematricupgrade, surnamematricupgrade, idNummatricupgrade, phonematricupgrade, emailmatricupgrade, subj1matricupgrade, subj2matricupgrade, subj3matricupgrade, subj4matricupgrade, subj5matricupgrade, subj6matricupgrade, subj7matricupgrade, subj8matricupgrade, subj9matricupgrade, subj10matricupgrade,schoolsa,tim_reg)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
		$params=[$my_id,$nameMatricUpgrade,$surnameMatricUpgrade,$idNumMatricUpgrade,$phoneMatricUpgrade,$emailMatricUpgrade,$subj1MatricUpgrade,$subj2MatricUpgrade,$subj3MatricUpgrade,$subj4MatricUpgrade,$subj5MatricUpgrade,$subj6MatricUpgrade,$subj7MatricUpgrade,$subj8MatricUpgrade,$subj9MatricUpgrade,$subj10MatricUpgrade,$SchoolsSA];
		$strParams="sssssssssssssssss";
		$response = $this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>1);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function getMatricRewriteSbjectContent($subj,$term){
		$sql="select*from matric_rewrite_subj_content where subject=? and term=?";
	    $strParams="ss";
	    $params=[$subj,$term];
	    return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getMatricSubjInfo($subj_id){
		$sql="select*from matricsubjects where subj_id=?";
	    $strParams="s";
	    $params=[$subj_id];
	    return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function matricUpgrade($cur_user_row){
		global $conn;
// 		echo $cur_user_row['my_id'];
		if(!$this->isRegistered($cur_user_row['my_id'])){
			?>
			<style>
				.ropw{
					border:1px solid #45f3ff;
					padding: 2px 2px;
				}
				.ropw .full-tc-page{
					width: 100%;
					border: 1px solid navy;
					padding: 1px 3px;
				}
				.ropw .full-tc-page .regForm{
					width: 100%;
					border: 1px solid #45f3ff;
					padding: 4px 4px;
				}
				.ropw .full-tc-page .regForm table{
					width: 100%;
				}
				.ropw .full-tc-page .regForm table .td{
					width: 30%;
					padding: 6px 6px;
				}
				.ropw .full-tc-page .regForm table #td{
					width: 70%;
					padding: 6px 6px;
				}
				.ropw .full-tc-page .regForm table td input,select{
					width: 100%;
					padding: 10px 10px;
					cursor: pointer;
					color: #45f3ff;
					background-color: #212121;
				}
				.ropw .full-tc-page .regForm .btn-mac{
					padding: 15px 15px;
					/*border: 2px solid navy;*/
				}
				.ropw .full-tc-page .regForm .btn-mac .btn{
					border: 2px solid #45f3ff;
					color: #45f3ff;
					padding: 5px 5px;
					border-radius: 50px;
					font-size: 15px;
				}
				.ropw .full-tc-page .regForm .btn-mac .btn:hover{
					border: 2px solid navy;
					color: navy;

				}

			</style>
		<div class="ropw" >
			<div class="full-tc-page">
				<h2>Register to start learning</h2>
				<div class="regForm">
					<table>
						<tr>
							<td class="id">Name</td>
							<td id="id"><input placeholder="First Name" type="text" class="nameMatricUpgrade"></td>
							
							
						</tr>
						<tr>
							<td class="id">Surname</td>
							<td id="id"><input placeholder="Last Name" type="text" class="surnameMatricUpgrade"></td>
							
						</tr>
						<tr>
							<td class="id">SA ID No</td>
							<td id="id"><input placeholder="SA ID Number" type="number" class="idNumMatricUpgrade"></td>
							
						</tr>
						<tr>
							<td class="id">Phone Number</td>
							<td id="id"><input placeholder="SA Phone Number" type="number" class="phoneMatricUpgrade"></td>
							
						</tr>
						<tr>
							<td class="id">Email Address</td>
							<td id="id"><input placeholder="Email Address" type="email" class="emailMatricUpgrade"></td>
							
						</tr>
						<tr>
							<td class="id">School Registered At</td>
							<td id="id"><select class="SchoolsSA">
								<option value="">-- Select School --</option>
								<?php $this->getAllSchools();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 1</td>
							<td id="id"><select class="subj1MatricUpgrade">

								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 2</td>
							<td id="id"><select class="subj2MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 3</td>
							<td id="id"><select class="subj3MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 4</td>
							<td id="id">
								<select class="subj4MatricUpgrade">
									<?php $this->getAllSubjectMatric();?>
								</select>
							</td>
							
						</tr>
						<tr>
							<td class="id">Subject 5</td>
							<td id="id"><select class="subj5MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 6</td>
							<td id="id"><select class="subj6MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 7</td>
							<td id="id"><select class="subj7MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 8</td>
							<td id="id"><select class="subj8MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 9</td>
							<td id="id"><select class="subj9MatricUpgrade">
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						<tr>
							<td class="id">Subject 10</td>
							<td id="id"><select class="subj10MatricUpgrade">
								
								<?php $this->getAllSubjectMatric();?>
							</select></td>
							
						</tr>
						
					</table>
					<div class="btn-mac">
						<button class="btn submitMatricReWriteReg">Register</button>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$(".submitMatricReWriteReg").click(function(){
					const SchoolsSA=$(".SchoolsSA").val();
					const nameMatricUpgrade=$(".nameMatricUpgrade").val();
					const surnameMatricUpgrade=$(".surnameMatricUpgrade").val();
					const idNumMatricUpgrade=$(".idNumMatricUpgrade").val();
					const phoneMatricUpgrade=$(".phoneMatricUpgrade").val();
					const emailMatricUpgrade=$(".emailMatricUpgrade").val();
					const subj1MatricUpgrade=$(".subj1MatricUpgrade").val();
					const subj2MatricUpgrade=$(".subj2MatricUpgrade").val();
					const subj3MatricUpgrade=$(".subj3MatricUpgrade").val();
					const subj4MatricUpgrade=$(".subj4MatricUpgrade").val();
					const subj5MatricUpgrade=$(".subj5MatricUpgrade").val();
					const subj6MatricUpgrade=$(".subj6MatricUpgrade").val();
					const subj7MatricUpgrade=$(".subj7MatricUpgrade").val();
					const subj8MatricUpgrade=$(".subj8MatricUpgrade").val();
					const subj9MatricUpgrade=$(".subj9MatricUpgrade").val();
					const subj10MatricUpgrade=$(".subj10MatricUpgrade").val();
					var error=0;
					if(nameMatricUpgrade==""){
						$(".nameMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(surnameMatricUpgrade==""){
						$(".surnameMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(idNumMatricUpgrade==""){
						$(".idNumMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(phoneMatricUpgrade==""){
						$(".phoneMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(emailMatricUpgrade==""){
						$(".emailMatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(subj1MatricUpgrade==""){
						$(".subj1MatricUpgrade").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(SchoolsSA==""){
						$(".SchoolsSA").attr("style","color:red;border:2px solid red;");
						$error=1;
					}
					else if(error==1){
						$(".submitMatricReWriteReg").attr("style","color:red;border:2px solid red;");
					}
					else{
						$(".submitMatricReWriteReg").attr("style","background-color:#000;color:green;padding:5px;opacity:.8;border:2px solid green");
						$(".submitMatricReWriteReg").html("Processing...");
						$.ajax({
							url:"./controller/ajaxCallProcessor.php",
							type:"POST",
							data:{
								nameMatricUpgrade:nameMatricUpgrade,
								surnameMatricUpgrade:surnameMatricUpgrade,
								idNumMatricUpgrade:idNumMatricUpgrade,
								phoneMatricUpgrade:phoneMatricUpgrade,
								emailMatricUpgrade:emailMatricUpgrade,
								subj1MatricUpgrade:subj1MatricUpgrade,
								subj2MatricUpgrade:subj2MatricUpgrade,
								subj3MatricUpgrade:subj3MatricUpgrade,
								subj4MatricUpgrade:subj4MatricUpgrade,
								subj5MatricUpgrade:subj5MatricUpgrade,
								subj6MatricUpgrade:subj6MatricUpgrade,
								subj7MatricUpgrade:subj7MatricUpgrade,
								subj8MatricUpgrade:subj8MatricUpgrade,
								subj9MatricUpgrade:subj9MatricUpgrade,
								subj10MatricUpgrade:subj10MatricUpgrade,
								SchoolsSA:SchoolsSA
							},
							cache:false,
							beforeSend:function(){
								$(".submitMatricReWriteReg").html("<img style='width:4%;color:#45f3ff;' src='../../img/processor.gif'><span style='color:green;'>UPLOADING..</span>");
							},
							success:function(e){
								console.log(e.length);
								if(e.length>2){
									$(".submitMatricReWriteReg").attr("style","background-color:#000;border:1pxsolid red;color:red;padding:5px;opacity:.8;");
									$(".submitMatricReWriteReg").html("Suspense 320 : "+e);
								}
								else{
									$(".submitMatricReWriteReg").html("<small style='color:green;'>Registration Successful..</small>");
									$(".nameMatricUpgrade").val("");
									$(".surnameMatricUpgrade").val("");
									$(".idNumMatricUpgrade").val("");
									$(".phoneMatricUpgrade").val("");
									$(".emailMatricUpgrade").val("");
									$(".subj1MatricUpgrade").val("");
									$(".subj2MatricUpgrade").val("");
									$(".subj3MatricUpgrade").val("");
									$(".subj4MatricUpgrade").val("");
									$(".subj5MatricUpgrade").val("");
									$(".subj6MatricUpgrade").val("");
									$(".subj7MatricUpgrade").val("");
									$(".subj8MatricUpgrade").val("");
									$(".subj9MatricUpgrade").val("");
									$(".subj10MatricUpgrade").val("");
									$(".SchoolsSA").val();
									loader("matricUpgrade");
								}
							}
						});
					}
				});
			});
		</script>
		
			<?php
		}
		else{
		    $MatricUpgradeStudentDetails=$this->getMatricUpgradeStudentDetails($cur_user_row['my_id']);
		    if(!empty($MatricUpgradeStudentDetails)){
		        $isPaid=false;
		        $month = date("m");
	            $day= date("d");
	            $year= date("Y");
		        if(isset($MatricUpgradeStudentDetails['Error'])){
		            echo "Report this error {068 515 3023} - duplicate : ".$MatricUpgradeStudentDetails['Error'];exit();
		        }
		        else{
		            $std_id=$MatricUpgradeStudentDetails['id'];
		            $studentIsPaidThisMonthAndYear=$this->studentIsPaidThisMonthAndYear($std_id,$year,$month);
		            if(!empty($studentIsPaidThisMonthAndYear)){
		                $isPaid=true;
		            }
		        }
		        if(!$isPaid){
		            $std_id='2023'.$MatricUpgradeStudentDetails['id'];
		            $payment_required=400+(400*0.15)+3;
		            $payment_required=number_format( sprintf( '%.2f', $payment_required ), 2, '.', '' );
		            $monthText=$this->getMonth($month);
                    $day;
                    $year;
                    if(isset($_GET['payment'])){
                        $amountToPay=400.00;
                        $tax=($amountToPay*0.15)+3;
    	                $amountToPay+=$tax;
                        $passPhrase = 'msiziMzobe98';
                        // $amountToPay = 5;
                        $amount_net=$amountToPay-2.48;
                        $data = array(
                            'merchant_id' => '18152361',
                            'merchant_key' => '2ammma77nrah4',
                            'return_url' => 'https://netchatsa.com/?apply',
                            'cancel_url' => 'https://netchatsa.com/cancel.php',
                            'notify_url' => 'https://netchatsa.com/notify.php',
                            'name_first'=>$MatricUpgradeStudentDetails['namematricupgrade'],
                            'name_last'=>$MatricUpgradeStudentDetails['surnamematricupgrade'],
                            'email_address'=>$MatricUpgradeStudentDetails['emailmatricupgrade'],
                            'm_payment_id' => $std_id,
                            'amount' => number_format( sprintf( '%.2f', $amountToPay ), 2, '.', '' ),
                            'item_name' => 'NETCHATSA MATRIC UPGRADE ADMIN FEE'
                            
                        );
                            // Generate signature (see Custom Integration -> Step 2)
                        $data["signature"] = $this->generateSignature($data, $passPhrase);
                        $pfParamString = $this->dataToString($data);
                        //echo 'Param : '.$pfParamString;
                        
                        $identifier = $this->generatePaymentIdentifier($pfParamString);
                        $data['pf_payment_id'] = '';
                        $data['item_description'] = 'THIS PAYMENT IS MADE ONLY FOR TERTIARY APPLICATION. IT IS NOT AN APPLICATION FEE. IT IS AN ADMINISTRATION FEE.';
                        $data['amount_gross'] = number_format( sprintf( '%.2f', $amountToPay ), 2, '.', '' );
                        $data['amount_fee'] = 2.48;
                        $data['amount_net'] = $amount_net;
                        $data['payment_status'] = 'PAID';
                        if($identifier!==null){
                           ?>
                           <script>
                              window.payfast_do_onsite_payment({"uuid":"<?php echo $identifier;?>"}, function (result){
                                  if(result){
                                    //   window.location=("./?_=apply&Processing=true");
                                    const std_id="<?php echo $std_id;?>";
                                    const amountToPay="<?php echo $amountToPay;?>";
                                    const pfData ='<?php echo json_encode($data);?>';
                                    const pfParamString = '<?php echo $pfParamString;?>';
                                    $(".sudoCodeoSitePayment").removeAttr("hidden");
                                    $.ajax({
                                		url:'./model/MatricPaymentUpgradeSuccess.php',
                                		type:'post',
                                		data:{std_id:std_id,amountToPay:amountToPay,pfData:pfData,pfParamString:pfParamString},
                                		success:function(e){
                                		    console.log(e);
                                		    if(e.length<=2){
                                		        $(".processingMatricUpgradePayment").removeAttr("hidden").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".processingMatricUpgradePayment").html("Payment Successfull, Processing Request...");
                                		        loader("matricUpgrade");
                                		    }
                                		    else{
                                		        $(".processingMatricUpgradePayment").removeAttr("hidden").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                                		        $(".processingMatricUpgradePayment").html(e);
                                		    }
                                			
                                		}
                                    });
                                  }
                                  else{
                                      //window.location=("./?_=apply&failedProcessing=true");
                                      $(".processingMatricUpgradePayment").removeAttr("hidden").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                                	  $(".processingMatricUpgradePayment").html("Payment Cancelled");
                                      
                                  }
                              });
                            </script>
                               <?php
                       }
                       else{
                           echo'<div style="width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;">
    			            Could not Identify your payment request {'.$identifier.'}
    			        </div>';
                       }
    			    }

		            ?>
		            <style>
		                .PaymentRequired{
		                    width:100%;
		                    padding:10px 10px;
		                    justify-content:center;
		                    text-align:center;
		                    align-content:center;
		                }
		                .paymentMatricUpgrade{
		                    width:90%;
		                    padding:10px 10px;
		                    background:navy;
		                    color:#45f3ff;
		                    border:2px solid white;
		                    border-radius:50px;
		                }
		            </style>
		            <br>
		            <center>
		                <h5 style="color:#45f3ff;">
		                    Outstanding Payment for <?php echo $monthText." ".$year." "?>. Please make payment of R<?php echo $payment_required;?> to continue learning.
		                </h5>
    		            <div class="PaymentRequired">
                            <div class="paymentMatricUpgrade" <?php if(isset($_['payment'])){ echo"hidden";}?> onclick="loader('matricUpgrade&payment')">PAY-NOW <?php echo 'R'.$payment_required;?></div>
            			</div>
            			<div class="processingMatricUpgradePayment" hidden></div>
            			<script>
            			 //   function paymentMatricUpgrade(){
            			 //       $(".PaymentRequired").attr("hidden",true);
            			 //       $(".processingMatricUpgradePayment").removeAttr("hidden").
            			 //       html("Please Wait, Fetching Payment request...").
            			 //       load("./model/MatricPaymentUpgradeSuccess.php");
            			 //   }
            			</script>
		           </center>
		            <?php
		        }
		        elseif(isset($_GET['_upgrade_'])&&!empty($_GET['_upgrade_'])){
        			?>
        			<style>
        				    .medLocker{
                		        width:100%;
                                color:#45f3ff;
                		    }
                		    .medLocker .bodyCamp{
                		        width:100%;
                		        padding:10px;
                		    }
                		    .medLocker .bodyCamp .radeMos{
                		        width:100%;
                		        height:auto;
                		        padding:6px;
                		        box-shadow: 0 8px 6px -6px black;
                		        display:flex;
                		        cursor:pointer;
                		    }
                		    .medLocker .bodyCamp .radeMos:hover{
                		        background-color:navy;
                		    }
                		    .medLocker .bodyCamp .radeMos .img-kMover{
                		        width:60px;
                		        height:60px;
                		        border-radius:100%;
                		        padding:10px;
                		    }
                		    .medLocker .bodyCamp .radeMos .img-kMover img{
                		        width:100%;
                		        height:100%;
                		        border-radius:100%;
                		    }
        			</style>
        			<div class="medLocker">
        				<?php
        				$getSubjInfo=$this->getMatricSubjInfo($_GET['_upgrade_']);
        				// print_r($array[$i]);
        				$subj_id=$getSubjInfo['subj_id'];
        				$subj_name=$getSubjInfo['subject'];
        				$dir="../../img/jj.jpg";
        				?>
        				<div class="bodyCamp" onclick="na2thisterm(1,<?php echo $_GET['_upgrade_'];?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
        	    		            <img src="<?php echo $dir;?>">
        	    		        </div>
        	    		        <div class="maxcKood">
        	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 1</span></small></div>
        	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
        	    		        </div>
        		            </div>
        			    </div>
        			    <div class="bodyCamp" onclick="na2thisterm(2,<?php echo $_GET['_upgrade_'];?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
        	    		            <img src="<?php echo $dir;?>">
        	    		        </div>
        	    		        <div class="maxcKood">
        	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 2</span></small></div>
        	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
        	    		        </div>
        		            </div>
        			    </div>
        			    <div class="bodyCamp" onclick="na2thisterm(3,<?php echo $_GET['_upgrade_'];?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
        	    		            <img src="<?php echo $dir;?>">
        	    		        </div>
        	    		        <div class="maxcKood">
        	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 3</span></small></div>
        	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
        	    		        </div>
        		            </div>
        			    </div>
        			    <div class="bodyCamp" onclick="na2thisterm(4,<?php echo $_GET['_upgrade_'];?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
        	    		            <img src="<?php echo $dir;?>">
        	    		        </div>
        	    		        <div class="maxcKood">
        	    		            <div><small style="font-size:20px;"><?php echo $subj_name;?> <span style="font-size:20px;"> TERM 4</span></small></div>
        	    		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
        	    		        </div>
        		            </div>
        			    </div>
        	    	</div>
        	    	<script>
        	    		function na2thisterm(term,subj_id){
        	    			loader("matricUpgrade&term="+term+"-"+subj_id);
        	    		}
        	    	</script>
        
        		<?php
        		}
        		elseif(isset($_GET['term'])&&!empty($_GET['term'])){
        			$tmp=explode("-",$_GET['term']);
        			$term=$tmp[0];
        			$subj_id=$tmp[1];
        			$getMatricRewriteSbjectContent=$this->getMatricRewriteSbjectContent($subj_id,$_GET['term']);
        			if(empty($getMatricRewriteSbjectContent)){
        				?>
        				<h2 style="color:#45f3ff;background-color: red;padding:10px 10px;text-align: center;">Subject Has no content yet!!</h2>
        				<?php
        			}
        			else{
        			    $chapters=array();
        				foreach ($getMatricRewriteSbjectContent as $array) {
        					if(!in_array($array['chapter'],$chapters)){
        					    array_push($chapters,$array['chapter']);
        					}
        				}
        				for($i=0;$i<sizeof($chapters);$i++){
        				    $matricUpgradeChapterInfo=$this->GetmatricUpgradeChapterInfo($chapters[$i]);
        				    $MatricUpgradeSubjInfo=$this->getMatricSubjInfo($matricUpgradeChapterInfo['subject']);
        				    $url=$term."-".$subj_id."-".$chapters[$i];
        				    // $ciphering = "AES-128-CTR"; 
                //             $iv_length = openssl_cipher_iv_length($ciphering); 
                //             $options = 0; 
                //             $encryption_iv = '0685153023980510'; 
                //             $encryption_key = "MaLwandeMkhize"; 
                //             $encryption = openssl_encrypt($url, $ciphering, $encryption_key, $options, $encryption_iv); 
                //           $decryption =  openssl_decrypt($url, $ciphering, $encryption_key, $options, $encryption_iv);
                            
                            //echo "Enryipting :: ".$url."<br>".$encryption.":: Encrypted<br>Decypted::".$decryption;
        				    ?>
        				    <center>
        				        <style>
        				            .matricSubjectHolder{
        				                width:100%;
        				                padding:10px 10px;
        				                border:none;
        				                /*box-shadow: 0 4px 6px 7px;*/
        				                box-shadow: 0 8px 6px -6px black;
        				            }
        				        </style>
        				    <div class="matricSubjectHolder" onclick="navigateTochapterTermContent('<?php echo $url?>')">
        				        <div class="display-subject"><?php echo $MatricUpgradeSubjInfo['subject'];?></div>
        				        <div class="display-chapter"><?php echo $matricUpgradeChapterInfo['chapter']?></div>
        				    </div>
        				    <br>
        				    </center>
        				    <script>
        				        function navigateTochapterTermContent(url){
                	    			loader("matricUpgrade&___="+url);
                	    			
                	    		}
        				    </script>
        				    <?php
        				}
        			}
        
        		}
        		elseif(isset($_GET['___'])){
        		    $url=explode("-",$_GET['___']);
        		    $term=$url[0];
        			$subj_id=$url[1];
        			$chapter=$url[2];
        			?>
        			<style>
                                .btn{
                                    color:#45f3ff;
                                    background-color:navy;
                                    
                                }
                                .btn0{
                                    color:#45f3ff;
                                    background-color:#FF6F61;
                                    
                                }
                                .btn1{
                                    color:#45f3ff;
                                    background-color:#6B5B95;
                                    
                                }
                                .btn2{
                                    color:green;
                                    background-color:#45f3ff;
                                    
                                }
                                .btn:hover{
                                    background-color:#88B04B;
                                    border:1px solid #45f3ff;
                                    color:#45f3ff;
                                }
                            </style>
                            <div class="mac" style="width:100%;display:flex;">
                                <div style="width:3%;"></div><div class="btn" data-toggle="modal" data-target="#install_module">Assignments<sup>(0)</sup></div><div style="width:3%;"></div><div class="btn btn0" >Tests<sup>(0)</sup></div><div style="width:3%;"></div><div class="btn btn1" >Quiz<sup>(0)</sup></div><div style="width:3%;"></div><div class="btn btn2" ><i class="fa fa-check" style="color:green;"></i></div>
                            </div>
                            
                            
                            <style>
                            .matricUpgradeContentDisplayer{
                		        width:100%;
                		        overflow-x:auto;
                                overflow-wrap: break-word;
                                word-wrap: break-word;
                                hyphens: auto;
                                color:#45f3ff;
                		    }
                		    .matricUpgradeContentDisplayer .bodyCamp{
                		        width:100%;
                		        padding:10px;
                		    }
                		    .matricUpgradeContentDisplayer .bodyCamp .radeMos{
                		        width:100%;
                		        height:auto;
                		        padding:6px;
                		        box-shadow: 0 8px 6px -6px black;
                		        cursor:pointer;
                		    }
                		    .matricUpgradeContentDisplayer .bodyCamp .radeMos:hover{
                		        background-color:navy;
                		    }
                		    
                		</style>
        			<div class="matricUpgradeContentDisplayer"></div>
                    <span id="loadmeTag"></span>
                    <script>
                    $(document).ready(function(){
                     
                     var limit = 10;
                     var start = 0;
                     var action = 'inactive';
                    
                    
                     if(action == 'inactive')
                     {
                      action = 'active';
                      loadMatricUpgradeData(limit, start);
                     }
                     
                     
                    });
                    $(window).scroll(function(){
                      if($(window).scrollTop() + $(window).height() > $(".matricUpgradeContentDisplayer").height() && action == 'inactive')
                      {
                       action = 'active';
                       start = start + limit;
                       setTimeout(function(){
                        loadMatricUpgradeData(limit, start);
                       }, 1000);
                      }
                     });
                     function loadMatricUpgradeData(limit, start)
                     {
                         $('#loadmeTag').html("<span>Please Wait Processing..</span>");
                        const term=<?php echo $term;?>;
                        const subj=<?php echo $subj_id;?>;
                        const chapter=<?php echo $chapter;?>;
                      $.ajax({
                       url:"./model/fetchMatricUpgradeContent.php",
                       method:"POST",
                       data:{limit:limit, start:start,term:term,subj:subj,chapter:chapter},
                       cache:false,
                       success:function(data)
                       {
                        $('.matricUpgradeContentDisplayer').append(data);
                        if(data == '')
                        {
                         $('#loadmeTag').html("<span type='button' class='btn btn-info'>limit reached</span>");
                         action = 'active';
                        }
                        else
                        {
                         $('#loadmeTag').html("<span class='btn btn-info' onclick='loadMatricUpgradeData("+(limit)+", "+(start + limit)+")'>load more</span>");
                         action = "inactive";
                        }
                       }
                      });
                     }
                     </script>
        			<?php
        			
        		}
        		else{
        			?>
        			<style>
        				.medLocker{
                		        
                		        width:100%;
                		        
                		        /*hyphens: auto;
                		        overflow-x:auto;
                                overflow-wrap: break-word;
                                word-wrap: break-word;*/
                                
                                color:#45f3ff;
                                
                		    }
                		    .medLocker .bodyCamp{
                		        width:100%;
                		        padding:10px;
                		    }
                		    .medLocker .bodyCamp .radeMos{
                		        width:100%;
                		        height:auto;
                		        padding:6px;
                		        box-shadow: 0 8px 6px -6px black;
                		        display:flex;
                		        cursor:pointer;
                		    }
                		    .medLocker .bodyCamp .radeMos:hover{
                		        background-color:navy;
                		    }
                		    .medLocker .bodyCamp .radeMos .img-kMover{
                		        width:60px;
                		        height:60px;
                		        border-radius:100%;
                		        padding:10px;
                		    }
                		    .medLocker .bodyCamp .radeMos .img-kMover img{
                		        width:100%;
                		        height:100%;
                		        border-radius:100%;
                		    }
        		</style>
        		<div style="width:100%;border-bottom:1px solid #ddd;padding:5px 5px;display:flex;">
        		    <select class="subjectAdd" style="width:100%;border:none;padding:5px 0;color:#45f3ff;">
        		        <?php $this->getAllSubjectMatric();?>
        		    </select>
        		    <span style="border:none;padding:5px 5px;color:#45f3ff;border:1px solid #ddd;cursor:pointer;" onclick="addSubjectToUpgrade()">Add</span>
        		</div>
        		<div class="submitMatricReWriteRegAdd" hidden></div>
        		<div class="medLocker">
        			<?php
        			$getAllInfoOfMatricReWriteLearner=$this->getAllInfoOfMatricReWriteLearner($cur_user_row['my_id']);
        			$array=[
        			    "subj1matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj1matricupgrade'],
            			"subj2matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj2matricupgrade'],
            			"subj3matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj3matricupgrade'],
            			"subj4matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj4matricupgrade'],
            			"subj5matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj5matricupgrade'],
            			"subj6matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj6matricupgrade'],
            			"subj7matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj7matricupgrade'],
            			"subj8matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj8matricupgrade'],
            			"subj9matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj9matricupgrade'],
            			"subj10matricupgrade"=>$getAllInfoOfMatricReWriteLearner['subj10matricupgrade']
        			        ];
        			
        			$arr=[];
        			foreach($array as $subj_id){
        				if(!empty($subj_id)){
        					$arr[]=$subj_id;
        				}
        			}
        			for ($i=0;$i<sizeof($arr);$i++){
        				$getSubjInfo=$this->getMatricSubjInfo($arr[$i]);
        				$subj_id=$getSubjInfo['subj_id'];
        				$subj_name=$getSubjInfo['subject'];
        				$dir="../../img/jj.jpg";
        				?>
        				<div class="bodyCamp" onclick="na2thisSubj(<?php echo $subj_id;?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
                		            <img src="<?php echo $dir;?>">
                		        </div>
                		        <div class="maxcKood">
                		            <div><small><?php echo $subj_name;?></small></div>
                		            <div><small>Click to visit Subject {<?php echo $subj_name;?>}</small></div>
                		        </div>
        		            </div>
            		    </div>
            		    
        				<?php
        			}
        		?>
        		</div>
        		<script>
        		    function addSubjectToUpgrade(){
        		        const subjModelAddSunject=$(".subjectAdd").val();
        		        if(subjModelAddSunject==""){
        		            $(".submitMatricReWriteRegAdd").removeAttr("hidden");
        					$(".submitMatricReWriteRegAdd").attr("style","color:red;border:2px solid red;");
        					$(".submitMatricReWriteRegAdd").html("<small>Cannot process Empty inputy!.. </small>");
        				}
        				else{
        				    $(".submitMatricReWriteRegAdd").removeAttr("hidden");
        					$(".submitMatricReWriteRegAdd").attr("style","background-color:#000;color:green;");
        					$(".submitMatricReWriteRegAdd").html("Processing...");
        					$.ajax({
        						url:"./controller/ajaxCallProcessor.php",
        						type:"POST",
        						data:{
        							subjModelAddSunject:subjModelAddSunject
        						},
        						cache:false,
        						beforeSend:function(){
        							$(".submitMatricReWriteRegAdd").html("<img style='width:4%;color:#45f3ff;' src='../../img/processor.gif'><span style='color:green;'>UPLOADING..</span>");
        						},
        						success:function(e){
        							console.log(e);
        							if(e.length>2){
        								$(".submitMatricReWriteRegAdd").attr("style","background-color:#000;border:1pxsolid red;color:red;padding:5px;opacity:.8;");
        								$(".submitMatricReWriteRegAdd").html("Suspense 320 : "+e);
        							}
        							else{
        								$(".submitMatricReWriteRegAdd").html("<small style='color:green;'>Subject Added Successful..</small>");
        								$(".subjectAdd").val();
        								
        								loader("matricUpgrade");
        							}
        						}
        					});
        				}
        		    }
        			function na2thisSubj(id){
        				loader("matricUpgrade&_upgrade_="+id);
        			}
        		</script>
        		<?php
        		}
		    }
		    else{
		        echo"<h5 style='color:#45f3ff;background-color:red;padding:10px 10px;text-align:center;'> U are not recognized as matric upgrade user.</h5>";exit();
		    }
		}
	}
	public function registerAsNewCandidate(string $my_id="",string $status=""){
		?>
		<style>
			.softa{
				width:100%;
				border:1px solid #45f3ff;
				box-shadow: 0px 0px 15px rgba(0,0,0,.5);
				background-color: #212121;
				padding:0 10px;
				color: #45f3ff;
				text-align: center;
			}
			.softa .settupMao{
				width: 100%;
			}
			.softa .settupMao input,select{
				width:100%;
				padding: 10px 10px;
				border: none;
				background-color: #212121;
				border-bottom: 2px solid #45f3ff;
				color: #45f3ff;
			}
			span{
				text-align: center;
			}
			.sudoBtmNet{
				padding: 10px 10px;

			}
		</style>
		<div class="softa">
			<center><h2>
				Fill 2 Request Self Learning Access
			</h2></center>
			<span>Enter Name</span>
			<div class="settupMao">
				<input type="text" placeholder="Enter Student Name" class="studentName">
			</div>
			<span>Enter Surname</span>
			<div class="settupMao">
				<input type="text" placeholder="Enter Surname" class="studentSurname">
			</div>
			<?php
			if($status=="tertiary"){
				?>
				<span>Select University</span>
				<div class="settupMao">
					<select class="studentSchoolAttecnding">
						<option value="">-- Select Tertiary --</option>
						<?php $this->getAllUniversities();?>
					</select>
				</div>
				<span>Select Current Level</span>
				<div class="settupMao">
					<select class="studentCurrentGrade">
						<option value="">-- Select Current level --</option>
						<option value="1st">1st Year</option>
						<option value="2nd">2nd Year</option>
						<option value="3rd">3rd Year</option>					
						<option value="4th">4th Year</option>
						<option value="5th">5th Year</option>
					</select>
				</div>
				<?php
			}
			else{
			?>
				<span>Select School</span>
				<div class="settupMao">
					<select class="studentSchoolAttecnding">
						<option value="">-- Select School --</option>
						<?php $this->getAllSchools();?>
					</select>
				</div>
				<span>Select Current Grade</span>
				<div class="settupMao">
					<select class="studentCurrentGrade">
						<option value="">-- Select Current Grade --</option>
						<option value="gr12">Grade 12</option>
						<option value="gr11">Grade 11</option>
						<option value="gr10">Grade 10</option>					
						<option value="gr9">Grade 9</option>
						<option value="gr8">Grade 8</option>
					</select>
				</div>
			<?php
			}
			?>
			<div class="sudoBtmNet">
				<div class="topNavBtn btn" onclick="SaveToAutoLearn('<?php echo $my_id;?>','<?php echo $status?>')">Request Self learning Access</div>
			</div>
			
			<div class="errorRegistrationModea" hidden></div>
		</div>
		<script>
			function SaveToAutoLearn(my_id_new_set,status_new_set){
				const studentNameconst = $(".studentName").val(); 
				const studentSurname = $(".studentSurname").val();
				const studentSchoolAttecnding = $(".studentSchoolAttecnding").val();
				const studentCurrentGrade = $(".studentCurrentGrade").val();
				$(".errorRegistrationModea").removeAttr("hidden").attr("style","color:#45f3ff;").html("<img style='width:4%;color:#45f3ff;' src='../../img/processor.gif'>Processing Request...");
				if(studentNameconst==""){
					$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("All Fields are required!..");
				}
				else if(studentSurname==""){
					$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("All Fields are required!..");
				}
				else if(studentSchoolAttecnding==""){
					$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("All Fields are required!..");
				}
				else if(studentCurrentGrade==""){
					$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("All Fields are required!..");
				}
				else{
					var amount=100.00;
					if(status_new_set=="high school"){
						amount=50.00;
					}
					$.ajax({
	            		url:'./controller/ajaxCallProcessor.php',
	            		type:'post',
	            		data:{my_id_new_set:my_id_new_set,status_new_set:status_new_set,studentNameconst:studentNameconst,studentSurname:studentSurname,studentSchoolAttecnding:studentSchoolAttecnding,studentCurrentGrade:studentCurrentGrade,amount:amount},
	            		success:function(e){
	            		    if(e.length==1){
	            		    	$(".errorRegistrationModea").html("Refreshing...");
	            		    	if(status_new_set=="high school"){
	            		    		loader("highschool");
	            		    	}
	            		    	else{
	            		    		loader("tertiary");
	            		    	}
	            		    }
	            		    else{
	            		    	$(".errorRegistrationModea").attr("style","background:red;color:#45f3ff;").html("Error: "+e);
	            		    }
	            		}
	          		});
				}
			}
		</script>
		<?php
	}
	public function setSelfLearningClass($my_id_new_set,$status_new_set,$studentNameconst,$studentSurname,$studentSchoolAttecnding,$studentCurrentGrade,$amount){
		$params=[$my_id_new_set,$status_new_set,$studentNameconst,$studentSurname,$studentSchoolAttecnding,$studentCurrentGrade,$amount];
		$strParams="sssssss";
		$sql="insert into sgela(my_id,status,name,surname,institution,level,paid,amount,date_reg)values(?,?,?,?,?,?,0,?,NOW())";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>$response);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function autoShowHighSchoolSelfLearning(array $responseDataArray=[]){
		$header_student_inf=$responseDataArray;
		?>
		<script>
			$(document).ready(function(){
				$(document).on('change','.changegrade',function(){
					const changegrade=$(".changegrade").val();
					$.ajax({
						
	            		url:'./controller/ajaxCallProcessor.php',
	            		type:'post',
	            		data:{changegrade:changegrade},
	            		success:function(e){
	            		    if(e.length<=2){
	            		    	$("#grade").html("Refreshing...");
	            		    	loader("highschool");
	            		    }
	            		    else{
	            		    	$("#grade").html("Error: "+e);
	            		    }
	            		}
	          		});
				});
			});
		</script>
		<style>
			.headerSgela{
				width: 100%;
				color:#45f3ff;
				border-bottom: 2px solid #45f3ff;
				padding: 10px 10px;

			}
			.flex{
				size: flex;
			}
			.randomdC{
				width: 100%;
				
			}
			select{
				width: 170px;
			}
			
			

		</style>
		<center>
		<div class="headerSgela flex">
			<div class="randomdC" style="width:30%;padding: 5px 5px;">
			    <h5 id="grade">
			    	<?php
			    		echo $header_student_inf['level'];
			    	?>
			    </h5>
			</div>
			<div class="randomdC" style="width:30%;padding: 5px 5px;">
			    <h6>
			    	<?php
			    		if($header_student_inf['paid']==1){
			    			?>
			    			<h5 style="color:red;font-style: bold;font-family: arial;">NOT PAID</h5>
			    			<?php
			    		}
			    		else{
			    			?>
			    			<h5 style="color:green;font-style: bold;font-family: arial;">PAID</h5>
			    			<?php
			    		}
			    	?>
			    </h6>
			</div>
			<?php if(isset($_GET['_-'])){
			    ?>
			<div class="randomdC" style="width:30%;border:1px solid #45f3ff;color:#45f3ff;border-radius:10px;padding:10px 5px;" onclick="redirectPractice(<?php echo $_GET['_-'];?>)">
			  Exams
			</div>
			    <?php
			    }
			?>
			<div class="randomdC">
			    <select class="changegrade" style="background-color:#212121;color: #45f3ff;">
			    	<option value="">-- Change Grade --</option>
			    	<option value="gr12">Grade 12</option>
			    	<option value="gr11">Grade 11</option>
			    	<option value="gr10">Grade 10</option>
			    	<option value="gr9">Grade 9</option>
			    	<option value="gr8">Grade 8</option>
			    </select>
			</div>
			
			<script>
			    function redirectPractice(subj){
			       loader("highschool&practiceSubj="+subj);
			    }
			</script>
		</div>
		
		<!-- </center> -->

		<?php
		$id=$header_student_inf['my_id'];
		if(isset($_GET['_-'])&&!empty($_GET['_-'])){
	        $subj_id=$_GET['_-'];
	        $subj_info=$this->NetchatSubjInfo($subj_id);
	        if($this->isNetchatSubj($subj_id)){
	            ?>
	            <style>
		
        		    .medLocker{
        		        
        		        width:100%;
        		        
        		        height:80.5vh;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                        hyphens: auto;
                        color:#45f3ff;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
        		</style>
        		<div class="medLocker">
        		    <?php
        		    $getChapterHighSchoolSet=$this->getChapterHighSchoolSet(intval($subj_id));
        		    if(count($getChapterHighSchoolSet)==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Chappters Added for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        foreach($getChapterHighSchoolSet as $row){
            		        $chapter_name=$row['chapter_name'];
            		        $chapter_id=$row['chapter_id'];
            		        $dir="../../img/aa.jpg";
            		        
            		        ?>
            		        <div class="bodyCamp" onclick="dofoUsLeg1(<?php echo $chapter_id;?>)">
            		            <div class="radeMos">
            		                <div class="img-kMover">
                    		            <img src="<?php echo $dir;?>">
                    		        </div>
                    		        <div class="maxcKood">
                    		            <div><small><?php echo $chapter_name;?></small></div>
                    		            <div><small>click to see Content presented for <?php echo $chapter_name;?></small></div>
                    		        </div>
            		            </div>
                    		        
                		    </div>
                    		
            		        <?php
            		    }
        		    }
            		    
        		    ?>
            		    
        		</div>
        		</center>
        		<?php
	        }
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	    }
	    elseif(isset($_GET['_-_'])&&!empty($_GET['_-_'])){
	        $chapter_id=$_GET['_-_'];
	        if($this->isChapterMor($chapter_id)){
	            $chapter_info=$this->getChapterInfo($chapter_id);
	            // print_r($chapter_info);
	            $subj_info=$this->NetchatSubjInfo($chapter_info['subj_id']);
	            ?>
	            <style>
		
        		    .medLocker{
        		        
        		        width:100%;
        		        
        		        height:80.5vh;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                        hyphens: auto;
                        color:#45f3ff;
                        background-color:#fff;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
        		</style>
        		<div class="medLocker" >
        		    <?php
        		    $getConententHighSchool=$this->getConententHighSchool(intval($chapter_id));
        		    if(count($getConententHighSchool)==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Contnent Added for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        foreach($getConententHighSchool as $row){
        		            $ext=explode(".",$row['content']);
        		            $ext=$ext[0];
        		            $subj_id=$row['subj_id'];
                            $chapter_id=$row['chapter_id'];
                            
        		            $dir="../../highschool/".$subj_id."/".$chapter_id."/".$row['content'];
        		            if(in_array($ext,["mp4","MP4","mv","MV"])){
        		                ?>
        		                <video style="width:100%;" controls download='false'>
                                  <source src="<?php echo $dir;?>" type="video/mp4">
                                  <source src="<?php echo $dir;?>" type="video/ogg">
                                  Your browser does not support the video tag.
                                </video>
        		                <?php
        		            }
        		            else{
        		                ?>
        		                <img src="<?php echo $dir;?>" style="width:100%;" download='false'>
        		                <?php
        		            }
        		            
        		        }
        		        
        		    }
            		    
        		    ?>
            		    
        		</div>
        		</center>
	            <?php
	        }
	        
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	        
	    }
	    elseif(isset($_GET['_practiceSubj_']) && !empty($_GET['_practiceSubj_'])){
	        $chapter=$_GET['_practiceSubj_'];
	        if($this->isNetchatSubjpracticeExams($chapter)){
	           // $subj_info=$this->NetchatSubjpracticeExams($chapter);
	            $NetchatSubjpracticeExams=$this->NetchatSubjpracticeExams($chapter);
	            if(count($NetchatSubjpracticeExams)==0){
	                ?>
	                <h4 style="color:red;">Chapter has no practice questions yet!!..</h4>
	                <?php
	            }
	            else{
	                $count=1;
	                foreach($NetchatSubjpracticeExams as $row){
	                    $chapter_id=$row['chapter'];
	                    $subject=$row['subject'];
	                    $question="../../highschool/".$subject."/".$chapter_id."/practice/".$row['question'];
	                    $answer="../../highschool/".$subject."/".$chapter_id."/practice/";
	                    $solution_array=array();
	                    if(!empty($row['a']) && $row['a']!="empty"){
	                        array_push($solution_array,$row['a']);
	                    }
	                    if(!empty($row['b']) && $row['b']!="empty"){
	                        array_push($solution_array,$row['b']);
	                    }
	                    if(!empty($row['c']) && $row['c']!="empty"){
	                        array_push($solution_array,$row['c']);
	                    }
	                    if(!empty($row['d']) && $row['d']!="empty"){
	                        array_push($solution_array,$row['d']);
	                    }
	                    if(!empty($row['e']) && $row['e']!="empty"){
	                        array_push($solution_array,$row['e']);
	                    }
	                    if(!empty($row['f']) && $row['f']!="empty"){
	                        array_push($solution_array,$row['f']);
	                    }
	                    
	                    ?>
        	            <!-- <div class="container"> -->
                            <center><h3>question <?php echo $count;?></h3></center>
                          <div class="displayMode" id="<?php echo $row['id'];?>">
                              <img src="<?php echo $question;?>" style="width:100%;">
                          </div>
                        
                          
        
        	            <?php
        	            $count++;
	                }

	            }        
	        }
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	    }
	    elseif(isset($_GET['practiceSubj']) && !empty($_GET['practiceSubj'])){
	        $subj_id=$_GET['practiceSubj'];
	        if($this->isNetchatSubj($subj_id)){
	            $subj_info=$this->NetchatSubjInfo($subj_id);
	            ?>
	            <style>
		
        		    .medLocker{
        		        width:100%;
        		        height:80.5vh;
        		        overflow-x:auto;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                        hyphens: auto;
                        color:#45f3ff;
        		    }
        		    .medLocker .bodyCamp{
        		        width:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos{
        		        width:100%;
        		        height:auto;
        		        padding:6px;
        		        box-shadow: 0 8px 6px -6px black;
        		        display:flex;
        		        cursor:pointer;
        		    }
        		    .medLocker .bodyCamp .radeMos:hover{
        		        background-color:navy;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover{
        		        width:60px;
        		        height:60px;
        		        border-radius:100%;
        		        padding:10px;
        		    }
        		    .medLocker .bodyCamp .radeMos .img-kMover img{
        		        width:100%;
        		        height:100%;
        		        border-radius:100%;
        		    }
        		</style>
        		<div class="medLocker">
        		    <?php
        		    $netchatsaExamsSubject=$this->netchatsaExamsSubject($subj_id);
        		    if(count($netchatsaExamsSubject)==0){
        		         ?>
            	        <h4 style="color:seagreen;">No Exam Practice for <?php echo $subj_info['subj_name'];?> Yet </h4>
            	        <?php
        		    }
        		    else{
        		        $chapterswithexamquestions=array();
        		       foreach($netchatsaExamsSubject as $row){
        		            $chapter=$row['chapter'];
        		            if(!in_array($chapter,$chapterswithexamquestions)){
        		                array_push($chapterswithexamquestions,$chapter);
        		            }
        		        }
        		        foreach($chapterswithexamquestions as $chapter_id){
        		            $chapter_info=$this->getChapterInfo($chapter_id);
        		           
            		        $chapter_name=$chapter_info['chapter_name'];
            		        
            		        $dir="../../img/aa.jpg";
            		        
            		        ?>
            		        <div class="bodyCamp" onclick="practiceExamQuestionsRedirect(<?php echo $chapter_id;?>)">
            		           
            		            <div class="radeMos">
            		                <div class="img-kMover">
                    		            <img src="<?php echo $dir;?>">
                    		        </div>
                    		        <div class="maxcKood">
                    		            <div><small><?php echo $chapter_name;?></small></div>
                    		            <div><small>click to start exam practice </small></div>
                    		        </div>
            		            </div>
                    		        
                		    </div>
                    		
            		        <?php
            		    }
        		    }  
        		    ?> 
        		</div>
        		<script>
        		    function practiceExamQuestionsRedirect(chapter){
        		        loader("highschool&_practiceSubj_="+chapter);
        		    }
        		</script>
        		</center>
        		<?php
	        }
	        else{
	            ?>
    	        <h4 style="color:red;">Query Not Found!!..</h4>
    	        <?php
	        }
	        
	    }
	    else{
            ?>
            <style>
		
			    .medLocker{
			        
			        width:100%;
			        hyphens: auto;
			        
			        overflow-x:auto;
	                overflow-wrap: break-word;
	                word-wrap: break-word;
	                
	                color:#45f3ff;
			    }
			    .medLocker .bodyCamp{
			        width:100%;
			        padding:10px;
			    }
			    .medLocker .bodyCamp .radeMos{
			        width:100%;
			        height:auto;
			        padding:6px;
			        box-shadow: 0 8px 6px -6px black;
			        display:flex;
			        cursor:pointer;
			    }
			    .medLocker .bodyCamp .radeMos:hover{
			        background-color:#45f3ff;
			        color:#000;
			    }
			    .medLocker .bodyCamp .radeMos .img-kMover{
			        width:60px;
			        height:60px;
			        border-radius:100%;
			        padding:10px;
			    }
			    .medLocker .bodyCamp .radeMos .img-kMover img{
			        width:100%;
			        height:100%;
			        border-radius:100%;
			    }
			</style>
				<div class="medLocker">
				    <?php
				    // echo $header_student_inf['level'];
				    $response =$this->getNetchatsaSubjectsForHighSchool($header_student_inf['level']);
				    $count=0;//
				    foreach($response as $row){
				        $subj_name=$row['subj_name'];
				        $subj_id=$row['subj_id'];
				        $dir="../../img/aa.jpg";
				        
				        ?>
				        <div class="bodyCamp" onclick="dofoUsLeg('<?php echo $subj_id;?>')">
				            <div class="radeMos">
				                <div class="img-kMover">
		        		            <img src="<?php echo $dir;?>">
		        		        </div>
		        		        <div class="maxcKood">
		        		            <div><small><?php echo $subj_name;?></small></div>
		        		            <div><small>click to see all Chapters presented for <?php echo $subj_name;?></small></div>
		        		        </div>
				            </div>
		        		        
		    		    </div>
		        		
				        <?php
				        $count++;
				    }
				    if($count==0){
				    	?>
				    	<h5 style="color:#bbb;border:1px solid #bbb;padding:10px;10px;"> <?php echo $header_student_inf['level']." has not subjects yet!!";?></h5>
				    	<?php
				    }
				    ?>
		    		    
				</div>
        	</center>
        <?php
       	}
	}
	public function autoShowTertiarySelfLearning(array $response){
		// print_r($response);
		$id=$response['my_id'];
	    if(isset($_GET['_u_'])&&!empty($_GET['_u_'])&&isset($_GET['_uu_'])&&!empty($_GET['_uu_'])){
	        $module=$_GET['_u_'];
	        $chapter=$_GET['_uu_'];
	        if($this->ismoduleandisstudent($id,$module) && $this->ischapterandmodule($chapter,$id)) {
	            ?>
                <style>
                    .rain{
                        color:#45f3ff;
                        background-color:navy;
                        border:1px solid #45f3ff;
                        
                    }
                    .rain:hover{
                        background-color:#45f3ff;
                        border:1px solid #000;
                        color:#000;
                    }
                </style>
                <div class="mac" style="width:100%;display:flex;">
                    <div style="width:3%;"></div>
                    <div class="rain" data-toggle="modal" data-target="#install_module" style="padding:0 10px;">Install Module</div>
                    <div style="width:3%;"></div>
                    <div class="rain" >Assessments</div>
                    <div style="width:3%;"></div>
                    <div class="rain" >Results</div>
                </div>
                
                
                <style>
                    .medLocker{
    		        
    		        width:100%;
    		        
    		        
    		        /*overflow-x:auto;
                    overflow-wrap: break-word;
                    word-wrap: break-word;
                    hyphens: auto;*/
                    color:#45f3ff;
    		    }
    		    .medLocker .bodyCamp{
    		        width:100%;
    		        padding:10px;
    		    }
    		    .medLocker .bodyCamp .radeMos{
    		        width:100%;
    		        height:auto;
    		        padding:6px;
    		        box-shadow: 0 8px 6px -6px black;
    		        
    		        
    		        cursor:pointer;
    		    }
    		    .medLocker .bodyCamp .radeMos:hover{
    		        background-color:navy;
    		    }
    		    
    		</style>
    		
                    <div class="medLocker"></div>
                    <div id="load_data_message"></div>
                    <script>
                    $(document).ready(function(){
                     
                     var limit = 7;
                     var start = 0;
                     var action = 'inactive';
                    
                    
                     if(action == 'inactive')
                     {
                      action = 'active';
                      load_country_data(limit, start);
                     }
                     
                     
                    });
                    $(window).scroll(function(){
                      if($(window).scrollTop() + $(window).height() > $(".medLocker").height() && action == 'inactive')
                      {
                       action = 'active';
                       start = start + limit;
                       setTimeout(function(){
                        load_country_data(limit, start);
                       }, 1000);
                      }
                     });
                     function load_country_data(limit, start)
                     {
                      const chapter="<?php echo $chapter?>";
                      $.ajax({
                       url:"./model/fetchUniContent.php",
                       method:"POST",
                       data:{limit:limit, start:start,chapter:chapter},
                       cache:false,
                       success:function(data)
                       {
                        $('.medLocker').append(data);
                        if(data == '')
                        {
                         $('#load_data_message').html("<span type='button' class='btn btn-info'>limit reached</span>");
                         action = 'active';
                        }
                        else
                        {
                         $('#load_data_message').html("<span onclick='load_country_data("+(limit)+", "+(start + limit)+")'>load more</span>");
                         action = "inactive";
                        }
                       }
                      });
                     }
                     </script>
                     
                     
                
                <?php
	        }
	        else{
	            ?>
	            <h2 style="color:red;">Query ID not found!!..</h2>
	            <?php
	        }
	    }
	    elseif(isset($_GET['_u_'])&&!empty($_GET['_u_'])){
	        $module=$this->OMO($_GET['_u_']);
	        // echo"Module Code : ".$module." - Student : ".$id;
	        if($this->ismoduleandisstudent($id,$module)) {
	            ?>
                <style>
                    .btn{
                        color:#45f3ff;
                        background-color:navy;
                        border:1px solid #45f3ff;
                        
                    }
                    .btn:hover{
                        background-color:#45f3ff;
                        border:1px solid #000;
                        color:#000;
                    }
                </style>
                <div class="mac" style="width:100%;display:flex;">
                    <div style="width:3%;"></div><div class="btn" data-toggle="modal" data-target="#install_module">Install Module</div><div style="width:3%;"></div><div class="btn" >Assessments</div><div style="width:3%;"></div><div class="btn" >Results</div>
                </div>
                
                
                <style>
                    .medLocker{
    		        
    		        width:100%;
    		        
    		        
    		        /*overflow-x:auto;
                    overflow-wrap: break-word;
                    word-wrap: break-word;
                    hyphens: auto;*/
                    color:#45f3ff;
    		    }
    		    .medLocker .bodyCamp{
    		        width:100%;
    		        padding:10px;
    		    }
    		    .medLocker .bodyCamp .radeMos{
    		        width:100%;
    		        height:auto;
    		        padding:6px;
    		        box-shadow: 0 8px 6px -6px black;
    		        display:flex;
    		        cursor:pointer;
    		    }
    		    .medLocker .bodyCamp .radeMos:hover{
    		        background-color:navy;
    		    }
    		    .medLocker .bodyCamp .radeMos .img-kMover{
    		        width:60px;
    		        height:60px;
    		        border-radius:100%;
    		        padding:10px;
    		    }
    		    .medLocker .bodyCamp .radeMos .img-kMover img{
    		        width:100%;
    		        height:100%;
    		        border-radius:100%;
    		    }
    		</style>
                    <div class="medLocker">
                    <?php
                    // $_=$conn->query("select*from sgelavarsychapter where module='$module'");
                    $sgelavarsychapter=$this->sgelavarsychapter($module);
                    if(count($sgelavarsychapter)==0){
                        ?>
                        <h5 style="color:red;">No chapters added yet
                        <?php
                    }
                    else{
                        foreach($sgelavarsychapter as $row){
                            
                            
            		        $module_info=$this->getModuleInfo($row['module']);
            		      //  $chapter_info=$this->getModuleChapterInfo($module_id);
            		        $dir="../../img/aa.jpg";
            		        ?>
            		        <div class="bodyCamp" onclick="navtocontent(<?php echo $row['id'];?>,<?php echo $row['module'];?>)">
            		            <div class="radeMos">
            		                <div class="img-kMover">
                    		            <img src="<?php echo $dir;?>">
                    		        </div>
                    		        <div class="maxcKood">
                    		            <div><small><?php echo $row['chapter'];?></small></div>
                    		            <div><small>click to see all Content presented for <?php echo $row['chapter'];?></small></div>
                    		        </div>
            		            </div>
                    		        
                		    </div>
                            <?php
                        }
                    }
                    ?>
                    <script>
                        function navtocontent(chapter_id,module_id){
                            loader("tertiary&_u_="+module_id+"&_uu_="+chapter_id);
                        }
                    </script>
                    </div>
                
                <?php
	            
	            
	            
	            
	            
	        }
	        else{
	            ?>
	            <h3 style="color:red;">ID Query not found!!..</h3>
	            <?php
	        }
	    }
	    else{
		    ?>
            <style>
                .btn{
                        color:#45f3ff;
                        border:1px solid #45f3ff;
                        padding: 10px 10px;
                        
                    }
                    .btn:hover{
                        background-color:#45f3ff;
                        border:1px solid #000;
                        color:#000;
                    }
            </style>
            <div class="mac" style="width:100%;display:flex;">
                <?php
                
                $level=$this->levelInfo($id,"tertiary");//mysqli_fetch_array($conn->query(""))
                ?>
                <div style="width:3%;"></div><div class="btn" data-toggle="modal" data-target="#install_module">Install Module</div><div style="width:3%;"></div><div >
                    <select class="updateLevelVAVA" style="color: #45f3ff;background-color: #212121;">
                        <option value="<?php echo $level['level']?>"><?php echo $level['level']?> Year</option>
                        <option value="1st">1st year</option>
                        <option value="2nd">2nd year</option>
                        <option value="3rd">3rd year</option>
                        <option value="4rth">4rth year</option>
                        <option value="5fth">5fth year</option>
                        <option value="6th">6th year</option>
                        <option value="7nth">7nth year</option>
                    </select>
                </div>
            </div>
            
            
            <style>
                .medLocker{
		        
		        width:100%;
		        
		        
		        /*overflow-x:auto;
                overflow-wrap: break-word;
                word-wrap: break-word;
                hyphens: auto;*/
                color:#45f3ff;
		    }
		    .medLocker .bodyCamp{
		        width:100%;
		        padding:10px;
		    }
		    .medLocker .bodyCamp .radeMos{
		        width:100%;
		        height:auto;
		        padding:6px;
		        box-shadow: 0 8px 6px -6px black;
		        display:flex;
		        cursor:pointer;
		    }
		    .medLocker .bodyCamp .radeMos:hover{
		        background-color:navy;
		    }
		    .medLocker .bodyCamp .radeMos .img-kMover{
		        width:60px;
		        height:60px;
		        border-radius:100%;
		        padding:10px;
		    }
		    .medLocker .bodyCamp .radeMos .img-kMover img{
		        width:100%;
		        height:100%;
		        border-radius:100%;
		    }
		</style>
                <div class="medLocker">
                <?php
                $gelaModuleStudent=$this->gelaModuleStudent($id,$level['level']);
                //$_=$conn->query("select*from sgelamodulestudent where my_id='$id' and level='".$level['level']."'");
                if(count($gelaModuleStudent)==0){
                    ?>
                    <h5 style="color:red;">No modules installed yet, Click <span style="color:#f3f3f3;">'Install Module'</span> to start installation.</h5>
                    <?php
                }
                else{
                    foreach($gelaModuleStudent as $row){
                        
                        $module_id=$row['module'];
        		        $module_info=$this->getModuleInfo($module_id);
        		        $chapter_info=$this->getModuleChapterInfo($module_id);
        		        
        		        $dir="../../img/aa.jpg";
        		        
        		        ?>
        		        <div class="bodyCamp" onclick="navtochapter(<?php echo $module_id;?>)">
        		            <div class="radeMos">
        		                <div class="img-kMover">
                		            <img src="<?php echo $dir;?>">
                		        </div>
                		        <div class="maxcKood">
                		            <div><small><?php echo $module_info['module'];?></small></div>
                		            <div><small>click to see all Chapters presented for <?php echo $module_info['module'];?></small></div>
                		        </div>
        		            </div>
                		        
            		    </div>
                        <?php
                    }
                }
                ?>
                <script>
                    function navtochapter(id){
                       loader("tertiary&_u_="+id);
                    }
                </script>
                </div>
            
            <?php
	    }
	}
	public function getAllModules(){
		$sql="select*from sgelavarsymodules";
		$params=[];
		$strParams="";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	//$_=$conn->query("select*from sgelavarsychapter where module='$module'");
    protected function sgelavarsychapter($module){
    	$sql="select*from sgelavarsychapter where module=?";
		$params=[$module];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
    }
	protected function levelInfo(string $id="",string $status="high school"){
		$sql="select*from sgela where my_id=? and status=?";
		$params=[$id,$status];
		$strParams="ss";
		return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	protected function gelaModuleStudent($id,$level){
		$sql="select*from sgelamodulestudent where my_id=? and level=?";
		$params=[$id,$level];
		$strParams="ss";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getModuleInfo($module_id){
	    $sql="select*from sgelavarsymodules where id=?";
		$params=[$module_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function getModuleChapterInfo($module_id){
	    $sql="select*from sgelavarsychapter where module=?";
		$params=[$module_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	protected function ismoduleandisstudent($std,$module){
	    $sql="select my_id, module from sgelamodulestudent where my_id=? AND module=?";
		$params=[$std,$module];
		$strParams="ss";
		return ($this->numRows($sql,$strParams,$params)>0);
	}
	protected function ischapterandmodule($chapter_id,$id){
	    $sql="select module from sgelavarsychapter where id=?";
		$params=[$chapter_id];
		$strParams="s";
		$response=$this->getAllDataSafely($sql,$strParams,$params)[0];
		if(count($response)==0){
	        return false;
	    }
	    else{
	        $module=$response['module'];
	        return $this->ismoduleandisstudent($id,$module);
	    }
	}
	protected function netchatsaExamsSubject(int $subj_id=0){
		$sql="select*from exampractice where subject=?";
		$params=[$subj_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	protected function NetchatSubjpracticeExams(int $chapter=0){
	    $sql="select*from exampractice where chapter=?";
		$params=[$chapter];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getdisplayModeAnswers(int $displayModeAnswers=0){
		$sql="select * from exampractice where id=?";
		$params=[$displayModeAnswers];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	protected function getChapterInfo(int $chapter_id=0){
	    $sql="select*from netchatsa_subjects_chapters where chapter_id=?";
		$params=[$chapter_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	protected function NetchatSubjInfo(int $subj_id=0):array{
	    $sql="select*from netchatsa_subjects where subj_id=?";
		$params=[$subj_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	protected function isChapterMor($chapter_id){
	    $sql="select*from netchatsa_subjects_chapters where chapter_id=?";
		$params=[$chapter_id];
		$strParams="s";
		return ($this->numRows($sql,$strParams,$params)==1);
	}
	protected function isNetchatSubjpracticeExams($chapter){
	    $sql="select*from exampractice where chapter=?";
		$params=[$chapter];
		$strParams="s";
		return ($this->numRows($sql,$strParams,$params)>0);
	}
	protected function isNetchatSubj($subj_id){
	    $sql="select*from netchatsa_subjects where subj_id=?";
		$params=[$subj_id];
		$strParams="s";
		return ($this->numRows($sql,$strParams,$params)==1);
	}
	protected function getConententHighSchool(int $chapter_id=0){
		$sql="select*from netchatsa_content where chapter_id=? order by time_added DESC";
		$params=[$chapter_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getNetchatsaSubjectsForHighSchool(string $level=""){
		$sql="select*from netchatsa_subjects where level=?";
		$params=[$level];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	protected function getChapterHighSchoolSet(int $subj_id=0){
	//'
		$sql="select*from netchatsa_subjects_chapters where subj_id=?";
		$params=[$subj_id];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function GetmatricUpgradeChapterInfo($MatricChapterId){
	    $sql="select*from matricupgradesubjchapter where id=?";
	    $strParams="s";
	    $params=[$MatricChapterId];
	    return $this->getAllDataSafely($sql,$strParams,$params)[0];
	    //return mysqli_fetch_array($conn->query("select*from matricupgradesubjchapter where id='$MatricChapterId'"));
	}
	public function changegrade($changegrade,$my_id){
		$params=[$changegrade,$my_id];
		$strParams="ss";
		$sql="update sgela set level=? where my_id=?";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>1);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	public function ngezelaEsinyeIsifundo($position,$subjModelAddSunject,$id){
		$params=[$position,$subjModelAddSunject,$id];
		$strParams="sss";
		$sql="update matricupgrade set ?=? where id=?";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>1);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
	}
	protected function isSubjectId($subj_id){
	    $sql="select*from netchatsa_subjects where subj_id=?";
	    $params=[$subj_id];
	    $strParams="s";
	    return ($this->numRows($sql,$strParams,$params)!=0);
	}
	protected function isChapter($chapter){
       $sql="select*from netchatsa_subjects_chapters where chapter_id=?";
       $params=[$chapter];
       $strParams="s";
	   return ($this->numRows($sql,$strParams,$params)!=0);
    }
    protected function getChaterInfo($chapter){
       $sql="select*from netchatsa_subjects_chapters where chapter_id=?";
       $params=[$chapter];
       $strParams="s";
       return $this->getAllDataSafely($sql,$strParams,$params)??[];
    }
    protected function getSubjInfo($subj_id){
	    $sql="select*from netchatsa_subjects where subj_id=?";
	    $params=[$subj_id];
	    $strParams="s";
        return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function getMusicType(string $type=""):array{
		$sql="select*from track where type_music=? order by time_uploaded DESC";
		$params=[$type];
	    $strParams="s";
        return $this->getAllDataSafely($sql,$strParams,$params)??[];

	}
	public function getTrackOfThisRecordingLabel(int $recording_label=0):array{
	    $sql="select*from track where recording_label=? order by time_uploaded DESC";
		$params=[$recording_label];
	    $strParams="s";
        return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
    public function getTrackMusicOfTRhisAlbum(int $album=0):array{
        $sql="select*from track where album=? order by time_uploaded DESC";
		$params=[$album];
	    $strParams="s";
        return $this->getAllDataSafely($sql,$strParams,$params)??[];
    }
    public function getTracksMusicArtist(int $artist=0):array{
        $sql="select*from track where artist=? order by time_uploaded DESC";
		$params=[$artist];
	    $strParams="s";
        return $this->getAllDataSafely($sql,$strParams,$params)??[];
    }
	public function getTracksMusic(string $orderBy=""){
		$sql="select*from track order by ? DESC";
		$params=[$orderBy];
		$strParams="s";
		return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getRecordingLabel($id){
        $sql="select* from recording_label where id=?";
      	$params=[$id];
	  	$strParams="s";
	  	return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
    }
    public function getAlbuminfo($id){
        $sql="select* from album where id=?";
        $params=[$id];
	  	$strParams="s";
	  	return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
    }
    public function getArtistInfo($id){
        $sql="select* from artist where id=?";
        $params=[$id];
	  	$strParams="s";
	  	return $this->getAllDataSafely($sql,$strParams,$params)[0]??[];
    }
    public function type_music(){
    	$sql="select*from type_music";
    	$params=[];
	  	$strParams="";
	  	return $this->getAllDataSafely($sql,$strParams,$params)??[];
    }
    public function getSgelavarsychapters(int $chapter=0,int $limit=0,int $start=0){
		$sql="select*from sgelavarsychapters where chapter=? limit ?,?";
    	$params=[$chapter,$start,$limit];
	  	$strParams="sss";
	  	return $this->getAllDataSafely($sql,$strParams,$params)??[];
	}
    public function trackLikes(int $track_id=0){
    	$sql="select id from song_likes where track=?";
    	$params=[$track_id];
	  	$strParams="s";
	  	return $this->numRows($sql,$strParams,$params);
    }
    public function submitAppVersionUpdate($updateVersionId,$NewVersion){
        $updateFromURL = "../../../accounts/ljisdjo%20sgjeoig_grekmogiemoe25674/";
        $url = explode("/",$_SERVER['REQUEST_URI']);
	    $url=str_replace("%20", " ",$url[2]);
	    $response = $this->copyUpdate();
	    if($response['response']=="F"){
	        return $response;
	    }
        $params=[$NewVersion,$updateVersionId];
		$strParams="ss";
		$sql="update create_runaccount set version=? where id=?";
		$response=$this->postDataSafely($sql,$strParams,$params);
		if(is_numeric($response)){
			return array("response"=>"S","data"=>1);
		}
		else{
			return array("response"=>"F","data"=>$response);
		}
    }
    protected function copyUpdate(string $userDir=".."){
        $count=0;
	    $sodo=0;
	    $totalCount=0;
	    $dir = "../../../";
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/index.php",$userDir."/index.php")?  $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/view/index.php",$userDir."/view/index.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/view/left.php",$userDir."/view/left.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/view/center.php",$userDir."/view/center.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/view/view.php",$userDir."/view/view.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/controller/ajaxCallProcessor.php",$userDir."/controller/ajaxCallProcessor.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/controller/pdo.php",$userDir."/controller/pdo.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/apply.php",$userDir."/model/apply.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/asifundeSonke.php",$userDir."/model/asifundeSonke.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/campusSelectLoader.php",$userDir."/model/campusSelectLoader.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/CourseSelectLoader.php",$userDir."/model/CourseSelectLoader.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/dataFetchAnswers.php",$userDir."/model/dataFetchAnswers.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/esGela.php",$userDir."/model/esGela.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/fetchUniContent.php",$userDir."/model/fetchUniContent.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/hh.php",$userDir."/model/hh.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/highschool.php",$userDir."/model/highschool.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/izihlabelelo.php",$userDir."/model/izihlabelelo.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/learn2code.php",$userDir."/model/learn2code.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/loadStudyAreaReply.php",$userDir."/model/loadStudyAreaReply.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/loadStudyAreaReplyRedirector.php",$userDir."/model/loadStudyAreaReplyRedirector.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/matricUpgrade.php",$userDir."/model/matricUpgrade.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/myBlockedUsers.php",$userDir."/model/myBlockedUsers.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/myFlaggedUser.php",$userDir."/model/myFlaggedUser.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/myProfile.php",$userDir."/model/myProfile.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/notification.php",$userDir."/model/notification.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/searchOnStudyArea.php",$userDir."/model/searchOnStudyArea.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/studyAreaCodeReplyModal.php",$userDir."/model/studyAreaCodeReplyModal.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/studyAreaRepliesLoader.php",$userDir."/model/studyAreaRepliesLoader.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/studyAreaTextImgReplyModal.php",$userDir."/model/studyAreaTextImgReplyModal.php")? $count++:$sodo++;$totalCount++;
	        
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/success.php",$userDir."/model/success.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/tertiary.php",$userDir."/model/tertiary.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/tertiaryMonthlyPayment.php",$userDir."/model/tertiaryMonthlyPayment.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/tertiaryMonthlyPaymentSuccess.php",$userDir."/model/tertiaryMonthlyPaymentSuccess.php")? $count++:$sodo++;$totalCount++;
	    copy("{$dir}accounts/ljisdjo sgjeoig_grekmogiemoe25674/model/tutoring.php",$userDir."/model/tutoring.php")? $count++:$sodo++;$totalCount++;
	  
		if(true){
		    return array("response"=>"S","data"=>"Files updated");
		}
		else{
		    return array("response"=>"F","data"=>"failed to create Directory!. Internal Error. Please contact 068 515 3023 whatsApp Support to report the issue");
		}
    }

}
?>