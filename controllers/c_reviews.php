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

    public function add() {
	
		# Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

		
        # Insert
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
 		$view->user = $user;
		$view->likes = $likes;
		$view->review = $review;
		
		# Render template
        echo $view;

    }

    public function p_add() {
 


        # Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
        DB::instance(DB_NAME)->insert('posts', $_POST);

		# Send back to posts
		Router::redirect("/posts/index");

    }
	
   public function delete($review_id, $restaurant_id) {

   
   		$review_id = DB::instance(DB_NAME)->sanitize($review_id);
		# Delete this review
		$where_condition = 'WHERE review_id = '.$review_id;
		DB::instance(DB_NAME)->delete('reviews', $where_condition);

		# Send back to posts
		Router::redirect("/restaurants/review/".$restaurant_id);

    }	
	
	public function index() {
	
		# Set up the View
		$this->template->content = View::instance('v_posts_index');
		$this->template->title   = "All Posts";

		# POSTS
		$q = 'SELECT 
				posts.post_id,
				posts.content,
				posts.created,
				posts.user_id AS post_user_id,
				users_users.user_id AS follower_id,
				users.first_name,
				users.last_name
			FROM posts
			INNER JOIN users_users 
				ON posts.user_id = users_users.user_id_followed
			INNER JOIN users 
				ON posts.user_id = users.user_id
			WHERE users_users.user_id = '.$this->user->user_id .'  
			ORDER BY posts.created DESC';

		# Run the query, store the results in the variable $posts
		$posts = DB::instance(DB_NAME)->select_rows($q);


		# LIKES
		$p = 'SELECT
				post_id,
				COUNT(like_id) as num_likes
			FROM likes
			GROUP BY post_id';

		# Run the query, store the results in the variable $likes
		$likes = DB::instance(DB_NAME)->select_rows($p);
			
		# Pass data to the View
		$this->template->content->posts = $posts;
		$this->template->content->likes = $likes;		
		$this->template->content->user = $this->user;
		
		# Render the View
		echo $this->template;

	}


	public function user() {
	
		# Set up the View
		$this->template->content = View::instance("v_reviews_user");
		$this->template->title   = "User's Reviews";	

		# Get user's profile stats
		# Query
		$p = 'SELECT first_name, last_name, city, state
				FROM users
				WHERE users.user_id = '.$this->user->user_id ;

		# Run the query, store the results in the variable $user
		$user = DB::instance(DB_NAME)->select_row($p);				
				
	

		# Get a list of reviews given by user
		$q = 'SELECT reviews.restaurant_id as restaurant_id, restaurants.name as name, restaurants.city as city, restaurants.state as state, reviews.rating as rating , reviews.created as created
			FROM reviews join restaurants on restaurants.restaurant_id = reviews.restaurant_id
			WHERE reviews.user_id = '.$this->user->user_id.' order by reviews.created DESC';
						
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
