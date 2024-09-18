function mostrarMenu() {
    const menu = document.getElementById("navmenu");
    const contenedor = document.getElementById("fondo-oscuro");
    menu.classList.add("visible");
    contenedor.classList.add("fondo-oscuro");
}

function ocultarMenu(){
    const menu = document.getElementById("navmenu");
    const contenedor = document.getElementById("fondo-oscuro");
    menu.classList.remove("visible");
    contenedor.classList.remove("fondo-oscuro");
}