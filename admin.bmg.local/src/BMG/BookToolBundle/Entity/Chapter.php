<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chapter
 *
 * @ORM\Table(name="chapter", indexes={@ORM\Index(name="fk_chapter_book1_idx", columns={"book_id"}), @ORM\Index(name="fk_chapter_status1_idx", columns={"status_id"}), @ORM\Index(name="fk_chapter_role1_idx", columns={"project_role_id"})})
 * @ORM\Entity
 */
class Chapter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="chapter_number", type="smallint", nullable=false)
     */
    private $chapterNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="chapter_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $chapterId;

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
     * @var \BMG\BookToolBundle\Entity\Book
     *
     * @ORM\ManyToOne(targetEntity="BMG\BookToolBundle\Entity\Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="book_id", referencedColumnName="book_id")
     * })
     */
    private $book;



    /**
     * Set chapterNumber
     *
     * @param integer $chapterNumber
     * @return Chapter
     */
    public function setChapterNumber($chapterNumber)
    {
        $this->chapterNumber = $chapterNumber;

        return $this;
    }

    /**
     * Get chapterNumber
     *
     * @return integer 
     */
    public function getChapterNumber()
    {
        return $this->chapterNumber;
    }

    /**
     * Get chapterId
     *
     * @return integer 
     */
    public function getChapterId()
    {
        return $this->chapterId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return Chapter
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
     * @return Chapter
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
     * Set book
     *
     * @param \BMG\BookToolBundle\Entity\Book $book
     * @return Chapter
     */
    public function setBook(\BMG\BookToolBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \BMG\BookToolBundle\Entity\Book 
     */
    public function getBook()
    {
        return $this->book;
    }
    
    public function __toString() {
    	 
    	return $this->getChapterId();
    }
}
