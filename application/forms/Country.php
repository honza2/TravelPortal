<?php

class Application_Form_Country extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('countyr')
                ->setMethod('post');

      $id = new Zend_Form_Element_Hidden('CountryId'); //použij pokud bude id a nechceš ho zobrazovat
        $id->addFilter('Int') //Chceme aby to bylo pouze číslo
           ->removeDecorator('label')
           ->removeDecorator('HtmlTag'); 


        $countryName = new Zend_Form_Element_Text('CountryName');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $countryName ->setLabel('countryName')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte jméno')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');

        $description = new Zend_Form_Element_Text('Description');       //vytvoření jednoho inputu
        $description->setLabel('description')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte příjmení')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');
        $continent = new Zend_Form_Element_Text('Continent');       //vytvoření jednoho inputu
        $continent->setLabel('continent')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte příjmení')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');
        
        
       


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-success');

        $this->addElements(array($id, $countryName, $description, $continent));
    }

}
