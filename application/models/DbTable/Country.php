<?php

class Application_Model_DbTable_Country extends Zend_Db_Table_Abstract
{

    protected $_name = 'travelplan';   //jméno tabulky
    protected $_Id = 'TravelPlanId';      // jméno sloupce id
    
    public function findPrimaryKey($id) {
        return $this->fetchRow($this->select()->where('TravelplanId = ?', $id));
    }
    
    public function fetchAllItems(){
        $select = $this->getAdapter()->select();    // getAdapter obrashuje sql funkce
        $select->from('travelplan');
        $data = $this->getAdapter()->fetchAll($select);
        return $data;
    }
   public function addPlan($area, $arrive, $departure, $description){
       $data = array(
          'Area' => $area,                    //v jednoduchých závorkách je sloupec z db musí se dodržet název
          'Arrive' => $arrive,
           'Departure'=> $departure,
           'Description' => $description           
       );
       $this->insert($data);
   }
     public function editPlan($area, $arrive, $departure, $description){
       $data = array(
          'Area' => $area,                    //v jednoduchých závorkách je sloupec z db musí se dodržet název
          'Arrive' => $arrive,
           'Departure'=> $departure,
           'Description' => $description        
       );
     $this->update($data, 'CountryId = ' . (int) $id );
   }
    

}

