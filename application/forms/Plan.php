<?php

class Application_Form_Plan extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('travelPlan')
                ->setMethod('post');

      $id = new Zend_Form_Element_Hidden('TravelplanId'); //použij pokud bude id a nechceš ho zobrazovat
        $id->addFilter('Int') //Chceme aby to bylo pouze číslo
           ->removeDecorator('label')
           ->removeDecorator('HtmlTag'); 
         $name = new Zend_Form_Element_Text('Name');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $name ->setLabel('name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte jméno')
                ->setAttrib('class', 'form-control');


        $area = new Zend_Form_Element_Text('Area');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $area ->setLabel('area')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte oblast')
                ->setAttrib('class', 'form-control');

        $description = new Zend_Form_Element_Text('Description');       //vytvoření jednoho inputu
        $description->setLabel('description')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte popisek')
                ->setAttrib('class', 'form-control');
        $arrive = new Zend_Form_Element_Text('Arrive');       //vytvoření jednoho inputu
        $arrive->setLabel('arrive')
                ->setName('Arrive')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte datum příjezdu')
                ->setAttrib('class', 'form-control');
        $departure = new Zend_Form_Element_Text('Departure');       //vytvoření jednoho inputu
        $departure->setLabel('departure')
                ->setName('Departure')                
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte datum odjezdu')
                ->setAttrib('class', 'form-control');
        $country = new Zend_Form_Element_Text('Country');       //vytvoření jednoho inputu
        $country->setLabel('country')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte zemi')
                ->setAttrib('class', 'form-control');        
         $continent = new Zend_Form_Element_Text('Continent');       //vytvoření jednoho inputu
        $continent->setLabel('continent')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte kontinent')
                ->setAttrib('class', 'form-control');       
        $currency = new Zend_Form_Element_Text('Currency');       //vytvoření jednoho inputu
        $currency->setLabel('currency')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte měnu')
                ->setAttrib('class', 'form-control');       
        $spend = new Zend_Form_Element_Text('SpendMoney');       //vytvoření jednoho inputu
        $spend->setLabel('spendMoney')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte rozpočet výletu')
                ->setAttrib('class', 'form-control');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-success');

        $this->addElements(array($id,$name, $area, $description, $arrive, $departure,$country,$continent,$currency,$spend, $submit));
    }

}
