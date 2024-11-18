import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

Future<void> createUserRecord(
    TextEditingController firstNameController,
    TextEditingController lastNameController,
    TextEditingController emailController,
    TextEditingController passwordController,
    TextEditingController repeatPasswordController) async {
  if (firstNameController.text.isNotEmpty &&
      lastNameController.text.isNotEmpty &&
      emailController.text.isNotEmpty &&
      passwordController.text.isNotEmpty &&
      repeatPasswordController.text == passwordController.text) {
    try {
      String uri = "http://192.168.1.31/komyuter_admin/app_api/insert_record.php";
      var body = {
        "fname": firstNameController.text,
        "lname": lastNameController.text,
        "email": emailController.text,
        "password": passwordController.text,
      };

      print("Sending data: $body"); // Debug: Check what is being sent

      var res = await http.post(Uri.parse(uri), body: body);

      print("Raw response: ${res.body}"); // Debug: Check API response

      var response = jsonDecode(res.body);
      if (response["success"] == "true") {
        print("Record Inserted");

        firstNameController.clear();
        lastNameController.clear();
        emailController.clear();
        passwordController.clear();
        repeatPasswordController.clear();
      } else {
        print("Server error: ${response["error"]}");
      }
    } catch (e) {
      print("Exception occurred: $e");
    }
  } else if (repeatPasswordController.text != passwordController.text) {
    print("Passwords do not match!");
  } else {
    print("Please fill up all fields");
  }
}