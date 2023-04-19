<?php

namespace Src\Config;

/**
 * Class MailConfig
 * @package Src\Config
 * @author <jonas-elias/>
 */
class MailConfig
{
    /**
     * Service Mail SMTP
     * @var string
     * @example
     * smtp-mail.outlook.com
     */
    public static $service = 'smtp-mail.outlook.com';

    /**
     * Mail address .com
     * @var string
     * @example
     * mail@hotmail.com
     */
    public static $emailName;

    /**
     * Mail password
     * @var string
     * @example
     * password
     */
    public static $emailPassword;

    /**
     * Port service mail
     * @var int
     * @example
     * 587
     */
    public static $port = '587';
}
