function mostrarMenu() {
    const menu = document.getElementById("navmenu");
    const contenedor = document.getElementById("fondo-oscuro");
    const items = document.getElementById("navitems");
    menu.classList.toggle("visible");
    contenedor.classList.toggle("fondo-oscuro");
    items.classList.toggle("block");
}