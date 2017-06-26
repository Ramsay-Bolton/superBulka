<?php

// обработка запроса в адресной строке

//return array(
//    //метод actionView в классе ProductController
//    'product/([0-9]+)' => 'product/view/$1', 
//    //метод actionIndex в классе CatalogController
//    'catalog' => 'catalog/index',
//    //метод actionCategory в классе CatalogController
//    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
//    'category/([0-9]+)' => 'catalog/category/$1',
//    'cart/checkout' => 'cart/checkout', // actionCheckOut в CartController   
//    'cart/add/([0-9]+)' => 'cart/add/$1',
//    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
//    'cart' => 'cart/index',
//    //'cart/order' => 'cart/checkout',
//    'user/register' => 'user/register',
//    'cabinet/edit' => 'cabinet/edit',
//    'cabinet' => 'cabinet/index',
//    'user/login' => 'user/login',
//    'user/logout' => 'user/logout',
//    'contacts' => 'site/contact',
//    '' => 'site/index',
//);



return array(
    
    'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController
    
    'admin/product/create' => 'adminProduct/create', //actionCreate AdminProductController
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1', //actionUpdate в AdminProductController
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1', //actionDelete в AdminProductController
    'admin/product' => 'adminProduct/index', //actionIndex в AdminProductController
    
    'admin/category/create' => 'adminCategory/create', //actionCreate в AdminCategoryController
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1', //actionUpdate в AdminCategoryController
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1', //actionDelete в AdminCategoryController
    'admin/category' => 'adminCategory/index', //actionIndex в AdminCategoryController
     
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1', //actionView в AdminOrderController
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1', //actionUpdate в AdminOrderController
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1', //actionDelete в AdminOrderController
    'admin/order' => 'adminOrder/index', //actionIndex в AdminOrderController
    
    'admin' => 'admin/index', //actionIndex в AdminController
    
    'catalog' => 'catalog/index', // actionIndex в CatalogController
   
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController   
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    
    'cart/checkout' => 'cart/checkout', // actionCheckOut в CartController    
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController    
    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController    
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAdd в CartController
    'cart' => 'cart/index', // actionIndex в CartController

    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    
    'contacts' => 'site/contact',
    
    'about' => 'site/about', //actionAbot в SiteController
    
    '' => 'site/index', // actionIndex в SiteController
    
);