<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HearAbout
 *
 * @ORM\Table(name="hear_about", indexes={@ORM\Index(name="fk_hear_about_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class HearAbout
{
    /**
     * @var string
     *
     * @ORM\Column(name="hear_about_name", type="string", length=45, nullable=false)
     */
    private $hearAboutName;

    /**
     * @var integer
     *
     * @ORM\Column(name="hear_about_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $hearAboutId;

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
     * Set hearAboutName
     *
     * @param string $hearAboutName
     * @return HearAbout
     */
    public function setHearAboutName($hearAboutName)
    {
        $this->hearAboutName = $hearAboutName;

        return $this;
    }

    /**
     * Get hearAboutName
     *
     * @return string 
     */
    public function getHearAboutName()
    {
        return $this->hearAboutName;
    }

    /**
     * Get hearAboutId
     *
     * @return integer 
     */
    public function getHearAboutId()
    {
        return $this->hearAboutId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return HearAbout
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
    
    public function __toString()
    {
    	return $this->getHearAboutName();
    }
}
