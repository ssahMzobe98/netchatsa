<?php 
function send_mail_to_school($email,$chool,$principal,$file){

        // to, from, subject, message body, attachment filename, etc.
        $to = $email;
        $from = "netchatsa@gmail.com";
        $subject = "SUCCESS OF REGISTRA WITH NETCHATSA";
        $message = "Dear $principal and $chool staff\n\n\nThank you For opening an Edu Account with us. We promise you a good Responsive System Engagement with your teachers and pupils. Our goal is to play a big role in SA ECONOMIC TRANSFORMATION through enhancing South African Education making it unstoppable by any life crisis/challenges.\n\n\n#NO STUDENT LEFT BEHIND\n#TRANSFORMING SOUTH AFRICAN ECONOMY THROUGH EDUCATION\n\nKind Regards\nThank you\nnetchatsa\nnetchatsa.com";
        $filename = "20210107_221755.jpg";//$file;
        $fname = "20210107_221755.jpg";

        $headers = "From: $from"; 
        // boundary 
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

        // headers for attachment 
        $headers .= "\nnetchatsa V: 2.0.1\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

        // multipart boundary 
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
        $message .= "--{$mime_boundary}\n";

        // preparing attachments            
            $file = fopen($filename,"rb");
            $data = fread($file,filesize($filename));
            fclose($file);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"".$fname."\"\n" . 
            "Content-Disposition: attachment;\n" . " filename=\"$fname\"\n" . 
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            $message .= "--{$mime_boundary}--\n";


        // send
        //print $message;

        $ok = @mail($to, $subject, $message, $headers, "-f " . $from);
        if($ok){
        	return true;
        } 
        else{
        	return false;
        }
}
function ibhubesiLesilisa($pwd){

	$strArr=array("L","9","D","!","a","K","1","b","Y","$","R","c","@","F","d","S","3","e","5","-","A","f","g","6","V","h","G","i","W","j","k","l","T","%","m","8","B","n","E","+","o","X","p","C","*","q","r","Q","s","M","+","t","N","2","u","H","v","4","U","w","I","7","&","x","O","y","J","z","=","P");
	$intArr=array('!','1','B','$','9','T','%','3','^','5','*','2','6','Y','(','7','+','8','G','-','4','E');
	//print sizeof($strArr)."   ";
	$fihliwe=shayIqanda(wamaHalahle($pwd),$strArr);
	return $fihliwe;


	
	
}
function shayIqanda($iqanda,$arr){
	$bhozo=str_split($iqanda);
	$khala="";
	foreach ($bhozo as $value) {
		$inamba=ord($value);
		//print $value;
		//print $inamba."-";
		$currPos=position(hash1($inamba));
		$khala.=$arr[$currPos];
		//echo "<pre>";print $arr[$currPos];echo"<prev";

	}
	return $khala;
}
function hash1($inamba){
	$hi=(($inamba^3)*((8%$inamba)/0.5))/30;
	//print $hi."  ";
	return $hi;
}
function position($pos){
	///print_r($strArr);
	if($pos>69){
		$pos/=3;
		return $pos;

	}
	else{
		return $pos;
	}
}

function wamaHalahle($pwd){
	$umphumela=str_split($pwd);
	$ubhozo="fr%";$ucikicane="fRg";$isithupha="3g@";
	$k=0;
	$uzwane="";
	foreach ($umphumela as $value) {
		if($k<sizeof($umphumela)){
			if((sizeof($umphumela)%2)==0){
				if(($k)==2){
					$uzwane=$uzwane.$ubhozo;
					//print $uzwane."";
				}
				else if(($k)==6){
					$uzwane=$uzwane.$ucikicane;
				}
				else if(($k)==9){
					$uzwane=$uzwane.$isithupha;
				}
				else{
					$uzwane=$uzwane.$value;
				}
			}
			else{
				if(($k)==3){
					$uzwane=$uzwane.$ubhozo;
					//print $uzwane."";
				}
				else if(($k)==7){
					$uzwane=$uzwane.$ucikicane;
				}
				else if(($k)==10){
					$uzwane=$uzwane.$isithupha;
				}
				else{
					$uzwane=$uzwane.$value;
				}
			}
		}
		
		else{
			break;	
		} 
		$k+=1;

	}
	
	//print $uzwane."\n\n\n";
	//print ($k+1)."";
	
	

	return $uzwane;

}
//ibhubesiLesilisa("abcdefgHIJklmnopP");

 ?>