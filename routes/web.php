<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
Route::get('/clear-app-cache', function() {
    Artisan::call('cache:clear');
    return "cache cleared!";
    });
    
    Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "all cache cleared!";
    });


Route::get('/', [PagesController::class, 'index']) ;
Route::get('/about',[PagesController::class, 'about']);
Route::get('/services',[PagesController::class, 'services']);

// Route::resource('posts',PostsController::class);
Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/create', [PostsController::class, 'create']);
Route::get('/posts/{id}', [PostsController::class, 'show']);
Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');
Route::get('/posts/edit/{id}', [PostsController::class, 'edit']);
Route::post('/posts/update/{id}', [PostsController::class, 'update']);
Route::post('/posts/delete/{id}', [PostsController::class, 'destroy']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
