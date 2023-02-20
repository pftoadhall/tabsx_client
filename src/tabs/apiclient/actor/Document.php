<?php

namespace tabs\apiclient\actor;
use tabs\apiclient\Builder;

/**
 * Tabs Rest API ActorDocument object.
 *
 * @category  Tabs_Client
 * @package   Tabs
 * @author    Carlton Software <support@carltonsoftware.co.uk>
 * @copyright 2016 Carlton Software
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 1
 * @link      http://www.carltonsoftware.co.uk
 *
 * @method Document setCreated(\DateTime $var) Sets the created
 * 
 */
class Document extends Builder
{
    /**
     * Created
     *
     * @var \DateTime
     */
    protected $created;

    /**
     * Document
     *
     * @var \tabs\apiclient\Document
     */
    protected $document;

    // -------------------- Public Functions -------------------- //

    /**
     * Constructor
     * 
     * @param integer $id ID
     *
     * @return void
     */
    public function __construct($id = null)
    {
        $this->created = new \DateTime();

        parent::__construct($id);
    }

    /**
     * Set the document
     *
     * @param stdclass|array|\tabs\apiclient\Document $document The Document
     *
     * @return ActorDocument
     */
    public function setDocument($document)
    {
        $this->document = \tabs\apiclient\Document::factory($document);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return array(
            'documentid' => $this->getDocument()->getId()
        );
    }

    /**
     * Returns the created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Returns the document
     *
     * @return \tabs\apiclient\Document
     */
    public function getDocument()
    {
        return $this->document;
    }
}