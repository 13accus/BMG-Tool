<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book", indexes={@ORM\Index(name="fk_book_book_type1_idx", columns={"book_type_id"}), @ORM\Index(name="fk_book_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class Book
{
    /**
     * @var string
     *
     * @ORM\Column(name="book_description", type="blob", nullable=true)
     */
    private $bookDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="bigint", nullable=false)
     */
    private $projectId;

    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bookId;

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
     * @var \BMG\BookToolBundle\Entity\BookType
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\BookType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="book_type_id", referencedColumnName="book_type_id")
     * })
     */
    private $bookType;



    /**
     * Set bookDescription
     *
     * @param string $bookDescription
     * @return Book
     */
    public function setBookDescription($bookDescription)
    {
        $this->bookDescription = $bookDescription;

        return $this;
    }

    /**
     * Get bookDescription
     *
     * @return string 
     */
    public function getBookDescription()
    {
        return $this->bookDescription;
    }

    /**
     * Set projectId
     *
     * @param integer $projectId
     * @return Book
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Get projectId
     *
     * @return integer 
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Get bookId
     *
     * @return integer 
     */
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return Book
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
     * Set bookType
     *
     * @param \BMG\BookToolBundle\Entity\BookType $bookType
     * @return Book
     */
    public function setBookType(\BMG\BookToolBundle\Entity\BookType $bookType = null)
    {
        $this->bookType = $bookType;

        return $this;
    }

    /**
     * Get bookType
     *
     * @return \BMG\BookToolBundle\Entity\BookType 
     */
    public function getBookType()
    {
        return $this->bookType;
    }
    
    public function __toString() {
    	
    	return $this;
    }
}
