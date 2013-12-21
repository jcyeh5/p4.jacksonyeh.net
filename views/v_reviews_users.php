<div class="mainframe">
	<!-- Display list of users -->

	<?php foreach($users as $user): ?>

		<div class="listbox">			 
			<!-- Display user's name -->
			<div class="review_user_list_name listitem">
				<a href='/reviews/user/<?=$user['user_id']?>'><?=$user['first_name']?> <?=$user['last_name']?> </a>
			</div>
			<div class="review_user_list_reviews listitem">
				<span class="list_label">
					Reviews:
				</span>	
				<?=$user['count']?>				
			</div>
			<div class="review_user_list_date listitem">			
				<span class="list_label">
					Most Recent Review:
				</span>
				<time datetime="<?=Time::display($user['recent'],'Y-m-d H:i')?>"> <?=Time::display($user['recent'])?> </time>
			</div>
		</div>
		
	<?php endforeach; ?>
</div>
