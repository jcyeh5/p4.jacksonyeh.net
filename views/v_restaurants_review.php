<div class="mainframe">
	<!-- If there is no restaurant-->
	<?php  if (empty($restaurant) ): ?>
		<div class = "mainframe">
			<p> no restaurant found </p>
		</div>
	<?php endif; ?>


<div id="restaurantinfobox">
	<div id="restaurantinfobox_left">
		<span class="restaurant_name">
			<?=$restaurant['name']?><br>
		</span>
		<?=$restaurant['address']?><br>
		<?=$restaurant['city']?>, <?=$restaurant['state']?> <?=$restaurant['zip']?><br>
		<?=$restaurant['phone']?><br>
		<?=$restaurant['website']?><br><br><br>

		<span class="list_label">Category:</span>  <?=$restaurant['category']?>
		<br>	
		<span class="list_label">Accept Credit Cards:</span>  <?=$restaurant['credit_cards']?>
		<br>
		<span class="list_label">Price Range:</span>  <?=$restaurant['price_range']?>
		<br>
</div>	
	<div id="restaurantinfobox_middle">
		<span class="list_label">Ambience:</span> <?=$restaurant['ambience']?>
		<br>	
		<span class="list_label">Attire:</span> <?=$restaurant['attire']?>
		<br>		
		<span class="list_label">Good For Groups:</span> <?=$restaurant['groups']?>
		<br>
		<span class="list_label">Good For Kids:</span> <?=$restaurant['kids']?>
		<br>
		<span class="list_label">Take Reservations:</span> <?=$restaurant['reservations']?>
		<br>
		<span class="list_label">Delivery:</span> <?=$restaurant['delivery']?>
		<br>
		<span class="list_label">Takeout:</span> <?=$restaurant['takeout']?>
		<br>
		<span class="list_label">Waiter Serice:</span> <?=$restaurant['waiter']?>
		<br>
		<span class="list_label">Outdoor Seating:</span> <?=$restaurant['outdoor']?>
		<br>
</div>
	<div id="restaurantinfobox_right">	
		<div id="seagal_rating_box">
			<span id="seagal_rating_label">Seagal Rating:</span><br>
			<span id="seagal_rating"><?=$restaurant['seagal_rating']?></span><br>
		</div>
		<br><br><br><br><br>
	</div>	
	<br>	<br>
	<span class="list_label">Review:</span> <?=$restaurant['seagal_review']?><br>
	<br>	
	</div>	
		Submit Your Review: <br>
		<form id="add_new_review">
			<label for='content'>New Post:</label><br>
			<input type='hidden' name='restaurant_id' id="ajax_restaurant_id" value="<?=$restaurant['restaurant_id']?>" >	
			<div id='review_entry_status'></div>
			<textarea name='content' id="contenttextarea"></textarea>
	<label for='rating'>Rating (0-10):</label><br>
			<input type='text' name='rating'>
			<br>		
			<input type='submit' id='post-btn' value='POST'>
		</form>
		
	<div id="user_review_box">
		<!-- Display list of reviews -->
		<?php foreach($reviews as $review): ?>
			<div class = "review">
				<article>		
					<p class="review_author"><?=$review['first_name']?> <?=$review['last_name']?></p>
					<time class="reviw_time" datetime="<?=Time::display($review['created'],'Y-m-d H:i')?>">
						<?=Time::display($review['created'])?>
					</time>
					
					<p class="review_content"><?=$review['content']?></p>

					<!-- menu buttons for each review -->			
					<div class="review_submenu" > 
						<ul>
							<!-- Display Delete button only for user's own reviews -->
							<?php if($user->user_id == $review['review_user_id']): ?>
							<li><a href='/reviews/delete/<?=$review['review_id']?>/<?=$review['restaurant_id']?>'><img src="/images/delete.png" alt="delete this review"></a> </li>
							<?php endif; ?>		
							
							<!-- Display LIKE button only for own reviews -->
							<li><a href='/reviews/like/<?=$review['review_id']?>/<?=$user->user_id?>/<?=$review['restaurant_id']?>'> <img class="like_img" src="/images/like.png" alt="like this review"></a></li>

							<!-- If there are any LIKEs for this post -->
							<?php foreach ($likes as $like): ?>
								<?php if ($like['review_id'] == $review['review_id']): ?>
									<li><p class="likes_count">likes: <?=$like['num_likes']?> </p></li>	
								<?php endif; ?>		
							<?php endforeach; ?>
						</ul>
					</div>

				</article>
			</div>
		<?php endforeach; ?>
	</div>
</div>