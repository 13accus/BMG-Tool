<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact", indexes={@ORM\Index(name="fk_contact_client_vendor1_idx", columns={"client_vendor_id"})})
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var string
     *
     * @ORM\Column(name="contact_firstname", type="string", length=45, nullable=true)
     */
    private $contactFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_lastname", type="string", length=45, nullable=true)
     */
    private $contactLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_title", type="string", length=45, nullable=true)
     */
    private $contactTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_email", type="string", length=200, nullable=true)
     */
    private $contactEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_mobile", type="string", length=10, nullable=true)
     */
    private $contactMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_phone", type="string", length=10, nullable=true)
     */
    private $contactPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_photo", type="string", length=200, nullable=true)
     */
    private $contactPhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_note", type="string", length=2000, nullable=true)
     */
    private $contactNote;

    /**
     * @var integer
     *
     * @ORM\Column(name="contact_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $contactId;

    /**
     * @var \BMG\BookToolBundle\Entity\ClientVendor
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\ClientVendor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_vendor_id", referencedColumnName="client_vendor_id")
     * })
     */
    private $clientVendor;



    /**
     * Set contactFirstname
     *
     * @param string $contactFirstname
     * @return Contact
     */
    public function setContactFirstname($contactFirstname)
    {
        $this->contactFirstname = $contactFirstname;

        return $this;
    }

    /**
     * Get contactFirstname
     *
     * @return string 
     */
    public function getContactFirstname()
    {
        return $this->contactFirstname;
    }

    /**
     * Set contactLastname
     *
     * @param string $contactLastname
     * @return Contact
     */
    public function setContactLastname($contactLastname)
    {
        $this->contactLastname = $contactLastname;

        return $this;
    }

    /**
     * Get contactLastname
     *
     * @return string 
     */
    public function getContactLastname()
    {
        return $this->contactLastname;
    }

    /**
     * Set contactTitle
     *
     * @param string $contactTitle
     * @return Contact
     */
    public function setContactTitle($contactTitle)
    {
        $this->contactTitle = $contactTitle;

        return $this;
    }

    /**
     * Get contactTitle
     *
     * @return string 
     */
    public function getContactTitle()
    {
        return $this->contactTitle;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     * @return Contact
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string 
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set contactMobile
     *
     * @param string $contactMobile
     * @return Contact
     */
    public function setContactMobile($contactMobile)
    {
        $this->contactMobile = $contactMobile;

        return $this;
    }

    /**
     * Get contactMobile
     *
     * @return string 
     */
    public function getContactMobile()
    {
        return $this->contactMobile;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     * @return Contact
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string 
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactPhoto
     *
     * @param string $contactPhoto
     * @return Contact
     */
    public function setContactPhoto($contactPhoto)
    {
        $this->contactPhoto = $contactPhoto;

        return $this;
    }

    /**
     * Get contactPhoto
     *
     * @return string 
     */
    public function getContactPhoto()
    {
        return $this->contactPhoto;
    }

    /**
     * Set contactNote
     *
     * @param string $contactNote
     * @return Contact
     */
    public function setContactNote($contactNote)
    {
        $this->contactNote = $contactNote;

        return $this;
    }

    /**
     * Get contactNote
     *
     * @return string 
     */
    public function getContactNote()
    {
        return $this->contactNote;
    }

    /**
     * Get contactId
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Set clientVendor
     *
     * @param \BMG\BookToolBundle\Entity\ClientVendor $clientVendor
     * @return Contact
     */
    public function setClientVendor(\BMG\BookToolBundle\Entity\ClientVendor $clientVendor = null)
    {
        $this->clientVendor = $clientVendor;

        return $this;
    }

    /**
     * Get clientVendor
     *
     * @return \BMG\BookToolBundle\Entity\ClientVendor 
     */
    public function getClientVendor()
    {
        return $this->clientVendor;
    }
}
