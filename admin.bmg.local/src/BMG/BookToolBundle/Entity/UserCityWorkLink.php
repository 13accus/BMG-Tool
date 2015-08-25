<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserCityWorkLink
 *
 * @ORM\Table(name="user_city_work_link", indexes={@ORM\Index(name="fk_user_city_link_city1_idx", columns={"city_id"}), @ORM\Index(name="fk_user_city_link_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class UserCityWorkLink
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_city_work_link_datetime", type="datetime", nullable=false)
     */
    private $userCityWorkLinkDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_city_work_link_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userCityWorkLinkId;

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
     * @var \BMG\BookToolBundle\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    private $city;



    /**
     * Set userCityWorkLinkDatetime
     *
     * @param \DateTime $userCityWorkLinkDatetime
     * @return UserCityWorkLink
     */
    public function setUserCityWorkLinkDatetime($userCityWorkLinkDatetime)
    {
        $this->userCityWorkLinkDatetime = $userCityWorkLinkDatetime;

        return $this;
    }

    /**
     * Get userCityWorkLinkDatetime
     *
     * @return \DateTime 
     */
    public function getUserCityWorkLinkDatetime()
    {
        return $this->userCityWorkLinkDatetime;
    }

    /**
     * Get userCityWorkLinkId
     *
     * @return integer 
     */
    public function getUserCityWorkLinkId()
    {
        return $this->userCityWorkLinkId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return UserCityWorkLink
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
     * Set city
     *
     * @param \BMG\BookToolBundle\Entity\City $city
     * @return UserCityWorkLink
     */
    public function setCity(\BMG\BookToolBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \BMG\BookToolBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }
}
