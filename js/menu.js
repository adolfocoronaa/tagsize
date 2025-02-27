document.addEventListener("DOMContentLoaded", function() {
    const menu = `
        <nav>
            <a href="./home_page.html" onclick="mostrarSeccion('inicio')">Inicio</a>
            <a href="./catalogo.html" onclick="mostrarSeccion('catalogo')">Catálogo</a>
            <a href="./cuentas.html" onclick="mostrarSeccion('cuentas')">Cuentas</a>
            <a href="./contacto.html" onclick="mostrarSeccion('contacto')">Contacto</a>
            <a href="./welcome.html">Iniciar Sesión</a>
        </nav>
    `;
    document.getElementById("menu-container").innerHTML = menu;
});
