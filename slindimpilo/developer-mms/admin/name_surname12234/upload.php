<?php
session_start();
if(isset($_SESSION['adminSession'])){
	require_once("pdo.php");
	$pdo=new _pdo_();
	$adminInfo=$pdo->currentAdminInfo($_SESSION['adminSession']);
	$e=array();
	$id=$adminInfo['adminid'];
	if(isset($_POST['newnum'])){
		$phone=mysqli_escape_string($conn,$_POST['newnum']);
		if($conn->query("update aminuser set phone='$phone' where adminid='$id'")){
			// sendEmail($adminInfo['adminid'],$header,)
			$e=1;
		}
		else{
			$e=$conn->error;
		}
	}
	elseif(isset($_POST['newemail'])){
		$newemail=mysqli_escape_string($conn,$_POST['newemail']);
		if($conn->query("update aminuser set adminid='$newemail' where adminid='$id'")){
			// sendEmail($adminInfo['adminid'],$header,)
			$e=1;
		}
		else{
			$e=$conn->error;
		}
	}
	elseif (isset($_POST['newpass'])) {
		$imfene=new _imfene_();
		$newpass=$imfene->ibhubesiLesilisa(md5($imfene->ibhubesiLesilisa(mysqli_escape_string($conn,$_POST['newpass']))));
		if($conn->query("update aminuser set password='$newpass' where adminid='$id'")){
			// sendEmail($adminInfo['adminid'],$header,)
			$e=1;
		}
		else{
			$e=$conn->error;
		}
	}
	elseif(isset($_FILES['file'])){
		$ext=explode(".",$_FILES['file']['name']);
		$ext=end($ext);
		$dir="../../img/".$adminInfo['id']."/";

		if(!is_dir($dir)){
           mkdir($dir,0777,true);
        }
        $myfile = fopen($dir."index.php", "w") or die("Unable to open file!");
        fwrite($myfile, "<?php header('Location:https://netchatsa.com');exit();?>");
        fclose($myfile);
		$arr=array("jpg","png","jpeng","heic","gif","JPG","PNG","jpeg","JPEG","GIF","JPENG","HEIC");
		if(!in_array(strtolower($ext),$arr)){
			$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic,pdf,docx,xlxs,xlx} Format Supported";
			
		}
		else{
			$new_name_file=rand(000,9999999999999)."_netChat.".$ext;
			if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($new_name_file))){
				if($conn->query("update aminuser set profileimg='$new_name_file' where adminid='$id'")){
				// sendEmail($adminInfo['adminid'],$header,)
					$e=1;
				}
				else{
					$e=$conn->error;
				}
			}
			else{
				$e="Error 201: Can Not move file to directory. please try again later!!";
			}
		}
	}
	elseif(isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['name'])&&isset($_POST['surname'])&&isset($_POST['phone'])&&isset($_POST['adminType'])){
		$imfene=new _imfene_();
		$email=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['email']));
		$password=$imfene->ibhubesiLesilisa(md5($imfene->ibhubesiLesilisa(mysqli_escape_string($conn,$_POST['password']))));
		$name=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['name']));
		$surname=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['surname']));
		$phone=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['phone']));
		$adminType=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['adminType']));
		$img="empty";
		$position="";
		if($adminType==1){
			$position="Director";
		}
		elseif($adminType==2){
			$position="Management";
		}
		else{
			$position="Admin Consultant";
		}
		$dir="admin/".$name."_".$surname.rand(0,99999);
		if(!is_dir($dir)){
           mkdir($dir,0777,true);
        }
		if($conn->query("insert into aminuser(adminid,name,surname,password,phone,position,admintype,profileimg,userdirectory,added_by,time_added)values('$email','$name','$surname','$password','$phone','$position','$adminType','$img','$dir','$id',NOW())")){
			$e=1;
		}
		else{
			$conn->error;
		}
	}
	elseif(isset($_POST['portfolio'])){
		$portfolio=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['portfolio']));
		if($conn->query("insert into portfolio(portfolio,addedby,time_added)values('$portfolio','$id',NOW())")){
			$e=1;
		}
		else{
			$conn->error;
		}
	}
	elseif(isset($_POST['id'])&&isset($_POST['cdcDeletePortfolio'])){
		$id=$_POST['id'];
		if($conn->query("delete from portfolio where id='$id'")){
			$e=1;
		}
		else{
			$conn->error;
		}
	}
	elseif(isset($_GET['_still_'])){
		$ext=explode(".",$_FILES['fileCol']['name']);
		$ext=end($ext);
		$dir="../../img/".$_POST['id_of_portfolio']."/";

		if(!is_dir($dir)){
           mkdir($dir,0777,true);
        }
        $myfile = fopen($dir."index.php", "w") or die("Unable to open file!");
        fwrite($myfile, "<?php header('Location:https://netchatsa.com');exit();?>");
        fclose($myfile);
		$arr=array("jpg","png","jpeng","heic","gif","JPG","PNG","jpeg","JPEG","GIF","JPENG","HEIC");
		if(!in_array(strtolower($ext),$arr)){
			$e="{".$ext."} Not Supported. Only {jpg,png,jpeng,heic,jpeg,gif} Format Supported";
			
		}
		else{
			$new_name_file=rand(000,9999999999999)."_netChat.".$ext;
			if(move_uploaded_file($_FILES['fileCol']['tmp_name'], $dir.basename($new_name_file))){
				$item=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['item']));
				$description=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['ItemDescription']));
				$price=$pdo->editTextBeforeSubmitting(mysqli_escape_string($conn,$_POST['price']));
				$portfolioId=$_POST['id_of_portfolio'];
				$inStock=0;
				if($conn->query("insert into items(item,description,portfolio,addedby,instock,price,time_added)values('$item','$description','$portfolioId','$id','$inStock','$price',NOW())")){
					$e=1;
				}
				else{
					$e=$conn->error;
				}
			}
			else{
				$e="File uploading Failed, please try again later!!";
			}
		}
	}
	echo json_encode($e);
	$conn->close();
}
else{
	session_destroy();
	?>
	<script>window.location=("../../?pet");</script>
	<?php
}

?>