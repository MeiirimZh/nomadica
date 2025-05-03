<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomadica</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/product-card.css">
</head>
<body>
    <?php
        require_once "blocks/header.html";

        $conn = new mysqli("localhost", "root", "", "nomadica");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_COOKIE['user'])) {
            $user = $_COOKIE['user'];

            $stmt = $conn->prepare("SELECT user_id FROM users WHERE name = ?");
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $result = $stmt->get_result();
            $user_id = intval($result->fetch_assoc()['user_id']);

            $stmt = $conn->prepare("SELECT COUNT(*) AS product_count FROM user_products WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $products_count = intval($result->fetch_assoc()["product_count"]);
        }
        else {
            $products_count = 0;
        }
    ?>

    <main>
        <div class="products">
            <?php
                for ($i = 0; $i < $products_count; $i++) {
                    require "blocks/product-card.html";
                }
            ?>
        </div>
    </main>

    <script src="js/cart.js"></script>
    <script src="js/loadUser.js"></script>
</body>
</html>