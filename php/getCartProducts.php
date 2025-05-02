<?php
    header('Content-Type: application/json');
    $conn = new mysqli("localhost", "root", "", "nomadica");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
        WHERE product_id = ANY(
        	SELECT product_id
        	FROM user_products
        	WHERE user_id = ?
        )
    ');

    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    foreach( $result as $row ) {
        $products[] = $row;
    }

    echo json_encode($products);
    $conn->close();