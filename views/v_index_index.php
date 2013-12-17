<div class="mainframe">
	<div id="indextopdiv">
		<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1>
	</div>
	<div id="indexbottomdiv">
	<!-- list user statistics-->
		<ul>
			<li><h2>Name: <span class="stat"><?=$user->first_name?> <?=$user->last_name?></span></h2></li>
			<li><h3>Email: <span class="stat"> <?=$user->email?> </span></h3></li>
			<li><h3>Number reviews I have given:  <span class="stat"><?=$reviews['num_reviews']?> </span></h3></li>
			<li><h3>My latest review: 	 <span class="stat"><time datetime="<?=Time::display($lastreview['created'],'Y-m-d H:i')?>"> <?=Time::display($lastreview['created'])?> </time> </span></h3></li>
		</ul>
	</div>
</div>


