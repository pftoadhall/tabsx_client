<?php

namespace tabs\apiclient\actor;

use tabs\apiclient\Base;

/**
 * READ ONLY: Tabs Rest API ActorSecurity object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2017 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 */
class ActorSecurity extends Base
{
    /**
     * Securityrole
     *
     * @var \tabs\apiclient\SecurityRole
     */
    protected $securityrole;

    /**
     * Securitygroup
     *
     * @var \tabs\apiclient\SecurityGroup
     */
    protected $securitygroup;

    // -------------------- Public Functions -------------------- //

    /**
     * Set the actor
     *
     * @param stdclass|array|\tabs\apiclient\TabsUser $actor The Actor
     *
     * @return ActorSecurity
     */
    public function setActor($actor)
    {
        $this->actor = \tabs\apiclient\TabsUser::factory($actor);

        return $this;
    }

    /**
     * Set the securityrole
     *
     * @param stdclass|array|\tabs\apiclient\SecurityRole $securityrole The Securityrole
     *
     * @return ActorSecurity
     */
    public function setSecurityrole($securityrole)
    {
        $this->securityrole = \tabs\apiclient\SecurityRole::factory($securityrole);

        return $this;
    }

    /**
     * Set the securitygroup
     *
     * @param stdclass|array|\tabs\apiclient\SecurityGroup $securitygroup The Securitygroup
     *
     * @return ActorSecurity
     */
    public function setSecuritygroup($securitygroup)
    {
        $this->securitygroup = \tabs\apiclient\SecurityGroup::factory($securitygroup);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $arr = array(
        );
        
        if ($this->getSecurityrole()) {
            $arr['securityroleid'] = $this->getSecurityrole()->getId();
            $arr['type'] = 'Role';
        } else if ($this->getSecuritygroup()) {
            $arr['securitygroupid'] = $this->getSecuritygroup()->getId();
            $arr['type'] = 'Group';
        }
        
        return $arr;
    }

    /**
     * Returns the securityrole
     *
     * @return \tabs\apiclient\SecurityRole
     */
    public function getSecurityrole()
    {
        return $this->securityrole;
    }

    /**
     * Returns the securitygroup
     *
     * @return \tabs\apiclient\SecurityGroup
     */
    public function getSecuritygroup()
    {
        return $this->securitygroup;
    }
}