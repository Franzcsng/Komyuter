import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:latlong2/latlong.dart';


Future<List<LatLng>> fetchBusStopsData() async {
  const String url = "http://192.168.1.31/komyuter_admin/app_api/get_bus_stops.php"; 
  try {
    final response = await http.get(Uri.parse(url));
    if (response.statusCode == 200) {
      List<dynamic> data = jsonDecode(response.body);
      return data.map((item) => LatLng(item['latitude'], item['longitude'])).toList();
    } else {
      throw Exception('Failed to load bus stops data');
    }
  } catch (e) {
    print("Error fetching bus stops data: $e");
    throw e;
  }
}