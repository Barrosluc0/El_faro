// ===== FUNCIONALIDADES PRINCIPALES =====

// 1. Actualizar fecha y hora con segundos
function actualizarFechaHora() {
    const ahora = new Date();
    const opciones = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    };
    const fechaHora = ahora.toLocaleDateString('es-CL', opciones);
    document.getElementById("fecha-hora").textContent = fechaHora;
}

// 2. Mostrar noticia completa con imagen
function mostrarNoticiaCompleta(titulo, categoria, contenido, imagenUrl) {
    const modal = document.createElement("div");
    modal.className = "modal";
    modal.innerHTML = `
        <div class="modal-background" onclick="cerrarModal()"></div>
        <div class="modal-content">
            <span class="close-modal" onclick="cerrarModal()">&times;</span>
            ${imagenUrl ? `<img src="${imagenUrl}" alt="${titulo}" class="modal-image">` : ''}
            <h2 class="title is-3">${titulo}</h2>
            <h4 class="subtitle is-5">${categoria}</h4>
            <div class="content">${contenido}</div>
        </div>
    `;
    document.body.appendChild(modal);
    modal.style.display = "block";
}

function cerrarModal() {
    const modal = document.querySelector(".modal");
    if (modal) modal.remove();
}

// 3. Agregar artículo con imagen
function agregarArticulo() {
    const titulo = document.getElementById("titulo-articulo").value;
    const categoria = document.getElementById("categoria-articulo").value;
    const contenido = document.getElementById("contenido-articulo").value;
    const imagenUrl = document.getElementById("imagen-articulo").value;

    if (titulo && categoria && contenido) {
        const grid = document.querySelector(".article-grid");
        const nuevoArticulo = document.createElement("div");
        nuevoArticulo.className = "card article";
        nuevoArticulo.innerHTML = `
            ${imagenUrl ? `<div class="card-image"><img src="${imagenUrl}" alt="${titulo}"></div>` : ''}
            <div class="card-content" onclick="mostrarNoticiaCompleta('${titulo.replace(/'/g, "\\'")}', '${categoria.replace(/'/g, "\\'")}', '${contenido.replace(/'/g, "\\'")}', '${imagenUrl ? imagenUrl.replace(/'/g, "\\'") : ''}')">
                <h2 class="title is-4">${titulo}</h2>
                <h4 class="subtitle is-6">${categoria}</h4>
                <p>${contenido.substring(0, 100)}...</p>
            </div>
        `;
        grid.prepend(nuevoArticulo);
        actualizarContador();
        document.getElementById("titulo-articulo").value = "";
        document.getElementById("categoria-articulo").value = "";
        document.getElementById("imagen-articulo").value = "";
        document.getElementById("contenido-articulo").value = "";
        document.getElementById("form-agregar").classList.add("is-hidden");
    } else {
        alert("⚠️ Completa todos los campos obligatorios!");
    }
}

// 4. Contador de artículos
function actualizarContador() {
    const total = document.querySelectorAll(".article-grid .article").length;
    document.getElementById("contador-articulos").textContent = `Contador de artículos: ${total}`;
}

// ===== INICIALIZACIÓN =====
document.addEventListener('DOMContentLoaded', () => {
    actualizarFechaHora();
    setInterval(actualizarFechaHora, 1000);

    const toggleForm = document.getElementById("toggle-form");
    if (toggleForm) {
        toggleForm.addEventListener("click", () => {
            document.getElementById("form-agregar").classList.toggle("is-hidden");
        });
    }

    actualizarContador();
});