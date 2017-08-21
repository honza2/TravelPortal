<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function fetchAllImagessAction() {
        $dbimage = new Application_Model_DbTable_Image();
        $image = $dbimage->fetchAllItems();
        $this->view->images = $image;     // předání kolekce do view. je to klíčové slovo co zavolám ve view
    }

    public function createImagesAction() {
        $form = new Application_Form_Image();
        $form->submit->setLabel('přidat');
        $this->view->imageForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $imageName = $form->getValue('Name'); //hodnota z new Zend_Form_Element_Text('Name')
                $description = $form->getValue('Surname');
                $alt = $form->getValue('Alt');
                $area = $form->getValue('Area');
                        


                $image = new Application_Model_DbTable_Image();
                $image->addUser($imageName, $alt, $description, $area);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            } else {
                $form->populate($formData); //Pokud zadaná data nejsou validní, pak jimi naplníme formulář a znovu ho zobrazíme.
            }
        }
    }

    public function editUsersAction() {
        $form = new Application_Form_Image();
        $form->submit->setLabel('změnit');
        $this->view->imageEditForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                 $imageName = $form->getValue('Name'); //hodnota z new Zend_Form_Element_Text('Name')
                $description = $form->getValue('Surname');
                $alt = $form->getValue('Alt');
                $area = $form->getValue('Area');

                $image = new Application_Model_DbTable_Image();
                $image->addUser($imageName, $alt, $description, $area);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            }
        } else {
            $item = new Application_Model_DbTable_Image();
            $selectItem = $this->_getParam('id', 0); // zjištění id
            $data = $item->findPrimaryKey($selectItem);
            $form->populate($data->toArray());
        }
    }

}
