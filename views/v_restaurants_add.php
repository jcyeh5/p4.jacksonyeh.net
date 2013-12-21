<div class="mainframe">
	<div id='restaurantinfobox'> 
		<h2>Add a Restaurant</h2>

		<!-- Sign Up Form -->
		<?php if($purpose == 'add'): ?>	
			<form method='POST' action='/restaurants/p_add'>
		<?php else: ?>	
			<form method='POST' action='/restaurants/p_add/<?=$restaurant['restaurant_id']?>'>
		<?php endif; ?>	
			<span class="list_label">
			Restaurant Name:&nbsp &nbsp <input type='text' name='name' size='50' value="<?=$restaurant['name']?>" ><br><br>

			Address:&nbsp &nbsp <input type='text' name='address' size='50'value="<?=$restaurant['address']?>" ><br><br>

			City:&nbsp &nbsp <input type='text' name='city' value="<?=$restaurant['city']?>"  ><br><br>		

			State: &nbsp &nbsp <input type='text' name='state' size='2' value="<?=$restaurant['state']?>"  ><br><br>	

			Zip  &nbsp &nbsp <input type='text' name='zip' size='5' value="<?=$restaurant['zip']?>"  ><br><br>	
			
			Phone &nbsp &nbsp <input type='text' name='phone' value="<?=$restaurant['phone']?>"  ><br><br>	
			
			website &nbsp &nbsp <input type='text' name='website' value="<?=$restaurant['website']?>"   ><br><br>				

		<div class="restaurantinfobox">	
			Category<br>
		   <input type='text' name='category' value="<?=$restaurant['category']?>"   >  	   
			<br><br>
			
			Ambience<br>
		   <input type='text' name='ambience' value="<?=$restaurant['ambience']?>" >  	   
			<br><br>		
			
			Attire<br>
		   <input type='text' name='attire' value="<?=$restaurant['attire']?>"  >  	   
			<br><br>
		
			Accept Credit Cards<br>
		   <input type='text' name='credit_cards' value="<?=$restaurant['credit_cards']?>"  >  	   
			<br><br>		
		</div>
		<div class="restaurantinfobox">	
			Price Range<br>
		   <input type='text' name='price_range' value="<?=$restaurant['price_range']?>"  >  	   
			<br><br>

			
			Good For Groups<br>
		   <input type='text' name='groups' value="<?=$restaurant['groups']?>"  >  	   
			<br><br>

			
			Good For Kids<br>
		   <input type='text' name='kids' value="<?=$restaurant['kids']?>"  >  	   
			<br><br>

			Take Reservations<br>
		   <input type='text' name='reservations' value="<?=$restaurant['reservations']?>"  >  	   
			<br><br>
		</div>
		<div class="restaurantinfobox">	
			Delivery<br>
		   <input type='text' name='delivery' value="<?=$restaurant['delivery']?>"  >  	   
			<br><br>	

			Takeout<br>
		   <input type='text' name='takeout' value="<?=$restaurant['takeout']?>"  >  	   
			<br><br>		

			Waiter Serice<br>
		   <input type='text' name='waiter' value="<?=$restaurant['waiter']?>"  >  	   
			<br><br>	


			Seagal's Rating<br>
		   <input type='text' name='seagal_rating' value="<?=$restaurant['seagal_rating']?>"   >  	   
			<br><br>			
		</div>	

			Seagal's Review<br>
			<textarea name='seagal_review' value="<?=$restaurant['seagal_review']?>"  ></textarea>	


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

