<?php
$servername = "localhost";
$username = "herit568_dbread";
$password = "cmeb4ugo!";
$dbname = "herit568_www";
if($eventtype=="Upcoming")
{
$sql = "SELECT e_id, e_name, e_date, e_url, e_v_url, e_time, e_location, e_description FROM `events` WHERE e_date >= CURDATE() ORDER BY e_date ASC LIMIT 15";
}
else
{
  $sql = "SELECT e_id, e_name, e_date, e_url, e_v_url, e_time, e_location, e_description 
  FROM `events` 
  WHERE e_date >= CURDATE() AND (e_url <> '' OR e_v_url <> '') 
  ORDER BY e_date 
  ASC LIMIT 15";
}
try 
{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $event_rowcount = $stmt->rowCount();
  if($event_rowcount < 1)
  {
    echo "No " . lcfirst($eventtype) . " events";
  }
  // set the resulting array to associative
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
  {
    $eventid = $row['e_id'];
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
      if(!empty($volunteerurl))
      {
        // Create only volunteer button if volunteer URL not empty and event url empty
        $linkbutton1 = '<a href=' . $volunteerurl . ' target=\'_blank\' class=\'button secondary\'>Volunteer</a>';
      } 
    } 
    else 
    {
      //Create event url button
      $linkbutton1 = '<a href=' . $eventurl . ' target=\'_blank\' class=\'button\'>Event Info</a>';
      if(!empty($volunteerurl))
      {
        // Create second button if volunteer URL also not empty
        $linkbutton2 = '<a href=' . $volunteerurl . ' target=\'_blank\' class=\'button secondary\'>Volunteer</a>'; 
      }    
    }
   $li = '<li>
                    <h3 class="event-title" id="'. $eventid . '">' . $eventname . '</h3>
                    <span class="event-meta">
                      <span><i class="fa fa-calendar"></i>'. $eventdate . '</span>
                      <span><i class="fa fa-map-marker"></i>'. $eventlocation . '</span>
                    </span>
                    <p>'. $eventdescription .'</p>
                    ' . $linkbutton1 . " " . $linkbutton2 . '
                    
                  </li>';
	echo $li;
   
}
      
    
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>