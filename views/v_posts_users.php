<div class="mainframe">
	<!-- Display list of users -->
	<?php foreach($users as $user): ?>

		<span class="post_users_name">	
			<!-- If there exists a connection with this user, show a unfollow link -->
			<?php if(isset($connections[$user['user_id']])): ?>
				<a href='/posts/unfollow/<?=$user['user_id']?>'><img height=15 width=47 class="followbutton" src="/images/unfollow.png" alt="unfollow this user"></a>

			<!-- Otherwise, show the follow link -->
			<?php else: ?>
				<a href='/posts/follow/<?=$user['user_id']?>'><img height=15 width=47 src="/images/follow.png" alt="follow this user"></a>
			<?php endif; ?>
		 
			<!-- Print this user's name -->
			<?php echo "  "?><?=$user['first_name']?> <?=$user['last_name']?>
			<br><br>	
		</span>
		
	<?php endforeach; ?>
</div>
