<?php
/**
 * Created by Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm\Field;

class TextField extends AbstractField
{
    public function getInputTag()
    {
        return '<input type="text" value="' . $this->getValue() . '" ' . $this->getAttributes() . '>';
    }
}
