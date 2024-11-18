import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:komyuter/map_pages/map_view.dart';

Future login(BuildContext context, TextEditingController userEmail, TextEditingController userPassword) async {
  var uri = "http://192.168.1.31/komyuter_admin/app_api/log_in.php";
  try {
    var response = await http.post(Uri.parse(uri), body: {
      "email": userEmail.text,
      "password": userPassword.text,
    });
    
    print("Response status: ${response.statusCode}");
    print("Response body: ${response.body}");

    var user = json.decode(response.body);
    if (user == "Success") {
      Fluttertoast.showToast(
        msg: "Log-in Successful",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.CENTER,
      );
      Navigator.push(context, MaterialPageRoute(builder: (context) => MapView()));
    } else {
      Fluttertoast.showToast(
        msg: "Log-in Failed",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.CENTER,
      );
    }
  } catch (e) {
    Fluttertoast.showToast(
      msg: "Error: Unable to connect to the server",
      toastLength: Toast.LENGTH_LONG,
      gravity: ToastGravity.CENTER,
    );
    print("Error occurred: $e");
  }
}