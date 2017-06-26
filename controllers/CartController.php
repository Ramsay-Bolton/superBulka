<?php

class CartController {

//    public function actionAdd($id) {
//        die();
//        //добавляем товар в корзину
//        Cart::addProduct($id);
//        
//        //возвращаем пользователя на страницу
//        $referrer = $_SERVER['HTTP_REFERER'];
//        header("Location: $referrer");
//    }

    public function actionAddAjax($id) {
        echo Cart::addProduct($id);
        return true;
    }

    public function actionDelete($id) {
        Cart::deleteProduct($id);

        header("Location: /cart");
    }

    public function actionIndex() {
        $categories = array();
        $categories = Category::getCategoriesList();

        $productsInCart = false;

        $productsInCart = Cart::getProducts();

        if ($productsInCart) {

            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }
        require_once(ROOT . '/views/cart/index.php');

        return true;
    }

    public function actionCheckout() {
        //получаем данные из корзины
        $productsInCart = Cart::getProducts();

        //если товаров нет, отправляем пользователя на главную
        if ($productsInCart == false) {
            header("Location: /");
        }

        //получаем список категорий для левого меню
        $categories = Category::getCategoriesList();

        //находим общую стоимость
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);

        //количество товаров в корзине
        $totalQuantity = Cart::countItem();

        //поля для формы: имя, телефон, комментарий к заказу
        $userName = false;
        $userPhone = false;
        $userComment = false;
        
        //статус успешного выполнения заказа
        $result = false;

        //проверяем является ли пользователь гостем
        if (!User::isGuest()) {
            //если пользователь авторизован, получаем инфу из БД
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
        } else {
            //если юзер - гость, поля останутся пустыми
            $userId = null;
        }

        //обработка формы
        if (isset($_POST['submit'])) {
            //если форма отправлена, получаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            //массив с ошибками после валидации полей
            $errors = false;

            //валидация полей
            if (!User::checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }

            if ($errors == false) {
                //если ошибок нет,  сщхраняем заказ в базе данных
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);
                //очищаем корзину
                if ($result) {
                    Cart::clear();
                }
            }
        }
        require_once(ROOT . '/views/cart/checkout.php');

        return true;
    }

}
