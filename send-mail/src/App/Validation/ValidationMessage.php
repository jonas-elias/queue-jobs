<?php

namespace Src\App\Validation;

use Src\App\Classes\AttributesMailClass;

/**
 * Class ValidationMessage
 * 
 * @package Src\App\Validation
 * @author <jonas-elias/>
 */
class ValidationMessage extends AttributesMailClass
{
    /**
     * to mail
     * 
     * @var string
     */
    private $to;

    /**
     * subject mail
     * 
     * @var string
     */
    private $subject;

    /**
     * message mail
     * 
     * @var string
     */
    private $message;

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
     * Method validate
     * 
     * @return bool
     */
    public function validate(): bool
    {
        if (empty($this->to) || empty($this->subject) || empty($this->message)) {
            return false;
        }

        return true;
    }
}
