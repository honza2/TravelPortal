<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function fetchAllCountryAction() {
        $dbuser = new Application_Model_DbTable_Country();
        $country = $dbuser->fetchAllItems();
        $this->view->users = $country;     // předání kolekce do view. je to klíčové slovo co zavolám ve view
    }

    public function createCountryAction() {
        $form = new Application_Form_Country();
        $form->submit->setLabel('přidat');
        $this->view->countryForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $countryName = $form->getValue('CountryName'); //hodnota z new Zend_Form_Element_Text('Name')
                $description = $form->getValue('Description');
                $continent = $form->getValue('Continent');                


                $country = new Application_Model_DbTable_Country();
                $country->addCountry($country, $continent, $description);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            } else {
                $form->populate($formData); //Pokud zadaná data nejsou validní, pak jimi naplníme formulář a znovu ho zobrazíme.
            }
        }
    }

    public function editCountryAction() {
        $form = new Application_Form_Country();
        $form->submit->setLabel('změnit');
        $this->view->countryEditForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $countryName = $form->getValue('CountryName'); //hodnota z new Zend_Form_Element_Text('Name')
                $description = $form->getValue('Description');
                $continent = $form->getValue('Continent'); 

                $country = new Application_Model_DbTable_Country();
                $country->addCountry($country, $continent, $description);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            }
        } else {
            $item = new Application_Model_DbTable_Country();
            $selectItem = $this->_getParam('id', 0); // zjištění id
            $data = $item->findPrimaryKey($selectItem);
            $form->populate($data->toArray());
        }
    }

}
