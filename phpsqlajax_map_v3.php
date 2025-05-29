<?php
include_once 'dbconnect.php';
            if(!empty($_GET))
        {
           
            $custid = $_GET['edit'];
            
           /* $sql = "SELECT * FROM `user` WHERE id='$custid'";
            $result = mysql_query($sql) or die("Error: ".  mysql_error());
            if($row = mysql_fetch_array($result, MYSQL_ASSOC))
            {
                if($custid == $row['id'])
                {
				$name=$row['username'];
				}
				}*/
				}
				$json = json_encode($custid);
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps AJAX + mySQL/PHP Example</title>
    <script src="https://maps.google.com/maps/api/js?sensor=false"
            type="text/javascript"></script>
    <script type="text/javascript">
   var customIcons = {
      mobile: {
        icon: 'bluetooth.png',
        //shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
     /* bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }*/
    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(13.094536, 80.205141), //set current lat,lng
        zoom: 12,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
	 // alert("phpsqlajax_genxml.php?edit="+<?= json_encode($custid)?>);
      downloadUrl("phpsqlajax_genxml.php?edit="+<?= json_encode($custid)?>, function(data) {
	 // alert(data);
        var xml = data.responseXML;
		
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var username = markers[i].getAttribute("username");
		  //alert(username);
          var mac = markers[i].getAttribute("mac");
          var rssi = markers[i].getAttribute("rssi");
		  var time = markers[i].getAttribute("time");
          var battery = markers[i].getAttribute("battery");
		  var power = markers[i].getAttribute("power");
		   var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>Mac: " + mac +"; RSSI:"+rssi+"; Time: "+time+"/; Battery: "+battery+"/; Power:"+power+ "</b> <br/>";
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
           // shadow: icon.shadow
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>
  </script>
  </head>

  <body onload="load()">
    <div id="map" style="width: 1000px; height: 1000px"></div>
  </body>
</html>