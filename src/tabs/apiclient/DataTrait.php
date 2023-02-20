<?php

namespace tabs\apiclient;

/**
 * Tabs Rest Data Trait object.
 *
 * Provides helper methods for data in objects
 *
 * PHP Version 5.5
 *
 * @category  API_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2014 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.carltonsoftware.co.uk
 */
trait DataTrait
{
    /**
     * Data returned from the get request
     *
     * @var \stdClass
     */
    protected $responsedata;

    /**
     * Get data from the response data object
     *
     * Uses func_get_args to get the steps to navigate the json. I.e:
     *
     * $this->getDataFromResponse('price', 'total', 'brochureprice')
     *
     * Would return the brochure price on a booking object if found.
     *
-     * @return null|mixed
     */
    public function getDataFromResponse()
    {
        return ObjectNavigator::navigate(
            func_get_args(),
            $this->responsedata
        );
    }

    /**
     * Set the response data
     *
     * @param object $data Data
     *
     * @return Base
     */
    public function setResponsedata($data)
    {
        $this->responsedata = $data;

        return $this;
    }

    /**
     * Get the response data
     *
     * @return object|null
     */
    public function getResponsedata()
    {
        return $this->responsedata;
    }
}