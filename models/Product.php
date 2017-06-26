<?php

class Product {
    //объявляем константу "количество товаров по умолчанию"
    const SHOW_BY_DEFAULT = 15;
    
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT) {
        
        $count = intval($count);
        //устанавливаем соединение с БД
        $db = Db::getConnection();
        //объявляем массив
        $productList = array();
        //выполняем запрос к БД
        $result = $db->query('SELECT id, name, price, image, '
                .'is_new, category_id FROM product '
                .'WHERE status = "1" '
                .'ORDER BY price DESC '
                .'LIMIT '.$count);
        //заполняем массив в цикле, пока существуют записи в таблице БД
        $i = 0;
        while($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $productList[$i]['category_id'] = $row['category_id'];
            $i++;
            
        }
        return $productList;
    }
    
    public static function getRecommendedProducts($count = self::SHOW_BY_DEFAULT) {
        
        $count = intval($count);
        //устанавливаем соединение с БД
        $db = Db::getConnection();
        //объявляем массив
        $productList = array();
        //выполняем запрос к БД
        $result = $db->query('SELECT id, name, price, image, '
                .'is_new, category_id FROM product '
                .'WHERE is_recommended = "1" '
                .'ORDER BY price DESC '
                .'LIMIT '.$count);
        //заполняем массив в цикле, пока существуют записи в таблице БД
        $i = 0;
        while($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $productList[$i]['category_id'] = $row['category_id'];
            $i++;
            
        }
        return $productList;
    }
    
    //получение страницы товаров определенной категории
    public static function getProductsListByCategory($categoryId = false, $page = 1) {
        if($categoryId) {
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            
            //устанавливаем соединение с БД
            $db = Db::getConnection();
            //объявляем массив
            $products = array();
            //выполняем запрос к БД
            $result = $db->query("SELECT id, name, price, image, is_new "
                    ."FROM product "
                    ."WHERE status = '1' "
                    ."AND category_id = $categoryId "
                    ."ORDER BY id ");
                    //."LIMIT ".self::SHOW_BY_DEFAULT
                    //." OFFSET ". $offset);
            //заполняем массив в цикле, пока существуют записи в таблице БД
            $i = 0;
            while($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $products[$i]['category_id'] = $categoryId;
                $i++;
            }
            return $products;
        }
    }
    
    //получение страницы одного товара
    public static function getProductById($id) {
        $id = intval($id);
        
        if ($id) {
            //устанавливаем соединение с БД
            $db = Db::getConnection();
            //выполняем запрос к БД
            $result = $db->query('SELECT * FROM product WHERE id = '.$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            //возвращаем масив требуемых данных о товаре
            return $result->fetch();
        }
    }
    
    public static function getTotalProductsInCategory($categoryId) {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT count(id) AS count FROM product '.
                'WHERE status ="1" AND category_id="'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        
        return $row['count'];
    }
    
    public static function getProductsByIds($idsArray) {
        $products = array();
        
        $db = Db::getConnection();
        //делаем из массива строку с айдишниками через зпт
        $idsString = implode(',', $idsArray);
//формируем строку запроса к БД
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);
//устанавливаем условие, чтобы запрос возвращал ассоциативный массив        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;
    }
    
    public static function getProductsList() {
        //устанавливаем связь с бд
        $db = Db::getConnection();
        //формируем запрос
        $result = $db->query('SELECT id, name, price, code FROM product ORDER BY id ASC');
        //объявляем массив товаров
        $productList = array();
        
        $i = 0;
        //пока в табдице есть данные, заполняем массив товаров
        while ($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['code'] = $row['code'];
            $i++;
        }
        
        return $productList;
    }
    
    public static function deleteProductById($id) {
        $db = Db::getConnection();
        
        $sql = "DELETE FROM product WHERE id=$id";
        
        $result = $db->prepare($sql);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    public static function createProduct($options) {
        //соединение с БД
        $db = Db::getConnection();
        //формируем запрос
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, '
                . 'brand, availability, description, '
                . 'is_new, is_recommended, status) '
                . 'VALUES '
                . '(:name, :code, :price, :category_id, '
                . ':brand, :availability, :description, '
                . ':is_new, :is_recommended, :status)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        
        return 0;
    }
    
    public static function updateProductById($id, $options) {
        //
        $db = Db::getConnection();
        
        $sql = 'UPDATE product '
                . 'SET '
                . 'name = :name, '
                . 'code = :code, '
                . 'price = :price, '
                . 'category_id = :category_id, '
                . 'brand = :brand, '
                . 'availability = :availability, '
                . 'description = :description, '
                . 'is_new = :is_new, '
                . 'is_recommended = :is_recommended, '
                . 'status = :status '
                . 'WHERE '
                . 'id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    public static function getImage($id) {
        //название изображения, когда нет изображения
        $noImage = 'no-image.jpg';
        
        //путь к папке с изображениями
        $path = '/upload/image/products/';
        
        //путь к изображению товара
        $pathToProductImage = $path. $id . '.jpg';
        
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            //если изображение есть, возвращаем путь к нему
            return $pathToProductImage;
        }
        return $path . $noImage;
    }
    
}
