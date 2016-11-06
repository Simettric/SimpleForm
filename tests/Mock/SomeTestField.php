<?php

namespace SimpleForm\Test\Mock;

use SimpleForm\Field\AbstractField;

class SomeTestField extends AbstractField
{
    public function getInputTag()
    {
        return '<input type="text" id="' . $this->_form_name . '_' . $this->getName() . '"  name="' . $this->_form_name . '[' . $this->getName() . ']" value="' . $this->getValue() . '">';
    }
}
