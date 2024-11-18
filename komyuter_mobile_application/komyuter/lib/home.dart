import 'package:flutter/material.dart';
import 'package:flutter_map/flutter_map.dart';
import 'package:komyuter/colors/colors.dart';
import 'package:latlong2/latlong.dart';
import 'package:komyuter/map_pages/map_operations/get_current_location.dart';  // Import the LocationService class
import 'package:komyuter/map_pages/map_operations/fetch_coordinates.dart';  
import 'package:komyuter/map_pages/map_operations/fetch_bus_stops.dart';  
import 'dart:async';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

 

@override
_HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {

  @override
  Widget build(BuildContext context){
    return Scaffold(
      body: Stack(
        children: [

          Container(
            padding: EdgeInsets.all(20),
            child: const Text('Saved Locations',
            style: TextStyle(
              color: AppColors.mainBlue,
              fontFamily: 'Open Sans',
              fontSize: 18,
            ),)
          ),

        

        ],
      ),
    );
  }
}