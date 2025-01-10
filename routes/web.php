<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVarificationMiddleware;
use Illuminate\Support\Facades\Route;


//web API routes
Route::post('/user-registration',[UserController::class,'userRegistration']);
Route::post('/user-login',[UserController::class,'userLogin']);
Route::post('/otp-send',[UserController::class,'sendOtp']);
Route::post('/otp-verify',[UserController::class,'verifyOtp']);
Route::post('/password-reset',[UserController::class,'resetPassword'])->middleware(TokenVarificationMiddleware::class);
Route::post('/update-user',[UserController::class,'updateUser'])->middleware(TokenVarificationMiddleware::class);



// page routes
Route::get('/',[UserController::class,'homePage']);
Route::get('/login',[UserController::class,'login']);
Route::get('/logout',[UserController::class,'userLogout']);
Route::get('/registration',[UserController::class,'registration']);
Route::get('/sendOtp',[UserController::class,'sendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'verifyOtpPage']);
Route::get('/resetPass',[UserController::class,'resetPass'])->middleware(TokenVarificationMiddleware::class);
Route::get('/dashboard',[UserController::class,'dashboard'])->middleware(TokenVarificationMiddleware::class);
Route::get('/profile',[UserController::class,'profilePage'])->middleware(TokenVarificationMiddleware::class);
Route::get('/category-page',[CategoryController::class,'categoryPage'])->middleware(TokenVarificationMiddleware::class);
Route::get('/customer-page',[CustomerController::class,'customerPage'])->middleware(TokenVarificationMiddleware::class);
Route::get('/product-page',[ProductController::class,'productPage'])->middleware(TokenVarificationMiddleware::class);
Route::get('/sale-page',[InvoiceController::class,'salePage'])->middleware(TokenVarificationMiddleware::class);


// category
Route::post('/create-category',[CategoryController::class,'createCategory'])->middleware(TokenVarificationMiddleware::class);
Route::get('/list-category',[CategoryController::class,'listCategory'])->middleware(TokenVarificationMiddleware::class);
Route::post('/update-category',[CategoryController::class,'updateCategory'])->middleware(TokenVarificationMiddleware::class);
Route::post('/delete-category',[CategoryController::class,'deleteCategory'])->middleware(TokenVarificationMiddleware::class);
Route::get('/category-by-id',[CategoryController::class,'categoryById'])->middleware(TokenVarificationMiddleware::class);



// customer
Route::post('/create-customer',[CustomerController::class,'createCustomer'])->middleware(TokenVarificationMiddleware::class);
Route::get('/list-customer',[CustomerController::class,'listCustomer'])->middleware(TokenVarificationMiddleware::class);
Route::post('/update-customer',[CustomerController::class,'updateCustomer'])->middleware(TokenVarificationMiddleware::class);
Route::post('/delete-customer',[CustomerController::class,'deleteCustomer'])->middleware(TokenVarificationMiddleware::class);
Route::get('/customer-by-id',[CustomerController::class,'customerById'])->middleware(TokenVarificationMiddleware::class);


// porduct
Route::post('/create-product',[ProductController::class,'createProduct'])->middleware(TokenVarificationMiddleware::class);
Route::get('/list-product',[ProductController::class,'listProduct'])->middleware(TokenVarificationMiddleware::class);
Route::post('/update-product',[ProductController::class,'updateProduct'])->middleware(TokenVarificationMiddleware::class);
Route::post('/delete-product',[ProductController::class,'deleteProduct'])->middleware(TokenVarificationMiddleware::class);
Route::get('/product-by-id',[ProductController::class,'productById'])->middleware(TokenVarificationMiddleware::class);

