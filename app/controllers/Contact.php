<?php
    class Contact extends Controller {
        public function index() {
            // заполняем данные $head для страницы
            $data = [
                'title' => 'Свяжитесь с нами',
                'description' => 'Контактная информация',
                'css' => '<link rel="stylesheet" href="/public/css/form.css" charset="utf-8">',
                'message' => ''
            ];

            if(isset($_POST['name'])) {
                // Создаем объект на основе 'ContactForm' при помощи метода основного класса Controller.php
                $mail = $this->model('SendMail');

                // Во вновь созданном объекте вызываем метод setData(), для установки необходимых значений
                $mail->setData(
                    $_POST['name'],
                    $_POST['email'],
                    $_POST['age'],
                    $_POST['message']);

                // Вызываем метод validForm(), для проверки полученных данных
                $isValid = $mail->validForm();
                if($isValid == "Верно")
                    // если валидация прошла и вернется сообщение "Верно", то
                    // пытаемся отправить сообщение при помощи PhpMailer
                    // если не получится, то вернется сообщение "Сообщение было не отправлено"
                    $data['message'] = $mail->sendEmail();
                else
                    // если валидация НЕ прошла, то вернется сообщение о поле, где была ошибка
                    $data['message'] = $isValid;
            }
            // после всех методов, отправляем взад $data
            $this->view('contact/index', $data);
        }

        public function about() {
            // заполняем данные $head для страницы
            $data = [
                'title' => 'О компании',
                'description' => 'Информация о сервисе'
            ];
            $this->view('contact/about', $data);
        }
    }