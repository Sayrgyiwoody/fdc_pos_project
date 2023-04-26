<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;


//Login , Register

Route::group(['middleware'=>'admin_auth'],function() {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {

    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');


    //admin
    Route::group(['middleware'=>'admin_auth', 'prefix'=>'admin'],function(){
        //Category
        Route::group(['prefix'=>'category'],function() {
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('list/create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('list/edit/{id}',[CategoryController::class,'editPage'])->name('category#editPage');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');
        });
        // Admin account
        Route::group(['prefix'=>'account'],function() {
            Route::get('changPasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');
            Route::get('informationPage',[AdminController::class,'informationPage'])->name('admin#informationPage');
            Route::get('updateAccountPage',[AdminController::class,'updateAccountPage'])->name('admin#updateAccountPage');
            Route::post('updateAccount/{id}',[AdminController::class,'updateAccount'])->name('admin#updateAccount');
            Route::get('admin/list',[AdminController::class,'adminList'])->name('admin#adminAccountList');
            Route::get('delete',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('change/userRole/{id}',[AdminController::class,'changeUserRole'])->name('admin#changeUserRole');
            Route::get('user/list',[AdminController::class,'userList'])->name('admin#userAccountList');
            Route::get('change/adminRole/{id}',[AdminController::class,'changeAdminRole'])->name('admin#changeAdminRole');
        });
        //product
        Route::group(['prefix'=>'product'],function() {
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('list/createPage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('list/view/{id}',[ProductController::class,'view'])->name('product#view');
            Route::get('list/editPage/{id}',[ProductController::class,'editPage'])->name('product#editPage');
            Route::post('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
        });

        //order
        Route::group(['prefix'=>'order'],function() {
            Route::get('list',[OrderController::class,'adminPage'])->name('admin#orderListPage');
            Route::get('list/status/sort',[OrderController::class,'statusSort'])->name('admin#statusSort');
            Route::get('list/status/change',[OrderController::class,'statusChange'])->name('admin#statusChange');
            Route::get('list/info/{order_code}',[OrderController::class,'info'])->name('admin#orderInfo');
            Route::get('delete',[OrderController::class,'adminDelete'])->name('admin#orderDelete');
            Route::get('delete/all',[OrderController::class,'adminDeleteAll'])->name('admin#orderDeleteAll');
        });

        Route::group(['prefix'=>'contact'],function() {
            Route::get('contactPage',[ContactController::class,'adminPage'])->name('admin#contactPage');
            Route::get('delete',[ContactController::class,'delete'])->name('admin$contactDelete');
            Route::get('contactPage/viewPage/{id}',[ContactController::class,'view'])->name('admin#contactView');
            Route::get('delete/all',[ContactController::class,'deleteAll'])->name('admin$contactDeleteAll');

        });
    });


    //user
    //home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function() {

        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('home/asc',[UserController::class,'homeAsc'])->name('user#homeAsc');
        Route::get('home/categoryFilter/{id}',[UserController::class,'categoryFilter'])->name('user#categoryFilter');
        Route::group(['prefix'=>'password'],function() {
            Route::get('changePage',[UserController::class,'passwordChangePage'])->name('user#passwordChangePage');
            Route::post('change',[UserController::class,'passwordChange'])->name('user#passwordChange');
        });

        Route::group(['prefix'=>'account'],function() {
            Route::get('informationPage',[UserController::class,'informationPage'])->name('user#informationPage');
            Route::get('updateAccountPage',[UserController::class,'updateAccountPage'])->name('user#updateAccountPage');
            Route::post('updateAccount/{id}',[UserController::class,'updateAccount'])->name('user#updateAccount');

        });

        //Ajax
        Route::group(['prefix'=>'ajax'],function() {
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('delete/cart/all',[AjaxController::class,'deleteAll'])->name('ajax#deleteAllCart');
            Route::get('delete/cart',[AjaxController::class,'delete'])->name('ajax#delete');
        });

        //product
        Route::group(['prefix'=>'product'],function() {
            Route::get('detail/{id}',[UserController::class,'productDetail'])->name('user#productDetail');
        });

        //Cart
        Route::group(['prefix'=>'cart'],function(){
            Route::get('list',[CartController::class,'cartList'])->name('cart#list');
        });

        //Order List
        Route::get('order/list',[OrderListController::class,'orderList'])->name('user#orderList');

        //Order
        Route::get('order/listPage',[OrderController::class,'listPage'])->name('user#orderListPage');
        Route::get('order/delete',[OrderController::class,'delete'])->name('user#orderDelete');
        Route::get('order/listPage/info/{order_code}',[OrderController::class,'orderInfo'])->name('user#orderInfo');

        //Contact
        Route::get('contactPage',[ContactController::class,'userPage'])->name('user#contactPage');
        Route::post('contact',[ContactController::class,'contact'])->name('user#contact');
    });
});

