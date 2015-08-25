<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity
 */
class Status
{
    /**
     * @var string
     *
     * @ORM\Column(name="status_name", type="string", length=45, nullable=false)
     */
    private $statusName;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $statusId;



    /**
     * Set statusName
     *
     * @param string $statusName
     * @return Status
     */
    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;

        return $this;
    }
    
    public function setStatus($statusId)
    {
    	$this->statusId = $statusId;
    
    	return $this;
    }

    /**
     * Get statusName
     *
     * @return string 
     */
    public function getStatusName()
    {
        return $this->statusName;
    }

    /**
     * Get statusId
     *
     * @return integer 
     */
    public function getStatusId()
    {
        return $this->statusId;
    }
    
    public function __toString()
    {
    	return $this->getStatusName();
    }

}
