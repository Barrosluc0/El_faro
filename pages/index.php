<?php

require_once '../app/views/partials/header.php';
$articles = Article::getGeneralNews();
?>

<main class="main-content">
    <div class="container">
        <div class="columns">
            <!-- Columna principal (Noticias generales) -->
            <div class="column is-8">
                <h1 class="title has-text-left">Noticias Generales</h1>
                
                <!-- Grilla de noticias (3 artículos originales) -->
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

            <!-- Columna derecha (Artículos recientes - Original) -->
            <div class="column is-4">
                <h2 class="title is-4">Artículos Recientes</h2>
                <div class="box destacados">
                    <!-- Destacado 1 (Fútbol) -->
                    <div class="card mb-4" onclick="location.href='<?= BASE_URL ?>?page=deportes'">
                        <div class="card-image">
                            <img src="<?= BASE_URL ?>/img/futbol.jpg" alt="Fútbol">
                        </div>
                        <div class="card-content">
                            <h3 class="title is-5">Chile clasifica al Mundial 2026</h3>
                            <p>La Roja venció 2-1 a Argentina en un partido histórico jugado en Buenos Aires...</p>
                        </div>
                    </div>

                    <!-- Destacado 2 (Bitcoin) -->
                    <div class="card mb-4" onclick="location.href='<?= BASE_URL ?>?page=negocios'">
                        <div class="card-image">
                            <img src="<?= BASE_URL ?>/img/bitcoin.jpg" alt="Bitcoin">
                        </div>
                        <div class="card-content">
                            <h3 class="title is-5">Bitcoin supera los $100,000</h3>
                            <p>La criptomoneda alcanza nuevo récord impulsada por adopción institucional...</p>
                        </div>
                    </div>

                    <!-- Destacado 3 (Nadal) -->
                    <div class="card" onclick="location.href='<?= BASE_URL ?>?page=deportes'">
                        <div class="card-image">
                            <img src="<?= BASE_URL ?>/img/nadal.jpg" alt="Nadal">
                        </div>
                        <div class="card-content">
                            <h3 class="title is-5">Nadal anuncia su retiro</h3>
                            <p>El tenista español se despedirá del tenis profesional tras Roland Garros 2025...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once '../app/views/partials/footer.php'; ?>