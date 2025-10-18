<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/db.php";

$query = "SELECT id, name, email, created_at FROM users ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($users) {
    echo json_encode($users);
} else {
    echo json_encode([]);
}
?>
