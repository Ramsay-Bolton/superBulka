<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminBase
 *
 * @author user609
 */
abstract class AdminBase {
    public static function checkAdmin() {
        //проверяем авторизован ли пользователь
        $userId = User::checkLogged();
        //получаем инфу о нем
        $user = User::getUserById($userId);
        //проверяем админ ли он
        if($user['role'] === 'admin') {
            return true;
        }        
        //если нет завершаем работу
        die('Access denied');
    }
}
