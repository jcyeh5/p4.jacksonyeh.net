<div id="profileframe">
	<div id="profiletopdiv">
		<h1>Edit your profile: <?=$user->first_name?> <?=$user->last_name?></h1>
	</div>
	
	<div id="profilebottomdiv">
	
		<!-- Update Profile Form -->
		<form method='POST' action='/users/p_profile'>

			First Name<br>
		   <input type='text' name='first_name' value="<?=$profile['first_name'] ?>" > 
			<?php if ($first_name_error <> ""):?> 
				<font color="red"><?=$first_name_error?></font>
			<?php endif;?>
			<br><br>

			Last Name<br>
		   <input type='text' name='last_name' value='<?=$profile['last_name']?>'>
			<?php if ($last_name_error <> ""):?> 
				<font color="red"><?=$last_name_error?></font>
			<?php endif;?>	
			<br><br>

			Email<br>
		   <input type='text' name='email' value='<?=$profile['email']?>'>
			<?php if ($email_error <> ""):?> 
				<font color="red"><?=$email_error?></font>
			<?php endif;?>
		   <br><br>

			Change Password<br>
			<input type='password' name='change_password'> 
			<?php if ($change_password_error <> ""):?> 
				<font color="red"><?=$change_password_error?></font>
			<?php endif;?>		
			<br><br>

			Confirm Change Password<br>
			<input type='password' name='confirm_password'> 
			<br><br>	
			
			<input type='hidden' name='timezone'>

			<script>
				$('input[name=timezone]').val(jstz.determine().name());
			</script>

			<input type='submit' value='Update'>

		</form>
	</div>
</div>