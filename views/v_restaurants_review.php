<!-- If there is no restaurant-->
<?php  if (empty($restaurant) ): ?>
	<div class = "mainframe">
		<p> no restaurant found </p>
	</div>
<?php endif; ?>



	<?=$restaurant['name']?><br>
	Address: <?=$restaurant['address']?><br>

		City: <?=$restaurant['city']?><br>
	

		State: <?=$restaurant['state']?><br>
	

		Zip: <?=$restaurant['zip']?><br>

		
		Phone: <?=$restaurant['phone']?><br>

		
		website: <?=$restaurant['website']?><br>
			

		Category: <?=$restaurant['category']?><br>

		

		Ambience: <?=$restaurant['ambience']?><br>
	
		
		Attire: <?=$restaurant['attire']?><br>

	
		Accept Credit Cards: <?=$restaurant['credit_cards']?><br>
	


		Price Range: <?=$restaurant['price_range']?><br>


		
		Good For Groups: <?=$restaurant['groups']?><br>

		
		Good For Kids: <?=$restaurant['kids']?><br>

		Take Reservations: <?=$restaurant['reservations']?><br>

		Delivery: <?=$restaurant['delivery']?><br>
	

		Takeout: <?=$restaurant['takeout']?><br>
		

		Waiter Serice: <?=$restaurant['waiter']?><br>

		Outdoor Seating: <?=$restaurant['outdoor']?><br>
		
		Seagal Rating: <?=$restaurant['seagal_rating']?><br>
		
		Seagal Review: <?=$restaurant['seagal_review']?><br>
		
		
		User Reviews: <br>
		<label for='content'>New Post:</label><br>
		<div id="ajax_restaurant_id"><?=$restaurant['restaurant_id']?></div>
			
		<textarea name='content' id="contenttextarea"></textarea>	
		<br>		
		<input type='button' id='post-btn' value='POST'>
		
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
						<!-- Display Delete button only for own reviews -->
						<?php if($user->user_id == $review['review_user_id']): ?>
						<li><a href='/reviews/delete/<?=$review['review_id']?>'><img src="/images/delete.png" alt="delete this review"></a> </li>
						<?php endif; ?>		
						
						<!-- Display LIKE button only for own reviews -->
						<li><a href='/review/like/<?=$review['review_id']?>/<?=$user->user_id?>'> <img class="like_img" src="/images/like.png" alt="like this review"></a></li>

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