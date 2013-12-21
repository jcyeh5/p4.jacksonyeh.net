<div class="mainframe">
	<h2>Please register so I can tutor you on the finer things in life.  -"Chef" Steven Seagal</h2>
	
	<br>
	<br>
	<div id='restaurantinfobox'> 
	<!-- Sign Up Form -->
	<form method='POST' action='/users/p_signup'>

		First Name<br>
	   <input type='text' name='first_name'>
		<br><br>

		Last Name<br>
	   <input type='text' name='last_name'>   
		<br><br>

		City<br>
	   <input type='text' name='city'>   
		<br><br>
		
		State<br>
	   <input type='text' name='state'>   
		<br><br>		
		
		Email<br>
	   <input type='text' name='email'>  	   
		<br><br>

		Password<br>
		<input type='password' name='password' >		
	
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
</div>

