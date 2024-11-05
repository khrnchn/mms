<div>
    <div id="map" style="height: 400px; width: 100%;" aria-label="Google Map showing {{ $address }}"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15
            });

            geocoder.geocode({
                'address': '{{ $address }}'
            }, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                    new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    console.error('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    </script>
</div>