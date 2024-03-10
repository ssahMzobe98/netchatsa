<?php
include_once("../../vendor/autoload.php");
use Src\Classes\Pdo\UserPdo;
use App\Providers\Constants\ServiceConstants;
use App\Providers\Constants\StatusConstants;
use App\Providers\Factory\PDOServiceFactory;
use App\Providers\Constants\Flags;
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
if(isset($_SESSION['usermail'])){
	// require_once("../controller/pdo.php");
	$userPdo = PDOServiceFactory::make(ServiceConstants::USER,[null]);
	$musicPdo = PDOServiceFactory::make(ServiceConstants::MUSIC_PDO,[$userPdo->connect]);
	$cur_user_row=$userPdo->getUserInfo(Flags::USER_EMAIL_COLUMN,$_SESSION['usermail']);
		?>

		<section class="welcome-area"  >
		      <!-- Welcome Slides -->
		      <div class="welcome-slides owl-carousel" >

		        <!-- Single Welcome Slide Active(duplicate when necessary!!) -->
		        <div class="welcome-welcome-slide bg-img bg-overlay" style=";width:100%;">
		          <div class="container h-100">
		            <div class="row h-100 align-items-center">
		              <div class="col-12">
		                <!-- Welcome Text 1 -->
		                <div class="welcome-text">
		                    <style>
		                        div.scrollmenu {
                                  background-color: #333;
                                  overflow: auto;
                                  white-space: nowrap;
                                  width:100%;
                                }
                                
                                div.scrollmenu a {
                                  display: inline-block;
                                  color: #45f3ff;
                                  text-align: center;
                                  padding: 5px;
                                  text-decoration: none;
                                }
                                
                                div.scrollmenu a:hover {
                                  background-color: #777;
																}
		                    </style>
		                    <div class="scrollmenu">
                              <a onclick="loader('izihlabelelo&downloads')" <?php if(isset($_GET['downloads'])){ echo'style="border:1px solid #45f3ff;color:white;"';}?>>Most Downloaded</a>
                              <a onclick="loader('izihlabelelo&latest_release')" <?php if(isset($_GET['latest_release'])){ echo'style="border:1px solid #45f3ff;color:white;"';}?>>Recent Release</a>
                              
                              <?php
                    	      $_aa=$musicPdo->type_music();
                    	      foreach($_aa as $row){
                    	          ?>
                    	          <a onclick="loader('izihlabelelo&music=<?php echo $row['id'];?>')" <?php if(isset($_GET['music']) && $_GET['music']==$row['id']){ echo'style="border:1px solid #45f3ff;color:white;"';}?> ><?php echo $row['type_music_name'];?></a>
                    	          <?php
                    	      }
                    	      ?>
                              
                            </div>
		                    <br>
		                  <div class="welcome-btn-groupt" style="">
		                      <style>
		                          .flex-wrap{
		                              background-color:#333;
		                              /*border:1px solid #45f3ff;*/
		                              box-shadow:-3px 4px 6px 6px black;
		                              
		                          }
		                      </style>
		                      <?php
		                      if(isset($_GET['music'])){
		                          $type_of_music=$_GET['music'];

		                          $_display=$musicPdo->getMusicType($type_of_music);
		                          if(count($_display)==0){
		                              ?>
		                              <h5 style="color:red;">No Music Loaded</h5>
		                              <?php
		                          }
		                          else{
		                              
		                          
		                             foreach($_display as $row){
		                                  $recording_label=$musicPdo->getRecordingLabel($row['recording_label']);
		                                  $album="";
		                                 $album_info="";
		                                  if($row['album']<1){
		                                      $album="Single Release";
		                                  }
		                                  else{
		                                      $album_info=$musicPdo->getAlbuminfo($row['album']);
		                                      $album=$album_info['album_name'];
		                                  }
		                                  $artist_info=$musicPdo->getArtistInfo($row['artist']);
		                                  $publish_date=$row['time_uploaded'];
		                                  $song_name=$row['track_name'];
		                                  $artist=$artist_info['artist_stage_name'];
		                                  $label=$recording_label['recording_label'];
		                                  $dir_img="../../logo/".$row['track_logo'];
		                                  $dir_mp3="../../track/".$row['track_mp3'];
		                                  $track_id=$row['id'];
		                                  ?>
		                                  <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms" style="background: #333;margin-top: -3%;width:100%;">
		                                  <div class="poca-music-thumbnail" style="width:100%;">
		                                    <img src="<?php echo $dir_img;?>" alt="" style="width:100%;">
		                                  </div>
		                                  <div class="poca-music-content" style="width:100%;">
		                                    <span class="music-published-date"><?php echo $publish_date;?> <small style="font-size:7px;padding:2px;border-radius:50px;background-color:#333;color:#45f3ff;border:1px solid #45f3ff;">new</small></span>
		                                    <h2><?php echo $song_name;?></h2>
		                                    <div class="music-meta-data">
		                                      <p>By <a onclick="loader('izihlabelelo&artist=<?php echo $row['artist'];?>')" class="music-author"><?php if(strlen($artist)<10){ echo $artist;}else{ for($i=0;$i<10;$i++){echo $artist[$i];}echo".."; }?></a> | <a onclick="loader('izihlabelelo&recording_label=<?php echo $row['recording_label'];?>')" class="music-catagory"><?php echo $label; ?></a> | <a onclick="loader('izihlabelelo&album=<?php echo $row['album'];?>')" class="music-duration"><?php echo $album;?></a></p>
		                                    </div>
		                                    <!-- Music Player -->
		                                    <div class="poca-music-player" style="width:100%;color:#45f3ff;background-color:#282828;">
		                                      <audio preload="auto" controls controlsList="nodownload" style="width:100%; color:#45f3ff;background-color:#282828;">
		                                        <source src="<?php echo $dir_mp3;?>" style="width:100%;">
		                                      </audio>
		                                    </div>
		                                    <!-- Likes, Share & Download -->
		                                    <div class="likes-share-download d-flex align-items-center justify-content-between">
		                                      <a onclick="likeSong(<?php echo $track_id;?>)" class="<?php echo $track_id;?>"><i class="fa fa-heart" aria-hidden="true"></i>(<?php
		                                      
		                                       echo $musicPdo->trackLikes($track_id);
		                                    ?>)</a>
		                                      <div>
		                                        <a  class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                        <a onclick="download_song(<?php echo $track_id;?>)" id="<?php echo $track_id;?>" href="<?php echo $dir_mp3;?>" download><i class="fa fa-download" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                      </div>
		                                    </div>
		                                  </div>
		                                </div>
		                                <br>
		                              <?php
		                              }
		                          }
		                      }
		                      elseif(isset($_GET['recording_label'])){
		                          $_display=$musicPdo->getTrackOfThisRecordingLabel($_GET['recording_label']);
		                          if(count($_display)==0){
		                              ?>
		                              <h5 style="color:red;">No Music Loaded</h5>
		                              <?php
		                          }
		                          else{
										foreach($_display as $row){
		                                  $recording_label=$musicPdo->getRecordingLabel($row['recording_label']);
		                                  $album="";
		                                  $album_info="";
		                                  if($row['album']<1){
		                                      $album="Single Release";
		                                  }
		                                  else{
		                                      $album_info=$musicPdo->getAlbuminfo($row['album']);
		                                      $album=$album_info['album_name'];
		                                  }
		                                  $artist_info=$musicPdo->getArtistInfo($row['artist']);
		                                  $publish_date=$row['time_uploaded'];
		                                  $song_name=$row['track_name'];
		                                  $artist=$artist_info['artist_stage_name'];
		                                  $label=$recording_label['recording_label'];
		                                  $dir_img="../../logo/".$row['track_logo'];
		                                  $dir_mp3="../../track/".$row['track_mp3'];
		                                  $track_id=$row['id'];
		                                  ?>
		                                  <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms" style="background: #333;margin-top: -3%;">
		                                  <div class="poca-music-thumbnail" style="width:100%;">
		                                    <img src="<?php echo $dir_img;?>" alt="" style="width:100%;">
		                                  </div>
		                                  <div class="poca-music-content" style="width:100%;">
		                                    <span class="music-published-date"><?php echo $publish_date;?><small style="font-size:7px;padding:2px;border-radius:50px;background-color:#333;color:#45f3ff;border:1px solid #45f3ff;">new</small></span>
		                                    <h2><?php echo $song_name;?></h2>
		                                    <div class="music-meta-data">
		                                      <p>By <a onclick="loader('izihlabelelo&artist=<?php echo $row['artist'];?>')" class="music-author"><?php if(strlen($artist)<10){ echo $artist;}else{ for($i=0;$i<10;$i++){echo $artist[$i];}echo".."; }?></a> | <a onclick="loader('izihlabelelo&recording_label=<?php echo $row['recording_label'];?>')" class="music-catagory"><?php echo $label; ?></a> | <a onclick="loader('izihlabelelo&album=<?php echo $row['album'];?>')" class="music-duration"><?php echo $album;?></a></p>
		                                    </div>
		                                    <!-- Music Player -->
		                                    <div class="poca-music-player" style="width:100%;color:#45f3ff;background-color:#282828;">
		                                      <audio preload="auto" controls controlsList="nodownload" style="width:100%; color:#45f3ff;background-color:#282828;">
		                                        <source src="<?php echo $dir_mp3;?>" style="width:100%;">
		                                      </audio>
		                                    </div>
		                                    <!-- Likes, Share & Download -->
		                                    <div class="likes-share-download d-flex align-items-center justify-content-between">
		                                      <a onclick="likeSong(<?php echo $track_id;?>)" class="<?php echo $track_id;?>"><i class="fa fa-heart" aria-hidden="true"></i>(<?php
		                                      
		                                       echo $musicPdo->trackLikes($track_id);
		                                    ?>)</a>
		                                      <div>
		                                        <a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                        <a onclick="download_song(<?php echo $track_id;?>)" id="<?php echo $track_id;?>" href="<?php echo $dir_mp3;?>" download><i class="fa fa-download" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                      </div>
		                                    </div>
		                                  </div>
		                                </div>
		                                <br>
		                              <?php
		                              }
		                          }
		                      }
                              elseif(isset($_GET['album'])){
                                  $_display=$musicPdo->getTrackMusicOfTRhisAlbum($_GET['album']);
		                          if(count($_display)==0){
		                              ?>
		                              <h5 style="color:red;">No Music Loaded</h5>
		                              <?php
		                          }
		                          else{
										foreach($_display as $row){
		                                  $recording_label=$musicPdo->getRecordingLabel($row['recording_label']);
		                                  $album="";
		                                  $album_info="";
		                                  if($row['album']<1){
		                                      $album="Single Release";
		                                  }
		                                  else{
		                                      $album_info=$musicPdo->getAlbuminfo($row['album']);
		                                      $album=$album_info['album_name'];
		                                  }
		                                  $artist_info=$musicPdo->getArtistInfo($row['artist']);
		                                  $publish_date=$row['time_uploaded'];
		                                  $song_name=$row['track_name'];
		                                  $artist=$artist_info['artist_stage_name'];
		                                  $label=$recording_label['recording_label'];
		                                  $dir_img="../../logo/".$row['track_logo'];
		                                  $dir_mp3="../../track/".$row['track_mp3'];
		                                  $track_id=$row['id'];
		                                  ?>
		                                  <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms" style="background: #333;margin-top: -3%;">
		                                  <div class="poca-music-thumbnail" style="width:100%;">
		                                    <img src="<?php echo $dir_img;?>" alt="" style="width:100%;">
		                                  </div>
		                                  <div class="poca-music-content" style="width:100%;">
		                                    <span class="music-published-date"><?php echo $publish_date;?><small style="font-size:7px;padding:2px;border-radius:50px;background-color:#333;color:#45f3ff;border:1px solid #45f3ff;">new</small></span>
		                                    <h2><?php echo $song_name;?></h2>
		                                    <div class="music-meta-data">
		                                      <p>By <a onclick="loader('izihlabelelo&artist=<?php echo $row['artist'];?>')" class="music-author"><?php if(strlen($artist)<10){ echo $artist;}else{ for($i=0;$i<10;$i++){echo $artist[$i];}echo".."; }?></a> | <a onclick="loader('izihlabelelo&recording_label=<?php echo $row['recording_label'];?>')" class="music-catagory"><?php echo $label; ?></a> | <a onclick="loader('izihlabelelo&album=<?php echo $row['album'];?>')" class="music-duration"><?php echo $album;?></a></p>
		                                    </div>
		                                    <!-- Music Player -->
		                                    <div class="poca-music-player" style="width:100%;color:#45f3ff;background-color:#282828;">
		                                      <audio preload="auto" controls controlsList="nodownload" style="width:100%; color:#45f3ff;background-color:#282828;">
		                                        <source src="<?php echo $dir_mp3;?>" style="width:100%;">
		                                      </audio>
		                                    </div>
		                                    <!-- Likes, Share & Download -->
		                                    <div class="likes-share-download d-flex align-items-center justify-content-between">
		                                      <a onclick="likeSong(<?php echo $track_id;?>)" class="<?php echo $track_id;?>"><i class="fa fa-heart" aria-hidden="true"></i>(<?php
		                                      
		                                       echo $musicPdo->trackLikes($track_id);
		                                    ?>)</a>
		                                      <div>
		                                        <a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                        <a onclick="download_song(<?php echo $track_id;?>)" id="<?php echo $track_id;?>" href="<?php echo $dir_mp3;?>" download><i class="fa fa-download" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                      </div>
		                                    </div>
		                                  </div>
		                                </div>
		                                <br>
		                              <?php
		                              }
		                          }
                              }
		                      elseif(isset($_GET['latest_release'])){
		                          $_display=$musicPdo->getTracksMusic("time_uploaded");
		                          if(count($_display)==0){
		                              ?>
		                              <h5 style="color:red;">No Music Loaded</h5>
		                              <?php
		                          }
		                          else{
										foreach($_display as $row){
		                                  $recording_label=$musicPdo->getRecordingLabel($row['recording_label']);
		                                  $album="";
		                                  $album_info="";
		                                  if($row['album']<1){
		                                      $album="Single Release";
		                                  }
		                                  else{
		                                      $album_info=$musicPdo->getAlbuminfo($row['album']);
		                                      $album=$album_info['album_name'];
		                                  }
		                                  $artist_info=$musicPdo->getArtistInfo($row['artist']);
		                                  $publish_date=$row['time_uploaded'];
		                                  $song_name=$row['track_name'];
		                                  $artist=$artist_info['artist_stage_name'];
		                                  $label=$recording_label['recording_label'];
		                                  $dir_img="../../logo/".$row['track_logo'];
		                                  $dir_mp3="../../track/".$row['track_mp3'];
		                                  $track_id=$row['id'];
		                                  ?>
		                                  <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms" style="background: #333;margin-top: -3%;">
		                                  <div class="poca-music-thumbnail" style="width:100%;">
		                                    <img src="<?php echo $dir_img;?>" alt="" style="width:100%;">
		                                  </div>
		                                  <div class="poca-music-content" style="width:100%;">
		                                    <span class="music-published-date"><?php echo $publish_date;?><small style="font-size:7px;padding:2px;border-radius:50px;background-color:#333;color:#45f3ff;border:1px solid #45f3ff;">new</small></span>
		                                    <h2><?php echo $song_name;?></h2>
		                                    <div class="music-meta-data">
		                                      <p>By <a onclick="loader('izihlabelelo&artist=<?php echo $row['artist'];?>')" class="music-author"><?php if(strlen($artist)<10){ echo $artist;}else{ for($i=0;$i<10;$i++){echo $artist[$i];}echo".."; }?></a> | <a onclick="loader('izihlabelelo&recording_label=<?php echo $row['recording_label'];?>')" class="music-catagory"><?php echo $label; ?></a> | <a onclick="loader('izihlabelelo&album=<?php echo $row['album'];?>')" class="music-duration"><?php echo $album;?></a></p>
		                                    </div>
		                                    <!-- Music Player -->
		                                    <div class="poca-music-player" style="width:100%;color:#45f3ff;background-color:#282828;">
		                                      <audio preload="auto" controls controlsList="nodownload" style="width:100%; color:#45f3ff;background-color:#282828;">
		                                        <source src="<?php echo $dir_mp3;?>" style="width:100%;">
		                                      </audio>
		                                    </div>
		                                    <!-- Likes, Share & Download -->
		                                    <div class="likes-share-download d-flex align-items-center justify-content-between">
		                                      <a onclick="likeSong(<?php echo $track_id;?>)" class="<?php echo $track_id;?>"><i class="fa fa-heart" aria-hidden="true"></i>(<?php
		                                      
		                                       echo $musicPdo->trackLikes($track_id);
		                                    ?>)</a>
		                                      <div>
		                                        <a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                        <a onclick="download_song(<?php echo $track_id;?>)" id="<?php echo $track_id;?>" href="<?php echo $dir_mp3;?>" download><i class="fa fa-download" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                      </div>
		                                    </div>
		                                  </div>
		                                </div>
		                                <br>
		                              <?php
		                              }
		                          }
		                      }
		                      elseif(isset($_GET['artist'])){
		                          $_display=$musicPdo->getTracksMusicArtist($_GET['artist']);
		                          if(count($_display)==0){
		                              ?>
		                              <h5 style="color:red;">No Music Loaded</h5>
		                              <?php
		                          }
		                          else{
										foreach($_display as $row){
		                                  $recording_label=$musicPdo->getRecordingLabel($row['recording_label']);
		                                  $album="";
		                                  $album_info="";
		                                  if($row['album']<1){
		                                      $album="Single Release";
		                                  }
		                                  else{
		                                      $album_info=$musicPdo->getAlbuminfo($row['album']);
		                                      $album=$album_info['album_name'];
		                                  }
		                                  $artist_info=$musicPdo->getArtistInfo($row['artist']);
		                                  $publish_date=$row['time_uploaded'];
		                                  $song_name=$row['track_name'];
		                                  $artist=$artist_info['artist_stage_name'];
		                                  $label=$recording_label['recording_label'];
		                                  $dir_img="../../logo/".$row['track_logo'];
		                                  $dir_mp3="../../track/".$row['track_mp3'];
		                                  $track_id=$row['id'];
		                                  ?>
		                                  <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms" style="background: #333;margin-top: -3%;">
		                                  <div class="poca-music-thumbnail" style="width:100%;">
		                                    <img src="<?php echo $dir_img;?>" alt="" style="width:100%;">
		                                  </div>
		                                  <div class="poca-music-content" style="width:100%;">
		                                    <span class="music-published-date"><?php echo $publish_date;?><small style="font-size:7px;padding:2px;border-radius:50px;background-color:#333;color:#45f3ff;border:1px solid #45f3ff;">new</small></span>
		                                    <h2><?php echo $song_name;?></h2>
		                                    <div class="music-meta-data">
		                                      <p>By <a onclick="loader('izihlabelelo&artist=<?php echo $row['artist'];?>')" class="music-author"><?php if(strlen($artist)<10){ echo $artist;}else{ for($i=0;$i<10;$i++){echo $artist[$i];}echo".."; }?></a> | <a onclick="loader('izihlabelelo&recording_label=<?php echo $row['recording_label'];?>')" class="music-catagory"><?php echo $label; ?></a> | <a onclick="loader('izihlabelelo&album=<?php echo $row['album'];?>')" class="music-duration"><?php echo $album;?></a></p>
		                                    </div>
		                                    <!-- Music Player -->
		                                    <div class="poca-music-player" style="width:100%;color:#45f3ff;background-color:#282828;">
		                                      <audio preload="auto" controls controlsList="nodownload" style="width:100%; color:#45f3ff;background-color:#282828;">
		                                        <source src="<?php echo $dir_mp3;?>" style="width:100%;">
		                                      </audio>
		                                    </div>
		                                    <!-- Likes, Share & Download -->
		                                    <div class="likes-share-download d-flex align-items-center justify-content-between">
		                                      <a onclick="likeSong(<?php echo $track_id;?>)" class="<?php echo $track_id;?>"><i class="fa fa-heart" aria-hidden="true"></i>(<?php
		                                      
		                                       echo $musicPdo->trackLikes($track_id);
		                                    ?>)</a>
		                                      <div>
		                                        <a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                        <a onclick="download_song(<?php echo $track_id;?>)" id="<?php echo $track_id;?>" href="<?php echo $dir_mp3;?>" download><i class="fa fa-download" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
		                                      </div>
		                                    </div>
		                                  </div>
		                                </div>
		                                <br>
		                              <?php
		                              }
		                          }
		                      }
		                      else{
		                          // $_display=$conn->query("select*from track order by  DESC");
		                          $_display=$musicPdo->getTracksMusic("downloads");
		                          if(count($_display)==0){
		                              ?>
		                              <h5 style="color:red;">No Music Loaded</h5>
		                              <?php
		                          }
		                          else{
									foreach($_display as $row){
			                              $recording_label=$musicPdo->getRecordingLabel($row['recording_label']);
			                              $album="";
			                              $album_info="";
			                              if($row['album']<1){
			                                  $album="Single Release";
			                              }
			                              else{
			                                  $album_info=$musicPdo->getAlbuminfo($row['album']);
			                                  $album=$album_info['album_name'];
			                              }
			                              $artist_info=$musicPdo->getArtistInfo($row['artist']);
			                              $publish_date=$row['time_uploaded'];
			                              $song_name=$row['track_name'];
			                              $artist=$artist_info['artist_stage_name'];
			                              $label=$recording_label['recording_label'];
			                              $dir_img="../../logo/".$row['track_logo'];
			                              $dir_mp3="../../track/".$row['track_mp3'];
			                              $track_id=$row['id'];
			                              ?>
			                            <div class="poca-music-area mt-100 d-flex align-items-center flex-wrap" data-animation="fadeInUp" data-delay="900ms" style="background: #333;margin-top: -3%;">
			                              <div class="poca-music-thumbnail" style="width:100%;">
			                                <img src="<?php echo $dir_img;?>" alt="" style="width:100%;">
			                              </div>
			                              <div class="poca-music-content" style="width:100%;">
			                                <span class="music-published-date"><?php echo $publish_date;?><small style="font-size:7px;padding:2px;border-radius:50px;background-color:#333;color:#45f3ff;border:1px solid #45f3ff;">new</small></span>
			                                <h2><?php echo $song_name;?></h2>
			                                <div class="music-meta-data">
			                                  <p>By <a onclick="loader('izihlabelelo&artist=<?php echo $row['artist'];?>')" class="music-author"><?php if(strlen($artist)<10){ echo $artist;}else{ for($i=0;$i<10;$i++){echo $artist[$i];}echo".."; }?></a> | <a onclick="loader('izihlabelelo&recording_label=<?php echo $row['recording_label'];?>')" class="music-catagory"><?php echo $label; ?></a> | <a onclick="loader('izihlabelelo&album=<?php echo $row['album'];?>')" class="music-duration"><?php echo $album;?></a></p>
			                                </div>
			                                <!-- Music Player -->
			                                <div class="poca-music-player" style="width:100%;color:#45f3ff;background-color:#282828;">
			                                  <audio preload="auto" controls controlsList="nodownload" style="width:100%; color:#45f3ff;background-color:#282828;">
			                                    <source src="<?php echo $dir_mp3;?>" style="width:100%;">
			                                  </audio>
			                                </div>
			                                <!-- Likes, Share & Download -->
			                                <div class="likes-share-download d-flex align-items-center justify-content-between">
			                                  <a onclick="likeSong(<?php echo $track_id;?>)" class="<?php echo $track_id;?>"><i class="fa fa-heart" aria-hidden="true"></i>(<?php
			                                  echo $musicPdo->trackLikes($track_id);
			                                ?>)</a>
			                                  <div>
			                                    <a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
			                                    <a onclick="download_song(<?php echo $track_id;?>)" id="<?php echo $track_id;?>" href="<?php echo $dir_mp3;?>" download><i class="fa fa-download" aria-hidden="true"></i> (<?php echo $row['downloads'];?>)</a>
			                                  </div>
			                                </div>
			                              </div>
			                            </div>
		                            	<br>
		                          		<?php
		                            }
		                         }
		                      }
		                      ?>
		                  </div>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		      <script>
		          function likeSong(track_id_like){
		           $.ajax({
		        		url:'./controller/ajaxCallProcessor.php',
		        		type:'post',
		        		data:{track_id_like:track_id_like},
		        		success:function(e){
		        			$("."+track_id_like).html('<i class="fa fa-heart" aria-hidden="true"></i>('+e+")");
		        		}
		        	});
		          }
		          function download_song(track_download){
		             $.ajax({
		        		url:'./controller/ajaxCallProcessor.php',
		        		type:'post',
		        		data:{track_download:track_download},
		        		success:function(e){
		        			$("#"+track_download).html('<i class="fa fa-download" aria-hidden="true"></i>('+e+")");
		        		}
		        	}); 
		          }
		      </script>
		    </section>




		<?php
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../");
	</script>

	<?php
}
?>