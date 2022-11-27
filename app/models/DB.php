<?php
// класс для подключения к БД (шаблон проектированияя Одиночка)
class DB {
    // 1. Создание статической переменной
    private static $_db = null;

    // 2. Метод на основе статической переменной
    public static function getinstence() {
        if(self::$_db == null) {
            // если переменная путсая - устанавливаем параметры подключение к БД
            self::$_db = new PDO('mysql:host=localhost;port=3306;dbname=ecommerce', 'root', '');
            // self::$_db = new PDO('mysql:host=91.219.194.11;port=3306;dbname=bhx20124_ecommerce', 'bhx20124_ecommerce', 'bhx20124_ecommerce');
        // возвращаем статичную переменную
        return self::$_db;
        }
    }

    // запрет создания объектов на основе данного класса (модификатор private)
    // доступ к конструктору запрещен
    private function __construct() {}
    // клонирование объекта зхапрещено
    private function __clone() {}
    // срабатывает при восстановлении данных
    // private function __wakeup() {}
}