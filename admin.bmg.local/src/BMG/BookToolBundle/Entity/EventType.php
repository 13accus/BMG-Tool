<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventType
 *
 * @ORM\Table(name="event_type")
 * @ORM\Entity
 */
class EventType
{
    /**
     * @var string
     *
     * @ORM\Column(name="event_type_name", type="string", length=45, nullable=true)
     */
    private $eventTypeName;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_type_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eventTypeId;



    /**
     * Set eventTypeName
     *
     * @param string $eventTypeName
     * @return EventType
     */
    public function setEventTypeName($eventTypeName)
    {
        $this->eventTypeName = $eventTypeName;

        return $this;
    }

    /**
     * Get eventTypeName
     *
     * @return string 
     */
    public function getEventTypeName()
    {
        return $this->eventTypeName;
    }

    /**
     * Get eventTypeId
     *
     * @return integer 
     */
    public function getEventTypeId()
    {
        return $this->eventTypeId;
    }
    
    public function __toString() {
    	return $this->getEventTypeName();
    }
}
