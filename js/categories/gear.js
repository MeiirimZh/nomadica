document.addEventListener("DOMContentLoaded", () => {
    let products;
    let page_products;
    let base_img_path = "/nomadica/img/products/";
    
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
          const j = Math.floor(Math.random() * (i + 1));
          [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function addToCart(index) {
        fetch('php/addToCart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                product_id: page_products[index]['product_id']
            })
        })

        alert("Товар добавлен в корзину!");
    }
    
    fetch('php/getCategoryProducts.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            category_id: 2
        })
    })
        .then(response => response.json())
        .then(data => {
            let product_cards = document.querySelectorAll(".product-card");

            products = [...data];
            page_products = shuffleArray(products);
        
            product_cards.forEach((element, index) => {
                element.querySelector(".product-card__img").src = base_img_path + page_products[index]['image_name'];
                element.querySelector(".product-card__text-name").textContent = page_products[index]['product_name'];
                element.querySelector(".product-card__text-price").textContent = parseInt(page_products[index]['price']).toLocaleString('en-US').replace(/,/g, ' ').toString() + ' ₸';
                element.querySelector(".product-card__text-price").style.fontWeight = "bold";

                element.querySelector(".product-card__add-to-cart").addEventListener("click", () => addToCart(index));
                ;
            });
        })
});