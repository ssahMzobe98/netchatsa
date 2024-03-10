<?php
namespace Src\Classes\Pdo;
use App\Providers\Response\Response;
use App\Providers\TraitService\DBConnectServiceTrait;
use App\Providers\Constants\StatusConstants;
use App\Providers\Constants\Flags;
class MusicPdo{
	use DBConnectServiceTrait;
	public function track_id_likeSendFunction(int $track_id_like=0,string $my_id=""):Response{
	    $sql="INSERT into song_likes(track,my_id)values(?,?)";
	    return $this->connect->postDataSafely($sql,'ss',[$track_id_like,$my_id]);
	}
	protected function getNumDownloadsOfThisTrack(int $trackId=0):int{
	    $sql="SELECT downloads from track where id=?";
	    return $this->connect->numRows($sql,'s',[$trackId]);
	}
    public function track_downloadSendFunction(int $track_download=0):Response{
        $currNumDownload=$this->getNumDownloadsOfThisTrack($track_download)+1;
        $sql="UPDATE track set downloads=? where id=?";
        return $this->connect->postDataSafely($sql,'ss',[$currNumDownload,$track_download]);
    }
    public function getMusicType(string $type=""):array{
		$sql="SELECT * from track where type_music=? order by time_uploaded DESC";
		$params=[$type];
	    $strParams="s";
        return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];

	}
	public function getTrackOfThisRecordingLabel(int $recording_label=0):array{
	    $sql="SELECT * from track where recording_label=? order by time_uploaded DESC";
		$params=[$recording_label];
	    $strParams="s";
        return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
    public function getTrackMusicOfTRhisAlbum(int $album=0):array{
        $sql="SELECT * from track where album=? order by time_uploaded DESC";
		$params=[$album];
	    $strParams="s";
        return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
    }
    public function getTracksMusicArtist(int $artist=0):array{
        $sql="SELECT * from track where artist=? order by time_uploaded DESC";
		$params=[$artist];
	    $strParams="s";
        return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
    }
	public function getTracksMusic(string $orderBy=""):array{
		$sql="SELECT * from track order by ? DESC";
		$params=[$orderBy];
		$strParams="s";
		return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function getRecordingLabel($id):array{
        $sql="SELECT *  from recording_label where id=?";
      	$params=[$id];
	  	$strParams="s";
	  	return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
    }
    public function getAlbuminfo($id):array{
        $sql="SELECT *  from album where id=?";
        $params=[$id];
	  	$strParams="s";
	  	return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
    }
    public function getArtistInfo($id):array{
        $sql="SELECT *  from artist where id=?";
        $params=[$id];
	  	$strParams="s";
	  	return $this->connect->getAllDataSafely($sql,$strParams,$params)[0]??[];
    }
    public function type_music():array{
    	$sql="SELECT * from type_music";
    	$params=[];
	  	$strParams="";
	  	return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
    }
    public function getSgelavarsychapters(int $chapter=0,int $limit=0,int $start=0):array{
		$sql="SELECT * from sgelavarsychapters where chapter=? limit ?,?";
    	$params=[$chapter,$start,$limit];
	  	$strParams="sss";
	  	return $this->connect->getAllDataSafely($sql,$strParams,$params)??[];
	}
	public function trackLikes(int $track_id=0):int{
    	$sql="SELECT id from song_likes where track=?";
    	$params=[$track_id];
	  	$strParams="s";
	  	return $this->connect->numRows($sql,$strParams,$params)??0;
    }
}