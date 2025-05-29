<?php
function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&apos;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

// Opens a connection to a mySQL server
$connection=mysql_connect ("localhost", "root","");
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active mySQL database
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
/*if($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
				{
					echo'<div class="btnalign" ><button name="change" id="change" class="CSSButton" onClick="check(' . $row['id'].');">Map View</button></div>';
				}*/


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
  echo 'username="' . parseToXML('&','&amp;', $row['username']) . '" ';
   echo 'rssi="' . $row['rssi'] . '" ';
  echo 'mac="' . parseToXML($row['mac']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
   echo 'time="' . $row['time'] . '" ';
  echo 'battery="' . $row['battery'] . '" ';
  echo 'power="' . $row['power'] . '" ';
  echo '/>';
}

// End XML file
echo '</marker>';
}
}
}

?>