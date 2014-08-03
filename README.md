SimpleForm
==========




## MVP Concept


### Creating Forms

    $builder = new FormBuilder("contact");
    $builder->add("firstName")
            ->add("lastName")
            ->add("email", "email")
            ->add("subject", "choice", array("choices"=>array())); //ChoiceValidator is implicit unless we configure our own ChoiceValidator in the "validator" key
            ->add("message", "textarea", array( 
                                          "validator" => array(
                                                new NotBlank(), 
                                                new MinLength(4)) 
                                        ));
            
    $form    = $builder->getForm();
        
        
### Validating Forms

    $form->bind( $_POST["contact"] );
    
    if($form->isValid()){
    
       echo $form->getValue("firstName");
    
    }
    
    
### Drawing Forms

    <?php echo $form["firstName"] ?>
    
    Results in:
    
    <div>
      
      <label for="contact_firstName">firstName</label>
      <input type="text" name="contact[firstName]" required="required">
      <span class="error">Error message</span>
    
    </div>
    
