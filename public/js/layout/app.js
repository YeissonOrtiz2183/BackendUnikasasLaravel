//Manejo modales
const modal = document.querySelectorAll('.modal')
const logout = document.querySelector('.logout')
const notifications = document.querySelector('.notifications')
const calendar = document.querySelector('.calendar')
const help = document.querySelector('.help')

//Logica modales
let statusModal = false;
function calcModal(status, n)
{
    closeModals(status)
    if (status === false) {
        showModal(n)
        statusModal = true;
    } else if (status === true) {
        hideModal(n)
        statusModal = false;
    }

    return status;

    function closeModals(status) {
        if (status == true) {
            for (let x = 0; x < modal.length; x++) {
                hideModal(x)
            }
        }
    }

    function hideModal(n) {
        modal[n].classList.remove('visible')
        modal[n].classList.add('hidden')
    }

    function showModal(n) {
        modal[n].classList.remove('hidden')
        modal[n].classList.add('visible')
    }
}

logout.addEventListener('click', () => {
    calcModal(statusModal, 0)
})

notifications.addEventListener('click', () => {
    calcModal(statusModal, 1)
})

calendar.addEventListener('click', () => {
    calcModal(statusModal, 2)
})

help.addEventListener('click', () => {
    calcModal(statusModal, 3)
})
