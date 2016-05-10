<?php
/**
 * Created by Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm\Field;


class TextareaField extends AbstractField {

    function getInputTag(){

        return '<textarea ' . $this->getAttributes() . '>' . $this->getValue() . '</textarea>';

    }

}