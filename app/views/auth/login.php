<?php require_once('C:/xampp/htdocs/El_faro/app/views/partials/header.php'); ?>

<div class="container">
<form method="POST" action="index.php?page=login_submit" class="box">

        <div class="field">
            <label class="label">Email</label>
            <input class="input" type="email" name="email" required>
        </div>
        <div class="field">
            <label class="label">Contraseña</label>
            <input class="input" type="password" name="password" required>
        </div>
        <button type="submit" class="button is-primary">Iniciar sesión</button>
    </form>
</div>

<?php require_once('C:/xampp/htdocs/El_faro/app/views/partials/footer.php'); ?>