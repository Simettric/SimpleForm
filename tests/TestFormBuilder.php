<?php

namespace SimpleForm\Test;


use SimpleForm\Field\AbstractField;
use SimpleForm\Form;

class TestFormBuilder extends \PHPUnit_Framework_TestCase {


    function createFormBuilder(){

        $config = new \SimpleForm\Config();
        $config->addFieldDefinition("test_field", "SimpleForm\\Test\\Mock\\SomeTestField");
        return new \SimpleForm\FormBuilder($config);

    }


    function testCreateFormFromBuilder() {


        $builder = $this->createFormBuilder();

        $form = $builder->create("test")->getForm();


        $this->assertTrue($form instanceof Form);
        $this->assertEquals("test",$form->getName());

    }

    function testAddSomeField() {


        $builder = $this->createFormBuilder();

        $form = $builder->create("test")->add("test", "test_field")->getForm();


        $this->assertTrue($form["test"] instanceof AbstractField);

    }

    function testRemoveSomeField() {


        $builder = $this->createFormBuilder();

        $builder->create("test")->add("test", "test_field");


        $form = $builder->getForm();

        $this->assertTrue($form->offsetExists("test"));

        $builder->remove("test");

        $this->assertFalse($form->offsetExists("test"));

    }






}