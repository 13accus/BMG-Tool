<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clearance
 *
 * @ORM\Table(name="clearance", indexes={@ORM\Index(name="fk_clearance_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class Clearance
{
    /**
     * @var string
     *
     * @ORM\Column(name="clearance_desc", type="string", length=500, nullable=true)
     */
    private $clearanceDesc;

    /**
     * @var integer
     *
     * @ORM\Column(name="clearance_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clearanceId;

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
     * Set clearanceDesc
     *
     * @param string $clearanceDesc
     * @return Clearance
     */
    public function setClearanceDesc($clearanceDesc)
    {
        $this->clearanceDesc = $clearanceDesc;

        return $this;
    }

    /**
     * Get clearanceDesc
     *
     * @return string 
     */
    public function getClearanceDesc()
    {
        return $this->clearanceDesc;
    }

    /**
     * Get clearanceId
     *
     * @return integer 
     */
    public function getClearanceId()
    {
        return $this->clearanceId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return Clearance
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
    	 
    	return $this->getClearanceDesc;
    }
}
