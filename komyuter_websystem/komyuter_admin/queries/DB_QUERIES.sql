
CREATE TABLE saved_locations_tbl (
    location_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    location_name VARCHAR(100) NOT NULL,
    notes VARCHAR(255),
    coordinate POINT NOT NULL,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cooperative_tbl (
    cooperative_id INT AUTO_INCREMENT PRIMARY KEY,
    cooperative_name VARCHAR(150) NOT NULL,
    city VARCHAR(100) NOT NULL,
    address VARCHAR(150) NOT NULL,
    status INT DEFAULT 1,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_updated DATETIME,
    date_removed DATETIME
);


CREATE TABLE user_tbl (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    f_name VARCHAR(100) NOT NULL,
    l_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    contact_no VARCHAR(15) NOT NULL,
    city VARCHAR(100) NOT NULL,
    address VARCHAR(150) NOT NULL,
    access INT DEFAULT 0,
    status INT DEFAULT 0,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_updated DATETIME,
    date_removed DATETIME
);


CREATE TABLE driver_tbl (
    driver_id INT AUTO_INCREMENT PRIMARY KEY,
    cooperative_id INT,
    f_name VARCHAR(100) NOT NULL,
    l_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contact_no VARCHAR(15) NOT NULL,
    city VARCHAR(100) NOT NULL,
    address VARCHAR(150) NOT NULL,
    status INT DEFAULT 0,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_updated DATETIME,
    date_removed DATETIME
);

CREATE TABLE conductor_tbl (
    conductor_id INT AUTO_INCREMENT PRIMARY KEY,
    cooperative_id INT,
    f_name VARCHAR(100) NOT NULL,
    l_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contact_no VARCHAR(15) NOT NULL,
    city VARCHAR(100) NOT NULL,
    address VARCHAR(150) NOT NULL,
    status INT DEFAULT 0,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_updated DATETIME,
    date_removed DATETIME
);

CREATE TABLE route_tbl (
    route_id INT AUTO_INCREMENT PRIMARY KEY,
    route_name VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL
);

CREATE TABLE route_coord_tbl (
    route_id INT,
    coordinate POINT,
    date_added DATETIME
);

CREATE TABLE bus_stops_tbl (
    stop_id INT AUTO_INCREMENT PRIMARY KEY,
    stop_name VARCHAR(255) NOT NULL,
    coordinate POINT,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE gps_device_tbl (
    gps_id VARCHAR(100) PRIMARY KEY,
    status INT DEFAULT 0,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_removed DATETIME
);

CREATE TABLE gps_live_tbl (
    gps_id VARCHAR(100),
    coordinate POINT,
    speed FLOAT(5,2),
    date_added DATETIME
);

CREATE TABLE vehicle_tbl (
    vehicle_id INT AUTO_INCREMENT PRIMARY KEY,
    cooperative_id INT,
    driver_id INT,
    conductor_id INT,
    gps_id varchar(100),
    route_id INT,
    license_num VARCHAR(50) NOT NULL,
    status INT DEFAULT 0,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_updated DATETIME,
    date_removed DATETIME
);

--

CREATE TABLE recent_rides_tbl (
    recent_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    vehicle_id INT,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE report_tbl (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    recent_id INT,
    incident_details VARCHAR (500) NOT NULL,
    incident_date DATE NOT NULL,
    incident_time TIME,
    status INT DEFAULT 0,
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE dismissed_report_tbl (
    report_id INT PRIMARY KEY,
    user_id INT,
    recent_id INT,
    incident_details VARCHAR(500) NOT NULL,
    incident_date DATE NOT NULL,
    incident_time TIME,
    status INT DEFAULT 1,
    date_created DATETIME,
    date_dismissed DATETIME
);

