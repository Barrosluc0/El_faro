<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h1>Contacto</h1>
    <form method="POST" action="index.php?page=contact_submit">
        <div class="field">
            <label class="label">Nombre</label>
            <input class="input" type="text" name="name" required>
        </div>
        <div class="field">
            <label class="label">Email</label>
            <input class="input" type="email" name="email" required>
        </div>
        <div class="field">
            <label class="label">Mensaje</label>
            <textarea class="textarea" name="message" required></textarea>
        </div>
        <button type="submit" class="button is-primary">Enviar</button>
    </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>