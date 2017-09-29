<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
        protected function _initNavigation() {
             $this->bootstrap('layout');
            $layout = $this->getResource('layout');
            $view = $layout->getView();
            $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
        
            $navigation = new Zend_Navigation($config);
//            $privilage = new Plugin_AccessCheck();
//            $acl = $privilage->_getAcl();
//            $role = $privilage->_getRole();
            $view->navigation($navigation);        
    }

}

