 var geocoder;
  var map = null;
  var marker = null;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
      zoom: 16,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
  }

  function codeAddress(name, address) {
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        if (marker!=null) marker.setMap(null);
        marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
            title: name
        });
      } else {
          //alert('Cannot find position of this hotel.');
        //alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
  
  function showMap(name, address) {
	   if (map == null) {initialize();}
	   
	   codeAddress(name, address);
	   openPopup('map_popup', 650, 550);
  }
  
  window.onload = function() {
	  
  }