<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 21:10
 */

namespace SimpleForm\Field;


class InputTypeField extends AbstractField {


    protected function  _configureHTMLAttributes(){
        parent::_configureHTMLAttributes();
        unset($this->_html_attributes["type"]);
    }

    function getInputTag(){

        $type = isset($this->_options["type"])? $this->_options["type"] :"text";

        return '<input type="'. $type .'" value="' . $this->getValue() . '" ' . $this->getAttributes() . '>';

    }

} 