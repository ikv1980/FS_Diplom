<?php require_once 'public/blocks/head.php'; ?>

<body>
    <?php require_once 'public/blocks/header.php'; ?>

    <div class="container main">
        <h1><?=$data['title']?></h1>
        <p>Увы, но такой страницы не существует. </p>
        <img src="/public/img/404.webp" alt="404">
    </div>

    <?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>