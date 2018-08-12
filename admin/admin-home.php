<!--PHP page variables and include head.php for HTML head, header and navigation-->
<?php 
session_start();
//force HTTPS
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

// If session variable is not set it will redirect to login page and store location of referring page to redirect user back to after successful login
if(!isset($_SESSION['username']) || empty($_SESSION['username']))
{
	$_SESSION['referer'] = "Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  header("location: ../login/login.php");
  exit;
}

//page metadata
$pagename='Admin Home'; 
$pageurl='/admin/admin-home.php';
include('../back/admin-head.php'); 

?>
<main class="main-content">
	<div class="fullwidth-block">
		<div class="container">
			<div class="row">
				<div class="content col-md-10 ">
                    <h2> Welcome to the Admin Home Page</h2> Use the navigation bar to administer Heritagesda.com content.
</div>
</div>
</div>
</div>
</main>
<?php include('../footer.php'); ?> <!-- Site Footer contained in external file -->

</html>