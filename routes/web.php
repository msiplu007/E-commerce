<?php
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'FrontendController@index');
Route::get('product/details/{slug}', 'FrontendController@productdetails');
Auth::routes(['verify' => true]);
//controller category
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('contact/upload/file/{contact_id}', 'HomeController@contactuploadfile');
Route::get('send/sendnewslatter', 'HomeController@sendsendnewslatter');
Route::get('addcategory', 'Categorycontroller@addcategory');
Route::post('addcategory/post', 'Categorycontroller@addcategorypost');
Route::get('delete/category/{category_id}', 'Categorycontroller@deletecategory');
Route::get('edit/category/{category_id}', 'Categorycontroller@editcategory');
Route::post('edit/category/post', 'Categorycontroller@editcategorypost');
Route::get('restore/category/{category_id}', 'Categorycontroller@restorecategory');
Route::get('force/delete/category/{category_id}', 'Categorycontroller@forcecdeleteategory');
Route::get('contact', 'FrontendController@contact');
Route::post('contact/insert', 'FrontendController@contactinsert');
Route::get('blog', 'FrontendController@blog');
Route::get('service', 'ServiceController@service');
Route::get('shop', 'FrontendController@shop');
Route::get('customer/register', 'FrontendController@customerregister');
Route::post('customer/register/post', 'FrontendController@customerregisterpost');



Route::post('cart/stote', 'CartController@store')->name('cart.store');
Route::get('cart', 'CartController@index')->name('cart.index');
Route::get('cart/{coupon_name}', 'CartController@index')->name('cart.shohan');
//profile controller
Route::get('profile', 'ProfileController@profile');
Route::post('editprofilepost', 'ProfileController@editprofilepost');
Route::post('editpasswordpost', 'ProfileController@editpasswordpost');
Route::post('mark/delete', 'CategoryController@markdelete');
Route::post('mark/restore', 'CategoryController@markrestore');

Route::post('changeprofilephoto', 'ProfileController@changeprofilephoto');



Route::resource('product', 'ProductController');
Route::resource('coupon', 'CouponController');

Route::get('checkout', 'CheckoutController@index');

Route::get('cart/remove/{cart_id}', 'CartController@remove')->name('cart.remove');
Route::post('cart/update', 'CartController@update')->name('cart.update');

Route::get('customer/home', 'CustomerController@home');


//git hub controller
Route::get('login/github', 'GithubController@redirectToProvider');
Route::get('login/github/callback', 'GithubController@handleProviderCallback');
