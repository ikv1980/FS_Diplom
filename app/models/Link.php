<?php
    require 'DB.php';

    class Link {
        private $link;
        private $short;

        private $_db = null;

        public function __construct() {
            $this->_db = DB::getInstence();
            $this->_db->exec("set names utf8mb4"); //Чтобы не было кракозябр (знаков вопроса)
        }
        // устанвока значений
        public function setData($link, $short) {
            $this->link = $link;
            $this->short = $short;
        }

        // проверка link на наличие в БД
        public function status_short($short) {
            $result = $this->_db->query("SELECT * FROM `links` WHERE `short` = '$short'");
            $status = ($result->fetch(PDO::FETCH_ASSOC) > 0);
            return $status;
        }
        // Получение записи из БД
        public function search_link($short) {
            $result = $this->_db->query("SELECT * FROM `links` WHERE `short` = '$short'");
            // return $result->fetch(PDO::FETCH_ASSOC)['link'];
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        // Метод проверки валидности ввода (простейшие проверки)
        public function validForm() {
            if(!(filter_var($this->link, FILTER_VALIDATE_URL)))
                return "Некорректная ссылка";
            else if(strlen($this->short) < 3)
                return "Длинна сокращения не менее 3 символов";
            else if($this->status_short($this->short))
                return 'Сокращение <b>['.$this->short.']</b> уже существует';
            else
                return "Верно";
        }

        // Добавление ссылки в БД
        public function addLink() {
            $sql = 'INSERT INTO links(link, short, name) VALUES(:link, :short, :name)';
            $query = $this->_db->prepare($sql);
            $name = $_COOKIE['login'];
            
            $query->execute(['link' => $this->link, 'short' => $this->short, 'name' => $name]);
            $_POST['short'] = null;
            $_POST['link'] = null;
        }

        // Получение ссылок из БД
        public function getLinks() {
            $name = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `links` WHERE `name` = '$name'");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Удаление ссылок из БД
        public function delLink($id) {
            $name = $_COOKIE['login'];
            $this->_db->query("DELETE FROM `links` WHERE `id` = '$id' AND `name` = '$name'");
            header('Location: /'); // заголовок переадресации
        }









    }