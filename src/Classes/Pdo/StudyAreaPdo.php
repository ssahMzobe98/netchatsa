<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\Flags;
class StudyAreaPdo{
	use DBConnectServiceTrait;
	public function fakaImpenduloKa_AsifundeSonke(int $iscode=0,string $post_id="",string $text="",string $img="",string $mp4="",string $id=""):Response{
		$params=[$iscode,$post_id,$text,$img,$mp4,$id];
		$sql="INSERT into studyareareply(iscode,post_id,text,img,video,posted_by,time_posted)values(?,?,?,?,?,?,NOW())";
		$strParams="ssssss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function hambisaUmbuzoWeCode($studyAreaMathTitleCode,$studyAreaMathCode,$my_id):Response{
		$params=[$studyAreaMathTitleCode,$studyAreaMathCode,$my_id];
		$sql="INSERT into studyarea(iscode,title,text,img,video,posted_by,time_posted)values(1,?,?,0,0,?,NOW())";
		$strParams="sss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function addViewCounts($post_id,$my_id):Response{
		$params=[$post_id,$my_id];
		$strParams="ss";
		$sql="INSERT into views(post_id,viewed_by,time_viewed)values(?,?,NOW())";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function addLikeCounts($post_id,$my_id):Response{
		$params=[$post_id,$my_id];
		$strParams="ss";
		$sql="INSERT into likes(post_id,user,time_liked)values(?,?,NOW())";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	// public function getNumLikes
	public function addDislikeCounts($post_id,$my_id):Response{
		$params=[$post_id,$my_id];
		$strParams="ss";
		$sql="INSERT into dislikes(post_id,disliked_by,time_disliked)values(?,?,NOW())";
		return $this->connect->postDataSafely($sql,$strParams,$params);
		
	}
	public function hambisaNoneCodeAsifunde($iscode,$title,$text,$img,$mp4,$my_id):Response{
		$params=[$iscode,$title,$text,$img,$mp4,$my_id];
		$sql="INSERT into studyarea(iscode,title,text,img,video,posted_by,time_posted)values(?,?,?,?,?,?,NOW())";
		$strParams="ssssss";
		return $this->connect->postDataSafely($sql,$strParams,$params);
	}
	public function getPostOfThisUid(int $post_id=0):array{
		$params=[$post_id];
		$strParams="s";
		$sql="SELECT *from studyarea where post_id=?";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];

	}
	public function getRepliesOfThisPost(int $post_id=0,int $min=0,int $max=0,string $id=""):array{
		$params=[$id,$id,$post_id,$min,$max];
		$strParams="sssss";
		// $sql="select*from studyareareply where post_id=? ORDER BY time_posted DESC limit ?,?";
		$sql="SELECT * FROM studyareareply where posted_by  NOT IN (select flaggee COLLATE utf8mb4_unicode_ci from flagged_use_list where flagger=?) and posted_by NOT IN(select blockee COLLATE utf8mb4_unicode_ci from blocked_user_list where blocker=?) and post_id=? ORDER BY time_posted DESC limit ?,?";
		return  $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	
	public function getAsifundeSonke(int $min=0,int $max=7,string $id=""){
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
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getOtherUser($poster_my_id):array{
		$sql="SELECT *from create_runaccount where my_id=?";
		$params=[$poster_my_id];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
	}
	public function getNumViews($post_id):int{
		$sql="SELECT *from views where post_id=?";
		$params=[$post_id];
		$strParams="s";
		return $this->connect->numRows($sql,$strParams,$params);
	}
	public function getNumDislike($post_id):int{
		$sql="SELECT *from dislikes where post_id=?";
		$params=[$post_id];
		$strParams="s";
		return $this->connect->numRows($sql,$strParams,$params);
	}
	public function getNumLikes($post_id):int{
		$sql="SELECT *from likes where post_id=?";
		$params=[$post_id];
		$strParams="s";
		return $this->connect->numRows($sql,$strParams,$params);
	}
	public function getNumOfReply($post_id):int{
		$sql="SELECT *from studyareareply where post_id=?";
		$params=[$post_id];
		$strParams="s";
		return $this->connect->numRows($sql,$strParams,$params);
	}
	public function getSearchItemsForStudyArea(string $search ="",string $id=""):array{
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
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
}
?>