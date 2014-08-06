<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 6/08/14
 * Time: 11:02
 */

class MockExecutionContext extends \Symfony\Component\Validator\Context\ExecutionContext{


    public $mock;
    protected $mocked_methods = array('getViolations');

    function __construct() {
        $this->mock = new SimpleMock();
        $this->mock->disableExpectationNameChecks();
    }

    function getViolations() {
        $result = &$this->mock->invoke("getViolations");
        return $result;
    }



} 