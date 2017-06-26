<?php
// ОТКОММЕНТИРОВАТЬ
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';
include_once ROOT . '/components/Pagination.php';

class CatalogController {
    
    public function actionIndex() {
        
        //создаем массив категорий товаров
        $categories = array();
        $categories = Category::getCategoriesList();
        
        //создаем массив последних товаров
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(12);
        
        //подключаем файл с HTML-разметкой страницы
        require_once (ROOT.'/views/catalog/index.php');
        
        return true;
    }
    
    public function actionCategory($categoryId, $page=1) {
        //создаем массив категорий товаров
        $categories = array();
        $categories = Category::getCategoriesList();
        
        //создаем массив товаров по выбранной категории
        $categoryProducts = array();
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);
        
        $total = Product::getTotalProductsInCategory($categoryId);
        
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page');
        
        require_once (ROOT.'/views/catalog/category.php');
        
        return true;
    }
}
