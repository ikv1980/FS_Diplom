<?php
    class ContactForm {
        private $name;
        private $email;
        private $age;
        private $message;

        public function setData($name, $email, $age, $message) {
            $this->name = $name;
            $this->email = $email;
            $this->age = $age;
            $this->message = $message;
        }

        // Метод проверки валидности ввода (простейшие проверки)
        public function validForm() {
            if(strlen($this->name) < 3)
                return "Имя слишком короткое. Не менее 3 символов";
            else if((filter_var($this->email, FILTER_VALIDATE_EMAIL) && strlen($this->email) > 5))
                return "Email слишком короткий";
            else if(!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
                return "Вы ввели не возраст";
            else if(strlen($this->message) < 5)
                return "Сообщение слишком короткое";
            else
                return "Верно";
        }

        // Метод для отправки сообщения на почту
        public function mail() {
            $to = "twkostik@gmail.com";
            $message = 'Имя: ' . $this->name . '. Возраст: ' . $this->age . '. Сообщение: ' . $this->message;

            $subject = "=?utf-8?B?".base64_encode("Сообщение с сайта")."?=";
            $headers = "From: $this->email\r\nReply-to: $this->email\r\nContent-type: text/html; charset=utf-8\r\n";
            $success = mail ($to, $subject, $message, $headers);

            $_POST['name'] = null;
            $_POST['email'] = null;
            $_POST['age'] = null;
            $_POST['message'] = null;

            if(!$success) return 'Сообщение не отправлено!';
            else return true;
        }
    }