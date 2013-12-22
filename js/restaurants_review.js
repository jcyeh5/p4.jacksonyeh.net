function validate(formData, jqForm, options) { 
    // formData is an array of objects representing the name and value of each field 
    // that will be sent to the server;  it takes the following form: 
    // 
    // [ 
    //     { name:  username, value: valueOfUsernameInput }, 
    //     { name:  password, value: valueOfPasswordInput } 
    // ] 
    // 
    // To validate, we can examine the contents of this array to see if the 
    // username and password fields have values.  If either value evaluates 
    // to false then we return false from this method. 
 
    for (var i=0; i < formData.length; i++) { 
        if (!formData[i].value) { 
        //    alert('Please enter a value for both Username and Password'); 
            return false; 
        } 
    } 
   // alert('Both fields contain values.'); 
	return true;
}


/*-------------------------------------------------------------------------------------------------
Document ready, start up
-------------------------------------------------------------------------------------------------*/
$(document).ready(function() { 
	$('#add_new_review_form').validationEngine({'custom_error_messages' : {
        '#add_new_review_form_rating' : {
            'required': {
                'message': "Must enter a value between 1 and 10, inclusive."
            },
            'custom[min]': {
                'message': "test"
            }
        },
        '.someClass': {
            'equals': {
                'message': "test"
            }
        },
        'required': {
            'message': "This is required"
        }
    }}  ); 
	
	var options = { 
		type: 'post',
		url: '/reviews/add',
		beforeSubmit: validate,
		success: function(response) { 
			// Load the results recieved from process.php into the results div
				if (response == 'you already gave a review for this visit'){
					$('#statusmessage').html(response);
				}
				else {
					$('#user_review_box').prepend(response);
					$('#statusmessage').html("");	
				}
		} ,
		clearForm: true
	}; 
	$('#add_new_review_form').ajaxForm(options);

}); 