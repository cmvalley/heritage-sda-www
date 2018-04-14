<?php
$servername = "localhost";
$username = "herit568_dbwrite";
$password = "cmeb4ugo!";
$dbname = "herit568_www";

try {
    $attributes = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
	];
	$dsn = "mysql:host=$servername;dbname=$dbname";
	$conn = new PDO($dsn, $username, $password, $attributes);
    
    

    // set the resulting array to associative
        
    
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>