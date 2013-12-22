<div id="profileframe">
	<div id='restaurantinfobox'> 
	<div id="profiletopdiv">
		<h1>Edit your profile: <?=$user->first_name?> <?=$user->last_name?></h1>
	</div>
	
	<div id="profilebottomdiv">
	<span class="list_label">	
		<!-- Update Profile Form -->
		<form id='edit_users_profile_form' method='POST' action='/users/p_profile'>

			First Name<br>
		   <input type='text' name='first_name' class="validate[required] text-input" value="<?=$profile['first_name'] ?>" > 
			<br><br>

			Last Name<br>
		   <input type='text' name='last_name' class="validate[required] text-input" value='<?=$profile['last_name']?>' >	
			<br><br>

			Email<br>
		   <input type='text' name='email' class="validate[required, custom[email]] text-input" value='<?=$profile['email']?>'>
		   <br><br>

			Change Password<br>
			<input id='change_password' type='password' name='change_password'> 
	
			<br><br>

			Confirm Change Password<br>
			<input type='password' name='confirm_password' class="validate[equals[change_password] text-input" > 
			<br><br>	
			
			<input id='user_timezone' type='hidden' name='timezone'>

			<input type='submit' value='Update'>

		</form>
	</span>	
	</div>
	</div>
</div>