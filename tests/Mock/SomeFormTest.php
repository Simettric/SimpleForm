<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 19:07
 */
namespace SimpleForm\Test\Mock;

use SimpleForm\Field\ChoiceField;
use SimpleForm\Field\TextField;
use SimpleForm\FormBuilder;

class SomeFormTest extends \SimpleForm\AbstractForm
{
    public function configure(FormBuilder $builder)
    {
        $this->setName("test_form");

        $builder->add("test_field", new TextField(array()))
            ->add("test_choice", new ChoiceField(array(
                "choices"=>array("Test"=>"key_test")
            )));
    }
}
