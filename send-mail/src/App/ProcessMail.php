<?php

namespace Src\App;

use Exception;
use Src\App\Classes\AttributesMailClass;
use Src\App\Validation\ValidationMessage;
use Src\App\Classes\SendMailClass;
use Src\App\Producer\ProducerMail;

/**
 * Class ProcessMail
 * 
 * @package Src\App
 * @author <jonas-elias/>
 */
class ProcessMail
{
    /**
     * Method constructor
     * 
     * @param AttributesMailClass $attributes
     * @param \Exception $e
     * @return void
     */
    public function __construct(
        public AttributesMailClass $attributes,
        public Exception $e
    ) {
    }

    /**
     * Method process send mail
     * 
     * @return array
     */
    public function send(): array
    {
        if (!$this->validate()) {
            return false;
        }

        $sendMail = new SendMailClass($this->attributes);

        (new ProducerMail())->handle([
            'to' => $this->attributes->__get('to'),
            'subject' => $this->attributes->__get('subject'),
            'message' => $this->attributes->__get('message')
        ]);

        $response = $sendMail->formatResponse(200, 'Mail sent successfully!');

        if ($response['status_code'] == 200) {
            return $response;
        }

        return $response;
    }

    /**
     * method call validate \ValidationMessage
     * @return bool
     */
    public function validate(): bool
    {
        $validation = new ValidationMessage($this->attributes);
        return $validation->validate();
    }
}

/**
 * Instance of AttributesMailClass
 * 
 * @return object $attributes
 */
$attributes = new AttributesMailClass();

/**
 * call method orchestration SendMail
 */
orchestrationSendMail($attributes->setAllElements($_POST, $attributes));

/**
 * Method to orchestration the process of sending mail
 * 
 * @param object $attributes
 * @return mixed
 * @throws Exception
 */
function orchestrationSendMail($attributes): mixed
{
    try {
        $validation = new ValidationMessage($attributes);
        $processMail = new ProcessMail($attributes, new Exception());

        if (!$validation->validate()) {
            throw new $processMail->e('Invalid Inputs!', 406);
        }

        $response = $processMail->send();

        if ($response['status_code'] == 200) {
            $_SESSION['success'] = true;
            $_SESSION['message'] = 'Mail sent successfully!';

            header('location: /');

            return true;
        }

        throw new $processMail->e($response['description_status'], 500);
    } catch (Exception $e) {
        $_SESSION['error'] = true;
        $_SESSION['message'] = $e->getMessage();

        header('location: /');

        return false;
    }
}
