let selectCart = document.querySelectorAll('.selectCart')
selectCart.forEach(select => {
    select.addEventListener('click', function(event) {
    event.preventDefault();
})
})

const allSelect = document.querySelectorAll('.numberOrderSelect select');
allSelect.forEach(function(select) {
    select.addEventListener('input', function(e) {
        select.parentElement.submit();
    });
});