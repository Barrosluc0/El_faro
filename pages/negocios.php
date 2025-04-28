<?php
require_once '../app/views/partials/header.php';
$articles = Article::getBusinessNews();
?>

<main class="main-content">
    <div class="container">
        <div class="columns">
            <div class="column is-8">
                <h1 class="title has-text-left">Negocios</h1>
                
                <div class="article-grid">
                    <?php foreach ($articles as $article): ?>
                    <div class="card article">
                        <div class="card-image">
                            <img src="<?= BASE_URL ?>/<?= $article['image'] ?>" alt="<?= $article['title'] ?>">
                        </div>
                        <div class="card-content" onclick="mostrarNoticiaCompleta(
                            '<?= addslashes($article['title']) ?>', 
                            '<?= $article['category'] ?>', 
                            '<?= addslashes($article['content']) ?>', 
                            '<?= BASE_URL ?>/<?= $article['image'] ?>'
                        )">
                            <h2 class="title is-4"><?= $article['title'] ?></h2>
                            <h4 class="subtitle is-6"><?= $article['category'] ?></h4>
                            <p><?= $article['excerpt'] ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Columna derecha (Artículos recientes) -->
            <div class="column is-4">
                <h2 class="title is-4">Artículos Recientes</h2>
                <div class="box destacados">
                    <div class="card mb-4" onclick="location.href='<?= BASE_URL ?>?page=deportes'">
                        <div class="card-image">
                            <img src="<?= BASE_URL ?>/img/nadal.jpg" alt="Nadal">
                        </div>
                        <div class="card-content">
                            <h3 class="title is-5">Nadal anuncia su retiro</h3>
                            <p>El tenista español se despedirá del tenis profesional tras Roland Garros 2025...</p>
                        </div>
                    </div>
                    <!-- Más destacados... -->
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once '../app/views/partials/footer.php'; ?>