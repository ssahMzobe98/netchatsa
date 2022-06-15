<?php
$user="root";
$pass="";
$dbnam="netchatsa";
$conn=mysqli_connect("localhost",$user,$pass,$dbnam)or die("Connection was not established!!");
include_once("iMfene.php");
class _pdo_{

	public function islogedIn(){
		global $conn;
		echo "check if is logged in";
		return false;
	}
	public function isVerified($my_id){
		global $conn;
		$mad=mysqli_fetch_array($conn->query("select*from verify_account where my_id='$my_id'"));
		return ($mad['code']==1);
	}
	public function LoginVerification(){
		global $conn;
		$error=array();
		$username=mysqli_escape_string($conn,$_POST['uname']);
		$pass=ibhubesiLesilisa(md5(ibhubesiLesilisa(mysqli_escape_string($conn,$_POST['psw']))));
		$_="select usermail and security from create_runaccount where usermail=? and security=? LIMIT 1";
    	$stmt = $conn->prepare($_);
		$stmt->bind_param("ss", $username,$pass);
		$stmt->execute();
		$stmt->bind_result($username);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		if($rnum==0){
			array_push($error,"error");
			array_push($error,"Incorrect Username or Password!");
			array_push($error,"r");
			array_push($error,"0");
		}
		return $error;
	}
	
	public function run_topic(){
		global $conn;
	    $array= array(1,2,3,4,5,6,7,8,9,11,22,33,44,55,66,77,88,99,12,13,14,15,16,17,18,19,21,22,23,24,25,26,27,28,29);
	    $addupPos=1;
	    $index=1;
	    while ( $index<= 5) {
	        $f=random_int(0, 35);
	        $s=random_int(1, 15);
	        $d=random_int(16, 34);
	        $pos=((($f+$s+$d)/25)*(15))/2;
	        if($pos>34){
	            $pos/=2;
	            $addupPos*=$array[$pos];
	        }
	        else{
	            $addupPos*=$array[$pos];
	        }
	        $index++;
	    }
	    return $addupPos;
	}
	public function createNewAccount(){
		global $conn;
		// include_once("../includes/get-no-con-/index.php");
        // include_once("controller/pdo.php");
        $array=array();
        $a=mysqli_escape_string($conn,$_POST["name"]);
        $b=mysqli_escape_string($conn,$_POST["surname"]);
        $c=mysqli_escape_string($conn,$_POST["username"]);
        $d=mysqli_escape_string($conn,$_POST["date"]);
        $e=mysqli_escape_string($conn,$_POST["gender"]);
        $f=mysqli_escape_string($conn,$_POST["promaths"]);
        $g=mysqli_escape_string($conn,$_POST["province"]);
        $h=mysqli_escape_string($conn,$_POST["city"]);
        $i=mysqli_escape_string($conn,$_POST["email_address"]);
        $j=mysqli_escape_string($conn,$_POST["psw"]);
        $k=mysqli_escape_string($conn,$_POST["re_psw"]);
        if($j!=$k){
            array_push($array,"error");
            array_push($array,"Password does not match&r=1&a=".$a."&b=".$b."&c=".$c."&d=".$d."&e=".$e."&f=".$f."&g=".$g."&h=".$h."&i=".$i);
            array_push($array,"r");
			array_push($array,"1");
        }
        elseif(strlen($j)<8 or strlen($k)<8){
        	array_push($array,"error");
            array_push($array,"Password too short&r=1&a=".$a."&b=".$b."&c=".$c."&d=".$d."&e=".$e."&f=".$f."&g=".$g."&h=".$h."&i=".$i);
            array_push($array,"r");
			array_push($array,"1");
        }
        else{
            $default_img="empty";
            $_="select usermail from create_runaccount where usermail=? LIMIT 1";
        	$stmt = $conn->prepare($_);
    		$stmt->bind_param("s", $i);
    		$stmt->execute();
    		$stmt->bind_result($i);
    		$stmt->store_result();
    		$rnum = $stmt->num_rows;
    		if($rnum==0){
    		    $j=ibhubesiLesilisa(md5(ibhubesiLesilisa($j)));
    		    $my_id=ibhubesiLesilisa(md5($i).md5($j));
    		    $verify="verified";
    		    $code=$this->run_topic();
    		    $dn=date("h:i:sa");
    		    $bright="dark";
    		    $tmp_status=0;
    		    $array=array();
    		    $account_owner=$a."_".$b.$code;
    		    if($conn->query("INSERT INTO verify_account(my_id,code,time) values('$my_id','$code',NOW())")){
    		        if($conn->query("INSERT INTO create_runaccount(usermail,name,surname,username,gender,promaths,province,city,date_of_birth,security,profile_image,time_posted,my_id,verify,account_owner) values('$i','$a','$b','$c','$e','$f','$g','$h','$d','$j','$default_img',NOW(),'$my_id','$verify','$account_owner')")){
                        if($conn->query("INSERT into brightdarksetup(my_id,darkbright,timechange) values('$my_id','$bright',NOW())")){
                            if($conn->query("INSERT into status_online_offline(my_id,onlne_ofline,time_last) values('$my_id','$tmp_status',NOW())")){
                                $kk=$this->run_topic();
                                $ii=$kk;
                                if($conn->query("INSERT into tmp_pass(tmp_email,password,code) values('$ii','$kk','$tmp_status')")){
                                	$subject = 'NEW ACCOUNT CREATED, NETCHATSA ACCOUNT VERIFICATION {'.$a.' '.$b.' '.$c.'}';
                                	$message = '<p>Congradulation '.$a.' '.$b.' '.$c.',Your Account has been successfully created. Please click (https://netchatsa.com/?_0_='.$code.') to verify your Account.</p>';
                                    $this->sendEmail($message,$i,'no-reply@netchatsa.com',$subject);//send mail to client
                                    $mail_to="netchatsa@gmail.com";
                                    $subject="NEW NETCHATSA ACCOUNT USER";
                                    $message="<p>Hello ".$a." ".$b." : ".$c." <br>".$a." ".$b." has Created  Account succesfully. <br>kind reguards <br>Netchat Messager</p>";
                                    $this->sendEmail($message,$mail_to,'newUser@netchatsa.com',$subject);//send mail to company
                                    $conn->close();
                                    array_push($array,"success");
                                    array_push($array,"Account successfuly created!!");
                                    array_push($array,"r");
									array_push($array,"0");
									//mkdir("user/".$account_owner,7750);
                                }
                                else{
                                    array_push($array,"error");
                                    array_push($array,$conn->error);
                                    array_push($array,"r");
									array_push($array,"1");
                                }
                            }
                            else{
                                array_push($array,"error");
                                array_push($array,$conn->error);
                                array_push($array,"r");
								array_push($array,"1");
                            }
                            
                        }
                        else{
                            array_push($array,"error");
                            array_push($array,$conn->error);
                            array_push($array,"r");
							array_push($array,"1");
                        }
                        
                    }
                    else{
                        array_push($array,"error");
                        array_push($array,$conn->error);
                        array_push($array,"r");
                        array_push($array,"1");
                    }
    		    }
    		    else{
    		        array_push($array,"error");
                    array_push($array,"Verification error, ".$conn->error);
                    array_push($array,"r");
                    array_push($array,"1");
    		    }
            }
            else{
                array_push($array,"error");
                array_push($array,"Account $i already exists!&r=0");
                array_push($array,"r");
				array_push($array,"1");
            }
        }
        return $array;
	}
	public function sendEmail($message,$reciever,$sender,$subject){
		global $conn;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $mess = '<html><body> <div style="background-color:#212121;color:#f3f3f3;">';
        $mess .= '<div style="display:flex;">';
        $mess .='<div style="width:50px;height:40px;margin-left:5%;border-radius:100%;border:4px solid #f3f3f3;padding:4px 0;"><img style="width:100%;border-radius:100%;" src="https://netchatsa.com/mailLogo.jpg"></div>';
        $mess .='<div><h3 style="color:#080;font-size:18px;">Netchatsa Mailer Alert</h3></div>';
        $mess .='</div>';
        $mess .= '<h3 style="color:#f40;">Exe Macala 🤙</h3>'.$message;
        $mess .= '<div style="padding:10px;border:1px solid #f3f3f3;font-style:italic;font-size:12px;color:red;">netchatsa mailer is a communication system developed by Sgela Technologies EAI. If this mail does not belong to you please ignore it. Do not reply to this email as it is controlled by RoboTech.</div></div></body></html>';
        mail($reciever, $subject, $mess, $headers);

	}
	public function verifyAccount($code){
		global $conn;
		
	    // include_once("=$_GET['_0_'];
	    $_="select code from verify_account where code=? Limit 1";
		$stmt = $conn->prepare($_);
		$stmt->bind_param("s", $code);
		$stmt->execute();
		$stmt->bind_result($code);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		$error=array();
		if($rnum==1){
		    $n=1;
		    $info=mysqli_fetch_array($conn->query("select*from verify_account where code='$code'"))['my_id'];
		    $_=mysqli_fetch_array($conn->query("select usermail from create_runaccount where my_id='$info'"));
		    if($conn->query("UPDATE verify_account SET code='$n' WHERE code='$code'")){
	            $message = '<p>Congradulation, Your Account has been successfully verified😇 🤩 . You can now login freely.</p>';
		    	$this->sendEmail($message,$_['usermail'],'no-reply@netchatsa.com','NETCHATSA ACCOUNT SUCCESSFULLY VERIFIED');    
		         return $error;
		    }
		    else{
		         return array_push($error,$conn->error);
		    }
		}
		else{
			return array_push($error,"code provide not valid. VERIFICATION:FAILED&r=0");
		}
	}
}

?>