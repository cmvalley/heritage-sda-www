<?php
//force HTTPS
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
// Include config file

require_once 'dbconnect.php';
$username = "cvalley2";
try
{
$sql2 = "SELECT @created_m_id := m_id, @created_pwd_last_set := pwd_last_set FROM member_auth WHERE m_uid = ?";
$sql3 = "INSERT INTO member_profile (m_id, m_uid, created) VALUES (@created_m_id, ?, @created_pwd_last_set)";
$stmt2 = mysqli_prepare($link, $sql2);
mysqli_stmt_bind_param($stmt2, "s", $param_username);
$param_username = $username;
mysqli_stmt_execute($stmt2);
mysqli_stmt_store_result($stmt2);
if(mysqli_stmt_num_rows($stmt2) == 1)
{
	echo "Success";
	mysqli_stmt_fetch($stmt2);
	echo $stmt2;

}
else
{
	echo "No Success";
}
}
catch (Exception $e)
{
echo $e;
}
?>