<?php require_once 'public/blocks/head.php'; ?>

<body>
    <?php require_once 'public/blocks/header.php'; ?>

    <div class="container main">
        <h1>СОКРА.ТИМ</h1>
        <?php if($_COOKIE['login'] == ''): ?>
            <h3>Вам нужно сократить ссылку?<br>Прежде чем это сделать - зарегистрируйтесь на сайте!</h3>
            <?php require_once 'app/views/user/formreg.php'; ?>
        <?php else: ?>
            <h3>Вам нужно сократить ссылку?<br>Сейчас мы это сделаем!</h3>
            <?php require_once 'app/views/home/sokr.php'; ?>
        <?php endif; ?>
    </div>
    <?php echo print_r($data)?>
    <?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>