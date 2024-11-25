import 'package:flutter/material.dart';
import 'package:komyuter/introduction_pages/intro_page_1.dart';
import 'package:komyuter/introduction_pages/intro_page_2.dart';
import 'package:komyuter/introduction_pages/intro_page_3.dart';
import 'package:smooth_page_indicator/smooth_page_indicator.dart';

class OnboardingScreen extends StatefulWidget {
  const OnboardingScreen({super.key});


@override
_OnboardingScreenState createState() => _OnboardingScreenState();
}

class _OnboardingScreenState extends State<OnboardingScreen> {

  PageController _controller = PageController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
           PageView(
            controller: _controller,
            children: [
              IntroPage1(),
              IntroPage2(),
              IntroPage3(),
            ],
           ),

           Container(
            alignment: Alignment(0, 0.75),
            child: 
              SmoothPageIndicator(controller: _controller, count: 3),)
        ],
      ),
    );
  }
}