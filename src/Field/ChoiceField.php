<?php
/**
 * Created by PhpStorm.
 * User: Asier
 * Date: 4/08/14
 * Time: 21:10
 */

namespace SimpleForm\Field;


use Symfony\Component\Validator\Constraints\Choice;

class ChoiceField extends AbstractField {


    function _checkOptionsRequisites(){

        if(!isset($this->_options["multiple"])){
            $this->_options["multiple"] = false;
        }

        if(!isset($this->_options["expanded"])){
            $this->_options["expanded"] = false;
        }

        if(!isset($this->_options["choices"])){
            $this->_options["choices"] = array();
        }



        $choice_validator = null;
        foreach($this->_validators as $validator){
            if($validator instanceof Choice){
                $choice_validator = $validator;
                break;
            }
        }

        if(!$choice_validator){
           $this->_validators[] = new Choice(array("choices"=>array_keys($this->_options["choices"]), "multiple"=>$this->_options["multiple"]));
        }


    }


    function getInputTag(){

        $is_select_tag = !$this->_options["expanded"];
        $is_multiple   = $this->_options["multiple"];


        foreach(array("choices", "multiple", "expanded") as $attribute){
            if(isset($this->_html_attributes[$attribute])){
                unset($this->_html_attributes[$attribute]);
            }
        }


        if($is_select_tag){

            if($is_multiple){
                $this->_html_attributes["multiple"] = "multiple";
            }

            $html = '<select ' . $this->getAttributes() . '>';



            foreach($this->_options["choices"] as $value=>$label){
                $html .= '<option' . ($value == $this->getValue() ? ' selected="selected"' : '') .
                         ' value="' . $value . '">' . $label .
                         '</option>';
            }


            $html .= '</select>';

        }else{

            $html = '';

            $type = $is_multiple ? "checkbox" : "radio";

            $name = $this->_html_attributes["name"];
            unset($this->_html_attributes["name"]);

            if($is_multiple){
                $name .= "[]";
            }


            foreach($this->_options["choices"] as $value=>$label){

                $checked = false;
                if($is_multiple){
                    $values  = is_array($this->getValue()) ? $this->getValue() : array($this->getValue());
                    $checked = (false !== in_array($value, $values));
                }else{
                    $checked = ($value == $this->getValue());
                }

                $html_attr = $this->_html_attributes;
                $html_attr["id"] .= ("_".$value);

                if(!isset($html_attr["class"])){
                    $html_attr["class"] = "";
                }
                $html_attr["class"] .= " choice-item";

                $attr = " ";
                foreach($html_attr as $key=>$_value){
                    $attr .= ' ' .  $key . '="' . $_value . '"';
                }

                $html .= '<p ' . $attr . '><label>'.
                         '<input type="' . $type .
                         '" name="' . $name .
                         '" ' . ($checked ? 'checked' : '') .
                         ' value="' . $value . '"/> ' . $label .
                         '</label></p>';

            }



        }

        return $html;



    }

    function reset(){
        if($this->_options["multiple"]){
            $this->setValue(array());
        }else{
            $this->setValue(null);
        }
    }



} 