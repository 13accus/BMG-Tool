<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectVendorClientLink
 *
 * @ORM\Table(name="project_vendor_client_link", indexes={@ORM\Index(name="fk_project_vendor_client_link_project1_idx", columns={"project_id"}), @ORM\Index(name="fk_project_vendor_client_link_client_vendor1_idx", columns={"client_vendor_id"})})
 * @ORM\Entity
 */
class ProjectVendorClientLink
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="project_vendor_client_link_datetime", type="datetime", nullable=false)
     */
    private $projectVendorClientLinkDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_vendor_client_link_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $projectVendorClientLinkId;

    /**
     * @var \BMG\BookToolBundle\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Project")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id", referencedColumnName="project_id")
     * })
     */
    private $project;

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
     * Set projectVendorClientLinkDatetime
     *
     * @param \DateTime $projectVendorClientLinkDatetime
     * @return ProjectVendorClientLink
     */
    public function setProjectVendorClientLinkDatetime($projectVendorClientLinkDatetime)
    {
        $this->projectVendorClientLinkDatetime = $projectVendorClientLinkDatetime;

        return $this;
    }

    /**
     * Get projectVendorClientLinkDatetime
     *
     * @return \DateTime 
     */
    public function getProjectVendorClientLinkDatetime()
    {
        return $this->projectVendorClientLinkDatetime;
    }

    /**
     * Get projectVendorClientLinkId
     *
     * @return integer 
     */
    public function getProjectVendorClientLinkId()
    {
        return $this->projectVendorClientLinkId;
    }

    /**
     * Set project
     *
     * @param \BMG\BookToolBundle\Entity\Project $project
     * @return ProjectVendorClientLink
     */
    public function setProject(\BMG\BookToolBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \BMG\BookToolBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set clientVendor
     *
     * @param \BMG\BookToolBundle\Entity\ClientVendor $clientVendor
     * @return ProjectVendorClientLink
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
    
    public function __toString() {
    	return $this;
    }
}
