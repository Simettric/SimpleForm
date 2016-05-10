<?php
namespace SimpleForm\Test;


use SimpleForm\Config;
use SimpleForm\Field\AbstractField;
use SimpleForm\Form;
use SimpleForm\FormBuilder;
use SimpleForm\Test\Mock\SomeFormTest;

class TestForm extends \PHPUnit_Framework_TestCase {


    function createFormBuilder(){

        $config = new Config();
        $config->addFieldDefinition("test_field", "SimpleForm\\Test\\Mock\\SomeTestField");
        return new FormBuilder($config);

    }

    function testGetFormName() {


        $builder = $this->createFormBuilder();

        $form = $builder->create("test")->getForm();


        $this->assertTrue($form instanceof Form);
        $this->assertEquals("test",$form->getName());

    }


    function testFormIterableAndAccesible() {


        $builder = $this->createFormBuilder()->create("test");

        $fields = array("field1", "field2");

        foreach($fields as $field){
            $builder->add($field, "test_field");
        }


        $form = $builder->getForm();

        foreach($fields as $field){
            $this->assertTrue($form[$field] instanceof AbstractField);
        }


    }

    function testGetFormValue() {

        $builder = $this->createFormBuilder();

        $form = $builder->create("test", array("need_a_value"=>"value"))->add("need_a_value", "test_field")->getForm();

        $this->assertEquals("value",$form->getValue("need_a_value"));
        $this->assertEquals("value",$form["need_a_value"]->getValue());

    }



    function testFormClass(){

        $form = new SomeFormTest(array("test_field"=>"value", "test_choice"=>"key_test"), $this->createFormBuilder());

        $this->assertEquals("test_form",$form->getName());
        $this->assertEquals("value",$form->getValue("test_field"));
        $this->assertEquals("value",$form["test_field"]->getValue());
        $this->assertEquals("key_test",$form["test_choice"]->getValue());
    }



    function testFormIsValid(){

        $form = new SomeFormTest(array(), $this->createFormBuilder());

        $form->bind(array("test_field"=>"value", "test_choice"=>"key_test"));

        $this->assertEquals("test_form",$form->getName());
        $this->assertEquals("value",$form->getValue("test_field"));
        $this->assertEquals("value",$form["test_field"]->getValue());
        $this->assertEquals("key_test",$form["test_choice"]->getValue());



        $this->assertTrue($form->isValid());

        $form->bind(array("test_field"=>"value", "test_choice"=>"key_test2"));

        $this->assertFalse($form->isValid());
    }

    function testGetErrors(){

        $builder = $this->createFormBuilder();

        $form = $builder->create("test")->add("test_notblank")->getForm();

        $form->bind(array("test_notblank"=>null));

        $this->assertFalse($form->isValid());


        foreach($form->getErrors() as $key=>$error){
            $this->assertEquals($key, "test_notblank");
            return;
        }



    }











}