<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<link href= "/css/jystyle.css" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" href="/css/validationEngine.jquery.css" type="text/css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
	<div id="wrapper">
		<div id="header">
	
				<a href='/' id="headerimage" title="Good Cookin"><h1>Good Cookin</h1></a>
		
			<div id="headernav">
				<ul id="mainnav">
					<li id="mainnav_home"><a href='/'>Home</a></li>

					<!-- Menu for users who are logged in -->
					<?php if($user): ?>
						<li id="mainnav_postopinions"><a href='/restaurants/index'>Review Bistro</a></li>

						<?php if ($user->email=='admin@g.com'):?>
						<li id="mainnav_postopinions"><a href='/restaurants/add'>Add Bistro</a></li>
						<li id="mainnav_postopinions"><a href='/restaurants/index/edit'>Edit Bistro</a></li>						
						<?php endif; ?>
						
						<li id="mainnav_members"><a href='/reviews/users'>Find People</a></li>
						<li id="mainnav_editprofile"><a href='/users/profile'>About Me</a></li>
						<li id="mainnav_logout"><a href='/users/logout'>Logout</a></li>

					<!-- Menu options for users who are not logged in -->
					<?php else: ?>				
						<li id="mainnav_login"><a href='/users/login'>Log in</a></li>
						<li id="mainnav_signup"><a href='/users/signup'>Sign up</a></li>
					<?php endif; ?>					

				</ul>
			</div>
		</div>
		
		<div id="content">
			<?php if(isset($content)) echo $content; ?>
			<?php if(isset($client_files_body)) echo $client_files_body; ?>
		</div>
	</div>
</body>
</html>