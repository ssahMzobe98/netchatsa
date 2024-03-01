<?php
use Providers\Service\PHPMailService;
use PHPMailer\PHPMailer\PHPMailer;
use Providers\Response\Response;
interface IPHPMailService{
	public function setSMTPSettings($host, $username, $password, $port = 587, $encryption = PHPMailer::ENCRYPTION_SMTPS):PHPMailService;

    public function setSender($email, $name):PHPMailService;

    public function addRecipient($email, $name):PHPMailService;

    public function setSubject($subject):PHPMailService;

    public function setBody($body):PHPMailService;

    public function send():Response;
}

?>