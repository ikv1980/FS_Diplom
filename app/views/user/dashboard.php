<?php require_once 'public/blocks/head.php'; ?>

<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1><?=$data['title']?></h1>
        <div class="user-info">
            <p>Привет, <b><?= $data['name']?></b></p>
            <div>
                <img src="/public/img/avatar/<?=$data['image']?>" alt="Аватар пользователя">
            </div>
            <form action="/user/dashboard" method="post" enctype="multipart/form-data">
                <input type="file" name="filename" accept=".jpg,.jpeg,.png,.bmp,.webp">
                <button type="submit" name="image" class="btn dashboard">Загрузить</button>
            </form>
            <p class="error"><?=$data['error']?></p>
            <form action="/user/dashboard" method="post">
                <input type="hidden" name="exit_btn">
                <button type="submit" class="btn">Выйти</button>
            </form>
        </div>
    </div>      

    <?php require 'public/blocks/footer.php' ?>
</body>
</html>