import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:latlong2/latlong.dart';

Future<List<LatLng>> fetchGPSData() async {
  const String url = "http://192.168.1.31/komyuter_admin/app_api/get_gps_data.php";
  try {
    final response = await http.get(Uri.parse(url));
    if (response.statusCode == 200) {
      List<dynamic> data = jsonDecode(response.body);
      return data.map((item) => LatLng(item['latitude'], item['longitude'])).toList();
    } else {
      throw Exception('Failed to load GPS data');
    }
  } catch (e) {
    print("Error fetching GPS data: $e");
    throw e;
  }
}