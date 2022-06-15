const cartCard2 = document.getElementById('cart-card2')
const cartLogo2 = document.getElementById('cart2')

cartLogo2.addEventListener('click', ()=>{
    cartCard2.classList.toggle('open')
    click2 = 1
    cartLogo2.firstElementChild.classList.toggle('active')
})

let click2 = 0
document.addEventListener("click", (evt) => {
    const flyoutElement = document.getElementById("cart-card");
    let targetElement = evt.target; // clicked element
    click2++
    do {
        if (targetElement == flyoutElement) {
            // This is a click inside. Do nothing, just return.
            return;
        }
        // Go up the DOM
        targetElement = targetElement.parentNode;
    } while (targetElement);
    // This is a click outside.
    if (click2 >= 3) {
        cartCard2.classList.remove('open')
    }
});