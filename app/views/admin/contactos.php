<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h1>Mensajes Recibidos</h1>
    
    <?php if (empty($messages)): ?>
        <p>No hay mensajes.</p>
    <?php else: ?>
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?= htmlspecialchars($msg['nombre']) ?></td>
                    <td><?= htmlspecialchars($msg['correo']) ?></td>
                    <td><?= htmlspecialchars($msg['mensaje']) ?></td>
                    <td><?= $msg['fecha_envio'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>