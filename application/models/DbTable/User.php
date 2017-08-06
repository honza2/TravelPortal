<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'example';   //jméno DB
    protected $_Id = 'Id';      // jméno sloupce id
    
    public function fetchAllItems(){
        $select = $this->getAdapter()->select();    // getAdapter obrashuje sql funkce
        $select->fromname('user');
        $data = $this->getAdapter()->fetchAll($select);
        return $data;
    }


}

