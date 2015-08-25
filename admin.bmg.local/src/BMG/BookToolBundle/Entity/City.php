<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city", indexes={@ORM\Index(name="fk_city_state1_idx", columns={"state_id"})})
 * @ORM\Entity
 */
class City
{
    /**
     * @var string
     *
     * @ORM\Column(name="city_name", type="string", length=45, nullable=false)
     */
    private $cityName;

    /**
     * @var string
     *
     * @ORM\Column(name="city_zipcode", type="string", length=10, nullable=false)
     */
    private $cityZipcode;

    /**
     * @var float
     *
     * @ORM\Column(name="city_latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $cityLatitude;

    /**
     * @var float
     *
     * @ORM\Column(name="city_longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $cityLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="city_county", type="string", length=50, nullable=false)
     */
    private $cityCounty;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cityId;

    /**
     * @var \BMG\BookToolBundle\Entity\State
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\State")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="state_id", referencedColumnName="state_id")
     * })
     */
    private $state;



    /**
     * Set cityName
     *
     * @param string $cityName
     * @return City
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;

        return $this;
    }

    /**
     * Get cityName
     *
     * @return string 
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set cityZipcode
     *
     * @param string $cityZipcode
     * @return City
     */
    public function setCityZipcode($cityZipcode)
    {
        $this->cityZipcode = $cityZipcode;

        return $this;
    }

    /**
     * Get cityZipcode
     *
     * @return string 
     */
    public function getCityZipcode()
    {
        return $this->cityZipcode;
    }

    /**
     * Set cityLatitude
     *
     * @param float $cityLatitude
     * @return City
     */
    public function setCityLatitude($cityLatitude)
    {
        $this->cityLatitude = $cityLatitude;

        return $this;
    }

    /**
     * Get cityLatitude
     *
     * @return float 
     */
    public function getCityLatitude()
    {
        return $this->cityLatitude;
    }

    /**
     * Set cityLongitude
     *
     * @param float $cityLongitude
     * @return City
     */
    public function setCityLongitude($cityLongitude)
    {
        $this->cityLongitude = $cityLongitude;

        return $this;
    }

    /**
     * Get cityLongitude
     *
     * @return float 
     */
    public function getCityLongitude()
    {
        return $this->cityLongitude;
    }

    /**
     * Set cityCounty
     *
     * @param string $cityCounty
     * @return City
     */
    public function setCityCounty($cityCounty)
    {
        $this->cityCounty = $cityCounty;

        return $this;
    }

    /**
     * Get cityCounty
     *
     * @return string 
     */
    public function getCityCounty()
    {
        return $this->cityCounty;
    }

    /**
     * Get cityId
     *
     * @return integer 
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set state
     *
     * @param \BMG\BookToolBundle\Entity\State $state
     * @return City
     */
    public function setState(\BMG\BookToolBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \BMG\BookToolBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }
    
    public function __toString()
    {
    	return $this->getCityName();
    }
}
