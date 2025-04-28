<?php require_once '../partials/header.php'; ?>

<div class="container">
    <form method="POST" action="<?= BASE_URL ?>/app/controllers/AuthController.php?action=register" class="box">
        <div class="field">
            <label class="label">Nombre</label>
            <input class="input" type="text" name="name" required>
        </div>
        <div class="field">
            <label class="label">Email</label>
            <input class="input" type="email" name="email" required>
        </div>
        <div class="field">
            <label class="label">Contraseña</label>
            <input class="input" type="password" name="password" required>
        </div>
        <button type="submit" class="button is-primary">Registrarse</button>
    </form>
</div>

<?php require_once '../partials/footer.php'; ?>