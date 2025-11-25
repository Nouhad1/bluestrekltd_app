<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ------------------------------
// Routes publiques
// ------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog.list');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Produits
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/pproduct', [HomeController::class, 'pproduct'])->name('product.list');
Route::get('/product_details/{id}', [HomeController::class, 'product_details'])->name('product.details');
Route::get('/products/category/{id}', [HomeController::class, 'productsByCategory'])->name('products.byCategory');

// Redirection dashboard admin
Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

// ------------------------------
// Routes client
// ------------------------------
Route::prefix('client')->group(function () {

    // Authentification
    Route::get('/login', [HomeController::class, 'showLoginForm'])->name('client.login');
    Route::post('/login', [HomeController::class, 'login'])->name('client.login.submit');
    Route::post('/logout', [HomeController::class, 'logout'])->name('client.logout');

    // Inscription
    Route::get('/register', [HomeController::class, 'showRegisterForm'])->name('client.register');
    Route::post('/register', [HomeController::class, 'register'])->name('client.register.submit');

    // Mot de passe oublié / reset (noms corrigés)
    Route::get('/forgot-password', [HomeController::class, 'showForgotForm'])->name('client.password.request');
    Route::post('/forgot-password', [HomeController::class, 'sendResetLink'])->name('client.password.email');
    Route::get('/reset-password/{token}', [HomeController::class, 'showResetForm'])->name('client.password.reset');
    Route::post('/reset-password', [HomeController::class, 'resetPassword'])->name('client.password.update');

    // Confirm password
    Route::get('/confirm-password', [HomeController::class, 'showConfirmForm'])->name('client.password.confirm');
    Route::post('/confirm-password', [HomeController::class, 'confirmPassword'])->name('client.password.confirm.post');

    // Two-factor authentication (noms corrigés)
    Route::get('/two-factor-challenge', [HomeController::class, 'showChallengeForm'])->name('client.two-factor.login');
    Route::post('/two-factor-challenge', [HomeController::class, 'verifyChallenge'])->name('client.two-factor.verify');

    // Email Verification
    Route::get('/verify-email', function () {
        return view('client.verify-email');
    })->middleware('auth:client')->name('client.verification.notice');

    Route::post('/email/verification-notification', [HomeController::class, 'sendEmailVerification'])
        ->middleware(['auth:client', 'throttle:6,1'])
        ->name('client.verification.send');

    // Routes protégées par auth:client
    Route::middleware('auth:client')->group(function () {
        // Profil client
        Route::get('/profile', [HomeController::class, 'profile'])->name('client.profile');
        Route::post('/profile/update', [HomeController::class, 'updateProfile'])->name('client.profile.update');

        // Historique des commandes
        Route::get('/orders', [HomeController::class, 'orders'])->name('client.orders');

        // Panier
        Route::get('/show_cart', [HomeController::class, 'show_cart'])->name('client.cart.show');
        Route::post('/cart/confirm', [HomeController::class, 'confirmOrder'])->name('client.cart.confirm');
        Route::put('/cart/update/{id}', [HomeController::class, 'updateCart'])->name('client.cart.update');
        Route::delete('/cart/remove/{id}', [HomeController::class, 'removeCartItem'])->name('client.cart.remove');
        Route::post('/add_cart/{reference}', [HomeController::class, 'add_cart'])->name('client.cart.add');
    });
});

// ------------------------------
// Routes Admin
// ------------------------------
Route::prefix('admin')->group(function () {

    // Authentification admin
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    Route::middleware('auth:admin')->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'view_dashboard'])->name('admin.dashboard');

        // Catégories
        Route::get('/categories', [AdminController::class, 'view_category'])->name('admin.categories');
        Route::post('/categories', [AdminController::class, 'add_category'])->name('admin.categories.add');
        Route::get('/categories/delete/{id}', [AdminController::class, 'delete_category'])->name('admin.categories.delete');

        // Produits
        Route::get('/products', [AdminController::class, 'view_product'])->name('admin.products');
        Route::post('/products', [AdminController::class, 'add_product'])->name('admin.products.add');
        Route::get('/products/show', [AdminController::class, 'show_product'])->name('admin.products.show');
        Route::get('/products/delete/{reference}', [AdminController::class, 'delete_product'])->name('admin.products.delete');
        Route::get('/products/update/{reference}', [AdminController::class, 'update_product'])->name('admin.products.update');
        Route::put('/products/update/{reference}', [AdminController::class, 'update_product_confirm'])->name('admin.products.update.confirm');
        Route::get('/check-product/{reference}', [AdminController::class, 'checkProduct']);

        // Commandes
        Route::get('/orders', [AdminController::class, 'order'])->name('admin.orders');
        Route::get('/orders/delivered/{id}', [AdminController::class, 'delivered'])->name('admin.orders.delivered');
        Route::get('/orders/search', [AdminController::class, 'searchdata'])->name('admin.orders.search');

        // Entrées (achats)
        Route::get('/entries', [AdminController::class, 'entry'])->name('admin.entry');
        Route::get('/add_entry', [AdminController::class, 'add_entry'])->name('admin.add_entry');
        Route::post('/store_entry', [AdminController::class, 'store_entry'])->name('admin.store_entry');
        Route::get('/delete_entry/{id}', [AdminController::class, 'delete_entry'])->name('admin.delete_entry');

        // Messages
        Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
        Route::get('/reply/{id}', [AdminController::class, 'replyMessage'])->name('admin.reply');
        Route::post('/reply/{id}', [AdminController::class, 'sendReply'])->name('admin.sendReply');

        // Déconnexion admin
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});

// Social login
Route::get('login/{provider}', [HomeController::class, 'redirect'])->name('social.login');
Route::get('login/{provider}/callback', [HomeController::class, 'callback'])->name('social.callback');

/*Route::get('/test-db', function () {
    return DB::table('sessions')->count();
});*/
