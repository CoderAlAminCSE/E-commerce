<?php

use App\Http\Controllers\admin\category\BrandController;
use App\Http\Controllers\admin\category\CategoryController;
use App\Http\Controllers\admin\category\CouponController;
use App\Http\Controllers\admin\category\SubCatController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\SiteController;
use App\Http\Controllers\admin\StokeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SerachController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/home', function () {
    return view('pages.home');
});


//frontend user related route
Route::get('/user/home',[HomeController::class,'UserIndex'])->name('user.home');
Route::get('/user/logout',[HomeController::class,'UserLogout'])->name('user.logout');


//category related route
Route::get('/admin/category',[CategoryController::class,'CategoryView'])->name('category.view');
Route::post('/admin/category/store',[CategoryController::class,'CategoryStore'])->name('store.category');
Route::get('/admin/category/delete/{id}',[CategoryController::class,'CategoryDelete'])->name('category.delete');
Route::get('/admin/category/edit/{id}',[CategoryController::class,'CategoryEdit'])->name('category.edit');
Route::post('/admin/category/update/{id}',[CategoryController::class,'CategoryUpdate'])->name('update.category');


//brands related route
Route::get('/admin/brand',[BrandController::class,'BrandView'])->name('brands.view');
Route::post('/admin/brand/store',[BrandController::class,'BrandStore'])->name('store.brand');
Route::get('/admin/brand/delete/{id}',[BrandController::class,'BrandDelete'])->name('brand.delete');
Route::get('/admin/brand/edit/{id}',[BrandController::class,'BrandEdit'])->name('brand.edit');
Route::post('/admin/brand/update/{id}',[BrandController::class,'BrandUpdate'])->name('update.brand');


//subcategory related route
Route::get('/admin/subcategory',[SubCatController::class,'SubCatView'])->name('subcategory_view.view');
Route::post('/admin/subcat/store',[SubCatController::class,'SubCatStore'])->name('store.subcategory');
Route::get('/admin/subcat/delete/{id}',[SubCatController::class,'SubCatDelete'])->name('subcategory.delete');
Route::get('/admin/subcat/edit/{id}',[SubCatController::class,'SubCatEdit'])->name('subcategory.edit');
Route::post('/admin/subcat/update/{id}',[SubCatController::class,'SubCatUpdate'])->name('update.subcategory');



//coupon related route
Route::get('/admin/coupon',[CouponController::class,'CouponView'])->name('coupon.view');
Route::post('/admin/coupon/store',[CouponController::class,'CouponStore'])->name('store.coupon');
Route::get('/admin/coupon/delete/{id}',[CouponController::class,'CouponDelete'])->name('coupon.delete');
Route::get('/admin/coupon/edit/{id}',[CouponController::class,'CouponEdit'])->name('coupon.edit');
Route::post('/admin/coupon/update/{id}',[CouponController::class,'CouponUpdate'])->name('update.coupon');


//product related route
Route::get('/admin/product',[ProductController::class,'ProductView'])->name('product.view');
Route::get('/admin/product/add',[ProductController::class,'ProductAdd'])->name('product.add');
Route::get('get/subcategory/{category_id}',[ProductController::class,'GetSubCat']);
Route::post('/admin/product/store',[ProductController::class,'ProductStore'])->name('store.product');
Route::get('inactive/product/{id}',[ProductController::class,'InActive'])->name('inactive.product');
Route::get('active/product/{id}',[ProductController::class,'Active'])->name('active.product');
Route::get('/admin/product/delete/{id}',[ProductController::class,'DeleteProduct'])->name('product.delete');
Route::get('/admin/product/details/{id}',[ProductController::class,'DetailsProduct'])->name('product.details');
Route::get('/admin/product/edit/{id}',[ProductController::class,'EditProduct'])->name('product.edit');
Route::post('/admin/product/withoutphoto/{id}',[ProductController::class,'updateProductwithoutphoto'])->name('update.product.withoutphoto');
Route::post('/admin/product/withphoto/{id}',[ProductController::class,'updateProductwithphoto'])->name('update.product.withphoto');
Route::get('products/{id}',[ProductController::class,'SubProductView']);
Route::get('allcategory/{id}',[ProductController::class,'CatProductView']);



//blog related route
Route::get('/blog/category/list',[PostController::class,'BlogCatList'])->name('add.blog.categorylist');
Route::post('/blog/category/store',[PostController::class,'BlogCatStore'])->name('store.blog.category');
Route::get('/blog/category/edit/{id}',[PostController::class,'BlogCatEdit'])->name('edit.blog.category');
Route::post('/blog/category/update/{id}',[PostController::class,'BlogCatUpdate'])->name('update.blog.category');
Route::get('/blog/category/delete/{id}',[PostController::class,'BlogCatDelete'])->name('delete.blog.category');

Route::get('/admin/all/blogpost',[PostController::class,'ViewBlogPost'])->name('all.blogpost');
Route::get('/admin/add/blogpost',[PostController::class,'CreatBlogPost'])->name('add.blogpost');
Route::post('/admin/store/blogpost',[PostController::class,'StoreBlogPost'])->name('store.post');
Route::get('/admin/delete/blogpost/{id}',[PostController::class,'DeleteBlogPost'])->name('delete.blogpost');
Route::get('/admin/edit/blogpost/{id}',[PostController::class,'EditBlogPost'])->name('edit.blogpost');
Route::post('/admin/update/blogpost/{id}',[PostController::class,'UpdateBlogPost'])->name('update.blogpost');


//wishlist related route
Route::get('add/wishlist/{id}',[WishlistController::class,'AddWishlist']);
Route::get('user/wishlist/view',[WishlistController::class,'ViewWishList'])->name('user.wishlist');


//AddToCart related route
Route::get('add/to/cart/{id}',[CartController::class,'AddCart']);
Route::get('check',[CartController::class,'check']);
Route::get('product/cart/view',[CartController::class,'ShowCart'])->name('show.cart');
Route::get('remove/cart/{rowId}',[CartController::class,'RemoveCart']);
Route::post('update/cart/item/',[CartController::class,'UpdateCart'])->name('update.cartitem');
Route::get('/cart/product/view/{id}',[CartController::class,'ViewCartProduct']);
Route::post('insert/cart/item/',[CartController::class,'InsertCart'])->name('insert.into.cart');
Route::get('product/checkout/',[CartController::class,'CheckOut'])->name('user.checkout');
Route::post('user/apply/coupon/',[CartController::class,'Coupon'])->name('apply.coupon');
Route::get('user/remove/coupon/',[CartController::class,'CouponRemove'])->name('coupon.remove');
Route::get('user/payment/page/',[CartController::class,'PaymentPage'])->name('payment.setup');


//Product Details related route
Route::get('product/details/{id}',[ControllersProductController::class,'ViewProduct'])->name('product.details');
Route::post('cart/product/add/{id}',[ControllersProductController::class,'AddCart']);



//payment related route
Route::post('user/payment/process',[PaymentController::class,'Payment'])->name('payment.process');
Route::post('user/stripe/charge',[PaymentController::class,'PaymentCharge'])->name('stripe.charge');


//payment related route
Route::get('admin/panding/order',[OrderController::class,'NewOrder'])->name('admin.newOrder');
Route::get('admin/view/order/{id}',[OrderController::class,'ViewOrder']);
Route::get('admin/payment/accept/{id}',[OrderController::class,'PaymentAccept']);
Route::get('admin/payment/cancel/{id}',[OrderController::class,'PaymentCancel']);
Route::get('admin/accept/payment',[OrderController::class,'AcceptPayment'])->name('admin.accept.payment');
Route::get('admin/cancel/order',[OrderController::class,'CancelOrder'])->name('admin.cancel.order');
Route::get('admin/process/payment',[OrderController::class,'ProcessPayment'])->name('admin.process.payment');
Route::get('admin/success/payment',[OrderController::class,'SuccessPayment'])->name('admin.success.payment');
Route::get('admin/delevery/process/{id}',[OrderController::class,'DeleveryProcess']);
Route::get('admin/delevery/done/{id}',[OrderController::class,'DeleveryDone']);


//user order traking related rotue
Route::post('user/order/traking',[OrderController::class,'OrderTraking'])->name('order.tracking');


// order report related route
Route::get('admin/today/order',[ReportController::class,'TodayOrder'])->name('today.order');
Route::get('admin/today/delivery',[ReportController::class,'TodayDelivery'])->name('today.delivery');
Route::get('admin/month/delivery',[ReportController::class,'ThisMonthDelivery'])->name('this.month.delivery');
Route::get('admin/search/',[ReportController::class,'Search'])->name('search.report');
Route::post('admin/search/by/year',[ReportController::class,'SearchByYear'])->name('search.by.year');
Route::post('admin/search/by/month',[ReportController::class,'SearchByMonth'])->name('search.by.month');
Route::post('admin/search/by/date',[ReportController::class,'SearchByDate'])->name('search.by.date');


// admin site setting related route
Route::get('admin/site/setting',[SiteController::class,'SiteSetting'])->name('admin.site.setting');
Route::post('admin/update/site/setting',[SiteController::class,'UpdateSiteSetting'])->name('update.sitesetting');


// user return order related route
Route::get('success/list',[ReturnController::class,'Successlist'])->name('success.orderlist');
Route::get('request/return/{id}',[ReturnController::class,'RequestReturn']);
Route::get('admin/return/request',[ReturnController::class,'ReturnRequest'])->name('admin.return.request');
Route::get('admin/approve/return/{id}',[ReturnController::class,'ApprovedReturn']);
Route::get('admin/all/return/list',[ReturnController::class,'AllReturnRequest'])->name('admin.all.return');



// admin product stoke related route
Route::get('admin/product/list',[StokeController::class,'ProductStoke'])->name('admin.product.stoke');



// contact page related route
Route::get('contact/page',[ContactController::class,'Contact'])->name('contact.page');
Route::post('contact/form',[ContactController::class,'ContactForm'])->name('contact.form');
Route::get('admin/all/message',[ContactController::class,'AllMessage'])->name('admin.all.message');


//product search related route
Route::post('user/product/search',[SerachController::class,'Search'])->name('product.search');