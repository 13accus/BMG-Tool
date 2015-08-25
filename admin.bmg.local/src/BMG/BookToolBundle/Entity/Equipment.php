<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipment
 *
 * @ORM\Table(name="equipment", indexes={@ORM\Index(name="fk_equipment_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class Equipment
{
    /**
     * @var string
     *
     * @ORM\Column(name="equipment_name", type="string", length=45, nullable=false)
     */
    private $equipmentName;

    /**
     * @var integer
     *
     * @ORM\Column(name="equipment_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $equipmentId;

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
     * Set equipmentName
     *
     * @param string $equipmentName
     * @return Equipment
     */
    public function setEquipmentName($equipmentName)
    {
        $this->equipmentName = $equipmentName;

        return $this;
    }

    /**
     * Get equipmentName
     *
     * @return string 
     */
    public function getEquipmentName()
    {
        return $this->equipmentName;
    }

    /**
     * Get equipmentId
     *
     * @return integer 
     */
    public function getEquipmentId()
    {
        return $this->equipmentId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return Equipment
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
    	return $this->getEquipmentName();
    }
}
