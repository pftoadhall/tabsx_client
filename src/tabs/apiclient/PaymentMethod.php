<?php

namespace tabs\apiclient;

use tabs\apiclient\Builder;

/**
 * Tabs Rest API PaymentMethod object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2017 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 * @method PaymentMethod setPaymentmethod(string $var) Sets the paymentmethod
 * 
 * @method PaymentMethod setDescription(string $var) Sets the description
 */
class PaymentMethod extends Builder
{
    /**
     * Paymentmethod
     *
     * @var string
     */
    protected $paymentmethod;

    /**
     * Description
     *
     * @var string
     */
    protected $description;

    // -------------------- Public Functions -------------------- //

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return array(
            'paymentmethod' => $this->getPaymentmethod(),
            'description' => $this->getDescription()
        );
    }

    /**
     * Returns the paymentmethod
     *
     * @return string
     */
    public function getPaymentmethod()
    {
        return $this->paymentmethod;
    }

    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}