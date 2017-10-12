<?php

class Application_Model_DbTable_Image extends Zend_Db_Table_Abstract
{

    protected $_name = 'image';   //jméno tabulky
    protected $_Id = 'ImageId';      // jméno sloupce id
    
    public function findPrimaryKey($id) {
        return $this->fetchRow($this->select()->where('ImageId = ?', $id));
    }
    
    public function fetchAllItems(){
        
        $select = $this->getAdapter()->select();    // getAdapter obrashuje sql funkce
        $select->from('image');
        $data = $this->getAdapter()->fetchAll($select);
        return $data;
    }
   public function addImage($imageName, $alt, $description, $area){
       $data = array(
          'ImageName' => $imageName,                    //v jednoduchých závorkách je sloupec z db musí se dodržet název
          'Alt' => $alt,
           'Description' => $description,
           'Area' => $area
       );
       $this->insert($data);
   }
     public function editImage($imageId, $imageName, $alt, $description, $area){
       $data = array(          
          'ImageName' => $imageName,                    //v jednoduchých závorkách je sloupec z db musí se dodržet název
          'Alt' => $alt,
           'Description' => $description,
           'Area' => $area       
       );
     $this->update($data, 'ImageId = ' . (int) $imageId );
   }
    

}

