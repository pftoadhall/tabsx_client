<?php

namespace tabs\apiclient;
use tabs\apiclient\Builder;

/**
 * Tabs Rest API object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2016 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 * @method Account setGroup(string $var) Sets the group
 * @method Account setNominalcode(string $var) Sets the nominalcode
 * @method Account setDescription(string $var) Sets the description
 * @method Account setUsebranding(boolean $var) Sets the usebranding
 */
class Account extends Builder
{
    /**
     * @var string
     */
    protected $group;

    /**
     * @var string
     */
    protected $nominalcode;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var boolean
     */
    protected $usebranding;

    // -------------------- Public Functions -------------------- //

    /**
     * Returns the group
     *
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Returns the nominalcode
     *
     * @return string
     */
    public function getNominalcode()
    {
        return $this->nominalcode;
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
     * Returns the usebranding
     *
     * @return boolean
     */
    public function getUsebranding()
    {
        return $this->usebranding;
    }
}