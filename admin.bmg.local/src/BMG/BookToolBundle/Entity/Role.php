<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role", indexes={@ORM\Index(name="fk_role_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class Role
{
    /**
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=45, nullable=false)
     */
    private $roleName;

    /**
     * @var string
     *
     * @ORM\Column(name="role_role", type="string", length=45, nullable=false)
     */
    private $roleRole;

    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

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
     * Set roleName
     *
     * @param string $roleName
     * @return Role
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string 
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Set roleRole
     *
     * @param string $roleRole
     * @return Role
     */
    public function setRoleRole($roleRole)
    {
        $this->roleRole = $roleRole;

        return $this;
    }

    /**
     * Get roleRole
     *
     * @return string 
     */
    public function getRoleRole()
    {
        return $this->roleRole;
    }

    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return Role
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
    	return $this->getRoleName();
    }
}
