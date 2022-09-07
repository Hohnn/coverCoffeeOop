const btnPlusRowCover = document.getElementById('addRowCover')
let countRowCover = 0
btnPlusRowCover.addEventListener('click', ()=>{
    countRowCover++
    const rowCover = document.getElementById('rowCover')
    const rowCoverClone = rowCover.cloneNode(true)
    let allInput = rowCoverClone.querySelectorAll('input')
    allInput.forEach(input => {
        input.value = ''
    })
    rowCoverClone.id = ''
    let yearInput = rowCoverClone.querySelector('[data-year]')
    yearInput.value = new Date().getFullYear() + countRowCover
    yearInput.removeAttribute('id')
    yearInput.name = 'year' + (new Date().getFullYear() + countRowCover)
    rowCoverClone.querySelector('[data-minus]').style.display = "block"
    console.log(yearInput.value);

    rowCover.parentNode.insertBefore(rowCoverClone, btnPlusRowCover.parentNode)
    listenMinusBtn(rowCoverClone)
})

let btnMinusRowCover = document.querySelectorAll('[data-minus]')
btnMinusRowCover[0].style.display = "none"

function listenMinusBtn(params) {
    btnMinusRowCover = document.querySelectorAll('[data-minus]')
    params.querySelector('[data-minus]').addEventListener('click', function () {
        countRowCover--
        this.parentNode.parentNode.remove()
    })
}

//add cover
const colCover = document.getElementById('colCover')
const btnAddContract = document.getElementById('btnAddContract')
const submitAddContract = document.getElementById('submitAddContract')
let toggleText = 0
btnAddContract.addEventListener('click', () => {
    colCover.classList.toggle('d-none')
    submitAddContract.classList.toggle('d-none')
    if (toggleText == 1) {
        btnAddContract.innerText = 'Ajout de couverture'
        toggleText = 0
        return false
    }
    btnAddContract.innerText = 'Annuler'
    toggleText = 1
})

