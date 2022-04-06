<?php

//Auth for Admin DashBoard
Route::group(['prefix' => 'auth', 'namespace' => 'Api\Auth'], function (){

  Route::post('login', 'LoginController@login');

  Route::post('register', 'RegisterController@register');

  Route::group(['middleware' => 'auth:api'], function (){

      Route::post('logout', 'LogOutController');

      Route::get('me', 'MeController');

  });

  Route::post('forgetPassword', 'ForgetPasswordController@forgetPassword');

  Route::post('changePassword', 'ChangePasswordController@saveResetPassword');

});



Route::group(['prefix' => 'customer', 'namespace' => 'Api'], function (){
    
Route::get('category','ApiEcommerceController@category')->name('category');
Route::get('product','ApiEcommerceController@product')->name('product');
Route::get('brand','ApiEcommerceController@brand')->name('brand');

      Route::get('product/brand/{brand_id}','ApiEcommerceController@productBrand')->name('productBrand');
      Route::get('product/category/{category_id}','ApiEcommerceController@productCategory')->name('productCategory');
      Route::get('product/subCategory/{sub_category_id}','ApiEcommerceController@productSubCategory')->name('productSubCategory');
 
});




//e-commerce controller for api
Route::group(['prefix' => 'customer', 'namespace' => 'Api', 'middleware' => 'auth:api'], function (){


    //======user routes=======
    Route::post('user','ProfileController@get_user')->name('getcuser');
    Route::post('user/update','ProfileController@update_user')->name('update_user');
    Route::post('my_order','ProfileController@my_order')->name('my_order');
    Route::get('order_detail/{id}','ProfileController@order_detail')->name('order_detail');

    //Route::get('category','ApiEcommerceController@category')->name('category');

   // Route::get('brand','ApiEcommerceController@brand')->name('brand');

    //Route::get('product','ApiEcommerceController@product')->name('product');

    Route::get('details/{id}','ApiEcommerceController@details')->name('details');

   // Route::get('product/category/{category_id}','ApiEcommerceController@productCategory')->name('productCategory');

 //   Route::get('product/subCategory/{sub_category_id}','ApiEcommerceController@productSubCategory')->name('productSubCategory');

   // Route::get('product/brand/{brand_id}','ApiEcommerceController@productBrand')->name('productBrand');

    /*add to cart routes start*/
    Route::post('cart/add_to_cart','ApiEcommerceController@addToCart')->name('addToCart');
    Route::post('cart/get_cart','ApiEcommerceController@getCart')->name('getCart');
    Route::post('update_quantity','ApiEcommerceController@update_quantity');
    Route::post('cart/remove_cart','ApiEcommerceController@removeCart')->name('removeCart');
    /*add to cart routes end*/

    //complain routes
    Route::post('complain','ApiEcommerceController@userComplain')->name('complain');

    //stock and inventory search start
    Route::get('stock_category','ApiEcommerceController@StockCategory')->name('stock_category');
    Route::get('stock_brand','ApiEcommerceController@StockBrand')->name('stock_brand');
    Route::get('stock_model/{brand_id}','ApiEcommerceController@StockModel')->name('stock_model');

    Route::post('stock_inventory','ApiEcommerceController@StockInventory')->name('stock_inventory');
    //stock and inventory search end

    /*service information route start*/
    Route::get('serviceType','ApiEcommerceController@serviceType')->name('serviceType');

    Route::post('service','ApiEcommerceController@service')->name('service');
    /*service information route end*/

    /*get a quote start*/
    Route::post('quote','ApiEcommerceController@quote')->name('quote');
    /*get a quote end*/

    /*pick up request start*/
    Route::post('pick_up','ApiEcommerceController@pickUp')->name('pick_up');
    Route::post('servicePickUp','ApiEcommerceController@servicePickUp')->name('servicePickUp');
    /*pick up request end*/

    /*drop up request routes start*/
    Route::post('drop_up','ApiEcommerceController@dropUp')->name('drop_up');
    Route::post('serviceDropUp','ApiEcommerceController@serviceDropUp')->name('serviceDropUp');
    /*drop up request routes end*/

    /*service payment start*/
    Route::post('payment','ApiEcommerceController@payment')->name('payment');
    /*service payment end*/

    /*coupon routes start*/
    Route::post('coupons','ApiEcommerceController@coupons')->name('coupons');
    Route::post('getCoupon','ApiEcommerceController@getCoupon')->name('getCoupon');
    Route::get('my_coupon/{id}','ApiEcommerceController@get_my_coupon')->name('get_my_coupon');
    /*coupon routes end*/

    /*order routes start*/
    Route::post('order','ApiEcommerceController@order')->name('order');
    /*order routes end*/

});

Route::group(['prefix' => 'product', 'namespace' => 'Api'], function (){
   
     Route::post('search','WarrantyController@search_product')->name('search.product');
});


Route::group(['prefix' => 'product', 'namespace' => 'Api', 'middleware' => 'auth:api'], function (){

    //======warranties routes=======
    Route::post('add_warranty','WarrantyController@add_warranty')->name('product.warranty');
    Route::post('get_warranty','WarrantyController@get_warranty')->name('product.warranty');

     //Route::post('search','WarrantyController@search_product')->name('search.product');
    

});
Route::group(['prefix' => 'address', 'namespace' => 'Api', 'middleware' => 'auth:api'], function (){

    Route::get('get_address','WarrantyController@get_address')->name('office.address');
});


Route::group(['prefix' => 'message', 'namespace' => 'Api', 'middleware' => 'auth:api'], function (){

    //======warranties routes=======
    Route::post('send_message','MessageController@send_message')->name('send_message');
    Route::get('get_message/{user_id}','MessageController@get_message')->name('get_message');
   

});
