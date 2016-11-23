<?php
/**
 * Mock class used in the tests
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm\Test\Mock;

use SimpleForm\AbstractForm;
use SimpleForm\Field\ChoiceField;
use SimpleForm\FormBuilder;

class TestChoiceForm extends AbstractForm
{
    public function configure(FormBuilder $builder)
    {
        $types     = array("Imagen"=> "image", "Audio"=>"audio");

        $this->setName("content_info");


        $builder->add("type", new ChoiceField(array("choices"=>$types, "label"=>"Tipo de contenido", "class"=>"form-control")));
    }
}
