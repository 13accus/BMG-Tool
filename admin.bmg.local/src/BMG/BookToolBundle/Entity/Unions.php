<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unions
 *
 * @ORM\Table(name="unions", indexes={@ORM\Index(name="fk_union_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class Unions
{
    /**
     * @var string
     *
     * @ORM\Column(name="union_name", type="string", length=45, nullable=false)
     */
    private $unionName;

    /**
     * @var integer
     *
     * @ORM\Column(name="union_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $unionId;

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
     * Set unionName
     *
     * @param string $unionName
     * @return Unions
     */
    public function setUnionName($unionName)
    {
        $this->unionName = $unionName;

        return $this;
    }

    /**
     * Get unionName
     *
     * @return string 
     */
    public function getUnionName()
    {
        return $this->unionName;
    }

    /**
     * Get unionId
     *
     * @return integer 
     */
    public function getUnionId()
    {
        return $this->unionId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return Unions
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
}
