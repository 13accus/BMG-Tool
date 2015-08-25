<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactSocialNetworkLink
 *
 * @ORM\Table(name="contact_social_network_link", indexes={@ORM\Index(name="fk_contact_social_network_link_contact1_idx", columns={"contact_id"}), @ORM\Index(name="fk_contact_social_network_link_social_network1_idx", columns={"social_network_id"})})
 * @ORM\Entity
 */
class ContactSocialNetworkLink
{
    /**
     * @var string
     *
     * @ORM\Column(name="contact_social_network_link_account", type="string", length=45, nullable=false)
     */
    private $contactSocialNetworkLinkAccount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="contact_social_network_link_datetime", type="datetime", nullable=false)
     */
    private $contactSocialNetworkLinkDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="contact_social_network_link_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $contactSocialNetworkLinkId;

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
     * @var \BMG\BookToolBundle\Entity\Contact
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Contact")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contact_id", referencedColumnName="contact_id")
     * })
     */
    private $contact;



    /**
     * Set contactSocialNetworkLinkAccount
     *
     * @param string $contactSocialNetworkLinkAccount
     * @return ContactSocialNetworkLink
     */
    public function setContactSocialNetworkLinkAccount($contactSocialNetworkLinkAccount)
    {
        $this->contactSocialNetworkLinkAccount = $contactSocialNetworkLinkAccount;

        return $this;
    }

    /**
     * Get contactSocialNetworkLinkAccount
     *
     * @return string 
     */
    public function getContactSocialNetworkLinkAccount()
    {
        return $this->contactSocialNetworkLinkAccount;
    }

    /**
     * Set contactSocialNetworkLinkDatetime
     *
     * @param \DateTime $contactSocialNetworkLinkDatetime
     * @return ContactSocialNetworkLink
     */
    public function setContactSocialNetworkLinkDatetime($contactSocialNetworkLinkDatetime)
    {
        $this->contactSocialNetworkLinkDatetime = $contactSocialNetworkLinkDatetime;

        return $this;
    }

    /**
     * Get contactSocialNetworkLinkDatetime
     *
     * @return \DateTime 
     */
    public function getContactSocialNetworkLinkDatetime()
    {
        return $this->contactSocialNetworkLinkDatetime;
    }

    /**
     * Get contactSocialNetworkLinkId
     *
     * @return integer 
     */
    public function getContactSocialNetworkLinkId()
    {
        return $this->contactSocialNetworkLinkId;
    }

    /**
     * Set socialNetwork
     *
     * @param \BMG\BookToolBundle\Entity\SocialNetwork $socialNetwork
     * @return ContactSocialNetworkLink
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

    /**
     * Set contact
     *
     * @param \BMG\BookToolBundle\Entity\Contact $contact
     * @return ContactSocialNetworkLink
     */
    public function setContact(\BMG\BookToolBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \BMG\BookToolBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }
    
    public function __toString() {
    	return $this;
    }
}
