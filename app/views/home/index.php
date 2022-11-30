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
                <div class="link">
                    <?php if(count($data['links']) > 0 ) {echo '<h2>Сокращенные ссылки</h2>';}?> 
                    <?php for($i = 0; $i < count($data['links']); $i++): ?>
                        <div>
                            <p><b>Длинная: </b><?=$data['links'][$i]['link']?></p>
                            <?php $host = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . "s/" . $data['links'][$i]['short']; ?>
                            <p><b>Короткая: </b><a href="<?=$host?>"><?=$host?></a></p>
                            <form method="post" class="form-control">
                                <input type='hidden' name='id' value='<?=$data['links'][$i]['id']?>' />
                                <button type="submit" class="btn" name="delete">Удалить  <i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    <?php endfor; ?>
                </div>
        <?php endif; ?>

    </div>
    <?php require_once 'public/blocks/footer.php'; ?>
</body>
</html>