<header>
  <!-- Шапка сайта, состоящая из двух горизонтальных меню -->
    <div class="menu01"></div>

    <div class="menu02 sticky"></div>

    <div class="container top-menu">
        <div class="logo">
            <a href="/"><img src="/public/img/logo.svg" alt="Logo"></a>
            <span>Уберем все<br>лишнее из<br>ссылки!</span>
        </div>
        <div>
            <div class="firstmenu">
                <a href="/">Главная</a>
                <a href="/contact/about">О компании</a>
                <a href="/contact">Контакты</a>
            </div>
            <div class="secondmenu">
                <?php if($_COOKIE['login'] == ''): ?>
                    <a href="/user/auth"><button class="btn auth">Войти</button></a>
                    <a href="/user/reg"><button class="btn">Регистрация</button></a>
                <?php else: ?>
                    <a href="/user/dashboard"><button class="btn dashboard">Профиль</button></a>
                    <form action="/user/dashboard" method="post">
                        <input type="hidden" name="exit_btn">
                        <button type="submit" class="btn">Выйти</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>