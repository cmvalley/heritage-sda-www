<?php 
session_start();
$title='Heritage Seventh-Day Adventist Church - ' . $pagename; 
$class = $login_msg = $auth_link = '';
if(isset($_SESSION['username']) || !empty($_SESSION['username']))
{
	$login_msg='Welcome ' . ucwords($_SESSION['username']);
	$auth_link='<a href="../login/logout.php">Sign Out</a>';
}
else
{ 
    $auth_link='<a href="../login/login.php">Sign In</a>';
    // If session variable is not set it will redirect to login page and store location of referring page to redirect user back to after successful login
	$_SESSION['referer'] = "Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("location: ../login/login.php");
    exit;
}
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
            <?php
            //get files in admin directory
            $admin_dir="../admin/";
            $admin_files = scandir($admin_dir);
            $admin_files = array_diff(scandir($admin_dir),array('.','..'));
            //sort $admin_files so that Admin Home first, then alphabetical
            rsort($admin_files);
            array_unshift($admin_files,"admin-home.php");
            $admin_files = array_unique($admin_files);
            //loop through array and format url links
            foreach ($admin_files as $admin_file) 
            {
                if(strtolower(pathinfo($admin_file,PATHINFO_EXTENSION)) == "php")
                {
                    $admin_link_array = explode("-",$admin_file);
                    $admin_link_name = implode(" ",$admin_link_array);
                    $admin_link_name = str_replace(".php","",$admin_link_name);
                    $admin_link_name = ucwords($admin_link_name);
                    $admin_url = $admin_dir . $admin_file;
                    $admin_href = '<br /> <a href="'.$admin_url.'">'.$admin_link_name.'</a> <br />';
                    if(str_replace("..","",$admin_url)==$_SERVER["REQUEST_URI"])
                    {
                        $class = "menu-item current-menu-item";
                    }
                    else
                    {
                        $class = "menu-item";
                    }
                    $li = '<li class="'.$class.'"><a href="'.$admin_url.'">'.$admin_link_name.'</a></li>';
                    echo $li;
                }
            }
            ?>
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