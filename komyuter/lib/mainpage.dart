import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:komyuter/components/log_in_out_text_field.dart';
import 'package:komyuter/components/button_one.dart';
import 'package:komyuter/colors/colors.dart';
import 'package:komyuter/user_operations/log_in.dart';
import 'package:komyuter/map_pages/map_view.dart';
import 'package:komyuter/home.dart';
import 'package:komyuter/sign_up_page.dart';
import 'package:google_nav_bar/google_nav_bar.dart';

class MainPage extends StatefulWidget {
  const MainPage({super.key});

 

@override
_MainPageState createState() => _MainPageState();
}

class _MainPageState extends State<MainPage> {
  int _selectedIndex = 0;
   final List<Widget> _pages = [
    // Add pages here
    HomePage(), // Placeholder for the home page
    MapView(),  // This will be the map page
    Center(child: Text('Reports Page')), // Placeholder for the reports page
  ];

  void _onItemTapped(int index) {
    setState(() {
      _selectedIndex = index;  // Update the selected tab index
    });
  }

  @override
  Widget build(BuildContext context){
    return MaterialApp(
      home: Scaffold(
      appBar: AppBar(
        backgroundColor: AppColors.darkBlueAccent,
        elevation: 0,
        title: SvgPicture.asset(
                "assets/images/komyuter_text.svg",
                width: 100,
                color: Colors.white,),
        iconTheme: const IconThemeData(
            color: Colors.white,  // Set the drawer icon color to white
          ),
      ),
      drawer: Drawer(
        child: Container(
          color: AppColors.mainBlue,
          child: ListView(
            children: [

              DrawerHeader(
                child:  SvgPicture.asset(
                "assets/images/komyuter.svg",
                height: 80,
                color: Colors.white,)
                ),
                
              ListTile(
              title: const Text('Settings',
              style: TextStyle(color: Colors.white)),
              onTap: () {},
              ),

              ListTile(
                title: const Text('Preferences',
                style: TextStyle(color: Colors.white)),
                onTap: () {},
              ),
            ],
          ),
        ),
      ),

      
      bottomNavigationBar: Container(
        color: AppColors.darkBlueAccent,
        child: Padding(
          padding:  EdgeInsets.symmetric(horizontal: 15.0, vertical: 10),
          child:  GNav(
          backgroundColor: AppColors.darkBlueAccent,
          color: Colors.white,
          activeColor: Colors.white,
          tabBackgroundColor: AppColors.mainBlue,
          padding: EdgeInsets.all(10),
          gap: 8,
          onTabChange: _onItemTapped, 
          tabs: const [
            
            GButton(
              icon: Icons.home,
              text: 'home'
            ),
        
            GButton(
              icon: Icons.map,
              text: 'map'
            ),
        
            GButton(
              icon: Icons.note,
              text: 'reports'
            ),
          ]
        ),
        ),
      ),
      backgroundColor: const Color.fromARGB(255, 255, 255, 255),
      body: _pages[_selectedIndex],
      )
    );
  }

}