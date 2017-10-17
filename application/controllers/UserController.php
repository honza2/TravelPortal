<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        $messages = $this->_helper->flashMessenger->getMessages();
        if (!empty($messages)) {
            $this->_helper->layout->getView()->message = $messages[0]; /// message se předává view
        
        }
    }

    public function indexAction() {
        // action body
    }

    public function fetchAllUsersAction() {
        $dbuser = new Application_Model_DbTable_User();
        $user = $dbuser->fetchAllItems();
        $count = count($user);

        if ($count == 0) {
            $message = 'No rows in table'; 
             $this->view->messageRows = $message;
        }
        $this->view->users = $user;     // předání kolekce do view. je to klíčové slovo co zavolám ve view
    }
    public function userAccountAction() {
        $dbuser = new Application_Model_DbTable_User();
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
                $imgUrl = $form->getValue('ImgUrl');
                $password = $form->getValue('Password');


                $user = new Application_Model_DbTable_User();
                if (strlen($imgUrl) == 0 ){
                    $imgUrl = "http://i0.kym-cdn.com/entries/icons/original/000/009/556/jesus-bleu-mauve.jpg";
                }
                $user->addUser($name, $surname, $imgUrl, $password);
                $this->_helper->flashMessenger->addMessage('Uživatel byl vytvořen');
                $this->_helper->redirector('fetch-all-users'); //přesměrování na list-of-users,, metoda init musí být v cotrolleru, kde redirektujem
            } else {
                $form->populate($formData); //Pokud zadaná data nejsou validní, pak jimi naplníme formulář a znovu ho zobrazíme.
            }
        }
    }
/*    public function deleteUsersAction() {
        $form = new Application_Form_User();
        $form->submit->setLabel('smazat');
        $this->view->userDeleteForm = $form;
        $item = new Application_Model_DbTable_User();
        $selectItem = $this->_getParam('id', 0); // zjištění id
        $data = $item->findPrimaryKey($selectItem);
        $form->populate($data->toArray());
        $item->deleteUser($selectItem);
        
    }*/
    public function deleteUsersAction() {
        if ($this->getRequest()->isPost()) {    //zjištění zda se má zobrazit potvrzovací form nebo provést mazání
            $del = $this->getRequest()->getPost('del'); //získá se hodnota z view jestli ano či ne ('del' je hodnota parametru name z view]
            if ($del == 'Ano') {
                $item = new Application_Model_DbTable_User();
                $selectedItem = $item->findPrimaryKey($this->getParam('id')); //bere id z formuláře proto malým
                $selectedItem->delete();                //netřeba mít metodu v modelu smažeme to takto
               // $this->_helper->flashMessenger->addMessage('User was deleted');
                $this->_helper->redirector('fetch-all-users');
            }
            if ($del == 'Ne') {
                $this->_helper->redirector('fetch-all-users');
            }
        } else {
            $id = $this->_getParam('id', 0);    //pomocí getparam zjistím id
            $item = new Application_Model_DbTable_User();   //instance do modelu abych poté zjistil záznam s uživatelem
            $this->view->userDeleteForm = $item->findPrimaryKey($id); //předám view
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
                $imageId = $form->getValue('ImgUrl');
                $description = $form->getValue('Description');
                 $password = $form->getValue('Password');
                $user = new Application_Model_DbTable_User();
                if (strlen($imageId) == 0 ){
                    $imageId = "http://i0.kym-cdn.com/entries/icons/original/000/009/556/jesus-bleu-mauve.jpg";
                }
                $user->editUser($id, $name, $surname, $imageId, $description, $password);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            }
        } else {
            $item = new Application_Model_DbTable_User();
            $selectItem = $this->_getParam('id', 0); // zjištění id v uvozovkách id proměnná z formuláře ne z db!
            $data = $item->findPrimaryKey($selectItem);
            $form->populate($data->toArray());
        }
    }
    public function editUserimgAction() {
        $form = new Application_Form_UserEditImg();
        $form->submit->setLabel('změnit');
        $this->view->userEditImgForm = $form;  //userForm je proměnná na kterou přistupuju ve view

        if ($this->getRequest()->isPost()) {  //Pokud metoda isPost() na objektu requestu vrací true, tak byl formulář odeslán
            $formData = $this->getRequest()->getPost(); //pomocí getPost() získáme data
            if ($form->isValid($formData)) {    //pomocí isValid() ověříme, že jsou data správná
                $id = $form->getValue('UserId');                
                $url = $form->getValue('ImgUrl'); //hodnota z new Zend_Form_Element_Text('Name')               
                $user = new Application_Model_DbTable_User();
                $user->saveImgUrl($id, $url);
                //  $this->_helper->flashMessenger->addMessage('Bylo přidáno nové pravidlo');
                // $this->_helper->redirector('user'); //přesměrování na list-of-users
            }
        } else {
            $item = new Application_Model_DbTable_User();
            $selectItem = $this->_getParam('id', 0); // zjištění id v uvozovkách id proměnná z formuláře ne z db!
            $data = $item->findPrimaryKey($selectItem);
            $form->populate($data->toArray());
        }
    }

}









