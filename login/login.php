<?php
session_start();
//page metadata
$pagename='Login'; 
$pageurl='/login/login.php';
//force HTTPS
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
// Include config file
require_once '../back/db_connect_read.php';
require '../head.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
        // Prepare a select statement
        $sql = "SELECT m_uid, m_pwd, m_role FROM member_auth WHERE m_uid = ?";
        $stmt = $conn->prepare($sql); 
        $param_username = trim($_POST["username"]);
        $stmt->execute([$param_username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $returned_user = $stmt->fetch();
        $user_rowcount = $stmt->rowCount();// only returns first row in Fetch:assoc mode. if 1 row found, username already exists in database
            if($user_rowcount == 1)
            {
                if(password_verify($_POST['password'],$row['m_pwd']))
                {
                    
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $row['m_role']; 
                    //if user is an admin and the referring page was not an admin page (previous session expired whil on admin page) redirect user to admin home page.
                    //otherwise redirect user to the referring page
                    if ($_SESSION['role'] == "admin" && stripos($_SESSION['referer'],"admin") === false)
                    {
                        $referer="Location: https://" . $_SERVER["HTTP_HOST"] . "/admin/admin-home.php";
                    } 
                     
                    header($referer);
                }
                else
                {
                    // Display an error message if password is not valid
                    $password_err = 'The password you entered was not valid.';
                }
            }
            else
            {
                // Display an error message if username doesn't exist
                $username_err = 'No account found with that username.';
            }
            
        
       
    $conn = null;
    }
}
?>
 
<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>-->
            <main class="main-content">
                <div class="fullwidth-block">
                    <div class="container">
                        <div class="content col-md-10 ">
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="contact-form">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" >
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div>
                <input type="submit" class="button" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div> 
    </div>
    </div>
    </main>   
<!--</body>-->
<?php include '../footer.php'; ?>
</html>