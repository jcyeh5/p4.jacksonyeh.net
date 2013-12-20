

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
            alert('Please enter a value for both Username and Password'); 
            return false; 
        } 
    } 
    alert('Both fields contain values.'); 
	return true;
}


/*-------------------------------------------------------------------------------------------------
Buttons Events
-------------------------------------------------------------------------------------------------*/

/*
$('#post-btn').click(function() {

	console.log("clicked");

    $.ajax({
        type: 'POST',
        url: '/reviews/add',
		beforeSubmit: showRequest,
			
        success: function(response) { 
                // Load the results we get back from process.php into the results div
            $('#user_review_box').prepend(response);
        },
        data: {
            restaurant_id: $('#ajax_restaurant_id').val(),
            content: $('#contenttextarea').val(),			
			
        },
    }); // end ajax setup
});
*/


/*-------------------------------------------------------------------------------------------------
Document ready, start up
-------------------------------------------------------------------------------------------------*/
$(document).ready(function() { 
var options = { 
    type: 'post',
    url: '/reviews/add',
	beforeSubmit: validate,
    success: function(response) { 
        // Load the results recieved from process.php into the results div
             $('#user_review_box').prepend(response);    
    } ,
	clearForm: true
}; 

// Then attach the ajax form plugin to this form so that when it's submitted, 
// it will be submitted via ajax    
$('#add_new_review').ajaxForm( options ); 


}); 





