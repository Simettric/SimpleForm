<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 19:07
 */

class SomeFormTest extends \SimpleForm\Form {

    function configure(){

        $this->setName("test_form");

        $this->getBuilder()->add("test_field", "test_field", array());

    }

} 