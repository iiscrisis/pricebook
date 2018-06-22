<div id="map_box" >

</div>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMppMJEwYHBiCntuoE5NA1Z-jClaa5X-k&callback=initMap">
    </script>

    <script type="text/javascript">
    var     map_initialized = false;
    var mapBox;
    var longlat="37.983810,23.727539";
    function initMap()
    {
      //alert("g init");

        var longlat_array = longlat.split(",");
          mapBox = new appMaps(longlat_array[1],longlat_array[0],"map_box","map_mats");


        map_initialized = true;
    }

    </script>
