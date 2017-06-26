<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';

class ProductController {
    
    public function actionView($productId) {
        
        //создаем массив категорий товаров
        $categories = array();
        $categories = Category::getCategoriesList();
        
        $product = Product::getProductById($productId);
        
        //подключаем файл с HTML-разметкой страницы
        require_once(ROOT.'/views/product/view.php');
        
        return true;
    }
}
