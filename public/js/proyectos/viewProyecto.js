const viewActivity = document.querySelectorAll(".view")
const createActivity = document.querySelectorAll('.add')
const suspenderProject = document.querySelector('.SuspenderProject')
const finishProject = document.querySelector('.FinishProject')
const modal = document.querySelectorAll('.modal')
const iconClose = document.querySelectorAll('.iconClose')
const editActivity = document.querySelectorAll('.edit')
const saveButton = document.querySelectorAll('.save')

for (let l = 0; l < saveButton.length; l++) {
    saveButton[l].addEventListener('click', () => {
        for (let t = 0; t < modal.length; t++) {
            modal[t].classList.remove('visible')
            modal[t].classList.add('hidden')
        }
    })
    
}
for( i=0; i < viewActivity.length; i++){
    viewActivity[i].addEventListener('click', () => {
        modal[0].classList.remove('hidden')
        modal[0].classList.add('visible')
    })
}
for (let z = 0; z < editActivity.length; z++) {
    editActivity[z].addEventListener('click', () => {
        modal[0].classList.remove('visible')
        modal[0].classList.add('hidden')
        modal[2].classList.remove('hidden')
        modal[2].classList.add('visible')
    })
}

for (let y = 0; y < createActivity.length; y++) {
    createActivity[y].addEventListener('click', () =>{
        console.log("Abrir modal crear actividad")
        modal[3].classList.remove('hidden')
        modal[3].classList.add('visible')
    })
}

suspenderProject.addEventListener('click', () => {
    modal[1].classList.remove('hidden')
    modal[1].classList.add('visible')
})

finishProject.addEventListener('click', () => {
    modal[4].classList.remove('hidden')
    modal[4].classList.add('visible')
})


for (let x = 0; x < modal.length; x++){
    for (let j = 0; j < iconClose.length; j++) {
        iconClose[j].addEventListener('click', () => {
            modal[x].classList.remove('visible')
            modal[x].classList.add('hidden')
        })
    }
}
