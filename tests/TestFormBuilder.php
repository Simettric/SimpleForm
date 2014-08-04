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

class TestFormBuilder extends UnitTestCase {


    function createFormBuilder(){

        $config = new \SimpleForm\Config();
        $config->addFieldDefinition("test_field", "\\SomeTestField");
        return new \SimpleForm\FormBuilder($config);

    }


    function testCreateFormFromBuilder() {


        $builder = $this->createFormBuilder();

        $form = $builder->create("test")->getForm();


        $this->assertTrue($form instanceof \SimpleForm\Form);
        $this->assertEqual("test",$form->getName());

    }

    function testAddSomeField() {


        $builder = $this->createFormBuilder();

        $form = $builder->create("test")->add("test", "test_field")->getForm();


        $this->assertTrue($form["test"] instanceof \SimpleForm\Field\AbstractField);

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