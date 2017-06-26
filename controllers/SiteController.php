<?php

class SiteController {
    public function actionIndex() {
        
        //создаем массив категорий товаров
        $categories = array();
        $categories = Category::getCategoriesList();
        
        //создаем массив последних товаров
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts();
        
        //создаем массив последних товаров
        $recommendedProducts = array();
        $recommendedProducts = Product::getRecommendedProducts(4);
        
        //подключаем файл с HTML-разметкой страницы
        require_once(ROOT.'/views/site/index.php');
        
        return true;
    }
    public function actionContact() {
        $userEmail = '';
        $userText = '';
        $result = false;
        
        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            
            $errors = false;
            
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            
            if ($errors == false) {
                $adminEmail = 'chemyshevat@gmail.com';
                $message = "Текст: ($userText). От: ($userEmail)";
                $subject = 'Тема письма';
                $result = mail($mail, $subject, $message);
                $result = true;
            }
        }
        require_once(ROOT.'/views/site/contact.php');
        
        return true;
    }
    
    public static function actionAbout() {
        $categories = array();
        $categories = Category::getCategoriesList();
        
        require_once(ROOT . '/views/site/about.php');
    }
}
