

/*-------------------------------------------------------------------------------------------------
Document ready, start up
-------------------------------------------------------------------------------------------------*/
$(document).ready(function() { 
	$('#add_restaurant_form').validationEngine({'custom_error_messages' : {
        '#restaurant_add_seagal_rating' : {
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
	

}); 