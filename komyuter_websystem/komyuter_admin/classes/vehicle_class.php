<?php
class Vehicle {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "komyuter_db";

        // Create the connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);  // Will show connection error if any
        }
    }

    // Add a new vehicle
    public function add_vehicle($cooperative_id, $gps_id, $route_id, $license_num, $status) {
        $NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
        $NOW = $NOW->format('Y-m-d H:i:s');
    
        // Prepare the statement
        $stmt = $this->conn->prepare("INSERT INTO vehicle_tbl (cooperative_id, gps_id, route_id, license_num, status, date_added) VALUES (?, ?, ?, ?, ?, ?)");
        
        try {
            $this->conn->autocommit(false);
            $stmt->bind_param('iiiiss', $cooperative_id, $gps_id, $route_id, $license_num, $status, $NOW);
            $stmt->execute();
    
            // Get the last inserted ID (vehicle ID)
            $new_vehicle_id = $this->conn->insert_id;
    
            $this->conn->commit();
            
            // Return the new vehicle ID
            return $new_vehicle_id;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Error adding new vehicle: " . $e->getMessage());
            return false;
        }
    }

    // Associate GPS device with vehicle
    public function add_gps_device($vehicle_id, $gps_id) {
        $NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
        $NOW = $NOW->format('Y-m-d H:i:s');

        $stmt = $this->conn->prepare("
            UPDATE vehicle_tbl
            SET gps_id = ?, date_updated = ?
            WHERE vehicle_id = ?
        ");

        try {
            $this->conn->autocommit(false);
            $stmt->bind_param('ssi', $gps_id, $NOW, $vehicle_id);
            $stmt->execute();
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Error updating GPS device: " . $e->getMessage());
            return false;
        }

        return true;
    }

    public function get_all_vehicles() {
        $sql = "SELECT * FROM vehicle_tbl";
        $result = $this->conn->query($sql);

        if (!$result) {
            error_log("Query failed: " . $this->conn->error);
            return false;
        }

        $vehicles = [];
        while ($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }

        return $vehicles;
    }

    public function get_vehicle_license($vehicle_id) {
        $stmt = $this->conn->prepare("SELECT license_num FROM vehicle_tbl WHERE vehicle_id = ?");
        $stmt->bind_param('i', $vehicle_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['license_num']; 
        } else {
            return false; 
        }
    }

    public function get_vehicle($vehicle_id) {
        $stmt = $this->conn->prepare("SELECT * FROM vehicle_tbl WHERE vehicle_id = ?");
        $stmt->bind_param('i', $vehicle_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}
?>