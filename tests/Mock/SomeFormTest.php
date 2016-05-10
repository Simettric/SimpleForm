<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 19:07
 */
namespace SimpleForm\Test\Mock;

class SomeFormTest extends \SimpleForm\AbstractForm {

    function configure(){

        $this->setName("test_form");

        $this->getBuilder()->add("test_field", "test_field", array())
            ->add("test_choice", "choice", array(
                "choices"=>array("key_test"=>"Test")
            ));

    }

} 