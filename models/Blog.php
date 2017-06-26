<?php

class Blog {
    //получение одной статьи из блога по ее номеру в БД
    public static function getBlogItemById($id) {
        $id = intval($id);
        
        //если id не пуст
        if ($id) {
            //устанавливаем соединение с БД
            $db = Db::getConnection();
            //выполняем запрос к БД
            $result = $db->query('SELECT * FROM blog WHERE id ='.$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            //извлечение строки запроса
            $blogItem = $result->fetch();
            
            return $blogItem;
        }
    }
    
    public static function getBlogList() {
        //устанавливаем соединение с БД
        $db = Db::getConnection();
        //объявляем массив
        $blogList = array();
        //выполняем запрос к БД
        $result = $db->query('SELECT id, title, date, short_content '
                .'FROM blog '
                .'ORDER BY date DESC '
                .'LIMIT 3');
        //заполняем массив в цикле, пока существую записи в таблице БД
        $i = 0;
        while($row = $result->fetch()) {
            $blogList[$i]['id'] = $row['id'];
            $blogList[$i]['title'] = $row['title'];
            $blogList[$i]['date'] = $row['date'];
            $blogList[$i]['short_content'] = $row['short_content'];
            $i++;
        }
        return $blogList;
    }
}
