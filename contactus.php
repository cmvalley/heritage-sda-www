<?php
// grab recaptcha library
require_once "recaptchalib.php";

// your secret key
$secret = "6LfHZE0UAAAAAOyxIRyKWIIvDxw4kw692ZiGOATD";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);

// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}


/* Set e-mail recipient */
$myemail  = "cmvalley@gmail.com";

/* Check all form inputs using check_input function */
if ($response != null && $response->success) 
{
$yourname = check_input($_POST['yourname'], "Enter your name");
$address1 = check_input($_POST['address1']);
$address2 = check_input($_POST['address2']);
$city = check_input($_POST['city']);
$state = check_input($_POST['state']);
$zip = check_input($_POST['zip']);
$phone = check_input($_POST['phone']);
$email = check_input($_POST['email']);
$wouldlike = check_input_checkbox($_POST['wouldlike']);
$how = check_input($_POST['how']);
$comments = check_input($_POST['comments']);
}
else
{
    show_error("Please verify your submission by using reCaptcha");
}

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
Address: $address1
Address2: $address2
City: $city
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
header('Location: thanks.php');
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

function check_input_checkbox($chkboxdata, $chkboxproblem='')
{
    if(empty($chkboxdata))
    {
        $returndata = "Nothing Selected";
    }
    else
    {
        $n = count($chkboxdata);
        $returndata = $chkboxdata[0];
        for($i=1; $i < $n; $i++)
        {
        $returndata .= ", " . $chkboxdata[$i];
        }
    }
    return $returndata;

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
