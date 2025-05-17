<?php
require_once 'C:/xampp/htdocs/El_faro/app/views/partials/header.php';

try {
    $articles = Article::getSportsNews();
} catch (Exception $e) {
    // Manejo elegante de errores
    $error = "Error al cargar noticias deportivas";
    $articles = [];
}
?>

<main class="main-content">
    <div class="container">
        <?php if (!empty($error)): ?>
            <div class="notification is-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="columns">
            <div class="column is-8">
                <h1 class="title has-text-left">Deportes</h1>
                
                <div class="article-grid">
                    <?php foreach ($articles as $article): ?>
                    <div class="card article">
                        <div class="card-image">
                            <img src="<?= htmlspecialchars($article['image']) ?>" 
                                 alt="<?= htmlspecialchars($article['title']) ?>">
                        </div>
                        <div class="card-content">
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
require_once 'C:/xampp/htdocs/El_faro/app/views/partials/footer.php'; 
?>