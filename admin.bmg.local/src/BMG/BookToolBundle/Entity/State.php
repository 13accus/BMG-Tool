<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * State
 *
 * @ORM\Table(name="state", indexes={@ORM\Index(name="fk_state_country1_idx", columns={"country_id"})})
 * @ORM\Entity
 */
class State
{
    /**
     * @var string
     *
     * @ORM\Column(name="state_code", type="string", length=2, nullable=false)
     */
    private $stateCode;

    /**
     * @var string
     *
     * @ORM\Column(name="state_name", type="string", length=45, nullable=false)
     */
    private $stateName;

    /**
     * @var integer
     *
     * @ORM\Column(name="state_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $stateId;

    /**
     * @var \BMG\BookToolBundle\Entity\Country
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     * })
     */
    private $country;



    /**
     * Set stateCode
     *
     * @param string $stateCode
     * @return State
     */
    public function setStateCode($stateCode)
    {
        $this->stateCode = $stateCode;

        return $this;
    }

    /**
     * Get stateCode
     *
     * @return string 
     */
    public function getStateCode()
    {
        return $this->stateCode;
    }

    /**
     * Set stateName
     *
     * @param string $stateName
     * @return State
     */
    public function setStateName($stateName)
    {
        $this->stateName = $stateName;

        return $this;
    }

    /**
     * Get stateName
     *
     * @return string 
     */
    public function getStateName()
    {
        return $this->stateName;
    }

    /**
     * Get stateId
     *
     * @return integer 
     */
    public function getStateId()
    {
        return $this->stateId;
    }

    /**
     * Set country
     *
     * @param \BMG\BookToolBundle\Entity\Country $country
     * @return State
     */
    public function setCountry(\BMG\BookToolBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \BMG\BookToolBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    public function __toString() {
    	return $this->getStateName();
    }
}
