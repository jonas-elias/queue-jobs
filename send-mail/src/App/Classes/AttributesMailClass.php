<?php

namespace Src\App\Classes;

/**
 * Class AttributesMailClass
 * 
 * @package Src\App\Classes
 * @author <jonas-elias/>
 */
class AttributesMailClass
{
    /**
     * @var string
     */
    private string $to;

    /**
     * @var string
     */
    private string $subject;

    /**
     * @var string
     */
    private string $message;

    /**
     * @var array
     */
    public $status = array('status_code' => null, 'description_status' => null);

    /**
     * Method __get elements
     * 
     * @param string $attribute
     * @return mixed
     */
    public function __get($attribute): mixed
    {
        return $this->$attribute;
    }

    /**
     * Method __set elements
     * 
     * @param string $attribute
     * @param mixed $value
     * @return void
     */
    public function __set($atribute, $value): void
    {
        $this->$atribute = $value;
    }

    /**
     * Method to set all elements
     * 
     * @param $_POST
     * @return object
     */
    public function setAllElements($elements, $object): object
    {
        foreach ($elements as $key => $value) {
            $object->__set($key, $value);
        }

        return $object;
    }
}
