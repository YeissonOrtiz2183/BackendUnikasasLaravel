const modal = document.querySelector('.modal');
const close = document.querySelectorAll('.close');
const button = document.getElementById('button');

const paswword = document.getElementById('password-one');
const password2 = document.getElementById('password-two');

button.addEventListener('click', () => {
    console.log('click');
    modal.classList.remove('hidden');
    modal.classList.add('visible');
    }
);

close.forEach(item => {
    item.addEventListener('click', () => {
        modal.classList.remove('visible');
        modal.classList.add('hidden');
    });
});

function validatePassword() {
    if (paswword.value == password2.value) {
        close[0].style.display = 'block';
        console.log('ok')
    } else {
        close[0].style.display = 'none';
    }
}
