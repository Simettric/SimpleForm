<?php
namespace SimpleForm\Test;

use SimpleForm\Field\TextareaField;

class TestTextareaField extends \PHPUnit_Framework_TestCase
{

    public function testGetInputTag()
    {
        $field = new TextareaField();
        $field->configure("inputs", "test_form");

        $html = '<textarea   required="required" id="test_form_inputs" name="test_form[inputs]"></textarea>';

        $this->assertEquals($html, $field->getInputTag());
    }
}