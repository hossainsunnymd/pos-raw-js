<?php

use App\Http\Controllers\CategoryController;
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


// category

Route::post('/create-category',[CategoryController::class,'createCategory'])->middleware(TokenVarificationMiddleware::class);
Route::get('/list-category',[CategoryController::class,'listCategory'])->middleware(TokenVarificationMiddleware::class);
Route::post('/update-category',[CategoryController::class,'updateCategory'])->middleware(TokenVarificationMiddleware::class);
Route::post('/delete-category',[CategoryController::class,'deleteCategory'])->middleware(TokenVarificationMiddleware::class);
Route::get('/category-by-id',[CategoryController::class,'categoryById'])->middleware(TokenVarificationMiddleware::class);





