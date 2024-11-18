<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'komyuter_db';
$user = 'root';
$pass = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get bus stops with coordinates split into latitude and longitude
    $query = "
        SELECT stop_name, ST_X(coordinate) AS latitude, ST_Y(coordinate) AS longitude
        FROM bus_stops_tbl
    ";

    $stmt = $pdo->query($query);
    $busStops = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if any data was retrieved
    if (empty($busStops)) {
        echo json_encode(['error' => 'No data found']);
    } else {
        echo json_encode($busStops);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>