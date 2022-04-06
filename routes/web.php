<?php

use Illuminate\Support\Facades\Route;


//eastern tech main e-commerce routes
Route::get('/', 'EcommerceController@index')->name('ecommerce');
Route::post('search/product', 'EcommerceController@search_realtime_product')->name('search.realtime.product');

Route::get('/details/{id}', 'EcommerceController@details')->name('details');
Route::get('/privacy_policy', 'EcommerceController@privacy_policy')->name('privacy.policy');

Route::get('category-product/{id}', 'EcommerceController@product_category')->name('customrCategory');                                 
Route::get('sub-category-product/{id}', 'EcommerceController@product_subcategory')->name('subcategory.front');
Route::get('brand-product/{id}', 'EcommerceController@product_brand')->name('brands');
Route::post('category_loaddata', 'EcommerceController@loadMoreDataCat')->name('cat.load.data');
Route::post('brand_loaddata', 'EcommerceController@loadMoreDataBrand')->name('brands.load.data');
Route::post('subcat_loaddata', 'EcommerceController@loadMoreDataSubCat')->name('subcat.load.data');
Route::post('product/search', 'EcommerceController@search_product')->name('product.search');

// customer order process
Route::get('checkout', 'OrderController@checkout_form')->name('checkout');
Route::post('checkout/store', 'OrderController@checkout')->name('checkout.store');
Route::get('checkout/confirm', 'OrderController@order_confirm')->name('checkout.confirm');

//Customer routes;
Route::group(['prefix'=>'customer'],function(){
     Route::get('/login', 'CustomerController@login')->name('customer.login');
     Route::POST('/register', 'CustomerController@register')->name('customer.register');
     Route::POST('/login/submit', 'CustomerController@login_submit')->name('customer.login.submit');
     Route::POST('/logout', 'CustomerController@logout')->name('customer.logout');
});

// cart routes
Route::POST('add/cart', 'CartController@add_to_cart')->name('add.to.cart');
Route::get('cart/item/load', 'CartController@get_all_cart_data')->name('cart.item.load');
Route::get('cart/item', 'CartController@cart_item')->name('cart.item');
Route::POST('cart/updare', 'CartController@cart_update')->name('cart.update');
Route::POST('cart/remove', 'CartController@cart_remove')->name('cart.remove');

Auth::routes();

//Admin Routes
Route::group(['middleware' => ['auth','admin']], function (){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/change/password', 'HomeController@show_password_form')->name('change.password.user');
    Route::post('/change/password/{id}', 'HomeController@password_update')->name('password.store.user');
    Route::get('/change/user/profile', 'HomeController@show_profile_form')->name('change.user.profile');
    Route::post('/update-user/profile/{id}', 'HomeController@update')->name('user.profile.update');
    Route::post('/user/delete/user', 'HomeController@user_image_profile')->name('user.delete_image_profile');
    Route::get('/create-user', 'HomeController@create_user')->name('create.user');
    Route::post('/user-store', 'HomeController@user_store')->name('user.store');

     Route::get('/user/show', 'HomeController@all_user')->name('user.show');
     Route::get('user/getData','HomeController@getData')->name('user.getData');
     Route::get('user/edit/{id}','HomeController@edit_form')->name('user.edit');
     Route::post('user/edit_info/{id}','HomeController@user_edit')->name('user.info.update');
    Route::post('user/delete_info','HomeController@destroy')->name('user.destroy');
    Route::post('user/delete_image','HomeController@delete_image')->name('user.delete_image');


    //Category Routes
    Route::get('category', 'CategoryController@index')->name('category');
    Route::get('category/create', 'CategoryController@create')->name('category.create');
    Route::get('category/getData','CategoryController@getData')->name('category.getData');
    Route::post('category/store', 'CategoryController@store')->name('category.store');
    Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('category/update/{id}', 'CategoryController@update')->name('category.update');
    Route::get('category/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');


     //Branch office Routes
    Route::get('branch_office', 'BranchOfficeController@index')->name('branch_office');
    Route::get('branch_office/create', 'BranchOfficeController@create')->name('branch_office.create');
    Route::get('branch_office/getData','BranchOfficeController@getData')->name('branch_office.getData');
    Route::post('branch_office/store', 'BranchOfficeController@store')->name('branch_office.store');
    Route::get('branch_office/edit/{id}', 'BranchOfficeController@edit')->name('branch_office.edit');
    Route::post('branch_office/update/{id}', 'BranchOfficeController@update')->name('branch_office.update');
    Route::get('branch_office/destroy/{id}', 'BranchOfficeController@destroy')->name('branch_office.destroy');

    //Logo Routes
  
    Route::get('/show_logo', 'LogoController@show_logo')->name('logo.show_logo');
    Route::post('logo/update', 'LogoController@update')->name('logo.update');

     //Banner Routes
  
    Route::get('/show_banner', 'BannerController@show_logo')->name('banner.show_banner');
    Route::post('banner/update', 'BannerController@update')->name('banner.update');


    //Sub-category routes
    Route::get('subCategory', 'SubCategoryController@index')->name('subCategory');
    Route::get('subCategory/create', 'SubCategoryController@create')->name('subCategory.create');
    Route::get('subCategory/getData','SubCategoryController@getData')->name('subCategory.getData');
    Route::post('subCategory/store', 'SubCategoryController@store')->name('subCategory.store');
    Route::get('subCategory/edit/{id}', 'SubCategoryController@edit')->name('subCategory.edit');
    Route::post('subCategory/update/{id}', 'SubCategoryController@update')->name('subCategory.update');
    Route::get('subCategory/destroy/{id}', 'SubCategoryController@destroy')->name('subCategory.destroy');


    //Brand
    Route::get('brand', 'BrandController@index')->name('brand');
    Route::get('brand/create', 'BrandController@create')->name('brand.create');
    Route::get('brand/getData','BrandController@getData')->name('brand.getData');
    Route::post('brand/store', 'BrandController@store')->name('brand.store');
    Route::get('brand/edit/{id}', 'BrandController@edit')->name('brand.edit');
    Route::post('brand/update/{id}', 'BrandController@update')->name('brand.update');
    Route::get('brand/destroy/{id}', 'BrandController@destroy')->name('brand.destroy');
    Route::get('brand/delete_image/{id}', 'BrandController@delete_image')->name('brand.delete_image');

    // Sliders

    Route::get('slider', 'SliderController@index')->name('sliders');
    Route::get('slider/getData','SliderController@getData')->name('sliders.getData');
    Route::get('slider/edit/{id}', 'SliderController@edit')->name('sliders.edit');
    Route::post('slider/update/{id}','SliderController@update')->name('sliders.update');
    Route::get('slider/destroy/{id}', 'SliderController@destroy')->name('sliders.destroy');
    Route::get('slider/delete', 'SliderController@delete_image')->name('slider.delete_image');
    Route::POST('slider/status', 'SliderController@change')->name('sliders.status');


    //products
    Route::get('product', 'ProductController@index')->name('product');
    Route::get('product/create', 'ProductController@create')->name('product.create');
    Route::get('product/view/{id}', 'ProductController@view')->name('product.view');
    Route::get('product/getData','ProductController@getData')->name('product.getData');
    Route::post('product/store', 'ProductController@store')->name('product.store');
    Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
    Route::get('product/delete_image/{id}', 'ProductController@delete_image')->name('product.delete_image');
    Route::get('product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
    Route::get('product/status_change/{id}', 'ProductController@status_change')->name('product.status_change');
    Route::get('product/publish_change/{id}', 'ProductController@publish_change')->name('product.publish_change');
    Route::get('product/feature_change/{id}', 'ProductController@feature_change')->name('product.feature_change');
    Route::get('product/get_sub_category', 'ProductController@get_sub_category')->name('product.get_sub_category');

    // Manage Customer order

    Route::get('/order/show', 'OrderController@show_all_order')->name('order.show');
    Route::get('/getorder', 'OrderController@getData')->name('order.getData');
    Route::post('/change/order/status', 'OrderController@change_status')->name('chanage.order.status');
    Route::get('/order/details/{id}', 'OrderController@order_detail')->name('order.details');
    Route::get('/order/invoice/{id}', 'OrderController@invoice')->name('order.invoice');


    /*multiple product Image upload start*/
    Route::get('product/image/{id}', 'ProductController@image')->name('image');
    Route::get('product/image_create/{id}', 'ProductController@image_create')->name('image_create');
    Route::get('product/image_getData', 'ProductController@image_getData')->name('image_getData');
    Route::post('product/image_upload/{id}', 'ProductController@image_upload')->name('image_upload');
    Route::get('product/image_edit/{id}', 'ProductController@image_edit')->name('image_edit');
    Route::post('product/image_update/{id}', 'ProductController@image_update')->name('image_update');
    Route::post('product/edit_delete_image/{id}', 'ProductController@edit_delete_image')->name('edit_delete_image');
    Route::post('product/image_delete', 'ProductController@image_delete')->name('image_delete');
    Route::get('product/image_destroy/{id}', 'ProductController@image_destroy')->name('image_destroy');
    /*multiple product Image upload end*/

    //Service types
    Route::get('service_type', 'ServiceTypeController@index')->name('service_type');
    Route::get('service_type/create', 'ServiceTypeController@create')->name('service_type.create');
    Route::get('service_type/getData','ServiceTypeController@getData')->name('service_type.getData');
    Route::post('service_type/store', 'ServiceTypeController@store')->name('service_type.store');
    Route::get('service_type/edit/{id}', 'ServiceTypeController@edit')->name('service_type.edit');
    Route::post('service_type/update/{id}', 'ServiceTypeController@update')->name('service_type.update');
    Route::get('service_type/destroy/{id}', 'ServiceTypeController@destroy')->name('service_type.destroy');

    //service
    Route::get('service', 'ServiceController@index')->name('service');
    Route::get('service/create', 'ServiceController@create')->name('service.create');
    Route::get('service/getData','ServiceController@getData')->name('service.getData');
    Route::post('service/store', 'ServiceController@store')->name('service.store');
    Route::get('service/edit/{id}', 'ServiceController@edit')->name('service.edit');
    Route::post('service/update/{id}', 'ServiceController@update')->name('service.update');
    Route::get('service/destroy/{id}', 'ServiceController@destroy')->name('service.destroy');

    //rider routes
    Route::get('rider', 'RiderController@index')->name('rider');
    Route::get('rider/create', 'RiderController@create')->name('rider.create');
    Route::get('rider/getData','RiderController@getData')->name('rider.getData');
    Route::post('rider/store', 'RiderController@store')->name('rider.store');
    Route::get('rider/change_password/{id}', 'RiderController@changePassword')->name('rider.changePassword');
    Route::post('rider/update_password/{id}', 'RiderController@updatePassword')->name('rider.updatePassword');
    Route::get('rider/edit/{id}', 'RiderController@edit')->name('rider.edit');
    Route::post('rider/update/{id}', 'RiderController@update')->name('rider.update');
    Route::post('rider/delete_image/{id}', 'RiderController@delete_image')->name('rider.delete_image');
    Route::get('rider/destroy/{id}', 'RiderController@destroy')->name('rider.destroy');

    //executive Routes
    Route::get('executive', 'ExecutiveController@index')->name('executive');
    Route::get('executive/create', 'ExecutiveController@create')->name('executive.create');
    Route::get('executive/getData','ExecutiveController@getData')->name('executive.getData');
    Route::post('executive/store', 'ExecutiveController@store')->name('executive.store');
    Route::get('executive/edit/{id}', 'ExecutiveController@edit')->name('executive.edit');
    Route::post('executive/update/{id}', 'ExecutiveController@update')->name('executive.update');
    Route::get('executive/destroy/{id}', 'ExecutiveController@destroy')->name('executive.destroy');
    Route::get('executive/active_change/{id}', 'ExecutiveController@active_change')->name('executive.active_change');

    //member routes
    Route::get('member', 'MemberController@index')->name('member');
    Route::get('member/create', 'MemberController@create')->name('member.create');
    Route::get('member/getData','MemberController@getData')->name('member.getData');
    Route::post('member/store', 'MemberController@store')->name('member.store');
    Route::get('member/edit/{id}', 'MemberController@edit')->name('member.edit');
    Route::post('member/update/{id}', 'MemberController@update')->name('member.update');
    Route::get('member/destroy/{id}', 'MemberController@destroy')->name('member.destroy');
    Route::get('member/active_change/{id}', 'MemberController@active_change')->name('member.active_change');

    //customer routes
    Route::get('customers', 'CustomerController@index')->name('customers');
    Route::get('customers/create', 'CustomerController@create')->name('customers.create');
    Route::get('customers/getData','CustomerController@getData')->name('customers.getData');
    Route::post('customers/store', 'CustomerController@store')->name('customers.store');
    Route::get('customers/edit/{id}', 'CustomerController@edit')->name('customers.edit');
    Route::post('customers/update/{id}', 'CustomerController@update')->name('customers.update');
    Route::get('customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');
    Route::get('customers/active_change/{id}', 'CustomerController@active_change')->name('customers.active_change');


    //Stock and inventory

    /*stock category start*/
    Route::get('stock_category', 'StockCategoryController@index')->name('stock_category');
    Route::get('stock_category/create', 'StockCategoryController@create')->name('stock_category.create');
    Route::get('stock_category/getData','StockCategoryController@getData')->name('stock_category.getData');
    Route::post('stock_category/store', 'StockCategoryController@store')->name('stock_category.store');
    Route::get('stock_category/edit/{id}', 'StockCategoryController@edit')->name('stock_category.edit');
    Route::post('stock_category/update/{id}', 'StockCategoryController@update')->name('stock_category.update');
    Route::get('stock_category/destroy/{id}', 'StockCategoryController@destroy')->name('stock_category.destroy');
    /*stock category end*/

    /*stock brand start*/
    Route::get('stock_brand', 'StockBrandController@index')->name('stock_brand');
    Route::get('stock_brand/create', 'StockBrandController@create')->name('stock_brand.create');
    Route::get('stock_brand/getData','StockBrandController@getData')->name('stock_brand.getData');
    Route::post('stock_brand/store', 'StockBrandController@store')->name('stock_brand.store');
    Route::get('stock_brand/edit/{id}', 'StockBrandController@edit')->name('stock_brand.edit');
    Route::post('stock_brand/update/{id}', 'StockBrandController@update')->name('stock_brand.update');
    Route::get('stock_brand/destroy/{id}', 'StockBrandController@destroy')->name('stock_brand.destroy');
    /*stock brand end*/


    /*stock Model start*/
    Route::get('stock_model', 'StockModelController@index')->name('stock_model');
    Route::get('stock_model/create', 'StockModelController@create')->name('stock_model.create');
    Route::get('stock_model/getData','StockModelController@getData')->name('stock_model.getData');
    Route::post('stock_model/store', 'StockModelController@store')->name('stock_model.store');
    Route::get('stock_model/edit/{id}', 'StockModelController@edit')->name('stock_model.edit');
    Route::post('stock_model/update/{id}', 'StockModelController@update')->name('stock_model.update');
    Route::get('stock_model/destroy/{id}', 'StockModelController@destroy')->name('stock_model.destroy');
    /*stock Model end*/

    /*Message routes*/
     Route::get('load_user_message', 'MessageController@datatable')->name('admin.load_user_message');
    Route::get('user_message', 'MessageController@get_message')->name('admin.get_user_message');
    Route::get('reply_message/{id}', 'MessageController@reply_message')->name('admin.reply_message');
    Route::post('submit_reply', 'MessageController@reply_submit')->name('admin.reply_submit');
    /*stock Model end*/


    /*stock start*/
    Route::get('stock', 'StockController@index')->name('stock');
    Route::get('stock/create', 'StockController@create')->name('stock.create');
    Route::post('stock/get_model', 'StockController@get_model')->name('stock.get_model');
    Route::get('stock/getData','StockController@getData')->name('stock.getData');
    Route::post('stock/store', 'StockController@store')->name('stock.store');
    Route::get('stock/edit/{id}', 'StockController@edit')->name('stock.edit');
    Route::post('stock/update/{id}', 'StockController@update')->name('stock.update');
    Route::get('stock/destroy/{id}', 'StockController@destroy')->name('stock.destroy');
    /*stock end*/

    /*customer services order routes start*/
    Route::get('quote','QuoteController@index')->name('quote');
    Route::get('quote/getData','QuoteController@getData')->name('quote.getData');
    Route::get('quote/get_coupons/{coupon_id}','QuoteController@get_coupons')->name('quote.get_coupons');
    Route::get('quote/status_change/{id}', 'QuoteController@status_change')->name('quote.status_change');
    Route::get('quote/destroy/{id}', 'QuoteController@destroy')->name('quote.destroy');
    Route::get('orderPayment/{id}', 'QuoteController@orderPayment')->name('orderPayment');
    Route::get('PaymentData', 'QuoteController@PaymentData')->name('PaymentData');
    Route::get('add_payment/{id}', 'QuoteController@AddPayment')->name('AddPayment');
    Route::post('order_payment_store', 'QuoteController@OrderPaymentStore')->name('order_payment_store');
    Route::get('payment_destroy/{id}', 'QuoteController@payment_destroy')->name('payment_destroy');
    /*customer services order routes end*/

    /*complain routes start*/
    Route::get('complain','QuoteController@complain')->name('complain');
    Route::get('complainData','QuoteController@complainData')->name('complainData');
    /*complain routes end*/

    /*pick up routes start*/
    Route::get('pick_up','PickUpController@index')->name('pick_up');
    Route::get('pick_up/getData','PickUpController@getData')->name('pick_up.getData');
    Route::get('pick_up/destroy/{id}','PickUpController@destroy');
    Route::get('pick_up/assign_rider/{id}','PickUpController@assignRider')->name('pick_up.assign_rider');
    Route::get('assign_rider_getData','PickUpController@assignRiderGetData')->name('assign_rider_getData');
    Route::get('pick_up/assign_rider_create/{id}','PickUpController@assign_rider_create')->name('assign_rider_create');
    Route::post('pick_up/assign_rider_store','PickUpController@assign_rider_store')->name('pick_up.assign_rider_store');
    Route::get('pick_up/assign_rider_status/{id}','PickUpController@assign_rider_status')->name('pick_up.assign_rider_status');
    Route::get('pick_up/assign_rider_edit/{id}','PickUpController@assign_rider_edit')->name('pick_up.assign_rider_edit');
    Route::post('pick_up/assign_rider_update/{id}','PickUpController@assign_rider_update')->name('pick_up.assign_rider_update');
    Route::get('pick_up/assign_rider_destroy/{id}','PickUpController@assign_rider_destroy')->name('pick_up.assign_rider_destroy');
    /*pick up routes end*/

    /*drop up routes start*/
    Route::get('drop_up','DropUpController@index')->name('drop_up');
    Route::get('drop_up/getData','DropUpController@getData')->name('drop_up.getData');
    Route::get('drop_up/destroy/{id}','DropUpController@destroy')->name('drop_up.destroy');
    Route::get('drop_up/drop_assign_rider/{id}','DropUpController@dropAssignRider')->name('drop_up.drop_assign_rider');
    Route::get('drop_up/drop_assign_rider_getData','DropUpController@dropAssignRiderGetData')->name('drop_up.drop_assign_rider_getData');
    Route::get('drop_up/drop_assign_rider_create/{id}','DropUpController@dropAssignRiderCreate')->name('drop_up.drop_assign_rider_create');
    Route::post('drop_up/drop_assign_rider_store','DropUpController@dropAssignRiderStore')->name('drop_up.drop_assign_rider_store');
    Route::get('drop_up/drop_assign_rider_edit/{id}','DropUpController@dropAssignRiderEdit')->name('drop_up.drop_assign_rider_edit');
    Route::post('drop_up/drop_assign_rider_update/{id}','DropUpController@dropAssignRiderUpdate')->name('drop_up.drop_assign_rider_update');
    Route::get('drop_up/drop_assign_rider_destroy/{id}','DropUpController@dropAssignRiderDestroy')->name('drop_up.drop_assign_rider_destroy');
    /*drop up routes end*/


    /*service payment start*/
    Route::get('payment','ServicePaymentController@index')->name('payment');
    Route::get('payment/getData','ServicePaymentController@getData')->name('payment.getData');
    Route::get('payment/status_change/{id}','ServicePaymentController@status_change')->name('payment.status_change');
    Route::get('payment/status_change/{id}','ServicePaymentController@status_change')->name('payment.status_change');
    Route::get('payment/invoice/{id}','ServicePaymentController@invoice')->name('payment.invoice');
    /*service payment end*/

    /*coupon routes start*/
    Route::get('coupon','CuponController@index')->name('coupon');
    Route::get('coupon/getData','CuponController@getData')->name('coupon.getData');
    Route::get('coupon/create','CuponController@create')->name('coupon.create');
    Route::post('coupon/store','CuponController@store')->name('coupon.store');
    Route::get('coupon/edit/{id}','CuponController@edit')->name('coupon.edit');
    Route::post('coupon/update/{id}','CuponController@update')->name('coupon.update');
    Route::delete('coupon/destroy/{id}','CuponController@destroy')->name('coupon.destroy');

    Route::get('user_coupon_list','CuponController@UserCouponList')->name('user_coupon_list');
    Route::get('user_coupon_getData','CuponController@user_coupon_getData')->name('user_coupon_getData');
    /*coupon routes end*/

});

//customer Routes
Route::group(['middleware' => ['auth','marchent']], function (){

    Route::get('/customer','MarchentController@index')->name('customer');

});
