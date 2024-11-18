import 'package:flutter/material.dart';

class ButtonOne extends StatelessWidget {
  final String text;

  const ButtonOne({
    super.key,
    required this.text,
    });

@override 
Widget build(BuildContext context) {

  return Container(
    width: 260,
    height: 45,
    decoration: const BoxDecoration(
      color: Colors.blue,
      borderRadius: BorderRadius.all(Radius.circular(10))
    ),
    child: Center(
      child: Text(
      text,
      style: const TextStyle(
        fontFamily: 'Open Sans',
        fontSize: 20,
        color: Colors.white,
      ),
    ), 
    ),
  );
}

}