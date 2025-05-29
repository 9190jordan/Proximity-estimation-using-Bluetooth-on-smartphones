<?php
// array for JSON response
include_once 'dbconnect.php';
$response = array();
// check for required fields
if ((isset($_POST['user'])) && isset($_POST['devname']) && isset($_POST['rssi']) && isset($_POST['name'])  && isset($_POST['mac'])&& isset($_POST['lat']) && isset($_POST['lng']) && isset($_POST['time'])&& isset($_POST['battery']) && isset($_POST['power'])) 
{  
$uname=$_POST['user'];
$devname=$_POST['devname'];
$rssi=$_POST['rssi'];
$name=$_POST['name'];
$mac=$_POST['mac'];
$lat=$_POST['lat'];	
$lng=$_POST['lng'];	
$time=$_POST['time'];
$battery=$_POST['battery'];	
$power=$_POST['power'];
$type="mobile";
    $result = mysql_query("INSERT INTO monitor(type,username, rssi,devname,name, mac,lat,lng,time,battery,power) VALUES('$type','$uname', '$rssi','$devname','$name','$mac','$lat', '$lng', '$time', '$battery', '$power')");
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Information Uploaded successfully.";
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.".mysql_error();
        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing".mysql_error();
    echo json_encode($response);
}
?>