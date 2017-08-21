<?php

class Application_Form_User extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('user')
                ->setMethod('post');

      $id = new Zend_Form_Element_Hidden('id'); //použij pokud bude id a nechceš ho zobrazovat
        $id->addFilter('Int') //Chceme aby to bylo pouze číslo
           ->removeDecorator('label')
           ->removeDecorator('HtmlTag'); 


        $name = new Zend_Form_Element_Text('Name');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $name->setLabel('jméno')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte jméno')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');
        $surname = new Zend_Form_Element_Text('Surname');       //vytvoření jednoho inputu
        $surname->setLabel('Příjmení')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte příjmení')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');
        
        
       


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-success');

        $this->addElements(array($id, $name, $surname, $submit));
    }

}
