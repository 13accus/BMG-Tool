<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserExperienceJobLink
 *
 * @ORM\Table(name="user_experience_job_link", indexes={@ORM\Index(name="fk_user_experience_job_link_experience_job1_idx", columns={"experience_job_id"}), @ORM\Index(name="fk_user_experience_job_link_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class UserExperienceJobLink
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_experience_job_link_datetime", type="datetime", nullable=false)
     */
    private $userExperienceJobLinkDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_experience_job_link_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userExperienceJobLinkId;

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
     * @var \BMG\BookToolBundle\Entity\ExperienceJob
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\ExperienceJob")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="experience_job_id", referencedColumnName="experience_job_id")
     * })
     */
    private $experienceJob;



    /**
     * Set userExperienceJobLinkDatetime
     *
     * @param \DateTime $userExperienceJobLinkDatetime
     * @return UserExperienceJobLink
     */
    public function setUserExperienceJobLinkDatetime($userExperienceJobLinkDatetime)
    {
        $this->userExperienceJobLinkDatetime = $userExperienceJobLinkDatetime;

        return $this;
    }

    /**
     * Get userExperienceJobLinkDatetime
     *
     * @return \DateTime 
     */
    public function getUserExperienceJobLinkDatetime()
    {
        return $this->userExperienceJobLinkDatetime;
    }

    /**
     * Get userExperienceJobLinkId
     *
     * @return integer 
     */
    public function getUserExperienceJobLinkId()
    {
        return $this->userExperienceJobLinkId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return UserExperienceJobLink
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
     * Set experienceJob
     *
     * @param \BMG\BookToolBundle\Entity\ExperienceJob $experienceJob
     * @return UserExperienceJobLink
     */
    public function setExperienceJob(\BMG\BookToolBundle\Entity\ExperienceJob $experienceJob = null)
    {
        $this->experienceJob = $experienceJob;

        return $this;
    }

    /**
     * Get experienceJob
     *
     * @return \BMG\BookToolBundle\Entity\ExperienceJob 
     */
    public function getExperienceJob()
    {
        return $this->experienceJob;
    }
}
