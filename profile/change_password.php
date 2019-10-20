<?php
session_start();
//force HTTPS
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
// Include config file
require_once '../back/db_connect_write.php';
//get current logged on user if no logged on user save this page as referer and redirect to login page
if (isset($_SESSION['username']))
{
    $userid = $_SESSION['username']; 
}
else
{
    $_SESSION['referer'] = "Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $_SESSION['authrefererflag'] = true; //this flag will be checked on the login page to assist in redirecting back here afterwards
    header("Location: https://" . $_SERVER["HTTP_HOST"] . "/login/login.php");
    exit();
}
if (count($_POST) > 0) {
    $sql = "SELECT m_pwd FROM member_auth WHERE m_uid =?";
    $stmt = $conn->prepare($sql); 
    $stmt->execute([$userid]);
    $row= $stmt->fetch();
    $returned_pwd = $row['m_pwd'];


    //$result = mysqli_query($conn, "SELECT *from users WHERE userId='" . $userid . "'");
    //$row = mysqli_fetch_array($result);
    if (password_verify($_POST["currentPassword"],$row["m_pwd"])) {
        //mysqli_query($conn, "UPDATE users set password='" . $_POST["newPassword"] . "' WHERE userId='" . $_SESSION["userId"] . "'");
        $sql = "UPDATE member_auth set m_pwd=? WHERE m_uid=?";
        $stmt = $conn->prepare($sql);
        $param_pwd = password_hash(trim($_POST["newPassword"]),PASSWORD_DEFAULT);
        $stmt->execute([$param_pwd,$userid]);
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
}
?>
<html>
<head>
<title>Change Password</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;
if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "Required";
	output = false;
}
else
{
    document.getElementById("currentPassword").innerHTML = "";
}
if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "Required";
	output = false;
}
else
{
    document.getElementById("newPassword").innerHTML = ""
}
if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "Required";
	output = false;
}
else
{
    document.getElementById("confirmPassword").innerHTML = ""
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "Passwords do not match";
	output = false;
} 	
return output;
}
</script>
</head>
<body>
    <form name="frmChange" method="post" action=""
        onSubmit="return validatePassword()">
        <div style="width: 500px;">
            <table border="0" cellpadding="10" cellspacing="0"
                width="500" align="center" class="tblSaveForm">
                <tr class="tableheader">
                    <td colspan="2">Change Password</td>
                </tr>
                <tr>
                    <td width="40%"><label>Current Password</label></td>
                    <td width="60%"><input type="password"
                        name="currentPassword" class="txtField" /><span
                        id="currentPassword" class="required"></span></td>
                </tr>
                <tr>
                    <td><label>New Password</label></td>
                    <td><input type="password" name="newPassword"
                        class="txtField" /><span id="newPassword"
                        class="required"></span></td>
                </tr>
                <td><label>Confirm Password</label></td>
                <td><input type="password" name="confirmPassword"
                    class="txtField" /><span id="confirmPassword"
                    class="required"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit"
                        value="Submit" class="btnSubmit"></td>
                </tr>
            </table>
            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
        </div>
    </form>
</body>
</html>