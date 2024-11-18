import 'package:flutter/material.dart';
import 'package:komyuter/colors/colors.dart';
import 'package:latlong2/latlong.dart';
import 'package:flutter_map/flutter_map.dart';

double _calculateDistance(LatLng start, LatLng end) {
final Distance distance = Distance();
return distance.as(LengthUnit.Kilometer, start, end); 
} 

void showUserMarkerDetails(BuildContext context, LatLng? userlocation) {
  showModalBottomSheet(
    context: context,
    isScrollControlled: true,
    builder: (BuildContext context) {
      return DraggableScrollableSheet(
        expand: false,
        builder: (BuildContext context, ScrollController scrollController) {
          return SingleChildScrollView(
            controller: scrollController,
            child: Container(
              width: double.infinity,
              padding: const EdgeInsets.all(20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [

                const Text( 
                    'Current Location',
                    style: TextStyle(
                      color: AppColors.darkBlueAccent,
                      fontSize: 24,
                      fontWeight: FontWeight.bold,
                    ),
                ),

              const SizedBox(height: 5),

                const Text('Nearby Jeepneys',
                  style: TextStyle(
                    color: AppColors.darkBlueAccent,
                  ),
                ),

              const SizedBox(height: 10),

                SizedBox(
                  height: 500,
                  child: ListView.builder(
                    itemCount: 10, // Replace with your actual list length
                    itemBuilder: (context, index) {
                      return ListTile(
                        leading: const Icon(Icons.directions_bus),
                        title: Text('Jeepney #$index'),
                        subtitle: const Text('Details here'),
                      );
                    },
                  ),
                ),


                 
                ],
              ),
            ),
          );
        },
      );
    },
  );
}