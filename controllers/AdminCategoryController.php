<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminCategoryController
 *
 * @author user609
 */
class AdminCategoryController extends AdminBase{
    
    public static function actionIndex() {
        //проверка на админа
        self::checkAdmin();
        //передача массива с данними о категориях из Бд
        $categoriesList = Category::getCategoriesListAdmin();
        //подключение вида
        require_once(ROOT.'/views/admin_category/index.php');
        return true;
    }
    
    public static function actionDelete($id) {
        self::checkAdmin();
        
        if (isset($_POST['submit'])) {
            Category::deleteCategoryById($id);
            
            header("Location: /admin/category/");
        }
        
        require_once(ROOT.'/views/admin_category/delete.php');
        return true;
    }
    
    public static function actionCreate() {
        self::checkAdmin();
        
        $categoriesList = Category::getCategoriesListAdmin();
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            
            $errors = false;
            
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поле';
            }
            
            if ($errors == false) {
                Category::createCategory($options);
                header("Location: /admin/category");
            }
        }
        
        require_once(ROOT.'/views/admin_category/create.php');
        return true;
    }
    
    public static function actionUpdate($id) {
        //проверка на админа
        self::checkAdmin();
        //получение списка категорий для выпадающго списка
        //$categoriesList = Category::getCategoriesListAdmin();
        //передаем форме массив с данными о товаре из БД
        $category = Category::getCategoryById($id);
        
        if (isset($_POST['submit'])) {
            //если форма отправлена, заполняем массив данных о товаре
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            
            if (Category::updateCategoryById($id, $options)) {
                header("Location: /admin/category");
            }
        }
        
        require_once(ROOT.'/views/admin_category/update.php');
        return true;
    }
}
