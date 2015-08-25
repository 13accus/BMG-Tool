<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectUpload
 *
 * @ORM\Table(name="project_upload", indexes={@ORM\Index(name="fk_project_upload_project1_idx", columns={"project_id"}), @ORM\Index(name="fk_project_upload_project_crew1_idx", columns={"project_crew_id"})})
 * @ORM\Entity
 */
class ProjectUpload
{
    /**
     * @var string
     *
     * @ORM\Column(name="project_upload_name", type="string", length=45, nullable=false)
     */
    private $projectUploadName;

    /**
     * @var string
     *
     * @ORM\Column(name="project_upload_description", type="string", length=2000, nullable=true)
     */
    private $projectUploadDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="project_upload_file_path", type="string", length=200, nullable=false)
     */
    private $projectUploadFilePath;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_upload_datetime", type="datetime", nullable=false)
     */
    private $projectUploadDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_upload_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $projectUploadId;

    /**
     * @var \BMG\BookToolBundle\Entity\ProjectCrew
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\ProjectCrew")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_crew_id", referencedColumnName="project_crew_id")
     * })
     */
    private $projectCrew;

    /**
     * @var \BMG\BookToolBundle\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Project")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id", referencedColumnName="project_id")
     * })
     */
    private $project;



    /**
     * Set projectUploadName
     *
     * @param string $projectUploadName
     * @return ProjectUpload
     */
    public function setProjectUploadName($projectUploadName)
    {
        $this->projectUploadName = $projectUploadName;

        return $this;
    }

    /**
     * Get projectUploadName
     *
     * @return string 
     */
    public function getProjectUploadName()
    {
        return $this->projectUploadName;
    }

    /**
     * Set projectUploadDescription
     *
     * @param string $projectUploadDescription
     * @return ProjectUpload
     */
    public function setProjectUploadDescription($projectUploadDescription)
    {
        $this->projectUploadDescription = $projectUploadDescription;

        return $this;
    }

    /**
     * Get projectUploadDescription
     *
     * @return string 
     */
    public function getProjectUploadDescription()
    {
        return $this->projectUploadDescription;
    }

    /**
     * Set projectUploadFilePath
     *
     * @param string $projectUploadFilePath
     * @return ProjectUpload
     */
    public function setProjectUploadFilePath($projectUploadFilePath)
    {
        $this->projectUploadFilePath = $projectUploadFilePath;

        return $this;
    }

    /**
     * Get projectUploadFilePath
     *
     * @return string 
     */
    public function getProjectUploadFilePath()
    {
        return $this->projectUploadFilePath;
    }

    /**
     * Set projectUploadDatetime
     *
     * @param \DateTime $projectUploadDatetime
     * @return ProjectUpload
     */
    public function setProjectUploadDatetime($projectUploadDatetime)
    {
        $this->projectUploadDatetime = $projectUploadDatetime;

        return $this;
    }

    /**
     * Get projectUploadDatetime
     *
     * @return \DateTime 
     */
    public function getProjectUploadDatetime()
    {
        return $this->projectUploadDatetime;
    }

    /**
     * Get projectUploadId
     *
     * @return integer 
     */
    public function getProjectUploadId()
    {
        return $this->projectUploadId;
    }

    /**
     * Set projectCrew
     *
     * @param \BMG\BookToolBundle\Entity\ProjectCrew $projectCrew
     * @return ProjectUpload
     */
    public function setProjectCrew(\BMG\BookToolBundle\Entity\ProjectCrew $projectCrew = null)
    {
        $this->projectCrew = $projectCrew;

        return $this;
    }

    /**
     * Get projectCrew
     *
     * @return \BMG\BookToolBundle\Entity\ProjectCrew 
     */
    public function getProjectCrew()
    {
        return $this->projectCrew;
    }

    /**
     * Set project
     *
     * @param \BMG\BookToolBundle\Entity\Project $project
     * @return ProjectUpload
     */
    public function setProject(\BMG\BookToolBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \BMG\BookToolBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }
    
    public function __toString() {
    	return $this;
    }
}
