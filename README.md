SimpleForm
==========
[![Build Status](https://travis-ci.org/Simettric/SimpleForm.svg?branch=master)](https://travis-ci.org/Simettric/SimpleForm)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b95de71b-f178-4de0-a44b-4c55eb262599/big.png)](https://insight.sensiolabs.com/projects/b95de71b-f178-4de0-a44b-4c55eb262599)

A simple way to working with forms in php.

### Install

    composer require simettric/simple-form



### Creating Forms


#### With the FormBuilder
```php
$builder = new FormBuilder($config);

$builder->create("message")
        ->add("firstName")
        ->add("lastName")
        ->add("email",   new InputTypeField(array("type"=>"email", "validators"=> new Email() )))
        ->add("subject", new ChoiceField(array("choices"=>array()))) //InArray is implicit unless we configure our own ChoiceValidator in the "validators" key
        ->add("message", new TextareaField(array(
              "validators" => array(
                    new NotEmpty(), 
                    new StringLength(array("min"=>4))
        )));
        
$data_array = array("firstName"=>"John");
$form       = $builder->getForm($data_array);
```

#### Creating a Form class
```php
class MessageForm extends AbstractForm{

    public function configure(FormBuilder $builder)
    {


        $builder->add("firstName")
                ->add("lastName")
                ->add("email",   new InputTypeField(array("type"=>"email", "validators"=> new Email() )))
                ->add("subject", new ChoiceField(array("choices"=>array()))) //ChoiceValidator is implicit unless we configure our own ChoiceValidator in the "validators" key
                ->add("message", new TextareaField(array(
                                               "validators" => array(
                                                     new NotEmpty(), 
                                                     new StringLength(array("min"=>4))
                                         )))

    }
    
    
    public function getName()
    {
        return 'message';
    }


}

$data_array = array("firstName"=>"John");
$form       = new MessageForm($data_array, new FormBuilder());
```        
        
### Validating Forms

SimpleForm uses [Zend Validator](http://framework.zend.com/manual/current/en/modules/zend.validator.html) to manage the fields validation in its forms.

```php
$builder->add("message", new TextareaField(array(
                              "label"      => "Write your message",
                              "validators" => array(
                                    new NotEmpty(), 
                                    new StringLength(array("min"=>4)
                              )))
);
```  

In your controller, you can bind the request data and check if the form is valid

```php
$form->bind( $_POST["message"] );

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
*Note: you can return a null value in your Form::getName() method in order to set a clean input name like:
```html   
  <input type="text" name="firstName" required="required">
```
*Note2: using Field::getRow("label") method, the result is similar but with a custom label.
```php
<?php echo $form["firstName"]->getRow('Text for the label tag') ?>
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
