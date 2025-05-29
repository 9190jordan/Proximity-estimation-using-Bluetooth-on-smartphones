
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
  <li><a href="index.html">Logout</a></li>
</ul>
</div>
  <div class="content">
<h2 style="padding: 20px 0px 5px 30px; color:#0B2161; margin-left:400px;">Welcome <span>to Locator</span></h2>
<h3 style="padding: 20px 0px 5px 30px; color:#0B2161; margin-left:400px;"><span>Create New User</span></h3>
<center>
<?php
        include_once 'dbconnect.php';
            $sql = "SELECT * FROM `user`";
                $result_report = mysql_query($sql) or die(mysql_error());       
            
            
            //generating header
            echo '<table border=\"1\" align=\"center\">
			 <tr><th>Id</th>
                <th>Emp Name</th>
                          <th>Report</th>
				
                </tr>';
            // importing another function php script
            //require_once 'functions.php';
            
            while($row = mysql_fetch_array($result_report))
            {
			
			$custid=$row['id'];
                echo '<tr align="center" valign="center"><td>'.$row['id'].'</td>
				
                    <td>'.$row['username'].'</td>
                    <td>
					<button name="change" id="change" onClick="check(' . $row['id'].');">View Report</button></td>';
            }
       // }
       // mysql_close();
        ?>
		</TABLE>

</div>
<div class="footer"><center><b style="color:#fff; position:relative;top:20px;">Eyeopen Technologies </b> </center></div>
</body>
</html>
