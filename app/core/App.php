<?php
    class App {

        protected $controller = 'Home';
        protected $method = 'index';
        protected $params = [];

        // тут обрабатывается непосредственно адресная строка по маске
        // HOST/$controller/$method/$params
        public function __construct() {
            $url = $this->parseUrl(); //parseUrl() разбирает URL и возвращает ассоциативный массив (см ниже)
            // echo '<pre>';print_r($url);echo '</pre>'; // вывод массива
            // проверка наличия контроллера с именем /[$controller] в папке Controllers
            if(file_exists('app/controllers/' . ucfirst($url[0]) . '.php')) {
                //если есть, то сохраняем его в переменную $controller
                $this->controller = ucfirst($url[0]);
                // echo 'Контроллер: '.$this->controller.'<br>'; //вывод имени контроллера на экран
                unset($url[0]);
            }

            // если есть то вызываем найденный контроллер, если нет - контроллер по умолчанию 'User'
            require_once 'app/controllers/' . $this->controller . '.php';
            // создается объект на основе найденного контроллера и заносится в переменную $controller
            $this->controller = new $this->controller;


            // проверка наличия метода с именем /[$method] в классе $controller
            if(isset($url[1])) {
                if(method_exists($this->controller, $url[1])) {
                    //если есть, то сохраняем его в переменную $method
                    $this->method = $url[1];
                    // echo 'Метод: '.$this->method.'<br>'; //вывод имени метода на экран
                    unset($url[1]);
                }
            }
            //все что не контроллер и не метод заносятся в переменную $params
            $this->params = $url ? array_values($url) : [];

            // Проверка на несуществующую страницу
            // Если имя контроллера(объекта) "Home" и параметров больше 0
            // то создаем объект "Error404"
            if (count($this->params) != 0 and (get_class($this->controller) == 'Home' )) {
                $this->controller = 'Error404';
                require_once 'app/controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;
            }
            // echo '<pre>';echo 'Параметры: ';print_r($this->params);echo '</pre>';echo '<hr>'; // вывод массива параметров
            // Вызываем пользовательскую функцию (объект->метод) с массивом параметров
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

        // получение подготовленных данных из адресной строки
        public function parseUrl() {
            //проверяем наличие url
            //->удаляем справа слеш, если есть
            //->разбиваем строку с помощью разделителя /
            //->возвращаем массив
            if(isset($_GET['url'])) {
                return explode('/', filter_var(
                    rtrim($_GET['url'], '/'),
                    FILTER_SANITIZE_STRING
                ));
            }
        }
    }