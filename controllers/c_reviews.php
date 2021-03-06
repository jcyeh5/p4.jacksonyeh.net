<?php

class reviews_controller extends base_controller {

    public function __construct() {
        parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
		# If user is blank, they're not logged in; redirect them to the login page
		if(!$this->user) {
			Router::redirect('/users/login');
		}
    }

	
	public function does_visit_exist() {
	
		$validateValue = $_GET['fieldValue'];
		$restaurant_id = $_GET['ajax_restaurant_id'];
		$user_id = $_GET['ajax_user_id'];

   		$validateValue = DB::instance(DB_NAME)->sanitize($validateValue);
   		$restaurant_id = DB::instance(DB_NAME)->sanitize($restaurant_id);
   		$user_id = DB::instance(DB_NAME)->sanitize($user_id);		
    //    echo '<pre>';
    //    print_r($_REQUEST);
    //    echo '</pre>'; 
	
		# Check if visit review has already been added
			
		# Query
		$q = "	SELECT review_id			
				FROM reviews
				WHERE restaurant_id = '".$restaurant_id."' and user_id = '".$user_id."' and visit_date = '".$validateValue."'";

		# Run the query, store the results in the variable $visit
		$visit = DB::instance(DB_NAME)->select_row($q);	
			
				
		# if the visit exists in the database
		if ($visit!= null){
			echo '["add_new_review_form_visit_date", false, "You have already added a review for this visit date"]';		
		}
		else{
			echo '["add_new_review_form_visit_date", true, ""]'; 
		}	
		
	}	
	
    public function add() {
	
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		# Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

		# strip out leading '0' on Rating if it exists
		if (substr($_POST['rating'] , 0, 1) == '0') {
			$_POST['rating'] =  (substr($_POST['rating'] , 1, 1));
		}

		# Check if visit review has already been added
			
		# Query
		$q = "	SELECT review_id			
				FROM reviews
				WHERE restaurant_id = '".$_POST['restaurant_id']."' and user_id = '".$this->user->user_id."' and visit_date = '".$_POST['visit_date']."'";

		# Run the query, store the results in the variable $visit
		$visit = DB::instance(DB_NAME)->select_row($q);	
			
				
		# if the visit exists in the database
		if ($visit!= null){
			# DO NOT ADD REVIEW, redirect back to page with error message
			# Set up the view
			$view = View::instance('v_restaurants_review_dont_add');			;		
			# Render template
			echo $view;
			
		}
		else{
			# If visit is not in database, then Insert
			# Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
			DB::instance(DB_NAME)->insert('reviews', $_POST);		
	 
			# Set up the view
			$view = View::instance('v_restaurants_review_add');

			# Retrieve review that was just added
			$p = "SELECT
					review_id,
					restaurant_id
				FROM reviews
				WHERE restaurant_id = ".$_POST['restaurant_id'].' 
				ORDER BY reviews.created DESC limit 1';

			# Run the query, store the results in the variable $review
			$review = DB::instance(DB_NAME)->select_row($p);		
			
		
			# Retrieve user name from database
			$q = 'SELECT 
					user_id,
					first_name,
					last_name
				FROM users 

				WHERE user_id = '.$this->user->user_id ;

			# Run the query, store the results in the variable $user
			
			$user = DB::instance(DB_NAME)->select_row($q);


			# LIKES
			$r = 'SELECT
					review_id,
					COUNT(like_id) as num_likes
				FROM likes
				GROUP BY review_id';

			# Run the query, store the results in the variable $likes
			$likes = DB::instance(DB_NAME)->select_rows($r);
				

			# Pass data to the view
			$view->created = $_POST['created'];
			$view->content = $_POST['content'];
			$view->rating = $_POST['rating'];
			$view->visit_date = $_POST['visit_date'];
			$view->user = $user;
			$view->likes = $likes;
			$view->review = $review;
			
			# Render template
			echo $view;
		}

    }

	
   public function delete($review_id, $restaurant_id) {

   
   		$review_id = DB::instance(DB_NAME)->sanitize($review_id);
   		$restaurant_id = DB::instance(DB_NAME)->sanitize($restaurant_id);	
		
		# Delete this review
		$where_condition = 'WHERE review_id = '.$review_id;
		DB::instance(DB_NAME)->delete('reviews', $where_condition);

		# Send back to posts
		Router::redirect("/restaurants/review/".$restaurant_id);

    }	
	



	public function user($user_id=null) {


   		$user_id = DB::instance(DB_NAME)->sanitize($user_id);	
		# Set up the View
		$this->template->content = View::instance("v_reviews_user");
		$this->template->title   = "User's Reviews";	

		# Get user's profile stats
		# Query
		$p = 'SELECT first_name, last_name, city, state
				FROM users
				WHERE users.user_id = '.$user_id ;

		# Run the query, store the results in the variable $user
		$user = DB::instance(DB_NAME)->select_row($p);				
				
	

		# Get a list of reviews given by user
		$q = 'SELECT reviews.restaurant_id as restaurant_id, restaurants.name as name, restaurants.city as city, restaurants.state as state, reviews.rating as rating , reviews.created as created
			FROM reviews join restaurants on restaurants.restaurant_id = reviews.restaurant_id
			WHERE reviews.user_id = '.$user_id.' order by reviews.created DESC';
						
		# Run the query, store the results in the variable $users
		$reviews = DB::instance(DB_NAME)->select_rows($q);		
		
			
		# Pass data to the View
		$this->template->content->user = $user;
		$this->template->content->reviews = $reviews;	
		
		# Render the view
		echo $this->template;
	}		
		
	
	public function users() {
	
		# Set up the View
		$this->template->content = View::instance("v_reviews_users");
		$this->template->title   = "Users List";

		# Get a list of users and the number of reviews given per user
		# Query
		$p = "SELECT users.user_id as user_id, users.first_name as first_name, users.last_name as last_name, count(reviews.user_id) as count, max(reviews.created) as recent
			FROM users left join reviews on users.user_id = reviews.user_id
			group by users.first_name, users.last_name";
						

		# Run the query, store the results in the variable $users
		$users = DB::instance(DB_NAME)->select_rows($p);	
							
			
		# Pass data to the View
		$this->template->content->users = $users;
	
		
		# Render the view
		echo $this->template;
	}





	public function like($review_id, $user_id, $restaurant_id) {
	
	#fill in $input array
	
		
		$compoundindex = $review_id.$user_id;
		$compoundindex = DB::instance(DB_NAME)->sanitize($compoundindex);
		
        # Insert
		$input = Array(	'like_id' => $compoundindex,
						'created' => Time::now(), 
						'review_id' => $review_id,
						'user_id' => $user_id,
						);
						
        # Note we didn't have to sanitize any of the data because we're using the insert method which does it for us
        DB::instance(DB_NAME)->update_or_insert_row('likes', $input);			

		# Send them to the posts page
		Router::redirect("/restaurants/review/".$restaurant_id);			
	}
	

	
}
