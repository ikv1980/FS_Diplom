<?php require_once 'public/blocks/head.php'; ?>

<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1><?=$data['title']?></h1>
        <p>Здесь вы можете авторизоваться на сайте</p>
        <form action="/user/auth" method="post" class="form-control">
            <input type="text" name="name" placeholder="Введите логин" value="<?=$_POST['name']?>" autocomplete="off"><br>
            <input type="password" name="pass" placeholder="Введите пароль"><br>
            <div class="error"><?=$data['message']?></div>
            <button class="btn" id="send">Готово</button>
        </form>
    </div>
    
    <?php require 'public/blocks/footer.php' ?>
</body>
</html>