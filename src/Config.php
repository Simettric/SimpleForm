<?php
/**
 * Created by Asier Marqués <asiermarques@gmail.com>
 */
namespace SimpleForm;

class Config
{
    private $_definitions = array();

    public function __construct()
    {
        $this->addFieldDefinition("text", "\\SimpleForm\\Field\\TextField");
        $this->addFieldDefinition("input", "\\SimpleForm\\Field\\InputTypeField");
        $this->addFieldDefinition("textarea", "\\SimpleForm\\Field\\TextareaField");
        $this->addFieldDefinition("choice", "\\SimpleForm\\Field\\ChoiceField");
    }

    public function addFieldDefinition($name, $class_name)
    {
        $this->_definitions[$name] = $class_name;
    }

    public function getFieldDefinition($name)
    {
        return $this->_definitions[$name];
    }
}
