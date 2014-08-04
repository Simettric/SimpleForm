<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 17:54
 */




class SomeTestField extends SimpleForm\Field\AbstractField {


    function getInputTag(){
        return '<input type="text" id="' . $this->_form_name . '_' . $this->getName() . '"  name="' . $this->_form_name . '[' . $this->getName() . ']" value="' . $this->getValue() . '">';
    }

} 