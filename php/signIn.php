<?php
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $conn = new mysqli("localhost", "root", "", "nomadica");

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 0) {
        $row = $result->fetch_assoc();
        $username = $row["name"];

        setcookie("user", $username, time() + 86400 * 30, "/");
    }

    header("Location: ../index.php");
    exit;