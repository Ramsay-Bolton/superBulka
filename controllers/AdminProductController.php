<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminProductController
 *
 * @author user609
 */
class AdminProductController extends AdminBase {

    //
    public static function actionIndex() {
        //
        self::checkAdmin();
        //
        $productsList = Product::getProductsList();

        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    public static function actionDelete($id) {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Product::deleteProductById($id);

            header("Location: /admin/product");
        }

        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }

    public static function actionCreate() {
        self::checkAdmin();

        $categoriesList = Category::getCategoriesListAdmin();

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поле';
            }

            if ($errors == false) {
                $id = Product::createProduct($options);

                if ($id) {
                    //если через форму было загружено изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        //если загружалось, переносим его в нужную папаку, даем новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . "/upload/image/products/{$id}.jpg");
                    }
                }
                header("Location: /admin/product");
            }
        }

        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    public static function actionUpdate($id) {
        //проверка на админа
        self::checkAdmin();
        //получение списка категорий для выпадающго списка
        $categoriesList = Category::getCategoriesListAdmin();
        //передаем форме массив с данными о товаре из БД
        $product = Product::getProductById($id);

        if (isset($_POST['submit'])) {
            //если форма отправлена, заполняем массив данных о товаре
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            // Сохраняем изменения
            if (Product::updateProductById($id, $options)) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                   move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/image/products/{$id}.jpg");
                }
            }
            header("Location: /admin/product");
        }

        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }

}
