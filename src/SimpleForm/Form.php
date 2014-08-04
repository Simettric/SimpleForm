<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 15:24
 */

namespace SimpleForm;


use SimpleForm\Exception\FieldNotConfiguredException;
use SimpleForm\Field\AbstractField;

class Form implements \Iterator, \ArrayAccess {


    protected $_fields     = array();

    protected $_has_errors = false;

    protected $_name;

    protected $_data;

    /**
     * @var FormBuilder
     */
    protected $_builder;

    function __construct($data, FormBuilder $builder){

        $this->_data    = $data;
        $this->_builder = $builder;
        $this->configure();



    }

    function configure(){ }


    function setName($name){
        $this->_name = $name;
    }

    function getName(){
        return $this->_name;
    }

    /**
     * @return FormBuilder
     */
    function getBuilder(){
        return $this->_builder->create($this);
    }


    function addField(AbstractField $field){

        if(isset($this->_data[$field->getName()])){
            $field->setValue($this->_data[$field->getName()]);
        }

        $this->_fields[$field->getName()] = $field;



    }

    function getValue($key){
        return $this->offsetGet($key)->getValue();
    }

    function getValues(){
        $values = array();
        foreach($this->_fields as $key=>$field){
            $values[] = $field->getValue();
        }
        return $values;
    }

    function bind(array $array){
        foreach($array as $key=>$value){
            if(!$this->offsetGet($key)->bind($value)){
                $this->_has_errors = true;
            }
        }
    }

    function isValid(){
        return $this->_has_errors == false;
    }


    function rewind() {
        reset($this->_fields);
    }

    function current() {
        return current($this->_fields);
    }

    function key() {
        return key($this->_fields);
    }

    function next() {
        next($this->_fields);
    }

    function valid() {
        return key($this->_fields) !== null;
    }



   function offsetExists (  $offset ){
        return isset($this->_fields[$offset]);
   }


    /**
     * @param mixed $offset
     * @return AbstractField
     * @throws Exception\FieldNotConfiguredException
     */
    function offsetGet (  $offset ){

        if($this->offsetExists($offset)) {

            return $this->_fields[$offset];

        }else{

            throw new FieldNotConfiguredException();

        }

   }


   function offsetSet (  $offset ,  $value ){
        //todo: exception
   }


   function offsetUnset (  $offset ){
       $this->_fields[$offset] = null;
       unset($this->_fields[$offset]);
   }




} 