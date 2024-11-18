<?php
class User{
    public function __construct() {
    $this->conn = include_once __DIR__ . '/../connection_db/db_connection.php';
    if (!$this->conn) {
        throw new Exception("Database connection failed.");
    }
}

public function new_user($f_name, $l_name, $email, $password) {
    $NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
    $NOW = $NOW->format('Y-m-d H:i:s');
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $this->conn->prepare("INSERT INTO user_tbl (f_name, l_name, email, password, date_added) VALUES (?, ?, ?, ?, ?)");
    
    try {
        $this->conn->autocommit(false);
        $stmt->bind_param('sssss', $f_name, $l_name, $email, $hashed_password, $NOW);
        $stmt->execute();
        $this->conn->commit();
    } catch (Exception $e) {
        $this->conn->rollback();
        error_log("Error adding new user: " . $e->getMessage());
        return false; 
    }
    
    return true; 
}

public function add_new_user($f_name, $l_name, $email, $password, $contactno, $city, $address, $access, $status) {
    $NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
    $NOW = $NOW->format('Y-m-d H:i:s');
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $this->conn->prepare("INSERT INTO user_tbl (f_name, l_name, email, password, contact_no, city, address, access, status, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    try {
        $this->conn->autocommit(false);
        $stmt->bind_param('ssssssssss', $f_name, $l_name, $email, $hashed_password, $contactno, $city, $address, $access, $status, $NOW);
        $stmt->execute();
        $this->conn->commit();
    } catch (Exception $e) {
        $this->conn->rollback();
        error_log("Error adding new user: " . $e->getMessage());
        return false; 
    }

    return true; 
}

public function check_login($email, $password) {
    $sql = "SELECT password FROM user_tbl WHERE email = ?"; 
    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        error_log("SQL Prepare Error: " . $this->conn->error);
        return false;
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    error_log("Fetched Hashed Password: " . $hashed_password);
    error_log("Input Password: " . $password);

    if ($hashed_password && password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['user_logged_in'] = true;
        $_SESSION['email'] = $email;
        return true;
    } else {
        error_log("Password verification failed for email: $email");
        return false;
    }
}
function get_session(){
    if(isset($_SESSION['login']) && $_SESSION['email'] == true){
        return true;
    }else{
        return false;
    }
}

public function get_user($id) {
    $sql = "SELECT * FROM user_tbl WHERE user_id = " . intval($id);
    $q = $this->conn->query($sql);
    if (!$q) {
        die("Query failed: " . $this->conn->error); 
    }
    $data = [];
    while ($r = $q->fetch_assoc()) {
        $data[] = $r;
    }
    return !empty($data) ? $data : false;
}


public function get_all_users(){
    $sql = "SELECT * FROM user_tbl";
    $q = $this->conn->query($sql);
    if (!$q) {
        die("Query failed: " . $this->conn->error); 
    }
    $data = [];
    while ($r = $q->fetch_assoc()) {
        $data[] = $r;
    }
    return !empty($data) ? $data : false;
}

public function list_users_search($keyword){
		
	$q = $this->conn->prepare('SELECT * FROM `user_tbl` WHERE `l_name` LIKE ?');
	$q->bindValue(1, "%$keyword%", PDO::PARAM_STR);
	$q->execute();

	while($r = $q->fetch(PDO::FETCH_ASSOC)){
	$data[]= $r;
	}
	if(empty($data)){
	   return false;
	}else{
		return $data;	
	}
}

function get_user_id($email) {
    $sql = "SELECT user_id FROM user_tbl WHERE email = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_id = $result->fetch_column();
    return $user_id;
}

function get_first_name($id){
    $sql="SELECT f_name FROM user_tbl WHERE user_id = ?";	
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $f_name = $result->fetch_column();
    return $f_name;
}

function get_last_name($id){
    $sql="SELECT l_name FROM user_tbl WHERE user_id = ?";	
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $l_name = $result->fetch_column();
    return $l_name;
}

function get_email($id){
    $sql="SELECT email FROM user_tbl WHERE user_id = ?";	
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $email = $result->fetch_column();
    return $email;
}

function get_contact_no($id){
    $sql="SELECT contact_no FROM user_tbl WHERE user_id = :id";	
    $q = $this->conn->prepare($sql);
    $q->execute(['id' => $id]);
    $contact = $q->fetchColumn();
    return $contact;
}

function get_city($id){
    $sql="SELECT city FROM user_tbl WHERE user_id = :id";	
    $q = $this->conn->prepare($sql);
    $q->execute(['id' => $id]);
    $city = $q->fetchColumn();
    return $city;
}

function get_address($id){
    $sql="SELECT address FROM user_tbl WHERE user_id = :id";	
    $q = $this->conn->prepare($sql);
    $q->execute(['id' => $id]);
    $address = $q->fetchColumn();
    return $address;
}

function get_status($id){
    $sql="SELECT status FROM user_tbl WHERE user_id = :id";	
    $q = $this->conn->prepare($sql);
    $q->execute(['id' => $id]);
    $status = $q->fetchColumn();
    return $status;
}
function get_access($id){
    $sql="SELECT access FROM user_tbl WHERE user_id = ?";	
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $access = $result->fetch_column();
    return $access;
}

function get_date_added($id){
    $sql="SELECT DATE(date_added) FROM user_tbl WHERE user_id = :id";	
    $q = $this->conn->prepare($sql);
    $q->execute(['id' => $id]);
    $date_added = $q->fetchColumn();
    return $date_added;
}

function get_time_added($id){
    $sql="SELECT TIME(date_added) FROM user_tbl WHERE user_id = :id";	
    $q = $this->conn->prepare($sql);
    $q->execute(['id' => $id]);
    $time_added = $q->fetchColumn();
    return $time_added;
}

function get_date_updated($id){
    $sql="SELECT DATE(date_updated) FROM user_tbl WHERE user_id = :id";	
    $q = $this->conn->prepare($sql);
    $q->execute(['id' => $id]);
    $date_updated = $q->fetchColumn();
    return $date_updated;
}

function get_time_updated($id){
    $sql="SELECT TIME(date_updated) FROM user_tbl WHERE user_id = :id";	
    $q = $this->conn->prepare($sql);
    $q->execute(['id' => $id]);
    $time_updated = $q->fetchColumn();
    return $time_updated;
}



}
?>