<?php require_once 'public/blocks/head.php'; ?>

<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1><?=$data['title']?></h1>
        <p>Здесь вы можете зарегистрироваться</p>
        <?php require 'formreg.php' ?>       
    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>
</html>