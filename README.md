SimpleForm
==========
[![Build Status](https://travis-ci.org/asiermarques/SimpleForm.svg?branch=master)](https://travis-ci.org/asiermarques/SimpleForm)



## MVP Concept

### Configure
```php
$config = new Config();
$config->addFieldDefinition("customField", "\\Namespace\\CustomField");
```

### Creating Forms


#### With the FormBuilder
```php
$builder = new FormBuilder($config);

$builder->create("message")
        ->add("firstName")
        ->add("lastName")
        ->add("email", "email")
        ->add("subject", "choice", array("choices"=>array())) //ChoiceValidator is implicit unless we configure our own ChoiceValidator in the "validators" key
        ->add("message", "textarea", array( 
                                      "validators" => array(
                                            new NotBlank(), 
                                            new Length(array("min"=>4))
                                    ));
$data_array = array("firstName"=>"John");
$form       = $builder->getForm($data_array);
```

#### Creating a Form class
```php
class MessageForm extends AbstractForm{

    function configure(){

        $this->name = "message";

        $builder = $this->getBuilder();

        $builder->add("firstName")
                ->add("lastName")
                ->add("email", "email")
                ->add("subject", "choice", array("choices"=>array())) //ChoiceValidator is implicit unless we configure our own ChoiceValidator in the "validators" key
                ->add("message", "textarea", array(
                                              "validators" => array(
                                                    new NotBlank(),
                                                    new MinLength(4))
                                            ));

    }


}

$data_array = array("firstName"=>"John");
$form       = new MessageForm($data_array, $config);
```        
        
### Validating Forms
```php
$form->bind( $_POST["contact"] );

if($form->isValid()){

   echo $form->getValue("firstName");

}
```    
    
### Rendering Forms
```php
<?php echo $form["firstName"] ?>
```

Outputs:
```html   
<div>
  
  <label for="contact_firstName">firstName</label>
  <input type="text" name="contact[firstName]" required="required">
  <span class="error">Error message</span>

</div>
```
You can render each HTML tag individually:
```php    
<?php echo $form["firstName"]->getLabelTag() ?>

<?php echo $form["firstName"]->getInputTag(array("class"=>"the attribute value")) ?>

<?php echo $form["firstName"]->getErrorTag() ?>
```    
Also, you can get an array of error values
```php     
<?php foreach( $form["firstName"]->getErrorArray() as $error ){} ?>
```
