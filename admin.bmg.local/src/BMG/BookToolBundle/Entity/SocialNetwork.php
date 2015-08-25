<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialNetwork
 *
 * @ORM\Table(name="social_network", indexes={@ORM\Index(name="fk_social_network_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class SocialNetwork
{
    /**
     * @var string
     *
     * @ORM\Column(name="social_network_name", type="string", length=45, nullable=true)
     */
    private $socialNetworkName;

    /**
     * @var integer
     *
     * @ORM\Column(name="social_network_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $socialNetworkId;

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
     * Set socialNetworkName
     *
     * @param string $socialNetworkName
     * @return SocialNetwork
     */
    public function setSocialNetworkName($socialNetworkName)
    {
        $this->socialNetworkName = $socialNetworkName;

        return $this;
    }

    /**
     * Get socialNetworkName
     *
     * @return string 
     */
    public function getSocialNetworkName()
    {
        return $this->socialNetworkName;
    }

    /**
     * Get socialNetworkId
     *
     * @return integer 
     */
    public function getSocialNetworkId()
    {
        return $this->socialNetworkId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return SocialNetwork
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
    	return $this->getSocialNetworkName();
    }
}
