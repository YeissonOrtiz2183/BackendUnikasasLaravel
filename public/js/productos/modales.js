const publicarButton = document.querySelectorAll('#publicar-button');
const modal = document.querySelectorAll('.modal');
const publicarContent = document.querySelector('.publicar');


console.log(publicarButton);

for (let i = 0; i < publicarButton.length; i++) {
    publicarButton[i].addEventListener('click', () => {
        modal[0].classList.remove('hidden');
        modal[0].classList.add('visible');
    })
}
