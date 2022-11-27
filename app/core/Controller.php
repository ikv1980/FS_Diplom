<?php
    // родитель всех контроллеров
    class Controller {
        // функция возвращающая объект на основе переданного имени модели
        protected function model($model) {
            // подключение файла запрошенной модели
            require_once 'app/models/' . $model . '.php';
            // возвращаем объект модели
            return new $model();
        }
        // подключение представления с передачей данных
        protected function view($view, $data = []) {
            require_once 'app/views/' . $view . '.php';
        }
    }