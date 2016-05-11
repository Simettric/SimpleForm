<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 19:07
 */
namespace SimpleForm\Test\Mock;

use SimpleForm\FormBuilder;

class SomeFormTest extends \SimpleForm\AbstractForm {

    function configure(FormBuilder $builder){

        $this->setName("test_form");

        $builder->add("test_field", "test_field", array())
            ->add("test_choice", "choice", array(
                "choices"=>array("key_test"=>"Test")
            ));

    }

} 