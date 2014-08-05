<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 21:13
 */

namespace SimpleForm\Field;


class TextareaField extends AbstractField {

    function getInputTag(){

        return '<textarea ' . $this->getAttributes() . '>' . $this->getValue() . '</textarea>';

    }

}