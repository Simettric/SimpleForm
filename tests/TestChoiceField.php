<?php

namespace SimpleForm\Test;


use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Validation;

class TestChoiceField extends \PHPUnit_Framework_TestCase {



    private $validator_context;

    function setUp(){
        $translator = new Translator("en_US");
        $this->validator_context = new ExecutionContext(Validation::createValidator(), "root", $translator);
    }



    function testGetInputTagSelectSingle() {


        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=>array("value"=>"test_option")));


        $html = '<select   required="required" id="test_form_choice" name="test_form[choice]"><option value="value">test_option</option></select>';

        $this->assertEquals($html, $field->getInputTag());


    }

    function testGetInputTagSelectMultiple() {


        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=>array("value"=>"test_option"), "multiple"=>true));


        $html = '<select   required="required" id="test_form_choice" name="test_form[choice]" multiple="multiple"><option value="value">test_option</option></select>';

        $this->assertEquals($html, $field->getInputTag());


    }

    function testGetInputTagCheckboxes() {


        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=>array("value"=>"test_option"), "multiple"=>true, "expanded"=>true));


        $html = '<p   required="required" id="test_form_choice_value" class=" choice-item"><label><input type="checkbox" name="test_form[choice][]"  value="value"/> test_option</label></p>';

        $this->assertEquals($html, $field->getInputTag());


    }

    function testGetInputTagRadios() {


        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=>array("value"=>"test_option"), "multiple"=>false, "expanded"=>true));


        $html = '<p   required="required" id="test_form_choice_value" class=" choice-item"><label><input type="radio" name="test_form[choice]"  value="value"/> test_option</label></p>';

        $this->assertEquals($html, $field->getInputTag());


    }

    function testValidator() {

        $choices = array("value"=>"test_option");

        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=> $choices, "multiple"=>false, "expanded"=>true));


        $this->assertCount(2, $field->getValidators());

        $has_constraint = false;
        foreach($field->getValidators() as $constraint){
            if($constraint instanceof \Symfony\Component\Validator\Constraints\Choice){
                $has_constraint = $constraint;
                break;
            }
        }
        $this->assertTrue($has_constraint != false);


        $this->assertEquals(array_keys($choices), $has_constraint->choices);

        $field->bind("value", $this->validator_context);
        $this->assertCount(0, $field->getErrors());

        $field->bind("bad_value", $this->validator_context);
        $this->assertCount(1, $field->getErrors());



    }

    function testFailedChoiceErrors(){

        $config = new \SimpleForm\Config();
        $builder = new \SimpleForm\FormBuilder($config);
        $form = $builder->create("test")->add(
            "test_choice",
            "choice",
            array( "choices"=>array(1=>"test") )
        )->getForm();

        $form->bind(array("test_choice"=>-1));

        $this->assertFalse($form->isValid());

        foreach($form->getErrors() as $key=>$error){
            $this->assertEquals($key, "test_choice");
            return;
        }
    }

    function testChoiceValidator(){

        $config = new \SimpleForm\Config();
        $builder = new \SimpleForm\FormBuilder($config);
        $form = $builder->create("test")->add(
            "test_choice",
            "choice",
            array( "choices"=>array("audio"=>"Audio") )
        )->getForm();

        $form->bind(array("test_choice"=>"audio"));

        $this->assertTrue($form->isValid());


    }



}