<?php
/* Set e-mail recipient */
$myemail  = "you@domain.com";

/* Check all form inputs using check_input function */
$yourname = check_input($_POST['yourname'], "Enter your name");
$address1  = check_input($_POST['address1'], );
$address2   = check_input($_POST['address2']);
$city  = check_input($_POST['city']);
$state   = check_input($_POST['state']);
$zip = check_input($_POST['zip']);
$phone = check_input($_POST['phone']);
$email = check_input($_POST['email']);
$wouldlike = check_input($_POST['wouldlike']);
$how = check_input($_POST['how']);
$comments = check_input($_POST['comments'],);

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}
*/

/* Let's prepare the message for the e-mail */
$message = "Hello!

Your contact form has been submitted by:

Name: $yourname
Address: $address
Address2: $address2
City: $City
State: $state
Zip: $zip
Phone: $phone
E-mail: $email


Interested in? $wouldlike
How did he/she find us? $how

Comments:
$comments

End of message
";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: thanks.html');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>
