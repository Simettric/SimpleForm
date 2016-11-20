<?php

namespace SimpleForm\Test;

use SimpleForm\Field\ChoiceField;
use Zend\Validator\InArray;

class TestChoiceField extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }



    public function testGetInputTagSelectSingle()
    {
        $field = new \SimpleForm\Field\ChoiceField(array("choices"=>array("test_option"=>"value")));
        $field->configure("choice", "test_form" );


        $html = '<select   required="required" id="test_form_choice" name="test_form[choice]"><option value="value">test_option</option></select>';

        $this->assertEquals($html, $field->getInputTag());
    }

    public function testEmptyOption()
    {
        $field = new \SimpleForm\Field\ChoiceField(array("choices"=>array("test_option"=>"value"), "empty_option"=>"test"));
        $field->configure("choice", "test_form");

        $html = '<select   required="required" id="test_form_choice" name="test_form[choice]"><option value="">test</option><option value="value">test_option</option></select>';

        $this->assertEquals($html, $field->getInputTag());
    }

    public function testGetInputTagSelectMultiple()
    {
        $field = new \SimpleForm\Field\ChoiceField(array("choices"=>array("test_option"=>"value"), "multiple"=>true));
        $field->configure("choice", "test_form");

        $html = '<select   required="required" id="test_form_choice" name="test_form[choice]" multiple="multiple"><option value="value">test_option</option></select>';

        $this->assertEquals($html, $field->getInputTag());
    }

    public function testGetInputTagCheckboxes()
    {
        $field = new \SimpleForm\Field\ChoiceField(array("choices"=>array("test_option"=>"value"), "multiple"=>true, "expanded"=>true));
        $field->configure("choice", "test_form");

        $html = '<p   required="required" id="test_form_choice_value" class=" choice-item"><label><input type="checkbox" name="test_form[choice][]"  value="value"/> test_option</label></p>';

        $this->assertEquals($html, $field->getInputTag());
    }

    public function testGetInputTagRadios()
    {
        $field = new \SimpleForm\Field\ChoiceField(array("choices"=>array("test_option"=>"value"), "multiple"=>false, "expanded"=>true));
        $field->configure("choice", "test_form");

        $html = '<p   required="required" id="test_form_choice_value" class=" choice-item"><label><input type="radio" name="test_form[choice]"  value="value"/> test_option</label></p>';

        $this->assertEquals($html, $field->getInputTag());
    }

    public function testValidator()
    {
        $choices = array("test_option"=>"value");

        $field = new \SimpleForm\Field\ChoiceField(array("choices"=> $choices, "multiple"=>false, "expanded"=>true));
        $field->configure("choice", "test_form");

        $this->assertCount(2, $field->getValidators());

        $has_constraint = false;
        foreach ($field->getValidators() as $validator) {
            if ($validator instanceof InArray) {
                $has_constraint = $validator;
                break;
            }
        }
        $this->assertTrue($has_constraint != false);


        $this->assertEquals(array_values($choices), $has_constraint->getHaystack());

        $field->bind("value");
        $this->assertCount(0, $field->getErrors());


        $field->bind("bad_value");
        $this->assertCount(1, $field->getErrors());
    }

    public function testFailedChoiceErrors()
    {
        $builder = new \SimpleForm\FormBuilder();

        $field   = new ChoiceField(array( "choices"=>array("test"=>1) ));

        $form    = $builder->create("test")->add("test_choice", $field)->getForm();

        $form->bind(array("test_choice"=>-1));

        $this->assertFalse($form->isValid());

        foreach ($form->getErrors() as $key=>$error) {
            $this->assertEquals($key, "test_choice");
            return;
        }
    }

    public function testChoiceValidator()
    {
        $builder = new \SimpleForm\FormBuilder();
        $form = $builder->create("test")->add(
            "test_choice",
            new ChoiceField(array( "choices"=>array("Audio"=>"audio") ))
        )->getForm();

        $form->bind(array("test_choice"=>"audio"));

        $this->assertTrue($form->isValid());
    }

    public function testChoiceRequiredValidator()
    {
        $builder = new \SimpleForm\FormBuilder();
        $form = $builder->create("test")->add(
            "test_choice",
            new ChoiceField(array( "choices"=>array("Audio"=>"audio") ))
        )->getForm();

        $form->bind(array("test_choice"=>""));

        $this->assertFalse($form->isValid());

        $builder = new \SimpleForm\FormBuilder();
        $form = $builder->create("test")->add(
            "test_choice",
            new ChoiceField(array( "choices"=>array("Audio"=>"audio"), "required"=>false ))
        )->getForm();

        $this->assertCount(0, $form["test_choice"]->getValidators());

        $form->bind(array("test_choice"=>""));

        $this->assertTrue($form->isValid());

        $builder = new \SimpleForm\FormBuilder();
        $form = $builder->create("test")->add(
            "test_choice",
            new ChoiceField(array( "choices"=>array("audio"=>"Audio"), "required"=>true ))
        )->getForm();

        $this->assertCount(2, $form["test_choice"]->getValidators());

        $form->bind(array());


        $this->assertFalse($form->isValid());
    }
}
