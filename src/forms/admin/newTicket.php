<?php
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['masomane'])){
	require_once("../controller/pdo.php");
	$pdo=new _pdo_();
	$cur_user_row =$pdo->userInfo($_SESSION['masomane']);
	$userDirect=$cur_user_row['user_nav'];
	$url = explode("/",$_SERVER['REQUEST_URI']);
	$url=$url[count($url)-4]."/".str_replace("%20", " ",$url[count($url)-3]);
	
	if($url==$userDirect){
		if(isset($_POST['neTicket'])&&$_POST['neTicket']>0){
			$projects = $pdo->maSomaneGetProjects();
			?>
			<style>
				.fromStatsI{
					display: flex;
					padding: 10px 10px;

				}
				.fromStatsI .leftStatsI{
					padding: 10px 10px;
					width: 100%;
				}
				.fromStatsI .leftStatsI input,select{
					padding: 10px 10px;
					color:white;
					border-radius: 10px;
					border: none;
					border-bottom: 2px solid rebeccapurple;
					background: none;
					width: 90%;
				}
				select{
					background:#6f42c1;
				}
				.fromStatsIe{
					padding: 10px 10px;
					width: 100%;
				}
				.editorEDS{
					width: 100%;
				}
				.BuddyMoc{
					padding: 10px 10px;
					background: none;
					border-radius: 10px;
					border:2px solid rebeccapurple;
					color:rebeccapurple;
				}
				.BuddyMoc:hover{
					border:2px solid #ddd;
					color:#ddd;
				}
				.textTicketDescription{
				padding: 10px 10px;
					color:white;
					border-radius: 10px;
					border: none;
					border-bottom: 2px solid rebeccapurple;
					background: none;
					
				height:45px;
			}
			.textTicketDescription::-webkit-scrollbar{
			  width:5px;
			}
			.textTicketDescription::-webkit-scrollbar-thumb {
			  background: red;
			  border-radius: 10px;
			}
			</style>
			<div class="fromStatsI">
				<div class="leftStatsI"><select class="projectStatsI">
					<option value="">-- Select Projects --</option>
					<?php
						foreach($projects as $row){
							?>
							<option value="<?php echo $row['id'];?>"><?php echo $row['name']."-MMS-".$row['id'];?></option>
							<?php
						}
					?>
				</select></div>
				<div class="leftStatsI"><textarea type="text" class="textTicketDescription" placeholder="Ticket Short description"></textarea></div>
				<div class="leftStatsI"><input type="number" class="textTicketWeight" placeholder="Ticket Weight..."></div>
			</div>
			<div class="fromStatsIe">
				<textarea class="editorEDS" id="editorEDS"></textarea>
			</div>
			<div class="MyDoma">
				<button type="button" class="btn BuddyMoc" onclick="saveNewTicket()">Save New Ticket</button><span class="errorSubmit"></span>
			</div>
				<script>
            var Findereditor = CKEDITOR.replace('editorEDS',{
                uploadUrl: '../../ckfinder/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                filebrowserBrowseUrl: '../../ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '../../ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                stylesSet: [{
                  name: 'Narrow image',
                  type: 'widget',
                  widget: 'image',
                  attributes: {
                    'class': 'image-narrow'
                  }
                },
                {
                  name: 'Wide image',
                  type: 'widget',
                  widget: 'image',
                  attributes: {
                    'class': 'image-wide'
                  }
                }
              ],
              contentsCss: [
                'https://cdn.ckeditor.com/4.21.0/full-all/contents.css',
                'https://ckeditor.com/docs/ckeditor4/4.21.0/examples/assets/css/widgetstyles.css'
              ],
              image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
              image2_disableResizer: true,
              removeButtons: 'PasteFromWord'
            });
            CKFinder.setupCKEditor(Findereditor);
            CKEDITOR.config.extraPlugins = 'justify';
        </script>
			

			<?php

		}
		else{
			echo"BAD REQUEST!!";
		}
	}
	else{
		session_destroy();
		?>
			<script>
				window.location=("../../?Yazi uyajwayela wena!!, Stop trying to access somebody's account through your own login details.");
			</script>
		<?php
	}
}
else{
	session_destroy();
	?>
	<script>
		window.location=("../../?fghfghfghgfh");
	</script>

	<?php
}
?> 