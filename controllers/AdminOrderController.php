<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminOrderContoller
 *
 * @author user609
 */
class AdminOrderController extends AdminBase {
    public static function actionIndex() {
        self::checkAdmin();
        
        $ordersList = Order::getOrderList();
        
        require_once(ROOT . '/views/admin_order/index.php');
        
        return true;
    }
    
    public static function actionDelete($id) {
        
        self::checkAdmin();
        
        if (isset($_POST['submit'])) {
            Order::deleteOrderById($id);
            
            header("Location: /admin/order");
        }
        
        require_once(ROOT . '/views/admin_order/delete.php');
        
        return true;
    }
    
    public static function actionUpdate($id) {
        
        self::checkAdmin();
        
        $order = Order::getOrderById($id);
//        
//        var_dump($order); die;
        
        if(isset($_POST['submit'])) {
            $options['userName'] = $_POST['userName'];
            $options['userPhone'] = $_POST['userPhone'];
            $options['userComment'] = $_POST['userComment'];
            $options['date'] = $_POST['date'];
            $options['status'] = $_POST['status'];
            
            if (Order::updateOrderById($id, $options)) {
                header("Location: /admin/order");
            }
        }
        require_once(ROOT . '/views/admin_order/update.php');
        
        return true;
    }
    
    public static function actionView($id){
        self::checkAdmin();
        
        $order = Order::getOrderById($id);
        //получаем массив с товарами (айди и количество)
        $productsQuantity = json_decode($order['products'], true);
        //массив с айди товаров в заказе
        $productsIds = array_keys($productsQuantity);
        //
        $products = Product::getProductsByIds($productsIds);
        
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }
}
