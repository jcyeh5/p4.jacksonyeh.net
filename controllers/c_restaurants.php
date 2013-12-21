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
		$client_files_head = Array(
        "/js/jquery-1.10.2.min.js",
		"/js/jstz-1.0.4.min.js"
        );
		
		# Use load_client_files to generate the links from the above array
		$this->template->client_files_head = Utils::load_client_files($client_files_head);  						

		
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
		"/js/seagal.js",
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

	public function p_login() {

		# check if Email and Password fields have been filled in.  If not, send back to login.
		if ($_POST['email'] == "" && $_POST['password'] == "") {
			
			# Send them back to the login page with an error
			Router::redirect("/users/login/error");	
		}
		
		# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);

		# Hash submitted password so we can compare it against one in the db
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		# Search the db for this email and password
		# Retrieve the token if it's available
		$q = "SELECT token 
			FROM users 
			WHERE email = '".$_POST['email']."' 
			AND password = '".$_POST['password']."'";

		$token = DB::instance(DB_NAME)->select_field($q);

		# If we didn't find a matching token in the database, it means login failed
		if(!$token) {

			# Send them back to the login page with an error
			Router::redirect("/users/login/error");

		# But if we did, login succeeded! 
		} else {

			/* 
			Store this token in a cookie using setcookie()
			Important Note: *Nothing* else can echo to the page before setcookie is called
			Not even one single white space.
			param 1 = name of the cookie
			param 2 = the value of the cookie
			param 3 = when to expire
			param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
			*/
			setcookie("token", $token, strtotime('+2 weeks'), '/');

			# Send them to the main page - or whever you want them to go
			Router::redirect("/");

		}

	}
	
	
	public function logout() {

		# If user is blank, they're not logged in; redirect them to the login page
		if(!$this->user) {
			Router::redirect('/users/login');
		}
		
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

		# Create the data array we'll use with the update method
		# In this case, we're only updating one field, so our array only has one entry
		$data = Array("token" => $new_token);

		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

		# Delete their token cookie by setting it to a date in the past - effectively logging them out
		setcookie("token", "", strtotime('-1 year'), '/');

		# Send them back to the main index.
		Router::redirect("/");

	}


	public function profile() {

		# If user is blank, they're not logged in; redirect them to the login page
		if(!$this->user) {
			Router::redirect('/users/login');
		}

		# If they weren't redirected away, continue:

		# Setup view
		$this->template->content = View::instance('v_users_profile');
		$this->template->title   = "Profile of".$this->user->first_name;

		# for error messages
			$first_name_error = "";
			$last_name_error = "";
			$email_error = "";
			$change_password_error = "";

			$this->template->content->first_name_error = $first_name_error;
			$this->template->content->last_name_error = $last_name_error;
			$this->template->content->email_error = $email_error;			
			$this->template->content->change_password_error = $change_password_error;	
		
		# Query
		$q = 'SELECT 
					first_name,
					last_name,
					email,
					timezone
				
				FROM users
				WHERE users.user_id = '.$this->user->user_id ;

		# Run the query, store the results in the variable $posts
		$profile = DB::instance(DB_NAME)->select_row($q);	
		
		# Pass data to the View
		$this->template->content->profile = $profile;

		# Render the View
		echo $this->template;
	
	}


	public function p_profile() {

		# If user is blank, they're not logged in; redirect them to the login page
		if(!$this->user) {
			Router::redirect('/users/login');
		}

		# If they weren't redirected away, continue:

		# Setup view
		$this->template->content = View::instance('v_users_profile');
		$this->template->title   = "Profile of".$this->user->first_name;	
		

		# check if all required fields are filled in...if not, redirect back to profile

			$first_name_error = "";
			$last_name_error = "";
			$email_error = "";
			$change_password_error = "";
			
			if ($_POST['first_name'] == "") {
				$first_name_error = "<-- first name is a required field";
			}
			if ($_POST['last_name'] == "") {
				$last_name_error = "<-- last name is a required field";
			}
			if ($_POST['email'] == "") {
				$email_error = "<-- email is a required field";
			}

			# check if they want to change the password.
			# if yes, both Change Password and Confirm Password have to be the same.
			if ($_POST['change_password'] != "" && $_POST['change_password'] != $_POST['confirm_password']) {
				$change_password_error = "<-- new password and confirm password do not match";
			}
		
		# if any of the fields above are not filled in correctly, redirect back to profile
		if ($first_name_error != "" || $last_name_error != "" || $email_error != "" || $change_password_error != "") {
			#fill in $profile array with _POST values
			$profile = Array(	'first_name' => $_POST['first_name'], 
								'last_name' => $_POST['last_name'],
								'email' => $_POST['email'],
								'change_password' => $_POST['change_password'],	
								'confirm_password' => $_POST['confirm_password']
							);
						
			# Pass data back to the View
			$this->template->content->profile = $profile;
			$this->template->content->first_name_error = $first_name_error;
			$this->template->content->last_name_error = $last_name_error;
			$this->template->content->email_error = $email_error;			
			$this->template->content->change_password_error = $change_password_error;

			# Render the View
			echo $this->template;							
		}
		else {	
			# everthing has been validated

			
			# Sanitize user input before moving on
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);

					
			# More data we want stored with the user
			$_POST['modified'] = Time::now();

					
			# next, either 1) Do not change password or 2) change password has been confirmed		
			# Do not change password
			if ($_POST['change_password'] == ""){
				# Update this user into the database
				$data    = Array(	'user_id' => $this->user->user_id , 
									'first_name' => $_POST['first_name'], 
									'last_name' => $_POST['last_name'],
									'email' => $_POST['email'],
									'timezone' => $_POST['timezone'],
									//'token' => $_POST['token'],
									'modified' => $_POST['modified']
								);	
			}
			# Change the password
			else {

				# Create an encrypted token via their email address and a random string
				$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

				# Encrypt the password  	
				$_POST['change_password'] = sha1(PASSWORD_SALT.$_POST['change_password']);   

				# Update this user into the database
				$data    = Array(	'user_id' => $this->user->user_id , 
									'first_name' => $_POST['first_name'], 
									'last_name' => $_POST['last_name'],
									'email' => $_POST['email'],
									'password' => $_POST['change_password'],
									'timezone' => $_POST['timezone'],
									'token' => $_POST['token'],
									'modified' => $_POST['modified']
								);	
				
			}
								
			$user_id = DB::instance(DB_NAME)->update_or_insert_row('users', $data);	
				
				
					
			# Send them to the main page
			Router::redirect("/");			
		} 
	
	}


} # end of the class
