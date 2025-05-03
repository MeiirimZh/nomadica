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
    ?>
    <main>
        <div class="products">
            <?php
                $conn = new mysqli('localhost', 'root', '', 'nomadica');

                $result = $conn->query("SELECT COUNT(*) AS products_count FROM products WHERE category_id = 1");
                $products_count = intval($result->fetch_assoc()['products_count']);

                for ($i = 0; $i < $products_count; $i++) {
                    require "blocks/product-card.html";
                }    
            ?>
        </div>
    </main>

    <script src="js/categories.js"></script>
    <script src="js/loadUser.js"></script>
</body>
</html>