<div id="loginframe">

	<!-- Login Form -->
	<form id= "loginform" method='POST' action='/users/p_login'>

		Email<br>
		<input type='text' name='email'>
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

		<h2>+1 features on this site</h2>
		<ul>
			<li>Delete a post</li>
			<li>Display and edit profile</li>
			<li>Reset password</li>
			<li>"LIKE" feature</li>
			<li>User statistics (i.e. number of followers, number of posts, etc.)</li>
		</ul>
			
	
		<!-- Signup button -->	
		<div id="signupbuttondiv"><a href='/users/signup'><img  src="/images/signuptoday.png" alt="link to sign up form"></a></div>
		
		
	</div>
	
	
	
</div>
