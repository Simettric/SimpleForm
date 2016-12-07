<?php
/**
 * Mock class used in the tests
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */
namespace SimpleForm\Test\Mock;

use SimpleForm\Field\ChoiceField;
use SimpleForm\Field\TextField;
use SimpleForm\FormBuilder;

class SomeTestForm extends \SimpleForm\AbstractForm
{
    public function configure(FormBuilder $builder)
    {

        $builder->add("test_field", new TextField(array()))
            ->add("test_choice", new ChoiceField(array(
                "choices"=>array("Test"=>"key_test")
            )));
    }

    public function getName()
    {
        return 'test_form';
    }
}
