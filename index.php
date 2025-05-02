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
                for ($i = 0; $i < 16; $i++) {
                    require "blocks/product-card.html";
                }    
            ?>
        </div>
    </main>

    <script src="js/products.js"></script>
    <script src="js/loadUser.js"></script>
</body>
</html>