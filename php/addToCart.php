<?php
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);

    $user = $_COOKIE['user'];
    $product_id = intval($data['product_id']);

    $conn = new mysqli("localhost", "root", "", "nomadica");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE name = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    $user_id = intval($result->fetch_assoc()['user_id']);

    $stmt = $conn->prepare("INSERT INTO user_products VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();