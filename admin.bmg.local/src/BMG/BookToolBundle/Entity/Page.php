<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="page", indexes={@ORM\Index(name="fk_page_chapter1_idx", columns={"chapter_id"}), @ORM\Index(name="fk_page_status1_idx", columns={"status_id"}), @ORM\Index(name="fk_page_role1_idx", columns={"project_role_id"})})
 * @ORM\Entity
 */
class Page
{
    /**
     * @var integer
     *
     * @ORM\Column(name="page_number", type="smallint", nullable=false)
     */
    private $pageNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="page_type_id", type="integer", nullable=false)
     */
    private $pageTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="page_content", type="text", nullable=false)
     */
    private $pageContent;

    /**
     * @var integer
     *
     * @ORM\Column(name="page_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pageId;

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
     * @var \BMG\BookToolBundle\Entity\ProjectRole
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\ProjectRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_role_id", referencedColumnName="role_id")
     * })
     */
    private $projectRole;

    /**
     * @var \BMG\BookToolBundle\Entity\Chapter
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Chapter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chapter_id", referencedColumnName="chapter_id")
     * })
     */
    private $chapter;



    /**
     * Set pageNumber
     *
     * @param integer $pageNumber
     * @return Page
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * Get pageNumber
     *
     * @return integer 
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * Set pageTypeId
     *
     * @param integer $pageTypeId
     * @return Page
     */
    public function setPageTypeId($pageTypeId)
    {
        $this->pageTypeId = $pageTypeId;

        return $this;
    }

    /**
     * Get pageTypeId
     *
     * @return integer 
     */
    public function getPageTypeId()
    {
        return $this->pageTypeId;
    }

    /**
     * Set pageContent
     *
     * @param string $pageContent
     * @return Page
     */
    public function setPageContent($pageContent)
    {
        $this->pageContent = $pageContent;

        return $this;
    }

    /**
     * Get pageContent
     *
     * @return string 
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }

    /**
     * Get pageId
     *
     * @return integer 
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return Page
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

    /**
     * Set projectRole
     *
     * @param \BMG\BookToolBundle\Entity\ProjectRole $projectRole
     * @return Page
     */
    public function setProjectRole(\BMG\BookToolBundle\Entity\ProjectRole $projectRole = null)
    {
        $this->projectRole = $projectRole;

        return $this;
    }

    /**
     * Get projectRole
     *
     * @return \BMG\BookToolBundle\Entity\ProjectRole 
     */
    public function getProjectRole()
    {
        return $this->projectRole;
    }

    /**
     * Set chapter
     *
     * @param \BMG\BookToolBundle\Entity\Chapter $chapter
     * @return Page
     */
    public function setChapter(\BMG\BookToolBundle\Entity\Chapter $chapter = null)
    {
        $this->chapter = $chapter;

        return $this;
    }

    /**
     * Get chapter
     *
     * @return \BMG\BookToolBundle\Entity\Chapter 
     */
    public function getChapter()
    {
        return $this->chapter;
    }
    
    public function __toString() {
    	return $this;
    }
}
