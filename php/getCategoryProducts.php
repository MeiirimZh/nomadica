<?php
    header('Content-Type: application/json');
    $conn = new mysqli("localhost", "root", "", "nomadica");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $category_id = intval($data['category_id']);
    $products = [];

    // Получение user_id
    $user = $_COOKIE['user'];
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE name = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_id = intval($result->fetch_assoc()['user_id']);

    $stmt = $conn->prepare('
        SELECT *
        FROM products
        WHERE category_id = ?
    ');

    $stmt->bind_param('i', $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    foreach( $result as $row ) {
        $products[] = $row;
    }

    echo json_encode($products);
    $conn->close();