<?php

class RegisterController extends Zend_Controller_Action {

    public function init() {
   
    }

    public function indexAction() {
        // action body
    

  
    }
    public function registerAction(){
    // zde je místo pro zpracování formuláře register
        
        
        $mail = new Zend_Mail('UTF-8');
                $mail->addTo($email, 'Tomas Czakan') //prijemnce
                        ->setFrom('sportevents1@seznam.cz', 'Enwico DATA') //odesilatel
                        ->setSubject('Registration confirmation')
                        ->setBodyText($form->getValue('FirstName') . 'You have been registered with NOSPAM, your temporary password is: ' . $password . '. To change your password, go to My Profile!!!')
                        ->send();
    }

}









