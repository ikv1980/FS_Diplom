<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/phpmailer/src/Exception.php';
    require 'phpmailer/phpmailer/src/PHPMailer.php';
    require 'phpmailer/phpmailer/src/SMTP.php';

    class SendMail {
        // данные авторизации
        private $login = 'twkostik@gmail.com';
        private $pwd = 'vzacfrgecmyudyic';

        // данные для письма
        private $name;
        private $email;
        private $age;
        private $message;

        // Установка данных
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
            else if(!(filter_var($this->email, FILTER_VALIDATE_EMAIL)))
                return "Некорректный email";
            else if(strlen($this->email) < 6)
                return "Email слишком короткий";    
            else if(!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
                return "Вы ввели не возраст";
            else if(strlen($this->message) < 5)
                return "Сообщение слишком короткое";
            else
                return "Верно";
        }

        public function sendEmail() {
            $mail = new PHPMailer();

            try {
                // настройки сервера
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Информация для разработчика
                $mail->isSMTP();
        
                // параметры для подключения
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth   = true;
                $mail->Username   = $this->login;
                $mail->Password   = $this->pwd;
                // Выбор протокола SSL(порт 465) или TLS(порт 587)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
                //$SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                //$mail->Port       = 587;
        
                // настройки сообщения (от кого и кому)
                $mail->CharSet = 'UTF-8';
                $mail->setFrom($this->login, 'Konstantin Ivanov');
                $mail->addAddress($this->login);
                $mail->addAddress($this->email);
        
                // содержание письма
                $mail->isHTML(true); // используем HTML
                $mail->Subject = 'Дипломное задание. itProger';
                $mail->Body = 
                'Гость с именем ' . $this->name . ' ('.(2022 - (int)$this->age).'г.р.) отправил текст: "' . $this->message . '"';
                $mail->AltBody = 'Просто альтернативный текст. PhpMailer';
        
                $mail->send();
                return 'Сообщение было успешно отправлено';
                }
            catch (Exception $e) {
                return "Не удалось отправить сообщение. Ошибка : {$mail->ErrorInfo}";
                }
        }
    }