<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', '192.168.2.80:3306');
define('DB_USERNAME', 'sqluser');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'gewaechshaus');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT temperature, humidity, time FROM messungen");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);