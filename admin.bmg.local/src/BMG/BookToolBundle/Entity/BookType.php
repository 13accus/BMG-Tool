<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookType
 *
 * @ORM\Table(name="book_type", indexes={@ORM\Index(name="fk_book_type_status1_idx", columns={"status_id"})})
 * @ORM\Entity
 */
class BookType
{
    /**
     * @var string
     *
     * @ORM\Column(name="book_type_name", type="string", length=45, nullable=false)
     */
    private $bookTypeName;

    /**
     * @var integer
     *
     * @ORM\Column(name="book_type_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bookTypeId;

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
     * Set bookTypeName
     *
     * @param string $bookTypeName
     * @return BookType
     */
    public function setBookTypeName($bookTypeName)
    {
        $this->bookTypeName = $bookTypeName;

        return $this;
    }

    /**
     * Get bookTypeName
     *
     * @return string 
     */
    public function getBookTypeName()
    {
        return $this->bookTypeName;
    }

    /**
     * Get bookTypeId
     *
     * @return integer 
     */
    public function getBookTypeId()
    {
        return $this->bookTypeId;
    }

    /**
     * Set status
     *
     * @param \BMG\BookToolBundle\Entity\Status $status
     * @return BookType
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
    	 
    	return $this->getBookTypeName();
    }
}
