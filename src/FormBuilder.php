<?php
/**
 * The Form Builder class.
 *
 * You need to use it in order to configure the form fields.
 * Also you can build forms on the fly, without the need of creating a Form class.
 *
 * @author Asier Marqués <asiermarques@gmail.com>
 */

namespace SimpleForm;

use SimpleForm\Field\AbstractField;
use SimpleForm\Field\TextField;

class FormBuilder
{

    /**
     * @var AbstractForm
     */
    private $_form;

    /**
     * @param $form
     * @param array $values
     * @return $this
     */
    public function create($form, $values=array())
    {
        if (is_string($form)) {
            $this->_form      = new FormBuilderForm($values, $this);
            $this->_form->setName($form);
        } elseif ($form instanceof AbstractForm) {
            $this->_form      = $form;
        }

        return $this;
    }

    /**
     * @param AbstractForm $form
     * @throws \Exception
     */
    public function setForm(AbstractForm $form)
    {
        if($this->_form instanceof AbstractForm)
            throw new \Exception('Form already setted');

        $this->_form = $form;
    }


    /**
     * @param $name
     * @param AbstractField|null $field
     * @return $this
     * @throws \Exception
     */
    public function add($name, AbstractField $field=null)
    {
        if(!$this->_form instanceof AbstractForm)
            throw new \Exception('Form not created yet, you need to call FormBuilder::create method first!');

        if(!$field)
        {
            $field = new TextField();
        }

        $field->configure($name, $this->getForm()->getName());


        $this->_form->addField($field);
        return $this;
    }


    /**
     * @param $key
     * @return $this
     * @throws \Exception
     */
    public function remove($key)
    {
        if(!$this->_form instanceof AbstractForm)
            throw new \Exception('Form not created yet, you need to call FormBuilder::create method first!');

        $this->_form->offsetUnset($key);
        return $this;
    }


    /**
     * @return AbstractForm
     */
    public function getForm()
    {
        return $this->_form;
    }
}
