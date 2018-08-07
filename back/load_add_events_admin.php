<?php 
//force HTTPS
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}


//include db connnect
require_once '../back/db_connect_write.php';

// Define variables and initialize with empty values
$eventname = $eventdate = $eventdesc = $eventurl = $eventloc = $eventtime = $volunteerurl = "";
$event_err = $myError = "";

//Check post data
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  
  //instantiate allowed null values
  $eventtime = check_empty($_POST['eventtime']);
  if ($eventtime != '')
  {
    validate_time($_POST['eventtime'], "Invalid time format. Use 24 hour HH:mm");
  }
  $eventurl = check_empty($_POST['eventurl']);
  if ($eventurl != '')
  {
    validateURL($_POST['eventurl'], "Event URL not valid");
  }
  $volunteerurl = check_empty($_POST['volunteerurl']);
  if ($volunteerurl != '')
  {
    validateURL($_POST['volunteerurl'], "Volunteer URL not valid");
  }
  $eventdesc = check_empty($_POST['eventdesc']);
  if ($eventdesc != '')
  {
    check_input($_POST['eventdesc']);
  }
  $eventloc = check_empty(check_input($_POST['eventloc']));
  //validate input has no special characters and is a valid date
  $eventname = check_input($_POST['eventname'], "Enter an event name");
  $eventdate = validateDate($_POST['eventdate'], "Incorrect date format");



  if (empty($myError))
  {
    try
    {
      //Start  insert transaction
          $conn->beginTransaction();
          // insert event
          $sql = "INSERT INTO events (e_date, e_name, e_url, e_v_url, e_time, e_location, e_fee, e_description, r_date, r_required, r_deadline, r_url, r_fee)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      //Set Paramaters
      $param_e_date = $eventdate;
      $param_e_name = $eventname;
      $param_e_url = $eventurl;
      $param_e_v_url = $volunteerurl;
      $param_e_time = $eventtime;
      $param_e_location = $eventloc;
      $param_e_fee = '';
      $param_e_description = $eventdesc;
      $param_r_date = '';
      $param_r_required = '';
      $param_r_deadline = '';
      $param_r_url = '';
      $param_r_fee = '';
      $stmt->execute([$param_e_date, $param_e_name, $param_e_url, $param_e_v_url, $param_e_time, $param_e_location, $param_e_fee, $param_e_description, $param_r_date, $param_r_required, $param_r_deadline, $param_r_url, $param_r_fee]);
      $conn->commit();
      echo '<span style="color:darkgreen;font-weight:bold;text-align:center;">Succesfully Added Event!</span>';
    }
    catch (Exception $e)
         {
            $conn->rollback();
            echo "Something went wrong. Please try again later.";
            throw $e;
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
          show_error($problem);
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
      show_error($problem);
    }
    return $date;
  }
  function validateURL($url, $problem)
  {
    //Sanitize URK
    filter_var($url, FILTER_SANITIZE_URL);
    // Validate url
    if (filter_var($url, FILTER_VALIDATE_URL)) 
    {
        //valid url
    } 
    else 
    {
        show_error($problem);
    }
  }
  function show_error($myError)
  {
    echo $myError;
  }
  function check_empty($allowednull)
  {
    if (empty($allowednull))
    {
      $allowednull = '';
    }
    return $allowednull;
  }
  function validate_time($time, $problem)
  {
    if(preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $time))
    {
      //valid time
    }
    else
    {
      //not valid
      show_error($problem);
    }
  }

?>