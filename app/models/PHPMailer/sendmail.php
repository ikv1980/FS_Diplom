<?php
    namespace App; // Объявление пространства имен

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    const LOGIN = 'twkostik@gmail.com';
    const PWD = 'xehplhzkpdcctuqx';

    $mail = new PHPMailer();

    try {
        // настройки сервера
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Информация для разработчика
        $mail->isSMTP();

        // параметры для подключения
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth   = true;
        $mail->Username   = LOGIN;
        $mail->Password   = PWD; // пароль приложения
        // Выбор протокола SSL(порт 465) или TLS(порт 587)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        //$SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //$mail->Port       = 587;

        // настройки сообщения (от кого и кому)
        $mail->CharSet = 'UTF-8';
        $mail->setFrom(LOGIN, 'Konstantin Ivanov');
        $mail->addAddress(LOGIN);
        $mail->addAddress($email);

        // содержание письма
        $mail->isHTML(true); // используем HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = 'Просто альтернативный текст';

        $mail->send();
        echo 'Сообщение было успешно отправлено';
        }
    catch (Exception $e) {
        echo "Не удалось отправить сообщение. Ошибка : {$mail->ErrorInfo}";
        }