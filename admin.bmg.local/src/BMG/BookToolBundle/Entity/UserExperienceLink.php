<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserExperienceLink
 *
 * @ORM\Table(name="user_experience_link", indexes={@ORM\Index(name="fk_user_experience_link_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_user_experience_link_experience1_idx", columns={"experience_id"}), @ORM\Index(name="fk_user_experience_link_time_period1_idx", columns={"time_period_id"})})
 * @ORM\Entity
 */
class UserExperienceLink
{
    /**
     * @var float
     *
     * @ORM\Column(name="user_experience_link_rate", type="float", precision=9, scale=2, nullable=false)
     */
    private $userExperienceLinkRate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_experience_link_datetime", type="datetime", nullable=false)
     */
    private $userExperienceLinkDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_experience_link_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userExperienceLinkId;

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
     * @var \BMG\BookToolBundle\Entity\TimePeriod
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\TimePeriod")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="time_period_id", referencedColumnName="time_period_id")
     * })
     */
    private $timePeriod;

    /**
     * @var \BMG\BookToolBundle\Entity\Experience
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Experience")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="experience_id", referencedColumnName="experience_id")
     * })
     */
    private $experience;



    /**
     * Set userExperienceLinkRate
     *
     * @param float $userExperienceLinkRate
     * @return UserExperienceLink
     */
    public function setUserExperienceLinkRate($userExperienceLinkRate)
    {
        $this->userExperienceLinkRate = $userExperienceLinkRate;

        return $this;
    }

    /**
     * Get userExperienceLinkRate
     *
     * @return float 
     */
    public function getUserExperienceLinkRate()
    {
        return $this->userExperienceLinkRate;
    }

    /**
     * Set userExperienceLinkDatetime
     *
     * @param \DateTime $userExperienceLinkDatetime
     * @return UserExperienceLink
     */
    public function setUserExperienceLinkDatetime($userExperienceLinkDatetime)
    {
        $this->userExperienceLinkDatetime = $userExperienceLinkDatetime;

        return $this;
    }

    /**
     * Get userExperienceLinkDatetime
     *
     * @return \DateTime 
     */
    public function getUserExperienceLinkDatetime()
    {
        return $this->userExperienceLinkDatetime;
    }

    /**
     * Get userExperienceLinkId
     *
     * @return integer 
     */
    public function getUserExperienceLinkId()
    {
        return $this->userExperienceLinkId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return UserExperienceLink
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
     * Set timePeriod
     *
     * @param \BMG\BookToolBundle\Entity\TimePeriod $timePeriod
     * @return UserExperienceLink
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
     * Set experience
     *
     * @param \BMG\BookToolBundle\Entity\Experience $experience
     * @return UserExperienceLink
     */
    public function setExperience(\BMG\BookToolBundle\Entity\Experience $experience = null)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return \BMG\BookToolBundle\Entity\Experience 
     */
    public function getExperience()
    {
        return $this->experience;
    }
}
