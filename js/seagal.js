
/*-------------------------------------------------------------------------------------------------
Events
-------------------------------------------------------------------------------------------------*/


$('#edit_users_profile_form').submit(function() {
	$('#user_timezone').val(jstz.determine().name());
});

$('#users_signup_form').submit(function() {
	$('#user_timezone').val(jstz.determine().name());	
});


/*-------------------------------------------------------------------------------------------------
Document ready, start up
-------------------------------------------------------------------------------------------------*/
$(document).ready(function() { 

	if ($('#edit_users_profile_form').length > 0) {
		$('#edit_users_profile_form').validationEngine();
	}
	if ($('#users_signup_form').length > 0) {
		$('#users_signup_form').validationEngine();
	}
	if ($('#loginform').length > 0) {
		$('#loginform').validationEngine();
	}	

}); 





