<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function fetchAllUsersAction() {
        $dbuser = new Application_Model_DbTable_Country();
        $user = $dbuser->fetchAllItems();
        $this->view->users = $user;     // předání kolekce do view. je to klíčové slovo co zavolám ve view
    }

    public function createUsersAction() {
        $form = new Application_Form_User();
        $form->submit->setLabel('přidat');
        $this->view->userForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $name = $form->getValue('Name'); //hodnota z new Zend_Form_Element_Text('Name')
                $surname = $form->getValue('Surname');


                $user = new Application_Model_DbTable_Country();
                $user->addUser($name, $surname);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            } else {
                $form->populate($formData); //Pokud zadaná data nejsou validní, pak jimi naplníme formulář a znovu ho zobrazíme.
            }
        }
    }

    public function editUsersAction() {
        $form = new Application_Form_User();
        $form->submit->setLabel('změnit');
        $this->view->userEditForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $id = $form->getValue('UserId');
                $name = $form->getValue('Name'); //hodnota z new Zend_Form_Element_Text('Name')
                $surname = $form->getValue('Surname');

                $user = new Application_Model_DbTable_Country();
                $user->editUser($id, $name, $surname);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            }
        } else {
            $item = new Application_Model_DbTable_Country();
            $selectItem = $this->_getParam('UserId', 0); // zjištění id
            $data = $item->findPrimaryKey($selectItem);
           // $form->populate($data->toArray());
        }
    }

}
