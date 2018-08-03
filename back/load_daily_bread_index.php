<?php
$servername = "localhost";
$username = "herit568_dbread";
$password = "cmeb4ugo!";
$dbname = "herit568_www";
$sql = "SELECT db_text, db_img_url, db_date FROM daily_bread WHERE db_date BETWEEN CURDATE() AND CURDATE() + 3";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("$sql"); 
    $stmt->execute();

    // set the resulting array to associative
   while($sqlrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
   $img_url = $sqlrow['db_img_url'];
   $textdate = $sqlrow['db_date'];
   $text = $sqlrow['db_text'];
   $phpdate = strtotime( $textdate );
   $textdate = date( 'm-d-Y', $phpdate );
   $div = '<div class="row">
              <div class="col-md-6">

                <div class="news">
                  <image class="news-image" src="' . $img_url . '"></image>
                  <h3 class="news-title">' . $text . '</h3>
                  <small class="date"><i class="fa fa-calendar"></i>' . $textdate . '</small>
                </div>
              </div>';
	echo $div;
   
}
      
    
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>