<?php
/**
 * The Textarea Form Field.
 *
 * It creates an textarea html tag.
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm\Field;

class TextareaField extends AbstractField
{
    public function getInputTag()
    {
        return '<textarea ' . $this->getAttributes() . '>' . $this->getValue() . '</textarea>';
    }
}
