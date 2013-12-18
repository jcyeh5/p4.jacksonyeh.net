<!-- If there are no posts -->
<?php  if (empty($posts) ): ?>
	<div class = "mainframe">
		<p> the people you are following have no opinions... please follow some other <a href="/posts/users/">people</a> </p>
	</div>
<?php endif; ?>

<!-- Display list of posts -->
<?php foreach($posts as $post): ?>
	<div class = "post">
		<article>		
			<p class="post_author"><?=$post['first_name']?> <?=$post['last_name']?></p>
			<time class="post_time" datetime="<?=Time::display($post['created'],'Y-m-d H:i')?>">
				<?=Time::display($post['created'])?>
			</time>
			
			<p class="post_content"><?=$post['content']?></p>

			<!-- menu buttons for each post -->			
			<div class="post_submenu" > 
				<ul>
					<!-- Display Delete button only for own posts -->
					<?php if($user->user_id == $post['post_user_id']): ?>
					<li><a href='/posts/delete/<?=$post['post_id']?>'><img src="/images/delete.png" alt="delete this post"></a> </li>
					<?php endif; ?>		
					
					<!-- Display LIKE button only for own posts -->
					<li><a href='/posts/like/<?=$post['post_id']?>/<?=$user->user_id?>'> <img class="like_img" src="/images/like.png" alt="like this post"></a></li>

					<!-- If there are any LIKEs for this post -->
					<?php foreach ($likes as $like): ?>
						<?php if ($like['post_id'] == $post['post_id']): ?>
							<li><p class="likes_count">likes: <?=$like['num_likes']?> </p></li>	
						<?php endif; ?>		
					<?php endforeach; ?>
				</ul>
			</div>

		</article>
	</div>
<?php endforeach; ?>