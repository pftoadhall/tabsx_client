<?php

namespace tabs\apiclient;

/**
 * Tabs Rest API Boolean Attribute object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2016 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 */
class AttributeBoolean extends Attribute
{
    /**
     * @inheritDoc
     */
    public function __construct($id = null)
    {
        $this->type = 'Boolean';
        
        parent::__construct($id);
    }
}