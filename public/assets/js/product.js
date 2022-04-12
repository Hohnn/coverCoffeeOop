const searchMember = document.getElementById('searchMember');
searchMember.addEventListener('keyup', function(e) {
    let search = this.value;
    let allLi = document.querySelectorAll('.productList li');
    allLi.forEach(function(li) {
        let name = li.innerText;
        if (name.toLowerCase().indexOf(search.toLowerCase()) != -1) {
            li.classList.remove('d-none');
        } else {
            li.classList.add('d-none');
        }
    });
});

const productList = document.getElementById('productList');

function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
} 

const loeading = () => {
    let random = Math.floor(Math.random() * 1000 + 1000);
    setTimeout( () => {
        let loading = document.getElementById('loading');
        loading.classList.add('d-none');
        productList.classList.remove('d-none');
        
    }, random);
}

docReady(loeading);