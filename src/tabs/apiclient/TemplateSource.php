<?php

namespace tabs\apiclient;

use tabs\apiclient\Builder;

/**
 * Tabs Rest API TemplateSource object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2017 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 * @method TemplateSource setTemplatesource(string $var) Sets the templatesource
 */
class TemplateSource extends Builder
{
    /**
     * Templatesource
     *
     * @var string
     */
    protected $templatesource;

    // -------------------- Public Functions -------------------- //

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $arr = $this->__toArray();
        $arr['sourcesql'] = 'SELECT * FROM ' . $this->getTemplatesource();
        return $arr;
    }

    /**
     * Returns the templatesource string
     *
     * @return string
     */
    public function getTemplatesource()
    {
        return $this->templatesource;
    }
}