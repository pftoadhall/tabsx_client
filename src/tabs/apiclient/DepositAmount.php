<?php

namespace tabs\apiclient;

use tabs\apiclient\Builder;
use tabs\apiclient\Currency;
use tabs\apiclient\PricingPeriod;
use tabs\apiclient\DepositAmountType;
use tabs\apiclient\Property;
use tabs\apiclient\Branding;

/**
 * Tabs Rest API DepositAmount object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2016 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 * @method DepositAmount setType(string $var) Sets the type
 * 
 * @method DepositAmount setName(string $var) Sets the name
 * 
 * @method DepositAmount setDescription(string $var) Sets the description
 * 
 * @method DepositAmount setAmount(float $var) Sets the amount
 * 
 * @method DepositAmount setPlusincludedextras(boolean $var) Sets the plusincludedextras
 * 
 * @method DepositAmount setPlusadditionalextras(boolean $var) Sets the plusadditionalextras
 * 
 * @method DepositAmount setDecimalplaces(integer $var) Sets the decimalplaces
 * 
 * 
 * @method DepositAmount setFromdate(\DateTime $var) Sets the fromdate
 * 
 * @method DepositAmount setTodate(\DateTime $var) Sets the todate
 * 
 * @method DepositAmount setMinimumamount(integer $var) Sets the minimumamount
 */
class DepositAmount extends Builder
{
    /**
     * Type
     *
     * @var string
     */
    protected $type;

    /**
     * Name
     *
     * @var string
     */
    protected $name;

    /**
     * Description
     *
     * @var string
     */
    protected $description;

    /**
     * Currency
     *
     * @var Currency
     */
    protected $currency;

    /**
     * Pricingperiod
     *
     * @var PricingPeriod
     */
    protected $pricingperiod;

    /**
     * Depositamounttype
     *
     * @var DepositAmountType
     */
    protected $depositamounttype;

    /**
     * Amount
     *
     * @var float
     */
    protected $amount;

    /**
     * Plusincludedextras
     *
     * @var boolean
     */
    protected $plusincludedextras;

    /**
     * Plusadditionalextras
     *
     * @var boolean
     */
    protected $plusadditionalextras;

    /**
     * Decimalplaces
     *
     * @var integer
     */
    protected $decimalplaces;

    /**
     * Property
     *
     * @var Property
     */
    protected $property;

    /**
     * Branding
     *
     * @var Branding
     */
    protected $branding;

    /**
     * Fromdate
     *
     * @var \DateTime
     */
    protected $fromdate;

    /**
     * Todate
     *
     * @var \DateTime
     */
    protected $todate;

    /**
     * Minimumamount
     *
     * @var integer
     */
    protected $minimumamount;

    // -------------------- Public Functions -------------------- //

    /**
     * @inheritDoc
     */
    public function __construct($id = null)
    {
        $this->fromdate = new \DateTime();
        $this->todate = new \DateTime();
        parent::__construct($id);
    }

    /**
     * Set the currency
     *
     * @param stdclass|array|Currency $currency The Currency
     *
     * @return DepositAmount
     */
    public function setCurrency($currency)
    {
        $this->currency = Currency::factory($currency);

        return $this;
    }

    /**
     * Set the pricingperiod
     *
     * @param stdclass|array|PricingPeriod $pricingperiod The Pricingperiod
     *
     * @return DepositAmount
     */
    public function setPricingperiod($pricingperiod)
    {
        $this->pricingperiod = PricingPeriod::factory($pricingperiod);

        return $this;
    }

    /**
     * Set the depositamounttype
     *
     * @param stdclass|array|DepositAmountType $depositamounttype The Depositamounttype
     *
     * @return DepositAmount
     */
    public function setDepositamounttype($depositamounttype)
    {
        $this->depositamounttype = DepositAmountType::factory($depositamounttype);

        return $this;
    }

    /**
     * Set the property
     *
     * @param stdclass|array|Property $property The Property
     *
     * @return DepositAmount
     */
    public function setProperty($property)
    {
        $this->property = Property::factory($property);

        return $this;
    }

    /**
     * Set the branding
     *
     * @param stdclass|array|Branding $branding The branding
     *
     * @return DepositAmount
     */
    public function setBranding($branding)
    {
        $this->branding = Branding::factory($branding);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $arr = array(
            'type' => $this->getType(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'currencyid' => $this->getCurrency()->getId(),
            'pricingperiod' => $this->getPricingperiod()->getPricingperiod(),
            'depositamounttype' => $this->getDepositamounttype()->getDepositamounttype(),
            'amount' => $this->getAmount(),
            'plusincludedextras' => $this->boolToStr($this->getPlusincludedextras()),
            'plusadditionalextras' => $this->boolToStr($this->getPlusadditionalextras()),
            'decimalplaces' => $this->getDecimalplaces(),
            'minimumamount' => $this->getMinimumamount(),
        );
        
        if ($this->getType() == 'Property') {
            $arr['propertyid'] = $this->getProperty()->getId();
        }
        
        if ($this->getType() == 'Branding') {
            $arr['brandingid'] = $this->getBranding()->getId();
        }
        
        if ($this->getType() != 'Booking') {
            $arr['fromdate'] = $this->getFromdate()->format('Y-m-d');
            $arr['todate'] = $this->getTodate()->format('Y-m-d');
        }
        
        return $arr;
    }

    /**
     * Returns the type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * Returns the currency
     *
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Returns the pricingperiod
     *
     * @return PricingPeriod
     */
    public function getPricingperiod()
    {
        return $this->pricingperiod;
    }

    /**
     * Returns the depositamounttype
     *
     * @return DepositAmountType
     */
    public function getDepositamounttype()
    {
        return $this->depositamounttype;
    }

    /**
     * Returns the amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Returns the plusincludedextras
     *
     * @return boolean
     */
    public function getPlusincludedextras()
    {
        return $this->plusincludedextras;
    }

    /**
     * Returns the plusadditionalextras
     *
     * @return boolean
     */
    public function getPlusadditionalextras()
    {
        return $this->plusadditionalextras;
    }

    /**
     * Returns the decimalplaces
     *
     * @return integer
     */
    public function getDecimalplaces()
    {
        return $this->decimalplaces;
    }

    /**
     * Returns the property
     *
     * @return Property
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Returns the branding
     *
     * @return Branding
     */
    public function getBranding()
    {
        return $this->branding;
    }

    /**
     * Returns the fromdate
     *
     * @return \DateTime
     */
    public function getFromdate()
    {
        return $this->fromdate;
    }

    /**
     * Returns the todate
     *
     * @return \DateTime
     */
    public function getTodate()
    {
        return $this->todate;
    }

    /**
     * Returns the minimumamount
     *
     * @return integer
     */
    public function getMinimumamount()
    {
        return $this->minimumamount;
    }
}