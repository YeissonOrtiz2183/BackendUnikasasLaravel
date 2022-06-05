const botonDespublicar= document.querySelector("[id='#bot1']");
const modalDespublicar=document.querySelector('.modalDespublicar')
const botonDespublicarDosAcep=document.querySelector('.despublicarDosAceptar');
const modalDosDespublicar=document.querySelector('.modalDosDespublicar');
const botonPublicar=document.querySelector("[id='carrito']");
const modalPublicar=document.querySelector(".modalPublicar");
const botonDosPublicar=document.querySelector('publicarDosAceptar')


for (let l= 0; l < botonDespublicar.length; l++) {
    botonDespublicar[l].addEventListener('click', function(){
        modalDespublicar.classList.add('modal--show')
    })

}

botonDespublicarDosAcep.addEventListener('click', function(){
    modalDespublicar.classList.add('.modalDespublicarDos--show')
})

//Modal Publicar
for(let j=0; j < botonPublicar.length;l++){
    botonDespublicar[j].addEventListener('click', function(){
        modalPublicar.classList.add('.modalPublicar--show');
    })
}

botonDosPublicar.addEventListener('click', function(){
    modalPublicar.classList.add('.modalPublicarDos--show')
})




