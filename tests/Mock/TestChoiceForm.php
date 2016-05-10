<?php
/**
 * Created by Asier Marqués <asiermarques@gmail.com>
 * Date: 10/5/16
 * Time: 14:29
 */

namespace SimpleForm\Test\Mock;


use SimpleForm\AbstractForm;

class TestChoiceForm extends AbstractForm{


    function configure(){

        $types     = array("image"=> "Imagen", "audio"=>"Audio");

        $this->setName("content_info");

        $builder = $this->getBuilder();

        $builder->add("type", "choice", array("choices"=>$types, "label"=>"Tipo de contenido", "class"=>"form-control"));


    }
}

