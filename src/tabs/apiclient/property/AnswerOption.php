<?php

namespace tabs\apiclient\property;

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
 * @method AnswerOption setAnsweroption(string $var) Sets the group
 */
class AnswerOption extends Builder
{
    /**
     * @var string
     */
    protected $answeroption;

    /**
     * Returns the group
     *
     * @return string
     */
    public function getAnsweroption()
    {
        return $this->answeroption;
    }
}