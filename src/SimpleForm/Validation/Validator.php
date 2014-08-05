<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 5/08/14
 * Time: 17:01
 */

namespace SimpleForm\Validation;


use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator implements ValidatorInterface {
    /**
     * Validates a value against a constraint or a list of constraints.
     *
     * If no constraint is passed, the constraint
     * {@link \Symfony\Component\Validator\Constraints\Valid} is assumed.
     *
     * @param mixed                   $value       The value to validate
     * @param Constraint|Constraint[] $constraints The constraint(s) to validate
     *                                             against
     * @param array|null              $groups      The validation groups to
     *                                             validate. If none is given,
     *                                             "Default" is assumed
     *
     * @return ConstraintViolationListInterface A list of constraint violations.
     *                                          If the list is empty, validation
     *                                          succeeded
     */
    public function validate($value, $constraints = null, $groups = null){}

    /**
     * Validates a property of an object against the constraints specified
     * for this property.
     *
     * @param object     $object       The object
     * @param string     $propertyName The name of the validated property
     * @param array|null $groups       The validation groups to validate. If
     *                                 none is given, "Default" is assumed
     *
     * @return ConstraintViolationListInterface A list of constraint violations.
     *                                          If the list is empty, validation
     *                                          succeeded
     */
    public function validateProperty($object, $propertyName, $groups = null){}

    /**
     * Validates a value against the constraints specified for an object's
     * property.
     *
     * @param object|string $objectOrClass The object or its class name
     * @param string        $propertyName  The name of the property
     * @param mixed         $value         The value to validate against the
     *                                     property's constraints
     * @param array|null    $groups        The validation groups to validate. If
     *                                     none is given, "Default" is assumed
     *
     * @return ConstraintViolationListInterface A list of constraint violations.
     *                                          If the list is empty, validation
     *                                          succeeded
     */
    public function validatePropertyValue($objectOrClass, $propertyName, $value, $groups = null){}

    /**
     * Starts a new validation context and returns a validator for that context.
     *
     * The returned validator collects all violations generated within its
     * context. You can access these violations with the
     * {@link ContextualValidatorInterface::getViolations()} method.
     *
     * @return ContextualValidatorInterface The validator for the new context
     */
    public function startContext(){

    }

    /**
     * Returns a validator in the given execution context.
     *
     * The returned validator adds all generated violations to the given
     * context.
     *
     * @param ExecutionContextInterface $context The execution context
     *
     * @return ContextualValidatorInterface The validator for that context
     */
    public function inContext(ExecutionContextInterface $context){

    }


    /**
     * Returns the strategy for cascading objects.
     *
     * @return int     The cascading strategy
     *
     * @see CascadingStrategy
     */
    public function getCascadingStrategy(){

    }

    /**
     * Returns the strategy for traversing traversable objects.
     *
     * @return int     The traversal strategy
     *
     * @see TraversalStrategy
     */
    public function getTraversalStrategy(){

    }
} 