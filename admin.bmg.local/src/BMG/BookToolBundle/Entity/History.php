<?php

namespace BMG\BookToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table(name="history")
 * @ORM\Entity
 */
class History
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="history_datetime", type="datetime", nullable=false)
     */
    private $historyDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="table_name", type="string", length=100, nullable=true)
     */
    private $tableName;

    /**
     * @var string
     *
     * @ORM\Column(name="field_name", type="string", length=100, nullable=true)
     */
    private $fieldName;

    /**
     * @var string
     *
     * @ORM\Column(name="row_id", type="string", length=100, nullable=false)
     */
    private $rowId;

    /**
     * @var string
     *
     * @ORM\Column(name="previous_value", type="string", length=2000, nullable=true)
     */
    private $previousValue;

    /**
     * @var string
     *
     * @ORM\Column(name="new_value", type="string", length=2000, nullable=true)
     */
    private $newValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="history_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $historyId;



    /**
     * Set historyDatetime
     *
     * @param \DateTime $historyDatetime
     * @return History
     */
    public function setHistoryDatetime($historyDatetime)
    {
        $this->historyDatetime = $historyDatetime;

        return $this;
    }

    /**
     * Get historyDatetime
     *
     * @return \DateTime 
     */
    public function getHistoryDatetime()
    {
        return $this->historyDatetime;
    }

    /**
     * Set tableName
     *
     * @param string $tableName
     * @return History
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * Get tableName
     *
     * @return string 
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * Set fieldName
     *
     * @param string $fieldName
     * @return History
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string 
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set rowId
     *
     * @param string $rowId
     * @return History
     */
    public function setRowId($rowId)
    {
        $this->rowId = $rowId;

        return $this;
    }

    /**
     * Get rowId
     *
     * @return string 
     */
    public function getRowId()
    {
        return $this->rowId;
    }

    /**
     * Set previousValue
     *
     * @param string $previousValue
     * @return History
     */
    public function setPreviousValue($previousValue)
    {
        $this->previousValue = $previousValue;

        return $this;
    }

    /**
     * Get previousValue
     *
     * @return string 
     */
    public function getPreviousValue()
    {
        return $this->previousValue;
    }

    /**
     * Set newValue
     *
     * @param string $newValue
     * @return History
     */
    public function setNewValue($newValue)
    {
        $this->newValue = $newValue;

        return $this;
    }

    /**
     * Get newValue
     *
     * @return string 
     */
    public function getNewValue()
    {
        return $this->newValue;
    }

    /**
     * Get historyId
     *
     * @return integer 
     */
    public function getHistoryId()
    {
        return $this->historyId;
    }
    
    public function __toString() {
    	return $this->getHistoryId();
    }
}
