document.addEventListener("DOMContentLoaded", () => {
    let products;
    let base_img_path = "/nomadica/img/products/";
    
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
          const j = Math.floor(Math.random() * (i + 1));
          [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }
    
    fetch('php/getProducts.php')
        .then(response => response.json())
        .then(data => {
            let product_cards = document.querySelectorAll(".product-card");

            products = [...data];
            page_products = shuffleArray(products);
        
            product_cards.forEach((element, index) => {
                element.querySelector(".product-card__img").src = base_img_path + page_products[index]['image_name'];
                element.querySelector(".product-card__text-name").textContent = page_products[index]['product_name'];
                element.querySelector(".product-card__text-price").textContent = page_products[index]['price'].toLocaleString('en-US').replace(/,/g, ' ') + ' ₸';
                ;
            });
        })
});