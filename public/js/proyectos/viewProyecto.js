const createActivity = document.querySelectorAll('.add')
const suspenderProject = document.querySelector('.SuspenderProject')
const finishProject = document.querySelectorAll('.FinishProject')
const activateProject = document.querySelector('.activate')
const modal = document.querySelectorAll('.modal')
const iconClose = document.querySelectorAll('.save')
const saveButton = document.querySelectorAll('.save')
const viewSuspension = document.querySelector('.suspension')

for (let l = 0; l < saveButton.length; l++) {
    saveButton[l].addEventListener('click', () => {
        for (let t = 0; t < modal.length; t++) {
            modal[t].classList.remove('visible')
            modal[t].classList.add('hidden')
        }
    })

}

for (let y = 0; y < createActivity.length; y++) {
    createActivity[y].addEventListener('click', () =>{
        console.log("Abrir modal crear actividad")
        modal[5].classList.remove('hidden')
        modal[5].classList.add('visible')
        document.querySelector('#etapaId').value = createActivity[y].getAttribute("value");
    })
}

suspenderProject.addEventListener('click', () => {
    modal[4].classList.remove('hidden')
    modal[4].classList.add('visible')
})

for (let i = 0; i < finishProject.length; i++) {
    finishProject[i].addEventListener('click', () => {
        modal[6].classList.remove('hidden')
        modal[6].classList.add('visible')
    })
}

viewSuspension.addEventListener('click', () =>{
    modal[7].classList.remove('hidden')
    modal[7].classList.add('visible')
})

for (let x = 0; x < modal.length; x++){
    for (let j = 0; j < iconClose.length; j++) {
        iconClose[j].addEventListener('click', () => {
            modal[x].classList.remove('visible')
            modal[x].classList.add('hidden')
        })
    }
}

activateProject.addEventListener('click', () =>{
    console.info('Mostrar modal')
    modal[8].classList.remove('hidden')
    modal[8].classList.add('visible')
})




