<?php

namespace Src\App\Classes;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Src\Config\MailConfig;

/**
 * Class SendMailClass
 * 
 * @package Src\App\Classes
 * @author <jonas-elias/>
 */
class SendMailClass extends AttributesMailClass
{
    /**
     * Method constructor
     * 
     * @param AttributesMailClass $attributes
     * @return void
     */
    public function __construct(AttributesMailClass $attributes)
    {
        $this->to = $attributes->to;
        $this->subject = $attributes->subject;
        $this->message = $attributes->message;
    }

    /**
     * Method send mail
     * 
     * @return array
     */
    public function sendMail(): array
    {
        try {
            $this->bodyToMail(
                $this->configurationAddresses(
                    $this->configurationAttributesPHPMailer(new PHPMailer(true))
                )
            )
                ->send();

            return $this->formatResponse(200, 'Mail sent successfully!');
        } catch (Exception $e) {
            return $this->formatResponse($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Method configuration attributes PHPMailer
     * 
     * @param PHPMailer $mail
     * @return PHPMailer
     */
    protected function configurationAttributesPHPMailer(PHPMailer $mail): PHPMailer
    {
        $mail->isSMTP();
        $mail->Host       = MailConfig::$service;
        $mail->SMTPAuth   = true;
        $mail->Username   = MailConfig::$emailName;
        $mail->Password   = MailConfig::$emailPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = MailConfig::$port;

        return $mail;
    }

    /**
     * Method to configuration addresses
     * 
     * @return object
     */
    protected function configurationAddresses(PHPMailer $mail): PHPMailer
    {
        $mail->setFrom(MailConfig::$emailName, 'Mail sender');
        $mail->addAddress($this->to);

        return $mail;
    }

    /**
     * Method to body to mail
     * 
     * @param PHPMailer $mail
     * @return PHPMailer
     */
    protected function bodyToMail(PHPMailer $mail): PHPMailer
    {
        $mail->isHTML(true);
        $mail->Subject =  $this->subject;
        $mail->Body    =  $this->message;
        $mail->AltBody = 'Is necessary support for HTML 5';

        return $mail;
    }

    /**
     * Method to format response
     * 
     * @return array
     */
    public function formatResponse(int $code, string $message): array
    {
        $this->status['status_code'] = $code;
        $this->status['description_status'] = $message;

        return $this->status;
    }
}
