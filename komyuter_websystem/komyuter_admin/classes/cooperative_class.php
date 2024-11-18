<?php
class Cooperative {
    private $conn;

    // Constructor to establish a database connection
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
    // Add a new cooperative
    public function add_cooperative($cooperative_name, $city, $address) {
        $NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
        $NOW = $NOW->format('Y-m-d H:i:s');
    
        // Prepare the statement
        $stmt = $this->conn->prepare("INSERT INTO cooperative_tbl (cooperative_name, city, address, date_added) VALUES (?, ?, ?, ?)");
    
        try {
            $this->conn->autocommit(false);
            $stmt->bind_param('ssss', $cooperative_name, $city, $address, $NOW);
            $stmt->execute();
    
            // Get the last inserted ID (cooperative ID)
            $new_cooperative_id = $this->conn->insert_id;
    
            $this->conn->commit();
    
            // Return the new cooperative ID
            return $new_cooperative_id;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Error adding cooperative: " . $e->getMessage());
            return false;
        }
    }

    // Update an existing cooperative
    public function update_status($cooperative_id, $status) {
        // Get the current timestamp
        $NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
        $NOW = $NOW->format('Y-m-d H:i:s');

        $stmt = $this->conn->prepare("UPDATE cooperative_tbl SET status = ?, date_updated = ? WHERE cooperative_id = ?");
    
        try {

            $this->conn->autocommit(false);
            $stmt->bind_param('isi', $status, $NOW, $cooperative_id);
            $stmt->execute();
            $this->conn->commit();
            return $cooperative_id;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Error updating cooperative status: " . $e->getMessage());
            return false;
        }
    }

    // Get cooperative by ID
    public function get_cooperative($cooperative_id) {
        $stmt = $this->conn->prepare("SELECT * FROM cooperative_tbl WHERE cooperative_id = ?");
        $stmt->bind_param('i', $cooperative_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function get_cooperative_name($cooperative_id) {
        $stmt = $this->conn->prepare("SELECT cooperative_name FROM cooperative_tbl WHERE cooperative_id = ?");
        $stmt->bind_param('i', $cooperative_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $coop_name = $result->fetch_column();
        return $coop_name;
    }

    public function getAllCooperativeIDs() {
        $query = "SELECT cooperative_id FROM cooperative_tbl";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $coop_ids = [];
        while ($row = $result->fetch_assoc()) {
            $coop_ids[] = $row['coop_id'];
        }

        $stmt->close();
        return $coop_ids;
    }

    public function getAllCooperatives() {
        $query = "SELECT * FROM cooperative_tbl"; // Corrected column names
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            // Output detailed error message from MySQL
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result) {
            // Output detailed error message from MySQL
            throw new Exception("Query execution failed: " . $this->conn->error);
        }
    
        $cooperatives = [];
        while ($row = $result->fetch_assoc()) {
            $cooperatives[] = $row;
        }
    
        $stmt->close();
        return $cooperatives;
    }

    public function get_all_cooperatives() {
        try {
            $result = $this->conn->query("SELECT * FROM cooperative_tbl WHERE status = 1");
            if (!$result) {
                throw new Exception("Query failed: " . $this->conn->error);
            }
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return []; 
        }
    }


    public function deactivate_cooperative($cooperative_id) {
        $NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
        $NOW = $NOW->format('Y-m-d H:i:s');

        $stmt = $this->conn->prepare("UPDATE cooperative_tbl SET status = 0, date_removed = ? WHERE cooperative_id = ?");
        try {
            $this->conn->autocommit(false);
            $stmt->bind_param('si', $NOW, $cooperative_id);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Error deactivating cooperative: " . $e->getMessage());
            return false;
        }
    }
}
?>