function addToCart(id) {
    const currentCartString = getCookie('cart');
    const currentCart = (currentCartString === '') ? {} : JSON.parse(currentCartString);
    if (currentCart.hasOwnProperty(id)) {
        currentCart[id] += 1;
    } else {
        currentCart[id] = 1;
    }
    setCookie('cart', JSON.stringify(currentCart), {
        path: '/'
    })
}

function removeFromCart(id) {
    const currentCartString = getCookie('cart');
    const currentCart = (currentCartString === '') ? {} : JSON.parse(currentCartString);
    if (currentCart.hasOwnProperty(id)) {
        currentCart[id] = 0;
    }
    setCookie('cart', JSON.stringify(currentCart), {
        path: '/'
    })
}

function updateCart() {
    const currentCartString = getCookie('cart');
    const currentCart = (currentCartString === '') ? {} : JSON.parse(currentCartString);
    console.log(currentCart);
}