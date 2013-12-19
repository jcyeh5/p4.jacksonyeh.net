




/*-------------------------------------------------------------------------------------------------
Buttons Events
-------------------------------------------------------------------------------------------------*/


$('#post-btn').click(function() {

	console.log("clicked");

    $.ajax({
        type: 'POST',
        url: '/reviews/add',
        success: function(response) { 
                // Load the results we get back from process.php into the results div
            $('#user_review_box').prepend(response);
        },
        data: {
            restaurant_id: $('#ajax_restaurant_id').html(),
            content: $('#contenttextarea').val(),			
			
        },
    }); // end ajax setup
});

/*-------------------------------------------------------------------------------------------------
Document ready, start up
-------------------------------------------------------------------------------------------------*/






