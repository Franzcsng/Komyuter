var map = L.map('map').setView([10.675291, 122.953031], 12);
var busMarker; 

L.tileLayer('https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=SGDPtqzalsOvRljYPiuh', {
    attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
    }).addTo(map);


    const markers = {};
    var vehiclesLayer = L.layerGroup().addTo(map);
    var busStopsLayer = L.layerGroup();

    const urlParams = new URLSearchParams(window.location.search);
    const isAddStopPage = urlParams.get('subpage') === 'addstop';

    if (isAddStopPage) {
        // Add a click event listener to the map
        map.on('click', function(e) {
            // Get the clicked coordinates
            const latitude = e.latlng.lat;
            const longitude = e.latlng.lng;

            // Update the form inputs with the clicked coordinates
            document.querySelector('.add-stop-form input[name="longitude"]').value = longitude;
            document.querySelector('.add-stop-form input[name="latitude"]').value = latitude;
        });
    }

    async function fetchCoordinates() {
        const response = await fetch('../komyuter_admin/app_api/get_gps_data.php');
        const data = await response.json();
        console.log(data);
        vehiclesLayer.clearLayers(); 

        if (data && data.length > 0) {
            data.forEach(device => {
                const { gps_id, latitude, longitude } = device;

                // If a marker for this gps_id exists, update its position
                if (markers[gps_id]) {
                    markers[gps_id].setLatLng([latitude, longitude]);
                } else {
                    markers[gps_id] = L.marker([latitude, longitude])
                        .bindPopup(`Device ID: ${gps_id}`);
                }
                markers[gps_id].addTo(vehiclesLayer);
            });

            //Map view to fit all markers
        }
    }
    // Fetch coordinates every 5 seconds
    setInterval(fetchCoordinates, 5000);

    async function fetchBusStops() {
        const response = await fetch('../komyuter_admin/app_api/get_bus_stops.php');  // Create this PHP file similarly
        const data = await response.json();
        console.log("Bus Stops Data:", data);
        busStopsLayer.clearLayers();
    
        if (data && data.length > 0) {
            data.forEach(stop => {
                const { stop_name, latitude, longitude } = stop;
    
                // Add circle markers for bus stops
                L.circle([latitude, longitude], { radius: 50, color: 'blue' })
                    .bindPopup(`Bus Stop: ${stop_name}`)
                    .addTo(busStopsLayer);
            });
        }
    }
    
    fetchBusStops();

    function showVehicles() {
        map.addLayer(vehiclesLayer);
        map.removeLayer(busStopsLayer);
    }
    
    function showStops() {
        map.addLayer(busStopsLayer);
        map.removeLayer(vehiclesLayer);
    }
    
    function showAll() {
        map.addLayer(vehiclesLayer);
        map.addLayer(busStopsLayer);
    }