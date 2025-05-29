<?php
function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

// Opens a connection to a MySQL server
$connection=mysql_connect ("localhost", "root", "");
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db("phonemonitor", $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}






if(!empty($_GET))
        {
           
            $custid = $_GET['edit'];
            
            $sql = "SELECT * FROM `user` WHERE id='$custid'";
            $result = mysql_query($sql) or die("Error: ".  mysql_error());
            if($row = mysql_fetch_array($result, MYSQL_ASSOC))
            {
                if($custid == $row['id'])
                {
				$name=$row['username'];
				$sql1 = "SELECT * FROM `monitor` WHERE username='$name'";
				$result1 = mysql_query($sql1) or die("Error: ".  mysql_error());
// Select all the rows in the markers table
//$query = "SELECT * FROM monitor WHERE 1";
//$result = mysql_query($query);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<marker>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result1)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'username="' . parseToXML($row['username']) . '" ';
  echo 'rssi="' . $row['rssi'] . '" ';
  echo 'mac="' . parseToXML($row['mac']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'time="' . $row['time'] . '" ';
  echo 'battery="' . $row['battery'] . '" ';
  echo 'power="' . $row['power'] . '" ';
   echo 'type="' . $row['type'] . '" ';
  echo '/>';
}

// End XML file
echo '</marker>';
}
}
}


?>