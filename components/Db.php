<?php

// Создаем подключение к базе данных

class Db {
    public static function getConnection() {
        //передаем свойсву $paramsPath путь к файлу с параметрами базы данных
        $paramsPath = ROOT.'/config/db_params.php';
        //подключаем файл с параметрами БД
        $params = include($paramsPath);
        
        //Строка с информацией о БД
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        
        //объект подключения к БД
        $db = new PDO($dsn, $params['user'], $params['password']);
        
        //запускаем SQL запрос на установку кодировки utf8
        $db->exec("set names utf8");
        
        return $db;
    }
    
}
