<?php
namespace Src\Classes;
class SAIDValidator {
    public static function validateSAID($idNumber):bool{
        if(strlen($idNumber) !== 13) {
            return false;
        }
        if(!ctype_digit($idNumber)) {
            return false;
        }
        $year = substr($idNumber, 0, 2);
        $month = substr($idNumber, 2, 2);
        $day = substr($idNumber, 4, 2);
        if(!checkdate($month, $day, $year)) {
            return false;
        }
        $sum = 0;
        $even = false;
        for ($i = 0; $i < 12; $i++) {
            $digit = intval($idNumber[$i]);
            $sum += ($even = !$even) ? $digit : (($digit < 5) ? $digit * 2 : 1 + ($digit - 5) * 2);
        }
        $checksum = (10 - ($sum % 10)) % 10;
        if($checksum != $idNumber[12]) {
            return false;
        }
        return true;
    }
    public static function validatePassport($passportNumber):bool{
        $regexes = [
            '/^[A-Z]{1}[0-9]{7}$/',    
            '/^[A-Z]{2}[0-9]{7}$/',    
            '/^[A-Z]{3}[0-9]{6}$/',    
            '/^[A-Z]{2}[0-9]{6}$/',    
            '/^[A-Z]{3}[0-9]{7}$/',    
            '/^[A-Z]{2}[0-9]{8}$/',
        ];
        foreach ($regexes as $regex) {
            if (preg_match($regex, $passportNumber)) {
            }
        }
        return false;
    }
}

?>