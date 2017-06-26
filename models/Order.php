<?php

class Order {

    public static function save($userName, $userPhone, $userComment, $userId, $products) {
        $products = json_encode($products);
        
        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
                . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getOrderList() {
        //
        $db = Db::getConnection();
        $result = $db->query('SELECT id, user_name, user_phone, user_comment, '
                . 'user_id, date, products, status '
                . 'FROM product_order ORDER BY id DESC ');

        $orderList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['user_name'] = $row['user_name'];
            $orderList[$i]['user_phone'] = $row['user_phone'];
            $orderList[$i]['user_comment'] = $row['user_comment'];
            $orderList[$i]['user_id'] = $row['user_id'];
            $orderList[$i]['date'] = $row['date'];
            $orderList[$i]['products'] = $row['products'];
            $orderList[$i]['status'] = $row['status'];
            $i++;
        }

        return $orderList;
    }

    public static function getOrderById($id) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $result->execute();
        
        return $result->fetch();
    }
    
    public static function updateOrderById($id, $options) {
        $db = Db::getConnection();
        
        $sql = 'UPDATE product_order SET '
                . 'user_name = :userName, '
                . 'user_phone = :userPhone, '
                . 'user_comment = :userComment, '
                . 'date = :date, '
                . 'status = :status '
                . 'WHERE id = :id';
        
        $result = $db->prepare($sql);
        
        $result->bindParam(':userName', $options['userName'], PDO::PARAM_STR);
        $result->bindParam(':userPhone', $options['userPhone'], PDO::PARAM_STR);
        $result->bindParam(':userComment', $options['userComment'], PDO::PARAM_STR);
        $result->bindParam(':date', $options['date'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    public static function getStatusText($status) {
        
        switch ($status) {
            case '1' : return 'Новый заказ';                break;
            case '2' : return 'В обработке';                break;
            case '3' : return 'Доставляется';                break;
            case '4' : return 'Закрыт';                break;
        }
    }
    
    public static function deleteOrderById($id) {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM product_order WHERE id = :id';
        
        $result = $db->prepare($sql);
        
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    

}
