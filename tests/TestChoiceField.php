<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 17:52
 */

require_once( __DIR__ . '/../vendor/autoload.php');
require_once( __DIR__ . '/../vendor/simpletest/simpletest/autorun.php');
require_once( __DIR__ . '/classes/MockExecutionContext.php');

class TestChoiceField extends UnitTestCase {







    function testGetInputTagSelectSingle() {


        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=>array("value"=>"test_option")));


        $html = '<select   required="required" id="test_form_choice" name="test_form[choice]"><option value="value">test_option</option></select>';

        $this->assertEqual($html, $field->getInputTag());


    }

    function testGetInputTagSelectMultiple() {


        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=>array("value"=>"test_option"), "multiple"=>true));


        $html = '<select   required="required" id="test_form_choice" name="test_form[choice]" multiple="multiple"><option value="value">test_option</option></select>';

        $this->assertEqual($html, $field->getInputTag());


    }

    function testGetInputTagCheckboxes() {


        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=>array("value"=>"test_option"), "multiple"=>true, "expanded"=>true));


        $html = '<p   required="required" id="test_form_choice_value" class=" choice-item"><label><input type="checkbox" name="test_form[choice][]"  value="value"/> test_option</label></p>';

        $this->assertEqual($html, $field->getInputTag());


    }

    function testGetInputTagRadios() {


        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=>array("value"=>"test_option"), "multiple"=>false, "expanded"=>true));


        $html = '<p   required="required" id="test_form_choice_value" class=" choice-item"><label><input type="radio" name="test_form[choice]"  value="value"/> test_option</label></p>';

        $this->assertEqual($html, $field->getInputTag());


    }

    function testValidator() {

        $choices = array("value"=>"test_option");

        $field = new \SimpleForm\Field\ChoiceField("choice", "test_form", array("choices"=> $choices, "multiple"=>false, "expanded"=>true));


        $this->assertTrue(count($field->getValidators()));

        $has_constraint = false;
        foreach($field->getValidators() as $constraint){
            if($constraint instanceof \Symfony\Component\Validator\Constraints\Choice){
                $has_constraint = $constraint;
                break;
            }
        }
        $this->assertTrue($has_constraint != false);


        $this->assertEqual(array_keys($choices), $has_constraint->choices);







    }





}