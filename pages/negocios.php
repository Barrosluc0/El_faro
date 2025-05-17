<?php
require_once 'C:/xampp/htdocs/El_faro/app/views/partials/header.php';

try {
    $articles = Article::getBusinessNews();
} catch (Exception $e) {
    error_log("Error al cargar noticias de negocios: " . $e->getMessage());
    $articles = [];
}
?>

<main class="main-content">
    <div class="container">
        <?php if (empty($articles)): ?>
            <div class="notification is-warning">
                No hay noticias de negocios disponibles.
            </div>
        <?php endif; ?>

        <div class="columns">
            <div class="column is-8">
                <h1 class="title has-text-left">Negocios</h1>
                
                <div class="article-grid">
                    <?php foreach ($articles as $article): ?>
                    <div class="card article">
                        <div class="card-image">
                            <img 
                                src="<?= htmlspecialchars($article['image']) ?>" 
                                alt="<?= htmlspecialchars($article['title']) ?>"
                                loading="lazy"
                            >
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