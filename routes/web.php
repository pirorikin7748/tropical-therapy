<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductViewController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/mypage', [\App\Http\Controllers\MypageController::class, 'index'])->name('mypage');
    Route::get('/mypage/profile', [MypageController::class, 'profile'])->name('mypage.profile');
    Route::post('/mypage/profile/update', [MypageController::class, 'update'])->name('mypage.update');
    Route::post('/mypage/withdraw', [MypageController::class, 'withdraw'])->name('mypage.withdraw');   
    Route::get('/mypage/favorites', [\App\Http\Controllers\MypageController::class, 'favorites'])->name('mypage.favorites');
    Route::get('/mypage/orders', [MypageController::class, 'orders'])->name('mypage.orders');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');  
    Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
    Route::post('/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
    Route::get('/checkout/complete/thanks', function () {
        return view('checkout.complete');
    })->name('checkout.complete.thanks');    
});

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::get('/contact/confirm', function () {
    return redirect()->route('contact.create');
});
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact/complete', fn() => view('contact.complete'))->name('contact.complete');

Route::get('/products', [\App\Http\Controllers\ProductViewController::class, 'index'])->name('products.index');

Route::get('/products/{id}', [productController::class, 'show'])->name('products.show');

Route::get('/legal', function () {
    return view('legal.index');
})->name('legal');

Route::middleware(['web'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('forget-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');

        Route::middleware('auth:admin')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::get('members', [\App\Http\Controllers\Admin\MemberController::class, 'index'])->name('members.index');
            Route::post('members/withdraw', [\App\Http\Controllers\Admin\MemberController::class, 'withdraw'])->name('members.withdraw');
            Route::get('members/csv', [\App\Http\Controllers\Admin\MemberController::class, 'csv'])->name('members.csv');

            Route::get('members/{id}/edit', [\App\Http\Controllers\Admin\MemberController::class, 'edit'])->name('members.edit');
            Route::post('members/{id}/update', [\App\Http\Controllers\Admin\MemberController::class, 'update'])->name('members.update');

            Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
            Route::post('/inquiries/{id}/reply', [InquiryController::class, 'reply'])->name('inquiries.reply');
            Route::get('/inquiries/{id}/reply', [InquiryController::class, 'showReplyForm'])->name('inquiries.reply_form');

            Route::post('sales/{id}/update', [SalesController::class, 'update'])->name('sales.update');
            Route::get('sales',[SalesController::class, 'index'])->name('sales.index');
            Route::get('sales/csv', [SalesController::class, 'csv'])->name('sales.csv');

            Route::get('products', [\App\Http\Controllers\Admin\AdminProductController::class, 'index'])->name('products.index');
            Route::get('products/create', [\App\Http\Controllers\Admin\AdminProductController::class, 'create'])->name('products.create');
            Route::post('products/confirm', [\App\Http\Controllers\Admin\AdminProductController::class, 'confirm'])->name('products.confirm');
            Route::post('products', [\App\Http\Controllers\Admin\AdminProductController::class, 'store'])->name('products.store');
            Route::get('products/{product}/edit', [\App\Http\Controllers\Admin\AdminProductController::class, 'edit'])->name('products.edit');
            Route::put('products/{product}', [\App\Http\Controllers\Admin\AdminProductController::class, 'update'])->name('products.update');
            Route::delete('products/{product}', [\App\Http\Controllers\Admin\AdminProductController::class, 'destroy'])->name('products.destroy');
            Route::get('products/csv', [\App\Http\Controllers\Admin\AdminProductController::class, 'csv'])->name('products.csv');
            Route::post('products/delete', [\App\Http\Controllers\Admin\AdminProductController::class, 'onDelete'])->name('products.onDelete');
        });
    });

require __DIR__.'/auth.php';

Route::get('/', [\App\Http\Controllers\ProductViewController::class, 'index'])->name('products.index');
