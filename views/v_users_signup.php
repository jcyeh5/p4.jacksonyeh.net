<div class="mainframe">
	<h2>Welcome to My 2 Cents.  Please register to start sharing your opinions with the rest of the world</h2>

	<!-- Sign Up Form -->
	<form method='POST' action='/users/p_signup'>

		First Name<br>
	   <input type='text' name='first_name' value="<?php echo $first_name?>">
			<?php if ($first_name_error <> ""):?> 
				<font color="red"><?=$first_name_error?></font>
			<?php endif;?>
		<br><br>

		Last Name<br>
	   <input type='text' name='last_name' value="<?php echo $last_name?>">   
			<?php if ($last_name_error <> ""):?> 
				<font color="red"><?=$last_name_error?></font>
			<?php endif;?>	
		<br><br>

		Email<br>
	   <input type='text' name='email' value="<?php echo $email?>">  	   
			<?php if ($email_error <> ""):?> 
				<font color="red"><?=$email_error?></font>
			<?php endif;?>
		<br><br>

		Password<br>
		<input type='password' name='password'  value="<?php echo $password?>">		
			<?php if ($password_error <> ""):?> 
				<font color="red"><?=$password_error?></font>
			<?php endif;?>			
		<br><br>

		<input type='hidden' name='timezone'>

		<script>
			$('input[name=timezone]').val(jstz.determine().name());
		</script>

		<?php if(isset($error)): ?>
			<div class='error'>
				There is an existing account with that email address.  Please use another.
			</div>
			<br>
		<?php endif; ?>	
		
		<input type='submit' value='Sign up'>

	</form>

</div>

