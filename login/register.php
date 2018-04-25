<?php
//force HTTPS
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
// Include config file

require_once 'dbconnect.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    // Validate username
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter a username.";
    } 
    else
    {
        // Prepare a select statement
        $sql = "SELECT m_id FROM member_auth WHERE m_uid = ?";
        try
        {
            $stmt = $conn->prepare($sql); 
            $param_username = trim($_POST["username"]);
            $stmt->execute([$param_username]);
            $returned_user= $stmt->fetch();
            $user_rowcount = $stmt->rowCount(); // only returns first row in Fetch:assoc mode. if 1 row found, username already exists in database
            if($user_rowcount == 1)
            {
                $username_err = "This username is already taken.";
            }
            else
            {
                $username = trim($_POST["username"]);
            }
        }    
        catch(Exception $e)
        {
            echo "Error: " . $e->getMessage();
            throw $e;
            
        }
          
        
        
        #if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            #mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            #$param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            #if(mysqli_stmt_execute($stmt)){
                /* store result */
                #mysqli_stmt_store_result($stmt);
                
                #if(mysqli_stmt_num_rows($stmt) == 1){
                    #$username_err = "This username is already taken.";
    } #else{
                    #$username = trim($_POST["username"]);
                #}

        // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 7){
        $password_err = "Password must have at least 7 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {
        try 
        {
             #mysqli_begin_transaction(); //turn on transactions
        $conn->beginTransaction();
        // insert new member credentials intp member_auth
        $sql = "INSERT INTO member_auth (m_uid, m_pwd) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$param_username, $param_password]);
        $last_id = $conn->lastInsertId();
        //Get last inserted db values of member ID and password last set date/time
        $sql = "SELECT m_id, pwd_last_set FROM member_auth WHERE m_id = ?";
        $stmt = $conn->prepare($sql);
        $param_last_id = $last_id;
        $stmt->execute([$param_last_id]);
        $row = $stmt->fetch();
        $member_id = $row["m_id"];
        $created_date = $row["pwd_last_set"];
        //insert new member into pember_profile        
        $sql = "INSERT INTO member_profile (m_id, m_uid, created) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $param_member_id = $member_id;
        $param_created_date = $created_date;
        $stmt->execute([$param_member_id, $param_username, $param_created_date]);

        #if($stmt1 = mysqli_prepare($link, $sql1) && $stmt2 = mysqli_prepare($link, $sql2) && $stmt3 = mysqli_prepare($link, $sql3))
        #{
            // Bind variables to the prepared statement as parameters
            #mysqli_stmt_bind_param($stmt1, "ss", $param_username, $param_password);
            #mysqli_stmt_bind_param($stmt2, "s", $param_username);
            #mysqli_stmt_bind_param($stmt3, "s", $param_username);
            // Set parameters
            #$param_username = $username;
            #$param_password = password_hash($password, PASSWORD_DEFAULT);
             // Creates a password hash
            
            // Attempt to execute the prepared statement
            #if(mysqli_stmt_execute($stmt1) && mysqli_stmt_execute($stmt2) && mysqli_stmt_execute($stmt3)){
                // Redirect to login page
                 #mysqli_commit($link);
                
            #} 
            #else{
                #echo "Something went wrong. Please try again later.";
            $conn->commit();
            $conn = null;
            header("location: login.php");
            #}
        #}
        }
        catch (Exception $e)
         {
            #$mysqli->rollback();
            $conn->rollback();
            echo "Something went wrong. Please try again later.";
            throw $e;
         }
    }
    else
    {
        #echo "Something is wrong please verify";
    }
         
        // Close statement
        #mysqli_stmt_close($stmt1);
        #mysqli_stmt_close($stmt2);
        #mysqli_stmt_close($stmt3);
    
    
    // Close connection
    #mysqli_close($link);
    $conn = null;
} 
else
{
    #echo "Oops! Something went wrong. Please try again later.";
}
        #}
         
        // Close statement
        #mysqli_stmt_close($stmt);
    #}
    
    
    
    // Check input errors before inserting in database
    
    

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>