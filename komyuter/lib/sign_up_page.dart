import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:komyuter/components/log_in_out_text_field.dart';
import 'package:komyuter/components/button_one.dart';
import 'package:komyuter/user_operations/create_user.dart';
import 'package:komyuter/colors/colors.dart';
import 'package:komyuter/log_in_page.dart';



class SignUpPage extends StatefulWidget {
  const SignUpPage({super.key});

 
@override
_SignUpPageState createState() => _SignUpPageState();
}

class _SignUpPageState extends State<SignUpPage> {

  final firstNameController = TextEditingController();
  final lastNameController = TextEditingController();
  final emailController = TextEditingController();
  final passwordController = TextEditingController();
  final repeatPasswordController = TextEditingController();

  @override
  Widget build(BuildContext context){
    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 255, 255, 255),
      body: SingleChildScrollView(
        child: Stack(
        children: [

         Positioned(
          top: 20,
          left: 0,  // Ensure alignment from the left
          right: 0, // Ensures it fills the width of the screen
          child: SvgPicture.asset(
            "assets/images/log_in_bg.svg",
            width: MediaQuery.of(context).size.width, // Fit screen width dynamically
            fit: BoxFit.cover,                         // Cover while maintaining aspect ratio
          ),
        ),

          Container(
              height: 130,
              width: double.infinity,
              color: AppColors.mainBlue, // Use color directly if no other decorations are needed
              ),

          Positioned(
            top: -20,
            left: -10,
            child: ClipRRect(
            borderRadius: BorderRadius.circular(100), // Set your desired radius
            child: Container(
              height: 100,
              width: 100,
              color: Color.fromARGB(255, 21, 94, 177), // Use color directly if no other decorations are needed
              ),
          ),
          ),

          Positioned(
            right: 40,
            child: ClipRRect(
            borderRadius: BorderRadius.circular(120), // Set your desired radius
            child: Container(
              height: 120,
              width: 120,
              color: AppColors.darkBlueAccent, // Use color directly if no other decorations are needed
              ),
          ),
          ),

          Positioned(
            right: 30,
            top: 180,
            child: ClipRRect(
            borderRadius: BorderRadius.circular(60), // Set your desired radius
            child: Container(
              height: 60,
              width: 60,
              color: AppColors.darkBlueAccent, // Use color directly if no other decorations are needed
              ),
            ),
          ),
          
          const Positioned(
                top: 240,
                left: 35,
                child:Text("Sign-up",
                style: TextStyle(
                fontSize: 35,
                fontFamily: 'Open Sans',
                color: Color.fromARGB(255, 35, 118, 213),
                ),
                ),
              ),

            Positioned(
            left: 30,
            top: 70,
            child: SvgPicture.asset(
                "assets/images/komyuter.svg",
                width: 110,
                height: 110,
                color: Colors.white,
                ),
          ),


        SafeArea(
        child: Center(
          child: Column(
            children: [
              const SizedBox(
                height: 90,
              ),
              
               const SizedBox(
                height: 185,
               ),
              
              LogTextField(
                controller: firstNameController,
                hintText: 'First name',
                obscureText: false,
              ),

              const SizedBox(
                height: 10,
              ),

              LogTextField(
                controller: lastNameController,
                hintText: 'Last name',
                obscureText: false,
              ),

              const SizedBox(
                height: 10,
              ),


              LogTextField(
                controller: emailController,
                hintText: 'Email',
                obscureText: false,
              ),
              

              const SizedBox(
                height: 10,
              ),

              LogTextField(
                controller: passwordController,
                hintText: 'Password',
                obscureText: true,
              ),

              const SizedBox(
                height: 10,
              ),

               LogTextField(
                controller: repeatPasswordController,
                hintText: 'Confirm password',
                obscureText: true,
              ),

              const SizedBox(
                height: 20,
              ),
              
              GestureDetector(
                onTap: () {
                  createUserRecord(firstNameController, lastNameController, emailController, passwordController, repeatPasswordController);
                  Navigator.push(context, MaterialPageRoute(builder: (context) => LogInPage()));
                  
                },
                child: const ButtonOne(text: "Register",),
              ),

              const SizedBox(
                height: 10,
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
                      text: "Already have an account? ",
                      style: TextStyle(
                        color: Colors.blue,
                      ),
                      
                    ),

                    WidgetSpan(
                      child: GestureDetector(
                        onTap: (){
                          Navigator.push(context, MaterialPageRoute(builder: (context) => LogInPage()));
                        },
                        child: const Text(
                          'log-in here.',
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
      )
      )
    );
  }

}