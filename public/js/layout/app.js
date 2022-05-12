// Manejo de iframes
const projects = document.querySelector('.projects')
const events = document.querySelector('.events')
const auditoria = document.querySelector('.auditoria')
const products = document.querySelector('.products')
const users = document.querySelector('.users')
const cotizaciones = document.querySelector('.cotizaciones')

//Manejo modales
const modal = document.querySelectorAll('.modal')
const logout = document.querySelector('.logout')
const notifications = document.querySelector('.notifications')
const calendar = document.querySelector('.calendar')
const help = document.querySelector('.help')

//Logica iframes
projects.addEventListener('click', () => {
    console.log("Abrir modulo proyectos");
    document.getElementById("myFrame").src = "../../ModuloProyectos/inicioProyecto/moduloInicioProyecto.html";
})

events.addEventListener('click', () => {
    console.log("Abrir modulo eventos")
    document.getElementById("myFrame").src = "../../ModuloEventos/moduloEventosInicio.html"
})

auditoria.addEventListener('click', () => {
    console.log("Abrir modulo auditoria")
    document.getElementById("myFrame").src = "../../ModuloAuditoria/moduloAuditoriaInicio.html"
})

products.addEventListener('click', () =>{
    document.getElementById("myFrame").src = "../../moduloProductos/ProductosInicio.html"
})

users.addEventListener('click', () =>{
    document.getElementById("myFrame").src = "../../moduloUsuarios/1inicioUsuarios.html"
})

cotizaciones.addEventListener('click', () =>{
    document.getElementById("myFrame").src = "../../moduloCotizaciones/Consultar_Cotizacion/Consultar_Cotizacion.html"
})

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
