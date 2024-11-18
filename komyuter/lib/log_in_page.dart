import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:komyuter/components/log_in_out_text_field.dart';
import 'package:komyuter/components/button_one.dart';
import 'package:komyuter/colors/colors.dart';
import 'package:komyuter/user_operations/log_in.dart';
import 'package:komyuter/map_pages/map_view.dart';
import 'package:komyuter/sign_up_page.dart';

class LogInPage extends StatefulWidget {
  const LogInPage({super.key});

 

@override
_LogInPageState createState() => _LogInPageState();
}

class _LogInPageState extends State<LogInPage> {

  final emailController = TextEditingController();
  final passwordController = TextEditingController();

  @override
  Widget build(BuildContext context){
    return Scaffold(
      backgroundColor: Color.fromARGB(255, 255, 255, 255),
      body: SingleChildScrollView(
        child: Stack(
        children: [

         Positioned(
          top: 100,
          left: 0,  // Ensure alignment from the left
          right: 0, // Ensures it fills the width of the screen
          child: SvgPicture.asset(
            "assets/images/log_in_bg.svg",
            width: MediaQuery.of(context).size.width, // Fit screen width dynamically
            fit: BoxFit.cover,                         // Cover while maintaining aspect ratio
          ),
        ),

          Container(
              height: 120,
              width: double.infinity,
              color: AppColors.mainBlue, // Use color directly if no other decorations are needed
              ),

          Positioned(
            top: -70,
            left: -80,
            child: ClipRRect(
            borderRadius: BorderRadius.circular(300), // Set your desired radius
            child: Container(
              height: 300,
              width: 300,
              color: AppColors.darkBlueAccent,
              ),
          ),
          ),

          Positioned(
            right: -20,
            child: ClipRRect(
            borderRadius: BorderRadius.circular(150), 
            child: Container(
              height: 150,
              width: 150,
              color: AppColors.darkBlueAccent, 
              ),
          ),
          ),

          Positioned(
            right: 30,
            top: 180,
            child: ClipRRect(
            borderRadius: BorderRadius.circular(100), 
            child: Container(
              height: 100,
              width: 100,
              color: AppColors.darkBlueAccent, 
              ),
            ),
          ),
          
          const Positioned(
                left: 45,
                top: 330,
                child:Text("Log-in",
                style: TextStyle(
                fontSize: 35,
                fontFamily: 'Open Sans',
                color: Color.fromARGB(255, 35, 118, 213),
                ),
                ),
              ),

        SafeArea(
        child: Center(
          child: Column(
            children: [
              const SizedBox(
                height: 50,
              ),

             SvgPicture.asset(
                "assets/images/komyuter.svg",
                width: 130,
                height: 130,
                color: Colors.white,),
              
              const SizedBox(
                height: 20,
              ),

                 SvgPicture.asset(
                "assets/images/komyuter_text.svg",
                width: 180,
                color: Colors.white,),
              
               const SizedBox(
                height: 145,
               ),
              
              LogTextField(
                controller: emailController,
                hintText: 'Email',
                obscureText: false,
              ),

              const SizedBox(
                height: 20,
              ),

              LogTextField(
                controller: passwordController,
                hintText: 'Password',
                obscureText: true,
              ),

              const SizedBox(
                height: 20,
              ),

              GestureDetector(
                onTap: (){
                  login(context, emailController, passwordController);
                },
                child: const ButtonOne(text: "Log-in",) 
                ),

              const SizedBox(
                height: 20,
              ),


              const Divider(
                color: Color.fromARGB(194, 69, 106, 174), // Line color
                thickness: 1,       // Line thickness
                indent: 50,         // Left spacing
                endIndent: 50,      // Right spacing
              ),

               const SizedBox(
                height: 10,
              ),



                
              RichText(
                text: TextSpan(
                  children: [
                    const TextSpan(
                      text: "Don't have an account yet? ",
                      style: TextStyle(
                        color: Colors.blue,
                      ),
                      
                    ),

                    WidgetSpan(
                      child: GestureDetector(
                        onTap: (){
                          Navigator.push(context, MaterialPageRoute(builder: (context) => SignUpPage()));
                        },
                        child: const Text(
                          'Sign-up here.',
                          style: TextStyle(
                            color: Color.fromARGB(255, 0, 38, 255),
                          )), 
                      )
                    ),
                  ]
                ),
              ),
                
               
            ],
          ),
        ),
      ),
        ],
      ),
      )
    );
  }

}