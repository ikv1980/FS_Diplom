<?php
    require 'DB.php';

    class Link {
        private $name;
        private $link;
        private $short;

        private $_db = null;

        public function __construct() {
            $this->_db = DB::getInstence();
            $this->_db->exec("set names utf8mb4"); //Чтобы не было кракозябр (знаков вопроса)
        }

        // Alt + Insert (Сгенерировать код... )
        public function setData($link, $short) {
            $this->link = $link;
            $this->short = $short;
        }

        // Метод проверки валидности ввода (простейшие проверки)
        public function validForm() {
            if(!(filter_var($this->link, FILTER_VALIDATE_URL)))
                return "Некорректная ссылка";
            else if(strlen($this->short) < 3)
                return "Длинна сокращения не менее 2 символов";
            else
                return "Верно";
        }

        // Добавление ссылки в БД
        public function addLink() {
            $sql = 'INSERT INTO links(link, short, name) VALUES(:link, :short, :name)';
            $query = $this->_db->prepare($sql);
            $name = $_COOKIE['login'];
            $query->execute(['link' => $this->link, 'short' => $this->short, 'name' => $name]);
        }

        // Получение ссылок из БД
        public function getLinks() {
            $name = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `links` WHERE `name` = '$name'");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }











    }