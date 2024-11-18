<?php

class Route {
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

    // Add a new route
    public function add_route($route_name, $city) {
        $stmt = $this->conn->prepare("INSERT INTO route_tbl (route_name, city) VALUES (?, ?)");
        try {
            $stmt->bind_param('ss', $route_name, $city);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            error_log("Error adding route: " . $e->getMessage());
            return false;
        }
    }

    // Update an existing route
    public function update_route($route_id, $route_name, $city) {
        $stmt = $this->conn->prepare("UPDATE route_tbl SET route_name = ?, city = ? WHERE route_id = ?");
        try {
            $stmt->bind_param('ssi', $route_name, $city, $route_id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            error_log("Error updating route: " . $e->getMessage());
            return false;
        }
    }

    // Get route by ID
    public function get_route($route_id) {
        $stmt = $this->conn->prepare("SELECT * FROM route_tbl WHERE route_id = ?");
        $stmt->bind_param('i', $route_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Get all routes
    public function get_all_routes() {
        $stmt = $this->conn->prepare("SELECT * FROM route_tbl");
        try {
            $stmt->execute();
            $result = $stmt->get_result();
            $routes = [];
            while ($row = $result->fetch_assoc()) {
                $routes[] = $row;
            }
            return $routes;
        } catch (Exception $e) {
            error_log("Error fetching all routes: " . $e->getMessage());
            return [];
        }
    }

    // Deactivate a route (soft delete)
    public function deactivate_route($route_id) {
        $stmt = $this->conn->prepare("UPDATE route_tbl SET status = 0 WHERE route_id = ?");
        try {
            $stmt->bind_param('i', $route_id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            error_log("Error deactivating route: " . $e->getMessage());
            return false;
        }
    }
}

?>