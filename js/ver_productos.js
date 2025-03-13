document.addEventListener("DOMContentLoaded", function () {
    fetch("../http/Controllers/ver_productos.php")
    //fetch("http://localhost/TAGSIZE/http/controllers/ver_productos.php")

        .then(response => response.json())
        .then(data => {
            console.log("Datos recibidos del servidor:", data); // Depuración en consola

            const tabla = document.getElementById("tabla-productos");
            tabla.innerHTML = ""; // Limpiar tabla antes de agregar nuevos productos

            if (!Array.isArray(data) || data.length === 0) {
                console.error("⚠ No se recibieron productos o el JSON es inválido.");
                tabla.innerHTML = "<tr><td colspan='4'>No hay productos disponibles.</td></tr>";
                return;
            }

            data.forEach(producto => {
                // Verificar si los datos existen antes de agregarlos
                let id = producto.id_productos ?? "N/A";
                let nombre = producto.nombre_producto ?? "N/A";
                let precio = producto.precio_producto ?? "N/A";
                let stock = producto.stock_del_producto ?? "N/A";

                let fila = `
                    <tr>
                        <td>${id}</td>
                        <td>${nombre}</td>
                        <td>$${precio}</td>
                        <td>${stock}</td>
                    </tr>
                `;
                tabla.innerHTML += fila;
            });
        })
        .catch(error => console.error("Error cargando productos:", error));
});

