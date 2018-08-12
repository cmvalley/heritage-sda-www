<?php
session_start();
//get referring address, if none send to home page after logout
if (stripos($_SESSION['referer'],"admin") !==false || stripos($_SESSION['referer'],"login") !==false)
{
    $referer = "Location: https://" . $_SERVER["HTTP_HOST"] . "/index.php";
}
else
{
    $referer = $_SESSION['referer'];
}
// remove all session variables
session_unset();
//remove session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// destroy the session 
session_destroy(); 
//send to referer
header($referer);
?>