<div id="loginframe">

	<!-- Login Form -->
	<form id= "loginform" method='POST' action='/users/p_login'>

		Email<br>
		<input type='text' name='email' class="validate[required, custom[email]]">
		<br><br>

		Password<br>
		<input type='password' name='password'>
		<br><br>

		<?php if(isset($error)): ?>
			<div class='error'>
				Login failed. Please double check your email and password.
			</div>
			<br>
		<?php endif; ?>
				
		<input type='submit' value='Log in'>
		<br><br><br><br>
	
	</form>


	<!-- Verbiage for screen -->
	<div id="welcometextdiv">

		<h2>Welcome to the next big thing in celebrity endorsements.</h2>
			I have been an Aikido master, movie star, deputy sheriff, and guitarist
		<br>
			Now I am a chef.  Sign up today to get my pearls of culinary wisdom.
			<br><br>
			
			- 'Chef' Steven Seagal
			<br><br>
	
		<!-- Signup button -->	
		<div id="signupbuttondiv"><a href='/users/signup'><img  src="/images/signuptoday.png" alt="link to sign up form"></a></div>
		
		
	</div>
	
	
	
</div>
