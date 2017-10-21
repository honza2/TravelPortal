<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyValid_Password
 *
 * @author 
 */

require_once 'Zend/Validate/Abstract.php';

/**
 * @see Zend_Validate_Hostname
 */
require_once 'Zend/Validate/Hostname.php'; //vyzkoušet jestli to jde bez těch dvou


class Zend_Validate_MyValidPassword extends Zend_Validate_Abstract{  
    const LENGTH = 'length';  //konstatnty kere chci a budu testovat
    const UPPER  = 'upper';
    const LOWER  = 'lower';
    const DIGIT  = 'digit';
 
    protected $_messageTemplates = array(
        self::LENGTH => "Musí být minimálně 8 znaků dlouhé",  //zjistit co je self
        self::UPPER  => "Musí obsahovat minimálně 1 velké písmeno",
        self::LOWER  => "Musí obsahovat minimálně malé písmeno",
        self::DIGIT  => "Musí obsahovat minimálně 1 číslo"
    );
 
    public function isValid($value)
    {
        $this->_setValue($value);
 
        $isValid = true;
 
        if (strlen($value) < 8) {  //spočítá počet znaků
            $this->_error(self::LENGTH);
            $isValid = false;
        }
 
        if (!preg_match('/[A-Z]/', $value)) {  //musí velké písmena, musí byt rozdílné
            $this->_error(self::UPPER);
            $isValid = false;
        }
 
        if (!preg_match('/[a-z]/', $value)) {
            $this->_error(self::LOWER);
            $isValid = false;
        }
 
        if (!preg_match('/\d/', $value)) {  //počet znaků, d něco znamená :)
            $this->_error(self::DIGIT);
            $isValid = false;
        }
 
        return $isValid;
    }
}
//<?php include_once 'Zend/View/Helper/HeadMeta.php'?>
<?php include_once 'Zend/View/Helper/Doctype.php'?>
<?php include_once 'Zend/View/Helper/HeadTitle.php'?>
<?php include_once 'Zend/View/Helper/HeadLink.php'?>
<?php include_once 'Zend/View/Helper/BaseUrl.php'?>
<?php include_once 'Zend/View/Helper/Navigation/Menu.php'?>
<?php include_once 'Zend/Controller/Action/Helper/Url.php'?>
<?php include_once 'Zend/View/Helper/Navigation/Breadcrumbs.php'?>
<?php include_once 'Zend/View/Helper/Layout.php'?>
<?php include_once 'Zend/View/Helper/HeadMeta.php'?>
