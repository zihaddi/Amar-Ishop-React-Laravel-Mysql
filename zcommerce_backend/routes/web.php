<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','role'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //products ::
    Route::get('/products', [ProductController::class, 'view'])->name('products');
    Route::get('/productAdd', [ProductController::class, 'add'])->name('productAdd');
    Route::post('/productsAdd', [ProductController::class, 'postadd']);
    Route::get('/productEdit', [ProductController::class, 'edit'])->name('productEdit');
    Route::post('/productsEdit', [ProductController::class, 'postedit']);
    Route::get('/productDelete', [ProductController::class, 'delete'])->name('productDelete');
    Route::post('/productsDelete', [ProductController::class, 'postdelete']);

    //Users ::
    Route::get('/users', [UserController::class, 'view'])->name('users');
    Route::get('/userAdd', [UserController::class, 'add'])->name('userAdd');
    Route::post('/usersAdd', [UserController::class, 'postadd']);
    Route::get('/userEdit', [UserController::class, 'edit'])->name('userEdit');
    Route::post('/usersEdit', [UserController::class, 'postedit']);
    Route::get('/userDelete', [UserController::class, 'delete'])->name('userDelete');
    Route::post('/usersDelete', [UserController::class, 'postdelete']);

    //Orders ::
    Route::get('/orders', [OrderController::class, 'view'])->name('orders');
    Route::get('/orderEdit', [OrderController::class, 'edit'])->name('orderEdit');
    Route::post('/ordersEdit', [OrderController::class, 'postedit']);
    Route::get('/orderDetails', [OrderController::class, 'orderDetails'])->name('orderDetails');
    Route::get('/pendingOrder', [OrderController::class, 'pendingOrder'])->name('pendingOrder');
    Route::get('/approvedOrder', [OrderController::class, 'approvedOrder'])->name('approvedOrder');
    Route::get('/shippingOrder', [OrderController::class, 'shippingOrder'])->name('shippingOrder');
    Route::get('/completedOrder', [OrderController::class, 'completedOrder'])->name('completedOrder');
    Route::get('/orderAdd', [OrderController::class, 'add'])->name('orderAdd');
    Route::post('/ordersAdd', [OrderController::class, 'postadd']);
    Route::get('/backWithFlash', [OrderController::class, 'backWithFlash'])->name('backWithFlash');
    Route::get('/clearCart', [OrderController::class, 'clearCart'])->name('clearCart');
    Route::get('/orderCheckout', [OrderController::class, 'orderCheckout'])->name('orderCheckout');
    
    
    
    
    
});



require __DIR__ . '/auth.php';
