<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 21:10
 */

namespace SimpleForm\Field;


class ChoiceField extends AbstractField {

    function getInputTag(){

        return '<input type="text" value="' . $this->getValue() . '" ' . $this->getAttributes() . '>';

    }



} 