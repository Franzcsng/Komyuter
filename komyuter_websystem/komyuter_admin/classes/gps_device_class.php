<?php
class GPSDevice {
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


    // Add a new GPS device
    public function add_device($gps_id) {
        $stmt = $this->conn->prepare("INSERT INTO gps_device_tbl (gps_id) VALUES (?)");
        
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param('s', $gps_id); // 's' denotes string
        $stmt->execute();
        $stmt->close();

        return true;
    }

    // Update GPS device status
    public function update_device_status($gps_id, $status) {
        $stmt = $this->conn->prepare("UPDATE gps_device_tbl SET status = ? WHERE gps_id = ?");

        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param('is', $status, $gps_id); // 'i' for integer, 's' for string
        $stmt->execute();
        $stmt->close();

        return true;
    }

    // Get GPS device by ID
    public function get_device($gps_id) {
        $stmt = $this->conn->prepare("SELECT * FROM gps_device_tbl WHERE gps_id = ?");

        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param('s', $gps_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $device = $result->fetch_assoc();
        $stmt->close();

        return $device;
    }

    // Get all GPS devices
    public function get_all_devices() {
        $stmt = $this->conn->prepare("SELECT * FROM gps_device_tbl");

        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $devices = [];
        while ($row = $result->fetch_assoc()) {
            $devices[] = $row;
        }

        $stmt->close();
        return $devices;
    }

    // Deactivate (soft delete) GPS device by setting status to 0
    public function deactivate_device($gps_id) {
        $stmt = $this->conn->prepare("UPDATE gps_device_tbl SET status = 0, date_removed = NOW() WHERE gps_id = ?");

        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }

        $stmt->bind_param('s', $gps_id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    // Get unassigned GPS devices (status = 0)
    public function get_unassigned_devices() {
        $stmt = $this->conn->prepare("SELECT * FROM gps_device_tbl WHERE status = 1");

        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $devices = [];
        while ($row = $result->fetch_assoc()) {
            $devices[] = $row;
        }

        $stmt->close();
        return $devices;
    }
}
?>