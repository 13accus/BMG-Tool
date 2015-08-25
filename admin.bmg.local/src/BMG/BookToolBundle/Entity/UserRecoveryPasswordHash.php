<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRecoveryPasswordHash
 *
 * @ORM\Table(name="user_recovery_password_hash", indexes={@ORM\Index(name="fk_user_recovery_password_hash_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class UserRecoveryPasswordHash
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_recovery_password_hash_value", type="string", length=200, nullable=true)
     */
    private $userRecoveryPasswordHashValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_recovery_password_hash_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userRecoveryPasswordHashId;

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
     * Set userRecoveryPasswordHashValue
     *
     * @param string $userRecoveryPasswordHashValue
     * @return UserRecoveryPasswordHash
     */
    public function setUserRecoveryPasswordHashValue($userRecoveryPasswordHashValue)
    {
        $this->userRecoveryPasswordHashValue = $userRecoveryPasswordHashValue;

        return $this;
    }

    /**
     * Get userRecoveryPasswordHashValue
     *
     * @return string 
     */
    public function getUserRecoveryPasswordHashValue()
    {
        return $this->userRecoveryPasswordHashValue;
    }

    /**
     * Get userRecoveryPasswordHashId
     *
     * @return integer 
     */
    public function getUserRecoveryPasswordHashId()
    {
        return $this->userRecoveryPasswordHashId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return UserRecoveryPasswordHash
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
}
