
function initialize() {

	var radius = 50;
	var markers = [];
	var map = new google.maps.Map(document.getElementById('map-canvas'), {
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var defaultBounds = new google.maps.LatLngBounds(
		new google.maps.LatLng(-33.8902, 151.1759),
		new google.maps.LatLng(-33.8474, 151.2631)
	);

	map.fitBounds(defaultBounds);

	var input = document.getElementById('pac-input');
	map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(input);

	var searchBox = new google.maps.places.SearchBox(input);

	google.maps.event.addListener(searchBox, 'places_changed', function() {

		var places = searchBox.getPlaces();

		if (places.length == 0) {
		  return;
		}

		for (var i = 0, marker; marker = markers[i]; i++) {
		  marker.setMap(null);
		}

		markers = [];
		var bounds = new google.maps.LatLngBounds();
		var sessionId = $('#sessionId').val();

		for (var i = 0, place; place = places[i]; i++) {

			var marker = new google.maps.Marker({
				map: map,
				title: place.name,
				position: place.geometry.location
			});

			var x = document.getElementById("debug");
			map.controls[google.maps.ControlPosition.TOP_CENTER].push(x);

			$("#debug").html("Tweets for " + place.name);

			markers.push(marker);

			$('#jstweets').empty();

			getTweets(map, place.geometry.location,radius,100);

			if(sessionId)
			{
				updateTweet(place.geometry.location,sessionId,place.name);
			}

			bounds.extend(place.geometry.location);
		}
		map.fitBounds(bounds);

     var listener = google.maps.event.addListener(map, "idle", function() {
            if (map.getZoom() > 16) map.setZoom(14);
            google.maps.event.removeListener(listener);
        });
	});

	  google.maps.event.addListener(map, 'bounds_changed', function() {
		var bounds = map.getBounds();
		searchBox.setBounds(bounds);
	  });

	if (navigator.geolocation) {
		 navigator.geolocation.getCurrentPosition(function (position) {
			 initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			 map.setCenter(initialLocation);

		 });
	}

}

google.maps.event.addDomListener(window, 'load', initialize);
