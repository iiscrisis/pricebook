function appMaps(long,lat,map_container,id)
{

  this.id = id;

  this.map_markers ;//= map_markers_array;
  this.container=jQuery("<div/>");
  this.appData;
  this.map;
  this.long = long;
  this.lat= lat;
  this.map_container = map_container;
  this.googleMapsLoaded=false; //Set to true if googlemaps have been loaded
  this.map_initialized=0;


  this.params;

  this.interval_id;

  this.initialize = function()
  {


    var self = this;
    this.map_markers = new Array();
  //  this.checkforgooglemaps();
  this.initializeMap();
  //  this.interval_id =  setInterval(function(){self.geolocate(self )},6000);
    this.mapsinitialized();
  }


  this.geolocate = function(self )
  {


       console.log("Checking for geoloc : "+self.map_initialized)

      if(self.map_initialized != 1)
      {
          return 0;

      }

      clearTimeout(self.interval_id);

    	navigator.geolocation.getCurrentPosition(app.getGeoLocation,app.geoLocationError);
  }

  this.mapsinitialized = function()
  {

    this.container.addClass("app_page");
    //	alert("1");//$("#front_page_app").html());
  /*  this.template = Handlebars.compile($("#"+this.template_id).html());
    //Should Add a clean up of al nodes begore rerendering
    this.setContext();*/
    //console.log(this.appData);

  }


  this.setContext = function()
  {
    //Read database and fill context

      var self = this;
      //alert(app.localFilePath);
      //Create Design Doc for Type Query
    //  self.appData.length = 0;
      this.appData={};

      //this.render();

}; //End Set context

this.render = function()
{

  //console.log($("#"+self.map_container).width());
  var context = {App:this.appData};
  var html = this.template(context) ;
  this.container.attr("id",this.id);
  this.container.html(html);

  this.container.append(jQuery("#"+this.map_container));

  return this;

};


   // dom ready


  this.checkforgooglemaps = function()
  {


    if (window.google && google.maps) {
        // Map script is already loaded
        console.log("Map script is already loaded. Initialising");
        this.initializeMap();
    } else {
        console.log("Lazy loading Google map...");
        this.lazyLoadGoogleMap();
    }

  }



   this.createMap = function (params)
   {
      var self = this;
    //  alert(self.lat+" "+self.long)
       var myLatlng = new google.maps.LatLng(self.lat,self.long);
       var mapOptions = {
           center: myLatlng,
           zoom: 11,
           mapTypeId: google.maps.MapTypeId.ROADMAP,

        /*   styles:[
    {
        "featureType": "all",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#00ffd4"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#444444"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry",
        "stylers": [
            {
                "saturation": "-90"
            },
            {
                "lightness": "28"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#008abc"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#4c4523"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.text",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "lightness": "100"
            },
            {
                "gamma": "1.81"
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ff0000"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#46bcec"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "saturation": "100"
            }
        ]
    }
]*/

       };
       console.log("create at "+self.map_container);

       self.map = new google.maps.Map(document.getElementById(self.map_container), mapOptions);

    /*   var marker = new google.maps.Marker({
           position: myLatlng,
           map: self.map,
           title: "Περιοχή",
           //icon: 'http://www.matsagouras.com/dev/images/icons/map.png',
        //   icon: 'http://olsimane.com/templates/frontend/images/map/map-pin.png'
      });*/

       this.map_initialized = 1;
   }

   this.lazyLoadGoogleMap =function()
   {
      var self = this;

       jQuery.getScript("http://maps.google.com/maps/api/js?sensor=true")
       .done(function (script, textStatus) {
           console.log("Google map script loaded successfully");
           self.initializeMap();
       })
       .fail(function (jqxhr, settings, ex) {
           alert("Could not load Google Maps, please check your internet connection");
       });
   }

  this.initializeMap = function()
  {
     this.createMap(this.params);
    // this.initializeMarkers(this.map_markers);
  }


 this.initializeMarkers = function(map_markers)
 {

 }

 this.createMarker = function(contentString, position, title, map)
 {
  var  infowindow= new google.maps.InfoWindow({
     content: contentString
   });


   var markers_array= new google.maps.Marker({
      position: position,
      map: map,
      title: title
   });

  markers_array.addListener('click', function() {
     infowindow.open(map,  markers_array);
   });

 }


 this.calculateDegrees = function(position)
 {
   //35°20'14.7
   var index_deg = position.indexOf('°');
   var index_min = position.indexOf("'");
   var index_direction = position.indexOf('\"');


      var degs = parseFloat(position.substring(0, index_deg));
      var mins = parseFloat(position.substring(index_deg+1, index_min))/60;
      var secs = parseFloat(position.substring(index_min+1, index_direction))/3600;

    //  console.log("DEGREES = "+ degs+" Minutes ="+ mins+ " Secs = "+secs)
      var deg = degs + mins + secs;
       console.log(deg);
       return deg;
    }


  this.setAppPosition=function(lat,long)
  {
    var self = this;
    self.lat = lat;
    self.long = long;

    console.log("LONG LAT "+lat+" "+long);
    var appPosition = new google.maps.LatLng(self.lat,self.long);//latitude_longitude);//, self.long);


    var contentString = '';

     var infowindow = new google.maps.InfoWindow({
       content: contentString
     });


  var marker = new google.maps.Marker({
        position: appPosition,
        map: self.map,
        title: "",

    });

    self.deleteMarkers();
    marker.addListener('click', function() {
       infowindow.open(self.map, marker);
     });

       self.map_markers.push(marker);
     //self.setAppsMarker(self.map,"",appPosition);

    self.map.setCenter(appPosition);
  }



  this.setMapOnAll=function(map) {
      var self = this;
    for (var i = 0; i <    self.map_markers.length; i++) {
         self.map_markers[i].setMap(map);
    }
  }

  // Removes the markers from the map, but keeps them in the array.
   this.clearMarkers=function() {
       var self = this;
    self.setMapOnAll(null);
  }

  // Shows any markers currently in the array.
   this.showMarkers=function() {
       var self = this;
    self.setMapOnAll(map);
  }

  // Deletes all markers in the array by removing references to them.
   this.deleteMarkers=function() {
       var self = this;
    self.clearMarkers();
       self.map_markers = [];
  }


  this.setAppsMarker=function(map,title,appPosition)
  {
    //alert(1);
    if(this.long !='' && this.lat !='' && this.geolocation=='on' && this.system_geolocation=='on')
    {
      //console.log("setting app marker at "+this.lat+" = "+this.long);
      var marker = new google.maps.Marker({
        position:appPosition,
        map: map,
        title:title,
        icon:('http://maps.google.com/mapfiles/ms/icons/blue-dot.png')
      });


      marker.addListener('click', function() {
         infowindow.open(self.map, marker);
       });
    //  marker.setMap(map);

      app.markers.push(marker);
    }else
    {
      //console.log("Marker not set");
    }
  };

this.initialize();
}
