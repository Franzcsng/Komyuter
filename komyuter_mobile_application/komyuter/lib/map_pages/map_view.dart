import 'package:flutter/material.dart';
import 'package:flutter_map/flutter_map.dart';
import 'package:latlong2/latlong.dart';
import 'package:komyuter/map_pages/map_operations/get_current_location.dart';  // Import the LocationService class
import 'package:komyuter/map_pages/map_operations/fetch_coordinates.dart';  
import 'package:komyuter/map_pages/map_operations/fetch_bus_stops.dart';  
import 'dart:async';
import 'package:komyuter/map_pages/marker_options.dart';  

class MapView extends StatefulWidget {
  const MapView({super.key});

 

@override
_MapViewState createState() => _MapViewState();
}

class _MapViewState extends State<MapView> {

  final MapController _mapController = MapController();
  LatLng? _currentLocation; 
  List<LatLng> _gpsLocations = [];
  List<LatLng> _busStopLocations = []; 
  bool _loading = true; 
  Timer? _timer;


  
  Future<void> _fetchGPSData() async {
  setState(() {
    _loading = true;
  });

  try {
    List<LatLng> data = await fetchGPSData();
    if (mounted) {
      setState(() {
        _gpsLocations = data;
        _loading = false;
      });
    }
  } catch (e) {
    print("Error in _fetchGPSData: $e");
    if (mounted) {
      setState(() {
        _loading = false;
      });
    }
  }
}

Future<void> _fetchBusStopsData() async {
  setState(() {
    _loading = true;
  });

  try {
    List<LatLng> data = await fetchBusStopsData();
    if (mounted) {
      setState(() {
        _busStopLocations = data;
        _loading = false;
      });
    }
  } catch (e) {
    print("Error in _fetchBusStopsData: $e");
    if (mounted) {
      setState(() {
        _loading = false;
      });
    }
  }
}

Future<void> _getCurrentLocation() async {
  LocationService locationService = LocationService();
  LatLng? currentLoc = await locationService.getCurrentLocation();

  if (currentLoc != null) {
    if (mounted) {
      setState(() {
        _currentLocation = currentLoc;
      });

    }
  } else {
    print("Location is null, please check permissions or service.");
  }
}

  @override
  void initState() {
    super.initState();
    _fetchGPSData();  
    _fetchBusStopsData(); 
    _getCurrentLocation(); 

    _timer = Timer.periodic(const Duration(seconds: 5), (timer) {
      _fetchGPSData();
      _fetchBusStopsData(); 
      _getCurrentLocation();
    });
  }

  @override
  void dispose() {
    _timer?.cancel(); 
    super.dispose();
  }

  @override
  Widget build(BuildContext context){
     
    return Scaffold(
      body: Stack(
        children: [
          FlutterMap(
            mapController: _mapController,
            options:  MapOptions(

              initialCenter: _currentLocation ?? const LatLng(10.6534, 122.9365),
              initialZoom: 15, 
            ),
            children: [
              TileLayer(
                urlTemplate: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
              ),
              if (!_loading) 

                MarkerLayer(
                  markers: [
                    // GPS markers
                    ..._gpsLocations.map((location) {
                      return Marker(
                        point: location,
                        width: 80.0,  
                        height: 80.0, 
                        child: const Icon(
                          Icons.directions_bus,
                          color: Colors.red,
                          size: 30,
                        ),
                      );
                    }).toList(),
                    // Bus stop markers
                    ..._busStopLocations.map((location) {
                      return Marker(
                        point: location,
                        width: 60.0, 
                        height: 60.0,
                        child: const Icon(
                          Icons.stop_circle,  
                          color: Colors.blue,
                          size: 30,
                        ),
                      );
                    }).toList(),
                    if (_currentLocation != null)
                    
                      Marker(
                        
                        point: _currentLocation!,
                        width: 60.0,
                        height: 60.0,
                        child: GestureDetector(
                          onTap: (){
                            showUserMarkerDetails(context, _currentLocation);
                          },
                          child: const Icon(
                            Icons.person_pin_circle,
                            color: Colors.green,
                            size: 40,
                          ),
                        ),
                      ),
                  ],
                ),
             
            ],)
        ],
      ),
    );
  }
}