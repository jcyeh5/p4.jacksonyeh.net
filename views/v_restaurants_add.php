<div class="mainframe">
	<div id='restaurantinfobox'> 
		<h2>Add a Bistro</h2>

		<!-- Sign Up Form -->
		<?php if($purpose == 'add'): ?>	
			<form id="add_restaurant_form" method='POST' action='/restaurants/p_add'>
		<?php else: ?>	
			<form id="add_restaurant_form" method='POST' action='/restaurants/p_add/<?=$restaurant['restaurant_id']?>'>
		<?php endif; ?>	

		<span class="list_label">
		Restaurant Name:&nbsp; &nbsp; <input type='text' name='name' size='50' value="<?=$restaurant['name']?>" class="validate[required] text-input" data-prompt-position ="centerRight" ><br><br>

		Address:&nbsp; &nbsp; <input type='text' name='address' size='50' value="<?=$restaurant['address']?>" class="validate[required] text-input" data-prompt-position ="centerRight"><br><br>

		City:&nbsp; &nbsp; <input type='text' name='city' value="<?=$restaurant['city']?>" class="validate[required] text-input" data-prompt-position ="centerRight" ><br><br>		

		State: &nbsp; &nbsp; <input type='text' name='state' size='2' value="<?=$restaurant['state']?>" class="validate[required] text-input" data-prompt-position ="centerRight" ><br><br>	

		Zip  &nbsp; &nbsp; <input type='text' name='zip' size='5' value="<?=$restaurant['zip']?>" class="validate[required] text-input" data-prompt-position ="centerRight" ><br><br>	
			
		Phone &nbsp; &nbsp; <input type='text' name='phone' value="<?=$restaurant['phone']?>" class="validate[required] text-input" data-prompt-position ="centerRight"><br><br>	
			
		website &nbsp; &nbsp; <input type='text' name='website' value="<?=$restaurant['website']?>" class="validate[custom[url]] text-input" data-prompt-position ="centerRight"  ><br><br>				
	
		<div class="restaurantinfobox">	
			Category<br>
			<input type='text' name='category' value="<?=$restaurant['category']?>" class="validate[required] text-input"  >  	   
			<br><br>
				
			Ambience<br>
			<input type='text' name='ambience' value="<?=$restaurant['ambience']?>" class="validate[required] text-input">  	   
			<br><br>		
				
			Attire<br>
			<input type='text' name='attire' value="<?=$restaurant['attire']?>" class="validate[required] text-input" >  	   
			<br><br>
			
			Accept Credit Cards<br>
			<input type='text' name='credit_cards' value="<?=$restaurant['credit_cards']?>" class="validate[required, custom[YesNo]] text-input" >  	   
			<br><br>		
		</div>
		<div class="restaurantinfobox">	
			Price Range<br>
			<input type='text' name='price_range' value="<?=$restaurant['price_range']?>" class="validate[required, custom[pricerange]] text-input" >  	   
			<br><br>

			Good For Groups<br>
			<input type='text' name='groups' value="<?=$restaurant['groups']?>" class="validate[required, custom[YesNo]] text-input" >  	   
			<br><br>

			Good For Kids<br>
			<input type='text' name='kids' value="<?=$restaurant['kids']?>" class="validate[required, custom[YesNo]] text-input" >  	   
			<br><br>

			Take Reservations<br>
			<input type='text' name='reservations' value="<?=$restaurant['reservations']?>" class="validate[required, custom[YesNo]] text-input" >  	   
			<br><br>
		</div>
		<div class="restaurantinfobox">	
			Delivery<br>
			<input type='text' name='delivery' value="<?=$restaurant['delivery']?>" class="validate[required, custom[YesNo]] text-input" >  	   
			<br><br>	

			Takeout<br>
			<input type='text' name='takeout' value="<?=$restaurant['takeout']?>" class="validate[required, custom[YesNo]] text-input" >  	   
			<br><br>		

			Waiter Serice<br>
			<input type='text' name='waiter' value="<?=$restaurant['waiter']?>" class="validate[required, custom[YesNo]] text-input"  >  	   
			<br><br>	


			Seagal's Rating<br>
			<input id='restaurant_add_seagal_rating' type='text' name='seagal_rating' value="<?=$restaurant['seagal_rating']?>" class="validate[required, custom[integer]] min[1] max[10]"  >  	   
			<br><br>			
		</div>	

		Seagal's Review<br>
		<textarea  name='seagal_review' class="reviewtextarea validate[required] text-input" ><?=$restaurant['seagal_review']?></textarea>	
		<br>
				
		<?php if($purpose == 'add'): ?>	
			<input type='submit' value='Add Restaurant'>
		<?php else: ?>		
			<input type='submit' value='Update Restaurant'>
		<?php endif; ?>			
		</span>
		</form>
	</div>
</div>

