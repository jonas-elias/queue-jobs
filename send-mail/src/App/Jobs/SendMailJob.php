<?php

namespace Src\App\Jobs;

use Src\App\Classes\AttributesMailClass;
use Src\App\Classes\SendMailClass;

/**
 * Class SendMailJob
 *
 * @author <jonas-elias/>
 */
class SendMailJob
{
    public function handle(array $params)
    {
        try {
            $attributes = new AttributesMailClass();
            $attributes->__set('to', $params['to']);
            $attributes->__set('subject', $params['subject']);
            $attributes->__set('message', $params['message']);
    
            $sendMail = new SendMailClass($attributes);
            $sendMail->sendMail();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
