<?php

class Application_Model_PassportMapper
{
    protected $_dbTable;
    protected $infoTable;
    protected $_colsTable;
    protected $_nameTable;


    public function __construct(){
        $this->infoTable = self::getInfoTable();
        $this->_colsTable = $this->infoTable['cols'];
        $this->_nameTable = $this->infoTable['name'];
    }

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Passport');
        }
        return $this->_dbTable;
    }

    private function getInfoTable()
    {
        return $this->getDbTable()->info();
    }

    public function fetchAll($format='Object')
    {
        $i = 0;
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();

        foreach ($resultSet as $row) {
            if($format=='Object'){
                $entry = new Application_Model_Passport();
                $entry->setId($row->id)
                      ->setName($row->name)
                      ->setOld($row->old);
                $entries[] = $entry;
            }
            else{
                $i++;

                foreach ($this->_colsTable as $key_column=>$name_column)
                    $entries[$this->_nameTable."{$i}"][$name_column] = $row->$name_column;
            }
        }
        return $entries;
    }
}