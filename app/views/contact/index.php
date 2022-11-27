<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Свяжитесь с нами</title>
    <meta name="description" content="Свяжитесь с нами" />
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <!-- Дополнительный CSS -->
    <link rel="stylesheet" href="/public/css/form.css" type="text/css" charset="utf-8">
    <link type="Image/x-icon" href="/favicon.ico" rel="icon">
</head>
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