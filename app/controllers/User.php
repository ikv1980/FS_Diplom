<?php
    class User extends Controller {

        // Регистрация пользователя
        public function reg() {
            // заполняем данные $head для страницы
            $data = [
                'title' => 'Регистрация пользователя',
                'description' => 'Страница регистрации пользователя',
                'css' => '<link rel="stylesheet" href="/public/css/form.css" charset="utf-8">',
                'message' => ''
            ];

            if(isset($_POST['name'])) {
                $user = $this->model('UserModel');
                $user->setData($_POST['email'], $_POST['name'], $_POST['pass']);
                // Валидация данных
                $isValid = $user->validForm();
                if($isValid == "Верно")
                    $user->addUser();
                else
                    $data['message'] = $isValid;
            }
            $this->view('user/reg', $data); // Передача данных в представление
        }

        // Личный кабинет пользователя
        public function dashboard() {
            if($_COOKIE['login'] == '') {
                header('Location: auth');
                exit();
            }

            $user = $this->model('UserModel');

            // заполняем данные $head для страницы
            $this->head = [
                'title' => 'Кабинет пользователя',
                'description' => 'Личный кабинет пользователя',
                'css' => '<link rel="stylesheet" href="/public/css/user.css" charset="utf-8">'
            ];

            // выход пользователя
            if(isset($_POST['exit_btn'])) {
                $user->logOut();
                exit();
            }

            // Получаем данные для отображения на странице. 
            $data = $user->getUser();
            $data += $this->head;
            $data['error'] = '';

            // Проверяем была ли нажата кнопка "Загрузить"
            if (isset($_REQUEST['image'])) {
                // Валидация данных
                $isValid = $user->validImage();
                if($isValid == "Верно") 
                    $user->addimage();
                else
                    $data['error'] = $isValid;
            }

            $this->view('user/dashboard', $data); // Передача данных в представление
        }

        // Авторизация пользователя
        public function auth() {
            // заполняем данные $head для страницы
            $this->head = [
                'title' => 'Авторизация пользователя',
                'description' => 'Страница авторизации пользователя',
                'css' => '<link rel="stylesheet" href="/public/css/form.css" charset="utf-8">',
                'message' => ''
            ];

            $data = $this->head;

            if(isset($_POST['name'])) {
                $user = $this->model('UserModel');
                $data['message'] = $user->auth($_POST['name'], $_POST['pass']);
            }

            $this->view('user/auth', $data);
        }
    }