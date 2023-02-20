<?php

namespace tabs\apiclient;

use tabs\apiclient\Builder;
use tabs\apiclient\Collection;

/**
 * Tabs Rest API Contact object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2017 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 * @method Contact setContactdatetime(\DateTime $var) Sets the contactdatetime
 * 
 * @method Contact setContent(string $var) Sets the content
 * 
 * @method Contact setSubject(string $var) Sets the subject
 * 
 * @method Contact setDeleted(boolean $var) Sets the delete
 * 
 * @method string setStatus_status(string $var) Sets the status_status
 * 
 * @method Contact setTemplateentityid(string $var) Set the template entity id
 * @method Collection|contact\Entity[] getContactentities() Returns the contactentities
 * @method Collection|contact\Document[] getDocuments() Returns the contact documents
 */
class Contact extends Builder
{
    /**
     * Contact type
     *
     * @var \tabs\apiclient\ContactType
     */
    protected $contacttype;

    /**
     * Contact datetime
     *
     * @var \DateTime
     */
    protected $contactdatetime;

    /**
     * Contact method type
     *
     * @var \tabs\apiclient\ContactMethodType
     */
    protected $contactmethodtype;

    /**
     * Content
     *
     * @var string
     */
    protected $content;

    /**
     * Subject
     *
     * @var string
     */
    protected $subject;

    /**
     * Sourcemarketingbrand
     *
     * @var \tabs\apiclient\SourceMarketingBrand
     */
    protected $sourcemarketingbrand;

    /**
     * Template
     *
     * @var \tabs\apiclient\Template
     */
    protected $template;

    /**
     * Template entity id
     *
     * @var string
     */
    protected $templateentityid;

    /**
     * Contactentities
     *
     * @var Collection|contact\Entity[]
     */
    protected $contactentities;
    
    /**
     * Sender contact detail
     * 
     * @var \tabs\apiclient\actor\ContactDetail
     */
    protected $sender;

    /**
     * Delete
     *
     * @var boolean
     */
    protected $deleted = false;
    
    /**
     * Status_status
     *
     * @var string
     */
    protected $status_status;
    
    /**
     * Contact documents
     * 
     * @var Collection|contact\Document[]
     */
    protected $documents;

    // -------------------- Public Functions -------------------- //

    /**
     * @inheritDoc
     */
    public function __construct($id = null)
    {
        $this->contactdatetime = new \DateTime();
        $this->contactentities = Collection::factory(
            'entity',
            new contact\Entity(),
            $this
        );
        $this->documents = Collection::factory(
            'document',
            new contact\Document(),
            $this
        );
        $this->setDeleted(false);
        $this->setStatus_status('Manual Entry');
        parent::__construct($id);
    }

    /**
     * Set the contacttype
     *
     * @param stdclass|array|\tabs\apiclient\ContactType $contacttype The Contacttype
     *
     * @return Contact
     */
    public function setContacttype($contacttype)
    {
        $this->contacttype = \tabs\apiclient\ContactType::factory($contacttype);

        return $this;
    }

    /**
     * Set the template
     *
     * @param stdclass|array|\tabs\apiclient\Template $tmpl The template
     *
     * @return Contact
     */
    public function setTemplate($tmpl)
    {
        $this->template = \tabs\apiclient\Template::factory($tmpl);

        return $this;
    }

    /**
     * Set the contactmethodtype
     *
     * @param stdclass|array|\tabs\apiclient\ContactMethodType $contactmethodtype The Contactmethodtype
     *
     * @return Contact
     */
    public function setContactmethodtype($contactmethodtype)
    {
        $this->contactmethodtype = \tabs\apiclient\ContactMethodType::factory($contactmethodtype);

        return $this;
    }

    /**
     * Set the sourcemarketingbrand
     *
     * @param stdclass|array|\tabs\apiclient\SourceMarketingBrand $sourcemarketingbrand The Sourcemarketingbrand
     *
     * @return Contact
     */
    public function setSourcemarketingbrand($sourcemarketingbrand)
    {
        $this->sourcemarketingbrand = \tabs\apiclient\SourceMarketingBrand::factory($sourcemarketingbrand);

        return $this;
    }
    
    /**
     * Set the sender
     * 
     * @param stdclass|array|\tabs\apiclient\actor\ContactDetail $sender Sender
     * 
     * @return \tabs\apiclient\Contact
     */
    public function setSender($sender)
    {
        if ($sender instanceof \stdClass
            && property_exists($sender, 'type')
        ) {
            switch ($sender->type) {
            case 'P':
                $this->sender = actor\Address::factory($sender);
                break;
            case 'F':
                $this->sender = actor\PhoneNumber::factory($sender);
                break;
            default:
                $this->sender = actor\ContactDetailOther::factory($sender);
                break;
            }
        } else {
            $this->sender = actor\ContactDetail::factory($sender);
        }
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $arr = $this->__toArray();
        
        if ($this->getContacttype()) {
            $arr['contacttype'] = $this->getContacttype()->getType();
        }
        
        if ($this->getContactmethodtype()) {
            $arr['contactmethodtype'] = $this->getContactmethodtype()->getMethod();
        }
        
        if ($this->getSender()) {
            $arr['sendercontactdetailid'] = $this->getSender()->getId();
        }
        
        if ($this->getTemplate()) {
            $arr['templateid'] = $this->getTemplate()->getId();
        }
        
        if ($this->getSourcemarketingbrand()) {
            $arr['sourcemarketingbrandid'] = $this->getSourcemarketingbrand()->getId();
        }
        
        return $arr;
    }

    /**
     * Returns the contacttype
     *
     * @return \tabs\apiclient\ContactType
     */
    public function getContacttype()
    {
        return $this->contacttype;
    }

    /**
     * Returns the contactdatetime
     *
     * @return \DateTime
     */
    public function getContactdatetime()
    {
        return $this->contactdatetime;
    }

    /**
     * Returns the contactmethodtype
     *
     * @return \tabs\apiclient\ContactMethodType
     */
    public function getContactmethodtype()
    {
        return $this->contactmethodtype;
    }

    /**
     * Returns the content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Returns the subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Returns the delete
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Returns the status_status
     *
     * @return string
     */
    public function getStatus_status()
    {
        return $this->status_status;
    }

    /**
     * Returns the sourcemarketingbrand
     *
     * @return \tabs\apiclient\SourceMarketingBrand
     */
    public function getSourcemarketingbrand()
    {
        return $this->sourcemarketingbrand;
    }

    /**
     * Returns the template
     *
     * @return \tabs\apiclient\Template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Returns the template entity id
     *
     * @return string
     */
    public function getTemplateentityid()
    {
        return $this->templateentityid;
    }

    /**
     * Returns the sender contact detail
     *
     * @return \tabs\apiclient\actor\ContactDetail
     */
    public function getSender()
    {
        return $this->sender;
    }
}