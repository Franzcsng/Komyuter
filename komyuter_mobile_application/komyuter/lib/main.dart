import 'package:flutter/material.dart';
import 'package:komyuter/log_in_page.dart';
import 'package:komyuter/map_pages/map_view.dart';
import 'package:komyuter/sign_up_page.dart';
import 'package:komyuter/introduction_pages/onboarding_page.dart';
import 'package:komyuter/mainpage.dart';


void main() {
  runApp(const Komyuter());
}

class Komyuter extends StatelessWidget {
  const Komyuter({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Komyuter',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
        useMaterial3: true,
      ),
      //home: MapView()
      //OnboardingScreen(),
      home: MainPage(),//LogInPage(),
      //home: SignUpPage(),
    );
  }
}