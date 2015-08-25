<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VendorSocialNetwork
 *
 * @ORM\Table(name="vendor_social_network", indexes={@ORM\Index(name="fk_vendor_social_network_vendor1_idx", columns={"vendor_id"}), @ORM\Index(name="fk_vendor_social_network_social_network1_idx", columns={"social_network_id"})})
 * @ORM\Entity
 */
class VendorSocialNetwork
{
    /**
     * @var string
     *
     * @ORM\Column(name="vendor_social_network_account", type="string", length=45, nullable=true)
     */
    private $vendorSocialNetworkAccount;

    /**
     * @var integer
     *
     * @ORM\Column(name="vendor_social_network_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vendorSocialNetworkId;

    /**
     * @var \BMG\BookToolBundle\Entity\ClientVendor
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\ClientVendor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vendor_id", referencedColumnName="client_vendor_id")
     * })
     */
    private $vendor;

    /**
     * @var \BMG\BookToolBundle\Entity\SocialNetwork
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\SocialNetwork")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="social_network_id", referencedColumnName="social_network_id")
     * })
     */
    private $socialNetwork;



    /**
     * Set vendorSocialNetworkAccount
     *
     * @param string $vendorSocialNetworkAccount
     * @return VendorSocialNetwork
     */
    public function setVendorSocialNetworkAccount($vendorSocialNetworkAccount)
    {
        $this->vendorSocialNetworkAccount = $vendorSocialNetworkAccount;

        return $this;
    }

    /**
     * Get vendorSocialNetworkAccount
     *
     * @return string 
     */
    public function getVendorSocialNetworkAccount()
    {
        return $this->vendorSocialNetworkAccount;
    }

    /**
     * Get vendorSocialNetworkId
     *
     * @return integer 
     */
    public function getVendorSocialNetworkId()
    {
        return $this->vendorSocialNetworkId;
    }

    /**
     * Set vendor
     *
     * @param \BMG\BookToolBundle\Entity\ClientVendor $vendor
     * @return VendorSocialNetwork
     */
    public function setVendor(\BMG\BookToolBundle\Entity\ClientVendor $vendor = null)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return \BMG\BookToolBundle\Entity\ClientVendor 
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set socialNetwork
     *
     * @param \BMG\BookToolBundle\Entity\SocialNetwork $socialNetwork
     * @return VendorSocialNetwork
     */
    public function setSocialNetwork(\BMG\BookToolBundle\Entity\SocialNetwork $socialNetwork = null)
    {
        $this->socialNetwork = $socialNetwork;

        return $this;
    }

    /**
     * Get socialNetwork
     *
     * @return \BMG\BookToolBundle\Entity\SocialNetwork 
     */
    public function getSocialNetwork()
    {
        return $this->socialNetwork;
    }
}
