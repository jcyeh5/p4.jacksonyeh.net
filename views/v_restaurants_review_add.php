<div class = "review">
	<article>		
		<div class="review_heading_left">
			<p class="review_author"><?=$user['first_name']?> <?=$user['last_name']?></p>
			<time class="reviw_time" datetime="<?=Time::display($created,'Y-m-d H:i')?>"><?=Time::display($created)?></time>
		</div>
		<div class="review_heading_right">
			<span class="list_label">Restaurant Rating:</span> <?=$rating?><br>
			<span class="list_label">Visit Date:</span> <?=$visit_date?><br>
		</div>
		<p class="review_content"><?=$content?></p>

		<!-- menu buttons for each review -->			
		<div class="review_submenu" > 
			<ul>
			<!-- Display Delete button -->
				<li><a href='/reviews/delete/<?=$review['review_id']?>/<?=$review['restaurant_id']?>'><img src="/images/delete.png" alt="delete this review"></a> </li>
	
			<!-- Display LIKE button  -->
				<li><a href='/reviews/like/<?=$review['review_id']?>/<?=$user['user_id']?>/<?=$review['restaurant_id']?> '><img class="like_img" src="/images/like.png" alt="like this review"></a></li>

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