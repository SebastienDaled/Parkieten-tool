<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartConroller;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\LidgeldController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::redirect('', '/home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/profile/{user}', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('updateProfile');

    
    // succes and webhook
    Route::get('/cart', [CartConroller::class, 'showCart'])->name('cart');
    
    // routes/web.php

    // Route::name('webhooks.mollie')->post('webhooks/mollie', 'PaymentController@handleWebhook');

    

    Route::get('/home', [PageController::class, 'index'])->name('home');
    Route::get('/home/history', [PageController::class, 'history'])->name('history');
    Route::get('/home/order', [PageController::class, 'order'])->name('order');
    Route::post('/home/order/filter', [FilterController::class, 'filter'])->name('filter');
    Route::post('/home/order/addToCart', [CartConroller::class, 'addToCart'])->name('addToCart');
    Route::post('home/order/deleteFromCart', [CartConroller::class, 'deleteFromCart'])->name('deleteFromCart');

    
    Route::get('/cart/checkout/success', [CartConroller::class, 'success'])->name('payment.success');
    Route::get('/lidgeld/success', [LidgeldController::class, 'success'])->name('lidgeld.success');
});

Route::middleware(['auth', 'auth.isAdmin'])->group(function () {
    Route::get('/adminPage', [AdminController::class, 'index'])->name('adminPage');

    Route::get('/adminPage/users', [AdminController::class, 'users'])->name('admin.users');
    
    
    Route::get('/adminPage/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/adminPage/users/create', [AdminController::class, 'storeUser'])->name('admin.users.store');
    
    Route::get('/adminPage/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/adminPage/users/{user}/edit', [AdminController::class, 'updateUser'])->name('admin.users.update');
    
    Route::get('/adminPage/users/{user}', [AdminController::class, 'showUser'])->name('admin.users.show');

    Route::get('/adminPage/rings', [AdminController::class, 'rings'])->name('admin.rings');
    Route::get('/adminPage/rings/create', [AdminController::class, 'createRing'])->name('admin.rings.create');
    Route::post('/adminPage/rings/create', [AdminController::class, 'storeRing'])->name('admin.rings.store');
    Route::get('/adminPage/rings/{ring}/edit', [AdminController::class, 'editRing'])->name('admin.rings.edit');
    Route::post('/adminPage/rings/{ring}/edit', [AdminController::class, 'updateRing'])->name('admin.rings.update');
    Route::get('/adminPage/rings/{ring}/delete', [AdminController::class, 'deleteRing'])->name('admin.rings.delete');

    Route::get('/adminPage/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/adminPage/orders/{order}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::get('/adminPage/orders/{order}/edit', [AdminController::class, 'editOrder'])->name('admin.orders.edit');
    Route::post('/adminPage/orders/{order}/edit', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
    Route::get('/adminPage/orders/{order}/delete', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');

    
    Route::get('/adminPage/exports', [AdminController::class, 'exports'])->name('admin.exports');
    Route::get('/adminPage/exports/export', [AdminController::class, 'exportOrders'])->name('admin.exports.export');
});

Route::post('/cart/checkout', [CartConroller::class, 'checkout'])->name('checkout');
Route::post('/webhooks/mollie', [PaymentController::class, 'handleWebhook'])->name('webhooks.mollie');

// lidgeld
Route::get('/lidgeld', [LidgeldController::class, 'payment'])->name('payment');
Route::post('/webhooks/lid/mollie', [PaymentController::class, 'lidgeldHook'])->name('webhooks.lid.mollie');

Route::group(['prefix' => 'admin'], function () {
   

    Voyager::routes();
});

// maak een middleware aan die controlleert als de rol admin is



// only for role admin
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin');
// });



