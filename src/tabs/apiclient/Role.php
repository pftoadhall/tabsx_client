<?php

namespace tabs\apiclient;

use tabs\apiclient\Builder;

/**
 * Tabs Rest API Role object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2017 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 * @method Role setName(string $var) Sets the name
 * 
 * @method Role setDonotdelete(boolean $var) Sets the donotdelete
 */
class Role extends Builder
{
    /**
     * Name
     *
     * @var string
     */
    protected $name;

    /**
     * Donotdelete
     *
     * @var boolean
     */
    protected $donotdelete;

    // -------------------- Public Functions -------------------- //

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return array(
            'name' => $this->getName(),
            'donotdelete' => $this->boolToStr($this->getDonotdelete())
        );
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
     * Returns the donotdelete
     *
     * @return boolean
     */
    public function getDonotdelete()
    {
        return $this->donotdelete;
    }
}