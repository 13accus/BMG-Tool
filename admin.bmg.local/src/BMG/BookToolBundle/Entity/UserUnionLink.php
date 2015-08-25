<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserUnionLink
 *
 * @ORM\Table(name="user_union_link", indexes={@ORM\Index(name="fk_user_union_link_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_user_union_link_union1_idx", columns={"union_id"})})
 * @ORM\Entity
 */
class UserUnionLink
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_union_link_datetime", type="datetime", nullable=false)
     */
    private $userUnionLinkDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_union_link_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userUnionLinkId;

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
     * @var \BMG\BookToolBundle\Entity\Unions
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Unions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="union_id", referencedColumnName="union_id")
     * })
     */
    private $union;



    /**
     * Set userUnionLinkDatetime
     *
     * @param \DateTime $userUnionLinkDatetime
     * @return UserUnionLink
     */
    public function setUserUnionLinkDatetime($userUnionLinkDatetime)
    {
        $this->userUnionLinkDatetime = $userUnionLinkDatetime;

        return $this;
    }

    /**
     * Get userUnionLinkDatetime
     *
     * @return \DateTime 
     */
    public function getUserUnionLinkDatetime()
    {
        return $this->userUnionLinkDatetime;
    }

    /**
     * Get userUnionLinkId
     *
     * @return integer 
     */
    public function getUserUnionLinkId()
    {
        return $this->userUnionLinkId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return UserUnionLink
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
     * Set union
     *
     * @param \BMG\BookToolBundle\Entity\Unions $union
     * @return UserUnionLink
     */
    public function setUnion(\BMG\BookToolBundle\Entity\Unions $union = null)
    {
        $this->union = $union;

        return $this;
    }

    /**
     * Get union
     *
     * @return \BMG\BookToolBundle\Entity\Unions 
     */
    public function getUnion()
    {
        return $this->union;
    }
}
