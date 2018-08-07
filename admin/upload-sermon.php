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
$pagename='Upload Sermon'; 
$pageurl='/admin/upload-sermon.php';
include('../head.php'); 
include('../back/load_upload_sermon_admin.php');
// Define variables and initialize with empty values
$upload_message_success = $upload_message = $file_upload_err = $sermon_date_err = $speaker_err = $sermon_title_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    //include db connnect
require_once '../back/db_connect_write.php';
//validate required input has no special characters and is a valid date
if(empty(trim($_POST["sermontitle"]))){$sermon_title_err = "Please enter sermon title";}
if(empty(trim($_POST["speaker"]))){$speaker_err = "Please enter speaker's name";}
if(empty(trim($_POST["sermondate"]))){$sermon_date_err = "Please enter date of sermon";}
if(empty(basename($_FILES["fileToUpload"]["name"]))){$file_upload_err = "Please choose file to upload";}
$sermontitle = check_input($_POST['sermontitle'], "Enter a sermon title with no special characters");
$sermonauthor = check_input($_POST['speaker'], "Enter a speaker with no special characters");
$sermondate = validateDate($_POST['sermondate'], "Incorrect date format");
$sermonfeatured = 0; //Future update may allow this to be set during upload
$filetoupload = check_empty(basename($_FILES["fileToUpload"]["name"],"Select File to Upload"));
//Set target directory and target file name
$target_dir = "../audio/"; 
$initial = strtolower(mb_substr($sermonauthor,0,1));
$lastname = strtolower(end(explode(" " , $sermonauthor)));
$prefix = $initial . "-" . $lastname . "-";
$file_name_builder = $prefix . strtolower(str_replace(" ", "-", $sermontitle)) . "." . strtolower(pathinfo($filetoupload,PATHINFO_EXTENSION));
$target_file = "../audio/" . $file_name_builder;
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(!empty(basename($_FILES["fileToUpload"]["name"])))
{
if(isset($_POST["upload"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is valid - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $upload_message .= " " . show_error("File is not valid.");
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $upload_message .= " " . show_error("Sorry, file already exists.");
    $uploadOk = 0;
}
// Check file size < 100MB
if ($_FILES["fileToUpload"]["size"] > 100000000) {
    $upload_message .= " " . show_error("Sorry, your file is too large.");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "mp3" && $imageFileType != "ogg" && $imageFileType != "wav"
&& $imageFileType != "aiff" ) {
    $upload_message .= " " . show_error("Sorry, only audio files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $upload_message .= " " . show_error("An error orrcurred the sermon was not uploaded.");
// if everything is ok, try to upload file
} else {
    try
    {

    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
    {
        //Prepare SQL insert
        
        
            $sql = "INSERT INTO sermons (s_audio_url, s_author, s_date, s_title, s_featured) 
            VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            //Set Paramaters
            $param_audio_url = $target_file;
            $param_speaker = $sermonauthor;
            $param_date = $sermondate;
            $param_title = $sermontitle;
            $param_featured = $sermonfeatured;
            $stmt->execute([$param_audio_url, $param_speaker, $param_date, $param_title, $param_featured]);
        


            $upload_message_success .= " " . show_error("The sermon ". $sermontitle . " and file" . basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
    }
}

        catch (Exception $e)
        {
            $upload_message .= " " . show_error("Oops something went wrong. Please try again later.");
           throw $e;
        }

     
    
    
}
}
$conn = null;
}

//validation functions
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        $upload_message .= " " . show_error($problem);
    }
    return $data;
}
function validateDate($date, $problem='' )
{
    //$date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
    
    $date_arr = explode('-', $date);
    //change to month day year order for checkdate function
  if (checkdate($date_arr[1], $date_arr[2], $date_arr[0])) 
  {
    // valid date ...
  }
  else
  {
    $upload_message .= " " . show_error($problem);
  }
  return $date;
}
function show_error($myError)
  {
    return $myError;
  }

function check_empty($required)
  {
    if (empty($required))
    {
        $upload_message .= " " . show_error($problem);
    }
    return $required;
  }
?>
<main class="main-content">
	<div class="fullwidth-block">
		<div class="container">
			<div class="row">
				<div class="content col-md-10 ">
                    <div class="adminform">
                    <form id="suploadform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
						<input type="text" name="sermontitle" placeholder="Sermon Title" /> 
                        <span class="errormsg"><?php echo $sermon_title_err; ?></span>
                         <br/>
                        <input type="text" name="speaker" placeholder="Speaker" />
                        <span class="errormsg"><?php echo $speaker_err; ?></span><br/>
                        <input type="date" name="sermondate" placeholder="Sermon Date"  />
                        <span class="errormsg"><?php echo $sermon_date_err; ?></span><br/>
                        <input type="file" name="fileToUpload" id="fileToUpload" />
                        <span class="errormsg"><?php echo $file_upload_err; ?></span><br/>
                        <span class="errormsg"> <?php echo $upload_message; ?> </span>
                        <span class="successmsg"> <?php echo $upload_message_success; ?> </span><br/>
						<p><input type="submit" value="Upload" name="upload"></p>
                    </form>
</div>
                </div>
			</div>
		</div>
	</div>
</main> <!-- .main-content -->
<?php include('../footer.php'); ?> <!-- Site Footer contained in external file -->

</html>