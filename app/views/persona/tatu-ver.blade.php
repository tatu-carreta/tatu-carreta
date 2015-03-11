@extends($project_name.'-master')

@section('head')
    @parent

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn5w3k9P2ISxdcfYba-sPxrGrz3W9-Jqk&sensor=false"></script>
    <script type="text/javascript">
        var data = {{$data}};
        var geocoder = new google.maps.Geocoder();
        var map;
        var infowindow = new google.maps.InfoWindow({
            content: ""
        });
        function initialize() {
            var mapOptions = {
                center: new google.maps.LatLng(-34.92125, -57.95433329999997),
                zoom: 13,
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

            var latLng = new google.maps.LatLng(data.latitud, data.longitud);
            // Creating a marker and putting it on the map
            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                title: data.title
            });

            bindInfoWindow(marker, map, infowindow, data.descripcion);
        }

        function bindInfoWindow(marker, map, infowindow, strDescription) {
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(strDescription);
                infowindow.open(map, marker);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@stop

@section('contenido')
    <section>
        <div class="container">
            <!--columna producto y descripcion -->
            <div class="col70">
                <div>
                    <h2>AN: {{ $persona -> apellido }} {{ $persona -> nombre }}</h2> 
                    <h2>Email: {{ $persona -> email }}</h2>
                    <h2>FN: {{ $persona -> fecha_nacimiento }}</h2>
                </div>
                <div class="clear"></div>
            </div>
            <!--columna info Mapa -->
            <div class="col30">
                <div id="map_canvas" style="width:500px; height:500px"></div>
            </div>
            <div class="clear"></div>
        </div>
    </section>
@stop