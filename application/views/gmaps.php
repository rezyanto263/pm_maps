<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #map {
            height: 100%;
        }
        html,body{
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7OY-SafGpc-rTdGZUWlCHkEdi0a_zAh0&loading=async&callback=initMap" async defer></script>

    <script type="text/javascript">
        var map;
        var location;
        var marker;
        var data = <?php echo json_encode($location); ?>;
        var curLat;
        var curLong;
        var directionDisplay;
        var directionService;
        function initMap() {
            infoWindow = new google.maps.InfoWindow;
            var mapOption = {
                zoom : 12,
                center : new google.maps.LatLng(-8.671071,115.229885),
                mapTypeId : google.maps.MapTypeId.ROADMAP,
                scrollWheel : true,
                streetViewControl : true,
                mapTypeControl : true,
            }
            map = new google.maps.Map(document.getElementById('map'), mapOption);
            // addMarker(-8.671071, 115.229885, 'Lokasi A');

            navigator.geolocation.getCurrentPosition(getLocation);
            function getLocation(position){

                curLat = position.coords.latitude;
                curLong = position.coords.longitude;
                console.log(curLat+" "+curLong)
                addMarker(curLat, curLong, "My Location");
            }

            for(var i = 0; i<data.length;i++) {
                addMarker(data[i]['lat'], data[i]['long'], data[i]['nama']);
            }
        }
        function addMarker(lat, long, nama) {
            // location = new google.maps.LatLng(lat, long);
            marker = new google.maps.Marker({
                map : map,
                position : {lat:lat, lng:long},
                title : nama,
                // icon : {
                //     url : "https://www.clipartmax.com/png/middle/235-2350691_map-marker-google-map-marker-yellow.png",
                //     scaledSize : new google.maps.Size(50, 50),
                // }
            });
            var isi = "<table border=1>"+
            "<tr>"+
            "<td>Nama</td>"+
            "<td>Lat</td>"+
            "<td>Long</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+nama+"</td>"+
            "<td>"+lat+"</td>"+
            "<td>"+long+"</td>"+
            "</tr>"+
            "<tr>"+
            "<button onclick='getDirection("+lat+","+long+")'>Get Direction</button>"+
            "</tr>"+
            "</table>";
            bindInfoWindow(marker, map, infoWindow, isi);
        }
        function bindInfoWindow(marker, map, infoWindow, info) {
            google.maps.event.addListener(marker, "click", function(){
                infoWindow.setContent(info);
                infoWindow.open(map, marker);
            })
        }
        
        function calculateAndDisplayRoute(origin_pos, destination_pos, directionService, directionDisplay, mode) {
            directionService.route({
                origin : origin_pos,
                destination : destination_pos,
                travelMode : google.maps.TravelMode[mode],
            }, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionDisplay.setDirections(response);
                }else {
                    alert('Error');
                }
            })
        }
        function getDirection(destLat, destLong) {
            var destFrom = curLat+","+curLong;
            var destTo = destLat+","+destLong;
            var mode = "DRIVING";
            infoWindow.close();
            if (directionDisplay !== undefined) {
                directionDisplay.setMap(null);
            }
            directionDisplay = new google.maps.DirectionsRenderer({suppressMarkers:true});
            directionService = new google.maps.DirectionsService;
            directionDisplay.setMap(map);
            console.log(destFrom);
            console.log(destTo);
            calculateAndDisplayRoute(destFrom, destTo, directionService, directionDisplay, mode);
        }
    </script>
</body>
</html>