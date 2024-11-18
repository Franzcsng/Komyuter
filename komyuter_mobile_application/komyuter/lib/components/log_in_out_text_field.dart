import 'package:flutter/material.dart';

class LogTextField extends StatelessWidget {
  final controller;
  final String hintText;
  final bool obscureText;

  const LogTextField({
    super.key,
    required this.controller,
    required this.hintText,
    required this.obscureText,
    });

  @override
  Widget build(BuildContext context){
    return  Padding(
      padding: const EdgeInsets.symmetric(horizontal: 50.0),
      child: SizedBox(
        height: 45,
        child: TextField(
        controller: controller,
        obscureText: obscureText,
        decoration: InputDecoration(
          enabledBorder: const OutlineInputBorder(
            borderRadius: BorderRadius.all(Radius.circular(15)),
            borderSide: BorderSide(
              color: Color.fromARGB(255, 34, 126, 246),
              width: 0.75)
          ),
          focusedBorder: const OutlineInputBorder(
            borderRadius: BorderRadius.all(Radius.circular(15)),
            borderSide: BorderSide(
              color: Color.fromARGB(255, 1, 70, 247),
              width: 2)
          ),
          fillColor: const Color.fromARGB(255, 255, 255, 255),
          filled: true,
          hintText: hintText,
          hintStyle: const TextStyle(
            fontFamily: 'Open Sans',
            fontSize: 13,
            color: Color.fromARGB(255, 6, 134, 240),
          ),
        )
        )
       ,)
    );

  }
}