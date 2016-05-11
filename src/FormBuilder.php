<?php
/**
 * Created by Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm;

use SimpleForm\Field\AbstractField;

class FormBuilder {


    /**
     * @var Config
     */
    private $_fields_config;


    /**
     * @var Form
     */
    private $_form;


    function __construct(Config $config){

        $this->_fields_config = $config;

    }


    /**
     * @param $form
     * @param array $values
     * @return $this
     */
    function create($form, $values=array()){

        if(is_string($form)){

            $this->_form      = new Form($values, $this);
            $this->_form->setName($form);

        }else if($form instanceof AbstractForm){

            $this->_form      = $form;

        }

        return $this;

    }

    function setForm(AbstractForm $form){
        $this->_form = $form;
    }



    function add($name, $key="text", $options=array()){



        if(!$field_class = $this->_fields_config->getFieldDefinition($key)){
           throw new \Exception("Field $key is not defined in configuration");
        }


        /**
         * @var $instance AbstractField
         */


        $instance = new $field_class($name, $this->getForm()->getName(), $options, (isset($options["validators"]) ? $options["validators"] : array()) );

        $this->_form->addField($instance);
        return $this;

    }

    function remove($key){
        //todo: check if a form was created

        $this->_form->offsetUnset($key);
        return $this;
    }


    /**
     * @return Form
     */
    function getForm(){
        return $this->_form;
    }


} 