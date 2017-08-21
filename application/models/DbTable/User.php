<?php

class Application_Model_DbTable_Country extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';   //jméno tabulky
    protected $_Id = 'Id';      // jméno sloupce id
    
    public function findPrimaryKey($id) {
        return $this->fetchRow($this->select()->where('Id = ?', $id));
    }
    
    public function fetchAllItems(){
        $select = $this->getAdapter()->select();    // getAdapter obrashuje sql funkce
        $select->from('user');
        $data = $this->getAdapter()->fetchAll($select);
        return $data;
    }
   public function addUser($name, $surname){
       $data = array(
          'Name' => $name,                    //v jednoduchých závorkách je sloupec z db musí se dodržet název
          'Surname' => $surname        
       );
       $this->insert($data);
   }
     public function editUser($id, $name, $surname){
       $data = array(
          'Name' => $name,                    
          'Surname' => $surname        
       );
     $this->update($data, 'Id = ' . (int) $id );
   }
    

}

