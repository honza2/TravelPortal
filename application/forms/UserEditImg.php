<?php

class Application_Form_UserEditImg extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('user')
                ->setMethod('post');

        $id = new Zend_Form_Element_Hidden('UserId'); //použij pokud bude id a nechceš ho zobrazovat
        $id->addFilter('Int') //Chceme aby to bylo pouze číslo
                ->removeDecorator('label')
                ->removeDecorator('HtmlTag');


        $url = new Zend_Form_Element_Text('ImgUrl');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $url->setLabel('URL obrázku')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte jméno')
                ->setAttrib('class', 'form-control'); //kaskádový styl

     


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-success');
        //    $delete = new Zend_Form_Element_Submit('delete');
        //   $delete->setAttrib('class', 'btn btn-delete');
        $this->addElements(array($id, $url, $submit));
    }
    
  

}
