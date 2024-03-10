<?php

namespace Src\Classes\Pdo;
use App\Providers\Constants\Flags;
class TimePdo{
	public static function getMonth($m){
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
	public static function time_Ago($time) { 
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
}
?>