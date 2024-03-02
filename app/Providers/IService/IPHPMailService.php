<?php
namespace App\Providers\IService;
use App\Providers\Service\PHPMailService;
use PHPMailer\PHPMailer\PHPMailer;
use App\Providers\Response\Response;
interface IPHPMailService{
	public function setSMTPSettings($host, $username, $password, $port = 465, $encryption = PHPMailer::ENCRYPTION_SMTPS):PHPMailService;

    public function setSender($email, $name):PHPMailService;

    public function addRecipient($email, string $name=''):PHPMailService;

    public function setSubject($subject):PHPMailService;

    public function setBody($body):PHPMailService;

    public function send():Response;
}

?>