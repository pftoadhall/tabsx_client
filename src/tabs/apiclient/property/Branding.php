<?php

namespace tabs\apiclient\property;

use tabs\apiclient\Builder;
use tabs\apiclient\Collection;
use tabs\apiclient\property\BookingBrand;
use tabs\apiclient\property\MarketingBrand;
use tabs\apiclient\property\price\Price;
use tabs\apiclient\property\branding\AvailableDay;
use tabs\apiclient\property\branding\Status;
use tabs\apiclient\property\branding\Calendar;
use tabs\apiclient\property\branding\ChangeDayTemplate;
use tabs\apiclient\property\branding\PricingYear;
use tabs\apiclient\extra\branding\Pricing;
use tabs\apiclient\extra\branding\Configuration;

/**
 * Tabs Rest API PropertyBranding object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2016 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 * @method Branding setPrimarybookingbrand(boolean $var) Sets the primarybookingbrand
 *
 * @method Branding setPromote(boolean $var) Sets the promote
 *
 * @method Branding setAllowbookingonwebuntil(\DateTime $var) Sets the allowbookingonwebuntil
 *
 * @method Branding setShowpricingonwebuntil(\DateTime $var) Sets the showpricingonwebuntil
 *
 * @method Branding setConvertpotentialstoprovisionals(string $var) Sets the convertpotentialstoprovisionals
 * 
 * @method Collection|ChangeDayTemplate[] getChangedaytemplates Returns the change day templates
 * @method Collection|Pricing[] getExtraprices() Returns the property extra prices
 * @method Collection|Configuration[] getExtraconfigurations() Returns the property extra configurations
 */
class Branding extends Builder
{
    /**
     * @var \tabs\apiclient\Branding
     */
    protected $branding;

    /**
     * @var \tabs\apiclient\BrandingGroup
     */
    protected $brandinggroup;

    /**
     * @var BookingBrand
     */
    protected $bookingbrand;

    /**
     * @var MarketingBrand
     */
    public $marketingbrand;

    /**
     * @var boolean
     */
    protected $primarybookingbrand;

    /**
     * @var boolean
     */
    protected $primarybranding;

    /**
     * @var PricingYear
     */
    protected $pricingyear;

    /**
     * @var boolean
     */
    protected $promote;

    /**
     * @var \tabs\apiclient\Status
     */
    protected $status;

    /**
     * @var Collection|Price[]
     */
    protected $prices;

    /**
     * @var Collection|Pricing[]
     */
    protected $extraprices;

    /**
     * @var Collection|Configuration[]
     */
    protected $extraconfigurations;

    /**
     * @var Collection|ChangeDayTemplate[]
     */
    protected $changedaytemplates;

    /**
     * @var Collection|AvailableDay[]
     */
    protected $availableDays;

    /**
     * @var Collection|Status[]
     */
    protected $statuses;

    /**
     * @var Collection|\tabs\apiclient\SpecialOffer[]
     */
    protected $specialoffers;

    /**
     * @var \DateTime
     */
    protected $allowbookingonwebuntil;

    /**
     * @var \DateTime
     */
    protected $showpricingonwebuntil;

    /**
     * @var string
     */
    protected $convertpotentialstoprovisionals;

    /**
     * @var \DateTime
     */
    protected $fromdate;

    /**
     * @var \DateTime
     */
    protected $todate;

    /**
     * @var array
     */
    protected $__COLLECTION_MAP = array(
        'statuses' => array(
            'class' => 'property\\branding\\Status',
            'parent' => true
        )
    );

    // -------------------- Public Functions -------------------- //

    /**
     * @inheritDoc
     */
    public function __construct($id = null)
    {
        $this->pricingyear = Collection::factory(
            'pricingyear',
            new PricingYear,
            $this
        );
        
        $this->prices = Collection::factory(
            'price',
            new Price,
            $this
        );

        $this->extraprices = Collection::factory(
            'extrapricing',
            new Pricing(),
            $this
        );

        $this->extraconfigurations = Collection::factory(
            'extraconfiguration',
            new Configuration(),
            $this
        );

        $this->changedaytemplates = Collection::factory(
            'changedaytemplate',
            new \tabs\apiclient\property\branding\ChangeDayTemplate(),
            $this
        );

        $this->availableDays = Collection::factory(
            'availability',
            new AvailableDay(),
            $this
        );

        $this->specialoffers = Collection::factory(
            'specialoffer',
            new \tabs\apiclient\SpecialOffer()
        );

        $this->specialoffers->setPath(function() {
            return $this->getUpdateUrl() . '/specialoffer';
        });

        $this->allowbookingonwebuntil = new \DateTime();
        $this->showpricingonwebuntil = new \DateTime();
        $this->fromdate = new \DateTime();
        $this->todate = new \DateTime();

        parent::__construct($id);
    }

    /**
     * Get some prices for the property brand
     *
     * @param \DateTime $fromDate Start date of price range
     * @param \DateTime $toDate   End date of price range
     *
     * @return Collection|Price[]
     */
    public function getPrices(
        \DateTime $fromDate = null,
        \DateTime $toDate = null
    ) {
        if ($fromDate && $toDate) {
            $this->prices->getPagination()
                ->addParameter('fromdate', $fromDate->format('Y-m-d'))
                ->addParameter('todate', $toDate->format('Y-m-d'));
        } else {
            $this->prices->getPagination()->removeParameter('fromdate')
                ->removeParameter('todate');
        }

        return $this->prices->fetch();
    }

    /**
     * Return the prices collection
     *
     * @return Collection|Price[]
     */
    public function getPricesCollection()
    {
        return $this->prices;
    }

    /**
     * Return the available days collection
     *
     * @return Collection|AvailableDay[]
     */
    public function getAvailableDaysCollection()
    {
        return $this->availableDays;
    }

    /**
     * Get some availability for the brand
     *
     * @param \DateTime $fromDate          Start date of availability range
     * @param \DateTime $toDate            End date of availability range
     * @param boolean   $includechangedays Whether to include change day information
     * @param int       $affiliateid       Optional affiliate id
     *
     * @return Collection|AvailableDay[]
     */
    public function getAvailableDays(
        \DateTime $fromDate = null,
        \DateTime $toDate = null,
        $includechangedays = true,
        $affiliateid = null
    ) {
        if ($fromDate && $toDate) {
            $this->availableDays->getPagination()
                ->addParameter('fromdate', $fromDate->format('Y-m-d'))
                ->addParameter('todate', $toDate->format('Y-m-d'));
        } else {
            $this->availableDays->getPagination()->removeParameter('fromdate')
                ->removeParameter('todate');
        }

        $this->availableDays->getPagination()->addParameter(
            'includechangedays',
            $this->boolToStr($includechangedays)
        );

        if ($affiliateid) {
            $this->availableDays->getPagination()->addParameter(
                'affiliateid',
                $affiliateid
            );
        }

        return $this->availableDays->fetch();
    }

    /**
     * Get a calendar object with availability for a specific month
     *
     * @param \DateTime $fromDate Fromdate
     * @param array     $options  Calendar options
     *
     * @return Calendar
     */
    public function getCalendar(
        \DateTime $fromDate = null,
        $options = array()
    ) {
        if (!$fromDate) {
            $fromDate = new \DateTime('first day of this month');
        }

        $fromDate->setTime(0, 0, 0);
        $toDate = clone $fromDate;
        $availStart = clone $fromDate;
        $availStart->sub(new \DateInterval('P7D'));
        $toDate->modify('last day of this month');
        $toDate->add(new \DateInterval('P7D'));

        $days = $this->getAvailableDays($fromDate, $toDate);

        $cal = new Calendar($options);
        $cal->setAvailableDays($days)
            ->setTargetMonth($fromDate);

        return $cal;
    }

    /**
     * Set the branding
     *
     * @param stdclass|array|\tabs\apiclient\Branding $branding The Branding
     *
     * @return Branding
     */
    public function setBranding($branding)
    {
        $this->branding = \tabs\apiclient\Branding::factory($branding);

        return $this;
    }

    /**
     * Set the brandinggroup
     *
     * @param stdclass|array|\tabs\apiclient\BrandingGroup $brandinggroup The Brandinggroup
     *
     * @return Branding
     */
    public function setBrandinggroup($brandinggroup)
    {
        $this->brandinggroup = \tabs\apiclient\BrandingGroup::factory($brandinggroup);

        return $this;
    }

    /**
     * Set the bookingbrand
     *
     * @param stdclass|array|BookingBrand $bookingbrand The Bookingbrand
     *
     * @return Branding
     */
    public function setBookingbrand($bookingbrand)
    {
        $this->bookingbrand = BookingBrand::factory($bookingbrand);

        // Fix for the non hateoas urls in the api
        if ($this->getParentProperty()) {
            $prop = $this->getParentProperty();
            $this->bookingbrand->setParent($prop);
        }

        return $this;
    }

    /**
     * Set the marketingbrand
     *
     * @param stdclass|array|MarketingBrand $marketingbrand The Marketingbrand
     *
     * @return Branding
     */
    public function setMarketingbrand($marketingbrand)
    {
        $this->marketingbrand = MarketingBrand::factory($marketingbrand);

        // Fix for the non hateoas urls in the api
        if ($this->getParentProperty()) {
            $prop = $this->getParentProperty();
            $this->marketingbrand->setParent($prop);
        }

        return $this;
    }

    /**
     * Set the status
     *
     * @param stdclass|array|Status $status The Status
     *
     * @return PropertyBranding
     */
    public function setStatus($status)
    {
        $this->status = Status::factory($status);

        return $this;
    }

    /**
     * Get the applicable offers for the property brand
     *
     * @param \DateTime $fromDate Start date of offer holiday period range
     * @param \DateTime $toDate   End date of offer holiday period range
     *
     * @return Collection|\tabs\apiclient\SpecialOffer[]
     */
    public function getSpecialoffers(
        \DateTime $fromDate = null,
        \DateTime $toDate = null
    ) {
        if ($fromDate && $toDate) {
            $this->specialoffers->getPagination()
                ->addParameter('fromdate', $fromDate->format('Y-m-d'))
                ->addParameter('todate', $toDate->format('Y-m-d'));
        } else {
            $this->specialoffers->getPagination()->removeParameter('fromdate')
                ->removeParameter('todate');
        }

        return $this->specialoffers->fetch();
    }

    /**
     * Override the set parent method to handle the non hateoas urls
     *
     * @param \tabs\apiclient\Property $element  Element
     *
     * @return Branding
     */
    public function setParent(&$element)
    {
        $this->parent = $element;

        if ($element instanceof \tabs\apiclient\Property) {
            if ($this->marketingbrand) {
                $this->marketingbrand->setParent($element);
            }
            if ($this->bookingbrand) {
                $this->bookingbrand->setParent($element);
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $arr = array(
            'brandingid' => $this->getBranding()->getId(),
            'brandinggroupid' => $this->getBrandinggroup()->getId(),
            'bookingbrandid' => $this->getBookingbrand()->getId(),
            'marketingbrandid' => $this->getMarketingbrand()->getId(),
            'primarybookingbrand' => $this->boolToStr($this->getPrimarybookingbrand()),
            'promote' => $this->boolToStr($this->getPromote()),
            'statusid' => $this->getStatus()->getId(),
            'allowbookingonwebuntildate' => $this->getAllowbookingonwebuntil()->format('Y-m-d'),
            'showpricingonwebuntildate' => $this->getShowpricingonwebuntil()->format('Y-m-d'),
            'extraconfigurations' => $this->getExtraconfigurations()->toArray(),
            'extraprices' => $this->getExtraprices()->toArray(),
            'changedaytemplates' => $this->getChangedaytemplates()->toArray(),
        );

        if ($this->getConvertpotentialstoprovisionals()) {
            $arr['convertpotentialstoprovisionals'] = $this->getConvertpotentialstoprovisionals();
        }
        
        return $arr;
    }

    /**
     * For serialisation
     *
     * @return array
     */
    public function __sleep()
    {
        return array(
            'id',
            'marketingbrand',
            'bookingbrand',
            'promote',
            'status',
            'allowbookingonwebuntil',
            'showpricingonwebuntil',
            'availableDays',
            'prices',
            'extraprices',
            'extraconfigurations',
            'changedaytemplates',
            'parent'
        );
    }

    /**
     * Returns the branding
     *
     * @return \tabs\apiclient\Branding
     */
    public function getBranding()
    {
        return $this->branding;
    }

    /**
     * Returns the brandinggroup
     *
     * @return \tabs\apiclient\BrandingGroup
     */
    public function getBrandinggroup()
    {
        return $this->brandinggroup;
    }

    /**
     * Returns the primary booking brand
     *
     * @return boolean
     */
    public function getPrimarybookingbrand()
    {
        return $this->primarybookingbrand;
    }

    /**
     * Returns the primary branding boolean
     *
     * @return boolean
     */
    public function getPrimarybranding()
    {
        return $this->primarybranding;
    }

    /**
     * Returns the promote
     *
     * @return boolean
     */
    public function getPromote()
    {
        return $this->promote;
    }

    /**
     * Returns the allowbookingonwebuntil
     *
     * @return \DateTime
     */
    public function getAllowbookingonwebuntil()
    {
        return $this->allowbookingonwebuntil;
    }

    /**
     * Returns the showpricingonwebuntil
     *
     * @return \DateTime
     */
    public function getShowpricingonwebuntil()
    {
        return $this->showpricingonwebuntil;
    }

    /**
     * Returns the convertpotentialstoprovisionals
     *
     * @return string
     */
    public function getConvertpotentialstoprovisionals()
    {
        return $this->convertpotentialstoprovisionals;
    }

    /**
     * Returns the status
     *
     * @return \tabs\apiclient\property\branding\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the status fromdate
     *
     * @return \DateTime
     */
    public function getFromdate()
    {
        return $this->fromdate;
    }

    /**
     * Returns the status todate
     *
     * @return \DateTime
     */
    public function gettodate()
    {
        return $this->todate;
    }
}