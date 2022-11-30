<?php require_once 'public/blocks/head.php'; ?>

<body>
    <?php require_once 'public/blocks/header.php'; ?>

    <div class="container main">
        <h1>Контакты</h1>
        <p>Напишите нам, если у вас есть вопросы</p>
        <form action="/contact" method="post" class="form-control">
            <!-- value="PHP" - для того, чтобы поля не обнулялись -->
            <input type="text" name="name" placeholder="Введите имя" value="<?=$_POST['name']?>"><br>
            <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
            <input type="text" name="age" placeholder="Введите возраст" value="<?=$_POST['age']?>"><br>
            <textarea name="message" placeholder="Введите само сообщение"><?=$_POST['message']?></textarea><br>
            <!-- Данные $data['message'] передаются при вызове страницы -->
            <div class="error"><?=$data['message']?></div>
            <button class="btn" id="send">Отправить</button>
        </form>
    </div>

    <?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>