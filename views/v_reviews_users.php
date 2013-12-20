<div class="mainframe">
	<!-- Display list of users -->
	<?php foreach($users as $user): ?>

		<span class="reviews_users_name">	

		 
			<!-- Print this user's name -->
			<?php echo "  "?>
			<a href='/reviews/user/<?=$user['user_id']?>'><?=$user['first_name']?> <?=$user['last_name']?> </a>
			Reviews: <?=$user['count']?>    
			Most Recent: <span><time datetime="<?=Time::display($user['recent'],'Y-m-d H:i')?>"> <?=Time::display($user['recent'])?> </time>
			<br><br>	
		</span>
		
	<?php endforeach; ?>
</div>
