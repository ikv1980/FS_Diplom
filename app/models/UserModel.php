<?php
    require 'DB.php';

    class UserModel {
        private $email;
        private $name;
        private $pass;
        private $image;

        private $_db = null;

        public function __construct() {
            $this->_db = DB::getInstence();
            $this->_db->exec("set names utf8mb4"); //Чтобы не было кракозябр (знаков вопроса)
        }

        public function setData($email, $name, $pass) {
            $this->email = $email;
            $this->name = $name;
            $this->pass = $pass;
            $this->image = 'user.webp'; // изображение по умолчанию
        }

        // проверка Email на валидность и длинну
        private function val_email($email) {
            return !(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 5);
        }
        // проверка Email на наличие в БД
        private function status_email($email) {
            $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
            $status = ($result->fetch(PDO::FETCH_ASSOC) > 0);
            return $status;
        }
        // проверка Login на наличие в БД
        private function status_name($name) {
            $result = $this->_db->query("SELECT * FROM `users` WHERE `name` = '$name'");
            $status = ($result->fetch(PDO::FETCH_ASSOC) > 0);
            return $status;
        }

        // Валидация данных
        public function validForm() {
            if($this->val_email($this->email))
                return "Некорректный Email";
            else if($this->status_email($this->email))
                return "Такой Email уже существует";
            else if(strlen($this->name) < 3)
                return "Логин слишком короткий. Не менее 3 символов";
            else if($this->status_name($this->name))
                return 'Пользователя с именем <b>['.$this->name.']</b> уже существует';
            else if(strlen($this->pass) < 3)
                return "Пароль не менее 3 символов";
            else
                return "Верно";
        }

        // Добавление пользователя в БД
        public function addUser() {
            $sql = 'INSERT INTO users(name, email, pass, image) VALUES(:name, :email, :pass, :image)';
            $query = $this->_db->prepare($sql);

            $pass = password_hash($this->pass, PASSWORD_DEFAULT);  // хеширование паролы. Можно использовать md5(), sha1()
            $query->execute(['name' => $this->name, 'email' => $this->email, 'pass' => $pass, 'image' => $this->image]);

            $this->setAuth($this->name);
        }

        // Получение данных о польозователе
        public function getUser() {
            $name = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `users` WHERE `name` = '$name'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        // Выход с сайта (удаление COOKIE)
        public function logOut() {
            setcookie('login', $this->name, time() - 3600, '/');
            unset($_COOKIE['login']);
            header('Location: /user/auth');
        }

        // Авторизация пользователя (установкаа COOKIE на 1 час )
        public function auth($name, $pass) {
            $result = $this->_db->query("SELECT * FROM `users` WHERE `name` = '$name'");
            $user = $result->fetch(PDO::FETCH_ASSOC);

            if($name == '')
                return 'Введите логин!';
            else if($user['name'] == '')
                return 'Пользователя с именем <b>['.$name.']</b> не существует';
            else if(password_verify($pass, $user['pass']))
                $this->setAuth($name);
            else
                return 'Пароли не совпадают';
        }

        // установкаа COOKIE на 1 час (60*60)
        public function setAuth($name) {
            setcookie('login', $name, time() + 3600, '/');
            header('Location: /user/dashboard'); // заголовок переадресации
        }

        // функция добавление изображения
        public function addimage() {
            if ($_FILES && $_FILES["filename"]["error"]==UPLOAD_ERR_OK) {
                $user = $_COOKIE['login']; // заносим в переменную авторизованного пользователя
                echo $user;
                echo gettype($user);

                // Блок изменения имени файла на уникальное
                $name = $_FILES["filename"]["name"]; // изначальное имя файла.расширение
                $name_without_ext = pathinfo($name, PATHINFO_FILENAME); // изначальное имя 
                $ext = pathinfo($name, PATHINFO_EXTENSION); // расширение
                $new_name = $name_without_ext . "_" . time() . "." . $ext; // новое имя файла.расширение
                echo '<br>'. $new_name;
                // копирование файла на сервер в папку
                $path = "public/img/avatar/" . $new_name;
                move_uploaded_file($_FILES["filename"]["tmp_name"], $path);

                // удаление существующего файла
                $result = $this->_db->query("SELECT `image` FROM `users` WHERE `name` = '$user'");
                $image = $result->fetch(PDO::FETCH_ASSOC);
                if ($image['image'] != 'user.webp') {
                    unlink("public/img/avatar/" . $image['image']);
                }

                // внесение информации о новом файле в БД
                $sql = "UPDATE users SET image=:image WHERE name=:name;";
                $query = $this->_db->prepare($sql);
                $query->execute(['image' => $new_name, 'name' => $user]);

                header('Location: /user/dashboard'); // заголовок переадресации
            } 
        }

        // Валидация изображения
        public function validImage() {
            if (empty($_FILES['filename']['type']))
                return "Вы не указали файла для загрузки";
            else if($_FILES['filename']['size'] / 1024 > 500)
                return "Размер файла не более 500КБт";
            else 
                return "Верно";
        }
    }