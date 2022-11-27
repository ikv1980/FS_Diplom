<form method="post" class="form-control">
    <input type="text" name="link" placeholder="Введите ссылку" value="<?=$_POST['link']?>" autocomplete="off"><br>
    <input type="text" name="short" placeholder="Введите сокращение" value="<?=$_POST['short']?>" autocomplete="off"><br>
    <div class="error"><?=$data['message']?></div>
    <button class="btn" id="send">Сократить</button>
</form>