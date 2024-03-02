<?php

namespace App\Providers\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Providers\IService\IPHPMailService;
use App\Providers\Response\Response;

class PHPMailService implements IPHPMailService
{
    private $mailer;

    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function setSMTPSettings($host, $username, $password, $port = 465, $encryption = PHPMailer::ENCRYPTION_SMTPS): PHPMailService
    {
        // $this->validateParameters([$host, $username, $password, $port, $encryption]);

        $this->mailer->isSMTP();
        $this->mailer->Host = $host;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $username;
        $this->mailer->Password = $password;
        $this->mailer->SMTPSecure = $encryption;
        $this->mailer->Port = $port;

        return $this;
    }

    public function setSender($email, $name): PHPMailService
    {
        // $this->validateParameters([$email, $name]);

        $this->mailer->setFrom($email, $name);
        return $this;
    }

    public function addRecipient($email, string $name=''): PHPMailService
    {
        // $this->validateParameters([$email, $name]);

        $this->mailer->addAddress($email, $name);
        return $this;
    }

    public function setSubject($subject): PHPMailService
    {
        // $this->validateParameters([$subject]);

        $this->mailer->Subject = $subject;
        return $this;
    }

    public function setBody($body): PHPMailService
    {
        // $this->validateParameters([$body]);

        $this->mailer->isHTML(true);
        $this->mailer->Body = $this->bodyText($body);
        return $this;
    }

    public function send(): Response
    {
        $response = new Response();

        try {
            $result = $this->mailer->send();
            if ($result) {
                $response->successSetter()->messagerSetter('Mail Sent Successfully ' . date('Y-m-d H:i:s'));
            } else {
                $response->failureSetter()->messagerSetter('Failed to send mail ' . date('Y-m-d H:i:s') . ' due to error: ' . $this->mailer->ErrorInfo);
            }
        } catch (Exception $e) {
            $response->failureSetter()->messagerSetter('Failed to send mail ' . date('Y-m-d H:i:s') . ' due to error: ' . $e->getMessage());
        }

        return $response;
    }

    private function validateParameters(array $parameters): void
    {
        foreach ($parameters as $param) {
            if (!is_string($param)) {
                 throw new Exception('Invalid input parameters.');
            }
        }
    }
    private function bodyText(string $message=''):string{
        // $headers  = 'MIME-Version: 1.0' . "\r\n";
        // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        // Create email headers
        // $headers .= 'From: '.$from."\r\n".
        //     'Reply-To: '.$from."\r\n" .
        //     'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $mess = '<html><body> <div style="background-color:#f2f2f2;color:#000000;">';
        $mess .= '<div style="display:flex;">';
        $mess .='<div style="width:40px;height:40px;margin-left:5%;border-radius:100%;padding:1px 1px;background:#f2f2f2;"><img style="width:100%;height:100%;border-radius:100%;" src="https://netchatsa.com/img/aa.jpg"></div>';
        $mess .='<div><h3 style="color:#000000;font-size:18px;font-weight:bolder;">Netchatsa</h3></div>';
        $mess .='</div>';
        $mess .= '<h3 style="color:#000000;">Exe Macala <i class="fa-regular fa-thumbs-up"></i></h3>'.$message;
        $mess .="<br><div><a href='https://play.google.com/store/apps/details?id=com.mmshightech.netchatsa'><span class='badge badge-primary text-center text-white' style='padding:10px 10px;background:navy;color:white;'>Download APP</span></a></div>";
        $mess .= '<br><hr><div style="padding:10px 10px;border:1px solid #000000;font-style:italic;font-size:10px;color:red;">netchatsa mailer is a communication system developed by Sgela Technologies EAI. If this mail does not belong to you please ignore it. Do not reply to this email as it is controlled by RoboTech.<br></div><br>
            <div style="width:100%;text-align:center;font-size:10px;color:#000;">Copyright (c) 2018 - toDate, All right reserved.</div>
        </div>

        </body></html>';
        return $mess;
    }
}

?>
