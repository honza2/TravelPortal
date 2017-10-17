<?php

class Application_Form_User extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('user')
                ->setMethod('post');

        $id = new Zend_Form_Element_Hidden('UserId'); //použij pokud bude id a nechceš ho zobrazovat
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
                ->setAttrib('class', 'form-control'); //kaskádový styl

        $surname = new Zend_Form_Element_Text('Surname');       //vytvoření jednoho inputu
        $surname->setLabel('Příjmení')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('placeholder', 'zadejte příjmení')
                ->setAttrib('class', 'form-control'); //kaskádový styl




        $imgUrl = new Zend_Form_Element_Text('ImgUrl');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $imgUrl->setLabel('url')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttrib('placeholder', 'zadejte URL obrázku')
                ->setAttrib('class', 'form-control'); //kaskádový styl


        $description = new Zend_Form_Element_Text('Description');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $description->setLabel('popis')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttrib('placeholder', 'zadejte popisek')
                ->setAttrib('class', 'form-control'); //kaskádový styl
        $this->addElementPrefixPath('myValidPassword', APPLICATION_PATH . '/../library/Validate', 'myValidPassword');
        
        $password = new Zend_Form_Element_Password('Password');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $password->setLabel('heslo')
                ->addFilter('StripTags')
                ->setRequired(true)
                ->addValidator('NotEmpty')
                ->setDescription('Heslo musí obsahovat 7 znaků') 
                 ->addValidator('myValidPassword', true)
                ->addFilter('StringTrim')
                ->setAttrib('placeholder', 'zadejte heslo')
                ->setAttrib('class', 'form-control'); //kaskádový styl
        
        $confirmPass = new Zend_Form_Element_Password('ConfirmPassword');       //vytvoření jednoho inputu, v uvozovkách tak jak se to jmenuje v db
        $confirmPass->setLabel('heslo')
                ->addFilter('StripTags')
                ->setRequired(true)
               ->addValidator('NotEmpty')
               ->addValidator('Identical')
                ->addFilter('StringTrim')
                ->setAttrib('placeholder', 'zadejte heslo')
                ->setAttrib('class', 'form-control'); //kaskádový styl


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-success');
        //    $delete = new Zend_Form_Element_Submit('delete');
        //   $delete->setAttrib('class', 'btn btn-delete');
        $this->addElements(array($id, $name, $surname, $imgUrl, $description, $password, $confirmPass, $submit));
    }
    
    public function isValid($data) {
        $confirmPassword = $this->getElement('ConfirmPassword'); 
        $confirmPassword->getValidator('Identical')
                ->setToken($data['Password'])
                ->setMessage('Passwords do not match!');
        return parent::isValid($data);
    }

}
