<?php
require_once 'C:/xampp/htdocs/El_faro/app/views/partials/header.php';
$articles = Article::getSportsNews();
?>

<main class="main-content">
    <div class="container">
        <div class="columns">
            <div class="column is-8">
                <h1 class="title has-text-left">Deportes</h1>
                
                <div class="article-grid">
                    <?php foreach ($articles as $article): ?>
                    <div class="card article">
                        <div class="card-image">
                            <img src="./<?= $article['image'] ?>" alt="<?= $article['title'] ?>">
                        </div>
                        <div class="card-content" onclick="mostrarNoticiaCompleta(
                            '<?= addslashes($article['title']) ?>', 
                            '<?= $article['category'] ?>', 
                            '<?= addslashes($article['content']) ?>', 
                            './<?= $article['image'] ?>'
                        )">
                            <h2 class="title is-4"><?= $article['title'] ?></h2>
                            <h4 class="subtitle is-6"><?= $article['category'] ?></h4>
                            <p><?= $article['excerpt'] ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>         
        </div>
    </div>
</main>

<?php require_once 'C:/xampp/htdocs/El_faro/app/views/partials/footer.php'; ?>