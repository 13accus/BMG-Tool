<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimePeriod
 *
 * @ORM\Table(name="time_period", indexes={@ORM\Index(name="fk_time_period_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class TimePeriod
{
    /**
     * @var string
     *
     * @ORM\Column(name="time_period_name", type="string", length=45, nullable=true)
     */
    private $timePeriodName;

    /**
     * @var integer
     *
     * @ORM\Column(name="time_period_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $timePeriodId;

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
     * Set timePeriodName
     *
     * @param string $timePeriodName
     * @return TimePeriod
     */
    public function setTimePeriodName($timePeriodName)
    {
        $this->timePeriodName = $timePeriodName;

        return $this;
    }

    /**
     * Get timePeriodName
     *
     * @return string 
     */
    public function getTimePeriodName()
    {
        return $this->timePeriodName;
    }

    /**
     * Get timePeriodId
     *
     * @return integer 
     */
    public function getTimePeriodId()
    {
        return $this->timePeriodId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return TimePeriod
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
