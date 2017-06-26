<?php

class Category {

    public static function getCategoriesList() {
        //устанавливаем соединение с БД
        $db = Db::getConnection();
        //объявляем массив
        $categoryList = array();
        //выполняем запрос к БД
        $result = $db->query('SELECT id, name FROM category '
                . 'ORDER BY sort_order ASC');
        //инициализируем массив в цикле, пока существуют записи в таблице БД
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }

    public static function getCategoriesListAdmin() {
        //
        $db = Db::getConnection();
        $result = $db->query('SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC ');

        $categoriesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoriesList[$i]['id'] = $row['id'];
            $categoriesList[$i]['name'] = $row['name'];
            $categoriesList[$i]['sort_order'] = $row['sort_order'];
            $categoriesList[$i]['status'] = $row['status'];
            $i++;
        }

        return $categoriesList;
    }

    public static function getStatusText($status) {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    public static function deleteCategoryById($id) {
        $db = Db::getConnection();
        //формируем запрос к БД
        $sql = "DELETE FROM category WHERE id=:id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute(); // возвращаем результат выполнения запроса true или false
    }

    public static function createCategory($options) {
        //соединение с БД
        $db = Db::getConnection();
        //формируем запрос
        $sql = 'INSERT INTO category '
                . '(name, sort_order, status) '
                . 'VALUES '
                . '(:name, :sort_order, :status)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getCategoryById($id) {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM category WHERE id = '.$id);
            
             $result->setFetchMode(PDO::FETCH_ASSOC);
            //возвращаем масив требуемых данных о товаре
            return $result->fetch();
        }
    }
    
    public static function updateCategoryById($id, $options) {
        
        $db = Db::getConnection();
        
        $sql = 'UPDATE category SET '
                . 'name = :name, '
                . 'sort_order = :sort_order, '
                . 'status = :status '
                . 'WHERE id = :id';
        
        $result = $db->prepare($sql);
        
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }

}
