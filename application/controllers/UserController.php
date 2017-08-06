<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function fetchAllUsersAction()   //actions jsou jak události
    {
        $dbuser = new Application_Model_DbTable_User();
        $user = $dbuser->fetchAllItems();
        $this->view->users = $user;     // předání kolekce do view. je to klíčové slovo co zavolám ve view
                
        
    }


}



