<?php

class Cart {
    
    public static function addProduct($id) {
        $id = intval($id);
        
        //массив для товаров в корзине
        $productsInCart = array();
        
        //если в корзине уже есть товары, они сохраняются в сессии
        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }
        //если товар есть в корзине, но был добавлен еще раз, увеличиваем количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            //добавляем новый товар в корзину
            $productsInCart[$id] = 1;
        }
        
        $_SESSION['products'] = $productsInCart;
//        echo '<pre>';        print_r($_SESSION['products']);        die();
        
        return self::countItem();
    }
    
    public static function countItem() {
        
        if (isset($_SESSION['products'])) {
            $count = 0;
                foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else { 
            return 0;
        }
    }
    
    public static function getProducts() {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }
    
    public static function getTotalPrice($products) {
        $productsInCart = self::getProducts();
        
        if ($productsInCart) {
            $total = 0;
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }
    
    public static function clear() {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }
    
    public static function deleteProduct($id) {
        //получаем массив товаров из сессии
        $productsInCart = self::getProducts();
        //удаляем элемент с переданным в метод айди
        unset($productsInCart[$id]);
        //заменяем массив товаров в сессии
        $_SESSION['products'] = $productsInCart;
    }
}
