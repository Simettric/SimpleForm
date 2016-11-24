<?php

namespace SimpleForm\Test;

use SimpleForm\Field\InputTypeField;
use Zend\Validator\NotEmpty;

class TestInputTypeField extends \PHPUnit_Framework_TestCase
{

    public function testGetInputTag()
    {
        $field = new InputTypeField();
        $field->configure("inputs", "test_form" );


        $html = '<input type="text" value=""   required="required" id="test_form_inputs" name="test_form[inputs]">';

        $this->assertEquals($html, $field->getInputTag());
    }

    public function testValidator()
    {
        $inputs = array("type" => "text");
        $field = new InputTypeField($inputs);
        $field->configure("inputs", "test_form" );

        $this->assertCount(1, $field->getValidators());

        $has_constraint = false;
        foreach ($field->getValidators() as $validator) {
            if ($validator instanceof NotEmpty) {
                $has_constraint = $validator;
                break;
            }
        }
        $this->assertTrue($has_constraint != false);



        $field->bind("value");
        $this->assertCount(0, $field->getErrors());


        $field->bind("");
        $this->assertCount(1, $field->getErrors());
    }

    public function testFailedChoiceErrors()
    {
        $builder = new \SimpleForm\FormBuilder();

        $field   = new InputTypeField();

        $form    = $builder->create("test")->add("test_inputs", $field)->getForm();

        $form->bind(array("test_inputs"=> ''));

        $this->assertFalse($form->isValid());

        foreach ($form->getErrors() as $key=>$error) {
            $this->assertEquals($key, "test_inputs");
            return;
        }
    }

    public function testGetInputTagToString()
    {
        $field = new InputTypeField();
        $field->configure("inputs", "test_form" );


        $html = '<label for="test_form_inputs">inputs</label><input type="text" value=""   required="required" id="test_form_inputs" name="test_form[inputs]">';

        $this->assertEquals($html,  $field->__toString());
    }

    public function testGetInputTagToStringCheckbox()
    {

        $field = new InputTypeField(array("type"=>"checkbox"));
        $field->configure("inputs", "test_form" );


        $html = '<label for="test_form_inputs"><input type="checkbox" value=""   required="required" id="test_form_inputs" name="test_form[inputs]"> inputs</label>';

        $this->assertEquals($html,  $field->__toString());
    }

    public function testGetInputTagToStringCheckboxChecked()
    {

        $field = new InputTypeField(array("type"=>"checkbox"));
        $field->setValue(1);
        $field->configure("inputs", "test_form" );

        $html = '<label for="test_form_inputs"><input type="checkbox" value=""   required="required" id="test_form_inputs" name="test_form[inputs]" checked="checked"> inputs</label>';

        $this->assertEquals($html,  $field->__toString());
    }

}
