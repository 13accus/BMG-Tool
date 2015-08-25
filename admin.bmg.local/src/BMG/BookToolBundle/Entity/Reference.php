<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reference
 *
 * @ORM\Table(name="reference", indexes={@ORM\Index(name="fk_reference_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Reference
{
    /**
     * @var string
     *
     * @ORM\Column(name="reference_desc", type="string", length=145, nullable=false)
     */
    private $referenceDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_email", type="string", length=245, nullable=false)
     */
    private $referenceEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_phone", type="string", length=10, nullable=true)
     */
    private $referencePhone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reference_datetime", type="datetime", nullable=false)
     */
    private $referenceDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="reference_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $referenceId;

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
     * Set referenceDesc
     *
     * @param string $referenceDesc
     * @return Reference
     */
    public function setReferenceDesc($referenceDesc)
    {
        $this->referenceDesc = $referenceDesc;

        return $this;
    }

    /**
     * Get referenceDesc
     *
     * @return string 
     */
    public function getReferenceDesc()
    {
        return $this->referenceDesc;
    }

    /**
     * Set referenceEmail
     *
     * @param string $referenceEmail
     * @return Reference
     */
    public function setReferenceEmail($referenceEmail)
    {
        $this->referenceEmail = $referenceEmail;

        return $this;
    }

    /**
     * Get referenceEmail
     *
     * @return string 
     */
    public function getReferenceEmail()
    {
        return $this->referenceEmail;
    }

    /**
     * Set referencePhone
     *
     * @param string $referencePhone
     * @return Reference
     */
    public function setReferencePhone($referencePhone)
    {
        $this->referencePhone = $referencePhone;

        return $this;
    }

    /**
     * Get referencePhone
     *
     * @return string 
     */
    public function getReferencePhone()
    {
        return $this->referencePhone;
    }

    /**
     * Set referenceDatetime
     *
     * @param \DateTime $referenceDatetime
     * @return Reference
     */
    public function setReferenceDatetime($referenceDatetime)
    {
        $this->referenceDatetime = $referenceDatetime;

        return $this;
    }

    /**
     * Get referenceDatetime
     *
     * @return \DateTime 
     */
    public function getReferenceDatetime()
    {
        return $this->referenceDatetime;
    }

    /**
     * Get referenceId
     *
     * @return integer 
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * Set user
     *
     * @param \BMG\BookToolBundle\Entity\User $user
     * @return Reference
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
    
    public function __toString() {
    	return $this;
    }
}
