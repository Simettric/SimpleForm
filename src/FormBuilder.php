<?php
/**
 * Created by Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm;

use SimpleForm\Field\AbstractField;

class FormBuilder
{


    /**
     * @var Config
     */
    private $_fields_config;


    /**
     * @var Form
     */
    private $_form;


    public function __construct(Config $config)
    {
        $this->_fields_config = $config;
    }


    /**
     * @param $form
     * @param array $values
     * @return $this
     */
    public function create($form, $values=array())
    {
        if (is_string($form)) {
            $this->_form      = new Form($values, $this);
            $this->_form->setName($form);
        } elseif ($form instanceof AbstractForm) {
            $this->_form      = $form;
        }

        return $this;
    }

    public function setForm(AbstractForm $form)
    {
        $this->_form = $form;
    }



    public function add($name, $key="text", $options=array())
    {
        if (!$field_class = $this->_fields_config->getFieldDefinition($key)) {
            throw new \Exception("Field $key is not defined in configuration");
        }


        /**
         * @var $instance AbstractField
         */


        $instance = new $field_class($name, $this->getForm()->getName(), $options, (isset($options["validators"]) ? $options["validators"] : array()));

        $this->_form->addField($instance);
        return $this;
    }

    public function remove($key)
    {
        //todo: check if a form was created

        $this->_form->offsetUnset($key);
        return $this;
    }


    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->_form;
    }
}
