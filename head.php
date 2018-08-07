<?php 
session_start();
$title='Heritage Seventh-Day Adventist Church - ' . $pagename; 
$classcurrentmenuitem='current-menu-item';
$classmenuitem='menu-item';
$class=$classmenuitem . ' ' . $classcurrentmenuitem;
$login_msg = $auth_link = ''
if(isset($_SESSION['username']) || !empty($_SESSION['username']))
{
	$login_msg='Welcome ' . ucwords($_SESSION['username']);
	$auth_link='<a href="../login/logout.php">Sign Out</a>';
}
else{ $auth_link='<a href="../login/login.php">Sign In</a>';}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title><?php echo($title); ?></title>

		<!-- Loading third party fonts -->
		<link href="../fonts/novecento-font/novecento-font.css" rel="stylesheet" type="text/css">
		<link href="../fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- Loading main css file -->
		<link rel="stylesheet" href="../style.css?version=30">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->



	</head>
	<body> <!--Closing body tag in footer -->
		<div align="right">
		<?php echo $login_msg; ?><br>
		<?php echo $auth_link; ?>
	</div>
		<div class="site-content"> <!--Closing site-content div tag in footer-->
			<header class="site-header">
	<div class="container">
		<a href="../index.php" class="branding">
			<img src="../images/SDALogo.png" alt="" class="logo">
			<h1 class="site-title">Heritage Seventh-Day Adventist Church</h1>
		</a>
		<div class="main-navigation">
		<button class="menu-toggle"><i class="fa fa-bars"></i> Menu</button>
		<ul class="menu">
			<li class=<?php if($pagename=='Home'){echo '\'menu-item current-menu-item\'';} else {echo '\'menu-item\'';} ?>><a href='../index.php'>Home <small>Come home</small></a></li>
			<li class=<?php if($pagename=='Sermons'){echo '\'menu-item current-menu-item\'';} else {echo '\'menu-item\'';} ?>><a href="../sermons.php">Sermons <small>Hear the word</small></a></li>
			<li class=<?php if($pagename=='Bible Studies'){echo '\'menu-item current-menu-item\'';} else {echo '\'menu-item\'';} ?>><a href="../biblestudies.php">Bible Studies <small>Study the Word</small></a></li>
			<!--<li class="menu-item"><a href="events.html">Events <small>Join in</small></a></li>-->
			<li class=<?php if($pagename=='Events'){echo '\'menu-item current-menu-item\'';} else {echo '\'menu-item\'';} ?>><a href="../events.php">Events <small>Join in</small></a></li>
			<li class=<?php if($pagename=='Contact Us'){echo '\'menu-item current-menu-item\'';} else {echo '\'menu-item\'';} ?>><a href="../contact.php">Contact <small>Reach out</small></a></li>
		</ul>
	</div>
		<div class="mobile-navigation"></div>
	</div>
</header> <!-- .site-header -->
<?php
	if ($pagename != 'Home')
	{
		
		$pagehead = '<div class="page-head" data-bg-image="/images/page-head-1.jpg">
				<div class="container">
					<h2 class="page-title">' . $pagename . '</h2>
				</div>
			</div>';
			echo $pagehead;
	}
?>