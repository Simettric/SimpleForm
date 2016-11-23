<?php
namespace SimpleForm\Test;

use SimpleForm\Field\TextField;

class TestTextField extends \PHPUnit_Framework_TestCase
{

    public function testGetInputTag()
    {
        $field = new TextField();
        $field->configure("inputs", "test_form");

        $html = '<input type="text" value=""   required="required" id="test_form_inputs" name="test_form[inputs]">';

        $this->assertEquals($html, $field->getInputTag());
    }
}