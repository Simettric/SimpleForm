<?php
/**
 * Created by Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm\Field;

class InputTypeField extends AbstractField
{
    protected function _configureHTMLAttributes()
    {
        parent::configureHTMLAttributes();
        unset($this->_html_attributes["type"]);
    }

    public function __toString()
    {
        $type = isset($this->_options["type"])? $this->_options["type"] :"text";

        if ($type=="checkbox" || $type=="radio") {
            $label = isset($this->_options["label"]) ? $this->_options["label"] : $this->_name;

            $checked_value = isset($this->_options["checked_value"]) ? $this->_options["checked_value"] : '';
            unset($this->_html_attributes["checked_value"]);

            if ($this->getValue()) {
                $this->_html_attributes["checked"] = "checked";
            } else {
                unset($this->_html_attributes["checked"]);
            }

            $this->setValue($checked_value);

            return '<label for="' . $this->_form_name . '_'. $this->_name .'">' . $this->getInputTag() . " " .$label . '</label>';
        }

        return parent::__toString();
    }

    public function getInputTag()
    {
        $type = isset($this->_options["type"])? $this->_options["type"] :"text";

        return '<input type="'. $type .'" value="' . $this->getValue() . '" ' . $this->getAttributes() . '>';
    }
}
