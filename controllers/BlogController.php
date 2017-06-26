<?php

//Подключаем файл с моделью блога
include_once ROOT.'/models/Blog.php';

class BlogCintroller {
    
    public function actionIndex() {
        
        //ОТКОММЕНТИРОВАТЬ
        $blogList = array();
        $blogList = Blog::getBlogList();
        
        //подключаем файл с HTML-разметкой страницы
        require_once(ROOT.'/views/blog/index.php');
        
        return true;
    }
    
    public function actionView($id) {
        if ($id) {
            $newsItem = Blog::getNewsItemById($id);
            //подключаем файл с HTML-разметкой страницы
            require_once (ROOT.'/views/blog/view.php');
        }
        return true;
    }
}
