<?php echo validation_errors(); ?>

<?php	
	$form_attributes = array( 'class'=>'form-horizontal', 'role'=>'form');
	echo form_open('sign_up', $form_attributes);
?>			
	
<?php	echo heading('Sign Up', 3); ?>
	<div class="form-group">
		
		<?php //echo form_error('username'); ?>
		<?php 
			$label_attributes = array('class'=>'control-label col-sm-2','name'=>'lblUsername');	
			echo form_label('Username:', 'txtUsername'); 
							
			$username_attribute = array(	'class'=>'form-control',
											'name' => 'username',
											'id'=>'txtUsername',
											'placeholder'=>'abc',
											'maxlength' => '30',
																				            
								        );
			echo form_input($username_attribute);
			?>     		
	</div>

	<div class="form-group">
		

		<?php 
			$label_attributes = array('class'=>'control-label col-sm-2','name'=>'lblEmail');	
			echo form_label('Email:', 'txtEmail'); 
		
					
			$email_attribute = array(	'class'=>'form-control',
											'name' => 'email',
											'id'=>'txtEmail',
											'placeholder'=>'abc@sample.com',
											'maxlength' => '30',
																				            
								        );
			echo form_input($email_attribute);
			?>     
	</div>

	<?php //echo form_error('password'); ?>
	<div class="form-group">

		<?php 
			$label_attributes = array('class'=>'control-label col-sm-2','name'=>'lblPassword');	
			echo form_label('Password:', 'txtPassword'); 
			
			$password_attribute = array(	'class'=>'form-control',
												'name' => 'password',
												'id'=>'txtPassword',
												'placeholder'=>'Enter password',
												'maxlength' => '30',
																	            
									        );
			echo form_password($password_attribute);
			?>      
	</div>

	<div class="form-group">

		<?php 
			$label_attributes = array('class'=>'control-label col-sm-2','name'=>'lblConfirmPassword');	
			echo form_label('Confirm Password:', 'txtConfirmPassword'); 
		
						
			$confirmpassword_attribute = array(	'class'=>'form-control',
											'name' => 'confirmpassword',
											'id'=>'txtConfirmPassword',
											'placeholder'=>'Confirm password',
											'maxlength' => '30'									            
								        );
			echo form_password($confirmpassword_attribute);
			?>      
	</div>
	
	<div class="form-group"> 
	    
    	<?php 
    			$submit_attribute = array('class'=>'btn btn-primary','value'=>'Submit', 'id'=>'btnSubmit');
    			echo form_submit($submit_attribute);     			
    	?>

    	<?php 
    			$reset_attribute = array('class'=>'btn btn-default','value'=>'reset', 'id'=>'btnReset');
    			echo form_reset($reset_attribute);
    	?>
	    
	</div>

	<div class="form-group"> 
	    
    	<?php 
			$button_attribute  = array(
						    			    'name' => 'googleplus',
						    			    'id' => 'btnGooglePlus',
						    			    'value' => 'googleplus',
						    			    'content' => 'Google+ Sign Up',
						    			    'class' => 'btn btn-default'

						    		   );

			echo form_button($button_attribute); 
    	?>	    
	</div>

<?php echo form_close(); ?>