<?php

class Application_Form_Image extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('image')
                ->setMethod('post');

      $id = new Zend_Form_Element_Hidden('ImageId'); //použij pokud bude id a nechceš ho zobrazovat
        $id->addFilter('Int') //Chceme aby to bylo pouze číslo
           ->removeDecorator('label')
           ->removeDecorator('HtmlTag'); 


        $alt = new Zend_Form_Element_Text('Alt');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $alt ->setLabel('alt')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte alt obrázku')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');
        $area = new Zend_Form_Element_Text('Area');       //vytvoření jednoho inputu
        $area->setLabel('area')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte oblast')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');
        $description = new Zend_Form_Element_Text('Description');       //vytvoření jednoho inputu
        $description->setLabel('description')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte popisek')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');
        $imageName = new Zend_Form_Element_Text('ImageName');       //vytvoření jednoho inputu
        $imageName ->setLabel('imageName')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte název obrázku')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');
        $url = new Zend_Form_Element_Text('ImgUrl');       //vytvoření jednoho inputu
        $url ->setLabel('imgUrl')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte URL obrázku')
                ->setAttrib('class', 'form-control') //kaskádový styl
                ->addErrorMessage('Must contain only digit and dot. Example: 5.1');        
        
       


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-success');

        $this->addElements(array($id, $alt, $description, $imageName, $area, $url,$submit));
    }

}
