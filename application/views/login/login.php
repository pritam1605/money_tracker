<?php echo validation_errors(); ?>

<?php	
	$form_attributes = array( 'class'=>'form-horizontal', 'role'=>'form');
	echo form_open('login/sign_in', $form_attributes);
?>			


	<div class="form-group">

		<?php	if(! is_null($msg))
				{
					echo $msg;
				}
		?>

		<?php	echo heading('Login', 2); ?>
		<?php //echo form_error('username'); ?>
		<?php 
			$label_attributes = array('class'=>'control-label','name'=>'username');	
			echo form_label('Username:', 'txtUsername');		
							
			$username_attribute = array(	'class'=>'form-control',
											'name' => 'username',
											'id'=>'txtUsername',
											'placeholder'=>'Enter username/email',
											'maxlength' => '30',
																				            
								        );
			echo form_input($username_attribute);
		?>		
	</div>

	<?php //echo form_error('password'); ?>
	<div class="form-group">
		<?php 
			$label_attributes = array('class'=>'control-label','name'=>'password');	
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
    	<div class="checkbox">
    		<label class="checkbox"><input type="checkbox"> Remember me</label>   
      	</div>	    
	</div>

	<div class="form-group">	    
    	<?php 
    		$submit_attribute = array('class'=>'btn btn-primary','value'=>'Submit', 'id'=>'btnSubmit');
			echo form_submit($submit_attribute);    		
    	?>
    	
    	<?php // google+ login button can be added here	?>  
    	
	</div>

	<div class="form-group">
		<div id="signinButton">
			<span
				class="g-signin"
				data-callback="signinCallback"
				data-clientid="637358824608-vn5jf87pmc2hfj9vur9g47fia2q8vvis.apps.googleusercontent.com"
				data-cookiepolicy="single_host_origin"
				data-requestvisibleactions="http://schema.org/AddAction"
				data-scope="https://www.googleapis.com/auth/plus.login"
				data-width="wide"
				data-height="standard"
				data-redirecturi="postmessage"    			
    		>
			</span>
		</div> 		
		<div id="result"><p id="test"></p></div>
	</div>
	<!-- 
		data-accesstype="offline" 
		data-approvalprompt="force" 
		data-scope="https://www.googleapis.com/auth/plus.login"
	-->

	<div class="form-group">	    
    	<p>Not a member yet?
	    	<?php 
	    		echo anchor('sign_up','Sign Up',array('class'=>'btn btn-link'));	    			
	    	?>
    	</p>	    
	<div>

<?php echo form_close(); ?>

<script type="text/javascript">
		
		function signinCallback(authResult) 
		{	
			//document.getElementById('test').innerHTML=JSON.stringify(authResult);

			if (authResult['status']['signed_in']) 
			{
			// Update the app to reflect a signed in user
			// Hide the sign-in button now that the user is authorized, for example:
				document.getElementById('signinButton').setAttribute('style', 'display: none');
				//alert("code "+authResult['code']);
				//alert("access token " + authResult['access_token']);
			} 
			else 
			{
			// Update the app to reflect a signed out user
			// Possible error values:
			//   "user_signed_out" - User is signed-out
			//   "access_denied" - User denied access to your app
			//   "immediate_failed" - Could not automatically log in the user
				console.log('Sign-in state: ' + authResult['error']);
			}	
		}
				
</script>