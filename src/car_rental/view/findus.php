<h1>Find Us Everywhere On Earth</h1>

<div id="map">

</div>

<script>
    var map = L.map('map').setView([48.636115, 2.194458], 2);
    // create the tile layer with correct attribution
    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
        maxZoom: 15,
        minZoom: 2
    }).addTo(map);

    var marker = L.marker([48.850614, 2.310478]).addTo(map);
    marker.bindPopup("<b>Paris Rental Store</b><br><p>Come visits the city of light !</p>").openPopup();

    var geoJsonFeature = {
        "type": "Feature",
        "properties": {
            "name": "New York Rental Store",
            "amenity": "New York Rental Store",
            "popupContent": "The right place to start explore the big apple !"
        },
        "geometry": {
            "type": "Point",
            "coordinates": [-74.020193, 40.775271]
        }
    };

    function onEachFeature(feature, layer) {
        // does this feature have a property named popupContent?
        if (feature.properties && feature.properties.popupContent) {
            layer.bindPopup(feature.properties.popupContent);
        }
    }

    L.geoJson(geoJsonFeature, {
        onEachFeature: onEachFeature
    }).addTo(map);

   


</script>

