<?php

namespace tabs\apiclient\booking;

use tabs\apiclient\Base;

/**
 * Tabs Rest API Booking Error object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2017 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 * @method Error  setCode(string $var) Sets the code
 *
 * @method Error  setMessage(string $var) Sets the message
 */
class Error extends Base
{
    /**
     * Code
     *
     * @var number
     */
    protected $code;

    /**
     * Message
     *
     * @var string
     */
    protected $message;
    
    // -------------------------- Public Functions -------------------------- //
    
    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->getMessage();
    }

    /**
     * Returns the code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}