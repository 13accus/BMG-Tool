<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserClearanceLink
 *
 * @ORM\Table(name="user_clearance_link", indexes={@ORM\Index(name="fk_user_clearance_link_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_user_clearance_link_clearance1_idx", columns={"clearance_id"})})
 * @ORM\Entity
 */
class UserClearanceLink
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_clearance_link_datetime", type="datetime", nullable=false)
     */
    private $userClearanceLinkDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_clearance_link_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userClearanceLinkId;

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
     * @var \BMG\BookToolBundle\Entity\Clearance
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Clearance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clearance_id", referencedColumnName="clearance_id")
     * })
     */
    private $clearance;



    /**
     * Set userClearanceLinkDatetime
     *
     * @param \DateTime $userClearanceLinkDatetime
     * @return UserClearanceLink
     */
    public function setUserClearanceLinkDatetime($userClearanceLinkDatetime)
    {
        $this->userClearanceLinkDatetime = $userClearanceLinkDatetime;

        return $this;
    }

    /**
     * Get userClearanceLinkDatetime
     *
     * @return \DateTime 
     */
    public function getUserClearanceLinkDatetime()
    {
        return $this->userClearanceLinkDatetime;
    }

    /**
     * Get userClearanceLinkId
     *
     * @return integer 
     */
    public function getUserClearanceLinkId()
    {
        return $this->userClearanceLinkId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return UserClearanceLink
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
     * Set clearance
     *
     * @param \BMG\BookToolBundle\Entity\Clearance $clearance
     * @return UserClearanceLink
     */
    public function setClearance(\BMG\BookToolBundle\Entity\Clearance $clearance = null)
    {
        $this->clearance = $clearance;

        return $this;
    }

    /**
     * Get clearance
     *
     * @return \BMG\BookToolBundle\Entity\Clearance 
     */
    public function getClearance()
    {
        return $this->clearance;
    }
}
