<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/db.php";

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->email)) {
    $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":email", $data->email);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User created successfully."]);
    } else {
        echo json_encode(["message" => "Failed to create user."]);
    }
} else {
    echo json_encode(["message" => "Incomplete data."]);
}
?>
