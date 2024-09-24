function mostrarMenu() {
    const menu = document.getElementById("navmenu");
    const contenedor = document.getElementById("fondo-oscuro");
    const body = document.getElementById("body");
    menu.classList.toggle("visible");
    contenedor.classList.toggle("fondo-oscuro");
    body.classList.toggle("overflow-y-h");
}

function ocultarMenu(){
    const menu = document.getElementById("navmenu");
    const contenedor = document.getElementById("fondo-oscuro");
    const body = document.getElementById("body");
    menu.classList.remove("visible");
    contenedor.classList.remove("fondo-oscuro");
    body.classList.toggle("overflow-y-h");
}

function dropdownMenu(){
    const dropdown = document.getElementById("dropdown-menu");
    dropdown.classList.toggle("expandir");
}

document.addEventListener('click', function(event){
    const dropdown = document.getElementById("dropdown-menu");
    if(!event.target.closest('.drop')){
        dropdown.classList.remove('expandir');
    }
})