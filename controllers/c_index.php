<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$this->template->title = "My Two Cents";
			
		# Get and print the current timestamp
		//echo Time::now();

		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/
	      					     		

		# If user is blank, they're not logged in; redirect them to the login page
		if(!$this->user) {
			Router::redirect('/users/login');
		}

		# Else user is already logged in.  Get user's statistics
		
			# Get number of posts
				# Query
				$q = "	SELECT count(post_id)as num_posts			
					FROM posts
					WHERE posts.user_id = '".$this->user->user_id."'";


				# Run the query, store the results in the variable $profile
				$posts = DB::instance(DB_NAME)->select_row($q);	
				
				
			# Get number of followers
				# Query
				$p = "	SELECT count(user_user_id)as num_followers			
					FROM users_users
					WHERE users_users.user_id_followed = '".$this->user->user_id."'";


				# Run the query, store the results in the variable $profile
				$followers = DB::instance(DB_NAME)->select_row($p);	

			# Get date/time of last post
				# Query
				$r = "	SELECT created			
					FROM posts
					WHERE posts.user_id = '".$this->user->user_id."' order by created desc limit 0,1";


				# Run the query, store the results in the variable $profile
				$lastpost = DB::instance(DB_NAME)->select_row($r);					
			
			# Pass data to the View
			$this->template->content->posts = $posts;
			$this->template->content->followers = $followers;
			$this->template->content->lastpost = $lastpost;
				
		
		
		# Render template
			echo $this->template;

 		
			
	} # End of method
	
	
} # End of class
