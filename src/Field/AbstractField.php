<?php
/**
 * The Base Form Field class.
 *
 * You need to extend it with your custom Form Fields.
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm\Field;

use Zend\Validator\AbstractValidator;
use Zend\Validator\NotEmpty;

abstract class AbstractField
{
    protected $_errors     = array();
    protected $_options    = array();
    protected $_validators = array();


    protected $_html_attributes = array();

    protected $_form_name;

    protected $_name;
    protected $_value;

    public function __construct($options=array())
    {

        $this->_options    = $options;

        if(isset($options["validators"]))
        {
            $this->_validators = $options["validators"];
            unset($this->_options["validators"]);
        }
    }

    public function configure($name, $form_name)
    {
        $this->_name       = $name;
        $this->_form_name  = $form_name;


        $this->checkOptionsRequisites();
        $this->configureHTMLAttributes();
    }


    public function reset()
    {
        $this->setValue(null);
    }

    public function getOptions()
    {
        return $this->_options;
    }

    public function getValidators()
    {
        return $this->_validators;
    }

    public function getErrors()
    {
        return $this->_errors;
    }


    /**
     * Override this method in order to check the required options
     * @return bool
     */
    protected function checkOptionsRequisites()
    {
        return true;
    }


    protected function configureHTMLAttributes()
    {


        if (isset($this->_options["required"])) {
            if ($this->_options["required"]) {
                $this->_html_attributes["required"] = "required";
                $this->_validators[] = new NotEmpty();
            }

            unset($this->_options["required"]);
        } else {
            $this->_html_attributes["required"] = "required";
            $this->_validators[] = new NotEmpty();
        }

        $this->_html_attributes["id"]   = $this->_form_name . "_" . $this->_name;
        $this->_html_attributes["name"] = $this->_form_name . "[" . $this->_name . "]";

        foreach ($this->_options as $key=>$option) {
            $this->_html_attributes[$key] = $option;
        }
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getAttributesArray()
    {
        return $this->_html_attributes;
    }

    public function getAttributes()
    {
        $html = " ";
        foreach ($this->_html_attributes as $key=>$value) {
            $html .= ' ' .  $key . '="' . $value . '"';
        }


        return $html;
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function setValue($value)
    {
        $this->_value = $value;
    }


    public function bind($value)
    {
        $this->reset();

        $this->setValue($value);

        $this->_errors = array();

        /**
         * @var $validator AbstractValidator
         */
        foreach ($this->_validators as $validator) {
            if (is_array($value)) {
                foreach ($value as $_value) {
                    if (!$validator->isValid($_value)) {
                        foreach ($validator->getMessages() as $i=>$message) {
                            $this->_errors[] = $message;
                        }
                    }
                }
            } else {
                if (!$validator->isValid($value)) {
                    foreach ($validator->getMessages() as $i=>$message) {
                        $this->_errors[] = $message;
                    }
                }
            }
        }

        if (count($this->_errors)) {
            if (!isset($this->_html_attributes["class"])) {
                $this->_html_attributes["class"] = "";
            }

            $this->_html_attributes["class"] .= " error";
        }

        return !count($this->_errors);
    }


    public function __toString()
    {
        return $this->getLabelTag() . $this->getInputTag() . $this->getErrorTag();
    }

    public function getLabelTag($label=null)
    {
        $label = isset($this->_options["label"]) ? $this->_options["label"] : ($label ? $label :$this->_name);
        return '<label for="' . $this->_form_name . '_'. $this->_name .'">' . $label . '</label>';
    }

    public function hasError()
    {
        return count($this->_errors);
    }

    public function getErrorArray()
    {
        return $this->_errors;
    }

    public function getErrorTag()
    {
        if ($this->hasError()) {
            $html = "";
            foreach ($this->getErrorArray() as $key=>$error) {
                $html .= '<span class="error">' . $error . '</span>';
            }
            return $html;
        }

        return null;
    }

    abstract public function getInputTag();
}
