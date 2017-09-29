<?php

class Application_Model_DbTable_TravelPlan extends Zend_Db_Table_Abstract
{

    protected $_name = 'country';   //jméno tabulky
    protected $_Id = 'Id';      // jméno sloupce id
    
    public function findPrimaryKey($id) {
        return $this->fetchRow($this->select()->where('CountryId = ?', $id));
    }
    
    public function fetchAllItems(){
        $select = $this->getAdapter()->select();    // getAdapter obrashuje sql funkce
        $select->from('travelplan');
        $data = $this->getAdapter()->fetchAll($select);
        return $data;
    }
   public function addCountry($countryName, $continent, $description){
       $data = array(
          'CountryName' => $countryName,                    //v jednoduchých závorkách je sloupec z db musí se dodržet název
          'Continent' => $continent,
           'Description' => $description           
       );
       $this->insert($data);
   }
     public function editCountry($id, $countryName, $continent, $description){
       $data = array(
          'CountryName' => $countryName,                    //v jednoduchých závorkách je sloupec z db musí se dodržet název
          'Continent' => $continent,
           'Description' => $description         
       );
     $this->update($data, 'CountryId = ' . (int) $id );
   }
    

}

