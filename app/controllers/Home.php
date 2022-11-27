<?php 
    class Home extends Controller {
        private $head = null;


        public function index() {
            // заполняем данные $head для страницы
            $this->head = [
                'title' => 'Главная страница',
                'description' => 'Главная страница сайта по сокращению ссылок',
                'css' => '<link rel="stylesheet" href="/public/css/form.css" charset="utf-8">',
                'message' => ''
            ];

            $data = $this->head;

            if($_COOKIE['login'] == '') {
                // Если пользователь НЕ авторизован, то обрабатываем форму регистрации 
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
            // Если пользователь авторизован, то обрабатываем форму ссылок 
            else {
                $user = $this->model('Link');
                $data['links'] = $user->getLinks();
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
            }
            
            $this->view('home/index', $data); // Передача данных в представление
        }


        public function autorisation() {
            if($_COOKIE['login'] == '')
                return false;
            else return true;
        }
    }