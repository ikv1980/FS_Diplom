<?php
    class Contact extends Controller {
        public function index(...$data) {
            $form = [];
            if(isset($_POST['name'])) {
                // Создаем объект на основе 'ContactForm' при помощи метода основного класса Controller.php
                $mail = $this->model('ContactForm');

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
                    // пытаемся отправить сообщение при помощи метода mail()
                    // если не получится, то вернется сообщение "Сообщение было не отправлено"
                    // иначе просто вернется True
                    $form['message'] = $mail->mail();
                else
                    // если валидация НЕ прошла, то вернется сообщение о поле, где была ошибка
                    $form['message'] = $isValid;
                    $data += $form;
            }
            // после всех методов, отправляем взад $data
            $this->view('contact/index', $data);
        }

        public function about(...$data) {
            $this->view('contact/about', $data);
        }
    }