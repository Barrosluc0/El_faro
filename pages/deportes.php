<?php
// Incluye el header común
require_once 'C:/xampp/htdocs/El_faro/app/views/partials/header.php';

try {
    // Obtiene noticias deportivas
    $articles = Article::getSportsNews();
} catch (Exception $e) {
    // Mensaje de error si falla la carga
    $error = "Error al cargar noticias deportivas";
    $articles = [];
}
?>

<main class="main-content">
    <div class="container">
        <!-- Muestra error si existe -->
        <?php if (!empty($error)): ?>
            <div class="notification is-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="columns">
            <div class="column is-8">
                <h1 class="title has-text-left">Deportes</h1>
                
                <!-- Lista de artículos deportivos -->
                <div class="article-grid">
                    <?php foreach ($articles as $article): ?>
                    <div class="card article">
                        <div class="card-image">
                            <img src="<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                        </div>
                        <div class="card-content" onclick="mostrarNoticiaCompleta(
                            '<?= addslashes($article['title']) ?>', 
                            '<?= addslashes($article['category']) ?>', 
                            '<?= addslashes($article['content']) ?>', 
                            '<?= addslashes($article['image']) ?>'
                        )">
                            <h2 class="title is-4"><?= htmlspecialchars($article['title']) ?></h2>
                            <h4 class="subtitle is-6"><?= htmlspecialchars($article['category']) ?></h4>
                            <p><?= htmlspecialchars($article['excerpt']) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>         
        </div>
    </div>
</main>

<?php 
// Incluye footer común
require_once 'C:/xampp/htdocs/El_faro/app/views/partials/footer.php'; 
?>
