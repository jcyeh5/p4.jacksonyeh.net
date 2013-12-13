<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<link href= "/css/style.css" type="text/css" rel="stylesheet"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
	<div id="wrapper">
		<div id="header">
	
				<a href='/' id="headerimage" title="My Two Cents"><h1>My Two Cents</h1></a>
		
			<div id="headernav">
				<ul id="mainnav">
					<li id="mainnav_home"><a href='/'>Home</a></li>

					<!-- Menu for users who are logged in -->
					<?php if($user): ?>
						<li id="mainnav_readopinions"><a href='/posts/index'>Read Opinions</a></li>
						<li id="mainnav_postopinions"><a href='/posts/add'>Post Opinions</a></li>
						<li id="mainnav_members"><a href='/posts/users'>Members</a></li>
						<li id="mainnav_editprofile"><a href='/users/profile'>Edit Profile</a></li>
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