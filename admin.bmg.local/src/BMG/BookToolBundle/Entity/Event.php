<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="fk_event_event_type1_idx", columns={"event_type_id"}), @ORM\Index(name="fk_event_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Event
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_datetime", type="datetime", nullable=false)
     */
    private $eventDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="event_ip", type="string", length=20, nullable=false)
     */
    private $eventIp;

    /**
     * @var string
     *
     * @ORM\Column(name="event_description", type="string", length=255, nullable=true)
     */
    private $eventDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="event_controller", type="string", length=100, nullable=true)
     */
    private $eventController;

    /**
     * @var string
     *
     * @ORM\Column(name="event_extra", type="string", length=2000, nullable=true)
     */
    private $eventExtra;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eventId;

    /**
     * @var \BMG\BookToolBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

    /**
     * @var \BMG\BookToolBundle\Entity\EventType
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\EventType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_type_id", referencedColumnName="event_type_id")
     * })
     */
    private $eventType;



    /**
     * Set eventDatetime
     *
     * @param \DateTime $eventDatetime
     * @return Event
     */
    public function setEventDatetime($eventDatetime)
    {
        $this->eventDatetime = $eventDatetime;

        return $this;
    }

    /**
     * Get eventDatetime
     *
     * @return \DateTime 
     */
    public function getEventDatetime()
    {
        return $this->eventDatetime;
    }

    /**
     * Set eventIp
     *
     * @param string $eventIp
     * @return Event
     */
    public function setEventIp($eventIp)
    {
        $this->eventIp = $eventIp;

        return $this;
    }

    /**
     * Get eventIp
     *
     * @return string 
     */
    public function getEventIp()
    {
        return $this->eventIp;
    }

    /**
     * Set eventDescription
     *
     * @param string $eventDescription
     * @return Event
     */
    public function setEventDescription($eventDescription)
    {
        $this->eventDescription = $eventDescription;

        return $this;
    }

    /**
     * Get eventDescription
     *
     * @return string 
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * Set eventController
     *
     * @param string $eventController
     * @return Event
     */
    public function setEventController($eventController)
    {
        $this->eventController = $eventController;

        return $this;
    }

    /**
     * Get eventController
     *
     * @return string 
     */
    public function getEventController()
    {
        return $this->eventController;
    }

    /**
     * Set eventExtra
     *
     * @param string $eventExtra
     * @return Event
     */
    public function setEventExtra($eventExtra)
    {
        $this->eventExtra = $eventExtra;

        return $this;
    }

    /**
     * Get eventExtra
     *
     * @return string 
     */
    public function getEventExtra()
    {
        return $this->eventExtra;
    }

    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return Event
     */
    public function setUser(\BMG\BookToolBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BMG\BookToolBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set eventType
     *
     * @param \BMG\BookToolBundle\Entity\EventType $eventType
     * @return Event
     */
    public function setEventType(\BMG\BookToolBundle\Entity\EventType $eventType = null)
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * Get eventType
     *
     * @return \BMG\BookToolBundle\Entity\EventType 
     */
    public function getEventType()
    {
        return $this->eventType;
    }
    
    public function __toString() {
    	return $this->getEventId();
    }
}
