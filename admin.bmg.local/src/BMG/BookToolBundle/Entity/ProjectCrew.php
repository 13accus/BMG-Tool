<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectCrew
 *
 * @ORM\Table(name="project_crew", indexes={@ORM\Index(name="fk_project_crew_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_project_crew_role1_idx", columns={"project_role_id"})})
 * @ORM\Entity
 */
class ProjectCrew
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="project_crew_rating", type="boolean", nullable=true)
     */
    private $projectCrewRating;

    /**
     * @var string
     *
     * @ORM\Column(name="project_crew_rating_reason", type="string", length=2000, nullable=true)
     */
    private $projectCrewRatingReason;

    /**
     * @var string
     *
     * @ORM\Column(name="project_crew_contract_password", type="string", length=45, nullable=true)
     */
    private $projectCrewContractPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_crew_datetime", type="datetime", nullable=false)
     */
    private $projectCrewDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_crew_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $projectCrewId;

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
     * @var \BMG\BookToolBundle\Entity\ProjectRole
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\ProjectRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_role_id", referencedColumnName="role_id")
     * })
     */
    private $projectRole;



    /**
     * Set projectCrewRating
     *
     * @param boolean $projectCrewRating
     * @return ProjectCrew
     */
    public function setProjectCrewRating($projectCrewRating)
    {
        $this->projectCrewRating = $projectCrewRating;

        return $this;
    }

    /**
     * Get projectCrewRating
     *
     * @return boolean 
     */
    public function getProjectCrewRating()
    {
        return $this->projectCrewRating;
    }

    /**
     * Set projectCrewRatingReason
     *
     * @param string $projectCrewRatingReason
     * @return ProjectCrew
     */
    public function setProjectCrewRatingReason($projectCrewRatingReason)
    {
        $this->projectCrewRatingReason = $projectCrewRatingReason;

        return $this;
    }

    /**
     * Get projectCrewRatingReason
     *
     * @return string 
     */
    public function getProjectCrewRatingReason()
    {
        return $this->projectCrewRatingReason;
    }

    /**
     * Set projectCrewContractPassword
     *
     * @param string $projectCrewContractPassword
     * @return ProjectCrew
     */
    public function setProjectCrewContractPassword($projectCrewContractPassword)
    {
        $this->projectCrewContractPassword = $projectCrewContractPassword;

        return $this;
    }

    /**
     * Get projectCrewContractPassword
     *
     * @return string 
     */
    public function getProjectCrewContractPassword()
    {
        return $this->projectCrewContractPassword;
    }

    /**
     * Set projectCrewDatetime
     *
     * @param \DateTime $projectCrewDatetime
     * @return ProjectCrew
     */
    public function setProjectCrewDatetime($projectCrewDatetime)
    {
        $this->projectCrewDatetime = $projectCrewDatetime;

        return $this;
    }

    /**
     * Get projectCrewDatetime
     *
     * @return \DateTime 
     */
    public function getProjectCrewDatetime()
    {
        return $this->projectCrewDatetime;
    }

    /**
     * Get projectCrewId
     *
     * @return integer 
     */
    public function getProjectCrewId()
    {
        return $this->projectCrewId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return ProjectCrew
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
     * Set projectRole
     *
     * @param \BMG\BookToolBundle\Entity\ProjectRole $projectRole
     * @return ProjectCrew
     */
    public function setProjectRole(\BMG\BookToolBundle\Entity\ProjectRole $projectRole = null)
    {
        $this->projectRole = $projectRole;

        return $this;
    }

    /**
     * Get projectRole
     *
     * @return \BMG\BookToolBundle\Entity\ProjectRole 
     */
    public function getProjectRole()
    {
        return $this->projectRole;
    }
    
    public function __toString() {
    	return $this->getUserId();
    }
}
