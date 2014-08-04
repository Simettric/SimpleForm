<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 15:48
 */

namespace SimpleForm\Field;


abstract class AbstractField {


    protected $_errors     = array();
    protected $_options    = array();
    protected $_validators = array();

    protected $_form_name;

    protected $_name;
    protected $_value;

    function __construct($name, $form_name, $options=array(), $validators=array()){

        $this->_name       = $name;
        $this->_form_name  = $form_name;
        $this->_options    = $options;
        $this->_validators = $validators;

    }

    function getName(){
        return $this->_name;
    }


    function getValue(){
        return $this->_value;
    }

    function setValue($value){
        $this->_value = $value;
    }


    function bind($value){
        return true;
    }


    function __toString(){
        return $this->getLabelTag() . $this->getInputTag() . $this->getErrorTag();
    }

    function getLabelTag($label=null){
        $label = isset($this->_options["label"]) ? $this->_options["label"] : ($label ? $label :$this->_name);
        return '<label for="' . $this->_form_name . '_'. $this->_name .'">' . $label . '</label>';
    }

    function hasError(){
        return count($this->_errors);
    }

    function getErrorArray(){
        return $this->_errors;
    }

    function getErrorTag(){

        if($this->hasError()){

            $html = "";
            foreach($this->getErrorArray() as $key=>$error){
                $html .= '<span class="error">' . $error . '</span>';
            }
            return $html;
        }


        return null;
    }

    abstract function  getInputTag();

} 