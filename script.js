// Constantes de configuración y duración de animaciones
const MODAL_ANIMATION_DURATION = 300; // Duración de animación modal en ms
const DATE_UPDATE_INTERVAL = 1000; // Intervalo para actualizar fecha/hora en ms
const DARK_MODE_STORAGE_KEY = 'elFaro_dark_mode'; // Clave para guardar modo oscuro en localStorage

// Aplica el modo oscuro o claro según la preferencia guardada en localStorage
function aplicarPreferenciaModo() {
    const preferencia = localStorage.getItem(DARK_MODE_STORAGE_KEY);
    if (preferencia === 'dark') {
        document.body.classList.add('dark-mode');
        actualizarIconoDarkMode(true);
    } else {
        document.body.classList.remove('dark-mode');
        actualizarIconoDarkMode(false);
    }
}

// Actualiza el icono del botón modo noche (luna o sol) según el estado actual
function actualizarIconoDarkMode(isDark) {
    const icon = document.getElementById('dark-mode-icon');
    if (!icon) return;
    if (isDark) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
        icon.setAttribute('title', 'Desactivar Modo Noche');
    } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
        icon.setAttribute('title', 'Activar Modo Noche');
    }
}

// Cambia el modo oscuro/claró y guarda la preferencia en localStorage
function toggleDarkMode() {
    const body = document.body;
    const estaEnDark = body.classList.toggle('dark-mode');
    if (estaEnDark) {
        localStorage.setItem(DARK_MODE_STORAGE_KEY, 'dark');
    } else {
        localStorage.setItem(DARK_MODE_STORAGE_KEY, 'light');
    }
    actualizarIconoDarkMode(estaEnDark);
}

// Actualiza la fecha y hora en el elemento con id "fecha-hora" cada segundo
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

// Muestra un modal con noticia completa, aplicando sanitización para prevenir XSS
function mostrarNoticiaCompleta(titulo, categoria, contenido, imagenUrl) {
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
    document.body.style.overflow = 'hidden'; // Bloquear scroll de fondo
    modal.style.display = "flex"; // Mostrar modal centrado

    // Poner foco en botón cerrar para accesibilidad
    const closeBtn = modal.querySelector('.close-modal');
    if (closeBtn) closeBtn.focus();
}

// Cierra el modal con animación y restaura scroll
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

// Valida y agrega un nuevo artículo en el grid, sanitizando la entrada
function agregarArticulo() {
    const tituloInput = document.getElementById("titulo-articulo");
    const categoriaInput = document.getElementById("categoria-articulo");
    const contenidoInput = document.getElementById("contenido-articulo");
    const imagenInput = document.getElementById("imagen-articulo");

    // Validar campos obligatorios
    if (!tituloInput.value.trim() || !categoriaInput.value || !contenidoInput.value.trim()) {
        mostrarNotificacion('⚠️ Completa todos los campos obligatorios!', 'is-danger');
        return;
    }

    const sanitizeForHTML = (str) => {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    };

    // Sanitizar valores
    const titulo = sanitizeForHTML(tituloInput.value.trim());
    const categoria = sanitizeForHTML(categoriaInput.value);
    const contenido = sanitizeForHTML(contenidoInput.value.trim());
    const imagenUrl = imagenInput.value ? sanitizeForHTML(imagenInput.value.trim()) : '';

    const grid = document.querySelector(".article-grid");
    if (!grid) return;

    // Crear el artículo con estructura semántica
    const nuevoArticulo = document.createElement("article");
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

    // Al hacer click en el contenido, mostrar noticia completa en modal
    nuevoArticulo.querySelector('.card-content').addEventListener('click', () => {
        mostrarNoticiaCompleta(titulo, categoria, contenido, imagenUrl);
    });

    grid.prepend(nuevoArticulo);

    // Limpiar formulario y ocultarlo
    tituloInput.value = '';
    categoriaInput.value = '';
    contenidoInput.value = '';
    imagenInput.value = '';
    document.getElementById("form-agregar").classList.add("is-hidden");

    actualizarContador();
    mostrarNotificacion('Artículo agregado correctamente!', 'is-success');
}

// Actualiza el contador con la cantidad de artículos visibles
function actualizarContador() {
    const articles = document.querySelectorAll(".article-grid .article");
    const contador = document.getElementById("contador-articulos");

    if (contador) {
        contador.textContent = `Artículos mostrados: ${articles.length}`;
        contador.setAttribute('aria-live', 'polite'); // Mejora accesibilidad
    }
}

// Muestra una notificación tipo toast con mensaje y estilo dado
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

    // Oculta automáticamente después de 5 segundos con animación
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 500);
    }, 5000);
}

// Maneja el envío del formulario para agregar artículo
function manejarSubmitForm(event) {
    event.preventDefault();
    agregarArticulo();
}

// Código que se ejecuta al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    aplicarPreferenciaModo(); // Aplica modo oscuro/claro guardado
    actualizarFechaHora(); // Muestra fecha y hora inicial
    setInterval(actualizarFechaHora, DATE_UPDATE_INTERVAL); // Actualiza cada segundo

    // Asigna evento submit al formulario de agregar artículo
    const formAgregar = document.getElementById("form-agregar");
    if (formAgregar) {
        formAgregar.addEventListener('submit', manejarSubmitForm);
    }

    actualizarContador(); // Actualiza contador de artículos al inicio

    // Cierra modal al presionar tecla Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            cerrarModal();
        }
    });

    // Botón para cambiar modo oscuro/claro
    const darkModeBtn = document.getElementById('dark-mode-toggle');
    if (darkModeBtn) {
        darkModeBtn.addEventListener('click', toggleDarkMode);
    }
});

// Polyfill para forEach en NodeList en navegadores antiguos
if (!NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach;
}
