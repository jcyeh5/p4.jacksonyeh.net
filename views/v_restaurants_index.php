<div class="mainframe">

	<?php if($purpose == 'edit'): ?>
		<h1> Edit A Bistro </h2>
	<?php else: ?>
		<h1> Review A Bistro </h2>
		<h3> Here is a hand picked list of places that I would personally recommend. </h3>
		- 'Chef' Steven Seagal
	<?php endif; ?>		

	<br><br>

	<!-- If there are no restaurants -->
	<?php  if (empty($restaurants) ): ?>
		<div class = "mainframe">
			<p> there are no restaurants </p>
		</div>
	<?php endif; ?>

	<!-- Display list of restaurants -->
	<?php foreach($restaurants as $restaurant): ?>

		<div class="listbox">	
			<div class ="restaurant_Listitem listitem">
				<div class="restaurant_Listitem_left listitem">		
					<!-- if adding a review -->
					<?php if($purpose == 'edit'): ?>
						<span id="restaurant_name" class="restaurant_name"><a  href='/restaurants/add/<?=$restaurant['restaurant_id']?>'><?=$restaurant['name']?></a></span><br>
					<?php else: ?>	
					<!-- else editing restaurant info -->					
						<span id="restaurant_name" class="restaurant_name"><a  href='/restaurants/review/<?=$restaurant['restaurant_id']?>'><?=$restaurant['name']?></a></span><br>
					<?php endif; ?>						
					<span class="list_label">
						Category:
					</span> 
					<?=$restaurant['category']?> <br>
					<span class="list_label">
						Price Range:
					</span> 
					<?=$restaurant['price_range']?>
				
				</div>
				<div class="restaurant_Listitem_right listitem">
					<?=$restaurant['address']?> <br>
					<?=$restaurant['city']?>, <?=$restaurant['state']?>  <?=$restaurant['zip']?>
					<br><br>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

</div>