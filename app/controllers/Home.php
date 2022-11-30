<?php 
    class Home extends Controller {

        public function index() {
            // заполняем данные $head для страницы
            $data = [
                'title' => 'Главная страница',
                'description' => 'Главная страница сайта по сокращению ссылок',
                'css' => '<link rel="stylesheet" href="/public/css/form.css" charset="utf-8">',
                'message' => ''
            ];

            // Действия, если пользователь НЕ авторизован - выводим и обрабатываем форму регистрации 
            if($_COOKIE['login'] == '') {
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
            }

            // Действия, если пользователь авторизован - выводим и обрабатываем форму ссылок 
            if($_COOKIE['login'] != '') {
                $user = $this->model('Link');
                $data['links'] = $user->getLinks();
                // добавление ссылки
                if(isset($_POST['link'])) {
                    $user->setData($_POST['link'], $_POST['short']);
                    // Валидация данных
                    $isValid = $user->validForm();
                    if($isValid == "Верно") {
                        $user->addLink();
                        $data['links'] = $user->getLinks();
                    }
                    else 
                        $data['message'] = $isValid;
                }
                // удаление ссылки
                if (isset($_REQUEST['delete'])) {
                    $user->delLink($_POST['id']);
                } 
            }
            
            $this->view('home/index', $data); // Передача данных в представление
        }
    }