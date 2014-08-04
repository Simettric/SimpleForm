<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 17:52
 */

ini_set("display_errors", true);

require_once( __DIR__ . '/../vendor/autoload.php');
require_once( __DIR__ . '/../vendor/simpletest/simpletest/autorun.php');
require_once( __DIR__ . '/classes/SomeTestField.php');
require_once( __DIR__ . '/classes/SomeFormTest.php');


class TestForm extends UnitTestCase {


    function createFormBuilder(){

        $config = new \SimpleForm\Config();
        $config->addFieldDefinition("test_field", "\\SomeTestField");
        return new \SimpleForm\FormBuilder($config);

    }

    function testGetFormName() {


        $builder = $this->createFormBuilder();

        $form = $builder->create("test")->getForm();


        $this->assertTrue($form instanceof \SimpleForm\Form);
        $this->assertEqual("test",$form->getName());

    }


    function testFormIterableAndAccesible() {


        $builder = $this->createFormBuilder()->create("test");

        $fields = array("field1", "field2");

        foreach($fields as $field){
            $builder->add($field, "test_field");
        }


        $form = $builder->getForm();

        foreach($fields as $field){
            $this->assertTrue($form[$field] instanceof \SimpleForm\Field\AbstractField);
        }


    }

    function testGetFormValue() {


        $builder = $this->createFormBuilder();

        $form = $builder->create("test", array("need_a_value"=>"value"))->add("need_a_value", "test_field")->getForm();

        $this->assertEqual("value",$form->getValue("need_a_value"));
        $this->assertEqual("value",$form["need_a_value"]->getValue());

    }

    function testFormClass(){

        $form = new SomeFormTest(array("test_field"=>"value"), $this->createFormBuilder());

        $this->assertEqual("test_form",$form->getName());
        $this->assertEqual("value",$form->getValue("test_field"));
        $this->assertEqual("value",$form["test_field"]->getValue());
    }









}