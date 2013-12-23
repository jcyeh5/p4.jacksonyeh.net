<div class="mainframe">
	<h2>Please register so I can tutor you on the finer things in life.  -"Chef" Steven Seagal</h2>
	<br><br>
	
	<div id='restaurantinfobox'> 
		<!-- Sign Up Form -->
		<form id='users_signup_form' method='POST' action='/users/p_signup'>

			First Name<br>
		   <input type='text' name='first_name' class="validate[required] text-input">
			<br><br>

			Last Name<br>
		   <input type='text' name='last_name' class="validate[required] text-input">   
			<br><br>

			City<br>
		   <input type='text' name='city' class="validate[required] text-input">   
			<br><br>
			
			State<br>
		   <input type='text' name='state' class="validate[required] text-input">   
			<br><br>		
			
			Email<br>
		   <input type='text' id="signup_email" name='email' class="validate[required, custom[email], ajax[does_email_exist] text-input">  	   
			<br><br>

			Password<br>
			<input type='password' name='password'  class="validate[required] text-input" >		
		
			<br><br>

			<input type='hidden' name='timezone'>

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

