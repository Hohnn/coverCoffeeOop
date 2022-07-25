const cartCard = document.getElementById('cart-card')
const cartLogo = document.getElementById('cart')

cartLogo.addEventListener('click', ()=>{
    cartCard.classList.toggle('open')
    click = 1
    cartLogo.firstElementChild.classList.toggle('active')
})

let click = 0
document.addEventListener("click", (evt) => {
    const flyoutElement = document.getElementById("cart-card");
    let targetElement = evt.target; // clicked element
    click++
    do {
        if (targetElement == flyoutElement) {
            // This is a click inside. Do nothing, just return.
            return;
        }
        // Go up the DOM
        targetElement = targetElement.parentNode;
    } while (targetElement);
    // This is a click outside.
    if (click >= 3) {
        cartCard.classList.remove('open')
        cartLogo.firstElementChild.classList.remove('active')
    }
});