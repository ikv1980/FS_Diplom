<form method="post" class="form-control">
    <input type="text" name="link" placeholder="Введите ссылку" value="<?=$_POST['link']?>" autocomplete="off"><br>
    <input type="text" name="short" placeholder="Введите сокращение" autocomplete="off"><br>
    <div class="error"><?=$data['message']?></div>
    <button type="submit" class="btn" id="send">Сократить</button>
</form>