<?php
    header('Content-Type: application/json');
    $conn = new mysqli("localhost", "root", "", "nomadica");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT product_id, product_name, price, image_name, category_id FROM products";
    $result = $conn->query($sql);
    $products = [];

    foreach( $result as $row ) {
        $products[] = $row;
    }

    echo json_encode($products);
    $conn->close();