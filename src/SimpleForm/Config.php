<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 16:35
 */

namespace SimpleForm;


use SimpleForm\Field\TextareaField;

class Config {

    private $_definitions = array();

    function __construct(){
        $this->addFieldDefinition("text", "\\SimpleForm\\\Field\\\InputTypeField");
        $this->addFieldDefinition("input", "\\SimpleForm\\\Field\\\InputTypeField");
        $this->addFieldDefinition("textarea", "\\SimpleForm\\\Field\\\TextareaField");
    }

    function addFieldDefinition($name, $class_name){
        $this->_definitions[$name] = $class_name;
    }

    function getFieldDefinition($name){
        return $this->_definitions[$name];
    }

} 