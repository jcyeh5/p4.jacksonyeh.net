<div class="mainframe">
	<div id='restaurantinfobox'> 
		<h2>Add a Restaurant</h2>

		<!-- Sign Up Form -->
		<form method='POST' action='/restaurants/p_add'>

			<span class="list_label">
			Restaurant Name:&nbsp &nbsp <input type='text' name='name' size='50'><br><br>

			Address:&nbsp &nbsp <input type='text' name='address' size='50'><br><br>

			City:&nbsp &nbsp <input type='text' name='city'><br><br>		

			State: &nbsp &nbsp <input type='text' name='state' size='2'><br><br>	

			Zip  &nbsp &nbsp <input type='text' name='zip' size='5'><br><br>	
			
			Phone &nbsp &nbsp <input type='text' name='phone'><br><br>	
			
			website &nbsp &nbsp <input type='text' name='website'><br><br>				

		<div class="restaurantinfobox">	
			Category<br>
		   <input type='text' name='category'>  	   
			<br><br>
			
			Ambience<br>
		   <input type='text' name='ambience'>  	   
			<br><br>		
			
			Attire<br>
		   <input type='text' name='attire'>  	   
			<br><br>
		
			Accept Credit Cards<br>
		   <input type='text' name='credit_cards'>  	   
			<br><br>		
		</div>
		<div class="restaurantinfobox">	
			Price Range<br>
		   <input type='text' name='price_range'>  	   
			<br><br>

			
			Good For Groups<br>
		   <input type='text' name='groups'>  	   
			<br><br>

			
			Good For Kids<br>
		   <input type='text' name='kids'>  	   
			<br><br>

			Take Reservations<br>
		   <input type='text' name='reservations'>  	   
			<br><br>
		</div>
		<div class="restaurantinfobox">	
			Delivery<br>
		   <input type='text' name='delivery'>  	   
			<br><br>	

			Takeout<br>
		   <input type='text' name='takeout'>  	   
			<br><br>		

			Waiter Serice<br>
		   <input type='text' name='waiter'>  	   
			<br><br>	


			Seagal's Rating<br>
		   <input type='text' name='seagal_rating'>  	   
			<br><br>			
		</div>	

			Seagal's Review<br>
			<textarea name='seagal_review' ></textarea>	

		
			<br>
			<input type='submit' value='Add Restaurant'>
		</span>
		</form>
	</div>
</div>

