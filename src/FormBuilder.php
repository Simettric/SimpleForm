<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 16:01
 */

namespace SimpleForm;
use SimpleForm\Field\AbstractField;

class FormBuilder {


    /**
     * @var Config
     */
    private $_fields_config;


    /**
     * @var string
     */
    private $_form_name;

    /**
     * @var Form
     */
    private $_form;


    function __construct(Config $config){

        $this->_fields_config = $config;

    }


    /**
     * @param $form
     * @param array|stdClass $values
     * @return $this
     */
    function create($form, $values=array()){

        if(is_string($form)){

            $this->_form_name = $form;
            $this->_form      = new Form($values, $this);
            $this->_form->setName($form);

        }else if($form instanceof AbstractForm){

            $this->_form      = $form;
            $this->_form_name = $form->getName();

        }

        return $this;

    }



    function add($name, $key="text", $options=array()){

        //todo: check if a form was created

        if(!$field_class = $this->_fields_config->getFieldDefinition($key)){
           throw new \Exception("Field $key is not defined in configuration");
        }


        /**
         * @var $instance AbstractField
         */


        $instance = new $field_class($name, $this->_form_name, $options, (isset($options["validators"]) ? $options["validators"] : array()) );

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