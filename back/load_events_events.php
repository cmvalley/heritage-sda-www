<?php
$servername = "localhost";
$username = "herit568_dbread";
$password = "cmeb4ugo!";
$dbname = "herit568_www";
if($eventtype=="Upcoming")
{
$sql = "SELECT e_name, e_date, e_url, e_v_url, e_time, e_location, e_description FROM `events` WHERE e_date >= CURDATE() ORDER BY e_date ASC LIMIT 6";
}
else
{
  $sql = "SELECT e_name, e_date, e_url, e_v_url, e_time, e_location, e_description FROM `events` WHERE e_date >= CURDATE() AND (e_url OR e_v_url) IS NOT NULL ORDER BY e_date ASC LIMIT 6";
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare($sql); 
    $stmt->execute();

    // set the resulting array to associative
   while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   $eventname = $row ['e_name'];
   $eventdate = $row['e_date'];
   $eventurl = $row['e_url'];
   $volunteerurl = $row['e_v_url'];
   $eventtime = $row['e_time'];
   $eventlocation = $row['e_location'];
   $eventdescription = $row['e_description'];
   $phpdate = strtotime( $eventdate );
   $eventdate = date( 'm-d-Y', $phpdate );
   $linkbutton1='';
   $linkbutton2='';
   // Create Event & Volunteer buttons
   if(empty($eventurl))
    { 
      if(empty($volunteerurl))
        {
          // Don't create button if no event or volunteer URL in result
        } 
      else 
        { 
          $linkbutton1 = '<a href=' . $volunteerurl . ' class=\'button\'>Volunteer</a>'; 
        }
    } 
    else 
      {
        $linkbutton1 = '<a href=' . $eventurl . ' class=\'button\'>Event Info</a>';
        if(empty($volunteerurl))
        {
          // Don't create second button if no event and volunteer URL in result
        } 
      else 
        { 
          $linkbutton2 = '<a href=' . $volunteerurl . ' class=\'button secondary\'>Volunteer</a>'; 
        }
      };
   $li = '<li>
                    <h3 class="event-title"><a href="#">'. $eventname . '</a></h3>
                    <span class="event-meta">
                      <span><i class="fa fa-calendar"></i>'. $eventdate . '</span>
                      <span><i class="fa fa-map-marker"></i>'. $eventlocation . '</span>
                    </span>
                    <p>'. $eventdescription .'</p>
                    ' . $linkbutton1 . '
                    
                  </li>';
	echo $li;
   
}
      
    
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>