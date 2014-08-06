<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 17:52
 */

require_once( __DIR__ . '/../vendor/autoload.php');
require_once( __DIR__ . '/../vendor/simpletest/simpletest/autorun.php');
require_once( __DIR__ . '/classes/SomeTestField.php');
require_once( __DIR__ . '/classes/MockExecutionContext.php');

class TestField extends UnitTestCase {





    function testCreateDefault() {


        $field = new SomeTestField("test_field", "test_form");

        $attributes = $field->getAttributesArray();
        $validators = $field->getValidators();

        $this->assertTrue(isset($attributes["required"]) && $attributes["required"]=="required");
        $this->assertTrue(false !== array_search(new \Symfony\Component\Validator\Constraints\NotNull(), $validators));


    }


    function testCreateOptional() {


        $field = new SomeTestField("test_field", "test_form", array("required"=>false));

        $attributes = $field->getAttributesArray();
        $validators = $field->getValidators();

        $this->assertFalse(isset($attributes["required"]));
        $this->assertFalse(count($validators));


    }


    function testValue() {


        $field = new SomeTestField("test_field", "test_form", array("required"=>false));
        $field->setValue("whatever");


        $this->assertEqual("whatever", $field->getValue());

        $field->bind("test", new MockExecutionContext());


        $this->assertEqual("test", $field->getValue());

    }

    function testGetLabelTag() {


        $field = new SomeTestField("test_field", "test_form", array("required"=>false));

        $this->assertEqual('<label for="test_form_test_field">test_field</label>', $field->getLabelTag());
        $this->assertEqual('<label for="test_form_test_field">Test</label>', $field->getLabelTag("Test"));

    }

    function testGetInputTag() {


        $field = new SomeTestField("test_field", "test_form", array("required"=>false));

        $field->setValue("test");
        $this->assertEqual('<input type="text" id="test_form_test_field"  name="test_form[test_field]" value="test">', $field->getInputTag());

    }

    function testRederField(){
        $field = new SomeTestField("test_field", "test_form", array("required"=>false));

        $field->setValue("test");

        $label = '<label for="test_form_test_field">test_field</label>';
        $input = '<input type="text" id="test_form_test_field"  name="test_form[test_field]" value="test">';
        $this->assertEqual($label.$input, (string) $field);
    }



}