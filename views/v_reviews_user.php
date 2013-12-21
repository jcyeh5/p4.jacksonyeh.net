<div class="mainframe">
	<div id='restaurantinfobox'> 
		Reviews by: <br>
		<?=$user['first_name']?> <?=$user['last_name']?> <br>
		 <?=$user['city']?> <?=$user['state']?>

		<br>
		<br>
		 <!-- Display list of reviews by the user -->
		<?php foreach($reviews as $review): ?>
			<!-- Print this review details -->	
			<div class="reviews_user_listbox">	

				<div class="review_user_list_name listitem">
					<a href='/restaurants/review/<?=$review['restaurant_id']?>'><?=$review['name']?>  </a> 
				</div>
				<div class="review_user_list_city listitem">
					<?=$review['city']?> <?=$review['state']?>
				</div>
				<div class="review_user_list_city listitem">
						Rating: <?=$review['rating']?> 
				</div>
				<div class="review_users_list_date listitem">
						Date: <span><time datetime="<?=Time::display($review['created'],'Y-m-d H:i')?>"> <?=Time::display($review['created'])?> </time>
				</div>	

			</div>
		<?php endforeach; ?>
	</div>
</div>
