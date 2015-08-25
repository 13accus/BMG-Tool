<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientVendorType
 *
 * @ORM\Table(name="client_vendor_type", indexes={@ORM\Index(name="fk_client_vendor_type_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class ClientVendorType
{
    /**
     * @var string
     *
     * @ORM\Column(name="client_vendor_type_name", type="string", length=45, nullable=false)
     */
    private $clientVendorTypeName;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_vendor_type_id", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clientVendorTypeId;

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
     * Set clientVendorTypeName
     *
     * @param string $clientVendorTypeName
     * @return ClientVendorType
     */
    public function setClientVendorTypeName($clientVendorTypeName)
    {
        $this->clientVendorTypeName = $clientVendorTypeName;

        return $this;
    }

    /**
     * Get clientVendorTypeName
     *
     * @return string 
     */
    public function getClientVendorTypeName()
    {
        return $this->clientVendorTypeName;
    }

    /**
     * Get clientVendorTypeId
     *
     * @return integer 
     */
    public function getClientVendorTypeId()
    {
        return $this->clientVendorTypeId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return ClientVendorType
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
    
    	return $this->getClientVendorTypeName();
    }
}
