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

    public function createTravelPlanAction() {
        $form = new Application_Form_TravelPlan();
        $form->submit->setLabel('přidat');
        $this->view->TravelPlanForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $TravelPlanName = $form->getValue('TravelPlanName'); //hodnota z new Zend_Form_Element_Text('Name')
                $description = $form->getValue('Description');
                $continent = $form->getValue('Continent');                


                $TravelPlan = new Application_Model_DbTable_TravelPlan();
                $TravelPlan->addTravelPlan($TravelPlan, $continent, $description);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            } else {
                $form->populate($formData); //Pokud zadaná data nejsou validní, pak jimi naplníme formulář a znovu ho zobrazíme.
            }
        }
    }

    public function editTravelPlanAction() {
        $form = new Application_Form_TravelPlan();
        $form->submit->setLabel('změnit');
        $this->view->TravelPlanEditForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $TravelPlanName = $form->getValue('TravelPlanName'); //hodnota z new Zend_Form_Element_Text('Name')
                $description = $form->getValue('Description');
                $continent = $form->getValue('Continent'); 

                $TravelPlan = new Application_Model_DbTable_TravelPlan();
                $TravelPlan->addTravelPlan($TravelPlan, $continent, $description);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            }
        } else {
            
            $item = new Application_Model_DbTable_TravelPlan();
            $selectItem = $this->_getParam('id', 0); // zjištění id
            $data = $item->findPrimaryKey($selectItem);
            $form->populate($data->toArray());
        }
    }

}
