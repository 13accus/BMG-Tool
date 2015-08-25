<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project", indexes={@ORM\Index(name="fk_project_city1_idx", columns={"city_id"}), @ORM\Index(name="fk_project_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class Project
{
    /**
     * @var string
     *
     * @ORM\Column(name="project_name", type="string", length=245, nullable=false)
     */
    private $projectName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_datetime_start", type="datetime", nullable=false)
     */
    private $projectDatetimeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_datetime_end", type="datetime", nullable=true)
     */
    private $projectDatetimeEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_air_datetime_start", type="datetime", nullable=true)
     */
    private $projectAirDatetimeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_air_datetime_end", type="datetime", nullable=true)
     */
    private $projectAirDatetimeEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_setup_staging_datetime_start", type="datetime", nullable=true)
     */
    private $projectSetupStagingDatetimeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_setup_staging_datetime_end", type="datetime", nullable=true)
     */
    private $projectSetupStagingDatetimeEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_setup_datetime_start", type="datetime", nullable=true)
     */
    private $projectSetupDatetimeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_setup_datetime_end", type="datetime", nullable=true)
     */
    private $projectSetupDatetimeEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_shoot_datetime_start", type="datetime", nullable=true)
     */
    private $projectShootDatetimeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_shoot_datetime_end", type="datetime", nullable=true)
     */
    private $projectShootDatetimeEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_load_out_datetime_start", type="datetime", nullable=true)
     */
    private $projectLoadOutDatetimeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_load_out_datetime_end", type="datetime", nullable=true)
     */
    private $projectLoadOutDatetimeEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="project_location", type="string", length=45, nullable=true)
     */
    private $projectLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="project_address1", type="string", length=45, nullable=true)
     */
    private $projectAddress1;

    /**
     * @var string
     *
     * @ORM\Column(name="project_address2", type="string", length=45, nullable=true)
     */
    private $projectAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="project_zipcode", type="string", length=5, nullable=true)
     */
    private $projectZipcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $projectId;

    /**
     * @var \BMG\BookToolBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

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
     * Set projectName
     *
     * @param string $projectName
     * @return Project
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string 
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set projectDatetimeStart
     *
     * @param \DateTime $projectDatetimeStart
     * @return Project
     */
    public function setProjectDatetimeStart($projectDatetimeStart)
    {
        $this->projectDatetimeStart = $projectDatetimeStart;

        return $this;
    }

    /**
     * Get projectDatetimeStart
     *
     * @return \DateTime 
     */
    public function getProjectDatetimeStart()
    {
        return $this->projectDatetimeStart;
    }

    /**
     * Set projectDatetimeEnd
     *
     * @param \DateTime $projectDatetimeEnd
     * @return Project
     */
    public function setProjectDatetimeEnd($projectDatetimeEnd)
    {
        $this->projectDatetimeEnd = $projectDatetimeEnd;

        return $this;
    }

    /**
     * Get projectDatetimeEnd
     *
     * @return \DateTime 
     */
    public function getProjectDatetimeEnd()
    {
        return $this->projectDatetimeEnd;
    }

    /**
     * Set projectAirDatetimeStart
     *
     * @param \DateTime $projectAirDatetimeStart
     * @return Project
     */
    public function setProjectAirDatetimeStart($projectAirDatetimeStart)
    {
        $this->projectAirDatetimeStart = $projectAirDatetimeStart;

        return $this;
    }

    /**
     * Get projectAirDatetimeStart
     *
     * @return \DateTime 
     */
    public function getProjectAirDatetimeStart()
    {
        return $this->projectAirDatetimeStart;
    }

    /**
     * Set projectAirDatetimeEnd
     *
     * @param \DateTime $projectAirDatetimeEnd
     * @return Project
     */
    public function setProjectAirDatetimeEnd($projectAirDatetimeEnd)
    {
        $this->projectAirDatetimeEnd = $projectAirDatetimeEnd;

        return $this;
    }

    /**
     * Get projectAirDatetimeEnd
     *
     * @return \DateTime 
     */
    public function getProjectAirDatetimeEnd()
    {
        return $this->projectAirDatetimeEnd;
    }

    /**
     * Set projectSetupStagingDatetimeStart
     *
     * @param \DateTime $projectSetupStagingDatetimeStart
     * @return Project
     */
    public function setProjectSetupStagingDatetimeStart($projectSetupStagingDatetimeStart)
    {
        $this->projectSetupStagingDatetimeStart = $projectSetupStagingDatetimeStart;

        return $this;
    }

    /**
     * Get projectSetupStagingDatetimeStart
     *
     * @return \DateTime 
     */
    public function getProjectSetupStagingDatetimeStart()
    {
        return $this->projectSetupStagingDatetimeStart;
    }

    /**
     * Set projectSetupStagingDatetimeEnd
     *
     * @param \DateTime $projectSetupStagingDatetimeEnd
     * @return Project
     */
    public function setProjectSetupStagingDatetimeEnd($projectSetupStagingDatetimeEnd)
    {
        $this->projectSetupStagingDatetimeEnd = $projectSetupStagingDatetimeEnd;

        return $this;
    }

    /**
     * Get projectSetupStagingDatetimeEnd
     *
     * @return \DateTime 
     */
    public function getProjectSetupStagingDatetimeEnd()
    {
        return $this->projectSetupStagingDatetimeEnd;
    }

    /**
     * Set projectSetupDatetimeStart
     *
     * @param \DateTime $projectSetupDatetimeStart
     * @return Project
     */
    public function setProjectSetupDatetimeStart($projectSetupDatetimeStart)
    {
        $this->projectSetupDatetimeStart = $projectSetupDatetimeStart;

        return $this;
    }

    /**
     * Get projectSetupDatetimeStart
     *
     * @return \DateTime 
     */
    public function getProjectSetupDatetimeStart()
    {
        return $this->projectSetupDatetimeStart;
    }

    /**
     * Set projectSetupDatetimeEnd
     *
     * @param \DateTime $projectSetupDatetimeEnd
     * @return Project
     */
    public function setProjectSetupDatetimeEnd($projectSetupDatetimeEnd)
    {
        $this->projectSetupDatetimeEnd = $projectSetupDatetimeEnd;

        return $this;
    }

    /**
     * Get projectSetupDatetimeEnd
     *
     * @return \DateTime 
     */
    public function getProjectSetupDatetimeEnd()
    {
        return $this->projectSetupDatetimeEnd;
    }

    /**
     * Set projectShootDatetimeStart
     *
     * @param \DateTime $projectShootDatetimeStart
     * @return Project
     */
    public function setProjectShootDatetimeStart($projectShootDatetimeStart)
    {
        $this->projectShootDatetimeStart = $projectShootDatetimeStart;

        return $this;
    }

    /**
     * Get projectShootDatetimeStart
     *
     * @return \DateTime 
     */
    public function getProjectShootDatetimeStart()
    {
        return $this->projectShootDatetimeStart;
    }

    /**
     * Set projectShootDatetimeEnd
     *
     * @param \DateTime $projectShootDatetimeEnd
     * @return Project
     */
    public function setProjectShootDatetimeEnd($projectShootDatetimeEnd)
    {
        $this->projectShootDatetimeEnd = $projectShootDatetimeEnd;

        return $this;
    }

    /**
     * Get projectShootDatetimeEnd
     *
     * @return \DateTime 
     */
    public function getProjectShootDatetimeEnd()
    {
        return $this->projectShootDatetimeEnd;
    }

    /**
     * Set projectLoadOutDatetimeStart
     *
     * @param \DateTime $projectLoadOutDatetimeStart
     * @return Project
     */
    public function setProjectLoadOutDatetimeStart($projectLoadOutDatetimeStart)
    {
        $this->projectLoadOutDatetimeStart = $projectLoadOutDatetimeStart;

        return $this;
    }

    /**
     * Get projectLoadOutDatetimeStart
     *
     * @return \DateTime 
     */
    public function getProjectLoadOutDatetimeStart()
    {
        return $this->projectLoadOutDatetimeStart;
    }

    /**
     * Set projectLoadOutDatetimeEnd
     *
     * @param \DateTime $projectLoadOutDatetimeEnd
     * @return Project
     */
    public function setProjectLoadOutDatetimeEnd($projectLoadOutDatetimeEnd)
    {
        $this->projectLoadOutDatetimeEnd = $projectLoadOutDatetimeEnd;

        return $this;
    }

    /**
     * Get projectLoadOutDatetimeEnd
     *
     * @return \DateTime 
     */
    public function getProjectLoadOutDatetimeEnd()
    {
        return $this->projectLoadOutDatetimeEnd;
    }

    /**
     * Set projectLocation
     *
     * @param string $projectLocation
     * @return Project
     */
    public function setProjectLocation($projectLocation)
    {
        $this->projectLocation = $projectLocation;

        return $this;
    }

    /**
     * Get projectLocation
     *
     * @return string 
     */
    public function getProjectLocation()
    {
        return $this->projectLocation;
    }

    /**
     * Set projectAddress1
     *
     * @param string $projectAddress1
     * @return Project
     */
    public function setProjectAddress1($projectAddress1)
    {
        $this->projectAddress1 = $projectAddress1;

        return $this;
    }

    /**
     * Get projectAddress1
     *
     * @return string 
     */
    public function getProjectAddress1()
    {
        return $this->projectAddress1;
    }

    /**
     * Set projectAddress2
     *
     * @param string $projectAddress2
     * @return Project
     */
    public function setProjectAddress2($projectAddress2)
    {
        $this->projectAddress2 = $projectAddress2;

        return $this;
    }

    /**
     * Get projectAddress2
     *
     * @return string 
     */
    public function getProjectAddress2()
    {
        return $this->projectAddress2;
    }

    /**
     * Set projectZipcode
     *
     * @param string $projectZipcode
     * @return Project
     */
    public function setProjectZipcode($projectZipcode)
    {
        $this->projectZipcode = $projectZipcode;

        return $this;
    }

    /**
     * Get projectZipcode
     *
     * @return string 
     */
    public function getProjectZipcode()
    {
        return $this->projectZipcode;
    }

    /**
     * Get projectId
     *
     * @return integer 
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return Project
     */
    public function setStatus(\BMG\BookToolBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \BMG\BookToolBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set city
     *
     * @param \BMG\BookToolBundle\Entity\City $city
     * @return Project
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
    
    public function __toString() {
    	return $this->getProjectName();
    }
}
