// ===== CONSTANTES Y CONFIGURACIÓN =====
const MODAL_ANIMATION_DURATION = 300; // ms
const DATE_UPDATE_INTERVAL = 1000; // 1 segundo

// ===== FUNCIONALIDADES PRINCIPALES =====

/**
 * Actualiza la fecha y hora en tiempo real
 * Usa Intl.DateTimeFormat para mejor soporte de internacionalización
 */
function actualizarFechaHora() {
    const ahora = new Date();
    const formatter = new Intl.DateTimeFormat('es-CL', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false,
        timeZone: 'America/Santiago'
    });
    
    const fechaHoraElement = document.getElementById("fecha-hora");
    if (fechaHoraElement) {
        fechaHoraElement.textContent = formatter.format(ahora);
    }
}

/**
 * Muestra una noticia completa en modal con validación de XSS
 * @param {string} titulo - Título de la noticia
 * @param {string} categoria - Categoría de la noticia
 * @param {string} contenido - Contenido completo
 * @param {string} imagenUrl - URL de la imagen
 */
function mostrarNoticiaCompleta(titulo, categoria, contenido, imagenUrl) {
    // Sanitización básica para prevenir XSS
    const sanitize = (str) => {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    };

    const modal = document.createElement("div");
    modal.className = "modal";
    modal.setAttribute('aria-modal', 'true');
    modal.setAttribute('role', 'dialog');
    
    modal.innerHTML = `
        <div class="modal-background" onclick="cerrarModal()"></div>
        <div class="modal-content">
            <button class="close-modal" onclick="cerrarModal()" aria-label="Cerrar modal">&times;</button>
            ${imagenUrl ? `<img src="${sanitize(imagenUrl)}" alt="${sanitize(titulo)}" class="modal-image" loading="lazy">` : ''}
            <h2 class="title is-3">${sanitize(titulo)}</h2>
            <h4 class="subtitle is-5">${sanitize(categoria)}</h4>
            <div class="content">${sanitize(contenido).replace(/\n/g, '<br>')}</div>
        </div>
    `;
    
    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden'; // Bloquear scroll
    modal.style.display = "block";
    
    // Focus para accesibilidad
    const closeBtn = modal.querySelector('.close-modal');
    if (closeBtn) closeBtn.focus();
}

/**
 * Cierra el modal con animación suave
 */
function cerrarModal() {
    const modal = document.querySelector(".modal");
    if (modal) {
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.remove();
            document.body.style.overflow = 'auto'; // Restaurar scroll
        }, MODAL_ANIMATION_DURATION);
    }
}

/**
 * Valida y agrega un nuevo artículo al grid
 * Con validación de campos y sanitización
 */
function agregarArticulo() {
    // Elementos del formulario
    const tituloInput = document.getElementById("titulo-articulo");
    const categoriaInput = document.getElementById("categoria-articulo");
    const contenidoInput = document.getElementById("contenido-articulo");
    const imagenInput = document.getElementById("imagen-articulo");
    
    // Validación
    if (!tituloInput.value.trim() || !categoriaInput.value || !contenidoInput.value.trim()) {
        mostrarNotificacion('⚠️ Completa todos los campos obligatorios!', 'is-danger');
        return;
    }

    // Sanitización
    const sanitizeForHTML = (str) => {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    };

    const titulo = sanitizeForHTML(tituloInput.value.trim());
    const categoria = sanitizeForHTML(categoriaInput.value);
    const contenido = sanitizeForHTML(contenidoInput.value.trim());
    const imagenUrl = imagenInput.value ? sanitizeForHTML(imagenInput.value.trim()) : '';

    // Crear nuevo artículo
    const grid = document.querySelector(".article-grid");
    if (!grid) return;

    const nuevoArticulo = document.createElement("article"); // Mejor semántica HTML
    nuevoArticulo.className = "card article";
    nuevoArticulo.innerHTML = `
        ${imagenUrl ? `
        <div class="card-image">
            <img src="${imagenUrl}" alt="${titulo}" loading="lazy">
        </div>` : ''}
        <div class="card-content">
            <h2 class="title is-4">${titulo}</h2>
            <h4 class="subtitle is-6">${categoria}</h4>
            <p>${contenido.substring(0, 100)}${contenido.length > 100 ? '...' : ''}</p>
        </div>
    `;

    // Evento click mejorado
    nuevoArticulo.querySelector('.card-content').addEventListener('click', () => {
        mostrarNoticiaCompleta(titulo, categoria, contenido, imagenUrl);
    });

    grid.prepend(nuevoArticulo);
    
    // Reset formulario
    tituloInput.value = '';
    categoriaInput.value = '';
    contenidoInput.value = '';
    imagenInput.value = '';
    
    document.getElementById("form-agregar").classList.add("is-hidden");
    actualizarContador();
    mostrarNotificacion('Artículo agregado correctamente!', 'is-success');
}

/**
 * Actualiza el contador de artículos
 * Con optimización de selección de elementos
 */
function actualizarContador() {
    const articles = document.querySelectorAll(".article-grid .article");
    const contador = document.getElementById("contador-articulos");
    
    if (contador) {
        contador.textContent = `Artículos mostrados: ${articles.length}`;
        contador.setAttribute('aria-live', 'polite');
    }
}

/**
 * Muestra una notificación estilo toast
 * @param {string} mensaje - Texto a mostrar
 * @param {string} tipo - Clase CSS para el estilo (ej: 'is-success')
 */
function mostrarNotificacion(mensaje, tipo = 'is-info') {
    const notification = document.createElement('div');
    notification.className = `notification ${tipo}`;
    notification.innerHTML = `
        <button class="delete" onclick="this.parentElement.remove()"></button>
        ${mensaje}
    `;
    
    notification.style.position = 'fixed';
    notification.style.bottom = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '1000';
    notification.style.transition = 'opacity 0.5s';
    
    document.body.appendChild(notification);
    
    // Auto-ocultar después de 5 segundos
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 500);
    }, 5000);
}

// ===== MANEJADORES DE EVENTOS =====

/**
 * Maneja el envío del formulario con validación
 */
function manejarSubmitForm(event) {
    event.preventDefault();
    agregarArticulo();
}

// ===== INICIALIZACIÓN =====
document.addEventListener('DOMContentLoaded', () => {
    // Configuración inicial de fecha/hora
    actualizarFechaHora();
    setInterval(actualizarFechaHora, DATE_UPDATE_INTERVAL);

    // Evento para toggle del formulario
    const toggleForm = document.getElementById("toggle-form");
    if (toggleForm) {
        toggleForm.addEventListener("click", () => {
            const form = document.getElementById("form-agregar");
            form.classList.toggle("is-hidden");
            if (!form.classList.contains('is-hidden')) {
                document.getElementById("titulo-articulo").focus();
            }
        });
    }

    // Evento para el formulario
    const formAgregar = document.getElementById("form-agregar");
    if (formAgregar) {
        formAgregar.addEventListener('submit', manejarSubmitForm);
    }

    // Contador inicial
    actualizarContador();

    // Mejorar accesibilidad del modal al presionar Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            cerrarModal();
        }
    });
});

// ===== POLYFILLS Y COMPATIBILIDAD =====
// Asegurar compatibilidad con navegadores antiguos
if (!NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach;
}