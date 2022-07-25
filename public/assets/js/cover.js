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
    rowCoverClone.querySelector('input').value = new Date().getFullYear() + 1
    rowCoverClone.querySelector('input').id = ''
    rowCoverClone.querySelector('input').name = 'year' + (new Date().getFullYear() + 1)

    rowCover.parentNode.insertBefore(rowCoverClone, rowCover.nextSibling)
}
)
