<?php
class restaurants_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "users_controller construct called<br><br>";
    } 

    public function index($reason=null) {
	
		# If user is blank, they're not logged in; redirect them to the login page
		if(!$this->user) {
			Router::redirect('/users/login');
		}	

		# Set up the View
		$this->template->content = View::instance('v_restaurants_index');
		
		if ($reason == "edit") {
			$this->template->title   = "Edit Restaurant Info";			
		}
		else {
			$this->template->title   = "All Restaurants";
		}

		# Get list of Restaurants
		$q = 'SELECT 
				name,
				category,
				price_range,
				address,
				city,
				state,
				zip,
				restaurant_id
			FROM restaurants
			ORDER BY name ASC';

		# Run the query, store the results in the variable $restaurants
		$restaurants = DB::instance(DB_NAME)->select_rows($q);


		# LIKES
		$p = 'SELECT
				review_id,
				COUNT(like_id) as num_likes
			FROM likes
			GROUP BY review_id';

		# Run the query, store the results in the variable $likes
		$likes = DB::instance(DB_NAME)->select_rows($p);
			
		# Pass data to the View
		$this->template->content->restaurants = $restaurants;
		$this->template->content->likes = $likes;		
		$this->template->content->user = $this->user;
		$this->template->content->purpose = $reason;
		
		# Render the View
		echo $this->template;	
		
    }

    public function add($restaurant_id= NULL) {

        # Setup view
        $this->template->content = View::instance('v_restaurants_add');
   
		# are we Editing or Adding a restaurant?
		if ($restaurant_id != null){
			$this->template->title   = "edit a restaurant";
			$purpose = 'edit';
		}
		else {
			$this->template->title   = "add a restaurant";
			$purpose = 'add';
		}
			
		// CSS/JS includes
		# Create an array of 1 or many client files to be included before the closing </body> tag
		$client_files_body = Array(
        "/js/jquery-1.10.2.min.js",
		"/js/jstz-1.0.4.min.js",
		"/js/jquery.form.js",
		"/js/jquery.validationEngine-en.js",
		"/js/jquery.validationEngine.js",
		"/js/restaurants_editadd.js"
        );
		
		# Use load_client_files to generate the links from the above array
		$this->template->client_files_body = Utils::load_client_files($client_files_body);  						

		
		# if we are editing, we will need to look up existing data
		if ($purpose == 'edit'){

			# Retrieve Restaurant info from database
			$p = 'SELECT 
					name,
					category,
					price_range,
					address,
					city,
					state,
					zip,
					phone,
					website,
					ambience,
					attire,
					credit_cards,
					groups,
					kids,
					reservations,
					delivery,
					takeout,
					waiter,
					outdoor,
					seagal_rating,
					seagal_review,
					restaurant_id
					
				FROM restaurants
					WHERE restaurants.restaurant_id = '.$restaurant_id ;

			# Run the query, store the results in the variable $restaurant
			$restaurant = DB::instance(DB_NAME)->select_row($p);	
		
		}
		# We will be adding a new restaurant, so initialize all array values to null
		# and place inside $restaurant
		else {
			$restaurant  = Array(	'name' => null,
									'category' => null,
									'price_range' => null,
									'address' => null,
									'city' => null,
									'state' => null,
									'zip' => null,
									'phone' => null,
									'website' => null,
									'ambience' => null,
									'attire' => null,
									'credit_cards' => null,
									'groups' => null,
									'kids' => null,
									'reservations' => null,
									'delivery' => null,
									'takeout' => null,
									'waiter' => null,
									'outdoor' => null,
									'seagal_rating' => null,
									'seagal_review' => null,
									'restaurant_id' => null,
							);
		}
		
		# Pass data to the View		
		$this->template->content->purpose = $purpose;
		$this->template->content->restaurant = $restaurant;
		
		
        # Render template
        echo $this->template;
    }

	public function p_add($restaurant_id = null) {
		
	
        # Dump out the results of POST to see what the form submitted
        #echo '<pre>';
        #print_r($_POST);
        #echo '</pre>'; 
		
        # Setup view
        $this->template->content = View::instance('v_restaurants_add');
   
		# are we Editing or Adding a restaurant?
		if ($restaurant_id != null){
			$this->template->title   = "edit a restaurant";
			$purpose = 'edit';
		}
		else {
			$this->template->title   = "add a restaurant";
			$purpose = 'add';
		}

		// CSS/JS includes
		# Create an array of 1 or many client files to be included before the closing </body> tag
		$client_files_body = Array(
        "/js/jquery-1.10.2.min.js",
		"/js/jstz-1.0.4.min.js",
		"/js/jquery.form.js",
		"/js/seagal.js",
        );
		# Use load_client_files to generate the links from the above array
		$this->template->client_files_body = Utils::load_client_files($client_files_body);  	
		
		# Sanitize user input before moving on
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);


		
			
		# More data we want stored with the restaurant
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();

		
		if ($purpose == 'edit'){
			# update restaurant in the database
			$user_id = DB::instance(DB_NAME)->update('restaurants', $_POST, 'WHERE restaurant_id = '.$restaurant_id );			
		}
		else {
			# add new restaurant into the database
			$user_id = DB::instance(DB_NAME)->insert('restaurants', $_POST);
		}

		# Send them to the restaurant index list
		Router::redirect("/restaurants/index");		
		
    }


    public function review($restaurant_id) {

		# Setup view
        $this->template->content = View::instance('v_restaurants_review');
        $this->template->title   = "Review Restaurant";

		// CSS/JS includes
		# Create an array of 1 or many client files to be included before the closing </body> tag
		$client_files_body = Array(
        "/js/jquery-1.10.2.min.js",
		"/js/jstz-1.0.4.min.js",
		"/js/jquery.form.js",
		"/js/jquery.validationEngine-en.js",
		"/js/jquery.validationEngine.js",
		"/js/restaurants_review.js",
        );
		# Use load_client_files to generate the links from the above array
		$this->template->client_files_body = Utils::load_client_files($client_files_body);  		
		
		# Retrieve Restaurant info from database
		$p = 'SELECT 
				name,
				category,
				price_range,
				address,
				city,
				state,
				zip,
				phone,
				website,
				ambience,
				attire,
				credit_cards,
				groups,
				kids,
				reservations,
				delivery,
				takeout,
				waiter,
				outdoor,
				seagal_rating,
				seagal_review,
				restaurant_id
				
			FROM restaurants
				WHERE restaurants.restaurant_id = '.$restaurant_id ;

		# Run the query, store the results in the variable $restaurant
		$restaurant = DB::instance(DB_NAME)->select_row($p);	
	
		$q = 'SELECT 
				reviews.review_id,
				reviews.content,
				reviews.created,
				reviews.user_id AS review_user_id,
				users.first_name,
				users.last_name,
				reviews.restaurant_id
			FROM reviews
			INNER JOIN users 
				ON reviews.user_id = users.user_id
			WHERE reviews.restaurant_id = '.$restaurant_id .' 
			ORDER BY reviews.created DESC';

		# Run the query, store the results in the variable $reviews
		
		$reviews = DB::instance(DB_NAME)->select_rows($q);


		# LIKES
		$r = 'SELECT
				review_id,
				COUNT(like_id) as num_likes
			FROM likes
			GROUP BY review_id';

		# Run the query, store the results in the variable $likes
		$likes = DB::instance(DB_NAME)->select_rows($r);
			
		# Pass data to the View
		$this->template->content->restaurant = $restaurant;		
		$this->template->content->reviews = $reviews;
		$this->template->content->likes = $likes;	

	

		
		# Render template
        echo $this->template;

    }




	


} # end of the class
