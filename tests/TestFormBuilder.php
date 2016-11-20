<?php

namespace SimpleForm\Test;

use SimpleForm\AbstractForm;
use SimpleForm\Field\AbstractField;
use SimpleForm\Test\Mock\SomeTestField;

class TestFormBuilder extends \PHPUnit_Framework_TestCase
{
    public function createFormBuilder()
    {
        return new \SimpleForm\FormBuilder();
    }


    public function testCreateFormFromBuilder()
    {
        $builder = $this->createFormBuilder();

        $form = $builder->create("test")->getForm();


        $this->assertTrue($form instanceof AbstractForm);
        $this->assertEquals("test", $form->getName());
    }

    public function testAddSomeField()
    {
        $builder = $this->createFormBuilder();

        $form = $builder->create("test")->add("test", new SomeTestField())->getForm();


        $this->assertTrue($form["test"] instanceof AbstractField);
    }

    public function testRemoveSomeField()
    {
        $builder = $this->createFormBuilder();

        $builder->create("test")->add("test", new SomeTestField());


        $form = $builder->getForm();

        $this->assertTrue($form->offsetExists("test"));

        $builder->remove("test");

        $this->assertFalse($form->offsetExists("test"));
    }
}
