<form method="post" class="form-control">
    <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>" autocomplete="off"><br>
    <input type="text" name="name" placeholder="Введите имя" value="<?=$_POST['name']?>" autocomplete="off"><br>
    <input type="password" name="pass" placeholder="Введите пароль" value="<?=$_POST['pass']?>" autocomplete="off"><br>
    <div class="error"><?=$data['message']?></div>
    <button class="btn" id="send">Зарегистрироваться</button>
</form>
<br><p class="comment">Есть аккаунт? Тогда вы можете <a href="/user/auth">авторизоваться</a></p>