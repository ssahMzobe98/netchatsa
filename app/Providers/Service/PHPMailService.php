<?php
namespace Providers\Services;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Providers\IService\IPHPMailService;
use Providers\Response\Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/**
 * 
 */
class PHPMailService implements IPHPMailService
{	private $mailer;
    public function __construct(PHPMailer $mailer) {
        $this->mailer = $mailer;
    }

    public function setSMTPSettings($host, $username, $password, $port = 587, $encryption = PHPMailer::ENCRYPTION_SMTPS):PHPMailService {
        // Validate input parameters
        if (!is_string($host) || !is_string($username) || !is_string($password) || !is_int($port) || !is_string($encryption)) {
            throw new Exception('Invalid input parameters.');
        }

        $this->mailer->isSMTP();
        $this->mailer->Host = $host;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $username;
        $this->mailer->Password = $password;
        $this->mailer->SMTPSecure = $encryption;
        $this->mailer->Port = $port;
        return $this;
    }

    public function setSender($email, $name):PHPMailService {
        // Validate input parameters
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !is_string($name)) {
            throw new Exception('Invalid input parameters.');
        }

        $this->mailer->setFrom($email, $name);
        return $this;
    }

    public function addRecipient($email, $name):PHPMailService {
        // Validate input parameters
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !is_string($name)) {
            throw new Exception('Invalid input parameters.');
        }

        $this->mailer->addAddress($email, $name);
        return $this;
    }

    public function setSubject($subject):PHPMailService {
        // Validate input parameters
        if (!is_string($subject)) {
            throw new Exception('Invalid input parameters.');
        }

        $this->mailer->Subject = $subject;
        return $this;
    }

    public function setBody($body):PHPMailService {
        // Validate input parameters
        if (!is_string($body)) {
            throw new Exception('Invalid input parameters.');
        }

        $this->mailer->isHTML(true);
        $this->mailer->Body = $body;
        return $this;
    }

    public function send():Response{
        try {
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log('Error sending email: ' . $e->getMessage());
            return false;
        }
    }
}


?>