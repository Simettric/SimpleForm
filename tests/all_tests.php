<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 17:51
 */

ini_set("display_errors", true);


require_once( __DIR__ . '/../vendor/autoload.php');
require_once( __DIR__ . '/../vendor/simpletest/simpletest/autorun.php');
require_once( __DIR__ . '/classes/SomeTestField.php');


class AllTests extends TestSuite {

    function __construct() {
        parent::__construct();
        $this->addFile(__DIR__ . '/TestFormBuilder.php');
        $this->addFile(__DIR__ . '/TestField.php');
        $this->addFile(__DIR__ . '/TestForm.php');
        $this->addFile(__DIR__ . '/TestChoiceField.php');
    }

    /*function AllTests() {
        $this->TestSuite('All tests');
        $this->addFile(__DIR__ . '/TestFormBuilder.php');
        $this->addFile(__DIR__ . '/TestField.php');
        $this->addFile(__DIR__ . '/TestForm.php');
        $this->addFile(__DIR__ . '/TestChoiceField.php');
    }*/
}
