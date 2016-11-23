<?php
/**
 * The Input Text Field.
 *
 * It creates an input type text html tag. It is the field type used by default by the Form Builder.
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm\Field;

class TextField extends AbstractField
{
    public function getInputTag()
    {
        return '<input type="text" value="' . $this->getValue() . '" ' . $this->getAttributes() . '>';
    }
}
