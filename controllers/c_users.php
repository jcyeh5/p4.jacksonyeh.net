<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "users_controller construct called<br><br>";
    } 

    public function index() {
	
		# If user is blank, they're not logged in; redirect them to the login page
		if(!$this->user) {
			Router::redirect('/users/login');
		}	

		Router::redirect('/posts/users');		
		
    }

    public function signup($error = NULL) {

        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";

		// CSS/JS includes
		# Create an array of 1 or many client files to be included before the closing </body> tag
		$client_files_head = Array(
        "/js/jquery-1.10.2.min.js",
		"/js/jstz-1.0.4.min.js"
        );
		# Use load_client_files to generate the links from the above array
		$this->template->client_files_head = Utils::load_client_files($client_files_head);  

	
			$first_name = "";
			$last_name = "";
			$email = "";
			$password = "";
			
		# for error messages
	
			$first_name_error = "";
			$last_name_error = "";
			$email_error = "";
			$password_error = "";

			$profile = Array(	'first_name' => "", 
								'last_name' => "",
								'email' => "",
								'password' => ""
							);		

						
		# Pass data to the view
			$this->template->content->error = $error;	
			$this->template->content->first_name_error = $first_name_error;
			$this->template->content->last_name_error = $last_name_error;
			$this->template->content->email_error = $email_error;			
			$this->template->content->password_error = $password_error;	
			$this->template->content->profile = @profile;
			$this->template->content->first_name = $first_name;	
			$this->template->content->last_name = $last_name;	
			$this->template->content->email = $email;	
			$this->template->content->password = $password;			
        # Render template
        echo $this->template;
    }

	public function p_signup() {
		
	
        # Dump out the results of POST to see what the form submitted
        #echo '<pre>';
        #print_r($_POST);
        #echo '</pre>'; 
		
        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";

		// CSS/JS includes
		# Create an array of 1 or many client files to be included before the closing </body> tag
		$client_files_head = Array(
        "/js/jquery-1.10.2.min.js",
		"/js/jstz-1.0.4.min.js"
        );
		# Use load_client_files to generate the links from the above array
		$this->template->client_files_head = Utils::load_client_files($client_files_head);  	

		# check if all required fields are filled in...if not, redirect back to sign up screen

			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$first_name_error = "";
			$last_name_error = "";
			$email_error = "";
			$password_error = "";
			
			if ($_POST['first_name'] == "") {
				$first_name_error = "<-- first name is a required field";
			}
			if ($_POST['last_name'] == "") {
				$last_name_error = "<-- last name is a required field";
			}
			if ($_POST['email'] == "") {
				$email_error = "<-- email is a required field";
			}
			if ($_POST['password'] == "") {
				$password_error = "<-- password is a required field";
			}

		
		# if any of the fields above are not filled in correctly, redirect back to sign up screen
		if ($first_name_error != "" || $last_name_error != "" || $email_error != "" || $password_error != "") {
			#fill in $profile array with _POST values
			$profile = Array(	'first_name' => $_POST['first_name'], 
								'last_name' => $_POST['last_name'],
								'email' => $_POST['email'],
								'password' => $_POST['password']
							);
						
			# Pass data back to the View
			$this->template->content->profile = $profile;
			$this->template->content->first_name_error = $first_name_error;
			$this->template->content->last_name_error = $last_name_error;
			$this->template->content->email_error = $email_error;			
			$this->template->content->password_error = $password_error;
			$this->template->content->first_name = $first_name;
			$this->template->content->last_name = $last_name;	
			$this->template->content->email = $email;	
			$this->template->content->password = $password;				
			
			# Render the View
			echo $this->template;							
		}	
		# else, input has been validated
		else {
		
		
			# Sanitize user input before moving on
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);

			# Check if email has already been registered
			
				# Query
				$q = "	SELECT email			
						FROM users
						WHERE users.email = '".$_POST['email']."'";


				# Run the query, store the results in the variable $profile
				$profile = DB::instance(DB_NAME)->select_row($q);	
			
				
				# if the email address already exists in the database
				if ($profile != null){
					# Send them back to the login page with an error
					Router::redirect("/users/signup/alreadytaken");		
				}
		
			
			# More data we want stored with the user
				$_POST['created']  = Time::now();
				$_POST['modified'] = Time::now();

			# Encrypt the password  
				$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

			# Create an encrypted token via their email address and a random string
				$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

			
			# Insert this user into the database
				$user_id = DB::instance(DB_NAME)->insert('users', $_POST);

			

			# Send a welcome Email
			
				# Build a multi-dimension array of recipients of this email
				$to[] = Array("name" => $_POST['first_name']." ".$_POST['last_name'], "email" => $_POST['email']);

				# Build a single-dimension array of who this email is coming from
				# note it's using the constants we set in the configuration above)
				$from = Array("name" => APP_NAME, "email" => APP_EMAIL);

				# Subject
				$subject = "Welcome to My 2 Cents";

				# You can set the body as just a string of text
				$body = "Hi ".$_POST['first_name'].", Welcome to My 2 Cents";

				# Build multi-dimension arrays of name / email pairs for cc / bcc if you want to 
				$cc  = "";
				$bcc = "";

				# With everything set, send the email
				$email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);

			
			# for now, we are not requiring an email confirmation, so just direct them to home page
			setcookie("token", $_POST['token'], strtotime('+2 weeks'), '/');

			
			# follow myself
				# Prepare the data array to be inserted
				$data = Array(
					"created" => Time::now(),
					"user_id" => $user_id,
					"user_id_followed" =>  $user_id
					);

				# Do the insert
				DB::instance(DB_NAME)->insert('users_users', $data);			
			
			# Send them to the home page
				Router::redirect("/");		
		}
    }


    public function login($error = NULL) {

		# Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

		# Pass data to the view
		$this->template->content->error = $error;	
		
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
