const contractRow = document.querySelectorAll('[data-bs-target="#contractModal"]');
const inputContractId = document.getElementById('contractId');
contractRow.forEach(btn => {
    btn.addEventListener('click', function() {
        console.log('ok');
        let contractId = this.dataset.id;
        let stock = this.querySelector('li.stock').innerText;
        console.log(stock);
        stockSelect.innerHTML = "";
        for (let index = 1; index <= stock; index++) {
            let option = document.createElement('option')
            option.value = index;
            option.text = index;
            stockSelect.appendChild(option);
        }
        inputContractId.value = contractId;
        let date = new Date()
        contractDate.value = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
        modalTitle.innerText = 'Commande contract n°' + this.querySelectorAll('li')[0].innerText;
        modalBody.innerText = this.querySelectorAll('li')[7].innerText;
        pricePreview.value = this.querySelectorAll('li')[8].innerText;
        solde.value = this.querySelectorAll('li')[6].innerText;
        soldePreview.value = solde.value;
    })
}
)

stockSelect.addEventListener('change', function() {
    let solde = document.getElementById('solde').value;
    let soldeCount = solde - this.value;
    soldePreview.value = soldeCount;
})


/* $('tr[data-href]').on("dblclick", function() {
    document.location = $(this).data('href');
}); */


/* 
const deleteOrder = document.getElementById('deleteOrder')
deleteOrder.addEventListener('click', function(event) {
    event.preventDefault();
    let key = this.dataset.key
    window.location.href = window.location.href + '?delete=' + key;
}) */

const btnEditContract = document.getElementById('editContract')
btnEditContract.addEventListener('click', function(event) {
    let updateBtn = document.getElementById('updateContractBtn');
    let addBtn = document.getElementById('addContractBtn');
    let deleteBtn = document.getElementById('deleteContractBtn');
    updateBtn.classList.remove('d-none');
    addBtn.classList.add('d-none');
    deleteBtn.classList.remove('d-none');
    let contractId = document.getElementById('contractId').value;
    editContractTitle.innerText = 'Modifier le contrat';
    let contractIdUpdate = document.getElementById('contractIdUpdate');
    contractIdUpdate.value = contractId;
    modalContractId.value = contractId;
    fetch(`../controllers/contract_controller.php?editContract=${contractId}`)
        .then(response => response.json())
        .then(async data => {
            const json = await data
            setInputValue(json)
        })
})

function setInputValue(json) {
    let refContract = document.getElementById('refContract');
    let endDate = document.getElementById('endDate');
    let startDate = document.getElementById('startDate');
    let providerSelect = document.getElementById('providerSelect');
    let quantityContract = document.getElementById('quantityContract');
    let productName = document.getElementById('productName');
    let price = document.getElementById('price');
    refContract.value = json.reference_contract;
    startDate.value = json.date_start_contract;
    endDate.value = json.date_end_contract;
    providerSelect.value = json.id_provider;
    quantityContract.value = json.quantity_contract;
    productName.value = json.name_contract;
    price.value = json.price_contract;
}

const toggleAddContractBtn = document.getElementById('toggleAddContractBtn');
toggleAddContractBtn.addEventListener('click', function() {
    let updateBtn = document.getElementById('updateContractBtn');
    let addBtn = document.getElementById('addContractBtn');
    let deleteBtn = document.getElementById('deleteContractBtn');
    updateBtn.classList.add('d-none');
    addBtn.classList.remove('d-none');
    deleteBtn.classList.add('d-none');
    editContractTitle.innerText = 'Nouveau contrat';
})
