<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRentalLink
 *
 * @ORM\Table(name="user_rental_link", indexes={@ORM\Index(name="fk_rental_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_user_rental_link_equipment1_idx", columns={"equipment_id"}), @ORM\Index(name="fk_user_rental_link_time_period1_idx", columns={"time_period_id"})})
 * @ORM\Entity
 */
class UserRentalLink
{
    /**
     * @var float
     *
     * @ORM\Column(name="user_rental_link_fee", type="float", precision=9, scale=2, nullable=false)
     */
    private $userRentalLinkFee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_rental_link_datetime", type="datetime", nullable=false)
     */
    private $userRentalLinkDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="rental_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rentalId;

    /**
     * @var \BMG\BookToolBundle\Entity\TimePeriod
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\TimePeriod")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="time_period_id", referencedColumnName="time_period_id")
     * })
     */
    private $timePeriod;

    /**
     * @var \BMG\BookToolBundle\Entity\Equipment
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Equipment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipment_id", referencedColumnName="equipment_id")
     * })
     */
    private $equipment;

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
     * Set userRentalLinkFee
     *
     * @param float $userRentalLinkFee
     * @return UserRentalLink
     */
    public function setUserRentalLinkFee($userRentalLinkFee)
    {
        $this->userRentalLinkFee = $userRentalLinkFee;

        return $this;
    }

    /**
     * Get userRentalLinkFee
     *
     * @return float 
     */
    public function getUserRentalLinkFee()
    {
        return $this->userRentalLinkFee;
    }

    /**
     * Set userRentalLinkDatetime
     *
     * @param \DateTime $userRentalLinkDatetime
     * @return UserRentalLink
     */
    public function setUserRentalLinkDatetime($userRentalLinkDatetime)
    {
        $this->userRentalLinkDatetime = $userRentalLinkDatetime;

        return $this;
    }

    /**
     * Get userRentalLinkDatetime
     *
     * @return \DateTime 
     */
    public function getUserRentalLinkDatetime()
    {
        return $this->userRentalLinkDatetime;
    }

    /**
     * Get rentalId
     *
     * @return integer 
     */
    public function getRentalId()
    {
        return $this->rentalId;
    }

    /**
     * Set timePeriod
     *
     * @param \BMG\BookToolBundle\Entity\TimePeriod $timePeriod
     * @return UserRentalLink
     */
    public function setTimePeriod(\BMG\BookToolBundle\Entity\TimePeriod $timePeriod = null)
    {
        $this->timePeriod = $timePeriod;

        return $this;
    }

    /**
     * Get timePeriod
     *
     * @return \BMG\BookToolBundle\Entity\TimePeriod 
     */
    public function getTimePeriod()
    {
        return $this->timePeriod;
    }

    /**
     * Set equipment
     *
     * @param \BMG\BookToolBundle\Entity\Equipment $equipment
     * @return UserRentalLink
     */
    public function setEquipment(\BMG\BookToolBundle\Entity\Equipment $equipment = null)
    {
        $this->equipment = $equipment;

        return $this;
    }

    /**
     * Get equipment
     *
     * @return \BMG\BookToolBundle\Entity\Equipment 
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return UserRentalLink
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
}
