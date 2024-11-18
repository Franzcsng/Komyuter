<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'komyuter_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "
        SELECT gps_id, ST_X(coordinate) AS latitude, ST_Y(coordinate) AS longitude
        FROM gps_live_tbl AS main
        WHERE date_added = (
            SELECT MAX(date_added)
            FROM gps_live_tbl
            WHERE gps_id = main.gps_id
        )
    ";

    $stmt = $pdo->query($query);
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if any data was retrieved
    if (empty($locations)) {
        echo json_encode(['error' => 'No data found']);
    } else {
        echo json_encode($locations);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>