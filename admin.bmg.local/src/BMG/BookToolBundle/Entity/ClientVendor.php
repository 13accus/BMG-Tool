<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientVendor
 *
 * @ORM\Table(name="client_vendor", indexes={@ORM\Index(name="fk_vendor_city1_idx", columns={"city_id"}), @ORM\Index(name="fk_client_vendor_client_vendor_type1_idx", columns={"client_vendor_type_id"}), @ORM\Index(name="fk_client_vendor_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class ClientVendor
{
    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_name", type="string", length=45, nullable=false)
     */
    private $clientVendorName;

    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_address1", type="string", length=45, nullable=false)
     */
    private $clientVendorAddress1;

    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_address2", type="string", length=45, nullable=true)
     */
    private $clientVendorAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_zipcode", type="string", length=10, nullable=false)
     */
    private $clientVendorZipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_logo", type="string", length=200, nullable=true)
     */
    private $clientVendorLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_website", type="string", length=200, nullable=true)
     */
    private $clientVendorWebsite;

    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_main_phone", type="string", length=10, nullable=true)
     */
    private $clientVendorMainPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_main_email", type="string", length=200, nullable=true)
     */
    private $clientVendorMainEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_timezone", type="string", length=5, nullable=true)
     */
    private $clientVendorTimezone;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_vendor_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clientVendorId;

    /**
     * @var \BMG\BookToolBundle\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    private $city;

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
     * @var \BMG\BookToolBundle\Entity\ClientVendorType
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\ClientVendorType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_vendor_type_id", referencedColumnName="client_vendor_type_id")
     * })
     */
    private $clientVendorType;



    /**
     * Set clientVendorName
     *
     * @param string $clientVendorName
     * @return ClientVendor
     */
    public function setClientVendorName($clientVendorName)
    {
        $this->clientVendorName = $clientVendorName;

        return $this;
    }

    /**
     * Get clientVendorName
     *
     * @return string 
     */
    public function getClientVendorName()
    {
        return $this->clientVendorName;
    }

    /**
     * Set clientVendorAddress1
     *
     * @param string $clientVendorAddress1
     * @return ClientVendor
     */
    public function setClientVendorAddress1($clientVendorAddress1)
    {
        $this->clientVendorAddress1 = $clientVendorAddress1;

        return $this;
    }

    /**
     * Get clientVendorAddress1
     *
     * @return string 
     */
    public function getClientVendorAddress1()
    {
        return $this->clientVendorAddress1;
    }

    /**
     * Set clientVendorAddress2
     *
     * @param string $clientVendorAddress2
     * @return ClientVendor
     */
    public function setClientVendorAddress2($clientVendorAddress2)
    {
        $this->clientVendorAddress2 = $clientVendorAddress2;

        return $this;
    }

    /**
     * Get clientVendorAddress2
     *
     * @return string 
     */
    public function getClientVendorAddress2()
    {
        return $this->clientVendorAddress2;
    }

    /**
     * Set clientVendorZipcode
     *
     * @param string $clientVendorZipcode
     * @return ClientVendor
     */
    public function setClientVendorZipcode($clientVendorZipcode)
    {
        $this->clientVendorZipcode = $clientVendorZipcode;

        return $this;
    }

    /**
     * Get clientVendorZipcode
     *
     * @return string 
     */
    public function getClientVendorZipcode()
    {
        return $this->clientVendorZipcode;
    }

    /**
     * Set clientVendorLogo
     *
     * @param string $clientVendorLogo
     * @return ClientVendor
     */
    public function setClientVendorLogo($clientVendorLogo)
    {
        $this->clientVendorLogo = $clientVendorLogo;

        return $this;
    }

    /**
     * Get clientVendorLogo
     *
     * @return string 
     */
    public function getClientVendorLogo()
    {
        return $this->clientVendorLogo;
    }

    /**
     * Set clientVendorWebsite
     *
     * @param string $clientVendorWebsite
     * @return ClientVendor
     */
    public function setClientVendorWebsite($clientVendorWebsite)
    {
        $this->clientVendorWebsite = $clientVendorWebsite;

        return $this;
    }

    /**
     * Get clientVendorWebsite
     *
     * @return string 
     */
    public function getClientVendorWebsite()
    {
        return $this->clientVendorWebsite;
    }

    /**
     * Set clientVendorMainPhone
     *
     * @param string $clientVendorMainPhone
     * @return ClientVendor
     */
    public function setClientVendorMainPhone($clientVendorMainPhone)
    {
        $this->clientVendorMainPhone = $clientVendorMainPhone;

        return $this;
    }

    /**
     * Get clientVendorMainPhone
     *
     * @return string 
     */
    public function getClientVendorMainPhone()
    {
        return $this->clientVendorMainPhone;
    }

    /**
     * Set clientVendorMainEmail
     *
     * @param string $clientVendorMainEmail
     * @return ClientVendor
     */
    public function setClientVendorMainEmail($clientVendorMainEmail)
    {
        $this->clientVendorMainEmail = $clientVendorMainEmail;

        return $this;
    }

    /**
     * Get clientVendorMainEmail
     *
     * @return string 
     */
    public function getClientVendorMainEmail()
    {
        return $this->clientVendorMainEmail;
    }

    /**
     * Set clientVendorTimezone
     *
     * @param string $clientVendorTimezone
     * @return ClientVendor
     */
    public function setClientVendorTimezone($clientVendorTimezone)
    {
        $this->clientVendorTimezone = $clientVendorTimezone;

        return $this;
    }

    /**
     * Get clientVendorTimezone
     *
     * @return string 
     */
    public function getClientVendorTimezone()
    {
        return $this->clientVendorTimezone;
    }

    /**
     * Get clientVendorId
     *
     * @return integer 
     */
    public function getClientVendorId()
    {
        return $this->clientVendorId;
    }

    /**
     * Set city
     *
     * @param \BMG\BookToolBundle\Entity\City $city
     * @return ClientVendor
     */
    public function setCity(\BMG\BookToolBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \BMG\BookToolBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return ClientVendor
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

    /**
     * Set clientVendorType
     *
     * @param \BMG\BookToolBundle\Entity\ClientVendorType $clientVendorType
     * @return ClientVendor
     */
    public function setClientVendorType(\BMG\BookToolBundle\Entity\ClientVendorType $clientVendorType = null)
    {
        $this->clientVendorType = $clientVendorType;

        return $this;
    }

    /**
     * Get clientVendorType
     *
     * @return \BMG\BookToolBundle\Entity\ClientVendorType 
     */
    public function getClientVendorType()
    {
        return $this->clientVendorType;
    }
    
    public function __toString() {
    
    	return $this->getClientVendorName();
    }
}
