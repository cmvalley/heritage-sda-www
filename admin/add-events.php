<!--PHP page variables and include head.php for HTML head, header and navigation-->
<?php 
//force HTTPS
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
//page metadata
$pagename='AddEvents'; 
$pageurl='../admin/add-events.php';
include('../head.php'); 

//include db connnect
require_once '../back/db_connect_write.php';

// Define variables and initialize with empty values
$eventname = $eventdate = $eventdesc = $eventurl = $eventloc = $eventtime = $volunteerurl = "";
$event_err = "";

//Check post data
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	
	//instantiate allowed null values
	//validate input has no special characters and is a valid date
	show_error($_POST['eventdate']);
	$eventname = check_input($_POST['eventname'], "Enter an event name");
	$eventdesc = check_empty(check_input($_POST['eventdesc']));
	$eventloc = check_empty(check_input($_POST['eventloc']));
	$eventdate = validateDate($_POST['eventdate'], "Incorrect date format");
	$eventtime = check_empty(check_input($_POST['eventtime']));
	$eventurl = check_empty(validateURL($_POST['eventurl'], "Event URL not valid"));
	$volunteerurl = check_empty(validateURL($_POST['volunteerurl'], "Volunteer URL not valid"));


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
		}
		catch (Exception $e)
         {
            #$mysqli->rollback();
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
    	$date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
    	show_error($date);
    	$date_arr = explode('-', $date);
    	//change to month day year order for checkdate function
		if (checkdate($date_arr[1], $date_arr[2], $date_arr[0] )) 
		{
    	// valid date ...
		}
		else
		{
			show_error($problem . $date);
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

?>


			<main class="main-content">
				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="content col-md-10 ">
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
								<input type="text" name="eventname" placeholder="Event Name" style=" border:solid 0.5px gray" /><br />
								<input type="text" name="eventdesc" placeholder="Event Description" style="border:solid .5px gray"  /><br>
								<input type="text" name="eventurl" placeholder="Event URL" style="border:solid .5px gray" /><br>
								<input type="text" name="eventloc" placeholder="Event Location" style="border:solid .5px gray" /><br>
								<input type="date" name="eventdate" style="border:solid .5px gray;" placeholder="Event Date" /> 
								<input type="text" name="eventtime" placeholder="Event Time" style="border:solid .5px gray"/><br>
								<input type="text" name="volunteerurl" placeholder="Volunteer URL" style="border:solid .5px gray">
								<br /><br>
								<p>I would like...
									<br />
									<input type="checkbox" name="wouldlike[]" value="learning about your church" /> To know more about this church<br />
									<input type="checkbox" name="wouldlike[]" value="special prayer" /> Special prayer (please specify in the comments below if you wish)<br />
									<input type="checkbox" name="wouldlike[]" value="call from pastoral staff" /> A call from the pastoral staff<br />
									<input type="checkbox" name="wouldlike[]" value="visit from pastoral staff" /> A visit from the pastoral staff<br />
									<input type="checkbox" name="wouldlike[]" value="becoming a member" /> To become a part of this church family<br />
									<input type="checkbox" name="wouldlike[]" value="other" /> Other (please specify in the comments below)<br />
									<br />
								</p>
								<p>How did you find us?
									<select name="how" style="border:solid .5px gray">
										<option value="" > -- Please select -- </option>
										<option>Web Search</option>
										<option>Word of mouth</option>
										<option>Link from another website</option>
										<option>Saw our sign</option>
										<option>Other</option>
									</select>
								</p>
								<p>Please add any additional comments in the space provided below <br />
									<b>Your comments:</b><br />
									<textarea name="comments" rows="10" cols="40" style="border:solid 1px gray"></textarea>
								</p>
								<br />
								<div class="g-recaptcha" data-sitekey="6LfHZE0UAAAAAO3IJy27-wXAzdmiRCI6UvxvN_HI"></div>
								<br />
								<p><input type="submit" value="Send it!"></p>

							</form>
						</div>
							
						</div>
						
					</div>
				</div>
			</main> <!-- .main-content -->
<?php include('footer.php'); ?> <!-- Site Footer contained in external file -->
</html>