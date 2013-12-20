<div class="mainframe">
Reviews by: <br>
<?=$user['first_name']?> <?=$user['last_name']?> <br>
 <?=$user['city']?> <?=$user['state']?>

<br>
<br>
 <!-- Display list of reviews by the user -->
	<?php foreach($reviews as $review): ?>

		<span class="reviews_users_name">	

		 
			<!-- Print this review details -->
			<?php echo "  "?>
			<a href='/restaurants/review/<?=$review['restaurant_id']?>'><?=$review['name']?>  </a> <?=$review['city']?> <?=$review['state']?>
			Rating: <?=$review['rating']?>    
			Date: <span><time datetime="<?=Time::display($review['created'],'Y-m-d H:i')?>"> <?=Time::display($review['created'])?> </time>
			<br><br>	
		</span>
		
	<?php endforeach; ?>
</div>
