<?php



namespace SimpleForm;


class FormBuilderForm extends AbstractForm
{

    private $name;

    public function __construct($name, array $data, FormBuilder $builder)
    {
        $this->name = $name;
        parent::__construct($data, $builder);
    }

    public function configure(FormBuilder $builder)
    {

    }

    public function getName() {
        return $this->name;
    }
}
