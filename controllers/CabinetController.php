<?php
class CabinetController {
    public function actionIndex() {
        
        $userId = User::checkLogged();
        
        echo $userId;
        
        $user = User::getUserById($userId);
        
        require_once(ROOT.'/views/cabinet/index.php');
        
        return true;
    }
    
    public function actionEdit() {
        //получаем айди юзера из СЕССИИ
        $userId = User::checkLogged();
        
        //получаем инфу о юзере из БД
        $user = User::getUserById($userId);
        
        $name = $user['name'];
        $password = $user['password'];
        
        $result = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $errors[] = false;
        
            if (!User::checkName($name)) {
                $errors[] = 'Wrong name';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6ти символов';
            }

            if ($errors == false) {
                $result = User::edit($userId, $name, $password);
            }
        }
        require_once(ROOT.'/views/cabinet/edit.php');
        
        return true;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

