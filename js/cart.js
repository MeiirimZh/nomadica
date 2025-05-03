document.addEventListener("DOMContentLoaded", () => {
    let products;
    let base_img_path = "/nomadica/img/products/";

    function delFromCart(index) {
        fetch('php/delFromCart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                product_id: products[index]['product_id']
            })
        })

        location.reload();
    }

    fetch('php/getCartProducts.php')
        .then(response => response.json())
        .then(data => {
            let product_cards = document.querySelectorAll(".product-card");

            products = [...data];
        
            product_cards.forEach((element, index) => {
                element.querySelector(".product-card__img").src = base_img_path + products[index]['image_name'];
                element.querySelector(".product-card__text-name").textContent = products[index]['product_name'];
                element.querySelector(".product-card__text-price").textContent = parseInt(products[index]['price']).toLocaleString('en-US').replace(/,/g, ' ').toString() + ' ₸';
                element.querySelector(".product-card__text-price").style.fontWeight = "bold";

                element.querySelector(".product-card__add-to-cart").textContent = "Удалить";
                element.querySelector(".product-card__add-to-cart").addEventListener("click", () => delFromCart(index));
                ;
            });
        })
})