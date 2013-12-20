<!-- If there are no restaurants -->
<?php  if (empty($restaurants) ): ?>
	<div class = "mainframe">
		<p> there are no restaurants </p>
	</div>
<?php endif; ?>

<!-- Display list of restaurants -->
<?php foreach($restaurants as $restaurant): ?>
	<div class = "restaurant">
		<div id="restaurant_Listitem_left">		
			<span id="restaurant_name"><a href='/restaurants/review/<?=$restaurant['restaurant_id']?>'><?=$restaurant['name']?></a></span><br>
			<span class="restaurant_list_label">Category:</span> <?=$restaurant['category']?> <br>
			<span class="restaurant_list_label">Price Range:</span> <?=$restaurant['price_range']?>
		
		</div>
		<div id="restaurant_Listitem_right">
			<p>
				<?=$restaurant['address']?> <br>
				<?=$restaurant['city']?>, <?=$restaurant['state']?>  <?=$restaurant['zip']?>
				<br>
			</p>
		</div>
	</div>
<?php endforeach; ?>