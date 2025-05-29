
<html>
<head>
<title>Admin login</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<script src="jquery.js"></script>

		<script>
		function check(id)
{
    window.location.href="SingleReport.php?edit=" + id;
}
		</script>
</head>
<body>
<div class="header">
<img src="banner.jpg" style="width:100%;height:120px;">
</div>

<div class="nav-area">
<ul class="navigation">
  <li><a href="home.php">About us</a></li>
  <li><a href="createuser.php">New User</a></li>
  <li><a href="monitor.php">Locator</a></li>
  <li><a href="#">Logout</a></li>
</ul>
</div>
  <div class="content">
<h1 style="padding: 20px 0px 5px 30px; color:#0B2161; margin-left:400px; position:relative; top:30px; "><span>Monitor Employee</span></h1>
<?php
        include_once 'dbconnect.php';
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
				if($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
				{
					echo'<div class="btnalign" ><button name="change" id="change" class="CSSButton" onClick="check(' . $row['id'].');">Map View</button></div>';
				}
				echo '<div class="aa"><table border=\"1\" align=\"center\">
				<tr><th>Id</th>
                <th>Emp Name</th>
                 <th>Rssi</th>
				<th>Device Name</th>
				<th>Adapter Name</th>
				<th>MAC</th>
				<th>Latitude</th>
				<th>Longtitude</th>
				<th>Battery Level</th>
				<th>Power Level</th>
				<th>Time</th>
                </tr>';
            
			
			while($row1 = mysql_fetch_array($result1))
            {
			
				$custid=$row['id'];
				
                echo '
				<tr align="center" valign="center"><td>'.$row['id'].'</td>
				
                    <td>'.$row1['username'].'</td>
					 <td>'.$row1['rssi'].'</td>
					  <td>'.$row1['devname'].'</td>
					  <td>'.$row1['name'].'</td>
					 <td>'.$row1['mac'].'</td>
					  <td>'.$row1['lat'].'</td>
					  <td>'.$row1['lng'].'</td>
					 <td>'.$row1['battery'].'</td>
					  <td>'.$row1['power'].'</td>
					  <td>'.$row1['time'].'</td>';
                    
            }               
                }
                else
                    echo '</br></br></br><h2 style="color: red"> Incorrect key, go back then try again</h2>';
            }
        }
        else
        {
            echo "Invalid Report ID";
        }  
            ?>
		</TABLE></div>

</div>
<div class="footer"><center><b style="color:#fff; position:relative;top:20px;">Eyeopen Technologies </b> </center></div>
</body>
</html>
