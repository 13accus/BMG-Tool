<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExperienceJob
 *
 * @ORM\Table(name="experience_job", indexes={@ORM\Index(name="fk_experience_job_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class ExperienceJob
{
    /**
     * @var string
     *
     * @ORM\Column(name="experience_job_name", type="string", length=45, nullable=true)
     */
    private $experienceJobName;

    /**
     * @var integer
     *
     * @ORM\Column(name="experience_job_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $experienceJobId;

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
     * Set experienceJobName
     *
     * @param string $experienceJobName
     * @return ExperienceJob
     */
    public function setExperienceJobName($experienceJobName)
    {
        $this->experienceJobName = $experienceJobName;

        return $this;
    }

    /**
     * Get experienceJobName
     *
     * @return string 
     */
    public function getExperienceJobName()
    {
        return $this->experienceJobName;
    }

    /**
     * Get experienceJobId
     *
     * @return integer 
     */
    public function getExperienceJobId()
    {
        return $this->experienceJobId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return ExperienceJob
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
    
    public function __toString() {
    	return $this->getExperienceJobName();
    }
}
