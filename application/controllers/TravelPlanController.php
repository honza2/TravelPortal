<?php

class TravelPlanController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function fetchAllPlansAction() {
        $dbplans = new Application_Model_DbTable_TravelPlan();
        $travelPlan = $dbplans->fetchAllItems();
        $this->view->plans = $travelPlan;     // předání kolekce do view. je to klíčové slovo co zavolám ve view
    }
    public function deletePlansAction() {
        if ($this->getRequest()->isPost()) {    //zjištění zda se má zobrazit potvrzovací form nebo provést mazání
            $del = $this->getRequest()->getPost('del'); //získá se hodnota z view jestli ano či ne ('del' je hodnota parametru name z view]
            if ($del == 'Ano') {
                $item = new Application_Model_DbTable_TravelPlan();
                $selectedItem = $item->findPrimaryKey($this->getParam('Id',0)); //bere id z URL proto malým
                $selectedItem->delete();                //netřeba mít metodu v modelu smažeme to takto
               // $this->_helper->flashMessenger->addMessage('User was deleted');
                $this->_helper->redirector('fetch-all-plans');
            }
            if ($del == 'Ne') {
                $this->_helper->redirector('fetch-all-plans');
            }
        } else {
            $id = $this->_getParam('id', 0);    //pomocí getparam zjistím id
            $item = new Application_Model_DbTable_TravelPlan();   //instance do modelu abych poté zjistil záznam s uživatelem
            $this->view->planDeleteForm = $item->findPrimaryKey($id); //předám view
        }
    }

    public function createPlanAction() {
        $form = new Application_Form_Plan();
        $form->submit->setLabel('přidat');        
        $this->view->PlanForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $name = $form->getValue('Name'); //hodnota z new Zend_Form_Element_Text('Name')
                $description = $form->getValue('Description');
                $area = $form->getValue('Area');  
                $arrive = $form->getValue('Arrive');
                $departure = $form->getValue('Departure');
                $country = $form->getValue('Country');
                $continent = $form->getValue('Continent');
                $currency = $form->getValue('Currency');
                $spend = $form->getValue('SpendMoney');


                $TravelPlan = new Application_Model_DbTable_TravelPlan();
                $TravelPlan->addPlan($name, $area, $description, $arrive, $departure, $country, $continent, $currency, $spend);
                 $this->_helper->flashMessenger->addMessage('Byl přidán záznam');
                 $this->_helper->redirector('fetch-all-plans'); //přesměrování na list-of-users
            } else {
                $form->populate($formData); //Pokud zadaná data nejsou validní, pak jimi naplníme formulář a znovu ho zobrazíme.
            }
        }
    }

    public function editPlansAction() {
        $form = new Application_Form_Plan();
        $form->submit->setLabel('změnit');
        $this->view->planEditForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $id = $form->getValue('TravelplanId');
                $name = $form->getValue('Name'); //hodnota z new Zend_Form_Element_Text('Name')
                $description = $form->getValue('Description');
                $area = $form->getValue('Area');  
                $arrive = $form->getValue('Arrive');
                $departure = $form->getValue('Departure');
                $country = $form->getValue('Country');
                $continent = $form->getValue('Continent');
                $currency = $form->getValue('Currency');
                $spend = $form->getValue('SpendMoney'); 
                $arriveToDate = strtotime($arrive);
                $arriveD = date('Y-m-d', $arriveToDate);
                $departureToDate= strtotime($departure);
                $departureD = date('Y-m-d', $departureToDate);
                
                if ($arriveD > $departureD){
                    $_SERVER['PHP_SELF'];
                    echo('Datum odjezdu menší než datum příjezdu');
                    
//                    $url = $_SERVER['REQUEST_URI'];
//                    $this->_helper->redirector($url);
                //   $this->_helper->flashMessenger->addMessage('datum odjezdu menší než datum příjezdu');
                }
                else{
                $TravelPlan = new Application_Model_DbTable_TravelPlan();
                $TravelPlan->editPlan($id, $name, $area, $description, $arriveD, $departureD, $country, $continent, $currency, $spend);
                
                $this->_helper->flashMessenger->addMessage('Přidán záznam');
                $this->_helper->redirector('fetch-all-plans'); //přesměrování na list-of-users
                }
            }
        } else {
            
            $item = new Application_Model_DbTable_TravelPlan();
            $selectItem = $this->_getParam('Id', 0); // zjištění id            
            $data = $item->findPrimaryKey($selectItem);
            $form->populate($data->toArray());
        }
    }

}
