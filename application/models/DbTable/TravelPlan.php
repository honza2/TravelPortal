<?php

class Application_Model_DbTable_TravelPlan extends Zend_Db_Table_Abstract
{

    protected $_name = 'travelplan';   //jméno tabulky
    protected $_Id = 'TravelplanId';      // jméno sloupce id
    
    public function findPrimaryKey($id) {
        return $this->fetchRow($this->select()->where('TravelplanId = ?', $id));
    }
    
    public function fetchAllItems(){
        $select = $this->getAdapter()->select();    // getAdapter obrashuje sql funkce
        $select->from('travelplan');
        $data = $this->getAdapter()->fetchAll($select);
        return $data;
    }
   public function addPlan($name, $area, $description, $arrive, $departure, $country, $continent, $currency, $spendMoney){
       $data = array(
          'Name' => $name,                    //v jednoduchých závorkách je sloupec z db musí se dodržet název
          'Area' => $area,
           'Description' => $description,
           'Arrive' => $arrive,
           'Departure' => $departure,
           'Country' => $country,
           'Continent' => $continent,
           'Currency' => $currency,
           'SpendMoney' => $spendMoney
       );
       $this->insert($data);
   }
     public function editPlan($id, $name, $area, $description, $arrive, $departure, $country, $continent, $currency, $spendMoney){
       $data = array(
          'Name' => $name,                    //v jednoduchých závorkách je sloupec z db musí se dodržet název
          'Area' => $area,
           'Description' => $description,
           'Arrive' => $arrive,
           'Departure' => $departure,    
           'Country' => $country,
           'Continent' => $continent,
           'Currency' => $currency,
           'SpendMoney' => $spendMoney               
       );
     $this->update($data, 'TravelplanId = ' . (int) $id );
   }
    

}

