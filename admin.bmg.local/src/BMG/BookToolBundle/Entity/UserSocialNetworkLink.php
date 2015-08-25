<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSocialNetworkLink
 *
 * @ORM\Table(name="user_social_network_link", indexes={@ORM\Index(name="fk_user_social_network_link_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_user_social_network_link_social_network1_idx", columns={"social_network_id"})})
 * @ORM\Entity
 */
class UserSocialNetworkLink
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_social_network_account", type="string", length=45, nullable=true)
     */
    private $userSocialNetworkAccount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_social_network_link_datetime", type="datetime", nullable=true)
     */
    private $userSocialNetworkLinkDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_social_network_link_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userSocialNetworkLinkId;

    /**
     * @var \BMG\BookToolBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

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
     * Set userSocialNetworkAccount
     *
     * @param string $userSocialNetworkAccount
     * @return UserSocialNetworkLink
     */
    public function setUserSocialNetworkAccount($userSocialNetworkAccount)
    {
        $this->userSocialNetworkAccount = $userSocialNetworkAccount;

        return $this;
    }

    /**
     * Get userSocialNetworkAccount
     *
     * @return string 
     */
    public function getUserSocialNetworkAccount()
    {
        return $this->userSocialNetworkAccount;
    }

    /**
     * Set userSocialNetworkLinkDatetime
     *
     * @param \DateTime $userSocialNetworkLinkDatetime
     * @return UserSocialNetworkLink
     */
    public function setUserSocialNetworkLinkDatetime($userSocialNetworkLinkDatetime)
    {
        $this->userSocialNetworkLinkDatetime = $userSocialNetworkLinkDatetime;

        return $this;
    }

    /**
     * Get userSocialNetworkLinkDatetime
     *
     * @return \DateTime 
     */
    public function getUserSocialNetworkLinkDatetime()
    {
        return $this->userSocialNetworkLinkDatetime;
    }

    /**
     * Get userSocialNetworkLinkId
     *
     * @return integer 
     */
    public function getUserSocialNetworkLinkId()
    {
        return $this->userSocialNetworkLinkId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return UserSocialNetworkLink
     */
    public function setUser(\BMG\BookToolBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BMG\BookToolBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set socialNetwork
     *
     * @param \BMG\BookToolBundle\Entity\SocialNetwork $socialNetwork
     * @return UserSocialNetworkLink
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
