<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table(name="experience", indexes={@ORM\Index(name="fk_experience_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class Experience
{
    /**
     * @var string
     *
     * @ORM\Column(name="experience_name", type="string", length=45, nullable=false)
     */
    private $experienceName;

    /**
     * @var integer
     *
     * @ORM\Column(name="experience_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $experienceId;

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
     * Set experienceName
     *
     * @param string $experienceName
     * @return Experience
     */
    public function setExperienceName($experienceName)
    {
        $this->experienceName = $experienceName;

        return $this;
    }

    /**
     * Get experienceName
     *
     * @return string 
     */
    public function getExperienceName()
    {
        return $this->experienceName;
    }

    /**
     * Get experienceId
     *
     * @return integer 
     */
    public function getExperienceId()
    {
        return $this->experienceId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return Experience
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
    	return $this->getExperienceName();
    }
}
